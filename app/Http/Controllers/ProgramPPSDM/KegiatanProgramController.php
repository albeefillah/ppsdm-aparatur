<?php

namespace App\Http\Controllers\ProgramPPSDM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KegiatanProgram;

class KegiatanProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kegiatanProgram = KegiatanProgram::all();

        return view('program-ppsdm/kegiatan-program/index', compact('kegiatanProgram'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('program-ppsdm/kegiatan-program/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kegiatanProgram = KegiatanProgram::create([
            'kode'  => $request->kode,
            'deskripsi'  => $request->deskripsi,
            'pagu_awal'  => $request->pagu_awal,
        ]);

        session()->flash('success', 'Data berhasil ditambahkan.');
        return redirect()->route('kegiatan-program.index');
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
        $kegiatanProgram = KegiatanProgram::find($id);

        return view('program-ppsdm/kegiatan-program/edit', compact('kegiatanProgram'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kegiatanProgram = KegiatanProgram::find($id);
        $kegiatanProgram->update([
            'kode'  => $request->kode,
            'deskripsi'  => $request->deskripsi,
            'pagu_awal'  => $request->pagu_awal,
        ]);

        session()->flash('success', 'Data berhasil diubah.');
        return redirect()->route('kegiatan-program.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kegiatanProgram = KegiatanProgram::find($id);
        $kegiatanProgram->delete();

        session()->flash('success', 'Data berhasil dihapus.');
        return redirect()->back();
    }
}
