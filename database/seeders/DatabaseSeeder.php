<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // $this->call(PokjaSeeder::class);
        // $this->call(RoleSeeder::class);
        // $this->call(UserSeeder::class);
        $this->call(EmployeeSeeder::class);
        // $this->call(JobSeeder::class);
        // $this->call(HolidaySeeder::class);
    }
}
