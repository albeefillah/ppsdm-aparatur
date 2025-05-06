<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::all();
        return view('manajemen-outsourcing.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manajemen-outsourcing.jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $jobs = Job::create([
            'code' => $request->code,
            'name' => $request->name,
            'category' => $request->category,
            'shift' => $request->shift,
            'type' => $request->type,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        session()->flash('success', 'Data berhasil ditambahkan.');
        return redirect()->route('jobs.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jobs = Job::find($id);
        return view('manajemen-outsourcing.jobs.edit', compact('jobs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jobs = Job::find($id);
        $jobs->update([
            'code' => $request->code,
            'name' => $request->name,
            'category' => $request->category,
            'shift' => $request->shift,
            'type' => $request->type,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        session()->flash('success', 'Data berhasil diubah.');
        return redirect()->route('jobs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobs = Job::find($id);
        $jobs->delete();

        session()->flash('success', 'Data berhasil dihapus.');
        return redirect()->back();
    }
}
