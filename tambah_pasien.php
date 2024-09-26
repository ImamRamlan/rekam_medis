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
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nomor_telepon = $_POST['nomor_telepon'];

    // Query untuk menambahkan data pasien baru
    $query = "INSERT INTO pasien (nama, alamat, tanggal_lahir, jenis_kelamin, nomor_telepon) 
              VALUES ('$nama', '$alamat', '$tanggal_lahir', '$jenis_kelamin', '$nomor_telepon')";

    // Jalankan query
    $result = mysqli_query($db, $query);

    if ($result) {
        // Set pesan sukses ke dalam sesi
        $_SESSION['success_message'] = "Data Pasien berhasil ditambahkan.";
        // Redirect ke halaman data_pasien setelah berhasil menambah data
        header("Location: data_pasien.php");
        exit();
    } else {
        // Jika terjadi kesalahan dalam menambah data, tampilkan pesan kesalahan
        $error_message = "Error: " . mysqli_error($db);
    }
}
?>
<?php include 'header.php'; ?>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h2>Tambah Pasien</h2>
            <?php if (!empty($error_message)) { ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php } ?>
            <form method="post">
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir:</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin:</label>
                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nomor_telepon">Nomor Telepon:</label>
                    <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" required>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Pasien</button>
            </form>
            <br>
            <a href="data_pasien.php" class="btn btn-secondary">Kembali ke Data Pasien</a>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
