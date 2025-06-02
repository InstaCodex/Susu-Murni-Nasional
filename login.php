<?php
require 'functions.php';

// Proses Login
if(isset($_POST['login'])) {
    $nama_pengguna = $_POST['nama_pengguna'];
    $kata_sandi = $_POST['kata_sandi'];

    // Cek kredensial di database
    $cek_database = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE nama_pengguna='$nama_pengguna'");
    $hitung = mysqli_num_rows($cek_database);
    
    if($hitung>0) {
        $data = mysqli_fetch_assoc($cek_database);
        // Verifikasi password
        if(password_verify($kata_sandi, $data['kata_sandi'])) {
            // Set session untuk user yang berhasil login
            $_SESSION['log'] = 'True';
            $_SESSION['id_pengguna'] = $data['id_pengguna'];
            $_SESSION['nama_pengguna'] = $data['nama_pengguna'];
            $_SESSION['peran'] = $data['peran'];
            header('location:index.php');
        } else {
            header('location:login.php');
        }
    } else {
        header('location:login.php');
    }
}

// Redirect ke index jika sudah login
if(!isset($_SESSION['log'])) {

} else {
    header('location:index.php');
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
    <title>SB Admin 2 - Login</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    </div>
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="nama_pengguna"
                                                id="exampleInputNamaPengguna" aria-describedby="namaPenggunaHelp"
                                                placeholder="Masukkan Nama Pengguna...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="kata_sandi"
                                                id="exampleInputPassword" placeholder="Kata Sandi">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button name="login" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>