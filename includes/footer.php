<?php
// Mengambil tahun sekarang untuk ditampilkan di footer
$tahunSekarang = date("Y"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/footer.css">
</head>
<body>
    <footer class="main-footer">
  <div class="footer-content">
    <p>&copy; <?php echo $tahunSekarang; ?> <a href="https://github.com/draprotez">draprotez</a>. All Rights Reserved.</p>
    </div>
</footer>
</body>
</html>


