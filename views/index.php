<?php 

require '../logic/koneksi.php';

// Tambahkan kategori baru
if (isset($_POST['kategoriTambah'])) {
    $kategori = $_POST['kategoriTambah'];
    $create = "INSERT INTO kategori (id_kategori, nama_kategori) VALUES (NULL, '$kategori')";
    mysqli_query($conn, $create);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}   

// Hapus kategori
if (isset($_POST['kategoriHapus'])) {
    $id = $_POST['kategoriHapus'];
    $delete = "DELETE FROM kategori WHERE id_kategori = '$id'";
    mysqli_query($conn, $delete);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

// Edit kategori
if (isset($_POST['kategoriEdit']) && isset($_POST['kategoriBaru'])) {
    $id = $_POST['kategoriEdit'];
    $kategoriBaru = $_POST['kategoriBaru'];
    $update = "UPDATE kategori SET nama_kategori = '$kategoriBaru' WHERE id_kategori = '$id'";
    mysqli_query($conn, $update);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

// Ambil semua kategori
$select = "SELECT * FROM kategori";
$selectSql = mysqli_query($conn, $select);

?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Coffee - Manage Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <!-- Container Card -->
    <nav class="bg-gray-800 p-4">
        <ul class="flex space-x-4">
            <li>
                <p class="text-white">Area Koffie</p>
            </li>
            <li><a href="../views/menu.php" @click.prevent="currentPage = 'menu'"
                    class="text-white hover:underline">Menu</a></li>
    </nav>
    <div class="bg-base-200 flex items-center justify-center min-h-screen p-4">
        <div class="card w-full max-w-lg bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title justify-center mb-4">Manage Categories</h2>
                <!-- Form Tambah Kategori -->
                <form method="post" action="">
                    <div class="form-control w-full mb-4">
                        <label class="label" for="newCategory">
                            <span class="label-text">New Category Name</span>
                        </label>
                        <div class="flex space-x-2">
                            <input type="text" id="newCategory" placeholder="Enter category name"
                                class="input input-bordered w-full" name="kategoriTambah" required />
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </form>
                <div class="divider"></div>
                <!-- Tampilkan Kategori -->
                <h3 class="text-lg font-semibold mb-2">Existing Categories</h3>
                <ul class="space-y-2">
                    <?php while ($data = mysqli_fetch_assoc($selectSql)) { ?>
                    <li class="flex justify-between items-center">
                        <span><?= htmlspecialchars($data['nama_kategori']); ?></span>
                        <div class="space-x-2">
                            <!-- Form Edit -->
                            <form method="post" action="" class="inline">
                                <input type="hidden" name="kategoriEdit" value="<?= $data['id_kategori']; ?>">
                                <input type="text" name="kategoriBaru" placeholder="New name"
                                    class="input input-bordered input-sm" required>
                                <button type="submit" class="btn btn-sm btn-success">Save</button>
                            </form>
                            <!-- Form Delete -->
                            <form method="post" action="" class="inline">
                                <input type="hidden" name="kategoriHapus" value="<?= $data['id_kategori']; ?>">
                                <button type="submit" class="btn btn-sm btn-error">Delete</button>
                            </form>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>