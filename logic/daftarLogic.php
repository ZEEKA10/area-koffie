<?php
session_start();
require '../logic/koneksi.php';

$email = $_POST["email"];
$pass = md5($_POST["password"]);
$nama = $_POST["nama"];

if (empty($email)) {
    header("Location: ../views/login.php");
    exit();  // Pastikan skrip berhenti setelah redirect
}

$queryDaftar = "INSERT INTO user (email, nama, password) VALUES ('$email','$nama','$pass')";

// Eksekusi query pertama
if (mysqli_query($conn, $queryDaftar)) {
    // Eksekusi query kedua jika query pertama berhasil
    echo "
    <script>
    alert('Silahkan Login');
    window.location.href = '../views/login.php';
    </script>
    ";
} else {
    // Menampilkan error jika terjadi masalah dengan query pertama
    $_SESSION['status'] = "Pendaftaran gagal: " . mysqli_error($conn);
    header("Location: ../views/daftar.php");
}
?>