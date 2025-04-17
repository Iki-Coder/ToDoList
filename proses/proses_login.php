<?php
session_start();
include '../config/koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM pengguna WHERE username = '$username'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);

    if (password_verify($password, $user['password'])) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['peran'] = $user['peran'];

        if ($user['peran'] == 'admin') {
            header("Location: ../views/dashboard_admin.php");
        } elseif ($user['peran'] == 'bos') {
            header("Location: ../views/dashboard_bos.php");
        } elseif ($user['peran'] == 'pegawai') {
            header("Location: ../views/dashboard_pegawai.php");
        } else {
            header("Location: ../index.php");
        }

        exit;
    } else {
        echo "Password salah.";
    }
}
?>
