-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2016 at 08:08 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.5.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `holiday`
--

-- --------------------------------------------------------

--
-- Table structure for table `eventreviews`
--

CREATE TABLE `eventreviews` (
  `rid` int(10) NOT NULL,
  `pricereview` int(4) NOT NULL,
  `qualityreview` int(4) NOT NULL,
  `review` longtext NOT NULL,
  `customerid` int(10) NOT NULL,
  `reviewgivendate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `resortoreventname` varchar(75) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventreviews`
--

INSERT INTO `eventreviews` (`rid`, `pricereview`, `qualityreview`, `review`, `customerid`, `reviewgivendate`, `resortoreventname`, `status`) VALUES
(1, 1, 2, 'adfasd', 5, '2016-06-15 12:28:00', 'zoo', 0),
(2, 1, 2, 'adfasd', 5, '2016-06-15 12:28:10', 'zoo', 0),
(3, 3, 3, 'asdfad', 5, '2016-06-15 12:31:32', 'zoo', 0),
(4, 3, 3, 'asdfad', 5, '2016-06-15 12:31:57', 'zoo', 0),
(5, 2, 3, 'asdfad', 5, '2016-06-15 12:32:37', 'zoo', 0),
(6, 2, 3, 'asdfasdf', 5, '2016-06-15 12:38:02', 'zoo', 0),
(7, 3, 3, 'asdfsdfa', 5, '2016-06-15 12:39:14', 'The Tech Fest 2016', 0);

-- --------------------------------------------------------

--
-- Table structure for table `placereviews`
--

CREATE TABLE `placereviews` (
  `prid` int(10) NOT NULL,
  `pricereview` int(4) NOT NULL,
  `qualityreview` int(4) NOT NULL,
  `review` longtext NOT NULL,
  `customerid` int(10) NOT NULL,
  `reviewgivendate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `placeid` int(10) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '1:show,0:false'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `placereviews`
--

INSERT INTO `placereviews` (`prid`, `pricereview`, `qualityreview`, `review`, `customerid`, `reviewgivendate`, `placeid`, `status`) VALUES
(1, 3, 2, 'asfasdfasd', 5, '2016-06-15 12:55:34', 3, 0),
(2, 4, 4, 'asfasdfasd', 5, '2016-06-15 12:56:50', 3, 0),
(3, 4, 2, 'adsdghsgh asa sdf ', 5, '2016-06-15 12:57:29', 3, 0),
(4, 4, 2, 'adsdghsgh asa sdf ', 5, '2016-06-15 12:57:41', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `resortreviews`
--

CREATE TABLE `resortreviews` (
  `rrid` int(10) NOT NULL,
  `pricereview` int(4) NOT NULL,
  `qualityreview` int(4) NOT NULL,
  `review` int(4) NOT NULL,
  `customerid` int(10) NOT NULL,
  `reviewgivendate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `resortname` varchar(75) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `smssettings`
--

CREATE TABLE `smssettings` (
  `id` int(5) NOT NULL,
  `url` varchar(75) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `senderid` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smssettings`
--

INSERT INTO `smssettings` (`id`, `url`, `username`, `password`, `senderid`) VALUES
(1, 'http://smslogin.mobi/spanelv2/api.php?username=', 'adepto', 'adepto@123', 'ADEPTO');

-- --------------------------------------------------------

--
-- Table structure for table `tblbookings`
--

CREATE TABLE `tblbookings` (
  `bookingid` int(10) UNSIGNED NOT NULL,
  `bookingtype` varchar(45) NOT NULL,
  `bookingtypeid` int(10) UNSIGNED DEFAULT NULL,
  `date` date DEFAULT NULL,
  `dateofvisit` date NOT NULL,
  `userid` int(10) UNSIGNED DEFAULT NULL,
  `quantity` int(10) DEFAULT NULL,
  `amount` varchar(45) DEFAULT NULL,
  `booking_status` varchar(45) DEFAULT NULL,
  `payment_status` varchar(45) DEFAULT NULL,
  `ticketnumber` varchar(90) DEFAULT NULL,
  `packageid` varchar(45) DEFAULT NULL,
  `visitorstatus` varchar(45) DEFAULT NULL,
  `vendorid` int(10) NOT NULL,
  `childqty` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbookings`
--

INSERT INTO `tblbookings` (`bookingid`, `bookingtype`, `bookingtypeid`, `date`, `dateofvisit`, `userid`, `quantity`, `amount`, `booking_status`, `payment_status`, `ticketnumber`, `packageid`, `visitorstatus`, `vendorid`, `childqty`) VALUES
(22, '', NULL, '2016-06-13', '0000-00-00', 1, 1, '1320', 'booked', 'paid', '20160613065926', '6', 'absent', 2, 1),
(23, '', NULL, '2016-06-13', '0000-00-00', 1, 1, '20', 'booked', 'paid', '20160613072539', '8', 'absent', 3, 1),
(24, '', NULL, '2016-06-13', '0000-00-00', 1, 1, '1320', 'pending', 'pending', '20160613115347', '6', 'absent', 2, 1),
(25, '', NULL, '2016-06-18', '0000-00-00', 5, 1, '80', 'pending', 'pending', '20160618075907', '1', 'absent', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblcities`
--

CREATE TABLE `tblcities` (
  `cityid` int(10) UNSIGNED NOT NULL,
  `cityname` varchar(45) DEFAULT NULL,
  `stateid` int(10) UNSIGNED DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblcountries`
--

CREATE TABLE `tblcountries` (
  `countryid` int(10) UNSIGNED NOT NULL,
  `countryname` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomers`
--

CREATE TABLE `tblcustomers` (
  `customer_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` longtext,
  `number` varchar(45) DEFAULT NULL,
  `dateofcreation` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcustomers`
--

INSERT INTO `tblcustomers` (`customer_id`, `name`, `username`, `password`, `number`, `dateofcreation`) VALUES
(5, 'Tedx', 'sainikhil013@gmail.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', '7893514850', '2016-06-14');

-- --------------------------------------------------------

--
-- Table structure for table `tblemail_template`
--

CREATE TABLE `tblemail_template` (
  `etempid` int(10) UNSIGNED NOT NULL,
  `etemptype` varchar(45) DEFAULT NULL,
  `etempname` varchar(45) DEFAULT NULL,
  `subject` varchar(45) DEFAULT NULL,
  `body_text` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbleventphotos`
--

CREATE TABLE `tbleventphotos` (
  `photoid` int(10) UNSIGNED NOT NULL,
  `eventid` int(10) UNSIGNED DEFAULT NULL,
  `photoname` varchar(45) DEFAULT NULL,
  `path` varchar(150) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbleventphotos`
--

INSERT INTO `tbleventphotos` (`photoid`, `eventid`, `photoname`, `path`, `status`) VALUES
(1, 2, 'Tech.png', 'http://localhost/holidaynew/assets/eventimages/Tech.png', '1'),
(2, 1, 'Wing.png', 'http://localhost/holidaynew/assets/eventimages/Wing.png', '1'),
(3, 2, 'Tech.png', 'http://localhost/holidaynew/assets/eventimages/Tech.png', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tblevents`
--

CREATE TABLE `tblevents` (
  `eventid` int(10) UNSIGNED NOT NULL,
  `vendorid` int(10) UNSIGNED DEFAULT NULL,
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
  `longitude` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblevents`
--

INSERT INTO `tblevents` (`eventid`, `vendorid`, `todate`, `fromdate`, `location`, `totime`, `fromtime`, `eventname`, `description`, `eventtype`, `cost`, `status`, `latitude`, `longitude`) VALUES
(1, 2, '2016-06-17', '2016-06-18', 'N Convention,Hyderabad, Hyderabad, Telangana, India', '19:00', '00:00', 'WINGDING- A Lively Event', 'Wingding refers to ‘A Lively Event’ i.e. the name itself Derives concept of the event.', '', NULL, '1', '17.457209', '78.381705'),
(2, 2, '2016-06-29', '2016-06-30', 'Jawaharlal Nehru Technological University,Kukatpally, Hyderabad, Telangana, India', '09:00', '18:00', 'The Tech Fest 2016', 'India''s Largest Technology and Design UnConference for Students  ', '', NULL, '1', '17.492640', '78.390512');

-- --------------------------------------------------------

--
-- Table structure for table `tbllocations`
--

CREATE TABLE `tbllocations` (
  `locationid` int(10) UNSIGNED NOT NULL,
  `locationname` varchar(45) DEFAULT NULL,
  `stateid` int(10) UNSIGNED DEFAULT NULL,
  `cityid` int(10) UNSIGNED DEFAULT NULL,
  `countryid` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblpackages`
--

CREATE TABLE `tblpackages` (
  `packageid` int(10) UNSIGNED NOT NULL,
  `resortid` int(10) UNSIGNED DEFAULT '0',
  `packagename` longtext,
  `description` longtext,
  `status` varchar(45) DEFAULT NULL,
  `createdby` varchar(45) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedby` varchar(45) DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `servicetax` double DEFAULT '0',
  `vendorid` int(11) DEFAULT NULL,
  `packageimage` varchar(150) DEFAULT NULL,
  `packagetags` longtext,
  `packagetype` varchar(45) DEFAULT NULL,
  `eventid` varchar(45) DEFAULT NULL,
  `adultprice` varchar(45) DEFAULT NULL,
  `childprice` varchar(45) DEFAULT NULL,
  `expirydate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpackages`
--

INSERT INTO `tblpackages` (`packageid`, `resortid`, `packagename`, `description`, `status`, `createdby`, `createdon`, `updatedby`, `updatedon`, `servicetax`, `vendorid`, `packageimage`, `packagetags`, `packagetype`, `eventid`, `adultprice`, `childprice`, `expirydate`) VALUES
(1, 1, 'Entry Fee', 'Nehru Zoological Park in Hyderabad is popularly known as the Hyderabad Zoo. Named after Pandit Jawaharlal Nehru, the zoo is an attraction of the city since it was established and opened to public in 1963.', '1', '1', '2016-06-12 01:12:35', 'admin', '2016-06-12 01:12:35', 0, 1, '', 'fun,dayout', 'daily', '', '20', '10', '2016-06-20'),
(3, 0, 'Regular Ticket', 'Wingding refers to ‘A Lively Event’ i.e. the name itself Derives concept of the event.', '1', '1', '2016-06-12 01:58:13', 'admin', '2016-06-12 01:58:13', 0, 2, '', 'fun', 'event', '1', '1200', '800', '0000-00-00'),
(4, 0, 'VIP Ticket', 'Wingding refers to ‘A Lively Event’ i.e. the name itself Derives concept of the event.', '1', '1', '2016-06-12 02:00:25', 'admin', '2016-06-12 02:00:25', 0, 2, '', 'fun', 'event', '1', '1500', '1500', '0000-00-00'),
(5, 0, 'Early Bird', 'Wingding refers to ‘A Lively Event’ i.e. the name itself Derives concept of the event.', '1', '1', '2016-06-12 02:01:28', 'admin', '2016-06-12 02:01:28', 0, 2, '', 'fun', 'event', '1', '900', '600', '0000-00-00'),
(6, 0, 'Early Bird Ticket - Valid For 2 Days', 'India''s Largest Technology and Design UnConference for Students  ', '1', '1', '2016-06-12 02:08:23', 'admin', '2016-06-12 02:08:23', 10, 2, '', 'technology,design', 'event', '2', '600', '600', '2016-06-14'),
(7, 0, 'Late Bird Ticket - Valid For 2 Days', 'India''s Largest Technology and Design UnConference for Students  ', '1', '1', '2016-06-12 02:09:45', 'admin', '2016-06-12 02:09:45', 5, 2, '', 'technology,design', 'event', '2', '1000', '1000', '0000-00-00'),
(8, 2, 'Entry Fee', 'One of the famous Hyderabad tourist places, Lumbini Park Hyderabad was developed by the Hyderabad Urban Development Authority in the year of 1994.', '1', '1', '2016-06-12 02:23:04', 'admin', '2016-06-12 02:23:04', 0, 3, '', 'fun,kids', 'daily', '', '10', '10', '2016-06-13'),
(9, 2, 'Speed Boating', 'One of the famous Hyderabad tourist places, Lumbini Park Hyderabad was developed by the Hyderabad Urban Development Authority in the year of 1994.', '1', '1', '2016-06-12 02:24:17', 'admin', '2016-06-12 02:24:17', 0, 3, '', 'fun,kids', 'daily', '', '50', '50', '0000-00-00'),
(10, 2, 'boating', 'One of the famous Hyderabad tourist places, Lumbini Park Hyderabad was developed by the Hyderabad Urban Development Authority in the year of 1994.', '1', '1', '2016-06-12 02:25:40', 'admin', '2016-06-12 02:25:40', 0, 3, '', 'kids,fun', 'daily', '', '40', '40', '0000-00-00'),
(11, 2, 'Laser Show', 'One of the famous Hyderabad tourist places, Lumbini Park Hyderabad was developed by the Hyderabad Urban Development Authority in the year of 1994.', '1', '1', '2016-06-12 02:26:35', 'admin', '2016-06-12 02:26:35', 0, 3, '', 'kids,fun', 'daily', '', '50', '50', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tblpayments`
--

CREATE TABLE `tblpayments` (
  `paymentid` int(10) UNSIGNED NOT NULL,
  `bookingid` varchar(45) DEFAULT NULL,
  `customerid` varchar(45) DEFAULT NULL,
  `packageid` int(10) NOT NULL,
  `totalcost` varchar(5) NOT NULL,
  `adultpriceperticket` varchar(5) NOT NULL,
  `childpriceperticket` varchar(5) NOT NULL,
  `numberofadults` varchar(5) NOT NULL,
  `numberofchildren` varchar(5) NOT NULL,
  `servicetax` varchar(5) NOT NULL,
  `transaction_id` varchar(150) DEFAULT NULL,
  `referenceno` varchar(45) DEFAULT NULL,
  `transdate` date DEFAULT NULL,
  `amount` int(10) UNSIGNED DEFAULT NULL,
  `response` varchar(45) DEFAULT NULL,
  `banktransaction` varchar(45) NOT NULL,
  `transactiondescription` varchar(75) NOT NULL,
  `authorizationcode` varchar(75) NOT NULL,
  `discriminator` varchar(75) NOT NULL,
  `cardnumber` varchar(45) NOT NULL,
  `billingphone` varchar(45) NOT NULL,
  `billingemail` varchar(45) NOT NULL,
  `udf9` varchar(45) NOT NULL,
  `mmp_txn` varchar(75) NOT NULL,
  `mer_txn` varchar(75) NOT NULL,
  `transactiontime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpayments`
--

INSERT INTO `tblpayments` (`paymentid`, `bookingid`, `customerid`, `packageid`, `totalcost`, `adultpriceperticket`, `childpriceperticket`, `numberofadults`, `numberofchildren`, `servicetax`, `transaction_id`, `referenceno`, `transdate`, `amount`, `response`, `banktransaction`, `transactiondescription`, `authorizationcode`, `discriminator`, `cardnumber`, `billingphone`, `billingemail`, `udf9`, `mmp_txn`, `mer_txn`, `transactiontime`, `status`) VALUES
(21, '22', 'sainikhil013@gmail.com', 6, '1320', '600', '600', '1', '1', '10', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '2016-06-13 13:29:26', 'unpaid'),
(22, '23', 'sainikhil013@gmail.com', 8, '20', '10', '10', '1', '1', '0', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '2016-06-13 13:55:39', 'unpaid'),
(23, '24', 'sainikhil013@gmail.com', 6, '1320', '600', '600', '1', '1', '10', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '2016-06-13 18:23:47', 'unpaid'),
(24, '25', 'sainikhil013@gmail.com', 1, '80', '20', '10', '1', '1', '0', NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '2016-06-18 14:29:07', 'unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `tblplaces`
--

CREATE TABLE `tblplaces` (
  `plid` int(10) NOT NULL,
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
  `status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblplaces`
--

INSERT INTO `tblplaces` (`plid`, `place`, `address`, `city`, `latitude`, `longitude`, `description`, `otherinfo`, `createdon`, `createdby`, `updatedon`, `updatedby`, `status`) VALUES
(1, 'Golconda Fort', 'Ibrahim Bagh, Hyderabad, Telangana 500008', 'hyderabad', '17.3836 ', '78.4015', 'Golkonda, also known as Golconda or Golla konda ("shepherd''s hill"), is a citadel and fort in Southern India and was the capital of the medieval sultanate of the Qutb Shahi dynasty (c.1518–1687), is situated 11 kilometres (6.8 mi) west of Hyderabad.', 'Historic', '2016-06-12 03:45:18', 'admin', '2016-06-12 06:03:58', 'admin', 1),
(2, 'Lumbini Park', 'Opposite Secretariat New Gate, Khairatabad, Hyderabad, Telangana 500004', 'Hyderabad', '17.410057', '78.473219', 'Lumbini Park is a small public, urban park of 7.5 acres (0.030 km2; 0.0117 sq mi) adjacent to Hussain Sagar in Hyderabad, India.', 'Fun place', '2016-06-12 06:07:49', 'admin', '2016-06-12 06:16:00', 'admin', 1),
(3, 'Prasads Imax', 'NTR Gardens, LIC Division P.O., Hyderabad, Telangana 500063', 'Hyderabad', '17.412864', '78.465915', 'Prasad''s is a centrally air conditioned multiplex of an area of 2,35,000 sq ft, housing an IMAX Movie Theatre, a five screen multiplex, food court, multinational fast food outlets, a gaming zone and a Shopping mall covering two levels of the complex.', 'fun,food', '2016-06-12 06:12:05', 'admin', '2016-06-12 06:16:48', 'admin', 1),
(4, 'Peddamma Temple', 'Hitech City Road, Jubilee Hills, Hyderabad, Telangana 500033', 'hyderabad', '17.4921 ', '78.4073', 'Peddamma temple is an Hindu temple located at Jubilee Hills in Hyderabad. It is very famous during the festive season of Bonaalu.', 'temple', '2016-06-12 06:15:00', 'admin', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblplacesphotos`
--

CREATE TABLE `tblplacesphotos` (
  `pphotoid` int(10) UNSIGNED NOT NULL,
  `plid` int(10) UNSIGNED DEFAULT NULL,
  `photoname` longtext,
  `path` longtext,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblplacesphotos`
--

INSERT INTO `tblplacesphotos` (`pphotoid`, `plid`, `photoname`, `path`, `status`) VALUES
(2, 1, 'golconda2.jpg', 'http://localhost/demo/holidayapp/assets/places/golconda2.jpg', '1'),
(3, 1, 'golconda3.jpg', 'http://localhost/demo/holidayapp/assets/places/golconda3.jpg', '1'),
(9, 2, 'lumbini1.jpg', 'http://localhost/demo/holidayapp/assets/places/lumbini1.jpg', '1'),
(10, 2, 'lumbini2.jpg', 'http://localhost/demo/holidayapp/assets/places/lumbini2.jpg', '1'),
(11, 2, 'lumbini3.jpg', 'http://localhost/demo/holidayapp/assets/places/lumbini3.jpg', '1'),
(15, 3, 'prasad4.jpg', 'http://localhost/demo/holidayapp/assets/places/prasad4.jpg', '1'),
(16, 3, 'prasads1.jpg', 'http://localhost/demo/holidayapp/assets/places/prasads1.jpg', '1'),
(17, 3, 'prasads2.jpg', 'http://localhost/demo/holidayapp/assets/places/prasads2.jpg', '1'),
(18, 3, 'prasads3.jpg', 'http://localhost/demo/holidayapp/assets/places/prasads3.jpg', '1'),
(19, 4, 'temple1.jpg', 'http://localhost/demo/holidayapp/assets/places/temple1.jpg', '1'),
(20, 4, 'temple2.jpg', 'http://localhost/demo/holidayapp/assets/places/temple2.jpg', '1'),
(21, 4, 'temple3.jpg', 'http://localhost/demo/holidayapp/assets/places/temple3.jpg', '1'),
(22, 4, 'temple4.jpg', 'http://localhost/demo/holidayapp/assets/places/temple4.jpg', '1'),
(23, 1, 'Golconda.jpg', 'http://localhost/demo/holidayapp/assets/places/Golconda.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tblresorphotos`
--

CREATE TABLE `tblresorphotos` (
  `rphotoid` int(10) UNSIGNED NOT NULL,
  `resortid` int(10) UNSIGNED DEFAULT NULL,
  `photoname` varchar(45) DEFAULT NULL,
  `path` varchar(150) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblresorphotos`
--

INSERT INTO `tblresorphotos` (`rphotoid`, `resortid`, `photoname`, `path`, `status`) VALUES
(4, 1, 'logo.jpg', 'http://localhost/holidaynew/assets/resortimages/logo.jpg', '1'),
(6, 2, 'lumbini1.jpg', 'http://localhost/holidaynew/assets/resortimages/lumbini1.jpg', '1'),
(7, 2, 'lumbini1.jpg', 'http://localhost/holidaynew/assets/resortimages/lumbini1.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tblresorts`
--

CREATE TABLE `tblresorts` (
  `resortid` int(10) UNSIGNED NOT NULL,
  `vendorid` int(10) UNSIGNED DEFAULT NULL,
  `resortname` varchar(45) DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  `description` longtext,
  `createdby` varchar(45) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `updatedby` varchar(45) DEFAULT NULL,
  `updatedon` datetime DEFAULT NULL,
  `status` varchar(5) DEFAULT NULL,
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblresorts`
--

INSERT INTO `tblresorts` (`resortid`, `vendorid`, `resortname`, `location`, `description`, `createdby`, `createdon`, `updatedby`, `updatedon`, `status`, `latitude`, `longitude`) VALUES
(1, 1, 'zoo', 'Hyderabad', 'Welcome to Nehru Zoological Park, and its sylvan setting, abutting the historic miralam Tank bund, (200 year old, World''s first multi arch masonry dam). The Zoo spread in over 380 acres established on 6th October, 1963.', 'admin', '2016-06-12 12:59:56', NULL, NULL, '1', '17.350695', '78.452313'),
(2, 3, 'Lumbini Park', 'Hyderabad', 'One of the famous Hyderabad tourist places, Lumbini Park Hyderabad was developed by the Hyderabad Urban Development Authority in the year of 1994.', 'admin', '2016-06-12 02:20:19', NULL, NULL, '1', '17.410057', '78.473219');

-- --------------------------------------------------------

--
-- Table structure for table `tblsms_template`
--

CREATE TABLE `tblsms_template` (
  `tempid` int(10) UNSIGNED NOT NULL,
  `temptype` varchar(45) DEFAULT NULL,
  `tempname` varchar(45) DEFAULT NULL,
  `temptext` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblstates`
--

CREATE TABLE `tblstates` (
  `stateid` int(10) UNSIGNED NOT NULL,
  `statename` varchar(45) DEFAULT NULL,
  `countryid` int(11) UNSIGNED DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbltransactions`
--

CREATE TABLE `tbltransactions` (
  `tid` int(10) NOT NULL,
  `transactiondate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vendorid` int(10) NOT NULL,
  `amountrecieved` double NOT NULL,
  `servicecharges` double NOT NULL,
  `amountpaid` double NOT NULL,
  `balance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltransactions`
--

INSERT INTO `tbltransactions` (`tid`, `transactiondate`, `vendorid`, `amountrecieved`, `servicecharges`, `amountpaid`, `balance`) VALUES
(1, '2016-06-14 16:29:29', 1, 1000, 100, 0, 1000),
(2, '2016-06-14 16:30:03', 1, 1000, 100, 0, 2000),
(3, '2016-06-14 16:30:52', 2, 5000, 500, 0, 5000),
(4, '2016-06-14 16:30:52', 2, 1500, 150, 0, 6500),
(5, '2016-06-14 16:33:00', 1, 0, 0, 500, 2500),
(6, '2016-06-14 16:33:00', 2, 0, 0, 500, 6000);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `userid` int(10) UNSIGNED NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `department` varchar(45) DEFAULT NULL,
  `designation` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `status` int(10) UNSIGNED DEFAULT NULL,
  `usertype` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`userid`, `username`, `password`, `department`, `designation`, `email`, `mobile`, `status`, `usertype`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 'admin@admin.com', '4525252545', 1, 'admin'),
(2, 'vendor', 'vendor', 'vendor', 'vendor', 'vendor@gmail.com', '7777777777', 1, 'vendor');

-- --------------------------------------------------------

--
-- Table structure for table `tblvendorpayments`
--

CREATE TABLE `tblvendorpayments` (
  `vpid` int(10) NOT NULL,
  `paymentdate` date NOT NULL,
  `vendorid` int(10) NOT NULL,
  `paymenttype` varchar(25) NOT NULL,
  `transactiondate` date NOT NULL,
  `transactionnumber` varchar(75) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblvendorphotos`
--

CREATE TABLE `tblvendorphotos` (
  `vphotoid` int(10) UNSIGNED NOT NULL,
  `vendorid` int(10) UNSIGNED DEFAULT NULL,
  `photoname` varchar(45) DEFAULT NULL,
  `path` varchar(150) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblvendors`
--

CREATE TABLE `tblvendors` (
  `vendorid` int(10) UNSIGNED NOT NULL,
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
  `status` int(10) UNSIGNED DEFAULT NULL COMMENT '1:valid,0:invalid;',
  `latitude` varchar(45) DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  `vendorlogo` varchar(150) DEFAULT NULL,
  `description` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblvendors`
--

INSERT INTO `tblvendors` (`vendorid`, `vendorname`, `password`, `contact_person`, `Address1`, `Address2`, `city`, `pincode`, `landline`, `mobile`, `email`, `website`, `createdon`, `updateon`, `status`, `latitude`, `longitude`, `vendorlogo`, `description`) VALUES
(1, 'Nehru Zoological Park', 'zoo', 'xyz', 'Zoo Park Main Rd, Kishan Bagh, Bahadurpura West', 'Zoo Park Main Rd, Kishan Bagh, Bahadurpura West', 'Hyderabad, Telangana ', '500064', '040 2447 7355', '1234567890', 'info@hydzoo.com', 'http://www.hydzoo.com/', '2016-06-12 12:19:56', '2016-06-12 12:19:56', 1, '17.350695', '78.452313', NULL, 'Welcome to Nehru Zoological Park, and its sylvan setting, abutting the historic miralam Tank bund, (200 year old, World''s first multi arch masonry dam). The Zoo spread in over 380 acres established on 6th October, 1963.'),
(2, 'xyz', 'xyz', 'xyz', 'xyz', 'xyz', 'Hyderabad, Telangana  ', '500000', '040 222222', '9876543210', 'xyz@gmail.com', 'http://www.xyz.com/', '2016-06-12 01:22:40', '2016-06-12 01:22:40', 1, '', '', NULL, 'Event Organizer'),
(3, 'Lumbini Park', 'park', 'xyz', 'Lumbini Park is a small public, urban park of 7.5 acres adjacent to Hussain Sagar.', 'Lumbini Park is a small public, urban park of 7.5 acres adjacent to Hussain Sagar.', 'Hyderabad', '500004', '', '09989336911', 'lumbnipark@gmail.com', 'http://www.hyderabadtourism.travel/lumbini-park-hyderabad', '2016-06-12 02:18:55', '2016-06-12 02:18:55', 1, '17.410057', '78.473219', NULL, 'One of the famous Hyderabad tourist places, Lumbini Park Hyderabad was developed by the Hyderabad Urban Development Authority in the year of 1994.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eventreviews`
--
ALTER TABLE `eventreviews`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `placereviews`
--
ALTER TABLE `placereviews`
  ADD PRIMARY KEY (`prid`);

--
-- Indexes for table `resortreviews`
--
ALTER TABLE `resortreviews`
  ADD PRIMARY KEY (`rrid`);

--
-- Indexes for table `smssettings`
--
ALTER TABLE `smssettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbookings`
--
ALTER TABLE `tblbookings`
  ADD PRIMARY KEY (`bookingid`);

--
-- Indexes for table `tblcities`
--
ALTER TABLE `tblcities`
  ADD PRIMARY KEY (`cityid`);

--
-- Indexes for table `tblcountries`
--
ALTER TABLE `tblcountries`
  ADD PRIMARY KEY (`countryid`);

--
-- Indexes for table `tblcustomers`
--
ALTER TABLE `tblcustomers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customerusername_UNIQUE` (`username`),
  ADD UNIQUE KEY `tblcustomerscol_UNIQUE` (`number`);

--
-- Indexes for table `tblemail_template`
--
ALTER TABLE `tblemail_template`
  ADD PRIMARY KEY (`etempid`);

--
-- Indexes for table `tbleventphotos`
--
ALTER TABLE `tbleventphotos`
  ADD PRIMARY KEY (`photoid`);

--
-- Indexes for table `tblevents`
--
ALTER TABLE `tblevents`
  ADD PRIMARY KEY (`eventid`);

--
-- Indexes for table `tbllocations`
--
ALTER TABLE `tbllocations`
  ADD PRIMARY KEY (`locationid`);

--
-- Indexes for table `tblpackages`
--
ALTER TABLE `tblpackages`
  ADD PRIMARY KEY (`packageid`);

--
-- Indexes for table `tblpayments`
--
ALTER TABLE `tblpayments`
  ADD PRIMARY KEY (`paymentid`);

--
-- Indexes for table `tblplaces`
--
ALTER TABLE `tblplaces`
  ADD PRIMARY KEY (`plid`);

--
-- Indexes for table `tblplacesphotos`
--
ALTER TABLE `tblplacesphotos`
  ADD PRIMARY KEY (`pphotoid`);

--
-- Indexes for table `tblresorphotos`
--
ALTER TABLE `tblresorphotos`
  ADD PRIMARY KEY (`rphotoid`);

--
-- Indexes for table `tblresorts`
--
ALTER TABLE `tblresorts`
  ADD PRIMARY KEY (`resortid`);

--
-- Indexes for table `tblsms_template`
--
ALTER TABLE `tblsms_template`
  ADD PRIMARY KEY (`tempid`);

--
-- Indexes for table `tblstates`
--
ALTER TABLE `tblstates`
  ADD PRIMARY KEY (`stateid`);

--
-- Indexes for table `tbltransactions`
--
ALTER TABLE `tbltransactions`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `tblvendorphotos`
--
ALTER TABLE `tblvendorphotos`
  ADD PRIMARY KEY (`vphotoid`);

--
-- Indexes for table `tblvendors`
--
ALTER TABLE `tblvendors`
  ADD PRIMARY KEY (`vendorid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eventreviews`
--
ALTER TABLE `eventreviews`
  MODIFY `rid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `placereviews`
--
ALTER TABLE `placereviews`
  MODIFY `prid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `resortreviews`
--
ALTER TABLE `resortreviews`
  MODIFY `rrid` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `smssettings`
--
ALTER TABLE `smssettings`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblbookings`
--
ALTER TABLE `tblbookings`
  MODIFY `bookingid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `tblcities`
--
ALTER TABLE `tblcities`
  MODIFY `cityid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblcountries`
--
ALTER TABLE `tblcountries`
  MODIFY `countryid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblcustomers`
--
ALTER TABLE `tblcustomers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblemail_template`
--
ALTER TABLE `tblemail_template`
  MODIFY `etempid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbleventphotos`
--
ALTER TABLE `tbleventphotos`
  MODIFY `photoid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tblevents`
--
ALTER TABLE `tblevents`
  MODIFY `eventid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbllocations`
--
ALTER TABLE `tbllocations`
  MODIFY `locationid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblpackages`
--
ALTER TABLE `tblpackages`
  MODIFY `packageid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tblpayments`
--
ALTER TABLE `tblpayments`
  MODIFY `paymentid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `tblplaces`
--
ALTER TABLE `tblplaces`
  MODIFY `plid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tblplacesphotos`
--
ALTER TABLE `tblplacesphotos`
  MODIFY `pphotoid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `tblresorphotos`
--
ALTER TABLE `tblresorphotos`
  MODIFY `rphotoid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tblresorts`
--
ALTER TABLE `tblresorts`
  MODIFY `resortid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tblstates`
--
ALTER TABLE `tblstates`
  MODIFY `stateid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbltransactions`
--
ALTER TABLE `tbltransactions`
  MODIFY `tid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `userid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tblvendorphotos`
--
ALTER TABLE `tblvendorphotos`
  MODIFY `vphotoid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tblvendors`
--
ALTER TABLE `tblvendors`
  MODIFY `vendorid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
