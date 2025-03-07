<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Menu Utama - Rental Sepeda</title>
</head>
<body>
    <center>
        <h2>Selamat Datang di Sistem Rental Sepeda</h2>

        <a href="pelanggan/pelanggan.php" class="btn">Kelola Data Pelanggan</a><br><br>
        <a href="sepeda/sepeda.php" class="btn">Kelola Data Sepeda</a><br><br>
        <a href="rental/rental.php" class="btn">Kelola Data Rental</a><br><br>
        
        <hr><br>
        
        <a href="logout.php" class="btn logout" onclick="return confirm('Yakin ingin logout?');">Logout</a>
    </center>
</body>
</html>
