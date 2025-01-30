<?php
require "../koneksi.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM petugas WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $sql);

    if (mysqli_num_rows($result) == 1) {

        session_start();
        $user = mysqli_fetch_assoc($result);

        $_SESSION['level'] = $user['level'];
        $_SESSION['username'] = $username;
        $_SESSION['id_petugas'] = $user['id_petugas'];

        if ($_SESSION['level'] == 'admin') {
            header("location: index.php");
            exit();
        } elseif ($_SESSION['level'] == 'petugas') {
            header("location: index.php");
            exit();
        }
    } else {
        echo "<script>alert('Gagal Login! Username atau Password salah.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post" class="form-login">
        <p>Silahkan Login</p>
        <div class="form-item">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div class="form-item">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</body>

</html>