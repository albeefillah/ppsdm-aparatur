<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komponen extends Model
{
    use HasFactory;

    protected $table = 'komponen';
    protected $fillable = [
        'kode',
        'nama_komponen'
    ];

    public function subKomponen()
    {
        return $this->hasMany(SubKomponen::class,'id_komponen');
    }
}
