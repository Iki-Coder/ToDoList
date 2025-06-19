<?php
session_start();
include '../config/koneksi.php';

if ($_SESSION['peran'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

$query = "SELECT tugas.*, pengguna.username FROM tugas 
          JOIN pengguna ON tugas.ditugaskan_kepada = pengguna.id";
$result = mysqli_query($koneksi, $query);
$jumlah_tugas = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container">

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2>Halo, Admin <span style="color: #03dac6"><?= $_SESSION['username']; ?></span></h2>
        <a class="btn" href="../logout.php">Logout</a>
    </div>

    <hr style="margin: 20px 0; border-color: #333;">

    <?php if ($jumlah_tugas > 0): ?>
        <h3>Daftar Tugas</h3>

        <table>
            <thead>
                <tr>
                    <th>Tugas</th>
                    <th>Waktu Diberikan</th>
                    <th>Batas Waktu</th>
                    <th>Status</th>
                    <th>Diberikan ke</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($data = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $data['tugas']; ?></td>
                    <td><?= $data['waktu_diberikan']; ?></td>
                    <td><?= $data['batas_waktu']; ?></td>
                    <td><?= $data['status']; ?></td>
                    <td><?= $data['username']; ?></td>
                    <td>
                        <?php if ($data['status'] == 'belum dikerjakan'): ?>
                            <a class="btn btn-small" href="edit_tugas.php?id=<?= $data['id']; ?>">Edit</a>
                        <?php endif; ?>
                        <a class="btn btn-small" style="background-color: #cf6679; color: #fff;"
                           href="../proses/proses_hapus_tugas.php?id=<?= $data['id']; ?>"
                           onclick="return confirm('Yakin dihapus NIHH???')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <h1 style="text-align: center; margin-top: 50px;">Tidak ada penugasan.</h1>
    <?php endif; ?>

    <br>
    <a class="btn" href="tambah_tugas.php">+ Tambah Tugas</a>

</div>
</body>
</html>
