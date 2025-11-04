<?php
function insertAdmin($conn, $data) {
    try {
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
            // Cek jika error karena duplikat username
            if ($conn->errno == 1062) { 
                return "Username '" . htmlspecialchars($data['username']) . "' sudah terdaftar.";
            } else {
                return "Gagal mendaftarkan admin: " . $stmt->error;
            }
        }
    } catch (mysqli_sql_exception $e) {
        // Tangani exception untuk duplicate entry
        if ($e->getCode() == 1062) {
            return "Username '" . htmlspecialchars($data['username']) . "' sudah terdaftar.";
        } else {
            return "Terjadi kesalahan: " . $e->getMessage();
        }
    }
}
?>