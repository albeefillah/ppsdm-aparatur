@section('title') 
PPSDM Aparatur - Edit User
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
                    <li class="breadcrumb-item"><a href="{{ route('os.index') }}">Data Piket</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Jadwal</li>
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
                <h5 class="card-title text-black">Edit Jadwal</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('os.update', $schedule->id) }}" onsubmit="return Validation()" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nama</label>
                        <select name="employee_id" required id="employee" class="form-control">
                            <option value="">Pilih Pegawai</option>
                            @foreach ($employee as $item)
                                <option value="{{ $item->id }}" {{ $schedule->employee_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Jenis Pekerjaan</label>
                        <select name="job_id" required id="job" class="form-control">
                            <option value="">Pilih Jenis Pekerjaan</option>
                            @foreach ($job as $item)
                                <option value="{{ $item->id }}" {{ $schedule->job_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                            @endforeach
                            <option value="">OFF</option>
                        </select>
                    </div>
                   
                    {{-- <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" required name="email" class="form-control" id="email" value="{{ $employee->email }}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" required name="password" class="form-control" id="password" placeholder="&bull;&bull;&bull;&bull;&bull;">
                    </div>
                   --}}
                  <a href="{{ route('os.index') }}" class="btn btn-secondary">Kembali</a>
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