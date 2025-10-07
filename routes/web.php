<?php

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test-wa', function () {
    $response = Http::withHeaders([
        'Authorization' => 'E8hd2JDQQ6jXMdT9fwDi', // GANTI dengan token kamu
    ])->post('https://api.fonnte.com/send', [
        'target' => '6289676849427', // GANTI dengan nomor yang sesuai
        'message' => 'Tes dari Laravel route',
    ]);

    return $response->json(); // Untuk melihat hasilnya
});

Route::get('/test-wa', function () {
    $today = Carbon::today()->format('Y-m-d');

    $schedules = Schedule::with(['employee', 'job'])
        ->whereDate('work_date', $today)
        ->get();

    $grouped = $schedules->groupBy(fn($s) => strtolower($s->job->shift ?? 'off'));

    $shiftLabel = ['pagi' => 'Pagi', 'siang' => 'Siang', 'sore' => 'Sore', 'malam' => 'Malam'];

    $message = "*Assalamualaikum wr.wb*\n\n";
    $message .= "Izin menyampaikan jadwal piket CS PPSDM Aparatur.\n";
    $message .= "Hari *" . Carbon::parse($today)->translatedFormat('l, d F Y') . "*\n\n";

    foreach (['pagi', 'siang', 'sore', 'malam'] as $shift) {
        if (!empty($grouped[$shift])) {
            $message .= "*" . $shiftLabel[$shift] . ":*\n";
            foreach ($grouped[$shift] as $item) {
                $message .= $item->job->name . ' - ' . $item->employee->name . "\n";
            }
            $message .= "\n";
        }
    }


    $response = Http::withHeaders([
        'Authorization' => 'E8hd2JDQQ6jXMdT9fwDi', // GANTI dengan token kamu
    ])->post('https://api.fonnte.com/send', [
        'target' => '6289676849427', // GANTI dengan nomor yang sesuai
        'message' => $message,
    ]);

    return $response->json();
});


