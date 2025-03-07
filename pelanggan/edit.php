<?php
include '../koneksi.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM customers WHERE id_customer = $id");
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    $email = $_POST['email'];

    $conn->query("UPDATE customers SET nama='$nama', alamat='$alamat', no_telp='$no_telp', email='$email' 
                WHERE id_customer=$id");
    header("Location: pelanggan.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pelanggan</title>
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

        <h2>Edit Pelanggan</h2>
        <form method="post">
            <label>Nama: 
                <input type="text" name="nama" value="<?= $row['nama']; ?>" required>
            </label><br><br>
            
            <label>Alamat: 
                <textarea name="alamat" required><?= $row['alamat']; ?></textarea>
            </label><br><br>
            
            <label>No Telp: 
                <input type="text" name="no_telp" value="<?= $row['no_telp']; ?>" required>
            </label><br><br>
            
            <label>Email: 
                <input type="email" name="email" value="<?= $row['email']; ?>" required>
            </label><br><br>
            
            <input type="submit" value="Update">
        </form>

        <hr>
        
        <a href="pelanggan.php">Kembali</a>
    </center>
</body>
</html>
