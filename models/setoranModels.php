<?php
/**
 * MODEL UNTUK MANAJEMEN SETORAN
 * Mengambil semua data setoran dengan JOIN
 */
function getAllSetoran($conn) {
    $sql = "SELECT s.*, u.nama AS nama_user, js.nama_jenis 
            FROM setoran s
            JOIN users u ON s.id_user = u.id_user
            JOIN jenis_sampah js ON s.id_jenis = js.id_jenis
            ORDER BY s.tanggal_setor DESC, s.id_setoran DESC";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

/**
 * Mengambil satu data setoran berdasarkan ID
 */
function getSetoranById($conn, $id) {
    $sql = "SELECT * FROM setoran WHERE id_setoran = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

/**
 * Memasukkan setoran baru ke database
 */
function insertSetoran($conn, $data) {
    $sql = "INSERT INTO setoran (id_user, id_jenis, berat_kg, total_harga, tanggal_setor) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iidds", 
        $data['id_user'], 
        $data['id_jenis'], 
        $data['berat_kg'], 
        $data['total_harga'], // Harga yang sudah dihitung
        $data['tanggal_setor']
    );
    return $stmt->execute();
}

/**
 * Mengupdate data setoran
 */
function updateSetoran($conn, $data) {
    $sql = "UPDATE setoran SET id_user = ?, id_jenis = ?, berat_kg = ?, total_harga = ?, tanggal_setor = ?
            WHERE id_setoran = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiddsi", 
        $data['id_user'], 
        $data['id_jenis'], 
        $data['berat_kg'], 
        $data['total_harga'], // Harga yang sudah dihitung ulang
        $data['tanggal_setor'],
        $data['id_setoran']
    );
    return $stmt->execute();
}

/**
 * Menghapus data setoran
 */
function deleteSetoran($conn, $id) {
    $sql = "DELETE FROM setoran WHERE id_setoran = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
?>