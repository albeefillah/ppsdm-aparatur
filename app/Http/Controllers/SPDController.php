<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SPDController extends Controller
{
    public function index()
    {
        
        return view('spd/index');
    }

    public function pelaksanaIndex()
    {
        return view('spd/pelaksana/index');
    }

    public function create()
    {
        return view('spd/create');
    }
    public function pesertaCreate()
    {
        return view('spd/pelaksana/peserta/create');
    }
    public function pesertaStore()
    {
        // return view('spd/pelaksana/peserta/create');
    }
    public function nonPesertaCreate()
    {
        return view('spd/pelaksana/non-peserta/create');
    }
}
