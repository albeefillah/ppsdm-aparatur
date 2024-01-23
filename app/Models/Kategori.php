<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $fillable = [
        'kode',
        'id_sub_komponen',
        'nama_kategori'
    ];


    public function subKomponen()
    {
        return $this->belongsTo(SubKomponen::class,'id_sub_komponen');
    }
}
