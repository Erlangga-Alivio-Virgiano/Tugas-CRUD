<?php
require_once 'koneksi.php';

$stmt = $pdo->query("SELECT * FROM pelanggaran_siswa ORDER BY id DESC");
$data_pelanggaran = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Poin Tata Tertib Sekolah</title>
    <style>
        body { font-family: sans-serif; background: #f4f7f6; margin: 0; padding: 20px; color: #333; }
        .container { max-width: 900px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h2 { margin-top: 0; color: #2c3e50; }
        .btn { display: inline-block; padding: 8px 12px; background: #3498db; color: #fff; text-decoration: none; border-radius: 4px; font-size: 14px; }
        .btn-danger { background: #e74c3c; }
        .btn-warning { background: #f39c12; }
        .btn:hover { opacity: 0.9; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; font-size: 14px; }
        th { background-color: #2980b9; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .action-btns { display: flex; gap: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Catatan Poin Pelanggaran Siswa</h2>
        <a href="tambah.php" class="btn">+ Tambah Pelanggaran Baru</a>
        
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th>Pelanggaran</th>
                    <th>Poin</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($data_pelanggaran) > 0): ?>
                    <?php $no = 1; foreach ($data_pelanggaran as $row): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['nama_siswa']); ?></td>
                        <td><?= htmlspecialchars($row['kelas']); ?></td>
                        <td><?= htmlspecialchars($row['jenis_pelanggaran']); ?></td>
                        <td><?= htmlspecialchars($row['poin']); ?></td>
                        <td><?= htmlspecialchars($row['tanggal']); ?></td>
                        <td>
                            <div class="action-btns">
                                <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning">Edit</a>
                                <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="7" style="text-align: center;">Belum ada data pelanggaran.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
