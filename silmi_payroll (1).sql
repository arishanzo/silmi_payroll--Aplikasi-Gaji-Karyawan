-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Des 2022 pada 03.10
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `silmi_payroll`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cicilan`
--

CREATE TABLE `cicilan` (
  `id_cicilan` int(11) NOT NULL,
  `nip` varchar(11) NOT NULL,
  `jumlah_cicilan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cicilan`
--

INSERT INTO `cicilan` (`id_cicilan`, `nip`, `jumlah_cicilan`) VALUES
(5, '001', 90000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `dt_karyawan`
--

CREATE TABLE `dt_karyawan` (
  `nip` varchar(11) NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `ttl` date NOT NULL,
  `devisi` varchar(100) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `alamat` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `dt_karyawan`
--

INSERT INTO `dt_karyawan` (`nip`, `nama_karyawan`, `ttl`, `devisi`, `tgl_masuk`, `alamat`) VALUES
('001', 'Aris', '2022-12-02', 'aaa', '2022-11-27', 'Lamongan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gaji`
--

CREATE TABLE `gaji` (
  `id_gaji` int(11) NOT NULL,
  `nip` varchar(11) NOT NULL,
  `take_home` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `infaq`
--

CREATE TABLE `infaq` (
  `id_infaq` int(11) NOT NULL,
  `nip` varchar(11) NOT NULL,
  `jumlah_infaq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `infaq`
--

INSERT INTO `infaq` (`id_infaq`, `nip`, `jumlah_infaq`) VALUES
(19, '001', 40000),
(20, '001', 80000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jam_kerja`
--

CREATE TABLE `jam_kerja` (
  `id_jam` int(11) NOT NULL,
  `nip` varchar(11) NOT NULL,
  `tanggal_input` date NOT NULL,
  `scan_1` time NOT NULL,
  `scan_2` time NOT NULL,
  `scan_3` time NOT NULL,
  `scan_4` time NOT NULL,
  `jam` int(11) NOT NULL,
  `menit` int(11) NOT NULL,
  `total_jam` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jam_kerja`
--

INSERT INTO `jam_kerja` (`id_jam`, `nip`, `tanggal_input`, `scan_1`, `scan_2`, `scan_3`, `scan_4`, `jam`, `menit`, `total_jam`) VALUES
(974, '001', '2022-08-29', '08:06:37', '12:00:00', '13:00:00', '15:59:10', 6, 52, 6.8666666666667),
(975, '001', '2022-08-30', '08:21:38', '12:00:00', '13:00:00', '16:02:23', 6, 39, 6.65),
(976, '001', '2022-09-01', '07:58:14', '12:00:00', '13:00:00', '16:05:07', 7, 6, 7.1),
(977, '001', '2022-09-02', '07:58:18', '12:00:00', '13:00:00', '16:03:35', 7, 3, 7.05),
(978, '001', '2022-09-03', '08:18:41', '12:00:00', '13:00:00', '15:05:16', 5, 47, 5.7833333333333),
(979, '001', '2022-09-05', '09:07:13', '12:00:00', '13:00:00', '16:03:54', 5, 55, 5.9166666666667),
(980, '001', '2022-09-06', '08:03:41', '12:00:00', '13:00:00', '20:05:00', 11, 1, 11.016666666667),
(981, '001', '2022-09-07', '07:57:37', '12:00:00', '13:00:00', '16:00:51', 7, 2, 7.0333333333333),
(982, '001', '2022-09-08', '08:33:23', '12:00:00', '13:00:00', '16:03:34', 6, 29, 6.4833333333333),
(983, '001', '2022-09-09', '08:00:06', '12:00:00', '13:00:00', '16:03:26', 7, 2, 7.0333333333333),
(984, '001', '2022-09-12', '07:57:12', '12:00:00', '13:00:00', '16:08:00', 7, 9, 7.15),
(985, '001', '2022-09-13', '07:51:38', '12:00:00', '13:00:00', '16:02:39', 7, 10, 7.1666666666667),
(986, '001', '2022-09-14', '07:55:38', '12:00:00', '13:00:00', '16:03:34', 7, 6, 7.1),
(987, '001', '2022-09-15', '07:59:10', '12:00:00', '13:00:00', '16:07:37', 7, 7, 7.1166666666667),
(988, '001', '2022-09-16', '08:00:00', '12:00:00', '13:00:00', '16:10:14', 7, 9, 7.15),
(989, '001', '2022-09-17', '08:00:00', '12:00:00', '13:00:00', '00:00:00', 9, 0, 9),
(990, '001', '2022-09-18', '06:40:00', '12:00:00', '13:00:00', '14:46:42', 7, 5, 7.0833333333333),
(991, '001', '2022-09-19', '08:17:21', '12:00:00', '13:00:00', '16:35:00', 7, 18, 7.3),
(992, '001', '2022-09-20', '08:12:40', '12:00:00', '13:00:00', '16:04:39', 6, 51, 6.85),
(993, '001', '2022-09-21', '07:58:14', '12:00:00', '13:00:00', '16:04:09', 7, 5, 7.0833333333333),
(994, '001', '2022-09-22', '07:52:49', '12:00:00', '13:00:00', '16:01:38', 7, 8, 7.1333333333333),
(995, '001', '2022-09-23', '08:02:05', '12:00:00', '13:00:00', '16:02:11', 6, 59, 6.9833333333333),
(996, '001', '2022-09-24', '07:57:43', '12:00:00', '13:00:00', '16:10:09', 7, 11, 7.1833333333333),
(997, '001', '2022-09-26', '07:51:56', '12:00:00', '13:00:00', '16:09:04', 7, 17, 7.2833333333333),
(998, '001', '2022-09-28', '08:37:15', '12:00:00', '13:00:00', '16:09:14', 6, 31, 6.5166666666667),
(999, '001', '2022-09-18', '06:40:00', '12:00:00', '13:00:00', '14:46:42', 7, 5, 7.0833333333333);

-- --------------------------------------------------------

--
-- Struktur dari tabel `lembur`
--

CREATE TABLE `lembur` (
  `id_lembur` int(11) NOT NULL,
  `nip` varchar(11) NOT NULL,
  `jumlah_lembur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `lembur`
--

INSERT INTO `lembur` (`id_lembur`, `nip`, `jumlah_lembur`) VALUES
(2, '001', 1100000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `reward`
--

CREATE TABLE `reward` (
  `id_reward` int(11) NOT NULL,
  `nip` varchar(11) NOT NULL,
  `jumlah_reward` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `reward`
--

INSERT INTO `reward` (`id_reward`, `nip`, `jumlah_reward`) VALUES
(4, '001', 100000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `total_jamkerja`
--

CREATE TABLE `total_jamkerja` (
  `id_jam` int(11) NOT NULL,
  `nip` varchar(11) NOT NULL,
  `jam` int(11) NOT NULL,
  `menit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tunjangan_tetap`
--

CREATE TABLE `tunjangan_tetap` (
  `id_tunjangantetap` int(11) NOT NULL,
  `nip` varchar(11) NOT NULL,
  `total_t_keahlian` double NOT NULL,
  `t_kepalakeluarga` int(11) NOT NULL,
  `t_masakerja` int(11) NOT NULL,
  `reward` int(11) NOT NULL,
  `total_lembur` double NOT NULL,
  `cicilan` int(11) NOT NULL,
  `infaq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tunjangan_tidak_tetap`
--

CREATE TABLE `tunjangan_tidak_tetap` (
  `id_tunjangantidaktetap` int(11) NOT NULL,
  `nip` int(11) NOT NULL,
  `gaji_pokok` int(11) NOT NULL,
  `t_jabatan` int(11) NOT NULL,
  `total_perjam` double NOT NULL,
  `total_ttp` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tunjangan_tidak_tetap`
--

INSERT INTO `tunjangan_tidak_tetap` (`id_tunjangantidaktetap`, `nip`, `gaji_pokok`, `t_jabatan`, `total_perjam`, `total_ttp`) VALUES
(25, 1, 90000, 80000, 186.12, 170186.12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_keahlian`
--

CREATE TABLE `t_keahlian` (
  `id_keahlian` int(11) NOT NULL,
  `nip` varchar(11) NOT NULL,
  `nama_keahlian` varchar(100) NOT NULL,
  `jumlah_tunjangan_keahlian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_keahlian`
--

INSERT INTO `t_keahlian` (`id_keahlian`, `nip`, `nama_keahlian`, `jumlah_tunjangan_keahlian`) VALUES
(49, '001', 'Potong', 75000),
(50, '001', 'Fusing', 40000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_kepalakeluarga`
--

CREATE TABLE `t_kepalakeluarga` (
  `id_tkepalakeluarga` int(11) NOT NULL,
  `nip` varchar(11) NOT NULL,
  `jumlah_tkepalakeluarga` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_kepalakeluarga`
--

INSERT INTO `t_kepalakeluarga` (`id_tkepalakeluarga`, `nip`, `jumlah_tkepalakeluarga`) VALUES
(1, '002', 666),
(2, '001', 300000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_masakkerja`
--

CREATE TABLE `t_masakkerja` (
  `id_tmasakerja` int(11) NOT NULL,
  `nip` varchar(11) NOT NULL,
  `jumlah_tmasakerja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `t_masakkerja`
--

INSERT INTO `t_masakkerja` (`id_tmasakerja`, `nip`, `jumlah_tmasakerja`) VALUES
(2, '001', 1500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `jabatan_user` enum('Pimpinan','Keuangan','HRD','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `jabatan_user`) VALUES
(7, 'Admin HRD & Keuangan', 'admin', 'cb42e130d1471239a27fca6228094f0e', 'Pimpinan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cicilan`
--
ALTER TABLE `cicilan`
  ADD PRIMARY KEY (`id_cicilan`);

--
-- Indeks untuk tabel `dt_karyawan`
--
ALTER TABLE `dt_karyawan`
  ADD PRIMARY KEY (`nip`);

--
-- Indeks untuk tabel `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id_gaji`);

--
-- Indeks untuk tabel `infaq`
--
ALTER TABLE `infaq`
  ADD PRIMARY KEY (`id_infaq`);

--
-- Indeks untuk tabel `jam_kerja`
--
ALTER TABLE `jam_kerja`
  ADD PRIMARY KEY (`id_jam`);

--
-- Indeks untuk tabel `lembur`
--
ALTER TABLE `lembur`
  ADD PRIMARY KEY (`id_lembur`);

--
-- Indeks untuk tabel `reward`
--
ALTER TABLE `reward`
  ADD PRIMARY KEY (`id_reward`);

--
-- Indeks untuk tabel `total_jamkerja`
--
ALTER TABLE `total_jamkerja`
  ADD PRIMARY KEY (`id_jam`);

--
-- Indeks untuk tabel `tunjangan_tetap`
--
ALTER TABLE `tunjangan_tetap`
  ADD PRIMARY KEY (`id_tunjangantetap`);

--
-- Indeks untuk tabel `tunjangan_tidak_tetap`
--
ALTER TABLE `tunjangan_tidak_tetap`
  ADD PRIMARY KEY (`id_tunjangantidaktetap`);

--
-- Indeks untuk tabel `t_keahlian`
--
ALTER TABLE `t_keahlian`
  ADD PRIMARY KEY (`id_keahlian`);

--
-- Indeks untuk tabel `t_kepalakeluarga`
--
ALTER TABLE `t_kepalakeluarga`
  ADD PRIMARY KEY (`id_tkepalakeluarga`);

--
-- Indeks untuk tabel `t_masakkerja`
--
ALTER TABLE `t_masakkerja`
  ADD PRIMARY KEY (`id_tmasakerja`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cicilan`
--
ALTER TABLE `cicilan`
  MODIFY `id_cicilan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `infaq`
--
ALTER TABLE `infaq`
  MODIFY `id_infaq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `jam_kerja`
--
ALTER TABLE `jam_kerja`
  MODIFY `id_jam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;

--
-- AUTO_INCREMENT untuk tabel `lembur`
--
ALTER TABLE `lembur`
  MODIFY `id_lembur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `reward`
--
ALTER TABLE `reward`
  MODIFY `id_reward` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tunjangan_tetap`
--
ALTER TABLE `tunjangan_tetap`
  MODIFY `id_tunjangantetap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tunjangan_tidak_tetap`
--
ALTER TABLE `tunjangan_tidak_tetap`
  MODIFY `id_tunjangantidaktetap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `t_keahlian`
--
ALTER TABLE `t_keahlian`
  MODIFY `id_keahlian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `t_kepalakeluarga`
--
ALTER TABLE `t_kepalakeluarga`
  MODIFY `id_tkepalakeluarga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `t_masakkerja`
--
ALTER TABLE `t_masakkerja`
  MODIFY `id_tmasakerja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
