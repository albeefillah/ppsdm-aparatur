<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Neon is a bootstrap, laravel & php admin dashboard template">
        <meta name="keywords" content="admin, admin dashboard, admin panel, admin template, admin theme, bootstrap 4, laravel, php, crm, analytics, responsive, sass support, ui kits, web app, clean design">
        <meta name="author" content="Themesbox17">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title> @yield('title') </title>
        <!-- Fevicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/esdm-icon.ico') }}">
        <!-- Start CSS -->   
        @yield('style')
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css">
        <style>
            .table-font{
        font-family: 'Gill Sans', sans-serif;
    }

        </style>
        <!-- End CSS -->
    </head>
    <body class="xp-vertical xp-toggle-menu">
        <!-- Search Modal -->
        <div class="modal search-modal fade" id="xpSearchModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="xp-searchbar">
                            <form>
                                <div class="input-group">
                                    <input type="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn" type="submit" id="button-addon2">GO</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start XP Container -->
        <div id="xp-container">     
            <!-- Start XP Leftbar -->
            @include('layouts.leftbar')
            <!-- End XP Leftbar -->
            <!-- Start XP Rightbar -->
            <div class="xp-rightbar">  
                <!-- Start XP Topbar -->
                <div class="xp-topbar">
                    <!-- Start XP Row -->
                    <div class="row">
                        <!-- Start XP Col -->
                        <div class="col-2 col-md-1 col-lg-1 order-2 order-md-1 align-self-center">
                            <div class="xp-menubar">
                                <a class="xp-menu-hamburger" href="javascript:void();">
                                   <i class="icon-menu font-20 text-black"></i>
                                 </a>
                             </div>
                             
                        </div> 
                        <!-- End XP Col -->
                        <!-- Start XP Col -->
                        <div class="col-2 col-md-2 col-lg-2 order-2 order-md-1">
                            <a href="{{ route('home') }}" class="xp-logo logo-center"><img src="/assets/images/logo-ppsdm-tr.png" width="80%" class="img-fluid" alt="logo"></a>
                        
                        </div> 
                        <!-- End XP Col -->
                        <!-- Start XP Col -->
                        <div class="col-10 col-md-9 col-lg-9 order-1 order-md-2">
                            <div class="xp-profilebar text-right">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <h6>{{ Auth::user()->role->pokja->pokja ?? null }} - {{ Auth::user()->role->deskripsi ?? null }}</h6>
                                    </li>
                                    <li class="list-inline-item mr-0">
                                        <div class="dropdown xp-userprofile">
                                            <a class="dropdown-toggle" href="#" role="button" id="xp-userprofile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="/assets/images/esdm-icon.ico" alt="user-profile" class="rounded-circle img-fluid"><span class="xp-user-live"></span></a>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="xp-userprofile">
                                                <a class="dropdown-item py-3 text-black text-center font-16" href="#">Hallo, {{ Auth::user()->name ?? null }} !</a>
                                                <a class="dropdown-item" href="#"><i class="icon-user text-primary mr-2"></i> Profile</a>
                                                <a class="dropdown-item" href="#"><i class="icon-settings text-warning mr-2"></i> Setting</a>
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                                    <i class="icon-power text-danger mr-2"></i> Logout</a>
                                            </div>
                                        </div>                                   
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- End XP Col -->
                    </div> 
                    <!-- End XP Row -->
                </div>
                <!-- End XP Topbar -->

                @if (session()->has('warning'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Peringatan !</strong> 
                        {{ session()->get('warning') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>    
                @endif

                @if (session()->has('failed'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Gagal !</strong> 
                        {{ session()->get('failed') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>    
                @endif
                @yield('content')
                <!-- Start XP Footerbar -->
                <div class="xp-footerbar">
                    <footer class="footer">
                        <p class="mb-0">© 2023 Dashboard PPSDM Aparatur - All Rights Reserved.</p>
                    </footer>
                </div>
                <!-- End XP Footerbar -->
            </div> 
            <!-- End XP Rightbar -->  
        </div>
        <!-- End XP Container -->
        <!-- Start JS -->        
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
        <script src="{{ asset('assets/js/detect.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
        @yield('script')
        <!-- Main JS -->
        <script src="{{ asset('assets/js/main.js') }}"></script>
        <!-- End JS -->
    </body>
</html>    