<?php
// Memulai session PHP
session_start();

// Proteksi Halaman: Jika belum login, tendang kembali ke halaman login.php
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

// Memanggil file koneksi
require 'koneksi.php';

// Mengambil ID buku yang dikirim via URL (GET)
if (!isset($_GET["id"])) {
    header("Location: index.php");
    exit;
}
$id = aman($_GET["id"]);

// Mengambil data buku lama berdasarkan ID
$buku = query_tampil("SELECT * FROM buku WHERE id = $id");

if (empty($buku)) {
    echo "<script>
            alert('Data buku tidak ditemukan!');
            document.location.href = 'index.php';
          </script>";
    exit;
}

$buku = $buku[0];

// Memproses perubahan data ketika tombol simpan ditekan
if (isset($_POST["submit"])) {
    
    $isbn         = aman($_POST["isbn"]);
    $judul        = aman($_POST["judul"]);
    $penulis      = aman($_POST["penulis"]);
    $penerbit     = aman($_POST["penerbit"]);
    $tahun_terbit = aman($_POST["tahun_terbit"]);
    $stok         = aman($_POST["stok"]);

    // Query untuk memperbarui data
    $query = "UPDATE buku SET 
                isbn = '$isbn', 
                judul = '$judul', 
                penulis = '$penulis', 
                penerbit = '$penerbit', 
                tahun_terbit = $tahun_terbit, 
                stok = $stok 
              WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Data buku berhasil diperbarui!');
                document.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal memperbarui data buku: " . mysqli_error($conn) . "');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Buku - UAS PWEB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">📚 Pustaka Digital</a>
            <span class="text-light small">Halo, <strong><?= $_SESSION["nama_user"]; ?></strong></span>
        </div>
    </nav>

    <div class="container my-5" style="max-width: 600px;">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-warning text-dark py-3">
                <h4 class="mb-0 fw-bold">Edit Informasi Buku</h4>
            </div>
            <div class="card-body p-4">
                
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="isbn" class="form-label fw-semibold">Kode ISBN</label>
                        <input type="text" class="form-control" id="isbn" name="isbn" value="<?= $buku['isbn']; ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="judul" class="form-label fw-semibold">Judul Buku</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="<?= $buku['judul']; ?>" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="penulis" class="form-label fw-semibold">Penulis</label>
                            <input type="text" class="form-control" id="penulis" name="penulis" value="<?= $buku['penulis']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="penerbit" class="form-label fw-semibold">Penerbit</label>
                            <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= $buku['penerbit']; ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tahun_terbit" class="form-label fw-semibold">Tahun Terbit</label>
                            <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" min="1000" max="2026" value="<?= $buku['tahun_terbit']; ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="stok" class="form-label fw-semibold">Jumlah Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok" min="0" value="<?= $buku['stok']; ?>" required>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="btn btn-secondary px-4">Batal</a>
                        <button type="submit" name="submit" class="btn btn-warning px-4 fw-medium">Simpan Perubahan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
