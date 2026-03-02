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
        body{
            padding: 20px;
        }
        .header{
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1{
            margin-bottom: 5px;
        }
        .info{
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f5f5f5;
        }
        table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        }
        table, th, td {
        border: 1px solid #333;
        }
        th, td {
        padding: 8px;
        text-align: left;
        }
        th {
        background-color: #f2f2f2;
        }
        .total {

        font-weight: bold;
        background-color: #e8f4ff;
        }   
        /* .no-print {
        display: none;
        } */
        @media print {
        .no-print {
        display: none !important;
        }
        body {
        padding: 0;
        margin: 0;
        }
        @page {
        size: portrait;
        margin: 1cm;
        }
        }
    </style>
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

            while ($row = mysqli_fetch_assoc($result)):
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
            <?php endwhile; ?>

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
        <p>Rata-rata Harga: Rp <?php echo number_format(($no > 1) ? $total_harga / ($no - 1) : 0, 0, ',', '.'); ?></p>
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
            if (window.opener) {
                window.close(); // jika dibuka popup
            } else {
                window.location.href = "index.php"; // jika bukan popup
            }
        }
    </script>
</body>
</html>