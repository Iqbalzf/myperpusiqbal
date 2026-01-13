<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

include "../templates/header.php";
include "../templates/sidebar.php";
?>

<div class="container-fluid">

    <!-- JUDUL -->
    <div class="mb-4">
        <h4 class="fw-bold">Laporan Perpustakaan</h4>
        <p class="text-muted mb-0">
            Modul laporan transaksi peminjaman, pengembalian, dan denda
        </p>
        <hr>
    </div>

    <!-- MENU LAPORAN -->
    <div class="row">

        <!-- PEMINJAMAN -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 laporan-card">
                <div class="card-body">
                    <h6 class="fw-bold mb-2">Laporan Peminjaman</h6>
                    <p class="text-muted small mb-3">
                        Menampilkan seluruh data peminjaman buku oleh anggota
                        beserta status transaksi.
                    </p>
                    <a href="peminjaman.php" class="btn btn-outline-dark btn-sm">
                        Buka Laporan
                    </a>
                </div>
            </div>
        </div>

        <!-- PENGEMBALIAN -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 laporan-card">
                <div class="card-body">
                    <h6 class="fw-bold mb-2">Laporan Pengembalian & Denda</h6>
                    <p class="text-muted small mb-3">
                        Menampilkan data pengembalian buku beserta perhitungan
                        denda keterlambatan.
                    </p>
                    <a href="pengembalian.php" class="btn btn-outline-dark btn-sm">
                        Buka Laporan
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!-- KEMBALI -->
    <a href="../index.php" class="btn btn-secondary btn-sm mt-3">
        ← Kembali ke Dashboard
    </a>

</div>

<?php include "../templates/footer.php"; ?>

<!-- STYLE TAMBAHAN KHUSUS HALAMAN INI -->
<style>
.laporan-card {
    transition: all 0.2s ease-in-out;
    background-color: #ffffff;
}

.laporan-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
}
</style>
