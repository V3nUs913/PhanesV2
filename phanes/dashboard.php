<?php
session_start();
include 'config.php';

// Cek apakah user sudah login, jika tidak redirect ke login.php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Siapkan prepared statement untuk menghindari SQL Injection
$stmt = $conn->prepare("SELECT fullname FROM users WHERE id = ?");
if (!$stmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Cek apakah user ditemukan
if ($result->num_rows === 0) {
    // Jika user tidak ditemukan, hapus session dan redirect ke login
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

$user = $result->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>User Dashboard - Phanes</title>
  <!-- Load Font Awesome untuk ikon sosial media -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #f0f4ff;
      color: #333;
    }
    .navbar {
      background-color:rgb(10, 104, 255);
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
      padding: 60px 40px;
      text-align: center;
    }
    .welcome {
      font-size: 1.8em;
      color: #3b82f6;
    }
    .actions {
      margin-top: 40px;
    }
    .actions a {
      display: inline-block;
      margin: 10px;
      padding: 14px 28px;
      background-color: #3b82f6;
      color: white;
      border-radius: 12px;
      text-decoration: none;
      font-weight: bold;
      transition: 0.3s;
    }
    .actions a:hover {
      background-color: #2563eb;
    }
    /* CSS untuk ikon sosial media kanan tengah */
    .social-icons {
      position: fixed;
      top: 50%;
      right: 24px;
      transform: translateY(-50%);
      display: flex;
      flex-direction: column;
      gap: 18px;
      z-index: 1000;
    }
    .social-icons a {
      color: #fff;
      background: #3b82f6;
      border-radius: 50%;
      width: 42px;
      height: 42px;
      display: flex;
      align-items: center;
      justify-content: center;
      text-decoration: none;
      font-size: 22px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.13);
      transition: background 0.2s, color 0.2s;
    }
    .social-icons a:hover {
      background: #fff;
      color: #3b82f6;
      border: 1px solid #3b82f6;
    }
  </style>
</head>
<body>

  <div class="navbar">
    <h2>Phanes</h2>
    <div>
      <a href="index.php">Home</a>
      <a href="services.php">Services</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>

  <div class="container">
    <p class="welcome">Welcome, <?php echo htmlspecialchars($user['fullname'], ENT_QUOTES, 'UTF-8'); ?>!</p>
    <p>What would you like to do today?</p>

    <div class="actions">
      <a href="order.php">Create a New Order</a>
      <a href="my_order.php">View My Orders</a>
    </div>
  </div>

  <div class="social-icons">
    <a href="https://www.instagram.com/phanescr3tive/" target="_blank" title="Instagram" rel="noopener noreferrer">
      <i class="fab fa-instagram"></i>
    </a>
    <a href="mailto:phanescreative@gmail.com" title="Email">
      <i class="fas fa-envelope"></i>
    </a>
    <a href="https://www.linkedin.com/in/phanes-creative-960269361/" target="_blank" title="LinkedIn" rel="noopener noreferrer">
      <i class="fab fa-linkedin"></i>
    </a>
  </div>

</body>
</html>
