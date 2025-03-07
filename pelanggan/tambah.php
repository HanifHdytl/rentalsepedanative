<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    $email = $_POST['email'];

    $conn->query("INSERT INTO customers (nama, alamat, no_telp, email, created_at) 
                VALUES ('$nama', '$alamat', '$no_telp', '$email', NOW())");
    header("Location: pelanggan.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pelanggan</title>
</head>
<body>
    <center>
        <!-- Navbar -->
        <div>
            <a href="../index.php">Home</a> | 
            <a href="pelanggan.php">Pelanggan</a> | 
            <a href="../sepeda/sepeda.php">Sepeda</a> |
            <a href="../rental/rental.php">Rental</a>
        </div>

        <hr>

        <h2>Tambah Pelanggan</h2>
        <form method="post">
            <label>Nama: 
                <input type="text" name="nama" required>
            </label><br><br>
            
            <label>Alamat: 
                <textarea name="alamat" required></textarea>
            </label><br><br>
            
            <label>No Telp: 
                <input type="text" name="no_telp" required>
            </label><br><br>
            
            <label>Email: 
                <input type="email" name="email" required>
            </label><br><br>
            
            <input type="submit" value="Simpan">
        </form>

        <hr>
        
        <a href="pelanggan.php">Kembali</a>
    </center>
</body>
</html>
