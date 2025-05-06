<?php

namespace App\Console\Commands;
// pola 3 kerja 1 libur
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Job;
use App\Models\Schedule;
use App\Models\Holiday;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Cache;

class GenerateMonthlyScheduleasd extends Command
{
    protected $signature = 'schedule:generate {month} {year} {--eligibility=}';
    protected $description = 'Generate monthly work schedule for all employees';

    protected $employeeAssignments = [];
    protected $employeeLastJob = [];
    protected $jobAssignments = [];
    protected $eligibilityMap = [];

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
            $offset = $index % $cycleLength;
            foreach ($datesArray as $i => $date) {
                $dateStr = $date->toDateString();
                $cyclePos = ($i + $offset) % $cycleLength;
                $employeeCycles[$employee->id][$dateStr] = $workCycle[$cyclePos];
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
                    return !$this->hasJobAssigned($employee->id, $dateStr)
                        && $employee->jobEligibilities->contains('id', $job->id);
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
}
