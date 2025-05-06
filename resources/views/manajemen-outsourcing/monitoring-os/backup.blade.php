@section('title')
PPSDM Aparatur - User
@endsection
@extends('layouts.main')
@section('style')
<!-- DataTables CSS -->
<link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Sweet Alert -->
<link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    .cell {
        padding: 2px;
        text-align: center;
        font-weight: bold;
    }

    .r1,
    {
    background-color: #cce5ff;
    /* Primary - Biru */
    }

    .r2\+ {
        background-color: #dd68ec;
        /* Primary - Biru */
    }

    .r3\+ {
        background-color: #5db4fc;
        /* Primary - Biru */
    }

    .r4 {
        background-color: #c1c0fc;
        /* Primary - Biru */
    }

    .k1 {
        background-color: #f9ccff;
        /* Primary - Biru */
    }

    .k2 {
        background-color: #f8b1c9;
        /* Primary - Biru */
    }

    .k3 {
        background-color: #fa6eb4;
        /* Primary - Biru */
    }

    .k4\+ {
        background-color: #c4fdc4;
        /* Primary - Biru */
    }

    .ld {
        background-color: #40f058;
        /* Primary - Biru */
    }

    .fom {
        background-color: #f7cb3c;
        /* Primary - Biru */
    }

    .obm {
        background-color: #f0ed4d;
        /* Primary - Biru */
    }

    .lds {
        background-color: #b4b4b4;
        /* Secondary - Hijau */
    }

    .fop {
        background-color: #faa21f;
        /* Secondary - Hijau */
    }

    .bs {
        background-color: #6188c2;
        /* Secondary - Hijau */
    }

    .gd {
        background-color: #ffeeba;
        /* Garden - Kuning */
    }

    .rrp {
        background-color: #f5bcc1;
        /* Women - Pink */
    }

    .dm1 {
        background-color: #64a25c;
        /* Women - Pink */
    }

    .dm2 {
        background-color: #d17272;
        /* Women - Pink */
    }

    .bq {
        background-color: #f56666;
        /* Banquet - Abu */
    }

    .off {
        background-color: #f5f5f5;
        /* Libur - Abu Muda */
        color: #ee3434;
    }

    /* Wrapper scroll horizontal */
    .scroll-table-wrapper {
        overflow-x: auto;
        white-space: nowrap;
        max-width: 100%;
    }

    th.month-end,
    td.month-end {
        border-right: 2px solid #000 !important;
    }

    .drag-scroll {
        overflow-x: auto;
        cursor: grab;
    }

    .drag-scroll:active {
        cursor: grabbing;
    }



    /* td.sticky-col {
        position: sticky;
        left: 0;
        background: white;
        z-index: 5;
        border-right: 2px solid #ccc;
    } 
     */

    /* Freeze kolom pertama (No) */
    /* th.sticky-col,
     td.sticky-col {
        position: sticky;
        left: 0;
        background: white;
        z-index: 5;
        border-right: 2px solid #ccc;
    } 

    /* Freeze kolom kedua (Nama) */
    /* th.sticky-col-2,
    td.sticky-col-2 {
        position: sticky;
        left: 40px; 
        background: white;
        z-index: 5;
        border-right: 2px solid #ccc;
    } */

    /* Freeze header (opsional) */
    /* thead th {
        position: sticky;
        top: 0;
        background: #e9ecef;
        z-index: 3;
    } */
</style>
@endsection
@section('content')
<!-- Start XP Breadcrumbbar -->
<div class="xp-breadcrumbbar">
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <h4 class="xp-page-title ml-3">Monitoring Jadwal Piket CS 2025</h4>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="xp-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Outsourcing</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- End XP Breadcrumbbar -->


