<?php
    session_start();
    require "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Aduan</title>
</head>
<body>
    <h1>Tambah Aduan</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-item">
            <label for="laporan">Isi Laporan</label>
            <textarea name="laporan" id="laporan"></textarea>
        </div>
        <div class="form-item">
            <label for="foto">Foto Pendukung</label>
            <input type="file" name="foto" id="foto">
        </div>
        <button type="submit">Kirim Laporan</button>
    </form>
    
</body>
</html>