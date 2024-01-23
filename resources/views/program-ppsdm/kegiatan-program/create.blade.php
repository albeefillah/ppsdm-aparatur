@section('title') 
PPSDM Aparatur - Tambah Kegiatan Program
@endsection 
@extends('layouts.main')
@section('style')

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
                    <li class="breadcrumb-item"><a href="{{ route('kegiatan-program.index') }}">Kegiatan Program</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Kegiatan Program</li>
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
                <h5 class="card-title text-black">Tambah Kegiatan Program</h5>
                <h6 class="card-subtitle">Isi form dibawah ini.</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('kegiatan-program.store') }}" onsubmit="return Validation()" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label for="kode">Kode *)</label>
                      <input type="text" required name="kode" class="form-control" id="kode" placeholder="Kode Kegiatan">
                    </div>
                    <div class="form-group">
                      <label for="deskripsi">Deskripsi *)</label>
                      <input type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="Deskripsi" required>
                    </div>
                    <div class="form-group">
                        <label for="pagu_awal">Pagu Awal</label>
                        <input types="number" name="pagu_awal" min="0" class="form-control" id="pagu_awal" placeholder="Pagu Awal">
                    </div>

                    <div class="mb-2">
                        <small><i>*) Wajib diisi.</i></small>
                    </div>
                  
                  <a href="{{ route('kegiatan-program.index') }}" class="btn btn-secondary">Kembali</a>
                  <button type="submit" class="btn btn-warning">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End XP Contentbar -->
@endsection 
@section('script')

@endsection 