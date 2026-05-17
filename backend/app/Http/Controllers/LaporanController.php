<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\PAC;
use App\Models\Kegiatan;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        $totalAnggota = Anggota::count();

        $totalPAC = PAC::count();

        $totalKegiatan = Kegiatan::count();

        $anggotaAktif = Anggota::where('status', 'aktif')->count();

        $kegiatanUpcoming = Kegiatan::where('status', 'upcoming')->count();

        $kegiatanOngoing = Kegiatan::where('status', 'ongoing')->count();

        $kegiatanCompleted = Kegiatan::where('status', 'completed')->count();

        return view('laporan', compact(
            'totalAnggota',
            'totalPAC',
            'totalKegiatan',
            'anggotaAktif',
            'kegiatanUpcoming',
            'kegiatanOngoing',
            'kegiatanCompleted'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | EXPORT PDF
    |--------------------------------------------------------------------------
    */

    public function exportPDF()
    {
        $anggotas = Anggota::all();

        $pdf = Pdf::loadView(
            'pdf.laporan-anggota',
            compact('anggotas')
        );

        return $pdf->download('laporan-anggota.pdf');
    }
}