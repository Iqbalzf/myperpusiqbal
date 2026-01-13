<?php
require_once "../config/koneksi.php";
$db = new Database();
$conn = $db->conn;

$nama   = $_POST['nama'];
$alamat = $_POST['alamat'];
$no_hp  = $_POST['no_hp'];

/* INSERT */
if (!isset($_POST['id_anggota'])) {

    $stmt = $conn->prepare(
        "INSERT INTO anggota (nama, alamat, no_hp) VALUES (?, ?, ?)"
    );
    $stmt->bind_param("sss", $nama, $alamat, $no_hp);
    $stmt->execute();
}

/* UPDATE */
else {

    $id = $_POST['id_anggota'];
    $stmt = $conn->prepare(
        "UPDATE anggota SET nama=?, alamat=?, no_hp=? WHERE id_anggota=?"
    );
    $stmt->bind_param("sssi", $nama, $alamat, $no_hp, $id);
    $stmt->execute();
}

header("Location: index.php");
exit;
