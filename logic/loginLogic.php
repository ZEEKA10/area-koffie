<?php
// berfungsi mengaktifkan session
session_start();

// berfungsi menghubungkan koneksi ke database
require 'koneksi.php';

// berfungsi menangkap data yang dikirim
$email = $_POST['email'];
$pass = $_POST['pass'];
$passmd5 = md5($pass);
// berfungsi menyeleksi data user dengan username dan password yang sesuai
$sql = mysqli_query($conn,"SELECT * FROM user  WHERE email = '$email' AND password ='$passmd5'");
$cek = mysqli_num_rows($sql);		

// berfungsi mengecek apakah username dan password ada pada database
if($cek > 0){
	$data 		= mysqli_fetch_assoc($sql);	

	// var_dump($cek);exit;
    
	$_SESSION['email'] 		= 	$data['email'];
	$_SESSION['nama'] 		= 	$data['nama'];

    echo "
		<script>alert('Selamat Datang Admin');
        window.location.href = '../index.php'</script>
		";
}else{
	header("location:../index.php?alert=gagal");
};
?>