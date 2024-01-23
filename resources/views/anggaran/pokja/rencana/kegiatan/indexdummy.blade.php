@section('title') 
PPSDM Aparatur - Kegiatan
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
    <div class="col-md-7 col-lg-7">
        <div class="row">
            <div class="col-md-1">
                <a href="{{ route('rencana.index') }}" class="btn btn-round btn-warning"><i class="mdi mdi-arrow-left"></i></a>
            </div>
            <div class="col-md-5 mt-2">
                <div class="xp-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item" ><a href="{{ route('rencana.index') }}">Rencana Anggaran</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kegiatan</li>
                    </ol>
                </div>
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
                <h5 class="card-title text-black">B. Layanan Perpustakaan </h5>
            </div>
            <div class="pl-4">
                <a class="btn btn-secondary" href="{{ route('kegiatan.create-dummy') }}">
                    + Tambah Kegiatan
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="xp-default-datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kegiatan</th>
                            <th>Pagu</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>Kegiatan 1</td>
                            <td>4.000.000</td>
                            <td>
                                <div class="row xp-button ml-1">
                                    
                                    <a href="{{ route('kegiatan.create-dummy') }}" class="btn btn-round btn-info"> <i class="mdi mdi-pencil"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Kegiatan 2</td>
                            <td>4.000.000</td>
                            <td>
                                <div class="row xp-button ml-1">
                                    
                                    <a href="{{ route('kegiatan.create-dummy') }}" class="btn btn-round btn-info"> <i class="mdi mdi-pencil"></i></a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Kegiatan 3</td>
                            <td>4.000.000</td>
                            <td>
                                <div class="row xp-button ml-1">
                                    
                                    <a href="{{ route('kegiatan.create-dummy') }}" class="btn btn-round btn-info"> <i class="mdi mdi-pencil"></i></a>
                                </div>
                            </td>
                        </tr>
                        
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2"> <b>Total</b> </th>
                                <th colspan="2"> <b>12.000.000</b></th>
                            </tr>
                        </tfoot>
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