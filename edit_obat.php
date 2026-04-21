<?php
require "config/database.php";

$id = $_GET['id'] ?? null;
if(!$id) die("ID tidak ditemukan");

$o = mysqli_fetch_assoc(
  mysqli_query($conn,"SELECT * FROM obat WHERE id='$id'")
);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Obat</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
:root{
  --green:#38a169;
  --green-soft:#e6f6ee;
  --border:#e5e7eb;
  --text:#374151;
}

*{
  box-sizing:border-box;
}

body{
  margin:0;
  min-height:100vh;
  background:#f3f4f6;
  font-family:system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
  display:flex;
  justify-content:center;
  align-items:center;
}

.card{
  width:100%;
  max-width:520px;
  background:#fff;
  border-radius:24px;
  padding:28px;
  box-shadow:0 25px 50px rgba(0,0,0,.08);
}

.header{
  text-align:center;
  margin-bottom:24px;
}

.header h2{
  margin:0;
  color:var(--green);
  font-size:22px;
}

.header p{
  margin:6px 0 0;
  font-size:14px;
  color:#6b7280;
}

.form{
  display:grid;
  gap:16px;
}

.group{
  display:flex;
  flex-direction:column;
  gap:6px;
}

label{
  font-size:13px;
  font-weight:600;
  color:var(--text);
}

input, textarea{
  padding:12px 14px;
  border-radius:14px;
  border:1px solid var(--border);
  font-size:14px;
  outline:none;
  transition:.2s;
}

input:focus, textarea:focus{
  border-color:var(--green);
  box-shadow:0 0 0 3px rgba(56,161,105,.15);
}

textarea{
  resize:vertical;
  min-height:90px;
}

.preview-box{
  display:flex;
  align-items:center;
  gap:14px;
  margin-top:6px;
  padding:12px;
  border-radius:16px;
  background:var(--green-soft);
}

.preview-box img{
  width:72px;
  height:72px;
  object-fit:cover;
  border-radius:14px;
  background:#fff;
}

.preview-box span{
  font-size:13px;
  color:#065f46;
}

.actions{
  display:flex;
  gap:12px;
  margin-top:10px;
}

button{
  flex:1;
  padding:12px;
  border:none;
  border-radius:16px;
  font-weight:600;
  font-size:14px;
  cursor:pointer;
  transition:.2s;
}

.save{
  background:var(--green);
  color:#fff;
}

.save:hover{
  background:#2f855a;
}

.back{
  background:#f1f5f9;
  color:#374151;
}

.back:hover{
  background:#e5e7eb;
}
</style>
</head>
<body>

<div class="card">
  <div class="header">
    <h2>✏️ Edit Data Obat</h2>
    <p>Perbarui informasi obat agar tetap akurat</p>
  </div>

  <form class="form" action="update_obat.php" method="POST">
    <input type="hidden" name="id" value="<?= $o['id'] ?>">

    <div class="group">
      <label>Nama Obat</label>
      <input type="text" name="nama"
        value="<?= htmlspecialchars($o['nama']) ?>" required>
    </div>

    <div class="group">
      <label>Kategori</label>
      <input type="text" name="kategori"
        value="<?= htmlspecialchars($o['kategori']) ?>" required>
    </div>

    <div class="group">
      <label>Harga</label>
      <input type="number" name="harga"
        value="<?= $o['harga'] ?>" required>
    </div>

    <div class="group">
      <label>Stok</label>
      <input type="number" name="stok"
        value="<?= $o['stok'] ?>" required>
    </div>

    <div class="group">
      <label>URL Gambar</label>
      <input type="text" name="gambar"
        value="<?= htmlspecialchars($o['gambar']) ?>" required>

      <div class="preview-box">
        <img src="<?= htmlspecialchars($o['gambar']) ?>">
        <span>Preview gambar obat</span>
      </div>
    </div>

    <div class="group">
      <label>Deskripsi</label>
      <textarea name="deskripsi"><?= htmlspecialchars($o['deskripsi']) ?></textarea>
    </div>

    <div class="actions">
      <button type="submit" class="save">💾 Simpan Perubahan</button>
      <button type="button" class="back" onclick="history.back()">⬅️ Kembali</button>
    </div>
  </form>
</div>

</body>
</html>
