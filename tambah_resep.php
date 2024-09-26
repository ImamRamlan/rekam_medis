<?php
session_start();
$title = "Tambah Resep Obat | Rekam Medis";
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}
// Pesan Gagal
$error_message = '';
if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai input dari formulir
    $id_catatan = $_POST['id_catatan'];
    $obat = $_POST['obat'];
    $dosis = $_POST['dosis'];
    $keterangan = $_POST['keterangan'];

    // Query untuk menambahkan data resep obat baru
    $query = "INSERT INTO resep_obat (id_catatan, obat, dosis, keterangan) VALUES ('$id_catatan', '$obat', '$dosis', '$keterangan')";
    $result = mysqli_query($db, $query);

    if ($result) {
        $_SESSION['success_message'] = "Data resep obat berhasil ditambahkan.";
        header("Location: resep_obat.php");
        exit();
    } else {
        $error_message = "Gagal menambahkan data resep obat. Silakan coba lagi.";
    }
}
include 'header.php';
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tambah Resep Obat</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <?php if (!empty($error_message)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="id_catatan">Pasien</label>
                    <select class="form-control" id="id_catatan" name="id_catatan" required>
                        <?php
                        // Query untuk mengambil daftar pasien
                        $query_pasien = "SELECT id_catatan, nama FROM catatan_medis INNER JOIN pasien ON catatan_medis.id_pasien = pasien.id_pasien";
                        $result_pasien = mysqli_query($db, $query_pasien);

                        // Loop through each row of result set
                        while ($row_pasien = mysqli_fetch_assoc($result_pasien)) {
                            echo "<option value='" . $row_pasien['id_catatan'] . "'>" . $row_pasien['nama'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="obat">Nama Obat</label>
                    <input type="text" class="form-control" id="obat" name="obat" required>
                </div>
                <div class="form-group">
                    <label for="dosis">Dosis</label>
                    <input type="text" class="form-control" id="dosis" name="dosis" required>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Tambah</button>
                <a href="resep_obat.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
