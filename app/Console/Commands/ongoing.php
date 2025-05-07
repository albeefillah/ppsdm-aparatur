<?php
// 3 hari seragam tapi dengan fallback
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Job;
use App\Models\Schedule;
use App\Models\Holiday;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Cache;

class GenerateMonthlyScheduleqwe extends Command
{
    protected $signature = 'schedule:generate {month} {year} {--eligibility=}';
    protected $description = 'Generate monthly work schedule for all employees';

    protected $employeeAssignments = [];
    protected $employeeLastJob = [];
    protected $jobAssignments = [];
    protected $eligibilityMap = [];
    protected $employeeCyclePosition = [];
    protected $employeeShiftCycle = [];

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

        $shifts = ['pagi', 'siang', 'sore', 'malam'];

        foreach ($employees as $index => $employee) {
            $defaultOffset = $index % $cycleLength;
            $offset = $this->getLastCycleOffset($employee->id, $startDate, $defaultOffset);
            $randomStartShift = $shifts[$index % count($shifts)];

            foreach ($datesArray as $i => $date) {
                $dateStr = $date->toDateString();
                $cyclePos = ($i + $offset) % $cycleLength;
                $employeeCycles[$employee->id][$dateStr] = $workCycle[$cyclePos];
                $this->employeeCyclePosition[$employee->id][$dateStr] = $cyclePos;

                if ($workCycle[$cyclePos] === 'Kerja') {
                    $this->employeeShiftCycle[$employee->id][$dateStr] = $randomStartShift;
                }
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
                return ($employeeCycles[$employee->id][$dateStr] ?? 'Libur') === 'Kerja';
            })->values();

            $jobEligibilityCounts = [];
            foreach ($jobs as $job) {
                $eligibleCount = $workingEmployees->filter(fn($e) => $e->jobEligibilities->contains('id', $job->id))->count();
                $jobEligibilityCounts[] = ['job' => $job, 'count' => $eligibleCount];
            }

            $sortedJobs = collect($jobEligibilityCounts)->sortBy('count')->pluck('job');

            foreach ($sortedJobs as $job) {
                $eligibleEmployees = $workingEmployees->filter(function ($employee) use ($job, $dateStr) {
                    return $this->isEligibleForJob($employee, $job, $dateStr) === true;
                })->shuffle();

                $fallbackEmployees = $workingEmployees->filter(function ($employee) use ($job, $dateStr) {
                    return $this->isEligibleForJob($employee, $job, $dateStr) === 'fallback';
                })->shuffle();

                $finalEmployees = $eligibleEmployees->merge($fallbackEmployees);

                if ($finalEmployees->isEmpty()) continue;

                $selectedEmployee = $finalEmployees->firstWhere(function ($emp) use ($job) {
                    return ($this->employeeLastJob[$emp->id] ?? null) !== $job->id;
                }) ?? $finalEmployees->first();

                Schedule::create([
                    'employee_id' => $selectedEmployee->id,
                    'job_id' => $job->id,
                    'work_date' => $dateStr,
                    'job_role' => 'primary',
                    'week_number' => $date->weekOfMonth,
                ]);

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

        $this->info("\u2705 Jadwal {$month}/{$year} berhasil dibuat dengan pola shift tetap 3 hari kerja 1 libur.");
    }

    protected function hasJobAssigned($employeeId, $dateStr)
    {
        return isset($this->employeeAssignments[$employeeId][$dateStr]);
    }

    protected function isEligibleForJob($employee, $job, $dateStr)
    {
        if ($this->hasJobAssigned($employee->id, $dateStr)) return false;
        if (!$employee->jobEligibilities->contains('id', $job->id)) return false;

        $expectedShift = $this->employeeShiftCycle[$employee->id][$dateStr] ?? null;
        $jobShift = $job->shift ?? $this->extractShiftFromJobName($job->name);

        if ($expectedShift && $jobShift !== $expectedShift) {
            return 'fallback';
        }

        return true;
    }

    protected function extractShiftFromJobName($jobName)
    {
        $lower = strtolower($jobName);
        if (str_contains($lower, 'sr')) return 'sore';
        if (str_contains($lower, 'm')) return 'malam';
        if (str_contains($lower, 's')) return 'siang';
        if (str_contains($lower, 'p')) return 'pagi';

        return null;
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

        if (count($last4) === 0) return $defaultOffset;

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
