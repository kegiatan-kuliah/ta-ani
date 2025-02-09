<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengeluaran Barang Harian</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
    @php
        use Carbon\Carbon;

        Carbon::setLocale('id');
    @endphp
</head>

<body>
    <h2>Laporan Pengeluaran Barang Harian</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pengeluaran Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Jenis Keperluan</th>
                <th>Nama Yang Meminta</th>
                <th>NIP</th>
                <th>Foto Pengeluaran Barang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($applications as $index => $application)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ Carbon::parse($application->date)->translatedFormat('d F Y') }}</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>{{ $application->purpose }}</td>
                    <td>{{ $application->employee->name }}</td>
                    <td>{{ $application->employee->identity_no }}</td>
                    <td><img src="/storage/{{ $application->photo }}" width="100px" height="100px"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
