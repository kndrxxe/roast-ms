<?php
session_start();
include '../../../config.php';

if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id); // "i" indicates the variable type is integer

    if ($stmt->execute()) {
        $_SESSION['deletesuccess'] = "User has been successfully deleted.";
        header('Location: /roast-ms/pages/admin/usermanagement.php');
    } else {
        $_SESSION['deleteerror'] = "Failed to delete user. Please try again.";
        header('Location: /roast-ms/pages/admin/usermanagement.php');
    }

    $stmt->close();
    header('Location: /roast-ms/pages/admin/usermanagement.php');
    exit(); // Good practice to exit after header redirect
}
?>