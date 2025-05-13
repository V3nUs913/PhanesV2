<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
if (isset($_SESSION['user_id'])) {
    echo "Welcome, " . htmlspecialchars($_SESSION['username']);
}


$user_id = $_SESSION['user_id'];
$query = mysqli_query($conn, "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Orders - Phanes</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f0f4ff;
      margin: 0;
    }

    .navbar {
      background-color: #93c5fd;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .navbar h2 {
      color: white;
      margin: 0;
    }

    .navbar a {
      color: white;
      text-decoration: none;
      font-weight: bold;
      margin-left: 20px;
    }

    .container {
      padding: 40px;
    }

    h3 {
      color: #3b82f6;
      margin-bottom: 20px;
    }

    .order-card {
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      padding: 20px;
      margin-bottom: 20px;
    }

    .order-card h4 {
      margin: 0;
      color: #2563eb;
    }

    .order-card p {
      margin-top: 8px;
    }

    .order-card small {
      color: #666;
    }
  </style>
</head>
<body>

  <div class="navbar">
    <h2>Phanes</h2>
    <div>
      <a href="dashboard.php">Dashboard</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>

  <div class="container">
    <h3>My Orders</h3>

    <?php if (mysqli_num_rows($query) > 0): ?>
      <?php while ($order = mysqli_fetch_assoc($query)): ?>
        <div class="order-card">
          <h4><?= htmlspecialchars($order['name']) ?></h4>
          <h4><?= nl2br(htmlspecialchars($order['email'])) ?></h4>
          <p><?= nl2br(htmlspecialchars($order['description'])) ?></p>
          <small>Ordered on: <?= date('d M Y, H:i', strtotime($order['created_at'])) ?></small>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p>You have no orders yet.</p>
    <?php endif; ?>
  </div>

</body>
</html>