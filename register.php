<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register Admin</title>
</head>
<body>
    <div class="register-container">
        <h2>Register Admin</h2>
        <form action="controller/registerController.php" method="POST">
            <label for="nama_admin">Nama Admin:</label>
            <input type="text" id="nama_admin" name="nama_admin" required>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Daftar</button>
        </form>
    </div>
</body>
</html>
