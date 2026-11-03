<?php
require_once 'koneksi.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$stmt = $pdo->prepare("SELECT * FROM pelanggaran_siswa WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    header("Location: index.php");
    exit;
}

$pesan = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_siswa       = trim($_POST['nama_siswa']);
    $kelas            = trim($_POST['kelas']);
    $jenis_pelanggaran= trim($_POST['jenis_pelanggaran']);
    $poin             = intval($_POST['poin']);
    $tanggal          = $_POST['tanggal'];

    if (!empty($nama_siswa) && !empty($kelas) && !empty($jenis_pelanggaran) && $poin > 0 && !empty($tanggal)) {
        $stmt = $pdo->prepare("UPDATE pelanggaran_siswa SET nama_siswa = ?, kelas = ?, jenis_pelanggaran = ?, poin = ?, tanggal = ? WHERE id = ?");
        $stmt->execute([$nama_siswa, $kelas, $jenis_pelanggaran, $poin, $tanggal, $id]);
        header("Location: index.php");
        exit;
    } else {
        $pesan = "Semua kolom wajib diisi dengan benar!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pelanggaran Siswa</title>
    <style>
        body { font-family: sans-serif; background: #f4f7f6; margin: 0; padding: 20px; color: #333; }
        .container { max-width: 500px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h2 { margin-top: 0; color: #2c3e50; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; font-size: 14px; }
        input[type="text"], input[type="number"], input[type="date"] { width: 100%; padding: 8px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; font-size: 14px; }
        .btn { padding: 10px 15px; background: #f39c12; color: #fff; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; }
        .btn-back { background: #95a5a6; text-decoration: none; display: inline-block; padding: 10px 15px; color: white; border-radius: 4px; font-size: 14px; }
        .error { color: #e74c3c; margin-bottom: 10px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Data Pelanggaran</h2>
        <?php if (!empty($pesan)): ?><div class="error"><?= $pesan; ?></div><?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label>Nama Siswa:</label>
                <input type="text" name="nama_siswa" value="<?= htmlspecialchars($data['nama_siswa']); ?>" required>
            </div>
            <div class="form-group">
                <label>Kelas:</label>
                <input type="text" name="kelas" value="<?= htmlspecialchars($data['kelas']); ?>" required>
            </div>
            <div class="form-group">
                <label>Jenis Pelanggaran:</label>
                <input type="text" name="jenis_pelanggaran" value="<?= htmlspecialchars($data['jenis_pelanggaran']); ?>" required>
            </div>
            <div class="form-group">
                <label>Poin Pelanggaran:</label>
                <input type="number" name="poin" value="<?= htmlspecialchars($data['poin']); ?>" min="1" required>
            </div>
            <div class="form-group">
                <label>Tanggal:</label>
                <input type="date" name="tanggal" value="<?= htmlspecialchars($data['tanggal']); ?>" required>
            </div>
            <button type="submit" class="btn">Perbarui Data</button>
            <a href="index.php" class="btn-back">Kembali</a>
        </form>
    </div>
</body>
</html>
