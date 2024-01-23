<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunUsed extends Model
{
    use HasFactory;

    protected $table = 'akun_used';

    protected $fillable = [
        'id_rkakl',
        'id_rencana',
        'id_role',
        'data',
    ];
    protected $casts = [
        'data' => 'json'
    ];

    public function rencana()
    {
        return $this->belongsTo(RencanaAnggaran::class, 'id_rencana');
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }

    public function rkakl()
    {
        return $this->belongsTo(RKAKLAwal::class, 'id_rkakl');
    }
}
