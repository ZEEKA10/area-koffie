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
            <li><a href="../views/menu.php" @click.prevent="currentPage = 'menu'" class="text-white hover:underline">Menu</a></li>
            <li><a href="#" @click.prevent="currentPage = 'categories'"
                    class="text-white hover:underline">Categories</a></li>
    </nav>

    <main class="flex-1 p-4">
        <div x-show="currentPage === 'dashboard'" x-html="await (await fetch('dashboard')).text()"></div>
        <div x-show="currentPage === 'menu'" x-html="await (await fetch('views/menu.php')).text()"></div>
        <div x-show="currentPage === 'categories'" x-html="await (await fetch('category.php')).text()"></div>
    </main>

</body>

</html>