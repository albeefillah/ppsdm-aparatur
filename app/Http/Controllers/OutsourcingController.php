<?php

namespace App\Http\Controllers;

use App\Models\Outsourcing;
use Illuminate\Http\Request;

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
