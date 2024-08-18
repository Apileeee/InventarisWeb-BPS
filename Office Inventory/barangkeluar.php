<?php
session_start();

// Pastikan untuk memulai sesi sebelum menggunakan $_SESSION

if (isset($_SESSION['admin'])) {
    // Jika pengguna adalah admin, arahkan ke dashboard.php
    $dashboardPage = "dashboard.php";
    $loggedInUserRole = "Admin";
} elseif (isset($_SESSION['pegawai'])) {
    // Jika pengguna adalah pegawai, arahkan ke dashboard_pegawai.php
    $dashboardPage = "dashboard_pegawai.php";
    $loggedInUserRole = "Pegawai";
} else {
    // Jika tidak ada informasi pengguna, mungkin perlu diarahkan ke halaman login
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BPS INVENTORY OFFICE</title>
    <link rel="icon" type="image/png" href="./img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="<?php echo $dashboardPage; ?>"  style="color: orange;"><i class="fa-solid fa-briefcase"></i> BPS Inventory Office</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="nav-link" href="#" onclick="confirmLogout()" style="color: white;">
            <i class="fa-solid fa-right-from-bracket"></i>
            Logout
        </a>
    </div>
</nav>
<!-- Akhir Navbar -->

<!-- Konten -->
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="sidebar">
                <ul class="nav flex-column nav-pills">
                    <li class="nav-item">
                        <span class="nav-link" style="text-align: center;">
                            <i class="fa-solid fa-user"></i><br>
                            <?php
                            if (isset($_SESSION['admin'])) {
                                echo "Admin Online";
                            } elseif (isset($_SESSION['pegawai'])) {
                                $loggedInUser = $_SESSION['pegawai'];

                            // Alternatif: Anda bisa menarik informasi lain dari database berdasarkan username
                            // dan menampilkan informasi tersebut di sini.
                                echo "Pegawai " . $loggedInUser;
                            } else {
                                echo "Informasi Pengguna Tidak Ditemukan";
                            }
                            ?>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>"
                            href="<?php echo $dashboardPage; ?>">
                            <i class="fa-solid fa-layer-group"></i>
                            Stock Barang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="barangmasuk.php">
                            <i class="fa-solid fa-arrow-trend-up"></i>
                            Barang Masuk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="barangkeluar.php">
                            <i class="fa-solid fa-arrow-trend-down"></i>
                            Barang Keluar
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="permintaan.php">
                            <i class="fa-solid fa-bell"></i>
                            Permintaan Barang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="laporanharian.php">
                            <i class="fa-solid fa-list-check"></i>
                            Laporan Harian
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Akhir Sidebar -->

        <!-- Konten Utama -->
        <div class="col-md-9 ml-sm-auto col-lg-9 px-md-4 content">
            <!-- Isi halaman Anda -->
            <p>Barang Keluar !</p>
        </div>
        <!-- Akhir Konten Utama -->
    </div>
</div>
<!-- Akhir Konten -->

<!-- JavaScript dan Skrip -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
<script src="https://kit.fontawesome.com/c4e23af47a.js" crossorigin="anonymous"></script>
<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Logout',
            text: 'Apakah Anda yakin ingin logout?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.replace('login.php');
                history.replaceState(null, null, '');
            }
        });
    }
</script>
</body>

</html>
