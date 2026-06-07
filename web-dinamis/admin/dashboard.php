<?php
session_start();
require_once "../config/database.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}

$produk   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) total FROM produk"));
$kategori = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) total FROM kategori"));
$merek    = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) total FROM merek"));
$pesanan  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) total FROM pesanan"));

$pesanan_terbaru = mysqli_query($conn, "SELECT p.*, u.nama_lengkap FROM pesanan p JOIN users u ON p.user_id=u.id ORDER BY p.created_at DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin OptiLens</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="wrapper">

    <div class="sidebar">
        <div class="brand">👓 OptiLens</div>
        <a href="dashboard.php" class="active">🏠 Dashboard</a>
        <a href="kategori/index.php">🏷️ Kategori</a>
        <a href="merek/index.php">⭐ Merek</a>
        <a href="produk/index.php">📦 Produk</a>
        
        <a href="../logout.php" class="logout">🚪 Logout</a>
    </div>

    <div class="main">

        <div class="topbar">
            <h1>Dashboard</h1>
            <span style="font-size:13px; color:#64748b;">
                Selamat datang, <?= $_SESSION['admin_nama'] ?? 'Admin' ?> 👋
            </span>
        </div>

        <!-- Stat Cards -->
        <div class="stats">
            <div class="stat-card">
                <div class="icon blue">📦</div>
                <div class="info">
                    <p>Total Produk</p>
                    <h3><?= $produk['total'] ?></h3>
                </div>
            </div>
            <div class="stat-card">
                <div class="icon green">🏷️</div>
                <div class="info">
                    <p>Total Kategori</p>
                    <h3><?= $kategori['total'] ?></h3>
                </div>
            </div>
            <div class="stat-card">
                <div class="icon purple">⭐</div>
                <div class="info">
                    <p>Total Merek</p>
                    <h3><?= $merek['total'] ?></h3>
                </div>
            </div>
            <div class="stat-card">
                <div class="icon yellow">🛍️</div>
                <div class="info">
                    <p>Total Pesanan</p>
                    <h3><?= $pesanan['total'] ?></h3>
                </div>
            </div>
        </div>

        <!-- Pesanan Terbaru -->
        <div class="card">
            <div class="card-header">
                <h2>Pesanan Terbaru</h2>
                <a href="pesanan/index.php" class="btn btn-edit">Lihat Semua</a>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Kode Pesanan</th>
                        <th>Pelanggan</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (mysqli_num_rows($pesanan_terbaru) == 0): ?>
                    <tr><td colspan="5" style="text-align:center; color:#94a3b8;">Belum ada pesanan</td></tr>
                <?php endif; ?>
                <?php while ($p = mysqli_fetch_assoc($pesanan_terbaru)): ?>
                    <tr>
                        <td><?= $p['kode_pesanan'] ?></td>
                        <td><?= $p['nama_lengkap'] ?></td>
                        <td>Rp <?= number_format($p['total'], 0, ',', '.') ?></td>
                        <td>
                            <?php
                            $badge = match($p['status']) {
                                'selesai'              => 'badge-success',
                                'dikirim'              => 'badge-info',
                                'diproses', 'dibayar'  => 'badge-warning',
                                'dibatalkan'           => 'badge-danger',
                                default                => 'badge-gray'
                            };
                            ?>
                            <span class="badge <?= $badge ?>">
                                <?= ucfirst(str_replace('_', ' ', $p['status'])) ?>
                            </span>
                        </td>
                        <td><?= date('d M Y', strtotime($p['created_at'])) ?></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

</body>
</html>