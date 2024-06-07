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

    <div class="col-md-12 col-lg-12 col-xl-12">
        @if (auth()->check() && (auth()->user()->can('isKapus') || auth()->user()->can('isSuperadmin')))
            @include('dashboard.kapus')
        @endif
        @can('isBPAU')    
            @include('dashboard.bpau')
        @elsecan('isBPAS')    
            @include('dashboard.bpas')
        @elsecan('isBPAP')    
            @include('dashboard.bpap')
        @elsecan('isBPAK')    
            @include('dashboard.bpak')
        @endcan
    </div>
    <!-- End XP Col -->
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