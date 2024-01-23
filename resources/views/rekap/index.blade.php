@section('title') 
PPSDM Aparatur - Rekap Anggaran
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
            <h4 class="xp-page-title">Rekap Anggaran</h4>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="xp-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Rekap Anggaran</li>
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
                <h5 class="card-title text-black">Data Rekap Anggaran</h5>
            </div>
            {{-- <div class="pl-4">
                <a href="{{ route('mata_anggaran.create') }}" class="btn btn-secondary">+ Tambah Rekap Anggaran</a>
            </div> --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table id="xp-default-datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Anggaran</th>
                            <th>Pokja</th>
                            <th>Deskripsi</th>
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
                                <td align="right"> {{ number_format($item->pagu_awal,0,',','.'); }}</td>
                                <td>
                                    <a href="{{ route('mata_anggaran.edit', $item->id) }}" class="btn btn-info"> <i class="fa fa-pencil"></i> </a>
                                    <a href="{{ route('mata_anggaran.destroy', $item->id) }}" class="btn btn-danger" id="xp-sa-warning"> <i class="fa fa-trash"></i> </a>
                                   
                                </td>
                            </tr>
                        @endforeach --}}
                            <tr>
                                <td>1</td>
                                <td>November 2023</td>
                                <td>BPAU</td>
                                <td>BPAU</td>
                                <td>Kode	Deskripsi	Pagu	Aksi
                                    020.12.WA	Program Dukungan Manajemen	25.322.032.000	
                                    1915	Pengelolaan Manajemen Kesekretariatan Bidang Pengembangan Sumber Daya Manusia ESDM	25.322.032.000	
                                    1915.EBA	Layanan Dukungan Manajemen Internal	22.773.839.000	
                                    1915.EBA.962	Layanan Umum	743.568.000	
                                    601	Melaksanakan Pelayanan Ketatausahaan dan Umum PPSDM Aparatur	615.608.000	
                                    A	Biaya Konsumsi Rapat Pimpinan/POKJA	87.828.000	
                                    B	Layanan Perpustakaan	64.945.000	
                                    C	Monitoring Operasional Kampus Lapangan	462.853.000	
                                    602	Melaksanakan Penyusunan Karya Ilmiah PPSDM Aparatur	127.960.000	
                                    A	Karya Tulis Ilmiah PPSDM Aparatur	462.853.000</td>
                                <td><span class="badge badge-success">Terealisasi</span></td>
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