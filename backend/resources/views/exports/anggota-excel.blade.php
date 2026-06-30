<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <table border="1">
        <thead>
            <tr style="background:#15633D;color:#FFFFFF;font-weight:bold">
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Tanggal Lahir</th>
                <th>Umur</th>
                <th>PAC</th>
                <th>Profesi</th>
                <th>Pendidikan</th>
                <th>Status</th>
                <th>Status Pernikahan</th>
                <th>Tanggal Bergabung</th>
            </tr>
        </thead>
        <tbody>
            @foreach($anggotas as $anggota)
                <tr>
                    <td>{{ $anggota->nama }}</td>
                    <td>{{ $anggota->email }}</td>
                    <td>{{ $anggota->telepon }}</td>
                    <td>{{ $anggota->tanggal_lahir?->format('Y-m-d') }}</td>
                    <td>{{ $anggota->umur }}</td>
                    <td>{{ $anggota->pac }}</td>
                    <td>{{ $anggota->profesi }}</td>
                    <td>{{ $anggota->pendidikan }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $anggota->status)) }}</td>
                    <td>
                        @switch($anggota->status_pernikahan)
                            @case('kawin') Kawin @break
                            @case('cerai_hidup') Cerai Hidup @break
                            @case('cerai_mati') Cerai Mati @break
                            @case('belum_kawin') Belum Kawin @break
                            @default -
                        @endswitch
                    </td>
                    <td>{{ $anggota->tanggal_bergabung?->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
