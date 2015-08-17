-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2015 at 01:26 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mentormaps`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE IF NOT EXISTS `data` (
  `NAME` varchar(100) DEFAULT NULL,
  `SKILLS_JSON` varchar(999) DEFAULT NULL,
  `TEAM_NUMBER` varchar(100) DEFAULT NULL,
  `COMMENTS` varchar(200) DEFAULT NULL,
  `PHONE` varchar(100) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `ADDRESS` varchar(100) DEFAULT NULL,
  `TYPE` varchar(100) DEFAULT NULL,
  `AGE` varchar(100) DEFAULT NULL,
  `ACCOUNT_TYPE` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`NAME`, `SKILLS_JSON`, `TEAM_NUMBER`, `COMMENTS`, `PHONE`, `EMAIL`, `ADDRESS`, `TYPE`, `AGE`, `ACCOUNT_TYPE`) VALUES
('Joseph Sirna', '{"skill-engineering":"false","engineering-desc":{"engineering-mechanical":"false","engineering-electrical":"false"},"skill-programming":"true","skill-cad":"false","programming-desc":{"programming-c":"false","programming-java":"true","programming-csharp":"true","programming-python":"false","programming-robotc":"true","programming-labview":"false","programming-easyc":"false","programming-nxt":"false","programming-ev3":"false"},"skill-strategy":"false","skill-business":"false","skill-marketing":"false","skill-manufacturing":"false","skill-design":"false","skill-scouting":"false","skill-fundraising":"false","skill-other":"false","skill-other-desc":""}', '3309', 'no', '5626650405', 'joseph.sirna@gmail.com', '1021 N Hensel Dr, La Habra, CA, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"true"}', '16', 'MENTOR'),
('Miriam', '{"skill-engineering":"true","engineering-desc":{"engineering-mechanical":"true","engineering-electrical":"true"},"skill-programming":"false","programming-desc":{"programming-c":"false","programming-java":"false","programming-csharp":"false","programming-python":"false","programming-robotc":"false","programming-labview":"false","programming-easyc":"false","programming-nxt":"false","programming-ev3":"false"},"skill-cad":"false","skill-strategy":"false","skill-business":"false","skill-marketing":"false","skill-manufacturing":"true","skill-design":"true","skill-scouting":"true","skill-fundraising":"false","skill-other":"false","skill-other-desc":""}', '3309', 'Hi like puppies and food', '5626072362', 'miriammelendez78@yahoo.com', '3212 Magnolia Ave, Long  Beach, CA, United States', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', '17', 'MENTOR'),
('Erick Locke', '{"skill-engineering":"true","engineering-desc":{"engineering-mechanical":"true","engineering-electrical":"false"},"skill-programming":"false","programming-desc":{"programming-c":"false","programming-java":"false","programming-csharp":"false","programming-python":"false","programming-robotc":"false","programming-labview":"false","programming-easyc":"false","programming-nxt":"false","programming-ev3":"false"},"skill-cad":"true","skill-strategy":"false","skill-business":"false","skill-marketing":"false","skill-manufacturing":"false","skill-design":"true","skill-scouting":"false","skill-fundraising":"false","skill-other":"false","skill-other-desc":""}', '3309', 'I am a demigod.', '714-655-5241', 'erick.locke.2@gmail.com', '8271 Reilly Dr., Huntington Beach, California, United States', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', '18', 'MENTOR'),
('Jon Logrippo', '{"skill-engineering":"false","engineering-desc":{"engineering-mechanical":"false","engineering-electrical":"false"},"skill-programming":"false","programming-desc":{"programming-c":"false","programming-java":"false","programming-csharp":"false","programming-python":"false","programming-robotc":"false","programming-labview":"false","programming-easyc":"false","programming-nxt":"false","programming-ev3":"false"},"skill-cad":"false","skill-strategy":"false","skill-business":"true","skill-marketing":"true","skill-manufacturing":"false","skill-design":"false","skill-scouting":"true","skill-fundraising":"true","skill-other":"false","skill-other-desc":""}', '3309', 'Something about yourself', '7143293808', 'jonathan.logrippo@servitehs.org', '1800 N. Boisseranc Dr, Anaheim, California, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"false","pref_vex":"true"}', '15', 'MENTOR'),
('The Friarbots', '{"skill-engineering":"false","engineering-desc":{"engineering-mechanical":"false","engineering-electrical":"false"},"skill-programming":"false","skill-cad":"false","programming-desc":{"programming-c":"false","programming-java":"false","programming-csharp":"false","programming-python":"false","programming-robotc":"false","programming-labview":"false","programming-easyc":"false","programming-nxt":"false","programming-ev3":"false"},"skill-strategy":"false","skill-business":"true","skill-marketing":"false","skill-manufacturing":"false","skill-design":"false","skill-scouting":"true","skill-fundraising":"true","skill-other":"false","skill-other-desc":""}', '3309', 'We are based out of Anaheim, CA and are looking for a mentor for Chairman''s.', '7148114564', 'events@team3309.org', '934 Keystone St. , Anaheim, California, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', '8', 'TEAM'),
('Momentum', '{"skill-engineering":"true","engineering-desc":{"engineering-mechanical":"true","engineering-electrical":"true"},"skill-programming":"true","skill-cad":"true","programming-desc":{"programming-c":"false","programming-java":"true","programming-csharp":"false","programming-python":"false","programming-robotc":"false","programming-labview":"false","programming-easyc":"false","programming-nxt":"false","programming-ev3":"false"},"skill-strategy":"true","skill-business":"true","skill-marketing":"true","skill-manufacturing":"true","skill-design":"true","skill-scouting":"true","skill-fundraising":"true","skill-other":"true","skill-other-desc":"LITERALLY EVERYTHING"}', '6000', 'We are a brand new team in the Long Beach area with a great start and a great space.', '(562)-810-0625', 'momentumrobotics@gmail.com', '1100 Iroquois Ave., Long Beach, California, United States', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', '1', 'TEAM'),
('Code Orange', '{"skill-engineering":"false","engineering-desc":{"engineering-mechanical":"false","engineering-electrical":"false"},"skill-programming":"false","skill-cad":"true","programming-desc":{"programming-c":"false","programming-java":"false","programming-csharp":"false","programming-python":"false","programming-robotc":"false","programming-labview":"false","programming-easyc":"false","programming-nxt":"false","programming-ev3":"false"},"skill-strategy":"true","skill-business":"true","skill-marketing":"true","skill-manufacturing":"false","skill-design":"false","skill-scouting":"false","skill-fundraising":"true","skill-other":"false","skill-other-desc":""}', '3476', '', '5558990345', 'code@orange.com', '15431 Verdun Circle, Irvine, California, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', '7', 'TEAM'),
('Jon L', '{"skill-engineering":"false","engineering-desc":{"engineering-mechanical":"false","engineering-electrical":"false"},"skill-programming":"false","programming-desc":{"programming-c":"false","programming-java":"false","programming-csharp":"false","programming-python":"false","programming-robotc":"false","programming-labview":"false","programming-easyc":"false","programming-nxt":"false","programming-ev3":"false"},"skill-cad":"false","skill-strategy":"false","skill-business":"false","skill-marketing":"false","skill-manufacturing":"false","skill-design":"false","skill-scouting":"false","skill-fundraising":"false","skill-other":"false","skill-other-desc":""}', '3309', '', '7142393404', 'jfl2900@drkstr.com', ', Anaheim, California, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"true"}', '15', 'MENTOR'),
('E Smith', '{"skill-engineering":"true","engineering-desc":{"engineering-mechanical":"true","engineering-electrical":"false"},"skill-programming":"false","programming-desc":{"programming-c":"false","programming-java":"false","programming-csharp":"false","programming-python":"false","programming-robotc":"false","programming-labview":"false","programming-easyc":"false","programming-nxt":"false","programming-ev3":"false"},"skill-cad":"true","skill-strategy":"true","skill-business":"false","skill-marketing":"false","skill-manufacturing":"true","skill-design":"true","skill-scouting":"false","skill-fundraising":"false","skill-other":"false","skill-other-desc":""}', '3309', 'something about myself here, is there a limit on the size and if so, how does the user know? al;ksdj lakjsd lf;kjas ;ldfj alsdj flaj sdlfj alsj dlf jalsdj flajskd lfja lsdfkj lasjdk flaj sdlfj alsd fl', '7148985275', 'jetengr@gmail.com', '6882 Cumberland Dr., Huntington Beach, CA, USA', '{"pref_fll":"true","pref_ftc":"false","pref_frc":"true","pref_vex":"true"}', 'NULL', 'MENTOR'),
('ESmith', '{"skill-engineering":"true","engineering-desc":{"engineering-mechanical":"true","engineering-electrical":"false"},"skill-programming":"false","skill-cad":"true","programming-desc":{"programming-c":"false","programming-java":"false","programming-csharp":"false","programming-python":"false","programming-robotc":"false","programming-labview":"false","programming-easyc":"false","programming-nxt":"false","programming-ev3":"false"},"skill-strategy":"false","skill-business":"false","skill-marketing":"false","skill-manufacturing":"true","skill-design":"true","skill-scouting":"true","skill-fundraising":"false","skill-other":"false","skill-other-desc":""}', '3309', 'something about myself', '7148985275', 'jetengr@team3309.org', 'Huntington beach, ca, usa', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"true"}', 'NULL', 'MENTOR');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `LATITUDE` varchar(500) DEFAULT NULL,
  `LONGITUDE` varchar(500) DEFAULT NULL,
  `ADDRESS` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`LATITUDE`, `LONGITUDE`, `ADDRESS`) VALUES
('33.9408116', '-117.93860990000002', '1021 N Hensel Dr, La Habra, CA, USA'),
('33.815702', '-118.19773299999997', '3212 Magnolia Ave, Long  Beach, CA, United States'),
('33.664314', '-117.983139', '8271 Reilly Dr., Huntington Beach, California, United States'),
('33.868209', '-117.80994299999998', '1800 N. Boisseranc Dr, Anaheim, California, USA'),
('33.8451499', '-117.95057600000001', '934 Keystone St. , Anaheim, California, USA'),
('33.7808849', '-118.10513709999998', '1100 Iroquois Ave., Long Beach, California, United States'),
('33.682461', '-117.78089899999998', '15431 Verdun Circle, Irvine, California, USA'),
('33.8352932', '-117.91450359999999', ', Anaheim, California, USA'),
('33.938736', '-117.93725599999999', '840 E Whittier Blvd, La Habra, CA, USA'),
('33.938736', '-117.93725599999999', '840 E Whittier Blvd, La Habra, CA, USA'),
('31.470334', '-83.63726400000002', 'ty, ty, ty, ty'),
('51.253775', '-85.32321389999998', 'Ontario, Canada'),
('44.200797', '24.502298099999962', '0, 0, 0, 0'),
('44.200797', '24.502298099999962', '0, 0, 0, 0'),
('36.91472220000001', '-111.4558333', 'p, p, p, p'),
('33.660297', '-117.99922650000002', ', Huntington Beach, CA, USA'),
('33.6566684', '-118.00255820000001', '22 main st., Huntington Beach, CA, USA'),
('33.6566684', '-118.00255820000001', '22 main st., Huntington Beach, CA, USA'),
('33.740871', '-118.00890219999997', '6882 Cumberland Dr., Huntington Beach, CA, USA'),
('33.740871', '-118.00890219999997', '6882 Cumberland Dr., Huntington Beach, CA, USA'),
('33.740871', '-118.00890219999997', '6882 Cumberland Dr., Huntington Beach, CA, USA'),
('33.6566684', '-118.00255820000001', '22 main st, huntington beach, ca, usa'),
('33.6566684', '-118.00255820000001', '22 main st, huntington beach, ca, usa'),
('33.6566684', '-118.00255820000001', '22 main st, huntington beach, ca, usa'),
('33.660297', '-117.99922650000002', 'huntington beach, ca, usa'),
('33.7091847', '-117.95366969999998', 'fountain valley, ca, usa'),
('33.660297', '-117.99922650000002', 'Huntington beach, ca, usa');

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE IF NOT EXISTS `logins` (
  `PASSWORD` varchar(100) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `TYPE` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`PASSWORD`, `EMAIL`, `TYPE`) VALUES
('55237ab9371b8c293d04ded9667ae8e0', 'joseph.sirna@gmail.com', 'MENTOR'),
('729ff12d3a1d3a801389a0118499b15b', 'miriammelendez78@yahoo.com', 'MENTOR'),
('71b47418dcf37583c4401118f98cd506', 'erick.locke.2@gmail.com', 'MENTOR'),
('5747fd889d7a45f982d98fe713588071', 'jonathan.logrippo@servitehs.org', 'MENTOR'),
('490146a2eb2b7307f3aad4b58b641321', 'events@team3309.org', 'TEAM'),
('495817934838fd98105a34800f41c33f', 'momentumrobotics@gmail.com', 'TEAM'),
('11735120082bc8ddc13c177626971ff2', 'code@orange.com', 'TEAM'),
('2738694a8517427e75dee2d88ccabf03', 'jfl2900@drkstr.com', 'MENTOR'),
('ae20672f40695820725ad2d0ab61d63e', 'jetengr@gmail.com', 'MENTOR'),
('336bb369eafe4470ad59b110e899dd84', 'jetengr@team3309.org', 'MENTOR');

-- --------------------------------------------------------

--
-- Table structure for table `survey_results`
--

CREATE TABLE IF NOT EXISTS `survey_results` (
  `REC_FRIEND` varchar(100) DEFAULT NULL,
  `REC_FEATURES` varchar(100) DEFAULT NULL,
  `TO_ADD_FEATURES` varchar(100) DEFAULT NULL,
  `DISLIKED_FEATURES` varchar(100) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `WHY` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey_results`
--

INSERT INTO `survey_results` (`REC_FRIEND`, `REC_FEATURES`, `TO_ADD_FEATURES`, `DISLIKED_FEATURES`, `EMAIL`, `WHY`) VALUES
('false', '', '', '', 'jonathan.logrippo@servitehs.org', NULL),
('false', '', '', '', 'joseph.sirna@gmail.com', NULL),
('false', '', '', '', 'joseph.sirna@gmail.com', NULL),
('false', 'algorithm', 'khfgcjhgc', 'map', 'joseph.sirna@gmail.com', NULL),
('true', 'map', '', 'sponsor_filter', 'joseph.sirna@gmail.com', NULL),
('false', 'map', '', 'sponsor_filter', 'joseph.sirna@gmail.com', NULL),
('false', '', '', '', 'joseph.sirna@gmail.com', NULL),
('false', '', '', '', 'joseph.sirna@gmail.com', NULL),
('false', '', '', '', 'joseph.sirna@gmail.com', NULL),
('false', '', '', '', 'joseph.sirna@gmail.com', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
