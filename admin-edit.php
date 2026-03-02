<?php
include 'config.php';

if (!isset($_GET['id'])) {
    header('Location: admin.php');
    exit();
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// Ambil data admin
$query = "SELECT * FROM admin WHERE id = '$id'";
$result = mysqli_query($koneksi, $query);
$admin = mysqli_fetch_assoc($result);

if (!$admin) {
    header('Location: admin.php');
    exit();
}

// Proses update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $telepon  = mysqli_real_escape_string($koneksi, $_POST['telepon']);

    $query = "UPDATE admin SET 
                nama = '$nama',
                email = '$email',
                password = '$password',
                telepon = '$telepon'
              WHERE id = '$id'";

    if (mysqli_query($koneksi, $query)) {
        header('Location: admin.php');
        exit();
    } else {
        echo "Gagal update: " . mysqli_error($koneksi);
    }
}

include 'template/header.php';
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <h1>Edit Data Admin</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Admin</h3>
                </div>

                <form method="POST">
                    <div class="card-body">

                        <div class="form-group">
                            <label>Nama Admin</label>
                            <input type="text" name="nama" class="form-control"
                                value="<?= htmlspecialchars($admin['nama']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"
                                value="<?= htmlspecialchars($admin['email']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control"
                                value="<?= htmlspecialchars($admin['password']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Telepon</label>
                            <input type="text" name="telepon" class="form-control"
                                value="<?= htmlspecialchars($admin['telepon']); ?>" required>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <a href="admin.php" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </section>
</div>

<?php include 'template/footer.php'; ?>