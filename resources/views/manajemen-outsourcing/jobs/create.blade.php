@section('title') 
PPSDM Aparatur - Monitoring OS - Tambah Job
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
                    <li class="breadcrumb-item"><a href="{{ route('jobs.index') }}">Job</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Job</li>
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
                <h5 class="card-title text-black">Tambah Job</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('jobs.store') }}" onsubmit="return Validation()" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="code">Kode</label>
                        <input type="text" required name="code" class="form-control" id="code" placeholder="Masukan Nama">
                    </div>
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" required name="name" class="form-control" id="name" placeholder="Masukan Nama">
                    </div>
                    <div class="form-group">
                        <label for="category">Kategori</label>
                        <input type="text" required name="category" class="form-control" id="category" placeholder="Kategori">
                    </div>
                    <div class="form-group">
                        <label for="jobdesc">Job Deskripsi</label>
                        <textarea name="jobdesc" class="form-control" id="jobdesc" cols="30" rows="10" placeholder="Isi Job Deksripsi"></textarea>
                    </div>
                    {{-- <div class="form-group">
                        <label for="type">Tipe</label>
                        <input type="text" required name="type" class="form-control" id="type" placeholder="Tipe">
                    </div> --}}
                    <div class="form-group">
                        <label for="shift">Shift</label>
                        <select name="shift" required id="shift" class="form-control">
                            <option value="">Pilih Shift</option>
                            <option value="pagi">Pagi</option>
                            <option value="siang">Siang</option>
                            <option value="sore">Sore</option>
                            <option value="malam">Malam</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="start">Jam Mulai</label>
                        <input type="time" required name="start" class="form-control" id="start" placeholder="Jam mulai">
                    </div>
                    <div class="form-group">
                        <label for="end">Jam Selesai</label>
                        <input type="time" required name="end" class="form-control" id="end" placeholder="Jam selesai">
                    </div>
                  <a href="{{ route('jobs.index') }}" class="btn btn-secondary">Kembali</a>
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