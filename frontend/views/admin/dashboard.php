<?php
require_once '../../../backend/auth/auth.php';
requireLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - E-Portfolio</title>
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
                <a href="../pages/home.php" class="text-gray-400 hover:text-white text-sm transition-colors">
                    View Portfolio
                </a>
                <span class="text-gray-400 text-sm">|</span>
                <span class="text-gray-400 text-sm">
                    <?php echo htmlspecialchars($_SESSION['admin_username']); ?>
                </span>
                <a href="logout.php" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm font-medium">
                    Logout
                </a>
            </div>
        </div>
    </header>

    <div class="w-full overflow-y-auto">
    <section class="max-w-7xl mx-auto p-12">
        <h1 class="text-5xl font-black text-white mb-8 text-center">Admin Dashboard</h1>
        <p class="text-gray-300 text-center mb-12">Manage your portfolio content</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Projects Management -->
            <a href="manage_projects.php" class="bg-glass border border-gray-700 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:border-blue-start">
                <div class="flex items-center mb-4">
                    <div class="bg-gradient-to-r from-blue-start to-purple-end p-3 rounded-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white ml-4">Projects</h3>
                </div>
                <p class="text-gray-400">Add and manage your projects with descriptions, links, and images</p>
            </a>

            <!-- Skills Management -->
            <a href="manage_skills.php" class="bg-glass border border-gray-700 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:border-blue-start">
                <div class="flex items-center mb-4">
                    <div class="bg-gradient-to-r from-blue-start to-purple-end p-3 rounded-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white ml-4">Skills</h3>
                </div>
                <p class="text-gray-400">Manage your technical and soft skills with proficiency levels</p>
            </a>

            <!-- Achievements Management -->
            <a href="manage_achievements.php" class="bg-glass border border-gray-700 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:border-blue-start">
                <div class="flex items-center mb-4">
                    <div class="bg-gradient-to-r from-blue-start to-purple-end p-3 rounded-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white ml-4">Achievements</h3>
                </div>
                <p class="text-gray-400">Document your school achievements and accomplishments</p>
            </a>

            <!-- Education Management -->
            <a href="manage_education.php" class="bg-glass border border-gray-700 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:border-blue-start">
                <div class="flex items-center mb-4">
                    <div class="bg-gradient-to-r from-blue-start to-purple-end p-3 rounded-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white ml-4">Education</h3>
                </div>
                <p class="text-gray-400">Manage your educational background</p>
            </a>

            <!-- Contact Messages -->
            <a href="manage_contacts.php" class="bg-glass border border-gray-700 rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:border-blue-start">
                <div class="flex items-center mb-4">
                    <div class="bg-gradient-to-r from-blue-start to-purple-end p-3 rounded-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white ml-4">Contact Messages</h3>
                </div>
                <p class="text-gray-400">View and manage contact form submissions</p>
            </a>
        </div>
    </section>
</div>
</body>
</html>