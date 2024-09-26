<?php
$current_page = basename($_SERVER['PHP_SELF']);
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">

        </div>
        <div class="sidebar-brand-text mx-3">Rekam <sup>Medis</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php echo ($current_page == 'dashboard_admin.php') ? 'active' : ''; ?>">
        <a class="nav-link" href="dashboard_admin.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        MAIN FEATURES
    </div>

    <!-- Menu items for Admin and Staff -->
    <?php if ($role == 'Admin') : ?>
        <li class="nav-item <?php echo ($current_page == 'data_staff.php') ? 'active' : ''; ?>">
            <a class="nav-link" href="data_staff.php">
                <i class="nav-icon fas fa-user"></i>
                <span>Data Staff</span></a>
        </li>
    <?php endif; ?>

    <?php if ($role == 'Admin' || $role == 'Staff') : ?>
        <li class="nav-item <?php echo ($current_page == 'data_pasien.php') ? 'active' : ''; ?>">
            <a class="nav-link" href="data_pasien.php">
                <i class="fas fa-bicycle"></i>
                <span>Data Pasien</span></a>
        </li>
        <li class="nav-item <?php echo ($current_page == 'data_dokter.php') ? 'active' : ''; ?>">
            <a class="nav-link" href="data_dokter.php">
                <i class="fas fa-bicycle"></i>
                <span>Data Dokter</span></a>
        </li>
    <?php endif; ?>

    <!-- Menu items for Admin, Staff, and Dokter -->
    <?php if ($role == 'Admin' || $role == 'Staff' || $role == 'Dokter') : ?>
        <li class="nav-item <?php echo ($current_page == 'data_catatan.php') ? 'active' : ''; ?>">
            <a class="nav-link" href="data_catatan.php">
                <i class="fas fa-store"></i>
                <span>Data Catatan Medis</span></a>
        </li>
    <?php endif; ?>
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        MAIN MORE.
    </div>
    <?php if ($role == 'Admin' || $role == 'Staff' || $role == 'Dokter') : ?>
        <li class="nav-item <?php echo ($current_page == 'resep_obat.php') ? 'active' : ''; ?>">
            <a class="nav-link" href="resep_obat.php">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <span>Resep Obat</span></a>
        </li>
    <?php endif; ?>
    <li class="nav-item <?php echo ($current_page == 'logout.php') ? 'active' : ''; ?>">
        <a href="logout.php" class="nav-link" onclick="return confirm('Apakah Anda yakin ingin keluar?');">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            Keluar
        </a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>