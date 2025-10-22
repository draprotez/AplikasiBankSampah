<?php
function insertUser($conn, $data) {
    
    $sql = "INSERT INTO users (nama, alamat, no_hp, email, username, password) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        return "Error saat menyiapkan statement: " . $conn->error;
    }
    
    // Bind parameter ke statement
    $stmt->bind_param("ssssss", 
        $data['nama'], 
        $data['alamat'], 
        $data['no_hp'], 
        $data['email'], 
        $data['username'], 
        $data['password_hashed']
    );

    // Eksekusi dan kembalikan hasilnya
    if ($stmt->execute()) {
        return true;
    } else {
        // Cek jika error karena duplikat username/email
        if ($conn->errno == 1062) { 
            return "Username atau Email sudah terdaftar.";
        } else {
            return "Gagal menambahkan user: " . $stmt->error;
        }
    }
}
?>