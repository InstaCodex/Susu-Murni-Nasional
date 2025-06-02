<?php 
// Mulai session
session_start();

// Hapus semua data session
session_destroy();

// Redirect ke halaman login
header('location:login.php');
?>