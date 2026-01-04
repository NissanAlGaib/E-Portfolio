<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-Portfolio</title>
    <link rel="stylesheet" href="../src/output.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
</head>

<body class="bg-dark-bg text-white font-sans flex h-screen">

    <!-- Main Content Area -->
    <main id="mainContent" class="flex-1 w-full backdrop-blur-sm flex justify-center items-center">
        <!-- AJAX-loaded content goes here -->
    </main>

    <!-- Dock -->
    <?php include __DIR__ . '/components/dock.php'; ?>

    <!-- Splash Screen -->
    <?php include __DIR__ . '/components/splash.php'; ?>

    <script src="../src/js/core/User.js"></script>
    <script src="../src/js/core/Hobbies.js"></script>
    <script src="../src/js/core/particle.js"></script>
    <script src="../src/js/main.js"></script>
</body>

</html>