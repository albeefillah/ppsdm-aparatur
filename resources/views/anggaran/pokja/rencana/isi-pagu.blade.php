@section('title') 
PPSDM Aparatur - Isi Pagu Rencana
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
    .table-border td {
        border: 1px solid black;
        border-top: 1px solid black;
    }
</style>

@endsection 
@section('content')
<!-- Start XP Breadcrumbbar -->                    
<div class="xp-breadcrumbbar">
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <h4 class="xp-page-title"></h4>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="xp-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('rencana.index') }}">Rencana Anggaran</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('rencana.create') }}">Tambah Rencana</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Isi Pagu</li>
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
                <h5 class="text-center text-black table-font mt-3">
                    Input Pagu Rencana Anggaran
                </h5>

                <h5 class="text-center card-title"> 
                    - {{ Auth::user()->role->role }} ({{ Auth::user()->role->deskripsi }}) -
                </h5>
            </div>
            
            <form action="{{ route('rencana.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-border table-font">
                            <thead>
                                <tr>
                                    <th style="background: #d8dee3;border:1px solid black;"><center>Kode</center></th>
                                    <th style="background: #d8dee3;border:1px solid black;"><center>Deskripsi</center></th>
                                    <th style="background: #d8dee3;border:1px solid black;"><center>Pagu Awal</center></th>
                                    <th style="background: #d8dee3;border:1px solid black;"><center>Isi Pagu</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rencana as $key => $item)
                                <tr>
                                    <td style="background: {{ $pokja === 'BPAU' ? '#ffff52' 
                                    : ($pokja === 'BPAS' ? '#BDD7EE' 
                                    : ($pokja === 'BPAP' ? '#F8CBAD' 
                                    : ($pokja === 'BPAK' ? '#C6E0B4' 
                                    : ''))) }};" align="center"> 
                                        <b> {{ $item->kode }} </b>
                                    </td>

                                    <td style="background: {{ $pokja === 'BPAU' ? '#ffff52' 
                                    : ($pokja === 'BPAS' ? '#BDD7EE' 
                                    : ($pokja === 'BPAP' ? '#F8CBAD' 
                                    : ($pokja === 'BPAK' ? '#C6E0B4' 
                                    : ''))) }};" >
                                     <b>{{ $item->deskripsi }}</b>
                                    </td>

                                   <td style="background: {{ $pokja === 'BPAU' ? '#ffff52' 
                                    : ($pokja === 'BPAS' ? '#BDD7EE' 
                                    : ($pokja === 'BPAP' ? '#F8CBAD' 
                                    : ($pokja === 'BPAK' ? '#C6E0B4' 
                                    : ''))) }};" align="right"> 
                                    <b>{{ number_format( intval($item->jumlah_biaya), 0, ",", ".") }}</b>
                                    </td>

                                     <td style="background: {{ $pokja === 'BPAU' ? '#ffff52' 
                                    : ($pokja === 'BPAS' ? '#BDD7EE' 
                                    : ($pokja === 'BPAP' ? '#F8CBAD' 
                                    : ($pokja === 'BPAK' ? '#C6E0B4' 
                                    : ''))) }};"> 
                                        <center>
                                            <div class="form-group">
                                                <input type="number" min="0" required placeholder="Masukkan Pagu" class="form-control" name="pagu[{{ $item->id }}]" id="pilih_{{ $item->id }}">
                                                <input type="hidden" value="{{ $item->id }}" name="id_rkakl[{{ $item->id }}]" id="id_rkakl">
                                            </div>
                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
            <div class="pl-4">
                <a href="{{ route('rencana.create') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-warning">Selanjutnya</button>
            </div>

            </form>

            </div>
        </div>
    </div>
    <!-- End XP Col -->

    

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