<?php

namespace App\Http\Controllers;

use App\Models\Outsourcing;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class OutsourcingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $os = Outsourcing::all();
        return view('manajemen-outsourcing.list-pegawai.index', compact('os'));
    }

    public function monitoring()
    {
        $os = Outsourcing::all();

        return view('manajemen-outsourcing.monitoring-os.index', compact('os'));
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
        return (new FastExcel(Outsourcing::all()))->download('file.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
