<?php

use App\Http\Controllers\BatchController;
use App\Http\Controllers\BatchListController;
use App\Http\Controllers\BotolController;
use App\Http\Controllers\CapController;
use App\Http\Controllers\CounterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DensityController;
use App\Http\Controllers\FinishGoodController;
use App\Http\Controllers\KartonController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\LakbanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\ParameterVarianController;
use App\Http\Controllers\ProcessingController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\SampelController;
use App\Http\Controllers\TempatController;
use App\Http\Controllers\TrialController;
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

    Route::get('/dashboard/jenis-lakban', [LakbanController::class, 'index'])->name('jenis-lakban-index');
    Route::post('/dashboard/jenis-lakban/store', [LakbanController::class, 'store'])->name('jenis-lakban-store');
    Route::delete('/dashboard/jenis-lakban-delete/{lakban}', [LakbanController::class, 'destroy'])->name('jenis-lakban-delete');
    Route::get('/dashboard/jenis-lakban-edit/{lakban}', [LakbanController::class, 'edit'])->name('jenis-lakban-edit');
    Route::put('/dashboard/jenis-lakban-update/{lakban}', [LakbanController::class, 'update'])->name('jenis-lakban-update');

    Route::get('/dashboard/botol-produksi', [VarianController::class, 'botolProduksiIndex'])->name('botol-produksi');
    Route::put('/dashboard/botol-produksi/store', [VarianController::class, 'botolProduksi'])->name('botol-produksi-store');

    Route::get('/dashboard/botol-produksi/cap-produksi', [VarianController::class, 'capProduksiIndex'])->name('cap-produksi');
    Route::put('/dashboard/cap-produksi/store', [VarianController::class, 'capProduksi'])->name('cap-produksi-store');

    Route::get('/dashboard/reject-produksi', [VarianController::class, 'rejectIndex'])->name('reject');
    Route::put('/dashboard/reject/store', [VarianController::class, 'reject'])->name('reject-store');

    // Route::get('/dashboard/reject-produksi/{id}/edit', [VarianController::class, 'rejectEdit'])->name('reject-edit');
    // Route::put('/dashboard/reject-produksi/{id}/update', [VarianController::class, 'rejecUpdate'])->name('reject-update');
    // Route::delete('/produksi/{id}/delete', [VarianController::class, 'rejectDestroy'])->name('reject-delete');

    Route::get('/dashboard/density', [DensityController::class, 'index'])->name('density-index');
    Route::post('/dashboard/density/store', [DensityController::class, 'store'])->name('density-store');
    Route::get('/dashboard/density/{density}/edit', [DensityController::class, 'edit'])->name('density-edit');
    Route::put('/dashboard/density/{density}/update', [DensityController::class, 'update'])->name('density-update');
    Route::delete('/produksi/density/{density}/delete', [DensityController::class, 'destroy'])->name('density-delete');

    Route::get('/dashboard/produksi', [ProduksiController::class, 'index'])->name('produksi-index');
    Route::post('/dashboard/produksi/store', [ProduksiController::class, 'store'])->name('produksi-store');
    // Route::get('/dashboard/density/{density}/edit', [DensityController::class, 'edit'])->name('density-edit');
    // Route::put('/dashboard/density/{density}/update', [DensityController::class, 'update'])->name('density-update');
    // Route::delete('/produksi/density/{density}/delete', [DensityController::class, 'destroy'])->name('density-delete');

    Route::get('/dashboard/produksi/{id}/batch-list', [BatchListController::class, 'index'])->name('batch-list-index');
    Route::post('/dashboard/produksi/{id}/batch-list/store', [BatchListController::class, 'store'])->name('batch-list-store');
    // Route::get('/dashboard/density/{density}/edit', [DensityController::class, 'edit'])->name('density-edit');
    // Route::put('/dashboard/density/{density}/update', [DensityController::class, 'update'])->name('density-update');
    // Route::delete('/produksi/density/{density}/delete', [DensityController::class, 'destroy'])->name('density-delete');

    Route::get('/dashboard/{id}/batch', [BatchController::class, 'index'])->name('batch-index');
    Route::post('/dashboard/{id}/batch/store', [BatchController::class, 'store'])->name('batch-store');

    Route::get('/dashboard/reject-produksi/{produksi_id}/botol/{batch_id}', [VarianController::class, 'rejectBotol'])->name('reject-botol-index');
    Route::post('/dashboard/reject-produksi/{produksi_id}/botol/{batch_id}/store', [VarianController::class, 'rejectBotolStore'])->name('reject-botol-store');
    Route::get('/dashboard/reject-produksi/botol-edit/{reject}', [VarianController::class, 'rejectBotolEdit'])->name('reject-botol-edit');
    Route::put('/dashboard/reject/produksi/botol-update/{reject}', [VarianController::class, 'rejectBotolUpdate'])->name('reject-botol-update');
    Route::delete('/dashboard/reject/produksi/botol-delete/{reject}', [VarianController::class, 'rejectBotolDestroy'])->name('reject-botol-delete');

    Route::get('/dashboard/reject-produksi/{produksi_id}/cap/{batch_id}', [VarianController::class, 'rejectCap'])->name('reject-cap-index');
    Route::post('/dashboard/reject-produksi/{produksi_id}/cap/{batch_id}/store', [VarianController::class, 'rejectCapStore'])->name('reject-cap-store');
    Route::get('/dashboard/reject-produksi/cap-edit/{reject}', [VarianController::class, 'rejectCapEdit'])->name('reject-cap-edit');
    Route::put('/dashboard/reject/produksi/cap-update/{reject}', [VarianController::class, 'rejectCapUpdate'])->name('reject-cap-update');
    Route::delete('/dashboard/reject/produksi/cap-delete/{reject}', [VarianController::class, 'rejectCapDestroy'])->name('reject-cap-delete');

    Route::get('/dashboard/sampel-produksi/{produksi_id}/botol/{batch_id}', [SampelController::class, 'indexBotol'])->name('sampel-botol-index');
    Route::post('/dashboard/sampel-produksi/{produksi_id}/botol/{batch_id}/store', [SampelController::class, 'storeBotol'])->name('sampel-botol-store');
    Route::get('/dashboard/sampel-produksi/botol-edit/{sampel}', [SampelController::class, 'editBotol'])->name('sampel-botol-edit');
    Route::put('/dashboard/sampel/produksi/botol-update/{sampel}', [SampelController::class, 'updateBotol'])->name('sampel-botol-update');
    Route::delete('/dashboard/sampel/produksi/botol-delete/{sampel}', [SampelController::class, 'destroyBotol'])->name('sampel-botol-delete');

    Route::get('/dashboard/sampel-produksi/{produksi_id}/cap/{batch_id}', [SampelController::class, 'indexCap'])->name('sampel-cap-index');
    Route::post('/dashboard/sampel-produksi/{produksi_id}/cap/{batch_id}/store', [SampelController::class, 'storeCap'])->name('sampel-cap-store');
    Route::get('/dashboard/sampel-produksi/cap-edit/{sampel}', [SampelController::class, 'editCap'])->name('sampel-cap-edit');
    Route::put('/dashboard/sampel/produksi/cap-update/{sampel}', [SampelController::class, 'updateCap'])->name('sampel-cap-update');
    Route::delete('/dashboard/sampel/produksi/cap-delete/{sampel}', [SampelController::class, 'destroyCap'])->name('sampel-cap-delete');

    Route::get('/dashboard/{id}/loss-liquid', [ProcessingController::class, 'index'])->name('processing-index');
    Route::post('/dashboard/{id}/loss-liquid/store', [ProcessingController::class, 'store'])->name('processing-store');
    Route::get('/dashboard/{id}/loss-liquid/{processing}/edit', [ProcessingController::class, 'edit'])->name('processing-edit');
    Route::put('/dashboard/{id}/loss-liquid/{processing}/update', [ProcessingController::class, 'update'])->name('processing-update');
    Route::delete('/dashboard/{id}/loss-liquid/{processing}/delete', [ProcessingController::class, 'destroy'])->name('processing-delete');

    Route::post('/dashboard/{produksi_id}/finish-good/{batch_id}/store', [FinishGoodController::class, 'store'])->name('finish-store');

    Route::get('/dashboard/{produksi_id}/cap/{batch_id}/trial', [TrialController::class, 'indexCap'])->name('trial-cap');
    Route::post('/dashboard/{produksi_id}/cap/{batch_id}/trial/store', [TrialController::class, 'capStore'])->name('trial-cap-store');

    Route::get('/dashboard/{produksi_id}/botol/{batch_id}/trial', [TrialController::class, 'indexBotol'])->name('trial-botol');
    Route::post('/dashboard/{produksi_id}/botol/{batch_id}/trial/store', [TrialController::class, 'botolStore'])->name('trial-botol-store');

    Route::get('/dashboard/{produksi_id}/botol/{batch_id}/trial/{id}/edit', [TrialController::class, 'edit'])->name('trial-edit');
    Route::put('/dashboard/{produksi_id}/botol/{batch_id}/trial/{id}/update', [TrialController::class, 'update'])->name('trial-update');
    Route::delete('/dashboard/trial/{id}/delete', [TrialController::class, 'delete'])->name('trial-delete');



    Route::get('/dashboard/spesifik-tempat', [TempatController::class, 'indexSpesifik'])->name('spesifik-tempat-index');
    Route::post('/dashboard/spesifik-tempat/store', [TempatController::class, 'storeSpesifik'])->name('spesifik-tempat-store');
    Route::delete('/dashboard/spesifik-tempat-delete/{spesifikTempat}', [TempatController::class, 'destroySpesifik'])->name('spesifik-tempat-delete');
    Route::get('/dashboard/spesifik-tempat-edit/{spesifikTempat}', [TempatController::class, 'editSpesifik'])->name('spesifik-tempat-edit');
    Route::put('/dashboard/spesifik-tempat-update/{spesifikTempat}', [TempatController::class, 'updateSpesifik'])->name('spesifik-tempat-update');

    Route::get('/dashboard/tempat', [TempatController::class, 'indexTempat'])->name('tempat-index');
    Route::post('/dashboard/tempat/store', [TempatController::class, 'storeTempat'])->name('tempat-store');
    Route::delete('/dashboard/tempat-delete/{tempatReject}', [TempatController::class, 'destroyTempat'])->name('tempat-delete');
    Route::get('/dashboard/tempat-edit/{tempatReject}', [TempatController::class, 'editTempat'])->name('tempat-edit');
    Route::put('/dashboard/tempat-update/{tempatReject}', [TempatController::class, 'updateTempat'])->name('tempat-update');

    Route::get('/dashboard/parameter-reject', [ParameterController::class, 'indexReject'])->name('parameter-reject-index');
    Route::post('/dashboard/parameter-reject/store', [ParameterController::class, 'storeReject'])->name('parameter-reject-store');
    Route::delete('/dashboard/parameter-reject-delete/{parameterReject}', [ParameterController::class, 'destroyReject'])->name('parameter-reject-delete');
    Route::get('/dashboard/parameter-reject-edit/{parameterReject}', [ParameterController::class, 'editReject'])->name('parameter-reject-edit');
    Route::put('/dashboard/parameter-reject-update/{parameterReject}', [ParameterController::class, 'updateReject'])->name('parameter-reject-update');

    Route::get('/dashboard/parameter-sampel', [ParameterController::class, 'indexSampel'])->name('parameter-sampel-index');
    Route::post('/dashboard/parameter-sampel/store', [ParameterController::class, 'storeSampel'])->name('parameter-sampel-store');
    Route::delete('/dashboard/parameter-sampel-delete/{parameterSampel}', [ParameterController::class, 'destroySampel'])->name('parameter-sampel-delete');
    Route::get('/dashboard/parameter-sampel-edit/{parameterSampel}', [ParameterController::class, 'editSampel'])->name('parameter-sampel-edit');
    Route::put('/dashboard/parameter-sampel-update/{parameterSampel}', [ParameterController::class, 'updateSampel'])->name('parameter-sampel-update');

    Route::get('/dashboard/parameter-varian', [ParameterVarianController::class, 'index'])->name('parameter-varian-index');
    Route::post('/dashboard/parameter-varian/store', [ParameterVarianController::class, 'store'])->name('parameter-varian-store');
    Route::delete('/dashboard/parameter-varian-delete/{parameterVarian}', [ParameterVarianController::class, 'destroy'])->name('parameter-varian-delete');
    Route::get('/dashboard/parameter-varian-edit/{parameterVarian}', [ParameterVarianController::class, 'edit'])->name('parameter-varian-edit');
    Route::put('/dashboard/parameter-varian-update/{parameterVarian}', [ParameterVarianController::class, 'update'])->name('parameter-varian-update');

     Route::get('/dashboard/{produksi_id}/counter/{batch_id}/{param_id}', [CounterController::class, 'index'])->name('counter-index');
    Route::post('/dashboard/{produksi_id}/counter/{batch_id}/{param_id}/store', [CounterController::class, 'store'])->name('counter-store');

    Route::get('/dashboard/{produksi_id}/counter/{batch_id}/{id}/edit', [CounterController::class, 'edit'])->name('counter-edit');
    Route::put('/dashboard/{produksi_id}/counter/{batch_id}/{id}/update', [CounterController::class, 'update'])->name('counter-update');
    Route::delete('/dashboard/trial/{id}/delete', [CounterController::class, 'delete'])->name('trial-delete');

});


