-- Menambahkan kolom quantity ke tabel pesanan_obat
ALTER TABLE pesanan_obat ADD COLUMN quantity INT NOT NULL DEFAULT 1;