<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan PAC</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #202321; font-size: 11px; }
        h1 { color: #15633d; margin-bottom: 4px; }
        p { color: #6b7280; margin-top: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #d8dedb; padding: 8px; text-align: left; }
        th { background: #15633d; color: white; }
        tr:nth-child(even) { background: #f5f7f6; }
    </style>
</head>
<body>
    <h1>Laporan PAC</h1>
    <p>Dicetak pada {{ now()->format('d/m/Y H:i') }}</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama PAC</th>
                <th>Kecamatan</th>
                <th>Ketua</th>
                <th>Anggota</th>
                <th>Alumni LKD</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pacs as $pac)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pac->nama_pac }}</td>
                    <td>{{ $pac->kecamatan }}</td>
                    <td>{{ $pac->ketua_pac ?: '-' }}</td>
                    <td>{{ $pac->jumlah_anggota }}</td>
                    <td>{{ $pac->alumni_lkd }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $pac->status)) }}</td>
                </tr>
            @empty
                <tr><td colspan="7">Belum ada data PAC.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
