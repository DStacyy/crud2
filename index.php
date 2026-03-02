<?php
include 'config.php';
include 'template/header.php';
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Dashboard</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <!-- Info boxes -->
            <div class="row">

                <!-- Total Barang -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1">
                            <i class="fas fa-box"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Barang</span>
                            <?php
                            $qBarang = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM barang");
                            $total_barang = mysqli_fetch_assoc($qBarang)['total'] ?? 0;
                            ?>
                            <span class="info-box-number"><?= $total_barang; ?></span>
                        </div>
                    </div>
                </div>

                <!-- Total Stok -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1">
                            <i class="fas fa-shopping-cart"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Stok</span>
                            <?php
                            $qStok = mysqli_query($koneksi, "SELECT SUM(stok) AS total_stok FROM barang");
                            $total_stok = mysqli_fetch_assoc($qStok)['total_stok'] ?? 0;
                            ?>
                            <span class="info-box-number"><?= $total_stok; ?></span>
                        </div>
                    </div>
                </div>

                <!-- Total Admin -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1">
                            <i class="fas fa-user-shield"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Admin</span>
                            <?php
                            $qAdmin = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM admin");
                            $total_admin = mysqli_fetch_assoc($qAdmin)['total'] ?? 0;
                            ?>
                            <span class="info-box-number"><?= $total_admin; ?></span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Selamat Datang di Aplikasi CRUD</h3>
                        </div>
                        <div class="card-body">
                            <p>Aplikasi ini digunakan untuk mengelola data barang dan admin dengan fitur CRUD
                                (Create, Read, Update, Delete).</p>

                            <p>Fitur yang tersedia:</p>
                            <ul>
                                <li>Manajemen data barang</li>
                                <li>Manajemen data admin</li>
                                <li>Tambah, edit, dan hapus data</li>
                            </ul>

                            <a href="barang.php" class="btn btn-primary">
                                <i class="fas fa-box"></i> Lihat Data Barang
                            </a>

                            <a href="admin.php" class="btn btn-warning ml-2">
                                <i class="fas fa-user"></i> Lihat Data Admin
                            </a>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<?php include 'template/footer.php'; ?>