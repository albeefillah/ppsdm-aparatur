<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataAnggaran extends Model
{
    use HasFactory;
    protected $table = 'mata_anggaran';
    protected $fillable = [
        'jenis_belanja',
        'akun',
        'pagu_awal',
        'tahun_anggaran',
    ];

}
