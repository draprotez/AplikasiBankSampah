<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
</head>
<body>
    <div class="login-container">
        <h2>Login Admin</h2>
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
</body>
</html>