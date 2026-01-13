<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once "../config/koneksi.php";
$db = new Database();
$conn = $db->conn;

/* ======================
   MODE CETAK
====================== */
$cetak = isset($_GET['cetak']);

/* ======================
   FILTER TANGGAL PINJAM
====================== */
$awal  = $_GET['awal'] ?? '';
$akhir = $_GET['akhir'] ?? '';

$where = "WHERE p.status = 'dipinjam'";
if ($awal && $akhir) {
    $where .= " AND p.tanggal_pinjam BETWEEN '$awal' AND '$akhir'";
}

/* ======================
   PAGINATION
====================== */
$batas = 10;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman - 1) * $batas;

$limit = $cetak ? "" : "LIMIT $halaman_awal, $batas";

/* ======================
   DATA PEMINJAMAN AKTIF
====================== */
$data = $conn->query("
    SELECT 
        p.id_peminjaman,
        a.nama,
        p.tanggal_pinjam,
        p.tanggal_jatuh_tempo,
        SUM(d.jumlah) AS total_buku
    FROM peminjaman p
    JOIN anggota a ON p.id_anggota = a.id_anggota
    JOIN detail_peminjaman d ON p.id_peminjaman = d.id_peminjaman
    $where
    GROUP BY p.id_peminjaman
    ORDER BY p.tanggal_jatuh_tempo ASC
    $limit
");

/* ======================
   TOTAL DATA
====================== */
$total_data = $conn->query("
    SELECT COUNT(DISTINCT p.id_peminjaman) AS total
    FROM peminjaman p
    JOIN detail_peminjaman d ON p.id_peminjaman = d.id_peminjaman
    $where
")->fetch_assoc()['total'];

$total_halaman = ceil($total_data / $batas);

/* ======================
   HEADER
====================== */
if (!$cetak) {
    include "../templates/header.php";
    include "../templates/sidebar.php";
}
?>

<h4 class="mb-4 text-center">Laporan Peminjaman Aktif</h4>

<?php if (!$cetak): ?>
<!-- FILTER -->
<form method="get" class="row g-2 mb-3">
    <div class="col-md-3">
        <input type="date" name="awal" class="form-control" value="<?= $awal; ?>">
    </div>
    <div class="col-md-3">
        <input type="date" name="akhir" class="form-control" value="<?= $akhir; ?>">
    </div>
    <div class="col-md-2">
        <button class="btn btn-dark w-100">Filter</button>
    </div>
    <div class="col-md-2">
        <a href="?awal=<?= $awal; ?>&akhir=<?= $akhir; ?>&cetak=1"
           target="_blank"
           class="btn btn-danger w-100">
            Cetak / PDF
        </a>
    </div>
</form>
<?php endif; ?>

<table class="table table-bordered table-hover">
    <thead class="table-dark text-center">
        <tr>
            <th>ID</th>
            <th>Nama Anggota</th>
            <th>Jumlah Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Jatuh Tempo</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($data->num_rows > 0): while ($row = $data->fetch_assoc()): ?>
        <tr>
            <td class="text-center">
                <?= str_pad($row['id_peminjaman'], 5, '0', STR_PAD_LEFT); ?>
            </td>
            <td><?= $row['nama']; ?></td>
            <td class="text-center"><?= $row['total_buku']; ?></td>
            <td class="text-center"><?= $row['tanggal_pinjam']; ?></td>
            <td class="text-center"><?= $row['tanggal_jatuh_tempo']; ?></td>
        </tr>
        <?php endwhile; else: ?>
        <tr>
            <td colspan="5" class="text-center text-muted">
                Tidak ada peminjaman aktif
            </td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php if (!$cetak): ?>
<!-- PAGINATION -->
<nav>
    <ul class="pagination justify-content-center">
        <?php for ($i = 1; $i <= $total_halaman; $i++): ?>
        <li class="page-item <?= $i == $halaman ? 'active' : ''; ?>">
            <a class="page-link"
               href="?halaman=<?= $i; ?>&awal=<?= $awal; ?>&akhir=<?= $akhir; ?>">
                <?= $i; ?>
            </a>
        </li>
        <?php endfor; ?>
    </ul>
</nav>

<a href="index.php" class="btn btn-secondary mt-3">
    ← Kembali
</a>

<?php include "../templates/footer.php"; ?>
<?php else: ?>
<script>
    window.print();
</script>
<?php endif; ?>

<!-- ======================
     CSS KHUSUS CETAK
====================== -->
<style>
@media print {
    body {
        font-size: 12px;
        color: #000;
    }

    .btn,
    form,
    nav,
    .sidebar,
    .pagination {
        display: none !important;
    }

    h4 {
        text-align: center;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th, table td {
        border: 1px solid #000;
        padding: 6px;
        text-align: center;
    }

    table th {
        background-color: #f2f2f2 !important;
        color: #000;
    }
}
</style>
