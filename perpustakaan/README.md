# Sistem Informasi Perpustakaan (Admin)

https://drive.google.com/drive/folders/1yIlF2snneGj-KUdtsVS50IPx4nSqDWkO?usp=sharing

Sistem Informasi Perpustakaan ini merupakan aplikasi berbasis web yang dikembangkan
menggunakan **PHP Native** dan **MySQL**, bertujuan untuk membantu pengelolaan
data perpustakaan secara terstruktur dan terintegrasi.

Aplikasi ini digunakan oleh **Admin** untuk mengelola data buku, anggota,
transaksi peminjaman, pengembalian, denda, serta laporan perpustakaan.

---

## 🎯 Fitur Utama

### 1. Autentikasi Admin
- Login admin menggunakan username dan password
- Proteksi halaman menggunakan session
- Logout untuk mengakhiri sesi

### 2. Dashboard
- Menampilkan ringkasan:
  - Total buku
  - Total anggota
  - Jumlah peminjaman aktif
  - Total denda
- Shortcut menu ke modul utama

### 3. Manajemen Buku
- CRUD data buku (judul, pengarang, tahun, stok, sampul)
- Upload gambar sampul buku
- Tombol hapus otomatis **nonaktif** jika buku pernah atau sedang dipinjam
- Pencarian dan pagination data buku

### 4. Manajemen Anggota
- CRUD data anggota
- Pencarian dan pagination
- Data anggota tidak dapat dihapus jika memiliki riwayat peminjaman

### 5. Peminjaman Buku
- Transaksi peminjaman buku oleh anggota
- Mendukung peminjaman dengan jumlah buku lebih dari satu
- Otomatis mengurangi stok buku
- Menyimpan tanggal pinjam dan tanggal jatuh tempo
- Status peminjaman (dipinjam / dikembalikan)

### 6. Pengembalian Buku & Denda
- Proses pengembalian buku
- Otomatis menambah stok buku
- Perhitungan denda jika pengembalian melewati jatuh tempo
- Penanda warna merah untuk keterlambatan
- Status transaksi diperbarui secara otomatis

### 7. Laporan
- Laporan peminjaman aktif
- Laporan pengembalian dan denda
- Filter berdasarkan tanggal
- Pagination
- Cetak laporan ke PDF (menggunakan print browser)

---

## ⚙️ Aturan & Mekanisme Sistem

1. Sistem hanya dapat diakses oleh admin yang telah login.
2. Buku tidak dapat dihapus jika masih atau pernah digunakan dalam transaksi peminjaman.
3. Anggota tidak dapat dihapus jika memiliki riwayat peminjaman.
4. Peminjaman dicatat dengan tanggal pinjam dan jatuh tempo.
5. Pengembalian melewati jatuh tempo akan dikenakan denda.
6. Sistem menerapkan foreign key untuk menjaga integritas data.
7. Penghapusan data dilindungi dengan validasi di sisi antarmuka dan server.

---

## 🗂️ Struktur Folder

perpustakaan/
├── auth/
│ ├── login.php
│ └── logout.php
├── assets/
│ └── img/
│ └── buku/
├── buku/
├── anggota/
├── peminjaman/
├── pengembalian/
├── laporan/
├── config/
│ └── koneksi.php
├── templates/
│ ├── header.php
│ ├── sidebar.php
│ └── footer.php
├── index.php
└── README.md


---

## 🛠️ Teknologi yang Digunakan

- PHP Native
- MySQL
- Bootstrap (CDN)
- HTML5 & CSS3
- JavaScript (alert & konfirmasi)

---

## 🧪 Catatan Pengujian

- Sistem telah diuji dengan berbagai skenario:
  - Penghapusan data yang masih memiliki relasi
  - Peminjaman dengan stok terbatas
  - Pengembalian tepat waktu dan terlambat
- Error database ditangani dengan validasi logika program

---

## 👤 Hak Akses

- **Admin**
  - Mengelola seluruh data sistem
  - Melakukan transaksi peminjaman dan pengembalian
  - Melihat dan mencetak laporan

---

## 📌 Tujuan Pengembangan

Aplikasi ini dikembangkan sebagai bagian dari:
- Implementasi pemrograman terstruktur dan berorientasi objek
- Penerapan akses basis data
- Pemenuhan skema kompetensi **LSP**
- Studi kasus Sistem Informasi Perpustakaan

---

## ✅ Status Proyek

✔ Fungsional  
✔ Terstruktur  
✔ Aman secara data  
✔ Siap untuk uji kompetensi LSP  

