<?php

namespace App\Http\Controllers\MonitoringBPA;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\Pokja;
use Illuminate\Http\Request;
use App\Models\RencanaAnggaran;
use App\Http\Controllers\Controller;

class BPAUController extends Controller
{
    public function index()
    {
        $tahun   = Carbon::now()->format('Y');
        $pokja   = Pokja::where('pokja','BPAU')->first();
        $role    = Role::where('id_pokja',$pokja->id)->get();
        return $rencana = RencanaAnggaran::where('id_pokja',$pokja->id)
                                    ->where('tahun',$tahun)->get();

        
        return view('monitoring-bpa/bpau/index');
    }
}
