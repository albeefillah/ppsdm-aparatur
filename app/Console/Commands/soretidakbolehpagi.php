<?php

namespace App\Console\Commands;
// sore tidak boleh pagi

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Job;
use App\Models\Schedule;
use App\Models\Holiday;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Cache;

class GenerateMonthlySchedulesawew extends Command
{
    protected $signature = 'schedule:generate {month} {year} {--eligibility=}';
    protected $description = 'Generate monthly work schedule for all employees';

    protected $employeeAssignments = [];
    protected $employeeLastJob = [];
    protected $jobAssignments = [];
    protected $eligibilityMap = [];
    protected $nightShiftAssignments = [];
    protected $employeeCyclePosition = [];
    protected $eveningShiftAssignments = []; // Untuk tracking shift sore
    protected $forcedNightShiftNextDays = []; // [employee_id] = [dateStr => true]
    protected $forcedOffAfterNight = [];      // [employee_id] = [dateStr => true]



    public function handle()
    {
        $month = (int) $this->argument('month');
        $year = (int) $this->argument('year');
        $eligibilityKey = $this->option('eligibility');
        $this->eligibilityMap = Cache::get($eligibilityKey, []);

        if (!checkdate($month, 1, $year)) {
            $this->error("Bulan/tahun tidak valid.");
            return;
        }

        $startDate = Carbon::create($year, $month)->startOfMonth();
        $endDate = Carbon::create($year, $month)->endOfMonth();
        $dates = CarbonPeriod::create($startDate, $endDate);

        $this->info("Menghapus jadwal lama untuk {$month}/{$year}...");
        Schedule::whereMonth('work_date', $month)->whereYear('work_date', $year)->delete();

        $holidays = Holiday::whereBetween('date', [$startDate, $endDate])->pluck('date')->toArray();
        $employees = Employee::with('jobEligibilities')->get();
        $jobs = Job::all();

        // POLA: 3 kerja 1 libur
        $workCycle = ['Kerja', 'Kerja', 'Kerja', 'Libur'];
        $cycleLength = count($workCycle);
        $employeeCycles = [];
        $datesArray = iterator_to_array($dates);

        foreach ($employees as $index => $employee) {
            $defaultOffset = $index % $cycleLength;
            $offset = $this->getLastCycleOffset($employee->id, $startDate, $defaultOffset);

            foreach ($datesArray as $i => $date) {
                $dateStr = $date->toDateString();
                $cyclePos = ($i + $offset) % $cycleLength;

                $employeeCycles[$employee->id][$dateStr] = $workCycle[$cyclePos];
                $this->employeeCyclePosition[$employee->id][$dateStr] = $cyclePos; // Tambahkan ini
            }
        }


        foreach ($datesArray as $date) {
            $dateStr = $date->toDateString();
            $isHoliday = in_array($dateStr, $holidays);
            $this->jobAssignments[$dateStr] = [];

            $workingEmployees = $employees->filter(function ($employee) use ($employeeCycles, $dateStr, $isHoliday, $date) {
                if ($employee->category === 'koor') {
                    return !$isHoliday && !$date->isWeekend();
                }

                $isScheduledToWork = ($employeeCycles[$employee->id][$dateStr] ?? 'Libur') === 'Kerja';
                $yesterday = Carbon::parse($dateStr)->subDay()->toDateString();
                $wasNightShiftYesterday = $this->nightShiftAssignments[$employee->id][$yesterday] ?? false;

                return $isScheduledToWork && !$wasNightShiftYesterday;
            })->shuffle()->values();


            // Prioritaskan job dengan kandidat paling sedikit lebih dulu
            $jobEligibilityCounts = [];
            foreach ($jobs as $job) {
                $eligibleCount = $workingEmployees->filter(fn($e) => $e->jobEligibilities->contains('id', $job->id))->count();
                $jobEligibilityCounts[] = ['job' => $job, 'count' => $eligibleCount];
            }

            $sortedJobs = collect($jobEligibilityCounts)->sortBy('count')->pluck('job');

            foreach ($sortedJobs as $job) {
                $eligibleEmployees = $workingEmployees->filter(function ($employee) use ($job, $dateStr) {
                    return $this->isEligibleForJob($employee, $job, $dateStr);
                })->shuffle();

                if ($eligibleEmployees->isEmpty()) continue;

                $selectedEmployee = $eligibleEmployees->firstWhere(function ($emp) use ($job) {
                    return ($this->employeeLastJob[$emp->id] ?? null) !== $job->id;
                }) ?? $eligibleEmployees->first();

                Schedule::create([
                    'employee_id' => $selectedEmployee->id,
                    'job_id' => $job->id,
                    'work_date' => $dateStr,
                    'job_role' => 'primary',
                    'week_number' => $date->weekOfMonth,
                ]);

                // Tracking shift malam dan sore
                if ($this->isNightShift($job)) {
                    $this->nightShiftAssignments[$selectedEmployee->id][$dateStr] = true;

                    $cyclePos = $this->employeeCyclePosition[$selectedEmployee->id][$dateStr] ?? null;

                    // Prediksi lanjutan shift malam
                    if ($cyclePos === 0) {
                        // Hari 1 → lanjut malam hari 2 & 3
                        $day2 = Carbon::parse($dateStr)->addDay()->toDateString();
                        $day3 = Carbon::parse($dateStr)->addDays(2)->toDateString();
                        $day4 = Carbon::parse($dateStr)->addDays(3)->toDateString();

                        $this->forcedNightShiftNextDays[$selectedEmployee->id][$day2] = true;
                        $this->forcedNightShiftNextDays[$selectedEmployee->id][$day3] = true;
                        $this->forcedOffAfterNight[$selectedEmployee->id][$day4] = true;
                    } elseif ($cyclePos === 1) {
                        // Hari 2 → malam hari 3, off hari 4
                        $day3 = Carbon::parse($dateStr)->addDay()->toDateString();
                        $day4 = Carbon::parse($dateStr)->addDays(2)->toDateString();

                        $this->forcedNightShiftNextDays[$selectedEmployee->id][$day3] = true;
                        $this->forcedOffAfterNight[$selectedEmployee->id][$day4] = true;
                    } elseif ($cyclePos === 2) {
                        // Hari 3 → besok off
                        $day4 = Carbon::parse($dateStr)->addDay()->toDateString();
                        $this->forcedOffAfterNight[$selectedEmployee->id][$day4] = true;
                    }
                }

                if ($job->shift === 'sore') {
                    $this->eveningShiftAssignments[$selectedEmployee->id][$dateStr] = true;
                }

                $this->employeeAssignments[$selectedEmployee->id][$dateStr] = 'kerja';
                $this->employeeLastJob[$selectedEmployee->id] = $job->id;
                $this->jobAssignments[$dateStr][$job->id] = $selectedEmployee->id;
            }


            foreach ($employees as $employee) {
                if (!isset($this->employeeAssignments[$employee->id][$dateStr])) {
                    Schedule::create([
                        'employee_id' => $employee->id,
                        'job_id' => null,
                        'work_date' => $dateStr,
                        'job_role' => 'libur',
                        'week_number' => $date->weekOfMonth,
                    ]);
                    $this->employeeAssignments[$employee->id][$dateStr] = 'libur';
                }
            }
        }

        $this->info("✅ Jadwal {$month}/{$year} berhasil dibuat dengan prioritas job krusial terlebih dulu.");
    }

