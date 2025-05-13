<?php
// config.php
$servername = "localhost";
$username = "root"; // Username default di XAMPP
$password = "";     // Password default di XAMPP (kosong)
$dbname = "phanes"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
