<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'role';
    protected $fillable = [
        'id_pokja',
        'role',
        'deskripsi'
    ];

    public function user(){
        return $this->hasOne(User::class, 'id_role');
    }

    public function pokja(){
        return $this->belongsTo(Pokja::class, 'id_pokja');
    }
}
