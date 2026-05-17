<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PACController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengaturanController;


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| DASHBOARD AREA
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | ANGGOTA
    |--------------------------------------------------------------------------
    */

    Route::prefix('anggota')->group(function () {

        Route::get('/', [AnggotaController::class, 'index']);

        Route::post('/store', [AnggotaController::class, 'store']);

        Route::put('/update/{id}', [AnggotaController::class, 'update']);

        Route::delete('/delete/{id}', [AnggotaController::class, 'destroy']);

        Route::get('/{id}', [AnggotaController::class, 'show']);
    });


    /*
    |--------------------------------------------------------------------------
    | PAC
    |--------------------------------------------------------------------------
    */

    Route::prefix('data-pac')->group(function () {

        Route::get('/', [PACController::class, 'index']);

        Route::post('/store', [PACController::class, 'store']);

        Route::put('/update/{id}', [PACController::class, 'update']);

        Route::delete('/delete/{id}', [PACController::class, 'destroy']);

        Route::get('/{id}', [PACController::class, 'show']);
    });


    /*
    |--------------------------------------------------------------------------
    | KEGIATAN
    |--------------------------------------------------------------------------
    */

    Route::prefix('kegiatan')->group(function () {

        Route::get('/', [KegiatanController::class, 'index']);

        Route::post('/store', [KegiatanController::class, 'store']);

        Route::put('/update/{id}', [KegiatanController::class, 'update']);

        Route::delete('/delete/{id}', [KegiatanController::class, 'destroy']);

        Route::get('/{id}', [KegiatanController::class, 'show']);
    });

    /*
    |--------------------------------------------------------------------------
    | LAPORAN
    |--------------------------------------------------------------------------
    */

    Route::prefix('laporan')->group(function () {

        Route::get('/', [LaporanController::class, 'index']);

        Route::get('/export/pdf', [LaporanController::class, 'exportPDF']);

        Route::get('/export/excel', [LaporanController::class, 'exportExcel']);

        Route::get('/export/csv', [LaporanController::class, 'exportCSV']);

    });

    /*
    |--------------------------------------------------------------------------
    | PENGATURAN
    |--------------------------------------------------------------------------
    */

    Route::get('/pengaturan', [PengaturanController::class, 'index']);

    Route::get('/pengaturan/profil', [PengaturanController::class, 'profil']);

    Route::get('/pengaturan/keamanan', [PengaturanController::class, 'keamanan']);

    Route::get('/pengaturan/notifikasi', [PengaturanController::class, 'notifikasi']);

    Route::get('/pengaturan/sistem', [PengaturanController::class, 'sistem']);
        

});