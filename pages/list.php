<?php
session_start();
require_once "../config.php"; // Secure database connection
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Feedback List | ROAST-MS</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">
  <h2>Feedback Entries</h2>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Rating</th>
        <th>Comments</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $result = $conn->query("SELECT * FROM feedback");
      while ($row = $result->fetch_assoc()):
        ?>
        <tr>
          <td><?= htmlspecialchars($row['name']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= str_repeat('★', $row['rating']) ?></td>
          <td><?= htmlspecialchars($row['comment']) ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</body>

</html>