-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 07, 2013 at 11:12 AM
-- Server version: 5.1.49
-- PHP Version: 5.3.26-1~dotdeb.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mygreenmd`
--

-- --------------------------------------------------------

--
-- Table structure for table `block_ip`
--

CREATE TABLE IF NOT EXISTS `block_ip` (
  `ip_id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` char(20) COLLATE latin1_general_ci NOT NULL,
  `date_time` datetime NOT NULL,
  `log` int(3) NOT NULL,
  PRIMARY KEY (`ip_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=35 ;

--
-- Dumping data for table `block_ip`
--

INSERT INTO `block_ip` (`ip_id`, `ip_address`, `date_time`, `log`) VALUES
(33, '74.63.93.188', '2009-07-28 18:00:06', 3),
(32, '192.168.0.79', '2009-07-28 17:57:11', 3);

-- --------------------------------------------------------

--
-- Table structure for table `claims`
--

CREATE TABLE IF NOT EXISTS `claims` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `type_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `claims`
--

INSERT INTO `claims` (`id`, `name`, `username`, `email`, `date`, `phone`, `is_approved`, `type_id`, `type_name`) VALUES
(1, 'ari', 'ari', 'ari.p@kiranatama.com', '2013-09-03', NULL, 1, NULL, NULL),
(2, 'test', 'test', 'aribasc3om@test.com', '2013-09-07', NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `deals`
--

CREATE TABLE IF NOT EXISTS `deals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) DEFAULT NULL,
  `type_name` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `expiry` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `deals`
--

INSERT INTO `deals` (`id`, `type_id`, `type_name`, `name`, `description`, `expiry`) VALUES
(6, 1, 'smoke_shop', 'deal smoke shop', 'deal smoke shopdeal smoke shopdeal smoke shop', '10:00'),
(3, 1, 'dispensary', 'test', 'test', '10:00'),
(4, 1, 'doctor', 'Deal for doctor', 'Deal for doctor', '10:00');

-- --------------------------------------------------------

--
-- Table structure for table `device_tokens`
--

CREATE TABLE IF NOT EXISTS `device_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `apple_id` varchar(255) DEFAULT NULL,
  `device_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `device_tokens`
--

INSERT INTO `device_tokens` (`id`, `apple_id`, `device_token`) VALUES
(1, '1', 'b67cc395f8be5a8993a49089c6b7684ada31005440b30fbf85168dc41e525231'),
(2, '2', '3e32056b928a48935577893cd561729a169f37aca52481d7ba9d8c93dc0b0c6d');

-- --------------------------------------------------------

--
-- Table structure for table `dispensaries`
--

CREATE TABLE IF NOT EXISTS `dispensaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `description` text,
  `timing` varchar(255) DEFAULT NULL,
  `open_time` varchar(255) DEFAULT NULL,
  `close_time` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `counter` int(11) DEFAULT '0',
  `rating` int(1) DEFAULT NULL,
  `highlight` tinyint(1) DEFAULT '0',
  `featured` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `dispensaries`
--

INSERT INTO `dispensaries` (`id`, `name`, `address`, `city`, `state`, `zip_code`, `email`, `website`, `description`, `timing`, `open_time`, `close_time`, `phone`, `picture`, `counter`, `rating`, `highlight`, `featured`) VALUES
(1, 'Dispensry Name', 'Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum', 'Bandung', 'Jawa', '0', 'aribascom@test.com', 'www.test.com', '<p>test</p>', '24/7', '10:00', '12:00', '093232', 'c4613b424492a921b78d3d720b6b9f50.jpg', 2, 3, 1, 0),
(2, 'Dispensry Name2', 'Lorem ipsum dolor sit amet', 'Bandung', 'Jawa', '40235', 'aribascom@tewwst.com', 'www.testd.com', '<p>Lorem ipsum dolor sit amet</p>', '24/7', '10:00', '12:00', '23432432', '07c531a92fc605a4b99c937ce7a965da.JPG', 0, 4, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE IF NOT EXISTS `doctors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `description` text,
  `timing` varchar(255) DEFAULT NULL,
  `open_time` varchar(255) DEFAULT NULL,
  `close_time` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `counter` int(11) DEFAULT '0',
  `rating` int(1) DEFAULT NULL,
  `highlight` tinyint(1) DEFAULT '0',
  `featured` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `address`, `city`, `state`, `zip_code`, `email`, `website`, `description`, `timing`, `open_time`, `close_time`, `phone`, `picture`, `counter`, `rating`, `highlight`, `featured`) VALUES
(1, 'Doctor 1', 'Lorem ipsum', 'Bandung', 'Jawa', '45654', 'aribascom@test.com', 'www.testd.com', 'test', '24/7', '10:00', '12:00', '093232', 'fd808bc3db75544f96f8cf10efdd7bf2.jpg', 1, 3, 1, 0),
(2, 'Doctor ari', 'jl margaasri no 68', 'Bandung', 'Jawa', '40235', 'aribascom@tewwst.com', 'www.testd.com', 'Lorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit amet', '24/7', '10:00', '12:00', '093232', '6ae81709698b81194f4909adbe083adb.jpg', 0, 3, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `modules`
--


-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE IF NOT EXISTS `packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `duration` varchar(255) DEFAULT NULL,
  `price` int(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `description`, `duration`, `price`) VALUES
(1, 'Bronze Package', '<p>LLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametorem ipsum dolor sit amet</p>', '1 month', 0),
(2, 'Silver Package', 'Package Details goes here.Package Details goes here.Package Details goes here.Package Details goes here.Package Details goes here.Package Details goes .\r\n', '1 month', 10),
(3, 'Gold Package', 'Package Details goes here.Package Details goes here.Package Details goes here.Package Details goes here.Package Details goes here.Package Details goes .\r\n', '1 month', 45),
(4, 'Diamond Package', 'Package Details goes here.Package Details goes here.Package Details goes here.Package Details goes here.Package Details goes here.Package Details goes .\r\n', '1 month', 50);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `content` text,
  `meta_keywords` text,
  `meta_description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `url`, `content`, `meta_keywords`, `meta_description`) VALUES
