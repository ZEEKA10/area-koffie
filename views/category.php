<?php 

require '../logic/koneksi.php';
if(isset($_POST['kategiruTambah'])) {
    $kategori = $_POST['kategoriTambah'];
    $create = "INSERT INTO kategori VALUES('','$kategori')";
    $sqlCreate = mysqli_query($conn,$create);
}

$select = "SELECT * FROM kategori";
$selectSql = mysqli_query($conn, $select);
$selects = mysqli_fetch_assoc($selectSql);
$cek = mysqli_num_rows($selects);


?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Coffee - Manage Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-base-200 flex items-center justify-center min-h-screen p-4">
    <!-- looping dan cek data kategori -->
    <?php if($cek > 0) { ?>
    <?php  ?>
    <div class="card w-full max-w-lg bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title justify-center mb-4">Manage Categories</h2>
            <form @submit.prevent="addCategory" method="post" action="post">
                <div class="form-control w-full mb-4">
                    <label class="label" for="newCategory">
                        <span class="label-text">New Category Name</span>
                    </label>
                    <div class="flex space-x-2">
                        <input type="text" id="newCategory" placeholder="Enter category name"
                            class="input input-bordered w-full" x-model="newCategory" required />
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>
            <div class="divider"></div>
            <h3 class="text-lg font-semibold mb-2">Existing Categories</h3>
            <ul class="space-y-2">
                <template x-for="category in categories" :key="category.id">
                    <form action="" method="post">
                        <li class="flex justify-between items-center">
                            <template x-if="editingId !== category.id">
                                <span x-text="category.nama_kategori"></span>
                            </template>
                            <template x-if="editingId === category.id">
                                <input type="text" class="input input-bordered input-sm" x-model="editingName"
                                    @keyup.enter="saveEdit" @keyup.escape="cancelEdit" />
                            </template>
                            <div class="space-x-2">
                                <template x-if="editingId !== category.id">
                                    <button @click="startEdit(category)" class="btn btn-sm btn-info">Edit</button>
                                </template>
                                <template x-if="editingId === category.id">
                                    <div class="space-x-2">
                                        <button @click="saveEdit" class="btn btn-sm btn-success">Save</button>
                                        <button @click="cancelEdit" class="btn btn-sm btn-warning">Cancel</button>
                                    </div>
                                </template>
                                <button @click="deleteCategory(category.id)"
                                    class="btn btn-sm btn-error">Delete</button>
                            </div>
                        </li>
                    </form>
                </template>
            </ul>
        </div>
    </div>
    <?php 
    } ?>
</body>

</html>