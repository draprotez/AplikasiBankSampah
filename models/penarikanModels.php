<?php
/**
 * MODEL UNTUK MANAJEMEN PENARIKAN
 */

/**
 * Mengambil semua histori penarikan (JOIN dengan user)
 */
function getAllPenarikan($conn) {
    $sql = "SELECT p.*, u.nama AS nama_user 
            FROM penarikan p
            JOIN users u ON p.id_user = u.id_user
            ORDER BY p.tanggal_penarikan DESC, p.id_penarikan DESC";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

/**
 * Memasukkan data penarikan baru
 */
function insertPenarikan($conn, $data) {
    // 1. Ubah SQL
    $sql = "INSERT INTO penarikan (id_user, jumlah, metode, tanggal_penarikan) 
            VALUES (?, ?, ?, ?)";
            
    $stmt = $conn->prepare($sql);
    
    // 2. Ubah bind_param (tambahkan 's' untuk string)
    $stmt->bind_param("idss", 
        $data['id_user'], 
        $data['jumlah'], 
        $data['metode'], // <-- TAMBAHKAN BARIS INI
        $data['tanggal_penarikan']
    );
    return $stmt->execute();
}

/**
 * Menghapus data penarikan
 * (PENTING: Hati-hati menggunakan ini, karena akan MENGEMBALIKAN saldo nasabah)
 */
function deletePenarikan($conn, $id) {
    $sql = "DELETE FROM penarikan WHERE id_penarikan = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
?>