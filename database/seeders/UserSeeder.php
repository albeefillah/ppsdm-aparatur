<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name'	=> 'Kepala Pusat',
            'username'	=> 'dashboard_kapus',
            'email'	=> 'kapus@gmail.com',
            'password'	=> bcrypt('kapusaparatur'),
            'id_role' => 1,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\User::create([
            'name'	=> 'Super Admin',
            'username'	=> 'superadmin',
            'email'	=> 'superadmin@gmail.com',
            'password'	=> bcrypt('superadmin'),
            'id_role' => 2,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\User::create([
            'name'	=> 'BPAU',
            'username'	=> 'dashboard_bpau',
            'email'	=> 'bpau@gmail.com',
            'password'	=> bcrypt('bagianumum'),
            'id_role' => 3,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\User::create([
            'name'	=> 'BPAS',
            'username'	=> 'dashboard_bpas',
            'email'	=> 'bpas@gmail.com',
            'password'	=> bcrypt('diklatsarpras'),
            'id_role' => 4,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\User::create([
            'name'	=> 'BPAP',
            'username'	=> 'dashboard_bpap',
            'email'	=> 'bpap@gmail.com',
            'password'	=> bcrypt('prokerevaluasi'),
            'id_role' => 5,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\User::create([
            'name'	=> 'BPAK',
            'username'	=> 'dashboard_bpak',
            'email'	=> 'bpak@gmail.com',
            'password'	=> bcrypt('standardisasi'),
            'id_role' => 6,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
      
    }
}
