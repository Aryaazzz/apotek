<?php
session_start();
require "../config/database.php";

$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
  echo json_encode(["status"=>"kosong"]);
  exit;
}

/* 🔥 AMBIL PESANAN TERAKHIR USER */
$q = mysqli_query($conn, "
  SELECT * FROM pesanan
  WHERE user_id='$user_id'
  ORDER BY id DESC
  LIMIT 1
");

$p = mysqli_fetch_assoc($q);

if (!$p) {
  echo json_encode(["status"=>"kosong"]);
  exit;
}

if ($p['status'] === 'menunggu') {
  echo json_encode(["status"=>"menunggu", "keluhan" => $p['keluhan']]);
  exit;
}

if ($p['status'] === 'proses') {
  echo json_encode(["status"=>"proses"]);
  exit;
}

if ($p['status'] === 'selesai') {

  $obat = [];
  $total = 0;

  $q2 = mysqli_query($conn, "
    SELECT o.nama, o.harga, o.gambar
    FROM pesanan_obat po
    JOIN obat o ON po.obat_id = o.id
    WHERE po.pesanan_id='{$p['id']}'
  ");

  while ($r = mysqli_fetch_assoc($q2)) {
    $obat[] = $r;
    $total += $r['harga'];
  }

  echo json_encode([
    "status" => "selesai",
    "obat"   => $obat,
    "total"  => $total
  ]);

   // 🔥 AUTO RESET SESSION
  unset($_SESSION['pesanan_id']);
  exit;
}

