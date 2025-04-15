<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\Job;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ScheduleGenerator
{
    public function generate(Carbon $startDate, Carbon $endDate): void
    {
        $employees = Employee::with(['specializations', 'restrictions'])->get();
        $jobs = Job::all();

        // Clear old schedules (optional)
        Schedule::whereBetween('work_date', [$startDate, $endDate])->delete();

        $days = $startDate->copy();
        $jobAssignments = [];

        while ($days->lte($endDate)) {
            $dailyJobs = $jobs->shuffle();
            $availableEmployees = $employees->shuffle();
            $assignedJobs = [];

            foreach ($dailyJobs as $job) {
                foreach ($availableEmployees as $key => $employee) {
                    // Skip if already assigned today
                    if (in_array($employee->id, $assignedJobs)) {
                        continue;
                    }

                    // Check restriction
                    if ($employee->restrictions->pluck('restricted_job_code')->contains($job->code)) {
                        continue;
                    }

                    // If specialization exists, only allow specialized jobs
                    $specials = $employee->specializations->pluck('special_job_code');
                    if ($specials->isNotEmpty() && !$specials->contains($job->code)) {
                        continue;
                    }

                    Schedule::create([
                        'employee_id' => $employee->id,
                        'job_id' => $job->id,
                        'work_date' => $days->toDateString(),
                    ]);

                    $assignedJobs[] = $employee->id;
                    unset($availableEmployees[$key]);
                    break;
                }
            }

            $days->addDay();
        }
    }
}
