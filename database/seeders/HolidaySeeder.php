<?php

namespace Database\Seeders;

use App\Models\Holiday;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $holidays = [
            // Januari
            ['date' => '2025-01-01', 'description' => 'Tahun Baru 2025 Masehi'],
            ['date' => '2025-01-27', 'description' => 'Isra Miraj Nabi Muhammad SAW'],
            ['date' => '2025-01-28', 'description' => 'Cuti Bersama Tahun Baru Imlek 2576 Kongzili'],
            ['date' => '2025-01-29', 'description' => 'Tahun Baru Imlek 2576 Kongzili'],

            //Maret
            ['date' => '2025-03-28', 'description' => 'Cuti Bersama Hari Suci Nyepi (Tahun Baru Saka 1947)'],
            ['date' => '2025-03-29', 'description' => 'Hari Suci Nyepi (Tahun Baru Saka 1947)'],
            ['date' => '2025-03-31', 'description' => 'Hari Raya Idul Fitri, 1 Syawal 1456 Hijriah'],


            // April
            ['date' => '2025-04-01', 'description' => 'Hari Raya Idul Fitri, 2 Syawal 1456 Hijriah'],
            ['date' => '2025-04-02', 'description' => 'Cuti Bersama Hari Raya Idul Fitri 1456 Hijriyah'],
            ['date' => '2025-04-03', 'description' => 'Cuti Bersama Hari Raya Idul Fitri 1456 Hijriyah'],
            ['date' => '2025-04-04', 'description' => 'Cuti Bersama Hari Raya Idul Fitri 1456 Hijriyah'],
            ['date' => '2025-04-07', 'description' => 'Cuti Bersama Hari Raya Idul Fitri 1456 Hijriyah'],
            ['date' => '2025-04-18', 'description' => 'Wafat Yesus Kristus'],
            ['date' => '2025-04-20', 'description' => 'Kebangkitan Yesus Kristus (Paskah)'],

            // Mei
            ['date' => '2025-05-01', 'description' => 'Hari Buruh'],
            ['date' => '2025-05-12', 'description' => 'Hari Raya Waisak 2569 BE'],
            ['date' => '2025-05-13', 'description' => 'Cuti Bersama Waisak 2569 BE'],
            ['date' => '2025-05-29', 'description' => 'Kenaikan Yesus Kristus'],
            ['date' => '2025-05-30', 'description' => 'Cuti Bersama Kenaikan Yesus Kristus'],

            // Juni
            ['date' => '2025-06-01', 'description' => 'Hari Lahir Pancasila'],
            ['date' => '2025-06-06', 'description' => 'Hari Raya Idul Adha 1446 Hijriah'],
            ['date' => '2025-06-09', 'description' => 'Cuti Bersama Hari Raya Idul Fitri 1446 Hijriah'],
            ['date' => '2025-06-27', 'description' => '1 Muharam Tahun Baru Islam 1447 Hijriah'],

            //Agustus
            ['date' => '2025-08-17', 'description' => 'Proklamasi Kemerdekaan'],

            // September
            ['date' => '2025-09-05', 'description' => 'Maulid Nabi Muhammad SAW'],

            // Desember
            ['date' => '2025-12-25', 'description' => 'Kelahiran Yesus Kristus'],
            ['date' => '2025-12-26', 'description' => 'Cuti Bersama Kelahiran Yesus Kristus'],

            // Tambahkan sesuai kalender
        ];

        foreach ($holidays as $holiday) {
            Holiday::firstOrCreate(['date' => $holiday['date']], ['description' => $holiday['description']]);
        }
    }
}
