-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Oct 06, 2016 at 03:38 PM
-- Server version: 5.6.33
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `book4hol_holiday`
--

-- --------------------------------------------------------

--
-- Table structure for table `error_log`
--

CREATE TABLE IF NOT EXISTS `error_log` (
  `errorid` int(10) NOT NULL,
  `date` datetime NOT NULL,
  `error` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eventreviews`
--

CREATE TABLE IF NOT EXISTS `eventreviews` (
  `rid` int(10) NOT NULL AUTO_INCREMENT,
  `pricereview` int(4) NOT NULL,
  `subject` longtext NOT NULL,
  `review` longtext NOT NULL,
  `customerid` int(10) NOT NULL,
  `reviewgivendate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `resortoreventname` int(10) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mobilesliders`
--

CREATE TABLE IF NOT EXISTS `mobilesliders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `type` varchar(20) NOT NULL,
  `value` int(10) NOT NULL,
  `status` int(2) NOT NULL,
  `image` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `mobilesliders`
--

INSERT INTO `mobilesliders` (`id`, `title`, `type`, `value`, `status`, `image`) VALUES
(5, 'zoo', 'zoo', 1, 1, 'zoo.png'),
(3, 'Golconda', 'placedetails', 1, 1, 'Golconda.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `placereviews`
--

CREATE TABLE IF NOT EXISTS `placereviews` (
  `prid` int(10) NOT NULL AUTO_INCREMENT,
  `pricereview` int(4) NOT NULL,
  `subject` longtext NOT NULL,
  `review` longtext NOT NULL,
  `customerid` int(10) NOT NULL,
  `reviewgivendate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `placeid` int(10) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '1:show,0:false',
  PRIMARY KEY (`prid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `resortreviews`
--

CREATE TABLE IF NOT EXISTS `resortreviews` (
  `rrid` int(10) NOT NULL AUTO_INCREMENT,
  `pricereview` int(4) NOT NULL,
  `subject` longtext NOT NULL,
  `review` longtext NOT NULL,
  `customerid` int(10) NOT NULL,
  `reviewgivendate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `resortname` varchar(75) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rrid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `smssettings`
--

CREATE TABLE IF NOT EXISTS `smssettings` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `url` varchar(75) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `senderid` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `smssettings`
--

INSERT INTO `smssettings` (`id`, `url`, `username`, `password`, `senderid`) VALUES
(1, 'http://smslogin.mobi/spanelv2/api.php?username=', 'adepto', 'adepto@123', 'ADEPTO');

-- --------------------------------------------------------

--
-- Table structure for table `taxmaster`
--

CREATE TABLE IF NOT EXISTS `taxmaster` (
  `taxid` int(10) NOT NULL AUTO_INCREMENT,
  `servicetax` int(5) NOT NULL,
  `swachcess` decimal(10,2) NOT NULL,
  `krishicess` decimal(10,2) NOT NULL,
  `kidsmealtax` int(5) NOT NULL,
  PRIMARY KEY (`taxid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `taxmaster`
--

INSERT INTO `taxmaster` (`taxid`, `servicetax`, `swachcess`, `krishicess`, `kidsmealtax`) VALUES
(1, 14, '0.50', '0.50', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tblbookings`
--

CREATE TABLE IF NOT EXISTS `tblbookings` (
  `bookingid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bookingtypeid` int(10) unsigned DEFAULT NULL,
  `date` date DEFAULT NULL,
  `dateofvisit` date NOT NULL,
  `userid` int(10) unsigned DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `amount` varchar(45) DEFAULT NULL,
  `booking_status` varchar(45) DEFAULT NULL,
  `payment_status` varchar(45) DEFAULT NULL,
  `ticketnumber` varchar(90) DEFAULT NULL,
  `packageid` varchar(45) DEFAULT NULL,
  `visitorstatus` varchar(45) DEFAULT NULL,
  `vendorid` int(10) NOT NULL,
  `childqty` int(10) DEFAULT NULL,
  `kidsmealqty` int(5) DEFAULT '0',
  `ipaddress` varchar(150) NOT NULL,
  `flag` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`bookingid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `tblbookings`
--

INSERT INTO `tblbookings` (`bookingid`, `bookingtypeid`, `date`, `dateofvisit`, `userid`, `quantity`, `amount`, `booking_status`, `payment_status`, `ticketnumber`, `packageid`, `visitorstatus`, `vendorid`, `childqty`, `kidsmealqty`, `ipaddress`, `flag`) VALUES
(1, NULL, '2016-10-05', '2016-10-05', 97, 0, '5.57', 'booked', 'paid', '147566695913', '1', 'absent', 24, 1, 0, '122.169.145.1', 0),
(2, NULL, '2016-10-05', '2016-10-26', 16, 0, '5.57', 'booked', 'paid', '147566852659', '1', 'absent', 24, 1, 0, '122.169.145.1', 0),
(3, NULL, '2016-10-05', '2016-10-05', 98, 0, '5.57', 'booked', 'paid', '147567185757', '1', 'visited', 24, 1, 0, '122.169.145.1', 1),
(4, NULL, '2016-10-05', '2016-10-05', 99, 0, '5.57', 'booked', 'paid', '147567366414', '1', 'visited', 24, 1, 0, '122.169.145.1', 1),
(5, NULL, '2016-10-05', '2016-10-05', 100, 0, NULL, 'booked', 'paid', '147567375961', '1', 'visited', 24, 1, 0, '122.169.145.1', 1),
(6, NULL, '2016-10-06', '2016-10-08', 16, 2, '78.06', 'pending', 'pending', '147573036729', '1', 'absent', 24, 2, 0, '122.169.145.1', 0),
(7, NULL, '2016-10-06', '2016-10-08', 16, 2, '78.06', 'pending', 'pending', '147573057799', '1', 'absent', 24, 2, 0, '122.169.145.1', 0),
(8, NULL, '2016-10-06', '2016-10-07', 16, 2, '66.90', 'pending', 'pending', '147573065415', '1', 'absent', 24, 0, 0, '122.169.145.1', 0),
(9, NULL, '2016-10-06', '2016-10-08', 16, 2, '78.06', 'pending', 'pending', '147573198696', '1', 'absent', 24, 2, 0, '122.169.145.1', 0),
(10, NULL, '2016-10-06', '2016-10-06', 101, 0, '5.57', 'pending', 'pending', '147573489079', '1', 'absent', 24, 1, 0, '183.82.181.100', 0),
(11, NULL, '2016-10-06', '2016-10-06', 102, 0, '5.57', 'pending', 'pending', '147573490977', '1', 'absent', 24, 1, 0, '183.82.181.100', 0),
(12, NULL, '2016-10-06', '2016-10-06', 103, 0, '5.57', 'pending', 'pending', '147573514969', '1', 'absent', 24, 1, 0, '183.82.181.100', 0),
(13, NULL, '2016-10-06', '2016-10-06', 104, 0, '5.57', 'pending', 'pending', '147573534704', '1', 'absent', 24, 1, 0, '183.82.181.100', 0),
(14, NULL, '2016-10-06', '2016-10-07', 105, 0, '5.57', 'pending', 'pending', '147573540892', '1', 'absent', 24, 1, 0, '183.82.181.100', 0),
(15, NULL, '2016-10-06', '2016-10-06', 106, 1, '33.46', 'pending', 'pending', '147573586288', '1', 'absent', 24, 0, 0, '183.82.181.100', 0),
(16, NULL, '2016-10-06', '2016-10-06', 107, 1, '33.46', 'pending', 'pending', '14757360876', '1', 'absent', 24, 0, 0, '183.82.181.100', 0),
(17, NULL, '2016-10-06', '2016-10-06', 108, 0, '5.57', 'pending', 'pending', '147573614765', '1', 'absent', 24, 1, 0, '122.169.145.1', 0),
(18, NULL, '2016-10-06', '2016-10-06', 16, 0, '5.57', 'pending', 'pending', '147573626864', '1', 'absent', 24, 1, 0, '122.169.145.1', 0),
(19, NULL, '2016-10-06', '2016-10-06', 16, 0, '5.57', 'pending', 'pending', '147573677179', '1', 'absent', 24, 1, 0, '122.169.145.1', 0),
(20, NULL, '2016-10-06', '2016-10-06', 109, 1, '33.46', 'failed', 'failed', '147573684543', '1', 'absent', 24, 0, 0, '183.82.181.100', 0),
(21, NULL, '2016-10-06', '2016-10-06', 110, 0, '5.57', 'booked', 'paid', '147573708004', '1', 'absent', 24, 1, 0, '183.82.181.100', 0),
(22, NULL, '2016-10-06', '2016-10-06', 112, 2, '72.47', 'pending', 'pending', '14757397021', '1', 'absent', 24, 1, 0, '183.82.181.100', 0),
(23, NULL, '2016-10-06', '2016-12-22', 113, 2, '66.90', 'pending', 'pending', '147574213327', '1', 'absent', 24, 0, 0, '103.41.97.149', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblcities`
--

CREATE TABLE IF NOT EXISTS `tblcities` (
  `cityid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cityname` varchar(45) DEFAULT NULL,
  `stateid` int(10) unsigned DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`cityid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblcountries`
--

CREATE TABLE IF NOT EXISTS `tblcountries` (
  `countryid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `countryname` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`countryid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomers`
--

CREATE TABLE IF NOT EXISTS `tblcustomers` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` longtext,
  `number` varchar(45) DEFAULT NULL,
  `dateofcreation` date DEFAULT NULL,
  `otp` varchar(50) NOT NULL DEFAULT '0',
  `regtype` varchar(60) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=114 ;

--
-- Dumping data for table `tblcustomers`
--

INSERT INTO `tblcustomers` (`customer_id`, `name`, `username`, `password`, `number`, `dateofcreation`, `otp`, `regtype`) VALUES
(1, 'narendra', 'narndra.sharma202007@gmail.com', '9688f90030cd45a0b509800aea7d95bef0e1c7d80e07d7ece86cd7da66f0282b47c5410aad7a2256f54f34078d4aadaab9f614f2223ec438200feeffeabfc20e', '9885754456', '2016-09-02', '', 'registration'),
(4, 'Tedx', 'sainikhil013@gmail.com', NULL, '7893514850', '2016-09-06', '0', 'Guest'),
(5, 'narendra', 'n@f.c', NULL, '9885754456', '2016-09-07', '0', 'Guest'),
(6, 'narendra', 'n@f.c', NULL, '9160144429', '2016-09-07', '0', 'Guest'),
(7, 'Akhil', 'akhil.shamanth@gmail.com', NULL, '9177399175', '2016-09-07', '0', 'Guest'),
(8, 'Tedx', 'sainikhil013@gmail.com', NULL, '7893514850', '2016-09-09', '0', 'Guest'),
(9, 'Tedx', 'sainikhil013@gmail.com', NULL, '7893514850', '2016-09-09', '0', 'Guest'),
(10, 'Tedx', 'sainikhil013@gmail.com', NULL, '7893514850', '2016-09-09', '0', 'Guest'),
(11, 'Tedx', 'sainikhil013@gmail.com', NULL, '7893514850', '2016-09-09', '0', 'Guest'),
(12, 'Tedx', 'sainikhil013@gmail.com', NULL, '7893514850', '2016-09-09', '0', 'Guest'),
(13, 'Tedx', 'sainikhil013@gmail.com', NULL, '7893514850', '2016-09-09', '0', 'Guest'),
(14, 'Tedx', 'sainikhil013@gmail.com', NULL, '7893514850', '2016-09-09', '0', 'Guest'),
(16, 'amar', 'sainikhil013@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', '7893514850', '2016-09-09', '', 'registration'),
(17, 'ghh', 'fdf@rf.g', NULL, '9160144429', '2016-09-09', '0', 'Guest'),
(18, 'Akhil', 'akhil.shamanth@gmail.com', NULL, '9177399175', '2016-09-20', '0', 'Guest'),
(19, 'suku', 's@g.com', NULL, '9849845571', '2016-09-20', '0', 'Guest'),
(20, 'satish', 'sathi.satya@gmail.com', NULL, '8886922279', '2016-09-20', '0', 'Guest'),
(21, 'satish', 'sath.satya@gmail.com', NULL, '8886922279', '2016-09-20', '0', 'Guest'),
(22, 'satish', 'sainikhil013@gmail.com', NULL, '7893514850', '2016-09-20', '0', 'Guest'),
(23, 'Tedx', 'sainikhil013@gmail.com', NULL, '7893514850', '2016-09-20', '0', 'Guest'),
(24, 'fghvhh', 'GH@n.y', NULL, '9885754456', '2016-09-20', '0', 'Guest'),
(25, 'narendra', 'narendra.sharma202007@gmail.com', 'aee1dcaecf89464e6f1a70b7cc763f0ee49e5b0661ce47af325ee68c786bc1dc976670eee780de7dc61f2b1c419e47b10771921a540e1095f7c496b2e38348d9', '9885754456', '2016-09-21', '0', 'Guest'),
(26, 'narendra', 'narendra.sharma202007@gmail.com', '4f72c046018b3c80f2507656cd68cdb8eac1dca688df63776499df7b6740c94f89a57e74e1701ed336522c5c0088f84dc21a323a2ba09e1c509129d3c27b32e1', '9885754456', '2016-09-21', '0', 'Guest'),
(27, 'narendra', 'narendra.sharma202007@gmail.com', 'd49dda6573bd273c58f49f6ed5d68c08d7767f25640280493a6ae55243077a190482e8b98c9661fe3cbc08695086717791008f726da2b83b6dacd507763fb95f', '9885754456', '2016-09-21', '0', 'Guest'),
(28, 'narendra', 'narendra.sharma202007@gmail.com', '174bef7fdf94b4348d140ae133d05138b1aeedf5f4870b38349fd9697d335d359f300dd0696235205ca11db0092f6ba08a0141a93d83f17a47644c9a3156779f', '9885754456', '2016-09-21', '0', 'Guest'),
(29, 'narendra', 'narendra.sharma202007@gmail.com', NULL, '9885754456', '2016-09-21', '0', 'Guest'),
(30, 'chinnu', 'Sharma@gmail.com', NULL, '9885754456', '2016-09-21', '0', 'Guest'),
(31, 'Narendra', 'narendra.sharma202007@gmail.com', 'db9cdaac3825692c599512a4c6956c76e0e1b57144f254348ed55157fe99861cd94c5e804de31563ee1bbd11283b010f3fb86e0e734233edb213d3ce8567a365', '9885754456', '2016-09-21', '0', 'Guest'),
(32, 'Narendra', 'narendra.sharma202007@gmail.com', 'b3e95f30f744a25bc8a51ee0893a1e989dec8d4583db618d70fb8735505b0013372c64cab799bd12546302dbd5b7cce0fe5e40a7355f549b1c4161c9ae144d37', '9885754456', '2016-09-21', '0', 'Guest'),
(33, 'Narendra', 'narendra.sharma202007@gmail.com', '91b6cb3ce70d548e23a321cd3b60d8b31c012ffa5848c986d07ed25a482e93a5e0e29bc447ee3390bb8541d796969ba301fc056af5fe3a5c91df92c10028f2dc', '9885754456', '2016-09-21', '0', 'Guest'),
(34, 'Narendra', 'narendra.sharma202007@gmail.com', 'd9bb1f698d0fd2dbd6ca7c7735c802a2a9a1ee0f992cc1d216c00856b2abd7e64a8f857994e6e26e75d3d1118b32c9dc7286eebf205858b67332523dfae75798', '9885754456', '2016-09-21', '0', 'Guest'),
(35, 'narendra sharma', 'narendra.sharma202007@gmail.com', 'd13464f850589926e2ee4034c3bb72306834df207a4812a46cb452b50c8f39228332764c45b93468c0d1ea942fc0d0b155c6f4885321140c4ca1298bb1f157c8', '9885754456', '2016-09-21', '0', 'Guest'),
(36, 'narendra sharma', 'narendra.sharma202007@gmail.com', '63bd2c69bde76f69c560ceabf9747087600cb4b134835d743e7c26f003f5ae40d6090a37bc24300fa5a5e4b514194dad74a0250539813cd8301078663e03804d', '9885754456', '2016-09-21', '0', 'Guest'),
(37, 'satish', 'sathi.satya@gmail.com', NULL, '8886922279', '2016-09-22', '0', 'Guest'),
(38, 'satish', 'sathi.satya@gmail.com', 'b13c99de7f889fbfc6b93f442d0b5c0e5dc1568848b208fca1a5c2cac9bf04b8d0d02a3011307163232367781f88f93552ffefb48c155159d7ed926235983ca3', '8886922279', '2016-09-22', '0', 'Guest'),
(39, 'satish', 'sathi.satya@gmail.com', NULL, '8886922279', '2016-09-22', '0', 'Guest'),
(40, 'narendra sharma', 'narendra.sharma202007@gmail.com', '022514bfeefd5a5824be751551790e0f124cfd1e76ff3b9942b16be5848684277b6a08270e532acd9dbb493a7668e2ee1ff431284e678219b93ac7f33d2490d4', '9885754456', '2016-09-22', '0', 'Guest'),
(41, 'narendra', 'narendra@shake.x', NULL, '9885754456', '2016-09-22', '0', 'Guest'),
(42, 'satish', 'sa@yahoo.com', NULL, '8886922279', '2016-09-22', '0', 'Guest'),
(43, 'satish', 'sathi.satya@gmail.com', '6b91fbed4f2c3a20c0715479f10c3e375c82dccfc871bb7bab5914eab2b90a6805b10428bf9cdd92ccc1e95971253822ba1e2be6c6ffba21111c601c6db49dd1', '8886922279', '2016-09-22', '0', 'Guest'),
(44, 'Akhil Shamanth Medak', 'akhil.shamanth@gmail.com', '197d87374feb565a8c14659c17b692c36b64b60ffde3c581225faa846e6517d543b35e938f7a371126a775106e8a19bf7e4c678a906336f0bc66a46f7929a81f', '9177399175', '2016-09-22', '0', 'Guest'),
(45, 'Akhil Shamanth Medak', 'akhil.shamanth@gmail.com', '73be61475625cb7414062ab6ef9229adc059cc85fb2b359be6d43c9ef0679c7d2c089dac86e794981b306a84d5dd11157ab83ba13b2fa54aa90ff8fc32d5cbb3', '9177399175', '2016-09-22', '0', 'Guest'),
(46, 'Akhil Shamanth Medak', 'akhil.shamanth@gmail.com', 'af38482ce3f12237a4d8a970d9d888863acaa530147e83589d3a3b19c193f5e70c926bd09b6e831d0de920e795f3eb5819f3ba4031397cded5a0676e873ecbfe', '9177399175', '2016-09-22', '0', 'Guest'),
(47, 'Akhil Shamanth Medak', 'akhil.shamanth@gmail.com', '3c21a5d2623febad765128b61bac2372d8124c9c66e52087e02b3bed42e9d7a18b35d6f8b1701807708941126d434553918f634e3d2998821fc68cb8d9e2983a', '9177399175', '2016-09-22', '0', 'Guest'),
(48, 'Akhil Shamanth Medak', 'akhil.shamanth@gmail.com', '5f00dc6b82e6c4198d4f8def82d851253bd5cf1f4ed12cf6cb1c178540573ad236b07a9b845a27f2161bfa180dd8a072a07a341b6257e66e79a53dc12b1af2c1', '9177399175', '2016-09-22', '0', 'Guest'),
(49, 'Satish', 'sa@yah.com', 'e4c70d7d065104be1f753236abcac6f1a3fe05575e2159f059f9c75c1dcb2862a03d21412f567441ded42afa215f9b3993bdd691273268db5cd811f340f3cc6f', '8886922279', '2016-09-22', '0', 'Guest'),
(50, 'narendra', 'narendra@sharks.com', NULL, '9885754456', '2016-09-22', '0', 'Guest'),
(51, 'Sharma', 'Sharma@cut.v', NULL, '9885754456', '2016-09-22', '0', 'Guest'),
(52, 'satish', 'sat@ya.com', NULL, '8886922279', '2016-09-24', '0', 'Guest'),
(53, 'satish', 'sathi.satya@gmail.com', NULL, '8886922279', '2016-09-26', '0', 'Guest'),
(54, 'satish', 'sathi.satya@gmail.com', 'b95e80ae352ed3ea5a48085addb7256588fb9f3bf696e2db8c3eadfc0972293b77c218895e0461ade00e6990608dded8e8cbc25daedaf0707c74a66fe9c67f54', '8886922279', '2016-09-26', '0', 'Guest'),
(55, 'satish', 'sathi.satya@gmail.com', '5c610ca3d6f902e9e40c546e2d59896078ec9efd5b994d0dca73bcd9e968dbef2031b1247ca7e63d38ca8cc5d050dfce2986f5fe359978189e236707a001004b', '8886922279', '2016-09-28', '0', 'Guest'),
(56, 'satish', 'sathi.satya@gmail.com', 'deff0f359902bdc2abda7ebb164916ca0b8401d73ec84294a35f3c3cbe4af6e449826023a2337be0c2d55f6a9adacd0a004ecf4330cd3deeb41a9c703a3a7d1c', '8886922279', '2016-09-28', '0', 'Guest'),
(57, 'M Akhil Shamanth', 'akhil.shamanth@gmail.com', NULL, '9177399175', '2016-09-28', '0', 'Guest'),
(58, 'satish', 'sathi.satya@gmail.com', NULL, '8886922279', '2016-09-28', '0', 'Guest'),
(59, 'aa', 'sa@qw.com', NULL, '8886922279', '2016-09-28', '0', 'Guest'),
(60, 'satish', 'sathi.satya@gmail.com', '89ef45d173cf6c18ab59fb6e682efa622227011aa1ea2dc4d0dcf0a5e0d2b48675094c902c4c94cac707a55547d958ae75ed7d47b25d81eadc0f6656332ef550', '8886922279', '2016-09-28', '0', 'Guest'),
(61, 'Tedx', 'sainikhil013@gmail.com', NULL, '7893514850', '2016-09-29', '0', 'Guest'),
(62, 'Tedx', 'sainikhil013@gmail.com', NULL, '7893514850', '2016-09-29', '0', 'Guest'),
(63, 'add', 'sainikhil013@gmail.com', NULL, '7893514850', '2016-09-29', '0', 'Guest'),
(64, 'sh', 'saihg@hh.vh', NULL, '7893514850', '2016-09-29', '0', 'Guest'),
(65, 'satish', 'sa@gh.com', NULL, '8886922279', '2016-09-29', '0', 'Guest'),
(66, 'sh', 'sh@gg.chn', NULL, '7893514850', '2016-09-29', '0', 'Guest'),
(67, 'satya', 'sainikhil013@gmail.com', NULL, '7893514850', '2016-09-29', '0', 'Guest'),
(68, 'satish', 'sathi.satya@gmail.com', '4fc14469eecf7d6754328798f14998d104487c74a80a509c17d4d7bda0555bb22ab802624a18decf62308ebf3d629a58471cee384fc004edb123644be8b94be4', '8886922279', '2016-09-29', '0', 'Guest'),
(69, 'satish', 'sathi.satya@gmail.com', 'e872a9db42f65021d01fd918923865a9699b18f9799513e49f2c77792c8de3ba1834fbb0f79543038a252f8652311846de25455be3a29062ba7bc1752db06e9a', '8886922279', '2016-09-29', '0', 'Guest'),
(70, 'satish', 'sathi.satya@gmail.com', 'ac415a2ace351f80d896666dff08c362ccc2f4815b57b77884a2dfbc8c4f5192b37695b6a600d115aa830a00bef4421bc20ba57b689077b687763071fc7a0d71', '8886922279', '2016-09-29', '0', 'Guest'),
(71, 'satish', 'sathi.satya@gmail.com', 'e40a74b24979cf5ac9f8ad293f7222499ddd5b936183c35437cccfc0b82d40539b96e7f76a71de459608b8f6b2d850de8dd8d877baa3875244da2373b6c71f3f', '8886922279', '2016-09-29', '0', 'Guest'),
(72, 'satish', 'sathi.satya@gmail.com', 'ffbca453c09cdcbffab2c97b83c93c40dcda45e5feef96e874d240e6a12080ae35127444cc5df2c44326f0459243b62fa6c034312fd42d5da10f1fb3e3c91899', '8886922279', '2016-09-29', '0', 'Guest'),
(73, 'satish', 'sathi.satya@gmail.com', '110ee2f9653664ec3ed52f0b721319261f9e23e1a6aa29aae5cdefe1601cb54c45f9f360cbfc97af3481e1235515153c1800b59c277b40e5bf071ef5f6337194', '8886922279', '2016-09-29', '0', 'Guest'),
(74, 'satish', 'sathi.satya@gmail.com', 'c3561197c6c5a7f4d509c08741acc3bae3eb0a025751eadb34437dab2f5d0b7b750f24e5fa1c3baa78b170f0d24d4467fc36993f0143a494e551393e378800b0', '8886922279', '2016-09-29', '0', 'Guest'),
(75, 'satish', 'sathi.satya@gmail.com', 'a0eeb5f1d7d6471165418a63b427003a68ecf9c3faa204bbbc7e691504e74acbb738679bbc937d669099517e8ddaa782242c3745478b4691531b2b02cd486d9b', '8886922279', '2016-09-29', '0', 'Guest'),
(76, 'satish', 'sathi.satya@gmail.com', '2dd4603773c2c7bbc38a50791108fe71db66fea8505505310edd030f9adac03db4b8968a0962dedd683a777ce75db6d5ceea55c4d3b2fe53a29f7cddcc597460', '8886922279', '2016-09-29', '0', 'Guest'),
(77, '', '', 'cf83e1357eefb8bdf1542850d66d8007d620e4050b5715dc83f4a921d36ce9ce47d0d13c5d85f2b0ff8318d2877eec2f63b931bd47417a81a538327af927da3e', '', '2016-09-30', '0', 'registration'),
(78, NULL, NULL, '175e9cf58bd62f6d3151f2502c76dcc1515f0f0750629ba37adccb211692f3e21bf852f63fa841c38df1de9804c532e2097608efe04981199675167fbd008744', NULL, '2016-09-30', '0', 'Guest'),
(79, 'Tedx', 'sainikhil013@gmail.com', '1435593ce7a53fc416d4881ea0ac584a6d8dc602decc102ce2306f6bfb22bf07f34d987f9b54fa7752284e93fc57a61c6b1fbe22a4c41eb72a27b1740b5c9c0c', '7893514850', '2016-09-30', '0', 'Guest'),
(80, 'narendra sharma', 'narendra.sharma202007@gmail.com', '32e5bda34244ad2ffda63afff28275d543a233acea48cd0fc6878559df191ff96668d5df9e4f4108459ee9ca08fd47a8513d7609695cc5d39137dbe4b20e15c1', '9885754456', '2016-09-30', '0', 'Guest'),
(81, 'Tedx', 'sainikhil013@gmail.com', 'd3a29a1f41cf2c590428e0ddcad6c787a814d7604b931c24068dca24dac59bd3726d6b3747dee8824dfdad03db54fe8bb0c19af1bea134c63edabb643a7986c5', '7893514850', '2016-09-30', '0', 'Guest'),
(82, 'narendra sharma', 'narendra.sharma202007@gmail.com', '563fac29c49d6e00bf76448d081b90aec8745f4719750587e9f29e4844ff6350309a2125c3fb5889a3ab07f55a94050bc8afac94aaf06e35e94df44b4a3ad670', '9885754456', '2016-09-30', '0', 'Guest'),
(83, 'satish', 'sathi.satya@gmail.com', 'd41206a8d16d4d90efece1885300680c729ce70ecddadae14ec1ba427fd1242ec61979a3499ffcb5b09ef6cdfa46f6dd7c0236396f0ba66e28a59e7480d24839', '8886922279', '2016-09-30', '0', 'Guest'),
(84, 'satish', 'sathi.satya@gmail.com', '4d296c5f3f67f6fdcc4bf483eb18c1fd0889ab3173dcd6efeccfa44082296fc543619bdaf746a594ba171acc9f8efdd4e1e09f7e581df3bed0d6c025959a3919', '8886922279', '2016-09-30', '0', 'Guest'),
(85, 'satish', 'sathi.satya@gmail.com', '1bf14010e03e1aff800c9770fa2a686e71f7e8ca84c9c78a9b8abfcfaf21df9be0aa444579f2ec675285cedc316c590a9b6b89c3355da3b3fb008df9f73fbbf5', '8886922279', '2016-09-30', '0', 'Guest'),
(86, 'satish', 'sathi.satya@gmail.com', 'afd8d5cc25eda6ef11b1038a48de19ba5259a62488937e2eed6273962e7e32d8f1c310c946e7f9c7de8d7105fccaac78a0b80d6007ee32b123d18d7698221592', '8886922279', '2016-09-30', '0', 'Guest'),
(87, 'jithu', 'jithender.k@ctrls.in', '6c638abd2b41c489472dbe0a0290a034e0fa6cd0f96e828cfd70182ba18c22188b5b75f48efbb40bfb18f3fe32117a096d7c46788ab9ce74b5df2cd92e9ed9d0', '9000286816', '2016-09-30', '0', 'Guest'),
(88, 'jithu', 'jithender.k@ctrls.in', 'e154e6bad2d9d6609059e74a5cb3930c8a39a39d8fbbbed0075aff5db3f9786c153ab53438eef38db3c1e745bac025486dccb59a04ed3183b447daa91cfcf8eb', '9000286816', '2016-09-30', '0', 'Guest'),
(89, 'narendra', 'narendra.sh@d.g', NULL, '9885754456', '2016-09-30', '0', 'Guest'),
(90, 'satish', 'sathi.satya@gmail.com', NULL, '8886922279', '2016-09-30', '0', 'Guest'),
(91, 'bcc', 'vvv@facebook.com', NULL, '9849845571', '2016-10-01', '0', 'Guest'),
(92, 'sukumar', 'sukumar.madishetti@gmail.com', NULL, '9849845571', '2016-10-01', '0', 'Guest'),
(93, 'sukumar', 'sukumar.madishetti@gmail.com', NULL, '9849845571', '2016-10-01', '0', 'Guest'),
(94, 'auk', 's@b.com', NULL, '9849845571', '2016-10-01', '0', 'Guest'),
(95, 's', 's@n.com', NULL, '9849845571', '2016-10-01', '0', 'Guest'),
(96, 'Tedx', 'sainikhil013@gmail.com', '2e915a2d8a1cca0839c9fdcc68041027563cf63106f66100f5e4b73455d9aefc5519dd0cb79e38f3fd9d4690af1d3b11012ef8d2326aa2a748a2a597b01dcc84', '9885754456', '2016-10-05', '0', 'Guest'),
(97, 'narendra', 'narendra.sharma202007@gmail.com', 'b41804cb8d6e3ef225d3d88079f73cabd67e61c3fa04cc43b405c5c31ea49a7916975ac1b9f6c33c66e0e7b785a036b28ee194de406803b2d01d5d31bbff9675', '9885754456', '2016-10-05', '0', 'Guest'),
(98, 'Sukumar', 'sukumar.madishetti@gmail.com', '8c4c2feaf03fe23db01ecdc35048ea4322b16e1dd508d51970ba584e2f7c800a36db00a0e4e15acb0eda8c262902b4b82740b46895f526f882594568b9dba799', '9849845571', '2016-10-05', '0', 'Guest'),
(99, 'narendra', 'narendra.sharma202007@gmail.com', '33139d3179731d5c0e13f47a74cc5d157b885a0c5cbcdecf6f7cab99748eb5749400aa343b4caa5592754680732285072a358c3adfdd90fac851006fc6f2f72e', '9885754456', '2016-10-05', '0', 'Guest'),
(100, 'sukumar', 'sukumar.madishetti@gmail.com', NULL, '9849845571', '2016-10-05', '0', 'Guest'),
(101, 'Sudhir Reddy', 'sudhirreddykura@yahoo.co.in', '14ee640de29a380d2f5bc4933db286dc2e385a0a86b431a21ea679436fc0728b7d3771ad9ee1394680554bac12b80c029e2ce7884e01778773f906296329d6aa', '9553555556', '2016-10-06', '0', 'Guest'),
(102, 'Sudhir Reddy', 'sudhirreddykura@yahoo.co.in', 'a62f0e96d18339692a72c42225c418d9e5badd7d4556713dc31d9aa96e6bc9fba51a7d4beba6fa184b9603e9d03d06dec8fa16ed0cc2c5526e7048cc7affb293', '9553555556', '2016-10-06', '0', 'Guest'),
(103, 'Sudhir Reddy', 'sudhirreddykura@yahoo.co.in', '50878783133c893f4da384ad5488ce53a91735fc36620feaf30f35a67489abc47c4cb200320e048730b6677fd7aa6646ce2fde92ccecefec5579df0ee174fed0', '9553555556', '2016-10-06', '0', 'Guest'),
(104, 'Sudhir Reddy', 'sudhirreddykura@yahoo.co.in', 'e9abe122741527066e7ac3753e7d74d471985174c1ec247542b2976026d725c8f3719bd71083e8e68d1d2e5945db40a628b3083abaa1ebe8e8ad493bb3efb879', '9553555556', '2016-10-06', '0', 'Guest'),
(105, 'Sudhir Reddy', 'sudhirreddykura@yahoo.co.in', '520ad375b0c71bbba2c1c41e2145c9e63e3cfc77847635ac085fa2c9a911708c4cb6d9b69e7d6498d4a8f9da0b39b9d19fc44897e749c18c0a37c0133f7541f6', '9553555556', '2016-10-06', '0', 'Guest'),
(106, 'Sudhir Reddy', 'sudhirreddykura@yahoo.co.in', 'e30a5475d2cf503143b3505cb0ee796838e3c45d1d699f8a4f222a73fa52341cee724c14421b8ad59885bbcb7153fdeceba6fb8568e47d1c6506e258e496320c', '9553555556', '2016-10-06', '0', 'Guest'),
(107, 'Sudhir Reddy', 'sudhirreddykura@yahoo.co.in', 'c322b3f2358d5b2e67d7a5128efb58ca96470cc419cbca407335cccb79b018a695bfd3d4fd9ccf3829ba6b741aff6d7f0e40b77281c1eb72a418bc0a6cd3ff73', '9553555556', '2016-10-06', '0', 'Guest'),
(108, 'Tedx', 'sainikhil013@gmail.com', '3dd13142fd084549502a67eaca9348468cf1cf0d3566aeb8b48e92bd7080c984f23f4b374128592a01c9d32b1a7381acab3a1433a7f793219f5912057a8aa2d0', '7893514850', '2016-10-06', '0', 'Guest'),
(109, 'Sudhir Reddy', 'sudhirreddykura@yahoo.co.in', '62e167306360b99a19683265dc9aabcb26f2ddb33efee46fd5925de6c7a05f0d8184fe81b591426dd20397fa43d5805838cf2022e14fa787752ab7bf14f3cd23', '9553555556', '2016-10-06', '0', 'Guest'),
(110, 'Sudhir Reddy', 'sudhirreddykura@yahoo.co.in', 'dbd36ca1756688ac4c32c97355540f5afec29286740d31d60d4ec10897479520c33defe0a065dd77bf4241080c0b102988ef8fc0fba8e18a27e44e8dfb75394d', '9553555556', '2016-10-06', '0', 'Guest'),
(111, 'sarath', 'sarath.madineni@gmail.com', '9e257bf7dc91f25c480d94035cc20b087a37142da5a4417b171feb6231fe44cdabafb147d3798436c3de791773c2f2514a916066c3efa87feddb7119d1feffcc', '9848949998', '2016-10-06', '0', 'registration'),
(112, 'Sudhir Reddy', 'sudhirreddykura@yahoo.co.in', '5542aac3b18d9d2d5ed35aecbb1178531fdacd7ac5f00df49f9986bd231fa15c56c096f18df7cef009984c6280818508949fd55649994fc3444bda8e1d115346', '9553555556', '2016-10-06', '0', 'Guest'),
(113, 'srikkanth', 'y222@yahoo.com', 'cc7f4f5572a1b9463c2fe2c23b5c22428f3331e5bccb0263681075806ebb5ead4e3315cc32dadee3d84248d2ffb40451cebb6af818f626fe038afbab22f6900c', '7286838441', '2016-10-06', '0', 'Guest');

-- --------------------------------------------------------

--
-- Table structure for table `tblemail_template`
--

CREATE TABLE IF NOT EXISTS `tblemail_template` (
  `etempid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `etemptype` varchar(45) DEFAULT NULL,
  `etempname` varchar(45) DEFAULT NULL,
  `subject` varchar(45) DEFAULT NULL,
  `body_text` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`etempid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbleventphotos`
--

CREATE TABLE IF NOT EXISTS `tbleventphotos` (
  `photoid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `eventid` int(10) unsigned DEFAULT NULL,
  `photoname` longtext,
  `path` longtext,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`photoid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblevents`
--

CREATE TABLE IF NOT EXISTS `tblevents` (
  `eventid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vendorid` int(10) unsigned DEFAULT NULL,
  `todate` date DEFAULT NULL,
  `fromdate` date NOT NULL,
  `location` longtext,
  `totime` varchar(45) DEFAULT NULL,
  `fromtime` varchar(45) DEFAULT NULL,
  `eventname` varchar(150) DEFAULT NULL,
  `description` longtext,
  `eventtype` varchar(45) DEFAULT NULL COMMENT 'free/paid',
  `cost` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  `bannerimage` longtext NOT NULL,
  `bannerimagepath` longtext NOT NULL,
  PRIMARY KEY (`eventid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbllocations`
--

CREATE TABLE IF NOT EXISTS `tbllocations` (
  `locationid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `locationname` varchar(45) DEFAULT NULL,
  `stateid` int(10) unsigned DEFAULT NULL,
  `cityid` int(10) unsigned DEFAULT NULL,
  `countryid` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`locationid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblpackages`
--

CREATE TABLE IF NOT EXISTS `tblpackages` (
  `packageid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resortid` int(10) unsigned DEFAULT '0',
  `packagename` longtext,
  `description` longtext,
  `status` varchar(45) DEFAULT NULL,
  `createdby` varchar(45) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedby` varchar(45) DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `servicetax` double DEFAULT '0',
  `vendorid` int(11) DEFAULT NULL,
  `packageimage` longtext,
  `packagetags` longtext,
  `packagetype` varchar(45) DEFAULT NULL,
  `eventid` varchar(45) DEFAULT NULL,
  `adultprice` decimal(10,0) DEFAULT NULL,
  `childprice` decimal(10,0) DEFAULT NULL,
  `kidsmealprice` decimal(10,0) NOT NULL DEFAULT '0',
  `expirydate` date NOT NULL,
  `mobileadultqty` int(5) NOT NULL DEFAULT '0',
  `mobilechildqty` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`packageid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tblpackages`
--

INSERT INTO `tblpackages` (`packageid`, `resortid`, `packagename`, `description`, `status`, `createdby`, `createdon`, `updatedby`, `updatedon`, `servicetax`, `vendorid`, `packageimage`, `packagetags`, `packagetype`, `eventid`, `adultprice`, `childprice`, `kidsmealprice`, `expirydate`, `mobileadultqty`, `mobilechildqty`) VALUES
(1, 1, 'Entry Ticket', '<p>Entry ticket for Nehru Zoo Park. Each Ticket valid for Person Only</p>', '1', 'admin', '2016-09-22 05:22:36', 'admin', '2016-09-22 05:22:36', 10, 24, 'zoo-entry-gate3.jpg', '               ', 'daily', '', '30', '5', '0', '2016-08-30', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblpayments`
--

CREATE TABLE IF NOT EXISTS `tblpayments` (
  `paymentid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bookingid` varchar(45) DEFAULT NULL,
  `customerid` varchar(45) DEFAULT NULL,
  `packageid` int(10) DEFAULT NULL,
  `totalcost` decimal(10,2) DEFAULT NULL,
  `adultpriceperticket` decimal(10,2) DEFAULT NULL,
  `childpriceperticket` decimal(10,2) DEFAULT NULL,
  `kidsmealprice` decimal(10,2) DEFAULT '0.00',
  `numberofadults` varchar(5) DEFAULT NULL,
  `numberofchildren` varchar(5) DEFAULT NULL,
  `noofkidsmeal` int(5) DEFAULT '0',
  `servicetax` varchar(5) DEFAULT NULL,
  `internetcharges` decimal(10,2) DEFAULT NULL,
  `swachhbharath` decimal(10,2) DEFAULT NULL,
  `krishkalyancess` decimal(10,2) DEFAULT NULL,
  `ticketnumber` varchar(55) DEFAULT NULL,
  `transaction_id` varchar(150) DEFAULT NULL,
  `referenceno` varchar(45) DEFAULT NULL,
  `transdate` varchar(200) DEFAULT NULL,
  `amount` decimal(10,2) unsigned DEFAULT NULL,
  `response` varchar(45) DEFAULT NULL,
  `banktransaction` varchar(45) DEFAULT '0',
  `transactiondescription` varchar(75) DEFAULT '0',
  `authorizationcode` varchar(75) DEFAULT '0',
  `discriminator` varchar(75) DEFAULT '0',
  `cardnumber` varchar(45) DEFAULT '0',
  `billingphone` varchar(45) DEFAULT '0',
  `billingemail` varchar(45) DEFAULT '0',
  `udf9` varchar(45) DEFAULT '0',
  `mmp_txn` varchar(75) DEFAULT '0',
  `mer_txn` varchar(75) DEFAULT '0',
  `transactiontime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(25) DEFAULT '0',
  `responsestatus` varchar(15) DEFAULT '0',
  PRIMARY KEY (`paymentid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `tblpayments`
--

INSERT INTO `tblpayments` (`paymentid`, `bookingid`, `customerid`, `packageid`, `totalcost`, `adultpriceperticket`, `childpriceperticket`, `kidsmealprice`, `numberofadults`, `numberofchildren`, `noofkidsmeal`, `servicetax`, `internetcharges`, `swachhbharath`, `krishkalyancess`, `ticketnumber`, `transaction_id`, `referenceno`, `transdate`, `amount`, `response`, `banktransaction`, `transactiondescription`, `authorizationcode`, `discriminator`, `cardnumber`, `billingphone`, `billingemail`, `udf9`, `mmp_txn`, `mer_txn`, `transactiontime`, `status`, `responsestatus`) VALUES
(1, '1', '97', 1, '5.57', '0.00', '5.00', '0.00', '0', '1', 0, '0.07', '0.50', '0.00', '0.00', '147566695913', NULL, NULL, 'Wed Oct 05 17:00:21 IST 2016', '5.57', NULL, 'IGAAAPLJM5', NULL, NULL, 'NB', 'null', '9885754456', 'narendra.sharma202007@gmail.com', '20161005045835000000', '21235961', '939405', '2016-10-05 11:29:19', 'paid', 'Ok'),
(2, '2', '16', 1, '5.57', '0.00', '5.00', '0.00', '0', '1', 0, '0.07', '0.50', '0.00', '0.00', '147566852659', NULL, NULL, 'Wed Oct 05 17:24:46 IST 2016', '5.57', NULL, '189047181', NULL, NULL, 'NB', 'null', '7893514850', 'sainikhil013@gmail.com', '20161005052526000000', '18904718', '964525', '2016-10-05 11:55:26', 'paid', 'Ok'),
(3, '3', '98', 1, '5.57', '0.00', '5.00', '0.00', '0', '1', 0, '0.07', '0.50', '0.00', '0.00', '147567185757', NULL, NULL, 'Wed Oct 05 18:22:14 IST 2016', '5.57', NULL, 'IGAAAPURL6', NULL, NULL, 'NB', 'null', '9849845571', 'sukumar.madishetti@gmail.com', '20161005062000000000', '21238404', '460679', '2016-10-05 12:50:57', 'paid', 'Ok'),
(4, '4', '99', 1, '5.57', '0.00', '5.00', '0.00', '0', '1', 0, '0.07', '0.50', '0.00', '0.00', '147567366414', NULL, NULL, 'Wed Oct 05 18:52:09 IST 2016', '5.57', NULL, 'IGAAAPXTR8', NULL, NULL, 'NB', 'null', '9885754456', 'narendra.sharma202007@gmail.com', '20161005065032000000', '21239249', '762773', '2016-10-05 13:21:04', 'paid', 'Ok'),
(5, NULL, '100', NULL, '5.57', '0.00', '5.00', '0.00', '0', '1', 0, '0.57', '0.57', '0.00', '0.00', '147567375961', NULL, NULL, 'Wed Oct 05 18:55:16 IST 2016', '5.57', NULL, 'IGAAAPYDU3', '0', '', 'NB', 'null', '9849845571', 'sukumar.madishetti@gmail.com', '0', '21239301', '852116', '2016-10-05 13:22:39', 'paid', 'Ok'),
(6, '6', '16', 1, '78.06', '60.00', '10.00', '0.00', '2', '2', 0, '0.98', '7.00', '0.04', '0.04', '147573036729', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-10-06 05:06:07', 'unpaid', '0'),
(7, '7', '16', 1, '78.06', '60.00', '10.00', '0.00', '2', '2', 0, '0.98', '7.00', '0.04', '0.04', '147573057799', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-10-06 05:09:37', 'unpaid', '0'),
(8, '8', '16', 1, '66.90', '60.00', '0.00', '0.00', '2', '0', 0, '0.84', '6.00', '0.03', '0.03', '147573065415', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-10-06 05:10:54', 'unpaid', '0'),
(9, '9', '16', 1, '78.06', '60.00', '10.00', '0.00', '2', '2', 0, '0.98', '7.00', '0.04', '0.04', '147573198696', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-10-06 05:33:06', 'unpaid', '0'),
(10, '10', '101', 1, '5.57', '0.00', '5.00', '0.00', '0', '1', 0, '0.07', '0.50', '0.00', '0.00', '147573489079', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-10-06 06:21:30', 'unpaid', '0'),
(11, '11', '102', 1, '5.57', '0.00', '5.00', '0.00', '0', '1', 0, '0.07', '0.50', '0.00', '0.00', '147573490977', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-10-06 06:21:49', 'unpaid', '0'),
(12, '12', '103', 1, '5.57', '0.00', '5.00', '0.00', '0', '1', 0, '0.07', '0.50', '0.00', '0.00', '147573514969', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-10-06 06:25:49', 'unpaid', '0'),
(13, '13', '104', 1, '5.57', '0.00', '5.00', '0.00', '0', '1', 0, '0.07', '0.50', '0.00', '0.00', '147573534704', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-10-06 06:29:07', 'unpaid', '0'),
(14, '14', '105', 1, '5.57', '0.00', '5.00', '0.00', '0', '1', 0, '0.07', '0.50', '0.00', '0.00', '147573540892', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-10-06 06:30:08', 'unpaid', '0'),
(15, '15', '106', 1, '33.46', '30.00', '0.00', '0.00', '1', '0', 0, '0.42', '3.00', '0.02', '0.02', '147573586288', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-10-06 06:37:42', 'unpaid', '0'),
(16, '16', '107', 1, '33.46', '30.00', '0.00', '0.00', '1', '0', 0, '0.42', '3.00', '0.02', '0.02', '14757360876', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-10-06 06:41:27', 'unpaid', '0'),
(17, '17', '108', 1, '5.57', '0.00', '5.00', '0.00', '0', '1', 0, '0.07', '0.50', '0.00', '0.00', '147573614765', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-10-06 06:42:27', 'unpaid', '0'),
(18, '18', '16', 1, '5.57', '0.00', '5.00', '0.00', '0', '1', 0, '0.07', '0.50', '0.00', '0.00', '147573626864', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-10-06 06:44:28', 'unpaid', '0'),
(19, '19', '16', 1, '5.57', '0.00', '5.00', '0.00', '0', '1', 0, '0.07', '0.50', '0.00', '0.00', '147573677179', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-10-06 06:52:51', 'unpaid', '0'),
(20, '20', '109', 1, '33.46', '30.00', '0.00', '0.00', '1', '0', 0, '0.42', '3.00', '0.02', '0.02', '147573684543', NULL, NULL, 'Thu Oct 06 12:26:56 IST 2016', '33.46', NULL, 'NA', 'Cancel by User', NULL, NULL, NULL, NULL, NULL, '20161006122347000000', '0', '290040', '2016-10-06 06:54:05', 'failed', 'C'),
(21, '21', '110', 1, '5.57', '0.00', '5.00', '0.00', '0', '1', 0, '0.07', '0.50', '0.00', '0.00', '147573708004', NULL, NULL, 'Thu Oct 06 12:28:55 IST 2016', '5.57', NULL, 'IGAAASUUS6', NULL, NULL, 'NB', 'null', '9553555556', 'sudhirreddykura@yahoo.co.in', '20161006122740000000', '21262027', '839527', '2016-10-06 06:58:00', 'paid', 'Ok'),
(22, '22', '112', 1, '72.47', '60.00', '5.00', '0.00', '2', '1', 0, '0.91', '6.50', '0.03', '0.03', '14757397021', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-10-06 07:41:42', 'unpaid', '0'),
(23, '23', '113', 1, '66.90', '60.00', '0.00', '0.00', '2', '0', 0, '0.84', '6.00', '0.03', '0.03', '147574213327', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-10-06 08:22:13', 'unpaid', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tblplaces`
--

CREATE TABLE IF NOT EXISTS `tblplaces` (
  `plid` int(10) NOT NULL AUTO_INCREMENT,
  `place` varchar(150) DEFAULT NULL,
  `type` varchar(150) NOT NULL,
  `address` longtext,
  `city` varchar(45) DEFAULT NULL,
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  `description` longtext,
  `otherinfo` longtext,
  `createdon` datetime DEFAULT NULL,
  `createdby` varchar(45) DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `updatedby` varchar(45) DEFAULT NULL,
  `status` int(3) NOT NULL,
  PRIMARY KEY (`plid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `tblplaces`
--

INSERT INTO `tblplaces` (`plid`, `place`, `type`, `address`, `city`, `latitude`, `longitude`, `description`, `otherinfo`, `createdon`, `createdby`, `updatedon`, `updatedby`, `status`) VALUES
(1, 'Golconda Fort', 'Things To Do', '<p>Ibrahim Bagh, Hyderabad, Telangana 500008</p>', 'hyderabad', '17.3836 ', '78.4015', '<p>Golkonda, also known as Golconda or Golla konda ("shepherd''s hill"), is a citadel and fort in Southern India and was the capital of the medieval sultanate of the Qutb Shahi dynasty (c.1518–1687), is situated 11 kilometres (6.8 mi) west of Hyderabad.</p>', '<p>Golkonda Fort was first built by the Kakatiya dynasty as part of their western defenses along the lines of the Kondapalli Fort. The city and the fortress were built on a granite hill that is 120 meters (480 ft) high, surrounded by massive battlements. The fort was rebuilt and strengthened by Rani Rudrama Devi and her successor Prataparudra. Later, the fort came under the control of the Musunuri Nayaks, who defeated the Tughlaqi army occupying Warangal. It was ceded by the Musunuri Kapaya Nayak to the Bahmani Sultanate as part of a treaty in 1364.</p>', '2016-06-12 03:45:18', 'admin', '2016-09-29 07:23:46', 'admin', 1),
(2, 'Lumbini Park', 'Things To Do', '<p>Opposite Secretariat New Gate, Khairatabad, Hyderabad, Telangana 500004</p>', 'Hyderabad', '17.410057', '78.473219', '<p>Lumbini Park is a small public, urban park of 7.5 acres (0.030 km2; 0.0117 sq mi) adjacent to Hussain Sagar in Hyderabad, India.</p>', '<p>Emotion Media Factory installed India''s first spectacular water multimedia show in Lumbini Park. The multimedia fountain show plays daily to a large audience, the installation combines a full spectrum of media elements, from dazzling laser animation, live video, stunning sound quality, rhythmic musical fountains and extraordinary beam effects, all astonishingly portrayed on one of the largest water screens in India. The elements coalesce to re-create stories and historical and cultural aspects of Hyderabad’s past, present and future, enthralling thousands of guests each night.</p>', '2016-06-12 06:07:49', 'admin', '2016-09-29 07:37:34', 'admin', 1),
(3, 'Prasads Imax', 'Things To Do', '<p>NTR Gardens, LIC Division P.O., Hyderabad, Telangana 500063</p>', 'Hyderabad', '17.412864', '78.465915', '<p>Prasad''s is a centrally air conditioned multiplex of an area of 2,35,000 sq ft, housing an IMAX Movie Theatre, a five screen multiplex, food court, multinational fast food outlets, a gaming zone and a Shopping mall covering two levels of the complex.</p>', '<p>It is the single most popular IMAX theatre in India. Its 72-foot high, 95-foot wide screen is accompanied by 635 seats and a 12,000-watt sound system. The Prasads IMAX theatre made its name by being the most attended screen in the world for major blockbusters such as the Harry Potter film franchise and Spider-Man films.They also got a record attendance for Christopher Nolan''s Interstellar (2014) as Prasads IMAX was the only screen in India to have presented the movie in 70mm IMAX format. However, Prasads is no longer screening IMAX films due to the unavailability of digital projector for the very large screen.</p>', '2016-06-12 06:12:05', 'admin', '2016-09-29 07:40:02', 'admin', 1),
(4, 'Peddamma Temple', 'Things To Do', '<p>Hitech City Road, Jubilee Hills, Hyderabad, Telangana 500033</p>', 'hyderabad', '17.4921 ', '78.4073', '<p>Peddamma temple is an Hindu temple located at Jubilee Hills in Hyderabad. It is very famous during the festive season of Bonaalu.</p>', '<p>The word "Peddamma", which consists of two separate words Pedda and Amma, literally mean ''Mother of Mothers'' or "The Supreme Mother". She is one of the 11 forms of Village Deities and is known as The Supreme most.</p>', '2016-06-12 06:15:00', 'admin', '2016-09-29 07:42:01', 'admin', 1),
(5, 'Charminar', 'Things To Do', '<p>Hyderabad, Telangana 500002</p>', 'Hyderabad', '17.362854', '78.474622', '<p>The Charminar, constructed in 1591 CE, is a monument and mosque located in Hyderabad, Telangana, India. The landmark has become a global icon of Hyderabad, listed among the most recognized structures of India.</p>', '<p>"One of the most beautiful historical place."</p>', '2016-06-15 12:57:40', 'admin', '2016-09-29 07:56:43', 'admin', 1),
(6, 'Hussain Sagar', 'Things To Do', '<p>Hussain Sagar, Hyderabad, Telangana</p>', 'Hyderabad', '17.425906', '78.473744', '<p>Hussain Sagar is a lake in Hyderabad built by Hazrat Hussain Shah Wali in 1562, during the rule of Ibrahim Quli Qutub Shah. It is spread across an area of 5.7 square kilometers and is fed by River Musi.</p>', '<p>Lake Hussainsagar, a heritage site of India was declared as the ''Heart of the World'' by UNWTO on 27th September of 2012, on the occasion of World Tourism Day, for being the World''s Largest Heart Shaped Mark, the World''s Heritage Heart shaped Mark, and the World''s Wonderful Heart Shaped Mark on the face of the earth among the heart shaped marks formed by the heart shaped lakes and islands that exist in the world. Logo for the ''Heart of the World'' was inaugurated by H.E. Mr. Taleb Rifai, Secretary-General, United Nations World Tourism Organisation (UNWTO), Madrid-Spain, in the year 2013.</p>', '2016-06-15 01:02:17', 'admin', '2016-09-29 07:25:55', 'admin', 1),
(7, 'Birla Mandir', 'Things To Do', '<p>Hill Fort Rd, Hyderabad, Telangana 500004</p>', 'Hyderabad', '17.407363', '78.469146', '<p>Birla Mandir is a Hindu temple, built on a 280 feet high hillock called Naubath Pahad on a 13 acres plot. The construction took 10 years and was constructed in 1976 by Swami Ranganathananda of Ramakrishna Mission.</p>', '<p>Imposing, hilltop Hindu temple built of white marble, with towers, shrines and interior carvings.</p>', '2016-06-15 04:09:01', 'admin', '2016-09-26 04:38:40', 'admin', 1),
(8, 'Taj Falaknuma Palace', 'Things To Do', '<p>Engine Bowli, Falaknuma, Hyderabad, Telangana 500053</p>', 'Hyderabad', '17.331311', '78.466183', '<p>Set in a restored 19th-century palace overlooking the city, this luxe hotel is 2 km from Falaknuma train station and 4 km from the landmark 16th-century Charminar mosque.</p>', '<p>An English architect designed this palace. The foundation stone for the construction was laid by Sir Vicar on 3 March 1884. He was the maternal grandson of H.H. Sikandar Jah Bahadur, Nizam lll of Hyderabad. It took nine years to complete the construction and furnish the palace. Sir Vicar moved into the Gol Bangla and Zanana Mahel of the Falaknuma Palace in December 1890 and closely monitored the finishing work at the Mardana portion. It is made completely with Italian marble and covers an area of 93,971 square meters.</p>', '2016-06-15 04:12:27', 'admin', '2016-09-29 07:48:55', 'admin', 1),
(9, 'NTR Gardens', 'Things To Do', '<p>NTR Marg, Central Secretariat, Khairatabad, Hyderabad, Telangana 500004</p>', 'Hyderabad', '17.412586', '78.468763', '<p>NTR Gardens is a small public, urban park of 36 acres adjacent to Hussain Sagar lake in Hyderabad,</p>', '<p>Urban park covering 34 acres, with family attractions, a restaurant, fountains & a Japanese garden.</p>', '2016-06-15 04:18:09', 'admin', '2016-09-29 07:57:43', 'admin', 1),
(10, 'Ramoji Film City', 'Things To Do', '<p>Anaspur Village, Hayathnagar Mandal, Hyderabad, Telangana 501512</p>', 'Hyderabad', '17.255264', '78.680853', '<p>The Ramoji Film City in India is located in Hyderabad. At 2000 acres, it is the largest integrated film city in the world.</p>', '<p>The world''s largest film studio offering tours, live shows, on-site theme park and adventure zone.</p>', '2016-06-15 04:21:04', 'admin', '2016-09-29 07:35:25', 'admin', 1),
(11, 'Salar Jung Museum', 'Things To Do', '<p>Salar Jung Road, Darulshifa, Hyderabad, Telangana 500002</p>', 'Hyderabad', '17.372418', '78.480291', '<p>The Salar Jung Museum is an art museum located at Darushifa, on the southern bank of the Musi river in the city of Hyderabad, Telangana, India. It is one of the three National Museums of India.</p>', '<p>Former art collection of the Salar Jung family from around the world, now a museum.</p>', '2016-06-15 04:23:16', 'admin', '2016-09-29 07:34:54', 'admin', 1),
(21, 'Chilukur Balaji Temple ', 'Things To Do', '<p>Chilkur Balaji Temple, Moinabad Mandal, Ranga Reddy District, Chilkur, Telangana 501504</p>', 'HYDERABAD', '17.343320', '78.306024', '<p>Chilkur Balaji Temple, popularly known as "Visa Balaji Temple'''', is an ancient Hindu temple of Lord Balaji on the banks of Osman Sagar in Hyderabad.</p>', '<p>The Balaji Temple is located at Chilkur in the Hyderabad district. It is 33 Kms away from Mehedipatnam. Approximately 75,000 to 1,00,000 devotees visit in a week. Generally temple gets heavy rush on Fridays and Sundays. The temple at Chilkur is managed by the hereditary trustee Sri M.V. Soundara Rajan and Sri C.S. Gopala Krishna. The entire family of the archaka, including the women are dedicated themselves to serve the God.</p>', '2016-08-20 02:32:48', 'admin', '2016-09-29 07:33:38', 'admin', 1),
(25, 'Jala Vihar', 'Kids Day Out', '<p>Necklace Road</p>', 'Hyderabad, Telangana India', '17.43266', '78.464785', '<p>Make some fun memories at Jalavihar, an amusement park filled with rides suitable for adults and children. It is located on Necklace Road and is right next to the Hussain Sagar Lake that gives an incredible view. It also features a party zone, meeting areas that are ideal for parties, festival events and corporate events. They also have a food court to satisfy those hunger pangs whilst the fun. The staff follows strict hygienic conditions to make sure that does not stop you from having fun.</p>', '<p>Entry Pass Rs.200 per ticket</p>', '2016-08-28 12:51:08', 'admin', '2016-09-29 07:58:04', 'admin', 1),
(27, 'KHILLA GHANPUR / GHANPUR FORT', 'Adventure', '<p>Khilla Ghanpur village, Mahabubnagar, Telangana</p>', 'Mahabubnagar', '16.567286', '78.055924', '<p>At a distance of 2 km from Khilla Ghanpur Bus Stand, 25 km from Mahabubnagar and 109 km from Hyderabad, Khilla Ghanpur Fort is located near Khilla Ghanpur village in Mahabubnagar district of Telangana. This is an ideal weekend getaway from Hyderabad to spend full day. The Ghanpur Fort is a hill fort built on a rocky hill by King Gona Ganapa Reddy in early 13th century. He ruled this area as a feudatory to Kakatiya rulers. Gona Ganapa Reddy is son of Gona Budda Reddy who was famous as the poet of Ranganatha Ramayana, a pioneering Telugu Literature. The name of Ghanapuram Killa came into existence from the name of Kakatiya Ruler Sri Ganapathi Deva. The fort is spread on rocky and hilly area of 4 Sq kilometers and there are fort buildings spread across the top most part of the hill. The fort was well built with cannons on the upper side of the fort. There are several remains of the walls and building blocks inside the fort. There are several temples inside the fort like Veerabhadra Temple, Narsimh Temple and Chowdeswari Temple. There are several caves on the hilltop and provide good opportunity for exploration. There are two ponds inside the fort with fresh water and they are good for swimming. There are several hills around the fort and they provide good opportunity for trekking as well. Ghanpur Lake is a large lake situated close to the Ghanpur village and the view of the lake from the fort is picturesque. The fort & monuments demand about 2-3 kms trek from Ghanpur village. It usually takes about 2 hours to trek, explore the fort & caves and come back to Ghanpur village.</p>', '<p>Distance (From Mahabubnagar): 25 Kms</p>', '2016-08-29 16:42:16', 'admin', '2016-09-29 07:58:46', 'admin', 1),
(28, 'KOILKONDA FORT ', 'Adventure', '<p>Koilkonda, Mahabubnagar, Telangana</p>', 'Mahabubnagar', '16.7442948', '77.9846673', '<p>At a distance of 1.3 km from Koilkonda Bus Stand, 25 km from Mahabubnagar Bus Station and 128 km from Hyderabad, Koilkonda Fort is situated at Koilkonda in Mahabubnagar district of Telangana. This is an ideal weekend getaway from Hyderabad to spend full day. Koilkonda Fort is the erstwhile outpost of the Qutab Shahi dynasty situated on a hilltop. To reach the top, one needs to hike across a deep gorge on the west or a series of streams if coming through east before reaching a plight of steps that leads to the fort. To enter the Koilkonda Fort, seven gates have to be crossed. The first one spots an inscription of Ibrahim Qutab Shah that belongs to 1550 AD. Fourth gate leads to a dilapidated palace. There is also a mosque, an Idgah and a pond here. The Fort also has a ashurkhana dedicated to Bibi Fatima and is revered by both Hindus and Muslims. The Kolisagar Dam is a medium-sized irrigation project that was constructed in the period of the Nizams during 1945-48. The Koilsagar Dam, which is about 10 km from the Koilkonda, stretches across the Peddavagu River, a minor tributary of the River Krishna. The western stretch of this picturesque reservoir is surrounded by high hills, making it a beautiful spot and is a treat for eyes during sunrise and sunset. Sri Ramkonda Hill is another prominent Hill with a temple dedicated to Lord Rama, which is 3 km from Koilkonda Fort. There is no motorable road to Sri Ramkonda Hill, one has to trek 3 km from the Fort. This hill is also famous for lot of herbal medicinal plants. There is an another hill named Verrabhadra Swamy Hill nearby, to reach this hill one has to trek 2 km from Koilkonda Fort.</p>', '<p>Distance (From Mahabubnagar): 25 Kms</p>', '2016-08-29 16:44:58', 'admin', '2016-09-29 07:59:10', 'admin', 1),
(29, 'KOULAS FORT', 'Adventure', '<p>Koulas village, Nizamabad, Telangana.</p>', 'Nizamabad', '18.323929', '77.697481', '<p>At a distance of 3 km from Koulas, 81 km from Nizamabad, 84 km from Medak and 169 km from Hyderabad, Koulas Fort is situated near Koulas village in Nizamabad district. Koulas Fort is a massive fort dating back to the 14th century, spread across 6 sq km and located in Jukkal mandal close to Bidar - Nanded road. This fort was built by Kakatiya rulers. This fort was conquered by Muslim rulers Bahamanis, Qutb Shahis and later occupied by the Nizams. The Koulas Fort was constructed in the semi-Dravidian style at an altitude of about 1100 ft. There is a stream that stands as a natural moat to the fort. The fort is spread across 400 acres surrounded by large fortification wall with strong bastions. The fort houses several wonderfully built gateways, buildings, temples, mosques and other structures. There are about 20 large cannons spread across the fort. It has 52 small and big bastions along several water tanks. The fort temple and dargah were declared as protected monuments by the Archaeology Department. The Kasikund temple was constructed on the patterns of the Kasi temple. There are three other temples dedicated to Rama, Hanuman and Balaji. Behind the fort is the Ashtabuji Mata also known as Jagadamba Mata temple. The fort is currently not well maintained and the approach route is full of thorns. Also, the fort becomes inaccessible during monsoons when the water levels in stream reach the peak. Visitors need to trek about 3 km to reach the Koulas Fort. It is advisable to take a villager as a guide from the Koulas village to visit the fort. The Koulas dam is about 20 km away from the fort and attracts a large number of birds in winter. Timings: 9 AM to 6 PM.</p>', '<p>Distance (From Nizamabad): 81 Kms</p>', '2016-08-29 16:46:51', 'admin', '2016-09-29 07:59:24', 'admin', 1),
(30, 'GAYATHRI WATERFALLS', 'Adventure', '<p>Tarnam Khurd Village, Kuntala Waterfalls, Nirmal, Adilabad, Telangana.</p>', 'Adilabad', '19.329862', '78.469344', '<p>At a distance of 5 km from Tarnam Khurd Village, 19 km from Kuntala Waterfalls, 38 km from Nirmal, 59 km Adilabad and 270 km from Hyderabad, Gayathri Waterfalls is a beautiful place located in Adilabad district of Telangana. Gayatri waterfalls is a very less known place situated on Kadem River, a tributary of Godavari River. Along with Kuntala and Pochera Falls, Gayatri falls is another fascinating waterfalls in Adilabad district. This is a a magnificent waterfall and attracts large number of tourists in monsoon season. Gayatri waterfall is also called as Gadidha Gundam or Mukti Gundam by the villagers. It is located at a very secluded place inside deep forest near Tarnam Khurd Village. This stunning waterfall is cascading down from a height of 100 ft into the valley to create a magnificent sight. There is a pool at the bottom of the falls and visitors can reach pool and swim. The rocks are very slippery should be careful while swimming in the pool. Neredigonda is 253 Km from Hyderabad on the way to Adilabad on NH 7. Kupti village comes after 6 km (on the same highway) where you will find sign board for Tarnam village on the right side. Turn right from here and drive for 2 Km on mud road to reach Tarnam Khurd village. One can go by vehicle only till Tarnam. From here 5 km trek is required to reach the falls. It is advisable to take a local from Tarnam Khurd village as a guide to reach this place. There is an alternate road from Ichoda (between Neredigonda - Adilabad) via Manikpur and Tarnam Buzurg. Gayathri falls is only 2 km walk from Tarnam Buzurg. But the road between Manikpur and Tarnam Buzurg is pretty bad and becomes inaccessible during peak rains. Trek to the waterfalls is of a moderate level and may not be suitable with kids. You may not find much water in season other than monsoon. One should carry water and food while trekking to the falls as there are no shops around. From Tarnam Khurd, it takes about 3-4 hours to reach the falls, explore & play and come back to Tarnam. Best time to visit this place is peak monsoon (Sep-Oct).</p>', '<p>Distance (From Adilabad): 59 Kms</p>', '2016-08-29 16:49:35', 'admin', '2016-09-29 07:59:58', 'admin', 1),
(31, 'KANAKAI WATERFALLS', 'Adventure', '<p>Girnur Village, Kuntala waterfalls, Nirmal, Adilabad, Telangana.</p>', 'Adilabad', '19.437941', '78.373485', '<p>At a distance of 2 km from Girnur Village, 35 km from Kuntala waterfalls, 54 km from Nirmal, 51 km Adilabad and 282 km from Hyderabad, Kanakai waterfalls is a nice waterfall on Kadem river located in Adilabad District of Telangana. This is also a good trekking destination. Bandrev waterfall and Cheekati Gundam are located in a single stretch along with Kanakai waterfalls and all three can be visited together. The Kanakai waterfall, also called as Kanakadurga waterfalls is located near a small village called Girnur of Bazarhatnoor Mandal. There is also a Kanaka Durga temple located near the waterfall. Large number of devotees from nearby villages visit the temple during festivals. The waterfall is cascading down from a height of 30 ft. There is a big pool at the bottom of the fall. Swimming at the falls is a great experience for the visitors. When you climb up to the top of the falls, you can get the panoramic view of the falls and the surrounding area. There are actually three falls at Kanakai. First is a small one where water flows through rocky formations forming small but wide waterfall with an average height of 10 feet, second one is the main falls (Bandrev waterfall) about 1 km from the first one where water cascades down into a big pool from a height of about 30 feet with a width of about 100 feet.. This is the place where a stream is merged into the Kadem river. Third one is called Cheekati Gundam which is few hundred meters away from the second one. It is similar to the first one with dense forest and dark surroundings. The whole area is covered with thick vegetation and sharp rock formations. Ichoda is 273 Km from Hyderabad on the way to Adilabad on NH 7. From Ichoda, you have take left and drive towards Bazarhatnoor via Adegaon Khurd, Pipri and reach Girnur. After driving for 1 km from Girnur village, there is a sign board pointing towards a mud road on the left that leads to the temple and waterfalls. Vehicles can go further 1 km from here (not accessible in peak monsoons) and the first waterfall is further half km from there (15-20 minutes walk). It is advisable to hire a villager as guide from Girnur village. You may not find much water in season other than monsoon. Carry enough water (shops available at Girnur). The rocks near the waterfalls are slippery and have to be careful while descending. It takes about 3-4 hours to visit all three waterfalls, spend some time and come back to the road point. Best time to visit this waterfall is after monsoon (Aug-Oct).</p>', '<p>Distance (From Adilabad): 51 Kms</p>', '2016-08-29 16:51:50', 'admin', '2016-09-29 08:00:15', 'admin', 1),
(33, 'NAVRATRI MAHOTSAV 2016 BY DANCE MANIA', 'Kids Day Out', '<p>Sindhi Colony, Secunderabad Venue: Dance Mania</p>', 'Secunderabad', '17.444707', '78.466381', '<p>The best of both worlds – traditional and contemporary dandia styles will be taught in this workshop featuring Garba Star Tulsi Desai, who will take the classes. This is open to all age groups.</p>', '<p>9966250970, 8686694724, Address: Sindhi Colony, Secunderabad Venue: Dance Mania</p>', '2016-09-01 13:04:09', 'admin', '2016-09-29 08:01:27', 'admin', 1),
(34, 'MORNING YOGA SESSIONS AT OUR SACRED SPACE', 'Kids Day Out', '<p>9-1-84, Sardar Patel Road, Secunderabad Next to Orchids Florist 500026 Venue: Our Sacred Space</p>', 'Hyderabad', '17.444497', '78.518879', '<p>The Micro Yoga exercises benefit all the organs and all the parts from head to waist. Similarly the Macro exercises stimulate and benefit all the organs and the parts from abdomen down to toes. They are practiced in the standing position. Each Macro Yoga exercise, pertaining to different parts of the body has to be repeated 5 to 10 times with full awareness. All exercises that are done on one side, should also be done on the other side. 1. Exercises for the abdomen 2. Exercises for the waist 3. Exercises for the excretory organs - Stool excretory organ (Rectum & anus) - Urinary organ 4. Exercises for thighs, knees and shanks 5. Exercises for calves, ankles, heels, soles, feet and toes</p>', '<p>9030613344 <a href="http://www.facebook.com/events/162398340862100">www.facebook.com/events/162398340862100</a> 9-1-84, Sardar Patel Road, Secunderabad Next to Orchids Florist 500026 Venue: Our Sacred Space</p>', '2016-09-01 13:17:53', 'admin', '2016-09-29 08:02:20', 'admin', 1),
(35, 'GARBA-DANDIYA CAMP 2016 AT RANG MANCH STUDIO', 'places', '<p>3-6-198, 5th floor, Himayath Nagar Main Road 500029 Venue: Rang Manch Studio</p>', 'Hyderabad', '17.406821', '78.479178', '<p>So here starts the most awaited Garba-dandiya camp with lots of fun and grace. Learn from basic to advance steps and enjoy your moves this Navratri-Festival.</p>', '<p>9032055181, 7032255181 ajrangmanch@gmail.com <a href="http://www.facebook.com/events/246355679091633">www.facebook.com/events/246355679091633</a> 3-6-198, 5th floor, Himayath Nagar Main Road 500029 Venue: Rang Manch Studio</p>', '2016-09-01 13:31:11', 'admin', '2016-09-29 08:03:39', 'admin', 1),
(36, 'RANGOLI WORKSHOP AT BOOKS N MORE', 'Kids Day Out', '<p>292, Street No 2, West Marredpally 500026 Venue: Books n More Library & Activity Centre</p>', 'Hyderabad', '17.45002', '78.500635', '<p>Come let’s learn the art of Festive Rangoli for decking up our homes for the upcoming festive season. Join Ms Vandana in this four session rangoli workshop to learn traditional white rangoli, colourful rangolis, flower rangoli , 3-D Effect Rangoli and floating water Rangoli. Unleash your creativity in this colourful workshop for ages 8 -16 years.From September 2’nd to 23’rd September.Fridays only.5-6:30 P.M.</p>', '<p>9885956728 booksnmore.india@gmail.com <a href="http://www.facebook.com/events/1093634237340037">www.facebook.com/events/1093634237340037 </a>292, Street No 2, West Marredpally 500026 Venue: Books n More Library & Activity Centre</p>', '2016-09-01 13:42:18', 'admin', '2016-09-29 08:04:28', 'admin', 1),
(38, 'CLAY MOULDING WORKSHOP - ECO FRIENDLY GANESHA MAKING', 'Kids Day Out', '<p>C-1, Saraswati block, Triveni complex, Habsiguda cross roads</p>', 'Hyderabad', '17.409141', '78.535641', '<p>ECO FRIENDLY GANESHA MAKING COMPETITION. Offer salutations to Lord Ganesha in your own unique style. Make your own Ganesha this season.!! Under an expert guidance & take home your own hand made Eco friendly Ganesha. Fun, gifts & lot more for every participant. Register now for Eco friendly Ganesha making competition. Explore your creativity with clay and save nature from pollution. Registration fee: 100/-, We will provide all the materials. Please register before 2nd Septembe</p>', '<p>9248714445 <a href="http://www.facebook.com/events/284888995219405">www.facebook.com/events/284888995219405</a> C-1, Saraswati block, Triveni complex, Habsiguda cross roads</p>', '2016-09-01 14:31:13', 'admin', '2016-09-29 08:05:04', 'admin', 1),
(39, 'M3 TEEN LEADERSHIP CAMP', 'Kids Day Out', '<p>Gurucool Venue: GURUCOOL</p>', 'Hyderabad', '17.440092', '78.464076', '<p>When great leaders are remembered and their memories rejoiced as in here it is Teachers’ Day, such deeds imbibe in us the same qualities of Leadership. But to emerge as a great leader, certain ‘I’ngredients are essential to influence us. These ‘I’s of leadership are:- INSIGHT INITIATIVE INSPIRATION INVOLVEMENT IMPROVISATION INDIVIDUALITY IMPLEMENTATION. Leadership in its essence is a combo of emotional intelligence and appropriate communication skills. Other people make the Leader out of the Right Person, at the Right Place, at the Right Time. Children emulate parents, teachers and elders surrounding them. Teens in their impressionable age need mentors,gurus and adult friends as role models at the crossroads of their life. With changing times, caution is often wrongly understood as inhibited act and attitude turning the brave new world topsy-turvy with bravado. To resolve this Catch 22 situation, patriotic, gallant and wise footsoldiers of India from the military and civilian communities have bridged together the relationship of ‘the buddy with the gen-next’. Methodology of GURUCOOL The methodology of GURUCOOL is interactive and hands-on with Situational Exercises, Group Activity and Case Studies, with Role Plays and Experience Sharing by both the mentors and the campers. The challenges will include simulation of environments, survival in the outdoors and strategic mind-body games on an adventure course. The camp will be residential and will bring back everyone to the basics in a neutral setting. The 2 day Outdoor Experiential Learning is the first stepping stone to self-discovery that will connect the mind to the body and help resolve internal conflicts in a near-nature environment. It will show the way to the youth as recognisable figure in effect to actions that occur. Leadership is acknowledged only when it is seen. Leadership is also about achieving things with support of others. Leadership is best described as the attitude and behaviour they would like to emulate. It is all about a special relationship between the leading and those who are lead. Experiential Learning and Outward Bound Activity Team Building Trust Motivation Confidence Building Communication Concentration Leadership Time Management Goal Setting Conflict Resolution Benefits Beyond Doubt M3 rewards participants with a mind without fear Body and soul which discover competency growth with positive emotions The inner-voice that accelerates decisions and aligns plans for performance Coordination and co-relation to turn around conflicts into positive results. Who Must Get There – Be there – Conquer There !! Performers who aim to be Achievers! This camp is not a training program but an academy to hone skill sets. Thus, children who are sponsored are invested upon for rich dividends through Collaboration, Teamwork & Leadership. The Investment-Rs 6,000/- per head.The cost is inclusive of the experiential to GURUCOOL and back.</p>', '<p>9940355521 priam@prakcen.com Gurucool Venue: GURUCOOL</p>', '2016-09-01 14:36:22', 'admin', '2016-09-29 08:05:33', 'admin', 1),
(41, 'TREK TO BHIVGAD AND SONDAI FORT BY PLUS VALLEY ADVENTURE', 'Kids Day Out', '<p>3 Anand Complex, Alkapuri Society, Opp. Hotel Kinara, Above Bata Showroom, Vanaz Corner, Paud Road Venue: Bhivgad and Sondai Fort</p>', 'Hyderabad', '17.440092', '78.464076', '<p>Information About Fort:- Bhivgad Fort:- There isn’t much known about this small fort. A small top, couple of water cisterns, a remnant is all that this fort offers us at the top. However, easy walk and small height, nice view of ranges around makes this a nice, little trek. Sondai Fort:- Karjat is one of the favourite destinations for trekkers. This is a central location for trekkers to visit places like Rajmachi, Peth, Songir, Peb, Irshalgad, Bhivgad, Dhak and Bhimashankar. Sondai, a relatively less known popular fort is also within reach. This fort is a part of the Matheran range. Though it does not have any structural remnants, the scenic views it offers and the final 15ft of rock patch makes it a thrilling experience. This fort was supposedly built as a watch Tower. Things to Carry - 1. Luggage packed in sack, all luggage wrapped in plastic bags to avoid getting wet (compulsory) 2. Complete spare set of clothes. 3. Water bottle (3 Ltr) compulsory. 4. Personal medication. 5. Good trekking shoes (floaters/sandals/chappals not permitted). 6. Camera -Optional Itinerary - 1. Reporting time 05.30 am 2. Departure from Pune by 06.00 am. 3. In route Halt for breakfast by 08.00 am. 4. Leave towards Bhivgad Fort 8.30a.m. 5. Introduction at 9.45am. 6. Reach base village of Bhivgad & immediately start a trek towards Bhivgad. 10.00 a.m. 7. Return To Base Village 11.30 a.m. 8.Start Journey Towards Sondai11.45a.m 9.Rech Base village of Mangad 12.45 p.m. 10. Lunch at Sondai Base 1 pm to 1.30 p.m. 11. Start Trek To Sondai Fort 1.45 You will get best Photos for Photography. 03.30 p.m. 12. Start a return trek towards base Village.04.00 p.m. 13. Reach Base Village of Mangad Fort. Evening Tea. 05.15 p.m. 14. Start a return journey with sweet memories. 15. Return to Pune by 7.30pm Difficulty Level - Medium. Activity Fees - 1200 + Service tax( 4.5%) Applied by Govt what’s included in Fees 1. Transportation by Private Vehicle (Pune to Pune) 2. Tea, Breakfast, Veg. Lunch/pack lunch 3. Experts in adventure activity 4. Safety equipment’s 5. First Aid Kit what’s NOT included in Fees 1. Cold drinks, mineral water etc. 2. Anything that is not mentioned in included list consider it out of package</p>', '<p>7720080918, 8380054989 info@plusvalleyadventure.com <a href="http://www.facebook.com/events/1615417135416107">www.facebook.com/events/1615417135416107</a> 3 Anand Complex, Alkapuri Society, Opp. Hotel Kinara, Above Bata Showroom, Vanaz Corner, Paud Road Venue: Bhivgad and Sondai Fort</p>', '2016-09-01 15:01:49', 'admin', '2016-09-29 08:07:16', 'admin', 1),
(42, 'FUN WITH BRAIN TEASERS', 'Kids Day Out', '<p>405, Sree Nilayam, Plot 336, Lanco Hills Road, Manikonda Venue: KidEngage</p>', 'Hyderabad', '17.40238', '78.372854', '<p>Break the code to reveal a secret message. Make our own jigsaw puzzle and challenge others to solve it. Look for the hidden treasure lost inside the alphabets. Sounds exciting?? Get ready for a roller coster ride in your brain. Let us take you on a special mission to have fun with brain teasers this weekend at KidEngage Fun and Learn center.</p>', '<p>9949010651 <a href="http://www.facebook.com/events/288890014818018">www.facebook.com/events/288890014818018</a> 405, Sree Nilayam, Plot 336, Lanco Hills Road, Manikonda Venue: KidEngage</p>', '2016-09-01 15:06:46', 'admin', '2016-09-29 08:07:58', 'admin', 1),
(43, 'STORY TELLING SESSION AT HAPPY TIMES CLUB', 'Kids Day Out', '<p>Bapu Bagh Colony, Close to Paradise Hotel 500003 Venue: HPS Kids School</p>', 'Hyderabad', '17.443637', '78.46449', '<p>SATURDAY TIME-STORY TIME come in and know how lord GANESHA was born lets welcome our favorite God- GANESHA in a Eco-friendly & natural way. DIY- YOUR OWN CLAY GANESHA using basic pottery techniques. carry back with u a handout that teaches u ACTIONS in GANESHA style. Tips and ideas of Eco-friendly celebrations and a demo of how to do the visarjan of your clay Ganesha, reclaiming it for gardening.</p>', '<p>9949650991 Bapu Bagh Colony, Close to Paradise Hotel 500003 Venue: HPS Kids School</p>', '2016-09-01 15:10:49', 'admin', '2016-09-29 08:08:18', 'admin', 1),
(44, 'HORSEBACK RIDING AT SADDLE HORSE RIDING ACADEMY', 'Kids Day Out', '<p>Beside Viswanaadha Gardens, Jaya Prakash Narayan Nagar, Miyapur 500049 Venue: Saddle Horse Riding Academy</p>', 'Hyderabad', '17.512511', '78.352228', '<p>Riding a horse for the first time can be an exhilarating experience. You probably feel the butterflies of anticipation, possibly a fear of controlling something larger than yourself and definitely the sheer joy of the experience that draws you back for more. Come spend this weekend learning to sit on a horse, feel its movement and sway along as the horse walks and trots. It’s a great experience for both children (over 3 years) and adults who want to do something active in Hyderabad. If you’re looking for a unique gift to an animal lover, our Horse Riding experience is sure to impress.</p>', '<p>9515129872 saddlehorseriding@gmail.com <a href="http://www.facebook.com/events/152619675179645">www.facebook.com/events/152619675179645</a> Beside Viswanaadha Gardens, Jaya Prakash Narayan Nagar, Miyapur 500049 Venue: Saddle Horse Riding Academy</p>', '2016-09-01 15:22:44', 'admin', '2016-09-29 08:08:51', 'admin', 1),
(45, 'CREATIVE WRITING WORKSHOP AT PANACHE', 'Kids Day Out', '<p>2nd Floor, Road No.7, Banjara Hills Opp.Iranian Consulate 500034 Venue: Panache - The Finishing School</p>', 'Hyderabad', '17.413828', '78.439758', '<p>Personality Pops bring to you a gamut of workshops which treats every corner of the mind , body and soul with an essence of fullfillment and accomplishment Come and explore the first of the Pandora box. Creative Writing on the first weekend of 3rd & 4th September Age - Above 8 years and Teenagers Timings: 3rd Sept- 5pm to 7pm 4th Sept- 10:30am to 12:30pm</p>', '<p>9000022114 info@panachefinishingschool.com <a href="http://www.facebook.com/PanacheFS">www.facebook.com/PanacheFS</a> 2nd Floor, Road No.7, Banjara Hills Opp.Iranian Consulate 500034 Venue: Panache - The Finishing School</p>', '2016-09-01 15:29:04', 'admin', '2016-09-29 08:09:36', 'admin', 1),
(46, '1ST ALL BENGAL OPEN RAPID CHESS TOURNAMENT', 'Kids Day Out', '<p>Naba Barrackpur, Kolkata</p>', 'Hyderabad', '17.488655', '78.451529', '<p>1st All Bengal Open Rapid Chess Championship. Timings - 3rd September - 2:00 PM Onwards 4th September - 10:00 AM Onwards Entry Fee - Rs. 500/-</p>', '<p>9830403068, 8013248905 Naba Barrackpur, Kolkata</p>', '2016-09-01 15:33:14', 'admin', '2016-09-29 08:09:55', 'admin', 1),
(47, 'SKETCHING AND CREATIVE THINKING WORKSHOP AT GYMBOREE', 'Kids Day Out', '<p>1057, PBN Center, 2nd floor, Road # 45, Jubilee Hills Hyderabad Venue: Gymboree Play & Music</p>', 'Hyderabad', '17.432524', '78.407015', '<p>Sketching & Creative Thinking Workshop with Taher Ali Baig and Faraaz Farshori for 3 - 7 years. Classes on Saturday only. 4- 6 PM</p>', '<p>9000202900 hyderabad@gymboree.co.in <a href="http://www.facebook.com/events/313148895694447">www.facebook.com/events/313148895694447</a> 1057, PBN Center, 2nd floor, Road # 45, Jubilee Hills Hyderabad Venue: Gymboree Play & Music</p>', '2016-09-01 15:36:24', 'admin', '2016-09-29 08:11:36', 'admin', 1),
(54, 'Laad (Choodi) Bazaar', 'Things To Do', '<p>Near Charminar, Hyderabad, Telangana.</p>', 'Hydearbad', '17.3618615', '78.4734438', '<p>Laad Bazaar is a very old market popular for bangles located in Hyderabad. It is located on one of the four main roads that branch out from the historic Charminar. Laad meaning lacquer is used to make bangles, on which artificial diamonds are studded. In this 1-kilometre (0.62 mi)-long shopping strip, most of the shops sell bangles, saris, wedding related items, and cheap jewelry.</p>\r\n<p> </p>', '<p>Laad Bazaar is the main market for bangles, it is popular for bangles, semi-precious stones, pearls, jewellery, products such as silverware, Nirmal, Kalamkari paintings, bidriware, lacquer bangles studded with stones, saris and handwoven materials of silk, cotton. brocade, velvet and gold embroidered fabrics, traditional Khara Dupattas, lacquer bangles and perfumes.The narrow lane is filled with burkha-clad women, bangle shops and old buildings with wooden balconies, bargaining and haggling is part and parcel of this market. Shopkeepers employ beckoning tactics, placing an employee at the entrance of the store beckoning passers-by to enter their shop.</p>', '2016-09-26 11:10:58', 'admin', '2016-10-03 05:49:25', 'admin', 1),
(55, 'Nizam Club', 'Things To Do', '<p>Saifabad, Hyderabad</p>', 'Hydearbad', '17.4035083', '78.4682849', '<p>The club was established in the month of Aban 1293 Fasli, under the patronage of H.E.H. the Nizams Government, and owes its origin to a desire to provide a first class club, managed on western lines to which gentlemen of culture and position could be admitted irrespective of race, and creed on terms of social equality.The club registered under the A.P. Societies Act of 1951 and the club is the first society registered in A.P.The elected body consisting of President, Vice-President, Hon. Secretary, Joint Secretary, and 6 members of the Managing Committee maintains the club.The Membership of the club shall be open to all persons with out any distinction of religion, race, caste or sex, subject to the provision of the club rules.The club runs its all activities with no profit, no loss motto.</p>', '<p>The club maintaince its decipline and decoram as per the club rules to use the club facilities by family gatherings.The aims and objects of the club are to provide a central place for the residents of the city to meet during leisure hours to take part in indoor and outdoor games and to increase unity and feelings of cordiality among officials, non-officials, Jagirdars and nobles of the Dominions. The club is located in the heart of the twin cities opposite to A.P. State Assembly Hall.surrounded in 4 acres land.</p>\r\n<p><strong>*Entry for Memebers only</strong></p>', '2016-09-26 16:18:55', 'admin', '2016-10-03 05:53:26', 'admin', 1),
(57, 'Yacht Club', 'Things To Do', '<p>Sanjeevaiah Park, Necklace Rd, Hyderabad, Telangana</p>', 'Hyderabad', '17.429337', '78.4758216', '<p>The idea of the Yacht Club in Hyderabad came up in the mind of it’s Founder President Suheim Sheikh in the year 2009 with the intent of creating infrastructure for all to access, given that Sailing has been part of Hyderabad and Hussain Sagar for more than a century.Armed with just this idea the Yacht Club of Hyderabad was born on World Environment Day June 5th 2009.</p>', '<p>The Yacht Club of Hyderabad now boasts of being one of the fastest growing and performance oriented water sports facility in the country with world class training systems for both recreational as well as competitive sailing and continues to perform at the top levels of national sailing.</p>', '2016-09-26 17:49:45', 'admin', '2016-10-03 05:53:01', 'admin', 1),
(58, 'Fateh Maidan Club', 'Things To Do', '<p>Abids, Hyderabad  - 500004</p>', 'Hyderabad', '17.3993498', '78.4733743', '<p>During the eight month siege of Golconda in 1687 the Mughal soldiers were camped on a vast open ground. After their victory, this ground was named as Fateh Maidan (Victory Sqaure). During Asif Jahi period, Fateh Maidan was used as Polo Grounds. Gymkhana ground in Secunderabad which was the home of Hyderabad Cricket Association did not have stands to accommodate the large number of spectators that used to watch the cricket matches. The matches were therefore held at Fateh Maidan even though the grounds were not owned by Hyderabad Cricket Association but by Andhra Pradesh Sports Council. The first test match was hosted in November 1955 against New Zealand. </p>', '<p>The stadium was renamed as Lal Bahadur Shastri Stadium in 1967. Floodlights were introduced in 1993 during the Hero Cup match between the West Indies and Zimbabwe. The Stadium was the home ground for the Hyderabad cricket team.</p>', '2016-09-26 17:52:08', 'admin', '2016-10-03 05:51:32', 'admin', 1),
(59, 'Jubilee Hills Club', 'Things To Do', '<p>Near Post Office, Road No 14, Jubilee Hills, Hyderabad</p>', 'hyderabad', '17.42973', '78.415335', '<p>The Jubilee Hills International Centre is a Registered Club established under the Public Societies Act in the year 1987 and is established basically for cultural and recreational activities of its members. The Centre is a nonprofit organization. The Centre is managed by elected policy making body (Governing Council) who serve in honorary capacity and is run in accordance with the bye-laws, rules and regulations.</p>', '<p>The Centre has developed as a nerve Centre of cultural and entertainment activities. We have been organizing major tournaments in several games as part of our policy of promoting sports and games. National and state ranking annual tournaments in Tennis, Bridge, Badminton, Swimming, Billiards and Snooker are being conducted.</p>', '2016-09-26 18:02:18', 'admin', '2016-10-03 05:51:05', 'admin', 1),
(60, 'Film Nagar Club', 'Things To Do', '<p>Road No. 06, Film Nagar, Hyderabad, Telangana 500096</p>', 'Hyderabad', '17.4149588', '78.4099066', '<p>Film Nagar Cultural Center (FNCC) is situated at Hyderabad, Telangana, India. The area is Film Nagar, after Jubilee Hills where most of the elite of Hyderabad have their homes. A co-operative housing society was formed unique in the world for and by the Telugu Film Industry persons to have their homes for all categories like Producers, Technicians and Artists etc wherein, now there are facilities in the building of the society, along with society office, there are offices of A.P Film Chamber of Commerce, Movie Artists association, Telugu Film Producers Council, Preview Theater, Offices of Some Producers, and also guest rooms for Persons from film industry from outside of Twin cities. Adjacent is a Temple Complex popular as Film Nagar Diva Sannidhanam.</p>', '<p>The Centre has developed as a nerve Centre of cultural and entertainment activities. We have been organizing major tournaments in several games as part of our policy of promoting sports and games. National and state ranking annual tournaments in Tennis, Bridge, Badminton, Swimming, Billiards and Snooker are being conducted.</p>', '2016-09-26 18:17:07', 'admin', '2016-10-03 05:50:18', 'admin', 1),
(61, 'Chowmahalla Palace', 'Things To Do', '<p><span class="SpellE">Khilwat</span>, 20-4-236, <span class="SpellE">Motigalli, </span>Hyderabad</p>', 'Hyderabad', '17.3578233', '78.4716897', '<p [removed] and elegance. A synthesis of many architectural styles and influences, the Palace Complex has been meticulously restored.</p>', '', '2016-10-03 08:01:36', 'admin', NULL, NULL, 1),
(62, 'Birla Planetarium', 'Things To Do', '<p>Near Birla Temple, Ambedkar Colony, Hyderabad</p>', 'Hyderabad', '17.4031808', '78.4707097', '<p [removed] justify;"><strong>The B M Birla Science Centre</strong> has been instituted in memory of late Shri Braj Mohan Birla who was a captain of industry and a philanthropist. Even before India became independent from the British, Mr. Birla had the courage to start the automobile industry in the country. Today their family which is referred to as Rockfeller family of India has multinational business interests ranging from automobiles through cement, paper, textiles, software and so on.</p>', '', '2016-10-03 08:04:46', 'admin', NULL, NULL, 1),
(63, 'Shilparamam', 'Things To Do', '<p>Hi-Tech City, Hyderabad</p>', 'Hyderabad', '17.451', '78.3748113', '<p [removed] justify;">Shilparamam Arts and Crafts village is a tribute to the cultural legacy of India. The primary aim of this establishment is to foster, restore and help flourish the culture of India''s glorious past. It provides a common platform for artisans and performing artists to showcase their talents. Nestling amidst rocks, rippling waterfalls and gorgeous lawns, Shilparamam is a melting pot of traditions and cultures. Here each season brings a mood of festivity and Indian festivals are celebrated in the most traditional way. Shilparamam hosts a multitude of ethnic art, crafts and culture from all over the country.</p>', '', '2016-10-03 08:09:19', 'admin', NULL, NULL, 1),
(64, 'Yadagirigutta', 'Things To Do', '<p>Yagadirigutta, Nalgonda District, Telangana.</p>', 'Nalgonda', '17385044', '78486671', '<p [removed] justify;">Yadagirigutta is the most unique, beautiful and pleasant Hillock with moderate Climate in all seasons and the temple is located at a distance of about 60 KM from the Hyderabad, capital city of Telangana. The flow of devotees / pilgrims visiting the temple for worship is very high since it is situated near the capital city. Every day not less than 5000-8000 pilgrims on average visits this temple for offering their vows, performing of saswata pujas ,saswata kalyanam,LakshaTulasi Pujas ,Abhisekam etc.,..</p>', '', '2016-10-03 08:13:10', 'admin', NULL, NULL, 1),
(65, 'Shilparamam', 'Shopping & Fashion', '<p>Hi-tech City, Hyderabad</p>', 'Hyderabad', '17.451', '78.3748113', '<p [removed] justify;">Shilparamam Arts and Crafts village is a tribute to the cultural legacy of India. The primary aim of this establishment is to foster, restore and help flourish the culture of India''s glorious past. It provides a common platform for artisans and performing artists to showcase their talents. Nestling amidst rocks, rippling waterfalls and gorgeous lawns, Shilparamam is a melting pot of traditions and cultures. Here each season brings a mood of festivity and Indian festivals are celebrated in the most traditional way. Shilparamam hosts a multitude of ethnic art, crafts and culture from all over the country. The yearly All-India Festival of Arts and Crafts held here in February highlights the cultural and creative traditions from every corner of the country and provides a unique occasion to take home a piece of Indian art.</p>', '', '2016-10-03 08:28:20', 'admin', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblplacesphotos`
--

CREATE TABLE IF NOT EXISTS `tblplacesphotos` (
  `pphotoid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `plid` int(10) unsigned DEFAULT NULL,
  `photoname` longtext,
  `path` longtext,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`pphotoid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=256 ;

--
-- Dumping data for table `tblplacesphotos`
--

INSERT INTO `tblplacesphotos` (`pphotoid`, `plid`, `photoname`, `path`, `status`) VALUES
(24, 5, 'Charminar_01.jpg', 'http://book4holiday.com/beta/assets/places/Charminar_01.jpg', '1'),
(25, 5, 'Charminar_02.jpg', 'http://book4holiday.com/beta/assets/places/Charminar_02.jpg', '1'),
(26, 5, 'Charminar_03.jpg', 'http://book4holiday.com/beta/assets/places/Charminar_03.jpg', '1'),
(27, 5, 'Charminar_04.jpg', 'http://book4holiday.com/beta/assets/places/Charminar_04.jpg', '1'),
(28, 5, 'Charminar_05.jpg', 'http://book4holiday.com/beta/assets/places/Charminar_05.jpg', '1'),
(34, 6, 'HussanSagar_01.JPG', 'http://book4holiday.com/beta/assets/places/HussanSagar_01.JPG', '1'),
(35, 6, 'HussanSagar_02.jpg', 'http://book4holiday.com/beta/assets/places/HussanSagar_02.jpg', '1'),
(36, 6, 'HussanSagar_03.jpg', 'http://book4holiday.com/beta/assets/places/HussanSagar_03.jpg', '1'),
(37, 6, 'HussanSagar_04.jpg', 'http://book4holiday.com/beta/assets/places/HussanSagar_04.jpg', '1'),
(38, 6, 'HussanSagar_05.jpg', 'http://book4holiday.com/beta/assets/places/HussanSagar_05.jpg', '1'),
(56, 1, 'Golcondaf_04.jpg', 'http://book4holiday.com/beta/assets/places/Golcondaf_04.jpg', '1'),
(57, 1, 'Golcondaf_05.jpg', 'http://book4holiday.com/beta/assets/places/Golcondaf_05.jpg', '1'),
(58, 2, 'Lumbini_01.jpg', 'http://book4holiday.com/beta/assets/places/Lumbini_01.jpg', '1'),
(59, 2, 'Lumbini_02.JPG', 'http://book4holiday.com/beta/assets/places/Lumbini_02.JPG', '1'),
(60, 2, 'Lumbini_03.jpg', 'http://book4holiday.com/beta/assets/places/Lumbini_03.jpg', '1'),
(61, 2, 'Lumbini_04.jpg', 'http://book4holiday.com/beta/assets/places/Lumbini_04.jpg', '1'),
(62, 2, 'Lumbini_05.JPG', 'http://book4holiday.com/beta/assets/places/Lumbini_05.JPG', '1'),
(63, 4, 'PDT_01.jpg', 'http://book4holiday.com/beta/assets/places/PDT_01.jpg', '1'),
(64, 4, 'PDT_02.jpg', 'http://book4holiday.com/beta/assets/places/PDT_02.jpg', '1'),
(65, 4, 'PDT_03.jpg', 'http://book4holiday.com/beta/assets/places/PDT_03.jpg', '1'),
(66, 4, 'PDT_04.jpg', 'http://book4holiday.com/beta/assets/places/PDT_04.jpg', '1'),
(67, 4, 'PDT_05.jpg', 'http://book4holiday.com/beta/assets/places/PDT_05.jpg', '1'),
(68, 3, 'PrasadImax_01.jpg', 'http://book4holiday.com/beta/assets/places/PrasadImax_01.jpg', '1'),
(69, 3, 'PrasadImax_02.jpg', 'http://book4holiday.com/beta/assets/places/PrasadImax_02.jpg', '1'),
(70, 3, 'PrasadImax_03.jpg', 'http://book4holiday.com/beta/assets/places/PrasadImax_03.jpg', '1'),
(71, 3, 'PrasadImax_04.jpg', 'http://book4holiday.com/beta/assets/places/PrasadImax_04.jpg', '1'),
(72, 3, 'PrasadImax_05.jpg', 'http://book4holiday.com/beta/assets/places/PrasadImax_05.jpg', '1'),
(73, 7, 'BirlaM_01.jpg', 'http://book4holiday.com/beta/assets/places/BirlaM_01.jpg', '1'),
(74, 7, 'BirlaM_02.jpg', 'http://book4holiday.com/beta/assets/places/BirlaM_02.jpg', '1'),
(75, 7, 'BirlaM_03.jpg', 'http://book4holiday.com/beta/assets/places/BirlaM_03.jpg', '1'),
(76, 7, 'BirlaM_04.jpg', 'http://book4holiday.com/beta/assets/places/BirlaM_04.jpg', '1'),
(77, 7, 'BirlaM_05.JPG', 'http://book4holiday.com/beta/assets/places/BirlaM_05.JPG', '1'),
(78, 8, 'Falaknuma_01.jpg', 'http://book4holiday.com/beta/assets/places/Falaknuma_01.jpg', '1'),
(79, 8, 'Falaknuma_02.jpg', 'http://book4holiday.com/beta/assets/places/Falaknuma_02.jpg', '1'),
(80, 8, 'Falaknuma_03.jpg', 'http://book4holiday.com/beta/assets/places/Falaknuma_03.jpg', '1'),
(81, 8, 'Falaknuma_04.jpg', 'http://book4holiday.com/beta/assets/places/Falaknuma_04.jpg', '1'),
(82, 8, 'Falaknuma_05.jpg', 'http://book4holiday.com/beta/assets/places/Falaknuma_05.jpg', '1'),
(83, 9, 'Ntr_01.jpg', 'http://book4holiday.com/beta/assets/places/Ntr_01.jpg', '1'),
(84, 9, 'Ntr_02.jpg', 'http://book4holiday.com/beta/assets/places/Ntr_02.jpg', '1'),
(85, 9, 'Ntr_03.jpg', 'http://book4holiday.com/beta/assets/places/Ntr_03.jpg', '1'),
(86, 9, 'Ntr_04.JPG', 'http://book4holiday.com/beta/assets/places/Ntr_04.JPG', '1'),
(87, 9, 'Ntr_05.jpg', 'http://book4holiday.com/beta/assets/places/Ntr_05.jpg', '1'),
(88, 10, 'Ramoji_01.jpg', 'http://book4holiday.com/beta/assets/places/Ramoji_01.jpg', '1'),
(89, 10, 'Ramoji_02.jpg', 'http://book4holiday.com/beta/assets/places/Ramoji_02.jpg', '1'),
(90, 10, 'Ramoji_03.jpg', 'http://book4holiday.com/beta/assets/places/Ramoji_03.jpg', '1'),
(91, 10, 'Ramoji_04.JPG', 'http://book4holiday.com/beta/assets/places/Ramoji_04.JPG', '1'),
(92, 10, 'Ramoji_05.jpg', 'http://book4holiday.com/beta/assets/places/Ramoji_05.jpg', '1'),
(93, 11, 'salarjung_01.jpg', 'http://book4holiday.com/beta/assets/places/salarjung_01.jpg', '1'),
(94, 11, 'salarjung_02.jpg', 'http://book4holiday.com/beta/assets/places/salarjung_02.jpg', '1'),
(95, 11, 'salarjung_03.jpg', 'http://book4holiday.com/beta/assets/places/salarjung_03.jpg', '1'),
(96, 11, 'salarjung_04.jpg', 'http://book4holiday.com/beta/assets/places/salarjung_04.jpg', '1'),
(97, 1, 'Golconda.jpg', 'http://book4holiday.com/beta/assets/places/Golconda.jpg', '1'),
(98, 1, 'Golcondaf_03.jpg', 'http://book4holiday.com/beta/assets/places/Golcondaf_03.jpg', '1'),
(99, 1, 'Golcondaf_011.jpg', 'http://book4holiday.com/beta/assets/places/Golcondaf_011.jpg', '1'),
(115, 15, 'kuntala.jpg', 'http://book4holiday.com/beta/assets/places/kuntala.jpg', '1'),
(116, 15, 'kuntala1.jpg', 'http://book4holiday.com/beta/assets/places/kuntala1.jpg', '1'),
(117, 15, 'kuntala2.jpg', 'http://book4holiday.com/beta/assets/places/kuntala2.jpg', '1'),
(118, 16, '6803_Laknavaram-lake.jpg', 'http://book4holiday.com/beta/assets/places/6803_Laknavaram-lake.jpg', '1'),
(120, 16, 'tourisom lakkavaram.jpg', 'http://book4holiday.com/beta/assets/places/tourisom lakkavaram.jpg', '1'),
(121, 16, 'tourisom lakkavaram.jpg', 'http://book4holiday.com/beta/assets/places/tourisom lakkavaram.jpg', '1'),
(122, 16, 'images.jpg', 'http://book4holiday.com/beta/assets/places/images.jpg', '1'),
(123, 16, 'tourisom lakkavaram.jpg', 'http://book4holiday.com/beta/assets/places/tourisom lakkavaram.jpg', '1'),
(124, 16, '6803_Laknavaram-lake.jpg', 'http://book4holiday.com/beta/assets/places/6803_Laknavaram-lake.jpg', '1'),
(125, 16, '6803_Laknavaram-lake.jpg', 'http://book4holiday.com/beta/assets/places/6803_Laknavaram-lake.jpg', '1'),
(126, 16, 'images.jpg', 'http://book4holiday.com/beta/assets/places/images.jpg', '1'),
(127, 16, 'tourisom lakkavaram.jpg', 'http://book4holiday.com/beta/assets/places/tourisom lakkavaram.jpg', '1'),
(128, 14, 'puri-jagannath-temple-hyderabad-23077781.jpg', 'http://book4holiday.com/beta/assets/places/puri-jagannath-temple-hyderabad-23077781.jpg', '1'),
(131, 13, 'kidsmeal.jpg', 'http://book4holiday.com/beta/assets/places/kidsmeal.jpg', '1'),
(133, 17, 'sanghi-temple-photos.jpg', 'http://book4holiday.com/beta/assets/places/sanghi-temple-photos.jpg', '1'),
(135, 21, 'gayatri-mandir-images-photos-5428ed5de4b0b2f2242ac00d.jpg', 'http://book4holiday.com/beta/assets/places/gayatri-mandir-images-photos-5428ed5de4b0b2f2242ac00d.jpg', '1'),
(136, 22, 'Yadagirigutta.jpg', 'http://book4holiday.com/beta/assets/places/Yadagirigutta.jpg', '1'),
(144, 25, 'jalavihar.jpg', 'http://book4holiday.com/beta/assets/places/jalavihar.jpg', '1'),
(145, 25, 'Jalavihar-Water-Park_Childrens-Water-Park_Necklace-Road-Hyderabad-India-15.jpg', 'http://book4holiday.com/beta/assets/places/Jalavihar-Water-Park_Childrens-Water-Park_Necklace-Road-Hyderabad-India-15.jpg', '1'),
(146, 25, 'jalvihar-hyderabad-necklace-road-2.jpg', 'http://book4holiday.com/beta/assets/places/jalvihar-hyderabad-necklace-road-2.jpg', '1'),
(147, 25, 'jalvihar-in-hyderabad.jpg', 'http://book4holiday.com/beta/assets/places/jalvihar-in-hyderabad.jpg', '1'),
(148, 26, 'Mount-Opera-Water-Park-Hyderabad.jpg', 'http://book4holiday.com/beta/assets/places/Mount-Opera-Water-Park-Hyderabad.jpg', '1'),
(149, 26, 'wonderla-amusement-park.jpg', 'http://book4holiday.com/beta/assets/places/wonderla-amusement-park.jpg', '1'),
(150, 26, 'Wonderla-Water-Park-Hyderabad.jpg', 'http://book4holiday.com/beta/assets/places/Wonderla-Water-Park-Hyderabad.jpg', '1'),
(151, 27, 'khilla.jpg', 'http://book4holiday.com/beta/assets/places/khilla.jpg', '1'),
(152, 28, 'Koilkonda_Fort_Main.jpg', 'http://book4holiday.com/beta/assets/places/Koilkonda_Fort_Main.jpg', '1'),
(153, 29, '223188993Nizamabad_Koulas_Fort_Main.jpg', 'http://book4holiday.com/beta/assets/places/223188993Nizamabad_Koulas_Fort_Main.jpg', '1'),
(154, 30, '334529587Adilabad_Gayatri_Falls_Main.jpg', 'http://book4holiday.com/beta/assets/places/334529587Adilabad_Gayatri_Falls_Main.jpg', '1'),
(155, 31, '334529371Adilabad_Kanakai_Falls_Main.jpg', 'http://book4holiday.com/beta/assets/places/334529371Adilabad_Kanakai_Falls_Main.jpg', '1'),
(169, 47, 'nodetail.gif', 'https://book4holiday.com/beta/assets/places/nodetail.gif', '1'),
(170, 46, 'BN-GJ136_chess_J_20150109120327.jpg', 'https://book4holiday.com/beta/assets/places/BN-GJ136_chess_J_20150109120327.jpg', '1'),
(171, 45, '608924_e590.jpg', 'https://book4holiday.com/beta/assets/places/608924_e590.jpg', '1'),
(172, 44, '1472702253201472702253.jpg', 'https://book4holiday.com/beta/assets/places/1472702253201472702253.jpg', '1'),
(173, 35, 'Traditional-Dhandiya-Nights-At-Yogi-Bear-Golf-Park.jpg', 'https://book4holiday.com/beta/assets/places/Traditional-Dhandiya-Nights-At-Yogi-Bear-Golf-Park.jpg', '1'),
(174, 33, 'nodetail.gif', 'https://book4holiday.com/beta/assets/places/nodetail.gif', '1'),
(175, 34, 'nodetail.gif', 'https://book4holiday.com/beta/assets/places/nodetail.gif', '1'),
(176, 36, 'rangoli3_vasu-rangoli_yt.jpg', 'https://book4holiday.com/beta/assets/places/rangoli3_vasu-rangoli_yt.jpg', '1'),
(177, 38, 'img02.jpg', 'https://book4holiday.com/beta/assets/places/img02.jpg', '1'),
(178, 39, 'b25130d052c2b3acfc3601d61fecd364.jpg', 'https://book4holiday.com/beta/assets/places/b25130d052c2b3acfc3601d61fecd364.jpg', '1'),
(179, 41, 'DSC09212.JPG', 'https://book4holiday.com/beta/assets/places/DSC09212.JPG', '1'),
(180, 42, 'nodetail.gif', 'https://book4holiday.com/beta/assets/places/nodetail.gif', '1'),
(181, 43, 'nodetail.gif', 'https://book4holiday.com/beta/assets/places/nodetail.gif', '1'),
(182, 48, 'K3.jpg', 'https://book4holiday.com/beta/assets/places/K3.jpg', '1'),
(183, 48, 'K11.jpg', 'https://book4holiday.com/beta/assets/places/K11.jpg', '1'),
(184, 48, 'K12.jpg', 'https://book4holiday.com/beta/assets/places/K12.jpg', '1'),
(185, 50, '1411541194_sm1.png', 'https://book4holiday.com/beta/assets/places/1411541194_sm1.png', '1'),
(186, 50, '1412772996_SRI_6643.png', 'https://book4holiday.com/beta/assets/places/1412772996_SRI_6643.png', '1'),
(187, 50, '1412773266_SRI_6688.png', 'https://book4holiday.com/beta/assets/places/1412773266_SRI_6688.png', '1'),
(188, 50, '1412779577_SRI_6846.png', 'https://book4holiday.com/beta/assets/places/1412779577_SRI_6846.png', '1'),
(189, 52, '3.jpg', 'https://book4holiday.com/beta/assets/places/3.jpg', '1'),
(190, 52, 'laad-bazaar.jpg', 'https://book4holiday.com/beta/assets/places/laad-bazaar.jpg', '1'),
(191, 52, 'lad-bazar-in-charminar.jpg', 'https://book4holiday.com/beta/assets/places/lad-bazar-in-charminar.jpg', '1'),
(192, 52, 'Ramazan-by-desi-Traveler-1-of-1-2.jpg', 'https://book4holiday.com/beta/assets/places/Ramazan-by-desi-Traveler-1-of-1-2.jpg', '1'),
(193, 53, 'ACdoubleroom.jpg', 'https://book4holiday.com/beta/assets/places/ACdoubleroom.jpg', '1'),
(194, 53, 'Greencarpet.jpg', 'https://book4holiday.com/beta/assets/places/Greencarpet.jpg', '1'),
(195, 53, 'Mainbuilding.jpg', 'https://book4holiday.com/beta/assets/places/Mainbuilding.jpg', '1'),
(196, 53, 'partyroom.jpg', 'https://book4holiday.com/beta/assets/places/partyroom.jpg', '1'),
(197, 53, 'suiteroom.jpg', 'https://book4holiday.com/beta/assets/places/suiteroom.jpg', '1'),
(198, 54, 'Laadbazar.jpg', 'https://book4holiday.com/beta/assets/places/Laadbazar.jpg', '1'),
(199, 55, 'K3.jpg', 'https://book4holiday.com/beta/assets/places/K3.jpg', '1'),
(200, 55, 'K10.jpg', 'https://book4holiday.com/beta/assets/places/K10.jpg', '1'),
(201, 55, 'K13.jpg', 'https://book4holiday.com/beta/assets/places/K13.jpg', '1'),
(202, 55, 'K17.jpg', 'https://book4holiday.com/beta/assets/places/K17.jpg', '1'),
(210, 58, '0123.jpg', 'https://book4holiday.com/beta/assets/places/0123.jpg', '1'),
(211, 58, '01234.jpg', 'https://book4holiday.com/beta/assets/places/01234.jpg', '1'),
(212, 58, '012345.jpg', 'https://book4holiday.com/beta/assets/places/012345.jpg', '1'),
(219, 59, '1.png', 'https://book4holiday.com/beta/assets/places/1.png', '1'),
(220, 59, '2.png', 'https://book4holiday.com/beta/assets/places/2.png', '1'),
(222, 59, '4.png', 'https://book4holiday.com/beta/assets/places/4.png', '1'),
(223, 59, '5.png', 'https://book4holiday.com/beta/assets/places/5.png', '1'),
(226, 60, '3.jpg', 'https://book4holiday.com/beta/assets/places/3.jpg', '1'),
(227, 60, '4.jpg', 'https://book4holiday.com/beta/assets/places/4.jpg', '1'),
(228, 60, '5.jpg', 'https://book4holiday.com/beta/assets/places/5.jpg', '1'),
(229, 60, '6.jpg', 'https://book4holiday.com/beta/assets/places/6.jpg', '1'),
(230, 60, '7.jpg', 'https://book4holiday.com/beta/assets/places/7.jpg', '1'),
(231, 57, 'a.jpg', 'https://book4holiday.com/beta/assets/places/a.jpg', '1'),
(232, 57, 'b.jpg', 'https://book4holiday.com/beta/assets/places/b.jpg', '1'),
(233, 57, 'c.jpg', 'https://book4holiday.com/beta/assets/places/c.jpg', '1'),
(234, 57, 'd.jpg', 'https://book4holiday.com/beta/assets/places/d.jpg', '1'),
(235, 57, 'e.jpg', 'https://book4holiday.com/beta/assets/places/e.jpg', '1'),
(236, 57, 'f.jpg', 'https://book4holiday.com/beta/assets/places/f.jpg', '1'),
(237, 61, 'hyderabad-chowmahalla-palace-1.jpg', 'https://book4holiday.com/beta/assets/places/hyderabad-chowmahalla-palace-1.jpg', '1'),
(238, 61, 'Mahal.jpg', 'https://book4holiday.com/beta/assets/places/Mahal.jpg', '1'),
(239, 61, 'Slider2.jpg', 'https://book4holiday.com/beta/assets/places/Slider2.jpg', '1'),
(243, 62, 'Birla-Planetarium1-kolkata.jpg', 'https://book4holiday.com/beta/assets/places/Birla-Planetarium1-kolkata.jpg', '1'),
(244, 62, 'chennai-birla-planetarium-new1.jpg', 'https://book4holiday.com/beta/assets/places/chennai-birla-planetarium-new1.jpg', '1'),
(245, 62, 'DE28-P2-BIRLA_G_DE_2291850f.jpg', 'https://book4holiday.com/beta/assets/places/DE28-P2-BIRLA_G_DE_2291850f.jpg', '1'),
(247, 63, 'shilparamam.jpg', 'https://book4holiday.com/beta/assets/places/shilparamam.jpg', '1'),
(248, 63, 'shilparamam1.jpg', 'https://book4holiday.com/beta/assets/places/shilparamam1.jpg', '1'),
(249, 64, 'Yadagirigutta-Temple2-copy.jpg', 'https://book4holiday.com/beta/assets/places/Yadagirigutta-Temple2-copy.jpg', '1'),
(250, 64, 'Yadagirigutta-Temple-Room-Booking.jpg', 'https://book4holiday.com/beta/assets/places/Yadagirigutta-Temple-Room-Booking.jpg', '1'),
(251, 64, 'yadgiri.jpg', 'https://book4holiday.com/beta/assets/places/yadgiri.jpg', '1'),
(252, 63, 'shilparamam0123.jpg', 'https://book4holiday.com/beta/assets/places/shilparamam0123.jpg', '1'),
(253, 65, 'shilparamam1.jpg', 'https://book4holiday.com/beta/assets/places/shilparamam1.jpg', '1'),
(254, 65, 'shilparamam0123.jpg', 'https://book4holiday.com/beta/assets/places/shilparamam0123.jpg', '1'),
(255, 65, 'shilparamam.jpg', 'https://book4holiday.com/beta/assets/places/shilparamam.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tblresorphotos`
--

CREATE TABLE IF NOT EXISTS `tblresorphotos` (
  `rphotoid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resortid` int(10) unsigned DEFAULT NULL,
  `photoname` longtext,
  `path` longtext,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`rphotoid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblresorts`
--

CREATE TABLE IF NOT EXISTS `tblresorts` (
  `resortid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vendorid` int(10) unsigned DEFAULT NULL,
  `resortname` varchar(150) DEFAULT NULL,
  `location` varchar(500) DEFAULT NULL,
  `description` longtext,
  `createdby` varchar(45) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedby` varchar(45) DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `status` varchar(5) DEFAULT NULL,
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  `bannerimage` longtext NOT NULL,
  `bannerimagepath` longtext NOT NULL,
  PRIMARY KEY (`resortid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tblresorts`
--

INSERT INTO `tblresorts` (`resortid`, `vendorid`, `resortname`, `location`, `description`, `createdby`, `createdon`, `updatedby`, `updatedon`, `status`, `latitude`, `longitude`, `bannerimage`, `bannerimagepath`) VALUES
(1, 24, 'Nehru ZooLogical Park', 'Bahadurpura, Hyderabad, Telangana, India - 500 064.', '<p><strong>Nehru Zoological Park</strong>, Hyderabad is one of the first zoos in the Country to display the animals in open moated enclosures with no barriers in between the visitors and the animals. The zoo was established with this concept and was opened to public viewing on <strong>06.10.1963</strong>. <br /><br />Since then the zoo kept on adding new facilities. The Lion Safari Park which was established in 1974 and Nocturnal Animal House established in the year 1982 were first of its kind in the country. At Present this zoo is displaying animals belonging to 140 species numbering 1334. During this period this zoo received Common Marmosets, Spoon Bills from Alipore Zoo, Kolkata. Pig Tailed Macaque, Himalayan Black Bear, Leopard Cats from Sipahijala Zoo, Tripura and Mouse Deers from Sri Venkateshwara Zoological Park, Tirupati, 6 Nos of White backed Vultures from Sakkarbagh Zoo There are other animal exchange programmes belongs this Zoo and Patna & Mysore Zoos in the pipe line. During this period most of the animal enclosures and visitor facilities were revamped. Efforts were made to make the zoo a plastic free area, A Plastic regulation counter was opened at the entrance gate which provides paper bags in place of polythine bags. Additional booking counters, Visitors Shelters, resting areas were created for the visitors. This Zoo is spread over an area of 380 acres and a visitor can''t see all the enclosures in one day on foot. Therefore bicycles were introduced in the zoo, and the visitors can hire these bicycles and can go around the zoo. This is helping the visitors in visiting the zoo completely.</p>', 'admin', '2016-08-21 01:52:29', 'vendor', '2016-09-03 01:30:14', '1', '17.351458', '78.447318', 'entry_gate1.png', ''),
(2, 26, 'Lahari Resorts', 'Bhanoor, Near Patancheru, Hyderabad - 502 305', 'Lahari Resort, a budget property is ideal for holidaying with friends and family and also for leisure cum business trip. The hotel is located at a distance of 53.7 km from Hyderabad International Airport, 20.6 km from Chandanagar Railway Station and 44.1 km from Shapur Nagar Bus Stand. The hotel is in proximity to various tourist places like Chilkur Balaji Temple, Sri Ramakrishna Math, Nehru Zoological Park, KBR National Park, Buddha Statue and many more. ', 'admin', '2016-08-21 02:17:16', NULL, NULL, '1', '17.4825', '78.185834', 'f1a.jpg', '/home/book4holiday/public_html/beta/assets/resortimages/'),
(3, 27, 'Honey Berg Resort', 'Muraharipalli Village, Near Genome Valley Medchal Mandal, Ranga Reddy, Hyderabad, Andhra Pradesh, India', 'Suchirindia Hotels & Resorts (P) Limited was set up by Suchirindia Group to foray into the hospitality sector. Resorts, Clubs, Theme Parks and other entertainment centers are being set up, initially in and around Hyderabad, major towns of Andhra Pradesh, metro cities in India and in due course overseas. Honey Berg is a 40,000 sq.ft, 3 Star boutique retreat located near Genome Valley, Shamirpet, Hyderabad. The highlighting factor of the resort is its architectural design which, while retaining the rocky terrain, seamlessly blends in with the surroundings. The magnificent glass façades and the rumbling waterfalls give it a distinct appearance and add substantially to the final panorama.The highlighting factor of the resort is its architectural design which, while retaining the rocky terrain, seamlessly blends in with the surroundings. The magnificent glass façades and the rumbling waterfalls give it a distinct appearance and add substantially to the final panorama.', 'admin', '2016-08-21 02:26:08', 'admin', '2016-08-22 06:12:55', '1', '17.65793', '78.584715', 'honey-berg-resorts-hyderabad-pool-view-37154805g.jpg', '/home/book4holiday/public_html/beta/assets/resortimages/'),
(4, 28, 'Summer Green Resort', 'Thumkunta Village,  Karimnagar Main Road,  Shameerpet Mandal, R. R. District  Telangana, India – 500078 ', 'Summer Green plays perfect host as a gateway destination for families, friends or colleagues. The picturesque greenery, great ambiance & sprawling lawns are ideal for hosting weddings, birthday parties, family functions, Get-together’s, corporate seminars & launches.', 'admin', '2016-08-21 02:33:37', 'admin', '2016-08-22 06:45:52', '1', '17.5702899', '78.5552554', 'summer-green-resort-hyderabad-exterior-view-31423096g.jpg', '/home/book4holiday/public_html/beta/assets/resortimages/'),
(5, 25, 'Leonia Holistic Destination', '89 Survey No | Bommaraspet, Shameerpet, Ranga Reddy District, Hyderabad 500078, India', 'Leonia Holistic Destination is a unique destination spread in sprawling greenery and natural rock formations that portray a warm invitation to guests from across the world to dwell in the ambience of luxury, warm hospitality and richness of integrated services offered by its villas and hotels. They offer 6 Signature Suites and variety of Amazing Amuzements.\r\n', 'admin', '2016-08-29 04:25:57', NULL, NULL, '1', '17.577819', '78.6015908', 'Lagoon_villa_leonia.jpg', '/home/book4holiday/public_html/beta/assets/resortimages/'),
(6, 25, 'Pragati Resorts', 'Chilkuru Balaji Temple Road, Proddutur Village, Shankarpally Mandal Ranga Reddy District , Andhra pradesh, India 501203', '"Pragati Green Resorts is a one-of-its-kind resort in the country - it is a man-made eco-village developed on barren land creating a natural habitat. The environment here is completely eco-friendly, abundantly bio-diverse, pollution-free and mosquito-free. It makes for the most welcoming destination for recreation, event and health in the lap of nature.\r\n \r\nHaving converted a non-useable land into a wonderful green belt on 2,500 acres of land without any chemical pesticides or fertilizers, we have been attracting rare species and contributing to biodiversity. Situated amidst 2.5 million mother plants and trees, the Resort is an 85 acre sprawl of greenery till the end of sight. It is an ideal retreat for the aware, creative and playful nature-lover.\r\n \r\nWhile you could spend a vacation plucking aromatic herbs for your tea and swimming in the pool with birds singing around, your whole family and group will be able to find their own interests. The resort property houses everything from cricket fields, golf course and naturopathy spa to ponds filled with ducks and lovely sculptures and fountains every few metres."\r\n\r\n', 'admin', '2016-08-29 04:30:53', NULL, NULL, '1', '17.3891674', '78.1819297', 'pragathi9.jpg', '/home/book4holiday/public_html/beta/assets/resortimages/'),
(7, 25, 'Golkonda Resorts & Spa', 'Sagar Mahal Complex, Gandipet, R R District, Near Osman Sagar Lake, Hyderabad, Telangana 500075', '"This upscale resort, set on 5 hectares of lush greenery, is a 5-minute walk from Osman Sagar Lake and 11 km from the Golkonda medieval fortress. \r\n\r\nFeaturing wood interiors, the chic villas feature free Wi-Fi and TVs, plus tea and coffeemaking facilities, and living areas. Some add balconies. Upgraded villas offer sleek decor and private gardens, and split-level villas include parlours. Luxury upgrades come with private pools and butler service.\r\n\r\nAmenities include multiple dining options and a bar by the outdoor pool, as well as a fitness centre, a spa and a salon. There''s also a cricket pitch and a game room, and conference space is available."\r\n', 'admin', '2016-08-29 04:32:47', NULL, NULL, '1', '17.3895408', '78.3162311', 'golconda.jpg', '/home/book4holiday/public_html/beta/assets/resortimages/'),
(8, 25, 'Chaitanya Resorts', 'Plot No: 402, 4th Floor, Chaitanya Villa, Arunodaya Colony,, Landmark Backside of Hitech Theater, Madhapur, Hyderabad, Telangana 500081', 'A celebration of beauty, heritage and nature, resort is a finest example of luxury, Chaitanya Resort stands as a great work of passion towards creating something magnificent and almost magical in the unadulterated essence of simple yet mesmerizing crafts of nature and man alike. Chaitanya Resort Situated in the historic city of Hyderabad on the away to “Sree Chilkur Balaji Temple” and close to “City''s heart". Boating (overlooking panoramically greener surroundings). Well maintained High Standard Swimming pool with Water Slides & Water Games. Cricket ground for cricketing enthusiasts. Pool view Suite, natural pleasure-loving Nature Lovers. Tug of war, Cricket, Volleyball, Badminton with kits. Professional DJ with High Volume DJ Console with Rain Dance. Adventure Activity (Burma Bridge, Commando Net, Archery, Artificial Rock Climbing, Double Roap, Zipline, Rapling. \r\n', 'admin', '2016-08-29 04:34:30', NULL, NULL, '1', '17.444654', '78.388878', 'Chaitanya-Resorts-Hyderabad.jpg', '/home/book4holiday/public_html/beta/assets/resortimages/'),
(9, 25, 'Aalankrita Resort', 'Thumkunta Village | Karimnagar Main Road, RR Dist, Hyderabad 500078, India', '"Nestled in lush gardens, this upscale resort offers accommodation in a collection of cottages. The resort is 6 km from Shamirpet Lake and 7 km from the Koteshwar Swamy Temple. \r\n\r\nThe relaxed rooms and suites with ethnic wood furnishings offer free Wi-Fi, flat-screen TVs and minibars. Upgraded rooms have sitting areas and some add balconies; suites offer sitting rooms. Room service is available 24/7.\r\n\r\nFreebies include breakfast and parking. Dining options include an elegant restaurant, a vegetarian eatery and a grill. Other amenities include sports activities, a game room, a covered outdoor pool and a spa. There''s also a gym, plus a meditation room."\r\n', 'admin', '2016-08-29 04:36:13', NULL, NULL, '1', '17.572378', '78.55716', 'Aalankrita-online-room-booking1.jpg', '/home/book4holiday/public_html/beta/assets/resortimages/'),
(10, 25, 'Dream Valley Resorts', 'Dream Valley Vikarabad Road | Before Chilkur X Roads, Hyderabad 500008, India', 'Dream Valley Resort is known as a Resort in collaboration with nature. The theme was to provide a weekend getaway for Families who spend working, and do not have time to relax and rejuvenate themselves for the coming week. Taking forward this legacy and providing more to Hyderabad the concept of a Resort with a water park was developed on an area of 20 acres at Bakaram Jagir before Chilkur X Roads. In the quest for providing more facilities the company is coming out with an exclusive convention centre, which will be a great mix and match with nature, all that a convention centre needs in an ambience that is close to nature. And entertainment will be an added attraction. This project houses a mega water park on an area of 20 acres, surrounded by greenery and good landscaping all around. The vision of being close to nature is always in the minds of Dream Valley Resorts, thus all things which are natural find a place. The idea is to contribute to the community and also to ensure follow up of all environment friendly practices.\r\n', 'admin', '2016-08-29 04:38:22', NULL, NULL, '1', '17.4178149', '78.4469734', 'Dream_Valley.jpg', '/home/book4holiday/public_html/beta/assets/resortimages/'),
(11, 25, 'Palm Exotica Boutique Resort & Spa', 'Bank Street | Shankarpally, Ranka Reddy District, Hyderabad 500029, India', 'Palm Exotica Boutique Resort & Spa set on the Highlands of Shankarpalli Hyderabad is an eco friendly unique luxury holiday resort, thoughtfully designed to charm you with its spectacular panoramic views, unparalleled choice of accommodation, dining experiences, recreational activities, adventure sports, spa, banquets, international standard day night Cricket Stadium while maintaining idyllic refuge of relaxation to create the perfect balance for a holiday in paradise, perfect for families, honeymooners and Corporate alike.\r\n', 'admin', '2016-08-29 04:39:59', NULL, NULL, '1', '17.4091359', '78.1110385', 'Palm_Exotica.jpg', '/home/book4holiday/public_html/beta/assets/resortimages/'),
(12, 25, 'Button Eyes Resort', 'Tolkatta Village Rd | Moinabad, Hyderabad 500058, India', '"At times when you want to be with just yourself and your dear ones. Or when you want to party for ever and ever. This is the right place. Button Eyes is where you have to head for. To spend time in solitude with your loved ones, for family gettogethers and corporate outings, Button Eyes is the ideal place.\r\nExplore the place to discover a whole new world of excitement."\r\n', 'admin', '2016-08-29 04:41:37', NULL, NULL, '1', '17.3042286', '78.2076478', 'Button_Eyes_Resort.jpg', '/home/book4holiday/public_html/beta/assets/resortimages/'),
(13, 25, 'Mrugavani Resort & Spa', 'SY No 177/1, Aziz Nagar Village, Moinabad Mandal Ranga Reddy District, Hyderabad 500075, India', '"Mrugavani Resort and Spa is an eco-tourism project which is a blend of nature and modernity. It is an integral part of Mrugavani National Park which is spread across 1006 acres. This green resort is in close vicinity of IT hub, Financial district and other Historical and Tourist spots in Hyderabad, the capital city of Telengana. The natural hideaway is within city limits and an ideal place for weekend trips and extended stays. It is 18 km away from heart of the city and 15 minutes drive from Rajiv Gandhi International Airport.\r\n\r\nMrugavani Resort and Spa is a public private partnership venture in eco-tourism sector with the Telangana State Forest Development Corporation Limited, exclusively for spreading environmental awareness among present and future generations."\r\n', 'admin', '2016-08-29 04:43:26', NULL, NULL, '1', '17.3529982', '78.3375902', 'mrugavani_resort_banner52-2880x1800.jpg', '/home/book4holiday/public_html/beta/assets/resortimages/'),
(14, 25, 'MAK Club & Resort', 'Srisailam Highway, Near International Airport, Hyderabad 500082, India', '"Set amid landscaped gardens, this upscale contemporary resort is 20 km from Rajiv Gandhi International Airport and 32 km from Hyderabad city centre. \r\n\r\nFeaturing eclectic decor, the modern rooms and villas offer Wi-Fi, satellite TV and sitting areas, plus minifridges, and tea and coffeemakers. The 3- and 4-bedroom villas add kitchens and separate living and dining areas.\r\n\r\nAmenities include a relaxed international restaurant, a lounge bar and 2 terraces, plus an outdoor pool, a hot tub and a spa offering massage and hydrotherapy. There''s also a tennis court, a squash court and a gym, as well as a game room with a pool table."\r\n', 'admin', '2016-08-29 04:44:39', NULL, NULL, '1', '17.138781', '78.472263', 'MAK_Club_Resort4.jpg', '/home/book4holiday/public_html/beta/assets/resortimages/'),
(15, 25, 'Mount Opera Star Resort', 'Batasingaram Village,Hayathnagar Mandal,, Hyderabad 501512, India', '"Mount Opera Multi-Theme Park Resort is a popular weekend getaway located in the outskirts of the city, on the Hyderabad-Vijayawada National Highway. Sprawling over a large area of about 55 acres, the park offers amusement rides, water world, indoor games, health clubs, net surfing and discotheque, to list a few. \r\n\r\nChildren can look for exciting rides like Merry-Go-Round, Go-Karting, Toy Train and Animatrix Dinasorire. Oasis Zone Water World is another prime attraction of this amusement park, where children can enjoy slides, have a ball in the wave pool or just enjoy dancing in the rain. On the other hand, if you prefer indoor sports, pick from a host of games like pool, table tennis, chess and carom. For fitness enthusiasts, there is Bodyline that also offers sauna, spa and massage services. As the day progresses, loosen up a little and get ready to burn the dance floor at the in-house discotheque. \r\n\r\nFor the convenience of visitors, this park provides accommodation facilities at its resort. People can also enjoy an array of delicious delicacies served at the food courts present in the resort. So, do not miss the opportunity of visiting this amazing theme park with your family and friends, when in Hyderabad."\r\n', 'admin', '2016-08-29 04:46:17', NULL, NULL, '1', '17.3155508', '78.7214036', 'mount-opera-star-resort.jpg', '/home/book4holiday/public_html/beta/assets/resortimages/'),
(16, 25, 'Srinidhi Joy N Joy Resorts', '3rd Floor, SR Complex, Opp. CCMB, Habsiguda, Secunderabad, Telangana 500007', '"SRINIDHI JOY ‘n’ JOY RESORTS was established in the year 2000 , Located in East Hyderabad on Warangal highway and it is one of its kind. The resort gives a getaway to rejuvenate- both body and mind as well caters the needs of our customers at affordable pricing. The Resort provides you balance between your work and family, thus we make your day out as relaxing and rejuvenating as possible.\r\n\r\nThe Best of Everything is we have something for all ages to keep your family happily occupied for hours with which you’ll get to be pampered like a family without having to worry about the budget."\r\n', 'admin', '2016-08-29 04:49:34', NULL, NULL, '1', '17.415737', '78.544886', 'Srinidhi_Joy_N_Joy_Resort.jpg', '/home/book4holiday/public_html/beta/assets/resortimages/'),
(17, 25, 'Papyrus Port', ' Bangalore Highway, Near 34th Milestone, Mahaboob Nagar District, Thimmapur, Telangana 500014', '"Set 1.3 km from Kottur railway station, this Egyptian-themed resort with a central pyramid-shaped building is a 4-minute walk from the NH7 highway. \r\n\r\nModest rooms with tiled floors and neutral decor come with TVs, minifridges and desks. They also have ceiling fans.\r\n\r\nThere''s a relaxed restaurant serving pan-Asian cuisine, and there''s a lagoon-style outdoor pool. Other amenities include a game room, spa services and a gym, as well as banqueting facilities."\r\n', 'admin', '2016-08-29 04:51:26', NULL, NULL, '1', '17.151427', '78.293349', 'Papyrus_Port.png', '/home/book4holiday/public_html/beta/assets/resortimages/'),
(18, 25, 'Vishal Prakruthi Resort', 'Opp. Dundigal Airforce Academy, Annaram Village, Jinnaram Mandal, Telangana 502313', 'Unique'' is the word that best captures Vishal Prakruthi Resorts in Hyderabad: a dynamic place rich in contrast and colour and is a heaven for vegetarian lovers with its fine decor magnificent views. Here, you will get to experience life in the authentic country side, far away from pollution and the din of the city life. A great range of indoor as well as outdoor leisure pursuits await your arrival at Vishal Prakruthi Resorts. A variety of entertainment facilities, passion of our professional service staff to provide quality personalized service and their unparalleled desire for guest satisfaction make Vishal Prakruthi Resorts ''the'' place for all your corporate events, celebrations, parties and family functions.\r\n', 'admin', '2016-08-29 04:53:20', NULL, NULL, '1', '17.4680379', '78.5068361', 'Vishal_Prakruthi_Resort.jpg', '/home/book4holiday/public_html/beta/assets/resortimages/');

-- --------------------------------------------------------

--
-- Table structure for table `tblsliders`
--

CREATE TABLE IF NOT EXISTS `tblsliders` (
  `sid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `title` longtext,
  `subtitle` longtext,
  `link` longtext,
  `expirydate` date DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `createdby` varchar(45) DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `updatedby` varchar(45) DEFAULT NULL,
  `image` longtext NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tblsliders`
--

INSERT INTO `tblsliders` (`sid`, `name`, `title`, `subtitle`, `link`, `expirydate`, `status`, `createdon`, `createdby`, `updatedon`, `updatedby`, `image`) VALUES
(1, 'Slider1', 'Independance Day', 'Independance Celebrations', '#', '0000-00-00', '1', '2016-08-12 02:14:21', 'admin', '2016-08-12 09:31:35', 'admin', '2.jpg'),
(2, 'Slider2', 'Alankrita Resorts', 'A right to plan your family day out', '#', '0000-00-00', '1', '2016-08-12 02:14:46', 'admin', '2016-08-12 09:27:58', 'admin', '4.jpg'),
(3, 'Zoo', 'Nehru Zoo Park', 'A right to plan your family day out', 'http://book4holiday.com/beta/index.php/resorts/zoo/1', '0000-00-00', '1', '2016-08-12 09:29:10', 'admin', '2016-08-23 09:21:49', 'admin', '10.jpg'),
(4, 'Slider4', 'Title', 'Subtitle', '#', '2016-08-12', '1', '2016-08-12 10:52:31', 'admin', NULL, NULL, '8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblsliders2`
--

CREATE TABLE IF NOT EXISTS `tblsliders2` (
  `sid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `title` longtext,
  `subtitle` longtext,
  `link` longtext,
  `expirydate` date DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `createdby` varchar(45) DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `updatedby` varchar(45) DEFAULT NULL,
  `image` longtext NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tblsliders2`
--

INSERT INTO `tblsliders2` (`sid`, `name`, `title`, `subtitle`, `link`, `expirydate`, `status`, `createdon`, `createdby`, `updatedon`, `updatedby`, `image`) VALUES
(1, 'Slider1', 'Independance Day', 'Independance Celebrations', 'http://book4holiday.com/beta/eventdetails/Independance-Celebrations/2', '0000-00-00', '1', '2016-08-12 02:14:21', 'admin', '2016-08-12 09:31:35', 'admin', '2.jpg'),
(2, 'Slider2', 'Alankrita Resorts', 'A right to plan your family day out', 'http://book4holiday.com/beta/resorts/Alankrita-Resorts/2', '0000-00-00', '1', '2016-08-12 02:14:46', 'admin', '2016-08-12 09:27:58', 'admin', '4.jpg'),
(3, 'Zoo', 'Nehru Zoo Park', 'A right to plan your family day out', 'http://book4holiday.com/beta/resorts-details/Nehru-Zoo-Logical-Park/1', '0000-00-00', '1', '2016-08-12 09:29:10', 'admin', '2016-08-12 09:31:09', 'admin', '10.jpg'),
(4, 'Slider4', 'Title', 'Subtitle', '#', '2016-08-12', '1', '2016-08-12 10:52:31', 'admin', NULL, NULL, '8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblsms_template`
--

CREATE TABLE IF NOT EXISTS `tblsms_template` (
  `tempid` int(10) unsigned NOT NULL,
  `temptype` varchar(45) DEFAULT NULL,
  `tempname` varchar(45) DEFAULT NULL,
  `temptext` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`tempid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblstates`
--

CREATE TABLE IF NOT EXISTS `tblstates` (
  `stateid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `statename` varchar(45) DEFAULT NULL,
  `countryid` int(11) unsigned DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`stateid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbltransactions`
--

CREATE TABLE IF NOT EXISTS `tbltransactions` (
  `tid` int(10) NOT NULL AUTO_INCREMENT,
  `transactiondate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vendorid` int(10) NOT NULL,
  `amountreceived` decimal(10,2) DEFAULT NULL,
  `servicecharges` decimal(10,2) DEFAULT NULL,
  `amountpaid` decimal(10,2) DEFAULT NULL,
  `balance` decimal(10,2) DEFAULT NULL,
  `kidsmealamountrecieved` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbltransactions`
--

INSERT INTO `tbltransactions` (`tid`, `transactiondate`, `vendorid`, `amountreceived`, `servicecharges`, `amountpaid`, `balance`, `kidsmealamountrecieved`) VALUES
(1, '2016-10-05 17:00:16', 24, '5.50', '0.07', NULL, '5.50', '0.00'),
(2, '2016-10-05 17:25:51', 24, '5.50', '0.07', NULL, '11.00', '0.00'),
(3, '2016-10-05 18:22:10', 24, '5.50', '0.07', NULL, '16.50', '0.00'),
(4, '2016-10-05 18:52:06', 24, '5.50', '0.07', NULL, '22.00', '0.00'),
(5, '2016-10-05 18:55:12', 24, '5.00', '0.57', NULL, '27.00', '0.00'),
(6, '2016-10-05 00:00:00', 24, '0.00', '0.00', '5.00', '22.00', NULL),
(7, '2016-10-05 22:03:17', 24, '5.57', NULL, NULL, '27.57', NULL),
(8, '2016-10-06 12:28:50', 24, '5.50', '0.07', NULL, '33.07', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE IF NOT EXISTS `tblusers` (
  `userid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vendorid` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` longtext,
  `department` varchar(45) DEFAULT NULL,
  `designation` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `status` int(10) unsigned DEFAULT NULL,
  `usertype` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`userid`, `vendorid`, `username`, `password`, `department`, `designation`, `email`, `mobile`, `status`, `usertype`) VALUES
(1, 0, 'admin', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', '', '', '', '', 1, 'admin'),
(2, 24, 'abc', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'Booking', 'Booking', 'booking@hydzoo.com', '1234567890', 1, 'booking'),
(3, 24, 'xyz', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'security', 'security', 'security@hydzoo.com', '1234567890', 1, 'security'),
(4, 3, 'def', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'booking', 'booking', 'booking@leonia.com', '1234567890', 1, 'booking'),
(5, 3, 'ghi', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'security', 'security', 'security@leonia.com', '1234567890', 1, 'security');

-- --------------------------------------------------------

--
-- Table structure for table `tblvendorpayments`
--

CREATE TABLE IF NOT EXISTS `tblvendorpayments` (
  `vpid` int(10) NOT NULL AUTO_INCREMENT,
  `paymentdate` date DEFAULT NULL,
  `vendorid` int(10) NOT NULL,
  `paymenttype` varchar(25) NOT NULL,
  `transactiondate` date DEFAULT NULL,
  `transactionnumber` varchar(75) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `insertedby` varchar(45) NOT NULL,
  `insertedon` datetime NOT NULL,
  PRIMARY KEY (`vpid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tblvendorpayments`
--

INSERT INTO `tblvendorpayments` (`vpid`, `paymentdate`, `vendorid`, `paymenttype`, `transactiondate`, `transactionnumber`, `amount`, `insertedby`, `insertedon`) VALUES
(1, NULL, 24, 'cash', NULL, NULL, '5.00', 'admin', '2016-10-05 08:42:14');

-- --------------------------------------------------------

--
-- Table structure for table `tblvendorphotos`
--

CREATE TABLE IF NOT EXISTS `tblvendorphotos` (
  `vphotoid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vendorid` int(10) unsigned DEFAULT NULL,
  `photoname` varchar(45) DEFAULT NULL,
  `path` varchar(150) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`vphotoid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblvendors`
--

CREATE TABLE IF NOT EXISTS `tblvendors` (
  `vendorid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vendorname` varchar(45) DEFAULT NULL,
  `password` varchar(150) NOT NULL,
  `contact_person` varchar(45) DEFAULT NULL,
  `Address1` longtext,
  `Address2` longtext,
  `city` varchar(45) DEFAULT NULL,
  `pincode` varchar(45) DEFAULT NULL,
  `landline` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `website` longtext,
  `createdon` datetime DEFAULT NULL,
  `updateon` datetime DEFAULT NULL,
  `status` int(10) unsigned DEFAULT NULL COMMENT '1:valid,0:invalid;',
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  `vendorlogo` varchar(150) DEFAULT NULL,
  `description` longtext,
  `bookingtype` varchar(60) NOT NULL,
  `kidsmealprice` int(10) NOT NULL,
  PRIMARY KEY (`vendorid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `tblvendors`
--

INSERT INTO `tblvendors` (`vendorid`, `vendorname`, `password`, `contact_person`, `Address1`, `Address2`, `city`, `pincode`, `landline`, `mobile`, `email`, `website`, `createdon`, `updateon`, `status`, `latitude`, `longitude`, `vendorlogo`, `description`, `bookingtype`, `kidsmealprice`) VALUES
(2, 'Alankrita Resorts', '123456', 'Suresh Babu', 'Shamirpet, NH 8', '', 'Hyderabad', '500064', '09014138751', '9885754456', 'sharma@gmail.com', '', '2016-08-19 03:21:19', '2016-08-19 03:21:19', 0, '0', '0', NULL, 'Aalankrita is the famous Hyderabad resort situated in Shamirpet, a man-made vision created in complete harmony with the panoramic beauty of Nature. From the moment you arrive, you’ll be taken in by its breathtaking landscaping and scenery, blended in the pleasure and luxury of a 4 star resort. The delight of being here will be further buoyed by detailed architecture and rich interiors complementing the resort’s ethnic theme, ensuring that the truly enlivening experience will stay long in your memory.', 'singlecheckout', 0),
(24, 'Nehru Zoological Park', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'Mr Narendar', 'Bahadurpura', '', 'Telangana, Hyderabad', '500064', '', '0123456789', 'hydzoo@gmail.com', '', '2016-08-21 01:24:05', '2016-08-21 01:24:05', 1, '0', '0', NULL, 'Hyderabad Zoo', 'singlecheckout', 0),
(25, 'Book4Holiday', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'Narendar', 'Madhapur', '', 'Hydearbad', '500080', '', '0123456789', 'info@book4holiday.com', '', '2016-08-21 01:40:26', '2016-08-21 01:40:26', 1, '0', '0', NULL, 'Book4Holiday is a market place portal providing services to sell event and resort tickets online.', 'singlecheckout', 0),
(26, 'Lahari Resorts', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'Lahari Resorts', 'Bhanoor, Near Patancheru,', '', 'Hyderabad', '502305', '', '0123456789', 'info@lahariresorts.com', '', '2016-08-21 02:15:34', '2016-08-21 02:15:34', 1, '0', '0', NULL, 'Lahari Resort, a budget property is ideal for holidaying with friends and family and also for leisure cum business trip. The hotel is located at a distance of 53.7 km from Hyderabad International Airport, 20.6 km from Chandanagar Railway Station and 44.1 km from Shapur Nagar Bus Stand. The hotel is in proximity to various tourist places like Chilkur Balaji Temple, Sri Ramakrishna Math, Nehru Zoological Park, KBR National Park, Buddha Statue and many more. ', 'singlecheckout', 0),
(27, 'Honey Berg Resort', '123456', 'Honey Berg Resort', 'Muraharipalli Village, Near Genome Valley, Medchal Mandal, Ranga Reddy , ', '', 'Hyderabad', '500016', '', '0123456789', 'info@honeyberg.com', '', '2016-08-21 02:24:07', '2016-08-21 02:24:07', 1, '0', '0', NULL, 'Suchirindia Hotels & Resorts (P) Limited was set up by Suchirindia Group to foray into the hospitality sector. Resorts, Clubs, Theme Parks and other entertainment centers are being set up, initially in and around Hyderabad, major towns of Andhra Pradesh, metro cities in India and in due course overseas. Honey Berg is a 40,000 sq.ft, 3 Star boutique retreat located near Genome Valley, Shamirpet, Hyderabad. The highlighting factor of the resort is its architectural design which, while retaining the rocky terrain, seamlessly blends in with the surroundings. The magnificent glass façades and the rumbling waterfalls give it a distinct appearance and add substantially to the final panorama.The highlighting factor of the resort is its architectural design which, while retaining the rocky terrain, seamlessly blends in with the surroundings. The magnificent glass façades and the rumbling waterfalls give it a distinct appearance and add substantially to the final panorama.', 'singlecheckout', 0),
(28, 'Summer Green Resort', '123456', 'Summer Green Resort', 'Survey No. 90/A, 111, 112/A, 112B, Thumkunta Village, ', '', 'Survey No. 90/A, 111, 112/A, 112B, Thumkunta ', '500078', '', '0123456789', 'summer@gmail.com', '', '2016-08-21 02:31:54', '2016-08-21 02:31:54', 1, '0', '0', NULL, 'Summer Green plays perfect host as a gateway destination for families, friends or colleagues. The picturesque greenery, great ambiance & sprawling lawns are ideal for hosting weddings, birthday parties, family functions, Get-together’s, corporate seminars & launches.', 'singlecheckout', 0),
(32, 'abcd', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'abc', 'Hyderabad', 'Hyderabad', 'hyderabad', '500004', '040123456', '1234567890', 'abc@gmail.com', 'www.google.com', '2016-08-26 03:26:13', '2016-08-26 03:26:13', 1, '0', '0', NULL, 'asdsad', 'singlecheckout', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
