<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outsourcing extends Model
{
    use HasFactory;
    protected $table = 'outsourcing';
    protected $fillable = [
        'nama',
        'role',
        'lokasi',
        'tgl_piket',
        'shift',
        'kd_ket',
        'keterangan',
        'jam_mulai',
        'jam_selesai',
    ];
}
