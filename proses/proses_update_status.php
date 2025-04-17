<?php
session_start();
if ($_SESSION['peran'] != 'pegawai') {
    header("Location: ../index.php");
    exit;
}
include '../config/koneksi.php';

$id_tugas = $_GET['id'];
$status = $_GET['status'];

$query = "UPDATE tugas SET status='$status' WHERE id=$id_tugas";
mysqli_query($koneksi, $query);

header("Location: ../views/dashboard_pegawai.php");
exit;
