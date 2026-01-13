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
$data = $conn->query("SELECT * FROM buku WHERE id_buku='$id'");
$buku = $data->fetch_assoc();

include "../templates/header.php";
include "../templates/sidebar.php";
?>

<h4 class="mb-4">Edit Buku</h4>

<div class="card shadow-sm">
    <div class="card-body">

        <form method="post" action="proses.php" enctype="multipart/form-data">
            <input type="hidden" name="id_buku" value="<?= $buku['id_buku']; ?>">

            <div class="mb-3">
                <label class="form-label">Judul Buku</label>
                <input type="text" name="judul" class="form-control"
                       value="<?= $buku['judul']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Pengarang</label>
                <input type="text" name="pengarang" class="form-control"
                       value="<?= $buku['pengarang']; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Tahun Terbit</label>
                <input type="number" name="tahun" class="form-control"
                       value="<?= $buku['tahun_terbit']; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control"
                       value="<?= $buku['stok']; ?>" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Sampul Buku</label><br>

                <img src="../assets/img/buku/<?= $buku['sampul'] ?: 'default.png'; ?>"
                     width="100"
                     class="mb-3 rounded shadow-sm">

                <input type="file" name="sampul" class="form-control" accept="image/*">
                <small class="text-muted">
                    Kosongkan jika tidak ingin mengganti sampul
                </small>
            </div>

            <button class="btn btn-warning">Update</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>

    </div>
</div>

<?php include "../templates/footer.php"; ?>
