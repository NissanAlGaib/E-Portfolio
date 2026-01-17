<?php
require_once __DIR__ . '/../../../backend/auth/auth.php';
requireLogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Admin'; ?> - E-Portfolio</title>
    <link rel="stylesheet" href="/E-Portfolio/E-Portfolio/frontend/src/output.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <script src="/E-Portfolio/E-Portfolio/frontend/src/js/lib/modal.js"></script>
    <script src="/E-Portfolio/E-Portfolio/frontend/src/js/lib/pagination.js"></script>
</head>

<body class="bg-dark-bg text-white font-sans min-h-screen">
    <!-- Admin Header -->
    <header class="bg-glass border-b border-gray-700 backdrop-blur-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="/E-Portfolio/E-Portfolio/frontend/index.php?page=admin" class="text-2xl font-bold bg-gradient-to-r from-blue-start to-purple-end bg-clip-text text-transparent hover:opacity-80 transition-opacity">
                    Admin Panel
                </a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="/E-Portfolio/E-Portfolio/frontend/index.php?page=home" class="text-gray-400 hover:text-white text-sm transition-colors">
                    View Portfolio
                </a>
                <span class="text-gray-400 text-sm">|</span>
                <span class="text-gray-400 text-sm">
                    <?php echo htmlspecialchars($_SESSION['admin_username']); ?>
                </span>
                <a href="/E-Portfolio/E-Portfolio/frontend/views/admin/logout.php" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm font-medium">
                    Logout
                </a>
            </div>
        </div>
    </header>

    <div class="w-full overflow-y-auto">