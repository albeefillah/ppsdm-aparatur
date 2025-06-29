<div class="xp-leftbar">
    <!-- Start XP Sidebar -->
    <div class="xp-sidebar" style="width: 100%;">
        <!-- Start XP Logobar -->
        <div class="xp-logobar text-center">
            <a href="{{ route('home') }}" class="xp-logo"><img src="/assets/images/logo-ppsdm-tr.png" width="80%" class="img-fluid" alt="logo"></a>
        </div>
        <!-- End XP Logobar -->
        <!-- Start XP Navigationbar -->
        <div class="xp-navigationbar">
            <ul class="xp-vertical-menu">
                <li class="{{ (request()->is('home*')) ? 'active' : '' }}">
                    <a href="{{ route('home') }}">
                      <i class="icon-speedometer"></i><span>Dashboard</span>
                  </a>
                </li>
                @if (auth()->check() && (auth()->user()->can('isKapus') || auth()->user()->can('isSuperadmin')))
                    <li class="xp-vertical-header">Master Data</li>
        
                    <li class="{{ (request()->is('user*')) ? 'active' : '' }}">
                        <a href="{{ route('user.index') }}">
                        <i class="icon-user"></i><span>Data User</span>
                    </a>
                    </li>
                @endif

                @if (auth()->check() && auth()->user()->role->role !== 'CS')
                    <li class="xp-vertical-header">Applications / Dashboard</li>

                    <li class="{{ (request()->is('sppd/')) ? 'active' : '' }}">
                        <a href="{{ route('sppd.index') }}">
                            <i class="icon-book-open"></i><span>Perjadin</span>
                        </a>
                    </li>
                    
                    <li class="{{ (request()->is('profile-kepeg/')) ? 'active' : '' }}">
                        <a href="{{ route('profile-kepeg.index') }}">
                            <i class="icon-people"></i><span>Kepegawaian ESDM</span>
                        </a>
                    </li>
                @endif

                @if (auth()->check() && (auth()->user()->can('isKapus') || auth()->user()->can('isSuperadmin')))
                <li class="{{ (request()->is('keuangan/')) ? 'active' : '' }}">
                    <a href="{{ route('keuangan.index') }}">
                        <i class="ti-money"></i><span>Keuangan</span>
                    </a>
                </li>
                <li class="{{ (request()->is('kurikulum/')) ? 'active' : '' }}">
                    <a href="{{ route('kurikulum.index') }}">
                        <i class="ti-layout-media-left"></i><span>Kurikulum</span>
                    </a>
                </li>


                @endif
                
                @if (auth()->check() && (auth()->user()->can('isKapus') || auth()->user()->can('isSuperadmin') || auth()->user()->can('isCS')))
                    <li class="{{ (request()->is('os/')) ? 'active' : '' }}">
                        <a href="javaScript:void();">
                            <i class="mdi mdi-account-group"></i><span>Mnj. Outsourcing</span><i class="icon-arrow-right pull-right"></i>
                        </a>
                        <ul class="xp-vertical-submenu">                                
                            <li><a href="{{ route('employee.index') }}">List Pegawai</a></li>         
                            <li><a href="{{ route('jobs.index') }}">List Job</a></li>         
                            <li><a href="{{ route('holiday.index') }}">List Holiday</a></li>         
                            <li><a href="{{ route('os.index') }}">Monitoring Jadwal</a></li>         
                            {{-- <li><a href="{{ route('monitoring.index') }}">Monitoring Jadwal</a></li>          --}}
                        </ul>
                    </li>
                @endif


            </ul>
        </div>
        <!-- End XP Navigationbar -->
    </div>
    <!-- End XP Sidebar -->
</div>