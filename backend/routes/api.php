<?php

use App\Http\Controllers\Api\KegiatanApiController;
use App\Http\Controllers\Api\PacApiController;
use App\Http\Controllers\Api\StatsApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('throttle:api')->group(function () {
    // KEGIATAN ENDPOINTS (search, filter, pagination)
    Route::get('/kegiatan', [KegiatanApiController::class, 'index']);
    Route::get('/kegiatan/{id}', [KegiatanApiController::class, 'show']);

    // PAC ENDPOINTS
    Route::get('/pac', [PacApiController::class, 'index']);
    Route::post('/pac/pengajuan', [PacApiController::class, 'storePengajuan'])
        ->middleware('throttle:pac-pengajuan');

    // SUMMARY STATS
    Route::get('/stats', [StatsApiController::class, 'index']);
});
