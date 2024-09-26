<?php
session_start();
$title = "Edit Data Dokter | Rekam Medis";
include 'koneksi.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

// Inisialisasi pesan error dan sukses
$error_message = '';
$success_message = '';

// Ambil ID dokter dari URL
$id_dokter = $_GET['id'];

// Cek jika ada data yang dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui form
    $nama = $_POST['nama'];
    $spesialisasi = $_POST['spesialisasi'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $alamat = $_POST['alamat'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Update data dokter
    $query = "UPDATE dokter SET nama='$nama', spesialisasi='$spesialisasi', nomor_telepon='$nomor_telepon', alamat='$alamat', username='$username', password='$password' WHERE id_dokter='$id_dokter'";
    $result = mysqli_query($db, $query);

    if ($result) {
        // Set pesan sukses ke dalam sesi
        $_SESSION['success_message'] = "Data Dokter berhasil diperbarui.";
        // Redirect ke halaman data_dokter setelah berhasil mengedit data
        header("Location: data_dokter.php");
        exit();
    } else {
        // Jika terjadi kesalahan dalam mengedit data, tampilkan pesan kesalahan
        $error_message = "Error: " . mysqli_error($db);
    }
}

// Ambil data dokter yang akan diedit
$query = "SELECT * FROM dokter WHERE id_dokter='$id_dokter'";
$result = mysqli_query($db, $query);
$dokter = mysqli_fetch_assoc($result);

?>
<?php include 'header.php'; ?>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h2>Edit Dokter</h2>
            <?php if (!empty($error_message)) { ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php } ?>
            <form method="post">
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $dokter['nama']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="spesialisasi">Spesialisasi:</label>
                    <input type="text" class="form-control" id="spesialisasi" name="spesialisasi" value="<?php echo $dokter['spesialisasi']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="nomor_telepon">Nomor Telepon:</label>
                    <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" value="<?php echo $dokter['nomor_telepon']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <textarea name="alamat" id="alamat" class="form-control" required><?php echo $dokter['alamat']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $dokter['username']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $dokter['password']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Perbarui Dokter</button>
            </form>
            <br>
            <a href="data_dokter.php" class="btn btn-secondary">Kembali ke Data Dokter</a>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
