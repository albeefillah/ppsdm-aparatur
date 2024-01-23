<?php

namespace App\Http\Controllers\Anggaran;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Komponen;
use App\Models\MataAnggaran;
use App\Models\KegiatanProgram;
use App\Models\KRO;
use App\Models\RincianOutput;
use App\Models\SubKomponen;
use App\Models\DetailKomponen;
use App\Models\RKAKLAwal;
use App\Models\AkunUsed;

class RKAKLController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahun = Carbon::now()->format('Y');
        $prevYear = Carbon::now()->subYear()->year;   

        $test = RKAKLAwal::where('tahun',$tahun)->first();
        $rkakl = null;

        if (isset($test)) {
            $rkakl = $test;
        }else{
            $rkakl = RKAKLAwal::where('tahun',$prevYear)->first();
        }

        $program = $rkakl->program['program'];
        $kegiatan = $rkakl->kegiatan_program['kegiatan_program'];
        $kro = $rkakl->kro['kro'];
        $rincian = $rkakl->rincian_output['rincian'];
        $subkom = $rkakl->subkom['subkom'];
        $detkom = $rkakl->detail['detkom'];
        $akun = $rkakl->akun['akun_used'] ?? [];
        $dataAkun = [];

        $cekAkunUsed = AkunUsed::whereIn('id',$akun)->get();
        foreach ($cekAkunUsed as $key => $akun_used_item) {
            foreach ($akun_used_item['data']['mata_anggaran'] as $key => $value) {
                $matang_data =[
                    'id'    => $value['id'],
                    'id_detkom' => $value['id_detkom'],
                    'kode'    => $value['kode'],
                    'deskripsi'    => $value['deskripsi'],
                    'pagu_awal'    => $value['pagu_awal'],
                    'pagu'    => $value['pagu'],
                ];
        
                $dataAkun['mata_anggaran'][] = $matang_data;
            } 
        }

        $akunUsed = $dataAkun['mata_anggaran'] ?? [];

        // return $dataAkun['mata_anggaran'];
        // Inisialisasi array $result untuk menyimpan hasil penggabungan data
        $result = [];

        // Tambahkan data tambahan sebelum 'kegiatan_program'
        $result['tahun'] = $rkakl['tahun'];
        $result['program'] = [
            'kode' => $program['kode'],
            'deskripsi' => $program['deskripsi'],
            'pagu' => $program['pagu'],
        ];

        // Loop melalui kegiatan_program
        foreach ($kegiatan as $kegiatan_item) {
            // Inisialisasi array untuk menyimpan data kegiatan_program
            $kegiatan_data = [
                'id' => $kegiatan_item['id'],
                'kode' => $kegiatan_item['kode'],
                'deskripsi' => $kegiatan_item['deskripsi'],
                'pagu' => $kegiatan_item['pagu'],
                'kro' => [],
            ];

            // Loop melalui kro yang terkait dengan kegiatan_program saat ini
            foreach ($kro as $kro_item) {
                if ($kro_item['id_kegiatan_program'] == $kegiatan_item['id']) {
                    // Inisialisasi array untuk menyimpan data kro
                    $kro_data = [
                        'id' => $kro_item['id'],
                        'id_kegiatan_program' => $kro_item['id_kegiatan_program'],
                        'kode_lengkap' => $kro_item['kode_lengkap'],
                        'kode' => $kro_item['kode'],
                        'deskripsi' => $kro_item['deskripsi'],
                        'pagu' => $kro_item['pagu'],
                        'rincian' => [],
                    ];

                    // Loop melalui rincian yang terkait dengan kro saat ini
                    foreach ($rincian as $rincian_item) {
                        if ($rincian_item['id_kro'] == $kro_item['id']) {
                            // Inisialisasi array untuk menyimpan data rincian
                            $rincian_data = [
                                'id' => $rincian_item['id'],
                                'id_kro' => $rincian_item['id_kro'],
                                'kode_lengkap' => $rincian_item['kode_lengkap'],
                                'kode' => $rincian_item['kode'],
                                'deskripsi' => $rincian_item['deskripsi'],
                                'pagu' => $rincian_item['pagu'],
                                'subkom' => [],
                            ];

                            // Loop melalui subkom yang terkait dengan rincian saat ini
                            foreach ($subkom as $subkom_item) {
                                if ($subkom_item['id_rincian_output'] == $rincian_item['id']) {
                                    // Inisialisasi array untuk menyimpan data subkom
                                    $subkom_data = [
                                        'id' => $subkom_item['id'],
                                        'id_rincian_output' => $subkom_item['id_rincian_output'],
                                        'kode_lengkap' => $subkom_item['kode_lengkap'],
                                        'kode' => $subkom_item['kode'],
                                        'deskripsi' => $subkom_item['deskripsi'],
                                        'pagu' => $subkom_item['pagu'],
                                        'detkom' => [],
                                    ];

                                    // Loop melalui detkom yang terkait dengan subkom saat ini
                                    foreach ($detkom as $detkom_item) {
                                        if ($detkom_item['id_sub_komponen'] == $subkom_item['id']) {
                                            // Inisialisasi array untuk menyimpan data detkom
                                            $detkom_data = [
                                                'id' => $detkom_item['id'],
                                                'id_sub_komponen' => $detkom_item['id_sub_komponen'],
                                                'kode_lengkap' => $detkom_item['kode_lengkap'],
                                                'kode' => $detkom_item['kode'],
                                                'deskripsi' => $detkom_item['deskripsi'],
                                                'pagu' => $detkom_item['pagu'],
                                            ];

                                            foreach ($akunUsed as $key => $akun_item) {
                                                if ($akun_item['id_detkom'] == $detkom_item['id']) {
                                                    // Inisialisasi array untuk menyimpan data akun
                                                    $akun_data = [
                                                        'id' => $akun_item['id'],
                                                        'id_detkom' => $akun_item['id_detkom'],
                                                        'kode' => $akun_item['kode'],
                                                        'deskripsi' => $akun_item['deskripsi'],
                                                        'pagu_awal' => $akun_item['pagu_awal'],
                                                        'pagu' => $akun_item['pagu'],
                                                    ];
        
                                                    // Tambahkan data akun ke dalam array akun_data
                                                    $detkom_data['akun'][] = $akun_data;
                                                }
                                            }

                                            // Tambahkan data detkom ke dalam array detkom_data
                                            $subkom_data['detkom'][] = $detkom_data;
                                        }
                                    }

                                    // Tambahkan data subkom ke dalam array subkom_data
                                    $rincian_data['subkom'][] = $subkom_data;
                                }
                            }

                            // Tambahkan data rincian ke dalam array kro_data
                            $kro_data['rincian'][] = $rincian_data;
                        }
                    }

                    // Tambahkan data kro ke dalam array kegiatan_data
                    $kegiatan_data['kro'][$kro_item['id']] = $kro_data;
                }
            }

            // Tambahkan data kegiatan_program ke dalam array result
            $result['kegiatan_program'][] = $kegiatan_data;
        }

        // return $re

        return view('anggaran/keuangan/rkakl_awal/index', compact('result','rkakl'));
    }

    public function create()
    {
        $kegiatan = KegiatanProgram::all();
        $kro = KRO::all();
        $ro = RincianOutput::all();
        $subkom = SubKomponen::all();
        $detail = DetailKomponen::all();

        return view('anggaran/keuangan/rkakl_awal/create', compact('kegiatan','kro','ro','subkom','detail'));
    }

   
    public function store(Request $request)
    {
        // Inisialisasi requirement untuk data json
        $kegiatan_program = KegiatanProgram::whereIn('id', $request->kegiatan_program ?? [])->get();
        $pagu_kegiatan =  $request->pagu_kegiatan;

        $kro = KRO::whereIn('id', $request->kro ?? [])->get();
        $pagu_kro = $request->pagu_kro;

        $rincian = RincianOutput::whereIn('id', $request->rincian ?? [])->get();
        $pagu_rincian = $request->pagu_rincian;
        
        $subkom = SubKomponen::whereIn('id', $request->subkom ?? [])->get();
        $pagu_subkom = $request->pagu_subkom;

        $detkom = DetailKomponen::whereIn('id', $request->detkom ?? [])->get();
        $pagu_detkom = $request->pagu_detkom;
         
        $kegiatan = [
            'kegiatan_program' => $kegiatan_program->map(function ($item, $index) use ($pagu_kegiatan) {
                return [
                    'id' => $item->id,
                    'kode' => $item->kode,
                    'deskripsi' => $item->deskripsi,
                    'pagu' => $pagu_kegiatan[$index],
                ];
            })->all(),
        ];

        $klasifikasi = [
            'kro' => $kro->map(function ($item, $index) use ($pagu_kro) {
                return [
                    'id'    => $item->id,
                    'id_kegiatan_program' => $item->id_kegiatan_program,
                    'kode_lengkap' => $item->kegiatanProgram->kode.'.'. $item->kode,
                    'kode' => $item->kode,
                    'deskripsi' => $item->deskripsi,
                    'pagu'  =>  $pagu_kro[$index],
                ];
            })->all(),
        ];

        $rincianOutput = [
            'rincian' => $rincian->map(function ($item, $index) use ($pagu_rincian) {
                return [
                    'id'    => $item->id,
                    'id_kro' => $item->id_kro,
                    'kode_lengkap' => $item->kro->kegiatanProgram->kode.'.'. $item->kro->kode.'.'.$item->kode,
                    'kode' => $item->kode,
                    'deskripsi' => $item->deskripsi,
                    'pagu'  =>  $pagu_rincian[$index],
                ];
            })->all(),
        ];

        $subkomponen = [
            'subkom' => $subkom->map(function ($item, $index) use ($pagu_subkom) {
                return [
                    'id'    => $item->id,
                    'id_rincian_output' => $item->id_rincian_output,
                    'kode_lengkap' => $item->rincianOutput->kro->kegiatanProgram->kode.'.'. $item->rincianOutput->kro->kode.'.'.$item->rincianOutput->kode.'.'.$item->kode,
                    'kode' => $item->kode,
                    'deskripsi' => $item->deskripsi,
                    'pagu'  =>  $pagu_subkom[$index],
                ];
            })->all(),
        ];

        $detkomponen = [
            'detkom' => $detkom->map(function ($item, $index) use ($pagu_detkom) {
                return [
                    'id' => $item->id,
                    'id_sub_komponen' => $item->id_sub_komponen,
                    'kode_lengkap' =>  $item->subKomponen->rincianOutput->kro->kegiatanProgram->kode.'.'. $item->subKomponen->rincianOutput->kro->kode.'.'.$item->subKomponen->rincianOutput->kode.'.'.$item->subKomponen->kode.'.'. $item->kode,
                    'kode' => $item->kode,
                    'deskripsi' => $item->deskripsi,
                    'pagu'  =>  $pagu_detkom[$index]
                ];
            })->all(),
        ];


        // Data Json
        $data= [
            'tahun' => $request->tahun,
            'program' => [
                'kode' => $request->kode_program,
                'deskripsi' => $request->desc_program,
                'pagu' => $request->pagu_program,
            ],
        ];
       

        $rkakl = RKAKLAwal::create([
            'program' =>  $data,
            'tahun' =>  $request->tahun,
            'kegiatan_program' => $kegiatan,
            'kro'   => $klasifikasi,
            'rincian_output'   => $rincianOutput,
            'subkom'   => $subkomponen,
            'detail'   => $detkomponen,
        ]);

        session()->flash('success','Data berhasil ditambahkan.');
        return redirect()->route('rkakl.index');
    }

    
    public function show(string $id)
    {
        //
    }

   
    public function edit(string $id)
    {
        //
    }

    
    public function update(Request $request, string $id)
    {
        //
    }

   
    public function destroy(string $id)
    {
        //
    }



    // Bagian tmabah akun
    public function listAkun(Request $request)
    {
        $id_rkakl = $request->id_rkakl;
        $detkom = json_decode($request->query('detkom'), true);
        
        $rkakl = RKAKLAwal::find($id_rkakl);
        $akun = AkunUsed::where('id_detkom',$detkom['id'])
                        ->where('id_rkakl',$rkakl->id)->first();

        $dataAkun = $akun->data['mata_anggaran'] ?? [];

        return view('anggaran/keuangan/rkakl_awal/akun/list-akun', compact('detkom','dataAkun','rkakl','akun'));
    }

    public function tambahAkun(Request $request)
    {
        $detkom = json_decode($request->query('detkom'), true);
        $mataAnggaran = MataAnggaran::all();
        $id_rkakl = $request->id_rkakl;

        return view('anggaran/keuangan/rkakl_awal/akun/tambah-akun', compact('detkom','mataAnggaran','id_rkakl'));
    }

    public function storeAkun(Request $request)
    {
       $matang = MataAnggaran::whereIn('id', $request->mata_anggaran)->get();
       $detkom = json_decode($request->detkom, true);
       $rkakl = RKAKLAwal::find($request->id_rkakl);
       $akunCheck = AkunUsed::where('id_detkom',$detkom['id'])
                            ->where('id_rkakl',$rkakl->id)->first();
       $data = [];

       foreach ($matang as $key => $matang_item) {
        $matang_data =[
            'id'    => $matang_item['id'],
            'id_detkom' => $request->id_detkom,
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

        $listAkunRKAKL = null;
        $listAkun = null;

        if (isset($akunCheck)) {
            $akunCheck->update([
                'data'  => $akun
            ]);
        }else{
            AkunUsed::create([
                'id_rkakl' =>  $request->id_rkakl,
                'id_detkom' => $request->id_detkom,
                'data'       => $data
            ]);
        }

        $getRecentId = AkunUsed::select('id')->whereRaw('id = (select max(`id`) from akun_used)')->first();

        $dataAkunRKAKL = [];
        $dataAkunRKAKL[] = $getRecentId['id'];

         // Validasi merge akun di tabel rkakl_awal
        $rkaklMataAnggaran = $rkakl->akun['akun_used'] ?? [];
        $mergeAkunRKAKL = array_merge($rkaklMataAnggaran, $dataAkunRKAKL) ?? [];
    

        $rkaklData['akun_used'] = $mergeAkunRKAKL;
        $encodeAkunRKAKL = json_encode($rkaklData);
        $akunRKAKL = json_decode($encodeAkunRKAKL, true);

        if (isset($rkakl->akun)) {
            $listAkunRKAKL = $akunRKAKL;
        }else{
            $listAkunRKAKL = $dataAkunRKAKL;
        }

        // return $listAkunRKAKL;
        
        $rkakl->update([
            'akun'  => $listAkunRKAKL
        ]);

        session()->flash('success','Akun berhasil ditambahkan.');
        return redirect()->route('rkakl.list-akun',['detkom' => $request->detkom, 'id_rkakl' => $request->id_rkakl]);
    }

    public function updateAkun(Request $request)
    {
        return $request;
        $akunUsed = AkunUsed::find($request->id_akun_used);
        $jsonData = $akunUsed->data;    

    }

    public function destroyAkun(Request $request)
    {
        $akunUsed = AKunUsed::find($request->id_akun_used);
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
        return redirect()->back();
    }

    public function dummyAkun()
    {
        $mataAnggaran = MataAnggaran::all();   
        return view('anggaran/keuangan/rkakl_awal/akundummy', compact('mataAnggaran'));
    }


    // Bagian tambah kegiatan
    public function kegiatan()
    {
        return view('anggaran/keuangan/rkakl_awal/kegiatan/list-akun');
    }
    public function kegiatanDummy()
    {
        return view('anggaran/keuangan/rkakl_awal/kegiatan/indexdummy');
    }
    public function kegiatanCreate()
    {
        return view('anggaran/keuangan/rkakl_awal/kegiatan/create');
    }
    public function kegiatanCreateDummy()
    {
        return view('anggaran/keuangan/rkakl_awal/kegiatan/createdummy');
    }






    // Setting server API Ajax RKAKL

    public function getKegiatanProgram()
    {
        $kegiatan = KegiatanProgram::get();

        return response()->json($kegiatan);
    }
    
    public function getKRO()
    {
        try {
            $kro = KRO::with('kegiatanProgram')->get();
            return response()->json($kro);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getRincian()
    {
        try {
            $ro = RincianOutput::with('kro.kegiatanProgram')->get();
            return response()->json($ro);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getSubkom()
    {
        try {
            $subkom = SubKomponen::with('rincianOutput.kro.kegiatanProgram')->get();
            return response()->json($subkom);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getDetkom()
    {
        try {
            $detail = DetailKomponen::with('subKomponen.rincianOutput.kro.kegiatanProgram')->get();
            return response()->json($detail);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getMataAnggaran()
    {
        try {
            $mataAnggaran = MataAnggaran::get();
            return response()->json($mataAnggaran);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
