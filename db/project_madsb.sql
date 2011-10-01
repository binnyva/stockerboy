-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 01, 2011 at 09:57 AM
-- Server version: 5.1.37
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project_madsb`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`) VALUES
(1, 'National');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE IF NOT EXISTS `color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `design_id` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`id`, `product_id`, `design_id`, `color`) VALUES
(1, 1, 3, 'Red'),
(2, 1, 11, 'Green'),
(3, 4, 21, 'Blue'),
(4, 4, 22, 'Black');

-- --------------------------------------------------------

--
-- Table structure for table `design`
--

CREATE TABLE IF NOT EXISTS `design` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `img_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `design`
--

INSERT INTO `design` (`id`, `name`, `product_id`, `img_name`) VALUES
(3, 'New Design', 1, 'blue_1317366243.jpg'),
(11, 'Latest', 1, 'home-_1317366303.jpg'),
(21, 'New Books', 4, '12481_1317366324.jpg'),
(22, 'Old Books', 4, '20101_1317366335.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `product_id` int(11) NOT NULL,
  `design_id` int(11) unsigned NOT NULL,
  `size` enum('XS','S','M','L','XL','XXL') DEFAULT NULL,
  `sex` enum('m','f') NOT NULL DEFAULT 'm',
  `color` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `national_cut` float NOT NULL,
  `city_cut` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `design_id` (`design_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `code`, `product_id`, `design_id`, `size`, `sex`, `color`, `price`, `national_cut`, `city_cut`) VALUES
(1, '0001', 1, 3, 'XS', 'm', 'Red', 2222, 22, 22),
(2, '0002', 1, 11, 'S', 'f', 'Green', 3333, 33, 33),
(3, '0003', 4, 21, 'M', 'm', 'Blue', 111, 1, 1),
(4, '0004', 4, 22, 'L', 'f', 'Black', 555, 5, 5);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`) VALUES
(1, 'T-shirt'),
(4, 'Book');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE IF NOT EXISTS `sale` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(11) unsigned NOT NULL,
  `quantity` int(4) NOT NULL,
  `sale_on` datetime NOT NULL,
  `sold_by_user_id` int(11) unsigned NOT NULL,
  `city_id` int(11) unsigned NOT NULL,
  `approved` enum('0','1') DEFAULT NULL,
  `approved_by_user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `sold_by_user_id` (`sold_by_user_id`),
  KEY `city_id` (`city_id`),
  KEY `approved_by_user_id` (`approved_by_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `sale`
--


-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE IF NOT EXISTS `size` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `design_id` int(11) NOT NULL,
  `size` enum('XS','S','M','L','XL','XXL') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id`, `product_id`, `design_id`, `size`) VALUES
(1, 1, 3, 'XS'),
(2, 1, 11, 'S'),
(3, 4, 21, 'M'),
(4, 4, 22, 'L');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(11) unsigned NOT NULL,
  `amount` int(5) NOT NULL,
  `city_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `stock`
--


-- --------------------------------------------------------

--
-- Table structure for table `transit`
--

CREATE TABLE IF NOT EXISTS `transit` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(11) unsigned NOT NULL,
  `amount` int(5) NOT NULL,
  `from_city_id` int(11) unsigned NOT NULL,
  `to_city_id` int(11) unsigned NOT NULL,
  `sent_by_user_id` int(11) unsigned NOT NULL,
  `left_on` datetime NOT NULL,
  `reached_on` datetime NOT NULL,
  `recived_by_user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `from_city_id` (`from_city_id`),
  KEY `to_city_id` (`to_city_id`),
  KEY `sent_by_user_id` (`sent_by_user_id`),
  KEY `recived_by_user_id` (`recived_by_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `transit`
--


-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `city_id` int(11) unsigned NOT NULL,
  `type` enum('national','city') DEFAULT NULL,
  `status` enum('1','0') DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `phone`, `city_id`, `type`, `status`) VALUES
(3, 'Rajesh', 'rajesh@orisys.in', 'rajesh', '9809414956', 1, 'national', '1'),
(4, 'Rabeesh', 'rabeesh@orisys.in', 'rabeesh', '9809414956', 1, 'city', '1');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `design`
--
ALTER TABLE `design`
  ADD CONSTRAINT `Design_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `Item_ibfk_1` FOREIGN KEY (`design_id`) REFERENCES `design` (`id`);

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `Sale_ibfk_1` FOREIGN KEY (`sold_by_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `Sale_ibfk_2` FOREIGN KEY (`approved_by_user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `Stock_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`),
  ADD CONSTRAINT `Stock_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`);

--
-- Constraints for table `transit`
--
ALTER TABLE `transit`
  ADD CONSTRAINT `Transit_ibfk_1` FOREIGN KEY (`sent_by_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `Transit_ibfk_2` FOREIGN KEY (`recived_by_user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `Transit_ibfk_3` FOREIGN KEY (`from_city_id`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `Transit_ibfk_4` FOREIGN KEY (`to_city_id`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `Transit_ibfk_5` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `User_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
