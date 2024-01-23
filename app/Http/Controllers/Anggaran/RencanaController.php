<?php

namespace App\Http\Controllers\Anggaran;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Komponen;
use App\Models\MataAnggaran;
use App\Models\KegiatanProgram;
use App\Models\KRO;
use App\Models\RKAKLAwal;
use App\Models\RincianOutput;
use App\Models\DetailKomponen;
use App\Models\RencanaAnggaran;
use App\Models\AkunUsed;

class RencanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pokja = Auth::user()->role->pokja->pokja;
        $id_role = Auth::user()->role->id;
        $tahun = Carbon::now()->format('Y');
        $rencana = RencanaAnggaran::where('id_role', $id_role)
                    ->where('tahun',$tahun)        
                    ->first();
        $arrayRencana = $rencana->rencana ?? [];

        $id_rkakl = [];
        $pagu = [];

        foreach ($arrayRencana as $item) {
            $id_rkakl[] = $item['id_rkakl'];
            $pagu[] = $item['pagu'];
        }

        $rkakl = RKAKLAwal::whereIn('id',$id_rkakl)->get();

        $akun = $rencana->akun ?? [];
        $dataAkun = [];

        $cekAkunUsed = AkunUsed::whereIn('id',$akun)->get();
        foreach ($cekAkunUsed as $key => $akun_used_item) {
            foreach ($akun_used_item['data']['mata_anggaran'] as $key => $value) {
                $matang_data =[
                    'id'    => $value['id'],
                    'id_rkakl' => $value['id_rkakl'],
                    'kode'    => $value['kode'],
                    'deskripsi'    => $value['deskripsi'],
                    'pagu_awal'    => $value['pagu_awal'],
                    'pagu'    => $value['pagu'],
                ];
        
                $dataAkun['mata_anggaran'][] = $matang_data;
            } 
        }

        // return $dataAkun;

        return view('anggaran/pokja/rencana/index', compact('rkakl','pokja','pagu','rencana','dataAkun'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tahun = Carbon::now()->format('Y');
        $prevYear = Carbon::now()->subYear()->year;   

        $test = RKAKLAwal::where('tahun',$tahun)->get();
        $rkakl = null;

        if (isset($test)) {
            $rkakl = $test;
        }else{
            $rkakl = RKAKLAwal::where('tahun',$prevYear)->get();
        }

        return view('anggaran/pokja/rencana/create', compact('rkakl'));
    }

    // public function tambahAkun()
    // {
    //     $mataAnggaran = MataAnggaran::all();
    //     return view('anggaran/pokja/rencana/tambah-akun', compact('mataAnggaran'));
    // }
    // public function dummyAkun()
    // {
    //     $mataAnggaran = MataAnggaran::all();   
    //     return view('anggaran/pokja/rencana/akundummy', compact('mataAnggaran'));
    // }


    public function store(Request $request)
    {
        $id_role = Auth::user()->role->id;
        $id_pokja = Auth::user()->role->pokja->id;
        $tahun = Carbon::now()->format('Y');

        $arrayPagu = array_values($request->input('pagu'));
        $arrayIdRKAKL = array_values($request->input('id_rkakl'));

        $rencana = [];

        for ($i = 0; $i < count($arrayIdRKAKL); $i++) {
            $rencana[] = [
                'id_rkakl' => intval($arrayIdRKAKL[$i]),
                'pagu' => ($arrayPagu[$i]),
            ];
        }
        
        RencanaAnggaran::create([
            'id_pokja'  => $id_pokja,
            'id_role'  => $id_role,
            'rencana'  => $rencana,
            'tahun'  => $tahun,
        ]);
        
        session()->flash('success','Data berhasil ditambahkan.');
        return redirect()->route('rencana.index');
    }

    public function isiPagu(Request $request)
    {
        $arrayIdRKAKL = array_keys($request->input('pilih'));
        $pokja = Auth::user()->role->pokja->pokja;
        
        $rencana = RKAKLAwal::whereIn('id', $arrayIdRKAKL)->get();

        return view('anggaran/pokja/rencana/isi-pagu', compact('rencana','pokja'));
    }


   // Bagian tmabah akun
   public function listAkun(Request $request)
   {
        $pagu = $request->pagu;
        $id_rencana = $request->id_rencana;
        $rkakl = RKAKLAwal::find($request->id_rkakl);
        
        $akun = AkunUsed::where('id_rkakl',$rkakl->id)
                        ->where('id_rencana',$id_rencana)->first();

        $dataAkun = $akun->data['mata_anggaran'] ?? [];

        return view('anggaran/pokja/rencana/akun/list-akun', compact('pagu','rkakl','dataAkun','id_rencana','akun'));
   }

   public function tambahAkun(Request $request)
   {
        // return $request;
       $mataAnggaran = MataAnggaran::all();
       

       $pagu = $request->pagu;
       $id_rencana = $request->id_rencana;
       $rkakl = RKAKLAwal::find($request->id_rkakl);

       return view('anggaran/pokja/rencana/akun/tambah-akun', compact('mataAnggaran','rkakl','pagu', 'id_rencana'));
   }

   public function storeAkun(Request $request)
   {
    //    return $request;
       $matang = MataAnggaran::whereIn('id', $request->mata_anggaran)->get();
       $rkakl = RKAKLAwal::find($request->id_rkakl);
       $rencana = RencanaAnggaran::find($request->id_rencana);
       $akunCheck = AkunUsed::where('id_rencana',$request->id_rencana)
                            ->where('id_rkakl',$rkakl->id)->first();

        $id_role = Auth::user()->role->id;                            
       $data = [];

       foreach ($matang as $key => $matang_item) {
        $matang_data =[
            'id'    => $matang_item['id'],
            'id_rkakl' => $request->id_rkakl,
            'kode'    => $matang_item['akun'],
            'deskripsi'    => $matang_item['jenis_belanja'],
            'pagu_awal'    => $matang_item['pagu_awal'],
            'pagu'    => $request['pagu_mata_anggaran'][$key],
        ];

        $data['mata_anggaran'][] = $matang_data;
           
       }

        $dataMataAnggaran = $data['mata_anggaran'];

    
        // Validasi merge tambah akun di akun_used
        $akunMataAnggaran = $akunCheck->data['mata_anggaran'] ?? [];
        $mergeAkun = array_merge($akunMataAnggaran, $dataMataAnggaran) ?? [];
        $akunData['mata_anggaran'] = $mergeAkun;
        $encodeAkun = json_encode($akunData);
        $akun = json_decode($encodeAkun, true);

        $listAkunRencana = null;
        $listAkun = null;

        if (isset($akunCheck)) {
            $akunCheck->update([
                'data'  => $akun
            ]);
        }else{
            AkunUsed::create([
                'id_rkakl' =>  $request->id_rkakl,
                'id_rencana' => $request->id_rencana,
                'id_role' => $id_role,
                'data'       => $data
            ]);
        }

        $getRecentId = AkunUsed::select('id')->whereRaw('id = (select max(`id`) from akun_used)')->first();

        $dataAkunRencana = [];
        $dataAkunRencana[] = $getRecentId['id'];

         // Validasi merge akun di tabel rkakl_awal
        $rencanaMataAnggaran = $rencana->akun ?? [];
        $mergeAkunRencana = array_merge($rencanaMataAnggaran, $dataAkunRencana) ?? [];
        

        if (isset($rencana->akun)) {
            $listAkunRencana = $mergeAkunRencana;
        }else{
            $listAkunRencana = $dataAkunRencana;
        }

        // return $listAkunRencana;
        
        $rencana->update([
            'akun'  => $listAkunRencana
        ]);
        
       session()->flash('success','Akun berhasil ditambahkan.');
       return redirect()->route('rencana.list-akun',['id_rencana' => $rencana->id_rencana, 'id_rkakl' => $request->id_rkakl]);
   }


   public function destroyAkun(Request $request)
   {
        $akunUsed = AkunUsed::find($request->id_akun_used);
        $jsonData = $akunUsed->data;

        foreach ($jsonData['mata_anggaran'] as $key => $item) {
            if ($item['id'] == $request->id) {
                unset($jsonData['mata_anggaran'][$key]);
                // atau juga bisa menggunakan array_values() untuk mengurutkan kembali indeks array jika diperlukan
                // $dataArray['mata_anggaran'] = array_values($dataArray['mata_anggaran']);
                break; 
            }
        }       

        $akunUsed->update([
            'data'  => $jsonData,
        ]);
       
       session()->flash('success','Akun berhasil dihapus.');
       return redirect()->route('rencana.list-akun',['id_rencana' => $akunUsed->id_rencana, 'id_rkakl' => $akunUsed->id_rkakl]);
   }




    public function kegiatan()
    {
        return view('anggaran/pokja/rencana/kegiatan/index');
    }
    public function kegiatanDummy()
    {
        return view('anggaran/pokja/rencana/kegiatan/indexdummy');
    }
    public function kegiatanCreate()
    {
        return view('anggaran/pokja/rencana/kegiatan/create');
    }
    public function kegiatanCreateDummy()
    {
        return view('anggaran/pokja/rencana/kegiatan/createdummy');
    }

    public function getKegiatanProgram()
    {
        $kegiatan = KegiatanProgram::get();

        return response()->json($kegiatan);
    }
    public function getKRO()
    {
        $kro = KRO::with('kegiatanProgram')->get();

        return response()->json($kro);
    }
}
