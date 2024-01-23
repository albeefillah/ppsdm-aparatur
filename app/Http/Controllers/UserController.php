<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::latest()->get();
        return view('user/index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = Role::all();
        return view('user/create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::create([
            'id_role' => $request->id_role,
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  bcrypt($request->password),
        ]);

        session()->flash('success','Data berhasil ditambahkan.');
        return redirect()->route('user.index');
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
        $role = Role::all();
        $user = User::find($id);

        return view('user/edit', compact('role','user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->update([
            'id_role' => $request->id_role,
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  bcrypt($request->password),
        ]);

        session()->flash('success','Data berhasil diubah.');
        return redirect()->route('user.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        session()->flash('success','Data berhasil dihapus.');
        return redirect()->back();
    }
}
