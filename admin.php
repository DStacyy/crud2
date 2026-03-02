<?php
include 'config.php';
include 'template/header.php';

$message = getMessage();
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Admin</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Data Admin</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <?php if ($message): ?>
                <div class="alert alert-<?php echo $message['type']; ?> alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?php echo $message['text']; ?>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Admin</h3>
                    <div class="card-tools">
                        <a href="tambah_admin.php" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Admin
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query  = "SELECT * FROM admin ORDER BY id DESC";
                            $result = mysqli_query($koneksi, $query);
                            $no = 1;

                            while ($row = mysqli_fetch_assoc($result)):
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($row['nama']); ?></td>
                                    <td><?= htmlspecialchars($row['email']); ?></td>
                                    <td><?= htmlspecialchars($row['telepon']); ?></td>
                                    <td><?= $row['created_at']; ?></td>
                                    <td>
                                        <a href="edit_admin.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="hapus_admin.php?id=<?= $row['id']; ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus admin ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
</div>

<?php include 'template/footer.php'; ?>