<?php
session_start();

include 'koneksi.php';
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit(); // Pastikan kode selanjutnya tidak dieksekusi setelah mengarahkan
}
$success_message = '';

// Periksa apakah ada pesan sukses dalam sesi
if (isset($_SESSION['success_message'])) {
    // Jika ada, simpan ke variabel lokal dan hapus dari sesi
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}
$danger_message = '';

// Periksa apakah ada pesan sukses dalam sesi
if (isset($_SESSION['danger_message'])) {
    // Jika ada, simpan ke variabel lokal dan hapus dari sesi
    $danger_message = $_SESSION['danger_message'];
    unset($_SESSION['danger_message']);
}
include 'header.php';

?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <span> <strong>Data Staff</strong></span>
    </div>
    <!-- Content Row -->
    <div class="card shadow mb-4">
        <a href="tambah_staff.php" class="btn btn-primary col-md-2">Tambah +</a>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Staff</h6>
            <?php if (!empty($success_message)) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $success_message; ?>
                </div>
                <?php endif; ?><?php if (!empty($danger_message)) : ?>
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
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM admin_staff"; // Query untuk mengambil data dari tabel admin_staff
                        $result = mysqli_query($db, $query); // Eksekusi query
                        while ($row = mysqli_fetch_assoc($result)) { // Looping untuk menampilkan data
                        ?>
                            <tr>
                                <td><?php echo $row['nama']; ?></td> <!-- Menampilkan data nama -->
                                <td><?php echo $row['username']; ?></td> <!-- Menampilkan data username -->
                                <td><?php echo $row['role']; ?></td> <!-- Menampilkan data role -->
                                <td>
                                    <!-- Tombol untuk menghapus data Staff -->
                                    <a href="delete_staff.php?id=<?php echo $row['id_admin']; ?>" class="btn btn-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data pasien ini?');"><i class="fas fa-trash"></i></a>
                                    <!-- Tombol untuk mengedit data Staff -->
                                    <a href="edit_staff.php?id=<?php echo $row['id_admin']; ?>" class="btn btn-warning" title="Edit"><i class="fas fa-info-circle"></i></a>
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