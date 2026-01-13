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
    $where = "WHERE a.nama LIKE '%$keyword%' OR a.no_hp LIKE '%$keyword%'";
}

/* =========================
   PAGINATION
========================= */
$batas = 10;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman - 1) * $batas;

/* =========================
   TOTAL DATA
========================= */
$total_data = $conn->query("
    SELECT COUNT(*) AS total
    FROM anggota a
    $where
")->fetch_assoc()['total'];

$total_halaman = ceil($total_data / $batas);

/* =========================
   AMBIL DATA + CEK TRANSAKSI
========================= */
$data = $conn->query("
    SELECT a.*,
           (SELECT COUNT(*) 
            FROM peminjaman p 
            WHERE p.id_anggota = a.id_anggota) AS total_pinjam
    FROM anggota a
    $where
    ORDER BY a.nama ASC
    LIMIT $halaman_awal, $batas
");
?>

<h4 class="mb-4">Data Anggota</h4>

<div class="row mb-3">
    <div class="col-md-6">
        <a href="tambah.php" class="btn btn-warning">
            + Tambah Anggota
        </a>
    </div>

    <div class="col-md-6">
        <form method="get" class="d-flex">
            <input type="text" name="search"
                class="form-control me-2"
                placeholder="Cari nama / no HP..."
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
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th width="140">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($data->num_rows > 0):
                    while ($row = $data->fetch_assoc()): ?>
                    <tr>
                        <td class="text-center">
                            <?= str_pad($row['id_anggota'], 5, '0', STR_PAD_LEFT); ?>
                        </td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['alamat']; ?></td>
                        <td><?= $row['no_hp']; ?></td>
                        <td class="text-center">
                            <a href="edit.php?id=<?= $row['id_anggota']; ?>"
                               class="btn btn-sm btn-primary">
                                Edit
                            </a>

                            <?php if ($row['total_pinjam'] == 0): ?>
                                <a href="hapus.php?id=<?= $row['id_anggota']; ?>"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Hapus anggota ini?')">
                                    Hapus
                                </a>
                            <?php else: ?>
                                <button class="btn btn-sm btn-secondary" disabled
                                    title="Anggota memiliki riwayat peminjaman">
                                    Hapus
                                </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            Data anggota tidak ditemukan
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- PAGINATION -->
        <nav>
            <ul class="pagination justify-content-center mt-4">
                <?php for ($i = 1; $i <= $total_halaman; $i++): ?>
                    <li class="page-item <?= ($i == $halaman) ? 'active' : ''; ?>">
                        <a class="page-link"
                           href="?halaman=<?= $i; ?>&search=<?= urlencode($keyword); ?>">
                            <?= $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>

    </div>
</div>

<?php include "../templates/footer.php"; ?>
