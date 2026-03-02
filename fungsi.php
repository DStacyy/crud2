<?php
// Fungsi untuk mendapatkan data barang dengan pencarian
function getBarang($keyword = '', $kategori = '') {
    global $koneksi;
    
    $query = "SELECT * FROM barang WHERE 1=1";
    $params = array();
    
    if (!empty($keyword)) {
        $query .= " AND (nama_barang LIKE ? OR deskripsi LIKE ?)";
        $params[] = "%$keyword%";
        $params[] = "%$keyword%";
    }
    
    if (!empty($kategori) && $kategori != 'semua') {
        $query .= " AND kategori = ?";
        $params[] = $kategori;
    }
    
    $query .= " ORDER BY id DESC";
    
    $stmt = mysqli_prepare($koneksi, $query);
    
    if (!empty($params)) {
        $types = str_repeat('s', count($params));
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }
    
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    return $result;
}

// Fungsi untuk mendapatkan semua kategori unik
function getKategori() {
    global $koneksi;
    $query = "SELECT DISTINCT kategori FROM barang ORDER BY kategori";
    $result = mysqli_query($koneksi, $query);
    
    $kategori = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $kategori[] = $row['kategori'];
    }
    
    return $kategori;
}
?>

