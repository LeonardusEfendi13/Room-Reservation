-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Des 2021 pada 03.32
-- Versi server: 10.4.20-MariaDB
-- Versi PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking`
--

CREATE TABLE `booking` (
  `id_booking` varchar(11) NOT NULL,
  `tgl_booking` date NOT NULL,
  `batas_sewa` date NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking_detail`
--

CREATE TABLE `booking_detail` (
  `id` int(11) NOT NULL,
  `id_booking` varchar(11) NOT NULL,
  `id_fasilitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pakai`
--

CREATE TABLE `detail_pakai` (
  `no_pakai` varchar(11) NOT NULL,
  `id_fasilitas` int(11) NOT NULL,
  `denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_pakai`
--

INSERT INTO `detail_pakai` (`no_pakai`, `id_fasilitas`, `denda`) VALUES
('03122021014', 11, 0),
('04122021015', 7, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` int(11) NOT NULL,
  `nama_fasilitas` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `penanggung_jawab` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `luas_area` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `kuota` varchar(255) NOT NULL,
  `dipakai` int(11) NOT NULL,
  `dibooking` int(11) NOT NULL,
  `image` varchar(255) DEFAULT 'facility-default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `fasilitas`
--

INSERT INTO `fasilitas` (`id`, `nama_fasilitas`, `id_kategori`, `penanggung_jawab`, `lokasi`, `luas_area`, `stock`, `kuota`, `dipakai`, `dibooking`, `image`) VALUES
(1, 'Lapangan Basket', 1, 'Agung Hermawan', 'Depan Gedung C', '25 x 25 m', 6, '15 Orang', 1, 1, 'img1638429622.jpg'),
(7, 'Laboratorium Komputer', 2, 'Felicity Ambery', 'Gedung B, Lantai 2', '6 x 6 m', 7, '30 Orang', 0, 0, 'img1638359030.jpg'),
(11, 'Ruang Kelas 12 IPA', 4, 'Ilyana Lumine', 'Gedung A, Lantai 3', '4 x 4 m', 4, '35 Orang', 0, 0, 'img1638430048.jpg'),
(12, 'Ruang Kelas 12 IPS', 4, 'Dono Kasino Indro', 'Gedung A, Lantai 3', '4 x 4 m', 10, '30 Orang', 0, 0, 'img1638430219.jpg'),
(13, 'Unit Kesehatan Siswa', 3, 'Dr. James Sulivan', 'Gedung D, Korridor Lantai 1', '2.5 x 3 m', 7, '3 Orang', 0, 0, 'img1638430415.jpg'),
(14, 'Perpustakaan', 5, 'Kasumi Shino', 'Gedung Perpustakaan', '30 x 30 m', 5, '85 Orang', 0, 0, 'img1638430565.jpg'),
(15, 'Auditorium', 6, 'Debbie Harris', 'Gedung C, Lantai 3', '20 x 20 m', 5, '240 Orang', 0, 0, 'img1638430716.jpg'),
(16, 'Laboratorium IPA', 10, 'Ms. Chang', 'Gedung B, Lantai 1', '4.5 x 4.5 m', 3, '20 Orang', 0, 0, 'img1638430928.jpg'),
(17, 'Lapangan Futsal', 7, 'Sr. John Cena', 'Balai Olahraga', '15 x 15 m', 4, '10 Orang', 0, 0, 'img1638431069.jpg'),
(18, 'Ruang Band', 5, 'Martin Garrix', 'Gedung C, Lantai 2 dan 3', '3 x 3 m', 2, '6 Orang', 0, 0, 'img1638431232.jpg'),
(19, 'Ruang Serbaguna', 8, 'Alexia Franky', 'Sebelah Gedung D', '7 x 7 m', 6, '22 Orang', 0, 0, 'img1638431614.png'),
(20, 'Ruang Bahasa', 2, 'Kiana Kaslana', 'Gedung A, Koridor Lantai 2', '4 x 4 m', 6, '30 Orang', 0, 0, 'img1638431780.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Outdoor'),
(2, 'Indoor'),
(3, 'Medical'),
(4, 'Classes'),
(5, 'Entertainment'),
(6, 'Hall'),
(7, 'Sport'),
(8, 'Other'),
(10, 'Laboratory');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pakai`
--

CREATE TABLE `pakai` (
  `no_pakai` varchar(11) NOT NULL,
  `tgl_pakai` date NOT NULL,
  `id_booking` varchar(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `status` enum('Pakai','Kembali') NOT NULL,
  `total_denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pakai`
--

INSERT INTO `pakai` (`no_pakai`, `tgl_pakai`, `id_booking`, `id_user`, `tgl_kembali`, `tgl_pengembalian`, `status`, `total_denda`) VALUES
('02122021001', '2021-12-02', '02122021001', 2, '2021-12-05', '2021-12-02', 'Kembali', 0),
('02122021002', '2021-12-02', '02122021001', 2, '2021-12-05', '2021-12-02', 'Kembali', 0),
('02122021003', '2021-12-02', '02122021001', 4, '2021-12-05', '0000-00-00', 'Pakai', 0),
('02122021004', '2021-12-02', '02122021001', 4, '2021-12-05', '0000-00-00', 'Pakai', 0),
('02122021005', '2021-12-02', '02122021001', 4, '2021-12-05', '0000-00-00', 'Pakai', 0),
('02122021006', '2021-12-02', '02122021001', 4, '2021-12-05', '0000-00-00', 'Pakai', 0),
('02122021007', '2021-12-02', '02122021001', 2, '2021-12-05', '2021-12-02', 'Kembali', 0),
('02122021008', '2021-12-02', '02122021001', 2, '2021-12-05', '2021-12-02', 'Kembali', 0),
('02122021009', '2021-12-02', '02122021002', 4, '2021-12-05', '2021-12-02', 'Kembali', 0),
('02122021010', '2021-12-02', '02122021001', 2, '2021-12-05', '2021-12-02', 'Kembali', 0),
('03122021011', '2021-12-03', '03122021001', 2, '2021-12-06', '2021-12-03', 'Kembali', 0),
('03122021012', '2021-12-03', '03122021001', 2, '2021-12-06', '2021-12-03', 'Kembali', 0),
('03122021013', '2021-12-03', '03122021002', 6, '2021-12-06', '2021-12-03', 'Kembali', 0),
('03122021014', '2021-12-03', '03122021001', 4, '2021-12-06', '2021-12-03', 'Kembali', 0),
('04122021015', '2021-12-04', '04122021001', 2, '2021-12-07', '2021-12-04', 'Kembali', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'member'),
(3, 'management');

-- --------------------------------------------------------

--
-- Struktur dari tabel `temp`
--

CREATE TABLE `temp` (
  `id` int(11) NOT NULL,
  `tgl_booking` datetime DEFAULT NULL,
  `id_user` varchar(11) NOT NULL,
  `email_user` varchar(255) DEFAULT NULL,
  `id_fasilitas` int(11) NOT NULL,
  `nama_fasilitas` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `penanggung_jawab` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `kuota` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `tanggal_input` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `image`, `password`, `role_id`, `is_active`, `tanggal_input`) VALUES
(1, 'Chloe Price', 'chloe@gmail.com', 'chloe.jpg', '12345', 1, 1, 30),
(2, 'Miku Hatsune', 'mikutella@gmail.com', 'pro1638537042.jpg', '$2y$10$s29kfF3u7PMs.Wf78yzMZu.GqHinfEAAXOmVeCZyajUYQmHajOdx.', 2, 1, 1),
(4, 'Maxine Fishcer', 'fishcer.max@student.umn.ac.id', 'pro1638429493.png', '$2y$10$cWlQit./nrKh5PS78aHoDe4Z5Bj4pLjLpzj4zjKFDQTklluFaAkX6', 2, 1, 2),
(6, 'Faye Bosconovitch', 'faye@lecture.umn.ac.id', 'default.jpg', '$2y$10$kNrT4aRDbvrARhkMnoZdSu6AYbrSSo93RVai94xNWVxDoicb0mii.', 2, 1, 2),
(7, 'Barry Allen', 'barry.flash@gmail.com', 'flash.jpg', 'flash', 3, 1, 10);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`);

--
-- Indeks untuk tabel `booking_detail`
--
ALTER TABLE `booking_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `pakai`
--
ALTER TABLE `pakai`
  ADD PRIMARY KEY (`no_pakai`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `booking_detail`
--
ALTER TABLE `booking_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `temp`
--
ALTER TABLE `temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
