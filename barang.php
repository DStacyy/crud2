<?php
include 'config.php';
include 'template/header.php';
include 'fungsi.php';

// Ambil parameter pencarian
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$kategori_filter = isset($_GET['kategori']) ? $_GET['kategori'] : '';

// Ambil data dengan filter
$result = getBarang($keyword, $kategori_filter);

// Ambil semua kategori untuk dropdown
$kategori_list = getKategori();

$message = getMessage();
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Data Barang</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            
           <?php if ($message): ?>
                <div class="alert alert-<?php echo $message['type']; ?> alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?php echo $message['text']; ?>
                </div>
            <?php endif; ?>

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Pencarian dan Filter</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form method="GET" action="barang.php" class="form-inline">
                        <div class="form-group mb-2 mr-2">
                            <label for="keyword" class="sr-only">Kata Kunci</label>
                            <input type="text" class="form-control" id="keyword" name="keyword"
                                placeholder="Cari nama barang" value="<?php echo htmlspecialchars($keyword); ?>">
                        </div>

                        <div class="form-group mb-2 mr-2">
                            <label for="kategori" class="sr-only">Kategori</label>
                            <select class="form-control" id="kategori" name="kategori">
                                <option value="semua">Semua Kategori</option>
                                <?php foreach ($kategori_list as $kat): ?>
                                    <option value="<?php echo htmlspecialchars($kat); ?>"
                                        <?php echo ($kategori_filter == $kat) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($kat); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mb-2 mr-2">
                            <i class="fas fa-search"></i> Cari
                        </button>

                        <a href="barang.php" class="btn btn-secondary mb-2">
                            <i class="fas fa-redo"></i> Reset
                        </a>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Barang</h3>
                    <div class="card-tools">
                        <a href="print.php" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Cetak Barang
                        </a>
                    </div>
                    <div class="card-tools">
                        <a href="tambah.php" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Barang
                        </a>
                    </div>
                </div>
                
<div class="card-body">
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <div class="alert alert-info">
                            Ditemukan <?php echo mysqli_num_rows($result); ?> data barang
                            <?php if (!empty($keyword)): ?>
                                dengan kata kunci "<?php echo htmlspecialchars($keyword); ?>"
                            <?php endif; ?>
                        </div>
                        <table class="table table-bordered table-striped datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Deskripsi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // $query = "SELECT * FROM barang ORDER BY id DESC";
                                // $result = mysqli_query($koneksi, $query);
                                $no = 1;

                                while ($row = mysqli_fetch_assoc($result)):
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo htmlspecialchars($row['nama_barang']); ?></td>
                                        <td>
                                            <span class="badge bg-info"><?php echo htmlspecialchars($row['kategori']); ?></span>
                                        </td>
                                        <td>Rp <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                                        <td>
                                            <span class="badge bg-<?php echo ($row['stok'] > 0) ? 'success' : 'danger'; ?>">
                                                <?php echo $row['stok']; ?>
                                            </span>
                                        </td>
                                        <td><?php echo substr(htmlspecialchars($row['deskripsi']), 0, 50); ?>...</td>
                                        <td>
                                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="hapus.php?id=<?php echo $row['id']; ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <div class="alert alert-warning text-center">
                            <i class="fas fa-exclamation-triangle"></i> Tidak ada data barang ditemukan.
                            <?php if (!empty($keyword)): ?>
                                Coba dengan kata kunci lain.
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>




                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'template/footer.php'; ?>

