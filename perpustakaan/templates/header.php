<?php
// pastikan session sudah aktif di halaman pemanggil
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin | Sistem Perpustakaan</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }
        .navbar-custom {
            background: linear-gradient(90deg, #0f172a, #020617);
        }
        .navbar-brand {
            font-weight: 600;
            color: #fbbf24 !important;
        }
        .admin-name {
            color: #e5e7eb;
            font-size: 14px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-custom px-4">
    <span class="navbar-brand">
        Sistem Perpustakaan
    </span>

    <div class="d-flex align-items-center">
        <span class="admin-name me-3">
            <?= $_SESSION['username']; ?>
        </span>
        <a href="auth/logout.php" class="btn btn-sm btn-warning">
            Logout
        </a>
    </div>
</nav>
