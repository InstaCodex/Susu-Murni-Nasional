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
    <title>SB Admin 2 - Dashboard</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
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
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Stok Masuk</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Stok Masuk
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Faktur</th>
                                            <th>Tanggal</th>
                                            <th>Nama Produk</th>
                                            <th>Satuan</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Total Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT fm.id_faktur_masuk, fm.no_faktur, fm.tanggal, b.nama_barang, dfm.id_detail, dfm.satuan, dfm.jumlah, dfm.harga, dfm.total_harga FROM faktur_masuk fm JOIN detail_faktur_masuk dfm ON fm.id_faktur_masuk = dfm.id_faktur_masuk JOIN barang b ON dfm.id_barang = b.id_barang ORDER BY fm.tanggal DESC";
                                        $result = mysqli_query($koneksi, $query);
                                        $i = 1;
                                        while($data = mysqli_fetch_array($result)){
                                        ?>
                                        <tr>
                                            <td><?= $i++; ?></td>
                                            <td><?= $data['no_faktur']; ?></td>
                                            <td><?= $data['tanggal']; ?></td>
                                            <td><?= $data['nama_barang']; ?></td>
                                            <td><?= $data['satuan']; ?></td>
                                            <td><?= $data['jumlah']; ?></td>
                                            <td><?= $data['harga']; ?></td>
                                            <td><?= $data['total_harga']; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal<?= $data['id_detail']; ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?= $data['id_detail']; ?>">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="editModal<?= $data['id_detail']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit Stok Masuk</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="functions.php" method="post">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id_detail" value="<?= $data['id_detail']; ?>">
                                                            <input type="hidden" name="id_faktur_masuk" value="<?= $data['id_faktur_masuk']; ?>">
                                                            <div class="form-group">
                                                                <label>Jumlah</label>
                                                                <input type="number" name="jumlah" class="form-control" value="<?= $data['jumlah']; ?>" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Harga</label>
                                                                <input type="number" name="harga" class="form-control" value="<?= $data['harga']; ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <button type="submit" name="edit_stok_masuk" class="btn btn-primary">Simpan Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Delete -->
                                        <div class="modal fade" id="deleteModal<?= $data['id_detail']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Hapus Stok Masuk</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="functions.php" method="post">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="id_detail" value="<?= $data['id_detail']; ?>">
                                                            <input type="hidden" name="id_faktur_masuk" value="<?= $data['id_faktur_masuk']; ?>">
                                                            <p>Apakah Anda yakin ingin menghapus stok masuk ini?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <button type="submit" name="delete_stok_masuk" class="btn btn-danger">Hapus</button>
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
    <script src="vendor/chart.js/Chart.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <!-- Modal Tambah Stok Masuk -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Stok Masuk</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="functions.php" method="post">
                    <div class="modal-body">
                        <?php 
                        $no_faktur = generateInvoiceNumber('INV-M-');
                        ?>
                        <input type="text" name="no_faktur" value="<?= $no_faktur; ?>" class="form-control" readonly><br>
                        <input type="date" name="tanggal" class="form-control" required><br>
                        <select name="id_barang" class="form-control" required>
                            <option value="">Pilih Produk</option>
                            <?php
                            $barang = mysqli_query($koneksi, "SELECT * FROM barang");
                            while($b = mysqli_fetch_array($barang)){
                            ?>
                            <option value="<?= $b['id_barang']; ?>"><?= $b['nama_barang']; ?></option>
                            <?php } ?>
                        </select><br>
                        <input type="text" name="satuan" placeholder="Satuan" class="form-control" required><br>
                        <input type="number" name="jumlah" placeholder="Jumlah" class="form-control" required><br>
                        <input type="number" name="harga" placeholder="Harga" class="form-control" required><br>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="addnewprodukmasuk" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>