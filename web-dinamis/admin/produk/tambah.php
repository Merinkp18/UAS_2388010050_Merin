<?php
require_once "../../config/session.php";
require_once "../../config/database.php";

$kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY nama ASC");
$merek    = mysqli_query($conn, "SELECT * FROM merek ORDER BY nama ASC");

if (isset($_POST['simpan'])) {
    $kategori_id = $_POST['kategori_id'];
    $merek_id    = $_POST['merek_id'];
    $nama        = $_POST['nama'];
    $slug        = $_POST['slug'];
    $deskripsi   = $_POST['deskripsi'];
    $harga       = $_POST['harga'];
    $is_aktif    = $_POST['is_aktif'];

    mysqli_query($conn, "INSERT INTO produk (kategori_id, merek_id, nama, slug, deskripsi, harga, is_aktif)
        VALUES ('$kategori_id','$merek_id','$nama','$slug','$deskripsi','$harga','$is_aktif')");

    header("Location: index.php?msg=simpan");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Admin OptiLens</title>
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
            <h1>Tambah Produk</h1>
            <a href="index.php" class="btn btn-cancel">← Kembali</a>
        </div>

        <div class="card" style="max-width:700px;">
            <form method="POST">

                <div class="form-row">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="kategori_id" class="form-control" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php while ($k = mysqli_fetch_assoc($kategori)): ?>
                            <option value="<?= $k['id'] ?>"><?= $k['nama'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Merek</label>
                        <select name="merek_id" class="form-control">
                            <option value="">-- Pilih Merek --</option>
                            <?php while ($m = mysqli_fetch_assoc($merek)): ?>
                            <option value="<?= $m['id'] ?>"><?= $m['nama'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" name="nama" class="form-control" placeholder="cth: Frame Titanium Oval" required>
                </div>

                <div class="form-group">
                    <label>Slug</label>
                    <input type="text" name="slug" class="form-control" placeholder="cth: frame-titanium-oval" required>
                    <small style="color:#94a3b8; font-size:12px;">Huruf kecil, tanpa spasi, gunakan tanda -</small>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="4" placeholder="Deskripsi produk..."></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Harga (Rp)</label>
                        <input type="number" name="harga" class="form-control" placeholder="cth: 250000" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="is_aktif" class="form-control">
                            <option value="1">Aktif</option>
                            <option value="0">Nonaktif</option>
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" name="simpan" class="btn btn-save">💾 Simpan</button>
                    <a href="index.php" class="btn btn-cancel">Batal</a>
                </div>

            </form>
        </div>

    </div>
</div>

<script>
document.querySelector('[name=nama]').addEventListener('input', function () {
    const slug = this.value.toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-');
    document.querySelector('[name=slug]').value = slug;
});
</script>

</body>
</html>