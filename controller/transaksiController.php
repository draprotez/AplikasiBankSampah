<?php
require_once("../config/database.php");

function getRiwayatTransaksi($id_user) {
    global $conn;
    $sql = "
        SELECT 
            t.tanggal_pengajuan,
            j.nama_jenis AS jenis_sampah,
            t.berat,
            t.harga
        FROM transaksi t
        INNER JOIN jenis_sampah j ON t.id_jenis = j.id_jenis
        WHERE t.id_user = ?
        ORDER BY t.tanggal_pengajuan DESC
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    return $stmt->get_result();
}
?>
