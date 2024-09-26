<?php
session_start();
$title = "Edit Data Staff | Rekam Medis";

include 'koneksi.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

// Inisialisasi pesan error
$error_message = '';

// Periksa apakah ada parameter ID yang dikirim melalui URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Jika tidak, redirect kembali ke halaman data_staff.php
    header("Location: data_staff.php");
    exit();
}

$id = $_GET['id']; // Ambil ID dari parameter URL

// Periksa jika ada pengiriman formulir melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $role = $_POST['role'];

    // Query untuk memperbarui data staff berdasarkan ID
    $query = "UPDATE admin_staff SET username='$username', password='$password', nama='$nama', role='$role' WHERE id_admin='$id'";

    // Jalankan query untuk memperbarui data
    $result = mysqli_query($db, $query);

    if ($result) {
        // Set pesan sukses ke dalam sesi
        $_SESSION['success_message'] = "Data Staff berhasil diperbarui.";
        // Redirect kembali ke halaman data_staff.php
        header("Location: data_staff.php");
        exit();
    } else {
        // Jika terjadi kesalahan dalam memperbarui data, tampilkan pesan kesalahan
        $error_message = "Terjadi kesalahan dalam memperbarui data Staff. Silakan coba lagi.";
    }
}

// Query untuk mengambil data staff berdasarkan ID
$query_get_staff = "SELECT * FROM admin_staff WHERE id_admin = '$id'";
$result_get_staff = mysqli_query($db, $query_get_staff);
$row = mysqli_fetch_assoc($result_get_staff);

// Periksa jika data staff ditemukan
if (!$row) {
    // Jika tidak, redirect kembali ke halaman data_staff.php
    header("Location: data_staff.php");
    exit();
}

// Inisialisasi variabel dengan nilai dari database
$username = $row['username'];
$password = $row['password'];
$nama = $row['nama'];
$role = $row['role'];
?>

<?php include 'header.php'; ?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h2>Edit Staff</h2>
            <?php if (!empty($error_message)) { ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php } ?>
            <form method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $password; ?>" required>
                </div>
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>" required>
                </div>
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="">Pilih Role</option>
                        <option value="Admin" <?php echo ($role == 'Admin') ? 'selected' : ''; ?>>Admin</option>
                        <option value="Staff" <?php echo ($role == 'Staff') ? 'selected' : ''; ?>>Staff</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
            <br>
            <a href="data_staff.php" class="btn btn-secondary">Kembali ke Data Staff</a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
