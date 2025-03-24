@section('title') 
PPSDM Aparatur - Dashboard
@endsection 
@extends('layouts.main')
@section('style')
<!-- Chartist Chart CSS -->
<link href="{{ asset('assets/plugins/chartist-js/chartist.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Datepicker CSS -->
<link href="{{ asset('assets/plugins/datepicker/datepicker.min.css') }}" rel="stylesheet" type="text/css" />

{{-- Add style table --}}
<style>
    .scroll-indicator{
        height:700px ;
        overflow-x:auto;
        border-radius: 8px;
        position: relative;
    }
    
</style>
@livewireStyles
@endsection 
@section('content')
<!-- Start XP Breadcrumbbar -->                    
<br>
<br>
<br>
<!-- End XP Breadcrumbbar -->
<!-- Start XP Contentbar -->    
<div class="xp-contentbar">

    <div class="row">
        <div class="col-md-4 col-lg-4 col-xl-4">
            <div class="card bg-success-gradient m-b-30">
                <div class="card-body">
                    <div class="xp-widget-box text-white text-center pt-3">
                        <p class="xp-icon-timer mb-4"><i class="icon-book-open"></i></p>
                        <h5 class="mb-2 font-20">Perjadin</h5>
                        <p class="mb-3">Monitoring data Perjalanan Dinas PPSDM Aparatur</p>
                        <a href="{{ route('sppd.index') }}" class="btn btn-white btn-rounded text-success">Lihat Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-4">
            <div class="card bg-info-gradient m-b-30">
                <div class="card-body">
                    <div class="xp-widget-box text-white text-center pt-3">
                        <p class="xp-icon-timer mb-4"><i class="icon-people"></i></p>
                        <h5 class="mb-2 font-20">Profile Kepegawaian</h5>
                        <p class="mb-3">Db Kepegawaian KESDM (TLCS, TUBEL, Penyertaan,dsb)</p>
                        <a href="{{ route('profile-kepeg.index') }}" class="btn btn-white btn-rounded text-info">Lihat Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
       

        @if (auth()->check() && (auth()->user()->can('isKapus') || auth()->user()->can('isSuperadmin')))
        <div class="col-md-4 col-lg-4 col-xl-4">
            <div class="card bg-warning-gradient m-b-30">
                <div class="card-body">
                    <div class="xp-widget-box text-white text-center pt-3">
                        <p class="xp-icon-timer mb-4"><i class="ti-money"></i></p>
                        <h class="mb-2 font-20">Keuangan</h>
                        <p class="mb-3">Monitoring Renkas dan Anggaran PPSDM Aparatur</p>
                        <a href="{{ route('keuangan.index') }}" class="btn btn-white btn-rounded text-warning">Lihat Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-4">
            <div class="card bg-secondary-gradient m-b-30">
                <div class="card-body">
                    <div class="xp-widget-box text-white text-center pt-3">
                        <p class="xp-icon-timer mb-4"><i class="ti-layout-media-left"></i></p>
                        <h5 class="mb-2 font-20">Kurikulum</h5>
                        <p class="mb-3">Daftar Kurikulum Pelatihan PPSDM Aparatur</p>
                        <a href="{{ route('kurikulum.index') }}" class="btn btn-white btn-rounded text-secondary">Lihat Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-4">
            <div class="card bg-danger-gradient m-b-30">
                <div class="card-body">
                    <div class="xp-widget-box text-white text-center pt-3">
                        <p class="xp-icon-timer mb-4"><i class="mdi mdi-account-group"></i></p>
                        <h5 class="mb-2 font-20">Outsourcing (OS)</h5>
                        <p class="mb-3">Database monitoring pegawai OS  PPSDMA</p>
                        <a href="{{ route('kurikulum.index') }}" class="btn btn-white btn-rounded text-secondary">Lihat Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>

</div>

<!-- End XP Contentbar -->
@endsection 
@section('script')
<!-- Chartist Chart JS -->
<script src="{{ asset('assets/plugins/chartist-js/chartist.min.js') }}"></script>
<script src="{{ asset('assets/plugins/chartist-js/chartist-plugin-tooltip.min.js') }}"></script>
<!-- To Do List JS -->
<script src="{{ asset('assets/js/init/to-do-list-init.js') }}"></script>
<!-- Datepicker JS -->
<script src="{{ asset('assets/plugins/datepicker/datepicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datepicker/i18n/datepicker.en.js') }}"></script>
<!-- Dashboard JS -->
<script src="{{ asset('assets/js/init/dashborad.js') }}"></script>

@livewireScripts
@endsection 