<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $fillable = [
        'name',
        'category',
        'team'
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'employee_id');
    }
    public function jobEligibilities()
    {
        return $this->belongsToMany(Job::class, 'employee_job');
    }
    public function getAllowedJobsAttribute()
    {
        return $this->jobEligibilities->pluck('id')->toArray();
    }
}
