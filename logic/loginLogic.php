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

	$_SESSION['email']	=	$data['email'];
	$_SESSION['nama'] 		= 	$data['nama'];	

		echo "
		<script>alert('Selamat Datang Admin {$data["nama"]}');
        window.location.href = '../views/index.php'</script>
		";
}else{
	echo mysqli_error($conn);
	header("location:../index.php?alert=gagal");
};
?>