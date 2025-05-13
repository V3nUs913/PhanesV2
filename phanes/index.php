<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Phanes - Discover 3D Printing</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }
    
    body {
      background-image: url("image/Kartun.jpg");
      background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
  min-height: 50vh;
  width: 100vw;
  display: flex;
  overflow: hidden;
    }

    .sidebar {
      padding:  70px 60px;
      display: center;
      flex-direction: column;
      justify-content: space-between;
      color: white;
    }

    .logo-area {
      display: flex;
      align-items: center;
      gap: 15px;
      font-weight: bold;
      font-size: 2em;
    }

    .promo {
      margin-top: 60px;
    }

    .promo h1 {
      font-size: 2.5em;
      letter-spacing: 2px;
      color: #000;
    }

    .promo h1 span {
      color: #7b61ff;
    }

    .promo p {
      margin: 20px 0;
      color: #333;
      line-height: 1.6em;
    }

    .promo button {
      padding: 10px 20px;
      background-color: rgb(192, 191, 191);
      border: none;
      border-radius: 25px;
      color: white;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .promo button:hover {
      background-color: rgb(36, 103, 248);
    }

    .social-media {
      margin-top: 40px;
      display: flex;
      gap: 15px;
    }

    .social-media i {
      font-size: 1.5em;
      color: rgb(181, 246, 59);
      cursor: pointer;
    }

    .main {
      width: 65%;
      position: relative;
      background-size: cover;
      background-position: center;
    }

    .navbar {
      position: absolute;
      top: 30px;
      right: 40px;
      display: flex;
      align-items: center;
      gap: 30px;
      z-index: 2;
    }

    .navbar a {
      color: blue;
      text-decoration: none;
      font-weight: bold;
      transition: color 0.3s;
    }

    .navbar a:hover {
      color: #ffd700;
    }

    .navbar button {
      padding: 8px 16px;
      background-color: blue;
      color: #fff;
      border: none;
      border-radius: 20px;
      font-weight: bold;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .navbar button:hover {
      background-color: #e0e7ff;
      color: blue;
    }

  </style>
</head>
<body>

    <div>
      <div class="logo-area">
        Phanes
      </div>

      <div class="sidebar">
      <div class="promo">
        <h1>Discover <span>Phanes</span></h1>
        <p>Experience the future of 3D printing. Customize your dream into reality with our precision-crafted technology.</p>
        <a href="read_more.php"><button>Read More</button></a>
      </div>
    </div>

    <div class="social-media">
      <i class="fab fa-twitter"></i>
      <i class="fab fa-facebook-f"></i>
      <i class="fab fa-instagram"></i>
    </div>
  </div>

  <!-- Bagian Main -->
  <div class="main">
    <div class="navbar">
      <a href="login.php"><button>Log In</button></a>
    </div>

</body>
</html>
