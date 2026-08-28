<?php

use App\Jobs\SyncPacSubmissionToGoogleSheet;
use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\PAC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('throttle:api')->group(function () {
    // GET KEGIATAN (dengan filter & search)
    Route::get('/kegiatan', function (Request $request) {
        $query = Kegiatan::with('pac:id,nama_pac,kecamatan');

        if ($request->filled('search')) {
            $escaped = addcslashes($request->search, '%_\\');
            $query->where(function ($q) use ($escaped) {
                $q->where('judul', 'like', "%{$escaped}%")
                    ->orWhere('deskripsi', 'like', "%{$escaped}%");
            });
        }

        if ($request->filled('category') && $request->category !== 'Semua') {
            $query->whereRaw('LOWER(kategori) = ?', [strtolower($request->category)]);
        }

        return response()->json($query->latest()->get());
    });

    // GET DETAIL KEGIATAN (single, with PAC relation)
    Route::get('/kegiatan/{id}', function ($id) {
        $kegiatan = Kegiatan::with('pac:id,nama_pac,kecamatan')->findOrFail($id);

        return response()->json($kegiatan);
    });

    // GET ALL ACTIVE PAC
    Route::get('/pac', function () {
        return response()->json(
            PAC::where('status', 'aktif')
                ->withCount('kegiatans as total_kegiatan')
                ->latest()
                ->get()
        );
    });

    // GET SUMMARY STATS
    Route::get('/stats', function () {
        $totalPAC = PAC::count();
        $pacAktif = PAC::where('status', 'aktif')->count();
        $totalAnggota = Anggota::count();
        $anggotaAktif = Anggota::where('status', 'aktif')->count();
        $totalKecamatan = PAC::whereNotNull('kecamatan')
            ->where('kecamatan', '!=', '')
            ->distinct('kecamatan')
            ->count('kecamatan');
        $anggotaTerverifikasi = Anggota::whereNotNull('email')
            ->whereNotNull('telepon')
            ->whereNotNull('tanggal_lahir')
            ->whereNotNull('pendidikan')
            ->whereNotNull('profesi')
            ->count();
        $tingkatVerifikasi = $totalAnggota > 0
            ? (int) round(($anggotaTerverifikasi / $totalAnggota) * 100)
            : 0;

        return response()->json([
            'total_pac' => $totalPAC,
            'pac_aktif' => $pacAktif,
            'total_anggota' => $totalAnggota,
            'anggota_aktif' => $anggotaAktif,
            'total_kecamatan' => $totalKecamatan,
            'tingkat_verifikasi' => $tingkatVerifikasi,
            'kepuasan' => $tingkatVerifikasi,
        ]);
    });

    // POST PENGAJUAN PAC BARU
    Route::post('/pac/pengajuan', function (Request $request) {
        $request->validate([
            'nama_pac' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'tanggal_berdiri' => 'required|date|before_or_equal:today|after_or_equal:1900-01-01',
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

        $webhookUrl = config('services.google_apps_script.pac_pengajuan_webhook_url');

        if ($webhookUrl) {
            $payload = [
                'token' => config('services.google_apps_script.pac_pengajuan_webhook_token'),
                'source' => config('app.name', 'KP-IF-SAKTI'),
                'submitted_at' => now()->toIso8601String(),
                'pac' => [
                    'id' => $pac->id,
                    'nama_pac' => $pac->nama_pac,
                    'kecamatan' => $pac->kecamatan,
                    'status' => $pac->status,
                    'tanggal_berdiri' => $request->tanggal_berdiri,
                    'ketua_pac' => $pac->ketua_pac,
                    'telepon' => $pac->telepon,
                    'email' => $pac->email,
                    'desa' => $pac->desa,
                    'kode_pos' => $pac->kode_pos,
                    'alamat' => $pac->alamat,
                    'deskripsi' => $pac->deskripsi,
                ],
            ];

            SyncPacSubmissionToGoogleSheet::dispatch($pac, $payload);
        }

        return response()->json([
            'success' => true,
            'message' => 'Pengajuan PAC berhasil dikirim dan sedang menunggu persetujuan admin.',
            'google_sheet_synced' => (bool) $webhookUrl,
            'data' => $pac,
        ], 201);
    })->middleware('throttle:pac-pengajuan');
});
