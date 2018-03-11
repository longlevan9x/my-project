-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2018 at 07:12 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(60) CHARACTER SET utf8 NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `role_admin` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `img_path` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`, `phone`, `address`, `role_admin`, `status`, `img_path`, `createdAt`, `updatedAt`) VALUES
(1, 'admin1', '827ccb0eea8a706c4c34a16891f84e7b', 'trieunguyenthanh@gmail.com', '0975091304', 'Hà Nội', -1, 1, NULL, '2016-11-29 13:25:10', NULL),
(4, 'long123', 'e10adc3949ba59abbe56e057f20f883e', 'vanlong@gmail.com', '0969696969', 'Hà Nội, Việt Nam', 0, 1, NULL, '2016-12-03 22:54:15', NULL),
(5, 'admin3', 'e10adc3949ba59abbe56e057f20f883e', '123@gmail.com', 'Miền bắc', '0123456789', 0, 1, NULL, '2016-12-03 23:12:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ansewers`
--

CREATE TABLE `ansewers` (
  `id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL,
  `username` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `level_user` tinyint(3) NOT NULL,
  `create_time` datetime NOT NULL,
  `like_ansewer` int(10) UNSIGNED DEFAULT NULL,
  `content` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `id_hoadon` int(11) NOT NULL,
  `id_dh` int(11) NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`id_hoadon`, `id_dh`, `create_time`, `update_time`) VALUES
(1, 21, '2017-01-10 20:30:00', '0000-00-00 00:00:00'),
(2, 24, '2017-01-10 20:30:18', '0000-00-00 00:00:00'),
(3, 26, '2017-01-10 20:35:34', '0000-00-00 00:00:00'),
(4, 23, '2017-01-10 20:35:39', '0000-00-00 00:00:00'),
(5, 27, '2017-01-18 15:41:54', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

CREATE TABLE `donhang` (
  `id_hd` int(11) NOT NULL,
  `id_sach` int(10) UNSIGNED NOT NULL,
  `TenKH` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `SDT` int(11) NOT NULL,
  `Email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `DiaChi` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `GhiChu` text COLLATE utf8_unicode_ci NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `ThanhTien` int(11) NOT NULL,
  `TrangThai` int(11) NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`id_hd`, `id_sach`, `TenKH`, `SDT`, `Email`, `DiaChi`, `GhiChu`, `SoLuong`, `ThanhTien`, `TrangThai`, `create_time`, `update_time`) VALUES
