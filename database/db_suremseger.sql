-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2022 at 04:35 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_suremseger`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `deskripsi_about` varchar(355) NOT NULL,
  `gambar` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `deskripsi_about`, `gambar`) VALUES
(1, 'Desa Kemuning Lor Kecamatan Arjasa Kabupaten Jember merupakan salah satu Desa Wisata Andalan, yang berada di lereng Gunung Argopuro. di desa ini terdapat komoditas Andalan yaitu perkebunan kopi, buah naga, bunga krisan dan peternakan sapi perah. Salah satu UKM produsen susu sapi perah adalah UKM Susu Rembangan milik Ibu Erin', '6265825882067.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `jambuka` varchar(30) NOT NULL,
  `nohp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `lokasi`, `jambuka`, `nohp`) VALUES
(1, 'Jl. Rembangan No.13, Darungan, Kemuning Lor, Arjasa, Jember jawa timur', '08.00 - 16.00', '085100236147');

-- --------------------------------------------------------

--
-- Table structure for table `deskripsi`
--

CREATE TABLE `deskripsi` (
  `id` int(11) NOT NULL,
  `judul` varchar(25) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deskripsi`
--

INSERT INTO `deskripsi` (`id`, `judul`, `deskripsi`, `gambar`) VALUES
(1, 'Susu Rembangan', ' Produk yang ditawarkan yaitu 100% susu segar rembangan dari perahan sapi yang berkualitas dengan berbagai rasa kurma, Melon, Vanila, Hazelnut, Strawbery, Coklat.', '6277dfcf82640.png');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `bank` varchar(30) NOT NULL,
  `jumlah` int(15) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(2, 14, 'Almas Firdaus', 'BNI', 30000, '2022-04-26', '20220426080940.png'),
(3, 14, 'Almas Firdaus', 'BNI', 30000, '2022-04-26', '20220426090602.png'),
(4, 22, 'Almas Firdaus', 'BNI', 30000, '2022-04-26', '20220426105602.jpg'),
(5, 29, 'Almas Firdaus', 'MANDIRI', 10000, '2022-04-26', '20220426113923.jpg'),
(6, 28, 'Almas Firdaus', 'MANDIRI', 30000, '2022-04-26', '20220426192008.jpg'),
(7, 30, 'Almas Firdaus', 'MANDIRI', 30000, '2022-04-26', '20220426192456.jpg'),
(8, 31, 'Almas Firdaus', 'BNI', 60000, '2022-04-29', '20220429094252.jpg'),
(9, 32, 'Almas Firdaus', 'BNI', 20000, '2022-04-30', '20220430024402.png'),
(10, 33, 'Almas Firdaus', 'BNI', 30000, '2022-04-30', '20220430044147.png'),
(11, 38, 'Almas Firdaus', 'BNI', 20000, '2022-05-06', '20220506083635.jpg'),
(12, 39, 'dinda', 'BNI', 30000, '2022-05-08', '20220508152851.jpg'),
(13, 41, 'Almas Firdaus', 'MANDIRI', 0, '2022-05-28', '20220528044052.png');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `opsi_pengiriman` varchar(30) NOT NULL,
  `opsi_pembayaran` varchar(30) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `status_pembelian` varchar(50) NOT NULL,
  `status_terima` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_user`, `tanggal_pembelian`, `total_pembelian`, `opsi_pengiriman`, `opsi_pembayaran`, `alamat_pengiriman`, `status_pembelian`, `status_terima`) VALUES
