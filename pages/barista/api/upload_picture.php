<?php
session_start();
require_once '../../../config.php';

// Ensure user ID is provided
if (!isset($_POST['user_id']) || empty($_POST['user_id'])) {
    die("Error: Missing user ID.");
}

$user_id = trim($_POST['user_id']);
$username = $_SESSION['name'] ?? 'Unknown';

// Check if file is uploaded
if (!isset($_FILES['picture']) || $_FILES['picture']['error'] !== UPLOAD_ERR_OK) {
    die("Error: No file uploaded or upload failed.");
}

// Upload folder
$uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/roast-ms/uploads/";
$relativePath = "/roast-ms/uploads/";

if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

$fileTmpPath = $_FILES["picture"]["tmp_name"];
$fileName = basename($_FILES["picture"]["name"]);
$fileSize = $_FILES["picture"]["size"];

$allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
$allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
$extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

// Validate type and extension
if (!in_array($extension, $allowedExtensions) || !in_array(mime_content_type($fileTmpPath), $allowedTypes)) {
    die("Error: Invalid file type.");
}

// Validate size (max 2MB)
if ($fileSize > 2 * 1024 * 1024) {
    die("Error: File too large (max 2MB).");
}

// Generate unique filename
$newFileName = "profile_" . $user_id . "_" . time() . "." . $extension;
$absoluteDestination = $uploadDir . $newFileName;
$databasePath = $relativePath . $newFileName;

// Move uploaded file
if (!move_uploaded_file($fileTmpPath, $absoluteDestination)) {
    die("Error: Unable to save uploaded file.");
}

// Get old picture for audit
$query = $conn->prepare("SELECT picture FROM users WHERE user_id = ?");
$query->bind_param("s", $user_id);
$query->execute();
$result = $query->get_result()->fetch_assoc();
$oldPicture = $result['picture'] ?? null;

// Remove old file if not default
if ($oldPicture && $oldPicture !== '/roast-ms/assets/images/default-150x150.png') {
    $oldFile = $_SERVER['DOCUMENT_ROOT'] . $oldPicture;
    if (file_exists($oldFile)) unlink($oldFile);
}

// Update database
$update = $conn->prepare("UPDATE users SET picture = ? WHERE user_id = ?");
$update->bind_param("ss", $databasePath, $user_id);

if ($update->execute() && $update->affected_rows > 0) {
    $_SESSION['updatesuccess'] = "Profile picture updated successfully.";

    // --- Audit Trail ---
    $ip_address = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
    $action = 'Updated profile picture';
    $table_name = 'users';
    $record_id = $user_id;
    $old_value = $oldPicture ?? '';
    $new_value = $databasePath;

    $audit_stmt = $conn->prepare("
        INSERT INTO audit_trail (user_id, username, action, table_name, record_id, old_value, new_value, ip_address)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $audit_stmt->bind_param(
        "isssisss",
        $user_id,
        $username,
        $action,
        $table_name,
        $record_id,
        $old_value,
        $new_value,
        $ip_address
    );
    $audit_stmt->execute();
    $audit_stmt->close();

} else {
    $_SESSION['updatefailed'] = "Profile picture update failed.";
}

header("Location: /roast-ms/pages/barista/settings.php");
exit;
?>
