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
   KONFIGURASI PAGINATION
========================= */
$batas = 10;
$halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

/* =========================
   SEARCH
========================= */
$keyword = isset($_GET['search']) ? trim($_GET['search']) : "";
$search_sql = "";

if ($keyword != "") {
    $search_sql = "WHERE judul LIKE '%$keyword%' 
                   OR pengarang LIKE '%$keyword%'";
}

/* =========================
   HITUNG TOTAL DATA
========================= */
$total_data = $conn->query(
    "SELECT COUNT(*) AS total FROM buku $search_sql"
)->fetch_assoc()['total'];

$total_halaman = ceil($total_data / $batas);

/* =========================
   AMBIL DATA BUKU
========================= */

$data = $conn->query("
    SELECT b.*,
           (SELECT COUNT(*) 
            FROM detail_peminjaman d 
            WHERE d.id_buku = b.id_buku) AS total_pinjam
    FROM buku b
    $search_sql
    ORDER BY b.judul ASC
    LIMIT $halaman_awal, $batas
");


?>

<h4 class="mb-4">Data Buku</h4>

<div class="row mb-3">
    <div class="col-md-6">
        <a href="tambah.php" class="btn btn-warning">
            + Tambah Buku
        </a>
    </div>

    <div class="col-md-6">
        <form method="get" class="d-flex">
            <input type="text" name="search"
                class="form-control me-2"
                placeholder="Cari judul / pengarang..."
                value="<?= htmlspecialchars($keyword); ?>">
            <button class="btn btn-dark">Cari</button>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Sampul</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th width="130">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = $halaman_awal + 1;
                if ($data->num_rows > 0):
                    while ($row = $data->fetch_assoc()):
                ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>

                            <td class="text-center">
                                <img src="../assets/img/buku/<?= $row['sampul'] ?: 'default.png'; ?>"
                                    width="60" class="rounded shadow-sm">
                            </td>

                            <td><?= $row['judul']; ?></td>
                            <td><?= $row['pengarang']; ?></td>
                            <td class="text-center"><?= $row['tahun_terbit']; ?></td>
                            <td class="text-center"><?= $row['stok']; ?></td>

                            <td class="text-center">
                                <a href="edit.php?id=<?= $row['id_buku']; ?>"
                                    class="btn btn-sm btn-primary">
                                    Edit
                                </a>

                                <?php if ($row['total_pinjam'] == 0): ?>
                                    <a href="hapus.php?id=<?= $row['id_buku']; ?>"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Hapus buku ini?')">
                                        Hapus
                                    </a>
                                <?php else: ?>
                                    <button class="btn btn-sm btn-secondary" disabled
                                        title="Buku sedang/ pernah dipinjam">
                                        Hapus
                                    </button>
                                <?php endif; ?>
                            </td>

                        </tr>
                    <?php endwhile;
                else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Data buku tidak ditemukan
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- PAGINATION -->
        <nav>
            <ul class="pagination justify-content-center mt-4">

                <?php if ($halaman > 1): ?>
                    <li class="page-item">
                        <a class="page-link"
                            href="?halaman=<?= $halaman - 1; ?>&search=<?= urlencode($keyword); ?>">
                            Previous
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_halaman; $i++): ?>
                    <li class="page-item <?= ($i == $halaman) ? 'active' : ''; ?>">
                        <a class="page-link"
                            href="?halaman=<?= $i; ?>&search=<?= urlencode($keyword); ?>">
                            <?= $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>

                <?php if ($halaman < $total_halaman): ?>
                    <li class="page-item">
                        <a class="page-link"
                            href="?halaman=<?= $halaman + 1; ?>&search=<?= urlencode($keyword); ?>">
                            Next
                        </a>
                    </li>
                <?php endif; ?>

            </ul>
        </nav>

    </div>
</div>

<?php include "../templates/footer.php"; ?>