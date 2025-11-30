<?php
session_start();
require_once '../../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = trim($_POST['update_id'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $role = trim($_POST['role'] ?? '');

    // Logged-in user info (for audit trail)
    $performedByID = $_SESSION['user_id'] ?? 0;
    $performedByUsername = $_SESSION['username'] ?? 'Unknown';
    $ip_address = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';

    // Validate required fields
    if (empty($id) || empty($name) || empty($username) || empty($role)) {
        $_SESSION['errorupdate'] = "All fields except password are required.";
        header('Location: /roast-ms/pages/manager/usermanagement.php');
        exit;
    }

    // 🔍 Get OLD VALUE before update
    $oldQuery = $conn->prepare("SELECT name, username, role FROM users WHERE id = ?");
    $oldQuery->bind_param("i", $id);
    $oldQuery->execute();
    $oldResult = $oldQuery->get_result();
    $oldData = $oldResult->fetch_assoc();
    $oldQuery->close();

    $old_value = json_encode($oldData, JSON_UNESCAPED_UNICODE);

    // Build update query depending on password
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET name = ?, username = ?, password = ?, role = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssi', $name, $username, $hashed_password, $role, $id);
    } else {
        $query = "UPDATE users SET name = ?, username = ?, role = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssi', $name, $username, $role, $id);
    }

    // Execute update
    if ($stmt && $stmt->execute()) {

        $_SESSION['updatesuccess'] = "User <strong>{$name}</strong> updated successfully.";

        // 🔍 Get NEW VALUE after update
        $newQuery = $conn->prepare("SELECT name, username, role FROM users WHERE id = ?");
        $newQuery->bind_param("i", $id);
        $newQuery->execute();
        $newResult = $newQuery->get_result();
        $newData = $newResult->fetch_assoc();
        $newQuery->close();

        $new_value = json_encode($newData, JSON_UNESCAPED_UNICODE);

        // ✨ AUDIT TRAIL — Success
        $action = "Updated user account";
        $table_name = "users";

        $audit = $conn->prepare("
            INSERT INTO audit_trail 
            (user_id, username, action, table_name, record_id, old_value, new_value, ip_address)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $audit->bind_param(
            "isssisss",
            $performedByID,
            $performedByUsername,
            $action,
            $table_name,
            $id,
            $old_value,
            $new_value,
            $ip_address
        );
        $audit->execute();
        $audit->close();

    } else {

        $_SESSION['updateerror'] = "Failed to update user <strong>{$name}</strong>. Please try again.";

        if ($stmt) {
            $_SESSION['updateerror'] .= " Error: " . $stmt->error;
        }

        // ✨ AUDIT TRAIL — Failed update
        $action = "Failed updating user account";
        $table_name = "users";

        $audit = $conn->prepare("
            INSERT INTO audit_trail 
            (user_id, username, action, table_name, record_id, old_value, new_value, ip_address)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $failed_new_value = json_encode(["error" => $stmt->error ?? "Unknown"], JSON_UNESCAPED_UNICODE);

        $audit->bind_param(
            "isssisss",
            $performedByID,
            $performedByUsername,
            $action,
            $table_name,
            $id,
            $old_value,
            $failed_new_value,
            $ip_address
        );
        $audit->execute();
        $audit->close();
    }

    if ($stmt) {
        $stmt->close();
    }

    $conn->close();

    header('Location: /roast-ms/pages/manager/usermanagement.php');
    exit;
}
?>
