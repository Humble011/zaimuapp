-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jun 2023 pada 16.02
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_keuangan`
--

DELIMITER $$
--
-- Fungsi
--
CREATE DEFINER=`root`@`localhost` FUNCTION `kode_automatis` (`kode` INT) RETURNS CHAR(7) CHARSET latin1 COLLATE latin1_swedish_ci  BEGIN
DECLARE kodebaru CHAR(7);
DECLARE urut INT;
 
SET urut = IF(kode IS NULL, 1, kode + 1);
SET kodebaru = CONCAT("TRX", LPAD(urut, 4, 0));
 
RETURN kodebaru;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `kode_automatis2` (`kode` INT) RETURNS CHAR(7) CHARSET latin1 COLLATE latin1_swedish_ci  BEGIN
DECLARE kodebaru CHAR(7);
DECLARE urut INT;
 
SET urut = IF(kode IS NULL, 1, kode + 1);
SET kodebaru = CONCAT("TRF", LPAD(urut, 4, 0));
 
RETURN kodebaru;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `contact_us`
--

INSERT INTO `contact_us` (`id`, `fullname`, `email`, `subject`, `message`) VALUES
(1, 'Muhammad Hilmi', 'hilmiaja@gmail.com', 'Saran', 'Perbagus lagi'),
(3, 'Januar', 'januar123@gmail.com', 'Saran', 'Sudah bagus, tinggal ditambah hosting'),
(4, 'reyhan', 'reyhan@gmail.com', 'Saran', 'tambah lagi fitur yang menarik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasukkan`
--

CREATE TABLE `pemasukkan` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(30) NOT NULL,
  `sumber` varchar(30) NOT NULL,
  `jumlah` varchar(250) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pemasukkan`
--

INSERT INTO `pemasukkan` (`id`, `tanggal`, `keterangan`, `sumber`, `jumlah`, `username`) VALUES
(54, '2023-01-30', 'Project ', 'ATM', '500.000', 'Hilmi'),
(55, '2023-01-30', 'Gaji', 'Pekerjaan', '5.000.000', 'Hilmi'),
(56, '2023-01-31', 'Tarik tunai', 'ATM', '1.000.000', 'Hilmi'),
(57, '2023-01-31', 'Dikasih Ortu', 'Pemberian', '500.000', 'Hilmi'),
(58, '2023-01-31', 'Project ', 'ATM', '2.000.000', 'Hilmi'),
(59, '2023-03-07', 'Gaji', 'ATM', '1.000.000', 'Hilmi'),
(60, '2023-05-15', 'remote', 'Pekerjaan', '1.000.000', 'Hilmi'),
(61, '2023-06-26', 'Upah', 'Pemberian', '50.000', 'Hilmi'),
(62, '2023-06-26', 'Freelance', 'Pekerjaan', '1.500.000', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `keperluan` varchar(30) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`id`, `tanggal`, `keterangan`, `keperluan`, `jumlah`, `username`) VALUES
(29, '2023-01-30', 'KFC', 'Makan dan Minum', '50.000', 'Hilmi'),
(30, '2023-01-30', 'Bayar Hutang', 'Hutang', '1.000.000', 'Hilmi'),
(31, '2023-01-31', 'Beli Headset', 'Peralatan', '1.550.000', 'Hilmi'),
(33, '2023-01-31', 'Mixue', 'Makan dan Minum', '100.000', 'Hilmi'),
(34, '2023-06-26', 'Ayam Geprek', 'Makan dan Minum', '30.000', 'Hilmi'),
(35, '2023-06-26', 'Starbuck', 'Makan dan Minum', '100.000', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening_keluar`
--

CREATE TABLE `rekening_keluar` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `aksi` varchar(10) NOT NULL DEFAULT 'keluar',
  `tanggal` date NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `rekening_keluar`
--

INSERT INTO `rekening_keluar` (`id`, `kode`, `jumlah`, `aksi`, `tanggal`, `username`) VALUES
(17, 'TRF0001', '1.000.000', 'keluar', '2023-01-31', 'Hilmi');

