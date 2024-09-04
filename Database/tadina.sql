-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Mar 2024 pada 00.22
-- Versi server: 10.4.18-MariaDB
-- Versi PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tadina`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `nama` text NOT NULL,
  `K1` int(11) NOT NULL,
  `K2` int(11) NOT NULL,
  `K3` int(11) NOT NULL,
  `K4` int(11) NOT NULL,
  `K5` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `nama`, `K1`, `K2`, `K3`, `K4`, `K5`) VALUES
(7, 'A1', 4, 2, 2, 4, 2),
(8, 'A2', 1, 3, 1, 4, 2),
(9, 'A3', 6, 2, 1, 6, 4),
(10, 'A4', 1, 3, 4, 1, 6),
(11, 'A5', 4, 1, 4, 1, 3),
(12, 'A6', 1, 3, 2, 6, 6),
(13, 'A7', 6, 1, 6, 4, 6),
(14, 'A8', 1, 3, 1, 4, 5),
(15, 'A9', 1, 4, 2, 4, 1),
(16, 'A10', 4, 4, 6, 4, 6),
(17, 'A11', 1, 1, 6, 6, 1),
(18, 'A12', 1, 2, 1, 1, 2),
(19, 'A13', 6, 2, 4, 1, 6),
(20, 'A14', 1, 3, 6, 4, 4),
(27, 'A15', 1, 4, 6, 6, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_keputusan`
--

