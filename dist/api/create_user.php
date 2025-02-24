<?php
session_start();
require_once '../../database/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']); // Plaintext password input
    $role = trim($_POST['role']);

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
        header("Location: /roast-ms/dist/pages/register");
        exit;
    }

    $check_stmt->close(); // Close the check statement

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind
    $sql = "INSERT INTO users (name, username, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $username, $hashed_password, $role);

    if ($stmt->execute()) {
        unset($_SESSION['entered_name'], $_SESSION['entered_username']); // Clear saved inputs
        $_SESSION['registrationsuccess'] = "Registration Successfully";
        header("Location: /roast-ms/dist/pages/login");
    } else {
        $_SESSION['registrationfailed'] = "Registration Failed";
        header("Location: /roast-ms/dist/pages/register");
    }

    // Close statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>
