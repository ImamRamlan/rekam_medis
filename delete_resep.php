<?php
session_start();

// Include file koneksi database
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit(); // Pastikan kode selanjutnya tidak dieksekusi setelah mengarahkan
}

// Periksa apakah parameter id telah diberikan
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Jika tidak, arahkan kembali ke halaman resep_obat.php
    header("Location: resep_obat.php");
    exit();
}

$id_resep = $_GET['id'];

// Query untuk menghapus data resep obat berdasarkan id
$query = "DELETE FROM resep_obat WHERE id_resep = $id_resep";
$result = mysqli_query($db, $query);

if ($result) {
    $_SESSION['success_message'] = "Data resep obat berhasil dihapus.";
} else {
    $_SESSION['danger_message'] = "Gagal menghapus data resep obat. Silakan coba lagi.";
}

// Redirect kembali ke halaman resep_obat.php
header("Location: resep_obat.php");
exit();
