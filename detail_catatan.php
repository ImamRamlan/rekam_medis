<?php
session_start();
include 'koneksi.php';
$title = "Detail Data Catatan | Rekam Medis";

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

include 'header.php';

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
} else {
    // Jika parameter id_catatan tidak tersedia, redirect ke halaman data_catatan.php
    header("Location: data_catatan.php");
    exit();
}
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Catatan Medis</h1>
    </div>
    <!-- Content Row -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <h5 class="card-title">Informasi Detail Catatan Medis</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Nama Pasien</th>
                            <td><?php echo $catatan['nama_pasien']; ?></td>
                        </tr>
                        <tr>
                            <th>Nama Dokter</th>
                            <td><?php echo $catatan['nama_dokter']; ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal Kunjungan</th>
                            <td><?php echo $catatan['tanggal_kunjungan']; ?></td>
                        </tr>
                        <tr>
                            <th>Keluhan</th>
                            <td><?php echo $catatan['keluhan']; ?></td>
                        </tr>
                        <tr>
                            <th>Diagnosa</th>
                            <td><?php echo $catatan['diagnosa']; ?></td>
                        </tr>
                        <tr>
                            <th>Tindakan</th>
                            <td><?php echo $catatan['tindakan']; ?></td>
                        </tr>
                        <tr>
                            <th>Export</th>
                            <td><a href="export_pdf.php?id=<?php echo $catatan['id_catatan']; ?>" class="btn btn-primary">Export to PDF</a></td>
                        </tr>
                    </tbody>
                </table>
                <a href="data_catatan.php" class="btn btn-secondary">Kembali ke Data Catatan Medis</a>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>