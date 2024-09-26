<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include file koneksi database
    include '../koneksi.php';

    // Ambil nilai input dari formulir
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = "SELECT * FROM pasien WHERE username='$username' AND password='$password'";
    $result = mysqli_query($db, $query);

    // Periksa apakah hasil query menghasilkan satu baris data
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $username;
        $_SESSION['nama'] = $row['nama']; // Ambil dari hasil query

        // Redirect ke halaman berdasarkan role
        header("Location: index.php");
        exit();
    } else {
        // Jika tidak cocok, tampilkan pesan error
        $error_message = "Username, password, atau role salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Pengguna | Rekam Medis</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('bg_login.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            height: 100%;
            overflow: auto;
        }

        .login-container {
            margin-top: 100px;
        }

        .card {
            background: rgba(255, 255, 255, 0.8);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center login-container">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-black">
                        <h5 class="mb-0 text-center">Masuk | Pengguna</h5>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <?php if (!empty($error_message)) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo $error_message; ?>
                                </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <input type="text" class="form-control" id="username" name="username" required placeholder="Masukkan Username..">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan Kata sandi..">
                            </div>
                           
                            
                            
                            <button type="submit" class="btn btn-success btn-block mt-3">Login</button>
                            <a href="daftar_akun.php" class="text-secondary">Daftar Akun?</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
