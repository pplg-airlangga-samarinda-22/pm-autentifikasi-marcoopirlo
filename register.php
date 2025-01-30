<?php
require "koneksi.php"; // Pastikan file ini mendefinisikan variabel $koneksi sebagai koneksi mysqli

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $nik = $_POST['nik'];

    // Periksa apakah NIK sudah digunakan
    $sql = "SELECT * FROM masyarakat WHERE nik = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("s", $nik); // Bind parameter untuk keamanan
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        echo "<script>alert('NIK sudah digunakan!')</script>";
    } else {
        $nama = $_POST['nama'];
        $telepon = $_POST['telepon'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Gunakan password_hash untuk keamanan

        // Masukkan data pengguna baru ke database
        $sql = "INSERT INTO masyarakat (nik, nama, telp, username, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("sssss", $nik, $nama, $telepon, $username, $password);

        if ($stmt->execute()) {
            echo "<script>alert('Pendaftaran berhasil!');</script>";
            echo "<script>window.location.href = 'login.php';</script>"; // Redirect setelah alert
        } else {
            echo "<script>alert('Pendaftaran gagal!');</script>";
        }
    }

    $stmt->close(); // Tutup statement
    $koneksi->close(); // Tutup koneksi
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registrasi</title>
</head>
<body>
    <h1>Registrasi Pengguna Baru</h1>
    <form action="" method="post">
        <div class="form-item">
            <label for="nik">NIK</label>
            <input type="text" name="nik" id="nik" required>
        </div>
        <div class="form-item">
            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" required>
        </div>
        <div class="form-item">
            <label for="telepon">Telepon</label>
            <input type="tel" name="telepon" id="telepon" required>
        </div>
        <div class="form-item">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div class="form-item">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <button type="submit">Register</button>
    </form>
    <a href="login.php">Batal</a>
</body>
</html>
