<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KegiatanProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\KegiatanProgram::create([
            'kode'	=> '1915',
            'deskripsi'	=> 'Pengelolaan Manajemen Kesekretariatan Bidang Pengembangan Sumber Daya Manusia ESDM',
            'pagu_awal' => null,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\KegiatanProgram::create([
            'kode'	=> '6398',
            'deskripsi'	=> 'Pendidikan dan Pelatihan Aparatur Sipil Negara',
            'pagu_awal' => null,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
    }
}
