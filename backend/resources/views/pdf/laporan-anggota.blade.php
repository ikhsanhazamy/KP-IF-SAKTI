<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Anggota</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #202321; font-size: 11px; }
        h1 { color: #15633d; margin-bottom: 4px; }
        p { color: #6b7280; margin-top: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #d8dedb; padding: 7px; text-align: left; }
        th { background: #15633d; color: white; }
        tr:nth-child(even) { background: #f5f7f6; }
    </style>
</head>
<body>
    <h1>Laporan Data Anggota</h1>
    <p>Dicetak pada {{ now()->format('d/m/Y H:i') }}</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Umur</th>
                <th>PAC</th>
                <th>Profesi</th>
                <th>Pendidikan</th>
                <th>Status</th>
                <th>Status Pernikahan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($anggotas as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->tanggal_lahir?->format('d/m/Y') ?? '-' }}</td>
                    <td>{{ $item->umur ? $item->umur.' tahun' : '-' }}</td>
                    <td>{{ $item->pac }}</td>
                    <td>{{ $item->profesi }}</td>
                    <td>{{ $item->pendidikan }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $item->status)) }}</td>
                    <td>
                        @switch($item->status_pernikahan)
                            @case('kawin') Kawin @break
                            @case('cerai_hidup') Cerai Hidup @break
                            @case('cerai_mati') Cerai Mati @break
                            @case('belum_kawin') Belum Kawin @break
                            @default -
                        @endswitch
                    </td>
                </tr>
            @empty
                <tr><td colspan="9">Belum ada data anggota.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
