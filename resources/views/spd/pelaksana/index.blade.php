@section('title') 
PPSDM Aparatur - SPD
@endsection 
@extends('layouts.main')
@section('style')
<!-- DataTables CSS -->
<link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Sweet Alert -->
<link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    #peserta-tab.active {
        background-color: #f1e724;
    }
    #non-peserta-tab.active {
        background-color: #f1e724;
    }
</style>
@endsection 
@section('content')
<!-- Start XP Breadcrumbbar -->                    
<div class="xp-breadcrumbbar">
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <h4 class="xp-page-title">Surat Perjalanan Dinas</h4>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="xp-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">SPD</li>
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
    <div class="col-md-12 col-lg-12 col-xl-12 ">
        <ul class="nav nav-pills mb-3 " id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="peserta-tab" data-toggle="pill" href="#peserta" role="tab" aria-controls="peserta" aria-selected="true">Peserta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="non-peserta-tab" data-toggle="pill" href="#non-peserta" role="tab" aria-controls="non-peserta" aria-selected="false">Non Peserta</a>
            </li>
           
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="peserta" role="tabpanel" aria-labelledby="peserta-tab">
               <br>
                <!-- Start Peserta -->
                <div class="col-lg-12">
                    <div class="card m-b-30">
                        <div class="card-header bg-white">
                            <h5 class="card-title text-black">Data Peserta Diklat 1</h5>
                        </div>
                        <div class="pl-4">
                            <a href="{{ route('spd.peserta.create') }}" class="btn btn-secondary">+ Tambah Peserta</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="xp-default-datatable" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Peserta</th>
                                        <th>Nama Peserta</th>
                                        <th>Unit</th>
                                        <th>Jabatan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1.</td>
                                        <td>3204065012880009</td>
                                        <td>Rahmat Irianto</td>
                                        <td>Bagian Umum</td>
                                        <td>Peserta</td>
                                        <td> Aktif </td>
                                        <td>
                                            <div class="row xp-button ml-1">
                                                <a href="" class="btn btn-round btn-info"> <i class="mdi mdi-pencil"></i> </a>
                                                <a href="" class="btn btn-round btn-danger" id="xp-sa-warning"> <i class="mdi mdi-delete-empty"></i> </a> 
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Peserta -->
            </div>
           
            <div class="tab-pane fade" id="non-peserta" role="tabpanel" aria-labelledby="non-peserta-tab">
               <br>
                <!-- Start Peserta -->
                <div class="col-lg-12">
                    <div class="card m-b-30">
                        <div class="card-header bg-white">
                            <h5 class="card-title text-black">Data Non Peserta Diklat 1</h5>
                        </div>
                        <div class="pl-4">
                            <a href="{{ route('spd.nonpeserta.create') }}" class="btn btn-secondary">+ Tambah Pegawai</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="xp-default-datatable" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIP</th>
                                        <th>Nama Pegawai</th>
                                        <th>Unit</th>
                                        <th>Jabatan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1.</td>
                                        <td>3204065012880009</td>
                                        <td>Waqiati Nurdhafiah, S.S.</td>
                                        <td>Bagian Umum</td>
                                        <td>Pengelola Kepegawaian</td>
                                        <td> Aktif </td>
                                        <td>
                                            <div class="row xp-button ml-1">
                                                <a href="" class="btn btn-round btn-info"> <i class="mdi mdi-pencil"></i> </a>
                                                <a href="" class="btn btn-round btn-danger" id="xp-sa-warning"> <i class="mdi mdi-delete-empty"></i> </a> 
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Peserta -->
            </div>
           
        </div>
    </div>
   <!-- End XP Col -->

   
</div>
<!-- End XP Contentbar -->
@endsection 
@section('script')
<!-- Required Datatable JS -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/init/table-datatable-init.js') }}"></script>

<!-- Sweet-Alert JS -->
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/js/init/sweet-alert-init.js') }}"></script>
@endsection 