<!-- Start XP Contentbar -->
<div class="xp-contentbar">

    {{-- Alert Validation --}}
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Sukses !</strong>
        {{ session()->get('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif


    <!-- Start XP Col -->
    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-header bg-white">
                {{-- <h4 class=" text-center text-black">Jadwal Piket CS Tahun 2025</h4> --}}
            </div>
            <div class="pl-5">
                <!-- Button trigger modal -->
                <a href="{{ route('os.index') }}" class="btn btn-success">
                    <i class="ti-calendar"> </i> Generate Jadwal
                </a>
            </div>
            <div class="card-body" style="font-size: 10px">
                <div class="table-responsive">
                    <div class="scroll-table-wrapper drag-scroll">
                        <table class="table table-bordered table-sm table-striped" style="min-width: max-content;">
                            <thead class="table-dark">
                                <!-- Baris 1: Bulan -->
                                <tr>
                                    <th rowspan="3" style="min-width: 40px;" class="text-center align-middle sticky-col">No</th>
                                    <th rowspan="3" style="min-width: 180px;" class="text-center align-middle sticky-col-2">Nama CS</th>
                                    @php
                                    $groupedDates = collect($dates)->groupBy(function ($date) {
                                    return \Carbon\Carbon::parse($date)->format('F Y');
                                    });
                                    $monthEndDates = $groupedDates->map(function ($group) {
                                    return \Carbon\Carbon::parse($group->last())->format('Y-m-d');
                                    })->values()->toArray();
                                    @endphp
                                    @foreach ($groupedDates as $monthName => $datesInMonth)
                                    @php
                                    $lastDate = \Carbon\Carbon::parse($datesInMonth->last())->format('Y-m-d');
                                    $monthClass = in_array($lastDate, $monthEndDates) ? 'month-end' : '';
                                    @endphp
                                    <th colspan="{{ $datesInMonth->count() }}" class="text-center text-black {{ $monthClass }}"
                                        style="font-size: 15px; background:#c4fdc4;">
                                        {{ $monthName }}
                                    </th>
                                    @endforeach
                                </tr>

                                <!-- Baris 2: Tanggal -->
                                <tr>
                                    @foreach ($dates as $date)
                                    @php
                                    $carbonDate = \Carbon\Carbon::parse($date);
                                    $isHoliday = in_array($date, $holidays ?? []);
                                    $isWeekend = in_array($carbonDate->dayOfWeek, [Carbon\Carbon::SATURDAY, Carbon\Carbon::SUNDAY]);
                                    $holidayClass = ($isHoliday || $isWeekend) ? 'bg-danger text-white' : '';
                                    $borderClass = in_array($date, $monthEndDates) ? 'month-end' : '';
                                    @endphp
                                    <th class="text-center {{ $holidayClass }} {{ $borderClass }}">
                                        {{ $carbonDate->format('j') }}
                                    </th>
                                    @endforeach
                                </tr>

                                <!-- Baris 3: Hari -->
                                <tr>
                                    @foreach ($dates as $date)
                                    @php
                                    $carbonDate = \Carbon\Carbon::parse($date);
                                    $dayName = $carbonDate->translatedFormat('D'); // Atau 'l' untuk nama lengkap
                                    $isHoliday = in_array($date, $holidays ?? []);
                                    $isWeekend = in_array($carbonDate->dayOfWeek, [Carbon\Carbon::SATURDAY, Carbon\Carbon::SUNDAY]);
                                    $holidayClass = ($isHoliday || $isWeekend) ? 'bg-danger text-white' : '';
                                    $borderClass = in_array($date, $monthEndDates) ? 'month-end' : '';
                                    @endphp
                                    <th class="text-center {{ $holidayClass }} {{ $borderClass }}">
                                        {{ $dayName }}
                                    </th>
                                    @endforeach
                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($employees as $index => $employee)
                                <tr>
                                    <td class="sticky-col text-center">{{ $index + 1 }}</td>
                                    <td class="sticky-col-2 text-start">{{ $employee->name }}</td>
                                    @foreach ($dates as $date)
                                    @php
                                    $schedule = $employee->schedules->first(function ($item) use ($date) {
                                    return \Carbon\Carbon::parse($item->work_date)->format('Y-m-d') === $date;
                                    });

                                    $jobCode = $schedule?->job?->code ?? 'OFF';

                                    $borderClass = in_array($date, $monthEndDates) ? 'month-end' : '';
                                    @endphp

                                    <td class="cell {{ strtolower($jobCode) }} {{ $borderClass }}">
                                        {{ $jobCode }}
                                    </td>
                                    @endforeach


                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
<!-- Required Datatable JS -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/init/table-datatable-init.js') }}"></script>

<!-- Sweet-Alert JS -->
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/js/init/sweet-alert-init.js') }}"></script>
<script>
    document.querySelectorAll('.drag-scroll').forEach(function(el) {
        let isDown = false;
        let startX;
        let scrollLeft;

        el.addEventListener('mousedown', (e) => {
            isDown = true;
            el.classList.add('active');
            startX = e.pageX - el.offsetLeft;
            scrollLeft = el.scrollLeft;
        });

        el.addEventListener('mouseleave', () => {
            isDown = false;
            el.classList.remove('active');
        });

        el.addEventListener('mouseup', () => {
            isDown = false;
            el.classList.remove('active');
        });

        el.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - el.offsetLeft;
            const walk = (x - startX) * 2; // bisa diubah speed-nya
            el.scrollLeft = scrollLeft - walk;
        });
    });
</script>

@endsection