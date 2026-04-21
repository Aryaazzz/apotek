<?php
require "./config/database.php";

$q = mysqli_query($conn, "
  SELECT id, nama_pembeli, keluhan, obat, obat_id, status
  FROM pesanan
  WHERE status IN ('proses','menunggu')
  ORDER BY id DESC
");

$data = [];
while($r = mysqli_fetch_assoc($q)){
  $data[] = $r;
}

header('Content-Type: application/json');
echo json_encode($data);
