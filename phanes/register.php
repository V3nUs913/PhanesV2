<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    // Validasi
    if ($password != $confirm) {
        echo "<script>alert('Password tidak cocok!');</script>";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        if (mysqli_num_rows($check) > 0) {
            echo "<script>alert('Email sudah terdaftar!');</script>";
        } else {
            $insert = mysqli_query($conn, "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$hash')");
            if ($insert) {
                echo "<script>alert('Registrasi berhasil!'); window.location='login.php';</script>";
            } else {
                echo "<script>alert('Registrasi gagal!');</script>";
            }
        }
    }
}
?>

<!-- TAMPAK DEPANNYA PAKAI YANG SUDAH KITA BUAT SEBELUMNYA -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - Phanes</title>
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

    .register-box {
      background-color: white;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      width: 420px;
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

    .login-link {
      text-align: center;
      margin-top: 20px;
    }

    .login-link a {
      color: #3b82f6;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <div class="register-box">
    <h2>Create Your Account</h2>
    <form action="#" method="post">
      <label for="fullname">Full Name</label>
      <input type="text" id="fullname" name="fullname" required>

      <label for="email">Email Address</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>

      <label for="confirm_password">Confirm Password</label>
      <input type="password" id="confirm_password" name="confirm_password" required>

      <button type="submit">Register</button>
    </form>

    <div class="login-link">
      Already have an account? <a href="login.php">Log In</a>
    </div>
  </div>

</body>
</html>