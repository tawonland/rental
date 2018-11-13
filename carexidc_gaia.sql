/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 100136
Source Host           : localhost:3306
Source Database       : carexidc_gaia

Target Server Type    : MYSQL
Target Server Version : 100136
File Encoding         : 65001

Date: 2018-11-13 07:12:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bouwherr
-- ----------------------------
DROP TABLE IF EXISTS `bouwherr`;
CREATE TABLE `bouwherr` (
  `idbouwherr` bigint(20) NOT NULL,
  `kode` varchar(50) NOT NULL DEFAULT '0',
  `nama` varchar(50) NOT NULL DEFAULT '0',
  `alamat` varchar(50) NOT NULL DEFAULT '0',
  `kota` varchar(60) NOT NULL,
  `kontak` varchar(50) NOT NULL DEFAULT '0',
  `file_logo` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='master pemilik pekerjaan';

-- ----------------------------
-- Records of bouwherr
-- ----------------------------
INSERT INTO `bouwherr` VALUES ('1', 'B0001', 'PT. Telkom Indonesia 12', 'Jl. Ketintang No 1 Surabaya', 'Surabaya', '-', '');
INSERT INTO `bouwherr` VALUES ('2', 'B0002', 'PT INDOSAT.TBK', 'JL KAYON', 'SURABAYA', '0', '0');
INSERT INTO `bouwherr` VALUES ('3', 'B0003', 'PT SMARTFREN', '-1', 'SURABAYA', '-', '');
INSERT INTO `bouwherr` VALUES ('4', 'E001', 'Excelcomindo', 'Jl Pemuda', 'Surabaya', '-', 'download.png');
INSERT INTO `bouwherr` VALUES ('5', 'H0001', 'H3I', '-', '-', '-', '0');

-- ----------------------------
-- Table structure for kategori_pekerjaan
-- ----------------------------
DROP TABLE IF EXISTS `kategori_pekerjaan`;
CREATE TABLE `kategori_pekerjaan` (
  `id1` bigint(20) NOT NULL,
  `ket` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='master';

-- ----------------------------
-- Records of kategori_pekerjaan
-- ----------------------------
INSERT INTO `kategori_pekerjaan` VALUES ('1', 'Strengthen');
INSERT INTO `kategori_pekerjaan` VALUES ('2', 'Grounding');
INSERT INTO `kategori_pekerjaan` VALUES ('3', 'Site Access');
INSERT INTO `kategori_pekerjaan` VALUES ('4', 'CME');
INSERT INTO `kategori_pekerjaan` VALUES ('5', 'Perijinan - Survey');

-- ----------------------------
-- Table structure for masterharga
-- ----------------------------
DROP TABLE IF EXISTS `masterharga`;
CREATE TABLE `masterharga` (
  `id1` bigint(20) NOT NULL,
  `material` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `uom` varchar(50) NOT NULL COMMENT 'satuan / unit of material',
  `hargasatuan` decimal(20,2) NOT NULL,
  `termasukppn` enum('Y','N') NOT NULL,
  `idbouwheer` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of masterharga
-- ----------------------------
INSERT INTO `masterharga` VALUES ('1', '4400000080', 'RETRIBUSI', 'PACKET', '1000000.00', 'N', '2');
INSERT INTO `masterharga` VALUES ('3', '1300000942', 'GROUNDING SYSTEM', 'EA', '0.00', 'Y', '2');
INSERT INTO `masterharga` VALUES ('4', '1111111', 'GROUND TEST', 'PACKET', '1200000.00', 'N', '0');
INSERT INTO `masterharga` VALUES ('6', '1300000943', 'grounding type A', 'PACKET', '1255001.00', 'Y', '5');
INSERT INTO `masterharga` VALUES ('7', '1111112', 'Grounding Corrective Maintenance', 'unit', '1000000.00', 'Y', '2');
INSERT INTO `masterharga` VALUES ('8', '1111113', 'Upgrrade PLN', 'unit', '1300000.00', 'Y', '2');
INSERT INTO `masterharga` VALUES ('9', '1300003978', 'Cooper bonded 5/8 LPCC584NC4 C5', 'UNT', '791755.00', 'N', '2');
INSERT INTO `masterharga` VALUES ('10', '1300002537', 'Bar Grounding Steel Galv300x100x10mm C5', 'UNT', '90000.00', 'N', '2');
INSERT INTO `masterharga` VALUES ('11', '1300004044', 'Copper Rod 5/8 C5', 'UNT', '648000.00', 'N', '2');
INSERT INTO `masterharga` VALUES ('12', '1300003186', 'Cable CBSC8 utk use Ground/Burial C5', 'M', '65549.00', 'N', '2');
INSERT INTO `masterharga` VALUES ('13', '1300005846', 'pipe PVC 3 C5', 'M', '68292.00', 'N', '2');
INSERT INTO `masterharga` VALUES ('14', '1300006946', 'Tee Connect CBSC8toCBSC8 150PLUSF20', 'P', '693704.00', 'N', '2');
INSERT INTO `masterharga` VALUES ('15', ' 1300002482', 'Bak kontrol baru C5', 'PC ', '324000.00', 'N', '2');
INSERT INTO `masterharga` VALUES ('16', '1300008112', 'Tutup Bak Kontrol C5', 'UNT', '108000.00', 'Y', '2');
INSERT INTO `masterharga` VALUES ('17', '1300007639', 'Gembok top security KEEP C5', 'PC', '291600.00', 'N', '2');
INSERT INTO `masterharga` VALUES ('18', '4100006802', 'Inst down conductor BC Wire 50 mm2 C5', 'M', '11880.00', 'N', '2');
INSERT INTO `masterharga` VALUES ('19', ' 4100007154', ' 4100007154', 'M3', '13500.00', 'N', '2');
INSERT INTO `masterharga` VALUES ('20', '4100007165', ' Inst grounding kaki tower+tutup cor C5', 'P', '43200.00', 'N', '2');
INSERT INTO `masterharga` VALUES ('21', '4100007198', 'Inst grounding connected KWH Meter C5', 'P', '27000.00', 'N', '2');
INSERT INTO `masterharga` VALUES ('22', '4100007220', 'Inst grounding to tiang lamp halaman C5', 'P', '27000.00', 'N', '2');
INSERT INTO `masterharga` VALUES ('23', '4100007264', 'Inst grounding bak kontrol complete C5', 'UNT', '54000.00', 'N', '2');
INSERT INTO `masterharga` VALUES ('24', '4100007385', 'Transport Barang ATP&Dok Grounding C5', 'LOT', '900000.00', 'N', '2');
INSERT INTO `masterharga` VALUES ('25', '4100007374', 'Survey&Doc Grounding C5', 'LOT', '900000.00', 'N', '2');
INSERT INTO `masterharga` VALUES ('26', '1300006869 ', 'Stone masonry C5', 'M3', '411831.00', 'Y', '2');
INSERT INTO `masterharga` VALUES ('27', '1300006726', 'Sloof 15/20 K-175 D-12 C5', 'M3', '2716560.00', 'Y', '2');
INSERT INTO `masterharga` VALUES ('28', '1300002977', 'Brick Wall 1 : 4 C5', 'M3', '87512.00', 'Y', '2');
INSERT INTO `masterharga` VALUES ('29', '1300003835', 'Cement 1 : 4 C5', 'M2', '26570.00', 'Y', '2');
INSERT INTO `masterharga` VALUES ('30', '1300002548', 'Barbed wire&clamp 5 rows zigzag galv C5', 'M', '17100.00', 'Y', '2');
INSERT INTO `masterharga` VALUES ('31', '1300003846', 'Cement foundation Incl paint C5', 'M2', '55364.00', 'Y', '2');
INSERT INTO `masterharga` VALUES ('32', '1300004187', 'Drainage buis beton 1/2 D=20cm d=2cm C5', 'M', '66123.00', 'Y', '2');
INSERT INTO `masterharga` VALUES ('33', '1300003890', 'Concrete floor 1:3:5 incl paint C5', 'M3', '651870.00', 'Y', '2');
INSERT INTO `masterharga` VALUES ('34', '4100005977 ', 'CME Site Survey Reporting C5', 'LOT', '900000.00', 'Y', '2');
INSERT INTO `masterharga` VALUES ('35', '4100005999', 'MobDemob no tower strengthening C5', 'LOT', '1624320.00', 'Y', '2');
INSERT INTO `masterharga` VALUES ('36', '4100006032', 'Excavation C5', 'M3', '36000.00', 'Y', '2');
INSERT INTO `masterharga` VALUES ('37', '4100006307 ', 'Drawing&documentation C5', 'LOT', '1800000.00', 'Y', '2');
INSERT INTO `masterharga` VALUES ('38', '4100006362', 'Acian C5', 'M2', '20160.00', 'Y', '2');
INSERT INTO `masterharga` VALUES ('39', '4100006406', 'Refilling / Back Fill C5', 'M3', '36000.00', 'Y', '2');
INSERT INTO `masterharga` VALUES ('40', '4100006439', 'Painting Weatherproof Dana Paint/ICI C5', 'M2', '29700.00', 'Y', '2');
INSERT INTO `masterharga` VALUES ('41', '4100006461', 'Remove&reinst BRC C5', 'M', '79087.00', 'Y', '2');
INSERT INTO `masterharga` VALUES ('42', '4100005944', 'CME Site Survey C5', 'LOT', '1350000.00', 'Y', '2');
INSERT INTO `masterharga` VALUES ('43', '4320000044', 'Sewa Lahan', 'AU', '6000000.00', 'Y', '2');
INSERT INTO `masterharga` VALUES ('44', '4400000004', 'IJIN KERJA LOCAL PERMIT', 'EA', '16500000.00', 'N', '2');
INSERT INTO `masterharga` VALUES ('45', '4100008325', 'NEWSHGB_BEKASI, KAB_C1A', 'LOT', '51866992.00', 'N', '2');

-- ----------------------------
-- Table structure for mbouwheer_pm
-- ----------------------------
DROP TABLE IF EXISTS `mbouwheer_pm`;
CREATE TABLE `mbouwheer_pm` (
  `id1` bigint(20) NOT NULL,
  `idbouwherr` bigint(20) NOT NULL DEFAULT '0',
  `namaPM` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mbouwheer_pm
-- ----------------------------
INSERT INTO `mbouwheer_pm` VALUES ('1', '1', 'BUDIMAN');
INSERT INTO `mbouwheer_pm` VALUES ('2', '2', 'RAFI SURAFI A');
INSERT INTO `mbouwheer_pm` VALUES ('3', '3', 'IWAN');
INSERT INTO `mbouwheer_pm` VALUES ('4', '1', 'IWAN');
INSERT INTO `mbouwheer_pm` VALUES ('5', '2', 'SUJIWO A');
INSERT INTO `mbouwheer_pm` VALUES ('7', '4', 'IDRIS');
INSERT INTO `mbouwheer_pm` VALUES ('8', '4', 'ARINI');
INSERT INTO `mbouwheer_pm` VALUES ('9', '5', 'Dwi muji');
INSERT INTO `mbouwheer_pm` VALUES ('10', '4', 'Teguh Putra');

-- ----------------------------
-- Table structure for mkontrak
-- ----------------------------
DROP TABLE IF EXISTS `mkontrak`;
CREATE TABLE `mkontrak` (
  `id1` bigint(20) NOT NULL,
  `id_bouwherr` bigint(20) NOT NULL,
  `nokontrak` varchar(50) NOT NULL DEFAULT '0',
  `tglkontrak` date NOT NULL,
  `nilaikontrak` decimal(20,2) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mkontrak
-- ----------------------------
INSERT INTO `mkontrak` VALUES ('2', '2', '5100001136', '2018-07-01', '0.00', 'the First Amandemen of Frame Contract For the Procurement of Site Access, Mini CME, Electricity System and Tower Strengthen');
INSERT INTO `mkontrak` VALUES ('3', '1', '5100004013', '2018-07-01', '0.00', '-');
INSERT INTO `mkontrak` VALUES ('4', '2', '5100001136', '2018-07-01', '0.00', '-');

-- ----------------------------
-- Table structure for msubkon
-- ----------------------------
DROP TABLE IF EXISTS `msubkon`;
CREATE TABLE `msubkon` (
  `id1` bigint(20) NOT NULL,
  `kode` varchar(10) NOT NULL DEFAULT '0',
  `nama` varchar(50) NOT NULL DEFAULT '0',
  `alamat` varchar(50) NOT NULL DEFAULT '0',
  `notelp` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of msubkon
-- ----------------------------
INSERT INTO `msubkon` VALUES ('1', 'Fd', 'Ainul asmala', 'Surabaya', '99282');
INSERT INTO `msubkon` VALUES ('2', 'H001', 'HARUN MAJU JAYA', 'JOMBANG-', '-');

-- ----------------------------
-- Table structure for ms_ketstatus
-- ----------------------------
DROP TABLE IF EXISTS `ms_ketstatus`;
CREATE TABLE `ms_ketstatus` (
  `idketstatus` tinyint(2) NOT NULL,
  `keterangan` varchar(60) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ms_ketstatus
-- ----------------------------
INSERT INTO `ms_ketstatus` VALUES ('1', 'Baru / PO / WO');
INSERT INTO `ms_ketstatus` VALUES ('2', 'HPP / BOQ');
INSERT INTO `ms_ketstatus` VALUES ('3', 'Progress / dikerjakan');
INSERT INTO `ms_ketstatus` VALUES ('4', 'BAUT (By System / Manual)');
INSERT INTO `ms_ketstatus` VALUES ('5', 'GR');
INSERT INTO `ms_ketstatus` VALUES ('6', 'Progress Selesai');
INSERT INTO `ms_ketstatus` VALUES ('7', 'Invoice');
INSERT INTO `ms_ketstatus` VALUES ('8', 'Payment');

-- ----------------------------
-- Table structure for picinternal
-- ----------------------------
DROP TABLE IF EXISTS `picinternal`;
CREATE TABLE `picinternal` (
  `idpicinternal` bigint(20) NOT NULL,
  `kode` varchar(10) NOT NULL DEFAULT '0',
  `nama` varchar(50) NOT NULL DEFAULT '0',
  `alamat` varchar(50) NOT NULL DEFAULT '0',
  `telp` varchar(50) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='master';

-- ----------------------------
-- Records of picinternal
-- ----------------------------
INSERT INTO `picinternal` VALUES ('1', 'PIC00001', 'Ahmad Budi', 'Jl. Surabaya no 1 Surabaya', '031-12345678', 'ahmad@gmail.com');
INSERT INTO `picinternal` VALUES ('2', 'PIC00002', 'Budiman Suciman', 'Surabaya', '081788888', 'budi@budi,com');
INSERT INTO `picinternal` VALUES ('3', 'PIC00003', 'RAFI SURAFI', 'SIDOARJO', '-', '-');
INSERT INTO `picinternal` VALUES ('5', 'PIC00004', 'SLAMET JAYA', 'SIDOARJO', '-', '-');
INSERT INTO `picinternal` VALUES ('6', 'PIC00005', 'MASICH PRASETYO', '-', '-', '-');

-- ----------------------------
-- Table structure for project1
-- ----------------------------
DROP TABLE IF EXISTS `project1`;
CREATE TABLE `project1` (
  `id1` bigint(20) NOT NULL,
  `idproject` varchar(20) NOT NULL DEFAULT '0',
  `namaproject` varchar(100) NOT NULL DEFAULT '0',
  `deskripsi` text,
  `tglmulai` date NOT NULL DEFAULT '0000-00-00',
  `tglselesai` date DEFAULT NULL,
  `durasi` decimal(10,4) DEFAULT NULL COMMENT 'durasi dalam bulan',
  `nokontrak` varchar(50) DEFAULT NULL,
  `tglkontrak` date DEFAULT NULL,
  `idbouwheer` bigint(20) DEFAULT NULL,
  `idpicinternal` bigint(20) DEFAULT NULL,
  `statuspengerjaan` enum('sendiri','sendiri subkon','subkon') DEFAULT 'sendiri',
  `picbouwheernama` varchar(50) DEFAULT NULL,
  `picbouwheertelp` varchar(50) DEFAULT NULL,
  `nilaiprojectdpp` decimal(20,2) DEFAULT NULL,
  `prosenppn` decimal(20,2) DEFAULT NULL,
  `nilaiprojectppn` decimal(20,2) DEFAULT NULL,
  `prosenpph` decimal(20,2) DEFAULT NULL,
  `nilaiprojectpph` decimal(20,2) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `otorisasi` datetime DEFAULT NULL COMMENT 'otorisasi dari GM',
  `rfi` smallint(6) NOT NULL DEFAULT '0',
  `siteid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of project1
-- ----------------------------
INSERT INTO `project1` VALUES ('1', 'PRJ00001', 'Proyek Pembangunan Menara Telekomunikasi', 'Pengembangan Menara Telekomunikasi Telkomsel', '2018-04-08', '2018-04-19', '11.0000', '123/90/A/2018', '2018-04-17', '1', '1', '', 'Budi Kurniawan', '031-55558888', '100000023.00', null, '500.00', null, '12321.00', '2018-04-07 15:31:52', '2018-04-07 15:32:14', null, '0', '');
INSERT INTO `project1` VALUES ('2', 'PRJ00002', 'Setup PowerPlan', 'Setup PowerPlan Tower', '2018-03-01', '2018-06-28', '119.0000', '-', '0000-00-00', '1', '2', '', 'Tony B', '0888888', '36000000.00', null, '0.00', null, '0.00', '2018-04-09 04:25:22', '2018-04-09 04:25:47', null, '0', '');
INSERT INTO `project1` VALUES ('3', 'PRJ00003', 'GROUND TOWER', 'SETUP TOWER', '2016-04-22', '2018-04-22', null, null, '2018-04-22', '2', '1', null, null, null, null, null, null, null, null, '0000-00-00 00:00:00', '0000-00-00 00:00:00', null, '0', '');
INSERT INTO `project1` VALUES ('4', 'PRJ00004', 'CLEANSING AREA', '-', '2018-04-29', '2018-05-31', '32.0000', '-', '0000-00-00', '2', '1', 'sendiri', '-', '-', '0.00', null, '0.00', null, '0.00', '2018-05-01 03:14:19', '2018-05-01 03:14:19', null, '0', '');
INSERT INTO `project1` VALUES ('5', 'PRJ00004', 'REPAIR ELECTRICITY', '-', '2018-04-01', '2018-09-21', '173.0000', '-', '0000-00-00', '1', '2', 'sendiri', '-', '-', '0.00', null, '0.00', null, '0.00', '2018-05-01 03:12:05', '2018-05-01 03:12:05', null, '0', '');
INSERT INTO `project1` VALUES ('7', 'PRJ00005', 'CABLE MAINTENANCE', '-', '2018-04-02', '2018-08-02', '4.0000', 'AA', '2018-05-06', '2', '1', 'sendiri', null, '-', '0.00', null, '0.00', null, '0.00', '2018-05-03 15:22:49', '2018-05-03 23:38:15', null, '0', '');
INSERT INTO `project1` VALUES ('8', 'PRJ00006', 'TOWER STRENGTHEN', '-', '2018-05-01', '2018-07-01', '2.0000', 'AA', '2018-05-01', '4', '1', '', null, '-', '0.00', null, '0.00', null, '0.00', '2018-05-03 23:06:45', '2018-05-03 23:37:56', null, '0', '');
INSERT INTO `project1` VALUES ('9', 'PRJ00007', 'com case Tower 10 Burneh', '-', '2018-05-01', '2018-06-01', '1.0000', '1223', '2018-05-25', '2', '1', 'sendiri', '', '0888888', '0.00', null, '0.00', null, '0.00', '2018-05-25 06:22:19', '2018-05-25 06:22:19', null, '0', '');
INSERT INTO `project1` VALUES ('10', 'PRJ00008', 'Corrective Maintenance', 'Corrective Maintenance plant', '2018-05-01', '2018-09-01', '4.0000', '-', '2018-05-07', '2', '1', 'sendiri', '', '0888888', '0.00', null, '0.00', null, '0.00', '2018-05-30 13:37:59', '2018-05-30 13:37:59', null, '0', '-');
INSERT INTO `project1` VALUES ('12', 'PRJ00009', 'CABLE MAINTENANCE 2', 'CABLE MAINTENANCE 2 - east java - jember', '2018-05-01', '2018-07-01', '2.0000', '5100004013', '2018-06-24', '2', '6', 'subkon', '', '0888888', '17838399.00', null, '1783840.00', null, '0.00', '2018-06-24 10:19:35', '2018-07-15 02:58:28', null, '0', 'CG.EJ.JBR.003');
INSERT INTO `project1` VALUES ('14', 'PRJ00010', 'Service Operation - Grounding Tebel 20SDA066', 'Service Operation - Work Order Pelaksanaan Pekerjaan Survey dan Perbaikan Grounding Tebel (20SDA066) site area East Java', '2018-07-13', '2018-08-13', '1.0000', '5100001136', '0000-00-00', '2', '2', 'sendiri', '', '0888888', '0.00', null, '0.00', null, '0.00', '2018-07-18 22:46:55', '2018-07-18 22:46:55', null, '0', '20SDA066');
INSERT INTO `project1` VALUES ('15', 'PRJ00011', 'SIGURAGURA', '-', '2018-04-17', '2018-08-15', '4.0000', '-', '0000-00-00', '2', '1', 'sendiri', '', '085623234222', '0.00', null, '0.00', null, '0.00', '2018-07-18 23:31:59', '2018-07-18 23:31:59', null, '0', '-');
INSERT INTO `project1` VALUES ('16', 'PRJ00012', 'EJA Pengurusan Sewa Lahan 65 Site Jawa Timur', 'EJA Pengurusan Sewa Lahan 65 Site Jawa Timur', '2017-02-23', '0000-00-00', '20.0000', '5100001136', '2018-07-08', '2', '1', 'sendiri', '', '-', '0.00', null, '0.00', null, '0.00', '2018-07-24 05:18:40', '2018-07-24 05:18:40', null, '0', '-');
INSERT INTO `project1` VALUES ('17', 'PRJ00013', 'TMGEJ-EJ1614-Sitac MBTS SBY Carniv & Jatim Park.', 'TMGEJ-EJ1614-Sitac MBTS SBY Carniv & Jatim Park.', '2017-06-12', '2019-02-12', '20.0000', '5100001136', '2018-07-31', '2', '6', 'sendiri', '', '-', '0.00', null, '0.00', null, '0.00', '2018-07-24 05:42:45', '2018-07-24 05:42:45', null, '0', '-');
INSERT INTO `project1` VALUES ('18', 'PRJ00014', 'SHGB Bekasi 3Site', '-', '2018-07-24', '2018-08-18', '1.0000', '5100004368', '2018-07-08', '2', '6', 'sendiri', '', '-', '0.00', null, '0.00', null, '0.00', '2018-07-24 07:24:05', '2018-07-24 07:24:05', null, '0', '-');

-- ----------------------------
-- Table structure for project1_file
-- ----------------------------
DROP TABLE IF EXISTS `project1_file`;
CREATE TABLE `project1_file` (
  `id1` bigint(20) NOT NULL,
  `id1_project` bigint(20) NOT NULL,
  `tgl_upload` date NOT NULL,
  `deskripsi` text NOT NULL,
  `tgl_receive` date NOT NULL,
  `namafile` varchar(255) NOT NULL,
  `keterangan` enum('PO','BOQ','WO','BAUT','GR','Invoice','Lain') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of project1_file
-- ----------------------------
INSERT INTO `project1_file` VALUES ('1', '1', '2018-04-08', 'tedsafgdsa', '2018-04-23', '1-1523122695.pdf', 'PO');
INSERT INTO `project1_file` VALUES ('2', '1', '2018-04-08', 'tesgfd', '2018-04-19', '1-1523122725.pdf', 'WO');
INSERT INTO `project1_file` VALUES ('3', '1', '2018-04-08', 'File yang berisi catatan notulensi rapat pertama koordinasi project', '2018-04-23', '1-1523127305.pdf', 'PO');
INSERT INTO `project1_file` VALUES ('4', '1', '2018-06-06', 'www', '2018-06-06', 'PO-06062018-cms1.png', 'PO');
INSERT INTO `project1_file` VALUES ('5', '12', '2018-07-15', 'file lain', '2018-07-15', '', 'Lain');
INSERT INTO `project1_file` VALUES ('6', '14', '2018-07-18', 'wo 13 feb 2018', '2018-07-18', 'WO-18072018-093_Service_Operation_-_Work_Order_Pelaksanaan_Pekerjaan_Survey_dan_Perbaikan_Grounding_Tebel_(20SDA066)_site_area_East_Java_pt_citragaia.pdf', 'WO');
INSERT INTO `project1_file` VALUES ('8', '15', '2018-07-18', 'po NO 4800286605', '2018-07-18', 'PO-18072018-4800286605-SIGURAGURA.PDF', 'PO');
INSERT INTO `project1_file` VALUES ('9', '15', '2018-07-21', 'po 2', '2018-07-21', 'PO-21072018-4800286605-SIGURAGURA.PDF', 'PO');

-- ----------------------------
-- Table structure for project1_invoice
-- ----------------------------
DROP TABLE IF EXISTS `project1_invoice`;
CREATE TABLE `project1_invoice` (
  `id1` bigint(20) NOT NULL,
  `id_project1_powobaut` bigint(20) DEFAULT NULL,
  `dpp` decimal(20,2) DEFAULT NULL,
  `ppn` decimal(20,2) DEFAULT NULL,
  `pph` decimal(20,2) DEFAULT NULL,
  `nama_ttd` varchar(50) DEFAULT NULL,
  `tglinvoice` date DEFAULT NULL,
  `invoice_sudah_dikirm` enum('Y','N') DEFAULT NULL,
  `tglditerima` date DEFAULT NULL COMMENT 'tanggal invoice di terima',
  `sudah_payment` enum('Y','N') DEFAULT NULL,
  `noinvoice` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of project1_invoice
-- ----------------------------
INSERT INTO `project1_invoice` VALUES ('1', '5', '100.00', '50.00', '25.00', 'Ahmad', '2018-07-24', 'Y', '2018-07-25', 'N', '123');
INSERT INTO `project1_invoice` VALUES ('3', '7', '2000000.00', '200000.00', '0.00', 'Budiman', '2018-08-13', 'N', '2018-08-20', 'N', '001');
INSERT INTO `project1_invoice` VALUES ('4', '7', '20000000.00', '2000000.00', '0.00', 'Nur Wibowo', '2018-08-07', 'N', '2018-08-01', 'N', 'INV001');

-- ----------------------------
-- Table structure for project1_keuangan
-- ----------------------------
DROP TABLE IF EXISTS `project1_keuangan`;
CREATE TABLE `project1_keuangan` (
  `id1` bigint(20) NOT NULL,
  `id1_project` bigint(20) NOT NULL DEFAULT '0',
  `tgl` date NOT NULL,
  `nilai` decimal(20,2) NOT NULL COMMENT '+ uang masuk (kredit), - uang keluar (debit)',
  `keterangan` varchar(255) DEFAULT NULL,
  `penerima` varchar(50) DEFAULT NULL,
  `ver_pic` date DEFAULT NULL,
  `ver_man` date DEFAULT NULL,
  `ver_kasir` date DEFAULT NULL,
  `id_pekerjaan` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of project1_keuangan
-- ----------------------------
INSERT INTO `project1_keuangan` VALUES ('3', '12', '2018-07-23', '1250000.00', 'tes', 'Ahmad', '2018-07-22', null, null, '2');
INSERT INTO `project1_keuangan` VALUES ('4', '1', '2018-07-01', '5000000.00', '-', 'budiman', '2018-07-22', '2018-07-22', '2018-07-22', '5');
INSERT INTO `project1_keuangan` VALUES ('5', '1', '2018-07-18', '2600000.00', '-', 'budiman', null, '2018-07-24', null, '5');
INSERT INTO `project1_keuangan` VALUES ('6', '3', '2018-07-09', '900000.00', '-', '-', null, null, null, '8');
INSERT INTO `project1_keuangan` VALUES ('7', '3', '2018-07-10', '300000.00', '-', '-', null, null, null, '8');
INSERT INTO `project1_keuangan` VALUES ('8', '1', '2018-08-16', '1250000.00', 'packing', 'Budi', null, null, null, '6');

-- ----------------------------
-- Table structure for project1_powo
-- ----------------------------
DROP TABLE IF EXISTS `project1_powo`;
CREATE TABLE `project1_powo` (
  `id1` bigint(20) NOT NULL,
  `id1_project` bigint(20) NOT NULL DEFAULT '0',
  `jenis` enum('PO','WO') NOT NULL DEFAULT 'PO',
  `no1` varchar(50) NOT NULL COMMENT 'no po',
  `tgl` date NOT NULL COMMENT 'tgl po',
  `jenis2` enum('normal','addendum') NOT NULL COMMENT 'membedakan antara po/wo normal vs addendum',
  `delivery_date` date NOT NULL COMMENT '= rfs date',
  `jenis_data` enum('dummy','notdummy','','') NOT NULL DEFAULT 'notdummy',
  `no_wo` varchar(50) NOT NULL,
  `tgl_wo` date NOT NULL,
  `sub_total` decimal(20,2) NOT NULL,
  `vat` decimal(20,2) NOT NULL,
  `grand_total` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='ada statement po bisa jadi belum ada ketika project berjalan, tapi WO pasti ada.. HPP dan BOQ di buat berdasarkan data ini.. ';

-- ----------------------------
-- Records of project1_powo
-- ----------------------------
INSERT INTO `project1_powo` VALUES ('8', '1', 'PO', '123/A/2018', '2018-04-08', 'normal', '2018-04-29', 'notdummy', '', '0000-00-00', '0.00', '0.00', '0.00');
INSERT INTO `project1_powo` VALUES ('9', '2', 'PO', '1', '2018-04-09', 'normal', '2018-04-08', 'notdummy', '', '0000-00-00', '0.00', '0.00', '0.00');
INSERT INTO `project1_powo` VALUES ('10', '3', 'PO', '1', '2016-04-22', 'normal', '0000-00-00', 'notdummy', '', '0000-00-00', '0.00', '0.00', '0.00');
INSERT INTO `project1_powo` VALUES ('11', '8', 'PO', '-', '2018-05-03', 'normal', '2018-06-28', 'notdummy', '', '0000-00-00', '0.00', '0.00', '0.00');
INSERT INTO `project1_powo` VALUES ('12', '9', 'PO', '1', '2018-05-25', 'normal', '2018-05-31', 'notdummy', '', '0000-00-00', '0.00', '0.00', '0.00');
INSERT INTO `project1_powo` VALUES ('13', '5', 'PO', '12', '2018-05-30', 'normal', '2018-05-31', 'notdummy', '', '0000-00-00', '0.00', '0.00', '0.00');
INSERT INTO `project1_powo` VALUES ('14', '10', 'WO', '-', '2018-05-30', 'normal', '2018-05-31', 'notdummy', '', '0000-00-00', '0.00', '0.00', '0.00');
INSERT INTO `project1_powo` VALUES ('15', '12', 'PO', '4800286604', '2018-06-24', 'normal', '2018-07-07', 'notdummy', '', '0000-00-00', '0.00', '0.00', '0.00');
INSERT INTO `project1_powo` VALUES ('16', '14', 'WO', '093/I00-I0A/PRJ/18', '2018-07-18', 'normal', '2018-08-13', 'notdummy', '', '0000-00-00', '0.00', '0.00', '0.00');
INSERT INTO `project1_powo` VALUES ('17', '15', 'PO', '4800286605', '2018-07-18', 'normal', '2018-08-17', 'notdummy', '', '0000-00-00', '0.00', '0.00', '0.00');
INSERT INTO `project1_powo` VALUES ('18', '16', 'PO', '4800230532', '2018-07-24', 'normal', '2017-03-31', 'notdummy', '', '0000-00-00', '0.00', '0.00', '0.00');
INSERT INTO `project1_powo` VALUES ('19', '17', 'PO', '4800246430', '2018-07-24', 'normal', '2017-07-31', 'notdummy', '', '0000-00-00', '0.00', '0.00', '0.00');
INSERT INTO `project1_powo` VALUES ('20', '18', 'PO', '4800290304', '2018-07-24', 'normal', '2018-07-12', 'notdummy', '', '0000-00-00', '0.00', '0.00', '0.00');
INSERT INTO `project1_powo` VALUES ('21', '4', 'PO', '221', '2018-08-13', 'normal', '2018-08-28', 'notdummy', '', '0000-00-00', '0.00', '0.00', '0.00');

-- ----------------------------
-- Table structure for project1_powo_baut
-- ----------------------------
DROP TABLE IF EXISTS `project1_powo_baut`;
CREATE TABLE `project1_powo_baut` (
  `id1` bigint(20) NOT NULL,
  `id_project1powo` bigint(20) NOT NULL DEFAULT '0',
  `tgl_baut` date NOT NULL,
  `no_baut` varchar(50) NOT NULL,
  `no_atp` varchar(50) NOT NULL COMMENT 'ATP : Accepted test project',
  `tgl_atp` date NOT NULL,
  `catatan` text NOT NULL,
  `no_gr` varchar(50) NOT NULL,
  `tgl_gr` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of project1_powo_baut
-- ----------------------------
INSERT INTO `project1_powo_baut` VALUES ('2', '12', '2018-05-16', '11', '', '2018-05-23', '-', '', '2018-05-16');
INSERT INTO `project1_powo_baut` VALUES ('3', '13', '2018-06-08', 'BA00078', '112', '2018-06-08', '-', '-', '2018-06-08');
INSERT INTO `project1_powo_baut` VALUES ('4', '14', '2018-05-31', 'BA00079', '112', '2018-06-02', '-', '-', '2018-06-01');
INSERT INTO `project1_powo_baut` VALUES ('5', '15', '2018-06-24', 'BA00078', '112', '2018-06-24', '-', '-', '2018-06-24');
INSERT INTO `project1_powo_baut` VALUES ('7', '8', '2018-07-17', 'BA00078', '112', '2018-07-13', '-', '-', '2018-07-14');
INSERT INTO `project1_powo_baut` VALUES ('9', '17', '2018-07-17', 'BA00078', '112', '2018-07-18', '-', '-', '2018-07-19');
INSERT INTO `project1_powo_baut` VALUES ('10', '9', '2018-07-01', 'BA00078', '112', '2018-07-02', '-', '-', '2018-07-03');

-- ----------------------------
-- Table structure for project1_powo_baut_dtl
-- ----------------------------
DROP TABLE IF EXISTS `project1_powo_baut_dtl`;
CREATE TABLE `project1_powo_baut_dtl` (
  `id1` bigint(20) NOT NULL,
  `id_project1_powobaut` bigint(20) NOT NULL DEFAULT '0',
  `material` varchar(100) NOT NULL,
  `uraian_pekerjaan` text NOT NULL,
  `uraian_pekerjaan2` text NOT NULL,
  `qty` double NOT NULL,
  `uom` varchar(50) NOT NULL,
  `unit_price` decimal(20,2) NOT NULL,
  `termasukppn` enum('Y','N') NOT NULL,
  `sub_total` decimal(20,2) NOT NULL,
  `realisasi_sebelumnya` decimal(20,2) NOT NULL DEFAULT '0.00',
  `realisasi` decimal(20,2) NOT NULL,
  `sisa` decimal(20,2) NOT NULL,
  `hasil` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of project1_powo_baut_dtl
-- ----------------------------
INSERT INTO `project1_powo_baut_dtl` VALUES ('1', '5', '1300003186', 'Cable CBSC8 utk use Ground/Burial C5', '', '80', 'M', '65549.00', 'Y', '5243920.00', '0.00', '0.00', '0.00', '-', '-');
INSERT INTO `project1_powo_baut_dtl` VALUES ('2', '5', '1300002537', 'Bar Grounding Steel Galv300x100x10mm C5', '-', '3', 'UNT', '90000.00', 'Y', '270000.00', '0.00', '3.00', '0.00', 'Baik', 'Diterima dengan baik');
INSERT INTO `project1_powo_baut_dtl` VALUES ('3', '5', '1300003978', 'Cooper bonded 5/8 LPCC584NC4 C5', '-', '1', 'UNT', '791755.00', 'Y', '791755.00', '5.00', '2.00', '3.00', 'Baik', 'Diterima dengan baik');
INSERT INTO `project1_powo_baut_dtl` VALUES ('4', '7', '1300006869 ', 'Stone masonry C5', '-', '3', 'M3', '411831.00', 'Y', '1235493.00', '0.00', '2.00', '0.00', 'Baik', 'Diterima dengan baik');
INSERT INTO `project1_powo_baut_dtl` VALUES ('5', '7', '1300002537', 'Bar Grounding Steel Galv300x100x10mm C5', '', '2', 'UNT', '90000.00', 'Y', '180000.00', '0.00', '0.00', '0.00', '-', '-');
INSERT INTO `project1_powo_baut_dtl` VALUES ('6', '7', '1300005846', 'pipe PVC 3 C5', '', '2.5', 'M', '68292.00', 'Y', '170730.00', '0.00', '0.00', '0.00', '-', '-');
INSERT INTO `project1_powo_baut_dtl` VALUES ('10', '9', '1300006869 ', 'Stone masonry C5', '-', '0.8', 'M3', '411831.00', 'Y', '329464.80', '1.00', '2.00', '3.00', 'Baik', 'Diterima dengan baik');
INSERT INTO `project1_powo_baut_dtl` VALUES ('11', '9', '1300003835', 'Cement 1 : 4 C5', '-', '34.05', 'M2', '26570.00', 'Y', '904708.50', '3.00', '4.00', '5.00', 'Baik', 'Diterima dengan baik');
INSERT INTO `project1_powo_baut_dtl` VALUES ('12', '9', '1300004187', 'Drainage buis beton 1/2 D=20cm d=2cm C5', '', '6.7', 'M', '66123.00', 'Y', '443024.10', '0.00', '0.00', '0.00', '-', '-');
INSERT INTO `project1_powo_baut_dtl` VALUES ('13', '10', '1300001267', 'POLE 2M', '', '48.65', 'PAC', '1200000.00', 'Y', '58380000.00', '0.00', '0.00', '0.00', '-', '-');
INSERT INTO `project1_powo_baut_dtl` VALUES ('14', '10', '1300004374', 'FOUNDATION CONCRETE K225 BTS 3308 C5', '', '24', 'M3', '2800000.00', 'Y', '67200000.00', '0.00', '0.00', '0.00', '-', '-');

-- ----------------------------
-- Table structure for project1_powo_boq
-- ----------------------------
DROP TABLE IF EXISTS `project1_powo_boq`;
CREATE TABLE `project1_powo_boq` (
  `id1` bigint(20) NOT NULL,
  `id_project1powo` bigint(20) NOT NULL DEFAULT '0',
  `material` varchar(100) NOT NULL,
  `uraian_pekerjaan` text NOT NULL,
  `qty` double NOT NULL,
  `uom` varchar(50) NOT NULL,
  `unit_price` decimal(20,2) NOT NULL,
  `termasukppn` enum('Y','N') NOT NULL,
  `sub_total` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='harga yang di tawarkan ke bowherr';

-- ----------------------------
-- Records of project1_powo_boq
-- ----------------------------
INSERT INTO `project1_powo_boq` VALUES ('1', '12', '4400000080', 'RETRIBUSI', '2', 'PACKET', '1000000.00', 'Y', '2000000.00');
INSERT INTO `project1_powo_boq` VALUES ('2', '12', '1111111', 'GROUND TEST', '2.5', 'PACKET', '1200000.00', 'Y', '2400000.00');
INSERT INTO `project1_powo_boq` VALUES ('3', '13', '1300000943', 'grounding type A', '4', 'PACKET', '1255001.00', 'Y', '5020004.00');
INSERT INTO `project1_powo_boq` VALUES ('4', '13', '1111111', 'GROUND TEST', '4', 'PACKET', '1200000.00', 'Y', '4800000.00');
INSERT INTO `project1_powo_boq` VALUES ('5', '14', '1111112', 'Grounding Corrective Maintenance', '3', 'unit', '1000000.00', 'Y', '3000000.00');
INSERT INTO `project1_powo_boq` VALUES ('6', '14', '1111112', 'Grounding Corrective Maintenance', '1', 'unit', '1000000.00', 'Y', '1000000.00');
INSERT INTO `project1_powo_boq` VALUES ('7', '14', '1111113', 'Upgrrade PLN', '1', 'unit', '1300000.00', 'Y', '1300000.00');
INSERT INTO `project1_powo_boq` VALUES ('8', '14', '1111113', 'Upgrrade PLN', '1', 'unit', '1300000.00', 'Y', '1300000.00');
INSERT INTO `project1_powo_boq` VALUES ('9', '15', '1300003978', 'Cooper bonded 5/8 LPCC584NC4 C5', '1', 'UNT', '791755.00', 'Y', '791755.00');
INSERT INTO `project1_powo_boq` VALUES ('10', '15', '1300002537', 'Bar Grounding Steel Galv300x100x10mm C5', '3', 'UNT', '90000.00', 'Y', '270000.00');
INSERT INTO `project1_powo_boq` VALUES ('11', '15', '1300003186', 'Cable CBSC8 utk use Ground/Burial C5', '80', 'M', '65549.00', 'Y', '5243920.00');
INSERT INTO `project1_powo_boq` VALUES ('12', '15', '1300002537', 'Bar Grounding Steel Galv300x100x10mm C5', '2.5', 'UNT', '90000.00', 'Y', '180000.00');
INSERT INTO `project1_powo_boq` VALUES ('13', '15', '4400000080', 'RETRIBUSI', '2', 'PACKET', '1000000.00', 'Y', '2000000.00');
INSERT INTO `project1_powo_boq` VALUES ('14', '8', '1300005846', 'pipe PVC 3 C5', '2.5', 'M', '68292.00', 'Y', '170730.00');
INSERT INTO `project1_powo_boq` VALUES ('15', '8', '1300002537', 'Bar Grounding Steel Galv300x100x10mm C5', '2', 'UNT', '90000.00', 'Y', '180000.00');
INSERT INTO `project1_powo_boq` VALUES ('16', '8', '1300006869 ', 'Stone masonry C5', '3', 'M3', '500000.00', 'Y', '1500000.00');
INSERT INTO `project1_powo_boq` VALUES ('17', '17', '1300006869 ', 'Stone masonry C5', '0.8', 'M3', '411831.00', 'Y', '329464.80');
INSERT INTO `project1_powo_boq` VALUES ('18', '17', '1300003835', 'Cement 1 : 4 C5', '34.05', 'M2', '26570.00', 'Y', '904708.50');
INSERT INTO `project1_powo_boq` VALUES ('19', '17', '1300004187', 'Drainage buis beton 1/2 D=20cm d=2cm C5', '6.7', 'M', '66123.00', 'Y', '443024.10');
INSERT INTO `project1_powo_boq` VALUES ('20', '10', '1111112', 'Grounding Corrective Maintenance', '1', 'unit', '1000000.00', 'Y', '1000000.00');
INSERT INTO `project1_powo_boq` VALUES ('21', '18', '4320000044', 'Sewa Lahan', '65', 'AU', '6000000.00', 'Y', '390000000.00');
INSERT INTO `project1_powo_boq` VALUES ('22', '19', '4400000004', 'IJIN KERJA LOCAL PERMIT', '2', 'EA', '16500000.00', 'Y', '33000000.00');
INSERT INTO `project1_powo_boq` VALUES ('23', '20', '4100008325', 'NEWSHGB_BEKASI, KAB_C1A', '3', 'LOT', '51866992.00', 'Y', '155600976.00');
INSERT INTO `project1_powo_boq` VALUES ('24', '21', '1111112', 'Grounding Corrective Maintenance', '2', 'unit', '1100000.00', 'Y', '2200000.00');

-- ----------------------------
-- Table structure for project1_powo_hpp
-- ----------------------------
DROP TABLE IF EXISTS `project1_powo_hpp`;
CREATE TABLE `project1_powo_hpp` (
  `id1` bigint(20) NOT NULL,
  `id_project1powo` bigint(20) NOT NULL DEFAULT '0',
  `material` varchar(100) NOT NULL,
  `uraian_pekerjaan` text NOT NULL,
  `qty` decimal(20,2) NOT NULL,
  `uom` varchar(50) NOT NULL,
  `unit_price` decimal(20,2) NOT NULL,
  `termasukppn` enum('Y','N') NOT NULL DEFAULT 'N',
  `sub_total` decimal(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='hpp : harga pokok penjualan, harga dasar pekerjaan\r\nboq : harga yang di sampaikan ke bowherr, biasanya up / keuntungan 30%';

-- ----------------------------
-- Records of project1_powo_hpp
-- ----------------------------
INSERT INTO `project1_powo_hpp` VALUES ('1', '9', '1300001267', 'POLE 2M ', '48.00', 'PAC', '850000.00', 'Y', '40800000.00');
INSERT INTO `project1_powo_hpp` VALUES ('2', '9', '1300004374', 'FOUNDATION CONCRETE K225 BTS 3308 C5', '24.65', 'M3', '2300000.00', 'Y', '56695000.00');
INSERT INTO `project1_powo_hpp` VALUES ('3', '8', '13000000', '', '80.00', 'M3', '100000.00', 'Y', '8000000.00');
INSERT INTO `project1_powo_hpp` VALUES ('4', '12', '4400000080', 'RETRIBUSI', '2.00', 'PACKET', '1000000.00', 'Y', '2000000.00');
INSERT INTO `project1_powo_hpp` VALUES ('5', '12', '1111111', 'GROUND TEST', '2.50', 'PACKET', '1200000.00', 'Y', '3000000.00');
INSERT INTO `project1_powo_hpp` VALUES ('6', '13', '1300000943', 'grounding type A', '4.00', 'PACKET', '1255001.00', 'Y', '5020004.00');
INSERT INTO `project1_powo_hpp` VALUES ('7', '13', '1111111', 'GROUND TEST', '4.00', 'PACKET', '1200000.00', 'Y', '4800000.00');
INSERT INTO `project1_powo_hpp` VALUES ('8', '14', '1111112', 'Grounding Corrective Maintenance', '3.00', 'unit', '1000000.00', 'Y', '3000000.00');
INSERT INTO `project1_powo_hpp` VALUES ('9', '14', '1111112', 'Grounding Corrective Maintenance', '1.00', 'unit', '1000000.00', 'Y', '1000000.00');
INSERT INTO `project1_powo_hpp` VALUES ('10', '14', '1111113', 'Upgrrade PLN', '1.00', 'unit', '1300000.00', 'Y', '1300000.00');
INSERT INTO `project1_powo_hpp` VALUES ('11', '14', '1111113', 'Upgrrade PLN', '1.00', 'unit', '1300000.00', 'Y', '1300000.00');
INSERT INTO `project1_powo_hpp` VALUES ('12', '15', '1300003978', 'Cooper bonded 5/8 LPCC584NC4 C5', '1.00', 'UNT', '791755.00', 'Y', '791755.00');
INSERT INTO `project1_powo_hpp` VALUES ('13', '15', '1300002537', 'Bar Grounding Steel Galv300x100x10mm C5', '3.00', 'UNT', '90000.00', 'Y', '270000.00');
INSERT INTO `project1_powo_hpp` VALUES ('14', '15', '1300003186', 'Cable CBSC8 utk use Ground/Burial C5', '80.00', 'M', '65549.00', 'Y', '5243920.00');
INSERT INTO `project1_powo_hpp` VALUES ('15', '15', '1300002537', 'Bar Grounding Steel Galv300x100x10mm C5', '2.50', 'UNT', '90000.00', 'Y', '225000.00');
INSERT INTO `project1_powo_hpp` VALUES ('16', '15', '4400000080', 'RETRIBUSI', '2.00', 'PACKET', '1000000.00', 'Y', '2000000.00');
INSERT INTO `project1_powo_hpp` VALUES ('17', '8', '1300005846', 'pipe PVC 3 C5', '2.50', 'M', '68292.00', 'Y', '170730.00');
INSERT INTO `project1_powo_hpp` VALUES ('18', '8', '1300002537', 'Bar Grounding Steel Galv300x100x10mm C5', '2.00', 'UNT', '93000.00', 'Y', '186000.00');
INSERT INTO `project1_powo_hpp` VALUES ('19', '8', '1300006869 ', 'Stone masonry C5', '3.00', 'M3', '250000.00', 'Y', '750000.00');
INSERT INTO `project1_powo_hpp` VALUES ('20', '17', '1300006869 ', 'Stone masonry C5', '0.80', 'M3', '411831.00', 'Y', '329464.80');
INSERT INTO `project1_powo_hpp` VALUES ('21', '17', '1300003835', 'Cement 1 : 4 C5', '34.05', 'M2', '26570.00', 'Y', '904708.50');
INSERT INTO `project1_powo_hpp` VALUES ('22', '17', '1300004187', 'Drainage buis beton 1/2 D=20cm d=2cm C5', '6.70', 'M', '66123.00', 'Y', '443024.10');
INSERT INTO `project1_powo_hpp` VALUES ('23', '10', '1111112', 'Grounding Corrective Maintenance', '1.00', 'unit', '1000000.00', 'Y', '1000000.00');
INSERT INTO `project1_powo_hpp` VALUES ('24', '18', '4320000044', 'Sewa Lahan', '65.00', 'AU', '6000000.00', 'Y', '390000000.00');
INSERT INTO `project1_powo_hpp` VALUES ('25', '19', '4400000004', 'IJIN KERJA LOCAL PERMIT', '2.00', 'EA', '16500000.00', 'Y', '33000000.00');
INSERT INTO `project1_powo_hpp` VALUES ('26', '20', '4100008325', 'NEWSHGB_BEKASI, KAB_C1A', '3.00', 'LOT', '51866992.00', 'Y', '155600976.00');
INSERT INTO `project1_powo_hpp` VALUES ('27', '21', '1111112', 'Grounding Corrective Maintenance', '2.00', 'unit', '1100000.00', 'Y', '2200000.00');

-- ----------------------------
-- Table structure for project1_powo_sub
-- ----------------------------
DROP TABLE IF EXISTS `project1_powo_sub`;
CREATE TABLE `project1_powo_sub` (
  `id1` bigint(20) NOT NULL,
  `id1_project1_powo` bigint(20) NOT NULL DEFAULT '0',
  `subkegiatan` varchar(255) NOT NULL,
  `site_id` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `material` varchar(100) NOT NULL,
  `uraian_pekerjaan` text NOT NULL,
  `qty` decimal(20,2) NOT NULL,
  `uom` varchar(50) NOT NULL,
  `unit_price` decimal(20,2) NOT NULL,
  `termasukppn` enum('Y','N') NOT NULL,
  `sub_total` decimal(20,2) NOT NULL,
  `tglmulai` date NOT NULL,
  `tglselesai` date NOT NULL,
  `biaya` decimal(20,2) NOT NULL COMMENT 'xx tidak usah di isi',
  `id_kategori` bigint(20) NOT NULL,
  `status_subkegiatan` enum('open','ongoing lapangan','ongoing administrasi','ongoing keuangan','close') NOT NULL DEFAULT 'open',
  `tglstatus` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='ini untuk sub kegiatan project, di siapkan takut di tanyakan, pada prakteknya, mungkin tidak diisi.. ';

-- ----------------------------
-- Records of project1_powo_sub
-- ----------------------------
INSERT INTO `project1_powo_sub` VALUES ('3', '9', 'SIMPLE POLE', '', '', '1300001267', 'POLE 2M', '48.65', 'PAC', '1200000.00', 'Y', '58380000.00', '0000-00-00', '0000-00-00', '0.00', '2', 'open', '0000-00-00');
INSERT INTO `project1_powo_sub` VALUES ('7', '9', 'FOUNDATION BTS OUTDOOR', '', '', '1300004374', 'FOUNDATION CONCRETE K225 BTS 3308 C5', '24.00', 'M3', '2800000.00', 'Y', '67200000.00', '2018-04-22', '2018-04-22', '0.00', '2', 'open', '2018-04-20');
INSERT INTO `project1_powo_sub` VALUES ('8', '12', '-', '-', '-', '4400000080', 'RETRIBUSI', '2.00', 'PACKET', '1000000.00', 'Y', '2000000.00', '2018-05-25', '0000-00-00', '0.00', '5', 'open', '2018-05-25');
INSERT INTO `project1_powo_sub` VALUES ('9', '12', '-', '-', '-', '1111111', 'GROUND TEST', '2.50', 'PACKET', '1200000.00', 'Y', '3000000.00', '2018-05-25', '2018-04-19', '0.00', '1', 'open', '2018-05-25');
INSERT INTO `project1_powo_sub` VALUES ('10', '13', '-', '-', '-', '1300000943', 'grounding type A', '4.00', 'PACKET', '1255001.00', 'Y', '5020004.00', '2018-05-30', '2018-06-08', '0.00', '1', 'open', '2018-05-30');
INSERT INTO `project1_powo_sub` VALUES ('11', '13', '-', '-', '-', '1111111', 'GROUND TEST', '4.00', 'PACKET', '1200000.00', 'Y', '4800000.00', '2018-05-30', '2018-06-08', '0.00', '1', 'open', '2018-05-30');
INSERT INTO `project1_powo_sub` VALUES ('12', '14', '-', 'CG.EJ.JBR.001', '-', '1111112', 'Grounding Corrective Maintenance', '3.00', 'unit', '1000000.00', 'Y', '3000000.00', '2018-05-30', '2018-05-25', '0.00', '1', 'open', '2018-05-30');
INSERT INTO `project1_powo_sub` VALUES ('13', '14', '-', 'CG.EJ.BKL.004', '-', '1111112', 'Grounding Corrective Maintenance', '1.00', 'unit', '1000000.00', 'Y', '1000000.00', '2018-05-30', '0000-00-00', '0.00', '1', 'open', '2018-05-30');
INSERT INTO `project1_powo_sub` VALUES ('14', '14', '-', 'CG.EJ.BKL.003', '-', '1111113', 'Upgrrade PLN', '1.00', 'unit', '1300000.00', 'Y', '1300000.00', '2018-05-30', '0000-00-00', '0.00', '1', 'open', '2018-05-30');
INSERT INTO `project1_powo_sub` VALUES ('15', '14', '-', 'CG.EJ.JBR.001', '-', '1111113', 'Upgrrade PLN', '1.00', 'unit', '1300000.00', 'Y', '1300000.00', '2018-05-30', '2018-05-16', '0.00', '1', 'open', '2018-05-30');
INSERT INTO `project1_powo_sub` VALUES ('16', '15', '-', '-', '-', '1300003978', 'Cooper bonded 5/8 LPCC584NC4 C5', '1.00', 'UNT', '791755.00', 'Y', '791755.00', '2018-06-24', '0000-00-00', '0.00', '1', 'open', '2018-06-24');
INSERT INTO `project1_powo_sub` VALUES ('17', '15', '-', '-', '-', '1300002537', 'Bar Grounding Steel Galv300x100x10mm C5', '3.00', 'UNT', '90000.00', 'Y', '270000.00', '2018-06-24', '0000-00-00', '0.00', '1', 'open', '2018-06-24');
INSERT INTO `project1_powo_sub` VALUES ('18', '15', '-', '-', '-', '1300003186', 'Cable CBSC8 utk use Ground/Burial C5', '80.00', 'M', '65549.00', 'Y', '5243920.00', '2018-06-24', '0000-00-00', '0.00', '1', 'open', '2018-06-24');
INSERT INTO `project1_powo_sub` VALUES ('19', '15', '-', '-', '-', '1300002537', 'Bar Grounding Steel Galv300x100x10mm C5', '2.50', 'UNT', '90000.00', 'Y', '225000.00', '2018-06-24', '0000-00-00', '0.00', '1', 'open', '2018-06-30');
INSERT INTO `project1_powo_sub` VALUES ('20', '16', '', '20SDA066', '', '4100007154', '4100007154', '1.00', 'M3', '13500.00', 'Y', '13500.00', '2018-07-01', '2018-08-13', '13500.00', '0', 'open', '0000-00-00');
INSERT INTO `project1_powo_sub` VALUES ('21', '15', 'ew1', '32', '32', '4400000080', 'RETRIBUSI', '12.00', 'PACKET', '1000000.00', 'Y', '12000000.00', '2018-06-24', '0000-00-00', '0.00', '1', 'open', '2018-07-21');
INSERT INTO `project1_powo_sub` VALUES ('22', '8', '-', '-', '-', '1300005846', 'pipe PVC 3 C5', '2.50', 'M', '68292.00', 'Y', '170730.00', '2018-04-08', '0000-00-00', '0.00', '1', 'ongoing keuangan', '2018-08-14');
INSERT INTO `project1_powo_sub` VALUES ('23', '8', '-', '-', '-', '1300002537', 'Bar Grounding Steel Galv300x100x10mm C5', '2.00', 'UNT', '90000.00', 'Y', '180000.00', '2018-04-08', '2018-07-17', '0.00', '1', 'open', '2018-07-21');
INSERT INTO `project1_powo_sub` VALUES ('24', '8', '-', '-', '-', '1300006869 ', 'Stone masonry C5', '3.00', 'M3', '411831.00', 'Y', '1235493.00', '2018-04-08', '0000-00-00', '0.00', '1', 'open', '2018-07-21');
INSERT INTO `project1_powo_sub` VALUES ('25', '17', '-', '20MLG035', 'SIGURAGURA', '1300006869 ', 'Stone masonry C5', '0.80', 'M3', '411831.00', 'Y', '329464.80', '2018-07-18', '2018-09-27', '0.00', '1', 'open', '2018-07-21');
INSERT INTO `project1_powo_sub` VALUES ('26', '17', '-', '20MLG035', 'SIGURAGURA', '1300003835', 'Cement 1 : 4 C5', '34.05', 'M2', '26570.00', 'Y', '904708.50', '2018-07-18', '2018-09-27', '0.00', '1', 'open', '2018-07-21');
INSERT INTO `project1_powo_sub` VALUES ('27', '17', '-', '20MLG035', 'SIGURAGURA', '1300004187', 'Drainage buis beton 1/2 D=20cm d=2cm C5', '6.70', 'M', '66123.00', 'Y', '443024.10', '2018-07-18', '2018-09-27', '0.00', '1', 'open', '2018-07-21');
INSERT INTO `project1_powo_sub` VALUES ('28', '10', '-', '-', '-', '1111112', 'Grounding Corrective Maintenance', '1.00', 'unit', '1000000.00', 'Y', '1000000.00', '2016-04-22', '0000-00-00', '0.00', '1', 'open', '2018-07-24');
INSERT INTO `project1_powo_sub` VALUES ('29', '18', 'Management fee sewa lahan EJBN Y2017 periode : januari s/d april 2017 sebanyak 65 site', '-', '-', '4320000044', 'Sewa Lahan', '65.00', 'AU', '6000000.00', 'Y', '390000000.00', '2018-07-24', '2018-07-31', '0.00', '1', 'open', '2018-07-24');
INSERT INTO `project1_powo_sub` VALUES ('30', '19', 'Pengurusan Sitac MBTS Surabaya Carnival & MBTS Jatim Park dalam Rangka Lebaran dan Libur Sekolah.', '-', '-', '4400000004', 'IJIN KERJA LOCAL PERMIT', '2.00', 'EA', '16500000.00', 'Y', '33000000.00', '2018-07-24', '2017-07-31', '0.00', '5', 'open', '2018-07-24');
INSERT INTO `project1_powo_sub` VALUES ('31', '20', '-', '-', '-', '4100008325', 'NEWSHGB_BEKASI, KAB_C1A', '3.00', 'LOT', '51866992.00', 'Y', '155600976.00', '2018-07-24', '0000-00-00', '0.00', '1', 'open', '2018-07-24');
INSERT INTO `project1_powo_sub` VALUES ('32', '21', '-', '-', '-', '1111112', 'Grounding Corrective Maintenance', '2.00', 'unit', '1100000.00', 'Y', '2200000.00', '2018-08-13', '2018-08-29', '0.00', '1', 'open', '2018-08-13');

-- ----------------------------
-- Table structure for project1_rancanganpekerjaan
-- ----------------------------
DROP TABLE IF EXISTS `project1_rancanganpekerjaan`;
CREATE TABLE `project1_rancanganpekerjaan` (
  `id1` bigint(20) NOT NULL,
  `id1_project` bigint(20) NOT NULL DEFAULT '0',
  `item_pekerjaan` text NOT NULL,
  `status` enum('open','ongoing lapangan','ongoing administrasi','ongoing keuangan','close') NOT NULL,
  `tglmulai` date NOT NULL,
  `durasi` int(11) NOT NULL COMMENT 'dalam hari',
  `tglselesai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of project1_rancanganpekerjaan
-- ----------------------------
INSERT INTO `project1_rancanganpekerjaan` VALUES ('1', '12', 'cek lokasi', 'open', '2018-07-13', '2', '0000-00-00');
INSERT INTO `project1_rancanganpekerjaan` VALUES ('2', '12', 'pemasangan pagar, mobilisasi alat', 'open', '2018-07-15', '2', '0000-00-00');
INSERT INTO `project1_rancanganpekerjaan` VALUES ('3', '14', 'persiapan', 'open', '2018-07-01', '3', '0000-00-00');
INSERT INTO `project1_rancanganpekerjaan` VALUES ('5', '1', 'Pembersihan Lahan', 'open', '2018-07-17', '3', '2018-07-20');
INSERT INTO `project1_rancanganpekerjaan` VALUES ('6', '1', 'Pemindahan alat kerja', 'close', '2018-07-19', '3', '2018-07-22');
INSERT INTO `project1_rancanganpekerjaan` VALUES ('7', '15', 'cek lokasi', 'open', '2018-07-17', '2', '2018-07-19');
INSERT INTO `project1_rancanganpekerjaan` VALUES ('8', '3', 'persiapan alat', 'open', '2018-07-09', '2', '2018-07-11');

-- ----------------------------
-- Table structure for project1_status
-- ----------------------------
DROP TABLE IF EXISTS `project1_status`;
CREATE TABLE `project1_status` (
  `id1` bigint(20) NOT NULL,
  `id1_project` bigint(20) NOT NULL DEFAULT '0',
  `keterangan` varchar(50) NOT NULL DEFAULT '0' COMMENT '1. Baru / PO / WO, 2. HPP / BOQ, 3.Progress / dikerjakan, 4. BAUT (By System / Manual), 5. GR, 6. Progress Selesai, 7. Invoice, 8. Payment',
  `remark` text NOT NULL,
  `status` enum('open','close') NOT NULL,
  `tgl_update` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of project1_status
-- ----------------------------
INSERT INTO `project1_status` VALUES ('1', '1', '1', '', 'open', '2018-05-03');
INSERT INTO `project1_status` VALUES ('2', '1', '3', '', 'open', '2018-05-25');
INSERT INTO `project1_status` VALUES ('3', '15', '1', 'sudah po', 'close', '2018-07-22');
INSERT INTO `project1_status` VALUES ('4', '15', '2', '', 'open', '2018-07-20');
INSERT INTO `project1_status` VALUES ('5', '2', '7', '', 'close', '2018-07-21');

-- ----------------------------
-- Table structure for project1_subkon
-- ----------------------------
DROP TABLE IF EXISTS `project1_subkon`;
CREATE TABLE `project1_subkon` (
  `id1` bigint(20) NOT NULL,
  `id1_project` bigint(20) NOT NULL DEFAULT '0',
  `id_subkon` bigint(20) NOT NULL DEFAULT '0',
  `material` varchar(100) NOT NULL,
  `uraian_pekerjaan` text NOT NULL,
  `qty` double NOT NULL,
  `uom` varchar(50) NOT NULL,
  `unit_price` decimal(20,2) NOT NULL,
  `termasukppn` enum('Y','N') NOT NULL,
  `sub_total` decimal(20,2) NOT NULL,
  `tglselesai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of project1_subkon
-- ----------------------------
INSERT INTO `project1_subkon` VALUES ('1', '4', '1', '1300005846', 'pipe PVC 3 C5', '2.5', 'M', '68292.00', '', '170730.00', '2018-07-25');

-- ----------------------------
-- Table structure for project1_sumberinformasi
-- ----------------------------
DROP TABLE IF EXISTS `project1_sumberinformasi`;
CREATE TABLE `project1_sumberinformasi` (
  `id1` bigint(20) NOT NULL,
  `jenis` enum('email','telepon','sms','IM','PO','WO','lain') NOT NULL,
  `tgl` date NOT NULL,
  `keterangan` text NOT NULL,
  `id1_project` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of project1_sumberinformasi
-- ----------------------------
INSERT INTO `project1_sumberinformasi` VALUES ('1', 'sms', '2018-04-07', 'SMS dari Bapak Budi dengan nomor HP 081-12345677, Isinya: Konfirmasi kepastian kelanjutan project BTS telkomsel di Sidoarjo', '1');
INSERT INTO `project1_sumberinformasi` VALUES ('7', 'email', '2018-04-24', 'fdsafdsa', '1');
INSERT INTO `project1_sumberinformasi` VALUES ('13', 'sms', '2018-04-17', 'Joss 1', '1');
INSERT INTO `project1_sumberinformasi` VALUES ('14', 'sms', '2018-04-19', 'Siiip', '1');
INSERT INTO `project1_sumberinformasi` VALUES ('15', 'telepon', '2018-03-07', 'dari pak Yo', '2');
INSERT INTO `project1_sumberinformasi` VALUES ('16', 'email', '2018-05-01', 'email dari pak Budi, tentang... ', '10');
INSERT INTO `project1_sumberinformasi` VALUES ('18', 'email', '2018-05-27', 'ada email dari cs@indosat.co.id', '12');
INSERT INTO `project1_sumberinformasi` VALUES ('19', 'PO', '2018-05-29', 'No 4800286604', '12');
INSERT INTO `project1_sumberinformasi` VALUES ('20', 'WO', '2018-02-13', 'pdf', '14');
INSERT INTO `project1_sumberinformasi` VALUES ('21', 'PO', '2018-04-17', 'PO. PDF', '15');

-- ----------------------------
-- Table structure for rsite
-- ----------------------------
DROP TABLE IF EXISTS `rsite`;
CREATE TABLE `rsite` (
  `id1` bigint(20) NOT NULL,
  `siteid` varchar(50) NOT NULL,
  `sitename` varchar(50) NOT NULL,
  `tpname` varchar(50) NOT NULL,
  `sitestatus` enum('on air','on going') NOT NULL,
  `longitude` float NOT NULL,
  `latitude` float NOT NULL,
  `province` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `site_available_for_colo` varchar(50) NOT NULL,
  `sitetype` varchar(50) NOT NULL,
  `towertype` varchar(50) NOT NULL,
  `buidingheight` float NOT NULL COMMENT '(meter)',
  `towerheight` float NOT NULL COMMENT 'from DPL',
  `shareablestatus` varchar(50) DEFAULT NULL,
  `availabletowerspace` float NOT NULL,
  `availablegroundspace` float NOT NULL,
  `commcasehistory` enum('Y','N') NOT NULL,
  `sitecontractperiod` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rsite
-- ----------------------------
INSERT INTO `rsite` VALUES ('3', '---CG.EJ.LMJ.0', 'Nama Sitenya Edit', 'TPnya', 'on air', '11.2', '55.4', 'Jawa Timur', 'Trenggalek', 'Malang', 'Available', 'Tipenya', 'towernya', '11.2', '22.1', 'statuse shareable ok', '3.2', '5.1', 'Y', '10');
INSERT INTO `rsite` VALUES ('5', '---CG.EJ.BKL.002', 'Petrah ', '', 'on air', '2', '2', 'East Java', 'Bangkalan', 'Desa Petrah Kec Tanah Merah Kab. Bangkalan', 'Available', 'GF', 'SST-3legs', '12', '14', '', '2', '2', 'Y', '>6 years');
INSERT INTO `rsite` VALUES ('6', '---CG.EJ.BKL.001', 'Lerpak', '-', 'on air', '3', '3', 'East Java', 'Bangkalan', 'Dusun Dajjah, Desa Geger Kec Geger Kab Bangkalan', 'Available', '', '', '3', '3', '', '0', '0', 'Y', '');
INSERT INTO `rsite` VALUES ('10', '---CG.EJ.JBR.001', 'RAYA_SEMBORO', '-', 'on air', '0', '0', 'East Java', 'Jember', 'Dusun Krajan Utara, RT. 03 RW. 04 Desa Gadingrejo, Kel. Umbulsari, Kab. Jember, Jawa Timur.', 'Available', 'GF', 'SST-3legs', '0', '0', '-', '0', '0', 'Y', '>6 years');
INSERT INTO `rsite` VALUES ('11', '---CG.EJ.BKL.004', 'Sepulu', '-', 'on air', '0', '2', 'East Java', 'Bangkalan', 'Desa Sepulu', 'Available', 'GF', 'SST-3legs', '20', '14', '-', '15', '15', 'Y', '>6 years');
INSERT INTO `rsite` VALUES ('13', '---CG.EJ.MDN.001', 'Sumber Gandu', 'XL', 'on air', '111.662', '-7.51903', 'East Java', 'Caruban', 'Desa Kedungrejo, Kec Pilangkenceng Kab. Madiun', 'Available', 'GF', 'SST-3legs', '0', '50', '-1', '0', '0', 'N', '>6 years');
INSERT INTO `rsite` VALUES ('16', 'CG.EJ.BKL.001', 'Banyoneng Dajah', 'XL', 'on air', '112.956', '-6.95458', 'EAST JAVA', 'Bangkalan', 'Desa Bangsareh, Kec. Bangkalan, Kabupaten Bangkalan', 'Available', 'GF', 'SST-3legs', '0', '70', null, '0', '0', 'N', '> 6 years');
INSERT INTO `rsite` VALUES ('17', 'CG.EJ.BKL.002', 'Petrah ', 'XL', 'on air', '112.901', '-7.07531', 'EAST JAVA', 'Bangkalan', 'Desa Petrah Kec Tanah Merah Kab. Bangkalan', 'Available', 'GF', 'SST-3legs', '0', '70', 'yes', '0', '0', 'N', '> 6 years');
INSERT INTO `rsite` VALUES ('18', 'CG.EJ.BKL.003', 'Lerpak', 'XL', 'on air', '112.934', '-7.0245', 'EAST JAVA', 'Bangkalan', 'Dusun Dajjah, Desa Geger Kec Geger Kab Bangkalan', 'Available', 'GF', 'SST-3legs', '0', '70', 'yes', '0', '0', 'N', '> 6 years');
INSERT INTO `rsite` VALUES ('19', 'CG.EJ.MDN.001', 'Sumber Gandu', 'XL', 'on air', '111.662', '-7.51903', 'EAST JAVA', 'Caruban', 'Desa Kedungrejo, Kec Pilangkenceng Kab. Madiun', 'Available', 'GF', 'SST-3legs', '0', '50', 'yes', '0', '0', 'N', '> 6 years');
INSERT INTO `rsite` VALUES ('20', 'CG.EJ.GRSK.001', 'Setro', 'XL + Tsel', 'on air', '112.613', '-7.30144', 'EAST JAVA', 'Gresik', 'Dusun Pengampon RT.14 RW.07,  Desa Setro , Kec.  Menganti, Kab. Gresik', 'Available', 'GF', 'SST-3legs', '0', '52', 'yes', '0', '0', 'N', '> 6 years');
INSERT INTO `rsite` VALUES ('21', 'CG.EJ.GRSK.002', 'BSB-Gersik', 'isat', 'on air', '112.635', '-7.18677', 'EAST JAVA', 'Gresik', 'Jl. Mayjen Sungkono XII/8, Kec. Kebomas, Kab. Gresik', 'Available', 'GF', 'SST-4legs', '0', '55', 'yes', '0', '0', 'N', '> 6 years');
INSERT INTO `rsite` VALUES ('22', 'CG.JBDT.JKT.004', 'Kedoya Raya', 'H3I', 'on air', '106.76', '-6.16979', 'JABODETABEK', 'Jakarta Barat', 'Jalan Kedoya Raya No.18 Rt.04/Rw.07, Kel. Kedoya Utara, Kec. Kebon Jeruk, Jakarta-Barat ', 'Available', 'Roof Top', 'SST-4legs', '10', '22', 'yes', '22', '0', 'N', '> 6 years');
INSERT INTO `rsite` VALUES ('23', 'CG.JBDT.JKT.012', 'Sukapura', 'H3I + SF', 'on air', '106.927', '-6.15012', 'JABODETABEK', 'Jakarta Timur', 'Jl. Taruna No. 8 RT. 06 RW. 02 Sukapura Tipar Cakung ', 'Available', 'Roof Top', 'Monopole', '8', '20', 'yes', '20', '0', 'N', '> 6 years');
INSERT INTO `rsite` VALUES ('24', 'CG.JBDT.JKT.013', 'Tambun Rengas', 'H3I', 'on air', '106.962', '-6.16194', 'JABODETABEK', 'Jakarta Timur', 'Jl.Tambun Rengas Rt.08 Rw.07 Kelurahan Cakung Timur Kecamatan Cakung Jakarta Timur ', 'Available', 'GF', 'SST-4legs', '0', '25', 'yes', '0', '0', 'Y', '> 6 years');
INSERT INTO `rsite` VALUES ('25', 'CG.EJ.PCT.001', 'Purworejo', 'XL + SF', 'on air', '111.139', '-8.19317', 'EAST JAVA', 'Pacitan', 'Dusun Krajan Dugulan RT 004 RW 003, Desa Mentoro, Kec. Pacitan , Kab. PACITAN', 'Available', 'GF', 'SST-3legs', '0', '50', 'yes', '0', '0', 'N', '> 6 years');
INSERT INTO `rsite` VALUES ('26', 'CG.EJ.PMK.001', 'Pamekasan', 'H3I + Tsel', 'on air', '113.285', '-7.09369', 'EAST JAVA', 'Pamekasan', 'Jl. Mesigit Alun-alun Pamekasan', 'Available', 'Menara Masjid', 'Menara', '0', '35', 'yes', '35', '0', 'N', '> 6 years');
INSERT INTO `rsite` VALUES ('27', 'CG.EJ.SMP.001', 'Bapelle', 'XL', 'on air', '113.303', '-7.02606', 'EAST JAVA', 'Sampang', 'Dusun MUNGGING Desa ROBOTAL Kec.ROBOTAL, Kab. Sampang', 'Available', 'GF', '', '0', '70', 'yes', '0', '0', 'N', '> 6 years');
INSERT INTO `rsite` VALUES ('28', 'CG.EJ.SBY.001', 'Rungkut Industri', 'XL', 'on air', '112.761', '-7.33411', 'EAST JAVA', 'Surabaya', ' JL. Rungkut Industri IV No. 34 Surabaya', 'Available', 'Roof Top', 'Pole-6M', '18', '24', 'yes', '24', '0', 'N', '> 6 years');
INSERT INTO `rsite` VALUES ('29', 'CG.EJ.SBY.002', 'Royal Residence', 'XL', 'on air', '112.681', '-7.31011', 'EAST JAVA', 'Surabaya', 'JL. BABATAN I NO.1 SBY', 'Available', 'GF', 'Monopole', '0', '25', 'yes', '0', '0', 'N', '> 6 years');
INSERT INTO `rsite` VALUES ('30', 'CG.EJ.BWI.001', 'BENCULUK', 'XL', 'on air', '114.204', '-8.4323', 'EAST JAVA', 'Banyuwangi', 'Dsn Trembelang RT 02 RW 01 Desa Cluring kec. Cluring Kab. Banyuwangi', 'Available', 'GF', 'SST-3legs', '0', '52', 'yes', '0', '0', 'N', 'PKS 10th');
INSERT INTO `rsite` VALUES ('31', 'CG.EJ.JBR.001', 'RAYA_SEMBORO', 'XL', 'on air', '113', '-8.23578', 'EAST JAVA', 'Jember', 'Dusun Krajan Utara, RT. 03 RW. 04 Desa Gadingrejo, Kel. Umbulsari, Kab. Jember, Jawa Timur.', 'Available', 'GF', 'SST-3legs', '0', '52', 'yes', '52', '0', 'N', 'PKS 10th');
INSERT INTO `rsite` VALUES ('32', 'CG.EJ.JBR.002', 'UMBULSARI', 'XL', 'on air', '113.412', '-8.25839', 'EAST JAVA', 'Jember', 'Dusun Banjarrejo, RT.06. RW. 08 Desa Gunungsari Kec. Umbulsari Kel. Gunungsari, Kec. Umbulsari, Kab.', 'Available', 'GF', 'SST-3legs', '0', '52', 'yes', '52', '0', 'N', 'PKS 10th');
INSERT INTO `rsite` VALUES ('33', 'CG.EJ.JBR.003', 'KALIWINING', 'XL', 'on air', '113.615', '-8.22839', 'EAST JAVA', 'Jember', 'Dusun Loji Kidul, RT. 02 RW. 19 Desa Kaliwining, Kel. Kaliwining, Kec. Rambipuji, Kab. Jember, Jawa ', 'Available', 'GF', 'SST-3legs', '0', '52', 'yes', '52', '0', 'N', 'PKS 10th');
INSERT INTO `rsite` VALUES ('34', 'CG.EJ.LMJ.004', 'YOSOWILANGUN', 'XL', 'on air', '113.261', '-8.2253', 'EAST JAVA', 'Lumajang', 'Dsn Tulusmulyo RT 03 RW 03 Desa Karangrejo Kab. Lumajang', 'Available', 'GF', 'SST-3legs', '0', '52', 'yes', '0', '0', 'N', 'PKS 10th');
INSERT INTO `rsite` VALUES ('35', 'CG.EJ.LMJ.005', 'PAGOWANDMT', 'XL', 'on air', '113.096', '-8.12957', 'EAST JAVA', 'Lumajang', 'Dsn. Kebonan Rt 01 RW 10 Ds Kertosari Kec. Pasru Jambe Kab. Lumajang', 'Available', 'GF', 'SST-3legs', '0', '52', '', '0', '0', 'N', 'PKS 10th');
INSERT INTO `rsite` VALUES ('36', 'CG.EJ.TBN.001', 'RAWASARI', 'XL', 'on air', '112.004', '-6.82917', 'EAST JAVA', 'Tuban', 'Dusun Krajan Rt.04. RW.03 Desa Beji Kel. Beji, Kec. Jenuh, Kab. Tuban - Jawa Timur', 'Available', 'GF', 'SST-3legs', '0', '42', 'yes', '42', '0', 'N', 'PKS 10th');
INSERT INTO `rsite` VALUES ('37', 'CG.EJ.SBY.010', 'Ketintang', 'Isat', 'on air', '112.728', '-7.31643', 'EAST JAVA', 'Surabaya', 'Jl. Ketintang Baru 13/32 Surabaya', 'Available', 'RT', 'Pole-6M', '15', '21', 'yes', '21', '0', 'N', 'PKS 10th');
INSERT INTO `rsite` VALUES ('38', 'CG.EJ.LMJ.001', 'KedungJajang2', 'Isat', 'on air', '113.234', '-8.02244', 'EAST JAVA', 'Lumajang', 'Dusun Krajan RT 003/RW01 Kel Grobogan Kec Kedungjajang Kab Lumajang', 'Available', 'GF', 'SST-3legs', '0', '52', 'yes', '0', '0', 'N', 'PKS 10th');
INSERT INTO `rsite` VALUES ('39', 'CG.EJ.LMJ.002', 'Wonocepokoayu', 'Isat', 'on air', '113.098', '-8.05762', 'EAST JAVA', 'Lumajang', 'Dusun Krajan RT 003/RW01 Kel Wonocempokoayu Kec Senduro Kab Lumajang', 'Available', 'GF', 'SST-3legs', '0', '50', 'yes', '0', '0', 'N', 'PKS 10th');

-- ----------------------------
-- Table structure for rsite_jns
-- ----------------------------
DROP TABLE IF EXISTS `rsite_jns`;
CREATE TABLE `rsite_jns` (
  `id1` bigint(20) NOT NULL,
  `jenis` enum('b2s','collocation') NOT NULL,
  `id_bouwher` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='jenis proses sewa, ada B2S dan collocation';

-- ----------------------------
-- Records of rsite_jns
-- ----------------------------
INSERT INTO `rsite_jns` VALUES ('70', 'b2s', '1');
INSERT INTO `rsite_jns` VALUES ('24', 'b2s', '2');
INSERT INTO `rsite_jns` VALUES ('26', 'b2s', '3');
INSERT INTO `rsite_jns` VALUES ('62', 'b2s', '5');
INSERT INTO `rsite_jns` VALUES ('30', 'collocation', '2');
INSERT INTO `rsite_jns` VALUES ('59', 'collocation', '4');
INSERT INTO `rsite_jns` VALUES ('39', 'collocation', '5');

-- ----------------------------
-- Table structure for rsite_pengeluaran
-- ----------------------------
DROP TABLE IF EXISTS `rsite_pengeluaran`;
CREATE TABLE `rsite_pengeluaran` (
  `id1` bigint(20) NOT NULL,
  `id_rsite` bigint(20) NOT NULL DEFAULT '0',
  `keterangan` varchar(100) NOT NULL DEFAULT '0',
  `jenis_biaya` enum('gaji','listrik','lain') NOT NULL DEFAULT 'gaji',
  `jumlah` decimal(20,2) NOT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `sudah_bayar` smallint(6) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rsite_pengeluaran
-- ----------------------------
INSERT INTO `rsite_pengeluaran` VALUES ('2', '3', 'Gaji Pegawai Edit', 'gaji', '1000000.00', '2018-05-19', '0');
INSERT INTO `rsite_pengeluaran` VALUES ('3', '5', '-', 'gaji', '4500000.00', '2018-05-20', '0');
INSERT INTO `rsite_pengeluaran` VALUES ('5', '5', '-', 'listrik', '13500000.00', '2018-04-20', '1');
INSERT INTO `rsite_pengeluaran` VALUES ('6', '11', 'Mei 2018', 'listrik', '3500000.00', '2018-05-30', '0');
INSERT INTO `rsite_pengeluaran` VALUES ('7', '11', 'Gaji Mei 2018', 'gaji', '4500000.00', '2018-05-30', '0');
INSERT INTO `rsite_pengeluaran` VALUES ('8', '13', 'Listrik', 'listrik', '4500000.00', '2018-06-24', '1');
INSERT INTO `rsite_pengeluaran` VALUES ('9', '6', 'sewa lahan agustus 2018', 'lain', '1000000.00', '2018-08-14', '0');
INSERT INTO `rsite_pengeluaran` VALUES ('11', '16', 'Hari Kemerdekaan Indonesia', 'gaji', '1.00', '2018-08-20', '1');
INSERT INTO `rsite_pengeluaran` VALUES ('12', '16', 'coba----', 'gaji', '3000000.00', '2018-08-01', '0');

-- ----------------------------
-- Table structure for rsite_penyewa
-- ----------------------------
DROP TABLE IF EXISTS `rsite_penyewa`;
CREATE TABLE `rsite_penyewa` (
  `id1` bigint(20) NOT NULL,
  `id_rsite` bigint(20) DEFAULT NULL,
  `jenis` enum('b2s','collocation') DEFAULT NULL,
  `id_bouwherr` bigint(20) DEFAULT NULL,
  `operator` varchar(50) DEFAULT NULL,
  `nospk` varchar(50) DEFAULT NULL,
  `typeskn` varchar(50) DEFAULT NULL,
  `tglspk` date DEFAULT NULL,
  `tglrfi` date DEFAULT NULL,
  `leasestart` date DEFAULT NULL,
  `leaseend` date DEFAULT NULL,
  `status` enum('baru','selesai','perpanjang','ongoing') DEFAULT NULL,
  `masa_sistem_pembayaran` varchar(50) DEFAULT NULL,
  `nilai_kontrak` decimal(20,0) DEFAULT NULL,
  `sewa_per_thn` decimal(20,0) DEFAULT NULL,
  `periode_tagihan` int(11) DEFAULT '1' COMMENT 'periode pemunculan invoice satuan dalam bulan',
  `nilai_invoice_pertagihan` decimal(20,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rsite_penyewa
-- ----------------------------
INSERT INTO `rsite_penyewa` VALUES ('2', '3', 'b2s', '4', 'XL Edit', 'SPK-212', 'kontrak', '2018-05-19', '2018-05-19', '2018-05-19', '2018-05-19', 'baru', '6 tahun', '1000000', '30000000', '1', null);
INSERT INTO `rsite_penyewa` VALUES ('5', '6', 'collocation', '3', 'PT SMARTFREN', 'asasa', 'kontrak', '2018-05-27', '2018-05-27', '2018-05-27', '2018-05-27', 'baru', '6 tahun', '1000000', '40000000', '1', null);
INSERT INTO `rsite_penyewa` VALUES ('6', '10', 'b2s', '2', 'PT INDOSAT.TBK', '12', '-', '2018-05-30', '2018-05-30', '2018-05-30', '2018-05-30', 'baru', '6 bulan', '1000000', '35000000', '1', null);
INSERT INTO `rsite_penyewa` VALUES ('7', '11', 'b2s', '2', 'PT INDOSAT.TBK', '24/SPK/2018', '-', '2018-05-30', '2018-05-30', '2018-05-30', '2020-05-30', 'baru', '6 bulan', '1000000', '30000000', '1', null);
INSERT INTO `rsite_penyewa` VALUES ('8', '6', 'b2s', '4', 'Excelcomindo', 'SPK-212', 'kontrak', '2018-06-01', '2018-06-01', '2018-06-01', '2018-06-01', '', '6 tahun', '1000000', '30000000', '1', null);
INSERT INTO `rsite_penyewa` VALUES ('9', '13', 'b2s', '4', 'Excelcomindo', '-', '-', '2018-06-24', '2018-06-24', '2018-02-24', '2018-06-26', 'baru', '12 bulan', '1000000', '30000000', '1', null);
INSERT INTO `rsite_penyewa` VALUES ('10', '13', 'collocation', '1', 'PT. Telkom Indonesia 12', '-', '-', '2018-06-24', '2018-06-24', '2018-06-24', '2018-06-24', 'baru', '6 bulan', '1000000', '30000000', '1', null);
INSERT INTO `rsite_penyewa` VALUES ('12', '17', 'b2s', '1', 'PT. Telkom Indonesia 12', '6601415', 'Site Macro', '2011-12-21', '2012-07-16', '2012-07-08', '2012-07-08', '', '30 hari', '1000000', '30000000', '1', null);
INSERT INTO `rsite_penyewa` VALUES ('13', '18', 'b2s', '4', 'Excelcomindo', '6601415', 'Macro', '2011-12-21', '2012-04-05', '2012-05-21', '2012-05-21', 'baru', '30 hari', '2000000', '30000000', '1', null);
INSERT INTO `rsite_penyewa` VALUES ('14', '19', 'b2s', '4', 'Excelcomindo', '6600944', 'Site Macro', '2011-03-18', '2011-06-25', '2011-07-19', '2011-07-19', '', '30 hari', '1000000', '30000000', '1', null);
INSERT INTO `rsite_penyewa` VALUES ('15', '20', 'b2s', '4', 'Excelcomindo', '6600224', 'Site Macro', '2011-12-07', '2011-07-13', '2012-07-08', '2022-07-08', '', '30 hari', '1000000', '30000000', '1', null);
INSERT INTO `rsite_penyewa` VALUES ('16', '27', 'b2s', '4', 'Excelcomindo', '6601415', 'Site Macro', '2011-12-21', '2012-07-16', '2012-07-08', '2022-07-08', '', '30 hari', '1000000', '30000000', '1', null);
INSERT INTO `rsite_penyewa` VALUES ('17', '28', 'b2s', '4', 'Excelcomindo', '6601916', 'Site Macro', '2012-09-21', '2012-05-28', '2012-06-22', '2022-06-22', 'baru', '30 hari', '1000000', '30000000', '1', null);
INSERT INTO `rsite_penyewa` VALUES ('18', '29', 'b2s', '1', 'PT. Telkom Indonesia 12', '6606051', 'Site Macro', '2012-11-30', '2012-12-19', '2012-12-21', '2022-12-21', '', '30 hari', '1000000', '30000000', '1', null);
INSERT INTO `rsite_penyewa` VALUES ('19', '16', 'b2s', '1', 'PT. Telkom Indonesia 12', '6600101', 'Site Macro', '2011-11-05', '2012-02-23', '2012-04-17', '2012-04-17', 'baru', '30 hari', null, null, '1', null);
INSERT INTO `rsite_penyewa` VALUES ('20', '16', 'b2s', '1', 'PT. Telkom Indonesia 12', '6600101', 'Site Macro', '2018-08-26', '2018-08-26', '2018-08-26', '2018-08-26', 'baru', '30 hari', '100000001', null, '1', null);
INSERT INTO `rsite_penyewa` VALUES ('21', '16', 'b2s', '1', 'PT. Telkom Indonesia 12', '6600101', 'Site Macro', '2018-08-26', '2018-08-26', '2018-08-26', '2018-08-26', 'baru', '30 hari', '50000000', null, '1', null);
INSERT INTO `rsite_penyewa` VALUES ('22', '16', 'b2s', '1', 'PT. Telkom Indonesia 12', '6600101', 'Site Macro', '2018-08-26', '2018-08-26', '2018-08-26', '2018-08-26', 'baru', '30 hari', '2000000', null, '1', '1000000');
INSERT INTO `rsite_penyewa` VALUES ('25', '16', 'b2s', '1', 'PT. Telkom Indonesia 12', '6600101', 'Site Macro', '2018-08-26', '2018-08-26', '2018-08-26', '2018-08-26', 'baru', '30 hari', '100000000', null, '1', '3000000');
INSERT INTO `rsite_penyewa` VALUES ('26', '16', 'b2s', '1', 'PT. Telkom Indonesia 12', '6600101', 'Site Macro', '2018-08-26', '2018-08-26', '2018-08-26', '2018-08-26', 'baru', '30 hari', '200000000', null, '1', '3000000');
INSERT INTO `rsite_penyewa` VALUES ('29', '16', 'b2s', '1', 'PT. Telkom Indonesia 12', '6600101', 'Site Macro', '2018-08-28', '2018-08-28', '2018-08-28', '2018-08-28', 'baru', '30 hari', '10000000', null, '2', '2000000');

-- ----------------------------
-- Table structure for rsite_penyewa_aman
-- ----------------------------
DROP TABLE IF EXISTS `rsite_penyewa_aman`;
CREATE TABLE `rsite_penyewa_aman` (
  `id1` bigint(20) NOT NULL,
  `id_rsite_penyewa` bigint(20) NOT NULL DEFAULT '0',
  `tgl` date NOT NULL,
  `nospk` varchar(50) NOT NULL,
  `jenisperubahan` enum('no spk','tgl spk','tgl sewa','lainnya') NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rsite_penyewa_aman
-- ----------------------------
INSERT INTO `rsite_penyewa_aman` VALUES ('2', '2', '2018-05-19', 'SPK123 Editxxxxxx', 'tgl sewa', 'Gak ada Editing');
INSERT INTO `rsite_penyewa_aman` VALUES ('4', '9', '2018-06-24', '12', 'no spk', '-');

-- ----------------------------
-- Table structure for rsite_penyewa_file
-- ----------------------------
DROP TABLE IF EXISTS `rsite_penyewa_file`;
CREATE TABLE `rsite_penyewa_file` (
  `id1` bigint(20) NOT NULL,
  `id_rsite_penyewa` bigint(20) NOT NULL DEFAULT '0',
  `tgl_upload` date NOT NULL,
  `deskripsi` text NOT NULL,
  `tgl_receive` date NOT NULL,
  `namafile` varchar(255) NOT NULL,
  `keterangan` enum('SPK','Invoice','Lain') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rsite_penyewa_file
-- ----------------------------
INSERT INTO `rsite_penyewa_file` VALUES ('4', '2', '2018-05-20', 'Coba upload raisa', '2018-05-20', '20-05-2018-03-52-20-9979.jpg', 'SPK');
INSERT INTO `rsite_penyewa_file` VALUES ('6', '5', '2018-05-29', 'spk', '2018-05-29', '29-05-2018-03-09-23-1641.pdf', 'SPK');
INSERT INTO `rsite_penyewa_file` VALUES ('7', '7', '2018-05-30', 'bukti bayar PBB Maret 2018', '2018-05-30', '30-05-2018-02-46-50-2328.pdf', 'Lain');
INSERT INTO `rsite_penyewa_file` VALUES ('8', '9', '2018-06-24', '-', '2018-06-24', '24-06-2018-03-57-27-1159.pdf', 'SPK');

-- ----------------------------
-- Table structure for rsite_penyewa_keuangan
-- ----------------------------
DROP TABLE IF EXISTS `rsite_penyewa_keuangan`;
CREATE TABLE `rsite_penyewa_keuangan` (
  `id1` bigint(20) NOT NULL,
  `id_rsite_penyewa` bigint(20) NOT NULL DEFAULT '0',
  `tagihan_ke` varchar(200) NOT NULL,
  `no_invoice` varchar(100) NOT NULL DEFAULT '0',
  `tgl_invoice` date NOT NULL,
  `no_po` varchar(100) NOT NULL COMMENT 'dasar PO',
  `sudah_dibayar` smallint(6) NOT NULL DEFAULT '0' COMMENT '0 : belum / 1 sudah',
  `tgl_bayar` date DEFAULT NULL,
  `nilai_invoice` decimal(20,0) NOT NULL,
  `sudah_dicetak` smallint(6) NOT NULL DEFAULT '0' COMMENT 'menunjukkan sudah di cetak atau belum',
  `sudah_dikirim` smallint(6) NOT NULL DEFAULT '0',
  `tgl_dikirim` date DEFAULT NULL,
  `sudah_diterim_user` smallint(6) NOT NULL DEFAULT '0',
  `tgl_diterima_user` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rsite_penyewa_keuangan
-- ----------------------------
INSERT INTO `rsite_penyewa_keuangan` VALUES ('1', '2', '', '12345', '2018-05-19', '67890 Edit', '1', '2018-05-19', '1500000', '0', '0', '0000-00-00', '0', '0000-00-00');
INSERT INTO `rsite_penyewa_keuangan` VALUES ('4', '5', '', '13', '2018-05-29', '13', '0', '2018-05-29', '4500000', '0', '0', '0000-00-00', '0', '0000-00-00');
INSERT INTO `rsite_penyewa_keuangan` VALUES ('5', '7', '', '21', '2018-05-30', '21/2018', '0', '2018-05-30', '17500000', '0', '0', '0000-00-00', '0', '0000-00-00');
INSERT INTO `rsite_penyewa_keuangan` VALUES ('6', '9', '', '12', '2018-06-24', '12', '0', '2018-06-24', '6500000', '0', '0', '0000-00-00', '0', '0000-00-00');
INSERT INTO `rsite_penyewa_keuangan` VALUES ('12', '26', '1', '1', '2018-08-26', '1', '0', '0000-11-30', '3200000', '1', '0', '0000-00-00', '1', '2018-08-27');
INSERT INTO `rsite_penyewa_keuangan` VALUES ('13', '26', '2', '2', '2018-08-26', '1', '0', '2018-08-26', '3200000', '0', '0', '0000-00-00', '0', '0000-00-00');
INSERT INTO `rsite_penyewa_keuangan` VALUES ('16', '26', '4', '4', '2018-08-27', '1', '0', '2018-08-27', '3000000', '0', '0', '2018-08-27', '0', '0000-00-00');
INSERT INTO `rsite_penyewa_keuangan` VALUES ('20', '26', '12', '11', '2018-08-27', '1', '0', '0000-00-00', '3000000', '0', '0', '2018-08-27', '0', '0000-00-00');
INSERT INTO `rsite_penyewa_keuangan` VALUES ('25', '25', '2', '16252', '2018-08-28', '1', '0', '0000-00-00', '3000000', '0', '0', '2018-08-28', '0', '0000-00-00');
INSERT INTO `rsite_penyewa_keuangan` VALUES ('26', '25', '3', '00000000026', '2018-08-28', '1', '0', '0000-00-00', '3000000', '0', '0', '2018-08-28', '0', '0000-00-00');
INSERT INTO `rsite_penyewa_keuangan` VALUES ('27', '25', '4', '00000000027', '2018-08-28', '1', '0', '0000-00-00', '3000000', '0', '0', '2018-08-28', '0', '0000-00-00');
INSERT INTO `rsite_penyewa_keuangan` VALUES ('28', '25', '5', '00000000028', '2018-08-28', '1', '0', '0000-00-00', '3000000', '0', '0', '2018-08-28', '0', '0000-00-00');
INSERT INTO `rsite_penyewa_keuangan` VALUES ('30', '29', '1', '00000000029', '2018-08-28', '1', '0', '0000-00-00', '2000000', '0', '0', '0000-00-00', '0', '0000-00-00');
INSERT INTO `rsite_penyewa_keuangan` VALUES ('31', '29', '2', '00000000031', '2018-08-28', '1', '0', '2018-08-28', '2000000', '0', '0', '2018-08-28', '0', '0000-00-00');
INSERT INTO `rsite_penyewa_keuangan` VALUES ('36', '29', '3', '00000000032', '2018-08-28', '1', '0', null, '2000000', '0', '0', '2018-08-29', '0', null);
INSERT INTO `rsite_penyewa_keuangan` VALUES ('44', '29', '4', '00000000036', '2018-08-29', '1', '0', null, '2000000', '0', '0', '2018-08-29', '0', null);

-- ----------------------------
-- Table structure for rsite_penyewa_subkon
-- ----------------------------
DROP TABLE IF EXISTS `rsite_penyewa_subkon`;
CREATE TABLE `rsite_penyewa_subkon` (
  `id1` bigint(20) NOT NULL,
  `id_rsite_penyewa` bigint(20) NOT NULL DEFAULT '0',
  `id_subkon` bigint(20) NOT NULL DEFAULT '0',
  `material` varchar(100) NOT NULL,
  `uraian_pekerjaan` text NOT NULL,
  `qty` double NOT NULL,
  `uom` varchar(50) NOT NULL,
  `unit_price` decimal(20,2) NOT NULL,
  `termasukppn` enum('Y','N') NOT NULL,
  `sub_total` decimal(20,2) NOT NULL,
  `tglselesai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rsite_penyewa_subkon
-- ----------------------------
INSERT INTO `rsite_penyewa_subkon` VALUES ('1', '2', '1', 'Baja', 'Meninjau ini\r\nMeninjau itu', '10', 'UOM-098', '15000.00', 'Y', '150000.00', '2018-05-20');
INSERT INTO `rsite_penyewa_subkon` VALUES ('4', '5', '1', '4400000080', 'RETRIBUSI', '3', 'PACKET', '1000000.00', 'Y', '3000000.00', '2018-05-29');
INSERT INTO `rsite_penyewa_subkon` VALUES ('5', '7', '2', '4400000080', 'RETRIBUSI, PBB', '2', 'PACKET', '1000000.00', 'Y', '2000000.00', '2018-05-30');
INSERT INTO `rsite_penyewa_subkon` VALUES ('6', '9', '2', '1300000943', '-', '3', 'PACKET', '450000.00', 'Y', '1350000.00', '2018-06-24');

-- ----------------------------
-- Table structure for rsite_sewa
-- ----------------------------
DROP TABLE IF EXISTS `rsite_sewa`;
CREATE TABLE `rsite_sewa` (
  `id1` bigint(20) NOT NULL,
  `id_rsite` bigint(20) NOT NULL DEFAULT '0',
  `leasestart` date DEFAULT NULL,
  `leaseend` date DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT '0',
  `nilai_sewa` decimal(20,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of rsite_sewa
-- ----------------------------
INSERT INTO `rsite_sewa` VALUES ('12', '10', '2018-05-29', '2018-05-29', '', null);
INSERT INTO `rsite_sewa` VALUES ('13', '10', '2018-05-29', '2020-05-29', 'SPK No 232/2323/2018', null);
INSERT INTO `rsite_sewa` VALUES ('14', '11', '2018-05-30', '2025-05-30', '-', null);
INSERT INTO `rsite_sewa` VALUES ('22', '17', '2012-07-08', '2022-07-08', '', null);
INSERT INTO `rsite_sewa` VALUES ('23', '18', '2012-05-21', '2022-05-21', '', null);
INSERT INTO `rsite_sewa` VALUES ('24', '19', '2011-07-19', '2021-07-19', '', null);
INSERT INTO `rsite_sewa` VALUES ('25', '20', '2012-07-08', '2022-07-08', '', null);
INSERT INTO `rsite_sewa` VALUES ('26', '21', '2018-08-15', '2018-08-15', 'Lease Start dan Lease End >>>belum', null);
INSERT INTO `rsite_sewa` VALUES ('27', '22', '2012-09-28', '2024-09-28', '', null);
INSERT INTO `rsite_sewa` VALUES ('28', '23', '2018-08-15', '2018-08-15', '', null);
INSERT INTO `rsite_sewa` VALUES ('29', '24', '2018-08-15', '2018-08-15', '', null);
INSERT INTO `rsite_sewa` VALUES ('30', '25', '2018-08-15', '2018-08-15', '', null);
INSERT INTO `rsite_sewa` VALUES ('31', '26', '2018-08-15', '2018-08-15', '', null);
INSERT INTO `rsite_sewa` VALUES ('33', '28', '2012-06-22', '2022-06-22', '', null);
INSERT INTO `rsite_sewa` VALUES ('34', '29', '2012-12-21', '2022-12-21', '', null);
INSERT INTO `rsite_sewa` VALUES ('36', '31', '2018-08-16', '2018-08-16', '', null);
INSERT INTO `rsite_sewa` VALUES ('37', '32', '2018-08-16', '2018-08-16', '', null);
INSERT INTO `rsite_sewa` VALUES ('38', '33', '2018-08-16', '2018-08-16', '', null);
INSERT INTO `rsite_sewa` VALUES ('39', '34', '2018-08-16', '2018-08-16', '', null);
INSERT INTO `rsite_sewa` VALUES ('40', '35', '2018-08-16', '2018-08-16', '', null);
INSERT INTO `rsite_sewa` VALUES ('41', '36', '2018-08-16', '2018-08-16', '', null);
INSERT INTO `rsite_sewa` VALUES ('42', '37', '2018-08-16', '2018-08-16', '', null);
INSERT INTO `rsite_sewa` VALUES ('43', '38', '2018-08-16', '2018-08-16', '', null);
INSERT INTO `rsite_sewa` VALUES ('44', '39', '2018-08-16', '2018-08-16', '', null);
INSERT INTO `rsite_sewa` VALUES ('47', '30', '2018-08-16', '2018-08-16', '', null);
INSERT INTO `rsite_sewa` VALUES ('48', '27', '2012-07-08', '2012-07-16', '', '0');

-- ----------------------------
-- Table structure for tlogin
-- ----------------------------
DROP TABLE IF EXISTS `tlogin`;
CREATE TABLE `tlogin` (
  `uname` varchar(50) NOT NULL,
  `pwd` varchar(120) DEFAULT NULL,
  `level` enum('1','2','3') DEFAULT NULL COMMENT '1 : admin, 2: manajemen, 3: operator'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tlogin
-- ----------------------------
INSERT INTO `tlogin` VALUES ('admin', '$2y$10$t.a.WDVHWhCFIJa/GtP0q.L4Y8hJyc0ibDD8WzlUrXBo6/dXQ//G.', '1');

-- ----------------------------
-- Table structure for tvariabel
-- ----------------------------
DROP TABLE IF EXISTS `tvariabel`;
CREATE TABLE `tvariabel` (
  `ket` varchar(50) NOT NULL,
  `value1` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tvariabel
-- ----------------------------
INSERT INTO `tvariabel` VALUES ('nmgm', 'Kurniawan EP');

-- ----------------------------
-- View structure for v_blm_invoice
-- ----------------------------
DROP VIEW IF EXISTS `v_blm_invoice`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost`  VIEW `v_blm_invoice` AS select `project1`.`idproject` AS `idproject`,`project1`.`namaproject` AS `namaproject`,`bouwherr`.`nama` AS `nama`,`project1_powo`.`no1` AS `noPO`,`project1_powo`.`tgl` AS `tglPO`,`project1_powo`.`delivery_date` AS `delivery_date`,`project1_powo_baut`.`no_baut` AS `no_baut`,`project1_powo_baut`.`tgl_baut` AS `tgl_baut`,`project1_invoice`.`tglinvoice` AS `tglinvoice`,`project1_invoice`.`invoice_sudah_dikirm` AS `invoice_sudah_dikirm`,`project1_powo_baut`.`tgl_gr` AS `tgl_gr`,`project1_powo_baut`.`no_gr` AS `no_gr` from ((((`project1` left join `bouwherr` on(`project1`.`idbouwheer` = `bouwherr`.`idbouwherr`)) left join `project1_powo` on(`project1_powo`.`id1_project` = `project1`.`id1`)) left join `project1_powo_baut` on(`project1_powo_baut`.`id_project1powo` = `project1_powo`.`id1`)) left join `project1_invoice` on(`project1_invoice`.`id_project1_powobaut` = `project1_powo_baut`.`id1`)) where `project1_powo_baut`.`no_baut` is not null and `project1_invoice`.`tglinvoice` is null ;

-- ----------------------------
-- View structure for v_project_aktif
-- ----------------------------
DROP VIEW IF EXISTS `v_project_aktif`;
CREATE ALGORITHM=UNDEFINED DEFINER=`carexidc`@`localhost` SQL SECURITY DEFINER  VIEW `v_project_aktif` AS select `project1`.`id1` AS `id1`,`project1`.`idproject` AS `idproject`,`project1`.`namaproject` AS `namaproject`,`project1`.`tglmulai` AS `tglmulai`,`project1`.`tglselesai` AS `tglselesai`,`bouwherr`.`nama` AS `nama`,`project1_status`.`keterangan` AS `keterangan`,`project1_status`.`status` AS `status` from ((`project1` left join `bouwherr` on(`project1`.`idbouwheer` = `bouwherr`.`idbouwherr`)) left join `project1_status` on(`project1_status`.`id1_project` = `project1`.`id1`)) where `project1_status`.`keterangan`  not like '%invoice%' or `project1_status`.`status` <> 'close' or `project1_status`.`keterangan` is null ;

-- ----------------------------
-- View structure for v_project_baut
-- ----------------------------
DROP VIEW IF EXISTS `v_project_baut`;
CREATE ALGORITHM=UNDEFINED DEFINER=`carexidc`@`localhost` SQL SECURITY DEFINER  VIEW `v_project_baut` AS select `project1`.`id1` AS `id_project`,`project1`.`namaproject` AS `pekerjaan`,`project1`.`nokontrak` AS `nokontrak`,`project1`.`tglkontrak` AS `tglkontrak`,`project1`.`deskripsi` AS `deskripsi`,`project1_powo`.`id1` AS `id_powo`,`project1_powo`.`jenis` AS `jenis_po_wo`,`project1_powo`.`no1` AS `no_po`,`project1_powo`.`tgl` AS `tgl_po`,`project1_powo`.`delivery_date` AS `rfs_po`,`project1`.`tglselesai` AS `rfs_kontrak`,`project1`.`siteid` AS `siteid_project`,`project1_powo_baut`.`id1` AS `id_baut`,`project1_powo_baut`.`tgl_baut` AS `tgl_baut`,`project1_powo_baut`.`no_baut` AS `no_baut`,`project1_powo_baut`.`no_atp` AS `no_atp`,`project1_powo_baut`.`tgl_atp` AS `tgl_pemeriksaan`,`project1_powo_baut`.`catatan` AS `catatan`,`project1_powo_baut_dtl`.`id1` AS `id_baut_detil`,`project1_powo_baut_dtl`.`material` AS `material`,`project1_powo_baut_dtl`.`uraian_pekerjaan` AS `uraian_pekerjaan`,`project1_powo_baut_dtl`.`uraian_pekerjaan2` AS `uraian_pekerjaan2`,`project1_powo_baut_dtl`.`qty` AS `qty`,`project1_powo_baut_dtl`.`uom` AS `uom`,`project1_powo_baut_dtl`.`unit_price` AS `unit_price`,`project1_powo_baut_dtl`.`realisasi_sebelumnya` AS `realisasi_sebelumnya`,`project1_powo_baut_dtl`.`realisasi` AS `realisasi`,`project1_powo_baut_dtl`.`sisa` AS `sisa`,`project1_powo_baut_dtl`.`hasil` AS `hasil`,`project1_powo_baut_dtl`.`keterangan` AS `keterangan`,`project1_powo_baut_dtl`.`sub_total` AS `sub_total` from (((`project1` left join `project1_powo` on(`project1_powo`.`id1_project` = `project1`.`id1`)) left join `project1_powo_baut` on(`project1_powo_baut`.`id_project1powo` = `project1_powo`.`id1`)) left join `project1_powo_baut_dtl` on(`project1_powo_baut_dtl`.`id_project1_powobaut` = `project1_powo_baut`.`id1`)) order by `project1`.`id1`,`project1_powo`.`id1`,`project1_powo_baut`.`id1`,`project1_powo_baut_dtl`.`material` ;

-- ----------------------------
-- View structure for v_project_blm_rfi
-- ----------------------------
DROP VIEW IF EXISTS `v_project_blm_rfi`;
CREATE ALGORITHM=UNDEFINED DEFINER=`carexidc`@`localhost` SQL SECURITY DEFINER  VIEW `v_project_blm_rfi` AS select `project1`.`idproject` AS `idproject`,`project1`.`namaproject` AS `namaproject`,`bouwherr`.`nama` AS `nama`,`project1`.`deskripsi` AS `deskripsi`,`project1`.`tglmulai` AS `tglmulai`,`project1`.`tglselesai` AS `tglselesai`,`project1`.`rfi` AS `rfi` from (`project1` left join `bouwherr` on(`project1`.`idbouwheer` = `bouwherr`.`idbouwherr`)) where `project1`.`rfi` is null or `project1`.`rfi` <> 1 ;

-- ----------------------------
-- View structure for v_project_dash
-- ----------------------------
DROP VIEW IF EXISTS `v_project_dash`;
CREATE ALGORITHM=UNDEFINED DEFINER=`carexidc`@`localhost` SQL SECURITY DEFINER  VIEW `v_project_dash` AS select `project1`.`id1` AS `id1`,`project1`.`idproject` AS `idproject`,`project1`.`namaproject` AS `namaproject`,sum(`project1_powo_hpp`.`sub_total`) AS `hpp`,sum(`project1_keuangan`.`nilai`) AS `pengeluaran`,sum(`project1_keuangan`.`nilai`) / sum(`project1_powo_hpp`.`sub_total`) * 100 AS `prosen1`,sum(`project1_powo_hpp`.`sub_total`) - sum(`project1_keuangan`.`nilai`) AS `sisa`,`project1`.`tglmulai` AS `tglmulai`,`project1`.`tglselesai` AS `tglselesai` from (((`project1` left join `project1_keuangan` on(`project1_keuangan`.`id1_project` = `project1`.`id1`)) left join `project1_powo` on(`project1_powo`.`id1_project` = `project1`.`id1`)) left join `project1_powo_hpp` on(`project1_powo_hpp`.`id_project1powo` = `project1_powo`.`id1`)) group by `project1`.`id1`,`project1`.`idproject`,`project1`.`namaproject`,`project1`.`tglmulai`,`project1`.`tglselesai` ;

-- ----------------------------
-- View structure for v_project_deadline
-- ----------------------------
DROP VIEW IF EXISTS `v_project_deadline`;
CREATE ALGORITHM=UNDEFINED DEFINER=`carexidc`@`localhost` SQL SECURITY DEFINER  VIEW `v_project_deadline` AS select distinct `project1`.`id1` AS `id1`,`project1`.`idproject` AS `idproject`,`project1`.`namaproject` AS `namaproject`,`project1`.`tglmulai` AS `tglmulai`,`project1`.`tglselesai` AS `tglselesai`,to_days(`project1`.`tglselesai`) - to_days(curdate()) AS `deadline` from (`project1` left join `project1_status` on(`project1_status`.`id1_project` = `project1`.`id1`)) where `project1_status`.`keterangan` < '7' or `project1_status`.`keterangan` is null and to_days(`project1`.`tglselesai`) - to_days(curdate()) <= 30 ;

-- ----------------------------
-- View structure for v_project_hpp
-- ----------------------------
DROP VIEW IF EXISTS `v_project_hpp`;
CREATE ALGORITHM=UNDEFINED DEFINER=`carexidc`@`localhost` SQL SECURITY DEFINER  VIEW `v_project_hpp` AS select `project1`.`idproject` AS `idproject`,`project1`.`namaproject` AS `namaproject`,`bouwherr`.`nama` AS `bouwherr`,sum(`project1_powo_hpp`.`sub_total`) AS `totahpp` from (((`project1` left join `bouwherr` on(`project1`.`idbouwheer` = `bouwherr`.`idbouwherr`)) left join `project1_powo` on(`project1_powo`.`id1_project` = `project1`.`id1`)) left join `project1_powo_hpp` on(`project1_powo_hpp`.`id_project1powo` = `project1_powo`.`id1`)) group by `project1`.`idproject`,`project1`.`namaproject`,`bouwherr`.`nama` ;

-- ----------------------------
-- View structure for v_project_lama_overdue
-- ----------------------------
DROP VIEW IF EXISTS `v_project_lama_overdue`;
CREATE ALGORITHM=UNDEFINED DEFINER=`carexidc`@`localhost` SQL SECURITY DEFINER  VIEW `v_project_lama_overdue` AS select `project1`.`id1` AS `id1`,`project1`.`idproject` AS `idproject`,`project1`.`namaproject` AS `namaproject`,`bouwherr`.`nama` AS `nama`,`project1_powo`.`no1` AS `nopo`,`project1_powo`.`tgl` AS `tglpo`,`project1_powo`.`delivery_date` AS `delivery_date`,`project1_powo_sub`.`uraian_pekerjaan` AS `uraian_pekerjaan`,`project1_powo_sub`.`status_subkegiatan` AS `status_subkegiatan`,curdate() AS `current_date()`,to_days(curdate()) - to_days(`project1_powo`.`tgl`) AS `hari` from (((`project1` left join `project1_powo` on(`project1_powo`.`id1_project` = `project1`.`id1`)) left join `bouwherr` on(`project1`.`idbouwheer` = `bouwherr`.`idbouwherr`)) left join `project1_powo_sub` on(`project1_powo_sub`.`id1_project1_powo` = `project1_powo`.`id1`)) where (`project1_powo_sub`.`status_subkegiatan` is null or `project1_powo_sub`.`status_subkegiatan` <> 'close') and to_days(curdate()) - to_days(`project1_powo`.`tgl`) >= 300 ;

-- ----------------------------
-- View structure for v_project_po_baut_invoice
-- ----------------------------
DROP VIEW IF EXISTS `v_project_po_baut_invoice`;
CREATE ALGORITHM=UNDEFINED DEFINER=`carexidc`@`localhost` SQL SECURITY DEFINER  VIEW `v_project_po_baut_invoice` AS select `project1`.`idproject` AS `idproject`,`project1`.`namaproject` AS `namaproject`,`bouwherr`.`nama` AS `nama`,`project1_powo`.`no1` AS `noPO`,`project1_powo`.`tgl` AS `tglPO`,`project1_powo`.`delivery_date` AS `delivery_date`,`project1_powo_baut`.`no_baut` AS `no_baut`,`project1_powo_baut`.`tgl_baut` AS `tgl_baut`,`project1_invoice`.`tglinvoice` AS `tglinvoice`,`project1_invoice`.`noinvoice` AS `noinvoice`,`project1_invoice`.`invoice_sudah_dikirm` AS `invoice_sudah_dikirm` from ((((`project1` left join `bouwherr` on(`project1`.`idbouwheer` = `bouwherr`.`idbouwherr`)) left join `project1_powo` on(`project1_powo`.`id1_project` = `project1`.`id1`)) left join `project1_powo_baut` on(`project1_powo_baut`.`id_project1powo` = `project1_powo`.`id1`)) left join `project1_invoice` on(`project1_invoice`.`id_project1_powobaut` = `project1_powo_baut`.`id1`)) ;

-- ----------------------------
-- View structure for v_project_selesai
-- ----------------------------
DROP VIEW IF EXISTS `v_project_selesai`;
CREATE ALGORITHM=UNDEFINED DEFINER=`carexidc`@`localhost` SQL SECURITY DEFINER  VIEW `v_project_selesai` AS select distinct `project1`.`id1` AS `id1`,`project1`.`idproject` AS `idproject`,`project1`.`namaproject` AS `namaproject`,`project1`.`tglmulai` AS `tglmulai`,`project1`.`tglselesai` AS `tglselesai`,`project1`.`nilaiprojectdpp` AS `nilaiprojectdpp`,`project1`.`nilaiprojectppn` AS `nilaiprojectppn`,`project1`.`nilaiprojectpph` AS `nilaiprojectpph`,`project1_status`.`status` AS `status`,`project1_status`.`keterangan` AS `keterangan` from (`project1` left join `project1_status` on(`project1_status`.`id1_project` = `project1`.`id1`)) where `project1_status`.`keterangan` = '7' and `project1_status`.`status` = 'close' ;

-- ----------------------------
-- View structure for v_project_totalpengeluaran
-- ----------------------------
DROP VIEW IF EXISTS `v_project_totalpengeluaran`;
CREATE ALGORITHM=UNDEFINED DEFINER=`carexidc`@`localhost` SQL SECURITY DEFINER  VIEW `v_project_totalpengeluaran` AS select `project1`.`idproject` AS `idproject`,`project1`.`namaproject` AS `namaproject`,`bouwherr`.`nama` AS `bouwheer`,sum(`project1_keuangan`.`nilai`) AS `totalpengeluaran` from ((`project1` left join `bouwherr` on(`project1`.`idbouwheer` = `bouwherr`.`idbouwherr`)) left join `project1_keuangan` on(`project1_keuangan`.`id1_project` = `project1`.`id1`)) group by `project1`.`idproject`,`project1`.`namaproject`,`bouwherr`.`nama` ;

-- ----------------------------
-- View structure for v_proj_sdh_payment
-- ----------------------------
DROP VIEW IF EXISTS `v_proj_sdh_payment`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_proj_sdh_payment` AS select `project1`.`idproject` AS `idproject`,`project1`.`namaproject` AS `namaproject`,`bouwherr`.`nama` AS `nama`,`project1_powo`.`no1` AS `nopo`,`project1_powo`.`tgl` AS `tglpo`,`project1_powo`.`delivery_date` AS `delivery_date`,`project1_powo_baut`.`no_baut` AS `no_baut`,`project1_powo_baut`.`tgl_baut` AS `tgl_baut`,`project1_invoice`.`tglinvoice` AS `tglinvoice`,`project1_invoice`.`invoice_sudah_dikirm` AS `invoice_sudah_dikirm`,`project1_invoice`.`tglditerima` AS `tglditerima`,`project1_invoice`.`sudah_payment` AS `sudah_payment` from ((((`project1` left join `bouwherr` on(`project1`.`idbouwheer` = `bouwherr`.`idbouwherr`)) left join `project1_powo` on(`project1_powo`.`id1_project` = `project1`.`id1`)) left join `project1_powo_baut` on(`project1_powo_baut`.`id_project1powo` = `project1_powo`.`id1`)) left join `project1_invoice` on(`project1_invoice`.`id_project1_powobaut` = `project1_powo_baut`.`id1`)) where `project1_invoice`.`sudah_payment` is not null ;

-- ----------------------------
-- View structure for v_rfs_duetime
-- ----------------------------
DROP VIEW IF EXISTS `v_rfs_duetime`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_rfs_duetime` AS select `project1`.`id1` AS `id1`,`project1`.`idproject` AS `idproject`,`project1`.`namaproject` AS `namaproject`,`bouwherr`.`nama` AS `nama`,`project1_powo`.`no1` AS `no1`,`project1_powo`.`tgl` AS `tglpo`,`project1_powo`.`delivery_date` AS `delivery_date`,`project1_status`.`status` AS `status`,abs(to_days(`project1_powo`.`delivery_date`) - to_days(current_timestamp())) AS `hari` from (((`project1` left join `bouwherr` on(`project1`.`idbouwheer` = `bouwherr`.`idbouwherr`)) left join `project1_powo` on(`project1_powo`.`id1_project` = `project1`.`id1`)) left join `project1_status` on(`project1_status`.`id1_project` = `project1`.`id1`)) where (`project1_status`.`keterangan`  not like '%invoice%' or `project1_status`.`status` <> 'close' or `project1_status`.`keterangan` is null) and (abs(to_days(`project1_powo`.`delivery_date`) - to_days(current_timestamp())) <= 7 or `project1_powo`.`delivery_date` is null) ;

-- ----------------------------
-- View structure for v_rsite_datarental
-- ----------------------------
DROP VIEW IF EXISTS `v_rsite_datarental`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_rsite_datarental` AS select `rsite`.`siteid` AS `siteid`,`rsite`.`sitename` AS `sitename`,`rsite`.`address` AS `address`,`rsite_penyewa`.`jenis` AS `jenis`,`bouwherr`.`nama` AS `nama`,`rsite_penyewa`.`nospk` AS `nospk`,`rsite_penyewa`.`typeskn` AS `typeskn`,`rsite_penyewa`.`tglspk` AS `tglspk`,`rsite_penyewa`.`leasestart` AS `leasestart`,`rsite_penyewa`.`leaseend` AS `leaseend`,to_days(`rsite_penyewa`.`leaseend`) - to_days(curdate()) AS `akanberakhir`,`rsite_penyewa`.`status` AS `status` from ((`rsite` left join `rsite_penyewa` on(`rsite_penyewa`.`id_rsite` = `rsite`.`id1`)) left join `bouwherr` on(`rsite_penyewa`.`id_bouwherr` = `bouwherr`.`idbouwherr`)) ;

-- ----------------------------
-- View structure for v_rsite_datasite
-- ----------------------------
DROP VIEW IF EXISTS `v_rsite_datasite`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_rsite_datasite` AS select `rsite`.`id1` AS `id1`,`rsite`.`siteid` AS `siteid`,`rsite`.`sitename` AS `sitename`,`rsite`.`address` AS `address`,`rsite`.`city` AS `city`,`rsite`.`province` AS `province`,`rsite`.`sitecontractperiod` AS `sitecontractperiod`,max(to_days(`rsite_sewa`.`leaseend`) - to_days(curdate())) AS `akanberakhir`,max(`rsite_sewa`.`leasestart`) AS `leasestart`,max(`rsite_sewa`.`leaseend`) AS `leaseend` from (`rsite` left join `rsite_sewa` on(`rsite_sewa`.`id_rsite` = `rsite`.`id1`)) group by `rsite`.`id1`,`rsite`.`siteid`,`rsite`.`sitename`,`rsite`.`address`,`rsite`.`city`,`rsite`.`province`,`rsite`.`sitecontractperiod` ;

-- ----------------------------
-- View structure for v_rsite_expenses
-- ----------------------------
DROP VIEW IF EXISTS `v_rsite_expenses`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_rsite_expenses` AS select `rsite`.`id1` AS `id1`,`rsite`.`siteid` AS `siteid`,`rsite`.`sitename` AS `sitename`,`rsite_pengeluaran`.`id1` AS `id11`,`rsite_pengeluaran`.`keterangan` AS `keterangan`,`rsite_pengeluaran`.`jenis_biaya` AS `jenis_biaya`,`rsite_pengeluaran`.`jumlah` AS `jumlah`,`rsite_pengeluaran`.`tgl_bayar` AS `tgl_bayar`,`rsite_pengeluaran`.`sudah_bayar` AS `sudah_bayar` from (`rsite` left join `rsite_pengeluaran` on(`rsite_pengeluaran`.`id_rsite` = `rsite`.`id1`)) order by `rsite_pengeluaran`.`tgl_bayar` desc ;

-- ----------------------------
-- View structure for v_rsite_gaji
-- ----------------------------
DROP VIEW IF EXISTS `v_rsite_gaji`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_rsite_gaji` AS select `rsite`.`siteid` AS `siteid`,`rsite`.`sitename` AS `sitename`,`rsite`.`address` AS `address`,`rsite`.`city` AS `city`,`rsite`.`province` AS `province`,`rsite`.`sitecontractperiod` AS `sitecontractperiod`,`rsite_pengeluaran`.`jenis_biaya` AS `jenis_biaya`,`rsite_pengeluaran`.`jumlah` AS `jumlah`,`rsite_pengeluaran`.`tgl_bayar` AS `tgl_bayar`,`rsite_pengeluaran`.`sudah_bayar` AS `sudah_bayar` from (`rsite` left join `rsite_pengeluaran` on(`rsite_pengeluaran`.`id_rsite` = `rsite`.`id1`)) where `rsite_pengeluaran`.`jenis_biaya` = 'gaji' and (`rsite_pengeluaran`.`sudah_bayar` <> 1 or `rsite_pengeluaran`.`sudah_bayar` is null) ;

-- ----------------------------
-- View structure for v_rsite_invoice_blm_cetak
-- ----------------------------
DROP VIEW IF EXISTS `v_rsite_invoice_blm_cetak`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_rsite_invoice_blm_cetak` AS select `rsite`.`id1` AS `id1`,`rsite`.`siteid` AS `siteid`,`rsite`.`sitename` AS `sitename`,`rsite_penyewa`.`operator` AS `operator`,`rsite_penyewa`.`id_bouwherr` AS `id_bouwherr`,`rsite_penyewa`.`masa_sistem_pembayaran` AS `masa_sistem_pembayaran`,`rsite_penyewa`.`periode_tagihan` AS `periode_tagihan`,`rsite_penyewa_keuangan`.`tagihan_ke` AS `tagihan_ke`,`rsite_penyewa_keuangan`.`no_invoice` AS `no_invoice`,`rsite_penyewa_keuangan`.`tgl_invoice` AS `tgl_invoice`,`rsite_penyewa_keuangan`.`sudah_dicetak` AS `sudah_dicetak`,`rsite_penyewa_keuangan`.`nilai_invoice` AS `nilai_invoice` from ((`rsite_penyewa_keuangan` join `rsite_penyewa` on(`rsite_penyewa_keuangan`.`id_rsite_penyewa` = `rsite_penyewa`.`id1`)) join `rsite` on(`rsite_penyewa`.`id_rsite` = `rsite`.`id1`)) where `rsite_penyewa_keuangan`.`sudah_dicetak` is null or `rsite_penyewa_keuangan`.`sudah_dicetak` = 0 order by `rsite`.`sitename`,`rsite_penyewa`.`operator`,`rsite_penyewa_keuangan`.`tgl_invoice` ;

-- ----------------------------
-- View structure for v_rsite_jml_tenant
-- ----------------------------
DROP VIEW IF EXISTS `v_rsite_jml_tenant`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_rsite_jml_tenant` AS select `a`.`id_rsite` AS `id_rsite`,count(`a`.`id1`) AS `jml_tenant` from `rsite_penyewa` `a` group by `a`.`id_rsite` ;

-- ----------------------------
-- View structure for v_rsite_rekap
-- ----------------------------
DROP VIEW IF EXISTS `v_rsite_rekap`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_rsite_rekap` AS select `a`.`id1` AS `idoperator`,`a`.`operator` AS `operator`,`b`.`sitename` AS `sitename`,`b`.`city` AS `city`,`b`.`towerheight` AS `towerheight`,`b`.`sitestatus` AS `sitestatus`,`c`.`nilai_sewa` AS `sitenilasewa`,`c`.`leasestart` AS `leasestart`,`c`.`leaseend` AS `leaseend`,timestampdiff(YEAR,`c`.`leasestart`,`c`.`leaseend`) AS `sitedurasiyear`,timestampdiff(MONTH,concat_ws('-',year(`c`.`leaseend`),date_format(`c`.`leasestart`,'%m-%d')),`c`.`leaseend`) AS `sitedurasimonth`,round(timestampdiff(DAY,current_timestamp(),`a`.`leaseend`) / 365,2) AS `sitesisasewa`,`a`.`nilai_kontrak` AS `oprnilaisewa`,timestampdiff(YEAR,`a`.`leasestart`,`a`.`leaseend`) AS `oprlamasewa`,`a`.`leasestart` AS `oprsewaawal`,`a`.`periode_tagihan` AS `oprdurasi`,`a`.`leaseend` AS `opleaseend`,timestampdiff(YEAR,current_timestamp(),`a`.`leaseend`) AS `outstdth`,`a`.`sewa_per_thn` AS `outstdsewaperthn`,`a`.`sewa_per_thn` * 10 / 100 AS `outstdppn`,`a`.`sewa_per_thn` + `a`.`sewa_per_thn` * 10 / 100 AS `outjml`,timestampdiff(YEAR,current_timestamp(),`a`.`leaseend`) * (`a`.`sewa_per_thn` + `a`.`sewa_per_thn` * 10 / 100) AS `sewatotal` from ((`rsite_penyewa` `a` join `rsite` `b` on(`b`.`id1` = `a`.`id_rsite`)) left join `v_rsite_sewa_lastrecord` `c` on(`c`.`id_rsite` = `b`.`id1`)) ;

-- ----------------------------
-- View structure for v_rsite_sewa_akanhabis
-- ----------------------------
DROP VIEW IF EXISTS `v_rsite_sewa_akanhabis`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_rsite_sewa_akanhabis` AS select `rsite`.`siteid` AS `siteid`,`rsite`.`sitename` AS `sitename`,`rsite`.`address` AS `address`,`rsite_penyewa`.`jenis` AS `jenis`,`bouwherr`.`nama` AS `nama`,`rsite_penyewa`.`nospk` AS `nospk`,`rsite_penyewa`.`typeskn` AS `typeskn`,`rsite_penyewa`.`tglspk` AS `tglspk`,`rsite_penyewa`.`leasestart` AS `leasestart`,`rsite_penyewa`.`leaseend` AS `leaseend`,to_days(`rsite_penyewa`.`leaseend`) - to_days(curdate()) AS `akanberakhir`,`rsite_penyewa`.`status` AS `status` from ((`rsite` left join `rsite_penyewa` on(`rsite_penyewa`.`id_rsite` = `rsite`.`id1`)) left join `bouwherr` on(`rsite_penyewa`.`id_bouwherr` = `bouwherr`.`idbouwherr`)) where (`rsite_penyewa`.`status` <> 'selesai' or `rsite_penyewa`.`status` is null) and to_days(`rsite_penyewa`.`leaseend`) - to_days(curdate()) <= 90 ;

-- ----------------------------
-- View structure for v_rsite_sewa_lastrecord
-- ----------------------------
DROP VIEW IF EXISTS `v_rsite_sewa_lastrecord`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_rsite_sewa_lastrecord` AS select `rsite_sewa`.`id1` AS `id1`,`rsite_sewa`.`id_rsite` AS `id_rsite`,`rsite_sewa`.`leasestart` AS `leasestart`,`rsite_sewa`.`leaseend` AS `leaseend`,`rsite_sewa`.`keterangan` AS `keterangan`,`rsite_sewa`.`nilai_sewa` AS `nilai_sewa` from `rsite_sewa` where `rsite_sewa`.`id1` in (select max(`rsite_sewa`.`id1`) from `rsite_sewa` group by `rsite_sewa`.`id_rsite`) order by `rsite_sewa`.`id1` desc ;

-- ----------------------------
-- View structure for v_site_akanhabis
-- ----------------------------
DROP VIEW IF EXISTS `v_site_akanhabis`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_site_akanhabis` AS select `rsite`.`id1` AS `id1`,`rsite`.`siteid` AS `siteid`,`rsite`.`sitename` AS `sitename`,`rsite`.`address` AS `address`,`rsite`.`city` AS `city`,`rsite`.`province` AS `province`,`rsite`.`sitecontractperiod` AS `sitecontractperiod`,max(to_days(`rsite_sewa`.`leaseend`) - to_days(curdate())) AS `akanberakhir`,`rsite_sewa`.`leaseend` AS `leaseend` from (`rsite` left join `rsite_sewa` on(`rsite_sewa`.`id_rsite` = `rsite`.`id1`)) group by `rsite`.`id1`,`rsite`.`siteid`,`rsite`.`sitename`,`rsite`.`address`,`rsite`.`city`,`rsite`.`province`,`rsite`.`sitecontractperiod` having to_days(`rsite_sewa`.`leaseend`) - to_days(curdate()) <= 120 ;

-- ----------------------------
-- Function structure for f_rsite_penyewa_get_nilai_kontrak_pertahun
-- ----------------------------
DROP FUNCTION IF EXISTS `f_rsite_penyewa_get_nilai_kontrak_pertahun`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `f_rsite_penyewa_get_nilai_kontrak_pertahun`(
	`id1_rsite_penyewa` INT
) RETURNS decimal(10,0)
BEGIN
	declare jml_thn integer;
	declare nilai_kontrak2 decimal(20,0);
	declare nilai_kontrak_pertahun decimal(20,0);
	
	select datediff(rsite_penyewa.leaseend, rsite_penyewa.leasestart) into jml_thn from rsite_penyewa
	where id1 = id1_rsite_penyewa;
	
	if jml_thn <= 0 then
		set jml_thn = 0;
	else
		set jml_thn = jml_thn / 365;
		if jml_thn <= 0 then
			set jml_thn = 1;
		end if;
	end if;
	
	select rsite_penyewa.nilai_kontrak into nilai_kontrak2 from rsite_penyewa
	where id1 = id1_rsite_penyewa;
	
	if nilai_kontrak2 <= 0 or jml_thn <= 0 or nilai_kontrak2 is null then
		set nilai_kontrak_pertahun = 0;
	else
		set nilai_kontrak_pertahun = nilai_kontrak2 / jml_thn;
	end if;
	
	
	return nilai_kontrak_pertahun;
END
;;
DELIMITER ;

-- ----------------------------
-- Function structure for s_jml_project
-- ----------------------------
DROP FUNCTION IF EXISTS `s_jml_project`;
DELIMITER ;;
CREATE DEFINER=`carexidc`@`localhost` FUNCTION `s_jml_project`() RETURNS int(11)
    NO SQL
BEGIN
	declare a integer;
	select count(*) into a from project1;
	return a;
END
;;
DELIMITER ;

-- ----------------------------
-- Function structure for s_jml_project_selesai
-- ----------------------------
DROP FUNCTION IF EXISTS `s_jml_project_selesai`;
DELIMITER ;;
CREATE DEFINER=`carexidc`@`localhost` FUNCTION `s_jml_project_selesai`() RETURNS int(11)
    NO SQL
BEGIN
	declare a integer;
	SELECT
  count(*) into a
FROM
  project1
  LEFT JOIN project1_status ON project1_status.id1_project = project1.id1
  where project1_status.keterangan = '7'
  and project1_status.status = 'close';
  
  return a;

END
;;
DELIMITER ;

-- ----------------------------
-- Function structure for s_nilai_project_all
-- ----------------------------
DROP FUNCTION IF EXISTS `s_nilai_project_all`;
DELIMITER ;;
CREATE DEFINER=`carexidc`@`localhost` FUNCTION `s_nilai_project_all`() RETURNS decimal(10,0)
    NO SQL
BEGIN
	declare a decimal(20,2);
	select
	sum(nilaiprojectdpp) + sum(nilaiprojectppn) - sum(nilaiprojectpph) into a
	from project1;

	return a;
END
;;
DELIMITER ;

-- ----------------------------
-- Function structure for s_nilai_project_selesai
-- ----------------------------
DROP FUNCTION IF EXISTS `s_nilai_project_selesai`;
DELIMITER ;;
CREATE DEFINER=`carexidc`@`localhost` FUNCTION `s_nilai_project_selesai`() RETURNS decimal(10,0)
    NO SQL
BEGIN
	declare a decimal(20,0);
	select
	sum(nilaiprojectdpp) + sum(nilaiprojectppn) - sum(nilaiprojectpph) into a
FROM
  project1
  LEFT JOIN project1_status ON project1_status.id1_project = project1.id1
  where project1_status.keterangan = '7'
  and project1_status.status = 'close';
  
  return a;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `project1_powo_hpp_before_insert`;
DELIMITER ;;
CREATE TRIGGER `project1_powo_hpp_before_insert` BEFORE INSERT ON `project1_powo_hpp` FOR EACH ROW BEGIN
	set new.sub_total = new.qty * new.unit_price;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `project1_powo_hpp_before_update`;
DELIMITER ;;
CREATE TRIGGER `project1_powo_hpp_before_update` BEFORE UPDATE ON `project1_powo_hpp` FOR EACH ROW BEGIN
	set new.sub_total = new.qty * new.unit_price;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `project1_powo_sub_before_insert`;
DELIMITER ;;
CREATE TRIGGER `project1_powo_sub_before_insert` BEFORE INSERT ON `project1_powo_sub` FOR EACH ROW BEGIN
	set new.sub_total = new.qty * new.unit_price;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `project1_powo_sub_before_update`;
DELIMITER ;;
CREATE TRIGGER `project1_powo_sub_before_update` BEFORE UPDATE ON `project1_powo_sub` FOR EACH ROW BEGIN
	set new.sub_total = new.qty * new.unit_price;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `project1_status_before_insert`;
DELIMITER ;;
CREATE TRIGGER `project1_status_before_insert` BEFORE INSERT ON `project1_status` FOR EACH ROW set new.tgl_update = now()
;
;;
DELIMITER ;
