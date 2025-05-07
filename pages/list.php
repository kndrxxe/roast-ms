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
  <a href="create.php" class="btn btn-success mb-3">Add Feedback</a>
  <table class="table table-bordered">
    <thead>
      <tr><th>Name</th><th>Email</th><th>Rating</th><th>Comments</th><th>Actions</th></tr>
    </thead>
    <tbody>
    <?php
      $result = $conn->query("SELECT * FROM feedback");
      while($row = $result->fetch_assoc()):
    ?>
      <tr>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= str_repeat('★', $row['rating']) ?></td>
        <td><?= htmlspecialchars($row['comments']) ?></td>
        <td>
          <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
          <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this feedback?');">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</body>
</html>
<?php include 'db.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $conn->prepare("INSERT INTO feedback (name, email, rating, comments) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $_POST['name'], $_POST['email'], $_POST['rating'], $_POST['comments']);
    $stmt->execute();
    header("Location: index.php");
    exit();
}
?>