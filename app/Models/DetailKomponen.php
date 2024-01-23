<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKomponen extends Model
{
    use HasFactory;
    protected $table = 'detail_komponen';
    protected $fillable = [
        'id_sub_komponen',
        'kode',
        'deskripsi',
        'pagu_awal'
    ];


    public function subKomponen()
    {
        return $this->belongsTo(SubKomponen::class,'id_sub_komponen');
    }

    public function akun()
    {
        return $this->belongsTo(AkunUsed::class,'id_detkom');
    }
}
