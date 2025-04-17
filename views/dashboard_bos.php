<?php
session_start();
include '../config/koneksi.php';

if ($_SESSION['peran'] != 'bos') {
    header("Location: ../index.php");
    exit;
}

$query = "SELECT tugas.*, pengguna.username FROM tugas 
          JOIN pengguna ON tugas.ditugaskan_kepada = pengguna.id";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Bos</title>
    
</head>
<body>
    <p style="float: right;">
        <a href="../logout.php">Logout</a>
    </p>

    <p>Selamat datang</p>
    <h2>Bos <?= $_SESSION['username']; ?></h2>

    <h3>Tugas:</h3>

    <table border="1">
        <tr>
            <th>Tugas</th>
            <th>Waktu Diberikan</th>
            <th>Batas Waktu</th>
            <th>Status</th>
            <th>Diberikan ke</th>
            <th>ToDo</th>
        </tr>
        <?php while ($data = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $data['tugas']; ?></td>
            <td><?= $data['waktu_diberikan']; ?></td>
            <td><?= $data['batas_waktu']; ?></td>
            <td><?= $data['status']; ?></td>
            <td><?= $data['username']; ?></td>
            <td>
                <?php if ($data['status'] == 'belum dikerjakan'): ?>
                    <a href="edit_tugas.php?id=<?= $data['id']; ?>">Edit</a> |
                <?php endif; ?>
                <a href="../proses/proses_hapus_tugas.php?id=<?= $data['id']; ?>">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <br>
    <a href="tambah_tugas.php">Tambah Tugas</a><br><br>
</body>
</html>
