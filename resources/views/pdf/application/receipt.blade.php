<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Perintah Pengeluaran Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            font-weight: bold;
        }
        .logo {
            position: absolute;
            top: 10px;
            left: 10px;
            width: 80px;
        }
        .title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }
        .subtitle {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            text-decoration: underline;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .table, .table th, .table td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #e0e0e0;
            text-align: center;
        }
        .info-table td {
            padding: 5px;
        }
        
        .signature-container {
            width: 100%;
            margin-top: 50px;
        }
        .signature {
            text-align: center;
        }
        .signature div {
            margin-bottom: 60px; /* Space for signature */
        }

        .left {
          float: right;
        }

        .right {
          float: right;
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
    
    <div style="margin-top: 15px;">
        <div class="subtitle">TANDA TERIMA BARANG</div>
        <div class="subtitle">Nomor : {{ $application->application_no }}</div>
    </div>
    <br>

    <p>Telah diterima barang sebagai berikut: </p>

    <table class="table">
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA BARANG</th>
                <th>JUMLAH</th>
                <th>SATUAN</th>
                <th>KEBUTUHAN UNTUK</th>
                <th>KET</th>
            </tr>
        </thead>
        <tbody>
          @foreach($application->items as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->unit }}</td>
                <td>{{ $application->purpose }}</td>
                <td></td>
            </tr>
          @endforeach
        </tbody>
    </table>

    <div style="width: 100%; margin-top: 40px; margin-bottom: 40px;">
        <div style="width: 50%; float: left; margin-bottom: 40px;">
            <br>
            <br>
            <br>
            <p style="margin-top:0px; margin-bottom: 0px;">Pengurus Barang Pembantu</p>
            <br>
            <br>
            <br>
            <br>
            <p style="margin-top:0px; margin-bottom: 0px;">ZUMMI WALNI,A.Md</p>
            <p style="margin-top:0px; margin-bottom: 0px;">NIP. 198310162014062002</p>
        </div>
        <div style="width: 50%; float: right; text-align: right; margin-bottom: 40px;">
            <p>Solok Selatan, {{ Carbon::now()->translatedFormat('d F Y')}} </p>
            <p style="margin-top:0px; margin-bottom: 0px;">Yang Meminta</p>
            <br>
            <br>
            <br>
            <br>
            <p style="margin-top:0px; margin-bottom: 0px;">{{ $application->employee->name }}</p>
            <p style="margin-top:0px; margin-bottom: 0px;">NIP. {{ $application->employee->identity_no }}</p>
        </div>
    </div>
</body>
</html>