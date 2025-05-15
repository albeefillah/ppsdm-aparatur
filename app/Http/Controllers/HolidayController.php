<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $holiday = Holiday::all();
        return view('manajemen-outsourcing.holiday.index', compact('holiday'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manajemen-outsourcing.holiday.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $holiday = Holiday::create([
            'date' => $request->date,
            'description' => $request->description,

        ]);

        session()->flash('success', 'Data berhasil ditambahkan.');
        return redirect()->route('holiday.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $holiday = Holiday::find($id);
        return view('manajemen-outsourcing.holiday.edit', compact('holiday'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $holiday = Holiday::find($id);
        $holiday->update([
            'date' => $request->date,
            'description' => $request->description,
        ]);

        session()->flash('success', 'Data berhasil diubah.');
        return redirect()->route('holiday.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $holiday = Holiday::find($id);
        $holiday->delete();

        session()->flash('success', 'Data berhasil dihapus.');
        return redirect()->back();
    }
}
