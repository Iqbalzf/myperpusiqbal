<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

include "../templates/header.php";
include "../templates/sidebar.php";
?>

<h4 class="mb-4">Tambah Anggota</h4>

<div class="card shadow-sm">
    <div class="card-body">

        <form method="post" action="proses.php">

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control"></textarea>
            </div>

            <div class="mb-4">
                <label class="form-label">No HP</label>
                <input type="text" name="no_hp" class="form-control">
            </div>

            <button class="btn btn-warning">Simpan</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>

        </form>

    </div>
</div>

<?php include "../templates/footer.php"; ?>
