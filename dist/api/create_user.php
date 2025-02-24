<?php
session_start();
require_once '../../database/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs
    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']); // Plaintext password input
    $role = trim($_POST['role']);

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind
    $sql = "INSERT INTO users (name, username, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $username, $hashed_password, $role);

    if ($stmt->execute()) {
        $_SESSION['registrationsuccess'] = "Registration Successfully";
        header("Location: /roast-ms/dist/pages/login");
    } else {
        $_SESSION['registrationfailed'] = "Registration Failed";
        header("Location: /roast-ms/dist/pages/login");
    }

    // Close statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>
