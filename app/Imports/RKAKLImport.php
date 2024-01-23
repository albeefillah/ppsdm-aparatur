<?php

namespace App\Imports;

use App\Models\RKAKLAwal;
use Maatwebsite\Excel\Concerns\ToModel;

class RKAKLImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new RKAKLAwal([
            'kode' => $row[0],
            'deskripsi' => $row[1],
            'jumlah_biaya' => $row[2],
            'tahun' => $row[3],
        ]);
    }
}
