<?php
session_start();
$title = "Data Catatan | Rekam Medis";
include 'koneksi.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

include 'header.php';
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Catatan Medis</h1>
    </div>
    <!-- Content Row -->
    <div class="card shadow mb-4">
        <a href="tambah_catatan.php" class="btn btn-primary col-md-2">Tambah +</a>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pasien</h6>
            <?php if (!empty($success_message)) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($danger_message)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $danger_message; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Pasien</th>
                            <th>Nama Dokter</th>
                            <th>Tanggal Kunjungan</th>
                            <th>Keluhan</th>
                            <th>Diagnosa</th>
                            <th>Tindakan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Pasien</th>
                            <th>Nama Dokter</th>
                            <th>Tanggal Kunjungan</th>
                            <th>Keluhan</th>
                            <th>Diagnosa</th>
                            <th>Tindakan</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        // Query untuk mengambil data catatan medis
                        $query = "SELECT catatan_medis.id_catatan, pasien.nama AS nama_pasien, dokter.nama AS nama_dokter, 
                                            catatan_medis.tanggal_kunjungan, catatan_medis.keluhan, 
                                            catatan_medis.diagnosa, catatan_medis.tindakan
                                  FROM catatan_medis
                                  INNER JOIN pasien ON catatan_medis.id_pasien = pasien.id_pasien
                                  INNER JOIN dokter ON catatan_medis.id_dokter = dokter.id_dokter";
                        $result = mysqli_query($db, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?php echo $row['nama_pasien']; ?></td>
                                <td><?php echo $row['nama_dokter']; ?></td>
                                <td><?php echo $row['tanggal_kunjungan']; ?></td>
                                <td><?php echo $row['keluhan']; ?></td>
                                <td><?php echo $row['diagnosa']; ?></td>
                                <td><?php echo $row['tindakan']; ?></td>
                                <td>
                                    <!-- Detail Catatan Medis -->
                                    <a href="detail_catatan.php?id=<?php echo $row['id_catatan']; ?>" class="btn btn-info btn-sm" title="Detail">
                                        <i class="fas fa-info-circle"></i>
                                    </a>

                                    <!-- Edit Catatan Medis -->
                                    <a href="edit_catatan.php?id=<?php echo $row['id_catatan']; ?>" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Hapus Catatan Medis -->
                                    <a href="delete_catatan.php?id=<?php echo $row['id_catatan']; ?>" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data pasien ini?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>