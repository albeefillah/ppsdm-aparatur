<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanUsed extends Model
{
    use HasFactory;
    protected $table = 'kegiatan_used';

    protected $fillable = [
        'id_rkakl',
        'id_detkom',
        'akun_used',
        'data',
    ];
    protected $casts = [
        'akun_used' => 'json',
        'data' => 'json'
    ];

    public function detkom()
    {
        return $this->belongsTo(DetailKomponen::class, 'id_detkom');
    }

    public function rkakl()
    {
        return $this->belongsTo(RKAKLAwal::class, 'id_rkakl');
    }
}
