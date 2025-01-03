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
        <div class="card-body">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="pj2024-tab" data-toggle="pill" href="#pj2024" role="tab" aria-controls="pj2024" aria-selected="true">2024</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="pj2023-tab" data-toggle="pill" href="#pj2023" role="tab" aria-controls="pj2023" aria-selected="false">2023</a>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pj2024" role="tabpanel" aria-labelledby="pj2024-tab">
                
                <div class="card m-b-30">
                  <div class="card-header">
                    <center><h5>Renkas PPSDM Aparatur 2025</h5></center>
                  </div>
                  <div class="card-body">
                      <iframe title="Renkas Analytics 2024" height="550px" width="100%" src="https://app.powerbi.com/view?r=eyJrIjoiM2E2YjcxMTgtNzhjNS00MGVjLTgzZGEtZDAwMDRlN2M4ZWJjIiwidCI6ImY4YjA2MGZmLWNhMDYtNDBmOS05YTE2LTRmZjcwYzgwZTZhZCIsImMiOjEwfQ%3D%3D&embedImagePlaceholder=true" frameborder="0" allowFullScreen="true"></iframe>
                  </div>
                </div>
          
              </div>
              <div class="tab-pane fade" id="pj2023" role="tabpanel" aria-labelledby="pj2023-tab">
                  <div class="card m-b-30">
                    <div class="card-header">
                      <center><h5>Renkas PPSDM Aparatur 2024</h5></center>
                    </div>
                    <div class="card-body">
                        <iframe title="Renaks Analytics 2023" height="550px" width="100%" src="https://app.powerbi.com/view?r=eyJrIjoiZGRmMTI0YTMtNjYyNy00YjU1LThhNWMtYWNmYmUyMzBkZmFmIiwidCI6ImY4YjA2MGZmLWNhMDYtNDBmOS05YTE2LTRmZjcwYzgwZTZhZCIsImMiOjEwfQ%3D%3D&embedImagePlaceholder=true" frameborder="0" allowFullScreen="true"></iframe>
                    </div>
                  </div>
              </div>
            </div>
        </div>
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