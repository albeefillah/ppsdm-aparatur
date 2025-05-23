<?php
// Pola campuran 3-2, 4-2, 3-2, 2-1 berulang
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

class GenerateMonthlySchedulecas extends Command
{
    protected $signature = 'schedule:generate {month} {year} {--eligibility=}';
    protected $description = 'Generate monthly work schedule for all employees';

    protected $employeeAssignments = [];
    protected $employeeLastJob = [];
    protected $jobAssignments = [];
    protected $eligibilityMap = [];
    protected $employeeCycleMap = [];
    protected $employeeCyclePosition = [];

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
        $datesArray = iterator_to_array(CarbonPeriod::create($startDate, $endDate));

        $this->info("Menghapus jadwal lama untuk {$month}/{$year}...");
        Schedule::whereMonth('work_date', $month)->whereYear('work_date', $year)->delete();

        $holidays = Holiday::whereBetween('date', [$startDate, $endDate])->pluck('date')->toArray();
        $employees = Employee::with('jobEligibilities')->get();
        $jobs = Job::all();

        $globalPattern = $this->generateGlobalCyclePattern(count($datesArray));

        // Custom offset berdasarkan urutan pola start
        $customOffsets = [
            0,  // Pegawai 1
            18,  // Pegawai 2 (Libur, 3-2...)
            17,  // Pegawai 3 (Kerja, Libur, 3-2...)
            16, // Pegawai 4 (2-1, 3-2...)
            15, // Pegawai 5 (Libur, 2-1...)
            14, // Pegawai 6 (Libur, Libur, 2-1...)
            13, // Pegawai 7 (Kerja, Libur, Libur, 2-1...)
            12, // Pegawai 8 (Kerja, Kerja, Libur, Libur, 2-1...)
        ];

        foreach ($employees as $index => $employee) {
            // $offset = $customOffsets[$index % count($customOffsets)];
            $offset = $customOffsets[$index]; // asalkan jumlah pegawai <= 24

            foreach ($datesArray as $i => $date) {
                $cyclePos = ($i + $offset) % count($globalPattern);
                $status = $globalPattern[$cyclePos];
                $dateStr = $date->toDateString();
                $this->employeeCycleMap[$employee->id][$dateStr] = $status;
                $this->employeeCyclePosition[$employee->id][$dateStr] = $cyclePos;
            }
        }

        foreach ($datesArray as $date) {
            $dateStr = $date->toDateString();
            $isHoliday = in_array($dateStr, $holidays);
            $this->jobAssignments[$dateStr] = [];

            $workingEmployees = $employees->filter(function ($employee) use ($dateStr, $isHoliday, $date) {
                if ($employee->category === 'koor') {
                    return !$isHoliday && !$date->isWeekend();
                }
                return ($this->employeeCycleMap[$employee->id][$dateStr] ?? 'Libur') === 'Kerja';
            })->shuffle()->values();

            $jobEligibilityCounts = [];
            foreach ($jobs as $job) {
                $eligibleCount = $workingEmployees->filter(fn($e) => $e->jobEligibilities->contains('id', $job->id))->count();
                $jobEligibilityCounts[] = ['job' => $job, 'count' => $eligibleCount];
            }

            $sortedJobs = collect($jobEligibilityCounts)->sortBy('count')->pluck('job');
            $nightJobs = $sortedJobs->filter(fn($job) => $job->shift === 'malam');
            $dayJobs = $sortedJobs->filter(fn($job) => $job->shift !== 'malam');

            foreach ($nightJobs as $job) {
                $eligibleEmployees = $workingEmployees->filter(function ($employee) use ($job, $dateStr) {
                    return !$this->hasJobAssigned($employee->id, $dateStr)
                        && $employee->jobEligibilities->contains('id', $job->id)
                        && $this->isLastWorkDay($employee->id, $dateStr);
                });

                $selected = $eligibleEmployees->first();
                if (!$selected) continue;
                $this->assignJob($selected, $job, $date);
            }

            foreach ($dayJobs as $job) {
                $eligibleEmployees = $workingEmployees->filter(function ($employee) use ($job, $dateStr) {
                    return !$this->hasJobAssigned($employee->id, $dateStr)
                        && $employee->jobEligibilities->contains('id', $job->id);
                })->shuffle();

                $selected = $eligibleEmployees->first();
                if (!$selected) continue;
                $this->assignJob($selected, $job, $date);
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

        $this->info("\u2705 Jadwal {$month}/{$year} berhasil dibuat berdasarkan pola global offset.");
    }

    protected function generateGlobalCyclePattern($targetDays)
    {
        $fullCycle = array_merge(
            ['Kerja', 'Kerja', 'Kerja', 'Libur', 'Libur'],
            ['Kerja', 'Kerja', 'Kerja', 'Kerja', 'Libur', 'Libur'],
            ['Kerja', 'Kerja', 'Kerja', 'Libur', 'Libur'],
            ['Kerja', 'Kerja', 'Libur']
        );

        return array_slice(array_merge(...array_fill(0, ceil($targetDays / count($fullCycle)), $fullCycle)), 0, $targetDays);
    }

    protected function assignJob($employee, $job, $date)
    {
        $dateStr = $date->toDateString();
        Schedule::create([
            'employee_id' => $employee->id,
            'job_id' => $job->id,
            'work_date' => $dateStr,
            'job_role' => 'primary',
            'week_number' => $date->weekOfMonth,
        ]);
        $this->employeeAssignments[$employee->id][$dateStr] = 'kerja';
        $this->employeeLastJob[$employee->id] = $job->id;
        $this->jobAssignments[$dateStr][$job->id] = $employee->id;
    }

    protected function isLastWorkDay($employeeId, $dateStr)
    {
        $nextDate = Carbon::parse($dateStr)->addDay()->toDateString();
        return ($this->employeeCycleMap[$employeeId][$dateStr] ?? '') === 'Kerja'
            && ($this->employeeCycleMap[$employeeId][$nextDate] ?? '') === 'Libur';
    }

    protected function hasJobAssigned($employeeId, $dateStr)
    {
        return isset($this->employeeAssignments[$employeeId][$dateStr]);
    }
}
