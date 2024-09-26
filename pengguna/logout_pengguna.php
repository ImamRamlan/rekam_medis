<?php
// Mulai sesi
session_start();

// Hapus semua variabel sesi
$_SESSION = array();

// Hapus cookie sesi jika ada
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}

// Hapus sesi
session_destroy();

// Redirect ke halaman login
header("Location: login_pengguna.php");
exit();
?>
