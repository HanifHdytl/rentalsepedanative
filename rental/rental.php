<?php

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}

include '../koneksi.php';

// Hapus transaksi jika ada parameter `hapus`
if (isset($_GET['hapus'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM rentals WHERE id_rental = $id");
    header("Location: rental.php");
    exit;
}

$result = $conn->query("SELECT rentals.*, customers.nama AS pelanggan, bicycles.merk AS sepeda
                        FROM rentals
                        JOIN customers ON rentals.id_customer = customers.id_customer
                        JOIN bicycles ON rentals.id_sepeda = bicycles.id_sepeda");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Rental</title>
</head>
<body>

<center>
<!-- Navbar -->
<div>
    <a href="../index.php">Home</a> | 
    <a href="../pelanggan/pelanggan.php">Pelanggan</a> | 
    <a href="../sepeda/sepeda.php">Sepeda</a> |
    <a href="rental.php">Rental</a>
</div>

<hr>

<h2>Data Rental</h2>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Pelanggan</th>
            <th>Sepeda</th>
            <th>Tanggal Sewa</th>
            <th>Tanggal Kembali</th>
            <th>Total Biaya</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
        <tr>
            <td><?= $row['id_rental']; ?></td>
            <td><?= $row['pelanggan']; ?></td>
            <td><?= $row['sepeda']; ?></td>
            <td><?= $row['tanggal_sewa']; ?></td>
            <td><?= $row['tanggal_kembali'] ?? '-'; ?></td>
            <td>Rp <?= number_format($row['total_biaya'], 0, ',', '.'); ?></td>
            <td><?= $row['status']; ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id_rental']; ?>">Edit</a> |
                <a href="rental.php?id=<?= $row['id_rental']; ?>&hapus=1" 
                    onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <br>

    <a href="tambah.php">Tambah Rental</a>

    <hr>

</center>


</body>
</html>
