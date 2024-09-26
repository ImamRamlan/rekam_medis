<?php
session_start();
include 'koneksi.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

// Periksa apakah ada parameter ID yang dikirim melalui URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Jika tidak, redirect kembali ke halaman data_staff.php
    header("Location: data_staff.php");
    exit();
}

$id = $_GET['id']; // Ambil ID dari parameter URL

// Query untuk menghapus data staff berdasarkan ID
$query = "DELETE FROM admin_staff WHERE id_admin = '$id'";

// Jalankan query untuk menghapus data
$result = mysqli_query($db, $query);

if ($result) {
    // Set pesan sukses ke dalam sesi
    $_SESSION['danger_message'] = "Data Staff berhasil dihapus.";
} else {
    // Jika terjadi kesalahan dalam menghapus data, set pesan error ke dalam sesi
    $_SESSION['error_message'] = "Terjadi kesalahan dalam menghapus data Staff.";
}

// Redirect kembali ke halaman data_staff.php
header("Location: data_staff.php");
exit();
