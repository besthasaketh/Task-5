<?php
session_start();

// ✅ Session check
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

include 'db.php';

// ✅ Get post ID from URL
$id = $_GET['id'] ?? null;

if (!$id) {
    echo "⚠️ No post ID provided in URL.<br>";
    echo "<a href='dashboard.php'>Back to Dashboard</a>";
    exit;
}

// ✅ Try deleting
try {
    $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->execute([$id]);

    // 🧪 Debug output
    echo "✅ Deleted post with ID: $id<br>";
    echo "<a href='dashboard.php'>Back to Dashboard</a>";
} catch (PDOException $e) {
    echo "❌ Error deleting post: " . $e->getMessage();
}
?>
