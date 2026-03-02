<?php
include 'config.php';

if (!isset($_GET['id'])) {
    header('Location: barang.php');
    exit();
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

$query = "SELECT * FROM barang WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);
$barang = mysqli_fetch_assoc($result);

if (!$barang) {
    showMessage('danger', 'Data tidak ditemukan!');
    header('Location: barang.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_barang = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
    $stok = mysqli_real_escape_string($koneksi, $_POST['stok']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    $query = "UPDATE barang SET 
              nama_barang = '$nama_barang',
              kategori = '$kategori',
              harga = '$harga',
              stok = '$stok',
              deskripsi = '$deskripsi'
              WHERE id = '$id'";

    if (mysqli_query($koneksi, $query)) {
        showMessage('success', 'Data barang berhasil diupdate!');
        header('Location: barang.php');
        exit();
    } else {
        showMessage('danger', 'Gagal mengupdate data: ' . mysqli_error($koneksi));
    }
}

include 'template/header.php';
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ubah Data Barang</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Form Edit Barang</h3>
                        </div>
                        <form method="POST" action="">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input type="text" class="form-control" id="nama_barang"
                                        name="nama_barang" value="<?php echo htmlspecialchars($barang['nama_barang']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select class="form-control" id="kategori" name="kategori" required>
                                        <option value="Elektronik" <?php echo ($barang['kategori'] == 'Elektronik') ? 'selected' : ''; ?>>Elektronik</option>
                                        <option value="Furniture" <?php echo ($barang['kategori'] == 'Furniture') ? 'selected' : ''; ?>>Furniture</option>
                                        <option value="Buku" <?php echo ($barang['kategori'] == 'Buku') ? 'selected' : ''; ?>>Buku</option>
                                        <option value="Aksesoris" <?php echo ($barang['kategori'] == 'Aksesoris') ? 'selected' : ''; ?>>Aksesoris</option>
                                        <option value="Lainnya" <?php echo ($barang['kategori'] == 'Lainnya') ? 'selected' : ''; ?>>Lainnya</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="harga">Harga (Rp)</label>
                                            <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $barang['harga']; ?>" min="0" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stok">Stok</label>
                                            <input type="number" class="form-control" id="stok" name="stok" value="<?php echo $barang['stok']; ?>" min="0" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?php echo htmlspecialchars($barang['deskripsi']); ?></textarea>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save"></i> Update
                                </button>
                                <a href="barang.php" class="btn btn-default">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'template/footer.php'; ?>