<?php
require "../config/database.php";

header('Content-Type: application/json');

// Query untuk mendapatkan riwayat pesanan dengan detail obat
$query = "
SELECT 
    p.id,
    p.nama_pembeli,
    p.keluhan,
    p.created_at,
    po.obat_id,
    po.quantity,
    o.nama as obat_nama,
    o.harga,
    o.kategori
FROM pesanan p
LEFT JOIN pesanan_obat po ON p.id = po.pesanan_id
LEFT JOIN obat o ON po.obat_id = o.id
WHERE p.status = 'selesai'
ORDER BY p.created_at DESC
";

$result = mysqli_query($conn, $query);

$riwayat = [];
$current_pesanan = null;

while ($row = mysqli_fetch_assoc($result)) {
    $pesanan_id = $row['id'];
    
    if (!isset($riwayat[$pesanan_id])) {
        $riwayat[$pesanan_id] = [
            'id' => $row['id'],
            'nama_pembeli' => $row['nama_pembeli'],
            'keluhan' => $row['keluhan'],
            'created_at' => $row['created_at'],
            'obat' => []
        ];
    }
    
    if ($row['obat_id']) {
        $riwayat[$pesanan_id]['obat'][] = [
            'id' => $row['obat_id'],
            'nama' => $row['obat_nama'],
            'kategori' => $row['kategori'],
            'harga' => $row['harga'],
            'quantity' => $row['quantity']
        ];
    }
}

// Convert to array and sort by date
$riwayat = array_values($riwayat);

echo json_encode($riwayat);
?>