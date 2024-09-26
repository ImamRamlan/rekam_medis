<?php
session_start();

// Include file koneksi database
include '../koneksi.php';

// Cek apakah form telah di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari formulir
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nomor_telepon = $_POST['nomor_telepon'];

    // Validasi apakah username sudah digunakan
    $check_username_query = "SELECT * FROM pasien WHERE username = '$username'";
    $check_username_result = mysqli_query($db, $check_username_query);

    if (mysqli_num_rows($check_username_result) > 0) {
        $_SESSION['error_message'] = "Username sudah digunakan. Silakan coba username lain.";
    } else {
        // Query untuk menyimpan data ke dalam tabel pasien
        $insert_query = "INSERT INTO pasien (nama, username, password, alamat, tanggal_lahir, jenis_kelamin, nomor_telepon) 
                         VALUES ('$nama', '$username', '$password', '$alamat', '$tanggal_lahir', '$jenis_kelamin', '$nomor_telepon')";

        // Jalankan query
        if (mysqli_query($db, $insert_query)) {
            $_SESSION['success_message'] = "Akun berhasil dibuat. Silakan login.";
        } else {
            $_SESSION['error_message'] = "Terjadi kesalahan saat membuat akun. Silakan coba lagi.";
        }
    }

    // Redirect kembali ke halaman daftar_akun.php
    header("Location: daftar_akun.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Registrasi Akun | Baca Komik</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Daftar Akun | Baca Komik</h1>
                            </div>
                            <?php if (isset($_SESSION['error_message'])) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $_SESSION['error_message']; ?>
                                </div>
                                <?php unset($_SESSION['error_message']); ?>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['success_message'])) : ?>
                                <div class="alert alert-success" role="alert">
                                    <?php echo $_SESSION['success_message']; ?>
                                </div>
                                <?php unset($_SESSION['success_message']); ?>
                            <?php endif; ?>
                            <form class="user" method="post">
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <textarea placeholder="Alamat" name="alamat" id="alamat" class="form-control form-control-user" name="alamat"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="date" class="form-control form-control-user" id="tanggal_lahir" name="tanggal_lahir" placeholder="Tanggal Lahir">
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="nomor_telepon" name="nomor_telepon" placeholder="Nomor Telepon">
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Daftar
                                </button>

                            </form>
                            <hr>

                            <div class="text-center">
                                <a class="small" href="login_pengguna.php">Sudah Punya Akun?</a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>
