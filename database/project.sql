-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Bulan Mei 2021 pada 21.00
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `namaMenu` varchar(50) NOT NULL,
  `harga` int(12) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `stok` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `id_toko`, `namaMenu`, `harga`, `gambar`, `stok`) VALUES
(2, 1, 'Nasi Pecel', 7000, 'nasipecel.jpg', 18),
(3, 1, 'Nasi Campur', 9000, '5fde02c53dc51.jpg', 13),
(4, 1, 'Nasi Rames', 8000, 'nasirames.jpg', 18),
(5, 1, 'Mie Goreng', 6000, '5fde04dc13089.jpg', 20),
(6, 2, 'Mie Kuah', 6000, 'miekuah.jpg', 17),
(7, 2, 'Es Teh', 2500, '5fde07087f20c.jpeg', 29),
(8, 2, 'Es Jeruk', 3000, '5fde0758445ce.jpg', 32),
(9, 2, 'Nasi Ayam Bakar', 20000, '5fde083fe7b5f.jpg', 18),
(16, 2, 'Nasi Lele Penyet', 9000, '5fde094072b31.jpg', 20),
(22, 3, 'Es Buah', 7000, '5fdd8ed759434.jpg', 22),
(23, 3, 'Nasi Ayam Geprek', 11000, '5fdf61d6e669f.jpg', 19),
(24, 2, 'Dinosaurus Geprek', 30000, '60a246d26443e.jpg', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `saldo`
--

CREATE TABLE `saldo` (
  `id_saldo` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `id_mhs` int(11) NOT NULL,
  `id_penjual` int(11) NOT NULL,
  `saldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `id_mhs` int(11) NOT NULL,
  `id_toko` int(11) DEFAULT 0,
  `tgl` date NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_dosen`, `id_mhs`, `id_toko`, `tgl`, `total`) VALUES
(74, 0, 7, 3, '2021-05-17', 25000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_produk`
--

CREATE TABLE `transaksi_produk` (
  `id_transaksi_produk` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi_produk`
--

INSERT INTO `transaksi_produk` (`id_transaksi_produk`, `id_transaksi`, `id_menu`, `id_toko`, `jumlah`) VALUES
(63, 74, 23, 3, 1),
(64, 74, 22, 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `userdosen`
--

CREATE TABLE `userdosen` (
  `id_dosen` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `usermhs`
--

CREATE TABLE `usermhs` (
  `id_mhs` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nim` varchar(12) NOT NULL,
  `password` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `usermhs`
--

INSERT INTO `usermhs` (`id_mhs`, `nama`, `nim`, `password`) VALUES
(7, 'Galuh Septiyani', '190411100102', '$2y$10$zuNVd87bxyYp0qVGufB3Pue5.pAYPbwCgue7U0ewDaoHUkrB3zR.O');

-- --------------------------------------------------------

--
-- Struktur dari tabel `userpenjual`
--

CREATE TABLE `userpenjual` (
  `id_penjual` int(11) NOT NULL,
  `nik` varchar(35) NOT NULL,
  `nama_penjual` varchar(100) NOT NULL,
  `nama_toko` varchar(100) NOT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `userpenjual`
--

INSERT INTO `userpenjual` (`id_penjual`, `nik`, `nama_penjual`, `nama_toko`, `gambar`, `password`) VALUES
(3, '3578281009000001', 'prasetyo adi pratama nugroho', 'i7n store', '60a293d9552ed.png', '$2y$10$xVtEGSD1EDy3YlRdY4oGsuH9wBAd.u1StZOyG0zoJ5kuoXof38QVi');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`id_saldo`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `transaksi_produk`
--
ALTER TABLE `transaksi_produk`
  ADD PRIMARY KEY (`id_transaksi_produk`);

--
-- Indeks untuk tabel `userdosen`
--
ALTER TABLE `userdosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indeks untuk tabel `usermhs`
--
ALTER TABLE `usermhs`
  ADD PRIMARY KEY (`id_mhs`);

--
-- Indeks untuk tabel `userpenjual`
--
ALTER TABLE `userpenjual`
  ADD PRIMARY KEY (`id_penjual`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `saldo`
--
ALTER TABLE `saldo`
  MODIFY `id_saldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT untuk tabel `transaksi_produk`
--
ALTER TABLE `transaksi_produk`
  MODIFY `id_transaksi_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT untuk tabel `userdosen`
--
ALTER TABLE `userdosen`
  MODIFY `id_dosen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `usermhs`
--
ALTER TABLE `usermhs`
  MODIFY `id_mhs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `userpenjual`
--
ALTER TABLE `userpenjual`
  MODIFY `id_penjual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
