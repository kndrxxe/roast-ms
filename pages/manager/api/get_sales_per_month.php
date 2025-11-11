<?php
session_start();
include "../../../config.php"; // DB connection

// Make sure $conn exists
if (!isset($conn)) {
    http_response_code(500);
    echo json_encode(["error" => "Database connection not found."]);
    exit;
}

// Query to get total sales per month
$sql = "SELECT YEAR(sale_date) AS year, 
               MONTH(sale_date) AS month, 
               IFNULL(SUM(total_amount), 0) AS total_sales
        FROM sales
        GROUP BY YEAR(sale_date), MONTH(sale_date)
        ORDER BY YEAR(sale_date), MONTH(sale_date)";

$result = $conn->query($sql);

if (!$result) {
    http_response_code(500);
    echo json_encode(["error" => "Query failed: " . $conn->error]);
    exit;
}

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [
        "year" => (int)$row['year'],
        "month" => (int)$row['month'],
        "total_sales" => (float)$row['total_sales']
    ];
}

header('Content-Type: application/json');
echo json_encode($data, JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);
exit;
?>
