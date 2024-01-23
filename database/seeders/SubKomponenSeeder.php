<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubKomponenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Id = 1
        \App\Models\SubKomponen::create([
            'kode'	=> '601',
            'deskripsi'	=> 'Melaksanakan Pelayanan Ketatausahaan dan Umum PPSDM Aparatur',
            'pagu_awal' => null,
            'id_rincian_output' => 1,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        // 2
        \App\Models\SubKomponen::create([
            'kode'	=> '602',
            'deskripsi'	=> 'Melaksanakan Penyusunan Karya Ilmiah PPSDM Aparatur',
            'pagu_awal' => null,
            'id_rincian_output' => 1,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        // 3
        \App\Models\SubKomponen::create([
            'kode'	=> '601',
            'deskripsi'	=> 'Melaksanakan Promosi dan Publikasi PPSDM Aparatur',
            'pagu_awal' => null,
            'id_rincian_output' => 2,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        // 4
        \App\Models\SubKomponen::create([
            'kode'	=> '602',
            'deskripsi'	=> 'Melaksanakan Pengelolaan dan Pengembangan Database PPSDM Aparatur',
            'pagu_awal' => null,
            'id_rincian_output' => 2,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        // 5
        \App\Models\SubKomponen::create([
            'kode'	=> '603',
            'deskripsi'	=> 'Melaksanakan Perencanaan Pelatihan PPSDM Aparatur',
            'pagu_awal' => null,
            'id_rincian_output' => 2,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        // EBA.994
        // 6
        \App\Models\SubKomponen::create([
            'kode'	=> '001',
            'deskripsi'	=> 'Gaji dan Tunjangan',
            'pagu_awal' => null,
            'id_rincian_output' => 3,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        // 7
        \App\Models\SubKomponen::create([
            'kode'	=> '002',
            'deskripsi'	=> 'Operasional dan Pemeliharaan Kantor',
            'pagu_awal' => null,
            'id_rincian_output' => 3,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);


        // EBB 971
        // 8
        \App\Models\SubKomponen::create([
            'kode'	=> '601',
            'deskripsi'	=> 'Renovasi Gedung dan Bangunan PPSDM Aparatur',
            'pagu_awal' => null,
            'id_rincian_output' => 4,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        // EBC 954
        // 9
        \App\Models\SubKomponen::create([
            'kode'	=> '601',
            'deskripsi'	=> 'Melaksanakan Pengelolaan Kepegawaian dan Organisasi PPSDM Aparatur',
            'pagu_awal' => null,
            'id_rincian_output' => 5,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        // 10
        \App\Models\SubKomponen::create([
            'kode'	=> '602',
            'deskripsi'	=> 'Melaksanakan Kerja Sama dan Implementasi PPSDM Aparatur',
            'pagu_awal' => null,
            'id_rincian_output' => 5,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        // 11
        \App\Models\SubKomponen::create([
            'kode'	=> '603',
            'deskripsi'	=> 'Menyusun, Menyempurnakan dan atau Membakukan NSPK PPSDM Aparatur',
            'pagu_awal' => null,
            'id_rincian_output' => 5,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        // EBC.996
        // 12
        \App\Models\SubKomponen::create([
            'kode'	=> '601',
            'deskripsi'	=> 'Melaksanakan Assessment Widyaiswara',
            'pagu_awal' => null,
            'id_rincian_output' => 6,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        // EBD.952
        // 13
        \App\Models\SubKomponen::create([
            'kode'	=> '601',
            'deskripsi'	=> 'Melaksanakan Penyusunan Dokumen Perencanaan dan Anggaran PPSDM Aparatur',
            'pagu_awal' => null,
            'id_rincian_output' => 7,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
        // 14
        \App\Models\SubKomponen::create([
            'kode'	=> '602',
            'deskripsi'	=> 'Melaksanakan Penyusunan Program Kerja PPSDM Aparatur',
            'pagu_awal' => null,
            'id_rincian_output' => 7,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        // 15
        \App\Models\SubKomponen::create([
            'kode'	=> '601',
            'deskripsi'	=> 'Melaksanakan Pemantauan dan Evaluasi Pelaksanaan Anggaran dan Kegiatan PPSDM Aparatur',
            'pagu_awal' => null,
            'id_rincian_output' => 8,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\SubKomponen::create([
            'kode'	=> '601',
            'deskripsi'	=> 'Melaksanakan Pengelolaan Keuangan dan Perbendaharaan PPSDM Aparatur',
            'pagu_awal' => null,
            'id_rincian_output' => 9,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);


        \App\Models\SubKomponen::create([
            'kode'	=> '601',
            'deskripsi'	=> 'Melaksanakan Pengembangan SDM',
            'pagu_awal' => null,
            'id_rincian_output' => 10,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
    }
}
