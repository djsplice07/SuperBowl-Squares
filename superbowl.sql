-- phpMyAdmin SQL Dump
-- version 2.8.0.1
-- http://www.phpmyadmin.net
--
-- Updated by: djsplice
-- Date: 1-25-2024
-- 
-- Host: custsql-pow13
-- Generation Time: Dec 13, 2013 at 12:59 AM
-- Server version: 5.5.32
-- PHP Version: 4.4.9
-- 
-- Database: `superbowl`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `VNSB_numbers`
-- 

DROP TABLE IF EXISTS `VNSB_numbers`;
CREATE TABLE IF NOT EXISTS `VNSB_numbers` (
  `NFC` tinyint(2) DEFAULT NULL,
  `AFC` tinyint(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Randomly picked numbers';

-- 
-- Dumping data for table `VNSB_numbers`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `VNSB_scores`
-- 

DROP TABLE IF EXISTS `VNSB_scores`;
CREATE TABLE IF NOT EXISTS `VNSB_scores` (
  `ID` tinyint(2) NOT NULL,
  `NFC_FIRST` tinyint(2) DEFAULT NULL,
  `AFC_FIRST` tinyint(2) DEFAULT NULL,
  `NFC_HALF` tinyint(2) DEFAULT NULL,
  `AFC_HALF` tinyint(2) DEFAULT NULL,
  `NFC_THIRD` tinyint(2) DEFAULT NULL,
  `AFC_THIRD` tinyint(2) DEFAULT NULL,
  `NFC_FINAL` tinyint(2) DEFAULT NULL,
  `AFC_FINAL` tinyint(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `VNSB_scores`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `VNSB_settings`
-- 

DROP TABLE IF EXISTS `VNSB_settings`;
CREATE TABLE IF NOT EXISTS `VNSB_settings` (
  `sb_title` varchar(26) NOT NULL COMMENT 'Title of Superbowl Squares',
  `commissioner` varchar(26) NULL COMMENT 'Name of commissioner (ie. Event Commissioner',
  `sb_event` varchar(26) NULL COMMENT 'Name of Event (ie. Superbowl LII)',
  `sb_date` varchar(30) NOT NULL DEFAULT '' COMMENT 'Date of Event/Game',
  `sb_time` varchar(8) NULL COMMENT 'Time of Event/Game',
  `sb_logo` varchar(30) DEFAULT NULL COMMENT 'Official logo of event',
  `NFC_team` varchar(30) DEFAULT NULL COMMENT 'NFC team name',
  `NFC_logo` varchar(30) DEFAULT NULL COMMENT 'NFC team logo',
  `AFC_team` varchar(30) DEFAULT NULL COMMENT 'AFC team name',
  `AFC_logo` varchar(30) DEFAULT NULL COMMENT 'AFC team logo',
  `Bet` varchar(5) NOT NULL DEFAULT '5.00' COMMENT 'Dollar amount per square',
  `Win_first` tinyint(2) NOT NULL DEFAULT '20' COMMENT 'Percent that goes to winner of 1st quarter',
  `Win_second` tinyint(2) NOT NULL DEFAULT '25' COMMENT 'Percent that goes to winner of 2nd quarter',
  `Win_third` tinyint(2) NOT NULL DEFAULT '20' COMMENT 'Percent that goes to winner of 3rd quarter',
  `Win_final` tinyint(2) NOT NULL DEFAULT '35' COMMENT 'Percent that goes to winner of final score',
  `Donation_Final` tinyint(2) NOT NULL DEFAULT '' COMMENT 'Percent that will go to the charity/donation; This can be 0',
  `Version` char(3) NOT NULL DEFAULT '',
  `Admin_email` varchar(30) NOT NULL DEFAULT 'admin@email.com' COMMENT 'Admin login email',
  `Admin_pwd` varchar(8) NOT NULL DEFAULT 'password' COMMENT 'Admin login password'
  `Grace` int(11) DEFAULT NULL COMMENT 'Grace period for payment in hours',
  `Venmo` varchar(20) DEFAULT NULL COMMENT 'Venmo address. Start with ''@''',
  `PayPal` varchar(50) DEFAULT NULL COMMENT 'PayPal link or email address',
  `CashApp` varchar(50) DEFAULT NULL COMMENT 'CashApp address. Start with ''$''',
  `Zelle` varchar(50) DEFAULT NULL COMMENT 'Zelle contact address (phone or email)',
  PRIMARY KEY (`sb_date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Setting for VN SuperBowl Squares';

-- 
-- Dumping data for table `VNSB_settings`
-- 

INSERT INTO `VNSB_settings` VALUES ('Host Name', 'Commissioner Name', 'Superbowl LVIII', 'Sunday February 11, 2024', '3:30 PM', 'superbowlnumber.png', 'NFC Team', 'nfc-generic.png', 'AFC Team', 'afc-generic.png', '5.00', 20, 25, 20, 35, 0, '5.1', 'admin@yourdomain.com', 'password');
INSERT INTO `VNSB_settings` VALUES ('Organization Name', 'https://www.yoursite.com/superbowl', 'Commissioner Name', 'Super Bowl LVIII', 'February 11, 2024', '3:30 PST', 'superbowlnumber.png', '49ers', 'nfc-team.png', 'Chiefs', 'afc-team.png', '5.00', 20, 25, 20, 35, 0, '5.1', 'admin email', 'admin pass', 24, '@venmo', 'paypal@email.com', '$cashapp', 'zelle@email.com');
-- --------------------------------------------------------

-- 
-- Table structure for table `VNSB_squares`
-- 

DROP TABLE IF EXISTS `VNSB_squares`;
CREATE TABLE IF NOT EXISTS `VNSB_squares` (
  `SQUARE` varchar(15) NOT NULL DEFAULT '',
  `NAME` varchar(30) NOT NULL DEFAULT 'AVAILABLE',
  `EMAIL` varchar(45) DEFAULT NULL,
  `NOTES` text,
  `DATE` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `CONFIRM` tinyint(1) NOT NULL DEFAULT '0',
  `FIRST` tinyint(1) NOT NULL DEFAULT '0',
  `HALF` tinyint(1) NOT NULL DEFAULT '0',
  `THIRD` tinyint(1) NOT NULL DEFAULT '0',
  `FINAL` tinyint(1) NOT NULL DEFAULT '0',
  UNIQUE KEY `SQUARE` (`SQUARE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Super Bowl Squares';

-- 
-- Dumping data for table `VNSB_squares`
-- 

INSERT INTO `VNSB_squares` VALUES ('00', 'AVAILABLE', NULL, NULL, '2013-01-14 01:56:43', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('01', 'AVAILABLE', NULL, NULL, '2013-01-15 12:10:16', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('02', 'AVAILABLE', NULL, NULL, '2013-01-09 11:53:47', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('03', 'AVAILABLE', NULL, NULL, '2013-01-15 08:41:10', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('04', 'AVAILABLE', NULL, NULL, '2013-01-14 01:52:22', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('05', 'AVAILABLE', NULL, NULL, '2013-01-08 12:45:49', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('06', 'AVAILABLE', NULL, NULL, '2013-01-21 12:38:27', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('07', 'AVAILABLE', NULL, NULL, '2013-01-18 02:49:41', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('08', 'AVAILABLE', NULL, NULL, '2013-01-14 01:23:21', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('09', 'AVAILABLE', NULL, NULL, '2013-01-14 02:30:08', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('10', 'AVAILABLE', NULL, NULL, '2013-01-08 12:58:53', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('11', 'AVAILABLE', NULL, NULL, '2013-01-08 04:34:09', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('12', 'AVAILABLE', NULL, NULL, '2013-01-08 03:53:14', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('13', 'AVAILABLE', NULL, NULL, '2013-01-14 04:26:08', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('14', 'AVAILABLE', NULL, NULL, '2013-01-20 10:03:29', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('15', 'AVAILABLE', NULL, NULL, '2013-01-13 02:31:36', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('16', 'AVAILABLE', NULL, NULL, '2013-01-14 02:18:40', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('17', 'AVAILABLE', NULL, NULL, '2013-01-14 01:36:04', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('18', 'AVAILABLE', NULL, NULL, '2013-01-14 08:48:40', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('19', 'AVAILABLE', NULL, NULL, '2013-01-20 07:02:59', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('20', 'AVAILABLE', NULL, NULL, '2013-01-15 08:41:10', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('21', 'AVAILABLE', NULL, NULL, '2013-01-08 12:45:49', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('22', 'AVAILABLE', NULL, NULL, '2013-01-09 11:53:47', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('23', 'AVAILABLE', NULL, NULL, '2013-01-08 03:53:33', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('24', 'AVAILABLE', NULL, NULL, '2013-01-08 12:58:53', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('25', 'AVAILABLE', NULL, NULL, '2013-01-20 10:03:50', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('26', 'AVAILABLE', NULL, NULL, '2013-01-16 07:36:01', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('27', 'AVAILABLE', NULL, NULL, '2013-01-08 12:45:49', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('28', 'AVAILABLE', NULL, NULL, '2013-01-18 03:16:41', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('29', 'AVAILABLE', NULL, NULL, '2013-01-20 08:44:30', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('30', 'AVAILABLE', NULL, NULL, '2013-01-22 02:21:03', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('31', 'AVAILABLE', NULL, NULL, '2013-01-22 02:21:03', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('32', 'AVAILABLE', NULL, NULL, '2013-01-13 02:31:36', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('33', 'AVAILABLE', NULL, NULL, '2013-01-08 04:34:09', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('34', 'AVAILABLE', NULL, NULL, '2013-01-15 12:10:16', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('35', 'AVAILABLE', NULL, NULL, '2013-01-14 02:30:08', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('36', 'AVAILABLE', NULL, NULL, '2013-01-20 10:04:10', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('37', 'AVAILABLE', NULL, NULL, '2013-01-15 12:25:05', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('38', 'AVAILABLE', NULL, NULL, '2013-01-20 10:46:57', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('39', 'AVAILABLE', NULL, NULL, '2013-01-14 04:04:01', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('40', 'AVAILABLE', NULL, NULL, '2013-01-14 01:52:22', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('41', 'AVAILABLE', NULL, NULL, '2013-01-15 08:41:10', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('42', 'AVAILABLE', NULL, NULL, '2013-01-14 02:18:40', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('43', 'AVAILABLE', NULL, NULL, '2013-01-14 02:30:08', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('44', 'AVAILABLE', NULL, NULL, '2013-01-11 07:25:05', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('45', 'AVAILABLE', NULL, NULL, '2013-01-14 01:36:40', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('46', 'AVAILABLE', NULL, NULL, '2013-01-08 02:11:23', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('47', 'AVAILABLE', NULL, NULL, '2013-01-14 01:56:43', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('48', 'AVAILABLE', NULL, NULL, '2013-01-14 04:26:08', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('49', 'AVAILABLE', NULL, NULL, '2013-01-14 01:52:22', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('50', 'AVAILABLE', NULL, NULL, '2013-01-20 07:02:59', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('51', 'AVAILABLE', NULL, NULL, '2013-01-20 08:32:44', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('52', 'AVAILABLE', NULL, NULL, '2013-01-15 12:10:16', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('53', 'AVAILABLE', NULL, NULL, '2013-01-15 10:03:13', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('54', 'AVAILABLE', NULL, NULL, '2013-01-14 01:36:40', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('55', 'AVAILABLE', NULL, NULL, '2013-01-11 07:25:05', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('56', 'AVAILABLE', NULL, NULL, '2013-01-15 12:10:16', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('57', 'AVAILABLE', NULL, NULL, '2013-01-21 12:39:03', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('58', 'AVAILABLE', NULL, NULL, '2013-01-21 09:11:27', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('59', 'AVAILABLE', NULL, NULL, '2013-01-18 03:16:41', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('60', 'AVAILABLE', NULL, NULL, '2013-01-14 02:30:08', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('61', 'AVAILABLE', NULL, NULL, '2013-01-22 02:21:03', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('62', 'AVAILABLE', NULL, NULL, '2013-01-08 12:58:53', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('63', 'AVAILABLE', NULL, NULL, '2013-01-14 01:36:40', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('64', 'AVAILABLE', NULL, NULL, '2013-01-14 04:08:24', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('65', 'AVAILABLE', NULL, NULL, '2013-01-15 10:03:13', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('66', 'AVAILABLE', NULL, NULL, '2013-01-08 03:53:58', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('67', 'AVAILABLE', NULL, NULL, '2013-01-15 08:41:10', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('68', 'AVAILABLE', NULL, NULL, '2013-01-08 12:58:53', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('69', 'AVAILABLE', NULL, NULL, '2013-01-18 02:49:41', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('70', 'AVAILABLE', NULL, NULL, '2013-01-15 12:25:05', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('71', 'AVAILABLE', NULL, NULL, '2013-01-21 12:37:39', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('72', 'AVAILABLE', NULL, NULL, '2013-01-14 01:36:40', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('73', 'AVAILABLE', NULL, NULL, '2013-01-08 02:11:23', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('74', 'AVAILABLE', NULL, NULL, '2013-01-16 07:36:01', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('75', 'AVAILABLE', NULL, NULL, '2013-01-14 04:04:01', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('76', 'AVAILABLE', NULL, NULL, '2013-01-18 03:16:41', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('77', 'AVAILABLE', NULL, NULL, '2013-01-08 03:54:15', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('78', 'AVAILABLE', NULL, NULL, '2013-01-20 10:46:57', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('79', 'AVAILABLE', NULL, NULL, '2013-01-08 07:00:57', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('80', 'AVAILABLE', NULL, NULL, '2013-01-14 01:23:21', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('81', 'AVAILABLE', NULL, NULL, '2013-01-14 04:26:08', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('82', 'AVAILABLE', NULL, NULL, '2013-01-21 12:36:55', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('83', 'AVAILABLE', NULL, NULL, '2013-01-18 03:16:41', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('84', 'AVAILABLE', NULL, NULL, '2013-01-20 08:32:44', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('85', 'AVAILABLE', NULL, NULL, '2013-01-20 08:44:30', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('86', 'AVAILABLE', NULL, NULL, '2013-01-18 02:49:41', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('87', 'AVAILABLE', NULL, NULL, '2013-01-20 07:02:59', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('88', 'AVAILABLE', NULL, NULL, '2013-01-08 03:54:33', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('89', 'AVAILABLE', NULL, NULL, '2013-01-15 12:10:16', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('90', 'AVAILABLE', NULL, NULL, '2013-01-09 11:53:47', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('91', 'AVAILABLE', NULL, NULL, '2013-01-14 08:48:40', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('92', 'AVAILABLE', NULL, NULL, '2013-01-14 04:04:01', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('93', 'AVAILABLE', NULL, NULL, '2013-01-20 07:02:59', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('94', 'AVAILABLE', NULL, NULL, '2013-01-14 01:52:22', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('95', 'AVAILABLE', NULL, NULL, '2013-01-14 01:36:04', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('96', 'AVAILABLE', NULL, NULL, '2013-01-14 04:26:08', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('97', 'AVAILABLE', NULL, NULL, '2013-01-15 08:41:10', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('98', 'AVAILABLE', NULL, NULL, '2013-01-15 12:10:16', 0, 0, 0, 0, 0);
INSERT INTO `VNSB_squares` VALUES ('99', 'AVAILABLE', NULL, NULL, '2013-01-14 02:30:08', 0, 0, 0, 0, 0);
