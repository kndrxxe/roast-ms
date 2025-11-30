<?php
require_once '../../../config.php';
session_start(); // ensure session is active

if (isset($_POST['item_id']) && isset($_POST['remove_qty'])) {
    $item_id = $_POST['item_id'];
    $remove_qty = (int)$_POST['remove_qty'];
    $user_id = $_SESSION['user_id']; // who performed the action

    // 1️⃣ Check current stock
    $stmt_check = $conn->prepare("SELECT quantity_in_stock FROM inventory WHERE item_id = ?");
    $stmt_check->bind_param("s", $item_id);
    $stmt_check->execute();
    $result = $stmt_check->get_result();
    $row = $result->fetch_assoc();
    $current_stock = $row['quantity_in_stock'] ?? 0;
    $stmt_check->close();

    if ($remove_qty > $current_stock) {

        $_SESSION['inventoryfailed'] = "❌ Cannot remove more than current stock ({$current_stock}) for item <strong>{$item_id}</strong>.";

        // ❗ Log failed attempt
        $action = "Attempted stock-out {$remove_qty} but failed (Insufficient stock)";
        $stmt_log = $conn->prepare("
            INSERT INTO audit_trail (user_id, action, item_id, quantity, timestamp)
            VALUES (?, ?, ?, ?, NOW())
        ");
        $stmt_log->bind_param("issi", $user_id, $action, $item_id, $remove_qty);
        $stmt_log->execute();
        $stmt_log->close();

    } else {

        // 2️⃣ Update inventory
        $stmt = $conn->prepare("UPDATE inventory SET quantity_in_stock = quantity_in_stock - ? WHERE item_id = ?");
        $stmt->bind_param("is", $remove_qty, $item_id);

        if ($stmt->execute()) {

            $_SESSION['inventorysuccess'] = "✅ Stock successfully removed for item <strong>{$item_id}</strong>.";

            // 3️⃣ Insert into audit trail
            $action = "Removed stock (Stock Out)";
            $stmt_log = $conn->prepare("
                INSERT INTO audit_trail (user_id, action, item_id, quantity, timestamp)
                VALUES (?, ?, ?, ?, NOW())
            ");
            $stmt_log->bind_param("issi", $user_id, $action, $item_id, $remove_qty);
            $stmt_log->execute();
            $stmt_log->close();

        } else {

            $_SESSION['inventoryfailed'] = "❌ Failed to remove stock for item <strong>{$item_id}</strong>.";

            // ❗ Log failed attempt
            $action = "Failed stock-out action due to system error";
            $stmt_log = $conn->prepare("
                INSERT INTO audit_trail (user_id, action, item_id, quantity, timestamp)
                VALUES (?, ?, ?, ?, NOW())
            ");
            $stmt_log->bind_param("issi", $user_id, $action, $item_id, $remove_qty);
            $stmt_log->execute();
            $stmt_log->close();
        }

        $stmt->close();
    }

    $conn->close();
    header("Location: /roast-ms/pages/manager/inventory.php");
    exit;
}
?>
