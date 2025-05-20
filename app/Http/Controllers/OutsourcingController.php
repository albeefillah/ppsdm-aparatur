<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Outsourcing;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use App\Models\Holiday;
use App\Models\Job;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\DataTables;


class OutsourcingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Schedule::with(['employee', 'job'])
                ->orderBy('work_date', 'asc');

            // Filter berdasarkan tanggal
            if ($request->filled('tanggal')) {
                $data->whereDate('work_date', $request->tanggal);
            }

            // Filter berdasarkan bulan
            if ($request->filled('bulan')) {
                $data->whereMonth('work_date', $request->bulan);
            }

            // Filter berdasarkan job
            if ($request->filled('job')) {
                if ($request->job === 'off') {
                    $data->whereNull('job_id');
                } else {
                    $data->where('job_id', $request->job);
                }
            }

            // Filter berdasarkan nama
            if ($request->filled('nama')) {
                $data->whereHas('employee', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->nama . '%');
                });
            }


            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('tanggal', function ($row) {
                    return \Carbon\Carbon::parse($row->work_date)->format('Y-m-d');
                })
                ->addColumn('nama_pegawai', function ($row) {
                    return $row->employee->name;
                })
                ->addColumn('pekerjaan', function ($row) {
                    return $row->job->code ?? 'off';
                })
                ->addColumn('aksi', function ($row) {
                    $edit = route('os.edit', $row->id);
                    $delete = route('os.destroy', $row->id);
                    return '
                    <a href="' . $edit . '" class="btn btn-info"><i class="fa fa-pencil"></i></a>
                    <a href="' . $delete . '" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                ';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        // Data untuk select filter
        $jobs = Job::select('id', 'code', 'name')->get();

        $os = Schedule::with(['employee', 'job'])
            ->orderBy('work_date')
            ->get();

        $employees = Employee::with(['schedules.job'])->get();


        // Ambil rentang tanggal dari schedule yang ada
        $minDate = Schedule::min('work_date');
        $maxDate = Schedule::max('work_date');

        // Generate array tanggal dari rentang tersebut
        $dates = [];
        if ($minDate && $maxDate) {
            $start = Carbon::parse($minDate);
            $end = Carbon::parse($maxDate);

            while ($start->lte($end)) {
                $dates[] = $start->format('Y-m-d');
                $start->addDay();
            }
        }
        $holidays = Holiday::pluck('date')->map(fn($d) => Carbon::parse($d)->format('Y-m-d'))->toArray();

        return view('manajemen-outsourcing.list-pegawai.index', compact('jobs', 'os', 'dates', 'employees', 'holidays'));
    }


    public function monitoring()
    {

        $os = Schedule::with(['employee', 'job'])
            ->orderBy('work_date')
            ->get();

        $employees = Employee::with(['schedules.job'])->get();


        // Ambil rentang tanggal dari schedule yang ada
        $minDate = Schedule::min('work_date');
        $maxDate = Schedule::max('work_date');

        // Generate array tanggal dari rentang tersebut
        $dates = [];
        if ($minDate && $maxDate) {
            $start = Carbon::parse($minDate);
            $end = Carbon::parse($maxDate);

            while ($start->lte($end)) {
                $dates[] = $start->format('Y-m-d');
                $start->addDay();
            }
        }
        $holidays = Holiday::pluck('date')->map(fn($d) => Carbon::parse($d)->format('Y-m-d'))->toArray();


        return view('manajemen-outsourcing.monitoring-os.index', compact('os', 'dates', 'employees', 'holidays'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manajemen-outsourcing.list-pegawai.create');
    }
    /**
     * 
     * Show the form for creating a new resource.
     */
    public function import(Request $request)
    {

        $file = $request->file('file');
        // return $file->getClientOriginalExtension();
        $namaFile = $file->getClientOriginalName();
        $file->move('DataOutsourcing', $namaFile);
        $os = (new FastExcel)->import(public_path('/DataOutsourcing/' . $namaFile), function ($data) {
            return Outsourcing::create([
                'nama' => $data['nama'],
                'role' => $data['role'],
                'lokasi' => $data['lokasi'],
                'tgl_piket' => $data['tgl_piket'],
                'shift' => $data['shift'],
                'kd_ket' => $data['kd_ket'],
                'keterangan' => $data['keterangan'],
                'jam_mulai' => $data['jam_mulai'],
                'jam_selesai' => $data['jam_selesai'],
            ]);
        });

        session()->flash('success', 'Data berhasil di import.');
        return redirect()->back();
    }
    public function export()
    {
        return (new FastExcel(Schedule::all()))->download('file.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function scheduleGenerate(Request $request)
    {
        $request->validate([
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2020',
            'job_eligibility' => 'required|array',
            'rotatable_jobs' => 'nullable|array|max:6',
        ]);

        // Simpan ke pivot table employee_job.
        foreach ($request->job_eligibility as $employeeId => $jobIds) {
            $employee = Employee::find($employeeId);
            if ($employee) {
                $employee->jobEligibilities()->sync($jobIds); // Update relasi
            }
        }

        // Simpan status rotatable
        $rotatableIds = $request->input('rotatable_jobs', []);
        Job::query()->update(['rotatable' => false]);
        Job::whereIn('id', $rotatableIds)->update(['rotatable' => true]);

        // Simpan ke cache sementara untuk schedule generate
        $key = 'job_eligibility_' . now()->timestamp;
        Cache::put($key, $request->input('job_eligibility'), now()->addMinutes(10));

        $month = $request->input('month');
        $year = $request->input('year');

        Artisan::call('schedule:generate', [
            'month' => $month,
            'year' => $year,
            '--eligibility' => $key,
        ]);

        session()->flash('success', "Jadwal untuk {$month}/{$year} berhasil di-generate.");
        return redirect()->route('os.index');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function formGenerate()
    {
        $employee = Employee::with('jobEligibilities')->get();

        $jobs = Job::all();

        $pagiJobs = $jobs->where('shift', 'pagi');
        $siangJobs = $jobs->where('shift', 'siang');
        $soreJobs = $jobs->where('shift', 'sore');
        $malamJobs = $jobs->where('shift', 'malam');

        return view('manajemen-outsourcing.list-pegawai.form-generate', compact('employee', 'jobs', 'pagiJobs', 'siangJobs', 'soreJobs', 'malamJobs'));
    }


    /**
     * Display the specified resource.
     */


    public function jobSummary(Request $request)
    {
        $jobs = Job::select('id', 'code', 'name')->get();

        // Tambahkan manual "OFF" sebagai job dengan null job_id
        $jobs->push((object)[
            'id' => null,
            'code' => 'off',
            'name' => null
        ]);

        $query = Schedule::query();

        if ($request->filled('tanggal')) {
            $query->whereDate('work_date', $request->tanggal);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('work_date', $request->bulan);
        }

        if ($request->filled('job')) {
            if ($request->job === 'off') {
                $query->whereNull('job_id');
            } else {
                $query->where('job_id', $request->job);
            }
        }

        if ($request->filled('nama')) {
            $query->whereHas('employee', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->nama . '%');
            });
        }

        $summary = $jobs->map(function ($job) use ($query) {
            $count = (clone $query)->where('job_id', $job->id)->distinct('employee_id')->count('employee_id');


            return [
                'kode_job' => $job->code,
                'deskripsi' => $job->name ?? 'LIBUR',
                'jumlah' => $count,
            ];
        });

        // Filter hanya job yang jumlahnya > 0
        $filteredSummary = $summary->filter(fn($item) => $item['jumlah'] > 0)->values();

        return response()->json($filteredSummary);
    }



    public function employeeList(Request $request)
    {
        $query = Employee::with(['schedules' => function ($q) use ($request) {
            $q->when($request->filled('tanggal'), function ($q) use ($request) {
                $q->where('work_date', $request->tanggal);
            });
            $q->when($request->filled('bulan'), function ($q) use ($request) {
                $q->whereMonth('work_date', $request->bulan);
            });
            $q->when($request->filled('job'), function ($q) use ($request) {
                if ($request->job === 'off') {
                    $q->whereNull('job_id');
                } else {
                    $q->where('job_id', $request->job);
                }
            });
        }]);

        if ($request->filled('nama')) {
            $query->where('name', 'like', '%' . $request->nama . '%');
        }

        $employees = $query->get();

        $filtered = $employees->filter(function ($employee) {
            return $employee->schedules->isNotEmpty();
        })->values();

        return response()->json($filtered);
    }


    public function detailDate(Request $request)
    {
        $date = $request->input('date');

        $schedules = Schedule::with(['employee', 'job'])
            ->whereDate('work_date', $date)
            ->get();

        $grouped = $schedules->groupBy(fn($s) => strtolower($s->job?->shift ?? 'off'));

        return response()->json([
            'date' => Carbon::parse($date)->translatedFormat('l, d F Y'),
            'shifts' => $grouped->map(function ($items) {
                return $items->map(fn($s) => [
                    'namejob' => $s->job?->name ?? '-',
                    'name' => $s->employee->name
                ])->values();
            })
        ]);
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $schedule = Schedule::find($id);
        $employee = Employee::all();
        $job = Job::all();

        return view('manajemen-outsourcing.list-pegawai.edit', compact('schedule', 'employee', 'job'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $schedule = Schedule::find($id);
        $schedule->update([
            'employee_id' => $request->employee_id,
            'job_id' => $request->job_id
        ]);

        session()->flash('success', 'Data berhasil diubah');
        return redirect()->route('os.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
