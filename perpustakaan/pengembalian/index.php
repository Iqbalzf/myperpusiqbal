<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once "../config/koneksi.php";
$db = new Database();
$conn = $db->conn;

include "../templates/header.php";
include "../templates/sidebar.php";

/* =========================
   SEARCH
========================= */
$keyword = isset($_GET['search']) ? trim($_GET['search']) : "";
$where = "";

if ($keyword != "") {
    $where = "WHERE a.nama LIKE '%$keyword%'
              OR p.status LIKE '%$keyword%'
              OR p.id_peminjaman LIKE '%$keyword%'";
}

/* =========================
   AMBIL DATA PENGEMBALIAN
========================= */
$data = $conn->query("
    SELECT 
        p.id_peminjaman,
        a.nama,
        p.tanggal_pinjam,
        p.tanggal_jatuh_tempo,
        p.status,
        IFNULL(p.denda, 0) AS denda,
        SUM(d.jumlah) AS total_buku
    FROM peminjaman p
    JOIN anggota a ON p.id_anggota = a.id_anggota
    JOIN detail_peminjaman d ON p.id_peminjaman = d.id_peminjaman
    $where
    GROUP BY p.id_peminjaman
    ORDER BY p.id_peminjaman DESC
");
?>

<h4 class="mb-4">Pengembalian Buku</h4>

<!-- SEARCH BAR -->
<div class="row mb-3">
    <div class="col-md-6">
        <p class="text-muted mb-0">
            Daftar transaksi peminjaman untuk proses pengembalian
        </p>
    </div>
    <div class="col-md-6">
        <form method="get" class="d-flex">
            <input type="text" name="search"
                class="form-control me-2"
                placeholder="Cari nama / status / ID..."
                value="<?= htmlspecialchars($keyword); ?>">
            <button class="btn btn-dark">Cari</button>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <table class="table table-bordered table-hover">
            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Nama Anggota</th>
                    <th>Jumlah Buku</th>
                    <th>Status</th>
                    <th>Denda</th>
                    <th width="160">Aksi</th>
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
                    <td class="text-center">
                        <span class="badge bg-<?= $row['status']=='dipinjam' ? 'warning' : 'success'; ?>">
                            <?= ucfirst($row['status']); ?>
                        </span>
                    </td>
                    <td class="text-center">
                        Rp <?= number_format($row['denda']); ?>
                    </td>
                    <td class="text-center">

                        <?php if ($row['status'] == 'dipinjam'): ?>
                            <a href="kembalikan.php?id=<?= $row['id_peminjaman']; ?>"
                               class="btn btn-sm btn-success">
                               Proses
                            </a>
                        <?php else: ?>
                            <button class="btn btn-sm btn-secondary"
                                onclick="alert('Buku sudah dikembalikan');">
                                Selesai
                            </button>
                        <?php endif; ?>

                    </td>
                </tr>
                <?php endwhile; else: ?>
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Data tidak ditemukan
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>
</div>

<?php include "../templates/footer.php"; ?>
