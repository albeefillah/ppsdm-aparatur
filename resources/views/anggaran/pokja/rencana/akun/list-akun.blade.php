@section('title') 
PPSDM Aparatur - Tambah Akun
@endsection 
@extends('layouts.main')
@section('style')
<!-- DataTables CSS -->
<link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Sweet Alert -->
<link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

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
            <div class="col-md-1">`
                <a href="{{ route('rencana.index') }}" class="btn btn-round btn-warning"><i class="mdi mdi-arrow-left"></i></a>
            </div>
            <div class="col-md-11 mt-2">
                <div class="xp-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                        <li class="breadcrumb-item" ><a href="{{ route('rencana.index') }}">Rencana Anggaran</a></li>
                        <li class="breadcrumb-item active" aria-current="page">List Akun</li>
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
                <h5 class="card-title text-black">{{ $rkakl->kode }}. {{ $rkakl->deskripsi }} (Rp. {{ number_format( $pagu, 0, ",", ".") }})</h5>
            </div>
        <div class="pl-4">
                <a href="{{ route('rencana.tambah-akun', ['id_rkakl' => $rkakl->id, 'pagu' => $pagu, 'id_rencana' => $id_rencana]) }}" type="button" class="btn btn-secondary" >
                    + Tambah Akun
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="xp-default-datatable" class="table table-striped table-borderless table-font">
                        <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Akun</th>
                            <th>Deskripsi</th>
                            <th>Pagu</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $totalPagu = 0;
                        @endphp
                        @foreach ($dataAkun as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item['kode'] }}</td>
                                <td>{{ $item['deskripsi'] }}</td>
                                <td align="right">{{ number_format($item['pagu'],0,',','.'); }}</td>
                                <td>
                                    {{-- <a href="{{ route('rencana.update-akun', ['id_akun_used' => $akun->id, 'id' => $item['id']]) }}" class="btn btn-info"> <i class="fa fa-pencil"></i> </a> --}}
                                    <a href="{{ route('rencana.destroy-akun', ['id_akun_used' => $akun->id, 'id' => $item['id']]) }}" class="btn btn-danger" id="xp-sa-warning"> <i class="fa fa-trash"></i> </a> 
                                </td>
                            </tr>
                        @php
                            $totalPagu += $item['pagu'];
                        @endphp
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3"> <b>Total</b> </th>
                                <th colspan="1" style="text-align: right;"> <b>{{ number_format($totalPagu,0,',','.'); }} </b></th>
                                <th></th>
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
<!-- Select2 JS -->
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/init/form-select-init.js') }}"></script>
<!-- Tagsinput JS -->
<script src="{{ asset('assets/js/init/form-select-init.js') }}"></script>
@endsection 