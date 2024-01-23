<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RincianOutputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\RincianOutput::create([
            'id_kro'	=> 1,
            'kode'	=> '962',
            'deskripsi'	=> 'Layanan Umum',
            'pagu_awal' => null,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
        
        \App\Models\RincianOutput::create([
            'id_kro'	=> 1,
            'kode'	=> '963',
            'deskripsi'	=> 'Layanan Data dan Informasi',
            'pagu_awal' => null,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\RincianOutput::create([
            'id_kro'	=> 1,
            'kode'	=> '994',
            'deskripsi'	=> 'Layanan Perkantoran',
            'pagu_awal' => null,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\RincianOutput::create([
            'id_kro'	=> 2,
            'kode'	=> '971',
            'deskripsi'	=> 'Layanan Prasarana Internal',
            'pagu_awal' => null,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\RincianOutput::create([
            'id_kro'	=> 3,
            'kode'	=> '954',
            'deskripsi'	=> 'Layanan Manajemen SDM',
            'pagu_awal' => null,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\RincianOutput::create([
            'id_kro'	=> 3,
            'kode'	=> '996',
            'deskripsi'	=> 'Layanan Pendidikan dan Pelatihan',
            'pagu_awal' => null,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\RincianOutput::create([
            'id_kro'	=> 4,
            'kode'	=> '952',
            'deskripsi'	=> 'Layanan Perencanaan dan Penganggaran',
            'pagu_awal' => null,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\RincianOutput::create([
            'id_kro'	=> 4,
            'kode'	=> '953',
            'deskripsi'	=> 'Layanan Pemantauan dan Evaluasi',
            'pagu_awal' => null,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\RincianOutput::create([
            'id_kro'	=> 4,
            'kode'	=> '953',
            'deskripsi'	=> 'Layanan Manajemen Keuangan',
            'pagu_awal' => null,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\RincianOutput::create([
            'id_kro'	=> 5,
            'kode'	=> '996',
            'deskripsi'	=> 'Layanan Pendidikan dan Pelatihan',
            'pagu_awal' => null,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
    }
}
