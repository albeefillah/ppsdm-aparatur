<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RKAKLDetail extends Model
{
    use HasFactory;

    protected $table = 'rkakl_detail';

    public function childDetails()
    {
        return $this->hasMany(RKAKLDetail::class, 'id_parent');
    }

    public function parentDetail()
    {
        return $this->belongsTo(RKAKLDetail::class, 'id_parent');
    }
}
