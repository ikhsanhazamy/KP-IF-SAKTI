<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PACController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\SettingController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::view('/', 'login');

Route::view('/login', 'login')
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/csrf-token', fn () => response()->json([
    'token' => csrf_token(),
]))->name('csrf-token');


/*
|--------------------------------------------------------------------------
| DASHBOARD AREA
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/header/search', [HeaderController::class, 'search'])
        ->name('header.search');

    Route::get('/header/notifications', [HeaderController::class, 'notifications'])
        ->name('header.notifications');

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index']);


    /*
    |--------------------------------------------------------------------------
    | ANGGOTA
    |--------------------------------------------------------------------------
    */

    Route::prefix('anggota')->group(function () {

        Route::get('/', [AnggotaController::class, 'index']);

        Route::post('/store', [AnggotaController::class, 'store']);

        Route::post('/import-csv', [AnggotaController::class, 'importCsv'])
            ->name('anggota.import-csv');

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

        Route::get('/', [PACController::class, 'index'])
        ->name('pac.index');

        Route::post('/store', [PACController::class, 'store'])
            ->name('pac.store');

        Route::post('/import-csv', [PACController::class, 'importCsv'])
            ->name('pac.import-csv');

        Route::get('/export/excel', [PACController::class, 'exportExcel'])
            ->name('pac.export-excel');

        Route::put('/update/{id}', [PACController::class, 'update'])
            ->name('pac.update');

        Route::delete('/delete/{id}', [PACController::class, 'destroy'])
            ->name('pac.destroy');

        Route::get('/{id}', [PACController::class, 'show'])
            ->name('pac.show');

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

        Route::get('/generate/{type}', [LaporanController::class, 'generate'])
            ->whereIn('type', ['anggota', 'pac', 'kegiatan']);

        Route::get('/export/pdf', [LaporanController::class, 'exportPDF']);

        Route::get('/export/excel', [LaporanController::class, 'exportExcel']);

        Route::get('/export/csv', [LaporanController::class, 'exportCSV']);

        Route::get('/export/pac/pdf', [LaporanController::class, 'exportPacPDF']);

        Route::get('/export/kegiatan/pdf', [LaporanController::class, 'exportKegiatanPDF']);

    });


    /*
    |--------------------------------------------------------------------------
    | PENGATURAN
    |--------------------------------------------------------------------------
    */

    Route::get('/pengaturan', [PengaturanController::class, 'index']);

    Route::get('/pengaturan/profil', [PengaturanController::class, 'profil']);

    Route::post('/pengaturan/profil/update',[PengaturanController::class, 'updateProfil'])->name('pengaturan.profil.update');

    Route::delete('/pengaturan/profil/foto',[PengaturanController::class, 'hapusFoto'])->name('pengaturan.profil.foto.delete');

    Route::get('/pengaturan/keamanan', [PengaturanController::class, 'keamanan']);

    Route::post('/pengaturan/update-password',[PengaturanController::class, 'updatePassword'])->name('pengaturan.password.update');

    Route::post('/pengaturan/keamanan/two-factor',[PengaturanController::class, 'updateTwoFactor'])->name('pengaturan.two-factor.update');

    Route::post('/pengaturan/update',[PengaturanController::class, 'update'])->name('pengaturan.update');
    
    Route::get('/pengaturan/notifikasi', [PengaturanController::class, 'notifikasi']);

    Route::post('/pengaturan/notifikasi',[PengaturanController::class, 'updateNotifikasi'])->name('pengaturan.notifikasi.update');

    Route::get('/pengaturan/sistem', [PengaturanController::class, 'sistem']);

    Route::post('/backup/database',[PengaturanController::class, 'backupDatabase'])->name('backup.database');

    Route::post('/restore/database',[PengaturanController::class, 'restoreDatabase'])->name('restore.database');

});
