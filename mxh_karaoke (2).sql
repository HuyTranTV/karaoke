-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 15, 2021 at 12:45 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mxh_karaoke`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `ID_CMT` char(20) NOT NULL,
  `ID_USER` char(10) NOT NULL,
  `NOIDUNG` varchar(300) NOT NULL,
  `NGAY_CMT` date NOT NULL DEFAULT current_timestamp(),
  `ID_VIDEO` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`ID_CMT`, `ID_USER`, `NOIDUNG`, `NGAY_CMT`, `ID_VIDEO`) VALUES
('1359866421', '1025066524', 'good', '2021-10-01', 'xIZr3GbSHr8'),
('1633228470', '1176460198', 'ok', '2021-08-30', 'xIZr3GbSHr8'),
('1651619277', '1176460198', 'ghee', '2021-10-01', 'xIZr3GbSHr8'),
('825083498', '1176460198', 'vip ghe', '0000-00-00', 'xIZr3GbSHr8');

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE `record` (
  `ID_RECORD` int(15) NOT NULL,
  `ID_USER` char(10) NOT NULL,
  `LINK` varchar(200) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `NGAY_DANG` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`ID_RECORD`, `ID_USER`, `LINK`, `Name`, `NGAY_DANG`) VALUES
(22, '1176460198', 'upload_my_record/yeumotnguoikara.mp3', 'yeumotnguoikara.mp3', '2021-10-03'),
(23, '1025066524', 'upload_my_record/huyhat.wav', 'huyhat.wav', '2021-10-14'),
(24, '1176460198', 'upload_my_record/sound.wav', 'sound.wav', '2021-10-14'),
(25, '1176460198', 'upload_my_record/phaigiuemthenao.wav', 'phaigiuemthenao.wav', '2021-10-14');

-- --------------------------------------------------------

--
-- Table structure for table `rep_cmt`
--

CREATE TABLE `rep_cmt` (
  `ID_USER` char(10) NOT NULL,
  `NOIDUNG` varchar(300) NOT NULL,
  `NGAY_CMT` date NOT NULL DEFAULT current_timestamp(),
  `ID_CMT` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rep_cmt`
--

INSERT INTO `rep_cmt` (`ID_USER`, `NOIDUNG`, `NGAY_CMT`, `ID_CMT`) VALUES
('1176460198', 'vip', '0000-00-00', ''),
('1176460198', 'hay', '2021-10-01', '825083498'),
('1176460198', 'dinh', '2021-10-01', '825083498');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID_USER` char(10) NOT NULL,
  `HOTEN_USER` char(40) NOT NULL,
  `SDT_USER` char(10) NOT NULL,
  `EMAIL_USER` varchar(200) NOT NULL,
  `hinhanh` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_USER`, `HOTEN_USER`, `SDT_USER`, `EMAIL_USER`, `hinhanh`) VALUES
('1025066524', 'Huy', '', 'huyprovn43@gmail.com', 'https://lh3.googleusercontent.com/a-/AOh14GillV1VxDsh29vIGGfKZqyDHGvH1AuykVtrUr037Bw=s96-c'),
('1176460198', 'Tran Van Huy', '', 'huyb1706475@student.ctu.edu.vn', 'https://lh3.googleusercontent.com/a-/AOh14Ghrc9SDC5pTT8EMDG__demiFa7SnfTh0EoV39-hBQ=s96-c'),
('123321123', 'huy tran', '', 'propro@23.com', 'https://scontent.fsgn5-3.fna.fbcdn.net/v/t39.30808-6/240670649_974516369763214_5028706159778686071_n.jpg?_nc_cat=111&ccb=1-5&_nc_sid=09cbfe&_nc_ohc=yr627u9y5M8AX-VTdC2&_nc_ht=scontent.fsgn5-3.fna&oh=86afbdb1ee2624b8993a2e6e4a7b3b5b&oe=61534D2E');

-- --------------------------------------------------------

--
-- Table structure for table `user_xem_video`
--

