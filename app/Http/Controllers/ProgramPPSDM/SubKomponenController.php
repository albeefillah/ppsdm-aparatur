<?php

namespace App\Http\Controllers\ProgramPPSDM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RincianOutput;
use App\Models\SubKomponen;

class SubKomponenController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subKomponen = SubKomponen::all();

        return view('program-ppsdm/sub-komponen/index', compact('subKomponen'));
    }

      /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ro = RincianOutput::all();

        return view('program-ppsdm/sub-komponen/create', compact('ro'));
    }

      /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $subKomponen = SubKomponen::create([
            'id_rincian_output' => $request->id_rincian_output,
            'kode'              => $request->kode,
            'deskripsi'         => $request->deskripsi,
            'pagu_awal'         => $request->pagu_awal,
        ]);

        session()->flash('success', 'Data berhasil ditambahkan');
        return redirect()->route('sub-komponen.index');
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
        $subKomponen = SubKomponen::find($id);
        $ro          = RincianOutput::all();
        
        return view('program-ppsdm/sub-komponen/edit', compact('subKomponen','ro'));
    }

      /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subKomponen = SubKomponen::find($id);
        $subKomponen->update([
            'id_rincian_output' => $request->id_rincian_output,
            'kode'              => $request->kode,
            'deskripsi'         => $request->deskripsi,
            'pagu_awal'         => $request->pagu_awal,
        ]);

        session()->flash('success', 'Data berhasil diubah');
        return redirect()->route('sub-komponen.index');

    }

      /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subKomponen = SubKomponen::find($id);
        $subKomponen->delete();

        
        session()->flash('success', 'Data berhasil dihapus');
        return redirect()->back();
    }
}
