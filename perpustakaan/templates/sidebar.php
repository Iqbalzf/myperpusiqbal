<style>
    .sidebar {
        background: #020617;
        min-height: 100vh;
        padding-top: 20px;
    }

    .sidebar a {
        color: #cbd5f5;
        text-decoration: none;
        padding: 12px 20px;
        display: block;
        font-size: 14px;
        border-left: 3px solid transparent;
        transition: 0.3s;
    }

    .sidebar a:hover {
        background: #0f172a;
        color: #fbbf24;
        border-left: 3px solid #fbbf24;
    }

    .sidebar-title {
        color: #64748b;
        font-size: 12px;
        padding: 10px 20px;
        text-transform: uppercase;
    }
</style>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-2 sidebar p-0">
            <div class="sidebar-title">Menu</div>

            <a href="/perpustakaan/index.php">Dashboard</a>
            <a href="/perpustakaan/buku/index.php">Data Buku</a>
            <a href="/perpustakaan/anggota/index.php">Data Anggota</a>
            <a href="/perpustakaan/peminjaman/index.php">Peminjaman</a>
            <a href="/perpustakaan/pengembalian/index.php">Pengembalian</a>
            <a href="/perpustakaan/laporan/index.php">Laporan</a>

        </div>

        <!-- KONTEN -->
        <div class="col-md-10 p-4">