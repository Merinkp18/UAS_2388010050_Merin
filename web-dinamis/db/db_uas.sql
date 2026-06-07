-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 07, 2026 at 02:28 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uas`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int UNSIGNED NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama_lengkap`, `email`, `password`) VALUES
(1, 'admin', 'admin@optik.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- --------------------------------------------------------

--
-- Table structure for table `alamat`
--

CREATE TABLE `alamat` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `label` varchar(50) NOT NULL COMMENT 'cth: Rumah, Kantor',
  `nama_penerima` varchar(100) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `provinsi` varchar(100) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `alamat_lengkap` text NOT NULL,
  `is_utama` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int UNSIGNED NOT NULL,
  `judul` varchar(150) DEFAULT NULL,
  `gambar` varchar(255) NOT NULL,
  `url_tuju` varchar(255) DEFAULT NULL,
  `urutan` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `is_aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id` int UNSIGNED NOT NULL,
  `pesanan_id` int UNSIGNED NOT NULL,
  `varian_id` int UNSIGNED NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `warna` varchar(50) NOT NULL,
  `ukuran` varchar(20) DEFAULT NULL,
  `foto_url` varchar(255) DEFAULT NULL,
  `harga_satuan` decimal(12,2) NOT NULL,
  `jumlah` tinyint UNSIGNED NOT NULL,
  `subtotal` decimal(12,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foto_produk`
--

CREATE TABLE `foto_produk` (
  `id` int UNSIGNED NOT NULL,
  `produk_id` int UNSIGNED NOT NULL,
  `warna` varchar(50) DEFAULT NULL,
  `url_foto` varchar(255) NOT NULL,
  `is_utama` tinyint(1) NOT NULL DEFAULT '0',
  `urutan` tinyint UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `deskripsi` text,
  `gambar` varchar(255) DEFAULT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `slug`, `deskripsi`, `gambar`, `urutan`, `created_at`) VALUES
(1, 'Frame Kacamata', 'frame-kacamata', NULL, NULL, 1, '2026-06-07 09:28:12'),
(2, 'Kacamata Baca', 'kacamata-baca', NULL, NULL, 2, '2026-06-07 09:28:12'),
(3, 'Kacamata Hitam', 'kacamata-hitam', NULL, NULL, 3, '2026-06-07 09:28:12'),
(4, 'Kacamata Anak', 'kacamata-anak', NULL, NULL, 4, '2026-06-07 09:28:12'),
(5, 'Lensa', 'lensa', NULL, NULL, 5, '2026-06-07 09:28:12'),
(6, 'Lensa Kontak', 'lensa-kontak', NULL, NULL, 6, '2026-06-07 09:28:12'),
(7, 'Cairan Lensa Kontak', 'cairan-lensa-kontak', NULL, NULL, 7, '2026-06-07 09:28:12'),
(8, 'Aksesoris', 'aksesoris', NULL, NULL, 8, '2026-06-07 09:28:12');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `varian_id` int UNSIGNED NOT NULL,
  `jumlah` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kupon`
--

CREATE TABLE `kupon` (
  `id` int UNSIGNED NOT NULL,
  `kode` varchar(30) NOT NULL,
  `tipe_diskon` enum('persen','nominal') NOT NULL,
  `nilai_diskon` decimal(10,2) NOT NULL,
  `min_belanja` decimal(12,2) NOT NULL DEFAULT '0.00',
  `maks_diskon` decimal(12,2) DEFAULT NULL,
  `kuota` int UNSIGNED DEFAULT NULL,
  `terpakai` int UNSIGNED NOT NULL DEFAULT '0',
  `berlaku_mulai` date NOT NULL,
  `berlaku_sampai` date NOT NULL,
  `is_aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `merek`
--

CREATE TABLE `merek` (
  `id` int UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `is_aktif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `merek`
--

INSERT INTO `merek` (`id`, `nama`, `slug`, `logo`, `is_aktif`) VALUES
(1, 'Oakley', 'oakley', NULL, 1),
(2, 'Ray-Ban', 'ray-ban', NULL, 1),
(3, 'Prada', 'prada', NULL, 1),
(4, 'Essilor', 'essilor', NULL, 1),
(5, 'Hoya', 'hoya', NULL, 1),
(6, 'Lokal / No Brand', 'lokal', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int UNSIGNED NOT NULL,
  `pesanan_id` int UNSIGNED NOT NULL,
  `metode` varchar(50) NOT NULL COMMENT 'cth: transfer_bca, gopay, qris',
  `no_referensi` varchar(100) DEFAULT NULL,
  `jumlah` decimal(12,2) NOT NULL,
  `status` enum('pending','sukses','gagal','refund') NOT NULL DEFAULT 'pending',
  `bukti_transfer` varchar(255) DEFAULT NULL,
  `dibayar_pada` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `kode_pesanan` varchar(30) NOT NULL COMMENT 'cth: OPT-20240601-0001',
  `kupon_id` int UNSIGNED DEFAULT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `diskon_kupon` decimal(12,2) NOT NULL DEFAULT '0.00',
  `ongkos_kirim` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(12,2) NOT NULL,
  `nama_penerima` varchar(100) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `kota` varchar(100) NOT NULL,
  `provinsi` varchar(100) NOT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `ekspedisi` varchar(50) DEFAULT NULL,
  `layanan` varchar(50) DEFAULT NULL,
  `no_resi` varchar(100) DEFAULT NULL,
  `status` enum('menunggu_pembayaran','dibayar','diproses','dikirim','selesai','dibatalkan','dikembalikan') NOT NULL DEFAULT 'menunggu_pembayaran',
  `catatan` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int UNSIGNED NOT NULL,
  `kategori_id` int UNSIGNED NOT NULL,
  `merek_id` int UNSIGNED DEFAULT NULL,
  `nama` varchar(200) NOT NULL,
  `slug` varchar(220) NOT NULL,
  `deskripsi` text,
  `material` varchar(100) DEFAULT NULL COMMENT 'cth: Titanium, Plastik, TR90',
  `bentuk_frame` varchar(50) DEFAULT NULL COMMENT 'cth: Oval, Square, Cat Eye, Round',
  `jenis_lensa` varchar(100) DEFAULT NULL COMMENT 'cth: Minus, Plus, Bifokal, Anti Radiasi (untuk produk lensa)',
  `harga` decimal(12,2) NOT NULL,
  `harga_coret` decimal(12,2) DEFAULT NULL,
  `berat_gram` smallint UNSIGNED DEFAULT NULL,
  `is_aktif` tinyint(1) NOT NULL DEFAULT '1',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `terjual` int UNSIGNED NOT NULL DEFAULT '0',
  `rating_avg` decimal(3,2) NOT NULL DEFAULT '0.00',
  `rating_count` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id` int UNSIGNED NOT NULL,
  `pesanan_id` int UNSIGNED NOT NULL,
  `produk_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `rating` tinyint UNSIGNED NOT NULL COMMENT '1-5 bintang',
  `komentar` text,
  `foto_1` varchar(255) DEFAULT NULL,
  `foto_2` varchar(255) DEFAULT NULL,
  `foto_3` varchar(255) DEFAULT NULL,
  `is_terverifikasi` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Triggers `ulasan`
--
DELIMITER $$
CREATE TRIGGER `trg_update_rating_delete` AFTER DELETE ON `ulasan` FOR EACH ROW BEGIN
  UPDATE produk
  SET rating_avg   = COALESCE((SELECT AVG(rating) FROM ulasan WHERE produk_id = OLD.produk_id), 0),
      rating_count = (SELECT COUNT(*) FROM ulasan WHERE produk_id = OLD.produk_id)
  WHERE id = OLD.produk_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_update_rating_insert` AFTER INSERT ON `ulasan` FOR EACH ROW BEGIN
  UPDATE produk
  SET rating_avg   = (SELECT AVG(rating) FROM ulasan WHERE produk_id = NEW.produk_id),
      rating_count = (SELECT COUNT(*)    FROM ulasan WHERE produk_id = NEW.produk_id)
  WHERE id = NEW.produk_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `foto_profil` varchar(255) DEFAULT NULL,
  `is_aktif` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `varian_produk`
--

CREATE TABLE `varian_produk` (
  `id` int UNSIGNED NOT NULL,
  `produk_id` int UNSIGNED NOT NULL,
  `warna` varchar(50) NOT NULL COMMENT 'cth: Hitam, Gold, Tortoise',
  `kode_warna` varchar(7) DEFAULT NULL COMMENT 'Hex color',
  `ukuran` varchar(20) DEFAULT NULL COMMENT 'cth: 50-18-140 (lens-bridge-temple mm)',
  `stok` smallint UNSIGNED NOT NULL DEFAULT '0',
  `sku` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `produk_id` int UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `alamat`
--
ALTER TABLE `alamat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan_id` (`pesanan_id`),
  ADD KEY `varian_id` (`varian_id`);

--
-- Indexes for table `foto_produk`
--
ALTER TABLE `foto_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_keranjang` (`user_id`,`varian_id`),
  ADD KEY `varian_id` (`varian_id`);

--
-- Indexes for table `kupon`
--
ALTER TABLE `kupon`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode` (`kode`);

--
-- Indexes for table `merek`
--
ALTER TABLE `merek`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pesanan_id` (`pesanan_id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_pesanan` (`kode_pesanan`),
  ADD KEY `kupon_id` (`kupon_id`),
  ADD KEY `idx_pesanan_user` (`user_id`),
  ADD KEY `idx_pesanan_status` (`status`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_produk_kategori` (`kategori_id`),
  ADD KEY `idx_produk_merek` (`merek_id`),
  ADD KEY `idx_produk_aktif` (`is_aktif`),
  ADD KEY `idx_produk_featured` (`is_featured`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan_id` (`pesanan_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_ulasan_produk` (`produk_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `varian_produk`
--
ALTER TABLE `varian_produk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD UNIQUE KEY `uq_varian` (`produk_id`,`warna`,`ukuran`),
  ADD KEY `idx_varian_produk` (`produk_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_wishlist` (`user_id`,`produk_id`),
  ADD KEY `produk_id` (`produk_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `alamat`
--
ALTER TABLE `alamat`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foto_produk`
--
ALTER TABLE `foto_produk`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kupon`
--
ALTER TABLE `kupon`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `merek`
--
ALTER TABLE `merek`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `varian_produk`
--
ALTER TABLE `varian_produk`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alamat`
--
ALTER TABLE `alamat`
  ADD CONSTRAINT `alamat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_pesanan_ibfk_2` FOREIGN KEY (`varian_id`) REFERENCES `varian_produk` (`id`);

--
-- Constraints for table `foto_produk`
--
ALTER TABLE `foto_produk`
  ADD CONSTRAINT `foto_produk_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `keranjang_ibfk_2` FOREIGN KEY (`varian_id`) REFERENCES `varian_produk` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`kupon_id`) REFERENCES `kupon` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`),
  ADD CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`merek_id`) REFERENCES `merek` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `ulasan_ibfk_1` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`),
  ADD CONSTRAINT `ulasan_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ulasan_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `varian_produk`
--
ALTER TABLE `varian_produk`
  ADD CONSTRAINT `varian_produk_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
