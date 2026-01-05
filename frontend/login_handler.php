<?php
session_start();

// Admin credentials (should match auth.php)
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', 'admin123'); // In production, use hashed passwords

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        header('Location: index.php?page=admin');
        exit();
    } else {
        header('Location: index.php?page=login&error=1');
        exit();
    }
} else {
    header('Location: index.php?page=login');
    exit();
}
