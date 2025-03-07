<?php
include '../koneksi.php';

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM bicycles WHERE id_sepeda = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $merk = $_POST['merk'];
    $tipe = $_POST['tipe'];
    $warna = $_POST['warna'];
    $harga_sewa = $_POST['harga_sewa'];
    $status = $_POST['status'];

    $conn->query("UPDATE bicycles SET 
                    merk = '$merk',
                    tipe = '$tipe',
                    warna = '$warna',
                    harga_sewa = '$harga_sewa',
                    status = '$status'
                    WHERE id_sepeda = $id");

    header("Location: sepeda.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Sepeda</title>
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

        <h2>Edit Sepeda</h2>

        <form method="post">
            <label>Merk:</label>
            <input type="text" name="merk" value="<?= $data['merk']; ?>" required><br><br>

            <label>Tipe:</label>
            <input type="text" name="tipe" value="<?= $data['tipe']; ?>" required><br><br>

            <label>Warna:</label>
            <input type="text" name="warna" value="<?= $data['warna']; ?>" required><br><br>

            <label>Harga Sewa:</label>
            <input type="number" name="harga_sewa" value="<?= $data['harga_sewa']; ?>" required><br><br>

            <label>Status:</label>
            <select name="status">
                <option value="Tersedia" <?= ($data['status'] == 'Tersedia') ? 'selected' : ''; ?>>Tersedia</option>
                <option value="Disewa" <?= ($data['status'] == 'Disewa') ? 'selected' : ''; ?>>Disewa</option>
                <option value="Perbaikan" <?= ($data['status'] == 'Perbaikan') ? 'selected' : ''; ?>>Perbaikan</option>
            </select><br><br>

            <button type="submit">Update</button>
        </form>

        <hr>

        <a href="sepeda.php">Kembali</a>
    </center>
</body>
</html>
