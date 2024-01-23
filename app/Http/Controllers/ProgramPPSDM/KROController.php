<?php

namespace App\Http\Controllers\ProgramPPSDM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KRO;
use App\Models\KegiatanProgram;

class KROController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kro = KRO::all();

        return view('program-ppsdm/kro/index', compact('kro'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kegiatanProgram = KegiatanProgram::all();
        return view('program-ppsdm/kro/create', compact('kegiatanProgram'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kro = KRO::create([
            'id_kegiatan_program'  => $request->id_kegiatan_program,
            'kode'  => $request->kode,
            'deskripsi'  => $request->deskripsi,
            'pagu_awal'  => $request->pagu_awal,
        ]);

        session()->flash('success', 'Data berhasil ditambahkan.');
        return redirect()->route('kro.index');
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
        $kro = KRO::find($id);
        $kegiatanProgram = KegiatanProgram::all(); 

        return view('program-ppsdm/kro/edit', compact('kro','kegiatanProgram'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kro = KRO::find($id);
        $kro->update([
            'id_kegiatan_program'  => $request->id_kegiatan_program,
            'kode'  => $request->kode,
            'deskripsi'  => $request->deskripsi,
            'pagu_awal'  => $request->pagu_awal,
        ]);

        session()->flash('success', 'Data berhasil diubah.');
        return redirect()->route('kro.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kro = KRO::find($id);
        $kro->delete();

        session()->flash('success', 'Data berhasil dihapus.');
        return redirect()->back( );
    }
}
