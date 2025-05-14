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
            ['code' => 'R1', 'name' => 'Room Service Lt. 1 (Kamar dan kelas)', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '15:00'],
            ['code' => 'R2', 'name' => 'Room Service Lt. 2 (Kamar dan kelas)', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '15:00'],
            // ['code' => 'R3p', 'name' => 'Room Service Lt. 3 (Kamar dan kelas)', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '15:00'],
            ['code' => 'R3-4', 'name' => 'Room Service Lt.3 dan Lt.4 (Kamar dan kelas)', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '15:00'],
            ['code' => 'K1p', 'name' => 'Kantor Lt. 1', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '15:00'],
            ['code' => 'K2p', 'name' => 'Kantor Lt. 2', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '15:00'],
            ['code' => 'K3-4p', 'name' => 'Kantor Lt. 3 dan Lt. 4', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '15:00'],
            ['code' => 'LD', 'name' => 'Laundry', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '15:00'],
            ['code' => 'GD', 'name' => 'Garden', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '15:00'],
            ['code' => 'MBS', 'name' => 'Marbot dan Basement', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '15:00'],
            ['code' => 'FOp', 'name' => 'Front Office', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '08:00', 'end' => '16:00'],


            // Shift Siang
            ['code' => 'K1s', 'name' => 'Kantor Lt. 1', 'category' => 'cs', 'type' => 'primary', 'shift' => 'siang', 'start' => '11:00', 'end' => '15:00'],
            ['code' => 'K2s', 'name' => 'Kantor Lt. 2', 'category' => 'cs', 'type' => 'primary', 'shift' => 'siang', 'start' => '11:00', 'end' => '15:00'],
            ['code' => 'K3-4s', 'name' => 'Kantor Lt. 3 dan Lt. 4', 'category' => 'cs', 'type' => 'primary', 'shift' => 'siang', 'start' => '11:00', 'end' => '15:00'],
            ['code' => 'OBs', 'name' => 'Office Boy (Lt 1-4 Wisma)', 'category' => 'cs', 'type' => 'primary', 'shift' => 'siang', 'start' => '11:00', 'end' => '19:00'],

            // Shift Sore
            ['code' => 'FOsr', 'name' => 'Front Office', 'category' => 'cs', 'type' => 'secondary', 'shift' => 'sore', 'start' => '18:00', 'end' => '02:00'],
            ['code' => 'OBsr', 'name' => 'Office Boy (Lt 1-4 Wisma)', 'category' => 'cs', 'type' => 'secondary', 'shift' => 'sore', 'start' => '18:00', 'end' => '02:00'],

            // Shift Malam
            ['code' => 'FOm', 'name' => 'Front Office', 'category' => 'cs', 'type' => 'secondary', 'shift' => 'malam', 'start' => '00:00', 'end' => '08:00'],
            ['code' => 'OBm', 'name' => 'Office Boy (Lt 1-4 Wisma)', 'category' => 'cs', 'type' => 'secondary', 'shift' => 'malam', 'start' => '00:00', 'end' => '08:00'],

            ['code' => 'BQ', 'name' => 'Banquet', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '15:00'],


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
