<?php
session_start();
require "../koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $nik = $_GET['nik'];
    $sql = "SELECT * FROM masyarakat where nik=?";
    $row = $koneksi->execute_query($sql, [$nik])->fetch_assoc();
    $nama = $row['nama'];
    $username = $row['username'];
    $telepon = $row['telp'];
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nik = $_GET['nik'];
    $nama = $_POST['nama'];
    $telepon = $_POST['telepon'];
    $sql = "UPDATE masyarakat SET nama=?, telp=? WHERE nik=?";
    $row = $koneksi->execute_query($sql, [$nama, $telepon, $nik]);
    if ($row) {
        header("location: masyarakat.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Masyarakat</title>
</head>
<body>
    <h1>Edit Data Masyarakat</h1>
    <form action="" method="post">
        <div class="form-item">
            <label for="nik">NIK</label>
            <input type="text" name="nik" id="nik" value="<?php echo $nik; ?>" disabled>
        </div>
        <div class="form-item">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" value="<?php echo $nama; ?>">
        </div>
        <div class="form-item">
            <label for="telepon">Telepon</label>
            <input type="tel" name="telepon" id="telepon" value="<?php echo $telepon; ?>">
        </div>
        <div class="form-item">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?php echo $username; ?>" disabled>
        </div>
        <button type="submit">Edit</button>
        <a href="masyarakat.php">Batal</a>
    </form>
</body>
</html>