<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitasi dan validasi input
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $figure_type = trim($_POST['figure_type']);
    $description = trim($_POST['description']);
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    $errors = [];

    if (empty($name)) $errors[] = "Nama harus diisi.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email tidak valid.";
    $valid_types = ['anime', 'realistic', 'chibi', 'pet', 'other'];
    if (empty($figure_type) || !in_array($figure_type, $valid_types)) $errors[] = "Tipe figure tidak valid.";
    if (empty($description)) $errors[] = "Deskripsi harus diisi.";

    if (empty($errors)) {
        $imageName = "";
        if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
            $uploadDir = "uploads/";
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
            $imageName = time() . '_' . basename($_FILES['file']['name']);
            $uploadFile = $uploadDir . $imageName;
            if (!move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
                $errors[] = "Gagal mengupload file.";
            }
        }
        if (empty($errors)) {
            $stmt = $conn->prepare("INSERT INTO orders (user_id, name, email, figure_type, description, image) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssss", $user_id, $name, $email, $figure_type, $description, $imageName);
            if ($stmt->execute()) {
                echo "<script>alert('Order berhasil dikirim!'); window.location='my_order.php';</script>";
                exit();
            } else {
                $errors[] = "Gagal menyimpan data order.";
            }
            $stmt->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Phanes - Order</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #e0e7ff 0%, #f9fafb 100%);
      color: #333;
      min-height: 100vh;
    }
    .header {
      background: linear-gradient(90deg, #3b82f6 60%, #2563eb 100%);
      color: white;
      padding: 20px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 4px 16px rgba(59,130,246,0.08);
    }
    .header h1 {
      margin: 0;
      font-weight: 700;
      letter-spacing: 1px;
      font-size: 2em;
    }
    .header a {
      color: white;
      text-decoration: none;
      margin-left: 30px;
      font-weight: 600;
      transition: color 0.2s;
    }
    .header a:hover {
      color: #ffd700;
    }
    .container {
      max-width: 480px;
      margin: 60px auto;
      background: white;
      padding: 40px 36px 32px 36px;
      border-radius: 24px;
      box-shadow: 0 10px 32px rgba(59,130,246,0.13), 0 2px 8px rgba(0,0,0,0.08);
      animation: fadeIn 0.8s;
    }
    @keyframes fadeIn {
      from {opacity: 0; transform: translateY(40px);}
      to {opacity: 1; transform: translateY(0);}
    }
    .container h2 {
      text-align: center;
      color: #2563eb;
      margin-bottom: 28px;
      font-weight: 700;
      letter-spacing: 0.5px;
      font-size: 1.5em;
    }
    .form-group {
      position: relative;
      margin-bottom: 24px;
    }
    input.form-input, textarea.form-input, select.form-select {
      width: 100%;
      padding: 16px 12px 16px 12px;
      border: 1.5px solid #d1d5db;
      border-radius: 12px;
      font-size: 1em;
      background: #f9fafb;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    input.form-input:focus, textarea.form-input:focus, select.form-select:focus {
      border-color: #3b82f6;
      box-shadow: 0 2px 12px rgba(59,130,246,0.1);
      background: #fff;
    }
    textarea.form-input {
      resize: vertical;
      min-height: 80px;
      max-height: 220px;
    }
    .form-label {
      position: absolute;
      top: 16px;
      left: 16px;
      color: #6b7280;
      font-size: 1em;
      background: white;
      padding: 0 4px;
      pointer-events: none;
      transition: 0.2s;
      border-radius: 4px;
      z-index: 2;
    }
    input.form-input:focus + .form-label,
    input.form-input:not(:placeholder-shown) + .form-label,
    textarea.form-input:focus + .form-label,
    textarea.form-input:not(:placeholder-shown) + .form-label,
    select.form-select:focus + .form-label,
    select.form-select:not([value=""]) + .form-label {
      top: -10px;
      left: 10px;
      font-size: 0.88em;
      color: #3b82f6;
      font-weight: 600;
      padding: 0 6px;
      box-shadow: 0 1px 2px rgba(59,130,246,0.04);
    }
    .submit-btn {
      width: 100%;
      padding: 16px;
      border: none;
      background: linear-gradient(90deg, #3b82f6 70%, #2563eb 100%);
      color: white;
      font-size: 1.1em;
      font-weight: 700;
      border-radius: 14px;
      cursor: pointer;
      box-shadow: 0 2px 12px rgba(59,130,246,0.1);
      transition: background 0.2s, transform 0.2s;
      letter-spacing: 0.5px;
    }
    .submit-btn:hover {
      background: linear-gradient(90deg, #2563eb 60%, #3b82f6 100%);
      transform: translateY(-2px) scale(1.02);
    }
    .error {
      background: #fee2e2;
      color: #b91c1c;
      border: 1px solid #fca5a5;
      padding: 10px 15px;
      border-radius: 8px;
      margin-bottom: 20px;
    }
    /* Social icons */
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
    @media (max-width: 600px) {
      .container {
        margin: 30px 12px;
        padding: 30px 20px;
      }
      .header {
        flex-direction: column;
        align-items: flex-start;
        padding: 18px 12px;
      }
      .header h1 {
        font-size: 1.3em;
      }
    }
  </style>
</head>
<body>

  <div class="header">
    <h1>Phanes</h1>
    <div>
      <a href="index.php">Home</a>
      <a href="services.php">Services</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>

  <div class="container">
    <h2>Order Custom 3D Figure</h2>

    <?php if (!empty($errors)): ?>
      <div class="error">
        <ul>
          <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form action="#" method="post" enctype="multipart/form-data" autocomplete="off" novalidate>
      <div class="form-group">
        <input type="text" id="name" name="name" class="form-input" placeholder=" " value="<?= isset($name) ? htmlspecialchars($name) : '' ?>" required />
        <label for="name" class="form-label">Full Name</label>
      </div>

      <div class="form-group">
        <input type="email" id="email" name="email" class="form-input" placeholder=" " value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" required />
        <label for="email" class="form-label">Email Address</label>
      </div>

      <div class="form-group">
        <select id="figure_type" name="figure_type" class="form-select" required>
          <option value="" disabled <?= !isset($figure_type) ? 'selected' : '' ?>>-- Choose One --</option>
          <option value="anime" <?= (isset($figure_type) && $figure_type == 'anime') ? 'selected' : '' ?>>Anime Style</option>
          <option value="realistic" <?= (isset($figure_type) && $figure_type == 'realistic') ? 'selected' : '' ?>>Realistic</option>
          <option value="chibi" <?= (isset($figure_type) && $figure_type == 'chibi') ? 'selected' : '' ?>>Chibi</option>
          <option value="pet" <?= (isset($figure_type) && $figure_type == 'pet') ? 'selected' : '' ?>>Pet Figurine</option>
          <option value="other" <?= (isset($figure_type) && $figure_type == 'other') ? 'selected' : '' ?>>Other</option>
        </select>
        <label for="figure_type" class="form-label">Type of Figure</label>
      </div>

      <div class="form-group">
        <textarea id="description" name="description" class="form-input" placeholder=" " rows="5" required><?= isset($description) ? htmlspecialchars($description) : '' ?></textarea>
        <label for="description" class="form-label">Order Description</label>
      </div>

      <div class="form-group">
        <label for="file" style="font-weight:600;color:#3b82f6;">Upload Design/Image (optional)</label>
        <input type="file" id="file" name="file" accept="image/*" />
      </div>

      <button type="submit" class="submit-btn">Submit Order</button>
    </form>
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
