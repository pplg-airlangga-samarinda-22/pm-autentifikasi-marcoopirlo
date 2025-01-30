<?php
$hostname = "localhost";
$username = "root"; // Pastikan username ini benar dan memiliki izin akses
$password = "";
$database = "pengaduan_masyarakat"; // Pastikan nama database sesuai

// Membuat koneksi
$koneksi = new mysqli($hostname, $username, $password, $database);

// Memeriksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
} else {
    echo "Koneksi berhasil";
}
?>