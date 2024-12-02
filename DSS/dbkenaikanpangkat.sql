-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Des 2024 pada 06.09
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbkenaikanpangkat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbalternatif`
--

CREATE TABLE `tbalternatif` (
  `idAlternatif` int(11) NOT NULL,
  `namaKaryawan` varchar(50) DEFAULT NULL,
  `departemen` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbhasil`
--

CREATE TABLE `tbhasil` (
  `idHasil` int(11) NOT NULL,
  `nilaiPreferensi` decimal(5,2) NOT NULL,
  `idAlternatif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbhasil`
--

INSERT INTO `tbhasil` (`idHasil`, `nilaiPreferensi`, `idAlternatif`) VALUES
(17, '0.19', 23),
(18, '0.34', 24);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbkriteria`
--

CREATE TABLE `tbkriteria` (
  `idKriteria` int(11) NOT NULL,
  `namaKriteria` varchar(45) NOT NULL,
  `bobot` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbkriteria`
--

INSERT INTO `tbkriteria` (`idKriteria`, `namaKriteria`, `bobot`) VALUES
(1, 'Lama Bekerja', '0.30'),
(2, 'Riwayat Pendidikan', '0.20'),
(3, 'Proyek Diselesaikan', '0.50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbuser`
--

CREATE TABLE `tbuser` (
  `idUser` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbuser`
--

INSERT INTO `tbuser` (`idUser`, `username`, `password`) VALUES
(1, 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbalternatif`
--
ALTER TABLE `tbalternatif`
  ADD PRIMARY KEY (`idAlternatif`);

--
-- Indeks untuk tabel `tbhasil`
--
ALTER TABLE `tbhasil`
  ADD PRIMARY KEY (`idHasil`,`idAlternatif`),
  ADD KEY `fk_tbHasil_tbAlternatif_idx` (`idAlternatif`);

--
-- Indeks untuk tabel `tbkriteria`
--
ALTER TABLE `tbkriteria`
  ADD PRIMARY KEY (`idKriteria`);

--
-- Indeks untuk tabel `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbalternatif`
--
ALTER TABLE `tbalternatif`
  MODIFY `idAlternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tbhasil`
--
ALTER TABLE `tbhasil`
  MODIFY `idHasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tbuser`
--
ALTER TABLE `tbuser`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
