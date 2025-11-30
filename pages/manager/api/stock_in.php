<?php
require_once '../../../config.php';
session_start(); // make sure sessions are active

if (isset($_POST['item_id']) && isset($_POST['add_qty'])) {

    $item_id = $_POST['item_id'];
    $add_qty = (int)$_POST['add_qty'];

    $username = $_SESSION['name'] ?? 'Unknown';
    $user_id  = $_SESSION['uid'] ?? 0;
    $ip       = $_SERVER['REMOTE_ADDR'];

    // 🔍 Get OLD quantity before updating
    $get_old = $conn->prepare("SELECT quantity_in_stock FROM inventory WHERE item_id = ?");
    $get_old->bind_param("s", $item_id);
    $get_old->execute();
    $old_row = $get_old->get_result()->fetch_assoc();
    $old_qty = $old_row['quantity_in_stock'] ?? 0;
    $get_old->close();

    // 🟢 Update stock
    $stmt = $conn->prepare("UPDATE inventory SET quantity_in_stock = quantity_in_stock + ? WHERE item_id = ?");
    $stmt->bind_param("is", $add_qty, $item_id);

    if ($stmt->execute()) {

        // 🔍 Calculate new quantity for audit
        $new_qty = $old_qty + $add_qty;

        // 📝 Insert into audit trail
        $audit = $conn->prepare("
            INSERT INTO audit_trail 
            (user_id, username, action, table_name, record_id, old_value, new_value, ip_address) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $action     = "Stock-In";
        $table_name = "inventory";
        $record_id  = $item_id;
        $old_value  = "Old Quantity: $old_qty";
        $new_value  = "New Quantity: $new_qty";

        $audit->bind_param(
            "isssisss",
            $user_id,
            $username,
            $action,
            $table_name,
            $record_id,
            $old_value,
            $new_value,
            $ip
        );

        $audit->execute();
        $audit->close();

        $_SESSION['inventorysuccess'] = "✅ Stock successfully updated for item <strong>{$item_id}</strong>.";
    } 
    else {
        $_SESSION['inventoryfailed'] = "❌ Failed to update stock for item <strong>{$item_id}</strong>.";
    }

    $stmt->close();
    $conn->close();

    header("Location: /roast-ms/pages/manager/inventory.php");
    exit;
}
?>