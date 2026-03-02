<?php
include 'config.php';

if (!isset($_GET['id'])) {
    header('Location: admin.php');
    exit();
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// Hapus data admin berdasarkan ID
$query = "DELETE FROM admin WHERE id = '$id'";

if (mysqli_query($koneksi, $query)) {
    header('Location: admin.php');
    exit();
} else {
    echo "Gagal menghapus data admin: " . mysqli_error($koneksi);
}
