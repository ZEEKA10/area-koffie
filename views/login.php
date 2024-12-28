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
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Coffee - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="flex items-center justify-center min-h-screen">

    <!-- Alert Section -->
    <?php if ($statusMessage): ?>
    <div role="alert" class="alert shadow-lg  fixed right-0 top-0 p-4 max-w-md w-full" x-data="{ visible: true }"
        x-show="visible">
        <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                class="stroke-info h-6 w-6 shrink-0 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-gray-800"><?= htmlspecialchars($statusMessage); ?></span>
        </div>
        <div class="mt-2 flex justify-end space-x-2 absolute right-3 p-4">
            <button @click="visible = false" class="btn btn-sm btn-error">Close</button>
        </div>
    </div>
    <?php endif; ?>
    <div class="card w-96 shadow-xl" x-data="{ email: '', password: '' }">
        <div class="card-body">
            <h2 class="card-title justify-center mb-4">Login to Area Coffee</h2>
            <form method="post" action="../logic/loginLogic.php" autocomplete="off">
                <div class="form-control w-full max-w-xs mb-4">
                    <label class="label" for="email">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" id="email" placeholder="Enter your email"
                        class="input input-bordered w-full max-w-xs" x-model="email" name="email" required
                        autocomplete="off" />
                </div>
                <div class="form-control w-full max-w-xs mb-6">
                    <label class="label" for="password">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" id="password" placeholder="Enter your password"
                        class="input input-bordered w-full max-w-xs" x-model="password" name="pass" required
                        autocomplete="new-password" />
                </div>
                <div class="card-actions justify-end">
                    <a href="register.php" class="btn btn-primary">Register</a>
                    <button type="submit" class="btn btn-secondary">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>