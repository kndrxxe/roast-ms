<?php
session_start();
require_once '../../../config.php';

// ✅ Ensure user ID is provided
if (!isset($_POST['user_id']) || empty($_POST['user_id'])) {
    die("Error: Missing user ID.");
}

$id = trim($_POST['user_id']); // UUID is a string

// ✅ Check if file is uploaded
if (!isset($_FILES['picture']) || $_FILES['picture']['error'] !== UPLOAD_ERR_OK) {
    die("Error: No file uploaded or upload failed.");
}

// ✅ Use absolute path for saving
$uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/roast-ms/uploads/";
$relativePath = "/roast-ms/uploads/";

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$fileName = basename($_FILES["picture"]["name"]);
$fileTmpPath = $_FILES["picture"]["tmp_name"];
$fileSize = $_FILES["picture"]["size"];
$fileType = mime_content_type($fileTmpPath);
$allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

// ✅ Validate image type
if (!in_array($fileType, $allowedTypes)) {
    die("Error: Only JPG, PNG, and WEBP images are allowed.");
}

// ✅ Validate size (max 2MB)
if ($fileSize > 2 * 1024 * 1024) {
    die("Error: File too large (max 2MB).");
}

// ✅ Generate unique filename
$extension = pathinfo($fileName, PATHINFO_EXTENSION);
$newFileName = "profile_" . $id . "_" . time() . "." . $extension;
$absoluteDestination = $uploadDir . $newFileName;
$databasePath = $relativePath . $newFileName;

// ✅ Move uploaded file
if (!move_uploaded_file($fileTmpPath, $absoluteDestination)) {
    die("Error: Unable to save uploaded file.");
}

// ✅ Get old picture from DB
$query = $conn->prepare("SELECT picture FROM users WHERE user_id = ?");
$query->bind_param("s", $id); // 's' = string for UUID
$query->execute();
$result = $query->get_result()->fetch_assoc();

if ($result && !empty($result['picture']) && $result['picture'] !== '/roast-ms/assets/images/default-150x150.png') {
    $oldFile = $_SERVER['DOCUMENT_ROOT'] . $result['picture'];
    if (file_exists($oldFile)) {
        unlink($oldFile);
    }
}

// ✅ Update new picture path in database
$update = $conn->prepare("UPDATE users SET picture = ? WHERE user_id = ?");
$update->bind_param("ss", $databasePath, $id);

if ($update->execute()) {
    if ($update->affected_rows === 0) {
        die("Update executed but no row matched the given ID. Check if \$id is correct.");
    }
    $_SESSION['updatesuccess'] = "Profile picture updated successfully.";
    header("Location: /roast-ms/pages/barista/settings.php");
} else {
    $_SESSION['updatefailed'] = "Profile picture update failed.";
    header("Location: /roast-ms/pages/barista/settings.php");
}

// ✅ Redirect back
header("Location: /roast-ms/pages/barista/settings.php");
exit;
?>
