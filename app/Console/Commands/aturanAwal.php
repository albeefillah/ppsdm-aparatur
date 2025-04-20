<?php
// Aturan awal
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use App\Models\Job;
use App\Models\Schedule;
use App\Models\Holiday;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class GenerateMonthlyScheduleAwal extends Command
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
        $fopJob = Job::where('code', 'FOP')->first();

        if ($koor && $fopJob) {
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
                    'job_id' => $fopJob->id,
                    'job_role' => 'primary',
                    'week_number' => $date->weekOfMonth,
                ]);

                // Catat bahwa FOP sudah dipakai oleh koor di tanggal ini
                $this->jobAssignments[$date->format('Y-m-d')][$fopJob->id] = $koor->id;
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

        if ($dayType === 'off') return null;

        if ($employee->category === 'koor') {
            return Job::where('code', 'FOP')->first()?->id;
        }

        if ($dayType === 'primary') {
            if ($employee->category === 'cs') {
                $availableJobIds = Job::where('category', 'cs')
                    ->where('type', 'primary')
                    ->pluck('id')
                    ->toArray();

                // Filter out jobs already taken on this date
                $availableJobIds = array_filter($availableJobIds, function ($jobId) use ($dateStr) {
                    return !isset($this->jobAssignments[$dateStr][$jobId]);
                });

                if (empty($availableJobIds)) return null;

                $selectedJobId = collect($availableJobIds)->random();

                $this->jobAssignments[$dateStr][$selectedJobId] = $employee->id;
                return $selectedJobId;
            }

            // For non-CS categories (special jobs)
            return Job::where('category', $employee->category)
                ->where('type', 'special')
                ->first()?->id;
        }


        if ($dayType === 'secondary') {
            $employeeId = $employee->id;
            $team = $employee->team;

            $teamJobs = [
                1 => ['LDP', 'FOM'],
                2 => ['OBM'],
                3 => ['LDS'],
                4 => ['FOP'],
            ];

            $jobCodes = $teamJobs[$team] ?? [];
            if (count($jobCodes) > 1) {
                $last = $this->csSecondaryJobHistory[$employeeId] ?? null;
                $filteredCodes = array_filter($jobCodes, fn($code) => $code !== $last);
                $jobCodes = !empty($filteredCodes) ? $filteredCodes : $jobCodes;
            }

            // Filter job yang belum dipakai di tanggal itu
            $availableJobCodes = array_filter($jobCodes, function ($code) use ($dateStr) {
                $jobId = Job::where('code', $code)->first()?->id;
                return $jobId && !isset($this->jobAssignments[$dateStr][$jobId]);
            });

            if (empty($availableJobCodes)) return null;

            $selectedCode = collect($availableJobCodes)->random();
            $this->csSecondaryJobHistory[$employeeId] = $selectedCode;

            $jobId = Job::where('code', $selectedCode)->first()?->id;

            $this->jobAssignments[$dateStr][$jobId] = $employeeId;
            return $jobId;
        }


        return null;
    }
}
