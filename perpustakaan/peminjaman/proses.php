<?php
require_once "../config/koneksi.php";
$db = new Database();
$conn = $db->conn;

$id_anggota = $_POST['id_anggota'];
$id_buku    = $_POST['id_buku'];
$jumlah     = (int) $_POST['jumlah'];
$tgl_pinjam = $_POST['tanggal_pinjam'];
$tgl_jt     = $_POST['tanggal_jatuh_tempo'];

$conn->begin_transaction();

try {

    // cek stok buku
    $stok = $conn->query(
        "SELECT stok FROM buku WHERE id_buku='$id_buku'"
    )->fetch_assoc()['stok'];

    if ($stok < $jumlah) {
        throw new Exception("Stok buku tidak mencukupi");
    }

    // insert peminjaman
    $stmt = $conn->prepare(
        "INSERT INTO peminjaman 
        (id_anggota, tanggal_pinjam, tanggal_jatuh_tempo, status)
        VALUES (?, ?, ?, 'dipinjam')"
    );
    $stmt->bind_param("iss", $id_anggota, $tgl_pinjam, $tgl_jt);
    $stmt->execute();

    $id_peminjaman = $conn->insert_id;

    // detail peminjaman
    $stmt = $conn->prepare(
        "INSERT INTO detail_peminjaman 
        (id_peminjaman, id_buku, jumlah)
        VALUES (?, ?, ?)"
    );
    $stmt->bind_param("iii", $id_peminjaman, $id_buku, $jumlah);
    $stmt->execute();

    // kurangi stok
    $conn->query(
        "UPDATE buku SET stok = stok - $jumlah WHERE id_buku='$id_buku'"
    );

    $conn->commit();

    // sukses
    header("Location: index.php");
    exit;

} catch (Exception $e) {

    $conn->rollback();

    // popup notifikasi + redirect
    echo "
    <script>
        alert('Transaksi gagal: Stok buku tidak mencukupi!');
        window.location.href = 'tambah.php';
    </script>
    ";
}
