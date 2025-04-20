<?php

// hanya garden dan Koor
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use App\Models\Job;
use App\Models\Schedule;
use App\Models\Holiday;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class GenerateMonthlyScheduleeerrrrr extends Command
{
    protected $signature = 'schedule:generate {month} {year}';
    protected $description = 'Generate monthly work schedule for all employees';
    protected $jobAssignments = [];
    protected $csMainJobHistory = [];
    protected $csSecondaryJobHistory = [];

    public function handle()
    {
        $month = (int) $this->argument('month');
        $year = (int) $this->argument('year');

        if (!checkdate($month, 1, $year)) {
            $this->error("Bulan/tahun tidak valid.");
            return;
        }

        $startDate = Carbon::create($year, $month)->startOfMonth();
        $endDate = Carbon::create($year, $month)->endOfMonth();
        $dates = CarbonPeriod::create($startDate, $endDate);

        $this->info("Menghapus jadwal lama untuk {$month}/{$year}...");
        Schedule::whereMonth('work_date', $month)->whereYear('work_date', $year)->delete();

        $employees = Employee::all();
        $holidays = Holiday::whereBetween('date', [$startDate, $endDate])->pluck('date')->toArray();

        // 1. Generate untuk pegawai KOOR terlebih dahulu
        $koor = Employee::where('category', 'koor')->first();
        $bqJob = Job::where('code', 'BQ')->first();

        if ($koor && $bqJob) {
            foreach ($dates as $date) {
                $isHoliday = in_array($date->format('Y-m-d'), $holidays) || in_array($date->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY]);

                if ($isHoliday) continue;

                Schedule::updateOrCreate([
                    'employee_id' => $koor->id,
                    'work_date' => $date->format('Y-m-d'),
                ], [
                    'job_id' => $bqJob->id,
                    'job_role' => 'primary',
                    'week_number' => $date->weekOfMonth,
                ]);

                $this->jobAssignments[$date->format('Y-m-d')][$bqJob->id] = $koor->id;
            }

            $employees = $employees->filter(fn($e) => $e->id !== $koor->id);
        }

        // 2. Generate jadwal untuk pegawai lainnya
        foreach ($employees as $employee) {
            $this->generateScheduleForEmployee($employee, $dates, $holidays);
        }

        $this->info("\u2705 Selesai generate jadwal untuk {$month}/{$year}.");
    }

    protected function generateScheduleForEmployee($employee, $dates, $holidays)
    {
        $pattern = ['primary', 'primary', 'primary', 'secondary', 'off', 'off'];
        $patternLength = count($pattern);
        $dayIndex = 0;

        $startDate = $dates->getStartDate()->format('Y-m-d');

        $previousRoles = Schedule::where('employee_id', $employee->id)
            ->where('work_date', '<', $startDate)
            ->orderByDesc('work_date')
            ->limit(6)
            ->pluck('job_role')
            ->reverse()
            ->map(fn($role) => $role === 'libur' ? 'off' : $role)
            ->values()
            ->toArray();

        $offset = 0;
        if (!empty($previousRoles)) {
            $patternString = implode(',', array_merge($pattern, $pattern));
            $joinedPrev = implode(',', $previousRoles);
            $foundAt = strpos($patternString, $joinedPrev);
            if ($foundAt !== false) {
                $offset = (substr_count(substr($patternString, 0, $foundAt), ',') + count($previousRoles)) % $patternLength;
            }
        } else {
            $offset = $employee->id % 6;
        }

        foreach ($dates as $date) {
            if ($employee->category === 'koor') {
                if (in_array($date->format('Y-m-d'), $holidays)) continue;
            }

            $adjustedIndex = ($dayIndex + $offset) % $patternLength;
            $dayType = $pattern[$adjustedIndex];
            $dayIndex++;

            $jobId = $this->assignJob($employee, $dayType, $date);
            if ($dayType !== 'off' && !$jobId) continue;

            $role = $dayType === 'off' ? 'libur' : $dayType;

            Schedule::create([
                'employee_id' => $employee->id,
                'job_id' => $jobId,
                'work_date' => $date->toDateString(),
                'job_role' => $role,
                'week_number' => $date->weekOfMonth,
            ]);
        }
    }

    protected function assignJob($employee, $dayType, $date)
    {
        $dateStr = $date->toDateString();
        $weekNumber = $date->weekOfMonth;

        if ($dayType === 'off') return null;

        // Cek bentrok di level global jobAssignments
        $isJobTaken = fn($jobId) => isset($this->jobAssignments[$dateStr][$jobId]);

        // KOOR hanya ambil BQ, skip jika bentrok
        if ($employee->category === 'koor') {
            $bqJob = Job::where('code', 'BQ')->first();
            if (!$bqJob || $isJobTaken($bqJob->id)) return null;

            $this->jobAssignments[$dateStr][$bqJob->id] = $employee->id;
            return $bqJob->id;
        }

        // === PRIMARY JOB ===
        if ($dayType === 'primary') {
            if ($employee->category === 'cs') {
                $availableJobIds = Job::where('category', 'cs')
                    ->where('type', 'primary')
                    ->pluck('id')
                    ->toArray();

                $availableJobIds = array_filter($availableJobIds, fn($id) => !$isJobTaken($id));
                if (empty($availableJobIds)) return null;

                $lastWeek = $weekNumber - 1;
                $lastJobId = $this->csMainJobHistory[$employee->id][$lastWeek] ?? null;

                $filtered = array_filter($availableJobIds, fn($id) => $id !== $lastJobId);
                $candidates = !empty($filtered) ? $filtered : $availableJobIds;

                // Ambil job yang belum diambil orang lain hari itu
                $selectedJobId = collect($candidates)->random();

                // Simpan untuk minggu ini
                $this->csMainJobHistory[$employee->id][$weekNumber] = $selectedJobId;
                $this->jobAssignments[$dateStr][$selectedJobId] = $employee->id;

                return $selectedJobId;
            }

            // SPECIAL JOB untuk marbot, garden, dll
            $job = Job::where('category', $employee->category)
                ->where('type', 'special')
                ->get()
                ->reject(fn($job) => $isJobTaken($job->id))
                ->first();

            if (!$job) return null;

            $this->jobAssignments[$dateStr][$job->id] = $employee->id;
            return $job->id;
        }

        // === SECONDARY JOB ===
        if ($dayType === 'secondary') {
            $query = Job::where('type', 'secondary');

            // Pegawai kategori garden tidak boleh FOM & FOP
            if ($employee->category === 'garden') {
                $query->whereNotIn('code', ['FOM', 'FOP']);
            }

            $jobs = $query->get();
            if ($jobs->isEmpty()) return null;

            // Ambil yang belum diambil orang lain hari itu
            $jobs = $jobs->reject(fn($job) => $isJobTaken($job->id));

            if ($jobs->isEmpty()) return null;

            // Rolling agar tidak sama dengan minggu lalu
            $lastCode = $this->csSecondaryJobHistory[$employee->id] ?? null;
            $filtered = $jobs->filter(fn($job) => $job->code !== $lastCode);
            $selected = $filtered->isNotEmpty() ? $filtered->random() : $jobs->random();

            $this->csSecondaryJobHistory[$employee->id] = $selected->code;
            $this->jobAssignments[$dateStr][$selected->id] = $employee->id;

            return $selected->id;
        }

        return null;
    }
}
