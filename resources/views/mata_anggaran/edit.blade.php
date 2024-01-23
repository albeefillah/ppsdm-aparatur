@section('title') 
PPSDM Aparatur - Edit Mata Anggaran
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
                    <li class="breadcrumb-item"><a href="{{ route('mata_anggaran.index') }}">MataAnggaran</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ubah Mata Anggaran</li>
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
                <h5 class="card-title text-black">Ubah Mata Anggaran</h5>
                <h6 class="card-subtitle"> - Unit Bagian Umum -</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('mata_anggaran.update', $mataAnggaran->id) }}" onsubmit="return Validation()" enctype="multipart/form-data">
                    @csrf
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="akun">Akun</label>
                      <input type="number" required name="akun" min="0" class="form-control" id="akun" value="{{ $mataAnggaran->akun }}">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="jenis_belanja">Jenis Belanja</label>
                      <input type="text" class="form-control" name="jenis_belanja" id="jenis_belanja" value="{{ $mataAnggaran->jenis_belanja }}" required>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="pagu_awal">Pagu Awal</label>
                      <input type="number" required name="pagu_awal" min="0" class="form-control" id="pagu_awal" value="{{ $mataAnggaran->pagu_awal }}">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="tahun_anggaran">Tahun Anggaran</label>
                      <input type="number" min="1000" required class="form-control" name="tahun_anggaran" id="tahun_anggaran" value="{{ $mataAnggaran->tahun_anggaran }}">
                      {{-- <div class="invalid-feedback">
                        Please provide a valid city.
                      </div> --}}
                    </div>
                  </div>
                  
                  <a href="{{ route('mata_anggaran.index') }}" class="btn btn-secondary">Kembali</a>
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