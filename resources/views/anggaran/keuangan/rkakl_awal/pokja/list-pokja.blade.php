@section('title') 
PPSDM Aparatur - RKAKL POKJA
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
        <div class="col-md-1">`
            <a href="{{ route('rkakl.index') }}" class="btn btn-round btn-warning"><i class="mdi mdi-arrow-left"></i></a>
        </div>
        <div class="col-md-11 mt-2">
            <div class="xp-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Pokja</li>
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
                <h5 class="text-black"> {{ $rkakl->kode }}. {{ $rkakl->deskripsi }}</h5>
                <h5 class="card-title mt-3">
                   - LIhat Detail di Setiap Pokja -
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pokja</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($pokja as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->pokja }}</td>
                                <td>{{ $item->deskripsi }}</td>
                                <td>
                                    <a href="{{ route('rkakl.detail-pokja',$item->id) }}" class="btn btn-success"> <i class="mdi mdi-eye"></i> Detail</a>
                                    {{-- <a href="{{ route('kegiatan.index') }}" class="btn btn-info"> <i class="mdi mdi-plus"></i> Kegiatan</a> --}}
                                </td>
                            </tr>
                            @endforeach
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