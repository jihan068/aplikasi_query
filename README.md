## 🧩 Deskripsi Singkat

Aplikasi **Daftar & Edit Pesanan** adalah web berbasis PHP yang terhubung ke database **MySQL/MariaDB** menggunakan **PDO**. Aplikasi ini menampilkan data pesanan dari tabel `kartupesanan` dan `detailpesanan` dengan tampilan Bootstrap yang responsif, serta menyediakan fitur **edit data pesanan**.

---

## ⚙️ Teknologi yang Digunakan

* **PHP (PDO)** → untuk koneksi dan manipulasi database
* **MySQL/MariaDB** → untuk menyimpan data pesanan dan detailnya
* **Bootstrap 5** → untuk tampilan web responsif
* **HTML + CSS** → untuk struktur tampilan dasar

---

## 🗂️ Struktur Folder dan Fungsi Masing-masing File

| File                 | Fungsi                                                                                                                                                   |
| -------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **db.php**           | Mengatur koneksi ke database menggunakan PDO. File ini dipanggil di semua halaman PHP agar bisa berkomunikasi dengan database.                           |
| **index.php**        | Halaman utama aplikasi. Berisi menu navigasi atau tombol untuk menuju ke daftar pesanan.                                                                 |
| **pesanan.php**      | Menampilkan semua data pesanan dalam bentuk tabel Bootstrap. Data diambil dari tabel `kartupesanan` dan menampilkan tombol **Edit** untuk setiap baris.  |
| **edit_pesanan.php** | Halaman untuk mengubah data pesanan berdasarkan `NomorPesanan`. Form berisi data lama, lalu pengguna bisa mengedit dan menyimpannya kembali ke database. |
| **README.md**        | File dokumentasi proyek yang menjelaskan deskripsi aplikasi, struktur, dan fungsi dari setiap bagian.                                                    |

---

## 🧠 Penjelasan Fungsi Database dan Relasi

Database bernama **`db_pesanan`** terdiri dari dua tabel utama:

### 1. **kartupesanan**

Menyimpan data pesanan secara umum seperti:

* NomorPesanan
* JenisProduk
* JumlahPesanan
* TglPesanan
* TglSelesai
* DipesanOleh

Setiap **NomorPesanan** menjadi **kunci utama (PRIMARY KEY)** dan terhubung ke tabel `detailpesanan`.

### 2. **detailpesanan**

Berisi rincian biaya atau komponen dari setiap pesanan:

* ID (Primary Key)
* NomorPesanan (Foreign Key → kartupesanan.NomorPesanan)
* Tanggal
* Kelompok
* Subkelompok
* Jumlah

Dengan relasi ini, sistem bisa menampilkan satu pesanan dengan detail biayanya secara terpisah.

---

## 🧾 Fungsi Utama Aplikasi

| Fitur                        | Penjelasan                                                                                                                                              |
| ---------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------- |
| **Tampilkan Daftar Pesanan** | Mengambil data dari tabel `kartupesanan` menggunakan query `SELECT * FROM kartupesanan ORDER BY NoPesanan ASC`.                                         |
| **Edit Data Pesanan**        | Mengambil data berdasarkan `$_GET['id']`, menampilkan form dengan data lama, dan memperbarui data menggunakan query `UPDATE ... WHERE NoPesanan = :id`. |
| **Validasi Input**           | Pastikan semua kolom wajib diisi (NamaProduk & Tanggal). Jika kosong, muncul alert JavaScript.                                                          |
| **Navigasi**                 | Tombol *Kembali ke Laporan* dan *Edit* menggunakan link sederhana Bootstrap.                                                                            |
| **Alert & Redirect**         | Setelah update berhasil, sistem menampilkan `alert('Data berhasil diperbarui!')` lalu kembali ke `pesanan.php`.                                         |

---

## 🧩 Koneksi Database (db.php)

Contoh potongan kode penting:

```php
$dsn = "mysql:host=localhost;dbname=db_pesanan;charset=utf8mb4";
$user = "root";
$pass = "";

try {
  $pdo = new PDO($dsn, $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Koneksi gagal: " . $e->getMessage());
}
```

Kode ini menghubungkan PHP dengan database menggunakan PDO, dan akan memunculkan pesan error jika koneksi gagal.

---

## 🪄 Tampilan (Bootstrap)

Semua halaman menggunakan **Bootstrap 5 CDN**, sehingga tampilan tabel dan form otomatis responsif tanpa file CSS tambahan.

Contoh tabel pada `pesanan.php`:

```html
<table class="table table-bordered table-striped table-hover">
  <thead class="table-dark text-center">
    <tr>
      <th>No Pesanan</th>
      <th>Nama Produk</th>
      <th>Tanggal Pesanan</th>
      <th>Aksi</th>
    </tr>
  </thead>
</table>
```

---

## ⚠️ Troubleshooting Umum

| Masalah                    | Penyebab                                              | Solusi                                                         |
| -------------------------- | ----------------------------------------------------- | -------------------------------------------------------------- |
| “Not Found” saat klik Edit | File `edit_pesanan.php` tidak ada di folder yang sama | Pastikan file berada satu direktori dengan `pesanan.php`       |
| “Pesanan tidak ditemukan!” | Parameter `?id=` tidak terkirim                       | Pastikan link tombol edit punya format `edit_pesanan.php?id=1` |
| Error koneksi database     | Salah nama database / user / password                 | Cek `db.php` dan nama DB di phpMyAdmin                         |
| Perubahan tidak tersimpan  | Query gagal / input kosong                            | Pastikan form memiliki atribut `name` dan `method="POST"`      |

---

## 🧩 Catatan Pengembangan

* Bisa dikembangkan menjadi aplikasi CRUD penuh (Tambah, Hapus, Cari).
* Bisa ditambah fitur relasi data antara pesanan & detail (JOIN).
* Bisa diupgrade pakai **Laravel** atau **CodeIgniter** jika ingin MVC.

---

## 📜 Lisensi

Proyek ini bersifat open-source (MIT License) dan dapat digunakan untuk keperluan pembelajaran atau pengembangan aplikasi berbasis web.

---