(1, 'About Us', 'about_us', '<p>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit ametv</p>\n<p>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit ametv</p>', 'About Us', 'About Us'),
(2, 'Privacy Policy', 'privacy', '<p>Privacy Policy</p>', 'test', 'tets'),
(3, 'Term an Conditions', 'terms', '<p>Term an Conditions</p>', 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cc_number` varchar(255) DEFAULT NULL,
  `expiry_month` varchar(2) DEFAULT NULL,
  `expiry_year` int(4) DEFAULT NULL,
  `pin` int(10) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `cc_number`, `expiry_month`, `expiry_year`, `pin`, `amount`, `created_at`) VALUES
(1, '4007000000027', '01', 2025, 324, 200, '2013-09-05 09:44:12'),
(2, '370000000000002', '01', 2022, 324, 200, '2013-09-05 09:52:18');

-- --------------------------------------------------------

--
-- Table structure for table `push_notifications`
--

CREATE TABLE IF NOT EXISTS `push_notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text,
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `push_notifications`
--

INSERT INTO `push_notifications` (`id`, `message`, `datetime`) VALUES
(1, 'test', '2013-09-06 01:15:50'),
(2, 'test', '2013-09-06 01:16:16'),
(3, 'test', '2013-09-06 03:24:26');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) DEFAULT NULL,
  `type_name` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `username` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `type_id`, `type_name`, `name`, `description`, `username`, `date`) VALUES
(1, NULL, NULL, 'Review 1', 'Review 1', 'ari', '2013-09-04'),
(2, 1, 'smoke_shop', 'REview for smoke shop', 'REview for smoke shop', 'ari', '2013-09-04'),
(3, 1, 'dispensary', 'review', 'review desc', 'ari', '2013-09-07');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `unid` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`unid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`unid`, `name`) VALUES
(1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `role_modules`
--

CREATE TABLE IF NOT EXISTS `role_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `read` int(1) NOT NULL DEFAULT '0',
  `write` int(1) NOT NULL DEFAULT '0',
  `delete` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `role_modules`
--


-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('70ee792f6eaa574e511e8cb57a9f9f0c', '192.168.0.111', 'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.0.1', 1246248446, ''),
('ecb911fe164a5a5efedd68af0867125b', '192.168.0.111', 'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.0.1', 1246248013, '');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `application_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `company_address`, `company_email`, `application_name`) VALUES
(1, 'ADROIT - MY GREEN MD', '', 'admin@mygreenmd.com', 'ADROIT - MY GREEN MD');

-- --------------------------------------------------------

--
-- Table structure for table `smoke_shops`
--

CREATE TABLE IF NOT EXISTS `smoke_shops` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `description` text,
  `timing` varchar(255) DEFAULT NULL,
  `open_time` varchar(255) DEFAULT NULL,
  `close_time` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `counter` int(11) DEFAULT '0',
  `rating` int(1) DEFAULT NULL,
  `highlight` tinyint(1) DEFAULT '0',
  `featured` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `smoke_shops`
--

INSERT INTO `smoke_shops` (`id`, `name`, `address`, `city`, `state`, `zip_code`, `email`, `website`, `description`, `timing`, `open_time`, `close_time`, `phone`, `picture`, `counter`, `rating`, `highlight`, `featured`) VALUES
(1, 'Smoke Shop1', 'Lorem ipsum', 'Bandung', 'Jawa', '40235', 'aribascom@gmail.com', 'www.testd.com', '<p>test</p>', '24/7', '10:00', '12:00', '093232', '1e3b256e199d9c805280eaca78a6cc54.jpg', 1, 2, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE IF NOT EXISTS `tracks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section` varchar(255) DEFAULT NULL,
  `activity_type` varchar(255) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tracks`
--

INSERT INTO `tracks` (`id`, `section`, `activity_type`, `datetime`, `ip_address`, `username`) VALUES
(1, 'Section Name', 'Call', '2013-09-04 20:24:03', '192.168.0.1', 'ari'),
(2, 'Section Name', 'Call', '2013-09-04 20:24:03', '192.168.0.1', 'ari'),
(3, 'Section Name', 'Call', '2013-09-04 20:24:03', '192.168.0.1', 'ari');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(100) COLLATE latin1_general_ci NOT NULL,
  `password` char(255) COLLATE latin1_general_ci NOT NULL,
  `name` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=43 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `name`, `email`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin@namastestudio.com');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE IF NOT EXISTS `user_roles` (
  `user_id` int(11) NOT NULL,
  `role_unid` int(2) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_id`, `role_unid`) VALUES
(1, 1);