    protected function hasJobAssigned($employeeId, $dateStr)
    {
        return isset($this->employeeAssignments[$employeeId][$dateStr]);
    }

    protected function isNightShift($job)
    {
        return $job->shift === 'malam'; // Pastikan kolom 'shift' benar-benar ada di tabel jobs
    }

    protected function isEligibleForJob($employee, $job, $dateStr)
    {


        // Cek apakah sudah ditugaskan di hari ini
        if ($this->hasJobAssigned($employee->id, $dateStr)) {
            return false;
        }

        // Cek apakah pegawai memang eligible untuk job ini
        if (!$employee->jobEligibilities->contains('id', $job->id)) {
            return false;
        }

        $yesterday = Carbon::parse($dateStr)->subDay()->toDateString();

        // Larangan shift pagi setelah sore
        if ($job->shift === 'pagi') {
            if ($this->eveningShiftAssignments[$employee->id][$yesterday] ?? false) {
                return false;
            }
        }

        // Larangan kerja setelah shift malam (harus OFF)
        if ($this->isNightShift($job)) {
            // tidak perlu dicek di sini karena shift malam justru ditentukan di hari ini
            // tapi pastikan hari berikutnya di-filter saat generate workingEmployees
        } else {
            // Jika kemarin malam, hari ini tidak boleh kerja
            if ($this->nightShiftAssignments[$employee->id][$yesterday] ?? false) {
                return false;
            }
        }

        // Pegawai HARUS shift malam hari ini karena rangkaian sebelumnya
        if ($this->forcedNightShiftNextDays[$employee->id][$dateStr] ?? false) {
            if (!$this->isNightShift($job)) {
                return false; // hanya boleh dapat shift malam
            }
        }

        // Pegawai HARUS libur hari ini setelah rangkaian malam
        if ($this->forcedOffAfterNight[$employee->id][$dateStr] ?? false) {
            return false;
        }


        return true;
    }


    protected function getLastCycleOffset($employeeId, $startDate, $defaultOffset)
    {
        $cycle = ['Kerja', 'Kerja', 'Kerja', 'Libur'];

        $last4 = Schedule::where('employee_id', $employeeId)
            ->whereDate('work_date', '<', $startDate)
            ->orderByDesc('work_date')
            ->limit(4)
            ->pluck('job_role')
            ->reverse()
            ->map(fn($r) => $r === 'libur' ? 'Libur' : 'Kerja')
            ->values()
            ->toArray();

        if (count($last4) === 0) {
            return $defaultOffset; // <- PASTIKAN INI ADA
        }

        foreach ($cycle as $i => $value) {
            $match = true;
            foreach ($last4 as $j => $item) {
                if ($cycle[($i + $j) % 4] !== $item) {
                    $match = false;
                    break;
                }
            }
            if ($match) {
                return ($i + count($last4)) % 4;
            }
        }

        return $defaultOffset;
    }
}
