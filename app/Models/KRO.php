<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KRO extends Model
{
    use HasFactory;

    protected $table = 'kro';
    protected $fillable = [
        'id_kegiatan_program',
        'kode',
        'deskripsi',
        'pagu_awal'
    ];

    public function kegiatanProgram()
    {
        return $this->belongsTo(KegiatanProgram::class, 'id_kegiatan_program');
    }

    public function rincianOutput()
    {
        return $this->hasMany(RincianOutput::class, 'id_kro');
    }
}
