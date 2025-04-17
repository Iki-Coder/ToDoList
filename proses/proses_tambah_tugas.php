<?php
session_start();
include '../config/koneksi.php';

if ($_SESSION['peran'] != 'admin' && $_SESSION['peran'] != 'bos') {
    header("Location: ../index.php");
    exit;
}

$tugas = $_POST['tugas'];
$waktu_diberikan = $_POST['waktu_diberikan'];
$batas_waktu = $_POST['batas_waktu'];
$ditugaskan_kepada = $_POST['ditugaskan_kepada'];

$query = "INSERT INTO tugas (tugas, status, waktu_diberikan, batas_waktu, ditugaskan_kepada)
          VALUES ('$tugas', 'belum dikerjakan', '$waktu_diberikan', '$batas_waktu', '$ditugaskan_kepada')";

mysqli_query($koneksi, $query);

if ($_SESSION['peran'] == 'admin') {
    header("Location: ../views/dashboard_admin.php");
} else {
    header("Location: ../views/dashboard_bos.php");
}
exit;
