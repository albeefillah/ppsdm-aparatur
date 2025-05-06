<?php

// 3 hari bertubrukan
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use App\Models\Job;
use App\Models\Schedule;
use App\Models\Holiday;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class GenerateMonthlySchedulerrrrr extends Command
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

        // 1. Generate untuk pegawai KOOR (Iwan Wiratmaja) terlebih dahulu
        $koor = Employee::where('category', 'koor')->first();
        $bqJob = Job::where('code', 'BQ')->first();

        if ($koor && $bqJob) {
            foreach ($dates as $date) {
                $isHoliday = in_array($date->format('Y-m-d'), $holidays);
                $isWeekend = in_array($date->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY]);

                if ($isHoliday || $isWeekend) {
                    continue; // Koor libur saat tanggal merah atau weekend
                }

                Schedule::updateOrCreate([
                    'employee_id' => $koor->id,
                    'work_date' => $date->format('Y-m-d'),
                ], [
                    'job_id' => $bqJob->id,
                    'job_role' => 'primary',
                    'week_number' => $date->weekOfMonth,
                ]);

                // Catat bahwa BQ sudah dipakai oleh koor di tanggal ini
                $this->jobAssignments[$date->format('Y-m-d')][$bqJob->id] = $koor->id;
            }

            // Hapus pegawai koor dari list biar nggak diproses ulang
            $employees = $employees->filter(fn($e) => $e->id !== $koor->id);
        }

        // 2. Generate jadwal untuk pegawai lainnya
        foreach ($employees as $employee) {
            $this->generateScheduleForEmployee($employee, $dates, $holidays);
        }


        $this->info("✅ Selesai generate jadwal untuk {$month}/{$year}.");
    }

    protected function generateScheduleForEmployee($employee, $dates, $holidays)
    {
        $pattern = ['primary', 'primary', 'primary', 'secondary', 'off', 'off'];
        $patternLength = count($pattern);
        $dayIndex = 0;

        $startDate = $dates->getStartDate()->format('Y-m-d');

        // Ambil max 6 jadwal terakhir sebelum bulan ini
        $previousRoles = Schedule::where('employee_id', $employee->id)
            ->where('work_date', '<', $startDate)
            ->orderByDesc('work_date')
            ->limit(6)
            ->pluck('job_role')
            ->reverse() // supaya urutannya dari yang paling lama
            ->map(function ($role) {
                return $role === 'libur' ? 'off' : $role;
            })
            ->values()
            ->toArray();

        // Gabungkan pola 2x buat bantu nyocokkan
        $offset = 0;
        if (!empty($previousRoles)) {
            $patternString = implode(',', array_merge($pattern, $pattern));
            $joinedPrev = implode(',', $previousRoles);

            $foundAt = strpos($patternString, $joinedPrev);

            if ($foundAt !== false) {
                $offset = (substr_count(substr($patternString, 0, $foundAt), ',') + count($previousRoles)) % $patternLength;
            }
        } else {
            // fallback: default offset
            $offset = $employee->id % 6;
        }

        foreach ($dates as $date) {
            if ($employee->category === 'koor') {
                $isHoliday = in_array($date->format('Y-m-d'), $holidays);
                $isWeekend = in_array($date->dayOfWeek, [Carbon::SATURDAY, Carbon::SUNDAY]);

                if ($isHoliday || $isWeekend) {
                    continue;
                }
            }

            $adjustedIndex = ($dayIndex + $offset) % $patternLength;
            $dayType = $pattern[$adjustedIndex];
            $dayIndex++;

            $jobId = $this->assignJob($employee, $dayType, $date);
            if ($dayType !== 'off' && !$jobId) {
                continue;
            }

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

        if ($employee->category === 'koor') {
            return Job::where('code', 'BQ')->first()?->id;
        }

        // PRIMARY untuk CS dengan pola 3 hari berturut
        if ($dayType === 'primary') {
            if ($employee->category === 'cs') {
                $employeeId = $employee->id;

                // Ambil semua job primary kategori cs
                $availableJobIds = Job::where('category', 'cs')
                    ->where('type', 'primary')
                    ->pluck('id')
                    ->toArray();

                // Pastikan job belum dipakai di tanggal ini
                $availableJobIds = array_filter($availableJobIds, function ($jobId) use ($dateStr) {
                    return !isset($this->jobAssignments[$dateStr][$jobId]);
                });

                if (empty($availableJobIds)) return null;

                // Hari pertama minggu: pilih job berbeda dari minggu sebelumnya
                if (!isset($this->csMainJobHistory[$employeeId][$weekNumber])) {
                    $lastWeekJobId = $this->csMainJobHistory[$employeeId][$weekNumber - 1] ?? null;

                    $filtered = array_filter($availableJobIds, fn($id) => $id !== $lastWeekJobId);
                    $candidateIds = !empty($filtered) ? $filtered : $availableJobIds;

                    $selectedJobId = collect($candidateIds)->random();
                    $this->csMainJobHistory[$employeeId][$weekNumber] = $selectedJobId;
                } else {
                    $selectedJobId = $this->csMainJobHistory[$employeeId][$weekNumber];
                }

                $this->jobAssignments[$dateStr][$selectedJobId] = $employeeId;
                return $selectedJobId;
            }

            // PRIMARY non-CS
            return Job::where('category', $employee->category)
                ->where('type', 'special')
                ->first()?->id;
        }

        // SECONDARY logic
        if ($dayType === 'secondary') {
            $employeeId = $employee->id;

            // Ambil semua job secondary
            $jobQuery = Job::where('type', 'secondary');

            // Garden tidak boleh FOM & FOP
            if ($employee->category === 'garden') {
                $jobQuery->whereNotIn('code', ['FOM', 'FOP']);
            }

            $secondaryJobs = $jobQuery->get();

            if ($secondaryJobs->isEmpty()) return null;

            $lastCode = $this->csSecondaryJobHistory[$employeeId] ?? null;
            $filtered = $secondaryJobs->filter(fn($job) => $job->code !== $lastCode);

            $jobToUse = $filtered->isNotEmpty() ? $filtered->random() : $secondaryJobs->random();

            $this->csSecondaryJobHistory[$employeeId] = $jobToUse->code;

            $this->jobAssignments[$dateStr][$jobToUse->id] = $employeeId;
            return $jobToUse->id;
        }

        return null;
    }
}
