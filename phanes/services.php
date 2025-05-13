<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Phanes - Services</title>
  <!-- Load Font Awesome for social media icons -->
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
  />
  <style>
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #f9fafe;
      color: #333;
    }

    .header {
      background-color: #3b82f6;
      color: white;
      padding: 20px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .header h1 {
      margin: 0;
    }

    .header a {
      color: white;
      text-decoration: none;
      margin-left: 30px;
      font-weight: bold;
    }

    .content {
      padding: 60px 40px;
    }

    .content h2 {
      font-size: 2em;
      color: #3b82f6;
    }

    .service-box {
      background: white;
      border-radius: 20px;
      padding: 30px;
      margin: 20px 0;
      box-shadow: 0 4px 10px rgba(0,0,0,0.08);
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 30px;
    }

    .service-text {
      flex: 1;
    }

    .service-image {
      width: 150px;
      height: auto;
      border-radius: 10px;
    }

    @media (max-width: 768px) {
      .service-box {
        flex-direction: column;
        text-align: center;
      }

      .service-image {
        margin-top: 20px;
      }
    }

    /* ===== Tambahan CSS untuk ikon sosial media kanan tengah ===== */
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
  <div class="header">
    <h1>Phanes</h1>
    <div>
      <a href="index.php">Home</a>
      <a href="order.php">Order</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>

  <div class="content">
    <h2>Our Services</h2>

    <div class="service-box">
      <div class="service-text">
        <h3>Custom 3D Figure</h3>
        <p>Buat figurin sesuai karakter, wajah, atau desainmu sendiri.</p>
      </div>
      <img src="image/Custom face Human.jpg" alt="Custom 3D Figure" class="service-image" />
    </div>

    <div class="service-box">
      <div class="service-text">
        <h3>3D Design & Modeling</h3>
        <p>Kami menyediakan jasa modeling untuk desain 3D profesional dan hobi.</p>
      </div>
      <img src="image/Custom tentara.jpg" alt="3D Design & Modeling" class="service-image" />
    </div>

    <div class="service-box">
      <div class="service-text">
        <h3>High-Quality Printing</h3>
        <p>Menggunakan printer mutakhir untuk hasil yang presisi dan detail tinggi.</p>
      </div>
      <img src="image/Tengkorak.jpg" alt="High-Quality Printing" class="service-image" />
    </div>
  </div>

  <!-- ===== Tambahan HTML ikon sosial media ===== -->
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