CREATE TABLE `detail_keputusan` (
  `id_dkeputusan` int(11) NOT NULL,
  `kode_hasil` varchar(20) DEFAULT NULL,
  `id_alternatif` int(11) DEFAULT NULL,
  `nama_alternatif` text DEFAULT NULL,
  `total` varchar(20) DEFAULT NULL,
  `id_keputusan` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_kriteria`
--

CREATE TABLE `detail_kriteria` (
  `id_dkriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `sub_kriteria` text NOT NULL,
  `nilai_rasio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `detail_kriteria`
--

INSERT INTO `detail_kriteria` (`id_dkriteria`, `id_kriteria`, `sub_kriteria`, `nilai_rasio`) VALUES
(9, 4, 'Biasa', 1),
(10, 4, 'Cukup Ketat', 2),
(11, 4, 'Ketat', 4),
(12, 4, 'Sangat Ketat', 6),
(13, 3, 'Resitas', 1),
(14, 3, 'Ceramah', 2),
(15, 3, 'Demonstrasi', 3),
(17, 3, 'Gabungan', 4),
(18, 5, 'Tidak Rajin', 1),
(19, 5, 'Rajin', 4),
(20, 5, 'Sangat Rajin', 6),
(42, 2, 'Biasa', 1),
(43, 2, 'Dekat', 4),
(44, 2, 'Sangat Dekat', 6),
(51, 34, '< 1 tahun', 1),
(52, 34, '< 2 tahun', 2),
(53, 34, '< 3 tahun', 3),
(54, 34, '< 4 tahun', 4),
(55, 34, '< 5 tahun', 5),
(56, 34, '> 5 tahun', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ir`
--

CREATE TABLE `ir` (
  `id_ir` int(11) NOT NULL,
  `ri` int(11) NOT NULL,
  `nilai` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ir`
--

INSERT INTO `ir` (`id_ir`, `ri`, `nilai`) VALUES
(1, 2, 0),
(4, 3, 0.58),
(5, 4, 0.9),
(6, 5, 1.12),
(7, 6, 1.24),
(8, 7, 1.32),
(9, 8, 1.41),
(10, 9, 1.45),
(11, 10, 1.49);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(7, '1 Minna'),
(8, '1 Madinah'),
(9, '1 Makkah'),
(10, '2 Minna'),
(12, '2 Madinah'),
(13, '2 Makkah'),
(14, '3 Minna'),
(15, '3 Madinah'),
(16, '3 Makkah'),
(17, '4 Minna'),
(18, '4 Madinah'),
(19, '4 Makkah'),
(20, '5 Minna'),
(21, '5 Madinah'),
(22, '5 Makkah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keputusan`
--

CREATE TABLE `keputusan` (
  `id_keputusan` int(11) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `tanggal_keputusan` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` text DEFAULT NULL,
  `keterangan` text NOT NULL,
  `type` text NOT NULL,
  `bobot_prioritas` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `keterangan`, `type`, `bobot_prioritas`) VALUES
(2, 'K1', 'Hubungan Dengan Siswa', 'Benefit', 0.13016),
(3, 'K2', 'Metode Pembelajaran', 'Benefit', 0.12956),
(4, 'K3', 'Metode Evaluasi Pembelajaran', 'Benefit', 0.24411),
(5, 'K4', 'Kehadiran', 'Benefit', 0.19205),
(34, 'K5', 'Masa Kerja', 'Benefit', 0.30412);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `pass` varchar(250) NOT NULL,
  `nama_lengkap` text NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `pass`, `nama_lengkap`, `role`) VALUES
(3, 'cek', 'c4ca4238a0b923820dcc509a6f75849b', 'tes', 'admin'),
(7, 'novi', '7fb8ceb3bd59c7956b1df66729296a4c', 'Novita', 'wkmda'),
(9, 'roni', '202cb962ac59075b964b07152d234b70', 'Roni Trianto, S. HI', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perbandingan_kriteria`
--

CREATE TABLE `perbandingan_kriteria` (
  `id_perkri` int(11) NOT NULL,
  `kriteria1` varchar(50) NOT NULL,
  `kriteria2` varchar(50) NOT NULL,
  `nilai_pembanding` float NOT NULL,
  `id_kriteria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `perbandingan_kriteria`
--

INSERT INTO `perbandingan_kriteria` (`id_perkri`, `kriteria1`, `kriteria2`, `nilai_pembanding`, `id_kriteria`) VALUES
(29, '2', '3', 1, 2),
(30, '2', '4', 0.333333, 2),
(31, '2', '5', 1, 2),
(32, '2', '15', 0.5, 2),
(33, '3', '4', 1, 3),
(34, '3', '5', 0.5, 3),
(35, '3', '15', 0.333333, 3),
(36, '4', '5', 2, 4),
(37, '4', '15', 0.5, 4),
(38, '5', '15', 1, 5),
(39, '2', '28', 0.5, 2),
(40, '3', '28', 0.333333, 3),
(41, '4', '28', 0.5, 4),
(42, '5', '28', 1, 5),
(43, '2', '29', 0.5, 2),
(44, '3', '29', 0.333333, 3),
(45, '4', '29', 0.5, 4),
(46, '5', '29', 1, 5),
(47, '2', '34', 0.5, 2),
(48, '3', '34', 0.333333, 3),
(49, '4', '34', 0.5, 4),
(50, '5', '34', 1, 5);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indeks untuk tabel `detail_keputusan`
--
ALTER TABLE `detail_keputusan`
  ADD PRIMARY KEY (`id_dkeputusan`),
  ADD KEY `id_alternatif` (`id_alternatif`),
  ADD KEY `fk_id_keputusan` (`id_keputusan`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indeks untuk tabel `detail_kriteria`
--
ALTER TABLE `detail_kriteria`
  ADD PRIMARY KEY (`id_dkriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indeks untuk tabel `ir`
--
ALTER TABLE `ir`
  ADD PRIMARY KEY (`id_ir`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `keputusan`
--
ALTER TABLE `keputusan`
  ADD PRIMARY KEY (`id_keputusan`);

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `pass` (`pass`);

--
-- Indeks untuk tabel `perbandingan_kriteria`
--
ALTER TABLE `perbandingan_kriteria`
  ADD PRIMARY KEY (`id_perkri`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `detail_keputusan`
--
ALTER TABLE `detail_keputusan`
  MODIFY `id_dkeputusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=704;

--
-- AUTO_INCREMENT untuk tabel `detail_kriteria`
--
ALTER TABLE `detail_kriteria`
  MODIFY `id_dkriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `ir`
--
ALTER TABLE `ir`
  MODIFY `id_ir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `keputusan`
--
ALTER TABLE `keputusan`
  MODIFY `id_keputusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `perbandingan_kriteria`
--
ALTER TABLE `perbandingan_kriteria`
  MODIFY `id_perkri` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_keputusan`
--
ALTER TABLE `detail_keputusan`
  ADD CONSTRAINT `detail_keputusan_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`),
  ADD CONSTRAINT `fk_id_keputusan` FOREIGN KEY (`id_keputusan`) REFERENCES `keputusan` (`id_keputusan`),
  ADD CONSTRAINT `id_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);

--
-- Ketidakleluasaan untuk tabel `detail_kriteria`
--
ALTER TABLE `detail_kriteria`
  ADD CONSTRAINT `detail_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`);

--
-- Ketidakleluasaan untuk tabel `perbandingan_kriteria`
--
ALTER TABLE `perbandingan_kriteria`
  ADD CONSTRAINT `id_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
