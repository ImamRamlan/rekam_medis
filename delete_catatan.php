<?php
session_start();
include 'koneksi.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

// Periksa apakah parameter id_catatan tersedia
if (isset($_GET['id'])) {
    // Ambil id_catatan dari parameter URL
    $id_catatan = $_GET['id'];

    // Query untuk menghapus catatan medis berdasarkan id_catatan
    $query_delete = "DELETE FROM catatan_medis WHERE id_catatan = $id_catatan";

    // Jalankan query delete
    $result_delete = mysqli_query($db, $query_delete);

    if ($result_delete) {
        // Set pesan sukses ke dalam sesi
        $_SESSION['success_message'] = "Catatan medis berhasil dihapus.";
    } else {
        // Jika terjadi kesalahan dalam menghapus data, set pesan error ke dalam sesi
        $_SESSION['danger_message'] = "Gagal menghapus catatan medis. Silakan coba lagi.";
    }
} else {
    // Jika parameter id_catatan tidak tersedia, redirect ke halaman data_catatan.php
    $_SESSION['danger_message'] = "ID catatan medis tidak valid.";
}

// Redirect ke halaman data_catatan.php setelah menghapus catatan medis
header("Location: data_catatan.php");
exit();
