-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 27, 2011 at 06:12 PM
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
-- Table structure for table `design`
--

CREATE TABLE IF NOT EXISTS `design` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `img_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `design`
--

INSERT INTO `design` (`id`, `name`, `product_id`, `img_name`) VALUES
(1, 'rrrrr', 1, 'blue_1317126498.jpg'),
(20, 'tttt', 1, '20101_1317126544.jpg'),
(21, 'yyy', 1, 'dicti_1317126548.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `design_id` int(11) unsigned NOT NULL,
  `size` enum('XS','S','M','L','XL','XXL') DEFAULT NULL,
  `sex` enum('m','f') NOT NULL DEFAULT 'm',
  `color` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `national_cut` float NOT NULL,
  `city_cut` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `design_id` (`design_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `item`
--


-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`) VALUES
(1, 'T-shirt');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE IF NOT EXISTS `sale` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(11) unsigned NOT NULL,
  `quantity` varchar(100) NOT NULL,
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
