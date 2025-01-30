<?php
session_start();
require "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Laporan</title>
</head>
<body>
    <a href="javascript:window.print();">Cetak</a>
    <h1>Laporan</h1>
    <table>
        <thead>
            <th>No</th>
            <th>Tanggal</th>
            <th>NIK Pelapor</th>
            <th>Isi Laporan</th>
            <th>Status</th>
        </thead>
        <tbody>

  <?php

  $no = 0;

  $sql = "SELECT * FROM pengaduan"; // Tambahkan * untuk memilih semua kolom

  $rows = $koneksi->execute_query($sql)->fetch_all(MYSQLI_ASSOC);

  foreach ($rows as $row) {

  ?>

  <tr>
    <td><?= ++$no ?></td>

    <td><?= $row['tgl_pengaduan'] ?></td>

    <td><?= $row['nik'] ?></td>

    <td><?= $row['isi_laporan'] ?></td>

    <td><?= ($row['status'] == 0) ? 'menunggu' : (($row['status'] == 'proses') ? 'diproses' : 'selesai') ?></td>

  </tr>

  <?php } ?>

</tbody>
    </table>
</body>
</html>