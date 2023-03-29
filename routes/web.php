<?php

use App\Http\Controllers\BotolController;
use App\Http\Controllers\CapController;
use App\Http\Controllers\KartonController;
use App\Http\Controllers\LabelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VarianController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('Guest')->group(function() {
    Route::get('/login', [LoginController::class, 'index'])->name('login-page');
    Route::post('/login', [LoginController::class, 'authanticate'])->name('login.auth');
});

Route::get('/logout', [LoginController::class, 'logout']);


Route::middleware(['Login', 'checkRole:super admin'])->group(function () {
    Route::get('/dashboard/user-data', [UserController::class, 'index'])->name('user-index');
    Route::post('/dashboard/user-store', [UserController::class, 'store'])->name('user-store');
    Route::delete('/dashboard/user-delete/{id}', [UserController::class, 'destroy'])->name('delete-user');
    Route::get('/dashboard/edit-user/{id}', [UserController::class, 'edit'])->name('edit-user');
    Route::put('/dashboard/update-user/{id}', [UserController::class, 'update'])->name('update-user');

    Route::get('/dashboard/jenis-botol', [BotolController::class, 'index'])->name('jenis-botol-index');
    Route::post('/dashboard/jenis-botol/store', [BotolController::class, 'store'])->name('jenis-botol-store');
    Route::delete('/dashboard/jenis-botol-delete/{botol}', [BotolController::class, 'destroy'])->name('jenis-botol-delete');
    Route::get('/dashboard/jenis-botol-edit/{botol}', [BotolController::class, 'edit'])->name('jenis-botol-edit');
    Route::put('/dashboard/jenis-botol-update/{botol}', [BotolController::class, 'update'])->name('jenis-botol-update');

    Route::get('/dashboard/jenis-cap', [CapController::class, 'index'])->name('jenis-cap-index');
    Route::post('/dashboard/jenis-cap/store', [CapController::class, 'store'])->name('jenis-cap-store');
    Route::delete('/dashboard/jenis-cap-delete/{cap}', [CapController::class, 'destroy'])->name('jenis-cap-delete');
    Route::get('/dashboard/jenis-cap-edit/{cap}', [CapController::class, 'edit'])->name('jenis-cap-edit');
    Route::put('/dashboard/jenis-cap-update/{cap}', [CapController::class, 'update'])->name('jenis-cap-update');

    Route::get('/dashboard/jenis-label', [LabelController::class, 'index'])->name('jenis-label-index');
    Route::post('/dashboard/jenis-label/store', [LabelController::class, 'store'])->name('jenis-label-store');
    Route::delete('/dashboard/jenis-label-delete/{label}', [LabelController::class, 'destroy'])->name('jenis-label-delete');
    Route::get('/dashboard/jenis-label-edit/{label}', [LabelController::class, 'edit'])->name('jenis-label-edit');
    Route::put('/dashboard/jenis-label-update/{label}', [LabelController::class, 'update'])->name('jenis-label-update');

    Route::get('/dashboard/jenis-karton', [KartonController::class, 'index'])->name('jenis-karton-index');
    Route::post('/dashboard/jenis-karton/store', [KartonController::class, 'store'])->name('jenis-karton-store');
    Route::delete('/dashboard/jenis-karton-delete/{karton}', [KartonController::class, 'destroy'])->name('jenis-karton-delete');
    Route::get('/dashboard/jenis-karton-edit/{karton}', [KartonController::class, 'edit'])->name('jenis-karton-edit');
    Route::put('/dashboard/jenis-karton-update/{karton}', [KartonController::class, 'update'])->name('jenis-karton-update');
});

Route::middleware(['Login'])->prefix('dashboard')->group(function () {
    Route::get('/produksi', [VarianController::class, 'index'])->name('varian-index');
    Route::post('/produksi-post', [VarianController::class, 'store'])->name('varian-store');
});


Route::get('/', function () {
    return view('home.index');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

