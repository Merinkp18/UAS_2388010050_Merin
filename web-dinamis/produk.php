<?php

require_once "config/database.php";

$keyword = '';

if(isset($_GET['cari'])){
    $keyword = $_GET['cari'];
}

$query = mysqli_query(
    $conn,
    "SELECT
        p.*,
        k.nama AS kategori,
        m.nama AS merek
    FROM produk p
    LEFT JOIN kategori k ON p.kategori_id = k.id
    LEFT JOIN merek m ON p.merek_id = m.id
    WHERE p.is_aktif = 1
    AND p.nama LIKE '%$keyword%'
    ORDER BY p.id DESC"
);

?>

<!DOCTYPE html>
<html>
<head>

<title>Semua Produk - OptiLens</title>

<link rel="stylesheet" href="assets/style.css">

<style>

.search-box{
    max-width:500px;
    margin:0 auto 40px;
    display:flex;
    gap:10px;
}

.search-box input{
    flex:1;
    padding:15px;
    border:1px solid #ddd;
    border-radius:10px;
}

.search-box button{
    background:#2563eb;
    color:white;
    border:none;
    padding:15px 25px;
    border-radius:10px;
    cursor:pointer;
}

</style>

</head>
<body>

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

<section class="section">

<div class="container">

<div class="section-title">

<h2>Semua Produk</h2>

<p>
Temukan berbagai pilihan produk optik terbaik
</p>

</div>

<form method="GET">

<div class="search-box">

<input
type="text"
name="cari"
placeholder="Cari produk..."
value="<?= $keyword ?>"
>

<button type="submit">
Cari
</button>

</div>

</form>

<div class="products">

<?php while($row = mysqli_fetch_assoc($query)): ?>

<div class="product-card">

<div class="product-body">

<div class="badge">
<?= $row['kategori']; ?>
</div>

<h3 class="product-title">
<?= $row['nama']; ?>
</h3>

<p style="color:#64748b; margin-bottom:10px;">
<?= $row['merek']; ?>
</p>

<div class="price">
Rp <?= number_format($row['harga'],0,',','.') ?>
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

<footer class="footer">

<h3>OptiLens</h3>



</footer>

</body>
</html>