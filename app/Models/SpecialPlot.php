<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialPlot extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id', 'job_id', 'target_date', 'reason', 'replaced_employee_id', 'previous_job_id'];
    protected $casts = [
        'target_date' => 'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
    public function replacedEmployee()
    {
        return $this->belongsTo(Employee::class, 'replaced_employee_id');
    }
    public function previousJob()
    {
        return $this->belongsTo(Job::class, 'previous_job_id');
    }
}
