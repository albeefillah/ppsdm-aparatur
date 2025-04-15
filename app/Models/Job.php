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
        'start',
        'end',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'job_id');
    }
}
