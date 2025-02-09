<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Persediaan Barang</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th {
            background-color: #e0e0e0;
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
          float: right%;
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
    <h2>Laporan Persediaan Barang</h2>
    <h2>SMK NEGERI 1 SOLOK SELATAN</h2>
    <h4>Kondisi Per {{ Carbon::now()->translatedFormat('d F Y') }}</h4>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Masuk Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah Barang Masuk</th>
                <th>Satuan</th>
                <th>Harga Satuan</th>
                <th>Total Harga</th>
                <th>Jumlah Barang Keluar</th>
                <th>Stok Barang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assets as $index => $asset)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ Carbon::parse($asset->created_at)->translatedFormat('d F Y') }}</td>
                    <td>{{ $asset->name }}</td>
                    <td>{{ $asset->begin_stock }}</td>
                    <td>{{ $asset->unit }}</td>
                    <td>{{ $asset->price }}</td>
                    <td>{{ $asset->price * $asset->begin_stock }}</td>
                    <td>{{ $asset->out_stock }}</td>
                    <td>{{ $asset->end_stock }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
  
    <div class="signature-container">
    <p style="text-align:right;">Solok Selatan, {{ Carbon::now()->translatedFormat('d F Y') }}</p>
      <div class="signature left">
          <p>Mengetahui</p>
          <p>Kepala Sekolah</p>
          <br>
          <br>
          <br>
          <br>
          <strong>EFRIZOLSE, MM</strong><br>
          NIP. 197212012002121002
      </div>

      <div class="signature right">
          <p>Pengurus Barang Pembantu Sekolah</p>
          <br>
          <br>
          <br>
          <br>
          <strong>ZUMMI WALNI, A.Md</strong><br>
          NIP. 198310162014062002
      </div>
  </div>
</body>

</html>
