<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokja extends Model
{
    use HasFactory;
    
    protected $table = 'pokja';
    protected $fillable = [
        'pokja',
        'deskripsi',
    ];

    public function role(){
        return $this->hasMany(Role::class, 'id_pokja');
    }

    public function rencana(){
        return $this->hasMany(RencanaAnggaran::class, 'id_pokja');
    }
}
