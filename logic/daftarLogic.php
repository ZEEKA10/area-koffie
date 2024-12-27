<?php
session_start();
require '../logic/koneksi.php';

$email       = $_POST["email"];
$pass       = md5($_POST["password"]);

if($email == null) {
    header("Location: ../index.php");
exit();  // Pastikan skrip berhenti setelah redirect
}


$queryDaftar = "INSERT INTO login VALUES ('$email','$pass',0)";
$queryDaftar2 = "INSERT INTO anggota VALUES ('$userId','$email','','','','')";

// Eksekusi query pertama
if (mysqli_query($conn, $queryDaftar)) {
    // Eksekusi query kedua jika query pertama berhasil
    if (mysqli_query($conn, $queryDaftar2)) {
        echo "
        <script>
        alert('Anda telah terdaftar sebagai Anggota Baru');
        window.location.href = '../index.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('Gagal menambahkan data anggota');
        window.location.href = '../index.php';
        </script>
        ";
    }
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