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
$conn->query("DELETE FROM anggota WHERE id_anggota='$id'");

header("Location: index.php");
exit;
