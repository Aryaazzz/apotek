<?php
session_start();
require "../config/database.php";

// Check if it's admin reset request (POST from admin dashboard)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_reset'])) {
  if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
  }
  
  // Delete all pesanan records
  $deleteObat = mysqli_query($conn, "DELETE FROM pesanan_obat");
  $deletePesanan = mysqli_query($conn, "DELETE FROM pesanan");
  
  if ($deleteObat && $deletePesanan) {
    echo json_encode(['success' => true, 'message' => 'Semua pesanan berhasil dihapus']);
  } else {
    echo json_encode(['success' => false, 'message' => 'Gagal menghapus pesanan']);
  }
  exit;
}

// Original user reset functionality
if(!isset($_SESSION['user_id'])){
  echo json_encode(["success"=>false]);
  exit;
}

$user_id = $_SESSION['user_id'];

// ambil pesanan terakhir user
$q = mysqli_query($conn,"
  SELECT id FROM pesanan 
  WHERE user_id='$user_id' 
  ORDER BY id DESC LIMIT 1
");

$p = mysqli_fetch_assoc($q);
if(!$p){
  echo json_encode(["success"=>false]);
  exit;
}

$pesanan_id = $p['id'];

// hapus relasi obat
mysqli_query($conn,"
  DELETE FROM pesanan_obat WHERE pesanan_id='$pesanan_id'
");

// hapus pesanan
mysqli_query($conn,"
  DELETE FROM pesanan WHERE id='$pesanan_id'
");

echo json_encode(["success"=>true]);
