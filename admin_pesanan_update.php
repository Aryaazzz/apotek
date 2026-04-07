<?php
require "config/database.php";

$pesanan_id = $_POST['pesanan_id'] ?? null;
$obat_data = $_POST['obat_data'] ?? []; // Array of ['id' => quantity]

// Validasi Input
if (!$pesanan_id) {
  http_response_code(400);
  exit("Status Error: ID pesanan tidak ditemukan");
}

if (empty($obat_data)) {
  http_response_code(400);
  exit("Status Error: Pilih minimal 1 obat");
}

// Check Status Pesanan
$q = mysqli_query($conn, "SELECT id, status FROM pesanan WHERE id='$pesanan_id'");
if (!$q || mysqli_num_rows($q) === 0) {
  http_response_code(404);
  exit("Status Error: Pesanan tidak ditemukan");
}

$p = mysqli_fetch_assoc($q);

if ($p['status'] === 'selesai') {
  http_response_code(400);
  exit("Status Error: Pesanan sudah selesai");
}

// Hapus obat lama jika ada
mysqli_query($conn, "DELETE FROM pesanan_obat WHERE pesanan_id='$pesanan_id'");

// Insert Obat Baru & Kurangi Stok
foreach ($obat_data as $oid => $quantity) {
  $oid = mysqli_real_escape_string($conn, $oid);
  $quantity = (int) $quantity;
  
  if ($quantity <= 0) continue;
  
  // Insert ke pesanan_obat dengan quantity
  mysqli_query($conn, "
    INSERT INTO pesanan_obat (pesanan_id, obat_id, quantity)
    VALUES ('$pesanan_id', '$oid', '$quantity')
  ");
  
  // ✅ KURANGI STOK OBAT sesuai quantity
  mysqli_query($conn, "
    UPDATE obat SET stok = stok - $quantity
    WHERE id='$oid' AND stok >= $quantity
  ");
}

// Update Status Pesanan ke Selesai
$update = mysqli_query($conn, "
  UPDATE pesanan SET status='selesai'
  WHERE id='$pesanan_id'
");

if ($update) {
  echo "Pesanan berhasil diselesaikan! Stok obat telah dikurangi otomatis.";
} else {
  http_response_code(500);
  echo "Status Error: Gagal mengupdate status pesanan";
}

