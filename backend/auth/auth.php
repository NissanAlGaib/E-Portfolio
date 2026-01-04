<?php
session_start();

// Admin credentials (in production, these should be in environment variables or database with hashing)
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD_HASH', password_hash('admin123', PASSWORD_DEFAULT)); // Change this password!

function isLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: /frontend/views/admin/login.php');
        exit();
    }
}

function login($username, $password) {
    if ($username === ADMIN_USERNAME && password_verify($password, ADMIN_PASSWORD_HASH)) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        $_SESSION['last_activity'] = time();
        return true;
    }
    return false;
}

function logout() {
    session_destroy();
    header('Location: /frontend/views/admin/login.php');
    exit();
}

// Check for session timeout (30 minutes)
if (isLoggedIn()) {
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
        logout();
    }
    $_SESSION['last_activity'] = time();
}
