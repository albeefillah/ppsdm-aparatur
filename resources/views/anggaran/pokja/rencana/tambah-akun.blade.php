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
                        <li class="breadcrumb-item active" aria-current="page">Akun</li>
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
                <h5 class="card-title text-black">A. Biaya Konsumsi Rapat Pimpinan / POKJA (Rp. 87.828.000)</h5>
            </div>
            <div class="pl-4">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#tambahAkun">
                    + Tambah Akun
                </button>

                {{-- Modal --}}
                <div class="modal fade" id="tambahAkun" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Akun</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        
                        <form method="POST" action="{{ route('rencana.store') }}" onsubmit="return Validation()" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="akun">Akun</label>
                                    <select name="deskripsi" class="xp-select2-single form-control">
                                        <option value="">Pilih Akun</option>
                                        @foreach ($mataAnggaran as $item)
                                            <option value="">{{ $item->akun }} - {{ $item->jenis_belanja }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="akun">Rencana Pagu</label>
                                    <input type="number" required name="akun" min="0" class="form-control" id="akun" placeholder="Masukan Pagu">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" data-dismiss="modal" class="btn btn-warning">Save changes</button>
                            </div>
                        </form>
                      </div>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="xp-default-datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Akun</th>
                            <th>Sisa Pagu</th>
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
                            <td>521111</td>
                            <td>Belanja Keperluan Perkantoran</td>
                            <td>87.828.000</td>
                            <td>
                                <div class="row xp-button ml-1">
                                    <a href="{{ route('rencana.tambah-akun') }}" class="btn btn-round btn-danger"> <i class="mdi mdi-delete"></i></a>
                
                                </div>
                            </td>
                        </tr>
                        
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2"> <b>Total</b> </th>
                                <th colspan="2"> <b>87.828.000</b></th>
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