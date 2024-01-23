<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Role::create([
            'id_pokja' => 5,
            'role' => 'Keuangan',
            'deskripsi' => null
        ]);

        // Role BPAU
        \App\Models\Role::create([
            'id_pokja' => 1,
            'role' => 'BPAUP',
            'deskripsi' => 'Kepegawaian'
        ]);

        \App\Models\Role::create([
            'id_pokja' => 1,
            'role' => 'BPAUK',
            'deskripsi' => 'Keuangan'
        ]);

        // Role BPAS
        \App\Models\Role::create([
            'id_pokja' => 2,
            'role' => 'BPASP',
            'deskripsi' => 'Penyelenggara Diklat'
        ]);
        \App\Models\Role::create([
            'id_pokja' => 2,
            'role' => 'BPASS',
            'deskripsi' => 'Sarana Prasarana'
        ]);

        // Role BPAP
        \App\Models\Role::create([
            'id_pokja' => 3,
            'role' => 'BPAPP',
            'deskripsi' => 'Program'
        ]);
        \App\Models\Role::create([
            'id_pokja' => 3,
            'role' => 'BPAPE',
            'deskripsi' => 'Evaluasi'
        ]);

        // Role BPAK 
        \App\Models\Role::create([
            'id_pokja' => 4,
            'role' => 'BPAKS',
            'deskripsi' => 'Standardisasi PSDM'
        ]);
        \App\Models\Role::create([
            'id_pokja' => 4,
            'role' => 'BPAKP',
            'deskripsi' => 'Perencanaan PSDM'
        ]);
    }
}
