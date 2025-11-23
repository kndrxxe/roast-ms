<?php
session_start();
require_once '../../../config.php';

// ✅ Always set timezone
date_default_timezone_set('Asia/Manila');

// Audit log function
function log_audit($conn, $user_id, $username, $action, $table_name = null, $record_id = null, $old_value = null, $new_value = null) {
    $ip_address = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
    $stmt = $conn->prepare("
        INSERT INTO audit_trail (user_id, username, action, table_name, record_id, old_value, new_value, ip_address)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("isssisss", $user_id, $username, $action, $table_name, $record_id, $old_value, $new_value, $ip_address);
    $stmt->execute();
    $stmt->close();
}

$user_id = $_SESSION['uid'] ?? null;
$name    = $_SESSION['name'] ?? 'Unknown';

if (!$user_id) {
    die("Please log in first.");
}

// --- CLOCK IN ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['time_in'])) {
    // Check if already clocked in today
    $check_query = "SELECT id FROM dtr_logs WHERE user_id = ? AND date = CURDATE() AND time_in IS NOT NULL";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("i", $user_id);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $_SESSION['timed_in'] = "You have already clocked in today.";
    } else {
        $time_in = date('Y-m-d H:i:s');
        $today   = date('Y-m-d');

        $insert_query = "INSERT INTO dtr_logs (user_id, name, time_in, date) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("isss", $user_id, $name, $time_in, $today);
        $stmt->execute();
        $inserted_id = $stmt->insert_id;
        $stmt->close();

        // --- Audit log ---
        log_audit($conn, $user_id, $name, "Clocked in", "dtr_logs", $inserted_id, null, $time_in);

        $_SESSION['timed_in'] = "Time in successfully.";
    }

    $check_stmt->close();
    header("Location: /roast-ms/pages/barista/dtr.php");
    exit;
}

// --- CLOCK OUT ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['time_out'])) {
    $current_time = date('Y-m-d H:i:s');

    // Get last clock-in record without time_out
    $query = "SELECT * FROM dtr_logs WHERE user_id = ? AND time_out IS NULL ORDER BY time_in DESC LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $clock_in = new DateTime($row['time_in']);
        $clock_out = new DateTime($current_time);

        $interval = $clock_in->diff($clock_out);
        $total_hours = $interval->h + ($interval->i / 60) + ($interval->s / 3600);

        $update_query = "UPDATE dtr_logs SET time_out = ?, total_hours = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("sdi", $current_time, $total_hours, $row['id']);
        $update_stmt->execute();
        $update_stmt->close();

        // --- Audit log ---
        log_audit($conn, $user_id, $name, "Clocked out", "dtr_logs", $row['id'], $row['time_in'], $current_time);

        $_SESSION['timed_out'] = "Time out successfully.";
    } else {
        $_SESSION['time_error'] = "No clock-in record found.";
    }

    $stmt->close();
    header("Location: /roast-ms/pages/barista/dtr.php");
    exit;
}
?>
