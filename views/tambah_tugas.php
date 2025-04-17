<?php
session_start();
include '../config/koneksi.php';

if ($_SESSION['peran'] != 'admin' && $_SESSION['peran'] != 'bos') {
    header("Location: ../index.php");
    exit;
}


$query = "SELECT * FROM pengguna WHERE peran='pegawai'";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Tugas</title>
</head>
<body>
    <h2>Tambah Tugas</h2>
    <a href="dashboard_bos.php">Kembali ke Dashboard</a><br><br>

    <form action="../proses/proses_tambah_tugas.php" method="POST">
    <label>Tugas:</label><br>
    <input type="text" name="tugas" required><br><br>

    <label>Waktu Diberikan:</label><br>
    <input type="date" name="waktu_diberikan" required><br><br>

    <label>(Deadline):</label><br>
    <input type="date" name="batas_waktu" required><br><br>

    <label>Ditugaskan ke:</label><br>
    <select name="ditugaskan_kepada" required>
        <?php while ($data = mysqli_fetch_assoc($result)): ?>
            <option value="<?= $data['id']; ?>"><?= $data['username']; ?></option>
        <?php endwhile; ?>
    </select><br><br>

    <button type="submit">Tambah Tugas</button>
</form>

</body>
</html>
