<?php
// 1. Memulai session PHP
session_start();

// 2. Proteksi Halaman: Jika belum login, tendang kembali ke halaman login.php
if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    header("Location: login.php");
    exit;
}

// 3. Memanggil file koneksi database
require 'koneksi.php';

// 4. Memproses data ketika tombol Simpan Data diklik
if (isset($_POST["submit"])) {
    
    // Mengambil data dari form dan menyaringnya dengan fungsi aman()
    $isbn         = aman($_POST["isbn"]);
    $judul        = aman($_POST["judul"]);
    $penulis      = aman($_POST["penulis"]);
    $penerbit     = aman($_POST["penerbit"]);
    $tahun_terbit = intval($_POST["tahun_terbit"]); // Memastikan diinput sebagai angka
    $stok         = intval($_POST["stok"]);         // Memastikan diinput sebagai angka

    // Query untuk memasukkan data baru ke dalam tabel buku
    $query = "INSERT INTO buku (isbn, judul, penulis, penerbit, tahun_terbit, stok) 
              VALUES ('$isbn', '$judul', '$penulis', '$penerbit', $tahun_terbit, $stok)";

    $result = mysqli_query($conn, $query);

    // Cek apakah kueri berhasil dieksekusi
    if ($result) {
        echo "<script>
                alert('Data buku berhasil ditambahkan!');
                document.location.href = 'index.php';
              </script>";
        exit;
    } else {
        // Jika gagal/macet, script akan berhenti di sini dan memunculkan letak kesalahannya
        die("Gagal menambahkan data. Pesan Error MySQL: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Buku - UAS PWEB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">📚 Pustaka Digital</a>
            <div class="d-flex align-items-center">
                <span class="text-light me-3 d-none d-sm-inline">Halo, <strong><?= $_SESSION["nama_user"]; ?></strong></span>
                <a href="logout.php" class="btn btn-sm btn-outline-danger fw-semibold" onclick="return confirm('Apakah Anda yakin ingin keluar dari sistem?');">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container my-5" style="max-width: 600px;">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3">
                <h4 class="mb-0 fw-bold">Tambah Koleksi Buku Baru</h4>
            </div>
            <div class="card-body p-4">
                
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="isbn" class="form-label fw-semibold">Kode ISBN</label>
                        <input type="text" class="form-control" id="isbn" name="isbn" placeholder="Contoh: 978-602-..." required autocomplete="off">
                    </div>
                    
                    <div class="mb-3">
                        <label for="judul" class="form-label fw-semibold">Judul Buku</label>
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan judul lengkap buku" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="penulis" class="form-label fw-semibold">Penulis / Pengarang</label>
                            <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Nama penulis" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="penerbit" class="form-label fw-semibold">Penerbit</label>
                            <input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="Nama perusahaan penerbit" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tahun_terbit" class="form-label fw-semibold">Tahun Terbit</label>
                            <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" min="1000" max="2026" placeholder="Contoh: 2024" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="stok" class="form-label fw-semibold">Jumlah Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok" min="0" placeholder="0" required>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-secondary px-4">Kembali</a>
                        <button type="submit" name="submit" class="btn btn-primary px-4 fw-semibold shadow-sm">Simpan Data</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <footer class="text-center py-4 text-muted bg-white border-top mt-5">
        <p class="mb-0">&copy; 2026 - Aplikasi Pendataan Buku UAS Pemrograman Web.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
