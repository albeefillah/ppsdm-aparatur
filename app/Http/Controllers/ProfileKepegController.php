<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileKepegController extends Controller
{
    public function index()
    {
        return view('dashboard/profile-kepeg/index');
    }
}
