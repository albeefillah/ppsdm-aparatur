<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $table = 'jobs';
    protected $fillable = [
        'code',
        'name',
        'category',
        'type',
        'shift',
        'jobdesc',
        'start',
        'end',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'job_id');
    }
    public function eligibleEmployees()
    {
        return $this->belongsToMany(Employee::class, 'employee_job');
    }
}
