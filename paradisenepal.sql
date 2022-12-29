-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 20, 2019 at 10:51 AM
-- Server version: 5.7.24
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paradisenepal`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `GetFilterPackages`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetFilterPackages` (IN `destination` VARCHAR(255), IN `activity` VARCHAR(255), IN `duration` VARCHAR(255), IN `price` VARCHAR(255))  BEGIN
  SELECT DISTINCT packages.Id, packages.Name, packages.Destination, packages.Duration, packages.Price FROM `packages` 
	INNER JOIN package_activity pa on (pa.PackageId = packages.Id)
	INNER JOIN activities a on (a.Id = pa.ActivityId) WHERE
   Destination LIKE CONCAT('%', destination, '%') 
   AND 
   (activity IS NULL or a.Activity = activity)
   AND
   packages.Duration LIKE CONCAT('%', duration, '%')
   AND
   (price IS NULL or packages.Price <= price)
   ;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
CREATE TABLE IF NOT EXISTS `activities` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Activity` varchar(250) NOT NULL,
  `Description` varchar(250) DEFAULT NULL,
  `Status` tinyint(1) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedAt` date NOT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `ModifiedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`Id`, `Activity`, `Description`, `Status`, `CreatedBy`, `CreatedAt`, `ModifiedBy`, `ModifiedAt`) VALUES
(1, 'Trekings', '', 1, 2, '2019-09-15', 2, '2019-09-15 00:00:00'),
(2, 'Cycling', '', 1, 2, '2019-09-18', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` blob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `fullname`, `email`, `message`) VALUES
(5, 'merry jean', 'merry@gmail.com', 0x4d792068757362616e6420616e642049206172726976656420696e204b6174686d616e647520616e64207765726520756e61626c6520746f206d656574207570207769746820612067756964652077652068616420617272616e67656420746f2068696b6520757020746f2070617274206f662074686520416e6e617075726e6120436972637569742e204c75636b696c792c20736f6d656f6e652066726f6d20416476656e7475726520436c756220736177207573206c6f6f6b696e67206c6f737420616e64206f66666572656420746f2068656c702e20576520746f6c64207468656d206f66206f757220736974756174696f6e2e205765206f6e6c79206861642036206461797320616e64206e656564656420746f20737461727420617320736f6f6e20617320706f737369626c652e20576520616c736f206469646e2774206861766520616e79206f66206f7572207065726d697473),
(6, 'Birendra', 'yesbirendra@gmail.com', 0x4e6570616c20776173207472756c79206d792062657374206576657220657870657269656e63652074686f756768204920686176652074726176656c6c6564206d616e7920646966666572656e74207061727473206f662074686520776f726c642e204974206973206d79206661766f72697465206f6620616c6c2064657374696e6174696f6e732c20646f206e6f74206d697373206974210d0a0d0a426972656e6472612043687564616c2c206f7572206c6f63616c20677569646520616e64206f7267616e697a65722c206f776e6572206f6620416476656e7475726520436c75622c207265616c6c792064696420686973206265737420746f206d616b65206f757220736576656e2d6461792d7472656b6b696e6720746f2074686520416e6e617075726e6120426173652043616d702c207468652074776f2d6461792d72616674696e6720706c75732074686520656c657068616e74207269646520696e204368697477616e204e6174696f6e616c205061726b20616c6c207665727920706c656173616e7420657870657269656e6365732e204163636f6d6d6f646174696f6e20616e6420666f6f642c20506f727465727320616e64207765617468657220616c6c20737570706f72746564206f7572206d6f6f642067726561746c792e204920616d20636f6e666964656e74207468617420746865205175616c697479206f66207468652073657276696365732c207468652070726f66657373696f6e616c69736d20616e6420667269656e646c696e6573732077652072656365697665642063616e206265207265636f6d6d656e64656420746f2065766572792076697369746f72206f66204e6570616c2e);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `PackageId` int(11) NOT NULL,
  `Comments` longtext NOT NULL,
  `Email` varchar(150) NOT NULL,
  `PostedAt` date NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`Id`, `PackageId`, `Comments`, `Email`, `PostedAt`) VALUES
