<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RincianOutput extends Model
{
    use HasFactory;

    protected $table = 'rincian_output';
    protected $fillable = [
        'id_kro',
        'kode',
        'deskripsi',
        'pagu_awal'
    ];


    public function kro()
    {
        return $this->belongsTo(KRO::class, 'id_kro');
    }

    public function subKomponen()
    {
        return $this->hasMany(SubKomponen::class, 'id_rincian_output');
    }
}
