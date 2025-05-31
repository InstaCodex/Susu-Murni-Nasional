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

    <title>SB Admin 2 - Tables</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
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
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
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
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
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
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Tambah Produk</h1>

                    <?php if(isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $_SESSION['error']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php unset($_SESSION['error']); endif; ?>

                    <?php if(isset($_SESSION['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $_SESSION['success']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php unset($_SESSION['success']); endif; ?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Produk
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Produk</th>
                                            <th>Nama Produk</th>
                                            <th>Satuan</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                            <th>Stok</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ambilsemuadatabarang = mysqli_query($koneksi, "SELECT * FROM barang");
                                        $i = 1;
                                        while($data = mysqli_fetch_array($ambilsemuadatabarang)){
                                            $id_barang = $data['id_barang'];
                                            $kode_barang = $data['kode_barang'];
                                            $nama_barang = $data['nama_barang'];
                                            $satuan = $data['satuan'];
                                            $harga_beli = $data['harga_beli'];
                                            $harga_jual = $data['harga_jual'];
                                            $stok = $data['stok'];
                                        ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $kode_barang; ?></td>
                                            <td><?= $nama_barang; ?></td>
                                            <td><?= $satuan; ?></td>
                                            <td><?= $harga_beli; ?></td>
                                            <td><?= $harga_jual; ?></td>
                                            <td><?= $stok; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$id_barang;?>">Edit</button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$id_barang;?>">Delete</button>
                                            </td>
                                        </tr>
                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="edit<?=$id_barang;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Produk</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <form action="functions.php" method="post">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id_barang" value="<?=$id_barang;?>">
                                                            <input type="text" name="kode_barang" value="<?=$kode_barang;?>" class="form-control" required><br>
                                                            <input type="text" name="nama_barang" value="<?=$nama_barang;?>" class="form-control" required><br>
                                                            <input type="text" name="satuan" value="<?=$satuan;?>" class="form-control" required><br>
                                                            <input type="number" name="harga_beli" value="<?=$harga_beli;?>" class="form-control" required><br>
                                                            <input type="number" name="harga_jual" value="<?=$harga_jual;?>" class="form-control" required><br>
                                                            <input type="number" name="stok" value="<?=$stok;?>" class="form-control" disabled>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="updateproduk" class="btn btn-primary">Submit</button>
                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="delete<?=$id_barang;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Produk</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <form action="functions.php" method="post">
                                                        <div class="modal-body">
                                                            Apakah yakin ingin menghapus produk <b><?=$nama_barang;?></b>?
                                                            <input type="hidden" name="id_barang" value="<?=$id_barang;?>">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="hapusproduk" class="btn btn-danger">Hapus</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Susu Murni Nasional 2025</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin Ingin Keluar</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Klik Logout Untuk Menghapus Session Dan Logout</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
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

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Produk</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="functions.php" method="post">
                    <div class="modal-body">
                        <input type="text" name="kode_barang" placeholder="Kode Produk" class="form-control" required><br>
                        <input type="text" name="nama_barang" placeholder="Nama Produk" class="form-control" required><br>
                        <input type="text" name="satuan" placeholder="Satuan" class="form-control" required><br>
                        <input type="number" name="harga_beli" placeholder="Harga Beli" class="form-control" required><br>
                        <input type="number" name="harga_jual" placeholder="Harga Jual" class="form-control" required><br>
                        <input type="number" name="stok" placeholder="Stok" class="form-control" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="addnewproduk" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>