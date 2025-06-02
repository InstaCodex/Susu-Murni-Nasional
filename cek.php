<?php
// Cek apakah user sudah login
if(isset($_SESSION['log'])) {
    // User sudah login, biarkan akses
} else {
    // User belum login, redirect ke halaman login
    header('location:login.php');
}
?>