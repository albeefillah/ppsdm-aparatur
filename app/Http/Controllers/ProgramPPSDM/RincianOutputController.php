<?php

namespace App\Http\Controllers\ProgramPPSDM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RincianOutput;
use App\Models\KRO;

class RincianOutputController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ro = RincianOutput::all();

        return view('program-ppsdm/rincian-output/index', compact('ro'));
    }

      /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kro = KRO::all();

        return view('program-ppsdm/rincian-output/create', compact('kro'));
    }

      /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ro = RincianOutput::create([
            'id_kro'    => $request->id_kro,
            'kode'      => $request->kode,
            'deskripsi' => $request->deskripsi,
            'pagu_awal' => $request->pagu_awal,
        ]);

        session()->flash('success', 'Data berhasil ditambahkan');
        return redirect()->route('rincian-output.index');
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
        $ro  = RincianOutput::find($id);
        $kro = KRO::all();

        
        return view('program-ppsdm/rincian-output/edit', compact('ro','kro'));
    }

      /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ro = RincianOutput::find($id);
        $ro->update([
            'id_kro'    => $request->id_kro,
            'kode'      => $request->kode,
            'deskripsi' => $request->deskripsi,
            'pagu_awal' => $request->pagu_awal,
        ]);

        session()->flash('success', 'Data berhasil diubah');
        return redirect()->route('rincian-output.index');

    }

      /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ro = RincianOutput::find($id);
        $ro->delete();

        
        session()->flash('success', 'Data berhasil dihapus');
        return redirect()->back();
    }
}
