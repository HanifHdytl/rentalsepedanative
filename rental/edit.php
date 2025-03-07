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

    // Ambil harga sewa per jam dari database
    $result = $conn->query("SELECT harga_sewa FROM bicycles WHERE id_sepeda = $id_sepeda");
    $data = $result->fetch_assoc();
    $harga_sewa_per_jam = $data['harga_sewa'];

    // Hitung durasi dalam jam
    $sewa = new DateTime($tanggal_sewa);
    $kembali = new DateTime($tanggal_kembali);
    $durasi = $sewa->diff($kembali)->h;

    // Hitung total biaya
    $total_biaya = $durasi * $harga_sewa_per_jam;

    // Update data di database
    $conn->query("UPDATE rentals SET 
        id_customer = '$id_customer', 
        id_sepeda = '$id_sepeda', 
        tanggal_sewa = '$tanggal_sewa', 
        tanggal_kembali = '$tanggal_kembali', 
        total_biaya = '$total_biaya',
        status = '$status'
        WHERE id_rental = $id_rental");

    header("Location: rental.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Transaksi Rental</title>
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

        <h2>Edit Rental</h2>

        <form method="post">
            <label>Pelanggan:</label>
            <select name="id_customer">
                <?php
                $customers = $conn->query("SELECT * FROM customers");
                while ($customer = $customers->fetch_assoc()) {
                    $selected = ($customer['id_customer'] == $rental['id_customer']) ? "selected" : "";
                    echo "<option value='{$customer['id_customer']}' $selected>{$customer['nama']}</option>";
                }
                ?>
            </select><br><br>

            <label>Sepeda:</label>
            <select name="id_sepeda" id="sepeda">
                <?php
                $bicycles = $conn->query("SELECT * FROM bicycles");
                while ($bicycle = $bicycles->fetch_assoc()) {
                    $selected = ($bicycle['id_sepeda'] == $rental['id_sepeda']) ? "selected" : "";
                    echo "<option value='{$bicycle['id_sepeda']}' data-harga='{$bicycle['harga_sewa']}' $selected>
                            {$bicycle['merk']} - {$bicycle['tipe']}
                        </option>";
                }
                ?>
            </select><br><br>

            <label>Tanggal Sewa:</label>
            <input type="datetime-local" name="tanggal_sewa" id="tanggal_sewa" 
                    value="<?= $rental['tanggal_sewa'] ?>" required><br><br>

            <label>Tanggal Kembali:</label>
            <input type="datetime-local" name="tanggal_kembali" id="tanggal_kembali" 
                    value="<?= $rental['tanggal_kembali'] ?>" required><br><br>

            <label>Status:</label>
            <select name="status">
                <option value="Disewa" <?= ($rental['status'] == "Disewa") ? "selected" : "" ?>>Disewa</option>
                <option value="Dikembalikan" <?= ($rental['status'] == "Dikembalikan") ? "selected" : "" ?>>Dikembalikan</option>
            </select><br><br>

            <label>Total Biaya:</label>
            <input type="text" name="total_biaya" id="total_biaya" 
                    value="<?= $rental['total_biaya'] ?>" readonly><br><br>

            <button type="submit">Simpan Perubahan</button>
        </form>

        <script>
            function hitungTotalBiaya() {
                let sewa = new Date(document.getElementById('tanggal_sewa').value);
                let kembali = new Date(document.getElementById('tanggal_kembali').value);
                let harga = document.getElementById('sepeda').selectedOptions[0].getAttribute('data-harga');

                if (sewa && kembali && harga) {
                    let durasi = (kembali - sewa) / (1000 * 60 * 60); // Konversi milidetik ke jam
                    if (durasi > 0) {
                        document.getElementById('total_biaya').value = (durasi * harga).toFixed(2);
                    } else {
                        document.getElementById('total_biaya').value = "0";
                    }
                }
            }

            document.getElementById('tanggal_kembali').addEventListener('change', hitungTotalBiaya);
            document.getElementById('tanggal_sewa').addEventListener('change', hitungTotalBiaya);
            document.getElementById('sepeda').addEventListener('change', hitungTotalBiaya);
        </script>

        <hr>

        <a href="rental.php">kembali</a>
    </center>
</body>
</html>
