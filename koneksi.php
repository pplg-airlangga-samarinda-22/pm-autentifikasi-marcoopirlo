<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "masyarakat";

// Membuat koneksi
$koneksi = new mysqli($hostname, $username, $password, $database);

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

echo "Koneksi berhasil!";
?>
