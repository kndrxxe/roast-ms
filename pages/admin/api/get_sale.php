<?php
session_start();
require_once '../../../config.php';
header('Content-Type: application/json');

if (isset($_GET['sale_id'])) {
    $sale_id = intval($_GET['sale_id']);

    $query = "
        SELECT si.id, si.sale_id, si.product_id, si.quantity, si.unit_price, si.total,
               p.name AS product, p.size
        FROM sales_items si
        JOIN products p ON si.product_id = p.id
        WHERE si.sale_id = ?
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $sale_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }

    echo json_encode($items);
    exit;
}

echo json_encode([]);
?>