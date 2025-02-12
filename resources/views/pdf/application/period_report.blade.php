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
    <div>
        <img src="{{ public_path('img/logo-provinsi-sumbar.png') }}" alt="" width="50px" height="50px" style="position: absolute; top: 25px;">
        <h3 style="margin-bottom: 0px; text-align: center;">PEMERINTAH PROVINSI SUMATERA BARAT</h3>
        <h1 style="margin-top: 0px; text-align: center;">SMK NEGERI 1 SOLOK SELATAN</h1>
        <hr>
    </div>
    <h2 style="text-align: center;">Laporan Pengeluaran Barang</h2>
    <h2 style="text-align: center;">Periode {{ Carbon::parse($startDate)->translatedFormat('d F Y') }} - {{ Carbon::parse($endDate)->translatedFormat('d F Y') }}</h2>
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
            @forelse ($applications as $index => $application)
                @php
                    $photo = '/storage/'.$application->photo;
                @endphp
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ Carbon::parse($application->date)->translatedFormat('d F Y') }}</td>
                    <td>
                        @foreach($application->items as $item)
                            {{ $item->name }} 
                        @endforeach
                    </td>
                    <td>{{ $application->total_quantity }}</td>
                    <td>
                        @foreach($application->items as $item)
                            {{ $item->unit }} 
                        @endforeach
                    </td>
                    <td>{{ $application->purpose }}</td>
                    <td>{{ $application->employee->name }}</td>
                    <td>{{ $application->employee->identity_no }}</td>
                    <td><img src="{{ public_path($photo) }}" width="100px" height="100px"></td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align: center;">Tidak Ada Data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div style="display: inline-block; width: 100%; margin-top: 40px;">
        <div style="width: 30%; float: left;">
            <br>
            <br>
            <br>
            <p style="margin-top:0px; margin-bottom: 0px;">Mengetahui</p>
            <p style="margin-top:0px; margin-bottom: 0px;">Kepala Sekolah</p>
            <br>
            <br>
            <br>
            <p style="margin-top:0px; margin-bottom: 0px;">EFRIZOLSE.MM</p>
            <p style="margin-top:0px; margin-bottom: 0px;">NIP. 197212012002121002</p>
        </div>
        <div style="width: 50%; float: right; text-align: right;">
            <p>Solok Selatan, {{ Carbon::now()->translatedFormat('d F Y')}} </p>
            <p style="margin-top:0px; margin-bottom: 0px;">Pengurus Barang Pembantu</p>
            <p style="margin-top:0px; margin-bottom: 0px;">Sekolah</p>
            <br>
            <br>
            <br>
            <p style="margin-top:0px; margin-bottom: 0px;">ZUMMI WALNI,A.Md</p>
            <p style="margin-top:0px; margin-bottom: 0px;">NIP. 198310162014062002</p>
        </div>
    </div>
</body>

</html>
