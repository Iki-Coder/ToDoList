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
$jumlah_tugas = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Pegawai</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">

        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2>Halo, Pegawai <span style="color: #03dac6"><?= $_SESSION['username']; ?></span></h2>
            <a class="btn" href="../logout.php">Logout</a>
        </div>

        <hr style="margin: 20px 0; border-color: #333;">

        <?php if ($jumlah_tugas > 0): ?>
            <h3>Daftar Tugas Kamu</h3>

            <table>
                <thead>
                    <tr>
                        <th>Tugas</th>
                        <th>Waktu Diberikan</th>
                        <th>Batas Waktu</th>
                        <th>Status</th>
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
                        <td>
                            <?php if ($data['status'] == 'belum dikerjakan'): ?>
                                <a class="btn btn-small" href="../proses/proses_update_status.php?id=<?= $data['id']; ?>&status=dikerjakan">Kerjakan</a>
                                <a class="btn btn-small" style="background-color: #cf6679; color: #fff;" href="../proses/proses_update_status.php?id=<?= $data['id']; ?>&status=ditolak">Tolak</a>
                            <?php elseif ($data['status'] == 'dikerjakan'): ?>
                                <a class="btn btn-small" href="../proses/proses_update_status.php?id=<?= $data['id']; ?>&status=selesai">Selesai</a>
                            <?php else: ?>
                                <em>beres Boss</em>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <h1 style="text-align: center; margin-top: 50px;">Gaada tugas buat lu.</h1>
        <?php endif; ?>

    </div>
</body>
</html>
