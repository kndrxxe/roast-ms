<?php
session_start();

if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: /roast-ms/index"); // Redirect to login
    exit;
}

// Check user role
function checkRole($allowed_roles) {
    if (!in_array($_SESSION['role'], $allowed_roles)) {
        $_SESSION['usernotfound'] = "You are not allowed to login";
        header("Location: /roast-ms/dist/pages/login");
    exit;
    }
}

function getUsername() {
    return isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
}

// Function to get the full name of the logged-in user
function getFullname() {
    return isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest User';
}
function getRole() {
    return isset($_SESSION['role']) ? $_SESSION['role'] : 'Guest User';
}
?>
