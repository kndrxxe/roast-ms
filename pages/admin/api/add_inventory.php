<?php
session_start();
require_once '../../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $item_id        = trim($_POST['item_id']);
    $product_name   = trim($_POST['product_name']);
    $category       = trim($_POST['category']);
    $supplier       = trim($_POST['supplier']);
    $quantity       = floatval($_POST['quantity']);
    $unit           = trim($_POST['unit']);
    $cost_price     = floatval($_POST['cost_price']);
    $selling_price  = floatval($_POST['selling_price']);
    $reorder_level  = intval($_POST['reorder_level']);

    // Auto-calculate stock value
    $stock_value = $quantity * $cost_price;

    // Determine item status automatically
    if ($quantity <= 0) {
        $status = 'Out of Stock';
    } elseif ($quantity <= $reorder_level) {
        $status = 'Low Stock';
    } else {
        $status = 'Available';
    }

    // Timestamp
    $last_updated = date('Y-m-d H:i:s');

    // Prepare insert statement
    $stmt = $conn->prepare("
        INSERT INTO inventory (
            item_id, product_name, category, supplier, 
            quantity_in_stock, unit_of_measure, cost_price, 
            selling_price, stock_value, reorder_level, 
            status, last_updated
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    if (!$stmt) {
        error_log("Database prepare failed: " . $conn->error);
        $_SESSION['error'] = "❌ Unable to add item. Please try again later.";
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

    // Execute and handle result
    if ($stmt->execute()) {
        $_SESSION['salessuccess'] = "✅ <strong>{$product_name}</strong> was successfully added to the inventory.";
    } else {
        error_log("Error adding item ({$item_id}): " . $stmt->error);
        $_SESSION['error'] = "❌ Could not add <strong>{$product_name}</strong>. Please check for duplicate IDs or database issues.";
    }

    $stmt->close();
    $conn->close();

    header("Location: /roast-ms/pages/admin/salestracking.php");
    exit;
}
?>
