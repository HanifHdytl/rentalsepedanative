<?php
include '../koneksi.php';

// Hapus sepeda jika ada parameter `hapus`
if (isset($_GET['hapus'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM bicycles WHERE id_sepeda = $id");
    header("Location: sepeda.php");
    exit;
}

$result = $conn->query("SELECT * FROM bicycles");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Sepeda</title>
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

<h2>Data Sepeda</h2>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Merk</th>
        <th>Tipe</th>
        <th>Warna</th>
        <th>Harga Sewa</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) : ?>
    <tr>
        <td><?= $row['id_sepeda']; ?></td>
        <td><?= $row['merk']; ?></td>
        <td><?= $row['tipe']; ?></td>
        <td><?= $row['warna']; ?></td>
        <td><?= $row['harga_sewa']; ?></td>
        <td><?= $row['status']; ?></td>
        <td>
            <a href="edit.php?id=<?= $row['id_sepeda']; ?>">Edit</a> | 
            <a href="sepeda.php?id=<?= $row['id_sepeda']; ?>&hapus=1" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<br>

<a href="tambah.php">Tambah Sepeda</a>

<hr>

</center>

</body>
</html>