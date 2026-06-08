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

    public function exportPDF()
    {
        $anggotas = Anggota::all();

        $pdf = Pdf::loadView(
            'pdf.laporan-anggota',
            compact('anggotas')
        );

        return $pdf->download('laporan-anggota.pdf');
    }

    public function exportExcel()
    {
        return redirect()
            ->back()
            ->with(
                'success',
                'Export Excel masih dalam pengembangan'
            );
    }

    public function exportCSV()
    {
        return redirect()
            ->back()
            ->with(
                'success',
                'Export CSV masih dalam pengembangan'
            );
    }
}