<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

include "../templates/header.php";
include "../templates/sidebar.php";
?>

<h4 class="mb-4">Tambah Buku</h4>

<div class="card shadow-sm">
    <div class="card-body">

        <form method="post" action="proses.php" enctype="multipart/form-data">

            <div class="mb-3">
                <label class="form-label">Judul Buku</label>
                <input type="text" name="judul" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Pengarang</label>
                <input type="text" name="pengarang" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Tahun Terbit</label>
                <input type="number" name="tahun" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Sampul Buku</label>
                <input type="file" name="sampul" class="form-control" accept="image/*">
                <small class="text-muted">
                    Kosongkan jika tidak ada (akan memakai sampul default)
                </small>
            </div>

            <button type="submit" class="btn btn-warning">
                Simpan
            </button>
            <a href="index.php" class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>
</div>

<?php include "../templates/footer.php"; ?>
