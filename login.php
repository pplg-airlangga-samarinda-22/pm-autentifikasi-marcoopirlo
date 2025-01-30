<?php
require "koneksi.php"; // Pastikan file koneksi.php berisi koneksi mysqli

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Periksa apakah semua input tersedia untuk menghindari error undefined array key
    $nik = $_POST['nik'] ?? null;
    $username = $_POST['username'] ?? null;
    $password = $_POST['password'] ?? null;

    if ($nik && $username && $password) {
        // Gunakan prepared statements untuk keamanan
        $sql = "SELECT * FROM masyarakat WHERE nik = ? AND username = ? AND password = ?";
        $stmt = $koneksi->prepare($sql);

        // Hash password (gunakan md5 sesuai database Anda)
        $hashed_password = md5($password);

        // Bind parameter
        $stmt->bind_param("sss", $nik, $username, $hashed_password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // Login berhasil
            session_start();
            $_SESSION['nik'] = $nik;
            header("Location: index.php");
            exit;
        } else {
            echo "<script>alert('Gagal Login! NIK, Username, atau Password salah.')</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Mohon lengkapi semua data!')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
</head>
<body>
    <form action="" method="post" class="form-login">
        <p>Silahkan Login</p>

        <!-- Input NIK -->
        <div class="form-item">
            <label for="nik">NIK</label>
            <input type="text" name="nik" id="nik" required>
        </div>

        <!-- Input Username -->
        <div class="form-item">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
        </div>

        <!-- Input Password -->
        <div class="form-item">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>

        <!-- Tombol Submit -->
        <button type="submit">Login</button>

        <!-- Link ke Register -->
        <a href="register.php">Register</a>
    </form>
</body>
</html>
