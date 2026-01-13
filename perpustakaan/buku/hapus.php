<?php
session_start();
require_once "../config/koneksi.php";

$db = new Database();
$conn = $db->conn;

$id = $_GET['id'];

// CEK APAKAH BUKU MASIH DIPAKAI DI PEMINJAMAN
$cek = $conn->query("
    SELECT COUNT(*) AS total 
    FROM detail_peminjaman 
    WHERE id_buku = '$id'
")->fetch_assoc();

if ($cek['total'] > 0) {
    // JIKA MASIH DIPAKAI → POPUP
    echo "
    <script>
        alert('Buku tidak dapat dihapus karena masih digunakan dalam transaksi peminjaman.');
        window.location.href = 'index.php';
    </script>
    ";
    exit;
}

// JIKA AMAN → HAPUS
$conn->query("DELETE FROM buku WHERE id_buku = '$id'");

echo "
<script>
    alert('Data buku berhasil dihapus.');
    window.location.href = 'index.php';
</script>
";
