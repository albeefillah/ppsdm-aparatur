<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KROSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\KRO::create([
            'id_kegiatan_program'	=> 1,
            'kode'	=> 'EBA',
            'deskripsi'	=> 'Layanan Dukungan Manajemen Internal',
            'pagu_awal' => null,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\KRO::create([
            'id_kegiatan_program'	=> 1,
            'kode'	=> 'EBB',
            'deskripsi'	=> 'Layanan Sarana dan Prasarana Internal',
            'pagu_awal' => null,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\KRO::create([
            'id_kegiatan_program'	=> 1,
            'kode'	=> 'EBC',
            'deskripsi'	=> 'Layanan Manajemen SDM Internal',
            'pagu_awal' => null,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\KRO::create([
            'id_kegiatan_program'	=> 1,
            'kode'	=> 'EBD',
            'deskripsi'	=> 'Layanan Manajemen Kinerja Internal',
            'pagu_awal' => null,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);







        \App\Models\KRO::create([
            'id_kegiatan_program'	=> 2,
            'kode'	=> 'EBC',
            'deskripsi'	=> 'Layanan Manajemen SDM Internal',
            'pagu_awal' => null,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
    }
}
