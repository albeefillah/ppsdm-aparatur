<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RKAKLAwal extends Model
{
    use HasFactory;

    
    
    protected $table = 'rkakl_new';
    protected $guarded = ['id'];
    protected $fillable = [
        'kode',
        'deskripsi',
        'jumlah_biaya',
        'tahun',
    ];

    // protected $fillable = [
    //     'tahun',
    //     'program',
    //     'kegiatan_program',
    //     'kro',
    //     'rincian_output',
    //     'subkom',
    //     'detail',
    //     'akun',
    // ];

    // protected $casts = [
    //     'program'           => 'json',
    //     'kegiatan_program'  => 'json',
    //     'kro'               => 'json',
    //     'rincian_output'    => 'json',
    //     'subkom'            => 'json',
    //     'detail'            => 'json',
    //     'akun'              => 'json',
    // ];

    public function rkaklDetail()
    {
        return $this->hasMany(RKAKLDetail::class, 'id_rkakl')->whereNull('id_parent');
    }
}
