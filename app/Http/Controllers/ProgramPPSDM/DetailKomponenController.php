<?php

namespace App\Http\Controllers\ProgramPPSDM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailKomponen;
use App\Models\SubKomponen;

class DetailKomponenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detail = DetailKomponen::all();

        return view('program-ppsdm/detail-komponen/index', compact('detail'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subKomponen = SubKomponen::all();

        return view('program-ppsdm/detail-komponen/create', compact('subKomponen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $detail = DetailKomponen::create([
            'id_sub_komponen' => $request->id_sub_komponen,
            'kode'            => $request->kode,
            'deskripsi'       => $request->deskripsi,
            'pagu_awal'       => $request->pagu_awal,
        ]);

        session()->flash('success', 'Data berhasil ditambahkan');
        return redirect()->route('detail-komponen.index');
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
        $detail      = DetailKomponen::find($id);
        $subKomponen = SubKomponen::all();
        
        return view('program-ppsdm/detail-komponen/edit', compact('detail','subKomponen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $detail = DetailKomponen::find($id);
        $detail->update([
            'id_sub_komponen' => $request->id_sub_komponen,
            'kode'            => $request->kode,
            'deskripsi'       => $request->deskripsi,
            'pagu_awal'       => $request->pagu_awal,
        ]);

        session()->flash('success', 'Data berhasil diubah');
        return redirect()->route('detail-komponen.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $detail = DetailKomponen::find($id);
        $detail->delete();

        
        session()->flash('success', 'Data berhasil dihapus');
        return redirect()->back();
    }
}
