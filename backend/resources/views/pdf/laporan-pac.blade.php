<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan PAC</title>
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
    <h1>Laporan Data PAC</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama PAC</th>
                <th>Kecamatan</th>
                <th>Desa</th>
                <th>Ketua PAC</th>
                <th>Telepon</th>
                <th>Jumlah Anggota</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pacs as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_pac }}</td>
                    <td>{{ $item->kecamatan }}</td>
                    <td>{{ $item->desa }}</td>
                    <td>{{ $item->ketua_pac }}</td>
                    <td>{{ $item->telepon }}</td>
                    <td>{{ $item->jumlah_anggota }}</td>
                    <td>{{ $item->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
