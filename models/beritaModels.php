<?php
/**
 * MODEL UNTUK MANAJEMEN BERITA
 */

/**
 * Mengambil semua berita, diurutkan dari yang terbaru
 */
function getAllBerita($conn) {
    $sql = "SELECT * FROM berita ORDER BY tanggal_post DESC";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

/**
 * Mengambil satu berita berdasarkan ID
 */
function getBeritaById($conn, $id) {
    $sql = "SELECT * FROM berita WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

/**
 * Memasukkan berita baru ke database
 */
function insertBerita($conn, $data) {
    $sql = "INSERT INTO berita (judul, konten, gambar) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", 
        $data['judul'], 
        $data['konten'], 
        $data['gambar'] // Nama file gambar
    );
    return $stmt->execute();
}

/**
 * Mengupdate berita di database
 */
function updateBerita($conn, $data) {
    // Cek apakah ada gambar baru atau tidak
    if (!empty($data['gambar'])) {
        // Jika ada gambar baru, update semua
        $sql = "UPDATE berita SET judul = ?, konten = ?, gambar = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", 
            $data['judul'], 
            $data['konten'], 
            $data['gambar'], 
            $data['id']
        );
    } else {
        // Jika tidak ada gambar baru, update judul dan konten saja
        $sql = "UPDATE berita SET judul = ?, konten = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", 
            $data['judul'], 
            $data['konten'], 
            $data['id']
        );
    }
    return $stmt->execute();
}

/**
 * Menghapus berita dari database
 */
function deleteBerita($conn, $id) {
    $sql = "DELETE FROM berita WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
?>