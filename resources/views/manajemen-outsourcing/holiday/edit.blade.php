@section('title') 
PPSDM Aparatur - Monitoring OS - Edit Tanggal Libur
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
                    <li class="breadcrumb-item"><a href="{{ route('holiday.index') }}">Tanggal Libur</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Tanggal Libur</li>
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
                <h5 class="card-title text-black">Edit Tanggal Libur</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('holiday.update', $holiday->id) }}" onsubmit="return Validation()" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="date">Tanggal</label>
                        <input type="date" required name="date" class="form-control" id="date" value="{{ $holiday->date }}">
                    </div>
                   
                    <div class="form-group">
                        <label for="description">Deskripsi</label>
                        <input type="text" required name="description" class="form-control" id="description" value="{{ $holiday->description }}">
                    </div>
                    
                  <a href="{{ route('holiday.index') }}" class="btn btn-secondary">Kembali</a>
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