-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Bulan Mei 2025 pada 08.28
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sbd`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `harga_beli` decimal(12,2) DEFAULT NULL,
  `harga_jual` decimal(12,2) DEFAULT NULL,
  `stok` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `kode_barang`, `nama_barang`, `satuan`, `harga_beli`, `harga_jual`, `stok`) VALUES
(3, '1P4A', 'Susu SGM', '100', 25000.00, 30000.00, 1100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_faktur_keluar`
--

CREATE TABLE `detail_faktur_keluar` (
  `id_detail` int(11) NOT NULL,
  `id_faktur_keluar` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` decimal(12,2) DEFAULT NULL,
  `total_harga` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_faktur_masuk`
--

CREATE TABLE `detail_faktur_masuk` (
  `id_detail` int(11) NOT NULL,
  `id_faktur_masuk` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `satuan` varchar(20) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` decimal(12,2) DEFAULT NULL,
  `total_harga` decimal(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_faktur_masuk`
--

INSERT INTO `detail_faktur_masuk` (`id_detail`, `id_faktur_masuk`, `id_barang`, `satuan`, `jumlah`, `harga`, `total_harga`) VALUES
(4, 5, 3, '100', 100, 1000.00, 100000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `faktur_keluar`
--

CREATE TABLE `faktur_keluar` (
  `id_faktur_keluar` int(11) NOT NULL,
  `no_faktur_keluar` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `id_pengguna` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `faktur_masuk`
--

CREATE TABLE `faktur_masuk` (
  `id_faktur_masuk` int(11) NOT NULL,
  `no_faktur` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `id_pengguna` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `faktur_masuk`
--

INSERT INTO `faktur_masuk` (`id_faktur_masuk`, `no_faktur`, `tanggal`, `id_pengguna`) VALUES
(5, '111PP', '2025-05-31', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama_pengguna` varchar(100) NOT NULL,
  `kata_sandi` varchar(255) NOT NULL,
  `peran` enum('admin','sales') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama_pengguna`, `kata_sandi`, `peran`) VALUES
(1, 'admin', 'admin123', 'admin'),
(3, 'admin1', '$2y$10$aV/R8DZ.b9aYd9ahdGGE8uaCPNnFAyDO6gjIcrKhRqkKGoKqiQMoO', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekap_faktur_keluar`
--

CREATE TABLE `rekap_faktur_keluar` (
  `id_rekap` int(11) NOT NULL,
  `no_faktur_keluar` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `total_barang_jasa` decimal(12,2) DEFAULT NULL,
  `id_pengguna` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekap_faktur_masuk`
--

CREATE TABLE `rekap_faktur_masuk` (
  `id_rekap` int(11) NOT NULL,
  `no_faktur` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `total_barang_jasa` decimal(12,2) DEFAULT NULL,
  `gt_faktur` decimal(12,2) DEFAULT NULL,
  `id_pengguna` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`);

--
-- Indeks untuk tabel `detail_faktur_keluar`
--
ALTER TABLE `detail_faktur_keluar`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_faktur_keluar` (`id_faktur_keluar`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `detail_faktur_masuk`
--
ALTER TABLE `detail_faktur_masuk`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_faktur_masuk` (`id_faktur_masuk`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indeks untuk tabel `faktur_keluar`
--
ALTER TABLE `faktur_keluar`
  ADD PRIMARY KEY (`id_faktur_keluar`),
  ADD UNIQUE KEY `no_faktur_keluar` (`no_faktur_keluar`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indeks untuk tabel `faktur_masuk`
--
ALTER TABLE `faktur_masuk`
  ADD PRIMARY KEY (`id_faktur_masuk`),
  ADD UNIQUE KEY `no_faktur` (`no_faktur`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indeks untuk tabel `rekap_faktur_keluar`
--
ALTER TABLE `rekap_faktur_keluar`
  ADD PRIMARY KEY (`id_rekap`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indeks untuk tabel `rekap_faktur_masuk`
--
ALTER TABLE `rekap_faktur_masuk`
  ADD PRIMARY KEY (`id_rekap`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `detail_faktur_keluar`
--
ALTER TABLE `detail_faktur_keluar`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `detail_faktur_masuk`
--
ALTER TABLE `detail_faktur_masuk`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `faktur_keluar`
--
ALTER TABLE `faktur_keluar`
  MODIFY `id_faktur_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `faktur_masuk`
--
ALTER TABLE `faktur_masuk`
  MODIFY `id_faktur_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `rekap_faktur_keluar`
--
ALTER TABLE `rekap_faktur_keluar`
  MODIFY `id_rekap` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `rekap_faktur_masuk`
--
ALTER TABLE `rekap_faktur_masuk`
  MODIFY `id_rekap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_faktur_keluar`
--
ALTER TABLE `detail_faktur_keluar`
  ADD CONSTRAINT `detail_faktur_keluar_ibfk_1` FOREIGN KEY (`id_faktur_keluar`) REFERENCES `faktur_keluar` (`id_faktur_keluar`),
  ADD CONSTRAINT `detail_faktur_keluar_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Ketidakleluasaan untuk tabel `detail_faktur_masuk`
--
ALTER TABLE `detail_faktur_masuk`
  ADD CONSTRAINT `detail_faktur_masuk_ibfk_1` FOREIGN KEY (`id_faktur_masuk`) REFERENCES `faktur_masuk` (`id_faktur_masuk`),
  ADD CONSTRAINT `detail_faktur_masuk_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Ketidakleluasaan untuk tabel `faktur_keluar`
--
ALTER TABLE `faktur_keluar`
  ADD CONSTRAINT `faktur_keluar_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`);

--
-- Ketidakleluasaan untuk tabel `faktur_masuk`
--
ALTER TABLE `faktur_masuk`
  ADD CONSTRAINT `faktur_masuk_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`);

--
-- Ketidakleluasaan untuk tabel `rekap_faktur_keluar`
--
ALTER TABLE `rekap_faktur_keluar`
  ADD CONSTRAINT `rekap_faktur_keluar_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`);

--
-- Ketidakleluasaan untuk tabel `rekap_faktur_masuk`
--
ALTER TABLE `rekap_faktur_masuk`
  ADD CONSTRAINT `rekap_faktur_masuk_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
