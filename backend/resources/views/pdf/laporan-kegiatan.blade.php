<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Kegiatan</title>
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
    <h1>Laporan Kegiatan</h1>
    <p>Dicetak pada {{ now()->format('d/m/Y H:i') }}</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Lokasi</th>
                <th>Kategori</th>
                <th>Peserta</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kegiatans as $kegiatan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kegiatan->judul }}</td>
                    <td>{{ \Carbon\Carbon::parse($kegiatan->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $kegiatan->lokasi }}</td>
                    <td>{{ $kegiatan->kategori }}</td>
                    <td>{{ $kegiatan->peserta }}</td>
                    <td>{{ ucfirst($kegiatan->status) }}</td>
                </tr>
            @empty
                <tr><td colspan="7">Belum ada data kegiatan.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
