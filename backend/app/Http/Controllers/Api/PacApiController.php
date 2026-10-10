<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SyncPacSubmissionToGoogleSheet;
use App\Models\PAC;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PacApiController extends Controller
{
    /**
     * Display a listing of active PACs.
     */
    public function index(Request $request): JsonResponse
    {
        $query = PAC::where('status', 'aktif')
            ->withCount('kegiatans as total_kegiatan');

        if ($request->filled('kecamatan')) {
            $query->where('kecamatan', $request->kecamatan);
        }

        if ($request->has('page') || $request->has('per_page')) {
            $perPage = (int) $request->input('per_page', 12);
            if ($perPage <= 0 || $perPage > 50) {
                $perPage = 12;
            }

            return response()->json($query->latest()->paginate($perPage));
        }

        return response()->json($query->latest()->get());
    }

    /**
     * Store a new PAC pengajuan.
     * Enforces honeypot bot check and district-level deduplication.
     */
    public function storePengajuan(Request $request): JsonResponse
    {
        // Honeypot check: reject bots submitting hidden fields
        if ($request->filled('website') || $request->filled('_hp')) {
            return response()->json([
                'success' => false,
                'message' => 'Permintaan tidak valid terdeteksi (bot protection).',
            ], 422);
        }

        $validated = $request->validate([
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
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'website' => 'nullable|string|max:255',
            '_hp' => 'nullable|string|max:255',
        ]);

        // District-level deduplication check (Issue #114)
        $cleanKecamatan = trim($validated['kecamatan']);
        $existing = PAC::whereRaw('LOWER(kecamatan) = ?', [strtolower($cleanKecamatan)])
            ->whereIn('status', ['aktif', 'pending'])
            ->first();

        if ($existing) {
            $statusText = $existing->status === 'aktif' ? 'sudah aktif' : 'sedang menunggu persetujuan';

            return response()->json([
                'success' => false,
                'message' => "Pengajuan PAC untuk Kecamatan {$cleanKecamatan} {$statusText}. Pengajuan duplikat tidak diperkenankan.",
                'errors' => [
                    'kecamatan' => ["Pengajuan PAC untuk Kecamatan {$cleanKecamatan} {$statusText}."],
                ],
            ], 422);
        }

        $pac = PAC::create([
            'nama_pac' => $validated['nama_pac'],
            'kecamatan' => $cleanKecamatan,
            'status' => 'pending',
            'tanggal_berdiri' => $validated['tanggal_berdiri'],
            'alamat' => $validated['alamat'] ?? null,
            'desa' => $validated['desa'] ?? null,
            'kode_pos' => $validated['kode_pos'] ?? null,
            'ketua_pac' => $validated['ketua_pac'],
            'telepon' => $validated['telepon'],
            'email' => $validated['email'] ?? null,
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'jumlah_anggota' => 0,
            'total_kegiatan' => 0,
            'deskripsi' => $validated['deskripsi'] ?? null,
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
                    'tanggal_berdiri' => $pac->tanggal_berdiri,
                    'ketua_pac' => $pac->ketua_pac,
                    'telepon' => $pac->telepon,
                    'email' => $pac->email,
                    'desa' => $pac->desa,
                    'kode_pos' => $pac->kode_pos,
                    'alamat' => $pac->alamat,
                    'deskripsi' => $pac->deskripsi,
                    'latitude' => $pac->latitude,
                    'longitude' => $pac->longitude,
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
    }
}