Route::middleware('Kapus')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
        Route::get('/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
        Route::post('/store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
        Route::get('/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
        Route::post('/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
        Route::get('/destroy/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
    });

    Route::prefix('keuangan')->group(function () {
        Route::get('/', [App\Http\Controllers\KeuanganController::class, 'index'])->name('keuangan.index');
    });

    Route::prefix('kurikulum')->group(function () {
        Route::get('/', [App\Http\Controllers\KurikulumController::class, 'index'])->name('kurikulum.index');
    });

    // Route::prefix('role')->group(function () {
    //     Route::get('/', [App\Http\Controllers\RoleController::class, 'index'])->name('role.index');
    //     Route::get('/create', [App\Http\Controllers\RoleController::class, 'create'])->name('role.create');
    //     Route::post('/store', [App\Http\Controllers\RoleController::class, 'store'])->name('role.store');
    //     Route::get('/edit/{id}', [App\Http\Controllers\RoleController::class, 'edit'])->name('role.edit');
    //     Route::post('/update/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('role.update');
    //     Route::get('/destroy/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('role.destroy');
    // });
});


// Route hanya bisa di akses oleh Kapus dan Koordinator CS
Route::middleware('KapusOrCS')->group(function () {
    Route::prefix('os')->group(function () {
        Route::get('/', [App\Http\Controllers\OutsourcingController::class, 'index'])->name('os.index');
        Route::get('/create', [App\Http\Controllers\OutsourcingController::class, 'create'])->name('os.create');
        Route::get('/export-jadwal', [App\Http\Controllers\OutsourcingController::class, 'exportPdf'])->name('os.export.pdf');
        Route::post('/import', [App\Http\Controllers\OutsourcingController::class, 'import'])->name('os.import');
        Route::get('/formGenerate', [App\Http\Controllers\OutsourcingController::class, 'formGenerate'])->name('os.form-generate');
        Route::post('/generate', [App\Http\Controllers\OutsourcingController::class, 'scheduleGenerate'])->name('os.generate');
        Route::get('/edit/{id}', [App\Http\Controllers\OutsourcingController::class, 'edit'])->name('os.edit');
        Route::post('/update/{id}', [App\Http\Controllers\OutsourcingController::class, 'update'])->name('os.update');
        Route::get('/destroy/{id}', [App\Http\Controllers\OutsourcingController::class, 'destroy'])->name('os.destroy');
        Route::get('/summary', [App\Http\Controllers\OutsourcingController::class, 'jobSummary'])->name('os.summary');
        Route::get('/detailDate', [App\Http\Controllers\OutsourcingController::class, 'detailDate'])->name('os.detail-date');
        Route::get('/employee-list', [App\Http\Controllers\OutsourcingController::class, 'employeeList'])->name('os.employee-list');
        Route::get('/special-plot', [App\Http\Controllers\OutsourcingController::class, 'specialPlot'])->name('os.special-plot');
        Route::post('/special-plot-store', [App\Http\Controllers\OutsourcingController::class, 'specialPlotStore'])->name('os.special-plot-store');
        Route::get('/special-plot-destroy/{id}', [App\Http\Controllers\OutsourcingController::class, 'specialPlotDestroy'])->name('os.special-plot-destroy');
    });

    Route::prefix('monitoring-os')->group(function () {
        Route::get('/', [App\Http\Controllers\OutsourcingController::class, 'monitoring'])->name('monitoring.index');
        Route::get('/create', [App\Http\Controllers\OutsourcingController::class, 'create'])->name('monitoring.create');

        Route::get('/edit/{id}', [App\Http\Controllers\OutsourcingController::class, 'edit'])->name('monitoring.edit');
        Route::post('/update/{id}', [App\Http\Controllers\OutsourcingController::class, 'update'])->name('monitoring.update');
        Route::get('/destroy/{id}', [App\Http\Controllers\OutsourcingController::class, 'destroy'])->name('monitoring.destroy');
    });

    Route::prefix('employee')->group(function () {
        Route::get('/', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee.index');
        Route::get('/create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('employee.create');
        Route::post('/store', [App\Http\Controllers\EmployeeController::class, 'store'])->name('employee.store');
        Route::get('/edit/{id}', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employee.edit');
        Route::post('/update/{id}', [App\Http\Controllers\EmployeeController::class, 'update'])->name('employee.update');
        Route::get('/destroy/{id}', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('employee.destroy');
    });

    Route::prefix('jobs')->group(function () {
        Route::get('/', [App\Http\Controllers\JobsController::class, 'index'])->name('jobs.index');
        Route::get('/create', [App\Http\Controllers\JobsController::class, 'create'])->name('jobs.create');
        Route::post('/store', [App\Http\Controllers\JobsController::class, 'store'])->name('jobs.store');
        Route::get('/edit/{id}', [App\Http\Controllers\JobsController::class, 'edit'])->name('jobs.edit');
        Route::post('/update/{id}', [App\Http\Controllers\JobsController::class, 'update'])->name('jobs.update');
        Route::get('/destroy/{id}', [App\Http\Controllers\JobsController::class, 'destroy'])->name('jobs.destroy');
    });

    Route::prefix('holiday')->group(function () {
        Route::get('/', [App\Http\Controllers\HolidayController::class, 'index'])->name('holiday.index');
        Route::get('/create', [App\Http\Controllers\HolidayController::class, 'create'])->name('holiday.create');
        Route::post('/store', [App\Http\Controllers\HolidayController::class, 'store'])->name('holiday.store');
        Route::get('/edit/{id}', [App\Http\Controllers\HolidayController::class, 'edit'])->name('holiday.edit');
        Route::post('/update/{id}', [App\Http\Controllers\HolidayController::class, 'update'])->name('holiday.update');
        Route::get('/destroy/{id}', [App\Http\Controllers\HolidayController::class, 'destroy'])->name('holiday.destroy');
    });
});

Route::prefix('sppd')->group(function () {
    Route::get('/', [App\Http\Controllers\SPPDController::class, 'index'])->name('sppd.index');
});

Route::prefix('profile-kepeg')->group(function () {
    Route::get('/', [App\Http\Controllers\ProfileKepegController::class, 'index'])->name('profile-kepeg.index');
});
