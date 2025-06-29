@section('title') 
PPSDM Aparatur - Ploting Spesial
@endsection 
@extends('layouts.main')
@section('style')
<!-- DataTables CSS -->
<link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Sweet Alert -->
<link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

@endsection 
@section('content')
<!-- Start XP Breadcrumbbar -->                    
<div class="xp-breadcrumbbar">
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <h4 class="xp-page-title ml-4">Penempatan Spesial Pegawai </h4>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="xp-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ploting Spesial</li>
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
            <div class="card-body">
                <form action="{{ route('os.special-plot-store') }}" method="POST" class="mb-4">
                    @csrf
                    <div class="row">
                        <div class="col-md-2">
                            <label>Tanggal</label>
                            <input type="date" name="target_date" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label>Pegawai</label>
                            <select name="employee_id" class="form-control" required>
                                <option value="">Pilih</option>
                                @foreach($employees as $emp)
                                    <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Job</label>
                            <select name="job_id" class="form-control" required>
                                <option value="">Pilih</option>
                                @foreach($jobs as $job)
                                    <option value="{{ $job->id }}">{{ $job->code }} - ({{ $job->name }})</option>
                                @endforeach
                            </select>
                        </div>
                       
                    </div>
                    <div class="form-group mt-2">
                        <label>Alasan</label>
                        {{-- <input type="text" name="reason" class="form-control"> --}}
                        <textarea name="reason" id="reason" cols="30" rows="10" placeholder="Tulis Keterangan" class="form-control"></textarea>
                    </div>
                    <button class="btn btn-success mt-3">Tambah Plotting</button>
                    <a href="{{ route('os.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                </form>
            </div>
        </div>
        <div class="card m-b-30">
            <div class="card-header bg-white">
                <h5 class="card-title text-black">Log Ploting Pegawai</h5>
            </div>
           
            <div class="card-body">
                <div class="table-responsive">
                    <table id="new-xp-default-datatable" class="table table-striped table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Pegawai</th>
                                <th>Tukar Job</th>
                                <th>Bertukar Dengan</th>
                                <th>Alasan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($plots as $plot)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($plot->target_date)->translatedFormat('d F Y')  }}</td>
                                    <td>{{ $plot->employee->name }}</td>
                                    <td>{{ $plot->previous_job_id ? ($plot->previousJob->code ?? 'OFF') : 'OFF' }}
                                         <i class="ti-exchange-vertical"></i> 
                                         {{ $plot->job->code }}</td>
                                    <td>{{ $plot->replacedEmployee->name ?? '-' }}</td>
                                    <td>{{ $plot->reason }}</td>
                                    <td>
                                        <a href="{{ route('os.special-plot-destroy', $plot->id) }}" class="btn btn-danger" id="xp-sa-warning"> <i class="fa fa-trash"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
@endsection 