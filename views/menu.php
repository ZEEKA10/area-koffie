<?php   
session_start();
require '../logic/koneksi.php'; // Ensure you have a proper connection to your database  

// Add new menu  
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
    $_SESSION['status'] = "Data telah ditambahkan";
    header("Location: " . $_SERVER['PHP_SELF']);  
    exit;  
}  

// Delete menu  
if (isset($_POST['menuHapus'])) {  
    $id = $_POST['menuHapus'];  
    $delete = "DELETE FROM menu WHERE id_menu = '$id'";  
    mysqli_query($conn, $delete);  
    $_SESSION['status'] = "Data telah dihapus";
    header("Location: " . $_SERVER['PHP_SELF']);  
    exit;  
}  

// Edit menu  
$editMenu = null;  
if (isset($_POST['menuEdit'])) {  
    $id = $_POST['menuEdit'];  
    $selectMenuToEdit = "SELECT * FROM menu WHERE id_menu = '$id'";  
    $menuToEditSql = mysqli_query($conn, $selectMenuToEdit);  
    $editMenu = mysqli_fetch_assoc($menuToEditSql);  
} elseif (isset($_POST['id_menu'])) { // to update  
    $id = $_POST['id_menu'];  
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
        $foto = $_POST['fotoLama']; // Retain old photo if no new file uploaded  
    }  

    $update = "UPDATE menu SET id_kategori = '$idkategori', nama_menu = '$nama_menu', harga = '$harga', deskripsi = '$deskripsi', foto = '$foto' WHERE id_menu = '$id'";  
    mysqli_query($conn, $update);
    header("Location: " . $_SERVER['PHP_SELF']);  
    exit;  
}  

// Fetch all menu items  
$selectMenu = "SELECT * FROM menu";  
$selectMenuSql = mysqli_query($conn, $selectMenu);  

// Fetch all categories  
$selectKategori = "SELECT * FROM kategori";  
$selectKategoriSql = mysqli_query($conn, $selectKategori);  

if (isset($_SESSION['status'])) {
    $statusMessage = $_SESSION['status'];
    unset($_SESSION['status']); // Hapus session setelah digunakan
} else {
    $statusMessage = null;
}

