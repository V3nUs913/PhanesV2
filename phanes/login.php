<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email    = $_POST['email'];
  $password = $_POST['password'];

  // Cari user berdasarkan email
  $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
  $user = mysqli_fetch_assoc($query);

  if ($user) {
    // Verifikasi password
    if (password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['fullname'] = $user['fullname'];
      echo "<script>alert('Login berhasil!'); window.location='dashboard.php';</script>";
      exit();
    } else {
      echo "<script>alert('Password salah!');</script>";
    }
  } else {
    echo "<script>alert('Email tidak ditemukan!');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Phanes</title>
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #f0f4ff;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-box {
      background-color: white;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      width: 400px;
    }

    h2 {
      text-align: center;
      color: #3b82f6;
      margin-bottom: 30px;
    }

    label {
      font-weight: 600;
      display: block;
      margin-top: 20px;
    }

    input {
      width: 100%;
      padding: 12px;
      margin-top: 8px;
      border: 1px solid #ccc;
      border-radius: 10px;
      font-size: 1em;
    }

    button {
      width: 100%;
      padding: 14px;
      margin-top: 30px;
      border: none;
      background-color: #3b82f6;
      color: white;
      font-size: 1.1em;
      border-radius: 12px;
      cursor: pointer;
      transition: 0.3s;
    }

    button:hover {
      background-color: #2563eb;
    }

    .register-link {
      text-align: center;
      margin-top: 20px;
    }

    .register-link a {
      color: #3b82f6;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <div class="login-box">
    <h2>Login to Phanes</h2>
    <form action="login.php" method="post">
      <label for="email">Email Address</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>

      <button type="submit">Log In</button>
    </form>

    <div class="register-link">
      Don't have an account? <a href="register.php">Register</a>
      or <a href="index.php">Back to Home</a>
    </div>
  </div>

</body>
</html>