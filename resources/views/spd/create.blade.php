@section('title') 
PPSDM Aparatur - Tambah Surat Tugas
@endsection 
@extends('layouts.main')
@section('style')
<!-- Select2 CSS -->
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Tagsinput CSS -->
<link href="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.css') }}" rel="stylesheet" type="text/css" />

@endsection 
@section('content')
<!-- Start XP Breadcrumbbar -->                    
<div class="xp-breadcrumbbar">
    <div class="row">
        <div class="col-md-6 col-lg-6">
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="xp-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('spd.index') }}">SPD</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Surat Tugas</li>
                </ol>
            </div>
        </div>
    </div>          
</div>
<!-- End XP Breadcrumbbar -->
<!-- Start XP Contentbar -->    
<div class="xp-contentbar">
    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-header bg-white">
                <h5 class="card-title text-black">Tambah Surat Tugas</h5>
                <h6 class="card-subtitle"> - Unit Bagian Umum -</h6>
            </div>
            <div class="card-body">
                <form id="xp-basic-form-wizard" method="get" action="{{ route('spd.index') }}" onsubmit="return Validation()" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <h3>Isian Umum</h3>
                        <section>
                            <div class="form-group">
                                <label for="nama_surat">Nama Surat Tugas</label>
                                <input type="text" class="form-control" name="nama_surat" placeholder="cth: Diklat 1" id="nama_surat">
                            </div>
        
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                  <label for="inputEmail4">Mata Anggaran *</label>
                                  <select class="form-control" name="mata_anggaran">
                                    <option>Pilih Mata Anggaran</option>
                                    <option value="4865"  data-id="9VgaqV7gaG">1915.EBA.962.601.C.524111 - Monitoring Operasional Kampus Lapangan</option>
                                    <option value="6080"  data-id="pjL8DoVL2Q">1915.EBA.962.602.A.524111 - Karya Tulis Ilmiah Bidang Administrasi, Manajemen dan Kepemimpinan</option>
                                    <option value="7638"  data-id="nGLRKeaEjX">1915.EBA.963.601.A - Pengelolaan Jurnal Ilmiah PPSDM Aparatur</option>
                                    <option value="7639"  data-id="OBx4wZJg2j">1915.EBA.963.601.B - Penerbitan Majalah Umum</option>
                                    <option value="5093"  data-id="Kyx66V2x9v">1915.EBA.994.002.N.524111 - Dukungan Perjalanan Dinas Pimpinan Dalam Rangka Konsultasi/Rapat Pimpinan dan Undangan Lainnya</option>
                                    <option value="7389"  data-id="zGLO8j6EDY">1915.EBA.994.002.P.524111 - Honorarium dan Operasional Pejabat Pengadaan/Penerima Hasil Pekerjaan Barang dan Jasa/Perangkat Unit Layanan Pengadaan/PPKJasa/Perangkat Unit Layanan Pengadaan</option>
                                    <option value="7969"  data-id="0rxbwqqLjW">1915.EBB.971.601.A.533121 - Biaya Pengelolaan Kegiatan Pengadaan Hydrant Indoor Wisma Cisitu</option>
                                    <option value="4892"  data-id="17EAo9Zx4W">1915.EBC.954.601.A.524111 - Pembinan Administrasi Pengelolaan Kepegawaian</option>
                                    <option value="4894"  data-id="l4EwbJBLpA">1915.EBC.954.601.B.524111 - Sistem Manajemen Anti-Penyuapan ISO 37001:2016</option>
                                    <option value="6084"  data-id="1vgrAWbEk7">1915.EBC.996.601.A.524111 - Assessment Widyaiswara</option>
                                  </select>
                                </div>
        
                                <div class="form-group col-md-6">
                                  <label for="inputPassword4">Sisa Pagu </label>
                                 <p>Rp. 9.5600.000</p>
                                  
                                </div>
                              </div>
        
                              <div class="form-group">
                                <label for="inputPassword4">Jenis *</label>
                                <select class="form-control" name="jenis">
                                  <option>Pilih Jenis</option>
                                  <option value="Diklat">Diklat</option>
                                  <option value="Luar Kota">Luar Kota</option>
                                  <option value="Dalam Kota">Dalam Kota</option>
                                </select>
                              </div>

                              <div class="form-group">
                                <label for="maksud">Maksud *</label>
                                <textarea name="maksud" id="maksud" rows="5" class="form-control" placeholder="Tulis Maksud Kegiatan"></textarea>
                              </div>
                        </section>
                        <h3>Rencana Anggaran</h3>
                        <section>
                            <div class="form-group">
                                <label for="jml_peserta">Peserta</label>
                                <input type="number" min="0" class="form-control" placeholder="Isi Jumlah Peserta" name="jml_peserta" id="jml_peserta">
                            </div>
                            <div class="form-group">
                                <b>-Non Peserta-</b>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="anggaran_peserta">Pengajar</label>
                                    <input type="number" min="0" class="form-control" placeholder="Isi Jumlah Pengajar" name="anggaran_peserta" id="anggaran_peserta">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="anggaran_non_peserta">Supporting</label>
                                    <input type="number" min="0" class="form-control" placeholder="Isi Jumlah Supporing" name="anggaran_non_peserta" id="anggaran_non_peserta">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="anggaran_non_peserta">Panitia</label>
                                    <input type="number" min="0" class="form-control" placeholder="Isi Jumlah Panitia" name="anggaran_non_peserta" id="anggaran_non_peserta">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="anggaran_non_peserta">Pejabat</label>
                                    <input type="number" min="0" class="form-control" placeholder="Isi Jumlah Pejabat" name="anggaran_non_peserta" id="anggaran_non_peserta">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="anggaran_non_peserta">Undangan</label>
                                <input type="number" min="0" class="form-control" placeholder="Isi Jumlah Undangan" name="anggaran_non_peserta" id="anggaran_non_peserta">
                            </div>

                            <hr style="border: 1px solid black">

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="anggaran_non_peserta">Anggaran Peserta</label>
                                    <input type="number" min="0" class="form-control" placeholder="Jumlah Anggaran" name="anggaran_non_peserta" id="anggaran_non_peserta">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="anggaran_non_peserta">Anggaran Non Peserta</label>
                                    <input type="number" min="0" class="form-control" placeholder="Jumlah Anggaran" name="anggaran_non_peserta" id="anggaran_non_peserta">
                                </div>
                            </div>

                        </section>
                    </div>


                    {{-- <a href="{{ route('spd.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-warning">Simpan</button> --}}
                </form>                                
            </div>
        </div>
    </div>
</div>
<!-- End XP Contentbar -->
@endsection 
@section('script')
<!-- Select2 JS -->
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/init/form-select-init.js') }}"></script>
<!-- Tagsinput JS -->
<script src="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-tagsinput/typeahead.bundle.js') }}"></script>
<script src="{{ asset('assets/js/init/form-select-init.js') }}"></script>

<!-- Form Step JS -->
<script src="{{ asset('assets/plugins/jquery-step/jquery.steps.min.js') }}"></script>
<script src="{{ asset('assets/js/init/form-step-init.js') }}"></script>
@endsection 