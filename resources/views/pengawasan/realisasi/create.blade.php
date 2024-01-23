@section('title') 
PPSDM Aparatur - Isi Realisasi
@endsection 
@extends('layouts.main')
@section('style')
<!-- DataTables CSS -->
<link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Sweet Alert -->
<link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

@endsection 
@section('content')
<!-- Start XP Breadcrumbbar -->                    
<div class="xp-breadcrumbbar">
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <h4 class="xp-page-title">Realisasi Anggaran Bulan Desember 2023</h4>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="xp-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('realisasi.index') }}"></a>Realisasi</li>
                    <li class="breadcrumb-item active" aria-current="page">Isi Realisasi</li>
                </ol>
            </div>
        </div>
    </div>          
</div>
<!-- End XP Breadcrumbbar -->


<!-- Start XP Contentbar -->    
<div class="xp-contentbar">
   
    {{-- Alert Validation --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil !</strong> 
            {{ session()->get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>    
    @endif


    <!-- Start XP Col -->
      <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-header bg-white">
                <h5 class="card-title text-black">- Unit Bagian Umum -</h5>
            </div>
            {{-- <div class="pl-4">
                <a href="{{ route('rencana.create') }}" class="btn btn-secondary">+ Tambah Rencana</a>
            </div> --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="xp-edit-btn">
                        <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Deskripsi</th>
                            <th>Pagu</th>
                            <th>Realisasi</th>
                            <th>Sisa</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>020.12.WA</td>
                            <td>Program Dukungan Manajemen</td>
                            <td>25.322.032.000</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>1915</td>
                            <td>Pengelolaan Manajemen Kesekretariatan Bidang Pengembangan Sumber Daya Manusia ESDM</td>
                            <td>25.322.032.000</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>1915.EBA</td>
                            <td>Layanan Dukungan Manajemen Internal</td>
                            <td>22.773.839.000</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>1915.EBA.962</td>
                            <td>Layanan Umum</td>
                            <td>743.568.000</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>601</td>
                            <td>Melaksanakan Pelayanan Ketatausahaan dan Umum PPSDM Aparatur</td>
                            <td>615.608.000</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>A</td>
                            <td>Biaya Konsumsi Rapat Pimpinan/POKJA</td>
                            <td>87.828.000</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>B</td>
                            <td>Layanan Perpustakaan</td>
                            <td>64.945.000</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>C</td>
                            <td>Monitoring Operasional Kampus Lapangan</td>
                            <td>462.853.000</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>602</td>
                            <td>Melaksanakan Penyusunan Karya Ilmiah PPSDM Aparatur</td>
                            <td>127.960.000</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>A</td>
                            <td>Karya Tulis Ilmiah PPSDM Aparatur</td>
                            <td>462.853.000</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End XP Col -->
   
</div>
<!-- End XP Contentbar -->
@endsection 
@section('script')

<!-- Tabledit JS -->
<script src="{{ asset('assets/plugins/tabledit/jquery.tabledit.js') }}"></script>
<script src="{{ asset('assets/js/init/table-editable-init.js') }}"></script>

<!-- Sweet-Alert JS -->
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/js/init/sweet-alert-init.js') }}"></script>

@endsection 