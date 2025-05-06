@section('title') 
PPSDM Aparatur - Tambah User
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
                    <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah User</li>
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
                <h5 class="card-title text-black">Tambah User</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('user.store') }}" onsubmit="return Validation()" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" required name="name" class="form-control" id="name" placeholder="Masukan Nama">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" required name="username" class="form-control" id="username" placeholder="Masukan Username">
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="id_role" required id="role" class="form-control">
                            <option value="">Pilih Role</option>
                            @foreach ($role as $item)
                                <option value="{{ $item->id }}">{{ $item->role }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" required name="email" class="form-control" id="email" placeholder="Masukan Email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" required name="password" class="form-control" id="password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                    </div>
                  
                  <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
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