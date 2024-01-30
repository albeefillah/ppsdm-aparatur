@section('title') 
PPSDM Aparatur - Tambah Akun
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
                    <li class="breadcrumb-item"><a href="{{ route('rkakl.index') }}">RKAKL Awal</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('rkakl.list-akun') }}">Akun</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Akun</li>
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
                <h5 class="card-title text-black">Tambah List Akun ({{ $detkom['kode'] }}.  {{ $detkom['deskripsi'] }}) </h5>
                <h6 class="card-subtitle"></h6> <br>
                <h6 class="card-subtitle">(Pagu = Rp. {{ number_format( $detkom['pagu'], 0, ",", ".") }})</h6> 
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('rkakl.store-akun') }}" onsubmit="return Validation()" enctype="multipart/form-data">
                    @csrf
                   <input type="hidden" name="id_rkakl" id="id_rkakl" value="{{ $id_rkakl }}">
                   <input type="hidden" name="id_detkom" id="id_detkom" value="{{ $detkom['id'] }}">
                   <input type="hidden" name="detkom" value="{{ json_encode($detkom) }}">

                    <div id="inputMataAnggaran">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="mata_anggaran">Mata Anggaran</label>
                                <div class="form-group">
                                    <select name="mata_anggaran[]" class="xp-select2-single form-control">
                                        <option value="">Pilih Mata Anggaran </option>
                                        @foreach ($mataAnggaran as $item)
                                            <option value="{{ $item->id }}">{{ $item->kode }} - {{ $item->deskripsi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
        
                            <div class="form-group col-md-5">
                                <label for="pagu_mata_angggaran">Pagu</label>
                                <div class="form-group">
                                    <input type="number" min="0" name="pagu_mata_anggaran[]" class="form-control" placeholder="Masukkan Pagu">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="button" id="addInput" class="btn btn-success">Tambah Akun</button>
                    </div>
            
                  <a href="{{ URL::previous() }}" class="btn btn-secondary">Kembali</a>
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


<script src="{{ asset('assets/js/rencana-anggaran/akun/mata-anggaran.js') }}"></script>


@endsection 