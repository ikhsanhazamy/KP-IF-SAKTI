<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Laporan Anggota</title>

    <style>

        body{
            font-family: sans-serif;
        }

        table{
            width:100%;
            border-collapse: collapse;
            margin-top:20px;
        }

        th, td{
            border:1px solid #ccc;
            padding:10px;
            font-size:12px;
        }

        th{
            background:#15633D;
            color:white;
        }

        h1{
            text-align:center;
        }

    </style>
</head>

<body>

    <h1>
        Laporan Data Anggota
    </h1>

    <table>

        <thead>

            <tr>

                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>PAC</th>
                <th>Status</th>

            </tr>

        </thead>

        <tbody>

            @foreach($anggotas as $item)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $item->nama }}</td>

                    <td>{{ $item->email }}</td>

                    <td>{{ $item->pac }}</td>

                    <td>{{ $item->status }}</td>

                </tr>

            @endforeach

        </tbody>

    </table>

</body>
</html>