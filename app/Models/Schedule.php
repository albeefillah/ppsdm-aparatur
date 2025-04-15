<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table = 'schedules';
    protected $fillable = [
        'employee_id',
        'job_id',
        'work_date',
        'day_type',
        'week_number',
        'job_role',
        'is_off',
    ];

    protected $casts = [
        'work_date' => 'date',
        'is_off' => 'boolean',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
}
