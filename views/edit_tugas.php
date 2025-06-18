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
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2>Edit Tugas</h2>
            <a class="btn" href="<?= $dashboard ?>">Kembali ke Dashboard</a>
        </div>

        <hr style="margin: 20px 0; border-color: #333;">

        <form action="../proses/proses_edit_tugas.php" method="POST">
            <input type="hidden" name="id" value="<?= $data['id']; ?>">

            <label for="tugas">Judul Tugas:</label><br>
            <input type="text" id="tugas" name="tugas" value="<?= htmlspecialchars($data['tugas']); ?>" required><br><br>

            <button class="btn" type="submit">Ganti Tugas</button>
        </form>
    </div>
</body>
</html>
