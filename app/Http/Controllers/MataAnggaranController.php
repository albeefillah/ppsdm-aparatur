<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataAnggaran;
use Carbon\Carbon;

class MataAnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahun = Carbon::now()->format('Y');
        $prevYear = Carbon::now()->subYear()->year;
        $mataAnggaran = MataAnggaran::latest()->get();

        return view('mata_anggaran/index', compact('mataAnggaran','tahun'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mata_anggaran/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $mataAnggaran = MataAnggaran::create([
            'jenis_belanja' => $request->jenis_belanja,
            'akun' => $request->akun,
            'pagu_awal' => $request->pagu_awal,
            'tahun_anggaran' => $request->tahun_anggaran,
        ]);

        session()->flash('success','Data berhasil ditambahkan.');
        return redirect()->route('mata_anggaran.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */ 
    public function edit(string $id)
    {
        $mataAnggaran = MataAnggaran::find($id);
        return view('mata_anggaran/edit', compact('mataAnggaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $mataAnggaran = MataAnggaran::find($id);
        $mataAnggaran->update([
            'jenis_belanja' => $request->jenis_belanja,
            'akun' => $request->akun,
            'pagu_awal' => $request->pagu_awal,
            'tahun_anggaran' => $request->tahun_anggaran,
        ]);

        session()->flash('success','Data berhasil diubah.');
        return redirect()->route('mata_anggaran.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mataAnggaran = MataAnggaran::find($id);
        $mataAnggaran->delete();

        session()->flash('success','Data berhasil dihapus.');
        return redirect()->back();

    }
}