CREATE TABLE `user_xem_video` (
  `ID_USER` char(10) NOT NULL,
  `ID_VIDEO` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_xem_video`
--

INSERT INTO `user_xem_video` (`ID_USER`, `ID_VIDEO`) VALUES
('1025066524', '0Zc2SyERJNk'),
('1025066524', '5lZtoClEbHE'),
('1025066524', 'dsmbp8ccubE'),
('1025066524', 'xIZr3GbSHr8'),
('1176460198', '-IGwI1OAV9c'),
('1176460198', '-k8595D4ASo'),
('1176460198', '-W3zezYatEQ'),
('1176460198', '6X5HW85E4t8'),
('1176460198', 'dsmbp8ccubE'),
('1176460198', 'iYYZMS402CI'),
('1176460198', 'N6QY9gnp3w0'),
('1176460198', 'xIZr3GbSHr8');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `ID_VIDEO` varchar(20) NOT NULL,
  `NAME_VIDEO` varchar(300) NOT NULL,
  `HINHANH_VIDEO` varchar(100) NOT NULL,
  `HOT` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`ID_VIDEO`, `NAME_VIDEO`, `HINHANH_VIDEO`, `HOT`) VALUES
('-IGwI1OAV9c', '[ Karaoke Mashup ] Hãy Đến Với Em (Remix) | Vĩnh Thuyên Kim', 'https://i.ytimg.com/vi/-IGwI1OAV9c/hqdefault.jpg', '6'),
('-k8595D4ASo', 'NGÀY CHƯA GIÔNG BÃO (KARAOKE VERSION) | Tùng Dương Official', 'https://i.ytimg.com/vi/-k8595D4ASo/hqdefault.jpg', '4'),
('-W3zezYatEQ', 'KARAOKE (Beat Gốc) CỐ GIANG TÌNH | Phát Hồ x JokeS Bii ft. DinhLong', 'https://i.ytimg.com/vi/-W3zezYatEQ/hqdefault.jpg', '9'),
('0Zc2SyERJNk', '[Karaoke] Một Bước Yêu Vạn Dặm Đau - Mr siro', 'https://i.ytimg.com/vi/0Zc2SyERJNk/hqdefault.jpg', '5'),
('5lZtoClEbHE', '(Karaoke) YÊU LÀ CƯỚI - PHÁT HỒ X2X | TONE NỮ', 'https://i.ytimg.com/vi/5lZtoClEbHE/hqdefault.jpg', '7'),
('6X5HW85E4t8', 'KARAOKE BEAT [Nước Mắt if Tăng Phúc]', 'https://i.ytimg.com/vi/6X5HW85E4t8/hqdefault.jpg', '77'),
('dsmbp8ccubE', 'Không Muốn Yêu Lại Càng Say Đắm  Mr.Siro [karaoke Tone Nữ]', 'https://i.ytimg.com/vi/dsmbp8ccubE/hqdefault.jpg', '11'),
('iYYZMS402CI', 'Phải Giữ Em Thế Nào Karaoke Mr.Siro | Beat Chuẩn | Karaoke Tone Nam', 'https://i.ytimg.com/vi/iYYZMS402CI/hqdefault.jpg', '5'),
('N6QY9gnp3w0', 'YÊU NGƯỜI KHÔNG Thể YÊU KARAOKE mr.siro', 'https://i.ytimg.com/vi/N6QY9gnp3w0/hqdefault.jpg', '3'),
('xIZr3GbSHr8', 'Không Muốn Yêu Lại Càng Say Đắm [ KARAOKE ] - Mr. Siro | Beat Chuẩn', 'https://i.ytimg.com/vi/xIZr3GbSHr8/hqdefault.jpg', '111');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`ID_CMT`),
  ADD KEY `FK_IDVIDEO_CMT` (`ID_VIDEO`),
  ADD KEY `FK_IDUSER_CMT` (`ID_USER`);

--
-- Indexes for table `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`ID_RECORD`),
  ADD KEY `FK_RECORD_USER` (`ID_USER`);

--
-- Indexes for table `rep_cmt`
--
ALTER TABLE `rep_cmt`
  ADD KEY `FK_USER_REPCMT` (`ID_USER`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Indexes for table `user_xem_video`
--
ALTER TABLE `user_xem_video`
  ADD PRIMARY KEY (`ID_USER`,`ID_VIDEO`),
  ADD KEY `FK_IDVIDEO` (`ID_VIDEO`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`ID_VIDEO`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `record`
--
ALTER TABLE `record`
  MODIFY `ID_RECORD` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_IDUSER_CMT` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`),
  ADD CONSTRAINT `FK_IDVIDEO_CMT` FOREIGN KEY (`ID_VIDEO`) REFERENCES `video` (`ID_VIDEO`);

--
-- Constraints for table `record`
--
ALTER TABLE `record`
  ADD CONSTRAINT `FK_RECORD_USER` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`);

--
-- Constraints for table `rep_cmt`
--
ALTER TABLE `rep_cmt`
  ADD CONSTRAINT `FK_USER_REPCMT` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`);

--
-- Constraints for table `user_xem_video`
--
ALTER TABLE `user_xem_video`
  ADD CONSTRAINT `FK_IDUSER` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`),
  ADD CONSTRAINT `FK_IDVIDEO` FOREIGN KEY (`ID_VIDEO`) REFERENCES `video` (`ID_VIDEO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
