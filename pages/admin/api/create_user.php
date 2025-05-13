<?php
session_start();
require_once '../../../config.php';

function generateUUID()
{
    return sprintf(
        '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0x0fff) | 0x4000,
        mt_rand(0, 0x3fff) | 0x8000,
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff),
        mt_rand(0, 0xffff)
    );
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);
    $user_id = generateUUID();

    // Store entered values in session (except password for security)
    $_SESSION['entered_name'] = $name;
    $_SESSION['entered_username'] = $username;

    // Check if the username already exists
    $check_sql = "SELECT id FROM users WHERE username = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $_SESSION['userexists'] = "Username is already taken.";
        header("Location: /roast-ms/pages/admin/usermanagement.php");
        exit;
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (user_id, name, username, password, role, created_at) 
    VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $user_id, $name, $username, $hashed_password, $role);

    if ($stmt->execute()) {
        unset($_SESSION['entered_name'], $_SESSION['entered_username']); // Clear saved inputs
        $_SESSION['registrationsuccess'] = "User has been successfully created!";
        header("Location: /roast-ms/pages/admin/usermanagement.php");
    } else {
        $_SESSION['registrationfailed'] = "Failed to create user. Please try again.";
        header("Location: /roast-ms/pages/admin/usermanagement.php");
    }
    // Close statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>