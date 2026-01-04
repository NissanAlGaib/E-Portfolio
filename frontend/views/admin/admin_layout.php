<?php
require_once '../../../backend/auth/auth.php';
requireLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - E-Portfolio</title>
    <link rel="stylesheet" href="../../src/output.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
</head>
<body class="bg-dark-bg text-white font-sans min-h-screen">
    <!-- Admin Header -->
    <header class="bg-glass border-b border-gray-700 backdrop-blur-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-start to-purple-end bg-clip-text text-transparent">
                    Admin Panel
                </h1>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-400 text-sm">
                    Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>
                </span>
                <a href="logout.php" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm font-medium">
                    Logout
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-8">
        <?php
        // Determine which page to load
        $page = $_GET['page'] ?? 'dashboard';
        
        $allowed_pages = [
            'dashboard' => 'dashboard_content.php',
            'admin-projects' => 'manage_projects_content.php',
            'admin-skills' => 'manage_skills_content.php',
            'admin-achievements' => 'manage_achievements_content.php',
            'admin-education' => 'manage_education_content.php',
            'admin-contacts' => 'manage_contacts_content.php',
        ];
        
        if (isset($allowed_pages[$page]) && file_exists($allowed_pages[$page])) {
            include $allowed_pages[$page];
        } else {
            include 'dashboard_content.php';
        }
        ?>
    </main>

    <script src="../../src/js/main.js"></script>
</body>
</html>
