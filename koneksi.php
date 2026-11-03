<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$db   = "db_sekolah_crud";

try {
    $pdo = new PDO("mysql:host=$host;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Buat database otomatis jika belum ada
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$db`");
    $pdo->exec("use `$db`");

    // Buat tabel pelanggaran siswa jika belum ada
    $pdo->exec("CREATE TABLE IF NOT EXISTS pelanggaran_siswa (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nama_siswa VARCHAR(100) NOT NULL,
        kelas VARCHAR(20) NOT NULL,
        jenis_pelanggaran VARCHAR(150) NOT NULL,
        poin INT NOT NULL,
        tanggal DATE NOT NULL
    )");

} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>
