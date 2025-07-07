<?php include 'db.php'; session_start(); ?>
<form method="POST">
  <input type="text" name="username" required placeholder="Username"><br>
  <input type="password" name="password" required placeholder="Password"><br>
  <button type="submit">Login</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->execute([$username]);
  $user = $stmt->fetch();

  if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user'] = $user;
    header('Location: dashboard.php');
  } else {
    echo "Invalid credentials!";
  }
}
?>
