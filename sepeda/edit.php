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
        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 4, 255, 0.1);
            margin-top: 30px;
        }
        h2 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #000000;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar-simple text-center">
    <a href="../index.php">Home</a>
    <a href="../pelanggan/pelanggan.php">Pelanggan</a>
    <a href="sepeda.php" class="active">Sepeda</a>
    <a href="../rental/rental.php">Rental</a>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-container">
                <h2 class="text-center">Edit Sepeda</h2>
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Merk</label>
                        <input type="text" name="merk" class="form-control" value="<?= $data['merk']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tipe</label>
                        <input type="text" name="tipe" class="form-control" value="<?= $data['tipe']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Warna</label>
                        <input type="text" name="warna" class="form-control" value="<?= $data['warna']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Harga Sewa</label>
                        <input type="number" name="harga_sewa" class="form-control" value="<?= $data['harga_sewa']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="Tersedia" <?= ($data['status'] == 'Tersedia') ? 'selected' : ''; ?>>Tersedia</option>
                            <option value="Disewa" <?= ($data['status'] == 'Disewa') ? 'selected' : ''; ?>>Disewa</option>
                            <option value="Perbaikan" <?= ($data['status'] == 'Perbaikan') ? 'selected' : ''; ?>>Perbaikan</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Update</button>
                    <a href="sepeda.php" class="btn btn-secondary w-100 mt-2">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
