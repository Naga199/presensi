-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jul 2022 pada 18.02
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `presensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kota`
--

CREATE TABLE `kota` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kota`
--

INSERT INTO `kota` (`id`, `nama`) VALUES
(1, 'Majalengka'),
(3, 'Wonogiri'),
(4, 'Indramayu'),
(17, 'Jakarta'),
(21, 'Padang'),
(22, 'Bantul'),
(23, 'Bandung');

-- --------------------------------------------------------

--
-- Struktur dari tabel `posisi`
--

CREATE TABLE `posisi` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `posisi`
--

INSERT INTO `posisi` (`id`, `nama`) VALUES
(1, 'Pend.Bahasa Indonesia'),
(2, 'Pend.Akuntansi'),
(3, 'Pend.Matematika'),
(4, 'Pend.Kewirausahaan'),
(5, 'Pend.Bahasa Inggris'),
(6, 'Pend.TIK'),
(7, 'Pend.Sejarah'),
(8, 'Pend.Agama Islam'),
(9, 'Pend.Bahasa Jepang'),
(10, 'BK');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `username_admin` varchar(30) NOT NULL,
  `password_admin` varchar(128) NOT NULL,
  `nama_admin` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `username_admin`, `password_admin`, `nama_admin`) VALUES
(1, 'admin', 'f5bb0c8de146c67b44babbf4e6584cc0', 'Administrator'),
(5, 'kepsek', 'f5bb0c8de146c67b44babbf4e6584cc0', 'Kepala Sekolah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_guru`
--

