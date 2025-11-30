<?php
session_start();
require_once '../../../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $sale_id   = $_POST['sale_id'] ?? null;
    $sale_date = $_POST['sale_date'] ?? date('Y-m-d');
    $shift     = $_POST['shift'] ?? '';
    $barista   = $_POST['barista'] ?? $_SESSION['name'] ?? 'Unknown';

    $user_id   = $_SESSION['user_id'] ?? 0;
    $username  = $_SESSION['username'] ?? 'Unknown';
    $ip_address = $_SERVER['REMOTE_ADDR'];

    if (!$sale_id) {
        $_SESSION['salesfailed'] = "Missing sale ID.";
        header("Location: /roast-ms/pages/manager/salestracking.php");
        exit;
    }

    // Ensure arrays exist
    if (!isset($_POST['product_id'], $_POST['quantity'], $_POST['unit_price'])) {
        $_SESSION['salesfailed'] = "Missing sale item data.";
        header("Location: /roast-ms/pages/manager/salestracking.php");
        exit;
    }

    // -------------------------------------
    // FETCH OLD VALUE BEFORE UPDATING
    // -------------------------------------
    $old_stmt = $conn->prepare("SELECT * FROM sales WHERE id = ?");
    $old_stmt->bind_param("i", $sale_id);
    $old_stmt->execute();
    $old_value_result = $old_stmt->get_result()->fetch_assoc();
    $old_value_json = json_encode($old_value_result); 
    $old_stmt->close();


    $total_quantity = array_sum($_POST['quantity']);
    $total_amount   = 0;

    $conn->begin_transaction();

    try {

        // 1. Update sales main record
        $stmt = $conn->prepare("
            UPDATE sales 
            SET sale_date=?, shift=?, barista=?, total_quantity=?
            WHERE id=?
        ");
        $stmt->bind_param("sssdi", $sale_date, $shift, $barista, $total_quantity, $sale_id);

        if (!$stmt->execute()) {
            throw new Exception("Failed to update sales record.");
        }
        $stmt->close();

        // 2. Delete old sale items
        $stmt = $conn->prepare("DELETE FROM sales_items WHERE sale_id=?");
        $stmt->bind_param("i", $sale_id);
        $stmt->execute();
        $stmt->close();

        // 3. Insert new sale items
        $sale_items = [];

        foreach ($_POST['product_id'] as $i => $product_id) {
            $qty        = (int) $_POST['quantity'][$i];
            $unit_price = (float) $_POST['unit_price'][$i];
            $total      = $qty * $unit_price;

            $total_amount += $total;

            $sale_items[] = [
                "product_id" => $product_id,
                "qty" => $qty,
                "unit_price" => $unit_price,
                "total" => $total
            ];

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

        // 4. Update recalculated total amount
        $stmt = $conn->prepare("UPDATE sales SET total_amount=? WHERE id=?");
        $stmt->bind_param("di", $total_amount, $sale_id);
        $stmt->execute();
        $stmt->close();

        // -------------------------------------
        // PREPARE NEW VALUE JSON
        // -------------------------------------
        $new_value = [
            "sale_id" => $sale_id,
            "sale_date" => $sale_date,
            "shift" => $shift,
            "barista" => $barista,
            "total_quantity" => $total_quantity,
            "total_amount" => $total_amount,
            "items" => $sale_items
        ];
        $new_value_json = json_encode($new_value);


        // -------------------------------------
        // INSERT AUDIT TRAIL COMPLETE VERSION
        // -------------------------------------
        $action = "Updated sale record";
        $table_name = "sales";

        $audit = $conn->prepare("
            INSERT INTO audit_trail 
            (user_id, username, action, table_name, record_id, old_value, new_value, ip_address, timestamp)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ");
        $audit->bind_param(
            "isssisss",
            $user_id,
            $username,
            $action,
            $table_name,
            $sale_id,
            $old_value_json,
            $new_value_json,
            $ip_address
        );
        $audit->execute();
        $audit->close();


        $conn->commit();

        $_SESSION['salessuccess'] = "Sale has been successfully updated!";
        header("Location: /roast-ms/pages/manager/salestracking.php");
        exit;

    } catch (Exception $e) {

        $conn->rollback();

        // Log failed attempt
        $action = "Failed to update sale: " . $e->getMessage();
        $table_name = "sales";

        $audit = $conn->prepare("
            INSERT INTO audit_trail 
            (user_id, username, action, table_name, record_id, old_value, ip_address, timestamp)
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
        ");
        $audit->bind_param(
            "isssiss",
            $user_id,
            $username,
            $action,
            $table_name,
            $sale_id,
            $old_value_json,
            $ip_address
        );
        $audit->execute();
        $audit->close();

        $_SESSION['salesfailed'] = "Error: " . $e->getMessage();
        header("Location: /roast-ms/pages/manager/salestracking.php");
        exit;
    }
}
?>
