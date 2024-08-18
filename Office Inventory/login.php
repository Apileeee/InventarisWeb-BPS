<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN | BPS INVENTORY OFFICE</title>
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
            <a class="navbar-brand" href="login.php" style="color: orange;"><i class="fa-solid fa-briefcase"></i> BPS Inventory Office</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>
<!-- Akhir Navbar -->

<section class="gradient-custom" style="background-image: linear-gradient(rgba(0, 0, 0, 0.75),rgba(0, 0, 0, 0.75)), url(./img/bps.jpg); background-size: cover;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <div class="mb-md-5 mt-md-4 pb-5">
                            <h2 class="fw-bold mb-2 text-uppercase" style="color: orange;">Login</h2>
                            <p class="text-white-50 mb-5">Please enter your username and password!</p>

                            <form id="loginForm" method="POST">
                                <div class="form-outline form-white mb-4">
                                    <input type="text" id="username" name="username" class="form-control form-control-lg" autocomplete="username" />
                                    <br>
                                    <label class="form-label" for="username">Username</label>
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input type="password" id="password" name="password" class="form-control form-control-lg" />
                                    <br>
                                    <label class="form-label" for="password">Password</label>
                                </div>

                                <button type="submit" class="btn btn-outline-light btn-lg px-4">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- JavaScript dan Skrip -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
<script src="https://kit.fontawesome.com/c4e23af47a.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('#loginForm').submit(function (e) {
            e.preventDefault();
            var username = $('#username').val();
            var password = $('#password').val();

            if (username == "" || password == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Username dan password harus diisi!'
                });
                return;
            }

            $.ajax({
                type: 'POST',
                url: 'prosess_login.php',
                data: $(this).serialize(),
                success: function (response) {
                    if (response.includes("Username atau password salah.")) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Username atau password salah!'
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Login berhasil!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                // Mengecek peran pengguna dan mengarahkan sesuai keinginan
                                if (response.includes("admin")) {
                                    window.location.href = 'dashboard.php';
                                } else {
                                    window.location.href = 'dashboard_pegawai.php';
                                }
                            }
                        });
                    }
                }

            });
        });
    });
</script>
</body>

</html>
