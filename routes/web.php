<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/maintenance', [App\Http\Controllers\HomeController::class, 'maintenance']);

// API Input RKAKL
Route::get('/get-kegiatan', [App\Http\Controllers\Anggaran\RKAKLController::class, 'getKegiatanProgram']);
Route::get('/get-kro', [App\Http\Controllers\Anggaran\RKAKLController::class, 'getKRO']);
Route::get('/get-rincian', [App\Http\Controllers\Anggaran\RKAKLController::class, 'getRincian']);
Route::get('/get-subkom', [App\Http\Controllers\Anggaran\RKAKLController::class, 'getSubkom']);
Route::get('/get-detkom', [App\Http\Controllers\Anggaran\RKAKLController::class, 'getDetkom']);
Route::get('/get-matang', [App\Http\Controllers\Anggaran\RKAKLController::class, 'getMataAnggaran']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('Keuangan')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
        Route::get('/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
        Route::post('/store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
        Route::get('/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
        Route::post('/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
        Route::get('/destroy/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
    });

    // Route::pref  ix('role')->group(function () {
    //     Route::get('/', [App\Http\Controllers\RoleController::class, 'index'])->name('role.index');
    //     Route::get('/create', [App\Http\Controllers\RoleController::class, 'create'])->name('role.create');
    //     Route::post('/store', [App\Http\Controllers\RoleController::class, 'store'])->name('role.store');
    //     Route::get('/edit/{id}', [App\Http\Controllers\RoleController::class, 'edit'])->name('role.edit');
    //     Route::post('/update/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('role.update');
    //     Route::get('/destroy/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('role.destroy');
    // });

    Route::prefix('mata-anggaran')->group(function () {
        Route::get('/', [App\Http\Controllers\MataAnggaranController::class, 'index'])->name('mata_anggaran.index');
        Route::get('/create', [App\Http\Controllers\MataAnggaranController::class, 'create'])->name('mata_anggaran.create');
        Route::post('/store', [App\Http\Controllers\MataAnggaranController::class, 'store'])->name('mata_anggaran.store');
        Route::get('/edit/{id}', [App\Http\Controllers\MataAnggaranController::class, 'edit'])->name('mata_anggaran.edit');
        Route::post('/update/{id}', [App\Http\Controllers\MataAnggaranController::class, 'update'])->name('mata_anggaran.update');
        Route::get('/destroy/{id}', [App\Http\Controllers\MataAnggaranController::class, 'destroy'])->name('mata_anggaran.destroy');
    });
    
    Route::prefix('program-ppsdm')->group(function () {
        Route::get('/kegiatan-program', [App\Http\Controllers\ProgramPPSDM\KegiatanProgramController::class, 'index'])->name('kegiatan-program.index');
        Route::get('/kegiatan-program/create', [App\Http\Controllers\ProgramPPSDM\KegiatanProgramController::class, 'create'])->name('kegiatan-program.create');
        Route::post('/kegiatan-program/store', [App\Http\Controllers\ProgramPPSDM\KegiatanProgramController::class, 'store'])->name('kegiatan-program.store');
        Route::get('/kegiatan-program/edit/{id}', [App\Http\Controllers\ProgramPPSDM\KegiatanProgramController::class, 'edit'])->name('kegiatan-program.edit');
        Route::post('/kegiatan-program/update/{id}', [App\Http\Controllers\ProgramPPSDM\KegiatanProgramController::class, 'update'])->name('kegiatan-program.update');
        Route::get('/kegiatan-program/destroy/{id}', [App\Http\Controllers\ProgramPPSDM\KegiatanProgramController::class, 'destroy'])->name('kegiatan-program.destroy');
   
        Route::get('/kro', [App\Http\Controllers\ProgramPPSDM\KROController::class, 'index'])->name('kro.index');
        Route::get('/kro/create', [App\Http\Controllers\ProgramPPSDM\KROController::class, 'create'])->name('kro.create');
        Route::post('/kro/store', [App\Http\Controllers\ProgramPPSDM\KROController::class, 'store'])->name('kro.store');
        Route::get('/kro/edit/{id}', [App\Http\Controllers\ProgramPPSDM\KROController::class, 'edit'])->name('kro.edit');
        Route::post('/kro/update/{id}', [App\Http\Controllers\ProgramPPSDM\KROController::class, 'update'])->name('kro.update');
        Route::get('/kro/destroy/{id}', [App\Http\Controllers\ProgramPPSDM\KROController::class, 'destroy'])->name('kro.destroy');
   
        Route::get('/rincian-output', [App\Http\Controllers\ProgramPPSDM\RincianOutputController::class, 'index'])->name('rincian-output.index');
        Route::get('/rincian-output/create', [App\Http\Controllers\ProgramPPSDM\RincianOutputController::class, 'create'])->name('rincian-output.create');
        Route::post('/rincian-output/store', [App\Http\Controllers\ProgramPPSDM\RincianOutputController::class, 'store'])->name('rincian-output.store');
        Route::get('/rincian-output/edit/{id}', [App\Http\Controllers\ProgramPPSDM\RincianOutputController::class, 'edit'])->name('rincian-output.edit');
        Route::post('/rincian-output/update/{id}', [App\Http\Controllers\ProgramPPSDM\RincianOutputController::class, 'update'])->name('rincian-output.update');
        Route::get('/rincian-output/destroy/{id}', [App\Http\Controllers\ProgramPPSDM\RincianOutputController::class, 'destroy'])->name('rincian-output.destroy');
   
        Route::get('/sub-komponen', [App\Http\Controllers\ProgramPPSDM\SubKomponenController::class, 'index'])->name('sub-komponen.index');
        Route::get('/sub-komponen/create', [App\Http\Controllers\ProgramPPSDM\SubKomponenController::class, 'create'])->name('sub-komponen.create');
        Route::post('/sub-komponen/store', [App\Http\Controllers\ProgramPPSDM\SubKomponenController::class, 'store'])->name('sub-komponen.store');
        Route::get('/sub-komponen/edit/{id}', [App\Http\Controllers\ProgramPPSDM\SubKomponenController::class, 'edit'])->name('sub-komponen.edit');
        Route::post('/sub-komponen/update/{id}', [App\Http\Controllers\ProgramPPSDM\SubKomponenController::class, 'update'])->name('sub-komponen.update');
        Route::get('/sub-komponen/destroy/{id}', [App\Http\Controllers\ProgramPPSDM\SubKomponenController::class, 'destroy'])->name('sub-komponen.destroy');
   
        Route::get('/detail-komponen', [App\Http\Controllers\ProgramPPSDM\DetailKomponenController::class, 'index'])->name('detail-komponen.index');
        Route::get('/detail-komponen/create', [App\Http\Controllers\ProgramPPSDM\DetailKomponenController::class, 'create'])->name('detail-komponen.create');
        Route::post('/detail-komponen/store', [App\Http\Controllers\ProgramPPSDM\DetailKomponenController::class, 'store'])->name('detail-komponen.store');
        Route::get('/detail-komponen/edit/{id}', [App\Http\Controllers\ProgramPPSDM\DetailKomponenController::class, 'edit'])->name('detail-komponen.edit');
        Route::post('/detail-komponen/update/{id}', [App\Http\Controllers\ProgramPPSDM\DetailKomponenController::class, 'update'])->name('detail-komponen.update');
        Route::get('/detail-komponen/destroy/{id}', [App\Http\Controllers\ProgramPPSDM\DetailKomponenController::class, 'destroy'])->name('detail-komponen.destroy');
    }); 
    
    Route::prefix('rkakl')->group(function () {

        Route::get('/', [App\Http\Controllers\Anggaran\RKAKLController::class, 'index'])->name('rkakl.index');
        Route::get('/create', [App\Http\Controllers\Anggaran\RKAKLController::class, 'create'])->name('rkakl.create');
        Route::get('/dummy-akun', [App\Http\Controllers\Anggaran\RKAKLController::class, 'dummyAkun'])->name('rkakl.dummy-akun');
        Route::post('/store', [App\Http\Controllers\Anggaran\RKAKLController::class, 'store'])->name('rkakl.store');
        Route::get('/edit/{id}', [App\Http\Controllers\Anggaran\RKAKLController::class, 'edit'])->name('rkakl.edit');
        Route::put('/update/{id}', [App\Http\Controllers\Anggaran\RKAKLController::class, 'update'])->name('rkakl.update');
        Route::get('/destroy/{id}', [App\Http\Controllers\Anggaran\RKAKLController::class, 'destroy'])->name('rkakl.destroy');
        
        Route::post('/import', [App\Http\Controllers\Anggaran\RKAKLController::class, 'importRKAKL'])->name('rkakl.import');
    
        // Route::get('/list-akun', [App\Http\Controllers\Anggaran\RKAKLController::class, 'listAkun'])->name('rkakl.list-akun');
        // Route::get('/tambah-akun', [App\Http\Controllers\Anggaran\RKAKLController::class, 'tambahAkun'])->name('rkakl.tambah-akun');
        // Route::post('/store-akun', [App\Http\Controllers\Anggaran\RKAKLController::class, 'storeAkun'])->name('rkakl.store-akun');
        // Route::get('/update-akun', [App\Http\Controllers\Anggaran\RKAKLController::class, 'updateAkun'])->name('rkakl.update-akun');
        // Route::get('/destroy-akun', [App\Http\Controllers\Anggaran\RKAKLController::class, 'destroyAkun'])->name('rkakl.destroy-akun');
        
        Route::get('/list-pokja/{id}', [App\Http\Controllers\Anggaran\RKAKLController::class, 'listPokja'])->name('rkakl.list-pokja');
        Route::get('/pokja-detail/{id}', [App\Http\Controllers\Anggaran\RKAKLController::class, 'detailPokja'])->name('rkakl.detail-pokja');
        // Route::get('/tambah-akun', [App\Http\Controllers\Anggaran\RKAKLController::class, 'tambahAkun'])->name('rkakl.tambah-akun');
        // Route::post('/store-akun', [App\Http\Controllers\Anggaran\RKAKLController::class, 'storeAkun'])->name('rkakl.store-akun');
        // Route::get('/update-akun', [App\Http\Controllers\Anggaran\RKAKLController::class, 'updateAkun'])->name('rkakl.update-akun');
        // Route::get('/destroy-akun', [App\Http\Controllers\Anggaran\RKAKLController::class, 'destroyAkun'])->name('rkakl.destroy-akun');
       
        Route::get('/kegiatan', [App\Http\Controllers\Anggaran\RencanaController::class, 'kegiatan'])->name('kegiatan.index');
        Route::get('/kegiatan-dummy', [App\Http\Controllers\Anggaran\RencanaController::class, 'kegiatanDummy'])->name('kegiatan.index-dummy');
        Route::get('/kegiatan/create', [App\Http\Controllers\Anggaran\RencanaController::class, 'kegiatanCreate'])->name('kegiatan.create');
        Route::get('/kegiatan/create-dummy', [App\Http\Controllers\Anggaran\RencanaController::class, 'kegiatanCreateDummy'])->name('kegiatan.create-dummy');
       
    });


    Route::prefix('pengawasan')->group(function () {
        Route::get('/realisasi', [App\Http\Controllers\Pengawasan\RealisasiController::class, 'index'])->name('realisasi.index');
        Route::get('/realisasi/create', [App\Http\Controllers\Pengawasan\RealisasiController::class, 'create'])->name('realisasi.create');
        Route::post('/realisasi/store', [App\Http\Controllers\Pengawasan\RealisasiController::class, 'store'])->name('realisasi.store');
        Route::get('/realisasi/edit/{id}', [App\Http\Controllers\Pengawasan\RealisasiController::class, 'edit'])->name('realisasi.edit');
        Route::post('/realisasi/update/{id}', [App\Http\Controllers\Pengawasan\RealisasiController::class, 'update'])->name('realisasi.update');
        Route::get('/realisasi/destroy/{id}', [App\Http\Controllers\Pengawasan\RealisasiController::class, 'destroy'])->name('realisasi.destroy');
    });
});

// Route::middleware('BPAUP')->group(function () {
    Route::prefix('anggaran')->group(function () {

        Route::get('/rencana', [App\Http\Controllers\Anggaran\RencanaController::class, 'index'])->name('rencana.index');
        Route::get('/rencana/create', [App\Http\Controllers\Anggaran\RencanaController::class, 'create'])->name('rencana.create');
        
        Route::get('/rencana/tambah-akun', [App\Http\Controllers\Anggaran\RencanaController::class, 'tambahAkun'])->name('rencana.tambah-akun');
        Route::get('/rencana/dummy-akun', [App\Http\Controllers\Anggaran\RencanaController::class, 'dummyAkun'])->name('rencana.dummy-akun');

        Route::post('/rencana/isi-pagu', [App\Http\Controllers\Anggaran\RencanaController::class, 'isiPagu'])->name('rencana.isi-pagu');
        Route::post('/rencana/store', [App\Http\Controllers\Anggaran\RencanaController::class, 'store'])->name('rencana.store');
        Route::get('/rencana/edit/{id}', [App\Http\Controllers\Anggaran\RencanaController::class, 'edit'])->name('rencana.edit');
        Route::post('/rencana/update/{id}', [App\Http\Controllers\Anggaran\RencanaController::class, 'update'])->name('rencana.update');
        Route::get('/rencana/destroy/{id}', [App\Http\Controllers\Anggaran\RencanaController::class, 'destroy'])->name('rencana.destroy');

        Route::get('/list-akun', [App\Http\Controllers\Anggaran\RencanaController::class, 'listAkun'])->name('rencana.list-akun');
        Route::get('/tambah-akun', [App\Http\Controllers\Anggaran\RencanaController::class, 'tambahAkun'])->name('rencana.tambah-akun');
        Route::post('/store-akun', [App\Http\Controllers\Anggaran\RencanaController::class, 'storeAkun'])->name('rencana.store-akun');
        Route::get('/update-akun', [App\Http\Controllers\Anggaran\RencanaController::class, 'updateAkun'])->name('rencana.update-akun');
        Route::get('/destroy-akun', [App\Http\Controllers\Anggaran\RencanaController::class, 'destroyAkun'])->name('rencana.destroy-akun');
    });


// });



Route::prefix('rekap')->group(function () {
    Route::get('/', [App\Http\Controllers\RekapController::class, 'index'])->name('rekap.index');
    Route::get('/create', [App\Http\Controllers\RekapController::class, 'create'])->name('rekap.create');
    Route::post('/store', [App\Http\Controllers\RekapController::class, 'store'])->name('rekap.store');
    Route::get('/edit/{id}', [App\Http\Controllers\RekapController::class, 'edit'])->name('rekap.edit');
    Route::post('/update/{id}', [App\Http\Controllers\RekapController::class, 'update'])->name('rekap.update');
    Route::get('/destroy/{id}', [App\Http\Controllers\RekapController::class, 'destroy'])->name('rekap.destroy');
});

Route::prefix('spd')->group(function () {
    Route::get('/', [App\Http\Controllers\SPDController::class, 'index'])->name('spd.index');
    Route::get('/create', [App\Http\Controllers\SPDController::class, 'create'])->name('spd.create');
    Route::post('/store', [App\Http\Controllers\SPDController::class, 'store'])->name('spd.store');
    Route::get('/edit/{id}', [App\Http\Controllers\SPDController::class, 'edit'])->name('spd.edit');
    Route::post('/update/{id}', [App\Http\Controllers\SPDController::class, 'update'])->name('spd.update');
    Route::get('/destroy/{id}', [App\Http\Controllers\SPDController::class, 'destroy'])->name('spd.destroy');

    Route::get('/pelaksana/{id}', [App\Http\Controllers\SPDController::class, 'pelaksanaIndex'])->name('spd.pelaksana.index');
    Route::get('/pelaksana/create/peserta', [App\Http\Controllers\SPDController::class, 'pesertaCreate'])->name('spd.peserta.create');
    Route::get('/pelaksana/create/nonpeserta', [App\Http\Controllers\SPDController::class, 'nonPesertaCreate'])->name('spd.nonpeserta.create');
    Route::get('/pelaksana/store/peserta', [App\Http\Controllers\SPDController::class, 'pesertaStore'])->name('spd.peserta.store');
});


