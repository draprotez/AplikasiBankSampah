<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="controller/loginController.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <?php
            // Menampilkan pesan error jika ada
            if (isset($_GET['error'])) {
                echo '<p class="error">' . htmlspecialchars($_GET['error']) . '</p>';
            }
            ?>
            
            <button type="submit">Login</button>
        </form>
    </div>
    <p>belum punya akun?</p><br>
    <a href="register.php"><button type="button">Register</button></a>
</body>
</html>