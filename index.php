<?php
require 'db.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laporan Pesanan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <h2 class="mb-4 text-primary">Laporan Pesanan</h2>

  <a href="pesanan.php" class="btn btn-success mb-3">📄 Lihat Daftar Pesanan</a>

  <table class="table table-bordered table-hover align-middle">
    <thead class="table-dark text-center">
      <tr>
        <th>No Pesanan</th>
        <th>Jenis Produk</th>
        <th>Jumlah Pesanan</th>
        <th>Tanggal Pesan</th>
        <th>Tanggal Selesai</th>
        <th>Dipesan Oleh</th>
        <th>Kelompok</th>
        <th>Subkelompok</th>
        <th>Jumlah</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT k.NomorPesanan, k.JenisProduk, k.JumlahPesanan, k.TglPesanan, 
                     k.TglSelesai, k.DipesanOleh, d.Kelompok, d.Subkelompok, d.Jumlah
              FROM kartupesanan k
              JOIN detailpesanan d ON k.NomorPesanan = d.NomorPesanan
              ORDER BY k.NomorPesanan ASC";
      $stmt = $pdo->query($sql);
      if ($stmt->rowCount() > 0) {
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
              echo "<tr>
                      <td class='text-center'>{$row['NomorPesanan']}</td>
                      <td>{$row['JenisProduk']}</td>
                      <td class='text-center'>{$row['JumlahPesanan']}</td>
                      <td class='text-center'>{$row['TglPesanan']}</td>
                      <td class='text-center'>{$row['TglSelesai']}</td>
                      <td>{$row['DipesanOleh']}</td>
                      <td>{$row['Kelompok']}</td>
                      <td>{$row['Subkelompok']}</td>
                      <td class='text-end'>Rp " . number_format($row['Jumlah'], 0, ',', '.') . "</td>
                    </tr>";
          }
      } else {
          echo "<tr><td colspan='9' class='text-center text-muted'>Tidak ada data</td></tr>";
      }
      ?>
    </tbody>
  </table>
</div>
</body>
</html>
