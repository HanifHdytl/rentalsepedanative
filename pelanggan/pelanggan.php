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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f1f5f9;
            font-family: Arial, sans-serif;
        }
        .table-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 4, 255, 0.1);
        }
        .table thead {
            background-color: #007bff;
            color: white;
        }
        .btn-action {
            margin: 0 3px;
        }
        .btn-warning, .btn-danger {
            font-size: 14px;
            display: inline-flex;
            align-items: center;
        }
        .btn-warning i, .btn-danger i {
            margin-right: 5px;
        }
        .add-button {
            font-size: 16px;
            font-weight: bold;
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
            margin: 0 20px;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .navbar-simple a:hover,
        .navbar-simple a.active {
            background-color: rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body>

<!-- Navbar Sederhana -->
<div class="navbar-simple text-center">
    <a href="../index.php" class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">Home</a>
    <a href="pelanggan.php" class="<?= basename($_SERVER['PHP_SELF']) == 'pelanggan.php' ? 'active' : '' ?>">Pelanggan</a>
    <a href="../sepeda/sepeda.php" class="<?= basename($_SERVER['PHP_SELF']) == 'sepeda.php' ? 'active' : '' ?>">Sepeda</a>
    <a href="../rental/rental.php" class="<?= basename($_SERVER['PHP_SELF']) == 'rental.php' ? 'active' : '' ?>">Rental</a>
</div>

<div class="container mt-4">
    <div class="text-center mb-4">
        <h2 class="fw-bold">Data Pelanggan</h2>
    </div>

    <div class="table-container">
        <table class="table table-bordered table-striped">
            <thead class="text-center">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Telp</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td class="text-center"><?= $row['id_customer']; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['alamat']; ?></td>
                    <td><?= $row['no_telp']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td class="text-center">
                        <a href="edit.php?id=<?= $row['id_customer']; ?>" class="btn btn-warning btn-sm btn-action">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="pelanggan.php?id=<?= $row['id_customer']; ?>&hapus=1" 
                            class="btn btn-danger btn-sm btn-action"
                            onclick="return confirm('Yakin ingin menghapus?');">
                            <i class="fas fa-trash-alt"></i> Hapus
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="text-center mt-4">
        <a href="tambah.php" class="btn btn-primary add-button">
            + Tambah Pelanggan
        </a>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
