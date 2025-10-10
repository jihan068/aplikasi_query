<?php
require 'db.php';

// Cek ID
if (!isset($_GET['id'])) {
  header("Location: pesanan.php");
  exit;
}
$id = $_GET['id'];

// Ambil data
$stmt = $pdo->prepare("SELECT * FROM kartupesanan WHERE NomorPesanan = :id");
$stmt->execute([':id' => $id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
  echo "<script>alert('Pesanan tidak ditemukan!'); window.location='pesanan.php';</script>";
  exit;
}

// Update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $produk = trim($_POST['JenisProduk']);
  $jumlah = trim($_POST['JumlahPesanan']);
  $tglpesan = trim($_POST['TglPesanan']);
  $tglselesai = trim($_POST['TglSelesai']);
  $pemesan = trim($_POST['DipesanOleh']);

  $update = $pdo->prepare("UPDATE kartupesanan 
                           SET JenisProduk = :produk, JumlahPesanan = :jumlah, 
                               TglPesanan = :tglpesan, TglSelesai = :tglselesai, DipesanOleh = :pemesan
                           WHERE NomorPesanan = :id");
  $update->execute([
    ':produk' => $produk,
    ':jumlah' => $jumlah,
    ':tglpesan' => $tglpesan,
    ':tglselesai' => $tglselesai,
    ':pemesan' => $pemesan,
    ':id' => $id
  ]);

  echo "<script>alert('Data berhasil diperbarui!'); window.location='pesanan.php';</script>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Pesanan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="card shadow-sm">
    <div class="card-body">
      <h3 class="mb-4 text-primary">Edit Data Pesanan</h3>

      <form method="POST">
        <div class="mb-3">
          <label class="form-label">No Pesanan</label>
          <input type="text" class="form-control" value="<?= htmlspecialchars($data['NomorPesanan']) ?>" readonly>
        </div>

        <div class="mb-3">
          <label class="form-label">Jenis Produk</label>
          <input type="text" name="JenisProduk" class="form-control" value="<?= htmlspecialchars($data['JenisProduk']) ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Jumlah Pesanan</label>
          <input type="number" name="JumlahPesanan" class="form-control" value="<?= htmlspecialchars($data['JumlahPesanan']) ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Tanggal Pesan</label>
          <input type="date" name="TglPesanan" class="form-control" value="<?= htmlspecialchars($data['TglPesanan']) ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Tanggal Selesai</label>
          <input type="date" name="TglSelesai" class="form-control" value="<?= htmlspecialchars($data['TglSelesai']) ?>" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Dipesan Oleh</label>
          <input type="text" name="DipesanOleh" class="form-control" value="<?= htmlspecialchars($data['DipesanOleh']) ?>" required>
        </div>

        <div class="d-flex justify-content-between">
          <a href="pesanan.php" class="btn btn-secondary">Kembali</a>
          <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>
