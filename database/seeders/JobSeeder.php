<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobs = [
            // Primary CS jobs
            ['code' => 'R1', 'name' => 'ROOM SERVICE LT. 1', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
            ['code' => 'R2', 'name' => 'ROOM SERVICE LT. 2', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
            ['code' => 'R3', 'name' => 'ROOM SERVICE LT. 3', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
            ['code' => 'R4', 'name' => 'ROOM SERVICE LT. 4', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
            ['code' => 'K1', 'name' => 'KANTOR LT. 1', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
            ['code' => 'K2', 'name' => 'KANTOR LT. 2', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
            ['code' => 'K3', 'name' => 'KANTOR LT. 3', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
            ['code' => 'K4', 'name' => 'KANTOR LT. 4', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
            ['code' => 'FOP', 'name' => 'FRONT OFFICE - PAGI', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:30', 'end' => '19:30'],

            // Special jobs
            ['code' => 'GDB', 'name' => 'BASEMENT + GARDEN WISMA', 'category' => 'marbot', 'type' => 'special', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
            ['code' => 'GD', 'name' => 'GARDEN', 'category' => 'garden', 'type' => 'special', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
            ['code' => 'RRP', 'name' => 'RESTROOM PUBLIC WANITA', 'category' => 'women', 'type' => 'special', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
            ['code' => 'BQ', 'name' => 'BANQUET', 'category' => 'koor', 'type' => 'special', 'shift' => 'pagi', 'start' => '07:01', 'end' => '17:01'],
            // ['code' => 'FOP', 'name' => 'FRONT OFFICE - PAGI', 'category' => 'koor', 'type' => 'special', 'shift' => 'pagi', 'start' => '07:30', 'end' => '19:30'],


            // Secondary jobs
            ['code' => 'LDP', 'name' => 'LONDRY - PAGI', 'category' => 'cs', 'type' => 'secondary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
            ['code' => 'FOM', 'name' => 'FRONT OFFICE - MALAM', 'category' => 'cs', 'type' => 'secondary', 'shift' => 'malam', 'start' => '19:30', 'end' => '07:30'],
            ['code' => 'OBM', 'name' => 'OFFICE BOY - MALAM', 'category' => 'cs', 'type' => 'secondary', 'shift' => 'malam', 'start' => '19:30', 'end' => '07:30'],
            ['code' => 'LDS', 'name' => 'LONDRY - SIANG', 'category' => 'cs', 'type' => 'secondary', 'shift' => 'malam', 'start' => '10:00', 'end' => '19:00'],

        ];

        foreach ($jobs as $job) {
            Job::create($job);
        }
    }
}
