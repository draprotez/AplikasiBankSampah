<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <div class="container">
        <div class="login-card">
            <h2>Login</h2>
            <form action="controller/loginController.php" method="POST">
                <div class="input-group">
                    <input type="text" id="username" name="username" placeholder="Username / Email" required>
                </div>
                
                <div class="input-group password-group">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <span class="toggle-password" onclick="togglePassword()">👁️‍🗨️</span>
                </div>

                <?php
                if (isset($_GET['error'])) {
                    echo '<p class="error">' . htmlspecialchars($_GET['error']) . '</p>';
                }
                ?>

                <button type="submit" class="btn-login">Login</button>
            </form>
            <p class="register-text">
                Belum Punya Akun?<a href="register.php">Daftar Disini</a>
            </p>
        </div>
    </div>

    <script>
        // fungsi toggle untuk menampilkan/menyembunyikan password
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const toggleIcon = document.querySelector(".toggle-password");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.textContent = ""; // ikon bisa disesuaikan
            } else {
                passwordInput.type = "password";
                toggleIcon.textContent = "";
            }
        }
    </script>
</body>
</html>
