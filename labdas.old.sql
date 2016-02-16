-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2015 at 07:02 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `labdas`
--

-- --------------------------------------------------------

--
-- Table structure for table `asisten`
--

CREATE TABLE IF NOT EXISTS `asisten` (
  `id_asisten` varchar(16) NOT NULL,
  `nama_asisten` varchar(256) NOT NULL,
  PRIMARY KEY (`id_asisten`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asisten`
--

INSERT INTO `asisten` (`id_asisten`, `nama_asisten`) VALUES
('as.11.12.12', 'Romi Rafael'),
('as.11.12.15', 'Wayan Huruk'),
('as12.1.3.22', 'Jon Kinawa');

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE IF NOT EXISTS `fakultas` (
  `id_fakultas` varchar(16) NOT NULL,
  `nama_fakultas` varchar(64) NOT NULL,
  PRIMARY KEY (`id_fakultas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id_fakultas`, `nama_fakultas`) VALUES
('f1', 'Fakultas Teknologi Informasi'),
('f10', 'Fakultas Kesehatan Masyarakat'),
('f11', 'Fakultas Kedokteran Gigi'),
('f2', 'Fakultas Pertanian'),
('f3', 'Fakultas Kedokteran'),
('f4', 'Fakultas Mipa'),
('f5', 'Fakultas Peternakan'),
('f6', 'Fakultas Teknik'),
('f7', 'Fakultas Farmasi'),
('f8', 'Fakultas Teknologi Pertanian'),
('f9', 'Fakultas Keperawatan');

-- --------------------------------------------------------

--
-- Table structure for table `hari`
--

CREATE TABLE IF NOT EXISTS `hari` (
  `id_hari` varchar(16) NOT NULL,
  `nama_hari` varchar(8) NOT NULL,
  PRIMARY KEY (`id_hari`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hari`
--

INSERT INTO `hari` (`id_hari`, `nama_hari`) VALUES
('h1', 'senin'),
('h2', 'selasa'),
('h3', 'rabu'),
('h4', 'kamis'),
('h5', 'jumat');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE IF NOT EXISTS `jadwal` (
  `id_jadwal` varchar(16) NOT NULL,
  `id_shift` varchar(16) NOT NULL,
  `id_hari` varchar(16) NOT NULL,
  PRIMARY KEY (`id_jadwal`),
  UNIQUE KEY `id_shift` (`id_shift`,`id_hari`),
  KEY `id_shift_2` (`id_shift`),
  KEY `id_hari` (`id_hari`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_shift`, `id_hari`) VALUES
('jad1', 's1', 'h1'),
('jad5', 's1', 'h2'),
('jad9', 's1', 'h3'),
('jad13', 's1', 'h4'),
('jad17', 's1', 'h5'),
('jad2', 's2', 'h1'),
('jad6', 's2', 'h2'),
('jad10', 's2', 'h3'),
('jad14', 's2', 'h4'),
('jad18', 's2', 'h5'),
('jad3', 's3', 'h1'),
('jad7', 's3', 'h2'),
('jad11', 's3', 'h3'),
('jad15', 's3', 'h4'),
('jad19', 's3', 'h5'),
('jad4', 's4', 'h1'),
('jad8', 's4', 'h2'),
('jad12', 's4', 'h3'),
('jad16', 's4', 'h4'),
('jad20', 's4', 'h5');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_praktikum`
--

CREATE TABLE IF NOT EXISTS `jadwal_praktikum` (
  `id_jad_prak` int(11) NOT NULL AUTO_INCREMENT,
  `id_prak` int(11) NOT NULL,
  `id_jadwal` varchar(16) NOT NULL,
  `kuota` int(11) NOT NULL,
  PRIMARY KEY (`id_jad_prak`),
  UNIQUE KEY `id_prak` (`id_prak`,`id_jadwal`),
  KEY `id_jadwal` (`id_jadwal`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `jadwal_praktikum`
--

INSERT INTO `jadwal_praktikum` (`id_jad_prak`, `id_prak`, `id_jadwal`, `kuota`) VALUES
(1, 1, 'jad1', 19),
(4, 1, 'jad3', 40),
(5, 1, 'jad5', 40),
(9, 1, 'jad4', 39),
(10, 3, 'jad1', 40),
(11, 3, 'jad2', 40),
(12, 3, 'jad9', 40),
(13, 1, 'jad8', 50);

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE IF NOT EXISTS `jurusan` (
  `id_jurusan` varchar(16) NOT NULL,
  `nama_jurusan` varchar(64) NOT NULL,
  `id_fakultas` varchar(16) NOT NULL,
  PRIMARY KEY (`id_jurusan`),
  KEY `fakultas_jurusan_fk` (`id_fakultas`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`, `id_fakultas`) VALUES
('j1', 'Sistem Informasi', 'f1'),
('j10', 'Peternakan', 'f5'),
('j11', 'Teknik Elektro', 'f6'),
('j12', 'Teknik Mesin', 'f6'),
('j13', 'Teknik Industri', 'f6'),
('j14', 'Teknik Sipil', 'f6'),
('j15', 'Teknik Lingkungan', 'f6'),
('j16', 'Farmasi', 'f7'),
('j17', 'Teknnologi Pertanian', 'f8'),
('j19', 'Keperawatan', 'f9'),
('j2', 'Sistem Komputer', 'f1'),
('j20', 'Kesehatan Masyarakat', 'f10'),
('j21', 'Kedokteran Gigi', 'f11'),
('j3', 'Pertanian', 'f2'),
('j4', 'Pendidikan Dokter', 'f3'),
('j5', 'Psikologi', 'f3'),
('j6', 'Matematika', 'f4'),
('j7', 'Biologi', 'f4'),
('j8', 'Fisika', 'f4'),
('j9', 'Kimia', 'f4');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `nim` int(11) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `id_jurusan` varchar(16) NOT NULL,
  PRIMARY KEY (`nim`),
  KEY `jurusan_mahasiswa_fk` (`id_jurusan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `id_jurusan`) VALUES
(1110962001, 'Antah sia', 'j1'),
(1110962009, 'Rahmat Nur Fajri', 'j1'),
(1110963020, 'ravi', 'j1'),
(1110963021, 'ndak tahu', 'j1'),
(1210961000, 'Hantu', 'j1'),
(1210961001, 'Audiah Duhani', 'j1'),
(1210961002, 'Rafiqro Setiawan', 'j1'),
(1210961003, 'Hafid Yoza Putra', 'j1'),
(1210961004, 'Afif Aulia', 'j1'),
(1210961005, 'Isra Wilna', 'j1'),
(1210961006, 'Asiska jeni', 'j1'),
(1210961007, 'Rulli Rhamananda', 'j1'),
(1210961008, 'Gembel ', 'j1'),
(1210961009, 'Tatan', 'j1'),
(1210961010, 'Kinikuman', 'j1'),
(1210961011, 'Swayper', 'j1'),
(1210961012, 'Kokkuri san', 'j1'),
(1210961013, 'Terlala', 'j1'),
(1210961014, 'Terlili', 'j1'),
(1210961015, 'Annisa', 'j1'),
(1210962001, 'Modi Lomura', 'j1'),
(1210962008, 'Ade Hijrianti', 'j1'),
(1210962009, 'Ryan Syahputera', 'j1'),
(1210962011, 'Defi', 'j1'),
(1210962012, 'Aisyatul Lathifah', 'j1'),
(1210962013, 'Fajri Rizky', 'j1'),
(1210962023, 'Parfi Sepriandra', 'j1'),
(1210963007, 'Vionita Varisa', 'j1'),
(1210964000, 'hahaha', 'j1'),
(1810931003, 'Andre Haryadi', 'j13');

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE IF NOT EXISTS `mata_kuliah` (
  `id_mk` varchar(16) NOT NULL,
  `nama_mk` varchar(64) NOT NULL,
  PRIMARY KEY (`id_mk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mata_kuliah`
--

INSERT INTO `mata_kuliah` (`id_mk`, `nama_mk`) VALUES
('p1', 'Fisika Dasar 1'),
('p2', 'Fisika Dasar 2');

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE IF NOT EXISTS `modul` (
  `id_modul` varchar(16) NOT NULL,
  `judul_modul` varchar(64) NOT NULL,
  `id_mk` varchar(16) NOT NULL,
  `no_modul` int(11) NOT NULL,
  `file` varchar(256) NOT NULL,
  PRIMARY KEY (`id_modul`),
  UNIQUE KEY `id_prak` (`id_mk`,`no_modul`),
  KEY `praktikum_modul_fk` (`id_mk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id_modul`, `judul_modul`, `id_mk`, `no_modul`, `file`) VALUES
('mod1-1', 'Gaya', 'p1', 1, 'file/20150607lasjfdla1916571-s2.0-S1877042813050702-main.pdf'),
('mod1-2', 'Belajar fisika dasar modul 1', 'p2', 1, 'file/p2-mod1-2-20150609-234956logo01.pdf'),
('mod2-1', 'Manggaya', 'p1', 2, ''),
('mod2-2', 'sdsdsfssfsfsfsf', 'p2', 2, ''),
('mod3-1', 'Usah Banyak Gaya', 'p1', 3, 'file/20150608lasjfdla202442NORMALISASI.pdf'),
('mod3-2', 'sdsdsfsfsfsfsf', 'p2', 3, ''),
('mod4-1', 'sgrrgegerg', 'p1', 4, 'file/p1-mod4-1-20150609-145851bios-hp.pdf'),
('mod4-2', 'sdsdaasassfsfsf', 'p2', 4, ''),
('mod5-1', 'rgegergegegeg', 'p1', 5, ''),
('mod5-2', 'afsadasdasd', 'p2', 5, ''),
('mod6-1', 'pengukuran', 'p1', 6, 'file/p1-m1-20150613-1337152015.06.11 Revisi Info Kuliah Pembekalan KKN-2015 (Minangkabau Corner - BPKP ).pdf');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE IF NOT EXISTS `nilai` (
  `id_nilai` int(16) NOT NULL,
  `id_modul` varchar(16) NOT NULL,
  `id_praktikan` int(11) NOT NULL,
  `nilai_lap_awal` int(11) NOT NULL,
  `nilai_prak` int(11) NOT NULL,
  `nilai_laporan` int(11) NOT NULL,
  PRIMARY KEY (`id_nilai`),
  KEY `modul_nilai_fk` (`id_modul`),
  KEY `id_praktikan` (`id_praktikan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `id_modul`, `id_praktikan`, `nilai_lap_awal`, `nilai_prak`, `nilai_laporan`) VALUES
(1, 'mod1-1', 1, 0, 100, 100),
(2, 'mod1-1', 2, 100, 100, 100),
(3, 'mod1-1', 3, 100, 100, 100),
(4, 'mod1-1', 4, 100, 100, 100),
(5, 'mod1-1', 5, 100, 100, 99),
(6, 'mod1-1', 6, 99, 99, 99),
(10, 'mod1-1', 10, 100, 75, 50),
(11, 'mod1-1', 11, 66, 66, 100),
(12, 'mod1-1', 12, 77, 77, 77),
(13, 'mod1-1', 13, 88, 88, 88),
(14, 'mod1-1', 14, 88, 88, 88),
(15, 'mod1-1', 15, 100, 100, 100),
(19, 'mod1-1', 19, 100, 100, 100),
(20, 'mod1-1', 20, 100, 100, 100),
(21, 'mod1-1', 21, 100, 100, 100),
(22, 'mod1-1', 16, 12, 13, 14),
(23, 'mod1-1', 9, 99, 90, 80),
(24, 'mod1-1', 22, 12, 13, 14),
(25, 'mod2-1', 23, 99, 76, 88),
(26, 'mod1-1', 23, 100, 20, 100),
(27, 'mod1-2', 26, 12, 13, 14),
(28, 'mod2-1', 22, 80, 80, 80);

-- --------------------------------------------------------

--
-- Table structure for table `pengawas`
--

CREATE TABLE IF NOT EXISTS `pengawas` (
  `id_pengawas` int(11) NOT NULL AUTO_INCREMENT,
  `id_jad_prak` int(11) NOT NULL,
  `id_asisten` varchar(16) NOT NULL,
  PRIMARY KEY (`id_pengawas`),
  UNIQUE KEY `id_jad_prak_2` (`id_jad_prak`,`id_asisten`),
  KEY `asisten_pengawas_praktikum_fk` (`id_asisten`),
  KEY `id_jad_prak` (`id_jad_prak`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pengawas`
--

INSERT INTO `pengawas` (`id_pengawas`, `id_jad_prak`, `id_asisten`) VALUES
(1, 1, 'as.11.12.12'),
(2, 1, 'as.11.12.15'),
(3, 1, 'as12.1.3.22');

-- --------------------------------------------------------

--
-- Table structure for table `praktikan`
--

CREATE TABLE IF NOT EXISTS `praktikan` (
  `id_praktikan` int(11) NOT NULL AUTO_INCREMENT,
  `id_jad_prak` int(11) NOT NULL,
  `id_prak` int(11) NOT NULL,
  `nim` int(11) NOT NULL,
  `krs` varchar(128) NOT NULL,
  `status_pr` int(11) NOT NULL,
  PRIMARY KEY (`id_praktikan`),
  UNIQUE KEY `id_jad_prak` (`id_jad_prak`,`nim`),
  UNIQUE KEY `id_jad_prak_3` (`id_jad_prak`,`nim`),
  UNIQUE KEY `id_prak` (`id_prak`,`nim`),
  KEY `nim` (`nim`),
  KEY `id_jad_prak_2` (`id_jad_prak`),
  KEY `id_prak_2` (`id_prak`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `praktikan`
--

INSERT INTO `praktikan` (`id_praktikan`, `id_jad_prak`, `id_prak`, `nim`, `krs`, `status_pr`) VALUES
(1, 1, 1, 1210962001, '', 1),
(2, 1, 1, 1210962009, '', 1),
(3, 9, 1, 1210962011, '', 1),
(4, 1, 1, 1210962012, '', 1),
(5, 1, 1, 1210962013, '', 1),
(6, 1, 1, 1210962008, '', 1),
(7, 1, 1, 1210961001, '', 1),
(8, 1, 1, 1210961002, '', 1),
(9, 1, 1, 1210961003, '', 1),
(10, 1, 1, 1210961004, '', 1),
(11, 1, 1, 1210961005, '', 1),
(12, 1, 1, 1210961006, '', 1),
(13, 1, 1, 1210961007, '', 1),
(14, 1, 1, 1210961008, '', 1),
(15, 1, 1, 1210961009, '', 1),
(16, 1, 1, 1210961010, '', 1),
(17, 1, 1, 1210961011, '', 1),
(18, 1, 1, 1210961012, '', 1),
(19, 1, 1, 1210961013, '', 1),
(20, 1, 1, 1210961014, '', 1),
(21, 1, 1, 1210961015, '', 1),
(22, 1, 1, 1210961000, '', 1),
(23, 1, 1, 1110962009, 'uploads/2334 (1).jpg', 1),
(24, 11, 3, 1210963007, '', 1),
(26, 11, 3, 1110962009, '', 1),
(27, 5, 1, 1110963020, 'uploads/age6.jpg', 0),
(29, 1, 1, 1210964000, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `praktikum`
--

CREATE TABLE IF NOT EXISTS `praktikum` (
  `id_prak` int(11) NOT NULL AUTO_INCREMENT,
  `id_mk` varchar(16) NOT NULL,
  `semester` int(11) NOT NULL,
  `tahun_ajaran` varchar(16) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id_prak`),
  UNIQUE KEY `id_prak` (`id_mk`,`semester`,`tahun_ajaran`),
  KEY `tahun_ajaran` (`tahun_ajaran`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `praktikum`
--

INSERT INTO `praktikum` (`id_prak`, `id_mk`, `semester`, `tahun_ajaran`, `status`) VALUES
(1, 'p1', 2, '2014 - 2015', 1),
(3, 'p2', 2, '2014 - 2015', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE IF NOT EXISTS `shift` (
  `id_shift` varchar(16) NOT NULL,
  `ket_shift` varchar(32) NOT NULL,
  PRIMARY KEY (`id_shift`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`id_shift`, `ket_shift`) VALUES
('s1', '08.00 - 10.00'),
('s2', '10.10 - 12.10'),
('s3', '13.00 - 15.00'),
('s4', '15.10 - 17.10');

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajaran`
--

CREATE TABLE IF NOT EXISTS `tahun_ajaran` (
  `tahun_ajaran` varchar(16) NOT NULL,
  PRIMARY KEY (`tahun_ajaran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tahun_ajaran`
--

INSERT INTO `tahun_ajaran` (`tahun_ajaran`) VALUES
('2014 - 2015'),
('2015 - 2016'),
('2016 - 2017'),
('2017 - 2018'),
('2018 - 2019'),
('2019 - 2020'),
('2020 - 2021');

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE IF NOT EXISTS `userlogin` (
  `username` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `akses` int(11) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`username`, `password`, `akses`, `last_login`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 1, '2015-06-13 16:20:13'),
('asisten', 'bf3fd5c967c0fb904bf15c054e4288dd', 2, '2015-06-13 11:54:52'),
('dosen', 'ce28eed1511f631af6b2a7bb0a85d636', 3, '2015-06-13 08:40:49'),
('jon', 'e807f1fcf82d132f9bb018ca6738a19f', 2, '2015-06-10 08:10:34'),
('korum', '81dc9bdb52d04dc20036dbd8313ed055', 2, '2015-06-12 09:03:31'),
('ryan', '10c7ccc7a4f0aff03c915c485565b9da', 2, '2015-06-13 16:00:53');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`id_shift`) REFERENCES `shift` (`id_shift`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`id_hari`) REFERENCES `hari` (`id_hari`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `jadwal_praktikum`
--
ALTER TABLE `jadwal_praktikum`
  ADD CONSTRAINT `jadwal_praktikum_ibfk_1` FOREIGN KEY (`id_prak`) REFERENCES `praktikum` (`id_prak`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `jadwal_praktikum_ibfk_2` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id_jadwal`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD CONSTRAINT `fakultas_jurusan_fk` FOREIGN KEY (`id_fakultas`) REFERENCES `fakultas` (`id_fakultas`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `jurusan_mahasiswa_fk` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusan` (`id_jurusan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `modul`
--
ALTER TABLE `modul`
  ADD CONSTRAINT `modul_ibfk_1` FOREIGN KEY (`id_mk`) REFERENCES `mata_kuliah` (`id_mk`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `modul_nilai_fk` FOREIGN KEY (`id_modul`) REFERENCES `modul` (`id_modul`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_praktikan`) REFERENCES `praktikan` (`id_praktikan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pengawas`
--
ALTER TABLE `pengawas`
  ADD CONSTRAINT `asisten_pengawas_praktikum_fk` FOREIGN KEY (`id_asisten`) REFERENCES `asisten` (`id_asisten`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pengawas_ibfk_1` FOREIGN KEY (`id_jad_prak`) REFERENCES `jadwal_praktikum` (`id_jad_prak`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `praktikan`
--
ALTER TABLE `praktikan`
  ADD CONSTRAINT `praktikan_ibfk_6` FOREIGN KEY (`id_prak`) REFERENCES `praktikum` (`id_prak`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `praktikan_ibfk_2` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `praktikan_ibfk_4` FOREIGN KEY (`id_jad_prak`) REFERENCES `jadwal_praktikum` (`id_jad_prak`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `praktikum`
--
ALTER TABLE `praktikum`
  ADD CONSTRAINT `praktikum_ibfk_1` FOREIGN KEY (`id_mk`) REFERENCES `mata_kuliah` (`id_mk`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `praktikum_ibfk_2` FOREIGN KEY (`tahun_ajaran`) REFERENCES `tahun_ajaran` (`tahun_ajaran`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
