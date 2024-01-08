-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 08 Jan 2024 pada 03.15
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
  `nama_guru` varchar(100) NOT NULL,
  `status_deleted` tinyint(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `status_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kelas`
--

CREATE TABLE `tbl_kelas` (
  `kelas_id` int(11) NOT NULL,
  `nama_kelas` varchar(100) NOT NULL,
  `status_deleted` tinyint(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_komputer`
--

CREATE TABLE `tbl_komputer` (
  `komputer_id` int(11) NOT NULL,
  `nama_komputer` varchar(100) NOT NULL,
  `spesifikasi_komputer` varchar(300) NOT NULL,
  `status_komputer` enum('aktif','non-aktif') NOT NULL,
  `status_deleted` tinyint(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_mapel`
--

CREATE TABLE `tbl_mapel` (
  `mapel_id` int(11) NOT NULL,
  `nama_mapel` varchar(100) NOT NULL,
  `status_deleted` tinyint(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_periode`
--

CREATE TABLE `tbl_periode` (
  `id_periode` int(11) NOT NULL,
  `tahun` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `nama_mapel` varchar(255) NOT NULL,
  `nama_hari` varchar(255) NOT NULL,
  `nama_guru` varchar(255) NOT NULL,
  `nama_kelas` varchar(255) NOT NULL,
  `no_ruangan` int(11) NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ruangan`
--

CREATE TABLE `tbl_ruangan` (
  `ruangan_id` int(11) NOT NULL,
  `no_ruangan` varchar(10) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `status_deleted` tinyint(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` enum('super admin','admin','user') NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `nama`, `jabatan`, `alamat`, `no_hp`, `email`, `role`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Ryu Senna Fa', 'Staff', 'Karawang', '085880046916', 'ryu123@gmail.com', 'super admin', '$2y$10$GJfOcqJcyCbYhZY.ULdJNeoNKTlJDNWL8DupMzhbuO2NHu2of09OG', '2023-11-27 17:04:56', NULL),
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
  ADD PRIMARY KEY (`id_periode`);

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
  MODIFY `guru_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `tbl_hari`
--
ALTER TABLE `tbl_hari`
  MODIFY `hari_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_jadwal`
--
ALTER TABLE `tbl_jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=736;

--
-- AUTO_INCREMENT untuk tabel `tbl_kelas`
--
ALTER TABLE `tbl_kelas`
  MODIFY `kelas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `tbl_komputer`
--
ALTER TABLE `tbl_komputer`
  MODIFY `komputer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_mapel`
--
ALTER TABLE `tbl_mapel`
  MODIFY `mapel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `tbl_periode`
--
ALTER TABLE `tbl_periode`
  MODIFY `id_periode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=681;

--
-- AUTO_INCREMENT untuk tabel `tbl_ruangan`
--
ALTER TABLE `tbl_ruangan`
  MODIFY `ruangan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
