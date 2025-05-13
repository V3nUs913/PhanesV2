<?php
include 'config.php'; // Koneksi ke database
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Phanes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef4ff;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: 20px auto;
        }
        h2 {
            color: #2c3e50;
        }
        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .gallery div {
            margin: 10px;
            text-align: center;
        }
        .gallery img {
            width: 200px;
            height: auto;
            border-radius: 5px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
        }
        .back-home {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #2c3e50;
            font-weight: bold;
        }
        .back-home:hover {
            color: #e74c3c;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
    <h2>Galeri Phanes</h2>

    <!-- Menampilkan Gambar dari Database -->
    <div class="gallery">
        <?php
        $result = mysqli_query($conn, "SELECT * FROM galeri ORDER BY id DESC");
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div>
                    <img src='" . $row['gambar'] . "'>
                    <p>" . $row['deskripsi'] . "</p>
                  </div>";
        }
        ?>
    </div>

    <a href="index.php" class="back-home">⬅ Kembali ke Home</a>
</div>

<?php include 'footer.php'; ?>

</body>
</html>