Route::middleware(['Login'])->prefix('dashboard')->group(function () {
    Route::get('/varian', [VarianController::class, 'index'])->name('varian-index');
    Route::post('/varian-post', [VarianController::class, 'store'])->name('varian-store');
    Route::get('/varian/{varian}/edit', [VarianController::class, 'edit'])->name('varian-edit');
    Route::put('/varian/{varian}/update', [VarianController::class, 'update'])->name('varian-update');
    Route::delete('/varian/{varian}/delete', [VarianController::class, 'destroy'])->name('varian-delete');
    Route::get('/varian/detail/{id}', [VarianController::class, 'detail'])->name('varian-detail');

    Route::put('/varian/detail/{id}/botol', [VarianController::class, 'botolStore'])->name('botol-detail-store');
    Route::put('/varian/detail/{id}/cap', [VarianController::class, 'capStore'])->name('cap-detail-store');
    Route::put('/varian/detail/{id}/label', [VarianController::class, 'labelStore'])->name('label-detail-store');
    Route::put('/varian/detail/{id}/karton', [VarianController::class, 'kartonStore'])->name('karton-detail-store');
    Route::put('/varian/detail/{id}/lakban', [VarianController::class, 'lakbanStore'])->name('lakban-detail-store');


});


Route::get('/', function () {
    return view('home.index');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard-index');


