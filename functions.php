<?php 
session_start();

// Koneksi ke database
$koneksi = mysqli_connect("localhost","root","","sbd");
// if ($koneksi) {
//     echo 'berhasil konek';
// }

// kanggo gawe no faktur acak
function generateInvoiceNumber($prefix) {
    $date = date('Ymd');
    $random = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
    return $prefix . $date . $random;
}

// Fungsi untuk menambah produk baru
if(isset($_POST['addnewproduk'])) {
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $satuan = $_POST['satuan'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stok = $_POST['stok'];

    // Cek apakah kode produk sudah ada
    $check_kode = mysqli_query($koneksi, "SELECT * FROM barang WHERE kode_barang='$kode_barang'");
    if(mysqli_num_rows($check_kode) > 0) {
        $_SESSION['error'] = "Kode produk sudah digunakan!";
        header('Location: tambah_produk.php'); exit();
    }
    
    // Tambahkan produk baru ke database
    $addtotable = mysqli_query($koneksi, "INSERT INTO barang (kode_barang, nama_barang, satuan, harga_beli, harga_jual, stok) VALUES ('$kode_barang', '$nama_barang', '$satuan', '$harga_beli', '$harga_jual', '$stok')");
    if($addtotable) {
        $_SESSION['success'] = "Produk berhasil ditambahkan!";
        header('Location: tambah_produk.php'); exit();
    } else {
        $_SESSION['error'] = "Gagal menambahkan produk";
        header('Location: tambah_produk.php'); exit();
    }
}

// Fungsi untuk update produk
if(isset($_POST['updateproduk'])) {
    $id_barang = $_POST['id_barang'];
    $kode_barang = $_POST['kode_barang'];
    $nama_barang = $_POST['nama_barang'];
    $satuan = $_POST['satuan'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stok = $_POST['stok'];
    $update = mysqli_query($koneksi, "UPDATE barang SET kode_barang='$kode_barang', nama_barang='$nama_barang', satuan='$satuan', harga_beli='$harga_beli', harga_jual='$harga_jual', stok='$stok' WHERE id_barang='$id_barang'");
    header('Location:tambah_produk.php');
}

// Fungsi untuk hapus produk
if(isset($_POST['hapusproduk'])) {
    $id_barang = $_POST['id_barang'];
    $hapus = mysqli_query($koneksi,"DELETE FROM barang WHERE id_barang='$id_barang'");
    header('Location:tambah_produk.php');
}

// Fungsi untuk menambah stok masuk
if(isset($_POST['addnewprodukmasuk'])) {
    $no_faktur = $_POST['no_faktur'];
    $tanggal = $_POST['tanggal'];
    $id_pengguna = $_SESSION['id_pengguna'];
    $id_barang = $_POST['id_barang'];
    $satuan = $_POST['satuan'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];
    $total_harga = $jumlah * $harga;
    
    // Insert ke tabel faktur_masuk
    $insert_faktur = mysqli_query($koneksi, "INSERT INTO faktur_masuk (no_faktur, tanggal, id_pengguna) VALUES ('$no_faktur', '$tanggal', '$id_pengguna')");
    $id_faktur_masuk = mysqli_insert_id($koneksi);
    
    // Insert ke tabel detail_faktur_masuk
    $insert_detail = mysqli_query($koneksi, "INSERT INTO detail_faktur_masuk (id_faktur_masuk, id_barang, satuan, jumlah, harga, total_harga) VALUES ('$id_faktur_masuk', '$id_barang', '$satuan', '$jumlah', '$harga', '$total_harga')");
    
    // Update stok barang
    mysqli_query($koneksi, "UPDATE barang SET stok = stok + $jumlah WHERE id_barang='$id_barang'");
    header('Location: stok_masuk.php');
}

// Fungsi untuk menambah stok keluar
if(isset($_POST['addnewprodukkeluar'])) {
    $no_faktur_keluar = $_POST['no_faktur_keluar'];
    $tanggal = $_POST['tanggal'];
    $id_pengguna = $_SESSION['id_pengguna'];
    $id_barang = $_POST['id_barang'];
    $satuan = $_POST['satuan'];
    $jumlah = $_POST['jumlah'];
    $harga = $_POST['harga'];
    $total_harga = $jumlah * $harga;

    // Cek stok yang tersedia
    $check_stock = mysqli_query($koneksi, "SELECT stok FROM barang WHERE id_barang='$id_barang'");
    $stock_data = mysqli_fetch_array($check_stock);
    $available_stock = $stock_data['stok'];

    // Validasi stok
    if($jumlah > $available_stock) {
        $_SESSION['error'] = "Stok tidak mencukupi! Stok tersedia: " . $available_stock;
        header('Location: stok_keluar.php');
        exit();
    }

    // Insert ke tabel faktur_keluar
    $insert_faktur = mysqli_query($koneksi, "INSERT INTO faktur_keluar (no_faktur_keluar, tanggal, id_pengguna) VALUES ('$no_faktur_keluar', '$tanggal', '$id_pengguna')");
    $id_faktur_keluar = mysqli_insert_id($koneksi);
    
    // Insert ke tabel detail_faktur_keluar
    $insert_detail = mysqli_query($koneksi, "INSERT INTO detail_faktur_keluar (id_faktur_keluar, id_barang, satuan, jumlah, harga, total_harga) VALUES ('$id_faktur_keluar', '$id_barang', '$satuan', '$jumlah', '$harga', '$total_harga')");
    
    // Update stok barang
    mysqli_query($koneksi, "UPDATE barang SET stok = stok - $jumlah WHERE id_barang='$id_barang'");
    header('Location: stok_keluar.php');
}

// CRUD Rekap Faktur Keluar
if(isset($_POST['addrekapkeluar'])) {
    $no_faktur_keluar = $_POST['no_faktur_keluar'];
    $tanggal = $_POST['tanggal'];
    $total_barang_jasa = $_POST['total_barang_jasa'];
    $id_pengguna = $_SESSION['id_pengguna'];
    $add = mysqli_query($koneksi, "INSERT INTO rekap_faktur_keluar (no_faktur_keluar, tanggal, total_barang_jasa, id_pengguna) VALUES ('$no_faktur_keluar', '$tanggal', '$total_barang_jasa', '$id_pengguna')");
    header('Location: rekap_faktur_keluar.php');
}
if(isset($_POST['updaterekapkeluar'])) {
    $id_rekap = $_POST['id_rekap'];
    $no_faktur_keluar = $_POST['no_faktur_keluar'];
    $tanggal = $_POST['tanggal'];
    $total_barang_jasa = $_POST['total_barang_jasa'];
    $id_pengguna = $_SESSION['id_pengguna'];
    $update = mysqli_query($koneksi, "UPDATE rekap_faktur_keluar SET no_faktur_keluar='$no_faktur_keluar', tanggal='$tanggal', total_barang_jasa='$total_barang_jasa', id_pengguna='$id_pengguna' WHERE id_rekap='$id_rekap'");
    header('Location: rekap_faktur_keluar.php');
}
if(isset($_POST['hapusrekapkeluar'])) {
    $id_rekap = $_POST['id_rekap'];
    $hapus = mysqli_query($koneksi, "DELETE FROM rekap_faktur_keluar WHERE id_rekap='$id_rekap'");
    header('Location: rekap_faktur_keluar.php');
}
// CRUD Rekap Faktur Masuk
if(isset($_POST['addrekapmasuk'])) {
    $no_faktur = $_POST['no_faktur'];
    $tanggal = $_POST['tanggal'];
    $total_barang_jasa = $_POST['total_barang_jasa'];
    $gt_faktur = $_POST['gt_faktur'];
    $id_pengguna = $_SESSION['id_pengguna'];
    $add = mysqli_query($koneksi, "INSERT INTO rekap_faktur_masuk (no_faktur, tanggal, total_barang_jasa, gt_faktur, id_pengguna) VALUES ('$no_faktur', '$tanggal', '$total_barang_jasa', '$gt_faktur', '$id_pengguna')");
    header('Location: rekap_faktur_masuk.php');
}
if(isset($_POST['updaterekapmasuk'])) {
    $id_rekap = $_POST['id_rekap'];
    $no_faktur = $_POST['no_faktur'];
    $tanggal = $_POST['tanggal'];
    $total_barang_jasa = $_POST['total_barang_jasa'];
    $gt_faktur = $_POST['gt_faktur'];
    $id_pengguna = $_SESSION['id_pengguna'];
    $update = mysqli_query($koneksi, "UPDATE rekap_faktur_masuk SET no_faktur='$no_faktur', tanggal='$tanggal', total_barang_jasa='$total_barang_jasa', gt_faktur='$gt_faktur', id_pengguna='$id_pengguna' WHERE id_rekap='$id_rekap'");
    header('Location: rekap_faktur_masuk.php');
}
if(isset($_POST['hapusrekapmasuk'])) {
    $id_rekap = $_POST['id_rekap'];
    $hapus = mysqli_query($koneksi, "DELETE FROM rekap_faktur_masuk WHERE id_rekap='$id_rekap'");
    header('Location: rekap_faktur_masuk.php');
}

// Fungsi untuk menambah pengguna baru
if(isset($_POST['addnewpengguna'])) {
    $nama_pengguna = $_POST['nama_pengguna'];
    $kata_sandi = password_hash($_POST['kata_sandi'], PASSWORD_DEFAULT);
    $peran = $_POST['peran'];
    
    // Cek apakah username sudah ada
    $check_username = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE nama_pengguna='$nama_pengguna'");
    if(mysqli_num_rows($check_username) > 0) {
        $_SESSION['error'] = "Nama pengguna sudah digunakan!";
        header('Location: pengguna.php'); exit();
    }
    
    // Tambahkan pengguna baru ke database
    $addtotable = mysqli_query($koneksi, "INSERT INTO pengguna (nama_pengguna, kata_sandi, peran) VALUES ('$nama_pengguna', '$kata_sandi', '$peran')");
    if($addtotable) {
        $_SESSION['success'] = "Pengguna berhasil ditambahkan!";
        header('Location: pengguna.php'); exit();
    } else {
        $_SESSION['error'] = "Gagal menambahkan pengguna";
        header('Location: pengguna.php'); exit();
    }
}

// Fungsi untuk update pengguna
if(isset($_POST['updatepengguna'])) {
    $id_pengguna = $_POST['id_pengguna'];
    $nama_pengguna = $_POST['nama_pengguna'];
    $peran = $_POST['peran'];
    
    // Update password jika diisi
    if(!empty($_POST['kata_sandi'])) {
        $kata_sandi = password_hash($_POST['kata_sandi'], PASSWORD_DEFAULT);
        $update = mysqli_query($koneksi, "UPDATE pengguna SET nama_pengguna='$nama_pengguna', kata_sandi='$kata_sandi', peran='$peran' WHERE id_pengguna='$id_pengguna'");
    } else {
        $update = mysqli_query($koneksi, "UPDATE pengguna SET nama_pengguna='$nama_pengguna', peran='$peran' WHERE id_pengguna='$id_pengguna'");
    }
    
    if($update) {
        header('Location: pengguna.php'); exit();
    } else {
        echo 'Gagal mengupdate pengguna'; header('Location: pengguna.php'); exit();
    }
}

// Hapus Pengguna
if(isset($_POST['hapuspengguna'])) {
    $id_pengguna = $_POST['id_pengguna'];
    $hapus = mysqli_query($koneksi, "DELETE FROM pengguna WHERE id_pengguna='$id_pengguna'");
    if($hapus) {
        header('Location: pengguna.php'); exit();
    } else {
        echo 'Gagal menghapus pengguna'; header('Location: pengguna.php'); exit();
    }
}

// Edit Stok Masuk
if(isset($_POST['edit_stok_masuk'])) {
    $id_detail = $_POST['id_detail'];
    $id_faktur_masuk = $_POST['id_faktur_masuk'];
    $jumlah_baru = $_POST['jumlah'];
    $harga_baru = $_POST['harga'];
    $total_harga_baru = $jumlah_baru * $harga_baru;

    // Ambil data lama
    $query_lama = mysqli_query($koneksi, "SELECT jumlah, id_barang FROM detail_faktur_masuk WHERE id_detail='$id_detail'");
    $data_lama = mysqli_fetch_array($query_lama);
    $jumlah_lama = $data_lama['jumlah'];
    $id_barang = $data_lama['id_barang'];

    // Update detail faktur masuk
    $update_detail = mysqli_query($koneksi, "UPDATE detail_faktur_masuk SET jumlah='$jumlah_baru', harga='$harga_baru', total_harga='$total_harga_baru' WHERE id_detail='$id_detail'");

    // Update stok barang
    $selisih = $jumlah_baru - $jumlah_lama;
    mysqli_query($koneksi, "UPDATE barang SET stok = stok + $selisih WHERE id_barang='$id_barang'");

    header('Location: stok_masuk.php');
}

// Delete Stok Masuk
if(isset($_POST['delete_stok_masuk'])) {
    $id_detail = $_POST['id_detail'];
    $id_faktur_masuk = $_POST['id_faktur_masuk'];

    // Ambil data sebelum dihapus
    $query_hapus = mysqli_query($koneksi, "SELECT jumlah, id_barang FROM detail_faktur_masuk WHERE id_detail='$id_detail'");
    $data_hapus = mysqli_fetch_array($query_hapus);
    $jumlah_hapus = $data_hapus['jumlah'];
    $id_barang = $data_hapus['id_barang'];

    // Hapus detail faktur masuk
    $delete_detail = mysqli_query($koneksi, "DELETE FROM detail_faktur_masuk WHERE id_detail='$id_detail'");

    // Update stok barang
    mysqli_query($koneksi, "UPDATE barang SET stok = stok - $jumlah_hapus WHERE id_barang='$id_barang'");

    // Cek apakah masih ada detail faktur masuk
    $cek_detail = mysqli_query($koneksi, "SELECT * FROM detail_faktur_masuk WHERE id_faktur_masuk='$id_faktur_masuk'");
    if(mysqli_num_rows($cek_detail) == 0) {
        // Jika tidak ada detail, hapus faktur masuk
        mysqli_query($koneksi, "DELETE FROM faktur_masuk WHERE id_faktur_masuk='$id_faktur_masuk'");
    }

    header('Location: stok_masuk.php');
}

// Edit Stok Keluar
if(isset($_POST['edit_stok_keluar'])) {
    $id_detail = $_POST['id_detail'];
    $id_faktur_keluar = $_POST['id_faktur_keluar'];
    $jumlah_baru = $_POST['jumlah'];
    $harga_baru = $_POST['harga'];
    $total_harga_baru = $jumlah_baru * $harga_baru;

    // Ambil data lama
    $query_lama = mysqli_query($koneksi, "SELECT jumlah, id_barang FROM detail_faktur_keluar WHERE id_detail='$id_detail'");
    $data_lama = mysqli_fetch_array($query_lama);
    $jumlah_lama = $data_lama['jumlah'];
    $id_barang = $data_lama['id_barang'];

    // Check if new quantity exceeds available stock
    $check_stock = mysqli_query($koneksi, "SELECT stok FROM barang WHERE id_barang='$id_barang'");
    $stock_data = mysqli_fetch_array($check_stock);
    $available_stock = $stock_data['stok'] + $jumlah_lama; // Add back the old quantity since it's being returned

    if($jumlah_baru > $available_stock) {
        $_SESSION['error'] = "Stok tidak mencukupi! Stok tersedia: " . $available_stock;
        header('Location: stok_keluar.php');
        exit();
    }

    // Update detail faktur keluar
    $update_detail = mysqli_query($koneksi, "UPDATE detail_faktur_keluar SET jumlah='$jumlah_baru', harga='$harga_baru', total_harga='$total_harga_baru' WHERE id_detail='$id_detail'");

    // Update stok barang
    $selisih = $jumlah_lama - $jumlah_baru; // Karena stok keluar mengurangi stok
    mysqli_query($koneksi, "UPDATE barang SET stok = stok + $selisih WHERE id_barang='$id_barang'");

    header('Location: stok_keluar.php');
}

// Delete Stok Keluar
if(isset($_POST['delete_stok_keluar'])) {
    $id_detail = $_POST['id_detail'];
    $id_faktur_keluar = $_POST['id_faktur_keluar'];

    // Ambil data sebelum dihapus
    $query_hapus = mysqli_query($koneksi, "SELECT jumlah, id_barang FROM detail_faktur_keluar WHERE id_detail='$id_detail'");
    $data_hapus = mysqli_fetch_array($query_hapus);
    $jumlah_hapus = $data_hapus['jumlah'];
    $id_barang = $data_hapus['id_barang'];

    // Hapus detail faktur keluar
    $delete_detail = mysqli_query($koneksi, "DELETE FROM detail_faktur_keluar WHERE id_detail='$id_detail'");

    // Update stok barang (kembalikan stok karena dihapus)
    mysqli_query($koneksi, "UPDATE barang SET stok = stok + $jumlah_hapus WHERE id_barang='$id_barang'");

    // Cek apakah masih ada detail faktur keluar
    $cek_detail = mysqli_query($koneksi, "SELECT * FROM detail_faktur_keluar WHERE id_faktur_keluar='$id_faktur_keluar'");
    if(mysqli_num_rows($cek_detail) == 0) {
        // Jika tidak ada detail, hapus faktur keluar
        mysqli_query($koneksi, "DELETE FROM faktur_keluar WHERE id_faktur_keluar='$id_faktur_keluar'");
    }

    header('Location: stok_keluar.php');
}

?>