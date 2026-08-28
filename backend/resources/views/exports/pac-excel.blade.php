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
                    <td>{{ \App\Http\Controllers\LaporanController::sanitizeForExport($pac->nama_pac) }}</td>
                    <td>{{ \App\Http\Controllers\LaporanController::sanitizeForExport($pac->kecamatan) }}</td>
                    <td>
                        @switch($pac->status)
                            @case('aktif') Aktif @break
                            @case('akan_expire') Akan Expire @break
                            @case('tidak_aktif') Tidak Aktif @break
                            @case('pending') Pending @break
                            @default -
                        @endswitch
                    </td>
                    <td>{{ $pac->tanggal_berdiri }}</td>
                    <td>{{ \App\Http\Controllers\LaporanController::sanitizeForExport($pac->alamat) }}</td>
                    <td>{{ \App\Http\Controllers\LaporanController::sanitizeForExport($pac->desa) }}</td>
                    <td>{{ \App\Http\Controllers\LaporanController::sanitizeForExport($pac->kode_pos) }}</td>
                    <td>{{ \App\Http\Controllers\LaporanController::sanitizeForExport($pac->ketua_pac) }}</td>
                    <td>{{ \App\Http\Controllers\LaporanController::sanitizeForExport($pac->telepon) }}</td>
                    <td>{{ \App\Http\Controllers\LaporanController::sanitizeForExport($pac->email) }}</td>
                    <td>{{ $pac->jumlah_anggota }}</td>
                    <td>{{ $pac->alumni_lkd }}</td>
                    <td>{{ \App\Http\Controllers\LaporanController::sanitizeForExport($pac->nomor_sk) }}</td>
                    <td>{{ \App\Http\Controllers\LaporanController::sanitizeForExport($pac->deskripsi) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
