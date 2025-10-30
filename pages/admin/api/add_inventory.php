<?php
session_start();
require_once '../../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $item_id        = trim($_POST['item_id']);
    $product_name   = trim($_POST['product_name']);
    $category       = trim($_POST['category']);
    $supplier       = trim($_POST['supplier']);
    $quantity       = floatval($_POST['quantity']);
    $unit           = trim($_POST['unit']);
    $cost_price     = floatval($_POST['cost_price']);
    $selling_price  = floatval($_POST['selling_price']);
    $reorder_level  = intval($_POST['reorder_level']);
    $status         = trim($_POST['status']);
    
    // Automatically set last_updated
    $last_updated   = date('Y-m-d H:i:s');

    // Calculate stock value
    $stock_value = $quantity * $cost_price;

    // Prepare query
    $stmt = $conn->prepare("
        INSERT INTO inventory 
        (item_id, product_name, category, supplier, quantity_in_stock, unit_of_measure, cost_price, selling_price, stock_value, reorder_level, status, last_updated)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    if ($stmt === false) {
        $_SESSION['error'] = "Database prepare failed: " . $conn->error;
        header("Location: /roast-ms/pages/admin/salestracking.php");
        exit;
    }

    $stmt->bind_param(
        "ssssisdddiss",
        $item_id,
        $product_name,
        $category,
        $supplier,
        $quantity,
        $unit,
        $cost_price,
        $selling_price,
        $stock_value,
        $reorder_level,
        $status,
        $last_updated
    );

    // Execute and handle response
    if ($stmt->execute()) {
        $_SESSION['salessuccess'] = "New item successfully added!";
    } else {
        $_SESSION['error'] = "Error adding item: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

    header("Location: /roast-ms/pages/admin/salestracking.php");
    exit;
}
?>
