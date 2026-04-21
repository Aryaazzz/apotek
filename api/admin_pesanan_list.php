<?php
require "../config/database.php";
header('Content-Type: application/json');

$data = [];

$q = mysqli_query($conn, "
  SELECT pesanan.*, users.username
  FROM pesanan
  LEFT JOIN users ON pesanan.user_id = users.id
  ORDER BY pesanan.id DESC
");

while ($p = mysqli_fetch_assoc($q)) {

    $obat = [];
    $oq = mysqli_query($conn, "
      SELECT obat.nama
      FROM pesanan_obat
      JOIN obat ON pesanan_obat.obat_id = obat.id
      WHERE pesanan_obat.pesanan_id='{$p['id']}'
    ");

    while ($o = mysqli_fetch_assoc($oq)) {
        $obat[] = $o['nama'];
    }

    $p['obat'] = $obat;
    $data[] = $p;
}

echo json_encode($data);


