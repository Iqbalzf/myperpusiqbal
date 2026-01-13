<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once "../config/koneksi.php";
$db = new Database();
$conn = $db->conn;

$anggota = $conn->query("SELECT * FROM anggota ORDER BY nama ASC");
$buku    = $conn->query("SELECT * FROM buku WHERE stok > 0 ORDER BY judul ASC");

include "../templates/header.php";
include "../templates/sidebar.php";
?>

<h4 class="mb-4">Transaksi Peminjaman</h4>

<div class="card shadow-sm">
    <div class="card-body">

        <form method="post" action="proses.php">

            <div class="mb-3">
                <label class="form-label">Anggota</label>
                <select name="id_anggota" class="form-control" required>
                    <option value="">-- Pilih Anggota --</option>
                    <?php while ($a = $anggota->fetch_assoc()): ?>
                        <option value="<?= $a['id_anggota']; ?>">
                            <?= str_pad($a['id_anggota'],5,'0',STR_PAD_LEFT); ?>
                            - <?= $a['nama']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Buku</label>
                <select name="id_buku" class="form-control" required>
                    <option value="">-- Pilih Buku --</option>
                    <?php while ($b = $buku->fetch_assoc()): ?>
                        <option value="<?= $b['id_buku']; ?>">
                            <?= $b['judul']; ?> (Stok: <?= $b['stok']; ?>)
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah Pinjam</label>
                <input type="number" name="jumlah" class="form-control"
                       min="1" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam"
                       class="form-control"
                       value="<?= date('Y-m-d'); ?>" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Tanggal Jatuh Tempo</label>
                <input type="date" name="tanggal_jatuh_tempo"
                       class="form-control"
                       value="<?= date('Y-m-d', strtotime('+7 days')); ?>" required>
            </div>

            <button class="btn btn-warning">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>

        </form>

    </div>
</div>

<?php include "../templates/footer.php"; ?>
