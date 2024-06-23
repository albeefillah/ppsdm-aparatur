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

