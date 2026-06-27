<?php
// Memulai session PHP
session_start();

// Proteksi Halaman: Jika belum login, jangan izinkan proses hapus dijalankan
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

// Memanggil file koneksi
require 'koneksi.php';

// Mengambil ID dari URL (GET)
if (isset($_GET["id"])) {
    $id = aman($_GET["id"]);

    // Query untuk menghapus data
    $query = "DELETE FROM buku WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Data buku berhasil dihapus!');
                document.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data buku: " . mysqli_error($conn) . "');
                document.location.href = 'index.php';
              </script>";
    }
} else {
    header("Location: index.php");
    exit;
}
?>
