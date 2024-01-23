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
            'name'	=> 'Keuangan',
            'email'	=> 'keuangan@gmail.com',
            'password'	=> bcrypt('keuangan'),
            'id_role' => 1,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
        \App\Models\User::create([
            'name'	=> 'BPAUP',
            'email'	=> 'bpaup@gmail.com',
            'password'	=> bcrypt('bpaup'),
            'id_role' => 2,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
        \App\Models\User::create([
            'name'	=> 'BPAUK',
            'email'	=> 'bpauk@gmail.com',
            'password'	=> bcrypt('bpauk'),
            'id_role' => 3,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
        \App\Models\User::create([
            'name'	=> 'BPASP',
            'email'	=> 'bpasp@gmail.com',
            'password'	=> bcrypt('bpasp'),
            'id_role' => 4,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
        \App\Models\User::create([
            'name'	=> 'BPASS',
            'email'	=> 'bpass@gmail.com',
            'password'	=> bcrypt('bpass'),
            'id_role' => 5,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
        \App\Models\User::create([
            'name'	=> 'BPAPP',
            'email'	=> 'bpapp@gmail.com',
            'password'	=> bcrypt('bpapp'),
            'id_role' => 6,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
        \App\Models\User::create([
            'name'	=> 'BPAPE',
            'email'	=> 'bpape@gmail.com',
            'password'	=> bcrypt('bpape'),
            'id_role' => 7,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
        \App\Models\User::create([
            'name'	=> 'BPAKS',
            'email'	=> 'bpaks@gmail.com',
            'password'	=> bcrypt('bpaks'),
            'id_role' => 8,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
        \App\Models\User::create([
            'name'	=> 'BPAKP',
            'email'	=> 'bpakp@gmail.com',
            'password'	=> bcrypt('bpakp'),
            'id_role' => 9,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
    }
}
