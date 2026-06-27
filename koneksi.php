<?php
// Konfigurasi Database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "pendataan_buku_uas";

// Membuat koneksi ke MySQL
$conn = mysqli_connect($host, $user, $pass, $db);

// Memeriksa apakah koneksi berhasil
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

/**
 * FUNCTION 1: Fungsi untuk mengeksekusi query SELECT dan mengambil datanya (Read)
 */
function query_tampil($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

/**
 * FUNCTION 2: Fungsi untuk mengamankan inputan form dari karakter berbahaya
 */
function aman($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return mysqli_real_escape_string($conn, $data);
}
?>
