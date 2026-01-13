<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

require_once "../config/koneksi.php";
$db = new Database();
$conn = $db->conn;

$id = $_GET['id'];

$peminjaman = $conn->query("
    SELECT p.*, a.nama
    FROM peminjaman p
    JOIN anggota a ON p.id_anggota = a.id_anggota
    WHERE p.id_peminjaman = '$id'
")->fetch_assoc();

if ($peminjaman['status'] == 'dikembalikan') {
    echo "
    <script>
        alert('Buku sudah dikembalikan!');
        window.location.href = 'index.php';
    </script>
    ";
    exit;
}


$detail = $conn->query("
    SELECT d.jumlah, b.judul
    FROM detail_peminjaman d
    JOIN buku b ON d.id_buku = b.id_buku
    WHERE d.id_peminjaman = '$id'
");

/* HITUNG DENDA */
$tgl_kembali = date('Y-m-d');
$jatuh_tempo = $peminjaman['tanggal_jatuh_tempo'];

$selisih = (strtotime($tgl_kembali) - strtotime($jatuh_tempo)) / (60*60*24);
$terlambat = ($selisih > 0) ? floor($selisih) : 0;

$denda_per_hari = 1000;
$total_denda = $terlambat * $denda_per_hari;

include "../templates/header.php";
include "../templates/sidebar.php";
?>

<h4 class="mb-4">Proses Pengembalian</h4>

<div class="card shadow-sm">
    <div class="card-body">

        <p><strong>Nama Anggota:</strong> <?= $peminjaman['nama']; ?></p>
        <p><strong>Tanggal Pinjam:</strong> <?= $peminjaman['tanggal_pinjam']; ?></p>
        <p><strong>Jatuh Tempo:</strong> <?= $jatuh_tempo; ?></p>
        <p><strong>Tanggal Kembali:</strong> <?= $tgl_kembali; ?></p>

        <hr>

        <h6>Detail Buku</h6>
        <ul>
            <?php while ($d = $detail->fetch_assoc()): ?>
                <li><?= $d['judul']; ?> (<?= $d['jumlah']; ?> buku)</li>
            <?php endwhile; ?>
        </ul>

        <hr>

        <p>
            <strong>Keterlambatan:</strong> <?= $terlambat; ?> hari<br>
            <strong>Denda:</strong> Rp <?= number_format($total_denda); ?>
        </p>

        <form method="post" action="proses.php">
            <input type="hidden" name="id_peminjaman" value="<?= $id; ?>">
            <input type="hidden" name="denda" value="<?= $total_denda; ?>">

            <button class="btn btn-success"
                    onclick="return confirm('Selesaikan pengembalian buku?')">
                Selesaikan Pengembalian
            </button>

            <a href="index.php" class="btn btn-secondary">Batal</a>
        </form>

    </div>
</div>

<?php include "../templates/footer.php"; ?>
