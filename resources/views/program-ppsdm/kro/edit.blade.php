@section('title') 
PPSDM Aparatur - Edit KRO
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
                    <li class="breadcrumb-item"><a href="{{ route('kro.index') }}">KRO</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit KRO</li>
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
                <h5 class="card-title text-black">Edit KRO</h5>
                <h6 class="card-subtitle">Ubah form dibawah ini.</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('kro.update', $kro->id) }}" onsubmit="return Validation()" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="id_kegiatan_program">Pilih Kegiatan Program *)</label>
                      <select name="id_kegiatan_program" id="id_kegiatan_program" class="form-control xp-select2-single" required>
                        <option value="">Pilih Kegiatan</option>
                        @foreach ($kegiatanProgram as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $kro->id_kegiatan_program ? 'selected' : '' }}>{{ $item->kode }} - {{ $item->deskripsi }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="kode">Kode *)</label>
                      <input type="text" required name="kode" class="form-control" id="kode" value="{{ $kro->kode }}">
                    </div>
                    <div class="form-group">
                      <label for="deskripsi">Deskripsi *)</label>
                      <input type="text" class="form-control" name="deskripsi" id="deskripsi" value="{{ $kro->deskripsi }}" required>
                    </div>
                    <div class="form-group">
                        <label for="pagu_awal">Pagu Awal</label>
                        <input types="number" name="pagu_awal" min="0" class="form-control" id="pagu_awal" value="{{ $kro->pagu_awal }}">
                    </div>

                    <div class="mb-2">
                        <small><i>*) Wajib diisi.</i></small>
                    </div>
                  
                  <a href="{{ route('kro.index') }}" class="btn btn-secondary">Kembali</a>
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
<!-- Tagsinput JS -->
<script src="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-tagsinput/typeahead.bundle.js') }}"></script>
<script src="{{ asset('assets/js/init/form-select-init.js') }}"></script>
@endsection 