<?php
session_start();
require_once '../../../config.php';

$user_id = $_SESSION['uid'] ?? null;

if (!$user_id) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

// Fetch attendance data for the past 7 days
$query = "
    SELECT 
        date, 
        COUNT(time_in) AS present 
    FROM 
        dtr_logs 
    WHERE 
        user_id = ? 
        AND date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) 
    GROUP BY 
        date
    ORDER BY 
        date ASC
";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$dates = [];
$attendance = [];

while ($row = $result->fetch_assoc()) {
    $dates[] = $row['date'];
    $attendance[] = $row['present'] > 0 ? 1 : 0; // 1 for Present, 0 for Absent
}

$stmt->close();

// Return data as JSON
echo json_encode([
    'dates' => $dates,
    'attendance' => $attendance,
]);
?>