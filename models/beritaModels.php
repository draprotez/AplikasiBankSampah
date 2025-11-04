<?php
function getAllBerita($conn) {
    $sql = "SELECT * FROM berita ORDER BY tanggal_post DESC";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getBeritaById($conn, $id) {
    $sql = "SELECT * FROM berita WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

function insertBerita($conn, $data) {
    $sql = "INSERT INTO berita (judul, konten, gambar) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", 
        $data['judul'], 
        $data['konten'], 
        $data['gambar']
    );
    return $stmt->execute();
}

function updateBerita($conn, $data) {
    if (!empty($data['gambar'])) {
        $sql = "UPDATE berita SET judul = ?, konten = ?, gambar = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", 
            $data['judul'], 
            $data['konten'], 
            $data['gambar'], 
            $data['id']
        );
    } else {
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

function deleteBerita($conn, $id) {
    $sql = "DELETE FROM berita WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
?>