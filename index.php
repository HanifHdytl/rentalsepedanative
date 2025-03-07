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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f1f5f9;
            font-family: Arial, sans-serif;
        }
        .navbar-simple {
            background-color: #007bff;
            padding: 10px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .navbar-simple a {
            color: white;
            font-weight: 500;
            text-decoration: none;
            margin: 0 15px;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .navbar-simple a:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }
        .welcome-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            text-align: center;
        }
        h2 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 25px;
            color: #000000;
        }
        .btn-option {
            display: block;
            width: 100%;
            margin-bottom: 15px;
            padding: 12px;
            font-size: 16px;
            font-weight: 500;
        }
        .btn-logout {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
        }
        .btn-logout:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar-simple text-center">
    <a href="#">Home</a>
    <a href="pelanggan/pelanggan.php">Pelanggan</a>
    <a href="sepeda/sepeda.php">Sepeda</a>
    <a href="rental/rental.php">Rental</a>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="welcome-container">
                <h2>Selamat Datang di Sistem Rental Sepeda</h2>
                <a href="pelanggan/pelanggan.php" class="btn btn-primary btn-option">Kelola Data Pelanggan</a>
                <a href="sepeda/sepeda.php" class="btn btn-primary btn-option">Kelola Data Sepeda</a>
                <a href="rental/rental.php" class="btn btn-primary btn-option">Kelola Data Rental</a>
                <hr>
                <a href="logout.php" class="btn btn-logout btn-option" onclick="return confirm('Yakin ingin logout?');">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
