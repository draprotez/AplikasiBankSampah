<?php
/**
 * MODEL UNTUK MANAJEMEN JENIS SAMPAH
 */

/**
 * Mengambil semua jenis sampah
 */
function getAllSampah($conn) {
    $sql = "SELECT * FROM jenis_sampah ORDER BY nama_jenis ASC";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

/**
 * Mengambil satu jenis sampah berdasarkan ID
 */
function getSampahById($conn, $id) {
    $sql = "SELECT * FROM jenis_sampah WHERE id_jenis = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

/**
 * FUNGSI BARU - Memasukkan jenis sampah baru
 */
function insertSampah($conn, $data) {
    $sql = "INSERT INTO jenis_sampah (nama_jenis, kategori, harga_per_kg) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssd", 
        $data['nama_jenis'], 
        $data['kategori'], 
        $data['harga_per_kg']
    );
    return $stmt->execute();
}

/**
 * FUNGSI BARU - Mengupdate jenis sampah
 */
function updateSampah($conn, $data) {
    $sql = "UPDATE jenis_sampah SET nama_jenis = ?, kategori = ?, harga_per_kg = ? 
            WHERE id_jenis = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdi", 
        $data['nama_jenis'], 
        $data['kategori'], 
        $data['harga_per_kg'], 
        $data['id_jenis']
    );
    return $stmt->execute();
}

/**
 * FUNGSI BARU - Menghapus jenis sampah
 */
function deleteSampah($conn, $id) {
    $sql = "DELETE FROM jenis_sampah WHERE id_jenis = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
?>