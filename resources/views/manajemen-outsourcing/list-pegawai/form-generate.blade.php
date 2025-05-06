@section('title') 
PPSDM Aparatur - Generate Jadwal Otomatis
@endsection 
@extends('layouts.main')
@section('style')
<style>
    .pagiClass{
        background-color: #A0C3D2;
    }
    .siangClass{
        background-color: #EAC7C7;
    }
    .soreClass{
        background-color: #EDC6B1;
    }
    .malamClass{
        background-color: #B7B7B7;
    }
</style>
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
                    <li class="breadcrumb-item"><a href="{{ route('os.index') }}">Data Piket</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Generate Jadwal</li>
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
                <h5 class="card-title text-black">Form Generate</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <button type="button" class="btn btn-success btn-sm" onclick="checkAll()">Check Semua</button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="uncheckAll()">Uncheck Semua</button>
                    <button type="button" class="btn btn-info btn-sm" onclick="restoreLastChecked()">Check Terakhir</button>
                </div>
                
                <form method="POST" action="{{ route('os.generate') }}" onsubmit="return Validation()" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="Bulan">Bulan</label>
                                <select name="month" id="month" class="form-control" required>
                                    <option value="">Pilih Bulan</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tahu">Tahun</label>
                                <input type="number" class="form-control" min="2020" name="year" placeholder="Tahun" required>
                            </div>
                        </div>
                    </div>
                    <div style="font-size: 15px;">
                        <p>Tentukan Job untuk Pegawai :</p>
                    </div>
                    <div class="table-responsive m-b-30">
                        <table class="table table-sm table-striped table-bordered" style="border: 1px solid black">
                            <thead>
                                <tr style="background-color: #DBDBDB">
                                    <th rowspan="2" class="text-center align-middle">No</th>
                                    <th rowspan="2" class="text-center align-middle">Nama</th>
                                    <th colspan="{{ $pagiJobs->count() }}" class="text-center pagiClass">Pagi</th>
                                    <th colspan="{{ $siangJobs->count() }}" class="text-center siangClass">Siang</th>
                                    <th colspan="{{ $soreJobs->count() }}" class="text-center soreClass">Sore</th>
                                    <th colspan="{{ $malamJobs->count() }}" class="text-center malamClass">Malam</th>
                                    <th rowspan="2" class="text-center align-middle"> <center>Jml</center></th>
                                </tr>
                                <tr class="text-center">
                                    @foreach ($pagiJobs as $job)
                                        <th class="pagiClass">{{ $job->code }}</th>
                                    @endforeach
                                    @foreach ($siangJobs as $job)
                                        <th class="siangClass">{{ $job->code }}</th>
                                    @endforeach
                                    @foreach ($soreJobs as $job)
                                        <th class="soreClass">{{ $job->code }}</th>
                                    @endforeach
                                    @foreach ($malamJobs as $job)
                                        <th class="malamClass">{{ $job->code }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employee as $index => $emp)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $emp->name }}</td>
                                        {{-- Loop Pagi --}}
                                        @foreach ($pagiJobs  as $job)
                                            <td>
                                                <center>
                                                    <input 
                                                        style="width:15px; height:15px;"
                                                        type="checkbox" 
                                                        class="job-checkbox"
                                                        data-employee="{{ $emp->id }}"
                                                        data-job="{{ $job->id }}"
                                                        name="job_eligibility[{{ $emp->id }}][]" 
                                                        value="{{ $job->id }}" {{ in_array($job->id, $emp->allowed_jobs ?? []) ? 'checked' : '' }}
                                                        
                                                    >
                                                </center>
                                            </td>
                                        @endforeach

                                        {{-- Loop Siang --}}
                                        @foreach ($siangJobs  as $job)
                                            <td>
                                                <center>
                                                    <input 
                                                        style="width:15px; height:15px;"
                                                        type="checkbox" 
                                                        class="job-checkbox"
                                                        data-employee="{{ $emp->id }}"
                                                        data-job="{{ $job->id }}"
                                                        name="job_eligibility[{{ $emp->id }}][]" 
                                                        value="{{ $job->id }}" {{ in_array($job->id, $emp->allowed_jobs ?? []) ? 'checked' : '' }}
                                                        
                                                    >
                                                </center>
                                            </td>
                                        @endforeach

                                        {{-- Loop Sore --}}
                                        @foreach ($soreJobs  as $job)
                                            <td>
                                                <center>
                                                    <input 
                                                        style="width:15px; height:15px;"
                                                        type="checkbox" 
                                                        class="job-checkbox"
                                                        data-employee="{{ $emp->id }}"
                                                        data-job="{{ $job->id }}"
                                                        name="job_eligibility[{{ $emp->id }}][]" 
                                                        value="{{ $job->id }}" {{ in_array($job->id, $emp->allowed_jobs ?? []) ? 'checked' : '' }}
                                                        
                                                    >
                                                </center>
                                            </td>
                                        @endforeach

                                        {{-- Loop Malam --}}
                                        @foreach ($malamJobs  as $job)
                                            <td>
                                                <center>
                                                    <input 
                                                        style="width:15px; height:15px;"
                                                        type="checkbox" 
                                                        class="job-checkbox"
                                                        data-employee="{{ $emp->id }}"
                                                        data-job="{{ $job->id }}"
                                                        name="job_eligibility[{{ $emp->id }}][]" 
                                                        value="{{ $job->id }}" {{ in_array($job->id, $emp->allowed_jobs ?? []) ? 'checked' : '' }}
                                                        
                                                    >
                                                </center>
                                            </td>
                                        @endforeach
                                        <td class="count-col text-center" id="count-{{ $emp->id }}" data-employee="{{ $emp->id }}" style="background-color: #DBDBDB;">0</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="text-center fw-bold" style="background-color: #DBDBDB;"><b>Jumlah</b></td>
                                    @foreach ($pagiJobs as $job)
                                        <th class="text-center" style="background-color: #DBDBDB;"><span id="total-job-{{ $job->id }}">0</span></th>
                                    @endforeach
                                    @foreach ($siangJobs as $job)
                                        <th class="text-center" style="background-color: #DBDBDB;"><span id="total-job-{{ $job->id }}">0</span></th>
                                    @endforeach
                                    @foreach ($soreJobs as $job)
                                        <th class="text-center" style="background-color: #DBDBDB;"><span id="total-job-{{ $job->id }}">0</span></th>
                                    @endforeach
                                    @foreach ($malamJobs as $job)
                                        <th class="text-center" style="background-color: #DBDBDB;"><span id="total-job-{{ $job->id }}">0</span></th>
                                    @endforeach
                                    <th class="text-center" style="background-color: #DBDBDB;">-</th> <!-- Untuk kolom "Jumlah" per baris -->
                                </tr>
                            </tfoot>
                            
                        </table>
                    </div>

                   
                  <a href="{{ route('os.index') }}" class="btn btn-secondary">Kembali</a>
                  <button type="submit" class="btn btn-warning"> <i class="fa fa-gear"></i> Generate Jadwal</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End XP Contentbar -->
