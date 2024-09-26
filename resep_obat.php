<?php
session_start();
$title = "Data Resep Obat | Rekam Medis";
include 'koneksi.php';

if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

include 'header.php';

// Pesan Sukses
$success_message = '';
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

// Pesan Gagal
$error_message = '';
if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <span><strong>Data Resep Obat</strong></span>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Resep Obat</h6>
        </div>
        <div class="card-body">
        <a href="tambah_resep.php" class="btn btn-primary col-md-2">Tambah +</a>
        <br>
            <?php if (!empty($success_message)) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($error_message)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pasien</th>
                            <th>Obat</th>
                            <th>Dosis</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Pasien</th>
                            <th>Obat</th>
                            <th>Dosis</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        // Query untuk mengambil data resep obat beserta nama pasien
                        $query = "SELECT resep_obat.*, pasien.nama 
                                  FROM resep_obat 
                                  INNER JOIN catatan_medis ON resep_obat.id_catatan = catatan_medis.id_catatan 
                                  INNER JOIN pasien ON catatan_medis.id_pasien = pasien.id_pasien";
                        $result = mysqli_query($db, $query);

                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row['nama']; ?></td>
                                <td><?php echo $row['obat']; ?></td>
                                <td><?php echo $row['dosis']; ?></td>
                                <td><?php echo $row['keterangan']; ?></td>
                                <td>
                                    <a href="edit_resep.php?id=<?php echo $row['id_resep']; ?>" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="delete_resep.php?id=<?php echo $row['id_resep']; ?>" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');"><i class="fas fa-trash"></i> Hapus</a>
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