// var_dump($_SESSION['status']);
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Coffee - Manage Menu Items</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-base-200 flex items-center justify-center min-h-screen p-4">
    <!-- Alert Section -->
    <?php if ($statusMessage): ?>
    <div id="alert-box" role="alert" class="alert shadow-lg fixed right-0 top-4 p-4 max-w-md w-full bg-white"
        style="z-index: 9999;">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="stroke-info h-6 w-6 shrink-0 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-gray-800"><?= htmlspecialchars($statusMessage); ?></span>
            </div>
            <button id="close-alert" class="btn btn-sm btn-error absolute right-3">Close</button>
        </div>
    </div>
    <script>
    document.getElementById('close-alert').addEventListener('click', function() {
        const alertBox = document.getElementById('alert-box');
        alertBox.style.display = 'none'; // Hide the alert
    });
    </script>
    <?php endif; ?>
    <div class="card w-full max-w-4xl bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title justify-center mb-4">Manage Menu Items</h2>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="form-control w-full mb-4">
                    <label class="label" for="idkategori">
                        <span class="label-text">Category</span>
                    </label>
                    <select id="idkategori" class="select select-bordered w-full" name="idkategori" required>
                        <option value="">Select a category</option>
                        <?php while ($kategori = mysqli_fetch_assoc($selectKategoriSql)) { ?>
                        <option value="<?= htmlspecialchars($kategori['id_kategori']); ?>"
                            <?= isset($editMenu) && $editMenu['id_kategori'] == $kategori['id_kategori'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($kategori['nama_kategori']); ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-control w-full mb-4">
                    <label class="label" for="nama_menu">
                        <span class="label-text">Menu Name</span>
                    </label>
                    <input type="text" id="nama_menu" placeholder="Enter menu name" class="input input-bordered w-full"
                        name="nama_menu" required
                        value="<?= isset($editMenu) ? htmlspecialchars($editMenu['nama_menu']) : ''; ?>" />
                </div>
                <div class="form-control w-full mb-4">
                    <label class="label" for="harga">
                        <span class="label-text">Price</span>
                    </label>
                    <input type="number" id="harga" placeholder="Enter price" class="input input-bordered w-full"
                        name="harga" step="0.01" min="0" required
                        value="<?= isset($editMenu) ? htmlspecialchars($editMenu['harga']) : ''; ?>" />
                </div>
                <div class="form-control w-full mb-4">
                    <label class="label" for="deskripsi">
                        <span class="label-text">Description</span>
                    </label>
                    <textarea id="deskripsi" placeholder="Enter description" class="textarea textarea-bordered w-full"
                        name="deskripsi"
                        required><?= isset($editMenu) ? htmlspecialchars($editMenu['deskripsi']) : ''; ?></textarea>
                </div>
                <div class="form-control w-full mb-6">
                    <label class="label" for="foto">
                        <span class="label-text">Photo</span>
                    </label>
                    <input type="file" id="foto" class="file-input file-input-bordered w-full" name="foto"
                        accept="image/*" />
                    <?php if (isset($editMenu) && $editMenu['foto']): ?>
                    <p>Current photo: <img src="../src/uploads/<?= htmlspecialchars($editMenu['foto']); ?>"
                            alt="<?= htmlspecialchars($editMenu['nama_menu']); ?>" width="50"></p>
                    <?php endif; ?>
                </div>
                <div class="card-actions justify-end">
                    <button type="submit" name="<?= isset($editMenu) ? 'menuEdit' : 'menuTambah'; ?>"
                        class="btn btn-primary">
                        <?= isset($editMenu) ? 'Update Menu Item' : 'Add Menu Item'; ?>
                    </button>
                    <?php if (isset($editMenu)): ?>
                    <input type="hidden" name="id_menu" value="<?= htmlspecialchars($editMenu['id_menu']); ?>">
                    <input type="hidden" name="fotoLama" value="<?= htmlspecialchars($editMenu['foto']); ?>">
                    <?php endif; ?>
                </div>
            </form>

            <div class="divider"></div>
            <h3 class="text-lg font-semibold mb-2">Existing Menu Items</h3>
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Photo</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($menu = mysqli_fetch_assoc($selectMenuSql)) { ?>
                        <tr>
                            <td><?= htmlspecialchars($menu['nama_menu']); ?></td>
                            <td>
                                <?php   
                                    $idkategori = htmlspecialchars($menu['id_kategori']);  
                                    $kategoriQuery = "SELECT nama_kategori FROM kategori WHERE id_kategori = '$idkategori'";  
                                    $kategoriResult = mysqli_query($conn, $kategoriQuery);  
                                    $kategoriName = mysqli_fetch_assoc($kategoriResult)['nama_kategori'];  
                                    echo htmlspecialchars($kategoriName);   
                                    ?>
                            </td>
                            <td><?= htmlspecialchars(number_format($menu['harga'], 2)); ?></td>
                            <td><?= htmlspecialchars($menu['deskripsi']); ?></td> <!-- Display Description -->
                            <td>
                                <?php if ($menu['foto']): ?>
                                <img src="../src/uploads/<?= htmlspecialchars($menu['foto']); ?>"
                                    alt="<?= htmlspecialchars($menu['nama_menu']); ?>" width="50">
                                <?php else: ?>
                                No photo
                                <?php endif; ?>
                            </td>
                            <td>
                                <!-- Form Edit -->
                                <form method="post" action="" enctype="multipart/form-data" class="inline">
                                    <input type="hidden" name="menuEdit"
                                        value="<?= htmlspecialchars($menu['id_menu']); ?>">
                                    <button type="submit" class="btn btn-sm btn-info">Edit</button>
                                </form>
                                <!-- Form Delete -->
                                <form method="post" action="" class="inline">
                                    <input type="hidden" name="menuHapus"
                                        value="<?= htmlspecialchars($menu['id_menu']); ?>">
                                    <button type="submit" class="btn btn-sm btn-error">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>