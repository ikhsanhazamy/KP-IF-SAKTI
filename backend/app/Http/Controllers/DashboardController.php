<?php

namespace App\Http\Controllers;

use App\Models\PAC;
use App\Models\Anggota;
use App\Models\Kegiatan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAnggota = Anggota::count();

        $totalPAC = PAC::count();

        $totalKegiatan = Kegiatan::count();

        $anggotaAktif = Anggota::where(
            'status',
            'aktif'
        )->count();

        $pacAktif = PAC::where(
            'status',
            'aktif'
        )->count();

        $pacTidakAktif = PAC::where(
            'status',
            '!=',
            'aktif'
        )->count();

        $kegiatanBulanIni = Kegiatan::whereMonth(
            'tanggal',
            Carbon::now()->month
        )->count();

        $pendidikanChart = Anggota::selectRaw(
            'pendidikan, COUNT(*) as total'
        )
        ->groupBy('pendidikan')
        ->get();

        $profesiChart = Anggota::selectRaw(
            'profesi, COUNT(*) as total'
        )
        ->groupBy('profesi')
        ->orderByDesc('total')
        ->limit(5)
        ->get();

        $aktivitasTerbaru = Kegiatan::latest()
            ->take(5)
            ->get();

        $topPAC = PAC::orderByDesc('jumlah_anggota')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalAnggota',
            'totalPAC',
            'totalKegiatan',
            'anggotaAktif',
            'pacAktif',
            'pacTidakAktif',
            'kegiatanBulanIni',
            'pendidikanChart',
            'profesiChart',
            'aktivitasTerbaru',
            'topPAC'
        ));
    }
}