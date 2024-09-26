<?php
session_start();
include 'koneksi.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

// Periksa apakah ada ID pasien yang dikirimkan melalui URL
if (isset($_GET['id'])) {
    $id_pasien = $_GET['id'];

    // Query untuk menghapus data pasien berdasarkan ID
    $query_delete = "DELETE FROM pasien WHERE id_pasien = $id_pasien";

    // Jalankan query
    if (mysqli_query($db, $query_delete)) {
        // Set pesan sukses ke dalam sesi
        $_SESSION['success_message'] = "Data Pasien berhasil dihapus.";
    } else {
        // Jika terjadi kesalahan dalam menghapus data, set pesan kesalahan
        $_SESSION['danger_message'] = "Error: " . mysqli_error($db);
    }
}

// Redirect kembali ke halaman data_pasien
header("Location: data_pasien.php");
exit();
?>
