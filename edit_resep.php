<?php
session_start();
$title = "Edit Resep Obat | Rekam Medis";
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

// Pesan Sukses
$success_message = '';
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

// Periksa apakah parameter id telah diberikan
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Jika tidak, arahkan kembali ke halaman resep_obat.php
    header("Location: resep_obat.php");
    exit();
}

$id_resep = $_GET['id'];

// Query untuk mendapatkan data resep obat berdasarkan id
$query = "SELECT * FROM resep_obat WHERE id_resep = $id_resep";
$result = mysqli_query($db, $query);

if (mysqli_num_rows($result) == 0) {
    // Jika tidak ada data dengan id yang diberikan, arahkan kembali ke halaman resep_obat.php
    header("Location: resep_obat.php");
    exit();
}

$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai input dari formulir
    $obat = $_POST['obat'];
    $dosis = $_POST['dosis'];
    $keterangan = $_POST['keterangan'];

    // Query untuk mengupdate data resep obat
    $query_update = "UPDATE resep_obat SET obat = '$obat', dosis = '$dosis', keterangan = '$keterangan' WHERE id_resep = $id_resep";
    $result_update = mysqli_query($db, $query_update);

    if ($result_update) {
        $_SESSION['success_message'] = "Data resep obat berhasil diupdate.";
        header("Location: resep_obat.php");
        exit();
    } else {
        $error_message = "Gagal mengupdate data resep obat. Silakan coba lagi.";
    }
}
include 'header.php';
?>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Resep Obat</h1>

    <div class="card shadow mb-4">
        <div class="card-body">
            <?php if (!empty($error_message)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($success_message)) : ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id_resep; ?>" method="post">
                <div class="form-group">
                    <label for="obat">Nama Obat</label>
                    <input type="text" class="form-control" id="obat" name="obat" value="<?php echo $row['obat']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="dosis">Dosis</label>
                    <input type="text" class="form-control" id="dosis" name="dosis" value="<?php echo $row['dosis']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3"><?php echo $row['keterangan']; ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
