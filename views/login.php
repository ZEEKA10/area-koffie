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

<body class="bg-stone-800 flex items-center justify-center min-h-screen">
    <div class="card bg-stone-500 w-96  shadow-xl" x-data="{ username: '', password: '' }">
        <div class="card-body">
            <h2 class="card-title justify-center mb-4">Login to Area Coffee</h2>
            <form method="post" action="../logic/loginLogic.php">
                <div class="form-control w-full max-w-xs mb-4">
                    <label class="label" for="email">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" id="email" placeholder="Enter your email"
                        class="input input-bordered w-full max-w-xs" x-model="Email" name="email" required />
                </div>
                <div class="form-control w-full max-w-xs mb-6">
                    <label class="label" for="password">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" id="password" placeholder="Enter your password"
                        class="input input-bordered w-full max-w-xs" name="pass" x-model="password" required />
                </div>
                <div class="card-actions justify-end">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>