(14, 19, 'Lê Long', 969651118, 'vanlong121996@gmail.com', 'Hà nội , việt nam', '', 1, 1200000, 1, '2017-01-08 12:15:06', '0000-00-00 00:00:00'),
(16, 15, 'Lê Long', 964582369, 'vanlong121996@gmail.com', 'Hà Nội', '8h 18-3', 1, 700000, 1, '2017-01-08 12:15:41', '0000-00-00 00:00:00'),
(19, 15, 'Lê Long', 2147483647, 'abc@gmail.com', 'Hà Nội', '10h 12-12', 1, 700000, 1, '2017-01-10 20:14:20', '0000-00-00 00:00:00'),
(20, 15, 'Lê Long', 2147483647, 'trieunguyenthanh@gmail.com', 'Hà Nội', '10h 12-12', 1, 700000, 1, '2017-01-10 20:28:11', '0000-00-00 00:00:00'),
(21, 2, 'Lê Long', 2147483647, 'trieunguyenthanh@gmail.com', 'Hà Nội', '10h 12-12', 1, 10000, 1, '2017-01-10 20:28:11', '0000-00-00 00:00:00'),
(22, 16, 'Lê Long', 2147483647, 'trieunguyenthanh@gmail.com', 'Hà Nội', '10h 12-12', 1, 910000, 0, '2017-01-10 20:28:11', '0000-00-00 00:00:00'),
(23, 17, 'Lê Long', 2147483647, 'trieunguyenthanh@gmail.com', 'Hà Nội', '10h 12-12', 1, 100000, 1, '2017-01-10 20:28:11', '0000-00-00 00:00:00'),
(24, 19, 'Lê Long', 2147483647, 'trieunguyenthanh@gmail.com', 'Hà Nội', '10h 12-12', 1, 1200000, 1, '2017-01-10 20:28:11', '0000-00-00 00:00:00'),
(25, 14, 'Lê Long', 2147483647, 'trieunguyenthanh@gmail.com', 'Hà Nội', '', 100, 1000000000, 0, '2017-01-10 20:31:50', '0000-00-00 00:00:00'),
(26, 15, 'Lê Long', 969651118, 'vanlong121996@gmail.com', 'Hà nội , việt nam', '', 50, 35000000, 1, '2017-01-10 20:34:10', '0000-00-00 00:00:00'),
(27, 19, 'Lê Long', 969651118, 'vanlong121996@gmail.com', 'Hà nội , việt nam', '', 1, 1200000, 1, '2017-01-10 21:01:27', '0000-00-00 00:00:00'),
(28, 18, 'Lê Long', 969651118, 'vanlong121996@gmail.com', 'Hà nội , việt nam', '', 1, 750000, 0, '2017-01-10 21:01:27', '0000-00-00 00:00:00'),
(29, 17, 'Lê Long', 969651118, 'vanlong121996@gmail.com', 'Hà nội , việt nam', '', 1, 100000, 0, '2017-01-10 21:01:27', '0000-00-00 00:00:00'),
(30, 16, 'Lê Long', 969651118, 'vanlong121996@gmail.com', 'Hà nội , việt nam', '', 1, 910000, 0, '2017-01-10 21:01:27', '0000-00-00 00:00:00'),
(31, 15, 'Lê Long', 969651118, 'vanlong121996@gmail.com', 'Hà nội , việt nam', '', 1, 700000, 0, '2017-01-10 21:01:27', '0000-00-00 00:00:00'),
(32, 14, 'Lê Long', 969651118, 'vanlong121996@gmail.com', 'Hà nội , việt nam', '', 1, 10000000, 0, '2017-01-10 21:01:27', '0000-00-00 00:00:00'),
(33, 13, 'Lê Long', 969651118, 'vanlong121996@gmail.com', 'Hà nội , việt nam', '', 1, 100000, 0, '2017-01-10 21:01:27', '0000-00-00 00:00:00'),
(36, 15, 'Chung', 2147483647, 'trieunguyenthanh@gmail.com', 'Hà Nội', '123', 1, 700000, 0, '2017-01-18 16:47:21', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `loaisach`
--

CREATE TABLE `loaisach` (
  `id_loai` int(11) NOT NULL,
  `TenLoai` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `loaisach`
--

INSERT INTO `loaisach` (`id_loai`, `TenLoai`, `create_time`, `update_time`) VALUES
(1, 'Sách văn học ', '2016-12-15 00:00:00', '2016-12-23 16:27:26'),
(2, 'Sách chính trị', '2016-12-21 00:00:00', '2016-12-23 16:24:54'),
(3, 'Sách kinh tế', '2016-12-15 00:00:00', '2016-12-23 16:03:02'),
(4, 'Sách khoa học', '2016-12-19 00:00:00', NULL),
(5, 'Sách giáo dục', '2016-12-19 09:13:40', '0000-00-00 00:00:00'),
(7, 'Sách thiếu nhi', '2016-12-19 10:16:47', '0000-00-00 00:00:00'),
(10, 'Sách hài hước', '2016-12-23 17:04:40', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `nhaxuatban`
--

CREATE TABLE `nhaxuatban` (
  `id_nxb` int(11) NOT NULL,
  `TenNXB` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `SDTNXB` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `DiaChiNXB` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `logo_NXB` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nhaxuatban`
--

INSERT INTO `nhaxuatban` (`id_nxb`, `TenNXB`, `SDTNXB`, `DiaChiNXB`, `logo_NXB`, `create_time`, `update_time`) VALUES
(52, 'Văn học văn nghệ', '0969651118', 'Hà nội , việt nam', 'vhvn.png', '2016-12-24 18:27:46', '0000-00-00 00:00:00'),
(53, 'Tri thức', '0965678998', 'Hồ Chí Minh', 'trithuc.png', '2016-12-13 19:36:16', '0000-00-00 00:00:00'),
(54, 'Giáo dục', '0969651118', 'Hà nội', 'giaoduc.jpg', '2016-12-13 19:36:34', '0000-00-00 00:00:00'),
(55, 'Lao động xã hội', '0934567890', 'Huế', 'ldxh.jpg', '2016-12-13 19:37:02', '0000-00-00 00:00:00'),
(56, 'NBX Kim Đồng', '0971111111', 'Hải Phòng', 'kimdong.png', '2016-12-13 19:37:34', '0000-00-00 00:00:00'),
(57, 'Nhà xuất bản Trẻ', '0969651118', 'Hà nội', 'nbxtre.jpg', '2016-12-13 19:39:02', '0000-00-00 00:00:00'),
(58, 'Thanh Niên', '0934302538', 'Hà nội , việt nam', 'thanhnien.jpg', '2016-12-13 19:39:23', '0000-00-00 00:00:00'),
(59, 'Giao Thông Vận Tải', '0987654321', 'Đà Nẵng', 'gtvt.png', '2016-12-13 19:41:23', '2016-12-20 16:19:28'),
(60, 'Quân đội nhân dân', '01234567890', 'Hà nội , việt nam', 'qdnd.png', '2016-12-13 19:42:04', '0000-00-00 00:00:00'),
(61, 'Văn học', '0969651118', 'Hà nội', 'vanhoc.jpg', '2016-12-24 18:29:09', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) CHARACTER SET utf8 NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `create_time` datetime NOT NULL,
  `id_book` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL,
  `like_comment` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sach`
--

CREATE TABLE `sach` (
  `id` int(11) NOT NULL,
  `TenSach` varchar(200) CHARACTER SET utf8 NOT NULL,
  `id_nxb` int(11) NOT NULL,
  `id_tg` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `HinhAnh` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `GiaCu` int(11) NOT NULL,
  `GiaMoi` int(11) DEFAULT NULL,
  `id_loai` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `SoTrang` int(11) NOT NULL,
  `SoLuotXem` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sach`
--

INSERT INTO `sach` (`id`, `TenSach`, `id_nxb`, `id_tg`, `status`, `HinhAnh`, `GiaCu`, `GiaMoi`, `id_loai`, `SoLuong`, `SoTrang`, `SoLuotXem`, `create_time`, `date_time`) VALUES
(2, 'Truyện tranh', 52, 5, 0, '20072015huongduong.jpg', 10000, 0, 1, 20, 200, NULL, '2016-12-20 08:05:45', NULL),
(4, 'donkihote và cối xay gió', 53, 9, 0, 'donkihote.jpg', 600000, 12000000, 1, 100, 500, NULL, '2016-12-20 09:06:18', NULL),
(5, 'Tắt đèn', 52, 8, 0, 'tatden.jpg', 100000, 100000, 1, 30, 200, NULL, '2016-12-20 18:31:33', '2016-12-20 21:39:00'),
(6, 'Truyện kiều', 61, 7, 1, 'truyenkieu.jpg', 10000, 0, 1, 30, 150, 0, '2016-12-20 18:59:11', NULL),
(7, 'donkihote và cối xay gió', 56, 11, 1, 'vhvn.png', 750000, 20000, 2, 100, 500, 2, '2016-12-20 19:00:50', '2016-12-23 16:20:32'),
(11, 'donkihote và cối xay gió 3', 59, 12, 1, 'truyenkieu.jpg', 10000000, 10000000, 5, 1233, 13213, 0, '2016-12-23 15:14:06', '2016-12-23 16:20:39'),
(12, 'Hoa Hướng dương', 61, 7, 1, 'hoahuongduong.jpg', 10000000, 10000000, 4, 12000, 100000, 0, '2016-12-23 15:16:07', '2016-12-23 16:19:42'),
(13, 'Hoa Hướng dương 1', 52, 5, 1, 'Penguins.jpg', 100000, 0, 1, 1233, 13213, 0, '2016-12-24 19:44:27', NULL),
(14, 'Harry Porter', 58, 14, 1, 'image03.jpg', 10000000, 0, 4, 30, 500, 1, '2016-12-27 09:43:41', NULL),
(15, 'Sách dạy nấu ăn', 53, 9, 1, 'image40.jpg', 252000, 700000, 5, 256, 1258, 3, '2016-12-27 09:44:49', '2016-12-30 18:58:09'),
(16, 'City Hunter', 57, 14, 1, 'image10.jpg', 910000, 0, 7, 980, 10000, 1, '2016-12-27 09:46:59', NULL),
(17, 'Tấm cám', 60, 9, 1, 'loginascustomer_profile.jpg', 100000, 0, 3, 30, 200, 2, '2016-12-31 00:12:58', NULL),
(18, 'Paulo Coelho', 55, 15, 1, 'nhagiakim.jpg', 750000, 0, 1, 1003, 13213, 21, '2016-12-31 00:17:18', NULL),
(19, 'Tắt đèn 2', 54, 9, 1, '3-1.jpg', 1200000, 0, 5, 20, 500, 7, '2016-12-31 17:07:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `meta_key` varchar(255) NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`meta_key`, `meta_value`) VALUES
('footer', 'Địa chỉ gửi hàng đổi/trả/bảo hành: Trung Tâm Xử Lý Đơn Hàng TIKI, Lô II-1, đường CN1, Khu Công Nghiệp Tân Bình, phường Tây Thạnh, Quận Tân Phú, TP. Hồ Chí Minh (Tham khảo hướng dẫn đổi, trả, bảo hành hoặc liên hệ 1900-6035 để được hướng dẫn trước khi gửi sản phẩm về Tiki)\r\n<br/>\r\nĐịa chỉ văn phòng: 52 Út Tịch, phường 4, quận Tân Bình, thành phố Hồ Chí Minh\r\n<br/>\r\nGiấy chứng nhận Đăng ký Kinh doanh số 0309532909 do Sở Kế hoạch và Đầu tư Thành phố Hồ Chí Minh cấp ngày 06/01/2010');

-- --------------------------------------------------------

--
-- Table structure for table `tacgia`
--

CREATE TABLE `tacgia` (
  `id_tg` int(11) NOT NULL,
  `TenTG` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `SDTTG` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `DiaChiTG` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `img_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tacgia`
--

INSERT INTO `tacgia` (`id_tg`, `TenTG`, `SDTTG`, `DiaChiTG`, `img_path`, `create_time`, `update_time`) VALUES
(5, 'Kim Đồng1', '0969651118', 'Hà nội', '13510776_603586493148745_3124049685442071706_n.png', '2016-12-13 16:03:05', '2016-12-20 16:25:46'),
(7, 'Long', '01234567812', 'Thanh oai', '3-1.jpg', '2016-12-16 16:36:21', '2016-12-24 15:31:00'),
(8, 'Ngô Tất Tố', '0969651118', 'Hà nội', 'admin_1.png', '2016-12-17 20:11:41', '2016-12-20 16:26:58'),
(9, 'Văn cao', '0969651118', 'Hà nội', '13335733_589040611272032_2055868807379568364_n.jpg', '2016-12-17 20:13:19', '0000-00-00 00:00:00'),
(10, 'Tác giả 3', '0969651118', 'Hà nội', 'user.jpg', '2016-12-20 15:16:28', '0000-00-00 00:00:00'),
(11, 'Bình', '0971111111', 'Hà nội , việt nam', '13510776_603586493148745_3124049685442071706_n.png', '2016-12-20 17:06:30', '0000-00-00 00:00:00'),
(12, 'Nam cao', '0987123456', 'Hà nội , việt nam', 'nc.jpg', '2016-12-20 19:09:35', '0000-00-00 00:00:00'),
(14, 'Bóng đá plus', '0969651118', 'Hà nội , việt nam', 'images.jpg', '2016-12-24 16:06:05', '0000-00-00 00:00:00'),
(15, 'Paulo Coelho', '01674125896', 'Nước ngoài', 'image32.jpg', '2016-12-31 00:16:19', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id_tk` int(11) NOT NULL,
  `TenDangNhap` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `MatKhau` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `TenHienThi` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `DiaChi` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `SDT` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Quyen` int(11) NOT NULL,
  `Trang_thai` tinyint(4) NOT NULL,
  `authen_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`id_tk`, `TenDangNhap`, `MatKhau`, `TenHienThi`, `DiaChi`, `SDT`, `Email`, `Quyen`, `Trang_thai`, `authen_key`, `create_time`, `update_time`) VALUES
(16, 'admin', '25d55ad283aa400af464c76d713c07ad', 'Lê Long', 'Hà nội , việt nam', '0969651118', 'vanlong121996@gmail.com', 0, 1, 'FKaumPcF1Cs12NAcAg0KinZhfpThJAF4uPOcSQxDGPg', '2017-01-03 19:16:40', '0000-00-00 00:00:00'),
(23, 'Admin12', 'e10adc3949ba59abbe56e057f20f883e', 'Long', 'Viet Nam', '12434', '123@gmail.com', 0, 0, '123', '2012-12-12 12:12:12', '0000-00-00 00:00:00'),
(36, 'long12', '827ccb0eea8a706c4c34a16891f84e7b', '12', 'Hà nội', '0971111111', 'vanlong121996@gmail.com', 0, 0, '0', '2017-01-18 07:48:16', '0000-00-00 00:00:00'),
(37, 'admin11', '827ccb0eea8a706c4c34a16891f84e7b', 'Lê Văn Long', 'Hà nội', '0969651118', 'vanlong121996@gmail.com', 0, 0, '0', '2017-01-18 07:49:00', '0000-00-00 00:00:00'),
(52, 'Admin12', 'e10adc3949ba59abbe56e057f20f883e', 'Long', 'Viet Nam', '12434', '123@gmail.com', 0, 0, '123', '2012-12-12 12:12:12', '0000-00-00 00:00:00'),
(53, 'admin1', '827ccb0eea8a706c4c34a16891f84e7b', 'Lê Văn Long', 'Hà nội , việt nam', '0969651118', 'vanlong121996@gmail.com', 0, 0, '0', '2017-01-18 15:32:12', '0000-00-00 00:00:00'),
(54, 'Admin12', 'e10adc3949ba59abbe56e057f20f883e', 'Long', 'Viet Nam', '12434', '123@gmail.com', 0, 0, '123', '2012-12-12 12:12:12', '0000-00-00 00:00:00'),
(55, 'Admin12', 'e10adc3949ba59abbe56e057f20f883e', 'Long', 'Viet Nam', '12434', '123@gmail.com', 0, 0, '123', '2012-12-12 12:12:12', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(10) UNSIGNED NOT NULL,
  `img` varchar(240) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `img`) VALUES
(1, 'abc.jpg'),
(2, ''),
(3, ''),
(4, ''),
(5, ''),
(6, ''),
(7, ''),
(8, 'Jellyfish.jpg'),
(9, '11464(1).jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ansewers`
--
ALTER TABLE `ansewers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD PRIMARY KEY (`id_hoadon`);

--
-- Indexes for table `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`id_hd`);

--
-- Indexes for table `loaisach`
--
ALTER TABLE `loaisach`
  ADD PRIMARY KEY (`id_loai`);

--
-- Indexes for table `nhaxuatban`
--
ALTER TABLE `nhaxuatban`
  ADD PRIMARY KEY (`id_nxb`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sach`
--
ALTER TABLE `sach`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`meta_key`);

--
-- Indexes for table `tacgia`
--
ALTER TABLE `tacgia`
  ADD PRIMARY KEY (`id_tg`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id_tk`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ansewers`
--
ALTER TABLE `ansewers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  MODIFY `id_hoadon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `id_hd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `loaisach`
--
ALTER TABLE `loaisach`
  MODIFY `id_loai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nhaxuatban`
--
ALTER TABLE `nhaxuatban`
  MODIFY `id_nxb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sach`
--
ALTER TABLE `sach`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tacgia`
--
ALTER TABLE `tacgia`
  MODIFY `id_tg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id_tk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
