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
        $anggotas = Anggota::all();

        $headers = [
            "Content-type"        => "application/vnd.ms-excel; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=laporan-anggota.xls",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use ($anggotas) {
            $file = fopen('php://output', 'w');
            
            $html = '
            <html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
            <head>
                <meta http-equiv="Content-type" content="text/html;charset=utf-8" />
                <!--[if gte mso 9]>
                <xml>
                    <x:ExcelWorkbook>
                        <x:ExcelWorksheets>
                            <x:ExcelWorksheet>
                                <x:Name>Laporan Anggota</x:Name>
                                <x:WorksheetOptions>
                                    <x:DisplayGridlines/>
                                </x:WorksheetOptions>
                            </x:ExcelWorksheet>
                        </x:ExcelWorksheets>
                    </x:ExcelWorkbook>
                </xml>
                <![endif]-->
                <style>
                    th { background-color: #15633D; color: #ffffff; font-weight: bold; border: 1px solid #cccccc; }
                    td { border: 1px solid #cccccc; }
                </style>
            </head>
            <body>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>PAC</th>
                            <th>Status</th>
                            <th>Telepon</th>
                            <th>Pendidikan</th>
                            <th>Profesi</th>
                            <th>Tanggal Bergabung</th>
                        </tr>
                    </thead>
                    <tbody>';
            
            foreach ($anggotas as $index => $item) {
                $html .= '
                        <tr>
                            <td>' . ($index + 1) . '</td>
                            <td>' . htmlspecialchars($item->nama) . '</td>
                            <td>' . htmlspecialchars($item->email) . '</td>
                            <td>' . htmlspecialchars($item->pac) . '</td>
                            <td>' . htmlspecialchars($item->status) . '</td>
                            <td>' . htmlspecialchars($item->telepon) . '</td>
                            <td>' . htmlspecialchars($item->pendidikan) . '</td>
                            <td>' . htmlspecialchars($item->profesi) . '</td>
                            <td>' . htmlspecialchars($item->tanggal_bergabung) . '</td>
                        </tr>';
            }
            
            $html .= '
                    </tbody>
                </table>
            </body>
            </html>';

            fwrite($file, $html);
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportCSV()
    {
        $headers = [
            "Content-type"        => "text/csv; charset=UTF-8",
            "Content-Disposition" => "attachment; filename=laporan-anggota.csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for Excel compatibility
            fputs($file, "\xEF\xBB\xBF");
            
            fputcsv($file, ['No', 'Nama', 'Email', 'PAC', 'Status', 'Telepon', 'Pendidikan', 'Profesi', 'Tanggal Bergabung']);

            $anggotas = Anggota::all();
            foreach ($anggotas as $index => $item) {
                fputcsv($file, [
                    $index + 1,
                    $item->nama,
                    $item->email,
                    $item->pac,
                    $item->status,
                    $item->telepon,
                    $item->pendidikan,
                    $item->profesi,
                    $item->tanggal_bergabung
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportPacPDF()
    {
        $pacs = PAC::all();

        $pdf = Pdf::loadView(
            'pdf.laporan-pac',
            compact('pacs')
        );

        return $pdf->download('laporan-pac.pdf');
    }

    public function exportKegiatanPDF()
    {
        $kegiatan = Kegiatan::all();

        $pdf = Pdf::loadView(
            'pdf.laporan-kegiatan',
            compact('kegiatan')
        );

        return $pdf->download('laporan-kegiatan.pdf');
    }
}