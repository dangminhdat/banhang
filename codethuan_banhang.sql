-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 30, 2017 lúc 05:11 CH
-- Phiên bản máy phục vụ: 10.1.21-MariaDB
-- Phiên bản PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `codethuan_banhang`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` char(15) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `level` tinyint(4) DEFAULT '1',
  `avatar` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `phone`, `address`, `password`, `status`, `level`, `avatar`, `created_at`, `update_at`) VALUES
(1, 'Đặng Minh Đạt', 'dangminhdat.qnam@gmail.com', '01215300516', 'Điện Bàn, Quảng Nam', '700b1baae665ae0adf255fba82a10c1b', 1, 1, NULL, NULL, '2017-12-30 15:34:25'),
(3, 'Cris Rin', 'tintuc.wp.96@gmail.com', '0123456789', 'Đà Nẵng', '700b1baae665ae0adf255fba82a10c1b', 1, 2, NULL, NULL, '2017-12-27 09:48:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chuyenmuc`
--

CREATE TABLE `chuyenmuc` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `hinh_anh` varchar(100) NOT NULL,
  `banner` varchar(100) NOT NULL,
  `home` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `id_parent` int(11) NOT NULL,
  `size` varchar(100) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `chuyenmuc`
--

INSERT INTO `chuyenmuc` (`id`, `name`, `slug`, `hinh_anh`, `banner`, `home`, `status`, `id_parent`, `size`, `create_at`, `update_at`) VALUES
(1, 'Áo nam', 'ao-nam', '', '', 1, 1, 0, 'M,L,XL,XXL', '2017-10-12 11:06:00', '2017-10-12 11:06:00'),
(2, 'Quần nam', 'quan-nam', '', '', 1, 1, 0, '28,29,30,31,32,33,34', '2017-10-12 11:06:42', '2017-10-12 11:06:42'),
(3, 'Giày nam', 'giay-nam', '', '', 0, 1, 0, NULL, '2017-10-12 11:06:49', '2017-10-12 11:06:49'),
(4, 'Phụ kiện', 'phu-kien', '', '', 1, 1, 0, NULL, '2017-10-12 11:07:06', '2017-10-12 11:07:06'),
(5, 'Áo sơ mi nam', 'ao-so-mi-nam', '', '', 1, 1, 1, NULL, '2017-10-13 16:10:10', '2017-10-13 16:10:10'),
(6, 'Áo thun nam', 'ao-thun-nam', '', '', 1, 1, 1, NULL, '2017-10-14 15:16:29', '2017-10-14 15:16:29'),
(7, 'Áo khoác nam', 'ao-khoac-nam', '', '', 1, 1, 1, NULL, '2017-10-14 15:16:45', '2017-10-14 15:16:45'),
(8, 'Áo vest nam', 'ao-vest-nam', '', '', 1, 1, 1, NULL, '2017-10-14 15:17:04', '2017-10-14 15:17:04'),
(9, 'Áo len nam', 'ao-len-nam', '', '', 1, 1, 1, NULL, '2017-10-14 15:17:27', '2017-10-14 15:17:27'),
(10, 'Quần jean nam', 'quan-jean-nam', '', '', 1, 1, 2, NULL, '2017-10-14 15:18:39', '2017-10-14 15:18:39'),
(11, 'Quần kaki nam', 'quan-kaki-nam', '', '', 1, 1, 2, NULL, '2017-10-14 15:19:11', '2017-10-14 15:19:11'),
(12, 'Quần tây nam', 'quan-tay-nam', '', '', 1, 1, 2, NULL, '2017-10-14 15:19:35', '2017-10-14 15:19:35'),
(13, 'Quần short nam', 'quan-short-nam', '', '', 1, 1, 2, NULL, '2017-10-14 15:19:48', '2017-10-14 15:19:48'),
(14, 'Ví da nam', 'vi-da-nam', '', '', 1, 1, 4, NULL, '2017-10-14 15:20:12', '2017-10-14 15:20:12'),
(15, 'Nón nam', 'non-nam', '', '', 1, 1, 4, NULL, '2017-10-14 15:20:23', '2017-10-14 15:20:23'),
(16, 'Thắt lưng nam', 'that-lung-nam', '', '', 1, 1, 4, NULL, '2017-10-14 15:20:43', '2017-10-14 15:20:43'),
(17, 'Cà vạt nam', 'ca-vat-nam', '', '', 1, 1, 4, NULL, '2017-10-14 15:21:13', '2017-10-14 15:21:13'),
(18, 'Mắt kính nam', 'mat-kinh-nam', '', '', 1, 1, 4, NULL, '2017-10-14 15:21:24', '2017-10-14 15:21:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dathang`
--

CREATE TABLE `dathang` (
  `id` int(11) NOT NULL,
  `giaodich_id` int(11) DEFAULT NULL,
  `sanpham_id` int(11) DEFAULT NULL,
  `soluong` tinyint(4) DEFAULT NULL,
  `size` varchar(10) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `sale` int(11) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giaodich`
--

CREATE TABLE `giaodich` (
  `id` int(11) NOT NULL,
  `tongtien` int(11) DEFAULT NULL,
  `taikhoan_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `create_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `sale` tinyint(4) DEFAULT '0',
  `thumbnail` varchar(100) DEFAULT NULL,
  `slide_thumbnail` varchar(100) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `chuyenmuc_con` int(11) DEFAULT NULL,
  `describ` text,
  `content` text,
  `soluong` int(11) DEFAULT '0',
  `head` int(11) DEFAULT '0',
  `view` int(11) DEFAULT '0',
  `hot` tinyint(4) DEFAULT '0',
  `create_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`id`, `name`, `slug`, `price`, `sale`, `thumbnail`, `slide_thumbnail`, `parent_id`, `chuyenmuc_con`, `describ`, `content`, `soluong`, `head`, `view`, `hot`, `create_at`, `updated_at`) VALUES
(1, 'Áo Sơ Mi Ca Rô Trắng Kem', 'ao-so-mi-ca-ro-trang-kem', 285000, 0, 'ao-so-mi-caro-trang-kem.jpg', 'W6FIO.jpg,7BaYm.jpg,eLz4l.jpg', 1, 5, 'OK!', '<p>OK!</p>\r\n', 0, 0, 26, 1, NULL, '2017-12-29 15:08:19'),
(2, 'Áo Sơ Mi Ca Rô Đen', 'ao-so-mi-ca-ro-den', 285000, 0, 'ao-so-mi-caro-den.jpg', 'Nc38y.jpg,1pUgO.jpg,uY7fr.jpg', 1, 5, 'OK!', '<p>OK!</p>\r\n', 1, 0, 0, 0, NULL, '2017-12-29 14:58:10'),
(3, 'Áo Sơ Mi Hàn Quốc Xanh Biển', 'ao-so-mi-han-quoc-xanh-bien', 245000, 0, 'ao-so-mi-han-quoc-xanh-bien.jpg', 'I7e2C.jpg,Gi3Fr.jpg,fjPle.jpg', 1, 5, '', '<p>OK</p>\r\n', 1, 0, 0, 1, NULL, '2017-12-29 14:58:39'),
(4, 'Áo Sơ Mi Hàn Quốc Trắng', 'ao-so-mi-han-quoc-trang', 245000, 0, 'ao-so-mi-han-quoc-trang.jpg', 'bNmqU.jpg,pKxGr.jpg,HVaFh.jpg', 1, 5, '', '<p>OK</p>\r\n', 1, 0, 4, 1, NULL, '2017-12-29 14:58:57'),
(5, 'Áo Sơ Mi Hàn Quốc Carô Xám', 'ao-so-mi-han-quoc-caro-xam', 285000, 0, 'ao-so-mi-han-quoc-caro-xam.jpg', '9wKxc.jpg,VJNr5.jpg,mxCwV.jpg', 1, 5, 'OK!', '<p>OK!</p>\r\n', 1, 1, 2, 1, NULL, '2017-12-29 14:59:40'),
(6, 'Áo Sơ Mi Hàn Quốc Đen', 'ao-so-mi-han-quoc-den', 285000, 0, 'ao-so-mi-han-quoc-den.jpg', 'vine1.jpg,WjZUI.jpg,T6xrs.jpg', 1, 5, 'OK!', '<p>OK!</p>\r\n', 1, 0, 0, 0, NULL, '2017-12-29 14:59:54'),
(7, 'Áo Thun Có Cổ Trắng Kem', 'ao-thun-co-co-trang-kem', 175000, 0, 'ao-thun-co-co-trang-kem.jpg', 'a32NO.jpg,leTOg.jpg,nHhOI.jpg', 1, 6, 'OK!', '<p>OK!</p>\r\n', 1, 0, 0, 0, NULL, '2017-12-29 15:00:08'),
(8, 'Áo Thun Xám', 'ao-thun-xam', 175000, 0, 'ao-thun-xam.jpg', '9iYQv.jpg,trgqQ.jpg,4bFln.jpg', 1, 6, 'OK!', '<p>OK!</p>\r\n', 1, 0, 0, 0, NULL, '2017-12-29 15:00:46'),
(9, 'Áo Thun Vàng Nâu', 'ao-thun-vang-nau', 175000, 70, 'ao-thun-vang-nau.jpg', 'BiIlH.jpg,ODRJV.jpg,kgz4c.jpg', 1, 6, '', '<p>OK!</p>\r\n', 1, 0, 2, 0, NULL, '2017-12-29 15:01:03'),
(10, 'Áo Khoác Dù Xám Xanh', 'ao-khoac-du-xam-xanh', 345000, 0, 'ao-khoac-du-xam-xanh.jpg', '6biC4.jpg,kEBA1.jpg,Nu40J.jpg', 1, 7, '', '<p>OK!</p>\r\n', 1, 0, 0, 0, NULL, '2017-12-29 15:01:12'),
(11, 'Áo Khoác Dù Xanh Đen', 'ao-khoac-du-xanh-den', 345000, 0, 'ao-khoac-du-xanh-den.jpg', 'OIxn0.jpg,3El7A.jpg,TRpij.jpg', 1, 7, '', '<p>OK!</p>\r\n', 1, 0, 0, 0, NULL, '2017-12-29 15:01:30'),
(12, 'Áo Khoác Dù Xám Chuột', 'ao-khoac-du-xam-chuot', 345000, 0, 'ao-khoac-du-xam-chuot.jpg', 'slYHk.jpg,r8ypH.jpg,EBHmD.jpg', 1, 7, '', '<p>OK!</p>\r\n', 1, 0, 0, 0, NULL, '2017-12-29 15:01:40'),
(13, 'Áo GiLê Màu Vàng Kem', 'ao-gile-mau-vang-kem', 315000, 0, 'ao-gile-mau-vang-kem.jpg', 'fBvCP.jpg,qeNKG.jpg,Kue4B.jpg', 1, 8, '', '<p>OK!</p>\r\n', 1, 1, 1, 0, NULL, '2017-12-29 15:02:04'),
(14, 'Áo Vest Cao Cấp Đỏ Mận', 'ao-vest-cao-cap-do-man', 675000, 0, 'ao-vest-cao-cap-do-man.jpg', 'pEq6f.jpg,dnPWu.jpg,9HfpT.jpg', 1, 8, 'OK!', '<p>OK!</p>\r\n', 1, 0, 2, 0, NULL, '2017-12-29 15:02:21'),
(15, 'Áo Vest Cao Cấp Xanh Đen', 'ao-vest-cao-cap-xanh-den', 675000, 0, 'ao-vest-cao-cap-xanh-den.jpg', 'sTfUq.jpg,xVHwk.jpg,kiEyj.jpg', 1, 8, '', '<p>OK!</p>\r\n', 1, 0, 0, 0, NULL, '2017-12-29 15:02:36'),
(16, 'Áo Len Xanh Đen', 'ao-len-xanh-den', 225000, 0, 'ao-len-xanh-den.jpg', 'c81Mt.jpg,xBPbg.jpg,TABoJ.jpg', 1, 9, '', '<p>OK!</p>\r\n', 1, 1, 2, 0, NULL, '2017-12-29 15:02:55'),
(17, 'Áo Len Xanh Biển Đậm', 'ao-len-xanh-bien-dam', 225000, 0, 'ao-len-xanh-bien-dam.jpg', 'nYQr1.jpg,3QXvD.jpg,Cihf6.jpg', 1, 9, 'OK!', '<p>OK!</p>\r\n', 1, 2, 1, 1, NULL, '2017-12-29 15:03:12'),
(18, 'Áo Len Đen', 'ao-len-den', 225000, 0, 'ao-len-den.jpg', '3OSj5.jpg,a4ruA.jpg,ToInr.jpg', 1, 9, 'OK!', '<p>OK!</p>\r\n', 1, 1, 0, 1, NULL, '2017-12-29 15:07:09'),
(19, 'Quần Jeans Skinny Bạc', 'quan-jeans-skinny-bac', 375000, 0, 'quan-jeans-skinny-bac.jpg', 'xA0HP.jpg,XKbWE.jpg,qFuUm.jpg', 2, 10, 'OK!', '<p>OK!</p>\r\n', 1, 0, 0, 0, NULL, '2017-12-29 15:06:57'),
(20, 'Quần Jeans Skinny Đen', 'quan-jeans-skinny-den', 325000, 0, 'quan-jeans-skinny-den.jpg', '0SwP2.jpg,pOAve.jpg,qdHxP.jpg', 2, 10, 'OK!', '<p>OK!</p>\r\n', 1, 0, 6, 0, NULL, '2017-12-29 15:06:43'),
(21, 'Quần Jeans Skinny Xanh Đen', 'quan-jeans-skinny-xanh-den', 345000, 0, 'quan-jeans-skinny-xanh-den.jpg', 'pCBJK.jpg,yMgbf.jpg,aqFvo.jpg', 2, 10, 'OK!', '<p>OK!</p>\r\n', 1, 0, 0, 1, NULL, '2017-12-29 15:06:15'),
(22, 'Quần Kaki Xanh Đen', 'quan-kaki-xanh-den', 225000, 0, 'quan-kaki-xanh-den.jpg', 'fKQ1N.jpg,PUHBC.jpg,cibNZ.jpg', 2, 11, '', '<p>OK!</p>\r\n', 1, 0, 0, 1, NULL, '2017-12-29 15:05:47'),
(23, 'Quần Kaki Kem', 'quan-kaki-kem', 225000, 0, 'quan-kaki-kem.jpg', 'afcSs.jpg,vSoaj.jpg,Tpa3B.jpg', 2, 11, 'OK!', '<p>OK!</p>\r\n', 1, 0, 0, 0, NULL, '2017-12-29 15:05:31'),
(24, 'Quần Kaki Đen', 'quan-kaki-den', 225000, 0, 'quan-kaki-den.jpg', 'AgHqv.jpg,VWQrN.jpg,XHpw5.jpg', 2, 11, 'OK!', '<p>OK!</p>\r\n', 1, 0, 0, 1, NULL, '2017-12-29 15:05:10'),
(25, 'Quần Tây Nam Hàn Quốc Đen', 'quan-tay-nam-han-quoc-den', 385000, 0, 'quan-tay-nam-han-quoc-den.jpg', 'woyK6.jpg,XbpwW.jpg,KjPsw.jpg', 2, 12, '', '<p>OK!</p>\r\n', 1, 0, 0, 0, NULL, '2017-12-29 15:04:41'),
(26, 'Quần Tây Nam Đen', 'quan-tay-nam-den', 385000, 0, 'quan-tay-nam-den.jpg', 'Uq9yc.jpg,jKzIh.jpg,MbXR2.jpg', 2, 12, 'OK!', '<p>OK!</p>\r\n', 0, 0, 0, 0, NULL, '2017-12-29 15:04:21'),
(27, 'Quần Tây Xanh Đen', 'quan-tay-xanh-den', 385000, 0, 'quan-tay-xanh-den.jpg', '0fRyX.jpg,SvqmK.jpg,ce6rR.jpg', 2, 12, 'OK!', '<p>OK!</p>\r\n', 1, 0, 0, 1, NULL, '2017-12-29 15:04:02'),
(28, 'Quần Short Vàng', 'quan-short-vang', 175000, 0, 'quan-short-vang.jpg', 'WpfIP.jpg,DyGa8.jpg,YZlx4.jpg', 2, 13, 'OK!', '<p>OK!</p>\r\n', 1, 0, 0, 1, NULL, '2017-12-29 15:07:51'),
(29, 'Quần Short Xanh Ngọc', 'quan-short-xanh-ngoc', 215000, 0, 'quan-short-xanh-ngoc.jpg', 'aj9YE.jpg,ShdVI.jpg,roATi.jpg', 2, 13, 'OK!', '<p>OK!</p>\r\n', 1, 0, 0, 1, NULL, '2017-12-29 15:08:05'),
(30, 'Quần Short Xám Trắng', 'quan-short-xam-trang', 215000, 0, 'quan-short-xam-trang.jpg', '1NYCX.jpg,475La.jpg,O7iV3.jpg', 2, 13, 'OK!', '<p>OK!</p>\r\n', 1, 0, 0, 1, NULL, '2017-12-29 14:57:07'),
(31, 'Ví Da Nam Màu Nâu', 'vi-da-nam-mau-nau', 275000, 0, 'vi-da-nam-mau-nau.jpg', 't9oPI.jpg,SZDNp.jpg,FrLQD.jpg', 4, 14, 'OK!', '<p>OK!</p>\r\n', 1, 0, 0, 0, NULL, '2017-12-29 14:56:24'),
(32, 'Ví Da Nam Màu Đen', 'vi-da-nam-mau-den', 275000, 0, 'vi-da-nam-mau-den.jpg', 'X1Fn4.jpg,TPMyq.jpg,NeB8l.jpg', 4, 14, 'OK!', '<p>OK!</p>\r\n', 1, 0, 0, 0, NULL, '2017-12-29 14:55:58'),
(33, 'Ví Da Nam Màu Bò', 'vi-da-nam-mau-bo', 275000, 0, 'vi-da-nam-mau-bo.jpg', '9SHNg.jpg,1ekKD.jpg,0HaM2.jpg', 4, 14, 'OK!', '<p>OK!</p>\r\n', 1, 0, 15, 1, NULL, '2017-12-29 14:55:34'),
(34, 'Nón Snapback Trắng', 'non-snapback-trang', 185000, 0, 'non-snapback-trang.jpg', 'BwSJ2.JPG,M9wh2.JPG,6xesk.jpg', 4, 15, 'OK!', '<p>OK!</p>\r\n', 1, 2, 0, 1, NULL, '2017-12-29 14:55:11'),
(35, 'Nón Đen', 'non-den', 95000, 0, 'non-den.JPG', 'BOhHV.JPG,3C9Bb.JPG,vj5MV.jpg', 4, 15, 'OK!', '<p>OK!</p>\r\n', 1, 0, 0, 0, NULL, '2017-12-29 14:54:43'),
(36, 'Nón Nâu', 'non-nau', 185000, 0, 'non-nau.JPG', 'RzijP.JPG,QwXKL.JPG,W2MjP.jpg', 4, 15, 'OK!', '<p>OK!</p>\r\n', 1, 0, 2, 1, NULL, '2017-12-30 15:02:26'),
(37, 'Thắt Lưng Nam Nâu', 'that-lung-nam-nau', 245000, 0, 'that-lung-nam-nau.jpg', 'SibYr.jpg,PTGUW.jpg,ZOr24.jpg', 4, 16, 'OK!', '<p>OK!</p>\r\n', 1, 0, 0, 0, NULL, '2017-12-29 14:53:57'),
(38, 'Thắt Lưng Nam Xanh', 'that-lung-nam-xanh', 245000, 0, 'that-lung-nam-xanh.jpg', '0BGHV.jpg,4Tc6g.jpg,Xsk6L.jpg', 4, 16, 'OK!', '<p>OK!</p>\r\n', 1, 1, 1, 1, NULL, '2017-12-29 14:53:26'),
(39, 'Thắt Lưng Nam Đen', 'that-lung-nam-den', 245000, 0, 'that-lung-nam-den.jpg', 'W1lYr.jpg,uOAMz.jpg,zmFHI.jpg', 4, 16, 'OK!', '<p>OK!</p>\r\n', 1, 0, 0, 1, NULL, '2017-12-29 14:53:04'),
(40, 'Cà Vạt Đen', 'ca-vat-den', 145000, 0, 'q2673.jpg', 'T5ypU.jpg,q2673.jpg,jXYd4.jpg', 4, 17, '', 'OK!', 1, 0, 9, 0, NULL, '2017-12-28 16:21:00'),
(41, 'Cà Vạt Sọc', 'ca-vat-soc', 145000, 0, 'ca-vat-soc.jpg', 'lCfzB.jpg,bz4pI.jpg,DrH7y.jpg', 4, 17, 'OK!', '<p>OK!</p>\r\n', 1, 2, 1, 1, NULL, '2017-12-29 14:51:49'),
(42, 'Cà Vạt Caro', 'ca-vat-caro', 145000, 0, 'ca-vat-caro.jpg', 'RIKwC.jpg,ah8C9.jpg,2U5zn.jpg', 4, 17, 'OK!', '<p>OK!</p>\r\n', 1, 0, 0, 0, NULL, '2017-12-29 14:51:25'),
(43, 'Mắt Kính Xanh Rêu', 'mat-kinh-xanh-reu', 185000, 20, 'mat-kinh-xanh-reu.jpg', 'qpIiW.jpg,8QhrE.jpg,pcul7.jpg', 4, 18, 'OK!', '<p>OK!</p>\r\n', 1, 0, 1, 1, NULL, '2017-12-29 14:47:13'),
(44, 'Mắt Kính Vàng', 'mat-kinh-vang', 195000, 0, 'mat-kinh-vang.jpg', 'bD7Ip.jpg,3kLrP.jpg,e1hio.jpg', 4, 18, 'OK!', '<p>OK!</p>\r\n', 1, 0, 4, 0, NULL, '2017-12-29 14:52:27'),
(45, 'Mắt Kính Hồng', 'mat-kinh-hong', 225000, 25, 'OoaP3.jpg', 'OoaP3.jpg,le37C.jpg,Me7f5.jpg', 4, 18, 'OK!', 'OK!', 1, 0, 0, 0, NULL, '2017-12-29 16:05:55'),
(46, 'Áo sơ mi Mr.RIN', 'ao-so-mi-mrrin', 145000, 20, 'yL2SC.jpg', '2LVSa.jpg,rLz0n.jpg,ZJtOL.jpg', 1, 5, 'OK!', '<p>OK!</p>\r\n', 0, 0, 46, 1, NULL, '2017-12-30 15:00:44'),
(47, 'quần jeans chất lượng cao', 'quan-jeans-chat-luong-cao', 500000, 10, '27gMl.jpg', 'zKdoC.jpg,GX56y.jpg,Q1Bxo.jpg', 2, 10, 'OK!', '<p>OK!</p>\r\n', 1, 3, 14, 1, NULL, '2017-12-29 16:37:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taikhoan`
--

CREATE TABLE `taikhoan` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` char(15) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL,
  `pay` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `taikhoan`
--

INSERT INTO `taikhoan` (`id`, `name`, `email`, `phone`, `address`, `note`, `pay`, `created_at`, `updated_at`) VALUES
(1, 'Đặng Minh Đạt', 'dangminhdat.qnam@gmail.com', '01215300516', '41 Trần quý cáp, vĩnh điện, điện bàn, Quảng Nam', '', 2, '2017-12-29 09:18:40', NULL),
(2, 'Đặng Minh Đạt', 'dangminhdat.qnam@gmail.com', '01215300516', '41, vĩnh điện, điện bàn, Quảng Nam', '', 0, '2017-12-29 10:10:53', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `website`
--

CREATE TABLE `website` (
  `title` text NOT NULL,
  `describ` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `keywords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `website`
--

INSERT INTO `website` (`title`, `describ`, `status`, `keywords`) VALUES
('Website bàn hàng online - XP Shop', 'Chuyên cung cấp áo quần phụ kiện cho nam giới', 1, 'bán hàng');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `chuyenmuc`
--
ALTER TABLE `chuyenmuc`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `dathang`
--
ALTER TABLE `dathang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `giaodich`
--
ALTER TABLE `giaodich`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT cho bảng `chuyenmuc`
--
ALTER TABLE `chuyenmuc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT cho bảng `dathang`
--
ALTER TABLE `dathang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `giaodich`
--
ALTER TABLE `giaodich`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT cho bảng `taikhoan`
--
ALTER TABLE `taikhoan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
