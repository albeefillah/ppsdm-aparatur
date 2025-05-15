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


        foreach ($jobs as $job) {
            Job::create($job);
        }
    }
}
