<?php
session_start();

// Cek apakah session 'status' ada
if (isset($_SESSION['status'])) {
    $statusMessage = $_SESSION['status'];
    unset($_SESSION['status']); // Hapus session setelah digunakan
} else {
    $statusMessage = null;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Dynamic Content</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>

<body x-data="{ currentPage: 'dashboard' }">


    <nav class="bg-gray-800 p-4">
        <ul class="flex space-x-4">
            <li><a href="#" @click.prevent="currentPage = 'dashboard'" class="text-white hover:underline">Dashboard</a>
            </li>
            <li><a href="../views/menu.php" @click.prevent="currentPage = 'menu'"
                    class="text-white hover:underline">Menu</a></li>
            <li><a href="#" @click.prevent="currentPage = 'categories'"
                    class="text-white hover:underline">Categories</a></li>
    </nav>

    <!-- Alert Section -->
    <?php if ($statusMessage): ?>
    <div role="alert" class="alert bg-primary shadow-lg border-l-4 border-blue-500 p-4 max-w-md w-full"
        x-data="{ visible: true }" x-show="visible">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                class="stroke-info h-6 w-6 shrink-0 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-gray-800 bg-success"><?= htmlspecialchars($statusMessage); ?></span>
        </div>
        <div class="mt-2 flex justify-end space-x-2">
            <button @click="visible = false" class="btn btn-sm btn-error">Close</button>
        </div>
    </div>
    <?php endif; ?>

    <main class="flex-1 p-4">
        <div x-show="currentPage === 'dashboard'" x-html="await (await fetch('dashboard')).text()"></div>
        <div x-show="currentPage === 'menu'" x-html="await (await fetch('views/menu.php')).text()"></div>
        <div x-show="currentPage === 'categories'" x-html="await (await fetch('category.php')).text()"></div>
    </main>

</body>

</html>