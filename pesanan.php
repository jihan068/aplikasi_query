<?php
require 'db.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar Pesanan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">
  <h2 class="mb-3">Daftar Pesanan</h2>
  <a href="index.php" class="btn btn-secondary mb-3">← Kembali ke Laporan</a>

  <table class="table table-bordered table-striped table-hover">
    <thead class="table-dark text-center">
      <tr>
        <th>No Pesanan</th>
        <th>Jenis Produk</th>
        <th>Jumlah Pesanan</th>
        <th>Tgl Pesanan</th>
        <th>Tgl Selesai</th>
        <th>Dipesan Oleh</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $stmt = $pdo->query("SELECT * FROM kartupesanan ORDER BY NomorPesanan ASC");
      if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo "<tr>
                  <td class='text-center'>{$row['NomorPesanan']}</td>
                  <td>{$row['JenisProduk']}</td>
                  <td class='text-center'>{$row['JumlahPesanan']}</td>
                  <td class='text-center'>{$row['TglPesanan']}</td>
                  <td class='text-center'>{$row['TglSelesai']}</td>
                  <td>{$row['DipesanOleh']}</td>
                  <td class='text-center'>
                    <a href='edit_pesanan.php?id={$row['NomorPesanan']}' class='btn btn-sm btn-warning'>Edit</a>
                  </td>
                </tr>";
        }
      } else {
        echo "<tr><td colspan='7' class='text-center text-muted'>Tidak ada data</td></tr>";
      }
      ?>
    </tbody>
  </table>
</div>
</body>
</html>
