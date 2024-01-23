<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    
        $this->call(PokjaSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(KegiatanProgramSeeder::class);
        $this->call(KROSeeder::class);
        $this->call(RincianOutputSeeder::class);
        $this->call(SubKomponenSeeder::class);
        $this->call(DetailKomponenSeeder::class);
    }
}
