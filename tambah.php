<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_barang = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
    $stok = mysqli_real_escape_string($koneksi, $_POST['stok']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    $query = "INSERT INTO barang (nama_barang, kategori, harga, stok, deskripsi) 
              VALUES ('$nama_barang', '$kategori', '$harga', '$stok', '$deskripsi')";

    if (mysqli_query($koneksi, $query)) {
        showMessage('success', 'Data barang berhasil ditambahkan!');
        header('Location: barang.php');
        exit();
    } else {
        showMessage('danger', 'Gagal menambahkan data: ' . mysqli_error($koneksi));
    }
}

include 'template/header.php';
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Barang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="barang.php">Data Barang</a></li>
                        <li class="breadcrumb-item active">Tambah Barang</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Barang</h3>
                        </div>
                        <form method="POST" action="">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang</label>
                                    <input type="text" class="form-control" id="nama_barang"
                                        name="nama_barang" placeholder="Masukkan nama barang" required>
                                </div>

                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select class="form-control" id="kategori" name="kategori" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="Elektronik" selected>Elektronik</option>
                                        <option value="Furniture" >Furniture</option>
                                        <option value="Buku" selected>Buku</option>
                                        <option value="Aksesoris" selected>Aksesoris</option>
                                        <option value="Lainnya" selected>Lainnya</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="harga">Harga (Rp)</label>
                                            <input type="number" class="form-control" id="harga"
                                                name="harga" placeholder="Masukkan harga" min="0" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stok">Stok</label>
                                            <input type="number" class="form-control" id="stok"
                                                name="stok" placeholder="Masukkan stok" min="0" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi"
                                        rows="3" placeholder="Masukkan deskripsi barang"></textarea>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan
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