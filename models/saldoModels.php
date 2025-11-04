<?php

function getSaldoUser($conn, $id_user) {
    
    // Hitung total pemasukan (dari setoran)
    $total_setoran = 0;
    $sql_setoran = "SELECT SUM(total_harga) AS total FROM setoran WHERE id_user = ?";
    $stmt_setoran = $conn->prepare($sql_setoran);
    $stmt_setoran->bind_param("i", $id_user);
    $stmt_setoran->execute();
    $result_setoran = $stmt_setoran->get_result();
    if ($result_setoran->num_rows > 0) {
        $total_setoran = (float)$result_setoran->fetch_assoc()['total'];
    }

    // Hitung total pengeluaran (dari penarikan)
    $total_penarikan = 0;
    $sql_penarikan = "SELECT SUM(jumlah) AS total FROM penarikan WHERE id_user = ?";
    $stmt_penarikan = $conn->prepare($sql_penarikan);
    $stmt_penarikan->bind_param("i", $id_user);
    $stmt_penarikan->execute();
    $result_penarikan = $stmt_penarikan->get_result();
    if ($result_penarikan->num_rows > 0) {
        $total_penarikan = (float)$result_penarikan->fetch_assoc()['total'];
    }

    // Kembalikan saldo akhir
    return $total_setoran - $total_penarikan;
}
?>