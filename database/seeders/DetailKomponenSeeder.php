<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailKomponenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\DetailKomponen::create([
            'kode'	=> 'A',
            'deskripsi'	=> 'Biaya Konsumsi Rapat Pimpinan / POKJA',
            'id_sub_komponen' => 1,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'B',
            'deskripsi'	=> 'Pelayanan Perpustakaan',
            'id_sub_komponen' => 1,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'C',
            'deskripsi'	=> 'Monitoring Operasional Kampus Lapangan',
            'id_sub_komponen' => 1,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'A',
            'deskripsi'	=> 'Karya Tulis Ilmiah Bidang Administrasi Manajemen dan Kepemimpinan',
            'id_sub_komponen' => 2,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'A',
            'deskripsi'	=> 'Pengelolaan Jurnal Ilmiah PPSDM Aparatur',
            'id_sub_komponen' => 3,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'B',
            'deskripsi'	=> 'Penerbitan Majalah Umum',
            'id_sub_komponen' => 3,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'C',
            'deskripsi'	=> 'Kehumasan',
            'id_sub_komponen' => 3,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'A',
            'deskripsi'	=> 'Pengelolaan Pengembangan SDM Secara E-Learning dan Pembelajaran Asinkronus',
            'id_sub_komponen' => 4,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'B',
            'deskripsi'	=> 'Pengelolaan Pengembangan Secara Asinkronus',
            'id_sub_komponen' => 4,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'C',
            'deskripsi'	=> 'Pengelolaan dan Pengembangan Sistem Informasi Pelayanan Pengembangan SDM',
            'id_sub_komponen' => 4,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'A',
            'deskripsi'	=> 'Penyusunan Kebutuhan Diklat Bidang Aparatur',
            'id_sub_komponen' => 5,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'B',
            'deskripsi'	=> 'Rencana Pengembangan Kompetensi',
            'id_sub_komponen' => 5,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'C',
            'deskripsi'	=> 'Penilaian Kompetensi (Assessment)',
            'id_sub_komponen' => 5,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'D',
            'deskripsi'	=> 'Manajemen Mutu',
            'id_sub_komponen' => 5,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'E',
            'deskripsi'	=> 'Peta Kompetensi',
            'id_sub_komponen' => 5,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'F',
            'deskripsi'	=> 'Penyiapan Kelembagaan',
            'id_sub_komponen' => 5,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'G',
            'deskripsi'	=> 'Penyusunan SOP Pengembangan Kompetensi SDM',
            'id_sub_komponen' => 5,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'H',
            'deskripsi'	=> 'Akreditasi Program Pelatihan Bidang Kepemimpinan',
            'id_sub_komponen' => 5,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'A',
            'deskripsi'	=> 'Gaji dan Tunjangan',
            'id_sub_komponen' => 6,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'A',
            'deskripsi'	=> 'Langganan Daya dan Jasa',
            'id_sub_komponen' => 7,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'B',
            'deskripsi'	=> 'Honorarium Penanggungjawab Pengelola Keuangan',
            'id_sub_komponen' => 7,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'C',
            'deskripsi'	=> 'Poliklinik dan Obat-obatan',
            'id_sub_komponen' => 7,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'D',
            'deskripsi'	=> 'Honorarium Tenaga Satuan Pengamanan',
            'id_sub_komponen' => 7,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'E',
            'deskripsi'	=> 'Honorarium Tenaga Kesehatan',
            'id_sub_komponen' => 7,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'F',
            'deskripsi'	=> 'Honorarium Tenaga Perkantoran',
            'id_sub_komponen' => 7,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'G',
            'deskripsi'	=> 'Pengadaan Peralatan/Perlengkapan Kantor',
            'id_sub_komponen' => 7,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'H',
            'deskripsi'	=> 'Pemeliharaan Gedung Kantor',
            'id_sub_komponen' => 7,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'I',
            'deskripsi'	=> 'Pemeliharaan Kendaraaan Bermotor Roda 2/4/6',
            'id_sub_komponen' => 7,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'J',
            'deskripsi'	=> 'Pemeliharaan Sarana Gedung',
            'id_sub_komponen' => 7,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'K',
            'deskripsi'	=> 'Pemeliharaan Peralatan Kantor',
            'id_sub_komponen' => 7,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'L',
            'deskripsi'	=> 'Pemeliharaan Linen Kamar Wisma Bandung dan Linen Gedung Wisma Kampus Lapangan',
            'id_sub_komponen' => 7,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'M',
            'deskripsi'	=> 'Pengadaan Pakaian Kerja Sopir/Pesuruh/Perawat/Dokter/Satpam/Tenaga Teknis Lainnya',
            'id_sub_komponen' => 7,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'N',
            'deskripsi'	=> 'Dukungan Perjalana Dinas Pimpinan Dalam Rangka Konsultasi/Rapat Pimpinan dan Undangan Lainnya',
            'id_sub_komponen' => 7,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'P',
            'deskripsi'	=> 'Honorarium dan Operasional Pejabat Pengadaan/Penerima Hasil Pekerjaan Barang dan Jasa/Perangkat Unit Layanan Pengadaan/PPKJasa/Perangkat Unit Layanan Pengadaan',
            'id_sub_komponen' => 7,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'Q',
            'deskripsi'	=> 'Sewa Kendaraan Dinas Operasional Jabatan Eselon II',
            'id_sub_komponen' => 7,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'A',
            'deskripsi'	=> 'Pengadaan Hydrant Indoor Wisma Cisitu',
            'id_sub_komponen' => 8,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'B',
            'deskripsi'	=> 'Renovasi Fasilitas Diklat Wisma PPSDMA',
            'id_sub_komponen' => 8,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'A',
            'deskripsi'	=> 'Pembinaan Administrasi Pengelolaan Kepegawaian',
            'id_sub_komponen' => 9,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'B',
            'deskripsi'	=> 'Sistem Manajemen Anti-Penyuapan ISO 37001:2016',
            'id_sub_komponen' => 9,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'C',
            'deskripsi'	=> 'Langganan Lisensi Aplikasi Telekomunikasi',
            'id_sub_komponen' => 9,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'D',
            'deskripsi'	=> 'Pengelolaan Kearsipan',
            'id_sub_komponen' => 9,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'A',
            'deskripsi'	=> 'Penjalinan Kerjasama Pengembangan SDM Aparatur',
            'id_sub_komponen' => 10,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'A',
            'deskripsi'	=> 'Penyusunan Kurikulum Diklat Bidang Manajemen I',
            'id_sub_komponen' => 11,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'B',
            'deskripsi'	=> 'Penyusunan Pedoman Pelatihan Bidang Manajemen',
            'id_sub_komponen' => 11,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'C',
            'deskripsi'	=> 'Penyusunan Modul Pelatihan Bidang Manajemen',
            'id_sub_komponen' => 11,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'D',
            'deskripsi'	=> 'Penyusunan Materi Uji Pelatihan Bidang Manajemen',
            'id_sub_komponen' => 11,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'A',
            'deskripsi'	=> 'Simulasi Pembelajaran',
            'id_sub_komponen' => 12,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'A',
            'deskripsi'	=> 'Penyusunan RKAKL',
            'id_sub_komponen' => 13,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'A',
            'deskripsi'	=> 'Penyusunan Program Kegiatan dan Informasi Kinerja PPSDM Aparatur',
            'id_sub_komponen' => 14,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'B',
            'deskripsi'	=> 'Penyusunan Standar Biaya Masukan / Standar Biaya Keluaran PPSDM Aparatur',
            'id_sub_komponen' => 14,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'C',
            'deskripsi'	=> 'Review dan Penelaahan Program Anggaran PPSDM Aparatur',
            'id_sub_komponen' => 14,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'A',
            'deskripsi'	=> 'Evaluasi Pelatihan Aparatur',
            'id_sub_komponen' => 15,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'B',
            'deskripsi'	=> 'Survey Kepuasan Masyarakat pada Diklat Manajemen Aparatur',
            'id_sub_komponen' => 15,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'C',
            'deskripsi'	=> 'Monitoring Triwulanan Capaian Kinerja PPSDM Aparatur',
            'id_sub_komponen' => 15,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'D',
            'deskripsi'	=> 'Evaluasi Widyaiswara',
            'id_sub_komponen' => 15,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'E',
            'deskripsi'	=> 'Evaluasi Pasca Pelatihan PPSDM Aparatur',
            'id_sub_komponen' => 15,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'F',
            'deskripsi'	=> 'Evaluasi Penyertaan Aparatur KESDM',
            'id_sub_komponen' => 15,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'G',
            'deskripsi'	=> 'Evaluasi Magang KESDM',
            'id_sub_komponen' => 15,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'H',
            'deskripsi'	=> 'Evaluasi Tugas Belajar',
            'id_sub_komponen' => 15,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

        \App\Models\DetailKomponen::create([
            'kode'	=> 'I',
            'deskripsi'	=> 'Penyusunan LAKIP dan Laptah ',
            'id_sub_komponen' => 15,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
        
        \App\Models\DetailKomponen::create([
            'kode'	=> 'A',
            'deskripsi'	=> 'Pengelolaan Sistem Informasi Keuangan (SIK)',
            'id_sub_komponen' => 16,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
        
        \App\Models\DetailKomponen::create([
            'kode'	=> 'B',
            'deskripsi'	=> 'Peningkatan Pelayanan Pengelolaan Keuangan',
            'id_sub_komponen' => 16,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
        
        \App\Models\DetailKomponen::create([
            'kode'	=> 'C',
            'deskripsi'	=> 'Pengelolaan Sistem Informasi Manajemen Aset Negara (SIMAN)',
            'id_sub_komponen' => 16,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
        
        \App\Models\DetailKomponen::create([
            'kode'	=> 'D',
            'deskripsi'	=> 'Implementasi Sistem Aplikasi Keuangan Tingkat Instansi(SAKTI)',
            'id_sub_komponen' => 16,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
        
        \App\Models\DetailKomponen::create([
            'kode'	=> 'A',
            'deskripsi'	=> 'Penyertaan Pelatihan Fungsional, Kepemimpinan, Manajerial, dan Sertifikasi Kompetensi ASN KESDM',
            'id_sub_komponen' => 17,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
        
        \App\Models\DetailKomponen::create([
            'kode'	=> 'B',
            'deskripsi'	=> 'Program Magang ASN KESDM di Industri',
            'id_sub_komponen' => 17,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
        
        \App\Models\DetailKomponen::create([
            'kode'	=> 'C',
            'deskripsi'	=> 'Dukungan Tugas Belajar',
            'id_sub_komponen' => 17,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
        
        \App\Models\DetailKomponen::create([
            'kode'	=> 'D',
            'deskripsi'	=> 'PELATIHAN OFFLINE',
            'id_sub_komponen' => 17,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
        
        \App\Models\DetailKomponen::create([
            'kode'	=> 'E',
            'deskripsi'	=> 'PELATIHAN ONLINE',
            'id_sub_komponen' => 17,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
        
        \App\Models\DetailKomponen::create([
            'kode'	=> 'F',
            'deskripsi'	=> 'Pelatihan Teknis Pelaksana I',
            'id_sub_komponen' => 17,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
        
        \App\Models\DetailKomponen::create([
            'kode'	=> 'G',
            'deskripsi'	=> 'Penyiapan Kegiatan Akademik Pengembangan Kompetensi SDM ASN',
            'id_sub_komponen' => 17,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
        
        \App\Models\DetailKomponen::create([
            'kode'	=> 'H',
            'deskripsi'	=> 'Seminar',
            'id_sub_komponen' => 17,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
        
        \App\Models\DetailKomponen::create([
            'kode'	=> 'I',
            'deskripsi'	=> 'Bimtek/ Workshop/ Pengembangan Kepemimpinan, Manajerial, dan Teknis',
            'id_sub_komponen' => 17,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);
        
        \App\Models\DetailKomponen::create([
            'kode'	=> 'J',
            'deskripsi'	=> 'Pelatihan Dasar CPNS Golongan II',
            'id_sub_komponen' => 17,
            'created_at' => new \DateTime,
            'updated_at' => null,
        ]);

    }
}
