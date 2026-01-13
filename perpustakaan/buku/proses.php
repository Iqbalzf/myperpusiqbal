<?php
require_once "../config/koneksi.php";
$db = new Database();
$conn = $db->conn;

$judul      = $_POST['judul'];
$pengarang  = $_POST['pengarang'];
$tahun      = $_POST['tahun'];
$stok       = $_POST['stok'];

$folder = "../assets/img/buku/";
$sampul = "default.png";

/* =========================
   PROSES UPLOAD GAMBAR
========================= */
if (!empty($_FILES['sampul']['name'])) {

    $ext_valid = ['jpg', 'jpeg', 'png'];
    $ext = strtolower(pathinfo($_FILES['sampul']['name'], PATHINFO_EXTENSION));

    if (!in_array($ext, $ext_valid)) {
        die("Format gambar tidak valid!");
    }

    if ($_FILES['sampul']['size'] > 2 * 1024 * 1024) {
        die("Ukuran gambar maksimal 2MB!");
    }

    $nama_file = uniqid() . '.' . $ext;
    move_uploaded_file($_FILES['sampul']['tmp_name'], $folder . $nama_file);
    $sampul = $nama_file;
}

/* =========================
   INSERT DATA
========================= */
if (!isset($_POST['id_buku'])) {

    $stmt = $conn->prepare(
        "INSERT INTO buku (judul, pengarang, tahun_terbit, stok, sampul)
         VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("ssiss", $judul, $pengarang, $tahun, $stok, $sampul);
    $stmt->execute();
}

/* =========================
   UPDATE DATA
========================= */
else {

    $id = $_POST['id_buku'];

    // Ambil data lama
    $old = $conn->query("SELECT sampul FROM buku WHERE id_buku='$id'")
                ->fetch_assoc();

    if ($sampul == "default.png") {
        $sampul = $old['sampul'];
    } else {
        if ($old['sampul'] != "default.png") {
            unlink($folder . $old['sampul']);
        }
    }

    $stmt = $conn->prepare(
        "UPDATE buku SET judul=?, pengarang=?, tahun_terbit=?, stok=?, sampul=?
         WHERE id_buku=?"
    );
    $stmt->bind_param(
        "ssissi",
        $judul,
        $pengarang,
        $tahun,
        $stok,
        $sampul,
        $id
    );
    $stmt->execute();
}

header("Location: index.php");
exit;
