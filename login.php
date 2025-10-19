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

                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <?php
                if (isset($_GET['error'])) {
                    echo '<p class="error">' . htmlspecialchars($_GET['error']) . '</p>';
                }
                ?>

                <button type="submit" class="btn-login">Login</button>
            </form>

            <p class="register-text">
                Belum Punya Akun? <a href="register.php">Daftar Disini</a>
            </p>
        </div>
    </div>



    <script>
        // fitur sembunyi password
        function togglePassword() {
            const input = document.getElementById("password");
            const icon = document.querySelector(".toggle-password");

            if (input.type === "password") {
                input.type = "text";
                icon.textContent = "👁️‍🗨️";
            } else {
                input.type = "password";
                icon.textContent = "👁️‍🗨️";
            }
        }
    </script>
</body>
</html>
