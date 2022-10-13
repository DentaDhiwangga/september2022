-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Okt 2022 pada 05.57
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbcrud2022`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tsiswa`
--

CREATE TABLE `tsiswa` (
  `id_siswa` int(11) NOT NULL,
  `nama_siswa` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `jeniskelamin` varchar(100) NOT NULL,
  `usia` varchar(100) NOT NULL,
  `walikelas` varchar(100) NOT NULL,
  `tanggalmengisi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tsiswa`
--

INSERT INTO `tsiswa` (`id_siswa`, `nama_siswa`, `alamat`, `jeniskelamin`, `usia`, `walikelas`, `tanggalmengisi`) VALUES
(3, 'Ramdani', 'Jl. Letjen Sekayu No.09', 'Laki-Laki', '-9', '15', '2022-10-13'),
(4, 'Denta', 'Ponorogo', 'laki-laki', '16', '9', '2022-10-12'),
(9, 'kawan', 'kanan', 'Perempuan', '10', '9', '2022-10-11'),
(10, 'Ramdani', 'Jl. Letjen Supratman No.03', 'Perempuan', '10', '6', '2022-10-13'),
(11, 'ali', 'Jl. Letjen Supratman No.03', 'Perempuan', '12', '8', '2022-10-13'),
(12, 'oke', 'kakak', 'Laki-Laki', '13', '16', '2022-10-13'),
(13, 'asdf', 'asdaf', 'Laki-Laki', '12', '16', '2022-10-04');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tsiswa`
--
ALTER TABLE `tsiswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tsiswa`
--
ALTER TABLE `tsiswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
