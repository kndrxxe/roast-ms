<?php
session_start();
require_once '../../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sale_id   = $_POST['sale_id'] ?? null;
    $sale_date = $_POST['sale_date'] ?? date('Y-m-d');
    $shift     = $_POST['shift'] ?? '';
    $barista   = $_POST['barista'] ?? $_SESSION['name'] ?? 'Unknown';

    if (!$sale_id) {
        $_SESSION['salesfailed'] = "Missing sale ID.";
        header("Location: /roast-ms/pages/barista/salestracking.php");
        exit;
    }

    // Make sure we have arrays
    if (!isset($_POST['product_id'], $_POST['quantity'], $_POST['unit_price'])) {
        $_SESSION['salesfailed'] = "Missing sale item data.";
        header("Location: /roast-ms/pages/barista/salestracking.php");
        exit;
    }

    $total_quantity = array_sum($_POST['quantity']);
    $total_amount   = 0;

    $conn->begin_transaction();

    try {
        // 1. Update sales main record
        $stmt = $conn->prepare("
            UPDATE sales 
            SET sale_date=?, shift=?, barista=?, total_quantity=?, total_amount=? 
            WHERE id=?
        ");
        $stmt->bind_param("sssidi", $sale_date, $shift, $barista, $total_quantity, $total_amount, $sale_id);

        if (!$stmt->execute()) {
            throw new Exception("Failed to update sales record.");
        }
        $stmt->close();

        // 2. Delete old sale items
        $stmt = $conn->prepare("DELETE FROM sales_items WHERE sale_id=?");
        $stmt->bind_param("i", $sale_id);
        $stmt->execute();
        $stmt->close();

        // 3. Insert updated sale items
        foreach ($_POST['product_id'] as $i => $product_id) {
            $qty        = (int) $_POST['quantity'][$i];
            $unit_price = (float) $_POST['unit_price'][$i];
            $total      = $qty * $unit_price;
            $total_amount += $total;

            $stmt = $conn->prepare("
                INSERT INTO sales_items (sale_id, product_id, quantity, unit_price, total)
                VALUES (?,?,?,?,?)
            ");
            $stmt->bind_param("iiidd", $sale_id, $product_id, $qty, $unit_price, $total);

            if (!$stmt->execute()) {
                throw new Exception("Failed to insert updated sale item.");
            }
            $stmt->close();
        }

        // 4. Update total amount in sales after recalculation
        $stmt = $conn->prepare("UPDATE sales SET total_amount=? WHERE id=?");
        $stmt->bind_param("di", $total_amount, $sale_id);
        $stmt->execute();
        $stmt->close();

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
