<?php
session_start();
$title = "Data Dokter | Rekam Medis";
include 'koneksi.php'; // Sertakan file koneksi.php untuk menghubungkan ke database

if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit(); // Pastikan kode selanjutnya tidak dieksekusi setelah mengarahkan
}

// Pesan sukses atau gagal yang akan ditampilkan
$success_message = '';
$danger_message = '';

// Periksa apakah ada pesan sukses dalam sesi
if (isset($_SESSION['success_message'])) {
    // Jika ada, simpan ke variabel lokal dan hapus dari sesi
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

// Periksa apakah ada pesan gagal dalam sesi
if (isset($_SESSION['danger_message'])) {
    // Jika ada, simpan ke variabel lokal dan hapus dari sesi
    $danger_message = $_SESSION['danger_message'];
    unset($_SESSION['danger_message']);
}

include 'header.php'; // Sertakan file header.php untuk bagian atas halaman
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <span> <strong>Data Dokter</strong></span>
    </div>
    <!-- Content Row -->
    <div class="card shadow mb-4">
        <a href="tambah_dokter.php" class="btn btn-primary col-md-2">Tambah +</a>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Dokter</h6>
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
                            <th>Nama</th>
                            <th>Spesialisasi</th>
                            <th>Nomor Telepon</th>
                            <th>Alamat</th>
                            <th>Username</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama</th>
                            <th>Spesialisasi</th>
                            <th>Nomor Telepon</th>
                            <th>Alamat</th>
                            <th>Username</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM dokter"; // Query untuk mengambil data dari tabel dokter
                        $result = mysqli_query($db, $query); // Eksekusi query
                        while ($row = mysqli_fetch_assoc($result)) { // Looping untuk menampilkan data
                        ?>
                            <tr>
                                <td><?php echo $row['nama']; ?></td> <!-- Menampilkan data nama -->
                                <td><?php echo $row['spesialisasi']; ?></td> <!-- Menampilkan data spesialisasi -->
                                <td><?php echo $row['nomor_telepon']; ?></td> <!-- Menampilkan data nomor telepon -->
                                <td><?php echo $row['alamat']; ?></td> <!-- Menampilkan data alamat -->
                                <td><?php echo $row['username']; ?></td> <!-- Menampilkan data username -->
                                <td>
                                    <!-- Tombol untuk menghapus data dokter -->
                                    <a href="delete_dokter.php?id=<?php echo $row['id_dokter']; ?>" class="btn btn-danger" title="Hapus"  onclick="return confirm('Apakah Anda yakin ingin menghapus data pasien ini?');"><i class="fas fa-trash"></i></a>
                                    <!-- Tombol untuk mengedit data dokter -->
                                    <a href="edit_dokter.php?id=<?php echo $row['id_dokter']; ?>" class="btn btn-warning" title="Edit"><i class="fas fa-info-circle"></i></a>
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

<?php include 'footer.php'; // Sertakan file footer.php untuk bagian bawah halaman ?>
