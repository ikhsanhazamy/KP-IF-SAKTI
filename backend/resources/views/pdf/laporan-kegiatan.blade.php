<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Kegiatan</title>
    <style>
        body {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 12px;
        }
        th {
            background: #15633D;
            color: white;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Laporan Data Kegiatan</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul Kegiatan</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Lokasi</th>
                <th>Kategori</th>
                <th>Peserta</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kegiatan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</td>
                    <td>{{ $item->waktu }} WIB</td>
                    <td>{{ $item->lokasi }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td>{{ $item->peserta }} Orang</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
