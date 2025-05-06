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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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

    Route::prefix('os')->group(function () {
        Route::get('/', [App\Http\Controllers\OutsourcingController::class, 'index'])->name('os.index');
        Route::get('/create', [App\Http\Controllers\OutsourcingController::class, 'create'])->name('os.create');
        Route::get('/export', [App\Http\Controllers\OutsourcingController::class, 'export'])->name('os.export');
        Route::post('/import', [App\Http\Controllers\OutsourcingController::class, 'import'])->name('os.import');
        Route::get('/formGenerate', [App\Http\Controllers\OutsourcingController::class, 'formGenerate'])->name('os.form-generate');
        Route::post('/generate', [App\Http\Controllers\OutsourcingController::class, 'scheduleGenerate'])->name('os.generate');
        Route::get('/edit/{id}', [App\Http\Controllers\OutsourcingController::class, 'edit'])->name('os.edit');
        Route::post('/update/{id}', [App\Http\Controllers\OutsourcingController::class, 'update'])->name('os.update');
        Route::get('/destroy/{id}', [App\Http\Controllers\OutsourcingController::class, 'destroy'])->name('os.destroy');
        Route::get('/summary', [App\Http\Controllers\OutsourcingController::class, 'jobSummary'])->name('os.summary');
        Route::get('/employee-list', [App\Http\Controllers\OutsourcingController::class, 'employeeList'])->name('os.employee-list');
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

    // Route::pref  ix('role')->group(function () {
    //     Route::get('/', [App\Http\Controllers\RoleController::class, 'index'])->name('role.index');
    //     Route::get('/create', [App\Http\Controllers\RoleController::class, 'create'])->name('role.create');
    //     Route::post('/store', [App\Http\Controllers\RoleController::class, 'store'])->name('role.store');
    //     Route::get('/edit/{id}', [App\Http\Controllers\RoleController::class, 'edit'])->name('role.edit');
    //     Route::post('/update/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('role.update');
    //     Route::get('/destroy/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('role.destroy');
    // });
});

Route::prefix('sppd')->group(function () {
    Route::get('/', [App\Http\Controllers\SPPDController::class, 'index'])->name('sppd.index');
});

Route::prefix('profile-kepeg')->group(function () {
    Route::get('/', [App\Http\Controllers\ProfileKepegController::class, 'index'])->name('profile-kepeg.index');
});
