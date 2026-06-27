<?php
// Memulai session PHP
session_start();

// Proteksi Halaman: Jika belum login, tendang kembali ke halaman login.php
if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    header("Location: login.php");
    exit;
}

// Memanggil file koneksi
require 'koneksi.php';

// Mengambil semua data dari tabel buku
$daftar_buku = query_tampil("SELECT * FROM buku ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pustaka Digital - UAS PWEB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            /* Menggunakan background gambar perpustakaan estetik yang senada */
            background: url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?q=80&w=1920') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        /* Efek blur transparan pada Navbar */
        .navbar-custom {
            background: rgba(33, 37, 41, 0.85) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Efek Kartu Kaca Modern (Glassmorphism) */
        .glass-card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.25);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.2);
        }

        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }

        /* Desain badge ISBN custom */
        .badge-isbn {
            background-color: #4a5568;
            color: #ffffff;
            font-size: 0.85rem;
            padding: 6px 10px;
        }

        /* Animasi hover untuk tombol aksi */
        .btn-action {
            transition: all 0.2s ease;
        }
        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="index.php">
                <i class="fa-solid fa-book-open text-warning me-2"></i>Pustaka Digital
            </a>
            
            <div class="d-flex align-items-center">
                <span class="text-light me-3 d-none d-sm-inline fs-6">
                    <i class="fa-solid fa-user-circle text-info me-1"></i> Halo, <strong><?= $_SESSION["nama_user"]; ?></strong>
                </span>
                <a href="logout.php" class="btn btn-sm btn-danger fw-semibold px-3 btn-action" onclick="return confirm('Apakah Anda yakin ingin keluar dari sistem?');">
                    <i class="fa-solid fa-right-from-bracket me-1"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="card glass-card p-4 p-md-5">
            
            <div class="row mb-4 align-items-center">
                <div class="col-md-7 text-center text-md-start mb-3 mb-md-0">
                    <h2 class="fw-bold text-dark mb-1">📋 Daftar Koleksi Buku</h2>
                    <p class="text-muted mb-0">Kelola informasi dan ketersediaan data buku perpustakaan secara real-time.</p>
                </div>
                <div class="col-md-5 text-center text-md-end">
                    <a href="tambah.php" class="btn btn-primary btn-lg fs-6 fw-semibold shadow-sm btn-action px-4">
                        <i class="fa-solid fa-plus-circle me-1"></i> Tambah Buku Baru
                    </a>
                </div>
            </div>

            <div class="table-responsive shadow-sm">
                <table class="table table-hover table-striped mb-0 align-middle bg-white">
                    <thead class="table-dark text-nowrap">
                        <tr>
                            <th class="text-center" style="width: 5%;">No</th>
                            <th style="width: 15%;">ISBN</th>
                            <th style="width: 30%;">Judul Buku</th>
                            <th style="width: 15%;">Penulis</th>
                            <th style="width: 15%;">Penerbit</th>
                            <th class="text-center" style="width: 8%;">Tahun</th>
                            <th class="text-center" style="width: 7%;">Stok</th>
                            <th class="text-center" style="width: 15%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($daftar_buku)) : ?>
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted fw-medium">
                                    <i class="fa-solid fa-folder-open fs-2 d-block mb-2 text-secondary"></i> Belum ada data buku di database.
                                </td>
                            </tr>
                        <?php else : ?>
                            <?php 
                            $no = 1; 
                            foreach ($daftar_buku as $buku) : 
                            ?>
                                <tr>
                                    <td class="text-center fw-bold text-secondary"><?= $no++; ?></td>
                                    <td><span class="badge badge-isbn text-wrap"><i class="fa-solid fa-barcode me-1"></i><?= $buku['isbn']; ?></span></td>
                                    <td class="fw-bold text-dark"><?= $buku['judul']; ?></td>
                                    <td><i class="fa-solid fa-user-pen text-muted me-1 small"></i><?= $buku['penulis']; ?></td>
                                    <td><i class="fa-solid fa-building-columns text-muted me-1 small"></i><?= $buku['penerbit']; ?></td>
                                    <td class="text-center text-secondary fw-medium"><?= $buku['tahun_terbit']; ?></td>
                                    <td class="text-center">
                                        <?php if ($buku['stok'] <= 5) : ?>
                                            <span class="badge bg-danger text-white px-2 py-1"><i class="fa-solid fa-triangle-exclamation me-1"></i><?= $buku['stok']; ?> (Kritis)</span>
                                        <?php else : ?>
                                            <span class="badge bg-success text-white px-3 py-1"><?= $buku['stok']; ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center text-nowrap">
                                        <a href="edit.php?id=<?= $buku['id']; ?>" class="btn btn-sm btn-warning fw-semibold text-dark btn-action px-3 me-1">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </a>
                                        <a href="hapus.php?id=<?= $buku['id']; ?>" class="btn btn-sm btn-danger fw-semibold btn-action px-3" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <footer class="text-center py-4 text-white-50 mt-5" style="background: rgba(33, 37, 41, 0.85); backdrop-filter: blur(10px);">
        <p class="mb-0 small">&copy; 2026 - Aplikasi Pendataan Buku UAS Pemrograman Web.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
