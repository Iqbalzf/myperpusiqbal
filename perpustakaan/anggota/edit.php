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
$data = $conn->query("SELECT * FROM anggota WHERE id_anggota='$id'");
$anggota = $data->fetch_assoc();

include "../templates/header.php";
include "../templates/sidebar.php";
?>

<h4 class="mb-4">Edit Anggota</h4>

<div class="card shadow-sm">
    <div class="card-body">

        <form method="post" action="proses.php">
            <input type="hidden" name="id_anggota" value="<?= $anggota['id_anggota']; ?>">

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control"
                       value="<?= $anggota['nama']; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control"><?= $anggota['alamat']; ?></textarea>
            </div>

            <div class="mb-4">
                <label class="form-label">No HP</label>
                <input type="text" name="no_hp" class="form-control"
                       value="<?= $anggota['no_hp']; ?>">
            </div>

            <button class="btn btn-warning">Update</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>

        </form>

    </div>
</div>

<?php include "../templates/footer.php"; ?>
