-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Okt 2019 pada 10.50
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
-- Database: `app_tabungannative`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `daftar`
--

CREATE TABLE `daftar` (
  `kode` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kelas` varchar(11) NOT NULL,
  `spp` int(10) NOT NULL,
  `spp1` int(10) NOT NULL,
  `spp2` int(10) NOT NULL,
  `lain` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `daftar`
--

INSERT INTO `daftar` (`kode`, `nama`, `kelas`, `spp`, `spp1`, `spp2`, `lain`) VALUES
('9aa1ca69-376f-4063-8671-6d81116727f2', 'Irfan Rosyadi', 'XII TKJ 4', 0, 0, 0, 0),
('c47d194b-bf74-4410-8f20-17cebfe412c8', 'Okta Indriani', '0', 0, 2147483647, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `keuangan`
--

CREATE TABLE `keuangan` (
  `kode` varchar(255) NOT NULL,
  `kodeUser` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(30) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `jumlah` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `keuangan`
--

INSERT INTO `keuangan` (`kode`, `kodeUser`, `tanggal`, `status`, `keterangan`, `jumlah`) VALUES
('7718ba70-6430-4bc5-bfe7-4313ec799cc1', '9aa1ca69-376f-4063-8671-6d81116727f2', '2019-01-23', 'Pemasukan', 'Masuk', 500000),
('efcff1ba-8bb6-4fd3-ae6d-65d2f9509b80', 'c47d194b-bf74-4410-8f20-17cebfe412c8', '2019-01-12', 'Pemasukan', 'Masuk', 40000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `kode` varchar(255) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telepon` bigint(20) NOT NULL,
  `alamat` text NOT NULL,
  `level` enum('Admin','Member') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`kode`, `nama`, `username`, `password`, `telepon`, `alamat`, `level`) VALUES
('9aa1ca69-376f-4063-8671-6d81116727f2', 'Yayasan', 'admin', '$2y$10$Dvw5GHZ8fNwBP8U2Ahx.Wuo9qUbO9OvTJsCMFMgKebhlf3F2yp.le', 812345678, 'Graha Selaras', 'Admin'),
('c47d194b-bf74-4410-8f20-17cebfe412c8', 'Okta Indriani', 'okta', '$2y$10$pQ/vpoQSUwbTGhg5msSI4umKDL6rGKB2XsTWVtlKhMCN6CrmdrRRq', 85249789876, 'Bandung', 'Member');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `daftar`
--
ALTER TABLE `daftar`
  ADD PRIMARY KEY (`kode`);

--
-- Indeks untuk tabel `keuangan`
--
ALTER TABLE `keuangan`
  ADD PRIMARY KEY (`kode`),
  ADD KEY `kodeUser` (`kodeUser`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`kode`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `keuangan`
--
ALTER TABLE `keuangan`
  ADD CONSTRAINT `keuangan_ibfk_1` FOREIGN KEY (`kodeUser`) REFERENCES `user` (`kode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
