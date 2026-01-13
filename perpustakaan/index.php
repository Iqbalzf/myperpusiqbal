<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: auth/login.php");
    exit;
}

require_once "config/koneksi.php";
$db = new Database();
$conn = $db->conn;

include "templates/header.php";
include "templates/sidebar.php";

/* =========================
   AMBIL DATA DASHBOARD
========================= */

// Total Buku
$total_buku = $conn->query("SELECT COUNT(*) AS total FROM buku")
    ->fetch_assoc()['total'];

// Total Anggota
$total_anggota = $conn->query("SELECT COUNT(*) AS total FROM anggota")
    ->fetch_assoc()['total'];

// Buku Sedang Dipinjam
$total_pinjam = $conn->query("
    SELECT COUNT(*) AS total 
    FROM peminjaman 
    WHERE status = 'dipinjam'
")->fetch_assoc()['total'];

// Total Denda
$total_denda = $conn->query("
    SELECT SUM(denda) AS total 
    FROM peminjaman 
    WHERE status = 'dikembalikan'
")->fetch_assoc()['total'];

$total_denda = $total_denda ?? 0;
?>

<h4 class="mb-4">Dashboard</h4>

<div class="row">

    <!-- TOTAL BUKU -->
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6 class="text-muted">Total Buku</h6>
                <h3 class="fw-bold"><?= $total_buku; ?></h3>
            </div>
        </div>
    </div>

    <!-- TOTAL ANGGOTA -->
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6 class="text-muted">Total Anggota</h6>
                <h3 class="fw-bold"><?= $total_anggota; ?></h3>
            </div>
        </div>
    </div>

    <!-- SEDANG DIPINJAM -->
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6 class="text-muted">Sedang Dipinjam</h6>
                <h3 class="fw-bold"><?= $total_pinjam; ?></h3>
            </div>
        </div>
    </div>

    <!-- TOTAL DENDA -->
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h6 class="text-muted">Total Denda</h6>
                <h3 class="fw-bold">
                    Rp <?= number_format($total_denda); ?>
                </h3>
            </div>
        </div>
    </div>

</div>

<hr>

<!-- QUICK MENU -->
<div class="row">

    <div class="col-md-3 mb-3">
        <a href="buku/index.php" class="btn btn-outline-dark w-100">
            📚 Data Buku
        </a>
    </div>

    <div class="col-md-3 mb-3">
        <a href="anggota/index.php" class="btn btn-outline-dark w-100">
            👤 Data Anggota
        </a>
    </div>

    <div class="col-md-3 mb-3">
        <a href="peminjaman/index.php" class="btn btn-outline-dark w-100">
            🔄 Peminjaman
        </a>
    </div>

    <div class="col-md-3 mb-3">
        <a href="laporan/index.php" class="btn btn-outline-dark w-100">
            📊 Laporan
        </a>
    </div>

</div>
<hr>

<div class="card shadow-sm border-0 mt-4">
    <div class="card-body">

        <h5 class="fw-bold mb-3">Aturan & Mekanisme Sistem Perpustakaan</h5>

        <ol class="mb-0">
            <li class="mb-2">
                <strong>Akses Sistem</strong><br>
                Sistem hanya dapat diakses oleh <em>Admin</em> yang telah melakukan login.
                Setiap aktivitas tercatat dalam sistem untuk menjaga keamanan data.
            </li>

            <li class="mb-2">
                <strong>Manajemen Data Buku</strong><br>
                Admin dapat menambah, mengubah, dan melihat data buku.
                Penghapusan buku <strong>tidak diizinkan</strong> apabila buku tersebut
                masih atau pernah digunakan dalam transaksi peminjaman.
            </li>

            <li class="mb-2">
                <strong>Manajemen Data Anggota</strong><br>
                Admin dapat mengelola data anggota.
                Data anggota <strong>tidak dapat dihapus</strong> jika masih memiliki
                riwayat transaksi peminjaman.
            </li>

            <li class="mb-2">
                <strong>Proses Peminjaman</strong><br>
                Setiap peminjaman dicatat dengan informasi:
                tanggal pinjam, tanggal jatuh tempo, jumlah buku, dan status peminjaman.
                Stok buku akan berkurang secara otomatis saat transaksi peminjaman berhasil.
            </li>

            <li class="mb-2">
                <strong>Proses Pengembalian</strong><br>
                Pengembalian hanya dapat dilakukan pada transaksi dengan status <em>dipinjam</em>.
                Sistem akan mengubah status menjadi <em>dikembalikan</em> dan mengembalikan stok buku.
            </li>

            <li class="mb-2">
                <strong>Denda Keterlambatan</strong><br>
                Apabila tanggal pengembalian melewati tanggal jatuh tempo,
                maka sistem akan menghitung denda secara otomatis sesuai ketentuan yang berlaku.
            </li>

            <li class="mb-2">
                <strong>Laporan</strong><br>
                Sistem menyediakan laporan peminjaman dan pengembalian yang dapat
                difilter berdasarkan tanggal dan dicetak dalam bentuk dokumen.
            </li>

            <li>
                <strong>Keamanan & Integritas Data</strong><br>
                Sistem menerapkan validasi relasi data (foreign key)
                untuk mencegah penghapusan data yang masih digunakan dalam transaksi.
            </li>
        </ol>

    </div>
</div>


<?php include "templates/footer.php"; ?>
