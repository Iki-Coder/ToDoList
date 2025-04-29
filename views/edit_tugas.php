<?php
session_start();
include '../config/koneksi.php';

if ($_SESSION['peran'] != 'admin' && $_SESSION['peran'] != 'bos') {
    header("Location: ../index.php");
    exit;
}

$id_tugas = $_GET['id'];
$query = "SELECT * FROM tugas WHERE id=$id_tugas";
$result = mysqli_query($koneksi, $query);
$data = mysqli_fetch_assoc($result);

$dashboard = '';
if ($_SESSION['peran'] == 'admin') {
    $dashboard = 'dashboard_admin.php';
} elseif ($_SESSION['peran'] == 'manager') {
    $dashboard = 'dashboard_manager.php';
} else {
    $dashboard = 'dashboard_bos.php';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Tugas</title>
</head>
<body>
    <h2>Edit Tugas</h2>
    <a href="<?= $dashboard ?>">Kembali ke Dashboard</a><br><br>

    <form action="../proses/proses_edit_tugas.php" method="POST">
        <input type="hidden" name="id" value="<?= $data['id']; ?>">

        <label>Judul Tugas:</label><br>
        <input type="text" name="tugas" value="<?= $data['tugas']; ?>" required><br><br>

        <button type="submit">Ganti Tugas</button>
    </form>
</body>
</html>
