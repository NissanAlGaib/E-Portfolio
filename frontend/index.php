<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get the page from URL parameter, default to 'home'
$page = $_GET['page'] ?? 'home';

// Define allowed pages to prevent directory traversal
$allowedPages = [
    'home' => 'views/pages/home.php',
    'profile' => 'views/pages/profile.php',
    'projects' => 'views/pages/projects.php',
    'skills' => 'views/pages/skills.php',
    'achievements' => 'views/pages/achievements.php',
    'education' => 'views/pages/education.php',
    'hobbies' => 'views/pages/hobbies.php',
    'login' => 'views/pages/login.php',
    'admin-login' => 'views/admin/login.php',
    'admin' => 'views/admin/dashboard.php',
    'admin-projects' => 'views/admin/manage_projects.php',
    'admin-skills' => 'views/admin/manage_skills.php',
    'admin-achievements' => 'views/admin/manage_achievements.php',
    'admin-education' => 'views/admin/manage_education.php',
    'admin-contacts' => 'views/admin/manage_contacts.php',
    'admin-hobbies' => 'views/admin/manage_hobbies.php',
    'admin-profile' => 'views/admin/manage_profile.php',
];

// Check if admin authentication is required
$adminPages = ['admin', 'admin-projects', 'admin-skills', 'admin-achievements', 'admin-education', 'admin-contacts', 'admin-hobbies', 'admin-profile'];
if (in_array($page, $adminPages)) {
    // Redirect to the admin page directly instead of including it
    $adminFile = $allowedPages[$page] ?? null;
    if ($adminFile && file_exists($adminFile)) {
        include $adminFile;
        exit();
    }
}

// Get the content file path
$contentFile = $allowedPages[$page] ?? $allowedPages['home'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-Portfolio</title>
    <link rel="stylesheet" href="src/output.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
</head>

<body class="bg-dark-bg text-white font-sans flex h-screen">

    <!-- Main Content Area -->
    <main id="mainContent" class="flex-1 w-full backdrop-blur-sm flex justify-center items-center overflow-y-auto pb-32">
        <?php
        if (file_exists($contentFile)) {
            include $contentFile;
        } else {
            echo '<p class="text-red-500">Page not found</p>';
        }
        ?>
    </main>

    <!-- Dock -->
    <?php include __DIR__ . '/views/components/dock.php'; ?>

    <!-- Splash Screen -->
    <?php include __DIR__ . '/views/components/splash.php'; ?>

    <script src="src/js/core/User.js"></script>
    <script src="src/js/core/Hobbies.js"></script>
    <script src="src/js/core/particle.js"></script>
    <script src="src/js/main.js"></script>

    <?php
    // Load page-specific scripts
    if ($page === 'projects') {
        echo '<script src="src/js/core/Projects.js"></script>';
        echo '<script>if (typeof loadProjects === "function") loadProjects();</script>';
    } elseif ($page === 'skills') {
        echo '<script src="src/js/core/Skills.js"></script>';
        echo '<script>if (typeof loadSkills === "function") loadSkills();</script>';
    } elseif ($page === 'achievements') {
        echo '<script src="src/js/core/Achievements.js"></script>';
        echo '<script>if (typeof loadAchievements === "function") loadAchievements();</script>';
    } elseif ($page === 'education') {
        echo '<script src="src/js/core/Education.js"></script>';
        echo '<script>if (typeof loadEducation === "function") loadEducation();</script>';
    } elseif ($page === 'home') {
        echo '<script>if (typeof loadUserData === "function") loadUserData();</script>';
    } elseif ($page === 'profile') {
        echo '<script>if (typeof loadProfileData === "function") loadProfileData();</script>';
    } elseif ($page === 'admin-projects') {
        echo '<script src="src/js/admin/ManageProjects.js"></script>';
        echo '<script>if (typeof loadProjectsAdmin === "function") loadProjectsAdmin();</script>';
    } elseif ($page === 'admin-skills') {
        echo '<script src="src/js/admin/ManageSkills.js"></script>';
        echo '<script>if (typeof loadSkillsAdmin === "function") loadSkillsAdmin();</script>';
    } elseif ($page === 'admin-achievements') {
        echo '<script src="src/js/admin/ManageAchievements.js"></script>';
        echo '<script>if (typeof loadAchievementsAdmin === "function") loadAchievementsAdmin();</script>';
    } elseif ($page === 'admin-education') {
        echo '<script src="src/js/admin/ManageEducation.js"></script>';
        echo '<script>if (typeof loadEducationAdmin === "function") loadEducationAdmin();</script>';
    } elseif ($page === 'admin-contacts') {
        echo '<script src="src/js/admin/ManageContacts.js"></script>';
        echo '<script>if (typeof loadContactsAdmin === "function") loadContactsAdmin();</script>';
    } elseif ($page === 'admin-hobbies') {
        echo '<script src="src/js/admin/ManageHobbies.js"></script>';
        echo '<script>if (typeof loadHobbiesAdmin === "function") loadHobbiesAdmin();</script>';
    }
    ?>
</body>

</html>