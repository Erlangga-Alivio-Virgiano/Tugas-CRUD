<?php
require_once 'koneksi.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $stmt = $pdo->prepare("DELETE FROM pelanggaran_siswa WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: index.php");
exit;
?>
