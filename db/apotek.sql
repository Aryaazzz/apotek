-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2026 at 06:40 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `obat`
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
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id`, `nama`, `kategori`, `harga`, `stok`, `gambar`, `deskripsi`) VALUES
(27, 'Paracetamol', 'Pereda Nyeri', 13000, 96, 'https://www.pharmacyonline.co.uk/uploads/images/products/large/pharmacy-online-paracetamol-paracetamol-500mg-100-tablets-1602960473paracetamol-1.jpg', 'Paracetamol (asetaminofen) adalah obat bebas dan aman yang efektif untuk meredakan nyeri ringan hingga sedang (sakit kepala, sakit gigi, nyeri haid, otot) dan menurunkan demam.'),
(30, 'Ibuprofen', 'Anti nyeri dan anti radang', 12000, 100, 'https://res.cloudinary.com/dk0z4ums3/image/upload/v1717379647/attached_image/ibuprofen-0-alodokter.jpg', 'Nyeri Haid, Sakit Gigi, Bengkak, Nyeri Otot\r\n\r\nCATATAN:\r\nKurang cocok buat yang punya maag'),
(31, 'Amoxicillin', 'Antibiotik', 18000, 100, 'https://www.bbukltd.com/wp-content/uploads/2015/08/Amoxicillin-500mg-caps-21s-2-copy-Copy.jpg', 'Untuk Infeksi Bakteri (Radang Tenggorokan, Gigi, Saluran Kemih)\r\n\r\nCATATAN:\r\nHarus resep dokter'),
(32, 'Antasida DOEN', 'Obat Lambung', 9000, 99, 'https://selesfarma.co.id/wp-content/uploads/2020/04/Antasida-Doen.jpg', 'Untuk Maag, Perut Perih, Asam Lambung Naik'),
(33, 'Omeprazole', 'Penekan Asam Lambung', 23000, 99, 'https://m.media-amazon.com/images/I/71pBbwA1A2L._AC_UL640_QL65_.jpg', 'Untuk Gerd, Maag Kronis\r\n\r\nCATATAN:\r\nDiminum sebelum makan'),
(34, 'Ambroxol', 'Pengencer Dahak', 14000, 99, 'https://th.bing.com/th/id/R.641e9bfaaa79def98e1cca55afe1edef?rik=FdHHndmGt%2fL8kA&riu=http%3a%2f%2fquefarmacia.com%2fwp-content%2fuploads%2f2017%2f05%2f7502223700963_1.jpg&ehk=wytHKRNSEF6DPlYNFiuEQ7oRUouWIghtZjhnelcsRr8%3d&risl=&pid=ImgRaw&r=0', 'Untuk Batuk Berdahak Kental'),
(35, 'Asam Mefenamat', 'Analgesik', 6000, 99, 'https://img-cdn.medkomtek.com/Jw04hnraQ3k-A-6LPVqnEyoTCNo=/0x0/smart/filters:quality(75):strip_icc():format(webp)/drugs/BjOoCBSYRYtfgquPa6Mxw/original/OBT0005410.jpg', 'Mengatasi Nyeri Sedang Seperti Sakit Gigi'),
(36, 'Panadol', 'analgetik', 12000, 100, 'https://storage.googleapis.com/rxstorage/Product/Photos/farmaku_panadol-biru-strip-10-tablet-01.jpg', 'Mengandung Paracetamol Untuk Meredakan Demam Dan Nyeri Ringan Hingga Sedang '),
(37, 'Gaviscon ', 'antasida', 30000, 100, 'https://medino-product.imgix.net/gaviscon-double-action-24-tablets-5f2f7d0aac4fc8247346c238bdece220.png?h=557&bg=FFF&auto=format,compress&q=60', 'Membentuk Lapisan Pelindung Di Lambung Untuk Mengurangi Rasa Panas Akibat Asam Lambung Naik'),
(38, 'Rennie', 'Antasida Kunyah', 15000, 100, 'https://www.rennie.co.uk/sites/g/files/vrxlpx55136/files/2024-09/PDP_peppermint_0.png', 'Tablet Kunyah Untuk Menetralkan Asam Lambung Dengan Cepat'),
(39, 'Enzyplex', 'Enzim Pencernaan', 20000, 100, 'https://medicastore.com/images/produk/NEW-ENZYPLEX-TABLET-100-S_-Il-a_Medicastore.webp', 'Membantu Proses Pencernaan Makanan Dan Mengurangi Perut kembung'),
(40, 'Microlax', 'Laksatif Rektal ', 25000, 100, 'https://www.pharos.co.id/wp-content/uploads/2022/11/mic1.jpg', 'Membantu Melunakkan Fases Untuk Menegatasi Sembelit'),
(41, 'Norit', 'Obat Diare', 9000, 100, 'https://image.makewebeasy.net/makeweb/m_1920x0/aDHlzCExY/DefaultData/CD98575E_9694_40F4_89FB_9EE809B5CABF.jpeg?v=202405291424', 'Mengandung Karbon Aktif Untuk  Menyerap Racun Penyebab Diare'),
(42, 'Canestem cream ', 'Anti Jamur', 20000, 100, 'https://www.canesten.co.id/sites/g/files/vrxlpx40286/files/2022-01/canesten-id-1_0.png', 'Mengatasi Infeksi Jamur Pada Kulit Seperti Kurap Dan Kutu Air'),
(43, 'Bioplacenton ', 'Salep Luka', 18000, 100, 'https://medicastore.com/uploads/images/XuUx9_Medicastore_Produk-Bioplacenton.jpg', 'Membantu Penyembuhan Luka Bakar Ringan Dan Luka Terbuka Kecil'),
(44, 'Hotin Cream', 'Salep Hangat', 16000, 100, 'https://yoline.co.id/media/products/ProductTube_hotincream_120ml.png', 'Memberikan Sensasi Hangat Untuk Pegal-Pegal'),
(45, 'Feminax', 'Nyeri Haid', 9000, 100, 'https://solvent-production.s3.amazonaws.com/media/images/products/2021/12/DSC_0802.JPG', 'Meredakan Nyeri Haid Saat Menstruasi'),
(46, 'Sanmol', 'Analgesik & Antipiretik', 5000, 100, 'https://zera.zensemitraraya.com/wp-content/uploads/2021/08/305.jpg', 'Menurunkan Demam Dan Meredakan Nyeri Ringan Hingga Sedang Seperti Sakit Kepala,Sakit Gigi,Pegal,Dan Nyeri Setelah Imunisasi.\r\n'),
(47, 'Captopril', 'Antihipertensi ', 10000, 100, 'https://res-5.cloudinary.com/dk0z4ums3/image/upload/c_scale,h_500,w_500/v1/production/pharmacy/products/1702541604_captopril_kf_25mg_tablet_%281%29', 'Obat untuk menurunkan tekanan darah tinggi dengan membantu melebarkan pembuluh darah. Digunakan rutin sesuai resep dokter dan bisa menyebabkan pusing di awal pemakaian.'),
(48, 'Ranitidine ', 'Obat Lambung', 6000, 100, 'https://primayahospital.b-cdn.net/wp-content/uploads/2024/03/C-19-1536x1024.jpg', 'Digunakan untuk mengurangi produksi asam lambung pada Maag Dan Nyeri Ulu Hati.Bekerja dengan menghambat reseptor histamin di lambung sehingga asam lambung berkurang. '),
(49, 'Bisacodyl', 'Laksatif', 7000, 100, 'https://img.lazcdn.com/g/p/a4b32869c1b1ec62129246b799fe8b83.jpg_720x720q80.jpg_.webp', 'Obat untuk mengatasi sembelit dengan merangsang gerakan usus agar buang air besar lebih lancar.'),
(50, 'Azithromycin', 'Antibiotik ', 30000, 100, 'https://smartwaywellness.com/wp-content/uploads/2023/08/AZITREAT-250-6-Tab-1-1.jpg?x69687', 'Digunakan untuk mengatasi infeksi bakteri seperti infeksi saluran pernafasan dan kulit.Harus digunakan sesuai resep dokter dan dihabiskan.'),
(51, 'Ciprofloxacin ', 'Antibiotik', 18000, 100, 'https://medicastore.com/images/produk/CIPROFLOXACIN-500MG-TABLET-100,S-(HJ)_9XtNP_Medicastore.webp', 'Mengobati infeksi bakteri seperti infeksi saluran kemeih dan pencernaan. Digunakan Sesuai Anjuran Dokter.'),
(52, 'Prednisone', 'Kortikosteroid', 10000, 100, 'https://primayahospital.b-cdn.net/wp-content/uploads/2024/06/C-4-1024x643.jpg', 'Digunakan untuk mengatasi peradangan dan reaksi alergi berat. Tidak Boleh Dihentikan Mendadak Tanpa Petunjuk Dokter.'),
(53, 'Methylprednisolone', 'Kortikosteroid', 15000, 100, 'https://www.hexpharmjaya.com/generik/wp-content/uploads/2023/06/Methylprednisolone-16mg-1536x1024.jpg', 'Mengurangi peradangan dan pembengkakan akibat alergi atau gangguan autoimun. Harus Sesuai Resep Dokter.'),
(54, 'Cetirizine', 'Antihistamin', 8000, 100, 'https://medicastore.com/uploads/images/YkN3R_Medicastore_Produk-Cetirizine-HCl.jpg', 'Meredakan alergi seperti gatal, bersin, dan biduran.'),
(55, 'Loratadine', 'Antihistamin', 10000, 100, 'https://www.gosupps.com/media/catalog/product/7/1/71pgV-hSboL.jpg', 'Untuk Meredakan Alergi seperti Gatal, Bersin, dan Pilek'),
(56, 'Dexamethasone', 'Kortikosteroid', 5000, 100, 'https://tse2.mm.bing.net/th/id/OIP.eExeoKgte79JNi42CvTsXgHaHa?rs=1&pid=ImgDetMain&o=7&rm=3', 'Mengurangi Peradangan dan Reaksi Alergi Berat'),
(57, 'Clindamycin', 'Antibiotik', 25000, 100, 'https://medarchive.us/wp-content/uploads/2022/09/Clindamycin.png', 'Mengobati Infeksi Bakteri, Terutama Pada Kulit dan Jaringan Lunak'),
(58, 'Erythromycin', 'Antibiotik', 12000, 100, 'https://images.fineartamerica.com/images-medium-large-5/2-erythromycin-antibiotic-drug-dr-p-marazziscience-photo-library.jpg', 'Digunakan Untuk Infeksi Saluran Pernapasan dan Kulit'),
(59, 'Loperamide', 'Obat Diare', 8000, 100, 'https://ionicpharma.co.uk/cdn/shop/products/Loperamide6s_1024x1024.jpg?v=1669980225', 'Mengurangi Frekuensi Buang Air Besar Saat Diare'),
(60, 'Domperidone', 'Antiemetik', 10000, 100, 'https://www.crescentpharma.com/wp-content/uploads/2017/11/Domperidone-10mg-Tablets_100s.png', 'Mengatasi Mual dan Muntah'),
(61, 'Simethicone', 'Antiflatulen', 7000, 100, 'https://m.media-amazon.com/images/I/71rkrn4GA0L.jpg', 'Mengurangi Kembung Akibat Gas Berlebih'),
(62, 'Ketoconazole', 'Antijamur', 15000, 100, 'https://5.imimg.com/data5/SELLER/Default/2025/2/487205734/BM/TO/BH/239537361/ketoconazole-cream-1000x1000.jpg', 'Mengobati Infeksi Jamur Pada Kulit'),
(63, 'Salbutamol', 'Obat Asma', 20000, 100, 'https://image.made-in-china.com/2f0j00wWOqhBsFzKbA/Salbutamol-Aerosol-100mcg-Dose-Bronchial-Antiasthmatic.jpg', 'Membantu melegakan saluran napas pada asma'),
(64, 'Amlodipine', 'Antihipertensi', 12000, 100, 'https://caodangyduocsaigon.vn/images/files/caodangyduocsaigon.vn/thuoc-amlodipine-1.jpg', 'Menurunkan tekanan darah tinggi'),
(65, 'Metformin', 'Antidiabetik', 15000, 100, 'https://aavelonepharma.com/wp-content/uploads/metformin.png', 'Mengontrol kadar gula darah pada diabetes'),
(66, 'CTM', 'Antihistamin', 4000, 100, 'https://d2qjkwm11akmwu.cloudfront.net/products/634655_15-7-2019_9-41-59.jpg', 'Mengatasi alergi, tapi bisa menyebabkan ngantuk'),
(67, 'Betadine', 'Antiseptik', 10000, 100, 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full/1030/betadine_betadine-antiseptic-solution-obat-luka-15ml_full02.jpg', 'Membersihkan luka agar tidak infeksi'),
(68, 'Gentamicin', 'Antibiotik Salep', 12000, 100, 'https://res-2.cloudinary.com/dk0z4ums3/image/upload/c_scale,h_500,w_500/v1/production/pharmacy/products/1694344668_gentamicin_salep', 'Mengobati infeksi bakteri pada kulit'),
(69, 'Hydrocortisone Cream', 'Salep Anti Radang', 10000, 100, 'https://fsastore.com/dw/image/v2/BFKW_PRD/on/demandware.static/-/Sites-hec-master/default/dw5a6871e5/images/large/777882-Z-3.jpg?sw=2700', 'Mengurangi gatal, iritasi, dan ruam kulit'),
(70, 'Oralit', 'Rehidrasi', 5000, 100, 'https://static.cdntap.com/tap-assets-prod/wp-content/uploads/sites/24/2021/03/oralit-6.jpg?width=450&quality=90', 'Mengganti cairan tubuh saat diare atau dehidrasi'),
(71, 'Zinc Sulfate', 'Suplemen', 8000, 100, 'https://www.risinghealth.com/wp-content/uploads/2022/11/Zinc-sulfate-tablets-1.png', 'Membantu mempercepat penyembuhan diare'),
(72, 'Neurobion', 'Vitamin', 20000, 100, 'https://24apteka.mk/wp-content/uploads/2023/09/NEUROBION_TABS_60S-2000x2000_20221219152822.webp', 'Menjaga kesehatan saraf'),
(73, 'Captopril', 'Antihipertensi', 8000, 100, 'https://image.made-in-china.com/2f0j00dqvVOZpGncYQ/Captopril-Tablet-25mg-Circulatory-System.webp', 'Menurunkan Tekanan Darah dan Membantu Kerja Jantung'),
(74, 'Furosemide', 'Diuretik', 7000, 100, 'https://th.bing.com/th/id/R.425e34777e4dae8c82345c629117d7d9?rik=Mr5%2f4XhyJc9zNA&riu=http%3a%2f%2fwww.dutch.com%2fcdn%2fshop%2ffiles%2f2023_02_Dutch_ProductImage_Furosemide_1024x.jpg%3fv%3d1719876301&ehk=Ik0kxhqIKV%2f3r0jvlhXfM0%2brniqTcipP75CQH3Wk9K8%3d', 'Membantu mengurangi kelebihan cairan dalam tubuh (edema)'),
(75, 'Doxycycline', 'Antibiotik', 15000, 100, 'https://image.made-in-china.com/2f0j00LJViltzwgHpu/Doxycycline-Hyclate-Capsules-100mg-Antibiotics-Medicine-Products-with-GMP-Certification.jpg', 'Mengobati infeksi bakteri seperti jerawat dan infeksi saluran napas'),
(76, 'Azithromycin', 'Antibiotik', 20000, 100, 'https://cdn11.bigcommerce.com/s-3i4vrf3l81/images/stencil/1920w/products/234/502/6CD9EA13-9CCE-489C-8539-1E6541A4C038__47232.1616975973.jpg?c=1', 'Digunakan untuk infeksi saluran pernapasan, kulit, dan telinga'),
(77, 'Miconazole', 'Antijamur', 10000, 100, 'https://www.careformulationlabs.com/uploaded_files/miconazole-15gm.jpg', 'Mengobati infeksi jamur pada kulit seperti panu atau kurap'),
(78, 'Acyclovir', 'Antivirus', 15000, 100, 'https://5.imimg.com/data5/SELLER/Default/2021/10/AL/TP/RM/10880774/acyclovir-tablets-ip-1000x1000.jpg', 'Mengobati infeksi virus seperti herpes'),
(79, 'Lansoprazole', 'Obat Lambung', 18000, 100, 'https://www.dailychemist.com/wp-content/uploads/2018/02/lansoprazole-1.jpg', 'Mengurangi asam lambung dan mengatasi tukak lambung'),
(80, 'Sucralfate', 'Obat Lambung', 12000, 100, 'https://goodmedtoday.com/wp-content/uploads/2025/09/Sucralfate-Tablets-1gram.webp', 'Melindungi dinding lambung dari iritasi asam'),
(81, 'Allopurinol', 'Antigout', 12000, 100, 'https://rsum.bandaacehkota.go.id/wp-content/uploads/2024/07/allopurinol-100-TRIMAN.jpg', 'Menurunkan kadar asam urat dalam darah '),
(82, 'Phenylephrine', 'Dekongestan', 8000, 100, 'https://cdn.commercev3.net/cdn.bernell.com/images/uploads/7260_13763_popup.jpg', 'Meredakan hidung tersumbat akibat flu atau alergi');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
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
-- Table structure for table `pesanan_obat`
--

CREATE TABLE `pesanan_obat` (
  `id` int(11) NOT NULL,
  `pesanan_id` int(11) NOT NULL,
  `obat_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pesanan`
--

CREATE TABLE `riwayat_pesanan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `keluhan` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `selesai_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riwayat_pesanan`
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
-- Table structure for table `riwayat_pesanan_obat`
--

CREATE TABLE `riwayat_pesanan_obat` (
  `id` int(11) NOT NULL,
  `riwayat_id` int(11) NOT NULL,
  `obat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riwayat_pesanan_obat`
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','pembeli') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(7, 'admin', 'admin@apotek.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
(8, 'pembeli', 'pembeli@apotek.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'pembeli');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan_obat`
--
ALTER TABLE `pesanan_obat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan_id` (`pesanan_id`),
  ADD KEY `obat_id` (`obat_id`);

--
-- Indexes for table `riwayat_pesanan`
--
ALTER TABLE `riwayat_pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_pesanan_obat`
--
ALTER TABLE `riwayat_pesanan_obat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- AUTO_INCREMENT for table `pesanan_obat`
--
ALTER TABLE `pesanan_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `riwayat_pesanan`
--
ALTER TABLE `riwayat_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `riwayat_pesanan_obat`
--
ALTER TABLE `riwayat_pesanan_obat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pesanan_obat`
--
ALTER TABLE `pesanan_obat`
  ADD CONSTRAINT `pesanan_obat_ibfk_1` FOREIGN KEY (`pesanan_id`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanan_obat_ibfk_2` FOREIGN KEY (`obat_id`) REFERENCES `obat` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
