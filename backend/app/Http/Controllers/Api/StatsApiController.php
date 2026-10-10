<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\PAC;
use Illuminate\Http\JsonResponse;

class StatsApiController extends Controller
{
    /**
     * Display organizational summary statistics.
     * Provides tingkat_verifikasi and kelengkapan_data,
     * while preserving kepuasan for backward compatibility.
     */
    public function index(): JsonResponse
    {
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

        $pacLengkap = PAC::whereNotNull('alamat')
            ->whereNotNull('ketua_pac')
            ->whereNotNull('telepon')
            ->count();
        $pacKelengkapan = $totalPAC > 0 ? (int) round(($pacLengkap / $totalPAC) * 100) : 0;
        $kelengkapanData = (int) round(($tingkatVerifikasi + $pacKelengkapan) / 2);

        return response()->json([
            'total_pac' => $totalPAC,
            'pac_aktif' => $pacAktif,
            'total_anggota' => $totalAnggota,
            'anggota_aktif' => $anggotaAktif,
            'total_kecamatan' => $totalKecamatan,
            'tingkat_verifikasi' => $tingkatVerifikasi,
            'kelengkapan_data' => $kelengkapanData,
            'kepuasan' => $tingkatVerifikasi, // retained for backward compatibility
        ]);
    }
}
