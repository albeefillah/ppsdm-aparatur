<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaAnggaran extends Model
{
    use HasFactory;

    protected $table = 'rencana_anggaran';
    protected $fillable = [
        'id_pokja',
        'id_role',
        'rencana',
        'akun',
        'tahun',
    ];

    protected $casts = [
        'rencana'  => 'json',
        'akun'  => 'json',
    ];

    public function pokja(){
        return $this->belongsTo(Pokja::class, 'id_pokja');
    }

    public function role(){
        return $this->belongsTo(Role::class, 'id_role');
    }

    public function akunUsed(){
        return $this->hasMany(AKunUsed::class, 'id_rencana');
    }



}
