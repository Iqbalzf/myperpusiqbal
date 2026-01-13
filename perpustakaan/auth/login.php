<?php
session_start();

// Jika sudah login, langsung ke dashboard
if (isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin | Perpustakaan</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            min-height: 100vh;
        }
        .login-card {
            border-radius: 16px;
            border: none;
        }
        .login-title {
            font-weight: 600;
            color: #111827;
        }
        .accent {
            color: #fbbf24;
        }
        .btn-login {
            background: #111827;
            color: #fbbf24;
            border-radius: 10px;
            font-weight: 600;
        }
        .btn-login:hover {
            background: #000;
            color: #fbbf24;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card shadow-lg login-card">
                <div class="card-body p-4">

                    <h4 class="text-center login-title mb-1">
                        Admin <span class="accent">Perpustakaan</span>
                    </h4>
                    <p class="text-center text-muted mb-4">
                        Silakan masuk ke sistem
                    </p>

                    <?php if (isset($_GET['error'])) : ?>
                        <div class="alert alert-danger text-center">
                            Username atau password salah
                        </div>
                    <?php endif; ?>

                    <form method="post" action="proses_login.php">
                        <div class="mb-3">
                            <label class="form-label text-muted">Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-login w-100 py-2">
                            Masuk
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
