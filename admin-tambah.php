<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $telepon  = mysqli_real_escape_string($koneksi, $_POST['telepon']);

    $query = "INSERT INTO admin (nama, email, password, telepon) 
              VALUES ('$nama', '$email', '$password', '$telepon')";

    if (mysqli_query($koneksi, $query)) {
        header('Location: admin.php');
        exit();
    } else {
        echo "Gagal menambahkan admin: " . mysqli_error($koneksi);
    }
}

include 'template/header.php';
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Tambah Admin</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Tambah Admin</h3>
                </div>

                <form method="POST">
                    <div class="card-body">

                        <div class="form-group">
                            <label>Nama Admin</label>
                            <input type="text" name="nama" class="form-control"
                                placeholder="Masukkan nama admin" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"
                                placeholder="Masukkan email" required>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control"
                                placeholder="Masukkan password" required>
                        </div>

                        <div class="form-group">
                            <label>Telepon</label>
                            <input type="text" name="telepon" class="form-control"
                                placeholder="Masukkan nomor telepon" required>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="admin.php" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </section>
</div>

<?php include 'template/footer.php'; ?>