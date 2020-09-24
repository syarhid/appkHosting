-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Sep 2020 pada 15.14
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengajuan`
--

CREATE TABLE `tb_pengajuan` (
  `id` int(11) NOT NULL,
  `token` varchar(50) NOT NULL,
  `nik` char(10) NOT NULL,
  `divisi` varchar(128) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `no_tlp` varchar(15) NOT NULL,
  `email` varchar(128) NOT NULL,
  `nama_perangkat` varchar(128) NOT NULL,
  `uraian_masalah` varchar(128) NOT NULL,
  `tgl_pengajuan` date NOT NULL,
  `tgl_penyelesaian` date DEFAULT NULL,
  `diagnosa` varchar(128) NOT NULL,
  `uraian_penyelesaian` varchar(128) NOT NULL,
  `nama_teknisi` varchar(128) NOT NULL,
  `nik_teknisi` varchar(10) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pengajuan`
--

INSERT INTO `tb_pengajuan` (`id`, `token`, `nik`, `divisi`, `nama`, `no_tlp`, `email`, `nama_perangkat`, `uraian_masalah`, `tgl_pengajuan`, `tgl_penyelesaian`, `diagnosa`, `uraian_penyelesaian`, `nama_teknisi`, `nik_teknisi`, `status`) VALUES
(2, '8h5b72zxaf', '5121022', 'DC-4100', 'Novaldy Dewanda Baskara, S.Tr.K', '081220065636', 'syarhid24@gmail.com', 'Monitor', ' Rusak', '2020-09-15', '2020-09-15', 'asd', 'asd', 'Teknisi IT Center/Octa', '412421', 'ditolak'),
(3, 'ebkh6zmsgt', '5121022', 'DC-4100', 'Novaldy Dewanda Baskara, S.Tr.K', '081220065636', 'syarhid24@gmail.com', 'CPU', ' Ngebeledug', '2020-09-15', '2020-09-15', 'asd', 'asd', 'Octavian', '412421', 'Selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nik` char(10) NOT NULL,
  `divisi` varchar(128) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `no_tlp` varchar(15) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nik`, `divisi`, `nama`, `no_tlp`, `email`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, '202012', 'IT Center', 'Raka Fatian', '0895376860744', 'itindonesian.aerospae@gmail.com', '$2y$10$tWW2OeJw1gSIlKMch0tJ5uM77D5oCywDcwBsJeJ0zQOySOA59lFOi', 1, 1, 1598904204);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(6, 1, 3),
(8, 3, 5),
(9, 4, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Administrator'),
(2, 'User'),
(3, 'Menu'),
(5, 'Manajer'),
(6, 'Teknisi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'User'),
(3, 'Manajer'),
(4, 'Teknisi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'SubMenu Management', 'menu/submenu', 'far fa-fw fa-folder-open', 1),
(6, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(7, 2, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 1),
(8, 1, 'Daftar User', 'admin/daftar', 'fas fa-fw fa-user-plus', 1),
(9, 6, 'My Profile', 'teknisi', 'fas fa-fw fa-user', 1),
(10, 5, 'My Profile', 'manajer', 'fas fa-fw fa-user', 1),
(11, 2, 'Pengajuan Perbaikan', 'user/pengajuan', 'fas fa-fw fa-laptop-medical', 1),
(12, 2, 'Tracking Pengajuan', 'user/penelusuran', 'fas fa-fw fa-search-location', 1),
(13, 5, 'Edit Profile', 'manajer/edit', 'fas fa-fw fa-user-edit', 1),
(14, 5, 'Change Password', 'manajer/changepassword', 'fas fa-fw fa-key', 1),
(15, 6, 'Edit Profile', 'teknisi/edit', 'fas fa-fw fa-user-edit', 1),
(16, 6, 'Change Password', 'teknisi/changepassword', 'fas fa-fw fa-key', 1),
(17, 5, 'Request Persetujuan', 'manajer/pengajuan', 'fas fa-fw fa-laptop-medical', 1),
(18, 6, 'Tugas Perbaikan', 'teknisi/perbaikan', 'fas fa-fw fa-laptop-medical', 1),
(19, 5, 'Laporan Data Pengajuan', 'manajer/reporting', 'fas fa-fw fa-book', 1),
(20, 6, 'Laporan Data Perbaikan', 'teknisi/reporting', 'fas fa-fw fa-book', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(7, 'spurwa911@gmail.com', 'vKv8uPFJtGIUCWgj3kUt3wPHwxTZyEISFu2iiE989AU=', 1599218866),
(8, 'spurwa911@gmail.com', '8KBDAT+Ug3v7etlvnCgkJDlrVuv0Ac4rmC9a2b7SMhI=', 1599219048),
(14, 'hidayatsyarif6690@gmail.com', 'o44hsRKC7MrPSLE1fBek4ew2qVWaEu2ZN2qyTK/+/jY=', 1600134204);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_pengajuan`
--
ALTER TABLE `tb_pengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
