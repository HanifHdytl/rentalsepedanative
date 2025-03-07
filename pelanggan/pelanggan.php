<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}

include '../koneksi.php';

if (isset($_GET['hapus'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM customers WHERE id_customer = $id");
    header("Location: pelanggan.php");
    exit;
}

$result = $conn->query("SELECT * FROM customers");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>
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

        <h2>Data Pelanggan</h2>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No Telp</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?= $row['id_customer']; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['alamat']; ?></td>
                <td><?= $row['no_telp']; ?></td>
                <td><?= $row['email']; ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id_customer']; ?>">Edit</a> | 
                    <a href="pelanggan.php?id=<?= $row['id_customer']; ?>&hapus=1" 
                        onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>

        <br>

        <a href="tambah.php">Tambah Pelanggan</a>

        <hr>
    </center>
</body>
</html>