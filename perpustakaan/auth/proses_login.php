<?php
session_start();
require_once "../config/koneksi.php";

// Ambil input
$username = $_POST['username'];
$password = $_POST['password'];

// Koneksi database
$db = new Database();
$conn = $db->conn;

// Query admin
$stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();
$admin = $result->fetch_assoc();

if ($admin && password_verify($password, $admin['password'])) {
    $_SESSION['login'] = true;
    $_SESSION['id_admin'] = $admin['id_admin'];
    $_SESSION['username'] = $admin['username'];

    header("Location: ../index.php");
    exit;
}

// Jika gagal
header("Location: login.php?error=1");
exit;
