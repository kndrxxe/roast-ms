<?php
session_start();
include "../../../config.php"; // db connection
header('Content-Type: application/json');

$sql = "SELECT p.id, p.name, p.size, SUM(si.quantity) AS total_quantity
        FROM sales_items si
        INNER JOIN products p ON si.product_id = p.id
        GROUP BY p.id, p.name, p.size
        ORDER BY total_quantity DESC";

$result = $conn->query($sql);

$data = ["labels" => [], "series" => []];

while ($row = $result->fetch_assoc()) {
    $data["labels"][] = $row["name"] . " (" . $row["size"] . ")";
    $data["series"][] = (int) $row["total_quantity"];
}

header('Content-Type: application/json');
echo json_encode($data);
?>