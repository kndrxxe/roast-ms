<?php
session_start();
require_once '../../../config.php';

$user_id = $_SESSION['uid'] ?? null;

if (!$user_id) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

// Fetch today's attendance status
$attendance_query = "SELECT COUNT(*) AS attendance_count FROM dtr_logs WHERE user_id = ? AND date = CURDATE()";
$stmt = $conn->prepare($attendance_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$attendance_result = $stmt->get_result()->fetch_assoc();
$attendance_status = $attendance_result['attendance_count'] > 0 ? 'Present' : 'Absent';
$stmt->close();

// Fetch total hours for the current week
$week_query = "SELECT SUM(total_hours) AS total_hours FROM dtr_logs WHERE user_id = ? AND WEEK(date) = WEEK(CURDATE())";
$stmt = $conn->prepare($week_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$week_result = $stmt->get_result()->fetch_assoc();
$total_hours_week = $week_result['total_hours'] ?? 0;
$stmt->close();

// Fetch shifts completed for the current month
$month_query = "SELECT COUNT(*) AS shifts_completed FROM dtr_logs WHERE user_id = ? AND MONTH(date) = MONTH(CURDATE())";
$stmt = $conn->prepare($month_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$month_result = $stmt->get_result()->fetch_assoc();
$shifts_completed = $month_result['shifts_completed'] ?? 0;
$stmt->close();

// Return data as JSON
echo json_encode([
    'attendance_status' => $attendance_status,
    'total_hours_week' => $total_hours_week,
    'shifts_completed' => $shifts_completed,
]);
?>