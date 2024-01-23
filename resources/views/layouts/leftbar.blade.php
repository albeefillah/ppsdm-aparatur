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

                @can('isKeuangan')
                <li class="xp-vertical-header">Master Data</li>

                <li>
                    <a href="{{ route('user.index') }}">
                      <i class="icon-people"></i><span>Data User</span>
                  </a>
                </li>
               
                <li {{ (request()->is('program-ppsdm*')) ? 'active' : '' }}>
                  <a href="javaScript:void();">
                    <i class="icon-event"></i><span>Program PPSDM</span><i class="icon-arrow-right pull-right"></i>
                  </a>
                  <ul class="xp-vertical-submenu">
                      <li><a href="{{ route('kegiatan-program.index') }}">Kegiatan Program</a></li>
                      <li><a href="{{ route('kro.index') }}">Klasifikasi Rincian Output (KRO)</a></li>
                      <li><a href="{{ route('rincian-output.index') }}">Rincian Output</a></li>
                      <li><a href="{{ route('sub-komponen.index') }}">Sub Komponen</a></li>
                      <li><a href="{{ route('detail-komponen.index') }}">Detail Komponen</a></li>
                  </ul>
                </li>


                <li class="{{ (request()->is('mata-anggaran*')) ? 'active' : '' }}">
                    <a href="{{ route('mata_anggaran.index') }}">
                      <i class="icon-wallet"></i><span>Mata Anggaran</span>
                  </a>
                </li>

              @endcan
                <li class="xp-vertical-header">Fitur Menu</li>

                {{-- <li class="{{ (request()->is('spd*')) ? 'active' : '' }}">
                    <a href="{{ route('spd.index') }}">
                      <i class="icon-event"></i><span>SPPD</span>
                  </a>
                </li> --}}

                <li {{ (request()->is('rencana*')) ? 'active' : '' }}>
                    <a href="javaScript:void();">
                      @can('isKeuangan')
                      <i class="icon-layers"></i><span>RKAKL</span><i class="icon-arrow-right pull-right"></i>
                      @else
                      <i class="icon-layers"></i><span>Anggaran</span><i class="icon-arrow-right pull-right"></i>
                      @endcan
                    </a>
                    <ul class="xp-vertical-submenu">
                      @can('isKeuangan')
                        <li><a href="{{ route('rkakl.index') }}">RKAKL Awal (DIPA 0)</a></li>
                        <li><a href="{{url('/maintenance')}}">Data RKAKL</a></li>
                      @else
                        <li><a href="{{ route('rencana.index') }}">Rencana Anggaran</a></li>
                        <li><a href="{{url('/maintenance')}}">Rekap Anggaran</a></li>
                      @endcan
                    </ul>
                </li>

                @can('isKeuangan')
                <li>
                    <a href="{{url('/maintenance')}}">
                      <i class="icon-screen-desktop"></i><span>Monitoring BPA</span><i class="icon-arrow-right pull-right"></i>
                    </a>
                    <ul class="xp-vertical-submenu">
                        <li><a href="{{url('/maintenance')}}">BPAU</a></li>
                        <li><a href="{{url('/maintenance')}}">BPAS</a></li>
                        <li><a href="{{url('/maintenance')}}">BPAK</a></li>
                        <li><a href="{{url('/maintenance')}}">BPAP</a></li>
                    </ul>
                </li>
                <li  {{ (request()->is('pengawasan*')) ? 'active' : '' }}>
                    <a href="{{url('/maintenance')}}">
                      <i class="icon-book-open"></i><span>Pengawasan</span><i class="icon-arrow-right pull-right"></i>
                    </a>
                    <ul class="xp-vertical-submenu">
                        <li><a href="{{ route('realisasi.index') }}">Realisasi Anggaran</a></li>
                        <li><a href="{{url('/maintenance')}}">Sisa Anggaran</a></li>
                    </ul>
                </li>

                <li class="{{ (request()->is('spd*')) ? 'active' : '' }}">
                  <a href="{{url('/maintenance')}}">
                    <i class="icon-refresh"></i><span>Revisi</span>
                  </a>
                </li>

                <li class="{{ (request()->is('spd*')) ? 'active' : '' }}">
                    <a href="{{ route('spd.index') }}">
                      <i class="icon-folder-alt"></i><span>Laporan</span>
                  </a>
                </li>
                @endcan

            </ul>
        </div>
        <!-- End XP Navigationbar -->
    </div>
    <!-- End XP Sidebar -->
</div>