@endsection 
@section('script')
<script>
    // ✅ Fungsi global
    function updateCounts() {
        const rowCounts = {};
        const colCounts = {};

        document.querySelectorAll('input.job-checkbox').forEach(cb => {
            const employeeId = cb.dataset.employee;
            const jobId = cb.dataset.job;

            if (!rowCounts[employeeId]) rowCounts[employeeId] = 0;
            if (!colCounts[jobId]) colCounts[jobId] = 0;

            if (cb.checked) {
                rowCounts[employeeId]++;
                colCounts[jobId]++;
            }
        });

        // Update per baris (pegawai)
        Object.entries(rowCounts).forEach(([empId, count]) => {
            const el = document.getElementById(`count-${empId}`);
            if (el) el.innerText = count;
        });

        document.querySelectorAll('.count-col').forEach(el => {
            const empId = el.dataset.employee;
            if (!rowCounts[empId]) el.innerText = '0';
        });

        // Update per kolom (job)
        Object.entries(colCounts).forEach(([jobId, count]) => {
            const el = document.getElementById(`total-job-${jobId}`);
            if (el) el.innerText = count;
        });

        document.querySelectorAll('.total-job-cell').forEach(el => {
            const jobId = el.dataset.job;
            if (!colCounts[jobId]) el.innerText = '0';
        });
    }

    // ✅ DOM loaded: hanya untuk pasang event listener
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('input.job-checkbox').forEach(cb => {
            cb.addEventListener('change', updateCounts);
        });

        updateCounts(); // run on load
    });

    // ✅ Fungsi tombol
    function checkAll() {
        document.querySelectorAll('.job-checkbox').forEach(cb => cb.checked = true);
        updateCounts();
    }

    function uncheckAll() {
        document.querySelectorAll('.job-checkbox').forEach(cb => cb.checked = false);
        updateCounts();
    }

    function restoreLastChecked() {
        const lastCheckedMap = @json($employee->mapWithKeys(function($e) {
            return [$e->id => $e->allowed_jobs];
        }));

        document.querySelectorAll('.job-checkbox').forEach(cb => {
            const empId = cb.dataset.employee;
            const jobId = cb.dataset.job;
            cb.checked = lastCheckedMap[empId] && lastCheckedMap[empId].includes(parseInt(jobId));
        });

        updateCounts();
    }
</script>



@endsection 