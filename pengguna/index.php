<?php
session_start(); // Mulai sesi
include '../koneksi.php';
$title = "Dashboard | Rekam Medis";
// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['username'])) {
    // Jika belum, redirect ke halaman login
    header("Location: login_pengguna.php");
    exit();
}

include 'header.php';
?>
<main id="main">
</main>
<?php include 'footer.php'; ?>