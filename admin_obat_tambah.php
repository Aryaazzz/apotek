<?php
require __DIR__ . "/config/database.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Akses tidak valid");
}

$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
$harga = (int) $_POST['harga'];
$stok = (int) $_POST['stok'];
$gambar = mysqli_real_escape_string($conn, $_POST['gambar']);
$deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);

mysqli_query($conn, "
  INSERT INTO obat (nama, kategori, harga, stok, gambar, deskripsi)
  VALUES ('$nama','$kategori',$harga,$stok,'$gambar','$deskripsi')
");

header("Location: admin_dashboard.php");
exit;
