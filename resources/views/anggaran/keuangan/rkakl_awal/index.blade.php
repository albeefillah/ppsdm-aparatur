@section('title') 
PPSDM Aparatur -Rencana Kerja Anggaran Kementrian Negara/Lembaga
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
            <h4 class="xp-page-title"></h4>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="xp-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">RKAKL Awal</li>
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
                <h4 class=" text-black text-center table-font mt-3">
                    RKAKL Awal Tahun {{ $rkakl[0]->tahun }}
                </h4>
            </div>
            {{-- <div class="pl-4">
                <a href="{{ route('rkakl.create') }}" class="btn btn-secondary">+ Input RKAKL Awal</a>
            </div> --}}
            
            <div class="pl-4">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleStandardModal">
                    Import Data
                </button>
            </div>

             <!-- Modal -->
             <div class="modal fade" id="exampleStandardModal" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleStandardModalLabel">Import Data</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="{{ route('rkakl.import') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            
                            <div class="form-group">
                                <input type="file" class="form-control" name="file_import">
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-info">Import</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-font">
                        <thead>
                        <tr>
                            <th style="background: #d8dee3;"><center>Kode</center></th>
                            <th style="background: #d8dee3;"><center>Deskripsi</center></th>
                            <th style="background: #d8dee3;"><center>Jumlah Biaya</center></th>
                            <th style="background: #d8dee3;"><center>Aksi</center></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($rkakl as $key => $item)
                            <tr>
                                <td style="background: #DDEBF7;" align="center"> <b> {{ $item->kode }} </b></td>
                                <td style="background: #DDEBF7;"><b>{{ $item->deskripsi }}</b></td>
                                <td style="background: #DDEBF7;" align="right"><b>{{ number_format( intval($item->jumlah_biaya), 0, ",", ".") }}</b></td>
                                <td style="background: #DDEBF7;">
                                    @if(strlen($item->kode) === 1 && ctype_alpha($item->kode))
                                        <center>
                                            <a href="{{ route('rkakl.list-pokja', $item->id) }}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Detail Pokja"> <i class="mdi mdi-eye"></i><i class="mdi mdi-parking"></i></a>
                                            <a href="#" data-toggle="modal" data-target="#editModal{{ $item->id }}"class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Ubah Data"> <i class="mdi mdi-plus"></i><i class="mdi mdi-pencil"></i></a>
                                        </center>
                                        @include('anggaran.keuangan.rkakl_awal.modal-edit', ['item' => $item])
                                    @endif
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

    

<!-- End XP Contentbar -->
@endsection 
@section('script')
<!-- resources/views/posts/index.blade.php atau footer.blade.php -->
<script>
    $(document).ready(function () {
        // Jika ingin menutup modal setelah form dikirim
        $('#editModal{{ $item->id }}').on('hidden.bs.modal', function () {
            // Reset form jika diperlukan
            // $('#editForm')[0].reset();
        });
    });
</script>

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