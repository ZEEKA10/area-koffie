<?php 

require '../logic/koneksi.php';

// Tambahkan menu baru
if (isset($_POST['menuTambah'])) {
    $idkategori = $_POST['idkategori'];
    $nama_menu = $_POST['nama_menu'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    // Handle file upload
    if (!empty($_FILES['foto']['name'])) {
        $foto = basename($_FILES['foto']['name']);
        $target = "../src/uploads/" . $foto;
        move_uploaded_file($_FILES['foto']['tmp_name'], $target);
    } else {
        $foto = null;
    }

    $create = "INSERT INTO menu (id_kategori, nama_menu, harga, deskripsi, foto) VALUES ('$idkategori', '$nama_menu', '$harga', '$deskripsi', '$foto')";
    mysqli_query($conn, $create);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}   

// Hapus menu
if (isset($_POST['menuHapus'])) {
    $id = $_POST['menuHapus'];
    $delete = "DELETE FROM menu WHERE id_menu = '$id'";
    mysqli_query($conn, $delete);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

// Edit menu
if (isset($_POST['menuEdit']) && isset($_POST['menuBaru'])) {
    $id = $_POST['menuEdit'];
    $idkategori = $_POST['idkategori'];
    $nama_menu = $_POST['nama_menu'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    // Handle file upload
    if (!empty($_FILES['foto']['name'])) {
        $foto = basename($_FILES['foto']['name']);
        $target = "../src/uploads/" . $foto;
        move_uploaded_file($_FILES['foto']['tmp_name'], $target);
    } else {
        $foto = $_POST['fotoLama'];
    }

    $update = "UPDATE menu SET idkategori = '$idkategori', nama_menu = '$nama_menu', harga = '$harga', deskripsi = '$deskripsi', foto = '$foto' WHERE id_menu = '$id'";
    mysqli_query($conn, $update);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

// Ambil semua menu
$selectMenu = "SELECT * FROM menu";
$selectMenuSql = mysqli_query($conn, $selectMenu);

// Ambil semua kategori
$selectKategori = "SELECT * FROM kategori";
$selectKategoriSql = mysqli_query($conn, $selectKategori);

?>
