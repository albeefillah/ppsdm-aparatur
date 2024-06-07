<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SPPDController extends Controller
{
    public function index()
    {
        return view('dashboard/sppd/index');
    }
}
