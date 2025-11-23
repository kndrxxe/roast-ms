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
    $sale_date = $_POST['sale_date'] ?? date('Y-m-d');
    $shift     = $_POST['shift'] ?? '';
    $barista   = $_POST['barista'] ?? $_SESSION['name'] ?? 'Unknown';
    $user_id   = $_SESSION['user_id'] ?? null;

    if (!isset($_POST['product_id'], $_POST['quantity'], $_POST['unit_price'])) {
        $_SESSION['salesfailed'] = "Missing sales item data!";
        header("Location: /roast-ms/pages/barista/salestracking.php");
        exit;
    }

    $total_quantity = array_sum($_POST['quantity']);
    $total_amount   = 0;

    $conn->begin_transaction();

    try {
        // --- 1. Insert into sales ---
        $stmt = $conn->prepare("
            INSERT INTO sales (sale_date, shift, barista, total_quantity, total_amount) 
            VALUES (?,?,?,?,?)
        ");
        $stmt->bind_param("sssid", $sale_date, $shift, $barista, $total_quantity, $total_amount);

        if (!$stmt->execute()) {
            throw new Exception("Failed to insert sales record.");
        }

        $sale_id = $stmt->insert_id;
        $stmt->close();

        // --- 2. Insert sale items ---
        $items_array = [];
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
            if (!$stmt->execute()) {
                throw new Exception("Failed to insert sales item.");
            }
            $stmt->close();

            $items_array[] = [
                'product_id' => $product_id,
                'quantity'   => $qty,
                'unit_price' => $unit_price,
                'total'      => $total
            ];
        }

        // --- 3. Update total amount in sales ---
        $stmt = $conn->prepare("UPDATE sales SET total_amount=? WHERE id=?");
        $stmt->bind_param("di", $total_amount, $sale_id);
        if (!$stmt->execute()) {
            throw new Exception("Failed to update sales total.");
        }
        $stmt->close();

        // --- 4. Log audit trail ---
        $new_value = json_encode([
            'sale'  => ['sale_date'=>$sale_date,'shift'=>$shift,'barista'=>$barista,'total_quantity'=>$total_quantity,'total_amount'=>$total_amount],
            'items' => $items_array
        ]);
        log_audit($conn, $user_id, $barista, "Created sale #$sale_id", "sales & sales_items", $sale_id, null, $new_value);

        $conn->commit();

        $_SESSION['salessuccess'] = "Sale has been successfully recorded!";
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