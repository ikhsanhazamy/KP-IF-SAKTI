<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\PAC;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class DashboardController extends Controller
{
    public function index()
    {
        $now = now();
        $currentMonthStart = $now->copy()->startOfMonth();
        $currentMonthEnd = $now->copy()->endOfMonth();
        $previousMonthStart = $now->copy()->subMonthNoOverflow()->startOfMonth();
        $previousMonthEnd = $now->copy()->subMonthNoOverflow()->endOfMonth();

        $totalAnggota = Anggota::count();
        $totalPAC = PAC::count();
        $totalKegiatan = Kegiatan::count();
        $pacAktif = PAC::where('status', 'aktif')->count();
        $pacTidakAktif = max($totalPAC - $pacAktif, 0);
        $skAktif = PAC::where('status', 'aktif')
            ->whereNotNull('nomor_sk')
            ->where('nomor_sk', '!=', '')
            ->count();

        $anggotaBulanIni = $this->countInPeriod(
            Anggota::query(),
            'tanggal_bergabung',
            $currentMonthStart,
            $currentMonthEnd
        );
        $anggotaBulanLalu = $this->countInPeriod(
            Anggota::query(),
            'tanggal_bergabung',
            $previousMonthStart,
            $previousMonthEnd
        );
        $pacBulanIni = $this->countInPeriod(
            PAC::where('status', 'aktif'),
            'created_at',
            $currentMonthStart,
            $currentMonthEnd
        );
        $pacBulanLalu = $this->countInPeriod(
            PAC::where('status', 'aktif'),
            'created_at',
            $previousMonthStart,
            $previousMonthEnd
        );
        $kegiatanBulanIni = $this->countInPeriod(
            Kegiatan::query(),
            'tanggal',
            $currentMonthStart,
            $currentMonthEnd
        );
        $kegiatanBulanLalu = $this->countInPeriod(
            Kegiatan::query(),
            'tanggal',
            $previousMonthStart,
            $previousMonthEnd
        );
        $skBulanIni = $this->countInPeriod(
            PAC::where('status', 'aktif')
                ->whereNotNull('nomor_sk')
                ->where('nomor_sk', '!=', ''),
            'created_at',
            $currentMonthStart,
            $currentMonthEnd
        );
        $skBulanLalu = $this->countInPeriod(
            PAC::where('status', 'aktif')
                ->whereNotNull('nomor_sk')
                ->where('nomor_sk', '!=', ''),
            'created_at',
            $previousMonthStart,
            $previousMonthEnd
        );

        $growth = [
            'anggota' => $this->percentageGrowth($anggotaBulanIni, $anggotaBulanLalu),
            'pac' => $this->percentageGrowth($pacBulanIni, $pacBulanLalu),
            'kegiatan' => $this->percentageGrowth($kegiatanBulanIni, $kegiatanBulanLalu),
            'sk' => $this->percentageGrowth($skBulanIni, $skBulanLalu),
        ];

        $anggotaGrowthChart = collect(range(5, 0))
            ->map(function (int $monthsAgo) use ($now) {
                $month = $now->copy()->subMonthsNoOverflow($monthsAgo);

                return [
                    'label' => $month->locale('id')->translatedFormat('M'),
                    'total' => Anggota::whereDate(
                        'tanggal_bergabung',
                        '<=',
                        $month->copy()->endOfMonth()
                    )->count(),
                ];
            });

        $profesiChart = Anggota::selectRaw('profesi, COUNT(*) as total')
            ->groupBy('profesi')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $topPAC = PAC::orderByDesc('jumlah_anggota')
            ->take(5)
            ->get()
            ->map(function (PAC $pac) use (
                $currentMonthStart,
                $currentMonthEnd,
                $previousMonthStart,
                $previousMonthEnd
            ) {
                $anggotaBulanIni = $this->countInPeriod(
                    Anggota::whereRaw('LOWER(pac) = ?', [strtolower($pac->nama_pac)]),
                    'tanggal_bergabung',
                    $currentMonthStart,
                    $currentMonthEnd
                );
                $anggotaBulanLalu = $this->countInPeriod(
                    Anggota::whereRaw('LOWER(pac) = ?', [strtolower($pac->nama_pac)]),
                    'tanggal_bergabung',
                    $previousMonthStart,
                    $previousMonthEnd
                );

                $pac->growth = $this->percentageGrowth(
                    $anggotaBulanIni,
                    $anggotaBulanLalu
                );

                return $pac;
            });

        $aktivitasTerbaru = collect()
            ->concat(
                Anggota::latest()->take(5)->get()->map(fn (Anggota $anggota) => [
                    'judul' => 'Anggota baru - '.$anggota->nama,
                    'waktu' => $anggota->created_at,
                    'jenis' => 'anggota',
                ])
            )
            ->concat(
                PAC::latest()->take(5)->get()->map(fn (PAC $pac) => [
                    'judul' => 'Data '.$pac->nama_pac.' diperbarui',
                    'waktu' => $pac->updated_at,
                    'jenis' => 'pac',
                ])
            )
            ->concat(
                Kegiatan::latest()->take(5)->get()->map(fn (Kegiatan $kegiatan) => [
                    'judul' => $kegiatan->judul.' - '.number_format($kegiatan->peserta).' peserta',
                    'waktu' => $kegiatan->updated_at,
                    'jenis' => 'kegiatan',
                ])
            )
            ->sortByDesc('waktu')
            ->take(5)
            ->values();

        $lastUpdated = collect([
            Anggota::max('updated_at'),
            PAC::max('updated_at'),
            Kegiatan::max('updated_at'),
        ])
            ->filter()
            ->map(fn ($date) => Carbon::parse($date))
            ->sortDesc()
            ->first() ?? $now;

        return view('dashboard', compact(
            'totalAnggota',
            'totalPAC',
            'totalKegiatan',
            'pacAktif',
            'pacTidakAktif',
            'skAktif',
            'kegiatanBulanIni',
            'growth',
            'anggotaGrowthChart',
            'profesiChart',
            'aktivitasTerbaru',
            'topPAC',
            'lastUpdated'
        ));
    }

    private function countInPeriod(
        Builder $query,
        string $column,
        Carbon $start,
        Carbon $end
    ): int {
        return $query->whereBetween($column, [$start, $end])->count();
    }

    private function percentageGrowth(int $current, int $previous): int
    {
        if ($previous === 0) {
            return $current > 0 ? 100 : 0;
        }

        return (int) round((($current - $previous) / $previous) * 100);
    }
}
