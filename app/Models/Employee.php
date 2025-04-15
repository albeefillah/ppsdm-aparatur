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
}
