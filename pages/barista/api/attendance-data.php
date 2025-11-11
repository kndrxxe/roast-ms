<?php
session_start();
require_once '../../../config.php';

$user_id = $_SESSION['uid'] ?? null;

if (!$user_id) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

// Fetch number of present days per month
$query = "
    SELECT 
        DATE_FORMAT(date, '%Y-%m') AS month,
        COUNT(*) AS present_days
    FROM dtr_logs
    WHERE user_id = ?
    GROUP BY month
    ORDER BY month ASC
";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$months = [];
$present_days = [];
$absent_days = [];

while ($row = $result->fetch_assoc()) {
    $months[] = date('F Y', strtotime($row['month'] . '-01'));
    $present_days[] = (int)$row['present_days'];

    $year_month = $row['month'] . '-01';
    $total_days = (int)date('t', strtotime($year_month));

    $absent = $total_days - (int)$row['present_days'];
    $absent_days[] = $absent > 0 ? $absent : null; // only show if absent
}


$stmt->close();

// Return JSON
echo json_encode([
    'months' => $months,
    'present_days' => $present_days,
    'absent_days' => $absent_days
]);
?>
