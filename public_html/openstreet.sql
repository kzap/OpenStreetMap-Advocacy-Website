-- phpMyAdmin SQL Dump
-- version 3.3.4
-- http://www.phpmyadmin.net
--
-- Host: 10.179.79.186
-- Generation Time: Oct 28, 2010 at 02:13 AM
-- Server version: 5.1.45
-- PHP Version: 5.3.2-1ubuntu4.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `openstreet`
--

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE IF NOT EXISTS `places` (
  `ID` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `place` varchar(255) NOT NULL,
  `lat` decimal(9,6) NOT NULL,
  `lng` decimal(9,6) NOT NULL,
  `osmid` int(10) unsigned NOT NULL,
  `osmdesc` varchar(35) NOT NULL,
  `updated` varchar(35) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `place` (`place`),
  KEY `osm-desc` (`osmdesc`),
  KEY `updated` (`updated`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;
