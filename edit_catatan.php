<?php
session_start();
$title = "Edit Catatan | Rekam Medis";
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

    // Query untuk mengambil detail catatan medis berdasarkan id_catatan
    $query = "SELECT catatan_medis.id_catatan, pasien.nama AS nama_pasien, dokter.nama AS nama_dokter, 
                      catatan_medis.tanggal_kunjungan, catatan_medis.keluhan, 
                      catatan_medis.diagnosa, catatan_medis.tindakan
              FROM catatan_medis
              INNER JOIN pasien ON catatan_medis.id_pasien = pasien.id_pasien
              INNER JOIN dokter ON catatan_medis.id_dokter = dokter.id_dokter
              WHERE catatan_medis.id_catatan = $id_catatan";
    $result = mysqli_query($db, $query);
    $catatan = mysqli_fetch_assoc($result);

    // Periksa apakah catatan medis ditemukan
    if (!$catatan) {
        // Jika tidak ditemukan, redirect ke halaman data_catatan.php
        header("Location: data_catatan.php");
        exit();
    }
} else {
    // Jika parameter id_catatan tidak tersedia, redirect ke halaman data_catatan.php
    header("Location: data_catatan.php");
    exit();
}

// Inisialisasi pesan error
$error_message = '';

// Cek jika ada data yang dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui form
    $tanggal_kunjungan = $_POST['tanggal_kunjungan'];
    $keluhan = $_POST['keluhan'];
    $diagnosa = $_POST['diagnosa'];
    $tindakan = $_POST['tindakan'];

    // Query untuk mengupdate catatan medis berdasarkan id_catatan
    $query_update = "UPDATE catatan_medis 
                     SET tanggal_kunjungan = '$tanggal_kunjungan', keluhan = '$keluhan', 
                         diagnosa = '$diagnosa', tindakan = '$tindakan'
                     WHERE id_catatan = $id_catatan";

    // Jalankan query update
    $result_update = mysqli_query($db, $query_update);

    if ($result_update) {
        // Set pesan sukses ke dalam sesi
        $_SESSION['success_message'] = "Catatan medis berhasil diperbarui.";
        // Redirect ke halaman detail_catatan.php setelah berhasil mengupdate data
        header("Location: detail_catatan.php?id=$id_catatan");
        exit();
    } else {
        // Jika terjadi kesalahan dalam mengupdate data, tampilkan pesan kesalahan
        $error_message = "Terjadi kesalahan. Silakan coba lagi.";
    }
}
include 'header.php';
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Catatan Medis</h1>
    </div>
    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <h5 class="card-title">Form Edit Catatan Medis</h5>
            <?php if (!empty($error_message)) { ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php } ?>
            <form method="post">
                <div class="form-group">
                    <label for="tanggal_kunjungan">Tanggal Kunjungan:</label>
                    <input type="date" class="form-control" id="tanggal_kunjungan" name="tanggal_kunjungan" value="<?php echo $catatan['tanggal_kunjungan']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="keluhan">Keluhan:</label>
                    <textarea class="form-control" id="keluhan" name="keluhan" rows="3" required><?php echo $catatan['keluhan']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="diagnosa">Diagnosa:</label>
                    <textarea class="form-control" id="diagnosa" name="diagnosa" rows="3" required><?php echo $catatan['diagnosa']; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="tindakan">Tindakan:</label>
                    <textarea class="form-control" id="tindakan" name="tindakan" rows="3" required><?php echo $catatan['tindakan']; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="detail_catatan.php?id=<?php echo $id_catatan; ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
