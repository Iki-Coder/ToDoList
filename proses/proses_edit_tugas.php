<?php
session_start();
include '../config/koneksi.php';

if ($_SESSION['peran'] != 'admin' && $_SESSION['peran'] != 'bos') {
    header("Location: ../index.php");
    exit;
}

$id_tugas = $_POST['id'];
$tugas = $_POST['tugas'];

$query = "UPDATE tugas SET tugas='$tugas' WHERE id=$id_tugas";
mysqli_query($koneksi, $query);

if ($_SESSION['peran'] == 'admin') {
    header("Location: ../views/dashboard_admin.php");
} else {
    header("Location: ../views/dashboard_bos.php");
}
exit;
