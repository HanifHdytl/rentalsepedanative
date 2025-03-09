<?php
include '../koneksi.php';

$id_rental = $_GET['id'];
$rental = $conn->query("SELECT * FROM rentals WHERE id_rental = $id_rental")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_customer = $_POST['id_customer'];
    $id_sepeda = $_POST['id_sepeda'];
    $tanggal_sewa = $_POST['tanggal_sewa'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    $status = $_POST['status'];

    $result = $conn->query("SELECT harga_sewa FROM bicycles WHERE id_sepeda = $id_sepeda");
    $data = $result->fetch_assoc();
    $harga_sewa_per_jam = $data['harga_sewa'];

    $sewa = new DateTime($tanggal_sewa);
    $kembali = new DateTime($tanggal_kembali);
    $durasi = ($kembali->getTimestamp() - $sewa->getTimestamp()) / 3600;

    $total_biaya = $durasi * $harga_sewa_per_jam;

    $conn->query("UPDATE rentals SET 
        id_customer = '$id_customer', 
        id_sepeda = '$id_sepeda', 
        tanggal_sewa = '$tanggal_sewa', 
        tanggal_kembali = '$tanggal_kembali', 
        total_biaya = '$total_biaya',
        status = '$status'
        WHERE id_rental = $id_rental");

    header("Location: rental.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Rental</title>
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
    <a href="../sepeda/sepeda.php">Sepeda</a>
    <a href="rental.php" class="active">Rental</a>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-container">
                <h2 class="text-center">Edit Rental</h2>
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Pelanggan</label>
                        <select name="id_customer" class="form-select" required>
                            <?php
                            $customers = $conn->query("SELECT * FROM customers");
                            while ($customer = $customers->fetch_assoc()) {
                                $selected = ($customer['id_customer'] == $rental['id_customer']) ? "selected" : "";
                                echo "<option value='{$customer['id_customer']}' $selected>{$customer['nama']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sepeda</label>
                        <select name="id_sepeda" id="sepeda" class="form-select" required>
                            <?php
                            $bicycles = $conn->query("SELECT * FROM bicycles");
                            while ($bicycle = $bicycles->fetch_assoc()) {
                                $selected = ($bicycle['id_sepeda'] == $rental['id_sepeda']) ? "selected" : "";
                                echo "<option value='{$bicycle['id_sepeda']}' data-harga='{$bicycle['harga_sewa']}' $selected>
                                        {$bicycle['merk']} - {$bicycle['tipe']}
                                      </option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Sewa</label>
                        <input type="datetime-local" name="tanggal_sewa" id="tanggal_sewa"
                               value="<?= date('Y-m-d\TH:i', strtotime($rental['tanggal_sewa'])) ?>" 
                               class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Kembali</label>
                        <input type="datetime-local" name="tanggal_kembali" id="tanggal_kembali"
                               value="<?= date('Y-m-d\TH:i', strtotime($rental['tanggal_kembali'])) ?>" 
                               class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Disewa" <?= ($rental['status'] == 'Disewa') ? 'selected' : '' ?>>Disewa</option>
                            <option value="Dikembalikan" <?= ($rental['status'] == 'Dikembalikan') ? 'selected' : '' ?>>Dikembalikan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Total Biaya</label>
                        <input type="text" id="total_biaya" class="form-control" readonly 
                               value="<?= number_format($rental['total_biaya'], 2) ?>">
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                    <a href="rental.php" class="btn btn-secondary w-100 mt-2">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function hitungTotalBiaya() {
        let sewa = new Date(document.getElementById('tanggal_sewa').value);
        let kembali = new Date(document.getElementById('tanggal_kembali').value);
        let harga = document.getElementById('sepeda').selectedOptions[0].getAttribute('data-harga');

        if (sewa && kembali && harga) {
            let durasi = (kembali - sewa) / (1000 * 60 * 60); 
            if (durasi > 0) {
                document.getElementById('total_biaya').value = (durasi * harga).toFixed(2);
            } else {
                document.getElementById('total_biaya').value = "0.00";
            }
        }
    }

    document.getElementById('tanggal_sewa').addEventListener('change', hitungTotalBiaya);
    document.getElementById('tanggal_kembali').addEventListener('change', hitungTotalBiaya);
    document.getElementById('sepeda').addEventListener('change', hitungTotalBiaya);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
