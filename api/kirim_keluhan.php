<?php
session_start();
require "../config/database.php";

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
  echo json_encode(['success' => false, 'message' => 'unauthorized']);
  exit;
}

$nama = trim($_POST['nama_pembeli'] ?? '');
$keluhan = trim($_POST['keluhan'] ?? '');
$user_id = intval($_SESSION['user_id']);

if ($nama === '') {
  $nama = $_SESSION['username'] ?? 'Pembeli';
}

if ($keluhan === '') {
  echo json_encode(['success' => false, 'message' => 'invalid']);
  exit;
}

// buat pesanan baru
$query = sprintf(
  "INSERT INTO pesanan (user_id, nama_pembeli, keluhan, status) VALUES (%d, '%s', '%s', 'menunggu')",
  $user_id,
  mysqli_real_escape_string($conn, $nama),
  mysqli_real_escape_string($conn, $keluhan)
);

$q = mysqli_query($conn, $query);

if ($q) {
  echo json_encode(['success' => true, 'message' => 'ok']);
} else {
  echo json_encode(['success' => false, 'message' => 'db_error', 'error' => mysqli_error($conn), 'query' => $query]);
}