(21, 9, '2022-04-26', 30000, 'Ambil sendiri', 'Transfer', 'jalan jalan Kec. balung Kab. jember jawa timur kode Pos 68161', 'Dibatalkan', 'Dibatalkan'),
(22, 9, '2022-04-26', 30000, 'Di antar', 'Transfer', 'jalan jalan Kec. balung Kab. jember jawa timur kode Pos 68161', 'Proses pengiriman', 'Belum diterima'),
(23, 9, '2022-04-26', 50000, 'Di antar', 'Transfer', 'jalan jalan Kec. balung Kab. jember jawa timur kode Pos 68161', 'Menunggu pembayaran', 'Belum diterima'),
(24, 9, '2022-04-26', 30000, 'Ambil sendiri', 'Transfer', 'jalan jalan Kec. balung Kab. jember jawa timur kode Pos 68161', 'Siap diambil', 'Belum diterima'),
(25, 9, '2022-04-26', 30000, 'Ambil sendiri', 'Transfer', 'jalan jalan Kec. balung Kab. jember jawa timur kode Pos 68161', 'Menunggu pembayaran', 'Belum diterima'),
(26, 9, '2022-04-26', 40000, 'Ambil sendiri', 'Transfer', 'jalan jalan Kec. balung Kab. jember jawa timur kode Pos 68161', 'Dibatalkan', 'Dibatalkan'),
(28, 9, '2022-04-26', 30000, 'Di antar', 'COD', 'jalan jalan Kec. balung Kab. jember jawa timur kode Pos 68161', 'Proses pengiriman', 'Belum diterima'),
(29, 9, '2022-04-26', 10000, 'Dikirim', 'Transfer', 'jalan jalan Kec. balung Kab. jember jawa timur kode Pos 68161', 'Proses pengiriman', 'Belum diterima'),
(30, 12, '2022-04-26', 30000, 'Di antar', 'Transfer', 'jalan puger Kec. balung Kab. jember jawa timur kode Pos 68161', 'Proses pengiriman', 'Sudah diterima'),
(31, 9, '2022-04-29', 60000, 'Ambil sendiri', 'Transfer', 'jalan jalan Kec. balung Kab. jember jawa timur kode Pos 68161', 'Siap diambil', 'Sudah diterima'),
(32, 9, '2022-04-30', 20000, 'Di antar', 'Transfer', 'jalan jalan Kec. balung Kab. jember jawa timur kode Pos 68161', 'Sudah kirim Pembayaran', 'Belum diterima'),
(33, 9, '2022-04-30', 30000, 'Di antar', 'Transfer', 'jalan jalan Kec. balung Kab. jember jawa timur kode Pos 68161', 'Proses pengiriman', 'Sudah diterima'),
(34, 12, '2022-04-30', 20000, 'Ambil sendiri', 'Transfer', 'jalan puger Kec. balung Kab. jember jawa timur kode Pos 68161', 'Dibatalkan', 'Dibatalkan'),
(35, 9, '2022-05-05', 30000, 'Di antar', 'Transfer', 'jalan jalan Kec. balung Kab. jember jawa timur kode Pos 68161', 'Menunggu pembayaran', 'Belum diterima'),
(36, 12, '2022-05-05', 20000, 'Di antar', 'Transfer', 'jalan puger Kec. balung Kab. jember jawa timur kode Pos 68161', 'Menunggu pembayaran', 'Belum diterima'),
(37, 12, '2022-05-05', 10000, 'Di antar', 'Transfer', 'jalan puger Kec. balung Kab. jember jawa timur kode Pos 68161', 'Dibatalkan', 'Dibatalkan'),
(38, 12, '2022-05-06', 20000, 'Di antar', 'Transfer', 'jalan puger Kec. balung Kab. jember jawa timur kode Pos 68161', 'Proses pengiriman', 'Sudah diterima'),
(39, 14, '2022-05-08', 30000, 'Di antar', 'Transfer', 'jalan dinda Kec. balung Kab. jember jawa timur kode Pos 68161', 'Proses pengiriman', 'Sudah diterima'),
(40, 14, '2022-05-08', 10000, 'Di antar', 'Transfer', 'jalan dinda Kec. balung Kab. jember jawa timur kode Pos 68161', 'Dibatalkan', 'Dibatalkan'),
(41, 12, '2022-05-28', 10000, 'Ambil sendiri', 'Transfer', 'jalan puger Kec. balung Kab. jember jawa timur kode Pos 68161', 'Siap diambil', 'Sudah diterima');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `subberat` int(11) NOT NULL,
  `subharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`, `nama`, `harga`, `berat`, `subberat`, `subharga`) VALUES
