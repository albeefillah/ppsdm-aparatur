@section('title') 
PPSDM Aparatur - Tambah Rencana Anggaran
@endsection 
@extends('layouts.main')
@section('style')
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
        <div class="col-md-6 col-lg-6">
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="xp-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('rkakl.index') }}">Rencana Anggaran</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Rencana Anggaran</li>
                </ol>
            </div>
        </div>
    </div>          
</div>
<!-- End XP Breadcrumbbar -->
<!-- Start XP Contentbar -->    
<div class="xp-contentbar">
    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-header bg-white">
                <h5 class="card-title text-black">Input RKAKL Awal</h5>
                <h6 class="card-subtitle"> - Keuangan -</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('rkakl.store') }}" onsubmit="return Validation()" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group col-md-1 justify-content-center mx-auto text-center">
                        <label for="tahun">Tahun (*)</label>
                        <input type="number" required name="tahun" min="0" class="form-control" id="tahun" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...">
                    </div>

                    <br>

                    <hr style="border: 1px solid black;">

                    <div id="inputKegiatan">
                        <div class="row">

                            <div class="form-group col-md-2">
                                <label for="kode">Kode</label>
                                <div class="form-group">
                                    <input type="number" min="0" name="kode[]" class="form-control" placeholder="Masukkan Pagu">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="deskripsi">Deskripsi</label>
                                <div class="form-group">
                                    <input type="text" min="0" name="deskripsi[]" class="form-control" placeholder="Masukkan Pagu">
                                </div>
                            </div>
        
                            <div class="form-group col-md-4">
                                <label for="jumlah_biaya">Jumlah Biaya</label>
                                <div class="form-group">
                                    <input type="number" min="0" name="jumlah_biaya[]" class="form-control" placeholder="Masukkan Pagu">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="button" id="addInput" class="btn btn-success">Tambah Kegiatan</button>
                    </div>
                

                    {{-- <hr style="border: 1px solid black;">

                    <div id="inputKRO">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="kro">Pilih KRO</label>
                                <div class="form-group">
                                    <select name="kro[]" class="xp-select2-single form-control">
                                        <option value="">Pilih KRO</option>
                                        @foreach ($kro as $item)
                                            <option value="{{ $item->id }}">{{ $item->kegiatanProgram->kode }}.{{ $item->kode }} - {{ $item->deskripsi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
        
                            <div class="form-group col-md-5">
                                <label for="pagu_kro">Pagu</label>
                                <div class="form-group">
                                    <input type="number" min="0" name="pagu_kro[]" class="form-control" placeholder="Masukkan Pagu">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <button type="button" id="addInputKRO" class="btn btn-success">Tambah KRO</button>
                    </div>
                
                    <hr style="border: 1px solid black;">

                    <div id="inputRincian">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="rincian">Pilih Rincian Output</label>
                                <div class="form-group">
                                    <select name="rincian[]" class="xp-select2-single form-control">
                                        <option value="">Pilih Rincian</option>
                                        @foreach ($ro as $item)
                                            <option value="{{ $item->id }}">{{ $item->kro->kegiatanProgram->kode }}.{{ $item->kro->kode }}.{{ $item->kode }} - {{ $item->deskripsi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
        
                            <div class="form-group col-md-5">
                                <label for="pagu_rincian">Pagu</label>
                                <div class="form-group">
                                    <input type="number" min="0" name="pagu_rincian[]" class="form-control" placeholder="Masukkan Pagu">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <button type="button" id="addInputRincian" class="btn btn-success">Tambah Rincian Output</button>
                    </div>

                    <hr style="border: 1px solid black;">

                    <div id="inputSubkom">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="    ">Pilih Sub Komponen</label>
                                <div class="form-group">
                                    <select name="subkom[]" class="xp-select2-single form-control">
                                        <option value="">Pilih Sub Komponen</option>
                                        @foreach ($subkom as $item)
                                            <option value="{{ $item->id }}">{{ $item->rincianOutput->kro->kegiatanProgram->kode }}.{{ $item->rincianOutput->kro->kode }}.{{ $item->rincianOutput->kode }}.{{ $item->kode }} - {{ $item->deskripsi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
        
                            <div class="form-group col-md-5">
                                <label for="pagu_subkom">Pagu</label>
                                <div class="form-group">
                                    <input type="number" min="0" name="pagu_subkom[]" class="form-control" placeholder="Masukkan Pagu">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <button type="button" id="addInputSubkom" class="btn btn-success">Tambah Sub Komponen</button>
                    </div>

                    <hr style="border: 1px solid black;">

                    <div id="inputDetkom">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="detkom">Pilih Detail Komponen</label>
                                <div class="form-group">
                                    <select name="detkom[]" class="xp-select2-single form-control">
                                        <option value="">Pilih Detail Komponen</option>
                                        @foreach ($detail as $item)
                                            <option value="{{ $item->id }}">{{ $item->subKomponen->rincianOutput->kro->kegiatanProgram->kode }}.{{ $item->subKomponen->rincianOutput->kro->kode }}.{{ $item->subKomponen->rincianOutput->kode }}. {{ $item->subKomponen->kode }}.{{ $item->kode }} - {{ $item->deskripsi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
        
                            <div class="form-group col-md-5">
                                <label for="pagu_detkom">Pagu</label>
                                <div class="form-group">
                                    <input type="number" min="0" name="pagu_detkom[]" class="form-control" placeholder="Masukkan Pagu">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <button type="button" id="addInputDetkom" class="btn btn-success">Tambah Detail Komponen</button>
                    </div> --}}
                
              
                  <a href="{{ route('rkakl.index') }}" class="btn btn-secondary">Kembali</a>
                  <button type="submit" class="btn btn-warning">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End XP Contentbar -->

@endsection 
@section('script')

<!-- Select2 JS -->
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/init/form-select-init.js') }}"></script>


<script src="{{ asset('assets/js/rencana-anggaran/kegiatan.js') }}"></script>
<script src="{{ asset('assets/js/rencana-anggaran/kro.js') }}"></script>
<script src="{{ asset('assets/js/rencana-anggaran/rincian.js') }}"></script>
<script src="{{ asset('assets/js/rencana-anggaran/subkom.js') }}"></script>
<script src="{{ asset('assets/js/rencana-anggaran/detkom.js') }}"></script>


@endsection 