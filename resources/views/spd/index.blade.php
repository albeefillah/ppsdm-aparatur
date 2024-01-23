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
      <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-header bg-white">
                <h5 class="card-title text-black">Data SPD Tahun 2023</h5>
            </div>
            <div class="pl-4">
                <a href="{{ route('spd.create') }}" class="btn btn-secondary">+ Tambah SPD</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="xp-default-datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Mata Anggaran</th>
                            <th>Tgl Berangkat</th>
                            <th style="width:50%">Maksud</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{-- @foreach ($mataAnggaran as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->jenis_belanja }}</td>
                                <td>{{ $item->akun }}</td>
                                <td>Rp. {{ number_format($item->pagu_awal,0,',','.'); }}</td>
                                <td>
                                    <a href="{{ route('spd.edit', $item->id) }}" class="btn btn-info"> <i class="fa fa-pencil"></i> </a>
                                    <a href="{{ route('spd.destroy', $item->id) }}" class="btn btn-danger" id="xp-sa-warning"> <i class="fa fa-trash"></i> </a>
                                   
                                </td>
                            </tr>
                        @endforeach --}}
                        <tr>
                            <td>1</td>
                            <td>1915.EBA.994.002.N.524111</td>
                            <td>2023-11-21</td>
                            <td>Pertemuan Dukungan Tugas Belajar Kementerian ESDM Tahun 2024 dengan The University of Westem Australia di Badan Pengembangan SDM ESDM di Lanjut Menghadiri Undangan Rapat Kerja dengan Komisi VII DPR RI di Jakarta</td>
                            <td>
                                <div class="row ml-1">
                                    <span class="badge badge-info"><i class="fa fa-check"></i></span>
                                    <span class="badge badge-info"><i class="fa fa-check"></i></span>
                                    <span class="badge badge-info"><i class="fa fa-check"></i></span>
                                </div>
                            </td>
                            <td>
                                <div class="row xp-button ml-1">
                                    <a href="{{ route('spd.pelaksana.index',1) }}" class="btn btn-round btn-warning"> <i class="mdi mdi-account-multiple-plus"></i></a>
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