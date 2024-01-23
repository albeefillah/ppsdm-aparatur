<?php

namespace App\Http\Controllers\Anggaran;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Pokja;
use App\Models\Komponen;
use App\Models\MataAnggaran;
use App\Models\KegiatanProgram;
use App\Models\KRO;
use App\Models\RincianOutput;
use App\Models\SubKomponen; 
use App\Models\DetailKomponen;
use App\Models\RKAKLAwal;
use App\Models\AkunUsed;

class RKAKLController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahun = Carbon::now()->format('Y');
        $prevYear = Carbon::now()->subYear()->year;   

        $test = RKAKLAwal::where('tahun',$tahun)->get();
        $rkakl = null;

        if (isset($test)) {
            $rkakl = $test;
        }else{
            $rkakl = RKAKLAwal::where('tahun',$prevYear)->get();
        }

        return view('anggaran/keuangan/rkakl_awal/index', compact('rkakl'));
    }

    public function importRKAKL(Request $request)
    {
        $file = $request->file('file_import');

        Excel::import(new \App\Imports\RKAKLImport, $file, 'xlsx');

        // session()->flash('success','Data berhasil ditambahkan.');
        return redirect()->back()->with('success', 'Data berhasil diimport.');
    }

    public function create()
    {
        $kegiatan = KegiatanProgram::all();
        $kro = KRO::all();
        $ro = RincianOutput::all();
        $subkom = SubKomponen::all();
        $detail = DetailKomponen::all();

        return view('anggaran/keuangan/rkakl_awal/create', compact('kegiatan','kro','ro','subkom','detail'));
    }

   
    public function store(Request $request)
    {
        return $request;

        session()->flash('success','Data berhasil ditambahkan.');
        return redirect()->route('rkakl.index');
    }

    
    public function update(Request $request, string $id)
    {
        $rkakl = RKAKLAwal::find($id);

        $rkakl->update([
            'kode' => $request->input('kode'),
            'deskripsi' => $request->input('deskripsi'),
            'jumlah_biaya' => $request->input('jumlah_biaya'),
        ]);
    
        session()->flash('success','Data berhasil diubah.');
        return redirect()->route('rkakl.index');
    }

   
    public function listPokja($id)
    {
        $rkakl = RKAKLAwal::find($id);
        $pokja = Pokja::where('pokja','!=','Keuangan')->get();

        return view('anggaran/keuangan/rkakl_awal/pokja/list-pokja', compact('pokja','rkakl'));
    }

    public function detailPokja($id)
    {
        $rkakl = RKAKLAwal::find($id);
        $pokja = Pokja::where('pokja','!=','Keuangan')->get();

        return view('anggaran/keuangan/rkakl_awal/pokja/list-pokja', compact('pokja','rkakl'));
    }


}
