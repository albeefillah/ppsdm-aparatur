<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanProgram extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_program';
    protected $fillable = [
        'kode',
        'deskripsi',
        'pagu_awal'
    ];

    public function kro()
    {
        return $this->hasMany(KRO::class, 'id_kegiatan_program');
    }
}
