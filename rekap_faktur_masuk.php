<?php
require 'functions.php';
require 'cek.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Rekap Faktur Masuk</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>
<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Susu Murni Nasional</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            
            <li class="nav-item">
                <a class="nav-link" href="tambah_produk.php">
                    <i class="fas fa-box"></i>
                    <span>Data Produk</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="pengguna.php">
                    <i class="fas fa-user"></i>
                    <span>Data Pengguna</span>
                </a>
                </li>

                <div class="sidebar-heading">Transaksi</div>
                <li class="nav-item">
                <a class="nav-link" href="stok_masuk.php">
                    <i class="fas fa-arrow-left"></i>
                    <span>Faktur Masuk</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="stok_keluar.php">
                    <i class="fas fa-arrow-right"></i>
                    <span>Faktur Keluar</span>
                </a>
                </li>

                <div class="sidebar-heading">Rekapitulasi</div>
                <li class="nav-item">
                <a class="nav-link" href="rekap_faktur_masuk.php">
                    <i class="fas fa-file-alt"></i>
                    <span>Rekap Faktur Masuk</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="rekap_faktur_keluar.php">
                    <i class="fas fa-file-alt"></i>
                    <span>Rekap Faktur Keluar</span>
                </a>
                </li>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['nama_pengguna']; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Rekap Faktur Masuk</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Laporan Faktur Masuk</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Faktur</th>
                                            <th>Tanggal</th>
                                            <th>Total Produk/Jasa</th>
                                            <th>Total Harga</th>
                                            <th>Nama Pengguna</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT 
                                                    f.no_faktur,
                                                    f.tanggal,
                                                    COUNT(dfm.id_detail) as total_barang_jasa,
                                                    SUM(dfm.total_harga) as total_harga,
                                                    p.nama_pengguna
                                                FROM faktur_masuk f
                                                JOIN detail_faktur_masuk dfm ON f.id_faktur_masuk = dfm.id_faktur_masuk
                                                JOIN pengguna p ON f.id_pengguna = p.id_pengguna
                                                GROUP BY f.id_faktur_masuk
                                                ORDER BY f.tanggal DESC";
                                        $result = mysqli_query($koneksi, $query);
                                        $i = 1;
                                        while($data = mysqli_fetch_array($result)){
                                        ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $data['no_faktur']; ?></td>
                                            <td><?= $data['tanggal']; ?></td>
                                            <td><?= $data['total_barang_jasa']; ?></td>
                                            <td>Rp <?= number_format($data['total_harga'], 0, ',', '.'); ?></td>
                                            <td><?= $data['nama_pengguna']; ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Susu Murni Nasional 2025</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- Modal Tambah -->
    <div class="modal fade" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Rekap Faktur Masuk</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="functions.php" method="post">
                    <div class="modal-body">
                        <input type="text" name="no_faktur" placeholder="No Faktur" class="form-control" required><br>
                        <input type="date" name="tanggal" class="form-control" required><br>
                        <input type="number" name="total_barang_jasa" placeholder="Total Produk/Jasa" class="form-control" required><br>
                        <input type="number" name="gt_faktur" placeholder="GT Faktur" class="form-control" required><br>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="addrekapmasuk" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>
</body>
</html> 