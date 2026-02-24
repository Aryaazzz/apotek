-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Feb 2026 pada 23.10
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotek`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `gambar` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id`, `nama`, `kategori`, `harga`, `stok`, `gambar`, `deskripsi`) VALUES
(27, 'Paracetamol', 'Pereda Nyeri', 13000, 100, 'https://www.pharmacyonline.co.uk/uploads/images/products/large/pharmacy-online-paracetamol-paracetamol-500mg-100-tablets-1602960473paracetamol-1.jpg', 'Paracetamol (asetaminofen) adalah obat bebas dan aman yang efektif untuk meredakan nyeri ringan hingga sedang (sakit kepala, sakit gigi, nyeri haid, otot) dan menurunkan demam.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `keluhan` varchar(255) DEFAULT NULL,
  `obat` text DEFAULT NULL,
  `obat_id` int(11) DEFAULT NULL,
  `status` enum('menunggu','proses','selesai') DEFAULT 'menunggu',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) DEFAULT 1,
  `nama_pembeli` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan_obat`
--

CREATE TABLE `pesanan_obat` (
  `id` int(11) NOT NULL,
  `pesanan_id` int(11) NOT NULL,
  `obat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_pesanan`
--

CREATE TABLE `riwayat_pesanan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `keluhan` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `selesai_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `riwayat_pesanan`
--

INSERT INTO `riwayat_pesanan` (`id`, `user_id`, `keluhan`, `created_at`, `selesai_at`) VALUES
(1, 8, 'batuk,demam,ginjal', '2026-01-25 22:50:56', '2026-01-25 22:53:17'),
(2, 7, 'batuk,demam,ginjal', '2026-01-25 22:53:24', '2026-01-25 22:53:32'),
(3, 8, 'batuk,demam,ginjal', '2026-01-25 22:58:59', NULL),
(4, 8, 'batuk,demam,ginjal', '2026-01-25 23:00:18', NULL),
(5, 7, 'batuk,demam,ginjal', '2026-01-25 23:01:59', NULL),
(6, 7, 'batuk,demam,ginjal', '2026-01-25 23:02:53', NULL),
(7, 7, 'sakit anjay', '2026-01-25 23:03:58', NULL),
(8, 8, '', '2026-01-25 23:25:48', NULL),
(9, 8, 'batuk', '2026-01-25 23:26:08', NULL),
(10, 8, 'batuk', '2026-01-25 23:27:48', NULL),
(11, 8, 'batuk', '2026-01-25 23:28:36', NULL),
(12, 7, 'batuk', '2026-01-25 23:39:33', NULL),
(13, 8, 'aaa', '2026-01-26 15:26:42', NULL),
(14, 8, 'batuk', '2026-01-26 15:33:31', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat_pesanan_obat`
--

CREATE TABLE `riwayat_pesanan_obat` (
  `id` int(11) NOT NULL,
  `riwayat_id` int(11) NOT NULL,
  `obat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `riwayat_pesanan_obat`
--

INSERT INTO `riwayat_pesanan_obat` (`id`, `riwayat_id`, `obat_id`) VALUES
(1, 1, 19),
(2, 2, 19),
(3, 3, 18),
(4, 4, 20),
(5, 5, 20),
(6, 6, 18),
(7, 7, 19),
(8, 8, 21),
(9, 9, 21),
(10, 10, 19),
(11, 11, 18),
(12, 12, 19),
(13, 13, 21),
(14, 14, 18);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','pembeli') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(7, 'admin', 'admin@apotek.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
(8, 'pembeli', 'pembeli@apotek.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pembeli');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan_obat`
--
ALTER TABLE `pesanan_obat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan_id` (`pesanan_id`),
  ADD KEY `obat_id` (`obat_id`);

--
-- Indeks untuk tabel `riwayat_pesanan`
--
ALTER TABLE `riwayat_pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `riwayat_pesanan_obat`
--
ALTER TABLE `riwayat_pesanan_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT untuk tabel `pesanan_obat`
--
ALTER TABLE `pesanan_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT untuk tabel `riwayat_pesanan`
--
ALTER TABLE `riwayat_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `riwayat_pesanan_obat`
--
ALTER TABLE `riwayat_pesanan_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pesanan_obat`
--
ALTER TABLE `pesanan_obat`
  ADD CONSTRAINT `pesanan_obat_ibfk_1` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanan_obat_ibfk_2` FOREIGN KEY (`obat_id`) REFERENCES `obat` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
