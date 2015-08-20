-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2015 at 01:40 AM
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
  `ACCOUNT_TYPE` varchar(6) DEFAULT NULL,
  `LATITUDE` varchar(100) DEFAULT NULL,
  `LONGITUDE` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`NAME`, `SKILLS_JSON`, `TEAM_NUMBER`, `COMMENTS`, `PHONE`, `EMAIL`, `ADDRESS`, `TYPE`, `AGE`, `ACCOUNT_TYPE`, `LATITUDE`, `LONGITUDE`) VALUES
('m1', '{"skill-engineering":"false","engineering-desc":{"engineering-mechanical":"false","engineering-electrical":"false"},"skill-programming":"true","programming-desc":{"programming-c":"false","programming-java":"true","programming-csharp":"true","programming-python":"false","programming-robotc":"true","programming-labview":"false","programming-easyc":"false","programming-nxt":"false","programming-ev3":"false"},"skill-cad":"false","skill-strategy":"false","skill-business":"false","skill-marketing":"false","skill-manufacturing":"false","skill-design":"false","skill-scouting":"false","skill-fundraising":"false","skill-other":"false","skill-other-desc":""}', '76', '', '', 'm1', '1021 N Hensel Dr, La Habra, CA, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', 'NULL', 'MENTOR', '33.9408116', '-117.93860990000002'),
('t1', '{"skill-engineering":"false","engineering-desc":{"engineering-mechanical":"false","engineering-electrical":"false"},"skill-programming":"true","skill-cad":"false","programming-desc":{"programming-c":"false","programming-java":"true","programming-csharp":"true","programming-python":"false","programming-robotc":"true","programming-labview":"false","programming-easyc":"false","programming-nxt":"false","programming-ev3":"false"},"skill-strategy":"false","skill-business":"false","skill-marketing":"false","skill-manufacturing":"false","skill-design":"false","skill-scouting":"false","skill-fundraising":"false","skill-other":"false","skill-other-desc":""}', 't1', '', '', 't1', 'the cat and the custard cup, la habra, ca, usa', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', 'Experienced Team', 'TEAM', '33.9319578', '-117.94617340000002'),
('Megan Guttieri', '{"skill-engineering":"true","engineering-desc":{"engineering-mechanical":"true","engineering-electrical":"false"},"skill-programming":"false","programming-desc":{"programming-c":"false","programming-java":"false","programming-csharp":"false","programming-python":"false","programming-robotc":"false","programming-labview":"false","programming-easyc":"false","programming-nxt":"false","programming-ev3":"false"},"skill-cad":"false","skill-strategy":"true","skill-business":"true","skill-marketing":"true","skill-manufacturing":"false","skill-design":"false","skill-scouting":"true","skill-fundraising":"true","skill-other":"false","skill-other-desc":""}', '3309', 'I love FIRST! ', '5627545479', 'meganguttieri@gmail.com', '2333 Promontory Dr., Signal Hill, California, United States', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', '18', 'MENTOR', NULL, NULL),
('David Carr', '{"skill-engineering":"true","engineering-desc":{"engineering-mechanical":"false","engineering-electrical":"true"},"skill-programming":"true","programming-desc":{"programming-c":"true","programming-java":"true","programming-csharp":"false","programming-python":"true","programming-robotc":"false","programming-labview":"false","programming-easyc":"false","programming-nxt":"false","programming-ev3":"false"},"skill-cad":"false","skill-strategy":"true","skill-business":"true","skill-marketing":"false","skill-manufacturing":"false","skill-design":"false","skill-scouting":"true","skill-fundraising":"false","skill-other":"false","skill-other-desc":""}', '3309', 'David is a college mentor and former student on Team 3309 and cofounder of the Orange County Robotics Alliance.  He studies Computer Science at USC and currently works as a software engineering intern', '714-248-6776', 'david@team3309.org', '934 N. Keystone, Anaheim, CA, United States', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', '21', 'MENTOR', NULL, NULL),
('Jon Logrippo', '{"skill-engineering":"false","engineering-desc":{"engineering-mechanical":"false","engineering-electrical":"false"},"skill-programming":"false","programming-desc":{"programming-c":"false","programming-java":"false","programming-csharp":"false","programming-python":"false","programming-robotc":"false","programming-labview":"false","programming-easyc":"false","programming-nxt":"false","programming-ev3":"false"},"skill-cad":"false","skill-strategy":"false","skill-business":"true","skill-marketing":"true","skill-manufacturing":"false","skill-design":"false","skill-scouting":"true","skill-fundraising":"true","skill-other":"false","skill-other-desc":""}', '3309', 'Something about yourself', '7143293808', 'jonathan.logrippo@servitehs.org', '1800 N. Boisseranc Dr, Anaheim, California, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', '0', 'MENTOR', '33.868209', '-117.80994299999998');

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
('43943cbde1a94a4ccf7d64e387b4a406', 'm1', 'MENTOR'),
('27607db4c68d1e06411fa66c61598617', 't1', 'TEAM'),
('89643b6f06a1d5645683f1b409e51298', 'meganguttieri@gmail.com', 'MENTOR'),
('eeca20998a75655b4dd53a33b3a0c3aa', 'david@team3309.org', 'MENTOR'),
('b06ce418fc6e048dbc6d110237ed1b54', 'jonathan.logrippo@servitehs.org', 'MENTOR');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `guid` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
('false', 'map', 'gay stuff', 'map', 'm1', NULL),
('false', 'sponsor_filter', '<script type="text/javascript">document.write("ross");</script>', 'algorithm', 't1', 'kl;bouvpi SVRG'),
('false', 'map', 'iongouiabresiopg["""""""""""""""""""""""""""""""""', 'map', 't1', 'im a dirty little hacker:  src="./script.js">document.write("roass");</script>');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
