<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
include 'db.php';

// Get post ID from URL
$id = $_GET['id'] ?? null;
if (!$id) {
    die("Invalid request.");
}

// Fetch existing post
$stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();

if (!$post) {
    die("Post not found.");
}

// Handle form submission
if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    $stmt->execute([$title, $content, $id]);

    echo "<p>Post updated successfully. <a href='dashboard.php'>Back to Dashboard</a></p>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Post</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h2>Edit Post</h2>
  <form method="POST">
    <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required><br>
    <textarea name="content" rows="5" required><?= htmlspecialchars($post['content']) ?></textarea><br>
    <button type="submit" name="update">Update Post</button>
  </form>

  <br><a href="dashboard.php">Back to Dashboard</a>
</body>
</html>
