<?php 
// berfungsi mengaktifkan session
session_start();
//Mengecek status login
if($_SESSION['nama'] == ""){
    header('Location:../views/index.php');
}
//Menghapus session variable
session_unset();
//berfungsi menghapus semua session
session_destroy();
session_start();
    // berfungsi mengalihkan halaman ke halaman login
    $_SESSION['status'] = "Anda Telah Logout";
    header("location:../../../index.php'");
?>