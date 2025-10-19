<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi</title>
    <link rel="stylesheet" href="assets/css/register.css">
</head>
<body>
    <div class="container">
        <div class="register-card">
            <h2>Registrasi</h2>

            <form action="controller/registerController.php" method="POST">
                <div class="input-group">
                    <input type="text" id="username" name="username" placeholder="Username" required>
                </div>

                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>

                <div class="input-group password-group">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <span class="toggle-password" onclick="togglePassword()">👁️‍🗨️</span>
                </div>

                <div class="input-group">
                    <input type="text" id="no_hp" name="no_hp" placeholder="Nomor Telepon" required>
                </div>

                <div class="input-group">
                    <input type="text" id="alamat" name="alamat" placeholder="Alamat" required>
                </div>

                <?php
                if (isset($_GET['error'])) {
                    echo '<p class="error">' . htmlspecialchars($_GET['error']) . '</p>';
                }
                ?>

                <button type="submit" class="btn-register">Daftar</button>
            </form>

            <p class="login-text">
                Sudah punya akun? <a href="login.php">Login</a>
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
                toggleIcon.textContent = "👁️‍🗨️"; // ubah ikon jadi "tertutup"
            } else {
                passwordInput.type = "password";
                toggleIcon.textContent = "👁️‍🗨️"; // ubah ikon jadi "terbuka"
            }
        }
    </script>
</body>
</html>
