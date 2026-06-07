<?php
require_once "../../config/session.php";
require_once "../../config/database.php";

$id   = (int)$_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM kategori WHERE id='$id'");
$row  = mysqli_fetch_assoc($data);

if (!$row) { header("Location: index.php"); exit; }

if (isset($_POST['update'])) {
    $nama   = $_POST['nama'];
    $slug   = $_POST['slug'];
    $urutan = $_POST['urutan'];

    mysqli_query($conn, "UPDATE kategori SET nama='$nama', slug='$slug', urutan='$urutan' WHERE id='$id'");
    header("Location: index.php?msg=simpan");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori - Admin OptiLens</title>
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
            <h1>Edit Kategori</h1>
            <a href="index.php" class="btn btn-cancel">← Kembali</a>
        </div>

        <div class="card" style="max-width: 540px;">
            <form method="POST">

                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" name="nama" class="form-control"
                           value="<?= htmlspecialchars($row['nama']) ?>" required>
                </div>

                <div class="form-group">
                    <label>Slug</label>
                    <input type="text" name="slug" class="form-control"
                           value="<?= htmlspecialchars($row['slug']) ?>" required>
                    <small style="color:#94a3b8; font-size:12px;">Huruf kecil, tanpa spasi, gunakan tanda -</small>
                </div>

                <div class="form-group">
                    <label>Urutan Tampil</label>
                    <input type="number" name="urutan" class="form-control"
                           value="<?= $row['urutan'] ?>" min="0" required>
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