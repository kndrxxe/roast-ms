<?php
require_once '../../database/config.php';

$query = "SELECT role_name FROM roles";
$result = $conn->query($query);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row['role_name'];
}

echo json_encode($data); // Convert data to JSON format
?>