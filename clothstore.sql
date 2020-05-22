-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Bulan Mei 2020 pada 15.06
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
  `nama_pengirim` varchar(50) NOT NULL,
  `tgl_transfer` date NOT NULL,
  `jam_transfer` time NOT NULL,
  `bank_transfer` varchar(20) NOT NULL,
  `foto_bukti` varchar(50) NOT NULL,
  `no_penjualan` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_buktitransfer`
--

INSERT INTO `tbl_buktitransfer` (`id_transfer`, `nama_pengirim`, `tgl_transfer`, `jam_transfer`, `bank_transfer`, `foto_bukti`, `no_penjualan`) VALUES
(2, 'Jamal Mustafa', '2020-04-29', '14:13:32', 'Mandiri', 'bkt-1588407873.jpg', 'PJL/20200424/002'),
(3, 'Rangga Putra Rizdilla', '2020-05-09', '10:15:08', 'BRI', 'bkt-1589034138.jpg', 'PJL/20200504/001'),
(4, 'Amal Setiawan', '2020-05-17', '19:40:30', 'BRI', 'bkt-1589719359.jpg', 'PJL/20200517/001');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_datapenerima`
--

CREATE TABLE `tbl_datapenerima` (
  `id_datapenerima` int(11) NOT NULL,
  `nama_penerima` varchar(60) NOT NULL,
  `nohp_penerima` varchar(15) NOT NULL,
  `alamat_penerima` text NOT NULL,
  `kode_pos` varchar(10) NOT NULL,
  `provinsi_penerima` varchar(50) NOT NULL,
  `kabkota_penerima` varchar(50) NOT NULL,
  `kurir_pengiriman` varchar(8) NOT NULL,
  `paket_pengiriman` varchar(30) NOT NULL,
  `etd_paket` varchar(15) NOT NULL,
  `ongkir_paket` int(11) NOT NULL,
  `berat_kiriman` int(11) NOT NULL,
  `no_penjualan` varchar(16) NOT NULL,
  `kode_plg` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_datapenerima`
--

INSERT INTO `tbl_datapenerima` (`id_datapenerima`, `nama_penerima`, `nohp_penerima`, `alamat_penerima`, `kode_pos`, `provinsi_penerima`, `kabkota_penerima`, `kurir_pengiriman`, `paket_pengiriman`, `etd_paket`, `ongkir_paket`, `berat_kiriman`, `no_penjualan`, `kode_plg`) VALUES
(9, 'Jamal', '085337337337', 'Jl Angkasa Raya Bimasakti Antariksa No 17, Kotagede', '55160', 'DI Yogyakarta', 'Yogyakarta', 'jne', 'REG', '1-2', 15000, 850, 'PJL/20200424/002', '2020033001'),
(10, 'Aslan Kemal', '085333417341', 'Jl Janti Kusuma No 17, Gambiran, Semarang', '54327', 'Jawa Tengah', 'Semarang', 'pos', 'Paket Kilat Khusus', '1-2 HARI', 12000, 200, 'PJL/20200427/001', '2020033001'),
(11, 'Rangga Ika Putra', '088207303222', 'Jl. Pancar Raya 13, Karang Baru, Kota Mataram, Nusa Tenggara Barat.', '40182', 'Nusa Tenggara Barat (NTB)', 'Mataram', 'pos', 'Paket Kilat Khusus', '3-5 HARI', 35000, 350, 'PJL/20200504/001', '2020032901'),
(12, 'Haidar Baihaqi', '085337334136', 'Perumahan RSS Baumata Tipe 21 Blok F no 5, Desa Baumata Barat, Kecamatan Taebenu, Kabupaten Kupang.', '55039', 'Nusa Tenggara Timur (NTT)', 'Kupang', 'pos', 'Paket Kilat Khusus', '4-6 HARI', 56000, 200, 'PJL/20200512/001', '2020051201'),
(13, 'Amal Setiawan', '085333461216', 'Jl Belakang UTY', '56066', 'DI Yogyakarta', 'Sleman', 'jne', 'REG', '1-2', 15000, 200, 'PJL/20200517/001', '2020051701');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_datapengiriman`
--

CREATE TABLE `tbl_datapengiriman` (
  `id_pengiriman` int(11) NOT NULL,
  `no_resi` varchar(20) NOT NULL,
  `jasa_kirim` varchar(20) NOT NULL,
  `tgl_kirim` date NOT NULL,
  `lama_kirim` varchar(10) NOT NULL,
  `catatan_kirim` text DEFAULT NULL,
  `tgl_record` date NOT NULL,
  `no_penjualan` varchar(16) NOT NULL,
  `id_pgw` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_datapengiriman`
--

INSERT INTO `tbl_datapengiriman` (`id_pengiriman`, `no_resi`, `jasa_kirim`, `tgl_kirim`, `lama_kirim`, `catatan_kirim`, `tgl_record`, `no_penjualan`, `id_pgw`) VALUES
(3, 'EE200509026YK', 'Pos Indonesia', '2020-05-09', '1-2', 'Segera Konfirmasi Kami jika Paket Telah Diterima, Terima Kasih Bro.', '2020-05-11', 'PJL/20200424/002', 'PGW001'),
(4, 'YK200512103MR', 'Pos Indonesia', '2020-05-12', '2-3', 'Mohon segera konfirmasi kami jika produk telah diterima. Terima kasih.', '2020-05-12', 'PJL/20200504/001', 'PGW001'),
(5, 'JNE30455YK', 'JNE', '2020-05-17', '1-2', 'Konfirmasi kami jika telah diterima', '2020-05-17', 'PJL/20200517/001', 'PGW001');

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
('2020033001', 'Jamal Mustafa', 'Laki-laki', 'jamal@gmail.com', 'jamal', 'jamal', '2020-03-30'),
('2020040401', 'Arif Setyo', 'Laki-laki', 'arifsetyo@gmail.com', 'arif', 'arif', '2020-04-04'),
('2020051201', 'Haidar Baihaqi', 'Laki-laki', 'haidarbaihaqi@gmail.com', 'haidar', 'haidar', '2020-05-12'),
('2020051701', 'Amal Setiawan', 'Laki-laki', 'amal@gmail.com', 'amal', 'amal', '2020-05-17');

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
('PJL/20200416/001', '2020-04-16', '22:04:27', 371450, 5, 380000, 'Offline', 'Lunas', 'Selesai', NULL, 'PGW001'),
('PJL/20200416/002', '2020-04-16', '22:06:39', 120000, 0, 150000, 'Offline', 'Lunas', 'Selesai', NULL, 'PGW001'),
('PJL/20200418/001', '2020-04-18', '18:42:07', 120000, 0, 120000, 'Offline', 'Lunas', 'Selesai', NULL, 'PGW001'),
('PJL/20200418/002', '2020-04-18', '23:47:06', 90000, 0, 100000, 'Offline', 'Lunas', 'Selesai', NULL, 'PGW001'),
('PJL/20200424/001', '2020-04-24', '13:00:20', 114000, 5, 120000, 'Offline', 'Lunas', 'Selesai', NULL, 'PGW001'),
('PJL/20200424/002', '2020-04-24', '14:18:11', 317000, 0, 0, 'Online', 'Lunas', 'Selesai', '2020033001', NULL),
('PJL/20200426/001', '2020-04-26', '15:08:28', 90000, 0, 100000, 'Offline', 'Lunas', 'Selesai', NULL, 'PGW001'),
('PJL/20200427/001', '2020-04-27', '16:14:00', 120000, 0, 0, 'Online', 'Pending', 'Belum Bayar', '2020033001', NULL),
('PJL/20200504/001', '2020-05-04', '15:31:08', 155000, 0, 0, 'Online', 'Lunas', 'Selesai', '2020032901', NULL),
('PJL/20200512/001', '2020-05-12', '21:33:31', 120000, 0, 0, 'Online', 'Pending', 'Belum Bayar', '2020051201', NULL),
('PJL/20200517/001', '2020-05-17', '19:40:02', 120000, 0, 0, 'Online', 'Lunas', 'Selesai', '2020051701', NULL);

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
(1, 'PRD011', 53, 81000, 10, 1, 81000, 'PJL/20200416/001'),
(2, 'PRD013', 63, 155000, 0, 2, 310000, 'PJL/20200416/001'),
(3, 'PRD014', 67, 120000, 0, 1, 120000, 'PJL/20200416/002'),
(4, 'PRD012', 32, 120000, 0, 1, 120000, 'PJL/20200418/001'),
(5, 'PRD015', 72, 90000, 0, 1, 90000, 'PJL/20200418/002'),
(6, 'PRD014', 67, 120000, 0, 1, 120000, 'PJL/20200424/001'),
(9, 'PRD011', 53, 81000, 10, 2, 162000, 'PJL/20200424/002'),
(10, 'PRD013', 63, 155000, 0, 1, 155000, 'PJL/20200424/002'),
(11, 'PRD015', 72, 90000, 0, 1, 90000, 'PJL/20200426/001'),
(12, 'PRD014', 67, 120000, 0, 1, 120000, 'PJL/20200427/001'),
(13, 'PRD013', 61, 155000, 0, 1, 155000, 'PJL/20200504/001'),
(14, 'PRD012', 31, 120000, 0, 1, 120000, 'PJL/20200512/001'),
(15, 'PRD012', 31, 120000, 0, 1, 120000, 'PJL/20200517/001');

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
('PRD001', 'Kaus Playstation Hitam', 'Kaus', 90000, 0, 13, 250, 'Cotton 30s', '07fdd10557fefffdae314e0677ab2133.jpg'),
('PRD002', 'Kaus Astronot On a Rocket', 'Kaus', 90000, 0, 11, 250, 'Cotton 30s', '297e365435bd93b324c09fb4e946fd06.jpg'),
('PRD003', 'Kaus Astronot Coffe', 'Kaus', 90000, 10, 7, 250, 'Cotton 30s', '89183006f83126c6e155e7116d338148.jpg'),
('PRD004', 'Kaus Sail Away Hitam', 'Kaus', 90000, 0, 12, 250, 'Cotton 30s', '518345ce0c5484748995ebd1374afd21.jpg'),
('PRD005', 'Blue Skinny Jeans', 'Celana', 155000, 0, 18, 350, 'Jeans yang dapat melar menyesuaikan bentuk tubuh', 'b357627a8847c25ef7a2aed37702b6c0.jpg'),
('PRD007', 'Jaket Bomber Dreambirds', 'Jaket', 190000, 0, 19, 500, '', '795338ce159da78cc55977005537061a.jpg'),
('PRD008', 'Jaket Bomber Warehouse Hitam', 'Jaket', 180000, 0, 17, 500, NULL, '0c452a2a72bfe2514bd9d7ace8f6a77a.jpg'),
('PRD009', 'Sweater Single Stone', 'Sweater', 160000, 0, 14, 400, NULL, '9b4e07c633f97054532ecd8288ba1820.jpg'),
('PRD010', 'Jaket Hoodie Keeping Promise Hitam', 'Jaket', 170000, 0, 16, 400, NULL, '5154ca2a646e0e771711ff327e3f63ca.jpg'),
('PRD011', 'Kaus Garis Kuning Hitam', 'Kaus', 90000, 10, 65, 250, 'Cotton 30s', 'prd-1585127477.jpg'),
('PRD012', 'Kemeja Hitam Lengan Panjang', 'Kemeja', 120000, 0, 45, 200, 'dengan bahan kain yang nyaman untuk setiap kegiatan anda', 'prd-1584967402.jpg'),
('PRD013', 'Loose Jeans Biru Muda', 'Celana', 155000, 0, 55, 350, 'Celana jeans longgar, nyaman untuk segala aktifitas anda', 'prd-1585154936.jpg'),
('PRD014', 'Kemeja Abu Polos Lengan Panjang', 'Kemeja', 120000, 0, 42, 200, 'Dengan bahan kain yang nyaman untuk setiap kegiatan anda', 'prd-1585155380.jpg'),
('PRD015', 'Kaus Jepang Putih', 'Kaus', 90000, 0, 46, 200, 'Cotton 30s', 'prd-1587228380.jpg');

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
(30, 'S', 10, 'PRD012'),
(31, 'M', 10, 'PRD012'),
(32, 'L', 15, 'PRD012'),
(33, 'XL', 10, 'PRD012'),
(51, 'S', 15, 'PRD011'),
(52, 'M', 20, 'PRD011'),
(53, 'L', 20, 'PRD011'),
(54, 'XL', 10, 'PRD011'),
(60, '29', 12, 'PRD013'),
(61, '30', 15, 'PRD013'),
(62, '31', 10, 'PRD013'),
(63, '32', 8, 'PRD013'),
(64, '33', 10, 'PRD013'),
(65, 'S', 5, 'PRD014'),
(66, 'M', 14, 'PRD014'),
(67, 'L', 17, 'PRD014'),
(68, 'XL', 6, 'PRD014'),
(69, 'XXL', 0, 'PRD014'),
(70, 'S', 12, 'PRD015'),
(71, 'M', 10, 'PRD015'),
(72, 'L', 18, 'PRD015'),
(73, 'XL', 6, 'PRD015');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_buktitransfer`
--
ALTER TABLE `tbl_buktitransfer`
  ADD PRIMARY KEY (`id_transfer`);

--
-- Indeks untuk tabel `tbl_datapenerima`
--
ALTER TABLE `tbl_datapenerima`
  ADD PRIMARY KEY (`id_datapenerima`);

--
-- Indeks untuk tabel `tbl_datapengiriman`
--
ALTER TABLE `tbl_datapengiriman`
  ADD PRIMARY KEY (`id_pengiriman`);

--
-- Indeks untuk tabel `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indeks untuk tabel `tbl_keranjangdetail`
--
ALTER TABLE `tbl_keranjangdetail`
  ADD PRIMARY KEY (`id_krjdt`);

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
  ADD PRIMARY KEY (`no_penjualan`);

--
-- Indeks untuk tabel `tbl_penjualandetail`
--
ALTER TABLE `tbl_penjualandetail`
  ADD PRIMARY KEY (`no_pjl_detail`);

--
-- Indeks untuk tabel `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_prd`);

--
-- Indeks untuk tabel `tbl_ukuranprd`
--
ALTER TABLE `tbl_ukuranprd`
  ADD PRIMARY KEY (`id_ukuran`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_buktitransfer`
--
ALTER TABLE `tbl_buktitransfer`
  MODIFY `id_transfer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_datapenerima`
--
ALTER TABLE `tbl_datapenerima`
  MODIFY `id_datapenerima` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tbl_datapengiriman`
--
ALTER TABLE `tbl_datapengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_keranjangdetail`
--
ALTER TABLE `tbl_keranjangdetail`
  MODIFY `id_krjdt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `tbl_penjualandetail`
--
ALTER TABLE `tbl_penjualandetail`
  MODIFY `no_pjl_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tbl_ukuranprd`
--
ALTER TABLE `tbl_ukuranprd`
  MODIFY `id_ukuran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
