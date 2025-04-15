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
            ['date' => '2025-01-01', 'description' => 'Tahun Baru'],
            ['date' => '2025-04-17', 'description' => 'Hari Raya'],
            ['date' => '2025-05-01', 'description' => 'Hari Buruh'],
            ['date' => '2025-05-12', 'description' => 'Hari Raya Waisak 2569 BE'],
            ['date' => '2025-05-13', 'description' => 'Cuti Bersama Waisak 2569 BE'],
            ['date' => '2025-05-29', 'description' => 'Kenaikan Yesus Kristus'],
            ['date' => '2025-05-30', 'description' => 'Cuti Bersama Kenaikan Yesus Kristus'],
            // Tambahkan sesuai kalender
        ];

        foreach ($holidays as $holiday) {
            Holiday::firstOrCreate(['date' => $holiday['date']], ['description' => $holiday['description']]);
        }
    }
}