(1, 1, 'Welcome to nepal.', 'uniqsaqya@gmail.com', '2019-09-20'),
(2, 1, 'I would love to go in this tour', 'test@gmail.com', '2019-09-20'),
(3, 1, 'I would love to go in this tour', 'test@gmail.com', '2019-09-20');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` blob NOT NULL,
  `added_date` date NOT NULL,
  `status` enum('yes','no') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `image`, `description`, `added_date`, `status`) VALUES
(4, ' Mr. bibek', 'adventure1.jpg', 0x20202020202020626f6174696e67, '0000-00-00', 'yes'),
(11, '  rafting in trishuli', 'Chrysanthemum.jpg', 0x2020202020202020202020202020202020206d6f737420616476656e7475726573207965707079, '0000-00-00', 'yes'),
(12, '  my events', 'tour1.jpg', 0x426c6573736564207769746820656e6368616e74696e67206c616e6473636170657320616e64206d79737469632048696d616c617961732c20746869732062656175746966756c20636f756e7472792068617320696e2073746f72652061206c6f7420666f722065766572796f6e65207669736974696e6720686572652e205769746820646966666572656e742067656f67726170686963616c2066656174757265732c204e6570616c206861732061206c6f7420746f206f666665722065766572796f6e6520616e64206f6e652063616e20676f207468726f7567682074686520696e6e657220636f7265206f6620746865206e6174757265207468726f75676820746865206d65616e73206f6620646966666572656e74206578636974696e672061637469766974696573206c696b652068696b696e672c207065616b20636c696d62696e672061732077656c6c206173205472656b6b696e6720696e204e6570616c20776869636820697320746865206d6f737420616476656e7475726f75732061732077656c6c2061732066756c6c206f6620656e6a6f796d656e7420616374697669747920706f70756c617220736f2066617220616d6f6e67206d616e79206f74686572206e756d65726f757320616374697669746965732e204e6570616c207472656b20697320616c6c2061626f7574206578706c6f72696e67207468652062656175746966756c206e617475726520616e642074686520666c6f726120616e64206661756e61207265736964696e67206f6e206974207769746820686967687320616e64206c6f7773206f6620746865207472656b6b696e6720747261696c732e20546865206d61676e69666963656e74206769616e74206d6f756e7461696e7320616e642074686520736e6f77207065616b65642048696d616c617961732061726520776f7274687768696c6520746f20766965772077697468206f6e659273206f776e206579657320647572696e6720746865207472656b20776869636820656e61626c65206f6e65927320727573747920616e6420746972656420736f756c20746f2070657020757020616e6420737061726b20776974682066756c6c206f6620646976696e6974792e2048696d616c6179617320616e6420416476656e7475726520617265207468652073796e6f6e796d73206f662065616368206f74686572206173207472656b6b6572206765747320746f20657870657269656e636520616c6c2074686520657373656e636520647572696e6720746865206a6f75726e65792e, '0000-00-00', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
CREATE TABLE IF NOT EXISTS `packages` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(250) NOT NULL,
  `Destination` varchar(250) NOT NULL,
  `Duration` varchar(250) NOT NULL,
  `Price` decimal(10,0) NOT NULL,
  `Type` int(11) DEFAULT NULL,
  `Description` longtext NOT NULL,
  `images` varchar(250) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `CreatedBy` int(11) NOT NULL,
  `CreatedAt` datetime NOT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `ModifiedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`Id`, `Name`, `Destination`, `Duration`, `Price`, `Type`, `Description`, `images`, `Status`, `CreatedBy`, `CreatedAt`, `ModifiedBy`, `ModifiedAt`) VALUES
(1, 'asdaa', 'asda', '5 days', '1000', 1, 'asdada', 'chitwan1.jpg', 1, 2, '2019-09-17 00:00:00', 2, '2019-09-18 00:00:00'),
(2, 'Chitwan Tour', 'Chitwan', '3 days 2 Night', '1500', 2, ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur interdum urna vel magna feugiat, a efficitur felis sagittis. Aliquam in nibh nec erat venenatis tempor et eu urna. In hac habitasse platea dictumst. Integer ullamcorper, felis non sagittis varius, neque nisl pulvinar diam, ac lacinia massa libero maximus nisi. Phasellus convallis ipsum augue, in commodo arcu tincidunt nec. Maecenas at neque quis tellus condimentum vehicula. Cras placerat arcu ac arcu dignissim viverra. Nam a sollicitudin lorem, eu tempus est. Pellentesque hendrerit tellus malesuada sapien sollicitudin aliquam. Fusce in semper orci.\r\n\r\nPellentesque euismod efficitur eros, eget ultrices ipsum congue at. Vestibulum gravida volutpat justo ac eleifend. In tincidunt lectus id diam suscipit consequat. Phasellus risus dui, vehicula id ipsum non, pharetra feugiat nibh. Maecenas venenatis quam orci, vitae sagittis magna porttitor et. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque tincidunt massa quis volutpat blandit. Pellentesque pharetra malesuada augue, sit amet commodo felis feugiat quis. Ut aliquet nisi nec purus porta, quis efficitur ligula venenatis. Cras faucibus eleifend mi ac sollicitudin. Vestibulum faucibus velit sed metus commodo mattis. Cras finibus, libero ut imperdiet maximus, neque tortor venenatis sapien, ut rutrum quam lectus quis tortor.\r\n\r\nPraesent eu ligula malesuada, finibus nulla quis, porta nisi. Maecenas vel ante odio. Cras erat sapien, cursus nec elit sed, laoreet lobortis nunc. Duis tempus orci nec orci aliquet sagittis. Suspendisse nec ornare lorem. Morbi molestie at ipsum sed semper. Maecenas at varius est. Praesent elementum sapien libero, a lacinia mauris vehicula porttitor. ', 'chitwan.jpg', 1, 2, '2019-09-18 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `package_activity`
--

DROP TABLE IF EXISTS `package_activity`;
CREATE TABLE IF NOT EXISTS `package_activity` (
  `Id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ActivityId` int(11) NOT NULL,
  `PackageId` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package_activity`
--

INSERT INTO `package_activity` (`Id`, `ActivityId`, `PackageId`) VALUES
(7, 2, 1),
(6, 1, 1),
(8, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

DROP TABLE IF EXISTS `sliders`;
CREATE TABLE IF NOT EXISTS `sliders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slider_image` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `added_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `slider_image`, `caption`, `status`, `added_date`) VALUES
(3, 'boudha.jpg', 'Boudha nath temple', 1, '2019-09-15'),
(4, 'banner1.jpeg', 'kathmandu durbar square', 1, '2019-09-15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `e_mail` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `e_mail`, `fullname`) VALUES
(4, 'uniqsaqya', '$2y$10$eK.L19b4UF96mL6evNKYYeFbFTWBrbrk28fGN64CHUJq5qTWpoJtq', 'uniqsaqya@gmail.com', 'Niklesh Shakya'),
(5, 'admin', '$2y$10$yDgpjLBh6tAzNUtm2JLgbOl.C17KZf96rjTga11.cjZ06nDwP1nqO', 'admin@gmail.com', 'Administrator');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
