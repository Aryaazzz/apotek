<?php
session_start();
require "config/database.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'pembeli') {
    header("Location: login.php");
    exit;
}
$user_id = $_SESSION['user_id'];

$data = mysqli_query($conn, "SELECT * FROM obat ORDER BY nama ASC");

if (!$data) {
    die("Query obat error: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Pembeli - Ramadhan</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap" rel="stylesheet">

<!-- Tailwind CDN -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
* {
  font-family: 'Quicksand', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
  
@keyframes float {
  0%,100% { transform: translateY(0); }
  50% { transform: translateY(-12px); }
}
.float {
  animation: float 6s ease-in-out infinite;
}

@keyframes moon-float {
  0%, 100% { transform: translateY(0) rotate(0deg); }
  50% { transform: translateY(10px) rotate(3deg); }
}

@keyframes star-twinkle-soft {
  0%, 100% { opacity: 0.7; }
  50% { opacity: 1; }
}

.moon-ornament {
  animation: moon-float 4s ease-in-out infinite;
}

.star-ornament {
  animation: star-twinkle-soft 2s ease-in-out infinite;
}

body.dark{
  background:linear-gradient(135deg,#0f172a,#052e16);
  color:#e5e7eb;
}

body.dark .obat-card,
body.dark form,
body.dark #statusPesanan,
body.dark footer{
  background:rgba(15,23,42,.85);
  color:#e5e7eb;
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

/* ===============================
   MEDICAL BACKGROUND
================================ */
.medical-bg{
  position:fixed;
  inset:0;
  z-index:-1;
  overflow:hidden;
  pointer-events:none;
}

/* PILLS */
.pill{
  position:absolute;
  bottom:-60px;
  width:44px;
  height:18px;
  border-radius:999px;
  background:linear-gradient(90deg,#66bb6a 50%,#ffffff 50%);
  opacity:.22;
  animation:floatUp 20s linear infinite;
}

.pill::after{
  content:'';
  position:absolute;
  left:50%;
  top:0;
  width:2px;
  height:100%;
  background:#e0e0e0;
}

/* MEDICAL PLUS */
.plus{
  position:absolute;
  bottom:-40px;
  font-size:28px;
  color:#4caf50;
  opacity:.18;
  animation:floatUpRotate 24s linear infinite;
}

/* ANIMATIONS */
@keyframes floatUp{
  from{
    transform:translateY(0) rotate(0deg);
  }
  to{
    transform:translateY(-120vh) rotate(360deg);
  }
}

@keyframes floatUpRotate{
  from{
    transform:translateY(0) rotate(0deg);
  }
  to{
    transform:translateY(-120vh) rotate(-360deg);
  }
}

body::before{
  content:'';
  position:fixed;
  inset:0;
  background:
    radial-gradient(circle at 15% 20%, rgba(168,224,99,.18), transparent 40%),
    radial-gradient(circle at 85% 80%, rgba(255,224,102,.12), transparent 45%);
  z-index:-2;
  animation: backgroundShift 10s ease-in-out infinite alternate;
}

body {
  background: linear-gradient(135deg, #f8fafb 0%, #e8f5e9 50%, #f0f9ff 100%) !important;
}

@keyframes backgroundShift {
  0% { opacity: 0.8; }
  100% { opacity: 1; }
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in-up {
  animation: fadeInUp 0.8s ease-out;
}

main > section {
  animation: fadeInUp 0.8s ease-out;
}

main > section:nth-child(1) { animation-delay: 0.1s; }
main > section:nth-child(2) { animation-delay: 0.2s; }
main > section:nth-child(3) { animation-delay: 0.3s; }
main > section:nth-child(4) { animation-delay: 0.4s; }
main > section:nth-child(5) { animation-delay: 0.5s; }
main > section:nth-child(6) { animation-delay: 0.6s; }


.review-title{
  font-size:1.8rem;
  font-weight:700;
  color:#2e7d32;
  display:flex;
  align-items:center;
  gap:10px;
  letter-spacing:.3px;
  position:relative;
  display:flex;
  justify-content:center;
  align-items:center;
}

.review-title i{
  font-size:1.2rem;
  color:#66bb6a;
  transform:translateY(1px);
}

.review-title::after{
  content:'';
  position:absolute;
  left:50%;
  bottom:-10px;
  width:0;
  height:3px;
  background:linear-gradient(90deg,#66bb6a,#4caf50);
  border-radius:999px;
  transform:translateX(-50%);
  transition:width .45s cubic-bezier(.22,.61,.36,1);
}

/* hover effect */
.review-title:hover::after{
  width:70%;
}

.review-section{
  margin-top:40px;
  background:var(--glass);
  padding:30px;
  border-radius:var(--radius);
  box-shadow:var(--shadow-soft);
  max-width:1100px;
  width:100%;
  overflow:hidden;
}
.review-section h2{
  display:flex;
  justify-content:center;
  align-items:center;
}

.review-container{
  display:flex;
  gap:18px;
  animation:autoScroll 40s linear infinite;
}
.review-section:hover .review-container{
  animation-play-state:paused;
}

@keyframes autoScroll{
  to{transform:translateX(-50%)}
}

.review-card{
  min-width:240px;
  background:#f9f9f9;
  padding:18px;
  border-radius:14px;
  text-align:center;
  transition:all .7s ease;
}

.review-card p{
  font-style:italic;
  color:#444;
  line-height:1.6;
}

.review-card .author{
  margin-top:10px;
  font-weight:600;
  color:#2e7d32;
}

.review-card:hover{
  transform:translateY(-5px);
  box-shadow:0 12px 28px rgba(0,0,0,.16);
}

.keluhan-box {
  display: flex;
  gap: 10px;
  max-width: 400px;
}

.keluhan-box input {
  flex: 1;
  padding: 10px;
  border-radius: 6px;
  border: 1px solid #ccc;
  font-size: 14px;
}

.btn-kirim {
  padding: 10px 16px;
  background: #2ecc71;
  border: none;
  border-radius: 6px;
  color: #fff;
  font-weight: bold;
  cursor: pointer;
}

.btn-kirim:hover {
  background: #27ae60;
}

.info-text {
  margin-top: 10px;
  color: #555;
  font-size: 14px;
}

</style>
</head>

<body class="min-h-screen text-gray-700 overflow-x-hidden">

<!-- TOAST NOTIFICATION CONTAINER -->
<div id="toastContainer" class="toast-container"></div>

<!-- RAMADHAN ORNAMENTS -->
<div class="fixed top-0 left-0 w-full h-screen pointer-events-none z-0" style="overflow: hidden;">
  <!-- Moon -->
  <i class="fas fa-moon moon-ornament" style="position: absolute; top: 40px; left: 60px; font-size: 50px; color: #ffe066; opacity: 0.8; filter: drop-shadow(0 0 16px #ffe06666);"></i>
  
  <!-- Stars -->
  <i class="fas fa-star star-ornament" style="position: absolute; top: 100px; left: 150px; font-size: 24px; color: #fffbe6; opacity: 0.7; filter: drop-shadow(0 0 8px #fffbe6aa);"></i>
  <i class="fas fa-star star-ornament" style="position: absolute; top: 150px; right: 100px; font-size: 20px; color: #fffbe6; opacity: 0.7; filter: drop-shadow(0 0 8px #fffbe6aa); animation-delay: 0.5s;"></i>
  <i class="fas fa-star star-ornament" style="position: absolute; top: 300px; right: 200px; font-size: 18px; color: #fffbe6; opacity: 0.6; filter: drop-shadow(0 0 6px #fffbe6aa); animation-delay: 1s;"></i>
  
  <!-- Lanterns -->
  <i class="fas fa-lantern moon-ornament" style="position: absolute; top: 60px; right: 80px; font-size: 45px; color: #ffb300; opacity: 0.8; filter: drop-shadow(0 0 12px #ffb30066);"></i>
  <i class="fas fa-lantern moon-ornament" style="position: absolute; bottom: 150px; left: 100px; font-size: 35px; color: #ffe066; opacity: 0.7; filter: drop-shadow(0 0 8px #ffe06666); animation-delay: 0.3s;"></i>
</div>

<div class="medical-bg">
  <span class="pill" style="left:10%; animation-delay:0s;"></span>
  <span class="pill" style="left:35%; animation-delay:6s;"></span>
  <span class="pill" style="left:60%; animation-delay:12s;"></span>
  <span class="pill" style="left:80%; animation-delay:3s;"></span>

  <span class="plus" style="left:20%; animation-delay:4s;">+</span>
  <span class="plus" style="left:50%; animation-delay:10s;">+</span>
  <span class="plus" style="left:70%; animation-delay:15s;">+</span>
</div>

<!-- HEADER -->
<header class="sticky top-0 z-50 shadow-xl" style="background: linear-gradient(90deg, #0f5132 0%, #1b6a3f 50%, #2d8a5a 100%);">
  <div class="max-w-7xl mx-auto px-4 py-5 flex items-center justify-between">
    <div class="flex items-center gap-4">
      <div class="w-14 h-14 rounded-full text-white flex items-center justify-center text-2xl shadow-lg" style="background: linear-gradient(135deg, #ffe066 0%, #ffb300 100%);">
        <i class="fas fa-mosque" style="color: #0f5132;"></i>
      </div>
      <div class="text-white">
        <h1 class="text-2xl font-bold">Apotek Kelompok Satu</h1>
        <p class="text-sm" style="color: #a8e063;"><i class="fas fa-moon" style="margin-right: 6px;"></i>Ramadhan 1447 H</p>
      </div>
    </div>
    <a href="auth/logout.php" class="flex items-center gap-2 text-white px-6 py-3 rounded-lg transition duration-300 transform hover:scale-105 font-medium shadow-lg" style="background: linear-gradient(90deg, #d32f2f, #f44336);">
      <i class="fas fa-sign-out-alt"></i> Logout
    </a>
  </div>
</header>

<main class="max-w-7xl mx-auto px-4 py-12 space-y-16 relative z-10">
<!-- DAFTAR OBAT -->
<section class="rounded-2xl shadow-lg p-8" style="background: linear-gradient(135deg, rgba(255,255,255,0.98) 0%, rgba(168,224,99,0.08) 100%); border: 2px solid #a8e06633;">
  <h2 class="text-3xl font-bold mb-2 flex items-center gap-3" style="color: #0f5132;">
    <i class="fas fa-capsules text-2xl" style="color: #a8e063;"></i> Daftar Obat Tersedia
  </h2>
  <p class="text-gray-600 mb-8">Lihat berbagai pilihan obat berkualitas di bulan suci ini</p>

  <div id="daftarObatContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Obat akan di-load via JavaScript untuk menampilkan stok realtime -->
    <div class="flex justify-center items-center col-span-full py-12">
      <div class="text-center">
        <div class="animate-spin mb-4">
          <i class="fas fa-spinner text-4xl" style="color: #a8e063;"></i>
        </div>
        <p class="text-gray-600 font-medium">Memuat daftar obat...</p>
      </div>
    </div>
  </div>
</section>

<!-- FORM KELUHAN & STATUS -->
<section class="grid md:grid-cols-2 gap-8">
  <!-- Form Input -->
  <div class="rounded-2xl shadow-lg p-8" style="background: linear-gradient(135deg, rgba(255,255,255,0.98) 0%, rgba(168,224,99,0.08) 100%); border-left: 4px solid #a8e063;">
    <h2 class="text-2xl font-bold mb-2 flex items-center gap-3" style="color: #0f5132;">
      <i class="fas fa-comment-medical text-xl" style="color: #a8e063;"></i> Konsultasi Keluhan
    </h2>
    <p class="text-gray-600 text-sm mb-6">Ceritakan keluhan Anda kepada apoteker kami, semoga cepat sembuh di bulan suci ini</p>

    <div class="space-y-5">
      <!-- Nama -->
      <div>
        <label class="block text-sm font-semibold mb-2" style="color: #0f5132;">
          <i class="fas fa-user mr-2" style="color: #a8e063;"></i>Nama Anda
        </label>
        <input
          type="text"
          id="nama_pembeli"
          placeholder="Masukkan nama lengkap"
          class="w-full px-4 py-3 border-2 rounded-xl focus:outline-none transition-all duration-300 hover:shadow-md text-gray-800"
          style="border-color: #a8e06644; background: #f9f9f9;"
        >
      </div>

      <!-- Keluhan -->
      <div>
        <label class="block text-sm font-semibold mb-2" style="color: #0f5132;">
          <i class="fas fa-stethoscope mr-2" style="color: #a8e063;"></i>Keluhan / Gejala
        </label>
        <textarea
          id="keluhan"
          rows="5"
          placeholder="Jelaskan keluhan atau gejala yang Anda alami secara detail..."
          class="w-full px-4 py-3 border-2 rounded-xl focus:outline-none transition-all duration-300 hover:shadow-md resize-none text-gray-800"
          style="border-color: #a8e06644; background: #f9f9f9;"
        ></textarea>
      </div>

      <!-- Tombol -->
      <button
        id="kirimKeluhan"
        class="w-full text-white py-3 rounded-xl font-bold flex items-center justify-center gap-3 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105"
        style="background: linear-gradient(90deg, #0f5132 0%, #a8e063 100%);">
        <i class="fas fa-paper-plane text-lg"></i>
        Kirim Keluhan ke Admin
      </button>
    </div>
  </div>

  <!-- Status Pesanan -->
  <div class="rounded-2xl shadow-lg p-8" style="background: linear-gradient(135deg, rgba(255,255,255,0.98) 0%, rgba(255,224,102,0.12) 100%); border-left: 4px solid #ffe066;">
    <h2 class="text-2xl font-bold mb-6 flex items-center gap-3" style="color: #0f5132;">
      <i class="fas fa-clipboard-check text-xl animate-pulse" style="color: #ffe066;"></i> Status Pesanan Anda
    </h2>
    
    <div id="statusPesanan" class="space-y-4">
      <div class="text-center py-12">
        <div class="flex justify-center mb-4">
          <div class="w-16 h-16 rounded-full flex items-center justify-center" style="background: #ffe06633;">
            <i class="fas fa-hourglass-half text-2xl animate-bounce" style="color: #ffe066;"></i>
          </div>
        </div>
        <p class="font-medium" style="color: #0f5132;">Menunggu keluhan Anda...</p>
        <p class="text-sm mt-2" style="color: #666;">Kirim keluhan di form sebelah untuk memulai</p>
      </div>
    </div>
  </div>
</section>

<!-- Section Review Apotek - Horizontal Scroll (ASLI, TIDAK DIUBAH) -->
 <h2 class="review-title" style="color: #0f5132;">
  <i class="fas fa-star" style="color: #ffe066;"></i>
  Review Apotek Kami
</h2>
 <section class="max-w-6xl mx-auto px-4 relative z-10">
<div class="review-section">
  <div class="review-container">
    <div class="review-card">
      <div class="stars">★★★★★</div>
      <p>"Pelayanan cepat dan obatnya berkualitas."</p>
      <div class="author">- Arya P.</div>
    </div>
    <div class="review-card">
      <div class="stars">★★★★☆</div>
      <p>"Apotek ini selalu stok obat lengkap."</p>
      <div class="author">- Reva A.</div>
    </div>
    <div class="review-card">
      <div class="stars">★★★★★</div>
      <p>"Dokter di sini sangat profesional."</p>
      <div class="author">- Regina A.</div>
    </div>
    <div class="review-card">
      <div class="stars">★★★★☆</div>
      <p>"Lokasi strategis dan jam operasional fleksibel."</p>
      <div class="author">- Raditya E.</div>
    </div>
    <div class="review-card">
      <div class="stars">★★★★★</div>
      <p>"Pengalaman belanja yang menyenangkan."</p>
      <div class="author">- Nida</div>
    </div>
    <div class="review-card">
      <div class="stars">★★★★☆</div>
      <p>"Stafnya friendly dan informatif."</p>
      <div class="author">- Kelompok Sebelah</div>
    </div>
  </div>
</div>
</section>


<!-- FOOTER -->
<footer class="rounded-2xl shadow-lg p-8 text-white text-center space-y-4 relative z-10" style="background: linear-gradient(90deg, #0f5132 0%, #1b6a3f 50%, #2d8a5a 100%);">
  <h3 class="text-2xl font-bold">Apotek Kelompok Satu</h3>
  <div class="h-1 w-20 mx-auto rounded-full" style="background: #a8e063;"></div>
  <div class="grid md:grid-cols-3 gap-6 py-4">
    <div>
      <p class="flex items-center justify-center gap-2 font-semibold">
        <i class="fas fa-phone text-lg"></i> +62 123 456 7890
      </p>
    </div>
    <div>
      <p class="flex items-center justify-center gap-2 font-semibold">
        <i class="fas fa-envelope text-lg"></i> info@apotek.com
      </p>
    </div>
    <div>
      <p class="flex items-center justify-center gap-2 font-semibold">
        <i class="fas fa-map-marker-alt text-lg"></i> Jl. Kesehatan No.123
      </p>
    </div>
  </div>
  <p class="text-sm pt-4 border-t" style="border-color: rgba(255,255,255,0.2); color: #a8e063;">
    © 2026 Apotek Kelompok Satu. Semua hak dilindungi. | <i class="fas fa-moon"></i> Ramadhan Kareem <i class="fas fa-moon"></i>
  </p>
</footer>

</main>


<!-- STATUS SCRIPT (TIDAK DIUBAH LOGIC) -->
<script>
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

// ===== LOAD DAFTAR OBAT DENGAN STOK REALTIME =====
async function loadDaftarObat() {
  try {
    const res = await fetch("api/manage_stok.php?action=get_stok_pembeli");
    const data = await res.json();
    
    if (!data.success || !data.data) {
      document.getElementById('daftarObatContainer').innerHTML = `
        <div class="flex justify-center items-center col-span-full py-12">
          <div class="text-center" style="color: #d32f2f;">
            <i class="fas fa-exclamation-circle text-4xl mb-4"></i>
            <p class="font-medium">Gagal memuat daftar obat</p>
          </div>
        </div>
      `;
      return;
    }
    
    const obats = data.data;
    
    if (obats.length === 0) {
      document.getElementById('daftarObatContainer').innerHTML = `
        <div class="flex justify-center items-center col-span-full py-12">
          <div class="text-center" style="color: #0f5132;">
            <i class="fas fa-inbox text-4xl mb-4" style="color: #a8e063;"></i>
            <p class="font-medium">Tidak ada obat yang tersedia saat ini</p>
          </div>
        </div>
      `;
      return;
    }
    
    const html = obats.map(o => {
      const stok = o.stok || 0;
      const stokStatus = stok === 0 ? 'Habis' : stok < 5 ? 'Stok Terbatas' : 'Tersedia';
      const stokColor = stok === 0 ? '#ef4444' : stok < 5 ? '#f59e0b' : '#10b981';
      const bgColor = stok === 0 ? '#fee2e2' : stok < 5 ? '#fef3c7' : '#dcfce7';
      const safeNama = String(o.nama || '').replace(/'/g, "\\'");
      
      return `
        <div class="group rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden border hover:border-opacity-70 ${stok === 0 ? 'opacity-60' : ''}" style="background: linear-gradient(135deg, rgba(255,255,255,0.98) 0%, rgba(168,224,99,0.08) 100%); border-color: #a8e06633;">
          
          <div class="relative h-40 flex items-center justify-center overflow-hidden" style="background: linear-gradient(135deg, rgba(168,224,99,0.12) 0%, rgba(255,224,102,0.08) 100%);">
            <img src="${o.gambar}" class="h-32 object-contain transition-transform duration-500 group-hover:scale-125" onerror="this.src='https://via.placeholder.com/200'">
            <span class="absolute top-3 right-3 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md" style="background: linear-gradient(90deg, #0f5132 0%, #a8e063 100%);">
              ${o.kategori}
            </span>
            
            <!-- BADGE STOK REALTIME -->
            <span class="absolute bottom-3 left-3 text-xs font-bold px-3 py-1 rounded-full shadow-md" style="background-color: ${bgColor}; color: ${stokColor};">
              📦 ${stokStatus}: ${stok}
            </span>
          </div>

          <div class="p-5 space-y-3">
            <h3 class="font-bold text-lg line-clamp-2" style="color: #0f5132;">${o.nama}</h3>
            
            <p class="text-sm text-gray-600 line-clamp-2">
              ${o.deskripsi || 'Obat berkualitas tinggi'}
            </p>
            
            <div class="pt-3 flex items-center justify-between" style="border-top: 2px solid #a8e06633;">
              <span class="text-2xl font-bold" style="color: #0f5132;">
                Rp${Number(o.harga).toLocaleString('id-ID')}
              </span>
              <div class="flex items-center justify-center w-10 h-10 rounded-full ${stok > 0 ? 'text-green-600' : 'text-red-600'} font-bold" style="background: ${stok > 0 ? '#dcfce722' : '#fee2e244'};">
                ${stok > 0 ? '✓' : '✕'}
              </div>
            </div>
            <div class="pt-3">
              ${stok > 0 ? `<button type="button" onclick="buyObat(${o.id}, '${safeNama}')" class="w-full bg-gradient-to-r from-[#0f5132] to-[#a8e063] text-white py-3 rounded-xl font-semibold transition hover:opacity-90">Beli Sekarang</button>` : `<button type="button" disabled class="w-full bg-gray-300 text-gray-700 py-3 rounded-xl font-semibold">Habis</button>`}
            </div>
          </div>
        </div>
      `;
    }).join('');
    
    document.getElementById('daftarObatContainer').innerHTML = html;
  } catch (error) {
    console.error('Error loading obat:', error);
    document.getElementById('daftarObatContainer').innerHTML = `
      <div class="flex justify-center items-center col-span-full py-12">
        <div class="text-center" style="color: #d32f2f;">
          <i class="fas fa-exclamation-triangle text-4xl mb-4"></i>
          <p class="font-medium">Terjadi kesalahan saat memuat obat</p>
        </div>
      </div>
    `;
  }
}

document.getElementById("kirimKeluhan").addEventListener("click", () => {
  const nama = document.getElementById("nama_pembeli").value.trim();
  const keluhan = document.getElementById("keluhan").value.trim();

  if (!nama || !keluhan) {
    showToast('Data Tidak Lengkap', 'Silakan isi nama dan keluhan terlebih dahulu', 'warning');
    return;
  }

  fetch("api/kirim_keluhan.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `nama_pembeli=${encodeURIComponent(nama)}&keluhan=${encodeURIComponent(keluhan)}`
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      showToast('Keluhan Berhasil Dikirim!', 'Silahkan lihat Status Pesanan untuk informasi lebih lanjut', 'success', 4000);
      document.getElementById("nama_pembeli").value = "";
      document.getElementById("keluhan").value = "";
      loadStatusPesanan(); // refresh langsung
    } else {
      console.error('kirim_keluhan error:', data);
      showToast('Gagal Mengirim Keluhan', data.message || 'Terjadi kesalahan', 'error', 5000);
    }
  })
  .catch(err => {
    console.error('fetch kirim_keluhan failed:', err);
    showToast('Gagal Mengirim Keluhan', 'Kesalahan jaringan atau server', 'error', 5000);
  });
});

async function buyObat(obatId, obatNama) {
  try {
    const res = await fetch("api/kirim_pesanan.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `obat_id=${encodeURIComponent(obatId)}&quantity=1`
    });
    const text = await res.text();

    if (text.trim() === "ok") {
      showToast('Pesanan Berhasil Dikirim', `Pesanan ${obatNama} berhasil dikirim ke admin.`, 'success', 4000);
      loadStatusPesanan();
      loadDaftarObat();
    } else {
      showToast('Gagal Mengirim Pesanan', text, 'error', 5000);
    }
  } catch (error) {
    console.error(error);
    showToast('Gagal Mengirim Pesanan', 'Terjadi kesalahan jaringan.', 'error', 5000);
  }
}

async function loadStatusPesanan(){
  const res = await fetch("api/cek_status.php")
  const data = await res.json();

  const box = document.getElementById("statusPesanan");

  if(data.status === "kosong"){
    box.innerHTML = "❌ Belum ada pesanan";
    return;
  }

  if(data.status === "menunggu"){
    box.innerHTML = "⏳ Keluhan Anda sedang menunggu diproses admin. Keluhan: " + data.keluhan;
    return;
  }

  if(data.status === "proses"){
    box.innerHTML = "⏳ Pesanan akan masuk ke admin dalam 15 detik, harap sabar...";
    return;
  }

  if(data.status === "selesai"){
  let html = data.obat.map(o => `
    <div style="
      display:flex;
      align-items:center;
      gap:12px;
      padding:12px;
      margin-top:10px;
      border-radius:14px;
      background:#f0fdf4;
    ">
      <img src="${o.gambar}" style="width:60px;height:60px;object-fit:contain;" onerror="this.src='https://via.placeholder.com/60'">
      <div style="text-align:left;">
        <b>${o.nama}</b><br>
        <small style="color:#16a34a">
          Rp${Number(o.harga).toLocaleString("id-ID")}
        </small>
      </div>
    </div>
  `).join("");

  box.innerHTML = `
    ✅ <br>Pesanan selesai <br>Silahkan ke kasir untuk membawa dan membayar obat</b><br><br>
    <b>Obat untuk kamu:</b>
    ${html}
    <hr style="margin:14px 0">
    <b>Total: Rp${Number(data.total).toLocaleString("id-ID")}</b>
    <br><br>
    ⏳ Pesanan akan direset dalam 10 detik...
  `;

  // ⏱️ AUTO RESET 10 DETIK
  setTimeout(() => {
    fetch("api/reset_pesanan.php")
      .then(res => res.json())
      .then(() => {
        
      });
  }, 10000);

  return;
}
}

// ✅ LOAD OBAT REALTIME SETIAP 3 DETIK
setInterval(loadDaftarObat, 3000);
loadDaftarObat();

// ✅ LOAD STATUS PESANAN REALTIME SETIAP 2 DETIK
setInterval(loadStatusPesanan, 2000);
loadStatusPesanan();
</script>


</body>
</html>
