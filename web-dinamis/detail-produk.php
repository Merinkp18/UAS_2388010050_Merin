<?php

require_once "config/database.php";

$id = $_GET['id'];

$query = mysqli_query(
    $conn,
    "SELECT
        p.*,
        k.nama AS kategori,
        m.nama AS merek
    FROM produk p
    LEFT JOIN kategori k ON p.kategori_id = k.id
    LEFT JOIN merek m ON p.merek_id = m.id
    WHERE p.id='$id'"
);

$data = mysqli_fetch_assoc($query);

if(!$data){
    die("Produk tidak ditemukan");
}

?>

<!DOCTYPE html>
<html>
<head>

<title><?= $data['nama']; ?></title>

<link rel="stylesheet" href="assets/style.css">

<style>

.detail-card{

    background:white;
    padding:40px;
    border-radius:25px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);

}

.detail-grid{

    display:grid;
    grid-template-columns:1fr 1fr;
    gap:40px;

}

.product-image{

    background:#eef4ff;
    border-radius:20px;
    min-height:350px;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:100px;

}

.info p{
    margin-bottom:15px;
}

.info h1{
    margin:20px 0;
}

.back-btn{
    margin-top:20px;
}

@media(max-width:900px){

.detail-grid{
    grid-template-columns:1fr;
}

}

</style>

</head>
<body>

<nav class="navbar">

<div class="container nav-content">

<div class="logo">
👓 Optik Merin
</div>

<div class="menu">

<a href="index.php">Home</a>
<a href="produk.php">Produk</a>
<a href="login.php">Admin</a>

</div>

</div>

</nav>

<section class="section">

<div class="container">

<div class="detail-card">

<div class="detail-grid">

<div class="product-image">

👓

</div>

<div class="info">

<div class="badge">
<?= $data['kategori']; ?>
</div>

<h1>
<?= $data['nama']; ?>
</h1>

<p>

<strong>Merek :</strong>

<?= $data['merek']; ?>

</p>

<p>

<strong>Status :</strong>

<?= ($data['is_aktif'] == 1) ? 'Tersedia' : 'Tidak Tersedia'; ?>

</p>

<div
style="
font-size:36px;
font-weight:bold;
color:#2563eb;
margin:25px 0;
"
>

Rp <?= number_format($data['harga'],0,',','.'); ?>

</div>

<h3>Deskripsi Produk</h3>

<p
style="
color:#64748b;
line-height:1.8;
margin-top:10px;
"
>

<?= nl2br($data['deskripsi']); ?>

</p>

<a
href="produk.php"
class="btn back-btn"
>

← Kembali ke Produk

</a>

</div>

</div>

</div>

</div>

</section>

<footer class="footer">

<h3>Optik Merin</h3>

<p>
Website Toko Optik Berbasis PHP & MySQL
</p>

</footer>

</body>
</html>