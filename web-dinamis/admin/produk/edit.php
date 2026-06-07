<?php
require_once "../../config/session.php";
require_once "../../config/database.php";

$id   = (int)$_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM produk WHERE id='$id'");
$row  = mysqli_fetch_assoc($data);

if (!$row) { header("Location: index.php"); exit; }

$kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY nama ASC");
$merek    = mysqli_query($conn, "SELECT * FROM merek ORDER BY nama ASC");

if (isset($_POST['update'])) {
    $kategori_id = $_POST['kategori_id'];
    $merek_id    = $_POST['merek_id'];
    $nama        = $_POST['nama'];
    $slug        = $_POST['slug'];
    $deskripsi   = $_POST['deskripsi'];
    $harga       = $_POST['harga'];
    $is_aktif    = $_POST['is_aktif'];

    mysqli_query($conn, "UPDATE produk SET
        kategori_id='$kategori_id', merek_id='$merek_id', nama='$nama',
        slug='$slug', deskripsi='$deskripsi', harga='$harga', is_aktif='$is_aktif'
        WHERE id='$id'");

    header("Location: index.php?msg=simpan");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Admin OptiLens</title>
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
            <h1>Edit Produk</h1>
            <a href="index.php" class="btn btn-cancel">← Kembali</a>
        </div>

        <div class="card" style="max-width:700px;">
            <form method="POST">

                <div class="form-row">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori_id" class="form-control" required>
                            <?php while ($k = mysqli_fetch_assoc($kategori)): ?>
                            <option value="<?= $k['id'] ?>" <?= $k['id'] == $row['kategori_id'] ? 'selected' : '' ?>>
                                <?= $k['nama'] ?>
                            </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Merek</label>
                        <select name="merek_id" class="form-control">
                            <option value="">-- Tanpa Merek --</option>
                            <?php while ($m = mysqli_fetch_assoc($merek)): ?>
                            <option value="<?= $m['id'] ?>" <?= $m['id'] == $row['merek_id'] ? 'selected' : '' ?>>
                                <?= $m['nama'] ?>
                            </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($row['nama']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Slug</label>
                    <input type="text" name="slug" class="form-control" value="<?= htmlspecialchars($row['slug']) ?>" required>
                    <small style="color:#94a3b8; font-size:12px;">Huruf kecil, tanpa spasi, gunakan tanda -</small>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4"><?= htmlspecialchars($row['deskripsi']) ?></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Harga (Rp)</label>
                        <input type="number" name="harga" class="form-control" value="<?= $row['harga'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="is_aktif" class="form-control">
                            <option value="1" <?= $row['is_aktif'] == 1 ? 'selected' : '' ?>>Aktif</option>
                            <option value="0" <?= $row['is_aktif'] == 0 ? 'selected' : '' ?>>Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" name="update" class="btn btn-save">💾 Update</button>
                    <a href="index.php" class="btn btn-cancel">Batal</a>
                </div>

            </form>
        </div>

    </div>
</div>

</body>
</html>