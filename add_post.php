<?php include 'db.php'; session_start(); ?>
<?php if (!isset($_SESSION['user'])) die("Login required"); ?>

<form method="POST">
  <input type="text" name="title" placeholder="Title" required><br>
  <textarea name="content" placeholder="Content" required></textarea><br>
  <button type="submit">Add Post</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = $_POST['title'];
  $content = $_POST['content'];

  $stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
  $stmt->execute([$title, $content]);

  echo "Post added. <a href='dashboard.php'>Back</a>";
}
?>