--
-- Trigger `rekening_keluar`
--
DELIMITER $$
CREATE TRIGGER `tg_kodekeluar` BEFORE INSERT ON `rekening_keluar` FOR EACH ROW BEGIN
DECLARE s VARCHAR(8);
DECLARE i INTEGER;
 
SET i = (SELECT SUBSTRING(kode,4,4) AS Nomer
FROM rekening_keluar ORDER BY Nomer DESC LIMIT 1);
 
SET s = (SELECT kode_automatis2(i));
 
IF(NEW.kode IS NULL OR NEW.kode = '')
 THEN SET NEW.kode =s;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening_masuk`
--

CREATE TABLE `rekening_masuk` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `aksi` varchar(20) NOT NULL DEFAULT 'masuk',
  `tanggal` date NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `rekening_masuk`
--

INSERT INTO `rekening_masuk` (`id`, `kode`, `jumlah`, `aksi`, `tanggal`, `username`) VALUES
(20, 'TRX0004', '1.000.000', 'masuk', '2023-01-31', 'Hilmi'),
(21, 'TRX0005', '10.000.000', 'masuk', '2023-01-31', 'Hilmi');

--
-- Trigger `rekening_masuk`
--
DELIMITER $$
CREATE TRIGGER `tg_kodemasuk` BEFORE INSERT ON `rekening_masuk` FOR EACH ROW BEGIN
DECLARE s VARCHAR(8);
DECLARE i INTEGER;
 
SET i = (SELECT SUBSTRING(kode,4,4) AS Nomer
FROM rekening_masuk ORDER BY Nomer DESC LIMIT 1);
 
SET s = (SELECT kode_automatis(i));
 
IF(NEW.kode IS NULL OR NEW.kode = '')
 THEN SET NEW.kode =s;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'aktif',
  `level` varchar(10) NOT NULL DEFAULT 'user',
  `no_rek` char(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `email`, `username`, `password`, `status`, `level`, `no_rek`) VALUES
(20, 'keithbenjamin011@gmail.com', 'Hilmi', '$2y$10$pffVBld8KG3ptcR8cF8z5uHXq5scgDSKJlp.WsJa9ncQtoaumEtYW', 'aktif', 'user', '	 0001234567'),
(21, 'admin123@gmail.com', 'admin', '$2y$10$tAL9nd4ZvbYOxHbwdg.L.uOVA/suYLJAikB51.K1m8/YVB4tu6I1S', 'aktif', 'admin', '1'),
(22, 'aku123@gmail.com', 'aku', '$2y$10$c8Alwvwjyoztgs7RHUGOJO/X9pCNBK7463LODMBF5z17GXiJlxbWi', 'aktif', 'user', '7'),
(23, 'user123@gmail.com', 'user', '$2y$10$w6ju0EnLmYpZFxLlpMHNeO.Ujw3GzR7FtpKSxDgClkFQ3RKjA2wFi', 'aktif', 'user', '1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemasukkan`
--
ALTER TABLE `pemasukkan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_username_masuk` (`username`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_username_keluar` (`username`);

--
-- Indeks untuk tabel `rekening_keluar`
--
ALTER TABLE `rekening_keluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_username_rekening_keluar` (`username`);

--
-- Indeks untuk tabel `rekening_masuk`
--
ALTER TABLE `rekening_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_username_rekening_masuk` (`username`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `username` (`username`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pemasukkan`
--
ALTER TABLE `pemasukkan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `rekening_keluar`
--
ALTER TABLE `rekening_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `rekening_masuk`
--
ALTER TABLE `rekening_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pemasukkan`
--
ALTER TABLE `pemasukkan`
  ADD CONSTRAINT `fk_username_masuk` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `fk_username_keluar` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rekening_keluar`
--
ALTER TABLE `rekening_keluar`
  ADD CONSTRAINT `fk_username_rekening_keluar` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rekening_masuk`
--
ALTER TABLE `rekening_masuk`
  ADD CONSTRAINT `fk_username_rekening_masuk` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
