<?php
session_start();
require '../logic/koneksi.php';

$email      = $_POST["email"];
$pass       = md5($_POST["password"]);
$nama       = $_POST["nama"];

if($email == null) {
    header("Location: ../index.php");
exit();  // Pastikan skrip berhenti setelah redirect
}


$queryDaftar = "INSERT INTO user VALUES ('$email','$nama','$pass')";

// Eksekusi query pertama
if (mysqli_query($conn, $queryDaftar)) {
    // Eksekusi query kedua jika query pertama berhasil
    
} else {
    echo "
    <script>
    alert('Data yang Anda Masukkan Sudah Terdaftar Silahkan Masukkan Data Baru');
    window.location.href = '../index.php';
    </script>
    ";
    // Menampilkan error jika terjadi masalah dengan query pertama
    echo mysqli_error($conn);
}



?>