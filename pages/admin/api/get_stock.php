<?php
require_once '../../../config.php';

if (isset($_GET['item_id'])) {
    $item_id = $_GET['item_id']; // no intval()

    $stmt = $conn->prepare("SELECT quantity_in_stock FROM inventory WHERE item_id = ?");
    $stmt->bind_param("s", $item_id); // 🔹 's' for string, not 'i'
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        echo json_encode(['stock' => $row['quantity_in_stock']]);
    } else {
        echo json_encode(['stock' => 0]);
    }

    $stmt->close();
    $conn->close();
}
?>
