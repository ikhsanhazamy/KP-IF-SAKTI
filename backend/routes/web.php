<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PACController;
use App\Http\Controllers\PengajuanPACController;
use App\Http\Controllers\PengaturanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::view('/', 'login');

Route::view('/login', 'login')
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:login');

Route::get('/two-factor-challenge', [AuthController::class, 'showTwoFactorChallenge'])
    ->name('two-factor.challenge');

Route::post('/two-factor-challenge', [AuthController::class, 'verifyTwoFactor'])
    ->name('two-factor.verify')
    ->middleware('throttle:login');

Route::post('/two-factor-challenge/resend', [AuthController::class, 'resendTwoFactorCode'])
    ->name('two-factor.resend')
    ->middleware('throttle:login');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/csrf-token', fn () => response()->json([
    'token' => csrf_token(),
]))->name('csrf-token');

/*
|--------------------------------------------------------------------------
| KEGIATAN (PUBLIC SPA OR ADMIN VIEW)
|--------------------------------------------------------------------------
*/

Route::get('/kegiatan', function (\Illuminate\Http\Request $request) {
    if (auth()->check()) {
        $user = auth()->user();
        if ($user && $user->two_factor_enabled && ! $request->session()->get('two_factor_verified', false)) {
            return redirect('/two-factor-challenge');
        }

        return app(KegiatanController::class)->index($request);
    }

    $spaCandidates = [
        '/var/www/frontend/index.html',
        base_path('../frontend/dist/index.html'),
        public_path('../../frontend/dist/index.html'),
    ];

    foreach ($spaCandidates as $path) {
        if (file_exists($path)) {
            return response()->file($path);
        }
    }

    return app(KegiatanController::class)->index($request);
})->name('kegiatan.index');

Route::get('/kegiatan/{id}', function (\Illuminate\Http\Request $request, $id) {
    if ($request->wantsJson() || $request->ajax()) {
        return app(KegiatanController::class)->show((int) $id);
    }

    if (auth()->check()) {
        return app(KegiatanController::class)->show((int) $id);
    }

    $spaCandidates = [
        '/var/www/frontend/index.html',
        base_path('../frontend/dist/index.html'),
        public_path('../../frontend/dist/index.html'),
    ];

    foreach ($spaCandidates as $path) {
        if (file_exists($path)) {
            return response()->file($path);
        }
    }

    return app(KegiatanController::class)->show((int) $id);
})->name('kegiatan.show');

/*
|--------------------------------------------------------------------------
| DASHBOARD AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', '2fa'])->group(function () {

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
    | PENGAJUAN PAC (APPROVAL & MANAGEMENT)
    |--------------------------------------------------------------------------
    */

    Route::prefix('pengajuan-pac')->group(function () {

        Route::get('/', [PengajuanPACController::class, 'index'])
            ->name('pengajuan-pac.index');

        Route::get('/{id}', [PengajuanPACController::class, 'show'])
            ->name('pengajuan-pac.show');

        Route::post('/{id}/approve', [PengajuanPACController::class, 'approve'])
            ->name('pengajuan-pac.approve');

        Route::post('/{id}/reject', [PengajuanPACController::class, 'reject'])
            ->name('pengajuan-pac.reject');

    });

    /*
    |--------------------------------------------------------------------------
    | KEGIATAN (ADMIN ACTIONS)
    |--------------------------------------------------------------------------
    */

    Route::prefix('kegiatan')->group(function () {

        Route::post('/store', [KegiatanController::class, 'store']);

        Route::put('/update/{id}', [KegiatanController::class, 'update']);

        Route::delete('/delete/{id}', [KegiatanController::class, 'destroy']);

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

    Route::post('/pengaturan/profil/update', [PengaturanController::class, 'updateProfil'])->name('pengaturan.profil.update');

    Route::delete('/pengaturan/profil/foto', [PengaturanController::class, 'hapusFoto'])->name('pengaturan.profil.foto.delete');

    Route::get('/pengaturan/keamanan', [PengaturanController::class, 'keamanan']);

    Route::post('/pengaturan/update-password', [PengaturanController::class, 'updatePassword'])->name('pengaturan.password.update');

    Route::post('/pengaturan/keamanan/two-factor', [PengaturanController::class, 'updateTwoFactor'])->name('pengaturan.two-factor.update');

    Route::post('/pengaturan/update', [PengaturanController::class, 'update'])->name('pengaturan.update');

    Route::get('/pengaturan/notifikasi', [PengaturanController::class, 'notifikasi']);

    Route::post('/pengaturan/notifikasi', [PengaturanController::class, 'updateNotifikasi'])->name('pengaturan.notifikasi.update');

    Route::get('/pengaturan/sistem', [PengaturanController::class, 'sistem']);

    Route::post('/backup/database', [PengaturanController::class, 'backupDatabase'])->name('backup.database');

    Route::post('/restore/database', [PengaturanController::class, 'restoreDatabase'])->name('restore.database');

});
