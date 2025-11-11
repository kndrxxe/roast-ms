<?php
session_start();
require_once '../../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = trim($_POST['update_id'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $role = trim($_POST['role'] ?? '');

    // Validate required fields
    if (empty($id) || empty($name) || empty($username) || empty($role)) {
        $_SESSION['errorupdate'] = "All fields except password are required.";
        header('Location: /roast-ms/pages/admin/usermanagement.php');
        exit;
    }

    // Prepare and execute the query
    if (!empty($password)) {
        // Password provided: update with new hash
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET name = ?, username = ?, password = ?, role = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssi', $name, $username, $hashed_password, $role, $id);
    } else {
        // No password change
        $query = "UPDATE users SET name = ?, username = ?, role = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssi', $name, $username, $role, $id);
    }

    if ($stmt && $stmt->execute()) {
        $_SESSION['updatesuccess'] = "User <strong>{$name}</strong> updated successfully.";
    } else {
        $_SESSION['updateerror'] = "Failed to update user <strong>{$name}</strong>. Please try again.";
        if ($stmt) {
            $_SESSION['updateerror'] .= " Error: " . $stmt->error;
        }
    }

    if ($stmt) {
        $stmt->close();
    }
    $conn->close();

    header('Location: /roast-ms/pages/admin/usermanagement.php');
    exit;
}
?>
