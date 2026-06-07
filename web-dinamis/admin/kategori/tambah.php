<?php
require_once "../../config/session.php";
require_once "../../config/database.php";

if (isset($_POST['simpan'])) {
    $nama   = $_POST['nama'];
    $slug   = $_POST['slug'];
    $urutan = $_POST['urutan'];

    mysqli_query($conn, "INSERT INTO kategori (nama, slug, urutan) VALUES ('$nama', '$slug', '$urutan')");
    header("Location: index.php?msg=simpan");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori - Admin OptiLens</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="wrapper">

    <div class="sidebar">
        <div class="brand">👓 OptiLens</div>
        <a href="../dashboard.php">🏠 Dashboard</a>
        <a href="index.php" class="active">🏷️ Kategori</a>
        <a href="../merek/index.php">⭐ Merek</a>
        <a href="../produk/index.php">📦 Produk</a>
        
        <a href="../../logout.php" class="logout">🚪 Logout</a>
    </div>

    <div class="main">

        <div class="topbar">
            <h1>Tambah Kategori</h1>
            <a href="index.php" class="btn btn-cancel">← Kembali</a>
        </div>

        <div class="card" style="max-width: 540px;">
            <form method="POST">

                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" name="nama" class="form-control" placeholder="cth: Frame Kacamata" required>
                </div>

                <div class="form-group">
                    <label>Slug</label>
                    <input type="text" name="slug" class="form-control" placeholder="cth: frame-kacamata" required>
                    <small style="color:#94a3b8; font-size:12px;">Huruf kecil, tanpa spasi, gunakan tanda -</small>
                </div>

                <div class="form-group">
                    <label>Urutan Tampil</label>
                    <input type="number" name="urutan" class="form-control" placeholder="cth: 1" min="0" required>
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
// Auto-generate slug dari nama
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