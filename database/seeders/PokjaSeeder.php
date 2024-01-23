<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PokjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Pokja::create([
            'pokja'	=> 'BPAU',
            'deskripsi'	=> 'Bagian Umum',
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\Pokja::create([
            'pokja'	=> 'BPAS',
            'deskripsi'	=> 'Pokja Penyelenggara Diklat dan Pengelolaan Sarana Prasarana',
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
        
        \App\Models\Pokja::create([
            'pokja'	=> 'BPAP',
            'deskripsi'	=> 'Pokja Prgram dan Evaluasi',
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\Pokja::create([
            'pokja'	=> 'BPAK',
            'deskripsi'	=> 'Pokja Perencanaan dan Standardisasi SDM Aparatur',
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\Pokja::create([
            'pokja'	=> 'Keuangan',
            'deskripsi'	=> 'Bagian Keuangan',
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
    }
}
