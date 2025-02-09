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

    <img src="logo.png" class="logo" alt="Logo">
    <div class="header">
        <p>PEMERINTAH PROVINSI SUMATERA BARAT</p>
        <p>SMK NEGERI 1 SOLOK SELATAN</p>
    </div>
    
    <div class="subtitle">SURAT PERINTAH PENGELUARAN/ PENYALURAN BARANG</div>
    <div class="subtitle">Nomor : {{ $application->application_no }}</div>
    <br>

    <table class="info-table">
        <tr>
            <td width="20%">Dari</td>
            <td>: Kepala SMKN 1 Solok Selatan</td>
        </tr>
        <tr>
            <td>Kepada</td>
            <td>: Pengurus Barang Pembantu SMKN 1 Sol-Sel</td>
        </tr>
    </table>

    <p>Harap diberikan/dikeluarkan barang sesuai dengan daftar di bawah ini, kepada:</p>
    
    <table class="info-table">
        <tr>
            <td width="20%">Nama</td>
            <td>: {{ $application->employee->name }}</td>
        </tr>
        <tr>
            <td>NIP</td>
            <td>: {{ $application->employee->identity_no }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>: KEPALA TENAGA ADMINISTRASI SEKOLAH</td>
        </tr>
    </table>

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

    <div class="signature-container">
        <div class="signature left">
            <p>Mengetahui</p>
            <p>Pengurus Barang Pembantu</p>
            <div>________________________</div>
        </div>

        <div class="signature right">
            <p>Muaralabuh, {{ Carbon::now()->translatedFormat('d F Y') }}</p>
            <p>Yang Meminta/Menerima</p>
            <div>________________________</div>
        </div>
    </div>

</body>
</html>