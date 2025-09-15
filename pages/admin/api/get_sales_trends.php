<?php
session_start();
include "../../../config.php"; // adjust path if needed


$query = "
  SELECT 
    p.category,
    DATE_FORMAT(s.sales_date, '%Y-%m-%d') AS sale_day,
    SUM(si.quantity) AS total_qty
  FROM sales_items si
  JOIN products p ON si.product_id = p.id
  JOIN sales s ON si.sale_id = s.id
  GROUP BY p.category, DATE_FORMAT(s.sales_date, '%Y-%m-%d')
  ORDER BY sale_day ASC
";

$result = $conn->query($query);

$data = [];
if($result){
    while($row = $result->fetch_assoc()){
        $data[] = [
            'category' => $row['category'],
            'date' => $row['sale_day'],
            'total_qty' => (int)$row['total_qty']  // ensure numeric
        ];
    }
}
header('Content-Type: application/json');
echo json_encode($data);
?>