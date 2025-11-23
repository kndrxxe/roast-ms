<?php
session_start();
require_once '../../../config.php';

// Audit log function
function log_audit($conn, $user_id, $username, $action, $table_name = null, $record_id = null, $old_value = null, $new_value = null) {
    $ip_address = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
    $stmt = $conn->prepare("
        INSERT INTO audit_trail (user_id, username, action, table_name, record_id, old_value, new_value, ip_address)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("isssisss", $user_id, $username, $action, $table_name, $record_id, $old_value, $new_value, $ip_address);
    $stmt->execute();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sale_id   = $_POST['sale_id'] ?? null;
    $sale_date = $_POST['sale_date'] ?? date('Y-m-d');
    $shift     = $_POST['shift'] ?? '';
    $barista   = $_POST['barista'] ?? $_SESSION['name'] ?? 'Unknown';
    $user_id   = $_SESSION['user_id'] ?? null;

    if (!$sale_id) {
        $_SESSION['salesfailed'] = "Missing sale ID.";
        header("Location: /roast-ms/pages/barista/salestracking.php");
        exit;
    }

    if (!isset($_POST['product_id'], $_POST['quantity'], $_POST['unit_price'])) {
        $_SESSION['salesfailed'] = "Missing sale item data.";
        header("Location: /roast-ms/pages/barista/salestracking.php");
        exit;
    }

    $total_quantity = array_sum($_POST['quantity']);
    $total_amount   = 0;

    $conn->begin_transaction();

    try {
        // --- 0. Get old sale and items for audit ---
        $oldSale = $conn->query("SELECT * FROM sales WHERE id=$sale_id")->fetch_assoc();
        $oldItems = [];
        $res = $conn->query("SELECT * FROM sales_items WHERE sale_id=$sale_id");
        while ($row = $res->fetch_assoc()) {
            $oldItems[] = $row;
        }
        $old_value = json_encode(['sale'=>$oldSale,'items'=>$oldItems]);

        // --- 1. Update sales main record ---
        $stmt = $conn->prepare("
            UPDATE sales 
            SET sale_date=?, shift=?, barista=?, total_quantity=?, total_amount=? 
            WHERE id=?
        ");
        $stmt->bind_param("sssidi", $sale_date, $shift, $barista, $total_quantity, $total_amount, $sale_id);
        if (!$stmt->execute()) throw new Exception("Failed to update sales record.");
        $stmt->close();

        // --- 2. Delete old sale items ---
        $stmt = $conn->prepare("DELETE FROM sales_items WHERE sale_id=?");
        $stmt->bind_param("i", $sale_id);
        $stmt->execute();
        $stmt->close();

        // --- 3. Insert updated sale items ---
        $newItems = [];
        foreach ($_POST['product_id'] as $i => $product_id) {
            $qty        = (int)$_POST['quantity'][$i];
            $unit_price = (float)$_POST['unit_price'][$i];
            $total      = $qty * $unit_price;
            $total_amount += $total;

            $stmt = $conn->prepare("
                INSERT INTO sales_items (sale_id, product_id, quantity, unit_price, total)
                VALUES (?,?,?,?,?)
            ");
            $stmt->bind_param("iiidd", $sale_id, $product_id, $qty, $unit_price, $total);
            if (!$stmt->execute()) throw new Exception("Failed to insert updated sale item.");
            $stmt->close();

            $newItems[] = ['product_id'=>$product_id,'quantity'=>$qty,'unit_price'=>$unit_price,'total'=>$total];
        }

        // --- 4. Update total amount ---
        $stmt = $conn->prepare("UPDATE sales SET total_amount=? WHERE id=?");
        $stmt->bind_param("di", $total_amount, $sale_id);
        $stmt->execute();
        $stmt->close();

        // --- 5. Log audit ---
        $new_value = json_encode(['sale'=>['sale_date'=>$sale_date,'shift'=>$shift,'barista'=>$barista,'total_quantity'=>$total_quantity,'total_amount'=>$total_amount],'items'=>$newItems]);
        log_audit($conn, $user_id, $barista, "Updated sale #$sale_id", "sales & sales_items", $sale_id, $old_value, $new_value);

        $conn->commit();

        $_SESSION['salessuccess'] = "Sale has been successfully updated!";
        header("Location: /roast-ms/pages/barista/salestracking.php");
        exit;

    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['salesfailed'] = "Error: " . $e->getMessage();
        header("Location: /roast-ms/pages/barista/salestracking.php");
        exit;
    }
}
?>
