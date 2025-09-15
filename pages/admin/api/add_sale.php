<?php
session_start();
require_once '../../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $sale_date = $_POST['sale_date'] ?? date('Y-m-d');
    $shift = $_POST['shift'] ?? '';
    $barista = $_POST['barista'] ?? $_SESSION['name'] ?? 'Unknown';

    // Validate that product_id and quantity exist
    if (!isset($_POST['product_id'], $_POST['quantity'], $_POST['unit_price'])) {
        $_SESSION['salesfailed'] = "Missing sales item data!";
        header("Location: /roast-ms/pages/admin/salestracking.php");
        exit;
    }

    $total_quantity = array_sum($_POST['quantity']);
    $total_amount = 0;

    $conn->begin_transaction();

    try {
        // Insert into sales
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

        // Insert sale items
        foreach ($_POST['product_id'] as $i => $product_id) {
            $qty = (int)$_POST['quantity'][$i];
            $unit_price = (float)$_POST['unit_price'][$i];
            $total = $qty * $unit_price;
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
        }

        // Update total amount in sales table
        $stmt = $conn->prepare("UPDATE sales SET total_amount=? WHERE id=?");
        $stmt->bind_param("di", $total_amount, $sale_id);

        if (!$stmt->execute()) {
            throw new Exception("Failed to update sales total.");
        }
        $stmt->close();

        $conn->commit();

        $_SESSION['salessuccess'] = "Sale has been successfully recorded!";
        header("Location: /roast-ms/pages/admin/salestracking.php");
        exit;

    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['salesfailed'] = "Error: " . $e->getMessage();
        header("Location: /roast-ms/pages/admin/salestracking.php");
        exit;
    }
}
?>