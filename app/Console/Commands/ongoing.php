<?php
// 4 kerja 2 libur 16 job
// pola ongoing yang sampe oktober 4 kerja 2 Day 2 Malam 2 Libur
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\Job;
use App\Models\Schedule;
use App\Models\Holiday;
use App\Models\SpecialPlot;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Cache;

class GenerateMonthlySchedulesa extends Command
{
    protected $signature = 'schedule:generate {month} {year} {--eligibility=}';
    protected $description = 'Generate monthly work schedule for all employees';

    protected $employeeAssignments = [];
    protected $employeeLastJob = [];
    protected $jobAssignments = [];
    protected $eligibilityMap = [];
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
        $dates = CarbonPeriod::create($startDate, $endDate);

        $this->info("Menghapus jadwal lama untuk {$month}/{$year}...");
        Schedule::whereMonth('work_date', $month)->whereYear('work_date', $year)->delete();

        $holidays = Holiday::whereBetween('date', [$startDate, $endDate])->pluck('date')->toArray();
        $employees = Employee::with('jobEligibilities')->get();
        $jobs = Job::all();

        $workCycle = ['Kerja', 'Kerja', 'Kerja', 'Kerja', 'Libur', 'Libur'];
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
                $this->employeeCyclePosition[$employee->id][$dateStr] = $cyclePos;
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
                        && ($this->employeeCyclePosition[$employee->id][$dateStr] ?? null) === 3;
                });

                $safeEmployee = $eligibleEmployees
                    ->filter(fn($emp) => $this->isNotCrucialElsewhere($emp, $job, $workingEmployees, $jobs, $dateStr))
                    ->first();

                if (!$safeEmployee) {
                    $fallback = $workingEmployees->filter(function ($employee) use ($job, $dateStr) {
                        return !$this->hasJobAssigned($employee->id, $dateStr)
                            && $employee->jobEligibilities->contains('id', $job->id)
                            && ($this->employeeCyclePosition[$employee->id][$dateStr] ?? null) === 3;
                    })->first();
                    $safeEmployee = $fallback;
                }

                if (!$safeEmployee) continue;

                Schedule::create([
                    'employee_id' => $safeEmployee->id,
                    'job_id' => $job->id,
                    'work_date' => $dateStr,
                    'job_role' => 'primary',
                    'week_number' => $date->weekOfMonth,
                ]);

                $this->employeeAssignments[$safeEmployee->id][$dateStr] = 'kerja';
                $this->employeeLastJob[$safeEmployee->id] = $job->id;
                $this->jobAssignments[$dateStr][$job->id] = $safeEmployee->id;
            }
            foreach ($dayJobs as $job) {
                $eligibleEmployees = $workingEmployees->filter(function ($employee) use ($job, $dateStr, $date) {
                    if ($this->hasJobAssigned($employee->id, $dateStr)) {
                        return false;
                    }

                    if (!$employee->jobEligibilities->contains('id', $job->id)) {
                        return false;
                    }

                    $cyclePos = $this->employeeCyclePosition[$employee->id][$dateStr] ?? null;

                    // Hari ke-1 dan ke-2 → wajib shift pagi
                    if (in_array($cyclePos, [0, 1])) {
                        return $job->shift === 'pagi';
                    }

                    // Hari ke-3
                    if ($cyclePos === 2) {
                        if ($job->shift === 'sore') {
                            // Cari tanggal besok
                            $nextDate = Carbon::parse($dateStr)->addDay()->toDateString();
                            $nextCyclePos = $this->employeeCyclePosition[$employee->id][$nextDate] ?? null;

                            // Pastikan next day (hari ke-4) adalah cyclePos 3 dan pegawai eligible shift malam
                            return $nextCyclePos === 3 &&
                                !$this->hasJobAssigned($employee->id, $nextDate) &&
                                $employee->jobEligibilities->contains(fn($j) => $j->shift === 'malam');
                        }

                        // Shift apapun boleh (pagi, sore, malam), pengecekan sore sudah ditangani di atas
                        return true;
                    }

                    // Hari ke-4
                    if ($cyclePos === 3) {
                        return true; // tidak dibatasi — validasi kombinasi sudah ditangani dari hari sebelumnya
                    }

                    // Hari libur
                    return false;
                })->shuffle();

                if ($eligibleEmployees->isEmpty()) {
                    $reallocated = $this->attemptReallocation($job, $workingEmployees, $jobs, $dateStr);
                    if ($reallocated) continue;
                    else continue;
                }

                $selectedEmployee = $eligibleEmployees->firstWhere(function ($emp) use ($job, $workingEmployees, $jobs, $dateStr) {
                    return $this->isSafeToAssign($emp, $job, $workingEmployees, $jobs, $dateStr);
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




        $this->info("\u2705 Jadwal {$month}/{$year} berhasil dibuat dengan pola 4 kerja 2 libur dan shift malam pada hari ke-4.");
    }


    protected function hasJobAssigned($employeeId, $dateStr)
    {
        return isset($this->employeeAssignments[$employeeId][$dateStr]);
    }

    protected function isSafeToAssign($emp, $job, $workingEmployees, $allJobs, $dateStr)
    {
        foreach ($allJobs as $otherJob) {
            if ($otherJob->id === $job->id) continue;

            $otherEligible = $workingEmployees->filter(function ($e) use ($otherJob, $dateStr, $emp) {
                return !$this->hasJobAssigned($e->id, $dateStr)
                    && $e->jobEligibilities->contains('id', $otherJob->id);
            });

            if ($otherEligible->count() === 1 && $otherEligible->first()->id === $emp->id) {
                return false;
            }
        }

        return true;
    }

    protected function isNotCrucialElsewhere($emp, $job, $workingEmployees, $allJobs, $dateStr)
    {
        foreach ($allJobs as $otherJob) {
            if ($otherJob->id === $job->id) continue;

            $otherEligible = $workingEmployees->filter(function ($e) use ($otherJob, $dateStr) {
                return !$this->hasJobAssigned($e->id, $dateStr)
                    && $e->jobEligibilities->contains('id', $otherJob->id);
            });

            if ($otherEligible->count() === 1 && $otherEligible->first()->id === $emp->id) {
                return false;
            }
        }

        return true;
    }

    protected function attemptReallocation($job, $workingEmployees, $jobs, $dateStr)
    {
        foreach ($this->employeeAssignments as $empId => $assignments) {
            if (($assignments[$dateStr] ?? null) !== 'kerja') continue;

            $assignedJobId = Schedule::where('employee_id', $empId)
                ->whereDate('work_date', $dateStr)
                ->value('job_id');

            if (!$assignedJobId) continue;

            $employee = $workingEmployees->firstWhere('id', $empId);
            if (!$employee) continue;

            $jobNow = $jobs->firstWhere('id', $assignedJobId);
            if (!$jobNow) continue;

            $replacementCandidates = $workingEmployees->filter(function ($e) use ($jobNow, $dateStr, $empId) {
                return $e->id !== $empId
                    && !$this->hasJobAssigned($e->id, $dateStr)
                    && $e->jobEligibilities->contains('id', $jobNow->id);
            });

            if ($replacementCandidates->isNotEmpty()) {
                $replacement = $replacementCandidates->first();

                // Ganti penugasan lama
                Schedule::where('employee_id', $empId)->whereDate('work_date', $dateStr)->delete();

                Schedule::create([
                    'employee_id' => $replacement->id,
                    'job_id' => $jobNow->id,
                    'work_date' => $dateStr,
                    'job_role' => 'primary',
                    'week_number' => Carbon::parse($dateStr)->weekOfMonth,
                ]);
                $this->employeeAssignments[$replacement->id][$dateStr] = 'kerja';

                // Assign pegawai utama ke job yang awalnya kosong
                Schedule::create([
                    'employee_id' => $employee->id,
                    'job_id' => $job->id,
                    'work_date' => $dateStr,
                    'job_role' => 'primary',
                    'week_number' => Carbon::parse($dateStr)->weekOfMonth,
                ]);
                $this->employeeAssignments[$employee->id][$dateStr] = 'kerja';
                return true;
            }
        }
        return false;
    }

    protected function getLastCycleOffset($employeeId, $startDate, $defaultOffset)
    {
        $cycle = ['Kerja', 'Kerja', 'Kerja', 'Kerja', 'Libur', 'Libur'];

        $last6 = Schedule::where('employee_id', $employeeId)
            ->whereDate('work_date', '<', $startDate)
            ->orderByDesc('work_date')
            ->limit(6)
            ->pluck('job_role')
            ->reverse()
            ->map(fn($r) => $r === 'libur' ? 'Libur' : 'Kerja')
            ->values()
            ->toArray();

        if (count($last6) === 0) {
            return $defaultOffset;
        }

        foreach ($cycle as $i => $value) {
            $match = true;
            foreach ($last6 as $j => $item) {
                if ($cycle[($i + $j) % 6] !== $item) {
                    $match = false;
                    break;
                }
            }
            if ($match) {
                return ($i + count($last6)) % 6;
            }
        }

        return $defaultOffset;
    }
}
