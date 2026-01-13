<?php
require_once "../config/koneksi.php";
$db = new Database();
$conn = $db->conn;

$id_peminjaman = $_POST['id_peminjaman'];
$denda = (int) $_POST['denda'];

$conn->begin_transaction();

try {

    // ambil detail buku
    $detail = $conn->query("
        SELECT id_buku, jumlah
        FROM detail_peminjaman
        WHERE id_peminjaman = '$id_peminjaman'
    ");

    if ($detail->num_rows == 0) {
        throw new Exception("Detail peminjaman tidak ditemukan");
    }

    // kembalikan stok
    while ($d = $detail->fetch_assoc()) {
        $conn->query("
            UPDATE buku 
            SET stok = stok + {$d['jumlah']}
            WHERE id_buku = '{$d['id_buku']}'
        ");
    }

    // update peminjaman
    $conn->query("
        UPDATE peminjaman 
        SET status = 'dikembalikan',
            tanggal_kembali = CURDATE(),
            denda = $denda
        WHERE id_peminjaman = '$id_peminjaman'
    ");

    $conn->commit();

} catch (Exception $e) {
    $conn->rollback();
    echo "
    <script>
        alert('Pengembalian gagal: {$e->getMessage()}');
        window.location.href = 'index.php';
    </script>
    ";
    exit;
}

header("Location: index.php");
exit;
