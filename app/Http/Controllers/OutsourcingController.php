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
                    return $row->job->code ?? 'OFF';
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
        $jobs = Job::select('id', 'code')->get();

        return view('manajemen-outsourcing.list-pegawai.index', compact('jobs'));
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
        ]);

        $month = $request->input('month');
        $year = $request->input('year');

        Artisan::call('schedule:generate', [
            'month' => $month,
            'year' => $year,
        ]);

        session()->flash('success', "Jadwal untuk {$month}/{$year} berhasil di generate.");
        return redirect()->route('monitoring.index');
    }

    /**
     * Display the specified resource.
     */


    public function jobSummary(Request $request)
    {
        $jobs = Job::select('id', 'code')->get();

        // Tambahkan manual "OFF" sebagai job dengan null job_id
        $jobs->push((object)[
            'id' => null,
            'code' => 'OFF'
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
            $count = (clone $query)->where('job_id', $job->id)->count();

            return [
                'kode_job' => $job->code,
                'jumlah' => $count
            ];
        });

        return response()->json($summary);
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
