<?php

require_once "config/database.php";

$produk = mysqli_query(
    $conn,
    "SELECT
    p.*,
    k.nama AS kategori
    FROM produk p
    LEFT JOIN kategori k
    ON p.kategori_id = k.id
    WHERE p.is_aktif = 1
    ORDER BY p.id DESC
    LIMIT 6"
);

$kategori = mysqli_query(
    $conn,
    "SELECT * FROM kategori
    ORDER BY urutan ASC"
);

$merek = mysqli_query(
    $conn,
    "SELECT * FROM merek
    WHERE is_aktif = 1"
);

$totalProduk = mysqli_fetch_assoc(
    mysqli_query($conn,
    "SELECT COUNT(*) as total FROM produk")
);

$totalKategori = mysqli_fetch_assoc(
    mysqli_query($conn,
    "SELECT COUNT(*) as total FROM kategori")
);

$totalMerek = mysqli_fetch_assoc(
    mysqli_query($conn,
    "SELECT COUNT(*) as total FROM merek")
);
?>

<!DOCTYPE html>
<html>
<head>

<title>OptiLens</title>

<link rel="stylesheet" href="assets/style.css">

</head>
<body>

<!-- NAVBAR -->

<nav class="navbar">

<div class="container nav-content">

<div class="logo">
👓 OptiLens
</div>

<div class="menu">

<a href="index.php">Home</a>
<a href="produk.php">Produk</a>


</div>

</div>

</nav>

<!-- HERO -->

<section class="hero">

<div class="container hero-content">

<div class="hero-text">

<h1>
Meet Your
<span>Vision Care</span>
With Us
</h1>

<p>
Temukan berbagai pilihan frame,
kacamata, dan lensa terbaik dengan
kualitas premium untuk kebutuhan
penglihatan Anda.
</p>

<a href="produk.php" class="btn">
Lihat Produk
</a>

</div>

<div class="hero-image">

<img src="https://images.unsplash.com/photo-1588776814546-daab30f310ce?q=80&w=1200" alt="">

</div>

</div>

<!-- ABOUT -->

<section class="section">

<div class="container about">

<img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?q=80&w=1200">

<div class="about-text">

<h2>
Nurture Better Vision
For Your Daily Life
</h2>

<p>

Optik Merin menyediakan berbagai
produk optik berkualitas tinggi
mulai dari frame, lensa hingga
aksesoris untuk menunjang
kenyamanan penglihatan Anda.

</p>

<div class="stats">

<div class="stat">
<h3><?= $totalProduk['total']; ?></h3>
<p>Produk</p>
</div>

<div class="stat">
<h3><?= $totalKategori['total']; ?></h3>
<p>Kategori</p>
</div>

<div class="stat">
<h3><?= $totalMerek['total']; ?></h3>
<p>Merek</p>
</div>

</div>

</div>

</div>

</section>

<section class="section">

<div class="container">

<div class="section-title">

<h2>Merek Tersedia</h2>

<p>
Berbagai merek terpercaya untuk kebutuhan mata Anda
</p>

</div>

<div class="services">

<?php while($m = mysqli_fetch_assoc($merek)): ?>

<div class="service-card">

<h3>
<?= $m['nama']; ?>
</h3>

<p>
<?= $m['slug']; ?>
</p>

</div>

<?php endwhile; ?>

</div>

</div>

</section>

</section>

<section class="section">

<div class="container">

<div class="section-title">

<h2>Kategori Produk</h2>

<p>
Temukan kategori produk yang Anda butuhkan
</p>

</div>

<div class="services">

<?php while($k = mysqli_fetch_assoc($kategori)): ?>

<div class="service-card">

<h3>
<?= $k['nama']; ?>
</h3>

<p>
<?= $k['slug']; ?>
</p>

</div>

<?php endwhile; ?>

</div>

</div>

</section>

<section class="section">

<div class="container">


<div class="services">

<?php while($k = mysqli_fetch_assoc($kategori)): ?>

<div class="service-card">

<h3><?= $k['nama']; ?></h3>

<p>
<?= $k['slug']; ?>
</p>

</div>

<?php endwhile; ?>

</div>

</div>

</section>



<!-- PRODUK -->

<section class="section">

<div class="container">

<div class="section-title">

<h2>Produk Terbaru</h2>

<p>
Pilihan produk unggulan kami
</p>

</div>

<div class="products">

<?php while($row = mysqli_fetch_assoc($produk)): ?>

<div class="product-card">

<div class="product-body">

<div class="badge">
<?= $row['kategori']; ?>
</div>

<div class="product-title">
<?= $row['nama']; ?>
</div>

<div class="price">
Rp <?= number_format($row['harga']); ?>
</div>

<a
href="detail-produk.php?id=<?= $row['id']; ?>"
class="btn"
>
Lihat Detail
</a>

</div>

</div>

<?php endwhile; ?>

</div>

</div>

</section>

<!-- FOOTER -->

<footer class="footer">

<h3>OptiLens</h3>



</footer>

</body>
</html>