(1, 6, 2, 2, 'Melon', 10000, 0, 0, 20000),
(2, 7, 4, 2, 'Hazelnut', 10000, 0, 0, 20000),
(3, 8, 2, 5, 'Melon', 10000, 0, 0, 50000),
(4, 8, 4, 7, 'Hazelnut', 10000, 0, 0, 70000),
(5, 9, 2, 4, 'Melon', 10000, 0, 0, 40000),
(6, 9, 4, 5, 'Hazelnut', 10000, 0, 0, 50000),
(7, 10, 2, 4, 'Melon', 10000, 0, 0, 40000),
(8, 10, 6, 4, 'Coklat', 10000, 0, 0, 40000),
(9, 11, 5, 3, 'Strawberry', 10000, 0, 0, 30000),
(10, 12, 2, 1, 'Melon', 10000, 0, 0, 10000),
(11, 13, 2, 1, 'Melon', 10000, 0, 0, 10000),
(12, 14, 4, 3, 'Hazelnut', 10000, 0, 0, 30000),
(13, 15, 3, 6, 'Vanilla', 10000, 0, 0, 60000),
(14, 16, 15, 1, 'Mochachino', 10000, 500, 500, 10000),
(15, 17, 15, 5, 'Mochachino', 10000, 500, 2500, 50000),
(16, 18, 15, 3, 'Mochachino', 10000, 500, 1500, 30000),
(17, 19, 15, 1, 'Mochachino', 10000, 500, 500, 10000),
(18, 20, 15, 3, 'Mochachino', 10000, 500, 1500, 30000),
(19, 21, 17, 3, 'Kurma', 10000, 500, 1500, 30000),
(20, 22, 17, 3, 'Kurma', 10000, 500, 1500, 30000),
(21, 23, 18, 5, 'Melon', 10000, 500, 2500, 50000),
(22, 24, 19, 3, 'Hazelnut', 10000, 500, 1500, 30000),
(23, 25, 17, 3, 'Kurma', 10000, 500, 1500, 30000),
(24, 26, 16, 4, 'Vanilla', 10000, 500, 2000, 40000),
(25, 27, 17, 2, 'Kurma', 10000, 500, 1000, 20000),
(26, 28, 17, 3, 'Kurma', 10000, 500, 1500, 30000),
(27, 29, 17, 1, 'Kurma', 10000, 500, 500, 10000),
(28, 30, 15, 3, 'Mochachino', 10000, 500, 1500, 30000),
(29, 31, 15, 2, 'Mochachino', 10000, 500, 1000, 20000),
(30, 31, 16, 4, 'Vanilla', 10000, 500, 2000, 40000),
(31, 32, 15, 2, 'Mochachino', 10000, 500, 1000, 20000),
(32, 33, 15, 3, 'Mochachino', 10000, 500, 1500, 30000),
(33, 34, 15, 2, 'Mochachino', 10000, 500, 1000, 20000),
(34, 35, 15, 1, 'Mochachino', 10000, 500, 500, 10000),
(35, 35, 16, 2, 'Vanilla', 10000, 500, 1000, 20000),
(36, 36, 15, 2, 'Mochachino', 10000, 500, 1000, 20000),
(37, 37, 16, 1, 'Vanilla', 10000, 500, 500, 10000),
(38, 38, 19, 2, 'Hazelnut', 10000, 500, 1000, 20000),
(39, 39, 20, 3, 'caramel', 10000, 500, 1500, 30000),
(40, 40, 17, 1, 'Kurma', 10000, 500, 500, 10000),
(41, 41, 16, 1, 'Vanilla', 10000, 500, 500, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `harga_produk` varchar(50) NOT NULL,
  `deskripsi_produk` varchar(255) NOT NULL,
  `volume_produk` varchar(30) NOT NULL,
  `berat_produk` int(11) NOT NULL,
  `stock_produk` int(5) NOT NULL,
  `gambar_produk` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga_produk`, `deskripsi_produk`, `volume_produk`, `berat_produk`, `stock_produk`, `gambar_produk`) VALUES
(15, 'Mochachino', '15000', 'Susu Segar ', '500', 500, 0, '62638c38eed69.png'),
(16, 'Vanilla', '10000', 'Susu Segar ', '500', 500, 8, '62658368c320e.png'),
(17, 'Kurma', '10000', 'Susu Segar ', '500', 500, 4, '6265838b6c1f6.png'),
(18, 'Melon', '10000', 'Susu Segar ', '500', 500, 15, '6265839acb152.png'),
(19, 'Hazelnut', '10000', 'Susu Segar ', '500', 500, 15, '626583aeea4e3.png'),
(20, 'caramel', '10000', 'Susu Segar ', '500', 500, 17, '626b9962d7c43.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(8) NOT NULL,
  `namalengkap` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `provinsi` varchar(30) NOT NULL,
  `kota` varchar(30) NOT NULL,
  `kecamatan` varchar(30) NOT NULL,
  `kodepos` varchar(10) NOT NULL,
  `nohp` varchar(13) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(2) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `namalengkap`, `email`, `alamat`, `provinsi`, `kota`, `kecamatan`, `kodepos`, `nohp`, `password`, `role`, `gambar`) VALUES
(9, 'admin2', 'admin2@gmail.com', 'jalan jalan', 'jawa timur', 'jember', 'balung', '68161', '0855555', '$2y$10$lSCgGUbJaKeY0/EVP1Q2VuwxUtot2288AYvhqkcLedGIKtK0dj4Mq', '1', '62657f4f3369e.jpg'),
(11, 'admin3', 'admin3@gmail.com', 'jalan jalan', 'jawa timur', 'jember', 'balung', '68161', '0812345678', '$2y$10$fRht4xVYEWpatYMXAmkU2.f9Bpng/BJ2s7BjkR500xvm5lgDdBhnO', '1', '62571034d3b10.png'),
(12, 'Almas Firdaus', 'almasfirdaus@gmail.com', 'jalan puger', 'jawa timur', 'jember', 'balung', '68161', '085738062555', '$2y$10$SIXakponWxvWvttK4xmev.RUwuH1SSkq0yKzvmN9IAF1KQw0z9Hi6', '2', '6265a9510ec1a.jpg'),
(13, 'Fitri', 'fitri@gmail.com', 'jalan jalan', 'jawa timur', 'jember', 'aaa', '111111', '088888', '$2y$10$vOHZtpP.sEow6kZTKlPWbuzWBaJi.X/zzf51EnO2a.jS.GnaANHuG', '2', 'defaultprofile.jpg'),
(14, 'dinda', 'dinda@gmail.com', 'jalan dinda', 'jawa timur', 'jember', 'balung', '68161', '0857777', '$2y$10$PhLy4K7Md9peLCNYHNOcOe14WfdXhyWqOfRYFnnAlEpUzsReL1G4W', '2', '6277c81c7ab14.jpg'),
(15, 'test', 'test@gmail.com', 'jalan puger', 'jawa timur', 'jember', 'balung', '68161', '085', '$2y$10$r9lgO/XNG1OJJ1jtv8vBJOJH60L2JTGOm7c5rTZQ3A/S3lFzTRJvC', '2', 'defaultprofile.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deskripsi`
--
ALTER TABLE `deskripsi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_pembelian` (`id_pembelian`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`),
  ADD KEY `id_pembelian` (`id_pembelian`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deskripsi`
--
ALTER TABLE `deskripsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id_pembelian`);

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD CONSTRAINT `pembelian_produk_ibfk_1` FOREIGN KEY (`id_pembelian`) REFERENCES `pembelian` (`id_pembelian`),
  ADD CONSTRAINT `pembelian_produk_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
