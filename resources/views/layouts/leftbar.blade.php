<div class="xp-leftbar">
    <!-- Start XP Sidebar -->
    <div class="xp-sidebar">
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
                <li class="xp-vertical-header">Applications / Dashboard</li>
                <li class="{{ (request()->is('profile-kepeg/')) ? 'active' : '' }}">
                    <a href="{{ route('sppd.index') }}">
                        <i class="icon-book-open"></i><span>Perjadin</span>
                    </a>
                </li>

                @if (auth()->check() && (auth()->user()->can('isKapus') || auth()->user()->can('isSuperadmin')))
                <li class="{{ (request()->is('sppd/')) ? 'active' : '' }}">
                    <a href="{{ route('profile-kepeg.index') }}">
                        <i class="icon-people"></i><span>Profile Kepegawaian</span>
                    </a>
                </li>
                @endif


            </ul>
        </div>
        <!-- End XP Navigationbar -->
    </div>
    <!-- End XP Sidebar -->
</div>