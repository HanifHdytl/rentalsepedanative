<?php
$host = "localhost";
$user = "root"; // Sesuaikan dengan user database kamu
$pass = ""; // Jika ada password, isi di sini
$db   = "rentalsepeda"; //sesuaikan nama databasenya

$conn = new mysqli( $host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
