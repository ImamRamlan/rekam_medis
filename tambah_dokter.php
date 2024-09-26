<?php
session_start();
$title = "Tambah Data Dokter | Rekam Medis";

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
    $nama = $_POST['nama'];
    $spesialisasi = $_POST['spesialisasi'];
    $nomor_telepon = $_POST['nomor_telepon'];
    $alamat = $_POST['alamat'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah username sudah digunakan
    $query_check_username = "SELECT COUNT(*) as count FROM dokter WHERE username = '$username'";
    $result_check_username = mysqli_query($db, $query_check_username);
    $data_check_username = mysqli_fetch_assoc($result_check_username);
    if ($data_check_username['count'] > 0) {
        $error_message = "Username sudah digunakan, silakan pilih username lain.";
    } else {
        $query = "INSERT INTO dokter (nama, spesialisasi, nomor_telepon, alamat, username, password) 
                  VALUES ('$nama', '$spesialisasi', '$nomor_telepon', '$alamat', '$username', '$password')";

        // Jalankan query
        $result = mysqli_query($db, $query);

        if ($result) {
            // Set pesan sukses ke dalam sesi
            $_SESSION['success_message'] = "Data Dokter berhasil ditambahkan.";
            // Redirect ke halaman data_dokter setelah berhasil menambah data
            header("Location: data_dokter.php");
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
            <h2>Tambah Dokter</h2>
            <?php if (!empty($error_message)) { ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php } ?>
            <form method="post">
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="spesialisasi">Spesialisasi:</label>
                    <input type="text" class="form-control" id="spesialisasi" name="spesialisasi" required>
                </div>
                <div class="form-group">
                    <label for="nomor_telepon">Nomor Telepon:</label>
                    <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <textarea name="alamat" id="" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Dokter</button>
            </form>
            <br>
            <a href="data_dokter.php" class="btn btn-secondary">Kembali ke Data Dokter</a>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
