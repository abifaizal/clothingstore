-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jun 2020 pada 17.20
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clothstore`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_buktitransfer`
--

CREATE TABLE `tbl_buktitransfer` (
  `id_transfer` int(11) NOT NULL,
  `nama_pengirim` varchar(50) CHARACTER SET latin1 NOT NULL,
  `tgl_transfer` date NOT NULL,
  `jam_transfer` time NOT NULL,
  `bank_transfer` varchar(20) CHARACTER SET latin1 NOT NULL,
  `foto_bukti` varchar(50) CHARACTER SET latin1 NOT NULL,
  `no_penjualan` varchar(16) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_buktitransfer`
--

INSERT INTO `tbl_buktitransfer` (`id_transfer`, `nama_pengirim`, `tgl_transfer`, `jam_transfer`, `bank_transfer`, `foto_bukti`, `no_penjualan`) VALUES
(5, 'Rangga Putra', '2020-06-20', '20:13:07', 'BRI', 'bkt-1592668874.jpg', 'PJL/20200601/001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_datapenerima`
--

CREATE TABLE `tbl_datapenerima` (
  `id_datapenerima` int(11) NOT NULL,
  `nama_penerima` varchar(60) CHARACTER SET latin1 NOT NULL,
  `nohp_penerima` varchar(15) CHARACTER SET latin1 NOT NULL,
  `alamat_penerima` text CHARACTER SET latin1 NOT NULL,
  `kode_pos` varchar(10) CHARACTER SET latin1 NOT NULL,
  `provinsi_penerima` varchar(50) CHARACTER SET latin1 NOT NULL,
  `kabkota_penerima` varchar(50) CHARACTER SET latin1 NOT NULL,
  `kurir_pengiriman` varchar(8) CHARACTER SET latin1 NOT NULL,
  `paket_pengiriman` varchar(30) CHARACTER SET latin1 NOT NULL,
  `etd_paket` varchar(15) CHARACTER SET latin1 NOT NULL,
  `ongkir_paket` int(11) NOT NULL,
  `berat_kiriman` int(11) NOT NULL,
  `no_penjualan` varchar(16) CHARACTER SET latin1 NOT NULL,
  `kode_plg` varchar(10) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_datapenerima`
--

INSERT INTO `tbl_datapenerima` (`id_datapenerima`, `nama_penerima`, `nohp_penerima`, `alamat_penerima`, `kode_pos`, `provinsi_penerima`, `kabkota_penerima`, `kurir_pengiriman`, `paket_pengiriman`, `etd_paket`, `ongkir_paket`, `berat_kiriman`, `no_penjualan`, `kode_plg`) VALUES
(19, 'Rangga Putra', '085321404002', 'Jl. Paradise, Coldplay, Kota Mataram', '20477', 'Nusa Tenggara Barat (NTB)', 'Mataram', 'tiki', 'ECO', '4', 44000, 250, 'PJL/20200601/001', '2020032901'),
(20, 'Haidar Baihaqi', '085239072433', 'Jl. Jendral Soedirman No 47, Kebun Tunggal, Semarang, Jawa Tengah.', '50227', 'Jawa Tengah', 'Semarang', 'jne', 'REG', '1-2', 15000, 750, 'PJL/20200622/001', '2020051201');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_datapengiriman`
--

CREATE TABLE `tbl_datapengiriman` (
  `id_pengiriman` int(11) NOT NULL,
  `no_resi` varchar(20) CHARACTER SET latin1 NOT NULL,
  `jasa_kirim` varchar(20) CHARACTER SET latin1 NOT NULL,
  `tgl_kirim` date NOT NULL,
  `lama_kirim` varchar(10) CHARACTER SET latin1 NOT NULL,
  `catatan_kirim` text CHARACTER SET latin1 DEFAULT NULL,
  `tgl_record` date NOT NULL,
  `no_penjualan` varchar(16) CHARACTER SET latin1 NOT NULL,
  `id_pgw` varchar(6) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_datapengiriman`
--

INSERT INTO `tbl_datapengiriman` (`id_pengiriman`, `no_resi`, `jasa_kirim`, `tgl_kirim`, `lama_kirim`, `catatan_kirim`, `tgl_record`, `no_penjualan`, `id_pgw`) VALUES
(6, 'MTR200620KB', 'Tiki', '2020-06-21', '3-5', 'Mohon segera konfirmasi kami jika barang telah diterima, Terima kasih telah berbelanja dan kami tunggu orderan selanjutnya.', '2020-06-20', 'PJL/20200601/001', 'PGW001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_keranjang`
--

CREATE TABLE `tbl_keranjang` (
  `id_keranjang` varchar(6) NOT NULL,
  `tanggal_krj` date NOT NULL,
  `jam_krj` time NOT NULL,
  `kode_plg` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_keranjangdetail`
--

CREATE TABLE `tbl_keranjangdetail` (
  `id_krjdt` int(11) NOT NULL,
  `id_prd` varchar(12) NOT NULL,
  `id_ukuran` int(11) NOT NULL,
  `jml_prd` int(11) NOT NULL,
  `id_keranjang` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pegawai`
--

CREATE TABLE `tbl_pegawai` (
  `id_pgw` varchar(6) NOT NULL,
  `nama_pgw` varchar(50) NOT NULL,
  `gender_pgw` varchar(10) NOT NULL,
  `lahir_pgw` date NOT NULL,
  `posisi_pgw` enum('Manager','Kasir') NOT NULL,
  `alamat_pgw` text NOT NULL,
  `username_pgw` varchar(30) NOT NULL,
  `password_pgw` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pegawai`
--

INSERT INTO `tbl_pegawai` (`id_pgw`, `nama_pgw`, `gender_pgw`, `lahir_pgw`, `posisi_pgw`, `alamat_pgw`, `username_pgw`, `password_pgw`) VALUES
('PGW001', 'Aslan Kemal', 'Laki-laki', '1996-02-01', 'Manager', 'Kosan Alif, Mlati, Sleman, Yogyakarta', 'aslankemal', 'aslankemal'),
('PGW002', 'Heri Prasetyo', 'Laki-laki', '1994-04-17', 'Manager', 'Jalan Siliwangi, Jl. Ring Road Utara Jl. Jombor Lor, Mlati Krajan, Sendangadi, Kec. Mlati, Kabupaten Sleman.', 'bapakheri', 'bapakheri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pelanggan`
--

CREATE TABLE `tbl_pelanggan` (
  `kode_plg` varchar(10) NOT NULL,
  `nama_plg` varchar(50) NOT NULL,
  `gender_plg` enum('Laki-laki','Perempuan') NOT NULL,
  `email_plg` varchar(50) NOT NULL,
  `username_plg` varchar(30) NOT NULL,
  `password_plg` varchar(30) NOT NULL,
  `tglregis_plg` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pelanggan`
--

INSERT INTO `tbl_pelanggan` (`kode_plg`, `nama_plg`, `gender_plg`, `email_plg`, `username_plg`, `password_plg`, `tglregis_plg`) VALUES
('2020032901', 'Rangga Putra Rizdillah', 'Laki-laki', 'ranggaputra@gmail.com', 'rangga', 'rangga', '2020-03-29'),
('2020040401', 'Arif Setyo', 'Laki-laki', 'arifsetyo@gmail.com', 'arif', 'arif', '2020-04-04'),
('2020051201', 'Haidar Baihaqi', 'Laki-laki', 'haidarbaihaqi@gmail.com', 'haidar', 'haidar', '2020-05-12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penjualan`
--

CREATE TABLE `tbl_penjualan` (
  `no_penjualan` varchar(16) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `jam_penjualan` time NOT NULL,
  `total_penjualan` int(11) NOT NULL,
  `diskon_penjualan` int(11) NOT NULL,
  `bayar_penjualan` int(11) NOT NULL,
  `metode_penjualan` enum('Offline','Online') NOT NULL,
  `lunas_penjualan` enum('Lunas','Pending') NOT NULL,
  `status_penjualan` enum('Belum Bayar','Menunggu Verifikasi','Verifikasi','Dikirim','Selesai') NOT NULL,
  `kode_plg` varchar(10) DEFAULT NULL,
  `id_pgw` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_penjualan`
--

INSERT INTO `tbl_penjualan` (`no_penjualan`, `tgl_penjualan`, `jam_penjualan`, `total_penjualan`, `diskon_penjualan`, `bayar_penjualan`, `metode_penjualan`, `lunas_penjualan`, `status_penjualan`, `kode_plg`, `id_pgw`) VALUES
('PJL/20200522/001', '2020-05-22', '12:33:46', 90000, 0, 90000, 'Offline', 'Lunas', 'Selesai', NULL, 'PGW001'),
('PJL/20200527/001', '2020-05-27', '11:59:56', 234000, 10, 250000, 'Offline', 'Lunas', 'Selesai', NULL, 'PGW001'),
('PJL/20200601/001', '2020-06-02', '00:10:35', 90000, 0, 0, 'Online', 'Lunas', 'Dikirim', '2020032901', NULL),
('PJL/20200602/002', '2020-06-02', '20:23:31', 220000, 0, 250000, 'Offline', 'Lunas', 'Selesai', NULL, 'PGW001'),
('PJL/20200622/001', '2020-06-22', '18:58:07', 260000, 0, 0, 'Online', 'Pending', 'Belum Bayar', '2020051201', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penjualandetail`
--

CREATE TABLE `tbl_penjualandetail` (
  `no_pjl_detail` int(11) NOT NULL,
  `id_prd` varchar(12) NOT NULL,
  `id_ukuran` int(11) NOT NULL,
  `harga_prd` int(11) NOT NULL,
  `diskon_prd` int(11) NOT NULL,
  `jml_prd` int(11) NOT NULL,
  `subtotal_prd` int(11) NOT NULL,
  `no_penjualan` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_penjualandetail`
--

INSERT INTO `tbl_penjualandetail` (`no_pjl_detail`, `id_prd`, `id_ukuran`, `harga_prd`, `diskon_prd`, `jml_prd`, `subtotal_prd`, `no_penjualan`) VALUES
(19, 'PRD003', 87, 90000, 0, 1, 90000, 'PJL/20200522/001'),
(26, 'PRD014', 132, 170000, 0, 1, 170000, 'PJL/20200527/001'),
(27, 'PRD013', 128, 90000, 0, 1, 90000, 'PJL/20200527/001'),
(28, 'PRD003', 87, 90000, 0, 1, 90000, 'PJL/20200601/001'),
(29, 'PRD013', 127, 90000, 0, 1, 90000, 'PJL/20200602/002'),
(30, 'PRD016', 139, 130000, 0, 1, 130000, 'PJL/20200602/002'),
(31, 'PRD012', 124, 170000, 0, 1, 170000, 'PJL/20200622/001'),
(32, 'PRD013', 127, 90000, 0, 1, 90000, 'PJL/20200622/001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id_prd` varchar(12) NOT NULL,
  `nama_prd` varchar(60) NOT NULL,
  `kategori_prd` varchar(15) NOT NULL,
  `harga_prd` int(11) NOT NULL,
  `diskon_prd` int(11) NOT NULL,
  `stok_prd` int(11) NOT NULL,
  `berat_prd` int(11) NOT NULL,
  `deskripsi_prd` text DEFAULT NULL,
  `gambar_prd` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_prd`, `nama_prd`, `kategori_prd`, `harga_prd`, `diskon_prd`, `stok_prd`, `berat_prd`, `deskripsi_prd`, `gambar_prd`) VALUES
('PRD001', 'Turbidity Black', 'Kaus', 90000, 0, 55, 250, '', 'prd-1589990222.jpg'),
('PRD002', 'Aester Earthshaker Black', 'Kaus', 90000, 0, 42, 250, '', 'prd-1589990332.jpg'),
('PRD003', 'Noxa Grind Viruses Black', 'Kaus', 90000, 0, 38, 250, '', 'prd-1589990388.jpg'),
('PRD005', 'Death Vertical Black', 'Kaus', 90000, 0, 26, 250, '', 'prd-1589990584.jpg'),
('PRD006', 'Death Vomit Black Orange', 'Kaus', 90000, 0, 28, 250, '', 'prd-1589990639.jpg'),
('PRD007', 'Jihad Black', 'Kaus', 90000, 0, 13, 250, '', 'prd-1589990686.jpg'),
('PRD008', 'Turbidity Knife Black', 'Kaus', 90000, 0, 27, 250, '', 'prd-1589990742.jpg'),
('PRD009', 'Gerogot Skull Black', 'Kaus', 90000, 0, 30, 250, '', 'prd-1589990859.jpg'),
('PRD010', 'Noxa Propaganda', 'Kaus', 90000, 0, 44, 250, '', 'prd-1589990919.jpg'),
('PRD011', 'BLCKSDW Hoodie C1', 'Jaket', 170000, 0, 41, 500, '', 'prd-1589991113.jpg'),
('PRD012', 'Black Shadow UFO Hoodie', 'Jaket', 170000, 0, 15, 500, '', 'prd-1589991249.jpg'),
('PRD013', 'BLCKSDW Tricolor', 'Kaus', 90000, 0, 44, 250, '', 'prd-1589991304.jpg'),
('PRD014', 'Black Shadow est013 Hoodie', 'Jaket', 170000, 0, 30, 500, '', 'prd-1590124908.jpg'),
('PRD015', 'Black Shadow Flannel C1', 'Kemeja', 130000, 0, 17, 250, '', 'prd-1590125004.jpg'),
('PRD016', 'Black Shadow Flannel C2', 'Kemeja', 130000, 0, 16, 250, '', 'prd-1590125068.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ukuranprd`
--

CREATE TABLE `tbl_ukuranprd` (
  `id_ukuran` int(11) NOT NULL,
  `keterangan_ukr` varchar(4) NOT NULL,
  `stok_ukr` int(11) NOT NULL,
  `id_prd` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_ukuranprd`
--

INSERT INTO `tbl_ukuranprd` (`id_ukuran`, `keterangan_ukr`, `stok_ukr`, `id_prd`) VALUES
(78, 'S', 12, 'PRD001'),
(79, 'M', 18, 'PRD001'),
(80, 'L', 17, 'PRD001'),
(81, 'XL', 8, 'PRD001'),
(82, 'S', 8, 'PRD002'),
(83, 'M', 12, 'PRD002'),
(84, 'L', 19, 'PRD002'),
(85, 'XL', 3, 'PRD002'),
(86, 'S', 18, 'PRD003'),
(87, 'M', 6, 'PRD003'),
(88, 'L', 4, 'PRD003'),
(89, 'XL', 10, 'PRD003'),
(94, 'S', 6, 'PRD005'),
(95, 'M', 7, 'PRD005'),
(96, 'L', 3, 'PRD005'),
(97, 'XL', 10, 'PRD005'),
(98, 'S', 3, 'PRD006'),
(99, 'M', 14, 'PRD006'),
(100, 'L', 10, 'PRD006'),
(101, 'XL', 1, 'PRD006'),
(102, 'S', 2, 'PRD007'),
(103, 'M', 3, 'PRD007'),
(104, 'L', 2, 'PRD007'),
(105, 'XL', 6, 'PRD007'),
(106, 'S', 14, 'PRD008'),
(107, 'M', 8, 'PRD008'),
(108, 'L', 4, 'PRD008'),
(109, 'XL', 1, 'PRD008'),
(110, 'S', 4, 'PRD009'),
(111, 'M', 12, 'PRD009'),
(112, 'L', 11, 'PRD009'),
(113, 'XL', 3, 'PRD009'),
(114, 'S', 12, 'PRD010'),
(115, 'M', 23, 'PRD010'),
(116, 'L', 7, 'PRD010'),
(117, 'XL', 2, 'PRD010'),
(118, 'S', 0, 'PRD011'),
(119, 'M', 12, 'PRD011'),
(120, 'L', 18, 'PRD011'),
(121, 'XL', 11, 'PRD011'),
(122, 'S', 3, 'PRD012'),
(123, 'M', 2, 'PRD012'),
(124, 'L', 9, 'PRD012'),
(125, 'XL', 1, 'PRD012'),
(126, 'S', 17, 'PRD013'),
(127, 'M', 10, 'PRD013'),
(128, 'L', 15, 'PRD013'),
(129, 'XL', 2, 'PRD013'),
(130, 'S', 6, 'PRD014'),
(131, 'M', 9, 'PRD014'),
(132, 'L', 11, 'PRD014'),
(133, 'XL', 4, 'PRD014'),
(134, 'S', 3, 'PRD015'),
(135, 'M', 7, 'PRD015'),
(136, 'L', 5, 'PRD015'),
(137, 'XL', 2, 'PRD015'),
(138, 'S', 2, 'PRD016'),
(139, 'M', 7, 'PRD016'),
(140, 'L', 4, 'PRD016'),
(141, 'XL', 3, 'PRD016');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_buktitransfer`
--
ALTER TABLE `tbl_buktitransfer`
  ADD PRIMARY KEY (`id_transfer`),
  ADD KEY `bkt_nopjl` (`no_penjualan`);

--
-- Indeks untuk tabel `tbl_datapenerima`
--
ALTER TABLE `tbl_datapenerima`
  ADD PRIMARY KEY (`id_datapenerima`),
  ADD KEY `pnrm_nopjl` (`no_penjualan`);

--
-- Indeks untuk tabel `tbl_datapengiriman`
--
ALTER TABLE `tbl_datapengiriman`
  ADD PRIMARY KEY (`id_pengiriman`),
  ADD KEY `pngrmn_nopjl` (`no_penjualan`);

--
-- Indeks untuk tabel `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `krj_kodeplg` (`kode_plg`);

--
-- Indeks untuk tabel `tbl_keranjangdetail`
--
ALTER TABLE `tbl_keranjangdetail`
  ADD PRIMARY KEY (`id_krjdt`),
  ADD KEY `krjd_idprd` (`id_prd`),
  ADD KEY `krjd_idkrj` (`id_keranjang`);

--
-- Indeks untuk tabel `tbl_pegawai`
--
ALTER TABLE `tbl_pegawai`
  ADD PRIMARY KEY (`id_pgw`);

--
-- Indeks untuk tabel `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD PRIMARY KEY (`kode_plg`);

--
-- Indeks untuk tabel `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  ADD PRIMARY KEY (`no_penjualan`),
  ADD KEY `pjl_idpgw` (`id_pgw`),
  ADD KEY `pjl_kdplg` (`kode_plg`);

--
-- Indeks untuk tabel `tbl_penjualandetail`
--
ALTER TABLE `tbl_penjualandetail`
  ADD PRIMARY KEY (`no_pjl_detail`),
  ADD KEY `pjld_idprd` (`id_prd`),
  ADD KEY `pjld_nopjl` (`no_penjualan`);

--
-- Indeks untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_prd`);

--
-- Indeks untuk tabel `tbl_ukuranprd`
--
ALTER TABLE `tbl_ukuranprd`
  ADD PRIMARY KEY (`id_ukuran`),
  ADD KEY `ukuran_idprd` (`id_prd`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_buktitransfer`
--
ALTER TABLE `tbl_buktitransfer`
  MODIFY `id_transfer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_datapenerima`
--
ALTER TABLE `tbl_datapenerima`
  MODIFY `id_datapenerima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tbl_datapengiriman`
--
ALTER TABLE `tbl_datapengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tbl_keranjangdetail`
--
ALTER TABLE `tbl_keranjangdetail`
  MODIFY `id_krjdt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `tbl_penjualandetail`
--
ALTER TABLE `tbl_penjualandetail`
  MODIFY `no_pjl_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `tbl_ukuranprd`
--
ALTER TABLE `tbl_ukuranprd`
  MODIFY `id_ukuran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_buktitransfer`
--
ALTER TABLE `tbl_buktitransfer`
  ADD CONSTRAINT `bkt_nopjl` FOREIGN KEY (`no_penjualan`) REFERENCES `tbl_penjualan` (`no_penjualan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_datapenerima`
--
ALTER TABLE `tbl_datapenerima`
  ADD CONSTRAINT `pnrm_nopjl` FOREIGN KEY (`no_penjualan`) REFERENCES `tbl_penjualan` (`no_penjualan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_datapengiriman`
--
ALTER TABLE `tbl_datapengiriman`
  ADD CONSTRAINT `pngrmn_nopjl` FOREIGN KEY (`no_penjualan`) REFERENCES `tbl_penjualan` (`no_penjualan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  ADD CONSTRAINT `krj_kodeplg` FOREIGN KEY (`kode_plg`) REFERENCES `tbl_pelanggan` (`kode_plg`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_keranjangdetail`
--
ALTER TABLE `tbl_keranjangdetail`
  ADD CONSTRAINT `krjd_idkrj` FOREIGN KEY (`id_keranjang`) REFERENCES `tbl_keranjang` (`id_keranjang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `krjd_idprd` FOREIGN KEY (`id_prd`) REFERENCES `tbl_produk` (`id_prd`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  ADD CONSTRAINT `pjl_idpgw` FOREIGN KEY (`id_pgw`) REFERENCES `tbl_pegawai` (`id_pgw`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pjl_kdplg` FOREIGN KEY (`kode_plg`) REFERENCES `tbl_pelanggan` (`kode_plg`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_penjualandetail`
--
ALTER TABLE `tbl_penjualandetail`
  ADD CONSTRAINT `pjld_idprd` FOREIGN KEY (`id_prd`) REFERENCES `tbl_produk` (`id_prd`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pjld_nopjl` FOREIGN KEY (`no_penjualan`) REFERENCES `tbl_penjualan` (`no_penjualan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_ukuranprd`
--
ALTER TABLE `tbl_ukuranprd`
  ADD CONSTRAINT `ukuran_idprd` FOREIGN KEY (`id_prd`) REFERENCES `tbl_produk` (`id_prd`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
