<?php
session_start();
require "config/database.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header("Location: login.php");
  exit;
}

$totalObat = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM obat"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Apotek - Ramadhan</title>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">

<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* {
  font-family: 'Quicksand', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

body{
  background: linear-gradient(135deg, #f8fafb 0%, #e8f5e9 50%, #f0f9ff 100%);
  background-size: 200% 200%;
  animation: bg 15s ease infinite;
}
@keyframes bg{
  0%{background-position: 0% 50%}
  50%{background-position: 100% 50%}
  100%{background-position: 0% 50%}
}
.card {
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}
.card:hover {
  transform: translateY(-10px) scale(1.02);
  box-shadow: 0 20px 40px rgba(34, 197, 94, 0.15);
}
.section {
  display: none;
}
.section.active {
  display: block;
  animation: fade 0.4s ease;
}
@keyframes fade {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* ===== TOAST NOTIFICATION ===== */
@keyframes slideInRight {
  from {
    transform: translateX(400px);
    opacity: 0;
  }
  to {
    transform: translateX(0);
    opacity: 1;
  }
}

@keyframes slideOutRight {
  from {
    transform: translateX(0);
    opacity: 1;
  }
  to {
    transform: translateX(400px);
    opacity: 0;
  }
}

@keyframes checkmarkAnimation {
  0% {
    transform: scale(0) rotate(-45deg);
    opacity: 0;
  }
  50% {
    transform: scale(1.2) rotate(0deg);
  }
  100% {
    transform: scale(1) rotate(0deg);
    opacity: 1;
  }
}

.toast-container {
  position: fixed;
  top: 20px;
  right: 20px;
  z-index: 9999;
  max-width: 400px;
}

.toast {
  background: white;
  border-radius: 12px;
  padding: 16px;
  margin-bottom: 12px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
  animation: slideInRight 0.4s ease forwards;
  display: flex;
  align-items: center;
  gap: 12px;
}

.toast.exit {
  animation: slideOutRight 0.4s ease forwards;
}

.toast.success {
  border-left: 4px solid #10b981;
}

.toast.error {
  border-left: 4px solid #ef4444;
}

.toast.warning {
  border-left: 4px solid #f59e0b;
}

.toast-icon {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  font-size: 18px;
}

.toast.success .toast-icon {
  background: #d1fae5;
  color: #10b981;
  animation: checkmarkAnimation 0.6s ease;
}

.toast.error .toast-icon {
  background: #fee2e2;
  color: #ef4444;
}

.toast.warning .toast-icon {
  background: #fef3c7;
  color: #f59e0b;
}

.toast-content {
  flex: 1;
}

.toast-title {
  font-weight: 600;
  color: #1f2937;
  margin-bottom: 2px;
}

.toast-message {
  font-size: 14px;
  color: #6b7280;
}

.toast-close {
  background: none;
  border: none;
  color: #9ca3af;
  cursor: pointer;
  font-size: 20px;
  padding: 0;
  flex-shrink: 0;
  transition: color 0.2s;
}

.toast-close:hover {
  color: #4b5563;
}

</style>
</head>

<body class="min-h-screen text-gray-700 bg-gray-50">

<!-- TOAST NOTIFICATION CONTAINER -->
<div id="toastContainer" class="toast-container"></div>

<div class="flex min-h-screen">

<!-- SIDEBAR -->
<aside class="w-64 shadow-xl flex flex-col" style="background: linear-gradient(180deg, #0f5132 0%, #1b6a3f 100%);">
  <div class="p-8 text-center border-b-2" style="border-color: #a8e06633;">
    <div class="w-16 h-16 mx-auto rounded-full text-white flex items-center justify-center text-3xl shadow-lg" style="background: linear-gradient(135deg, #ffe066 0%, #ffb300 100%);">
      <i class="fas fa-mosque" style="color: #0f5132;"></i>
    </div>
    <h2 class="mt-4 font-bold text-xl text-white">Admin Apotek</h2>
    <p class="text-xs mt-1" style="color: #a8e063;"><i class="fas fa-moon" style="margin-right: 4px;"></i>Ramadhan 1447 H</p>
  </div>

  <nav class="p-5 space-y-1 flex-1">
    <button onclick="showSection('dashboard')" class="w-full px-4 py-3 rounded-lg text-white font-semibold transition flex items-center gap-3" style="background: rgba(168,224,99,0.25); color: #a8e063;">
      <i class="fas fa-chart-line w-5 text-center"></i> <span>Dashboard</span>
    </button>
    <button onclick="showSection('tambah')" class="w-full px-4 py-3 rounded-lg text-white hover:text-yellow-300 font-medium transition flex items-center gap-3">
      <i class="fas fa-plus w-5 text-center" style="color: #ffe066;"></i> <span>Tambah Obat</span>
    </button>
    <button onclick="showSection('obat')" class="w-full px-4 py-3 rounded-lg text-white hover:text-yellow-300 font-medium transition flex items-center gap-3">
      <i class="fas fa-list w-5 text-center" style="color: #ffe066;"></i> <span>Daftar Obat</span>
    </button>
    <button onclick="showSection('pesanan')" class="w-full px-4 py-3 rounded-lg text-white hover:text-yellow-300 font-medium transition flex items-center gap-3">
      <i class="fas fa-shopping-bag w-5 text-center" style="color: #ffe066;"></i> <span>Pesanan</span>
    </button>
  </nav>

  <div class="p-5 border-t-2" style="border-color: #a8e06633;">
    <a href="auth/logout.php" class="block text-center text-white py-3 rounded-lg font-medium transition flex items-center justify-center gap-2" style="background: linear-gradient(90deg, #d32f2f, #f44336);">
      <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
    </a>
  </div>
</aside>

<!-- MAIN -->
<div class="flex-1 flex flex-col">

<header class="shadow-md px-8 py-5 flex items-center gap-3 border-b-2" style="background: linear-gradient(90deg, #0f5132 0%, #1b6a3f 50%, #2d8a5a 100%); border-color: #a8e06633;">
  <div class="w-12 h-12 rounded-lg text-white flex items-center justify-center text-xl" style="background: linear-gradient(135deg, #ffe066 0%, #ffb300 100%);">
    <i class="fas fa-home" style="color: #0f5132;"></i>
  </div>
  <h1 class="text-2xl font-bold text-white">
    Dashboard Admin
  </h1>
</header>

<main class="p-8 space-y-8 bg-gray-50 flex-1">

<!-- DASHBOARD -->
<section id="dashboard" class="section active">
  <div class="p-10 rounded-2xl shadow-lg text-white text-center mb-10" style="background: linear-gradient(90deg, #0f5132 0%, #a8e063 100%);">
    <h2 class="text-3xl font-bold mb-2"><i class="fas fa-moon" style="margin-right: 10px;"></i>Selamat Datang Apoteker</h2>
    <p style="color: #f0fdf4;">Kelola data obat dan pesanan dengan mudah di bulan suci Ramadhan <i class="fas fa-moon"></i> <i class="fas fa-pills"></i></p>
  </div>

  <div class="grid md:grid-cols-3 gap-6 w-full">
    <div class="bg-white p-8 rounded-2xl shadow-md card hover:shadow-xl text-center border-t-4" style="border-color: #a8e063;">
      <div class="w-14 h-14 mx-auto rounded-full text-white flex items-center justify-center text-3xl mb-4" style="background: linear-gradient(135deg, #a8e063 0%, #7cb342 100%);">
        <i class="fas fa-pills"></i>
      </div>
      <p class="text-gray-600 text-sm mb-1">Total Obat</p>
      <h2 class="text-4xl font-bold" style="color: #0f5132;"><i class="fas fa-pills mr-2"></i><?= $totalObat ?></h2>
    </div>
    <div class="bg-white p-8 rounded-2xl shadow-md card hover:shadow-xl text-center border-t-4" style="border-color: #ffe066;">
      <div class="w-14 h-14 mx-auto rounded-full text-white flex items-center justify-center text-3xl mb-4" style="background: linear-gradient(135deg, #ffe066 0%, #ffb300 100%);">
        <i class="fas fa-clock"></i>
      </div>
      <p class="text-gray-600 text-sm mb-1">Status</p>
      <h2 class="text-2xl font-bold" style="color: #0f5132;">Realtime</h2>
    </div>
    <div class="bg-white p-8 rounded-2xl shadow-md card hover:shadow-xl text-center border-t-4" style="border-color: #0f5132;">
      <div class="w-14 h-14 mx-auto rounded-full text-white flex items-center justify-center text-3xl mb-4" style="background: linear-gradient(135deg, #0f5132 0%, #1b6a3f 100%);">
        <i class="fas fa-check-circle"></i>
      </div>
      <p class="text-gray-600 text-sm mb-1">Sistem</p>
      <h2 class="text-2xl font-bold" style="color: #0f5132;">Aktif</h2>
    </div>
  </div>
</section>

<!-- TAMBAH OBAT -->
<section id="tambah" class="section bg-white p-8 rounded-2xl shadow-md" style="border-top: 4px solid #a8e063;">
<h3 class="text-2xl font-bold mb-6 flex items-center gap-2" style="color: #0f5132;">
  <i class="fas fa-plus-circle" style="color: #a8e063;"></i> Tambah Obat Baru
</h3>
<form action="admin_obat_tambah.php" method="POST" class="grid md:grid-cols-2 gap-5">
  <input name="nama" placeholder="Nama Obat" class="border-2 p-3 rounded-lg focus:outline-none transition" style="border-color: #a8e06644; background: #f9f9f9;" required>
  <input name="kategori" placeholder="Kategori" class="border-2 p-3 rounded-lg focus:outline-none transition" style="border-color: #a8e06644; background: #f9f9f9;" required>
  <input name="harga" type="number" placeholder="Harga" class="border-2 p-3 rounded-lg focus:outline-none transition" style="border-color: #a8e06644; background: #f9f9f9;" required>
  <input name="gambar" placeholder="URL Gambar" class="border-2 p-3 rounded-lg focus:outline-none transition" style="border-color: #a8e06644; background: #f9f9f9;" required>
  <textarea name="deskripsi" placeholder="Deskripsi" class="border-2 p-3 rounded-lg focus:outline-none transition md:col-span-2 resize-none" style="border-color: #a8e06644; background: #f9f9f9;" rows="4"></textarea>
  <button class="text-white py-3 rounded-lg md:col-span-2 font-semibold transition flex items-center justify-center gap-2" style="background: linear-gradient(90deg, #0f5132 0%, #a8e063 100%);">
    <i class="fas fa-save"></i> Simpan Obat
  </button>
</form>
</section>

<!-- DAFTAR OBAT -->
<section id="obat" class="section bg-white p-8 rounded-2xl shadow-md" style="border-top: 4px solid #a8e063;">
<h3 class="text-2xl font-bold mb-6 flex items-center gap-2" style="color: #0f5132;">
  <i class="fas fa-list" style="color: #a8e063;"></i> Daftar Obat & Kelola Stok
</h3>

<!-- SEARCH & FILTER -->
<div class="grid md:grid-cols-3 gap-4 mb-6">
  <div class="relative">
    <input type="text" id="searchInput" placeholder="Cari nama obat..." class="w-full border-2 p-3 rounded-lg focus:outline-none transition" style="border-color: #a8e06644; background: #f9f9f9;">
  </div>
  <div>
    <select id="filterKategori" class="w-full border-2 p-3 rounded-lg focus:outline-none transition bg-white" style="border-color: #a8e06644;">
      <option value="">Semua Kategori</option>
      <?php
      $kategoris = mysqli_query($conn, "SELECT DISTINCT kategori FROM obat ORDER BY kategori ASC");
      while($k = mysqli_fetch_assoc($kategoris)):
      ?>
      <option value="<?= htmlspecialchars($k['kategori']) ?>"><?= htmlspecialchars($k['kategori']) ?></option>
      <?php endwhile; ?>
    </select>
  </div>
  <div class="text-right">
    <button onclick="resetFilter()" class="text-white px-6 py-3 rounded-lg transition font-medium flex items-center justify-center gap-2 w-full" style="background: #666;">
      <i class="fas fa-sync-alt"></i> Reset Filter
    </button>
  </div>
</div>

<div class="overflow-x-auto">
<table class="w-full">
<thead class="text-white" style="background: linear-gradient(90deg, #0f5132 0%, #a8e063 100%);">
<tr>
  <th class="p-4 text-left font-semibold">Gambar</th>
  <th class="p-4 text-left font-semibold">Nama Obat</th>
  <th class="p-4 text-left font-semibold">Kategori</th>
  <th class="p-4 text-left font-semibold">Harga</th>
  <th class="p-4 text-center font-semibold"><i class="fas fa-box"></i> Stok</th>
  <th class="p-4 text-center font-semibold">Aksi</th>
</tr>
</thead>
<tbody id="tabelObat">
<?php
$q=mysqli_query($conn,"SELECT * FROM obat ORDER BY id DESC");
while($o=mysqli_fetch_assoc($q)):
$stok = isset($o['stok']) ? $o['stok'] : 0;
$stok_color = $stok == 0 ? 'text-red-600 font-bold' : ($stok < 10 ? 'text-orange-600 font-bold' : 'text-green-600 font-bold');
?>
<tr class="border-b hover:bg-gray-50 transition obat-row" data-obat-id="<?= $o['id'] ?>">
<td class="p-4 text-center">
  <div class="w-16 h-16 mx-auto bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center border-2 border-gray-200 hover:border-opacity-70 transition" style="border-color: #a8e06633;">
    <?php if (!empty($o['gambar'])): ?>
      <img src="<?= htmlspecialchars($o['gambar']) ?>" alt="<?= htmlspecialchars($o['nama']) ?>" class="w-full h-full object-cover cursor-pointer" onclick="showImageModal('<?= htmlspecialchars($o['gambar']) ?>', '<?= htmlspecialchars($o['nama']) ?>')">
    <?php else: ?>
      <div class="text-gray-400 text-center">
        <i class="fas fa-image text-3xl"></i>
        <p class="text-xs mt-1">No Image</p>
      </div>
    <?php endif; ?>
  </div>
</td>
<td class="p-4 nama-obat"><?= htmlspecialchars($o['nama']) ?></td>
<td class="p-4 text-gray-600 kategori-obat"><?= htmlspecialchars($o['kategori']) ?></td>
<td class="p-4 font-bold" style="color: #0f5132;">Rp<?= number_format($o['harga']) ?></td>
<td class="p-4 text-center stok-display" style="color: <?= $stok == 0 ? '#ef4444' : ($stok < 10 ? '#f59e0b' : '#10b981'); ?>; font-weight: bold;"><?= $stok ?></td>
<td class="p-4 text-center">
  <div class="flex gap-2 justify-center flex-wrap">
    <button onclick="openRestokModal(<?= $o['id'] ?>, '<?= htmlspecialchars($o['nama']) ?>')" class="text-white px-3 py-2 rounded-lg transition font-medium text-sm flex items-center gap-1" style="background: linear-gradient(90deg, #a8e063 0%, #7cb342 100%);" title="Restok Obat">
      <i class="fas fa-plus-circle"></i> Restok
    </button>
    <a href="edit_obat.php?id=<?= $o['id'] ?>" class="text-white px-3 py-2 rounded-lg transition font-medium text-sm flex items-center gap-1" style="background: linear-gradient(90deg, #0f5132 0%, #1b6a3f 100%);">
      <i class="fas fa-edit"></i> Edit
    </a>
    <a href="hapus_obat.php?id=<?= $o['id'] ?>" class="text-white px-3 py-2 rounded-lg transition font-medium text-sm flex items-center gap-1" style="background: linear-gradient(90deg, #d32f2f, #f44336);">
      <i class="fas fa-trash-alt"></i> Hapus
    </a>
  </div>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
<div id="emptyMessage" class="text-center p-8 text-gray-500 hidden">
  <i class="fas fa-search text-4xl mb-3 block"></i>
  <p class="text-lg font-medium">Tidak ada obat yang cocok dengan filter</p>
</div>
</section>

<!-- PESANAN -->
<section id="pesanan" class="section bg-white p-8 rounded-2xl shadow-md" style="border-top: 4px solid #ffe066;">
<h3 class="text-2xl font-bold mb-6 flex items-center gap-2" style="color: #0f5132;">
  <i class="fas fa-shopping-bag" style="color: #ffe066;"></i> Pesanan Pelanggan (Realtime)
</h3>

<!-- SEARCH & FILTER PESANAN -->
<div class="grid md:grid-cols-4 gap-4 mb-6">
  <div class="relative">
    <input type="text" id="searchPembeli" placeholder="Cari nama pembeli..." class="w-full border-2 p-3 rounded-lg focus:outline-none transition" style="border-color: #a8e06644; background: #f9f9f9;">
  </div>
  <div>
    <input type="text" id="searchKeluhan" placeholder="Cari keluhan..." class="w-full border-2 p-3 rounded-lg focus:outline-none transition" style="border-color: #a8e06644; background: #f9f9f9;">
  </div>
  <div>
    <select id="filterStatusPesanan" class="w-full border-2 p-3 rounded-lg focus:outline-none transition bg-white" style="border-color: #a8e06644;">
      <option value="">Semua Status</option>
      <option value="proses"><i class="fas fa-hourglass-half"></i> Diproses</option>
      <option value="selesai"><i class="fas fa-check-circle"></i> Riwayat Selesai</option>
    </select>
  </div>
  <div class="flex gap-2 justify-start">
    <button onclick="resetAllPesanan()" class="text-white px-6 py-3 rounded-lg transition font-medium flex items-center justify-center gap-2" style="background: #d32f2f;">
      <i class="fas fa-trash-alt"></i> Reset Semua
    </button>
  </div>
</div>

<div class="overflow-x-auto">
<table class="w-full">
<thead class="text-white" style="background: linear-gradient(90deg, #ff9800 0%, #ffb74d 100%);">
<tr>
  <th class="p-4 text-left font-semibold">Pembeli</th>
  <th class="p-4 text-left font-semibold">Keluhan</th>
  <th class="p-4 text-center font-semibold">Status</th>
  <th class="p-4 text-center font-semibold">Aksi</th>
</tr>
</thead>
<tbody id="tabelPesanan"></tbody>
</table>
</div>
<div id="emptyMessagePesanan" class="text-center p-8 text-gray-500 hidden">
  <i class="fas fa-search text-4xl mb-3 block"></i>
  <p class="text-lg font-medium">Tidak ada pesanan yang cocok dengan filter</p>
</div>
</section>

<!-- MODAL PILIH OBAT -->
<div id="modalObat" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white rounded-2xl p-8 w-full max-w-2xl max-h-96 overflow-y-auto">
    <h3 class="text-2xl font-bold mb-6 flex items-center gap-2" style="color: #0f5132;">
      <i class="fas fa-pills" style="color: #a8e063;"></i> Pilih Obat untuk Pesanan
    </h3>
    <p class="text-sm text-gray-600 mb-4 p-3 rounded-lg" style="background: #f0f9ff;">
      <i class="fas fa-info-circle mr-2"></i> Pilih minimal 1 obat sebelum menyelesaikan pesanan
    </p>
    <div class="mb-4">
      <input type="text" id="searchObatModal" placeholder="Cari obat..." class="w-full px-4 py-2 border-2 rounded-lg focus:outline-none transition" style="border-color: #a8e06644; background: #f9f9f9;" />
    </div>
    <div id="daftarObatModal" class="space-y-3 mb-6">
      <!-- obat akan di-render di sini -->
    </div>
    <div class="flex gap-3 justify-end">
      <button onclick="closeModalObat()" class="text-white px-6 py-3 rounded-lg transition font-medium" style="background: #666;">
        <i class="fas fa-times mr-2"></i> Batal
      </button>
      <button onclick="submitObat()" class="text-white px-6 py-3 rounded-lg transition font-medium" style="background: linear-gradient(90deg, #0f5132 0%, #a8e063 100%);">
        <i class="fas fa-check mr-2"></i> Selesaikan Pesanan
      </button>
    </div>
  </div>
</div>

<!-- MODAL RESTOK OBAT -->
<div id="modalRestok" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
  <div class="bg-white rounded-2xl p-8 w-full max-w-md">
    <h3 class="text-2xl font-bold text-purple-700 mb-2 flex items-center gap-2">
      <i class="fas fa-boxes"></i> Restok Obat
    </h3>
    <p id="restokObatNama" class="text-gray-600 mb-6 text-lg font-semibold"></p>
    
    <div class="space-y-5 mb-6">
      <div>
        <label class="block text-gray-700 font-semibold mb-2">Stok Saat Ini</label>
        <input type="text" id="restokStokSaatIni" readonly class="w-full px-4 py-3 bg-gray-100 border-2 border-gray-300 rounded-lg text-gray-700 font-bold text-lg">
      </div>
      
      <div>
        <label class="block text-gray-700 font-semibold mb-2">Jumlah Tambah</label>
        <input type="number" id="restokJumlah" min="1" placeholder="Masukkan jumlah..." class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-purple-500 transition" value="0">
      </div>
      
      <div class="bg-purple-50 p-4 rounded-lg border-l-4 border-purple-500">
        <p class="text-sm text-gray-600 mb-2">Stok Setelah Restok:</p>
        <p id="restokPreview" class="text-2xl font-bold text-purple-600">0</p>
      </div>
    </div>

    <div class="flex gap-3 justify-end">
      <button onclick="closeRestokModal()" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-3 rounded-lg transition font-medium">
        <i class="fas fa-times mr-2"></i> Batal
      </button>
      <button onclick="submitRestok()" class="bg-purple-500 hover:bg-purple-600 text-white px-6 py-3 rounded-lg transition font-medium flex items-center gap-2">
        <i class="fas fa-save"></i> Simpan Restok
      </button>
    </div>
  </div>
</div>

</main>
</div>
</div>

<script>
let currentRestokObatId = null;
let currentRestokObatNama = null;

function showSection(id){
  document.querySelectorAll('.section').forEach(s=>s.classList.remove('active'));
  document.getElementById(id).classList.add('active');
}

// ===== TOAST NOTIFICATION =====
function showToast(title, message, type = 'success', duration = 4000) {
  const container = document.getElementById('toastContainer');
  const toast = document.createElement('div');
  toast.className = `toast ${type}`;
  
  const icons = {
    success: '✓',
    error: '✕',
    warning: '!'
  };
  
  toast.innerHTML = `
    <div class="toast-icon">${icons[type]}</div>
    <div class="toast-content">
      <div class="toast-title">${title}</div>
      <div class="toast-message">${message}</div>
    </div>
    <button class="toast-close" onclick="this.parentElement.remove()">×</button>
  `;
  
  container.appendChild(toast);
  
  if (duration > 0) {
    setTimeout(() => {
      toast.classList.add('exit');
      setTimeout(() => toast.remove(), 400);
    }, duration);
  }
}

// ===== RESTOK MODAL =====
async function openRestokModal(obatId, obatNama) {
  currentRestokObatId = obatId;
  currentRestokObatNama = obatNama;
  
  const modal = document.getElementById('modalRestok');
  document.getElementById('restokObatNama').textContent = obatNama;
  document.getElementById('restokJumlah').value = 0;
  
  // Get current stock
  const res = await fetch(`api/manage_stok.php?action=get_stok&obat_id=${obatId}`);
  const data = await res.json();
  
  if (data.success) {
    const stokSaatIni = data.data.stok;
    document.getElementById('restokStokSaatIni').value = stokSaatIni;
    document.getElementById('restokJumlah').dataset.stokSaatIni = stokSaatIni;
  } else {
    showToast('Error', 'Gagal mendapatkan data stok', 'error');
    return;
  }
  
  // Update preview when input changes
  document.getElementById('restokJumlah').addEventListener('input', function() {
    const stokSaatIni = parseInt(document.getElementById('restokStokSaatIni').value);
    const jumlah = parseInt(this.value) || 0;
    const stokBaru = stokSaatIni + jumlah;
    document.getElementById('restokPreview').textContent = stokBaru;
  });
  
  modal.classList.remove('hidden');
}

function closeRestokModal() {
  document.getElementById('modalRestok').classList.add('hidden');
  currentRestokObatId = null;
  currentRestokObatNama = null;
}

async function submitRestok() {
  const jumlah = parseInt(document.getElementById('restokJumlah').value);
  
  if (isNaN(jumlah) || jumlah <= 0) {
    showToast('Validasi', 'Masukkan jumlah yang valid (> 0)', 'warning');
    return;
  }
  
  const payload = {
    obat_id: currentRestokObatId,
    jumlah: jumlah,
    tipe: 'tambah'
  };
  
  const res = await fetch('api/manage_stok.php?action=update_stok', {
    method: 'POST',
    headers: {'Content-Type': 'application/json'},
    body: JSON.stringify(payload)
  });
  
  const data = await res.json();
  
  if (data.success) {
    showToast('Restok Berhasil', `${currentRestokObatNama} ditambah ${jumlah} unit`, 'success');
    closeRestokModal();
    location.reload();
  } else {
    showToast('Gagal', data.message || 'Gagal mengupdate stok', 'error');
  }
}

// ===== SEARCH & FILTER OBAT =====
function filterObat() {
  const searchInput = document.getElementById('searchInput').value.toLowerCase();
  const filterKategori = document.getElementById('filterKategori').value.toLowerCase();
  const rows = document.querySelectorAll('.obat-row');
  let visibleCount = 0;

  rows.forEach(row => {
    const nama = row.querySelector('.nama-obat').textContent.toLowerCase();
    const kategori = row.querySelector('.kategori-obat').textContent.toLowerCase();

    const matchSearch = nama.includes(searchInput);
    const matchKategori = filterKategori === '' || kategori === filterKategori;

    if (matchSearch && matchKategori) {
      row.style.display = '';
      visibleCount++;
    } else {
      row.style.display = 'none';
    }
  });

  // Tampilkan pesan jika tidak ada hasil
  const emptyMessage = document.getElementById('emptyMessage');
  if (visibleCount === 0) {
    emptyMessage.classList.remove('hidden');
  } else {
    emptyMessage.classList.add('hidden');
  }
}

function resetFilter() {
  document.getElementById('searchInput').value = '';
  document.getElementById('filterKategori').value = '';
  filterObat();
}

// Event listeners
document.getElementById('searchInput').addEventListener('keyup', filterObat);
document.getElementById('filterKategori').addEventListener('change', filterObat);

// Tutup modal restok saat klik di luar
document.getElementById('modalRestok')?.addEventListener('click', function(e) {
  if (e.target === this) closeRestokModal();
});

let pesananList = [];
let obatList = [];
let currentPesananId = null;

async function resetAllPesanan() {
  if (!confirm('Yakin ingin menghapus semua pesanan dan riwayatnya?')) return;
  const fd = new FormData();
  fd.append('admin_reset', '1');
  const res = await fetch('api/reset_pesanan.php', { method: 'POST', body: fd });
  const data = await res.json();
  if (data.success) {
    showToast('Reset Berhasil', 'Semua pesanan dan riwayat telah dihapus', 'success');
    pesananList = [];
    renderPesanan();
  } else {
    showToast('Reset Gagal', data.message || 'Gagal menghapus pesanan', 'error');
  }
}

async function loadObat() {
  const res = await fetch("api/get_obat.php");
  obatList = await res.json();
}

// ===== LOAD STOK TABEL REALTIME =====
async function loadStokTable() {
  try {
    const res = await fetch("api/manage_stok.php?action=get_all_stok");
    const data = await res.json();
    
    if (!data.success) return;
    
    // Update stok di tabel
    data.data.forEach(obat => {
      const row = document.querySelector(`tr[data-obat-id="${obat.id}"]`);
      if (row) {
        const stokDisplay = row.querySelector('.stok-display');
        if (stokDisplay) {
          const stok = obat.stok || 0;
          stokDisplay.textContent = stok;
          
          // Update warna berdasarkan stok
          stokDisplay.className = 'stok-display ';
          if (stok == 0) {
            stokDisplay.className += 'text-red-600 font-bold';
          } else if (stok < 10) {
            stokDisplay.className += 'text-orange-600 font-bold';
          } else {
            stokDisplay.className += 'text-green-600 font-bold';
          }
        }
      }
    });
  } catch (error) {
    console.error('Error loading stok:', error);
  }
}

async function loadPesanan(){
  const res = await fetch("api/get_pesanan.php");
  pesananList = await res.json();
  renderPesanan();
}

function filterPesanan(){
  const searchPembeli = document.getElementById('searchPembeli').value.toLowerCase();
  const searchKeluhan = document.getElementById('searchKeluhan').value.toLowerCase();
  const filterStatus = document.getElementById('filterStatusPesanan').value;

  const filtered = pesananList.filter(p => {
    const namaPembeli = (p.nama_pembeli || "").toLowerCase();
    const keluhan = (p.keluhan || "").toLowerCase();
    const status = p.status || "";

    const matchPembeli = namaPembeli.includes(searchPembeli);
    const matchKeluhan = keluhan.includes(searchKeluhan);
    const matchStatus = filterStatus === "" || status === filterStatus;

    return matchPembeli && matchKeluhan && matchStatus;
  });

  renderPesananFiltered(filtered);
}

function renderPesananFiltered(data){
  const tbody = document.getElementById("tabelPesanan");
  const emptyMsg = document.getElementById("emptyMessagePesanan");

  if(data.length === 0){
    tbody.innerHTML = "";
    emptyMsg.classList.remove('hidden');
    return;
  }

  emptyMsg.classList.add('hidden');
  tbody.innerHTML = data.map(p => `
    <tr class="border-b hover:bg-gray-50 transition pesanan-row" data-status="${p.status}">
      <td class="p-4"><i class="fas fa-user-circle text-gray-500 mr-2"></i>${p.nama_pembeli}</td>
      <td class="p-4 text-gray-700">${p.keluhan}</td>
      <td class="p-4 text-center">
        ${p.status=='selesai'
          ? '<span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold"><i class="fas fa-check-circle mr-1"></i>Selesai</span>'
          : '<span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold"><i class="fas fa-hourglass-half mr-1"></i>Diproses</span>'}
      </td>
      <td class="p-4 text-center">
        ${p.status === 'selesai' 
          ? '<span class="text-gray-500 text-sm">Selesai</span>'
          : '<button onclick="openModalObat(' + p.id + ')" class="bg-green-100 text-green-700 px-4 py-2 rounded-lg hover:bg-green-200 transition font-medium text-sm"><i class="fas fa-check"></i> Selesaikan</button>'}
      </td>
    </tr>
  `).join("");
}

function renderPesanan(){
  renderPesananFiltered(pesananList);
}

function resetFilterPesanan(){
  document.getElementById('searchPembeli').value = '';
  document.getElementById('searchKeluhan').value = '';
  document.getElementById('filterStatusPesanan').value = '';
  filterPesanan();
}

// ===== MODAL GAMBAR =====
function showImageModal(imageSrc, obatName) {
  const modal = document.getElementById("modalGambar");
  document.getElementById("modalGambarImg").src = imageSrc;
  document.getElementById("modalGambarNama").textContent = obatName;
  modal.classList.remove('hidden');
}

function closeImageModal() {
  document.getElementById("modalGambar").classList.add('hidden');
}

document.getElementById('modalGambar')?.addEventListener('click', function(e) {
  if (e.target === this) closeImageModal();
});

// ===== MODAL OBAT =====
function openModalObat(pesananId) {
  currentPesananId = pesananId;
  const modal = document.getElementById("modalObat");
  const daftar = document.getElementById("daftarObatModal");
  
  daftar.innerHTML = obatList.map(o => `
    <label class="obat-modal-item flex items-center p-4 border-2 border-gray-200 rounded-xl hover:bg-green-50 cursor-pointer transition" data-nama="${o.nama.toLowerCase()}">
      <input type="checkbox" class="obat-checkbox" value="${o.id}" style="width:20px;height:20px;cursor:pointer;">
      <div class="ml-4 flex-1">
        <div class="font-semibold text-gray-800">${o.nama}</div>
        <div class="text-sm text-gray-600">${o.kategori}</div>
        <div class="text-green-600 font-bold">Rp${Number(o.harga).toLocaleString('id-ID')}</div>
      </div>
      <img src="${o.gambar}" class="w-16 h-16 object-cover rounded-lg" onerror="this.src='https://via.placeholder.com/60'">
    </label>
  `).join("");
  
  // Reset search
  document.getElementById('searchObatModal').value = '';
  
  modal.classList.remove('hidden');
}

function filterObatModal() {
  const searchInput = document.getElementById('searchObatModal').value.toLowerCase();
  const items = document.querySelectorAll('.obat-modal-item');
  
  items.forEach(item => {
    const nama = item.getAttribute('data-nama');
    if (nama.includes(searchInput)) {
      item.style.display = '';
    } else {
      item.style.display = 'none';
    }
  });
}

function closeModalObat() {
  document.getElementById("modalObat").classList.add('hidden');
  currentPesananId = null;
}

async function submitObat() {
  const checked = Array.from(document.querySelectorAll('.obat-checkbox:checked')).map(c => c.value);
  
  if (checked.length === 0) {
    showToast('Pilihan Obat Kosong', 'Silakan pilih minimal 1 obat sebelum menyelesaikan pesanan', 'warning');
    return;
  }
  
  const fd = new FormData();
  fd.append("pesanan_id", currentPesananId);
  checked.forEach(id => fd.append("obat_id[]", id));
  
  const res = await fetch("admin_pesanan_update.php", {method: "POST", body: fd});
  const msg = await res.text();
  
  // Check if response contains "Error" or starts with "Status Error"
  if (msg.includes('Error') || msg.startsWith('Status')) {
    showToast('Gagal Menyelesaikan', msg, 'error', 5000);
  } else {
    showToast('Pesanan Berhasil Diselesaikan!', msg, 'success', 4000);
    // ✅ Refresh stok tabel setelah selesaikan pesanan
    setTimeout(() => {
      loadStokTable();
    }, 500);
  }
  
  closeModalObat();
  if (!msg.includes('Error') && !msg.startsWith('Status')) {
    await loadPesanan();
  }
}

// Tutup modal saat klik di luar
document.getElementById('modalObat')?.addEventListener('click', function(e) {
  if (e.target === this) closeModalObat();
});

// Event listeners untuk filter pesanan
document.getElementById('searchPembeli').addEventListener('keyup', filterPesanan);
document.getElementById('searchKeluhan').addEventListener('keyup', filterPesanan);
document.getElementById('filterStatusPesanan').addEventListener('change', filterPesanan);

// Event listener untuk search obat di modal
document.getElementById('searchObatModal').addEventListener('keyup', filterObatModal);

loadObat();
setInterval(loadPesanan, 10000);
loadPesanan();

// ✅ LOAD STOK REALTIME SETIAP 2 DETIK
setInterval(loadStokTable, 2000);
loadStokTable();
</script>

<!-- MODAL LIHAT GAMBAR OBAT -->
<div id="modalGambar" class="hidden fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
  <div class="bg-white rounded-2xl p-6 w-full max-w-2xl shadow-2xl">
    <div class="flex justify-between items-center mb-4">
      <h3 id="modalGambarNama" class="text-2xl font-bold text-gray-800"></h3>
      <button onclick="closeImageModal()" class="text-gray-500 hover:text-gray-700 text-2xl">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <div class="flex justify-center bg-gray-100 rounded-xl p-4">
      <img id="modalGambarImg" src="" alt="Gambar Obat" class="max-h-96 max-w-full object-contain">
    </div>
    <div class="mt-4 flex justify-end">
      <button onclick="closeImageModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg transition font-medium">
        <i class="fas fa-times mr-2"></i> Tutup
      </button>
    </div>
  </div>
</div>

</body>
</html>