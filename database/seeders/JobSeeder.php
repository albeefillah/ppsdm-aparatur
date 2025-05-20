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
            ['code' => 'R1', 'name' => 'Room Service Lt. 1 (Kamar dan kelas)', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
            ['code' => 'R2', 'name' => 'Room Service Lt. 2 (Kamar dan kelas)', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
            ['code' => 'R3', 'name' => 'Room Service Lt. 3 (Kamar dan kelas)', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
            ['code' => 'R4', 'name' => 'Room Service Lt. 4 (Kamar dan kelas)', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
            ['code' => 'K1', 'name' => 'Kantor Lt. 1', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
            ['code' => 'K2', 'name' => 'Kantor Lt. 2', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
            ['code' => 'K3', 'name' => 'Kantor Lt. 3', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
            ['code' => 'K4', 'name' => 'Kantor Lt. 4', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
            ['code' => 'LD', 'name' => 'Laundry', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
            ['code' => 'GD', 'name' => 'Garden', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
            ['code' => 'MBS', 'name' => 'Marbot dan Basement', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],
            ['code' => 'FOp', 'name' => 'Front Office (Pagi)', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],


            // Shift Siang
            // ['code' => 'K1s', 'name' => 'Kantor Lt. 1', 'category' => 'cs', 'type' => 'primary', 'shift' => 'siang', 'start' => '11:00', 'end' => '17:00'],
            // ['code' => 'K2s', 'name' => 'Kantor Lt. 2', 'category' => 'cs', 'type' => 'primary', 'shift' => 'siang', 'start' => '11:00', 'end' => '17:00'],
            // ['code' => 'K3s', 'name' => 'Kantor Lt. 3 dan Lt. 4', 'category' => 'cs', 'type' => 'primary', 'shift' => 'siang', 'start' => '11:00', 'end' => '17:00'],
            // ['code' => 'OBs', 'name' => 'Office Boy (Lt 1-4 Wisma)', 'category' => 'cs', 'type' => 'primary', 'shift' => 'siang', 'start' => '11:00', 'end' => '19:00'],

            // Shift Sore
            ['code' => 'FOsr', 'name' => 'Front Office (Sore)', 'category' => 'cs', 'type' => 'secondary', 'shift' => 'sore', 'start' => '18:00', 'end' => '02:00'],
            // ['code' => 'OBsr', 'name' => 'Office Boy (Lt 1-4 Wisma)', 'category' => 'cs', 'type' => 'secondary', 'shift' => 'sore', 'start' => '18:00', 'end' => '02:00'],

            // Shift Malam
            // ['code' => 'FOsr', 'name' => 'Front Office (Sore)', 'category' => 'cs', 'type' => 'primary', 'shift' => 'sore', 'start' => '15:00', 'end' => '01:00'],
            ['code' => 'FOm', 'name' => 'Front Office (Malam)', 'category' => 'cs', 'type' => 'primary', 'shift' => 'malam', 'start' => '23:00', 'end' => '09:00'],
            ['code' => 'OBm', 'name' => 'Office Boy Malam (Lt 1-4 Wisma)', 'category' => 'cs', 'type' => 'primary', 'shift' => 'malam', 'start' => '19:00', 'end' => '07:00'],

            ['code' => 'BQ', 'name' => 'Banquet', 'category' => 'cs', 'type' => 'primary', 'shift' => 'pagi', 'start' => '07:00', 'end' => '17:00'],


        ];


        foreach ($jobs as $job) {
            Job::create($job);
        }
    }
}
