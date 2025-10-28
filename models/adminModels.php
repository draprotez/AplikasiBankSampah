<?php
/**
 * MODEL UNTUK MANAJEMEN ADMIN
 */

/**
 * Memasukkan admin baru ke database
 *
 * @param mysqli $conn Koneksi database
 * @param array $data Data admin (nama_admin, username, password_hashed)
 * @return true|string Mengembalikan true jika sukses, atau pesan error jika gagal
 */
function insertAdmin($conn, $data) {
    
    $sql = "INSERT INTO admin (nama_admin, username, password) VALUES (?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        return "Error saat menyiapkan statement: " . $conn->error;
    }
    
    // Bind parameter ke statement
    $stmt->bind_param("sss", 
        $data['nama_admin'], 
        $data['username'], 
        $data['password_hashed']
    );

    // Eksekusi dan kembalikan hasilnya
    if ($stmt->execute()) {
        return true;
    } else {
        // Cek jika error karena duplikat username (error code 1062)
        if ($conn->errno == 1062) { 
            return "Username '" . htmlspecialchars($data['username']) . "' sudah terdaftar.";
        } else {
            return "Gagal mendaftarkan admin: " . $stmt->error;
        }
    }
}
?>