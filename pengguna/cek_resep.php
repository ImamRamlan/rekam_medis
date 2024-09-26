<?php
session_start(); // Mulai sesi
include '../koneksi.php';
$title = "Cek Resep Dokter | Rekam Medis";
// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['username'])) {
    // Jika belum, redirect ke halaman login
    header("Location: login_pengguna.php");
    exit();
}

include 'header.php';

if (!isset($_GET['id_catatan'])) {
    echo "<script>alert('Catatan tidak ditemukan, silahkan kembali.');</script>";
    echo "<script>window.location.href = 'index.php';</script>";
    exit();
}

// Ambil ID Catatan dari URL
$id_catatan = $_GET['id_catatan'];

// Query untuk mengambil resep obat untuk catatan medis tertentu
$query = "SELECT * FROM resep_obat WHERE id_catatan = $id_catatan";
$result = mysqli_query($db, $query);

?>

<main id="main">
    <section class="portfolio">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Cek Resep Dokter</h2>
                <p>Daftar Resep Obat</p>
            </div>
            <?php
            if (mysqli_num_rows($result) > 0) {
            ?>
                <div class="row">
                    <div class="col">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <?php
                                // Loop untuk menampilkan resep obat
                                while ($resep = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <th>------------------------------</th>
                                        <td>------------------------------</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Nama Obat</th>
                                        <td><?php echo $resep['obat']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Dosis</th>
                                        <td><?php echo $resep['dosis']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Keterangan</th>
                                        <td><?php echo $resep['keterangan']; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="container">
                    <p>Harap menunggu untuk resep obat anda.</p>
                </div>
            <?php
            }
            ?>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>