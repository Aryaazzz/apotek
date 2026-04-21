<?php
session_start();
require "../config/database.php";

if (!isset($_SESSION['user_id'])) {
  die("unauthorized");
}

$obat_id = intval($_POST['obat_id'] ?? 0);
$quantity = intval($_POST['quantity'] ?? 1);
$user_id = $_SESSION['user_id'];
$nama_pembeli = trim($_SESSION['username'] ?? ($_POST['nama_pembeli'] ?? 'Pembeli'));
$keluhan = trim($_POST['keluhan'] ?? '');

if ($obat_id <= 0 || $quantity <= 0) {
  die("invalid");
}

$obatRes = mysqli_query($conn, "SELECT nama FROM obat WHERE id='$obat_id'");
$obatRow = mysqli_fetch_assoc($obatRes);

if (!$obatRow) {
  die("invalid_obat");
}

$obat_nama = $obatRow['nama'];
if ($keluhan === '') {
  $keluhan = "Mau beli obat: $obat_nama x$quantity";
}

// Simpan pesanan utama
$insert = mysqli_query($conn, "INSERT INTO pesanan (user_id, nama_pembeli, keluhan, status, obat, obat_id) VALUES ('$user_id', '" . mysqli_real_escape_string($conn, $nama_pembeli) . "', '" . mysqli_real_escape_string($conn, $keluhan) . "', 'proses', '" . mysqli_real_escape_string($conn, $obat_nama) . "', '$obat_id')");

if (!$insert) {
  die("db_error");
}

$pesanan_id = mysqli_insert_id($conn);
$insert_obat = mysqli_query($conn, "INSERT INTO pesanan_obat (pesanan_id, obat_id, quantity) VALUES ('$pesanan_id', '$obat_id', '$quantity')");

if (!$insert_obat) {
  mysqli_query($conn, "DELETE FROM pesanan WHERE id='$pesanan_id'");
  die("db_error");
}

echo "ok";
