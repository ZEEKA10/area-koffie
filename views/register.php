<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Coffee - Register</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.9.4/dist/full.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../src/css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-base-200 flex items-center justify-center min-h-screen">
    <div class="card w-96 bg-base-100 shadow-xl"
        x-data="{ username: '', email: '', password: '', confirmPassword: '' }">
        <div class="card-body">
            <h2 class="card-title justify-center mb-4">Register for Area Coffee</h2>
            <form action="../logic/daftarLogic.php" method="post" autocomplete="off">
                <div class="form-control w-full max-w-xs mb-4">
                    <label class="label" for="email">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="text" id="email" placeholder="Choose an email"
                        class="input input-bordered w-full max-w-xs" x-model="email" name="email" required autocomplete="off" />
                </div>
                <div class="form-control w-full max-w-xs mb-4">
                    <label class="label" for="nama">
                        <span class="label-text">Nama</span>
                    </label>
                    <input type="text" id="nama" placeholder="Create a Name"
                        class="input input-bordered w-full max-w-xs" x-model="Nama" name="nama" required autocomplete="off" />
                </div>
                <div class="form-control w-full max-w-xs mb-4">
                    <label class="label" for="password">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" id="password" placeholder="Create a password"
                        class="input input-bordered w-full max-w-xs" x-model="password" name="password" required autocomplete="new-password" />
                </div>
                <div class="form-control w-full max-w-xs mb-6">
                    <label class="label" for="confirmPassword">
                        <span class="label-text">Confirm Password</span>
                    </label>
                    <input type="password" id="confirmPassword" placeholder="Confirm your password"
                        class="input input-bordered w-full max-w-xs" x-model="confirmPassword" required autocomplete="new-password" />
                </div>
                <div class="card-actions justify-between">
                    <a href="login.php" class="btn btn-ghost">Login</a>
                    <button type="submit" class="btn btn-primary" :disabled="password !== confirmPassword">Register</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
