-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Des 2023 pada 12.42
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_guru`
--

CREATE TABLE `tbl_guru` (
  `guru_id` int(11) NOT NULL,
  `nama_guru` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_guru`
--

INSERT INTO `tbl_guru` (`guru_id`, `nama_guru`) VALUES
(1, 'asep cvt'),
(2, 'rudi  kopling'),
(3, 'farhan kebab'),
(5, 'Abdul Keyboard'),
(6, 'Ari Bohlam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_hari`
--

CREATE TABLE `tbl_hari` (
  `hari_id` int(11) NOT NULL,
  `nama_hari` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_hari`
--

INSERT INTO `tbl_hari` (`hari_id`, `nama_hari`) VALUES
(1, 'senin'),
(2, 'selasa'),
(3, 'rabu'),
(4, 'kamis'),
(5, 'sabtu'),
(6, 'minggu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jadwal`
--

CREATE TABLE `tbl_jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `guru_id` int(11) NOT NULL,
  `mapel_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `hari_id` int(11) NOT NULL,
  `ruangan_id` int(11) NOT NULL,
  `waktu_id` int(11) NOT NULL,
  `status` varchar(255) DEFAULT 'active',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_jadwal`
--

INSERT INTO `tbl_jadwal` (`id_jadwal`, `guru_id`, `mapel_id`, `kelas_id`, `hari_id`, `ruangan_id`, `waktu_id`, `status`, `deleted_at`) VALUES
(247, 3, 10, 11, 3, 5, 4, 'active', NULL),
(248, 2, 9, 9, 1, 6, 1, 'active', NULL),
(249, 5, 7, 5, 6, 7, 1, 'active', NULL),
(250, 1, 6, 13, 4, 6, 1, 'active', NULL),
(252, 1, 10, 12, 3, 6, 2, 'active', NULL),
(253, 1, 7, 12, 1, 6, 4, 'active', NULL),
(255, 5, 9, 5, 5, 5, 2, 'active', NULL),
(257, 1, 8, 5, 5, 6, 2, 'active', NULL),
(258, 2, 12, 10, 4, 5, 4, 'active', NULL),
(259, 5, 11, 13, 6, 6, 3, 'active', NULL),
(260, 1, 8, 7, 2, 6, 2, 'active', NULL),
(261, 6, 8, 6, 1, 6, 1, 'active', NULL),
(265, 2, 3, 7, 4, 6, 1, 'active', NULL),
(266, 6, 11, 6, 2, 5, 3, 'active', NULL),
(267, 2, 7, 11, 5, 6, 3, 'active', NULL),
(269, 3, 7, 8, 6, 5, 3, 'active', NULL),
(270, 6, 9, 13, 3, 5, 4, 'active', NULL),
(271, 1, 3, 7, 6, 5, 4, 'active', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kelas`
--

CREATE TABLE `tbl_kelas` (
  `kelas_id` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_kelas`
--

INSERT INTO `tbl_kelas` (`kelas_id`, `nama_kelas`) VALUES
(5, 'TKJ-A-10'),
(6, 'TKJ-B-10'),
(7, 'TKJ-C-10'),
(8, 'TKJ-A-11'),
(9, 'TKJ-B-11'),
(10, 'TKJ-C-11'),
(11, 'TKJ-A-12'),
(12, 'TKJ-B-12'),
(13, 'TKJ-C-12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_komputer`
--

CREATE TABLE `tbl_komputer` (
  `komputer_id` int(11) NOT NULL,
  `nama_komputer` varchar(100) NOT NULL,
  `spesifikasi_komputer` varchar(300) NOT NULL,
  `status_komputer` enum('aktif','non-aktif','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_komputer`
--

INSERT INTO `tbl_komputer` (`komputer_id`, `nama_komputer`, `spesifikasi_komputer`, `status_komputer`) VALUES
(2, 'PC-02', 'RTX4080', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_mapel`
--

CREATE TABLE `tbl_mapel` (
  `mapel_id` int(11) NOT NULL,
  `nama_mapel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_mapel`
--

INSERT INTO `tbl_mapel` (`mapel_id`, `nama_mapel`) VALUES
(3, 'python'),
(6, 'C++'),
(7, 'Javascript'),
(8, 'PBO'),
(9, 'Pemweb'),
(10, 'ADBO'),
(11, 'DAA'),
(12, 'BASDAT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_periode`
--

CREATE TABLE `tbl_periode` (
  `id_periode` int(11) NOT NULL,
  `id_jadwal` int(11) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_periode`
--

INSERT INTO `tbl_periode` (`id_periode`, `id_jadwal`, `tahun`, `semester`, `created_at`) VALUES
(111, NULL, 2023, 20231, '2023-12-11 07:07:44'),
(112, 247, 2023, 20231, '2023-12-12 06:06:28'),
(113, 248, 2023, 20231, '2023-12-12 06:06:28'),
(114, 249, 2023, 20231, '2023-12-12 06:06:28'),
(115, 250, 2023, 20231, '2023-12-12 06:06:28'),
(116, 252, 2023, 20231, '2023-12-12 06:06:28'),
(117, 253, 2023, 20231, '2023-12-12 06:06:28'),
(118, NULL, 2023, 20231, '2023-12-12 06:06:28'),
(119, 255, 2023, 20231, '2023-12-12 06:06:28'),
(120, 257, 2023, 20231, '2023-12-12 06:06:28'),
(121, 258, 2023, 20231, '2023-12-12 06:06:28'),
(122, 259, 2023, 20231, '2023-12-12 06:06:28'),
(123, 260, 2023, 20231, '2023-12-12 06:06:28'),
(124, 261, 2023, 20231, '2023-12-12 06:06:28'),
(125, NULL, 2023, 20231, '2023-12-12 06:06:28'),
(126, 265, 2023, 20231, '2023-12-12 06:06:28'),
(127, 266, 2023, 20231, '2023-12-12 06:06:28'),
(128, 267, 2023, 20231, '2023-12-12 06:06:28'),
(129, 269, 2023, 20231, '2023-12-12 06:06:28'),
(130, 270, 2023, 20231, '2023-12-12 06:06:28'),
(131, 271, 2023, 20231, '2023-12-12 06:06:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ruangan`
--

CREATE TABLE `tbl_ruangan` (
  `ruangan_id` int(11) NOT NULL,
  `no_ruangan` varchar(10) NOT NULL,
  `kapasitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_ruangan`
--

INSERT INTO `tbl_ruangan` (`ruangan_id`, `no_ruangan`, `kapasitas`) VALUES
(5, '101', 35),
(6, '102', 35),
(7, '103', 35);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('super admin','admin','user','') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `nama`, `jabatan`, `alamat`, `no_hp`, `email`, `role`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Ryu Senna Fa', 'Staff', 'Karawang', '085880046916', 'ryu123@gmail.com', 'super admin', '$2y$10$rPuM0iC9Lr.YUehAe8sGRuwZ2.CA6FDkAwtLkyXEZ5VgtXMoU6qna', '2023-11-27 17:04:56', NULL),
(5, 'rizki', 'Guru', 'Bekasi', '089966775522', 'rizki123@gmail.com', 'admin', '$2y$10$P1kPddAFWrEIXxADGJG7guG/.a4I0bAvN/wsEA.TvGdZsc9Sxmif6', '2023-12-04 07:22:00', NULL),
(7, 'Tryo', 'Guru', 'Cikarang', '083812345678', 'tryo123@gmail.com', 'admin', '$2y$10$MvMr0I.muiBMUaTfBjpMqu2o6Am4GuyQemS.ivOD6ywZ.EbUeGxQS', '2023-12-04 14:24:09', NULL),
(9, 'Taufiq', 'Guru', 'Klari', '083123456789', 'taufiq123@gmail.com', 'admin', '$2y$10$6G9l.dBzBEORMbfVCPx58ObWZ7H6sUvder3H6OGGdOO22leP/RwM.', '2023-12-05 13:41:49', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_waktu`
--

CREATE TABLE `tbl_waktu` (
  `waktu_id` int(11) NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_waktu`
--

INSERT INTO `tbl_waktu` (`waktu_id`, `waktu_mulai`, `waktu_selesai`) VALUES
(1, '08:00:00', '09:00:00'),
(2, '09:00:00', '10:00:00'),
(3, '10:00:00', '11:00:00'),
(4, '11:00:00', '12:00:00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_guru`
--
ALTER TABLE `tbl_guru`
  ADD PRIMARY KEY (`guru_id`);

--
-- Indeks untuk tabel `tbl_hari`
--
ALTER TABLE `tbl_hari`
  ADD PRIMARY KEY (`hari_id`);

--
-- Indeks untuk tabel `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `hari_id` (`hari_id`),
  ADD KEY `waktu_id` (`waktu_id`),
  ADD KEY `tbl_jadwal_ibfk_4` (`mapel_id`),
  ADD KEY `tbl_jadwal_ibfk_1` (`guru_id`),
  ADD KEY `tbl_jadwal_ibfk_3` (`kelas_id`),
  ADD KEY `tbl_jadwal_ibfk_5` (`ruangan_id`);

--
-- Indeks untuk tabel `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  ADD PRIMARY KEY (`kelas_id`);

--
-- Indeks untuk tabel `tbl_komputer`
--
ALTER TABLE `tbl_komputer`
  ADD PRIMARY KEY (`komputer_id`);

--
-- Indeks untuk tabel `tbl_mapel`
--
ALTER TABLE `tbl_mapel`
  ADD PRIMARY KEY (`mapel_id`);

--
-- Indeks untuk tabel `tbl_periode`
--
ALTER TABLE `tbl_periode`
  ADD PRIMARY KEY (`id_periode`),
  ADD KEY `tbl_periode_ibfk_1` (`id_jadwal`);

--
-- Indeks untuk tabel `tbl_ruangan`
--
ALTER TABLE `tbl_ruangan`
  ADD PRIMARY KEY (`ruangan_id`);

--
-- Indeks untuk tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indeks untuk tabel `tbl_waktu`
--
ALTER TABLE `tbl_waktu`
  ADD PRIMARY KEY (`waktu_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_guru`
--
ALTER TABLE `tbl_guru`
  MODIFY `guru_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_hari`
--
ALTER TABLE `tbl_hari`
  MODIFY `hari_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- AUTO_INCREMENT untuk tabel `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  MODIFY `kelas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tbl_komputer`
--
ALTER TABLE `tbl_komputer`
  MODIFY `komputer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_mapel`
--
ALTER TABLE `tbl_mapel`
  MODIFY `mapel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tbl_periode`
--
ALTER TABLE `tbl_periode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT untuk tabel `tbl_ruangan`
--
ALTER TABLE `tbl_ruangan`
  MODIFY `ruangan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_waktu`
--
ALTER TABLE `tbl_waktu`
  MODIFY `waktu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  ADD CONSTRAINT `tbl_jadwal_ibfk_1` FOREIGN KEY (`guru_id`) REFERENCES `tbl_guru` (`guru_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_jadwal_ibfk_2` FOREIGN KEY (`hari_id`) REFERENCES `tbl_hari` (`hari_id`),
  ADD CONSTRAINT `tbl_jadwal_ibfk_3` FOREIGN KEY (`kelas_id`) REFERENCES `tbl_kelas` (`kelas_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_jadwal_ibfk_4` FOREIGN KEY (`mapel_id`) REFERENCES `tbl_mapel` (`mapel_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_jadwal_ibfk_5` FOREIGN KEY (`ruangan_id`) REFERENCES `tbl_ruangan` (`ruangan_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_jadwal_ibfk_6` FOREIGN KEY (`waktu_id`) REFERENCES `tbl_waktu` (`waktu_id`);

--
-- Ketidakleluasaan untuk tabel `tbl_periode`
--
ALTER TABLE `tbl_periode`
  ADD CONSTRAINT `tbl_periode_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `tbl_jadwal` (`id_jadwal`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