CREATE TABLE `tbl_guru` (
  `id_guru` int(11) NOT NULL,
  `nama_guru` varchar(64) NOT NULL,
  `nuptk_guru` varchar(32) NOT NULL,
  `ptk_guru` smallint(8) DEFAULT NULL,
  `kode_guru` varchar(16) DEFAULT NULL,
  `jk_guru` tinyint(1) DEFAULT NULL,
  `ttl_guru` date DEFAULT NULL,
  `asal_kota` int(8) DEFAULT NULL,
  `telp_guru` varchar(16) DEFAULT NULL,
  `email_guru` varchar(128) DEFAULT NULL,
  `statuskepegawaian_guru` varchar(32) DEFAULT NULL,
  `alamat_guru` varchar(128) DEFAULT NULL,
  `password_guru` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_guru`
--

INSERT INTO `tbl_guru` (`id_guru`, `nama_guru`, `nuptk_guru`, `ptk_guru`, `kode_guru`, `jk_guru`, `ttl_guru`, `asal_kota`, `telp_guru`, `email_guru`, `statuskepegawaian_guru`, `alamat_guru`, `password_guru`) VALUES
(1, 'Anni Hapsah', '5840760664300000', 1, '2206280506505044', 2, '1982-05-08', 17, '08128770626202', 'timothyasha@yahoo.com', 'gty/pty', 'P. KOMARUDIN RT10/RW5 Kel.Pulo Gebang Kec.Cakung (13950)', 'f5bb0c8de146c67b44babbf4e6584cc0'),
(2, 'Bashir Rahadi', '8640764665110052', 2, '2206280506333363', 1, '1986-03-08', 17, '085711374350', 'bashirjingjet86@gmail.com', 'gty/pty', 'Jl. Pisangan Lama III No. 33 RT5/RW11 Kel.Pisangan Timur, Kec.Pulo Gadung (13230)', 'f5bb0c8de146c67b44babbf4e6584cc0'),
(3, 'Caya Hendra Arif Mulyanto', '1336741644200005', 2, '2206280506434386', 1, '1963-04-30', 1, '081296968763', 'caya1963hendra@gmail.com', 'gty/pty', 'Kp. Kapuk III RT11/RW5 Kel.Klender, Kec. Duren Sawit (13470)', 'f5bb0c8de146c67b44babbf4e6584cc0'),
(4, 'Edi Suhendro', '7349772673130013', 3, '2206280506565619', 1, '1994-10-17', 3, '089604568776', 'suhendroedi12@yahoo.com', 'gty/pty', 'Bekasi Timur Regency 7, Gerbera G7/ 60 RT3/RW30 Kel.Burangkeng, Kec.Setu(17320)', 'f5bb0c8de146c67b44babbf4e6584cc0'),
(5, 'Hartono', '4442746648200063', 1, '2206280506404010', 1, '1968-11-10', 17, '00', 'drshartonohartono@gmail.com', 'honorer', 'Jl Cipinang Muara 1 RT16/RW03 Kel.Pondok Bambu, Kec. Duren Sawit (13430)', 'f5bb0c8de146c67b44babbf4e6584cc0'),
(6, 'Lia Firaya', '5251757659300043', 4, '2206280506484811', 2, '1979-09-19', 17, '081299004511', 'liafiraya09@gmail.com', 'gty/pty', 'JL. H.MIRAN RT9/RW2 Kel.PONDOK KOPI, Kec.Duren Sawit (13460)', 'f5bb0c8de146c67b44babbf4e6584cc0'),
(7, 'Muhammad Kosim Bayu Widiatmoko', '6953755656200012', 5, '2206280506242414', 1, '1977-06-21', 17, '08988080421', 'dmyan9el@gmail.com', 'gty/pty', 'Jl. Kp. Rawadas RT4/RW3 Kel.Pondok Kopi, Kec.Duren Sawit (13460)', 'f5bb0c8de146c67b44babbf4e6584cc0'),
(8, 'Mukhsonah', '1941739639300003', 1, '2206280606171717', 1, '1961-09-06', 4, '081510227934', 'mukhsonah1961@gmail.com', 'gty/pty', 'Komplek Puskopad Blok C No. 4 RT6/RW17 Kel.Jaka Sampurna, Kec.Bekasi Barat (17145)', 'f5bb0c8de146c67b44babbf4e6584cc0'),
(9, 'Octavianis', '2742748650200002', 6, '2206280606373716', 1, '1970-10-04', 21, '081384143555', 'octaf_2010@yahoo.co.id', 'gty/pty', 'JL. KH MAISIN NO. 19 RT6/RW7 Kel.Klender, Kec.Duren Sawit (13470)', 'f5bb0c8de146c67b44babbf4e6584cc0'),
(10, 'Paryda', '00', 2, '2206280606353579', 2, '1992-09-26', 17, '087783116427', 'paryda.uranaiko@gmail.com', 'honorer', 'KP. PENGGILINGAN RT4/RW6 Kel.PENGGILINGAN, Kec.Cakung (13940)', 'f5bb0c8de146c67b44babbf4e6584cc0'),
(11, 'R. Tuti Setiawati', '9448738639300032', 7, '2206280606111116', 2, '1960-01-16', 17, '085280457962', 'bayu.hasyim@yahoo.com', 'gty/pty', 'Kampung Baru Klender RT11/RW1 Kel.Jatinegara, Kec.Cakung (13930)', 'f5bb0c8de146c67b44babbf4e6584cc0'),
(12, 'TASSYA RATNA SARI', '00', 9, '2206280606171712', 2, '1992-01-28', 17, '00', 'tassyartnsr@gmail.com', 'tenaga', 'Jl. S. KAMPAR V No. 497 Kel.SEMPER BARAT, Kec. Cilincing (14130)', 'f5bb0c8de146c67b44babbf4e6584cc0'),
(13, 'Titik  Suryani', '0134747648130103', 2, '2206280606090970', 2, '1969-02-08', 22, '0817180862', 'tika_su40@yahoo.com', 'honorer', 'Jl. Kedasih IX No. 33 Blok E-1 Kel.Mekar  Mukti, Kec.Cikarang Utara (17530)', 'f5bb0c8de146c67b44babbf4e6584cc0'),
(14, 'Tutut Suryawati', '1436746647300002', 5, '2206280606353518', 2, '1968-04-01', 17, '085212873338', 'tututsuryawati@gmail.com', 'gty/pty', 'JL. h. Maisin n0 13 bulak klender RT4/RW16 Kel.Klender, Kec.Duren Sawit (13470)', 'f5bb0c8de146c67b44babbf4e6584cc0'),
(15, 'Yuli Astuti', '1739740642300003', 8, '2206280606444412', 2, '1962-07-14', 17, '087885802356', 'yuli1962astuti@gmail.com', 'gty/pty', 'Kp. Bulak No. 39 RT9/RW7 Kel.Klender, Kec.Duren Sawit (13470)', 'f5bb0c8de146c67b44babbf4e6584cc0'),
(16, 'Yusuf Maulana', '00', 10, '2206280606494912', 1, '1977-02-22', 23, '089698887137', 'yusufmaulanap@yahoo.com', 'gty/pty', 'Jl. Saleh Abud RT14/RW8 Kel.Jatinegara, Kec.Jatinegara (13310)', 'f5bb0c8de146c67b44babbf4e6584cc0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_izinkerja`
--

CREATE TABLE `tbl_izinkerja` (
  `id_izin` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `type_izin` varchar(16) NOT NULL,
  `tgl_izin_awal` date DEFAULT NULL,
  `tgl_izin_akhir` date DEFAULT NULL,
  `keterangan` varchar(128) DEFAULT NULL,
  `status` varchar(16) DEFAULT NULL,
  `tgl_diproses` datetime DEFAULT NULL,
  `catatan` varchar(64) DEFAULT NULL,
  `pemroses` int(11) DEFAULT NULL,
  `tgl_dibuat` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_izinkerja`
--

INSERT INTO `tbl_izinkerja` (`id_izin`, `id_guru`, `type_izin`, `tgl_izin_awal`, `tgl_izin_akhir`, `keterangan`, `status`, `tgl_diproses`, `catatan`, `pemroses`, `tgl_dibuat`) VALUES
(1, 1, 'Sakit', '2022-07-01', '2022-07-02', 'acara keluarga', 'Disetujui', '2022-07-02 20:26:33', NULL, 1, '2022-07-02 20:24:29'),
(2, 2, 'Izin', '2022-07-01', '2022-07-02', 'ke rs', 'Disetujui', '2022-07-04 20:43:05', NULL, 1, '2022-07-04 20:36:59'),
(3, 6, 'Izin', '2022-06-04', '2022-06-06', 'Cek Up ke rumah sakit', 'Ditolak', '2022-07-04 20:47:22', NULL, 1, '2022-07-04 20:46:26'),
(4, 1, 'Izin', '2022-07-14', '2022-07-15', 'cek up kedua ke rs', 'Ditolak', '2022-07-14 09:05:01', NULL, 1, '2022-07-14 09:04:42'),
(5, 2, 'Sakit', '2022-07-14', '2022-07-16', 'diharuskan istirahat', 'Disetujui', '2022-07-14 09:08:57', NULL, 1, '2022-07-14 09:08:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_presensi`
--

CREATE TABLE `tbl_presensi` (
  `id_presensi` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `date` date NOT NULL,
  `masuk_guru` varchar(32) DEFAULT NULL,
  `pulang_guru` varchar(32) DEFAULT NULL,
  `image_masuk_guru` varchar(128) DEFAULT NULL,
  `image_pulang_guru` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_presensi`
--

INSERT INTO `tbl_presensi` (`id_presensi`, `id_guru`, `date`, `masuk_guru`, `pulang_guru`, `image_masuk_guru`, `image_pulang_guru`) VALUES
(1, 1, '2022-07-01', '2022-07-01 22:07:25', '2022-07-01 22:11:31', NULL, NULL),
(2, 1, '2022-07-02', '2022-07-02 20:16:59', '2022-07-02 20:19:02', NULL, NULL),
(3, 1, '2022-07-03', '2022-07-03 22:25:07', NULL, NULL, NULL),
(4, 2, '2022-07-04', '2022-07-04 20:42:33', NULL, NULL, NULL),
(5, 2, '2022-07-05', '2022-07-05 20:42:33', NULL, NULL, NULL),
(6, 1, '2022-07-04', NULL, '2022-07-04 23:51:02', NULL, NULL),
(7, 2, '2022-07-07', '2022-07-07 09:39:59', NULL, NULL, NULL),
(8, 1, '2022-07-14', '2022-07-14 08:58:57', '2022-07-14 12:17:10', 'upload/pic_20220714085200.jpeg', 'upload/pic_20220714002700.jpeg'),
(9, 2, '2022-07-14', '2022-07-14 09:12:27', '2022-07-14 09:12:53', 'upload/pic_20220714091017.jpeg', 'upload/pic_20220714091243.jpeg'),
(10, 2, '2022-07-15', '2022-07-15 04:51:23', '2022-07-15 08:31:03', 'upload/pic_20220715045108.jpeg', 'upload/pic_20220715083101.jpeg'),
(11, 1, '2022-07-15', '2022-07-15 04:56:34', NULL, NULL, NULL),
(12, 5, '2022-07-15', '2022-07-15 04:54:47', NULL, NULL, NULL),
(13, 13, '2022-07-15', '2022-07-15 08:36:17', '2022-07-15 08:38:29', 'upload/pic_20220715083615.jpeg', 'upload/pic_20220715083828.jpeg'),
(14, 9, '2022-07-15', '2022-07-15 09:04:19', NULL, 'upload/pic_20220715090235.jpeg', NULL),
(15, 6, '2022-07-15', '2022-07-15 09:36:13', '2022-07-15 09:37:34', 'upload/pic_20220715093605.jpeg', 'upload/pic_20220715093732.jpeg'),
(16, 4, '2022-07-15', '2022-07-15 12:24:23', '2022-07-15 11:01:49', 'upload/pic_20220715105637.jpeg', 'upload/pic_20220715110131.jpeg'),
(17, 2, '2022-07-17', '2022-07-17 08:08:40', NULL, NULL, NULL),
(18, 2, '2022-07-17', '2022-07-17 08:08:40', NULL, NULL, NULL),
(19, 15, '2022-07-17', '2022-07-17 08:16:46', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_qrcode`
--

CREATE TABLE `tbl_qrcode` (
  `kode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `posisi`
--
ALTER TABLE `posisi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tbl_guru`
--
ALTER TABLE `tbl_guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indeks untuk tabel `tbl_izinkerja`
--
ALTER TABLE `tbl_izinkerja`
  ADD PRIMARY KEY (`id_izin`);

--
-- Indeks untuk tabel `tbl_presensi`
--
ALTER TABLE `tbl_presensi`
  ADD PRIMARY KEY (`id_presensi`);

--
-- Indeks untuk tabel `tbl_qrcode`
--
ALTER TABLE `tbl_qrcode`
  ADD PRIMARY KEY (`kode`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kota`
--
ALTER TABLE `kota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `posisi`
--
ALTER TABLE `posisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_guru`
--
ALTER TABLE `tbl_guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tbl_izinkerja`
--
ALTER TABLE `tbl_izinkerja`
  MODIFY `id_izin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_presensi`
--
ALTER TABLE `tbl_presensi`
  MODIFY `id_presensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `tbl_qrcode`
--
ALTER TABLE `tbl_qrcode`
  MODIFY `kode` int(5) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
