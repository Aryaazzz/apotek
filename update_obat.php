<?php
require "config/database.php";

mysqli_query($conn,"
UPDATE obat SET
nama='$_POST[nama]',
kategori='$_POST[kategori]',
harga='$_POST[harga]',
stok='$_POST[stok]',
gambar='$_POST[gambar]',
deskripsi='$_POST[deskripsi]'
WHERE id='$_POST[id]'
");

header("Location: admin_dashboard.php");
