
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

    .r1p
    {
    background-color: #cce5ff;
    /* Primary - Biru */
    }

    .r2p {
        background-color: #dd68ec;
        /* Primary - Biru */
    }

    .r3p {
        background-color: #5db4fc;
        /* Primary - Biru */
    }

    .r4p {
        background-color: #c1c0fc;
        /* Primary - Biru */
    }

    .k1p, .k1s {
        background-color: #f9ccff;
        /* Primary - Biru */
    }

    .k2p, .k2s {
        background-color: #f8b1c9;
        /* Primary - Biru */
    }

    .k3p, .k3s {
        background-color: #fa6eb4;
        /* Primary - Biru */
    }

    .k4p, .k4s {
        background-color: #c4fdc4;
        /* Primary - Biru */
    }

    .ld {
        background-color: #40f058;
        /* Primary - Biru */
    }

    .sd {
        background-color: #f7cb3c;
        /* Primary - Biru */
    }

    .obm, .obsr, .obs {
        background-color: #f0ed4d;
        /* Primary - Biru */
    }

    .lds {
        background-color: #b4b4b4;
        /* Secondary - Hijau */
    }

    .fop, .fom, .fosr {
        background-color: #faa21f;
        /* Secondary - Hijau */
    }

    .mbs {
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

    .bq {
        background-color: #f56666;
        /* Banquet - Abu */
    }

    .off {
        background-color: #f5f5f5;
        /* Libur - Abu Muda */
        color: #ee3434;
    }

    .scroll-table-wrapper {
        overflow-x: auto;
        /* white-space: nowrap; */
        border: 1px solid #ddd;
        max-width: 100%;
    }

    table {
        border-collapse: collapse;
        width: max-content;
        box-sizing: border-box;
    }

    th, td {
        border: 1px solid #ccc;
        padding: 4px 8px;
        white-space: nowrap;
        background-color: white;
    }

    /* Header freeze */
    thead th {
        position: sticky;
        top: 0;
        z-index: 10;
        background-color: #3674B5 !important;
        color: white;
    }

    /* Kolom Freeze: NO */
    .sticky-col.no-col {
        position: sticky;
        left: 0;
        z-index: 20;
        background-color: white;
        width: 40px;
        min-width: 40px;
        max-width: 40px;
    }

    /* Kolom Freeze: Nama CS */
    .sticky-col-2.name-col {
        position: sticky;
        left: 40px; /* harus sesuai total kolom sebelumnya */
        z-index: 20;
        background-color: white;
        width: 180px;
        min-width: 180px;
        max-width: 180px;
    }



     /* Tambahan opsional agar scroll lebih smooth */
     .scroll-table-wrapper::-webkit-scrollbar {
        height: 8px;
    }

    .scroll-table-wrapper::-webkit-scrollbar-thumb {
        background-color: #aaa;
        border-radius: 10px;
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

  
</style>
@endsection 
@section('content')
<!-- Start XP Breadcrumbbar -->                    
<div class="xp-breadcrumbbar">
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <h4 class="xp-page-title ml-3 mb">Jadwal Piket Outsourcing</h4>
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

{{-- Tabel Monitoring Jadwal --}}

  <!-- Start XP Col -->
  <div class="xp-contentbar">
      <div class="col-lg-12">
          <div class="card m-b-30">
              <div class="card-header bg-white">
                  {{-- <h4 class=" text-center text-black">Jadwal Piket CS Tahun 2025</h4> --}}
              </div>
          
              <div class="card-body" style="font-size: 10px">
                  <div class="table-responsive">
                      <div class="scroll-table-wrapper drag-scroll">
                          <table class="table table-bordered table-sm table-striped" style="min-width: max-content;">
                              <thead class="table-dark">
                                  <!-- Baris 1: Bulan -->
                                  <tr>
                                      <th rowspan="3" class="sticky-col no-col text-center align-middle">No</th>
                                      <th rowspan="3" class="sticky-col-2 name-col text-center align-middle">Nama CS</th>
                                      @php
                                      $groupedDates = collect($dates)->groupBy(function ($date) {
                                      return \Carbon\Carbon::parse($date)->translatedFormat('F Y');
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
                                    <td class="sticky-col no-col text-center">{{ $index + 1 }}</td>
                                    <td class="sticky-col-2 name-col text-start">{{ $employee->name }}</td>
                                    
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


{{-- Tabel Filter Data Piket --}}

<!-- Start XP Contentbar -->    
   
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

    <div class="col-lg-12">
        {{-- Card Filter --}}
        <div class="card mb-3">
            <div class="card-body">
                <form class="row g-3">
                    <div class="col-md-3">
                        <label for="filter-tanggal" class="form-label">Filter Tanggal</label>
                        <input type="date" id="filter-tanggal" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label for="filter-bulan" class="form-label">Filter Bulan</label>
                        <select id="filter-bulan" class="form-control">
                            <option value="">-- Semua Bulan --</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}">{{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="filter-job" class="form-label">Filter Job</label>
                        <select id="filter-job" class="form-control">
                            <option value="">-- Semua Job --</option>
                            @foreach($jobs as $job)
                                <option value="{{ $job->id }}">{{ $job->code }} - {{ $job->name }}</option>
                            @endforeach
                            <option value="off">OFF</option> <!-- Tambahan untuk OFF -->
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="filter-job" class="form-label">Search Nama</label>
                        <input type="text" id="filter-nama" class="form-control mb-2" placeholder="Cari Nama Pegawai...">
                    </div>
                    
                </form>
                <div class="row">
                    <div class="pl-3 pt-3">
                        <!-- Button trigger modal -->
                        <a href="{{ route('os.form-generate') }}" class="btn btn-secondary">
                            <i class="fa fa-gear"> </i> Generate Jadwal
                        </a>
                        <!-- Modal -->
                        {{-- <form action="{{ route('os.generate') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal fade" id="generateJadwal" tabindex="-1" role="dialog" aria-labelledby="generateJadwalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="generateJadwalLabel">Isi Bulan dan Tahun </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="number" class="form-control" min="1" max="12" name="month" placeholder="Bulan" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="number" class="form-control" min="2020" name="year" placeholder="Tahun" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
                                            <button type="submit" class="btn btn-secondary">Generate Jadwal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form> --}}
                    </div>
                    <div class="pl-3 pt-3">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleStandardModal">
                            <i class="ti-import"> </i> Import Excel
                        </button>
                        <!-- Modal -->
                        <form action="{{ route('os.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal fade" id="exampleStandardModal" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleStandardModalLabel">Upload File</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="file"  class="form-control" name="file" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                            <button type="submit" class="btn btn-info">Import</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
    
                    <div class="pl-3 pt-3">
                        <a href="{{ route('os.export') }}" class="btn btn-success"> <i class="ti-export"> </i> Export Excel</a>
                    </div>
                    <div class="pl-3 pt-3">
                        <button type="button" id="reset-filter" class="btn btn-warning mb-2">Reset Filter</button>
                    </div>
                    <div class="pl-3 pt-3">
                        <label for=""></label>
                    </div>
                </div>
                

            </div>
        </div>
        
      
        
        <div class="row">
            <div class="col-md-8">
                <div class="card m-b-30">
                    <div class="card-header bg-white">
                        <div class="row ml-2">
                            <h5 class="card-title text-black">Data Piket</h5>
                            <div class="xp-badge ml-2">
                               {{-- <h6> <a href="#" id="job-count-badge-utama" class="badge badge-dark">0</a>     </h6>                                --}}
                            </div>               
                        </div>
                    </div>
                
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="xp-default-datatable" class="table table-sm table-striped table-bordered w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nama Pegawai</th>
                                        <th>Pekerjaan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card m-b-30">
                    <div class="card-header bg-white">
                        <div class="row ml-2">
                            <h5 class="card-title text-black">Jenis Pekerjaan (Job)</h5>
                            <div class="xp-badge ml-2">
                               <h6> <a href="#" id="job-count-badge" class="badge badge-dark">0</a>     </h6>                               
                            </div>               
                        </div>
                    </div>
                
                    <div class="card-body p-2">
                            <!-- TABEL JOB SUMMARY -->
                            <div class="table-responsive" style="overflow-x: auto; height:240px;">
                                <table id="summary-table" class="table table-sm table-striped">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Job</th>
                                            <th>Deskripsi</th>
                                            <th>Jml Pegawai</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
        
                    </div>
                </div>
                <div class="card m-b-30">
                    <div class="card-header bg-white">
                        <div class="row ml-2">
                            <h5 class="card-title text-black">List Pegawai</h5>
                            <div class="xp-badge ml-2">
                               <h6> <a href="#" id="job-count-badge-employee" class="badge badge-dark">0</a>     </h6>                               
                            </div>               
                        </div>
                    </div>
                
                    <div class="card-body p-2">
                            <!-- TABEL PEGAWAI TERLIBAT -->
                            <div class="table-responsive" style="overflow-x: auto; height:240px;">
                                <table id="employee-table" class="table table-sm table-striped">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pegawai</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
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
    $(document).ready(function() {
        loadSummary();
        loadEmployees();
         // 🟢 Update badge jumlah data
        let table = $('#xp-default-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('os.index') }}",
                data: function (d) {
                    d.tanggal = $('#filter-tanggal').val();
                    d.bulan = $('#filter-bulan').val();
                    d.job = $('#filter-job').val();
                    d.nama = $('#filter-nama').val(); 
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'tanggal', name: 'tanggal' },
                { data: 'nama_pegawai', name: 'nama_pegawai' },
                { data: 'pekerjaan', name: 'pekerjaan' },
                { data: 'aksi', name: 'aksi', orderable: false, searchable: false }
            ]
        });

        // Reload table setiap filter berubah
        $('#filter-tanggal, #filter-bulan, #filter-job, #filter-nama').on('change keyup', function() {
            table.ajax.reload();
            loadSummary();
            loadEmployees();
        });


        // Reset Filter
        $('#reset-filter').on('click', function () {
        $('#filter-nama').val('');
        $('#filter-tanggal').val('');
        $('#filter-bulan').val('');
        $('#filter-job').val('');
        table.ajax.reload();
        loadSummary();
        loadEmployees();
        });
    });



    function loadSummary() {
    $.ajax({
        url: "{{ route('os.summary') }}",
        data: {
            tanggal: $('#filter-tanggal').val(),
            bulan: $('#filter-bulan').val(),
            job: $('#filter-job').val(),
            nama: $('#filter-nama').val()
        },
        success: function (data) {
            let tbody = $('#summary-table tbody');
            tbody.empty();
            // 🟢 Update badge jumlah data
            $('#job-count-badge').text(data.length);

            if (data.length === 0) {
                tbody.append('<tr><td colspan="3" class="text-center">Tidak ada data</td></tr>');
            } else {
                data.forEach((item, index) => {
                    tbody.append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.kode_job}</td>
                            <td>${item.deskripsi}</td>
                            <td>${item.jumlah}</td>
                        </tr>
                    `);
                });
            }
        }
    });
    }

    function loadEmployees() {
    $.ajax({
        url: "{{ route('os.employee-list') }}", // Buat route baru ya
        data: {
            tanggal: $('#filter-tanggal').val(),
            bulan: $('#filter-bulan').val(),
            job: $('#filter-job').val(),
            nama: $('#filter-nama').val()
        },
        success: function (data) {
            let tbody = $('#employee-table tbody');
            tbody.empty();

              // 🟢 Update badge jumlah data
            $('#job-count-badge-employee').text(data.length);
             
            if (data.length === 0) {
                tbody.append('<tr><td colspan="2" class="text-center">Tidak ada pegawai</td></tr>');
            } else {
                data.forEach((item, index) => {
                    tbody.append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.name}</td>
                        </tr>
                    `);
                });
            }
        }
    });
}

</script>
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