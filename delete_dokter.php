<?php
session_start();
include 'koneksi.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

// Periksa apakah ID dokter telah diterima melalui URL
if (isset($_GET['id'])) {
    $id_dokter = $_GET['id'];

    // Query untuk menghapus data dokter berdasarkan ID
    $query = "DELETE FROM dokter WHERE id_dokter = '$id_dokter'";
    $result = mysqli_query($db, $query);

    if ($result) {
        // Set pesan sukses ke dalam sesi
        $_SESSION['success_message'] = "Data Dokter berhasil dihapus.";
    } else {
        // Set pesan kesalahan ke dalam sesi
        $_SESSION['danger_message'] = "Terjadi kesalahan saat menghapus data dokter.";
    }
} else {
    // Jika ID dokter tidak ditemukan dalam URL, set pesan kesalahan
    $_SESSION['danger_message'] = "ID dokter tidak ditemukan.";
}

// Redirect ke halaman data_dokter.php setelah operasi delete
header("Location: data_dokter.php");
exit();
?>
