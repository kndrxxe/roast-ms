<?php
require_once '../../../config.php';
session_start(); // make sure sessions are active

if (isset($_POST['item_id']) && isset($_POST['add_qty'])) {
    $item_id = $_POST['item_id'];
    $add_qty = (int)$_POST['add_qty'];

    $stmt = $conn->prepare("UPDATE inventory SET quantity_in_stock = quantity_in_stock + ? WHERE item_id = ?");
    $stmt->bind_param("is", $add_qty, $item_id);

    if ($stmt->execute()) {
        $_SESSION['inventorysuccess'] = "✅ Stock successfully updated for item <strong>{$item_id}</strong>.";
    } else {
        $_SESSION['inventoryfailed'] = "❌ Failed to update stock for item <strong>{$item_id}</strong>. Please try again or contact support.";
    }

    $stmt->close();
    $conn->close();

    header("Location: /roast-ms/pages/manager/inventory.php");
    exit;
}
?>
