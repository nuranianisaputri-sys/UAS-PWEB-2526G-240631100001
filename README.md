# UAS-PWEB-2526G-240631100001
# NAMA : NURANI ANISA PUTRI
# NIM : 240631100001
# JUDUL APLIKASI :  SISTEM PENDATAAN BUKU
# DESKRIPSI SINGKAT :
Aplikasi manajemen pendataan koleksi buku perpustakaan digital berbasis web. Proyek ini dibangun untuk memenuhi tugas Akhir Semester (UAS) mata kuliah Pemrograman Web dengan menerapkan arsitektur PHP Native, MySQLi, dan antarmuka modern menggunakan Bootstrap 5 dengan tema Glassmorphism.
## Fitur Utama
- Autentikasi Aman: Sistem Login dan Logout menggunakan manajemen Session State dan enkripsi password MD5.
- Proteksi Halaman: Halaman CRUD tidak dapat diakses secara langsung tanpa proses login terlebih dahulu.
- Manajemen CRUD Lengkap: Fitur Tambah, Tampil (Read), Edit, dan Hapus data buku.
- Indikator Stok Kondisional: Sistem otomatis memberikan tanda warna merah jika stok buku berada dalam kondisi kritis (<= 5).
- Desain Antarmuka: Tampilan responsif dilengkapi efek transparan modern dan ikon dari Font Awesome.
## Spesifikasi Teknologi
- Bahasa Pemrograman: PHP (Native)
- Database: MySQL / MariaDB
- Desain Frontend: Bootstrap 5 & Font Awesome Icons

## Struktur Database
Aplikasi ini menggunakan database bernama "pendataan_buku_uas" yang terdiri dari 2 tabel utama:
### 1. Tabel buku (Manajemen Data Perpustakaan)
- id: INT (Primary Key, Auto Increment) - Identitas unik setiap buku.
- isbn: VARCHAR(20) - Nomor standar buku internasional (mendukung karakter hubung).
- judul: VARCHAR(255) - Judul lengkap koleksi buku.
- penulis: VARCHAR(100) - Nama pengarang buku.
- penerbit: VARCHAR(100) - Nama perusahaan penerbit.
- tahun_terbit: INT - Tahun rilis atau publikasi buku.
- stok: INT - Jumlah ketersediaan buku fisik di perpustakaan.
### 2. Tabel users (Autentikasi Hak Akses)
- id: INT (Primary Key, Auto Increment) - Identitas unik pengguna.
- username: VARCHAR(50, Unique) - Nama akun administrator untuk masuk ke sistem.
- password: VARCHAR(255) - Kunci pengaman akun yang dienkripsi menggunakan MD5.
- nama_lengkap: VARCHAR(100) - Nama asli administrator yang ditampilkan pada dashboard.

## Cara Menjalankan Aplikasi di Localhost
### 1. Persiapan Database
1. Aktifkan Apache dan MySQL pada XAMPP Control Panel.
2. Buka browser dan akses http://localhost/phpmyadmin/.
3. Buat database baru dengan nama "pendataan_buku_uas".
4. Import file "database.sql" yang tersedia di dalam folder proyek ini ke database tersebut.
### 2. Penempatan Folder
1. Pastikan folder proyek ini bernama "uaspemrogramanweb".
2. Letakkan folder tersebut di dalam direktori server lokal Anda (C:/xampp/htdocs/).
### 3. Mengakses Aplikasi
Buka browser Anda dan ketikkan URL berikut di kolom alamat paling atas:
http://localhost/uaspemrogramanweb/login.php
## Akun Akses Demo (Default)
Untuk masuk ke dalam sistem, gunakan kredensial berikut:
- Username: NURANIANISAPUTRI
- Password: NINIS001
