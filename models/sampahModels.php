<?php
// Fungsi untuk mengambil semua jenis sampah
function getAllSampah($conn) {
    $sql = "SELECT * FROM jenis_sampah ORDER BY nama_jenis ASC";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Fungsi untuk mengambil jenis sampah berdasarkan ID
function getSampahById($conn, $id) {
    $sql = "SELECT * FROM jenis_sampah WHERE id_jenis = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Fungsi untuk menambahkan jenis sampah baru
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

// Fungsi untuk mengupdate jenis sampah
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

// Fungsi untuk menghapus jenis sampah
function deleteSampah($conn, $id) {
    $sql = "DELETE FROM jenis_sampah WHERE id_jenis = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
?>