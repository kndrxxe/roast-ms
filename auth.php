<?php
ini_set('session.use_strict_mode', 1);
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on');

session_start();
require_once "config.php"; // Secure database connection

// ⏱️ Session Timeout & Regeneration
$timeout_duration = 600; // 600 seconds = 10 minutes

// Check for inactivity timeout
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    session_start();
    $_SESSION['sessionexpired'] = "Your session has expired due to inactivity.";
    header("Location: /roast-ms/login.php?timeout=1");
    exit;
}
$_SESSION['LAST_ACTIVITY'] = time(); // Update timestamp

// Regenerate session ID periodically (prevent fixation)
if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
} elseif (time() - $_SESSION['CREATED'] > 600) {
    session_regenerate_id(true);
    $_SESSION['CREATED'] = time();
}

// 👤 User Authentication Check
if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: /roast-ms/login.php");
    exit;
}

// 🧩 Helper Functions
function checkRole($allowed_roles) {
    if (!in_array($_SESSION['role'], $allowed_roles)) {
        session_start();
        $_SESSION['access_denied'] = "You are not allowed to login";
        header("Location: /roast-ms/login.php");
        exit;
    }
}

function getUsername() {
    return $_SESSION['username'] ?? null;
}

function getFullname() {
    return $_SESSION['name'] ?? null;
}

function getRole() {
    return $_SESSION['role'] ?? null;
}

function userID() {
    return $_SESSION['uid'] ?? null;
}
?>
