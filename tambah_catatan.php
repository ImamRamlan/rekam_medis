<?php
session_start();
$title = "Tambah Data Catatan Rekam Medis | Rekam Medis";

include 'koneksi.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

// Inisialisasi pesan error
$error_message = '';

// Ambil daftar pasien dan dokter
$query_pasien = "SELECT * FROM pasien";
$query_dokter = "SELECT * FROM dokter";
$result_pasien = mysqli_query($db, $query_pasien);
$result_dokter = mysqli_query($db, $query_dokter);

// Cek jika ada data yang dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan melalui form
    $id_pasien = $_POST['id_pasien'];
    $id_dokter = $_POST['id_dokter'];
    $tanggal_kunjungan = $_POST['tanggal_kunjungan'];
    $keluhan = $_POST['keluhan'];
    $diagnosa = $_POST['diagnosa'];
    $tindakan = $_POST['tindakan'];

    // Query untuk menambahkan catatan medis
    $query = "INSERT INTO catatan_medis (id_pasien, id_dokter, tanggal_kunjungan, keluhan, diagnosa, tindakan) 
              VALUES ('$id_pasien', '$id_dokter', '$tanggal_kunjungan', '$keluhan', '$diagnosa', '$tindakan')";

    // Jalankan query
    $result = mysqli_query($db, $query);

    if ($result) {
        // Set pesan sukses ke dalam sesi
        $_SESSION['success_message'] = "Catatan medis berhasil ditambahkan.";
        // Redirect ke halaman data_catatan setelah berhasil menambah data
        header("Location: data_catatan.php");
        exit();
    } else {
        // Jika terjadi kesalahan dalam menambah data, tampilkan pesan kesalahan
        $error_message = "Terjadi kesalahan dalam menambah catatan medis: " . mysqli_error($db);
    }
}
?>

<?php include 'header.php'; ?>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h2>Tambah Catatan Medis</h2>
            <?php if (!empty($error_message)) { ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php } ?>
            <form method="post">
                <div class="form-group">
                    <label for="id_pasien">Pasien:</label>
                    <select class="form-control" id="id_pasien" name="id_pasien" required>
                        <option value="">Pilih Pasien</option>
                        <?php while ($row_pasien = mysqli_fetch_assoc($result_pasien)) { ?>
                            <option value="<?php echo $row_pasien['id_pasien']; ?>"><?php echo $row_pasien['nama']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="id_dokter">Dokter:</label>
                    <select class="form-control" id="id_dokter" name="id_dokter" required>
                        <option value="">Pilih Dokter</option>
                        <?php while ($row_dokter = mysqli_fetch_assoc($result_dokter)) { ?>
                            <option value="<?php echo $row_dokter['id_dokter']; ?>"><?php echo $row_dokter['nama']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal_kunjungan">Tanggal Kunjungan:</label>
                    <input type="date" class="form-control" id="tanggal_kunjungan" name="tanggal_kunjungan" required>
                </div>
                <div class="form-group">
                    <label for="keluhan">Keluhan:</label>
                    <textarea class="form-control" id="keluhan" name="keluhan" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="diagnosa">Diagnosa:</label>
                    <textarea class="form-control" id="diagnosa" name="diagnosa" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="tindakan">Tindakan:</label>
                    <textarea class="form-control" id="tindakan" name="tindakan" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Catatan Medis</button>
            </form>
            <br>
            <a href="data_catatan.php" class="btn btn-secondary">Kembali ke Data Catatan Medis</a>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
