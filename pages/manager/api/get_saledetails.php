<?php
session_start();
require_once '../../../config.php';
header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $sale_id = intval($_GET['id']);

    // Get sale main info
    $stmt = $conn->prepare("SELECT * FROM sales WHERE id=?");
    $stmt->bind_param("i", $sale_id);
    $stmt->execute();
    $sale = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    // Get sale items
    $stmt = $conn->prepare("
        SELECT si.id, si.product_id, si.quantity, si.unit_price, si.total,
               p.name, p.size
        FROM sales_items si
        JOIN products p ON si.product_id=p.id
        WHERE si.sale_id=?
    ");
    $stmt->bind_param("i", $sale_id);
    $stmt->execute();
    $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    echo json_encode([
        "sale" => $sale,
        "items" => $items
    ]);
}
?>