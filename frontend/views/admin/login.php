<?php
require_once __DIR__ . '/../../../backend/auth/auth.php';

// If already logged in, redirect to dashboard
if (isLoggedIn()) {
    header('Location: /E-Portfolio/E-Portfolio/frontend/index.php?page=admin');
    exit();
}

$error = '';

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (login($username, $password)) {
        header('Location: /E-Portfolio/E-Portfolio/frontend/index.php?page=admin');
        exit();
    } else {
        $error = 'Invalid username or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - E-Portfolio</title>
    <link rel="stylesheet" href="/E-Portfolio/E-Portfolio/frontend/src/output.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
</head>

<body class="bg-dark-bg text-white font-sans min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md p-8">
        <div class="bg-glass border border-gray-700 rounded-2xl p-8 shadow-lg backdrop-blur-lg">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-black text-white mb-2">Admin Login</h1>
                <p class="text-gray-400">Access your portfolio dashboard</p>
            </div>

            <?php if ($error): ?>
                <div class="bg-red-500 bg-opacity-20 border border-red-500 text-red-300 px-4 py-3 rounded-lg mb-6">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="" class="space-y-6">
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-300 mb-2">Username</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        required
                        autofocus
                        class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white"
                        placeholder="Enter your username">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        class="w-full p-3 rounded-lg bg-glass border border-gray-700 focus:ring-2 focus:ring-blue-start focus:outline-none text-white"
                        placeholder="Enter your password">
                </div>

                <button
                    type="submit"
                    class="w-full bg-gradient-to-r from-blue-start to-purple-end text-white font-bold py-3 px-6 rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-300">
                    Login
                </button>
            </form>

            <div class="mt-6 text-center">
                <a href="../../views/pages/home.php" class="text-gray-400 hover:text-white text-sm transition-colors">
                    ← Back to Portfolio
                </a>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-700">
                <p class="text-xs text-gray-500 text-center">
                    Default credentials: admin / admin123<br>
                    <span class="text-red-400">Change the password in backend/auth/auth.php</span>
                </p>
            </div>
        </div>
    </div>
</body>

</html>