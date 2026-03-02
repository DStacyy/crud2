<?php
include 'config.php';

if (!isset($_GET['id'])) {
    header('Location: barang.php');
    exit();
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// Hapus data barang berdasarkan ID
$query = "DELETE FROM barang WHERE id = '$id'";

if (mysqli_query($koneksi, $query)) {
    showMessage('success', 'Data barang berhasil dihapus!');
} else {
    showMessage('danger', 'Gagal menghapus data: ' . mysqli_error($koneksi));
}

header('Location: barang.php');
exit();
