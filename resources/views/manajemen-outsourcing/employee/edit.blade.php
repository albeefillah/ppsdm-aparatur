@section('title') 
PPSDM Aparatur - Monitoring OS - Edit Pegawai
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
                    <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Pegawai</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Pegawai</li>
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
                <h5 class="card-title text-black">Edit Pegawai</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('employee.update', $employee->id) }}" onsubmit="return Validation()" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" required name="name" class="form-control" id="name" value="{{ $employee->name }}">
                    </div>
                    <div class="form-group">
                        <label for="category">Kategori</label>
                        <input type="text" required name="category" class="form-control" id="category" value="{{ $employee->category }}">
                    </div>
                   
                  
                  <a href="{{ route('employee.index') }}" class="btn btn-secondary">Kembali</a>
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