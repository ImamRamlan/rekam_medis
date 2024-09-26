<?php
session_start();
$title = "Edit Data Pasien | Rekam Medis";

include 'koneksi.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

// Inisialisasi pesan error
$error_message = '';
$success_message = '';

// Periksa apakah ada ID pasien yang dikirimkan melalui URL
if (isset($_GET['id'])) {
    $id_pasien = $_GET['id'];

    // Ambil data pasien berdasarkan ID
    $query = "SELECT * FROM pasien WHERE id_pasien = $id_pasien";
    $result = mysqli_query($db, $query);
    $pasien = mysqli_fetch_assoc($result);

    // Cek apakah data pasien ditemukan
    if (!$pasien) {
        $error_message = "Data pasien tidak ditemukan.";
    }
} else {
    // Jika tidak ada ID yang dikirimkan, arahkan kembali ke halaman data_pasien
    header("Location: data_pasien.php");
    exit();
}

// Cek jika ada data yang dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui form
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nomor_telepon = $_POST['nomor_telepon'];

    // Query untuk mengupdate data pasien
    $query_update = "UPDATE pasien 
                     SET nama = '$nama', alamat = '$alamat', tanggal_lahir = '$tanggal_lahir', 
                         jenis_kelamin = '$jenis_kelamin', nomor_telepon = '$nomor_telepon'
                     WHERE id_pasien = $id_pasien";

    // Jalankan query
    if (mysqli_query($db, $query_update)) {
        // Set pesan sukses ke dalam sesi
        $_SESSION['success_message'] = "Data Pasien berhasil diperbarui.";
        // Redirect ke halaman data_pasien setelah berhasil mengupdate data
        header("Location: data_pasien.php");
        exit();
    } else {
        // Jika terjadi kesalahan dalam mengupdate data, tampilkan pesan kesalahan
        $error_message = "Error: " . mysqli_error($db);
    }
}
?>
<?php include 'header.php'; ?>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h2>Edit Pasien</h2>
            <?php if (!empty($error_message)) { ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php } ?>
            <?php if (!empty($success_message)) { ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
            <?php } ?>
            <?php if ($pasien) { ?>
            <form method="post">
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $pasien['nama']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat:</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $pasien['alamat']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir:</label>
                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $pasien['tanggal_lahir']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin:</label>
                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="Laki-laki" <?php if ($pasien['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                        <option value="Perempuan" <?php if ($pasien['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nomor_telepon">Nomor Telepon:</label>
                    <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" value="<?php echo $pasien['nomor_telepon']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Pasien</button>
            </form>
            <br>
            <a href="data_pasien.php" class="btn btn-secondary">Kembali ke Data Pasien</a>
            <?php } ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
