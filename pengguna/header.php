<?php
$current_page = basename($_SERVER['REQUEST_URI'], ".php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?php echo $title; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Favicons -->
    <link href="ass/img/api/logo-api.png" rel="icon">
    <link href="ass/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="ass/vendor/aos/aos.css" rel="stylesheet">
    <link href="ass/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="ass/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="ass/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="ass/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="ass/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="ass/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="ass/css/style.css" rel="stylesheet">
    <style>
        /* Tambahkan garis bawah pada setiap baris kecuali baris terakhir */
        .table-bordered>tbody>tr:not(:last-child)>td,
        .table-bordered>tbody>tr:not(:last-child)>th {
            border-bottom: 1px solid #dee2e6;
        }
    </style>

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-lg-between">
            <h1 class="logo me-auto me-lg-0"><a href="index.html">Rekam Medis <span>.</span></a></h1>
            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li>
                        <a class="nav-link scrollto <?php echo $current_page == 'index' ? 'active' : ''; ?>" href="index.php">Beranda</a>
                    </li>
                    <li class="">
                        <a class="nav-link scrollto <?php echo $current_page == 'catatan_medis' ? 'active' : ''; ?>" href="catatan_medis.php">Catatan Medis</a>
                    </li>
                    <li class="">
                        <a class="nav-link scrollto <?php echo $current_page == 'cek_resep' ? 'active' : ''; ?>" href="cek_resep.php">Riwayat Resep Obat</a>
                    </li>
                    <li class="">
                        <a class="nav-link scrollto" href="logout_pengguna.php" onclick="return confirm('Apakah Anda yakin ingin keluar?')">Keluar</a>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
            <a href="#" class="get-started-btn scrollto"><?php echo $_SESSION['nama']; ?> </a>
        </div>
    </header><!-- End Header -->
    <section id="hero" class="d-flex align-items-center justify-content-center">
        <div class="container" data-aos="fade-up">

            <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="150">
                <div class="col-xl-6 col-lg-8">
                    <h1>Rekam Medis<span>.</span></h1>
                    <h2>Rumah Sakit xx.</h2>
                </div>
            </div>
        </div>
    </section><!-- End Hero -->