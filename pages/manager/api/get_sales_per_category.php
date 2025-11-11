<?php
session_start();
include "../../../config.php"; // db connection

$sql = "SELECT p.category, SUM(si.quantity) AS total_quantity
        FROM sales_items si
        INNER JOIN products p ON si.product_id = p.id
        GROUP BY p.category
        ORDER BY total_quantity DESC";

$result = $conn->query($sql);

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = [
        "x" => $row["category"],
        "y" => (int)$row["total_quantity"] // ✅ cast as integer
    ];
}

header('Content-Type: application/json');
echo json_encode($data, JSON_NUMERIC_CHECK); // ✅ force numeric values

?>