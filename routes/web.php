<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\AcaraController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\OrangTuaController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CheckinTamuController;
use App\Http\Controllers\DetailAcaraController;
use App\Http\Controllers\MonitoringController;

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
    
    Route::get('login',[AuthController::class, 'login'])->name('login');
    Route::post('login',[AuthController::class, 'prosesLogin']);

});

Route::get('/display', [MonitoringController::class, 'index'])->name('display');

Route::middleware('auth')->group(function () {
    Route::get('logout',[AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard',[DashboardController::class, 'index'])->name('dashboard');
    
    Route::prefix('master')->group(function () {
        Route::resource('acara', AcaraController::class);
        Route::resource('detail-acara', DetailAcaraController::class);
        Route::resource('orang-tua', OrangTuaController::class);
        Route::resource('galeri', GaleriController::class);
        Route::resource('rekening', RekeningController::class);
    });
    
    Route::resource('tamu', TamuController::class);
    Route::get('check-in-tamu',[CheckinTamuController::class, 'index'])->name('checkin.index');
    Route::post('check-in-tamu-scanner', [CheckinTamuController::class, 'scanner'])->name('scanner');
});
