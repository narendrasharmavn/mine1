-- phpMyAdmin SQL Dump
-- version 4.0.10.16
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 19, 2016 at 07:00 PM
-- Server version: 5.6.32
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `book4holiday`
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
  `resortoreventname` varchar(75) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `eventreviews`
--

INSERT INTO `eventreviews` (`rid`, `pricereview`, `subject`, `review`, `customerid`, `reviewgivendate`, `resortoreventname`, `status`) VALUES
(1, 5, 'Test Review', 'Test Review', 38, '2016-08-14 10:57:50', '2', 1),
(2, 5, 'Happy Independance Day', 'Happy Independance Day', 40, '2016-08-15 11:55:01', '1', 1),
(3, 5, 'Happy Independance Day1', 'Happy its working', 40, '2016-08-15 11:57:57', '1', 1),
(4, 3, '', 'k', 6, '2016-08-16 10:04:58', '2', 1),
(5, 5, '', 'k', 6, '2016-08-16 10:05:18', '2', 1),
(6, 3, 'happyweekend', 'it''Good', 6, '2016-08-18 08:25:56', '1', 1),
(7, 1, ''';;l', '22', 6, '2016-08-18 11:18:16', '1', 1),
(8, 3, 'hiii', 'GOOD', 2, '2016-08-19 12:20:18', '4', 1),
(9, 4, 'Good Event', 'A great event...', 3, '2016-08-19 18:39:46', '2', 1),
(10, 0, 'Not a good Event', 'I would not even rate this event.... not even worth to rate', 3, '2016-08-19 18:40:47', '2', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `placereviews`
--

INSERT INTO `placereviews` (`prid`, `pricereview`, `subject`, `review`, `customerid`, `reviewgivendate`, `placeid`, `status`) VALUES
(1, 5, 'Nice Place to see', 'Nice Place to see, anyone can plan a dayout', 40, '2016-08-15 11:58:49', 6, 1),
(2, 5, 'sdfsdf', 'sdfsdf', 45, '2016-08-17 15:17:24', 1, 1),
(3, 4, 'dfsdf', 'sdfsdf', 45, '2016-08-17 15:19:46', 1, 1),
(4, 5, '', 'ddd', 6, '2016-08-17 17:06:02', 1, 1),
(5, 4, 'Very Divine', 'Great temple to visit', 45, '2016-08-17 18:27:48', 4, 1),
(6, 4, 'Good Park', 'Good park to visit with kids', 45, '2016-08-17 18:29:05', 2, 1),
(7, 5, 'g0od', 'hi', 6, '2016-08-18 07:28:09', 9, 1),
(8, 3, 'nice', 'good', 6, '2016-08-18 08:35:12', 11, 1),
(9, 4, 'good', 'nice', 6, '2016-08-18 08:41:39', 3, 1),
(10, 5, 'fdd', 'excellent ', 6, '2016-08-18 08:52:24', 7, 1),
(11, 3, '', 'ghhgu', 6, '2016-08-18 08:52:39', 7, 1),
(12, 3, '', 'Super', 6, '2016-08-18 09:01:31', 8, 1),
(13, 1, '', 'good', 6, '2016-08-18 09:41:06', 6, 1),
(14, 3, 'good', 'good', 6, '2016-08-18 09:42:31', 5, 1),
(15, 3, 'good', 'good', 6, '2016-08-18 09:45:10', 10, 1),
(16, 3, '', 'Good fun', 6, '2016-08-18 10:17:31', 3, 1),
(17, 0, 'good', 'good', 6, '2016-08-19 08:04:25', 1, 1),
(18, 0, 'hii', 'good', 6, '2016-08-19 08:06:01', 11, 1),
(19, 4, 'Great Temple', 'very Divine temple to go', 3, '2016-08-19 18:47:20', 4, 1),
(20, 4, 'Nice Place', 'Good place to hangout with Family', 3, '2016-08-19 18:49:54', 13, 1),
(21, 3, '   ', 'test this', 3, '2016-08-19 18:50:44', 3, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `resortreviews`
--

INSERT INTO `resortreviews` (`rrid`, `pricereview`, `subject`, `review`, `customerid`, `reviewgivendate`, `resortname`, `status`) VALUES
(1, 5, 'Superrb', 'Excellent', 38, '2016-08-14 10:50:17', '2', 1),
(2, 5, 'sdfsd', 'dfdfdf', 38, '2016-08-14 10:50:50', '1', 1),
(3, 5, 'test', 'test', 38, '2016-08-14 10:52:12', '2', 1),
(4, 5, 'Super', 'Excellent', 38, '2016-08-14 10:53:08', '2', 1),
(5, 5, 'Happy Independance Day', 'Happy Independance Day', 40, '2016-08-15 11:49:51', '1', 1),
(6, 5, 'good for kids', 'Kids will enjoy a lot', 40, '2016-08-15 11:59:34', '1', 1),
(7, 5, 'kkl', 'ok', 6, '2016-08-16 10:13:21', '1', 1),
(8, 5, 'sdfsdf', 'sdfsdf', 45, '2016-08-17 14:49:29', '1', 1),
(9, 5, 'Review Working', 'Review Working', 45, '2016-08-17 14:50:27', '1', 1),
(10, 4, 'I love it', 'Really', 45, '2016-08-17 15:11:06', '1', 1),
(11, 3, 'super', 'supte', 45, '2016-08-17 15:11:21', '1', 1),
(12, 3, 'test', 'test', 45, '2016-08-17 15:23:36', '1', 1),
(13, 3, '', 's', 6, '2016-08-17 16:53:06', '3', 1),
(14, 5, 'gg', 'f', 6, '2016-08-17 16:53:24', '3', 1),
(15, 5, '', 'hjh', 6, '2016-08-17 16:54:08', '1', 1),
(16, 5, '', 's', 6, '2016-08-17 17:22:30', '4', 1),
(17, 4, 'Good Resort', 'This is a good resort', 45, '2016-08-17 18:26:06', '2', 1),
(18, 2, 'nice', 'good', 6, '2016-08-18 08:11:40', '2', 1),
(19, 5, '', 'Good place\r\n', 6, '2016-08-18 09:48:57', '3', 1),
(20, 5, '', 'Good', 6, '2016-08-18 10:56:26', '1', 1),
(21, 3, '', '', 45, '2016-08-19 07:14:01', '3', 1),
(22, 3, '', '', 45, '2016-08-19 07:14:12', '3', 1),
(23, 0, 'nice', 'good', 6, '2016-08-19 07:55:19', '1', 1),
(24, 0, 'hiii', 'this is very nice', 2, '2016-08-19 12:06:02', '5', 1),
(25, 3, 'Hiii', 'good', 2, '2016-08-19 12:15:01', '7', 1),
(26, 5, 'nice', 'k', 2, '2016-08-19 12:36:11', '2', 1),
(27, 3, 'Good Place to visit', 'This is a good place to visit for fun', 3, '2016-08-19 18:28:18', '3', 1);

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
(1, 14, '0.50', '0.50', 0);

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
  PRIMARY KEY (`bookingid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=155 ;

--
-- Dumping data for table `tblbookings`
--

INSERT INTO `tblbookings` (`bookingid`, `bookingtypeid`, `date`, `dateofvisit`, `userid`, `quantity`, `amount`, `booking_status`, `payment_status`, `ticketnumber`, `packageid`, `visitorstatus`, `vendorid`, `childqty`, `kidsmealqty`) VALUES
(1, NULL, '2016-08-12', '2016-08-12', 1, 2, '70', 'pending', 'pending', '20160812025927000000', '1', 'absent', 1, 1, 0),
(2, NULL, '2016-08-12', '2016-08-13', 2, 1, '4349', 'pending', 'pending', '20160812030102000000', '2', 'absent', 3, 1, 0),
(3, NULL, '2016-08-12', '2016-08-12', 3, 1, '30', 'pending', 'pending', '20160812054240000000', '1', 'absent', 1, 0, 0),
(4, NULL, '2016-08-12', '2016-08-12', 4, 5, '17059.5', 'pending', 'pending', '20160812061247000000', '2', 'absent', 3, 2, 0),
(5, NULL, '2016-08-12', '2016-08-13', 5, 1, '4349', 'failed', 'failed', '20160812085056000000', '2', 'absent', 3, 1, 0),
(6, NULL, '2016-08-12', '2016-08-20', 6, 2, '80', 'pending', 'pending', '20160812090421000000', '1', 'absent', 1, 2, 0),
(7, NULL, '2016-08-12', '2016-08-20', 6, 2, '210', 'pending', 'pending', '20160812090421000000', '5', 'absent', 1, 2, 0),
(8, NULL, '0000-00-00', '2016-08-12', 8, 2, NULL, 'pending', 'pending', '20160812090948000000', '4', 'absent', 1, 0, 0),
(9, NULL, '2016-08-12', '2016-08-18', 6, 2, '60', 'pending', 'pending', '20160812091154000000', '1', 'absent', 1, 0, 0),
(10, NULL, '2016-08-12', '2016-08-18', 6, 2, '150', 'pending', 'pending', '20160812091154000000', '5', 'absent', 1, 0, 0),
(11, NULL, '2016-08-12', '2016-08-18', 6, 2, '80', 'pending', 'pending', '20160812091210000000', '1', 'absent', 1, 2, 0),
(12, NULL, '2016-08-12', '2016-08-18', 6, 2, '210', 'pending', 'pending', '20160812091210000000', '5', 'absent', 1, 2, 0),
(13, NULL, '2016-08-12', '2016-08-18', 6, 3, '120', 'pending', 'pending', '20160812091322000000', '1', 'absent', 1, 3, 0),
(14, NULL, '2016-08-12', '2016-08-18', 6, 2, '210', 'pending', 'pending', '20160812091322000000', '5', 'absent', 1, 2, 0),
(15, NULL, '2016-08-12', '2016-08-13', 6, 1, '40', 'pending', 'pending', '20160812092017000000', '1', 'absent', 1, 1, 0),
(16, NULL, '2016-08-12', '2016-08-13', 6, 1, '105', 'pending', 'pending', '20160812092017000000', '5', 'absent', 1, 1, 0),
(17, NULL, '2016-08-12', '2016-08-13', 6, 1, '40', 'pending', 'pending', '20160812092058000000', '1', 'absent', 1, 1, 0),
(18, NULL, '2016-08-12', '2016-08-13', 6, 0, '0', 'pending', 'pending', '20160812092058000000', '5', 'absent', 1, 0, 0),
(19, NULL, '0000-00-00', '2016-08-12', 9, 3, NULL, 'pending', 'pending', '20160812093945000000', '4', 'absent', 1, 0, 0),
(20, NULL, '0000-00-00', '2016-08-12', 10, 2, NULL, 'pending', 'pending', '20160813122620000000', '3', 'absent', 1, 2, 0),
(21, NULL, '2016-08-13', '2016-08-20', 11, 2, '6000', 'pending', 'pending', '20160813024059000000', '3', 'absent', 1, 2, 0),
(22, NULL, '2016-08-13', '2016-08-13', 12, 1, '44.6', 'pending', 'pending', '20160813104841000000', '1', 'absent', 1, 1, 0),
(23, NULL, '0000-00-00', '2016-08-19', 19, 2, NULL, 'pending', 'pending', '20160813023643000000', '4', 'absent', 1, 2, 0),
(24, NULL, '0000-00-00', '2016-08-13', 20, 2, NULL, 'pending', 'pending', '20160813040141000000', '4', 'absent', 1, 0, 0),
(25, NULL, '0000-00-00', '1970-01-01', 21, 6, NULL, 'pending', 'pending', '20160813055347000000', '1', 'absent', 1, 3, 0),
(26, NULL, '0000-00-00', '2016-08-13', 22, 3, NULL, 'pending', 'pending', '20160813061119000000', '4', 'absent', 1, 0, 0),
(27, NULL, '0000-00-00', '1970-01-01', 26, 1, NULL, 'pending', 'pending', '20160813061927000000', '1', 'absent', 1, 0, 0),
(28, NULL, '0000-00-00', '1970-01-01', 26, 1, NULL, 'pending', 'pending', '20160813062001000000', '1', 'absent', 1, 0, 0),
(29, NULL, '0000-00-00', '1970-01-01', 26, 1, NULL, 'pending', 'pending', '20160813062126000000', '1', 'absent', 1, 0, 0),
(30, NULL, '0000-00-00', '1970-01-01', 28, 1, NULL, 'pending', 'pending', '20160813062159000000', '1', 'absent', 1, 0, 0),
(31, NULL, '0000-00-00', '1970-01-01', 29, 6, NULL, 'pending', 'pending', '20160813062719000000', '1', 'absent', 1, 0, 0),
(32, NULL, '0000-00-00', '1970-01-01', 31, 1, NULL, 'pending', 'pending', '20160813111710000000', '1', 'absent', 1, 0, 0),
(33, NULL, '0000-00-00', '2016-08-19', 34, 1, NULL, 'pending', 'pending', '20160813112307000000', '3', 'absent', 1, 0, 0),
(34, NULL, '0000-00-00', '2016-08-13', 36, 1, NULL, 'pending', 'pending', '20160813112418000000', '4', 'absent', 1, 0, 0),
(35, NULL, '0000-00-00', '2016-08-13', 37, 2, NULL, 'pending', 'pending', '20160813112948000000', '4', 'absent', 1, 0, 0),
(36, NULL, '2016-08-15', '2016-08-16', 39, 1, '33.45', 'pending', 'pending', '20160815022913000000', '1', 'absent', 1, 0, 0),
(37, NULL, '2016-08-15', '2016-08-16', 40, 2, '10258', 'pending', 'pending', '20160815053430000000', '2', 'absent', 0, 3, 0),
(38, NULL, '2016-08-15', '2016-08-31', 40, 2, '89.2', 'booked', 'paid', '20160815053435000000', '1', 'absent', 1, 2, 0),
(39, NULL, '2016-08-15', '2016-08-16', 40, 1, '4348.5', 'booked', 'paid', '20160815055259000000', '2', 'absent', 0, 1, 0),
(40, NULL, '2016-08-16', '2016-08-18', 6, 2, '66.9', 'pending', 'pending', '20160816035502000000', '1', 'absent', 1, 0, 0),
(41, NULL, '2016-08-16', '2016-08-25', 6, 2, '66.9', 'pending', 'pending', '20160816040017000000', '1', 'absent', 1, 0, 0),
(42, NULL, '2016-08-16', '2016-08-18', 6, 1, '278.75', 'pending', 'pending', '20160816040357000000', '1', 'absent', 1, 2, 4),
(43, NULL, '2016-08-16', '2016-08-17', 6, 1, '89.2', 'pending', 'pending', '20160816040423000000', '1', 'absent', 1, 0, 1),
(44, NULL, '2016-08-16', '2016-08-17', 6, 1, '44.6', 'pending', 'pending', '20160816040500000000', '1', 'absent', 1, 1, 0),
(45, NULL, '2016-08-16', '2016-08-17', 6, 1, '55.75', 'pending', 'pending', '20160816040608000000', '1', 'absent', 1, 2, 0),
(46, NULL, '2016-08-16', '2016-08-17', 6, 1, '33.45', 'pending', 'pending', '20160816041121000000', '1', 'absent', 1, 0, 0),
(47, NULL, '2016-08-16', '2016-08-16', 6, 1, '44.6', 'pending', 'pending', '20160816041145000000', '1', 'absent', 1, 1, 0),
(48, NULL, '2016-08-16', '2021-04-15', 6, 3, '122.65', 'failed', 'failed', '20160816041217000000', '1', 'absent', 1, 2, 0),
(49, NULL, '2016-08-16', '2016-08-17', 43, 1, '30', 'failed', 'failed', '20160816061117000000', '1', 'absent', 1, 0, 0),
(50, NULL, '0000-00-00', '2016-08-08', 44, 5, NULL, 'pending', 'pending', '20160816072629000000', '4', 'absent', 1, 1, 0),
(51, NULL, '0000-00-00', '2016-08-01', 0, 0, NULL, 'pending', 'pending', '20160816073605000000', '2', 'absent', 3, 6, 0),
(52, NULL, '0000-00-00', '2016-08-01', 0, 0, NULL, 'pending', 'pending', '20160816073632000000', '2', 'absent', 3, 6, 0),
(53, NULL, '0000-00-00', '2016-08-01', 0, 0, NULL, 'pending', 'pending', '20160816073642000000', '2', 'absent', 3, 6, 0),
(54, NULL, '0000-00-00', '2016-08-01', 0, 0, NULL, 'pending', 'pending', '20160816073654000000', '2', 'absent', 3, 6, 0),
(55, NULL, '2016-08-17', '2016-08-25', 6, 0, '133.80', 'pending', 'pending', '20160817102131000000', '1', 'absent', 1, 2, 2),
(56, NULL, '2016-08-17', '2016-08-18', 6, 1, '390.26', 'pending', 'pending', '20160817102536000000', '4', 'absent', 1, 1, 0),
(57, NULL, '2016-08-17', '2016-08-18', 6, 2, '557.50', 'pending', 'pending', '20160817102608000000', '4', 'absent', 1, 1, 0),
(58, NULL, '2016-08-17', '2016-05-05', 6, 1, '44.60', 'pending', 'pending', '20160817103113000000', '1', 'absent', 1, 1, 0),
(59, NULL, '2016-08-17', '2016-02-24', 6, 2, '89.20', 'pending', 'pending', '20160817103300000000', '1', 'absent', 1, 2, 0),
(60, NULL, '2016-08-17', '2016-08-17', 6, 1, '390.26', 'pending', 'pending', '20160817105313000000', '4', 'absent', 1, 1, 0),
(61, NULL, '2016-08-17', '2016-08-18', 45, 2, '89.20', 'failed', 'failed', '20160817105834000000', '1', 'absent', 1, 2, 0),
(62, NULL, '2016-08-17', '2016-08-18', 45, 2, '89.20', 'failed', 'failed', '20160817110057000000', '1', 'absent', 1, 2, 0),
(63, NULL, '2016-08-17', '2016-08-18', 45, 1, '44.60', 'booked', 'paid', '20160817110331000000', '1', 'absent', 1, 1, 0),
(64, NULL, '2016-08-17', '2016-08-19', 45, 2, '256.46', 'failed', 'failed', '20160817110644000000', '1', 'absent', 1, 2, 3),
(65, NULL, '2016-08-17', '2016-08-18', 45, 2, '557.50', 'pending', 'pending', '20160817114657000000', '4', 'absent', 1, 1, 0),
(66, NULL, '2016-08-18', '2016-08-26', 0, 2, '200.70', 'pending', 'pending', '20160818121000000000', '1', 'absent', 1, 2, 2),
(67, NULL, '2016-08-18', '2016-08-19', 0, 1, '100.36', 'booked', 'paid', '20160818121927000000', '1', 'visited', 1, 1, 1),
(68, NULL, '2016-08-18', '2016-08-27', 6, 2, '256.46', 'booked', 'paid', '20160818125937000000', '1', 'absent', 1, 2, 3),
(69, NULL, '2016-08-18', '2016-08-18', 6, 2, '100.36', 'pending', 'pending', '20160818020519000000', '1', 'absent', 1, 3, 0),
(70, NULL, '2016-08-18', '2016-08-20', 6, 1, '44.60', 'pending', 'pending', '20160818032257000000', '1', 'absent', 1, 1, 0),
(71, NULL, '2016-08-18', '2016-08-19', 6, 1, '44.60', 'booked', 'paid', '20160818032438000000', '1', 'absent', 1, 1, 0),
(72, NULL, '2016-08-18', '2016-08-26', 6, 1, '44.60', 'pending', 'pending', '20160818033643000000', '1', 'absent', 1, 1, 0),
(73, NULL, '2016-08-18', '2015-08-20', 6, 0, '78.06', 'pending', 'pending', '20160818035006000000', '1', 'absent', 1, 2, 1),
(74, NULL, '2016-08-18', '2014-08-20', 6, 0, '11.16', 'pending', 'pending', '20160818035035000000', '1', 'absent', 1, 1, 0),
(75, NULL, '2016-08-18', '1970-01-01', 6, 1, '33.46', 'pending', 'pending', '20160818035203000000', '1', 'absent', 1, 0, 0),
(76, NULL, '2016-08-18', '1970-01-01', 6, 0, '11.16', 'booked', 'paid', '20160818035301000000', '1', 'absent', 1, 1, 0),
(77, NULL, '2016-08-18', '2016-08-19', 6, 0, '66.90', 'pending', 'pending', '20160818041509000000', '1', 'absent', 1, 1, 1),
(78, NULL, '2016-08-18', '2016-08-15', 6, 2, '78.06', 'pending', 'pending', '20160818041622000000', '1', 'absent', 1, 1, 0),
(79, NULL, '2016-08-18', '2016-08-15', 6, 2, '78.06', 'booked', 'paid', '20160818042754000000', '1', 'absent', 1, 1, 0),
(80, NULL, '2016-08-18', '2016-08-18', 6, 2, '133.80', 'pending', 'pending', '20160818051531000000', '1', 'absent', 1, 1, 1),
(81, NULL, '2016-08-18', '2016-08-15', 6, 2, '133.80', 'pending', 'pending', '20160818051901000000', '1', 'absent', 1, 1, 1),
(82, NULL, '2016-08-18', '2016-08-15', 6, 2, '133.80', 'pending', 'pending', '20160818052124000000', '1', 'absent', 1, 1, 1),
(83, NULL, '2016-08-18', '2016-08-24', 0, 0, '11.16', 'pending', 'pending', '20160818052406000000', '1', 'absent', 1, 1, 0),
(84, NULL, '2016-08-18', '2016-08-19', 6, 1, '33.46', 'booked', 'paid', '20160818060616000000', '1', 'absent', 1, 0, 0),
(85, NULL, '2016-08-19', '2016-08-24', 0, 3, '133.80', 'booked', 'paid', '20160819015324000000', '1', 'absent', 1, 3, 0),
(86, NULL, '2016-08-19', '2016-08-24', 0, 2, '200.70', 'pending', 'pending', '20160819031034000000', '1', 'absent', 1, 2, 2),
(87, NULL, '2016-08-19', '2016-08-25', 2, 1, '33.43', 'pending', 'pending', '20160819045749000000', '1', 'absent', 1, 0, 0),
(88, NULL, '2016-08-19', '2016-08-25', 2, 1, '33.43', 'pending', 'pending', '20160819045749000000', '1', 'absent', 1, 0, 0),
(89, NULL, '2016-08-19', '2016-08-25', 2, 1, '33.43', 'pending', 'pending', '20160819045750000000', '1', 'absent', 1, 0, 0),
(90, NULL, '2016-08-19', '2016-08-25', 2, 1, '33.43', 'pending', 'pending', '20160819045750000000', '1', 'absent', 1, 0, 0),
(91, NULL, '2016-08-19', '2016-08-25', 2, 1, '33.43', 'pending', 'pending', '20160819045921000000', '1', 'absent', 1, 0, 0),
(92, NULL, '2016-08-19', '2016-08-25', 2, 1, '33.43', 'pending', 'pending', '20160819045922000000', '1', 'absent', 1, 0, 0),
(93, NULL, '2016-08-19', '2016-08-25', 2, 1, '33.43', 'pending', 'pending', '20160819045955000000', '1', 'absent', 1, 0, 0),
(94, NULL, '2016-08-19', '2016-08-25', 2, 1, '33.43', 'pending', 'pending', '20160819050035000000', '1', 'absent', 1, 0, 0),
(95, NULL, '2016-08-19', '2016-08-25', 2, 1, '33.43', 'pending', 'pending', '20160819050036000000', '1', 'absent', 1, 0, 0),
(96, NULL, '2016-08-19', '2016-08-25', 2, 1, '33.43', 'pending', 'pending', '20160819050036000000', '1', 'absent', 1, 0, 0),
(97, NULL, '2016-08-19', '2016-08-25', 2, 1, '33.43', 'pending', 'pending', '20160819050036000000', '1', 'absent', 1, 0, 0),
(98, NULL, '2016-08-19', '2016-08-25', 2, 1, '33.43', 'pending', 'pending', '20160819050052000000', '1', 'absent', 1, 0, 0),
(99, NULL, '2016-08-19', '2016-08-25', 2, 1, '33.43', 'pending', 'pending', '20160819050112000000', '1', 'absent', 1, 0, 0),
(100, NULL, '2016-08-19', '2016-08-25', 2, 1, '33.43', 'pending', 'pending', '20160819050112000000', '1', 'absent', 1, 0, 0),
(101, NULL, '2016-08-19', '2016-08-25', 2, 1, '33.43', 'pending', 'pending', '20160819050213000000', '1', 'absent', 1, 0, 0),
(102, NULL, '2016-08-19', '2016-08-25', 2, 1, '33.43', 'pending', 'pending', '20160819050219000000', '1', 'absent', 1, 0, 0),
(103, NULL, '2016-08-19', '2016-08-25', 1, 2, '77.99', 'pending', 'pending', '20160819050322000000', '1', 'absent', 1, 1, 0),
(104, NULL, '2016-08-19', '2016-08-25', 2, 1, '33.43', 'pending', 'pending', '20160819050334000000', '1', 'absent', 1, 0, 0),
(105, NULL, '2016-08-19', '2016-08-20', 2, 1, '33.43', 'pending', 'pending', '20160819050837000000', '1', 'absent', 1, 0, 0),
(106, NULL, '2016-08-19', '2016-08-21', 2, 1, '33.43', 'pending', 'pending', '20160819051142000000', '1', 'absent', 1, 0, 0),
(107, NULL, '2016-08-19', '2016-08-25', 1, 2, '5013.00', 'pending', 'pending', '20160819051712000000', '3', 'absent', 1, 1, 0),
(108, NULL, '2016-08-19', '2016-08-25', 1, 2, '5013.00', 'pending', 'pending', '20160819051744000000', '3', 'absent', 1, 1, 0),
(109, NULL, '2016-08-19', '2016-08-20', 2, 0, '1671.00', 'pending', 'pending', '20160819051829000000', '3', 'absent', 1, 1, 0),
(110, NULL, '2016-08-19', '2016-08-20', 2, 1, '1671.00', 'pending', 'pending', '20160819052207000000', '3', 'absent', 1, 0, 0),
(111, NULL, '2016-08-19', '2016-08-20', 2, 1, '1671.00', 'failed', 'failed', '20160819052500000000', '3', 'absent', 1, 0, 0),
(112, NULL, '2016-08-19', '2016-08-20', 2, 1, '1671.00', 'pending', 'pending', '20160819052648000000', '3', 'absent', 1, 0, 0),
(113, NULL, '2016-08-19', '2016-08-20', 2, 1, '33.43', 'pending', 'pending', '20160819052746000000', '1', 'absent', 1, 0, 0),
(114, NULL, '2016-08-19', '2016-08-20', 2, 1, '33.43', 'pending', 'pending', '20160819052837000000', '1', 'absent', 1, 0, 0),
(115, NULL, '2016-08-19', '2016-08-26', 1, 2, '5013.00', 'booked', 'paid', '20160819053341000000', '3', 'absent', 1, 1, 0),
(116, NULL, '2016-08-19', '2016-08-20', 2, 1, '1671.00', 'pending', 'pending', '20160819055055000000', '3', 'absent', 1, 0, 0),
(117, NULL, '2016-08-19', '2016-08-20', 2, 1, '1671.00', 'booked', 'paid', '20160819055502000000', '3', 'absent', 1, 0, 0),
(118, NULL, '2016-08-19', '2016-08-21', 2, 0, '66.84', 'failed', 'failed', '20160819055756000000', '1', 'absent', 1, 1, 1),
(119, NULL, '2016-08-19', '2016-08-20', 2, 1, '33.43', 'booked', 'paid', '20160819060007000000', '1', 'absent', 1, 0, 0),
(120, NULL, '2016-08-19', '2016-08-20', 3, 2, '89.12', 'booked', 'paid', '20160819060424000000', '1', 'absent', 1, 2, 0),
(121, NULL, '2016-08-19', '2016-08-23', 2, 0, '10', 'pending', 'pending', '20160819061509000000', '1', 'absent', 1, 1, 0),
(122, NULL, '2016-08-19', '2016-08-23', 2, 0, '10', 'pending', 'pending', '20160819061511000000', '1', 'absent', 1, 1, 0),
(123, NULL, '2016-08-19', '2016-08-23', 2, 0, '10', 'pending', 'pending', '20160819061511000000', '1', 'absent', 1, 1, 0),
(124, NULL, '2016-08-19', '2016-08-23', 2, 0, '10', 'pending', 'pending', '20160819061512000000', '1', 'absent', 1, 1, 0),
(125, NULL, '2016-08-19', '2016-08-23', 2, 0, '10', 'pending', 'pending', '20160819061512000000', '1', 'absent', 1, 1, 0),
(126, NULL, '2016-08-19', '2016-08-23', 2, 0, '10', 'pending', 'pending', '20160819061528000000', '1', 'absent', 1, 1, 0),
(127, NULL, '2016-08-19', '2016-08-23', 2, 0, '10', 'pending', 'pending', '20160819061528000000', '1', 'absent', 1, 1, 0),
(128, NULL, '2016-08-19', '2016-08-23', 2, 0, '10', 'pending', 'pending', '20160819061528000000', '1', 'absent', 1, 1, 0),
(129, NULL, '2016-08-19', '2016-08-20', 2, 0, '11.15', 'booked', 'paid', '20160819061557000000', '1', 'absent', 1, 1, 0),
(130, NULL, '2016-08-19', '2016-08-20', 2, 0, '1671.00', 'booked', 'paid', '20160819061827000000', '3', 'absent', 1, 1, 0),
(131, NULL, '2016-08-19', '2016-08-22', 4, 1, '33.43', 'booked', 'paid', '20160819064213000000', '1', 'absent', 1, 0, 0),
(132, NULL, '2016-08-19', '2016-08-27', 5, 1, '30', 'pending', 'pending', '20160819064943000000', '1', 'absent', 1, 0, 0),
(133, NULL, '2016-08-19', '2016-08-27', 6, 1, '30', 'pending', 'pending', '20160819064944000000', '1', 'absent', 1, 0, 0),
(134, NULL, '2016-08-19', '2016-08-27', 7, 1, '30', 'pending', 'pending', '20160819064950000000', '1', 'absent', 1, 0, 0),
(135, NULL, '2016-08-19', '2016-08-27', 8, 1, '30', 'pending', 'pending', '20160819065011000000', '1', 'absent', 1, 0, 0),
(136, NULL, '2016-08-19', '2016-08-20', 9, 1, '44.56', 'booked', 'paid', '20160819065148000000', '1', 'absent', 1, 1, 0),
(137, NULL, '2016-08-19', '2016-08-25', 10, 1, '40', 'pending', 'pending', '20160819065256000000', '1', 'absent', 1, 1, 0),
(138, NULL, '2016-08-19', '2016-08-25', 11, 1, '40', 'pending', 'pending', '20160819065301000000', '1', 'absent', 1, 1, 0),
(139, NULL, '2016-08-19', '2016-08-27', 12, 1, '30', 'pending', 'pending', '20160819065304000000', '1', 'absent', 1, 0, 0),
(140, NULL, '2016-08-19', '2016-08-27', 13, 1, '30', 'pending', 'pending', '20160819065305000000', '1', 'absent', 1, 0, 0),
(141, NULL, '2016-08-19', '2016-08-27', 14, 1, '30', 'pending', 'pending', '20160819065305000000', '1', 'absent', 1, 0, 0),
(142, NULL, '2016-08-19', '2016-08-25', 15, 1, '40', 'pending', 'pending', '20160819070048000000', '1', 'absent', 1, 1, 0),
(143, NULL, '2016-08-19', '2016-08-25', 16, 1, '40', 'pending', 'pending', '20160819070626000000', '1', 'absent', 1, 1, 0),
(144, NULL, '2016-08-19', '2016-08-31', 1, 2, '70', 'pending', 'pending', '20160819070736000000', '1', 'absent', 1, 1, 0),
(145, NULL, '2016-08-19', '2016-08-31', 1, 2, '70', 'pending', 'pending', '20160819070855000000', '1', 'absent', 1, 1, 0),
(146, NULL, '2016-08-19', '2016-08-31', 1, 2, '70', 'pending', 'pending', '20160819070946000000', '1', 'absent', 1, 1, 0),
(147, NULL, '2016-08-19', '2016-08-25', 17, 2, '80', 'booked', 'paid', '20160819071448000000', '1', 'absent', 1, 2, 0),
(148, NULL, '2016-08-19', '2016-08-25', 18, 2, '77.99', 'booked', 'paid', '20160819071615000000', '1', 'absent', 1, 1, 0),
(149, NULL, '2016-08-19', '2016-08-31', 19, 2, '80', 'booked', 'paid', '20160819071741000000', '1', 'absent', 1, 2, 2),
(150, NULL, '2016-08-19', '2016-08-24', 20, 2, '5013.00', 'pending', 'pending', '20160819073122000000', '3', 'absent', 1, 1, 0),
(151, NULL, '2016-08-19', '2016-08-24', 21, 2, '5013.00', 'booked', 'paid', '20160819073207000000', '3', 'absent', 1, 1, 0),
(152, NULL, '2016-08-19', '2016-08-25', 22, 2, '200.52', 'booked', 'paid', '20160819073324000000', '1', 'absent', 1, 2, 2),
(153, NULL, '2016-08-20', '2016-08-31', 3, 2, '468.30', 'booked', 'paid', '20160820120229000000', '8', 'absent', 8, 1, 0),
(154, NULL, '2016-08-20', '2016-08-24', 3, 1, '3345.00', 'booked', 'paid', '20160820121316000000', '3', 'absent', 1, 1, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `tblcustomers`
--

INSERT INTO `tblcustomers` (`customer_id`, `name`, `username`, `password`, `number`, `dateofcreation`, `otp`, `regtype`) VALUES
(1, 'raju', 'raju@gmail.com', 'b0412597dcea813655574dc54a5b74967cf85317f0332a2591be7953a016f8de56200eb37d5ba593b1e4aa27cea5ca27100f94dccd5b04bae5cadd4454dba67d', '7893514850', '2016-08-19', '0', 'registration'),
(2, 'shobha', 'shobharani0906@gmail.com', '04ba96038186d31a224308dc2d79bda66d3584aa01086f7d7d8aa9d13eea08cdb221eee453ce63e3a6db9ccc0aaec709134cfcd6ce4a9c7749d727445f37b86b', '9603485530', '2016-08-19', '0', 'registration'),
(3, 'satish', 'sathi.satya@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', '8886922279', '2016-08-19', '0', 'registration'),
(4, 'anil', 'anil@gmail.com', '3eb81648686ce3b57459eaf4b568882c65f4fe447278d6b133b1178c3bb08ec28415d25211bad6089a601f4e4fe1948ae9466902ced48e17e03afe2053727d45', '9603485530', '2016-08-19', '0', 'Guest'),
(5, 'sravani', 'sravani90@gmail.com', '4d422a2e37e1f17a5e47fc584d6ce5911c2571c1ceeda269094fc36a31e3009d743b11c97d9d1545f0314835653c0feb69f0a1e28657beee19f9d4babc10a22c', '9603485530', '2016-08-19', '0', 'Guest'),
(6, 'sravani', 'sravani90@gmail.com', '2edfc1bfbbe1a0136ce51c229fb24f523bbd49044cef6b616b7bf21960cd3996c67daddfad9952d588f4402e9d97b4aefe03bcf62edacca65071e08e9ae4860c', '9603485530', '2016-08-19', '0', 'Guest'),
(7, 'sravani', 'sravani90@gmail.com', '12c188222a0b5eb8d73a6a02057c9be34e055065d013c55df3904347988b90a7053bf2d22649daeda488c10d2a89913ba36e0ebf6d0d9f5b8f0a757c4afc0d77', '9603485530', '2016-08-19', '0', 'Guest'),
(8, 'sravani', 'sravani90@gmail.com', 'c359f8afbed46168d1d8338fa665b8e9d0439a3bb0bbaf81e5b2df3f55626af3246e44142ef6592b765c1fceb70b1e8a96cd390cb93b734863de4e8fc5c929bb', '9603485530', '2016-08-19', '0', 'Guest'),
(9, 'narendra', 'narendra.sharma202007@gmail.com', '3d2130853e7dc2c82fc292a25ef9418d8bb785de660f8bc42b5256fde780ae33f474f8a48f94f983f8ab1f7175c8b89d9c74146398a12e88b16fd7406701314d', '9885754456', '2016-08-19', '0', 'Guest'),
(10, 'narendra', 'narendra.sharma202007@gmail.com', '9e8bc6f3721102c7a150ef990e568518c84e330f05de684ab700eb3686c10e3244bbed2fb77707e17cbd19115e82333bc7501d333f3ff97f4d9c9f0d473cc442', '9885754456', '2016-08-19', '0', 'Guest'),
(11, 'narendra', 'narendra.sharma202007@gmail.com', '88617f905789362e2aba12aa7f21361de13350697db4c0f2b0172f5a4663ae5252dbe6e0df046a2e3cd6a3ae8c9670d08975dea601a22605e10f22399abb4cd0', '9885754456', '2016-08-19', '0', 'Guest'),
(12, 'sravani', 'sravani90@gmail.com', 'a780dd460a1db103d6d9b69a204317d670ed8b668700d26e81d902d0c57724bd31d8243b6da72dd6fc55a4c4e6f66317e3b9b851ed2422c6c52307798f8243c2', '9603485530', '2016-08-19', '0', 'Guest'),
(13, 'sravani', 'sravani90@gmail.com', 'bc5656193033db4261ee0286ba52e894c161d89fb067571962c17e38deb7ceffa0d0f518930dc905894babbf38418190c01584d11c8d3aa102e4356cf62c2c4e', '9603485530', '2016-08-19', '0', 'Guest'),
(14, 'sravani', 'sravani90@gmail.com', '7dd6065f4290913511b100b561ec75217c1ba511a700f07494397fd12d8a1277b21e31a1f5902a6e39a7ae82ce9fb3556773a938142c6e74b28c4b87814f6036', '9603485530', '2016-08-19', '0', 'Guest'),
(15, 'narendra', 'narendra.sharma202007@gmail.com', '1f4027883f8326bc439aa072afc5c72b226f5148d39ca087c7309bbc19dc6ee48db0ade354116f488df49b0bdb3b2a784fe19ef5800199680146c5f482d543d8', '9885754456', '2016-08-19', '0', 'Guest'),
(16, 'narendra', 'narendra.sharma202007@gmail.com', '66959981673bcfe171b3b3507348b6463dc64a1d839e636802cb71486c69aa0ea684648d36b5a478428c47d3460e74877d4a0185a4fb32c46922cf1df9afa454', '9885754456', '2016-08-19', '0', 'Guest'),
(17, 'Tedx', 'sainikhil013@gmail.com', '3c40c40c945c0618a69f68b7e574fde146f49e47760eee9ea513d26ab2640b0b917ef873a10174882a05a9161a26fe43b5140fd0e4843c3a0515fe6d37558872', '7893514850', '2016-08-19', '0', 'Guest'),
(18, 'Tedx', 'sainikhil013@gmail.com', '26fda84809562d0644fe5c9305741726152ac1a69e292f75da447d5b3b3e2e6c988e59325e3db2289c42aaf7037e0b9583a73f0669a084b56612d7b95ef6089d', '7893514850', '2016-08-19', '0', 'Guest'),
(19, 'Tedx', 'sainikhil013@gmail.com', 'ea01e824588b4c8c682b448a1a5224d0b44c8f1e7410f05ec0a1bc0bf895a94f9d8edec1a1f4c554d5af5ab455b75f7656305f2e5ccf54c0ed897aa7fae2c3b6', '7893514850', '2016-08-19', '0', 'Guest'),
(20, 'Tedx', 'sainikhil013@gmail.com', 'f34ef4747418ed07f1d15eeb5f67284d6eb9f9441608f2400fdbb763ca63daaf55bfd8bc64e78d475585791d5a406a05c4317c449555b47c93bad444eb4081cb', '7893514850', '2016-08-19', '0', 'Guest'),
(21, 'Tedx', 'sainikhil013@gmail.com', '269eafc5968b792b4f52f20510c96fa81502a6cbf8bbee86b3fa9c10dcdb99d959288e88818bc64e313cef0c7313ec8b3c575fcaaee31627d4d008673f318e1c', '7893514850', '2016-08-19', '0', 'Guest'),
(22, 'Tedx', 'sainikhil013@gmail.com', 'aa2cf8a6608277e735dd61c44541a1c2c949cb0673d8bee9c836d4cfe55f4bc24c4882ca8c0b8ea736396a9fb0e76cd717f0b8ce821a6102ccb157b0d4fb9dd1', '7893514850', '2016-08-19', '0', 'Guest');

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
  `eventname` varchar(45) DEFAULT NULL,
  `description` longtext,
  `eventtype` varchar(45) DEFAULT NULL COMMENT 'free/paid',
  `cost` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  `bannerimage` longtext NOT NULL,
  `bannerimagepath` longtext NOT NULL,
  PRIMARY KEY (`eventid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tblevents`
--

INSERT INTO `tblevents` (`eventid`, `vendorid`, `todate`, `fromdate`, `location`, `totime`, `fromtime`, `eventname`, `description`, `eventtype`, `cost`, `status`, `latitude`, `longitude`, `bannerimage`, `bannerimagepath`) VALUES
(1, 3, '2016-08-31', '2016-08-12', 'Hyderabad', '02:01', '', 'Happy Weekend', 'Nestled in lush gardens, this upscale resort offers accommodation in a collection of cottages. The resort is 6 km from Shamirpet Lake and 7 km from the Koteshwar Swamy Temple', NULL, NULL, '1', '', '', 'Events01.jpg', '/home2/book4holiday/public_html/beta/assets/eventimages/'),
(2, 1, '2016-08-31', '2016-08-01', 'Hyderabad', '', '', 'Independance Celebrations', 'Independance Celebrations on Aug 15th Independance Celebrations on Aug 15thIndependance Celebrations on Aug 15th', '', NULL, '1', '', '', 'independenceday-web-banner2.jpg', 'D:/xamp/xamp/htdocs/bookserver/assets/eventimages/'),
(3, 2, '2016-02-12', '2016-03-10', 'Hyderabad.', '18:00', '16:20', 'klklk', 'iuiuiu', NULL, NULL, '1', '', '', 'bg1.jpg', '/var/www/html/beta/assets/eventimages/'),
(4, 2, '2016-09-04', '2016-09-02', 'Hyderabad.', '18:00', '16:00', 'vinayaka chavithi', 'vi', NULL, NULL, '1', '', '', '', ''),
(5, 8, '2016-08-26', '2016-08-19', 'sdfsdfsdf', '', '', 'sdfsdfs', 'sdfsdfdsf', NULL, NULL, '1', '', '', 'icon.png', ''),
(6, 10, '2016-09-20', '2016-08-21', 'Hyderabad', '08:00', '06:00', '5k Marathon', '5 kilometer marathon', NULL, NULL, '1', '', '', 'indira.jpg', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tblpackages`
--

INSERT INTO `tblpackages` (`packageid`, `resortid`, `packagename`, `description`, `status`, `createdby`, `createdon`, `updatedby`, `updatedon`, `servicetax`, `vendorid`, `packageimage`, `packagetags`, `packagetype`, `eventid`, `adultprice`, `childprice`, `kidsmealprice`, `expirydate`, `mobileadultqty`, `mobilechildqty`) VALUES
(1, 1, 'Entry Ticket', 'Entry ticket for Nehru Zoo Park. Each Ticket valid for Person Only                             ', '1', 'admin', '2016-08-12 11:51:01', 'admin', '2016-08-12 11:51:01', 10, 1, 'zoo-entry-gate3.jpg', '               ', 'daily', '', '30', '10', '50', '2016-08-31', 0, 0),
(2, 3, 'Independencce Day Celebrations', 'Offering an outdoor swimming pool, a fitness centre and a spa and wellness centre, Leonia Holistic Destination is located in Shamirpet.\r\n', '1', 'admin', '2016-08-12 12:21:44', 'admin', '2016-08-12 12:21:44', 10, 3, 'independenceday-web-banner.jpg', '', 'event', '1', '2500', '1400', '0', '2016-08-15', 0, 0),
(3, 4, 'Independencce Day Celebrations', 'sdfsdfsdf', '1', 'admin', '2016-08-17 11:13:14', 'admin', '2016-08-17 11:13:14', 10, 3, 'logo.png', 'test, test', 'event', '2', '1500', '1500', '0', '2016-08-31', 0, 0),
(6, 1, 'hjyg b', 'vjnbjmbnj', '1', '1', '2016-08-19 03:56:51', 'vendor', '2016-08-19 03:56:51', 0, 1, NULL, '265', 'onetime', NULL, '50', '30', '0', '2015-09-27', 0, 0),
(7, 3, 'sample', 'fghjhuj', '1', 'admin', '2016-08-19 06:28:08', 'admin', '2016-08-19 06:28:08', 5, 3, '', 'gdgfhgg', 'event', '1', '85', '21', '59', '2016-03-22', 0, 0),
(8, 7, 'sdfsdfsdf', 'sdfsfsdf', '1', 'admin', '2016-08-19 07:43:16', 'admin', '2016-08-19 07:43:16', 10, 8, 'puri-jagannath-temple-hyderabad-23077781.jpg', 'sdfsdf', 'event', '5', '150', '120', '150', '2016-08-30', 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `tblpayments`
--

INSERT INTO `tblpayments` (`paymentid`, `bookingid`, `customerid`, `packageid`, `totalcost`, `adultpriceperticket`, `childpriceperticket`, `kidsmealprice`, `numberofadults`, `numberofchildren`, `noofkidsmeal`, `servicetax`, `internetcharges`, `swachhbharath`, `krishkalyancess`, `ticketnumber`, `transaction_id`, `referenceno`, `transdate`, `amount`, `response`, `banktransaction`, `transactiondescription`, `authorizationcode`, `discriminator`, `cardnumber`, `billingphone`, `billingemail`, `udf9`, `mmp_txn`, `mer_txn`, `transactiontime`, `status`, `responsestatus`) VALUES
(1, '103', '1', 1, '77.99', '60.00', '10.00', '0.00', '2', '1', 0, '0.91', '7.00', '0.04', '0.04', '20160819050322000000', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-08-19 11:33:22', 'unpaid', '0'),
(2, '104', '2', 1, '33.43', '30.00', '0.00', '0.00', '1', '0', 0, '0.39', '3.00', '0.02', '0.02', '20160819050334000000', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-08-19 11:33:34', 'unpaid', '0'),
(3, '105', '2', 1, '33.43', '30.00', '0.00', '0.00', '1', '0', 0, '0.39', '3.00', '0.02', '0.02', '20160819050837000000', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-08-19 11:38:37', 'unpaid', '0'),
(4, '106', '2', 1, '33.43', '30.00', '0.00', '0.00', '1', '0', 0, '0.39', '3.00', '0.02', '0.02', '20160819051142000000', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-08-19 11:41:42', 'unpaid', '0'),
(5, '107', '1', 3, '5013.00', '3000.00', '1500.00', '0.00', '2', '1', 0, '58.50', '450.00', '2.25', '2.25', '20160819051712000000', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-08-19 11:47:12', 'unpaid', '0'),
(6, '108', '1', 3, '5013.00', '3000.00', '1500.00', '0.00', '2', '1', 0, '58.50', '450.00', '2.25', '2.25', '20160819051744000000', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-08-19 11:47:44', 'unpaid', '0'),
(7, '109', '2', 3, '1671.00', '0.00', '1500.00', '0.00', '0', '1', 0, '19.50', '150.00', '0.75', '0.75', '20160819051829000000', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-08-19 11:48:29', 'unpaid', '0'),
(8, '110', '2', 3, '1671.00', '1500.00', '0.00', '0.00', '1', '0', 0, '19.50', '150.00', '0.75', '0.75', '20160819052207000000', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-08-19 11:52:07', 'unpaid', '0'),
(9, '111', '2', 3, '1671.00', '1500.00', '0.00', '0.00', '1', '0', 0, '19.50', '150.00', '0.75', '0.75', '20160819052500000000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-08-19 11:55:00', 'failed', NULL),
(10, '112', '2', 3, '1671.00', '1500.00', '0.00', '0.00', '1', '0', 0, '19.50', '150.00', '0.75', '0.75', '20160819052648000000', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-08-19 11:56:48', 'unpaid', '0'),
(11, '113', '2', 1, '33.43', '30.00', '0.00', '0.00', '1', '0', 0, '0.39', '3.00', '0.02', '0.02', '20160819052746000000', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-08-19 11:57:46', 'unpaid', '0'),
(12, '114', '2', 1, '33.43', '30.00', '0.00', '0.00', '1', '0', 0, '0.39', '3.00', '0.02', '0.02', '20160819052837000000', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-08-19 11:58:37', 'unpaid', '0'),
(13, '115', '1', 3, '5013.00', '3000.00', '1500.00', '0.00', '2', '1', 0, '58.50', '450.00', '2.25', '2.25', '20160819053341000000', NULL, NULL, 'Fri Aug 19 17:34:21 IST 2016', '5013.00', NULL, '187833111', NULL, NULL, 'NB', 'null', '7893514850', 'raju@gmail.com', '', '18783311', '161431', '2016-08-19 12:03:41', 'paid', 'Ok'),
(14, '116', '2', 3, '1671.00', '1500.00', '0.00', '0.00', '1', '0', 0, '19.50', '150.00', '0.75', '0.75', '20160819055055000000', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-08-19 12:20:55', 'unpaid', '0'),
(15, '117', '2', 3, '1671.00', '1500.00', '0.00', '0.00', '1', '0', 0, '19.50', '150.00', '0.75', '0.75', '20160819055502000000', NULL, NULL, 'Fri Aug 19 17:55:37 IST 2016', '1671.00', NULL, '187833271', NULL, NULL, 'NB', 'null', '9603485530', 'shobharani0906@gmail.com', '', '18783327', '831297', '2016-08-19 12:25:02', 'paid', 'Ok'),
(16, '118', '2', 1, '66.84', '0.00', '10.00', '50.00', '0', '1', 1, '0.78', '6.00', '0.03', '0.03', '20160819055756000000', NULL, NULL, 'Fri Aug 19 17:58:35 IST 2016', '66.84', NULL, '187833291', NULL, NULL, 'NB', 'null', '9603485530', 'shobharani0906@gmail.com', '', '18783329', '761866', '2016-08-19 12:27:56', 'failed', 'F'),
(17, '119', '2', 1, '33.43', '30.00', '0.00', '0.00', '1', '0', 0, '0.39', '3.00', '0.02', '0.02', '20160819060007000000', NULL, NULL, 'Fri Aug 19 18:00:44 IST 2016', '33.43', NULL, '187833331', NULL, NULL, 'NB', 'null', '9603485530', 'shobharani0906@gmail.com', '', '18783333', '267378', '2016-08-19 12:30:07', 'paid', 'Ok'),
(18, '120', '3', 1, '89.12', '60.00', '20.00', '0.00', '2', '2', 0, '1.04', '8.00', '0.04', '0.04', '20160819060424000000', NULL, NULL, 'Fri Aug 19 18:05:10 IST 2016', '89.12', NULL, '187833391', NULL, NULL, 'NB', 'null', '8886922279', 'sathi.satya@gmail.com', '', '18783339', '684029', '2016-08-19 12:34:24', 'paid', 'Ok'),
(19, '129', '2', 1, '11.15', '0.00', '10.00', '0.00', '0', '1', 0, '0.13', '1.00', '0.01', '0.01', '20160819061557000000', NULL, NULL, 'Fri Aug 19 18:16:44 IST 2016', '11.15', NULL, '187833481', NULL, NULL, 'NB', 'null', '9603485530', 'shobharani0906@gmail.com', '', '18783348', '804908', '2016-08-19 12:45:57', 'paid', 'Ok'),
(20, '130', '2', 3, '1671.00', '0.00', '1500.00', '0.00', '0', '1', 0, '19.50', '150.00', '0.75', '0.75', '20160819061827000000', NULL, NULL, 'Fri Aug 19 18:19:23 IST 2016', '1671.00', NULL, '187833501', NULL, NULL, 'NB', 'null', '9603485530', 'hari6@gmail.com', '', '18783350', '749496', '2016-08-19 12:48:27', 'paid', 'Ok'),
(21, '131', '4', 1, '33.43', '30.00', '0.00', '0.00', '1', '0', 0, '0.39', NULL, NULL, NULL, '20160819064213000000', NULL, NULL, 'Fri Aug 19 18:43:53 IST 2016', '33.43', NULL, '187833591', NULL, NULL, 'NB', 'null', '9603485530', 'anil@gmail.com', '', '18783359', '153163', '2016-08-19 13:12:13', 'paid', 'Ok'),
(22, '136', '9', 1, '44.56', '30.00', '10.00', '0.00', '1', '1', 0, '0.52', NULL, NULL, NULL, '20160819065148000000', '0116232186002', NULL, 'Fri Aug 19 18:52:37 IST 2016', '44.56', NULL, '123123', 'Transction Success', '323232', 'CC', '555555XXXXXX4444', '9885754456', 'narendra.sharma202007@gmail.com', '', '18783363', '353532', '2016-08-19 13:21:48', 'paid', 'Ok'),
(23, NULL, '1', NULL, '77.99', NULL, NULL, '99.99', '2', '1', 0, '0.91', '7.00', '0.04', '0.04', '20160819070946000000', '20160819070946000000', NULL, '2016-08-19', '77.99', NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-08-19 13:39:46', 'unpaid', '0'),
(24, NULL, NULL, NULL, '89.12', NULL, NULL, '0.00', '2', '2', 0, '1.04', '8.00', '0.04', NULL, '20160819071448000000', NULL, NULL, 'Fri Aug 19 19:15:39 IST 2016', '89.12', NULL, '187833791', NULL, NULL, 'NB', 'null', '7893514850', 'sainikhil013@gmail.com', '', '18783379', '774770', '2016-08-19 13:44:48', 'paid', 'Ok'),
(25, '148', '18', 1, '77.99', '60.00', '10.00', '0.00', '2', '1', 0, '0.91', NULL, NULL, NULL, '20160819071615000000', NULL, NULL, 'Fri Aug 19 19:16:51 IST 2016', '77.99', NULL, '187833811', NULL, NULL, 'NB', 'null', '7893514850', 'sainikhil013@gmail.com', '', '18783381', '624910', '2016-08-19 13:46:15', 'paid', 'Ok'),
(26, NULL, NULL, NULL, '200.52', NULL, NULL, '100.00', '2', '2', 2, '2.34', '18.00', '0.09', NULL, '20160819071741000000', NULL, NULL, 'Fri Aug 19 19:18:15 IST 2016', '200.52', NULL, '187833841', NULL, NULL, 'NB', 'null', '7893514850', 'sainikhil013@gmail.com', '', '18783384', '820439', '2016-08-19 13:47:41', 'paid', 'Ok'),
(27, '150', '20', 3, '5013.00', '3000.00', '1500.00', '0.00', '2', '1', 0, '58.50', NULL, NULL, NULL, '20160819073122000000', NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '2016-08-19 14:01:22', 'unpaid', '0'),
(28, '151', '21', 3, '5013.00', '3000.00', '1500.00', '0.00', '2', '1', 0, '58.50', NULL, NULL, NULL, '20160819073207000000', NULL, NULL, 'Fri Aug 19 19:32:44 IST 2016', '5013.00', NULL, '187833941', NULL, NULL, 'NB', 'null', '7893514850', 'sainikhil013@gmail.com', '', '18783394', '963821', '2016-08-19 14:02:07', 'paid', 'Ok'),
(29, '152', '22', 1, '200.52', '60.00', '20.00', '100.00', '2', '2', 2, '2.34', NULL, NULL, NULL, '20160819073324000000', NULL, NULL, 'Fri Aug 19 19:33:59 IST 2016', '200.52', NULL, '187833981', NULL, NULL, 'NB', 'null', '7893514850', 'sainikhil013@gmail.com', '', '18783398', '651459', '2016-08-19 14:03:24', 'paid', 'Ok'),
(30, '153', '3', 8, '468.30', '300.00', '120.00', '0.00', '2', '1', 0, '5.88', '42.00', '0.21', '0.21', '20160820120229000000', NULL, NULL, 'Sat Aug 20 00:04:42 IST 2016', '468.30', NULL, '187834291', NULL, NULL, 'NB', 'null', '8886922279', 'sathi.satya@gmail.com', '', '18783429', '389609', '2016-08-19 18:32:29', 'paid', 'Ok'),
(31, '154', '3', 3, '3345.00', '1500.00', '1500.00', '0.00', '1', '1', 0, '42.00', '300.00', '1.50', '1.50', '20160820121316000000', NULL, NULL, 'Sat Aug 20 00:14:05 IST 2016', '3345.00', NULL, '187834301', NULL, NULL, 'NB', 'null', '8886922279', 'sathi.satya@gmail.com', '', '18783430', '175904', '2016-08-19 18:43:16', 'paid', 'Ok');

-- --------------------------------------------------------

--
-- Table structure for table `tblplaces`
--

CREATE TABLE IF NOT EXISTS `tblplaces` (
  `plid` int(10) NOT NULL AUTO_INCREMENT,
  `place` varchar(45) DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tblplaces`
--

INSERT INTO `tblplaces` (`plid`, `place`, `address`, `city`, `latitude`, `longitude`, `description`, `otherinfo`, `createdon`, `createdby`, `updatedon`, `updatedby`, `status`) VALUES
(1, 'Golconda Fort', 'Ibrahim Bagh, Hyderabad, Telangana 500008', 'hyderabad', '17.3836 ', '78.4015', 'Golkonda, also known as Golconda or Golla konda ("shepherd''s hill"), is a citadel and fort in Southern India and was the capital of the medieval sultanate of the Qutb Shahi dynasty (c.1518–1687), is situated 11 kilometres (6.8 mi) west of Hyderabad.', 'Historic', '2016-06-12 03:45:18', 'admin', '2016-06-12 06:03:58', 'admin', 1),
(2, 'Lumbini Park', 'Opposite Secretariat New Gate, Khairatabad, Hyderabad, Telangana 500004', 'Hyderabad', '17.410057', '78.473219', 'Lumbini Park is a small public, urban park of 7.5 acres (0.030 km2; 0.0117 sq mi) adjacent to Hussain Sagar in Hyderabad, India.', 'Fun place', '2016-06-12 06:07:49', 'admin', '2016-06-12 06:16:00', 'admin', 1),
(3, 'Prasads Imax', 'NTR Gardens, LIC Division P.O., Hyderabad, Telangana 500063', 'Hyderabad', '17.412864', '78.465915', 'Prasad''s is a centrally air conditioned multiplex of an area of 2,35,000 sq ft, housing an IMAX Movie Theatre, a five screen multiplex, food court, multinational fast food outlets, a gaming zone and a Shopping mall covering two levels of the complex.', 'fun,food', '2016-06-12 06:12:05', 'admin', '2016-06-12 06:16:48', 'admin', 1),
(4, 'Peddamma Temple', 'Hitech City Road, Jubilee Hills, Hyderabad, Telangana 500033', 'hyderabad', '17.4921 ', '78.4073', 'Peddamma temple is an Hindu temple located at Jubilee Hills in Hyderabad. It is very famous during the festive season of Bonaalu.', 'temple', '2016-06-12 06:15:00', 'admin', NULL, NULL, 1),
(5, 'Charminar', 'Hyderabad, Telangana 500002', 'Hyderabad', '17.362854', '78.474622', 'The Charminar, constructed in 1591 CE, is a monument and mosque located in Hyderabad, Telangana, India. The landmark has become a global icon of Hyderabad, listed among the most recognized structures of India.', '"One of the most beautiful historical place."', '2016-06-15 12:57:40', 'admin', NULL, NULL, 1),
(6, 'Hussain Sagar', '\r\nHussain Sagar, Hyderabad, Telangana', 'Hyderabad', '17.425906', '78.473744', 'Hussain Sagar is a lake in Hyderabad built by Hazrat Hussain Shah Wali in 1562, during the rule of Ibrahim Quli Qutub Shah. It is spread across an area of 5.7 square kilometers and is fed by River Musi.', 'Fun Place', '2016-06-15 01:02:17', 'admin', NULL, NULL, 1),
(7, 'Birla Mandir', 'Hill Fort Rd, Hyderabad, Telangana 500004', 'Hyderabad', '17.407363', '78.469146', 'Birla Mandir is a Hindu temple, built on a 280 feet high hillock called Naubath Pahad on a 13 acres plot. The construction took 10 years and was constructed in 1976 by Swami Ranganathananda of Ramakrishna Mission.', 'Imposing, hilltop Hindu temple built of white marble, with towers, shrines and interior carvings.', '2016-06-15 04:09:01', 'admin', NULL, NULL, 1),
(8, 'Taj Falaknuma Palace', 'Engine Bowli, Falaknuma, Hyderabad, Telangana 500053', 'Hyderabad', '17.332538', '78.466000', 'Set in a restored 19th-century palace overlooking the city, this luxe hotel is 2 km from Falaknuma train station and 4 km from the landmark 16th-century Charminar mosque.', '', '2016-06-15 04:12:27', 'admin', NULL, NULL, 1),
(9, 'NTR Gardens', 'NTR Marg, Central Secretariat, Khairatabad, Hyderabad, Telangana 500004', 'Hyderabad', '17.412586', '78.468763', 'NTR Gardens is a small public, urban park of 36 acres adjacent to Hussain Sagar lake in Hyderabad,', 'Urban park covering 34 acres, with family attractions, a restaurant, fountains & a Japanese garden.', '2016-06-15 04:18:09', 'admin', NULL, NULL, 1),
(10, 'Ramoji Film City', 'Anaspur Village, Hayathnagar Mandal, Hyderabad, Telangana 501512', 'Hyderabad', '17.255264', '78.680853', 'The Ramoji Film City in India is located in Hyderabad. At 2000 acres, it is the largest integrated film city in the world. ', 'The world''s largest film studio offering tours, live shows, on-site theme park and adventure zone.', '2016-06-15 04:21:04', 'admin', NULL, NULL, 1),
(11, 'Salar Jung Museum', 'Salar Jung Road, Darulshifa, Hyderabad, Telangana 500002', 'Hyderabad', '17.372418', '78.480291', 'The Salar Jung Museum is an art museum located at Darushifa, on the southern bank of the Musi river in the city of Hyderabad, Telangana, India. It is one of the three National Museums of India.', 'Former art collection of the Salar Jung family from around the world, now a museum.', '2016-06-15 04:23:16', 'admin', NULL, NULL, 1),
(13, 'Shilparamam', 'hitech city', 'Hyderabad', '', '', 'good', 'nice', '2016-08-19 05:15:00', 'admin', NULL, NULL, 1),
(14, 'Shri Jaganath Temple', 'Banjara Hills, Hyderabad, India', 'Hyderabad', '', '', 'The Jagannath Temple in Hyderabad, India is a modern temple built by the Odia community of the city of Hyderabad dedicated to the Hindu God Jagannath. The temple located near Banjara hills Road no.12 (twelve) in Hyderabad is famous for its annual Rathyatra festival attended by thousands of devotees.[1] Jagannath means Lord of the Universe. The temple which was constructed during 2009 recently lies in Center of Hyderabad City.', 'The Jagannath Temple in Hyderabad, India is a modern temple built by the Odia community of the city of Hyderabad dedicated to the Hindu God Jagannath. The temple located near Banjara hills Road no.12 (twelve) in Hyderabad is famous for its annual Rathyatra festival attended by thousands of devotees.[1] Jagannath means Lord of the Universe. The temple which was constructed during 2009 recently lies in Center of Hyderabad City.', '2016-08-19 06:39:36', 'admin', '2016-08-19 06:41:27', 'admin', 1),
(15, 'Kuntala Water Falls', 'Kuntala, Neredigonda mandal', 'Kuntala, Adilabad Dist', '', '', 'The water gushes through the rocks making its own path from a height of 147 feet and then splits in to multiple streams. While there are many scenic waterfalls, this one is really accessible. Climbing up further to reach to top of Kuntala falls may seem to be a good idea, but one has to be careful as it is too steep. To add adventure, tourists can enjoy trekking at the Kuntala waterfalls through big boulders for reaching the footsteps of the waterfalls. ', 'The extremely beautiful waterfall is a rare such destination in the country. The verdant and dense green forest around the waterfall makes it a natural habitat for bird species, reptiles, and many insects and hence serves as a nice adventurous location. The Narsimha Swamy temple located near the waterfall adds a spiritual touch to the beautiful location', '2016-08-19 06:56:41', 'admin', NULL, NULL, 1),
(16, 'Laknavaram Lake', 'Lakkavaram, Warangal Dist', 'Lakkavaram', '15.6995', '79.7947', 'Lakhnavaram Lake, located in Govindaraopet Mandal about 70 kilometers away from Warangal, is a trending picnic spot. The lake is an exceptional thing of beauty. The lake was formed by closing down three narrow valleys. Each valley is replaced with a short bund, and hills act as their natural barrier. The lake has been constructed by the rulers of the Kakatiya dynasty in 13th Century A.D. An added advantage is that the lake takes shelter in isolated surroundings and this makes your holiday very private.', 'The entire region seems bountiful with green crops and pleasant water resources. The Lakhnavaram Lake which hides itself amidst the hills was discovered during the Kakatiya reign and the rulers expanded it to grow as a source of irrigation. An added attraction to this mystic beauty is the suspension bridge. The hanging bridge takes you to the mini island in the lake. The authorities maintaining the lake also provide boat riding facility which will take you close to the most serene part of the lake.', '2016-08-19 09:24:16', 'admin', '2016-08-19 09:27:33', 'admin', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=132 ;

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
(113, 14, 'Jagannath_Temple_Hyderabad_18387.jpg', 'http://book4holiday.com/beta/assets/places/Jagannath_Temple_Hyderabad_18387.jpg', '1'),
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
(131, 13, 'kidsmeal.jpg', 'http://book4holiday.com/beta/assets/places/kidsmeal.jpg', '1');

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
  `resortname` varchar(45) DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tblresorts`
--

INSERT INTO `tblresorts` (`resortid`, `vendorid`, `resortname`, `location`, `description`, `createdby`, `createdon`, `updatedby`, `updatedon`, `status`, `latitude`, `longitude`, `bannerimage`, `bannerimagepath`) VALUES
(1, 1, 'Nehru Zoo Logical Park', 'Hyderabad.', '                                                                                 Nehru Zoological Park, Hyderabad is one of the first zoos in the Country to display the animals in open moated enclosures with no barriers in between the visitors and the animals. The zoo was established with this concept and was opened to public viewing on 06.10.1963. Since then the zoo kept on adding new facilities. The Lion Safari Park which was established in 1974 and Nocturnal Animal House established in the year 1982 were first of its kind in the country.\r\n\r\nAt Present this zoo is displaying animals belonging to 140 species numbering 1334. During this period this zoo received Common Marmosets, Spoon Bills from Alipore Zoo, Kolkata. Pig Tailed Macaque, Himalayan Black Bear, Leopard Cats from Sipahijala Zoo, Tripura and Mouse Deers from Sri Venkateshwara Zoological Park, Tirupati, 6 Nos of White backed Vultures from Sakkarbagh Zoo There are other animal exchange programmes belongs this Zoo and Patna & Mysore Zoos in the pipe line.\r\n\r\nDuring this period most of the animal enclosures and visitor facilities were revamped. Efforts were made to make the zoo a plastic free area, A Plastic regulation counter was opened at the entrance gate which provides paper bags in place of polythine bags. Additional booking counters, Visitors Shelters, resting areas were created for the visitors.\r\n\r\nThis Zoo is spread over an area of 380 acres and a visitor can''t see all the enclosures in one day on foot. Therefore bicycles were introduced in the zoo, and the visitors can hire these bicycles and can go around the zoo. This is helping the visitors in visiting the zoo completely.', 'narendra.sharma202007@gmail.com', '2016-08-12 11:44:29', 'vendor', '2016-08-19 03:11:32', '1', '17.3512764', '78.445263', 'Nehru-Zoological-Park-755021.jpg', ''),
(2, 2, 'Alankrita Resorts', 'Shamirpet', 'Nestled in lush gardens, this upscale resort offers accommodation in a collection of cottages. The resort is 6 km from Shamirpet Lake and 7 km from the Koteshwar Swamy Temple', 'sharma@gmail.com', '2016-08-12 11:57:51', NULL, NULL, '1', NULL, NULL, 'Aalankrita-BEV.jpg', '/home2/book4holiday/public_html/beta/assets/resortimages/'),
(3, 3, 'Holiday Place', 'Shamirpet', 'Nestled in lush gardens, this upscale resort offers accommodation in a collection of cottages. The resort is 6 km from Shamirpet Lake and 7 km from the Koteshwar Swamy Temple', 'leonia@gmail.com', '2016-08-12 12:02:08', 'admin', '2016-08-17 09:58:48', '1', '', '', '04.jpg', '/home2/book4holiday/public_html/beta/assets/resortimages/'),
(5, 3, 'Golkonda Resorts', 'Hyderabad.', 'ggghh', 'admin', '2016-08-19 03:23:12', NULL, NULL, '1', '', '', '', ''),
(7, 8, 'Fabhotel', 'vizag', 'stay comfortable', 'admin', '2016-08-19 05:40:24', 'admin', '2016-08-19 05:40:47', '1', '', '', '', ''),
(8, 9, 'papyrusport', 'Bangalore Highway,Thimmapur', 'Papyrus port is a one of its kind, Egyptian themed resort in the city of Hyderabad. Inspired by some of the most famous architectural wonders of Egypt - the pyramids and the sphinxes, the resort represents the rich cultural heritage and the legends of the Egyptian culture. A fun and exciting state-of-the-art activities and recreational equipment will keep you and your family happily occupied for hours. Our plethora of facilities include a restaurant, banquet Hall, Senet Room, Spa, Lawns, open air theatre, Rooms, Indoor & outdoor games, Beach cricket, beach bally ball grounds, sophisticated gym and swimming pool are sure to make your stay with us a memorable one.', 'admin', '2016-08-19 07:05:34', 'admin', '2016-08-19 07:40:53', '1', 'khkkjhkh', 'hghgjgj', 'Jagannath_Temple_Hyderabad_18387.jpg', ''),
(9, 10, 'Indirapark', 'Hyderabad', 'park', 'admin', '2016-08-19 09:51:14', NULL, NULL, '1', '', '', 'indira.jpg', '/var/www/html/beta/assets/resortimages/');

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
(3, 'Zoo', 'Nehru Zoo Park', 'A right to plan your family day out', '#', '0000-00-00', '1', '2016-08-12 09:29:10', 'admin', '2016-08-12 09:31:09', 'admin', '10.jpg'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tbltransactions`
--

INSERT INTO `tbltransactions` (`tid`, `transactiondate`, `vendorid`, `amountreceived`, `servicecharges`, `amountpaid`, `balance`, `kidsmealamountrecieved`) VALUES
(1, '2016-08-19 00:00:00', 1, '0.00', '0.00', '1500.00', '-1500.00', NULL),
(2, '2016-08-19 00:00:00', 2, '0.00', '0.00', '450.00', '-450.00', NULL),
(3, '2016-08-19 17:38:17', 1, '4954.50', '58.50', NULL, '3454.50', '0.00'),
(4, '2016-08-19 17:55:14', 1, '1651.50', '19.50', NULL, '5106.00', '0.00'),
(5, '2016-08-19 17:59:41', 1, '5013.00', NULL, NULL, '10119.00', '0.00'),
(6, '2016-08-19 18:00:22', 1, '33.04', '0.39', NULL, '10152.04', '0.00'),
(7, '2016-08-19 18:04:47', 1, '88.08', '1.04', NULL, '10240.12', '0.00'),
(8, '2016-08-19 18:16:21', 1, '11.02', '0.13', NULL, '10251.14', '0.00'),
(9, '2016-08-19 18:19:00', 1, '1651.50', '19.50', NULL, '11902.64', '0.00'),
(10, '2016-08-19 18:43:30', 1, '33.04', '0.39', NULL, '11935.68', '0.00'),
(11, '2016-08-19 18:52:16', 1, '44.04', '0.52', NULL, '11979.72', '0.00'),
(12, '2016-08-19 19:15:17', 1, '88.08', '1.04', NULL, '12067.80', '0.00'),
(13, '2016-08-19 19:16:29', 1, '77.08', '0.91', NULL, '12144.88', '0.00'),
(14, '2016-08-19 19:17:53', 1, '198.18', '2.34', NULL, '12343.06', '100.00'),
(15, '2016-08-19 19:32:22', 1, '4954.50', '58.50', NULL, '17297.56', '0.00'),
(16, '2016-08-19 19:33:37', 1, '198.18', '2.34', NULL, '17495.74', '100.00'),
(17, '2016-08-20 00:04:20', 8, '462.42', '5.88', NULL, '462.42', '0.00'),
(18, '2016-08-20 00:13:42', 1, '3303.00', '42.00', NULL, '20798.74', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE IF NOT EXISTS `tblusers` (
  `userid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `department` varchar(45) DEFAULT NULL,
  `designation` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `status` int(10) unsigned DEFAULT NULL,
  `usertype` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`userid`, `username`, `password`, `department`, `designation`, `email`, `mobile`, `status`, `usertype`) VALUES
(1, 'admin', 'admin', NULL, NULL, NULL, NULL, 1, 'admin');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tblvendorpayments`
--

INSERT INTO `tblvendorpayments` (`vpid`, `paymentdate`, `vendorid`, `paymenttype`, `transactiondate`, `transactionnumber`, `amount`, `insertedby`, `insertedon`) VALUES
(1, NULL, 1, 'cash', NULL, NULL, '1500.00', 'admin', '2016-08-19 05:28:48'),
(2, NULL, 2, 'cash', NULL, NULL, '450.00', 'admin', '2016-08-19 05:29:12');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `tblvendors`
--

INSERT INTO `tblvendors` (`vendorid`, `vendorname`, `password`, `contact_person`, `Address1`, `Address2`, `city`, `pincode`, `landline`, `mobile`, `email`, `website`, `createdon`, `updateon`, `status`, `latitude`, `longitude`, `vendorlogo`, `description`, `bookingtype`, `kidsmealprice`) VALUES
(1, 'Nehru Zoological Park', '123456', 'Curator', 'Hyderabad', 'Hitechcity', 'Hyderabad', '500064', '', '8121412298', 'narendra.sharma202007@gmail.com', '', '2016-08-17 09:18:05', '2016-08-17 09:18:05', 1, '0', '0', NULL, 'Nehru Zoological Park, Hyderabad is one of the first zoos in the Country to display the animals in open moated enclosures with no barriers in between the visitors and the animals. The zoo was established with this concept and was opened to public viewing on 06.10.1963. Since then the zoo kept on adding new facilities. The Lion Safari Park which was established in 1974 and Nocturnal Animal House established in the year 1982 were first of its kind in the country.\r\n\r\nAt Present this zoo is displaying animals belonging to 140 species numbering 1334. During this period this zoo received Common Marmosets, Spoon Bills from Alipore Zoo, Kolkata. Pig Tailed Macaque, Himalayan Black Bear, Leopard Cats from Sipahijala Zoo, Tripura and Mouse Deers from Sri Venkateshwara Zoological Park, Tirupati, 6 Nos of White backed Vultures from Sakkarbagh Zoo There are other animal exchange programmes belongs this Zoo and Patna & Mysore Zoos in the pipe line.\r\n\r\nDuring this period most of the animal enclosures and visitor facilities were revamped. Efforts were made to make the zoo a plastic free area, A Plastic regulation counter was opened at the entrance gate which provides paper bags in place of polythine bags. Additional booking counters, Visitors Shelters, resting areas were created for the visitors.\r\n\r\nThis Zoo is spread over an area of 380 acres and a visitor can''t see all the enclosures in one day on foot. Therefore bicycles were introduced in the zoo, and the visitors can hire these bicycles and can go around the zoo. This is helping the visitors in visiting the zoo completely.', 'singlecheckout', 50),
(2, 'Alankrita Resorts', '123456', 'Suresh Babu', 'Shamirpet, NH 8', '', 'Hyderabad', '500064', '09014138751', '9885754456', 'sharma@gmail.com', '', '2016-08-19 03:21:19', '2016-08-19 03:21:19', 1, '0', '0', NULL, 'Aalankrita is the famous Hyderabad resort situated in Shamirpet, a man-made vision created in complete harmony with the panoramic beauty of Nature. From the moment you arrive, you’ll be taken in by its breathtaking landscaping and scenery, blended in the pleasure and luxury of a 4 star resort. The delight of being here will be further buoyed by detailed architecture and rich interiors complementing the resort’s ethnic theme, ensuring that the truly enlivening experience will stay long in your memory.', 'singlecheckout', 0),
(3, 'Leonia.D', '123456', 'ramakrishna yendluri', 'Shamirpet, Hyderbad', '', 'Hyderabad', '500064', '040 2334569', '9885754457', 'leonia@gmail.com', '', '2016-08-19 03:20:28', '2016-08-19 03:20:28', 1, '0', '0', NULL, 'Nestled in lush gardens, this upscale resort offers accommodation in a collection of cottages. The resort is 6 km from Shamirpet Lake and 7 km from the Koteshwar Swamy Temple', 'singlecheckout', 50),
(8, 'navya', '1234567', 'shobha D', 'madhapur', 'sdfsdf', 'Hyderabad.', '', '', '9603485530', 'jahnavimuppidi434@gmail.com', '', '2016-08-19 07:40:12', '2016-08-19 07:40:12', 1, '0', '0', NULL, 'fcvvcb', 'singlecheckout', 10),
(9, 'Telangana Tourism', '123456', 'Satish', 'Hyderabad', '', 'Hyderabad', '500000072', '', '8886922279', 'sathi.satya@gmail.com', '', '2016-08-19 06:58:57', '2016-08-19 06:58:57', 1, '0', '0', NULL, 'Tourism', 'singlecheckout', 0),
(10, 'GHMC', '123456', 'ravi', 'GHMC, Saifabad, hyderabad', '', 'Hyderabad', '50000001', '', '9889988912334444', 'ravi@ghmc.co.in', '', '2016-08-19 08:37:54', '2016-08-19 08:37:54', 1, '0', '0', NULL, 'Ven', 'singlecheckout', 0),
(11, 'GHMC1', '123456', 'Satish', 'Hyderabad', '', 'Hyderabad', '500007', '', '9999888899', 'sathi@gmail.com', '', '2016-08-19 09:43:24', '2016-08-19 09:43:24', 0, '0', '0', NULL, 'Tour Package', 'singlecheckout', 0),
(12, 'GHMC', '123456', 'Satish', 'hyd', '', 'Hyderabad', '500012', '', '9999888888', 'sathi1@gmail.com', '', '2016-08-19 09:46:52', '2016-08-19 09:46:52', 1, '0', '0', NULL, 'welcome', 'singlecheckout', 0),
(13, 'GHMC', '123456', 'Satish', 'hyd', '', 'Hyderabad', '500012', '', '9999888777', 'sathi22@gmail.com', '', '2016-08-19 09:48:22', '2016-08-19 09:48:22', 1, '0', '0', NULL, 'welcome', 'singlecheckout', 0),
(14, 'zxczxc', '123456', 'zxczx', 'zxczxc', 'zxc', 'zxczxc', '665656', '', '9885754456', 'sharma@gmail.com', '', '2016-08-19 10:23:00', '2016-08-19 10:23:00', 1, '0', '0', NULL, 'sdfsdfsdf', 'multicheckout', 10),
(15, 'sdfsdf', '123456', 'sdfsdf', 'sdfsdfsd', '', 'sdfsdfsdsdf', '565656', '', '9885754456', 'sharma@gmail.com', '', '2016-08-19 10:23:59', '2016-08-19 10:23:59', 1, '0', '0', NULL, 'sdfsdfsdf', 'multicheckout', 10),
(16, 'navee', '123456', 'asdfdsf', 'htddddd', '', 'hydddddd', '565656', '', '9885754456', 'sharma@gmail.com', '', '2016-08-19 10:28:43', '2016-08-19 10:28:43', 1, '0', '0', NULL, 'sdfsdfsdf', 'multicheckout', 60),
(17, 'navee', '123456', 'asdfdsf', 'htddddd', '', 'hydddddd', '565656', '', '9885754456', 'sharma@gmail.com', '', '2016-08-19 10:29:32', '2016-08-19 10:29:32', 1, '0', '0', NULL, 'sdfsdfsdf', 'multicheckout', 60),
(18, 'navee', '123456', 'asdfdsf', 'htddddd', '', 'hydddddd', '565656', '', '9885754456', 'sharma@gmail.com', '', '2016-08-19 10:30:01', '2016-08-19 10:30:01', 1, '0', '0', NULL, 'sdfsdfsdf', 'multicheckout', 60),
(19, 'New Vendor12345', '123456', 'dfsdfsdf', 'sdfsdfsdfsdfsd', '', 'sdfdgdgerterwe', '500067', '', '9885754456', 'sharma@gmail.com', '', '2016-08-20 12:00:07', '2016-08-20 12:00:07', 1, '0', '0', NULL, 'sdfsdfsdfsdfsdfdsf', 'singlecheckout', 0),
(20, 'New Vendor12345', '123456', 'dfsdfsdf', 'sdfsdfsdfsdfsd', '', 'sdfdgdgerterwe', '500067', '', '9885754456', 'sharma@gmail.com', '', '2016-08-20 12:00:26', '2016-08-20 12:00:26', 1, '0', '0', NULL, 'sdfsdfsdfsdfsdfdsf', 'singlecheckout', 0),
(21, 'New Vendor12345', '123456', 'dfsdfsdf', 'sdfsdfsdfsdfsd', '', 'sdfdgdgerterwe', '500067', '', '9885754456', 'sharma@gmail.com', '', '2016-08-20 12:00:29', '2016-08-20 12:00:29', 1, '0', '0', NULL, 'sdfsdfsdfsdfsdfdsf', 'singlecheckout', 0),
(22, 'New Vendor12345789', '123456', 'dfsdfsdf1234', 'sdfsdfsdfsdfsd', '', 'sdfdgdgerterwe1234', '500067', '', '9885754456', 'sharma@gmail.com', '123456', '2016-08-20 12:02:12', '2016-08-20 12:02:12', 1, '0', '0', NULL, 'sdfsdfsdfsdfsdfdsf', 'singlecheckout', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
