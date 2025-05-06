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
            // Shift Pagi
            ['code' => 'R1p', 'name' => 'ROOM SERVICE LT. 1 Pagi (Kamar dan kelas)', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '15:00'],
            ['code' => 'R2p', 'name' => 'ROOM SERVICE LT. 2 Pagi (Kamar dan kelas)', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '15:00'],
            // ['code' => 'R3p', 'name' => 'ROOM SERVICE LT. 3 Pagi (Kamar dan kelas)', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '15:00'],
            ['code' => 'R4p', 'name' => 'ROOM SERVICE LT. 4 Pagi (Kamar dan kelas)', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '15:00'],
            ['code' => 'K1p', 'name' => 'KANTOR LT. 1', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '15:00'],
            ['code' => 'K2p', 'name' => 'KANTOR LT. 2', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '15:00'],
            ['code' => 'K4p', 'name' => 'KANTOR LT. 4 dan LT. 3 Kantor', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '15:00'],
            ['code' => 'LD', 'name' => 'LAUNDRY', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '15:00'],
            ['code' => 'GD', 'name' => 'GARDEN', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '15:00'],
            ['code' => 'MBS', 'name' => 'MARBOT DAN BASEMENT', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '15:00'],
            ['code' => 'FOp', 'name' => 'FRONT OFFICE PAGI', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '08:00', 'end' => '16:00'],


            // Shift Siang
            ['code' => 'K1s', 'name' => 'KANTOR LT. 1', 'category' => 'cs', 'type' => 'primary', 'shift' => 'siang', 'start' => '11:00', 'end' => '15:00'],
            ['code' => 'K2s', 'name' => 'KANTOR LT. 2', 'category' => 'cs', 'type' => 'primary', 'shift' => 'siang', 'start' => '11:00', 'end' => '15:00'],
            ['code' => 'K4s', 'name' => 'KANTOR LT. 4 dan LT. 3 Kantor', 'category' => 'cs', 'type' => 'primary', 'shift' => 'siang', 'start' => '11:00', 'end' => '15:00'],
            ['code' => 'OBs', 'name' => 'OFFICE BOY - Siang (Lt 1-4 Wisma)', 'category' => 'cs', 'type' => 'primary', 'shift' => 'siang', 'start' => '11:00', 'end' => '19:00'],

            // Shift Sore
            ['code' => 'FOsr', 'name' => 'FRONT OFFICE - Sore', 'category' => 'cs', 'type' => 'secondary', 'shift' => 'sore', 'start' => '18:00', 'end' => '02:00'],
            ['code' => 'OBsr', 'name' => 'OFFICE BOY - Sore (Lt 1-4 Wisma)', 'category' => 'cs', 'type' => 'secondary', 'shift' => 'sore', 'start' => '18:00', 'end' => '02:00'],

            // Shift Malam
            ['code' => 'FOm', 'name' => 'FRONT OFFICE - Malam', 'category' => 'cs', 'type' => 'secondary', 'shift' => 'malam', 'start' => '00:00', 'end' => '08:00'],
            ['code' => 'OBm', 'name' => 'OFFICE BOY - Malam', 'category' => 'cs', 'type' => 'secondary', 'shift' => 'malam', 'start' => '00:00', 'end' => '08:00'],

            ['code' => 'BQ', 'name' => 'BANQUET', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '15:00'],


        ];


        // $jobs = [
        //     // Primary CS jobs
        //     ['code' => 'R1', 'name' => 'ROOM SERVICE LT. 1', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
        //     ['code' => 'R2+', 'name' => 'ROOM SERVICE LT. 2 + BACKUP K2', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
        //     ['code' => 'R3+', 'name' => 'ROOM SERVICE LT. 3 + BACKUP K1', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
        //     ['code' => 'R4', 'name' => 'ROOM SERVICE LT. 4', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
        //     ['code' => 'K1', 'name' => 'KANTOR LT. 1', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
        //     ['code' => 'K2', 'name' => 'KANTOR LT. 2', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
        //     ['code' => 'K3', 'name' => 'KANTOR LT. 3', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
        //     ['code' => 'K4+', 'name' => 'KANTOR LT. 4 + BACKUP K3', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
        //     ['code' => 'FOP', 'name' => 'FRONT OFFICE - PAGI', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:30', 'end' => '19:30'],
        //     ['code' => 'LD', 'name' => 'LAUNDRY', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '10:00', 'end' => '19:00'],

        //     // Special jobs
        //     ['code' => 'BS', 'name' => 'BASEMENT', 'category' => 'marbot', 'type' => 'special', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
        //     ['code' => 'GD', 'name' => 'GARDEN', 'category' => 'garden', 'type' => 'special', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
        //     // ['code' => 'RRP', 'name' => 'RESTROOM PUBLIC WANITA', 'category' => 'women', 'type' => 'special', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
        //     ['code' => 'BQ', 'name' => 'BANQUET', 'category' => 'koor', 'type' => 'special', 'shift' => 'pagi', 'start' => '07:01', 'end' => '17:01'],
        //     // ['code' => 'FOP', 'name' => 'FRONT OFFICE - PAGI', 'category' => 'koor', 'type' => 'special', 'shift' => 'pagi', 'start' => '07:30', 'end' => '19:30'],


        //     // Secondary jobs
        //     // ['code' => 'LDP', 'name' => 'LONDRY - PAGI', 'category' => 'cs', 'type' => 'secondary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
        //     ['code' => 'FOM', 'name' => 'FRONT OFFICE - MALAM', 'category' => 'cs', 'type' => 'secondary', 'shift' => 'malam', 'start' => '19:30', 'end' => '07:30'],
        //     ['code' => 'OBM', 'name' => 'OFFICE BOY - MALAM', 'category' => 'cs', 'type' => 'secondary', 'shift' => 'malam', 'start' => '19:30', 'end' => '07:30'],
        //     // ['code' => 'LDS', 'name' => 'LONDRY - SIANG', 'category' => 'cs', 'type' => 'secondary', 'shift' => 'malam', 'start' => '10:00', 'end' => '19:00'],

        // ];




        // $jobs = [
        //     // Primary CS jobs
        //     ['code' => 'j1', 'name' => 'ROOM SERVICE LT. 1', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
        //     ['code' => 'j2', 'name' => 'ROOM SERVICE LT. 2 + BACKUP K2', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
        //     ['code' => 'j3', 'name' => 'ROOM SERVICE LT. 3 + BACKUP K1', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
        //     ['code' => 'j4', 'name' => 'ROOM SERVICE LT. 4', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
        //     ['code' => 'j5', 'name' => 'KANTOR LT. 1', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
        //     ['code' => 'j6', 'name' => 'KANTOR LT. 2', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
        //     ['code' => 'j7', 'name' => 'KANTOR LT. 3', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
        //     ['code' => 'j8', 'name' => 'KANTOR LT. 4 + BACKUP K3', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
        //     ['code' => 'j9', 'name' => 'FRONT OFFICE - PAGI', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:30', 'end' => '19:30'],
        //     ['code' => 'j10', 'name' => 'LAUNDRY', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '10:00', 'end' => '19:00'],
        //     ['code' => 'j11', 'name' => 'LAUNDRY', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '10:00', 'end' => '19:00'],
        //     ['code' => 'j12', 'name' => 'LAUNDRY', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '10:00', 'end' => '19:00'],
        //     ['code' => 'j13', 'name' => 'LAUNDRY', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '10:00', 'end' => '19:00'],
        //     ['code' => 'j14', 'name' => 'LAUNDRY', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '10:00', 'end' => '19:00'],
        //     ['code' => 'j15', 'name' => 'LAUNDRY', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '10:00', 'end' => '19:00'],
        //     ['code' => 'j16', 'name' => 'LAUNDRY', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '10:00', 'end' => '19:00'],
        //     ['code' => 'j17', 'name' => 'LAUNDRY', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '10:00', 'end' => '19:00'],

        //     // // Special jobs
        //     // ['code' => 'BS', 'name' => 'BASEMENT', 'category' => 'marbot', 'type' => 'special', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
        //     // ['code' => 'GD', 'name' => 'GARDEN', 'category' => 'garden', 'type' => 'special', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
        //     // // ['code' => 'RRP', 'name' => 'RESTROOM PUBLIC WANITA', 'category' => 'women', 'type' => 'special', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
        //     ['code' => 'BQ', 'name' => 'BANQUET', 'category' => 'koor', 'type' => 'special', 'shift' => 'pagi', 'start' => '07:01', 'end' => '17:01'],
        //     // // ['code' => 'FOP', 'name' => 'FRONT OFFICE - PAGI', 'category' => 'koor', 'type' => 'special', 'shift' => 'pagi', 'start' => '07:30', 'end' => '19:30'],


        //     // Secondary jobs
        //     ['code' => 'LDP', 'name' => 'LONDRY - PAGI', 'category' => 'cs', 'type' => 'secondary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
        //     ['code' => 'FOM', 'name' => 'FRONT OFFICE - MALAM', 'category' => 'cs', 'type' => 'secondary', 'shift' => 'malam', 'start' => '19:30', 'end' => '07:30'],
        //     ['code' => 'OBM', 'name' => 'OFFICE BOY - MALAM', 'category' => 'cs', 'type' => 'secondary', 'shift' => 'malam', 'start' => '19:30', 'end' => '07:30'],
        //     ['code' => 'LDS', 'name' => 'LONDRY - SIANG', 'category' => 'cs', 'type' => 'secondary', 'shift' => 'malam', 'start' => '10:00', 'end' => '19:00'],

        // ];

        foreach ($jobs as $job) {
            Job::create($job);
        }
    }
}
