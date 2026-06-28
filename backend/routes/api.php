<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Kegiatan;
use App\Models\PAC;
use App\Models\Anggota;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// GET KEGIATAN (dengan filter & search)
Route::get('/kegiatan', function (Request $request) {
    $query = Kegiatan::query();

    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('judul', 'like', "%{$search}%")
              ->orWhere('deskripsi', 'like', "%{$search}%");
        });
    }

    if ($request->filled('category') && $request->category !== 'Semua') {
        $query->where('kategori', $request->category);
    }

    return response()->json($query->latest()->get());
});

// GET ALL PAC
Route::get('/pac', function () {
    return response()->json(PAC::latest()->get());
});

// GET SUMMARY STATS
Route::get('/stats', function () {
    $totalPAC = PAC::count();
    $pacAktif = PAC::where('status', 'aktif')->count();
    $totalAnggota = Anggota::count();
    $totalKecamatan = PAC::distinct('kecamatan')->count('kecamatan');

    return response()->json([
        'total_pac' => $totalPAC,
        'pac_aktif' => $pacAktif,
        'total_anggota' => $totalAnggota,
        'total_kecamatan' => $totalKecamatan,
    ]);
});

// POST PENGAJUAN PAC BARU
Route::post('/pac/pengajuan', function (Request $request) {
    $request->validate([
        'nama_pac' => 'required|string|max:255',
        'kecamatan' => 'required|string|max:255',
        'tanggal_berdiri' => 'required|date',
        'alamat' => 'nullable|string',
        'desa' => 'nullable|string|max:255',
        'kode_pos' => 'nullable|string|max:10',
        'ketua_pac' => 'required|string|max:255',
        'telepon' => 'required|string|max:20',
        'email' => 'nullable|email|max:255',
        'deskripsi' => 'nullable|string',
    ]);

    $pac = PAC::create([
        'nama_pac' => $request->nama_pac,
        'kecamatan' => $request->kecamatan,
        'status' => 'pending', // Default status pending untuk pengajuan baru
        'tanggal_berdiri' => $request->tanggal_berdiri,
        'alamat' => $request->alamat,
        'desa' => $request->desa,
        'kode_pos' => $request->kode_pos,
        'ketua_pac' => $request->ketua_pac,
        'telepon' => $request->telepon,
        'email' => $request->email,
        'jumlah_anggota' => 0,
        'total_kegiatan' => 0,
        'deskripsi' => $request->deskripsi,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Pengajuan PAC berhasil dikirim dan sedang menunggu persetujuan admin.',
        'data' => $pac
    ], 201);
});
