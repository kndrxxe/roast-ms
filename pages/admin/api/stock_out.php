<?php
require_once '../../../config.php';
session_start(); // make sure sessions are active

if (isset($_POST['item_id']) && isset($_POST['remove_qty'])) {
    $item_id = $_POST['item_id'];
    $remove_qty = (int)$_POST['remove_qty'];

    // Optional: Check current stock to avoid negative stock
    $stmt_check = $conn->prepare("SELECT quantity_in_stock FROM inventory WHERE item_id = ?");
    $stmt_check->bind_param("s", $item_id);
    $stmt_check->execute();
    $result = $stmt_check->get_result();
    $row = $result->fetch_assoc();
    $current_stock = $row['quantity_in_stock'] ?? 0;
    $stmt_check->close();

    if ($remove_qty > $current_stock) {
        $_SESSION['inventoryfailed'] = "❌ Cannot remove more than current stock ({$current_stock}) for item <strong>{$item_id}</strong>.";
    } else {
        $stmt = $conn->prepare("UPDATE inventory SET quantity_in_stock = quantity_in_stock - ? WHERE item_id = ?");
        $stmt->bind_param("is", $remove_qty, $item_id);

        if ($stmt->execute()) {
            $_SESSION['inventorysuccess'] = "✅ Stock successfully removed for item <strong>{$item_id}</strong>.";
        } else {
            $_SESSION['inventoryfailed'] = "❌ Failed to remove stock for item <strong>{$item_id}</strong>. Please try again or contact support.";
        }

        $stmt->close();
    }

    $conn->close();
    header("Location: /roast-ms/pages/admin/inventory.php");
    exit;
}
?>
