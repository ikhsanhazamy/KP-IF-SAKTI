<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Kegiatan;
use App\Models\PAC;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan', $this->reportData());
    }

    public function generate(string $type)
    {
        return match ($type) {
            'anggota' => $this->memberPdf(),
            'pac' => Pdf::loadView('pdf.laporan-pac', [
                'pacs' => PAC::orderBy('nama_pac')->get(),
            ])->download('laporan-pac.pdf'),
            'kegiatan' => Pdf::loadView('pdf.laporan-kegiatan', [
                'kegiatans' => Kegiatan::orderByDesc('tanggal')->get(),
            ])->download('laporan-kegiatan.pdf'),
        };
    }

    public function exportPDF()
    {
        return $this->memberPdf();
    }

    public function exportPacPDF()
    {
        return Pdf::loadView('pdf.laporan-pac', [
            'pacs' => PAC::orderBy('nama_pac')->get(),
        ])->download('laporan-pac.pdf');
    }

    public function exportKegiatanPDF()
    {
        return Pdf::loadView('pdf.laporan-kegiatan', [
            'kegiatans' => Kegiatan::orderByDesc('tanggal')->get(),
        ])->download('laporan-kegiatan.pdf');
    }

    public function exportExcel(): Response
    {
        $content = view('exports.anggota-excel', [
            'anggotas' => Anggota::orderBy('nama')->get(),
        ])->render();

        return response($content, 200, [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="data-anggota.xls"',
        ]);
    }

    public function exportCSV(): StreamedResponse
    {
        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');
            fwrite($handle, "\xEF\xBB\xBF");
            fputcsv($handle, [
                'Nama',
                'Email',
                'Telepon',
                'Tanggal Lahir',
                'Umur',
                'PAC',
                'Profesi',
                'Pendidikan',
                'Status',
                'Status Pernikahan',
                'Tanggal Bergabung',
            ]);

            Anggota::orderBy('nama')->chunk(200, function ($anggotas) use ($handle) {
                foreach ($anggotas as $anggota) {
                    fputcsv($handle, [
                        self::sanitizeForExport($anggota->nama),
                        self::sanitizeForExport($anggota->email),
                        self::sanitizeForExport($anggota->telepon),
                        $anggota->tanggal_lahir?->format('Y-m-d'),
                        $anggota->umur,
                        self::sanitizeForExport($anggota->pac),
                        self::sanitizeForExport($anggota->profesi),
                        self::sanitizeForExport($anggota->pendidikan),
                        ucfirst(str_replace('_', ' ', $anggota->status)),
                        $this->formatStatusPernikahan($anggota->status_pernikahan),
                        $anggota->tanggal_bergabung?->format('Y-m-d'),
                    ]);
                }
            });

            fclose($handle);
        }, 'data-anggota.csv', [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public static function sanitizeForExport(?string $value): string
    {
        if ($value === null || $value === '') {
            return '';
        }

        $firstChar = substr($value, 0, 1);
        if (in_array($firstChar, ['=', '+', '-', '@', "\t", "\r"], true)) {
            return "'".$value;
        }

        return $value;
    }

    private function memberPdf()
    {
        return Pdf::loadView('pdf.laporan-anggota', [
            'anggotas' => Anggota::orderBy('nama')->get(),
        ])->download('laporan-anggota.pdf');
    }

    private function formatStatusPernikahan(?string $status): string
    {
        return match ($status) {
            'kawin' => 'Kawin',
            'cerai_hidup' => 'Cerai Hidup',
            'cerai_mati' => 'Cerai Mati',
            'belum_kawin' => 'Belum Kawin',
            default => '-',
        };
    }

    private function reportData(): array
    {
        $totalAnggota = Anggota::count();
        $anggotaAktif = Anggota::where('status', 'aktif')->count();
        $totalPAC = PAC::count();
        $totalKegiatan = Kegiatan::count();

        $nowDate = now()->toDateString();
        $isSqlite = config('database.default') === 'sqlite';

        $ageRaw = $isSqlite
            ? "AVG(CAST(strftime('%Y', '{$nowDate}') - strftime('%Y', tanggal_lahir) - (strftime('%m-%d', '{$nowDate}') < strftime('%m-%d', tanggal_lahir)) AS INTEGER))"
            : "AVG(TIMESTAMPDIFF(YEAR, tanggal_lahir, '{$nowDate}'))";

        $avgAgeResult = Anggota::whereNotNull('tanggal_lahir')
            ->selectRaw("{$ageRaw} as avg_age")
            ->value('avg_age');

        $averageAge = $avgAgeResult !== null ? (int) round((float) $avgAgeResult) : 0;

        $months = collect(range(5, 0))
            ->map(fn (int $offset) => now()->startOfMonth()->subMonths($offset));

        $growthLabels = $months
            ->map(fn (Carbon $month) => $month->locale('id')->translatedFormat('M'))
            ->values();

        $monthFormatSql = $isSqlite
            ? "strftime('%Y-%m', tanggal_bergabung)"
            : "DATE_FORMAT(tanggal_bergabung, '%Y-%m')";

        $kegiatanMonthFormatSql = $isSqlite
            ? "strftime('%Y-%m', tanggal)"
            : "DATE_FORMAT(tanggal, '%Y-%m')";

        $windowStart = now()->startOfMonth()->subMonths(5);
        $windowEnd = now()->endOfMonth();

        $baseMemberCount = Anggota::where('tanggal_bergabung', '<', $windowStart->toDateString())->count();

        $membersPerMonth = Anggota::query()
            ->whereBetween('tanggal_bergabung', [$windowStart->toDateString(), $windowEnd->toDateString()])
            ->selectRaw("{$monthFormatSql} as ym, COUNT(*) as total")
            ->groupBy('ym')
            ->pluck('total', 'ym');

        $runningMemberTotal = $baseMemberCount;
        $memberGrowth = $months
            ->map(function (Carbon $month) use ($membersPerMonth, &$runningMemberTotal) {
                $ym = $month->format('Y-m');
                $runningMemberTotal += (int) ($membersPerMonth[$ym] ?? 0);

                return $runningMemberTotal;
            })
            ->values();

        $activitiesPerMonth = Kegiatan::query()
            ->whereBetween('tanggal', [$windowStart->toDateString(), $windowEnd->toDateString()])
            ->selectRaw("{$kegiatanMonthFormatSql} as ym, COUNT(*) as total")
            ->groupBy('ym')
            ->pluck('total', 'ym');

        $activityGrowth = $months
            ->map(fn (Carbon $month) => (int) ($activitiesPerMonth[$month->format('Y-m')] ?? 0))
            ->values();

        $professionDistribution = Anggota::selectRaw('profesi, COUNT(*) as total')
            ->groupBy('profesi')
            ->orderByDesc('total')
            ->pluck('total', 'profesi');

        $educationOrder = collect(['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3']);
        $educationCounts = Anggota::selectRaw('pendidikan, COUNT(*) as total')
            ->groupBy('pendidikan')
            ->pluck('total', 'pendidikan');

        $mostActivePac = PAC::orderByDesc('jumlah_anggota')
            ->orderBy('nama_pac')
            ->first();

        return [
            'totalAnggota' => $totalAnggota,
            'totalPAC' => $totalPAC,
            'totalKegiatan' => $totalKegiatan,
            'anggotaAktif' => $anggotaAktif,
            'averageAge' => $averageAge,
            'averageActivitiesPerPac' => $totalPAC > 0
                ? round($totalKegiatan / $totalPAC, 1)
                : 0,
            'participationRate' => $totalAnggota > 0
                ? (int) round(($anggotaAktif / $totalAnggota) * 100)
                : 0,
            'mostActivePac' => $mostActivePac?->nama_pac ?? '-',
            'growthLabels' => $growthLabels,
            'memberGrowth' => $memberGrowth,
            'activityGrowth' => $activityGrowth,
            'professionLabels' => $professionDistribution->keys()->values(),
            'professionValues' => $professionDistribution->values(),
            'educationLabels' => $educationOrder,
            'educationValues' => $educationOrder
                ->map(fn (string $education) => (int) ($educationCounts[$education] ?? 0)),
        ];
    }
}
