<?php
session_start(); // Mulai sesi
include '../koneksi.php';
$title = "Catatan Medis | Rekam Medis";
// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['username'])) {
    // Jika belum, redirect ke halaman login
    header("Location: login_pengguna.php");
    exit();
}

include 'header.php';
?>


<main id="main">
    <section class="portfolio">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Catatan Medis</h2>
                <p>Daftar Catatan Medis Anda</p>
            </div>
            <?php
            // Query untuk mengambil catatan medis pengguna yang sedang login dan informasi dokter yang menangani
            $username = $_SESSION['username'];
            $query = "SELECT c.tanggal_kunjungan, c.keluhan, c.diagnosa, c.tindakan, d.nama AS nama_dokter, c.id_catatan
                        FROM catatan_medis c
                        INNER JOIN dokter d ON c.id_dokter = d.id_dokter
                        WHERE c.id_pasien = (SELECT id_pasien FROM pasien WHERE username = '$username')";
            $result = mysqli_query($db, $query);

            if (mysqli_num_rows($result) > 0) {
            ?>
                <div class="row">
                    <div class="col">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <?php
                                // Loop untuk menampilkan catatan medis pengguna per baris
                                while ($catatan = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <th>------------------------------</th>
                                        <td>------------------------------</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Tanggal Kunjungan</th>
                                        <td><?php echo $catatan['tanggal_kunjungan']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Dokter</th>
                                        <td><?php echo $catatan['nama_dokter']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Keluhan</th>
                                        <td><?php echo $catatan['keluhan']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Diagnosa</th>
                                        <td><?php echo $catatan['diagnosa']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Tindakan</th>
                                        <td><?php echo $catatan['tindakan']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Lihat Resep Dokter</th>
                                        <td><a href="cek_resep.php?id_catatan=<?php echo $catatan['id_catatan']; ?>" class="btn btn-success">Resep Dokter</a></td>
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
                // Tampilkan pesan jika tidak ada catatan medis
                echo "<p>Anda belum memiliki catatan medis.</p>";
            }
            ?>
        </div>
    </section>
</main>


<?php include 'footer.php'; ?>
