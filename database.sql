CREATE DATABASE IF NOT EXISTS pendataan_buku_uas;
USE pendataan_buku_uas;

CREATE TABLE IF NOT EXISTS buku (
    id INT AUTO_INCREMENT PRIMARY KEY,
    isbn VARCHAR(20) NOT NULL,
    judul VARCHAR(255) NOT NULL,
    penulis VARCHAR(100) NOT NULL,
    penerbit VARCHAR(100) NOT NULL,
    tahun_terbit INT NOT NULL,
    stok INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO buku (isbn, judul, penulis, penerbit, tahun_terbit, stok) VALUES
('978-602-03-3160-7', 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', 2005, 15),
('978-979-733-530-4', 'Bumi Manusia', 'Pramoedya Ananta Toer', 'Lentera Dipantara', 2005, 8),
('978-602-06-3317-6', 'Negeri 5 Menara', 'Ahmad Fuadi', 'Gramedia Pustaka Utama', 2009, 12),
('978-979-1227-45-2', 'Perahu Kertas', 'Dee Lestari', 'Bentang Pustaka', 2009, 20),
('978-602-03-2478-4', 'Hujan', 'Tere Liye', 'Gramedia Pustaka Utama', 2016, 2),
('978-602-03-8591-5', 'Dunia Sophie', 'Jostein Gaarder', 'Mizan Pustaka', 2014, 8);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO users (username, password, nama_lengkap) VALUES
('NURANIANISAPUTRI', MD5('NINIS001'), 'Nurani Anisa Putri');
