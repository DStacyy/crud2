<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Barang</title>
</head>
<body>
    <div class="no-print" style="margin-bottom: 20px; text-align: center;">
        <button onclick="window.print();">Cetak Halaman</button>
        <button onclick="window.close();">Tutup</button>
        </div>
    <div class="header">
        <h1>LAPORAN DATA BARANG</h1>
        <P>Tanggal Cetak <?= date('d/m/y H:i:s') ?></P>
    </div>
    <div class="info">
        <p><strong>Filter: </strong> Kategori: Elektronik</p>
        <p><strong>Total Data: </strong> 20 barang </p>
    </div>
    <table>
        <thead>
            <th>Id</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Deskripsi</th>
            <th>Tanggal Input</th>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Kursi Gemink</td>
                <td>Furniture</td>
                <td>1800000</td>
                <td>15</td>
                <td>Kursi Untuk Main Game</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
            </tr>
        </tbody>
    </table>

    <div style="margin-top:20px;">
        <p><strong>Ringkasan:</strong></p>
        <p>Total Data: 100 Barang</p>
        <p>Total Nilai Barang: Rp1.500.000</p>
        <p>Rata-rata Harga: Rp450.000</p>
    </div>
    <script>
        window.onload = function(){
            if(window.location.search.indexOf('auto-print')!== -1){
                window.print();
            }
        }
    </script>
</body>
</html>