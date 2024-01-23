<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKomponen extends Model
{
    use HasFactory;

    protected $table = 'sub_komponen';
    protected $fillable = [
        'id_rincian_output',
        'kode',
        'deskripsi',
        'pagu_awal'
    ];


    public function rincianOutput()
    {
        return $this->belongsTo(RincianOutput::class,'id_rincian_output');
    }

    public function detailKomponen()
    {
        return $this->hasMany(DetailKomponen::class,'id_sub_komponen');
    }
}
