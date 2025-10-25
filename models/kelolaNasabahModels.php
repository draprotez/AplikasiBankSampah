<?php
function insertUser($conn, $data) {
    $sql = "INSERT INTO users (nama, alamat, no_hp, email, username, password) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", 
        $data['nama'], $data['alamat'], $data['no_hp'], 
        $data['email'], $data['username'], $data['password_hashed']
    );
    if ($stmt->execute()) {
        return true;
    } else {
        return "Error: " . $stmt->error;
    }
}
function getAllUsers($conn) {
    $sql = "SELECT * FROM users ORDER BY nama ASC";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}
function getUserById($conn, $id) {
    $sql = "SELECT * FROM users WHERE id_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}
function updateUser($conn, $data) {
    $sql = "UPDATE users SET nama = ?, alamat = ?, no_hp = ?, email = ?, username = ? 
            WHERE id_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", 
        $data['nama'], $data['alamat'], $data['no_hp'], 
        $data['email'], $data['username'], $data['id_user']
    );
    
    if ($stmt->execute()) {
        return true;
    } else {
        return "Error: " . $stmt->error;
    }
}
function updateUserPassword($conn, $id, $new_password_hashed) {
    $sql = "UPDATE users SET password = ? WHERE id_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $new_password_hashed, $id);
    
    if ($stmt->execute()) {
        return true;
    } else {
        return "Error: " . $stmt->error;
    }
}
function deleteUser($conn, $id) {
    $sql = "DELETE FROM users WHERE id_user = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        return true;
    } else {
        return "Error: " . $stmt->error;
    }
}
?>