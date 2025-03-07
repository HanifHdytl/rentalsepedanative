<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $merk = $_POST['merk'];
    $tipe = $_POST['tipe'];
    $warna = $_POST['warna'];
    $harga_sewa = $_POST['harga_sewa'];
    $status = $_POST['status'];

    $conn->query("INSERT INTO bicycles (merk, tipe, warna, harga_sewa, status) 
                VALUES ('$merk', '$tipe', '$warna', '$harga_sewa', '$status')");
    header("Location: sepeda.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Sepeda</title>
</head>
<body>

<center>
<!-- Navbar -->
<div>
    <a href="../index.php">Home</a> | 
    <a href="../pelanggan/pelanggan.php">Pelanggan</a> | 
    <a href="sepeda.php">Sepeda</a> |
    <a href="../rental/rental.php">Rental</a>
</div>

<hr>

<h2>Tambah Sepeda</h2>
    <form method="post">
        <label>Merk:</label>
        <input type="text" name="merk" required><br><br>

        <label>Tipe:</label>
        <input type="text" name="tipe" required><br><br>

        <label>Warna:</label>
        <input type="text" name="warna" required><br><br>

        <label>Harga Sewa:</label>
        <input type="number" name="harga_sewa" step="0.01" required><br><br>

        <label>Status:</label>
        <select name="status">
            <option value="Tersedia">Tersedia</option>
            <option value="Disewa">Disewa</option>
        </select><br><br>

        <button type="submit">Simpan</button>
    </form>

<hr>

<a href="sepeda.php">kembali</a>
</center>

</body>
</html>
