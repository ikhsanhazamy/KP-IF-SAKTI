<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <table border="1">
        <thead>
            <tr style="background:#15633D;color:#FFFFFF;font-weight:bold">
                <th>Nama PAC</th>
                <th>Kecamatan</th>
                <th>Status</th>
                <th>Tanggal Berdiri</th>
                <th>Alamat</th>
                <th>Desa</th>
                <th>Kode Pos</th>
                <th>Ketua PAC</th>
                <th>Telepon</th>
                <th>Email</th>
                <th>Jumlah Anggota</th>
                <th>Alumni LKD</th>
                <th>Nomor SK</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pacs as $pac)
                <tr>
                    <td>{{ $pac->nama_pac }}</td>
                    <td>{{ $pac->kecamatan }}</td>
                    <td>
                        @switch($pac->status)
                            @case('aktif') Aktif @break
                            @case('akan_expire') Akan Expire @break
                            @case('tidak_aktif') Tidak Aktif @break
                            @default -
                        @endswitch
                    </td>
                    <td>{{ $pac->tanggal_berdiri }}</td>
                    <td>{{ $pac->alamat }}</td>
                    <td>{{ $pac->desa }}</td>
                    <td>{{ $pac->kode_pos }}</td>
                    <td>{{ $pac->ketua_pac }}</td>
                    <td>{{ $pac->telepon }}</td>
                    <td>{{ $pac->email }}</td>
                    <td>{{ $pac->jumlah_anggota }}</td>
                    <td>{{ $pac->alumni_lkd }}</td>
                    <td>{{ $pac->nomor_sk }}</td>
                    <td>{{ $pac->deskripsi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
