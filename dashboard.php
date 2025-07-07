<?php include 'db.php'; session_start(); ?>
<?php if (!isset($_SESSION['user'])) die("Login required"); ?>

<h2>Welcome, <?= $_SESSION['user']['username'] ?></h2>
<a href="add_post.php">Add Post</a> | <a href="logout.php">Logout</a>

<?php
$posts = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
foreach ($posts as $post) {
  echo "<h3>{$post['title']}</h3>";
  echo "<p>{$post['content']}</p>";
  echo "<small>{$post['created_at']}</small><hr>";
}
?>
<a href="delete_post.php?id=<?= $post['id'] ?>" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
