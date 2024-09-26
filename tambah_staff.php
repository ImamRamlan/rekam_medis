<?php
session_start();
$title = "Tambah Data Pasien | Rekam Medis";

include 'koneksi.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

// Inisialisasi pesan error
$error_message = '';

// Cek jika ada data yang dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $role = $_POST['role'];

   // Cek apakah username sudah digunakan
   $query_check_username = "SELECT COUNT(*) as count FROM admin_staff WHERE username = '$username'";
   $result_check_username = mysqli_query($db, $query_check_username);
   $data_check_username = mysqli_fetch_assoc($result_check_username);
   if ($data_check_username['count'] > 0) {
       $error_message = "Username sudah digunakan, silakan pilih username lain.";
   } else {
       $query = "INSERT INTO admin_staff (username, password, nama, role) VALUES ('$username', '$password', '$nama', '$role')";

       // Jalankan query
       $result = mysqli_query($db, $query);

       if ($result) {
           // Set pesan sukses ke dalam sesi
           $_SESSION['success_message'] = "Data Staff berhasil ditambahkan.";
           // Redirect ke halaman manajemen_karyawan setelah berhasil menambah data
           header("Location: data_staff.php");
           exit();
       } else {
           // Jika terjadi kesalahan dalam menambah data, tampilkan pesan kesalahan
           echo "Error: " . mysqli_error($db);
       }
   }
}
?>
<?php include 'header.php'; ?>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h2>Tambah Staff</h2>
            <?php if (!empty($error_message)) { ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php } ?>
            <form method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="">Pilih Role</option>
                        <option value="Admin">Admin</option>
                        <option value="Staff">Staff</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Staff</button>
            </form>
            <br>
            <a href="data_staff.php" class="btn btn-secondary">Kembali ke Data Staff</a>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
