<?php
require_once "../../config/session.php";
require_once "../../config/database.php";

$query = mysqli_query($conn, "
    SELECT p.*, k.nama AS kategori, m.nama AS merek
    FROM produk p
    LEFT JOIN kategori k ON p.kategori_id = k.id
    LEFT JOIN merek m ON p.merek_id = m.id
    ORDER BY p.id DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk - Admin OptiLens</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="wrapper">

    <div class="sidebar">
        <div class="brand">👓 OptiLens</div>
        <a href="../dashboard.php">🏠 Dashboard</a>
        <a href="../kategori/index.php">🏷️ Kategori</a>
        <a href="../merek/index.php">⭐ Merek</a>
        <a href="index.php" class="active">📦 Produk</a>
        
        <a href="../../logout.php" class="logout">🚪 Logout</a>
    </div>

    <div class="main">

        <div class="topbar">
            <h1>Data Produk</h1>
            <a href="tambah.php" class="btn btn-add">+ Tambah Produk</a>
        </div>

        <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success">
            ✅ Produk berhasil <?= $_GET['msg'] == 'hapus' ? 'dihapus' : 'disimpan' ?>.
        </div>
        <?php endif; ?>

        <div class="card">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Merek</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($query)): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= $row['kategori'] ?? '-' ?></td>
                        <td><?= $row['merek'] ?? '-' ?></td>
                        <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                        <td>
                            <span class="badge <?= $row['is_aktif'] ? 'badge-success' : 'badge-gray' ?>">
                                <?= $row['is_aktif'] ? 'Aktif' : 'Nonaktif' ?>
                            </span>
                        </td>
                        <td>
                            <div class="action">
                                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-edit">✏ Edit</a>
                                <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-delete"
                                   onclick="return confirm('Hapus produk ini?')">🗑 Hapus</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

</body>
</html>