<?php
session_start();
if ($_SESSION['peran'] != 'pegawai') {
    header("Location: ../index.php");
    exit;
}
include '../config/koneksi.php';

$pegawai_id = $_SESSION['id'];
$query = "SELECT * FROM tugas WHERE ditugaskan_kepada=$pegawai_id";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Pegawai</title>
</head>
<body>
<p style="float: right;">
        <a href="../logout.php">Logout</a>
    </p>

    <p>Selamat datang</p>
    <h2>Pegawai <?= $_SESSION['username']; ?></h2>

    <h3>Tugas:</h3>
    <table border="1">
    <tr>
        <th>Tugas</th>
        <th>Waktu Diberikan</th>
        <th>Batas Waktu</th>
        <th>Status</th>
        <th>ToDo</th>
    </tr>
    <?php while ($data = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $data['tugas']; ?></td>
            <td><?= $data['waktu_diberikan']; ?></td>
            <td><?= $data['batas_waktu']; ?></td>
            <td><?= $data['status']; ?></td>
            <td>
                <?php if ($data['status'] == 'belum dikerjakan'): ?>
                    <a href="../proses/proses_update_status.php?id=<?= $data['id']; ?>&status=dikerjakan">Kerjakan</a>|
                    <a href="../proses/proses_update_status.php?id=<?= $data['id']; ?>&status=ditolak">Tolak</a>
                <?php elseif ($data['status'] == 'dikerjakan'): ?>
                    <a href="../proses/proses_update_status.php?id=<?= $data['id']; ?>&status=selesai">Selesai</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
