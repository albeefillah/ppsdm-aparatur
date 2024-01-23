@section('title') 
PPSDM Aparatur - Tambah kegiatan
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
                    <li class="breadcrumb-item"><a href="{{ route('rencana.index') }}">Rencana Anggaran</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('kegiatan.index') }}">Kegiatan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Rencana Kegiatan</li>
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
                <h5 class="card-title text-black">Tambah Kegiatan</h5>
                <h6 class="card-subtitle"> B. Pelayanan Perpustakaan</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('kegiatan.index') }}" onsubmit="return Validation()" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div><b>Pilih Mata Anggaran :</b></div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck1">
                            <label class="form-check-label" for="gridCheck1">
                              521211 - Belanja Bahan (Sisa Pagu : Rp. 15.454.000)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck2">
                            <label class="form-check-label" for="gridCheck2">
                              521811 - Belanja Barang Persediaan Bidang Konsumsi (Sisa Pagu : Rp. 12.222.000)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck3">
                            <label class="form-check-label" for="gridCheck3">
                              522151 - Belanja Jasa Profesi (Sisa Pagu : Rp. 5.321.000)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gridCheck4">
                            <label class="form-check-label" for="gridCheck4">
                              524111 - Belanja Perjalanan Dinas Biasa (Sisa Pagu : Rp. 15.323.000)
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_kegiatan">Nama Kegiatan</label>
                        <input type="text" required name="nama_kegiatan" class="form-control" id="nama_kegiatan" placeholder="Nama Kegiatan">
                    </div>
                    <div class="form-group">
                        <label for="anggaran">Pagu Anggaran</label>
                        <input type="number" required name="anggaran" min="0" class="form-control" id="anggaran" placeholder="Masukan Anggaran">
                    </div>
              
                  <a href="{{ route('kegiatan.index') }}" class="btn btn-secondary">Kembali</a>
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