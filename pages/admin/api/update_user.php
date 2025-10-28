<?php
session_start();
require_once '../../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = trim($_POST['update_id']);
    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    if (empty($id) || empty($name) || empty($username) || empty($role)) {
        $_SESSION['errorupdate'] = "All fields except password are required.";
        header('Location: adminusers.php');
        exit;
    }

    // Prepare SQL
    if (!empty($password)) {
        // If password was changed
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET name = ?, username = ?, password = ?, role = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssi', $name, $username, $hashed_password, $role, $id);
    } else {
        // If password was not changed
        $query = "UPDATE users SET name = ?, username = ?, role = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssi', $name, $username, $role, $id);
    }

    if ($stmt->execute()) {
        $_SESSION['updatesuccess'] = "User updated successfully.";
        header('Location: /roast-ms/pages/admin/usermanagement.php');
        exit;
    } else {
        $_SESSION['updateerror'] = "Failed to update user, Please try again: " . $stmt->error;
        header('Location: /roast-ms/pages/admin/usermanagement.php');
        exit;
    }
    $stmt->close();
    $conn->close();
}
?>