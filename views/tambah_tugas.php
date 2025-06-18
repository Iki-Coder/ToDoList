<?php
session_start();
include '../config/koneksi.php';

if ($_SESSION['peran'] != 'admin' && $_SESSION['peran'] != 'bos') {
    header("Location: ../index.php");
    exit;
}

$query = "SELECT * FROM pengguna WHERE peran='pegawai'";
$result = mysqli_query($koneksi, $query);

$dashboard = ($_SESSION['peran'] == 'admin') ? 'dashboard_admin.php' : 'dashboard_bos.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Tugas</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2>Tambah Tugas</h2>
            <a class="btn" href="<?= $dashboard ?>">Kembali ke Dashboard</a>
        </div>

        <hr style="margin: 20px 0; border-color: #333;">

        <form action="../proses/proses_tambah_tugas.php" method="POST">
            <label for="tugas">Tugas:</label><br>
            <input type="text" id="tugas" name="tugas" required><br><br>

            <label for="waktu_diberikan">Waktu Diberikan:</label><br>
            <input type="date" id="waktu_diberikan" name="waktu_diberikan" required><br><br>

            <label for="batas_waktu">Batas Waktu (Deadline):</label><br>
            <input type="date" id="batas_waktu" name="batas_waktu" required><br><br>

            <label for="ditugaskan_kepada">Ditugaskan ke:</label><br>
            <select id="ditugaskan_kepada" name="ditugaskan_kepada" required>
                <?php while ($data = mysqli_fetch_assoc($result)): ?>
                    <option value="<?= $data['id']; ?>"><?= $data['username']; ?></option>
                <?php endwhile; ?>
            </select><br><br>

            <button class="btn" type="submit">Tambah Tugas</button>
        </form>
    </div>
</body>
</html>
