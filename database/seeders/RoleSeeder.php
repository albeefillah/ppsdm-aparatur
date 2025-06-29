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
            'role' => 'Kapus',
            'deskripsi' => 'Kepala Pusat PPSDM Aparatur'
        ]);
        \App\Models\Role::create([
            'id_pokja' => 5,
            'role' => 'Super Admin',
            'deskripsi' => 'Super Admin'
        ]);
        \App\Models\Role::create([
            'id_pokja' => 1,
            'role' => 'BPAU',
            'deskripsi' => 'Bagian Umum'
        ]);
        \App\Models\Role::create([
            'id_pokja' => 2,
            'role' => 'BPAS',
            'deskripsi' => 'Diklat & Sarpras'
        ]);
        \App\Models\Role::create([
            'id_pokja' => 3,
            'role' => 'BPAP',
            'deskripsi' => 'Program, Evaluasi & Kerjasama'
        ]);
        \App\Models\Role::create([
            'id_pokja' => 4,
            'role' => 'BPAK',
            'deskripsi' => 'Perencanaan & Standardisasi'
        ]);

        \App\Models\Role::create([
            'id_pokja' => 1,
            'role' => 'CS',
            'deskripsi' => 'Koordinator CS'
        ]);
    }
}
