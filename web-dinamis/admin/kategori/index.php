<?php

require_once "../../config/session.php";
require_once "../../config/database.php";

$data = mysqli_query(
    $conn,
    "SELECT * FROM kategori ORDER BY urutan ASC"
);

?>

<!DOCTYPE html>
<html>
<head>

<title>Data Kategori</title>

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

        <div class="card">

            <div style="
                display:flex;
                justify-content:space-between;
                align-items:center;
                margin-bottom:20px;
            ">

                <h2>Data Kategori</h2>

                <a href="tambah.php" class="btn btn-add">
                    + Tambah Kategori
                </a>

            </div>

            <table class="table">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Slug</th>
                        <th>Urutan</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                <?php
                $no = 1;

                while($row = mysqli_fetch_assoc($data)):
                ?>

                    <tr>

                        <td><?= $no++ ?></td>

                        <td><?= $row['nama'] ?></td>

                        <td><?= $row['slug'] ?></td>

                        <td><?= $row['urutan'] ?></td>

                        <td>

                            <div class="action">

                                <a
                                    href="edit.php?id=<?= $row['id'] ?>"
                                    class="btn btn-edit">
                                    ✏ Edit
                                </a>

                                <a
                                    href="hapus.php?id=<?= $row['id'] ?>"
                                    class="btn btn-delete"
                                    onclick="return confirm('Hapus kategori ini?')">
                                    🗑 Hapus
                                </a>

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