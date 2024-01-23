<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KomponenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Komponen::create([
            'kode'	        => '020.12.WA',
            'nama_komponen'	=> 'Program Dukungan Manajemen',
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
        \App\Models\Komponen::create([
            'kode'	        => '1915',
            'nama_komponen'	=> 'Pengelolaan Manajemen Kesekretariatan Bidang Pengembangan Sumber Daya Manusia ESDM',
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        // EBA
        \App\Models\Komponen::create([
            'kode'	        => '1915.EBA',
            'nama_komponen'	=> 'Layanan Dukungan Manejemen Internal',
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\Komponen::create([
            'kode'	        => '1915.EBA.962',
            'nama_komponen'	=> 'Layanan Umum',
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\Komponen::create([
            'kode'	        => '1915.EBA.963',
            'nama_komponen'	=> 'Layanan Data dan Informasi',
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\Komponen::create([
            'kode'	        => '1915.EBA.994',
            'nama_komponen'	=> 'Layanan Perkantoran',
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);


        // EBB
        \App\Models\Komponen::create([
            'kode'	        => '1915.EBB',
            'nama_komponen'	=> 'Layanan Sarana dan Prasarana Internal',
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\Komponen::create([
            'kode'	        => '1915.EBB.971',
            'nama_komponen'	=> 'Layanan Prasarana Internal',
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);


        // EBC
        \App\Models\Komponen::create([
            'kode'	        => '1915.EBC',
            'nama_komponen'	=> 'Layanan Manajemen SDM Internal',
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
        // id = 10
        \App\Models\Komponen::create([
            'kode'	        => '1915.EBC.954',
            'nama_komponen'	=> 'Layanan Manajemen SDM',
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\Komponen::create([
            'kode'	        => '1915.EBC.996',
            'nama_komponen'	=> 'Layanan Pendidikan dan Pelatihan',
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        // EBD
        \App\Models\Komponen::create([
            'kode'	        => '1915.EBD',
            'nama_komponen'	=> 'Layanan Manajemen Kinerja Internal',
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        // 13
        \App\Models\Komponen::create([
            'kode'	        => '1915.EBD.952',
            'nama_komponen'	=> 'Layanan Perencanaan Pengangguran',
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\Komponen::create([
            'kode'	        => '1915.EBD.953',
            'nama_komponen'	=> 'Layanan Pemantauan dan Evaluasi',
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\Komponen::create([
            'kode'	        => '1915.EBD.955',
            'nama_komponen'	=> 'Layanan Manajemen Keuangan',
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\Komponen::create([
            'kode'	        => '6398',
            'nama_komponen'	=> 'Pendidikan dan Pelatihan Aparatur Sipil Negara',
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\Komponen::create([
            'kode'	        => '6398.EBC',
            'nama_komponen'	=> 'Layanan Manajemen SDM Internal',
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\Komponen::create([
            'kode'	        => '6398.EBC.996',
            'nama_komponen'	=> 'Layanan Pendidikan dan Pelatihan',
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);


    }
}
