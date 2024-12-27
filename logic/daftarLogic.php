<?php
session_start();
require '../logic/koneksi.php';

$email      = $_POST["email"];
$pass       = md5($_POST["pass"]);
$nama       = $_POST["nama"];

if($email == null) {
    header("Location: ../index.php");
exit();  // Pastikan skrip berhenti setelah redirect
}


$queryDaftar = "INSERT INTO user VALUES ('$email','$nama','$pass')";

// Eksekusi query pertama
if (mysqli_query($conn, $queryDaftar)) {
    // Eksekusi query kedua jika query pertama berhasil
    echo "
    <script>
    alert('Selamat Datang');
    window.location.href = '../views/login.php';
    </script>
    ";
} else {
    // Menampilkan error jika terjadi masalah dengan query pertama
    echo mysqli_error($conn);
}



?>