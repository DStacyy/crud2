<?php
    include 'config.php';
    include 'fungsi.php';

    // ambil parameter pencarian
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
    $kategori_filter = isset($_GET['kategori']) ? $_GET['kategori'] : '';

    //ambil data barang
    $result = getBarang($keyword, $kategori_filter);

    // ambil semua kategori untuk dropdown
    $kategori_list = getKategori();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Barang</title>
    <style>
        *{
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
        }
        body {
        background-color: #f4f6f9;
        padding: 30px;
    }

    .header {
        text-align: center;
        margin-bottom: 25px;
    }

    .header h1 {
        font-weight: 600;
        color: #343a40;
        margin-bottom: 5px;
    }

    .header p {
        color: #6c757d;
        font-size: 14px;
    }

    .info {
        background: #ffffff;
        padding: 15px 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
        margin-bottom: 20px;
        border-left: 4px solid #007bff;
    }

    .info p {
        margin-bottom: 5px;
        font-size: 14px;
        color: #495057;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #ffffff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 0 15px rgba(0,0,0,0.05);
    }

    thead {
        background-color: #007bff;
        color: white;
    }

    th, td {
        padding: 10px 12px;
        font-size: 14px;
    }

    th {
        text-align: left;
        font-weight: 600;
    }

    tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    tbody tr:hover {
        background-color: #e9f3ff;
    }

    .total {
        font-weight: bold;
        background-color: #e2f0ff !important;
        color: #004085;
    }

    .no-print button {
        padding: 8px 14px;
        margin: 0 5px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        transition: 0.2s ease;
    }

    .no-print button:first-child {
        background-color: #28a745;
        color: white;
    }

    .no-print button:last-child {
        background-color: #6c757d;
        color: white;
    }

    .no-print button:hover {
        opacity: 0.85;
    }

    @media print {

    /* Sembunyikan tombol & semua button */
    .no-print,
    .no-print *,
    button {
        display: none !important;
    }

    body {
        background: white !important;
        padding: 0;
        color: black !important;
        font-size: 12px;
    }

    .header h1 {
        color: black !important;
    }

    .header p {
        color: black !important;
    }

    .info {
        background: white !important;
        border: 1px solid #000 !important;
        box-shadow: none !important;
    }

    table {
        box-shadow: none !important;
        border: 1px solid #000;
        page-break-inside: auto;
    }

    thead {
        background: white !important;
        color: black !important;
    }

    th, td {
        border: 1px solid #000;
        padding: 6px;
    }

    tbody tr {
        background: white !important;
    }

    .total {
        background: #ddd !important;
        color: black !important;
    }

    @page {
        margin: 1cm;
    }
}
        
    </style>
</head>

<body>
    <div class="no-print" style="margin-bottom: 20px; text-align: center;">
        <button onclick="window.print();">Cetak Halaman</button>
        <button onclick="tutupHalaman();">Tutup</button>
        </div>
    <div class="header">
        <h1>LAPORAN DATA BARANG</h1>
        <P>Tanggal Cetak <?= date('d/m/y H:i:s') ?></P>
    </div>
    <div class="info">
        <p><strong>Filter:</strong>
            <?php
            if (!empty($keyword))
                echo ' Kata kunci: "' . htmlspecialchars($keyword) . '"';
            if (!empty($kategori_filter) && $kategori_filter != 'semua')
                echo ' Kategori: ' . htmlspecialchars($kategori_filter);
            ?>
        </p>
        <p><strong>Total Data:</strong> <?php echo mysqli_num_rows($result); ?> barang</p>
    </div>
    <table>
        <?php
        $no = 1;
        $total_harga = 0;
        $total_stok = 0;
        ?>
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
            <?php
            $no = 1;
            $total_harga = 0;
            $total_stok = 0;

            while ($row = mysqli_fetch_assoc($result)){
                $total_harga += $row['harga'] * $row['stok'];
                $total_stok += $row['stok'];
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo htmlspecialchars($row['nama_barang']); ?></td>
                    <td><?php echo htmlspecialchars($row['kategori']); ?></td>
                    <td>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                    <td><?php echo $row['stok']; ?></td>
                    <td><?php echo htmlspecialchars($row['deskripsi']); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($row['created_at'])); ?></td>
                </tr>
            <?php } ?>

            <!-- Total -->
            <tr class="total">
                <td colspan="3">TOTAL</td>
                <td>Rp <?php echo number_format($total_harga, 0, ',', '.'); ?></td>
                <td><?php echo $total_stok; ?></td>
                <td colspan="2"></td>
            </tr>
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        <p><strong>Ringkasan:</strong></p>
        <p>Total Data: <?php echo ($no - 1); ?> barang</p>
        <p>Total Nilai Barang: Rp <?php echo number_format($total_harga, 0, ',', '.'); ?></p>
        <p>Rata-rata Harga: Rp <?php echo number_format(($no > 1) ? $total_harga / $total_stok : 0, 0, ',', '.'); ?></p>
    </div>

    <script>
        window.onload = function () {

            // Auto print
            if (window.location.search.indexOf('auto_print') !== -1) {
                window.print();
            }

            // Auto close
            if (window.location.search.indexOf('auto_close') !== 0) {
                window.close();
            }
        };

        // Fungsi tombol tutup
        function tutupHalaman() {
        // Coba tutup jendela (berhasil jika dibuka via window.open)
        window.close();

        // Jika gagal menutup (misal dibuka di tab baru/bukan popup), 
        // arahkan kembali ke halaman barang.php (sesuaikan nama file Anda)
        setTimeout(function() {
            window.location.href = "barang.php"; 
        }, 200); // delay 0.5 detik
    }
    </script>
</body>
</html>