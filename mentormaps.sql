-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2015 at 08:40 AM
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
  `COMMENTS` varchar(100) DEFAULT NULL,
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
('Joseph Sirna', '{"skill-mechanical-engineering":"false","skill-programming":"true","skill-strategy":"false","skill-business":"false","skill-marketing":"false","skill-manufacturing":"false","skill-design":"false","skill-scouting":"false","skill-fundraising":"false","skill-other":"false","skill-other-desc":""}', '3309', 'no', '5626650405', 'joseph.sirna@gmail.com', '1021 N Hensel Dr', '{"pref_fll":"false","pref_ftc":"true","pref_frc":"true"}', '16', 'MENTOR'),
('test_team_1', '{"skill-mechanical-engineering":"true","skill-programming":"true","skill-strategy":"true","skill-business":"false","skill-marketing":"false","skill-manufacturing":"false","skill-design":"true","skill-scouting":"false","skill-fundraising":"false","skill-other":"true","skill_other_desc":"no"}', '1234', 'no', '7614253324', 'e', 'Denver, CO', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true"}', '!TODO', 'TEAM'),
('test_team_2', '{"skill-mechanical-engineering":"false","skill-programming":"false","skill-strategy":"false","skill-business":"true","skill-marketing":"true","skill-manufacturing":"false","skill-design":"true","skill-scouting":"true","skill-fundraising":"true","skill-other":"false","skill_other_desc":""}', '2', '', '', 'e', 'Seattle, Washington', '{"pref_fll":"true","pref_ftc":"false","pref_frc":"false"}', '!TODO', 'TEAM'),
('mentor_2', '{"skill-mechanical-engineering":"true","skill-programming":"true","skill-strategy":"true","skill-business":"true","skill-marketing":"true","skill-manufacturing":"true","skill-design":"true","skill-scouting":"true","skill-fundraising":"true","skill-other":"true","skill-other-desc":"no"}', '12345', 'okay', '4345709899', 'e3', 'Albany, New York', '{"pref_fll":"true","pref_ftc":"false","pref_frc":"false"}', '34', 'MENTOR'),
('mentor_4', '{"skill-engineering":"true","engineering-desc":"{"engineering-mechanical":"true","engineering-electrical":"true"}","skill-programming":0,"programming-desc":"{"programming-c":"true","programming-java":"true","programming-csharp":"true","programming-python":"true","programming-robotc":"true","programming-labview":"true","programming-easyc":"true","programming-nxt":null,"programming-ev3":"true"}","skill-strategy":"true","skill-business":"true","skill-marketing":"true","skill-manufacturing":"true","skill-design":"true","skill-scouting":"true","skill-fundraising":"true","skill-other":"true","skill-other-desc":"no"}', '12356471623', 'asdfyoasdf', '532674578234', 'e4', 'Yorba Linda Blvd, Placentia, CA, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":null}', '35', 'MENTOR'),
('', '{"skill-engineering":null,"engineering-desc":"{"engineering-mechanical":null,"engineering-electrical":null}","skill-programming":0,"programming-desc":"{"programming-c":null,"programming-java":null,"programming-csharp":null,"programming-python":null,"programming-robotc":null,"programming-labview":null,"programming-easyc":null,"programming-nxt":null,"programming-ev3":null}","skill-strategy":null,"skill-business":null,"skill-marketing":null,"skill-manufacturing":null,"skill-design":null,"skill-scouting":null,"skill-fundraising":null,"skill-other":null,"skill-other-desc":""}', '', '', '', '', '', '{"pref_fll":null,"pref_ftc":null,"pref_frc":null,"pref_vex":null}', '', 'MENTOR'),
('', '{"skill-engineering":null,"engineering-desc":"{"engineering-mechanical":null,"engineering-electrical":null}","skill-programming":null,"programming-desc":"{"programming-c":null,"programming-java":null,"programming-csharp":null,"programming-python":null,"programming-robotc":null,"programming-labview":null,"programming-easyc":null,"programming-nxt":null,"programming-ev3":null}","skill-strategy":null,"skill-business":null,"skill-marketing":null,"skill-manufacturing":null,"skill-design":null,"skill-scouting":null,"skill-fundraising":null,"skill-other":null,"skill-other-desc":""}', '', '', '', '', '', '{"pref_fll":null,"pref_ftc":null,"pref_frc":null,"pref_vex":null}', '', 'MENTOR'),
('mentor_4', '{"skill-engineering":"true","engineering-desc":"{"engineering-mechanical":"false","engineering-electrical":"true"}","skill-programming":"true","programming-desc":"{"programming-c":"false","programming-java":"true","programming-csharp":"true","programming-python":"true","programming-robotc":"false","programming-labview":"true","programming-easyc":"false","programming-nxt":null,"programming-ev3":"false"}","skill-strategy":"false","skill-business":"false","skill-marketing":"false","skill-manufacturing":"true","skill-design":"true","skill-scouting":"true","skill-fundraising":"true","skill-other":"true","skill-other-desc":""}', 'jashbfk', '', 'odeshapfrouisd', 'n', 'ouhasouihf, kljbsdluikgb, iujbhsdiogjfb, iusdhfg', '{"pref_fll":"true","pref_ftc":"true","pref_frc":"true","pref_vex":null}', 'iohdsf', 'MENTOR'),
('mentor_4', '{"skill-engineering":"true","engineering-desc":"{"engineering-mechanical":"false","engineering-electrical":"true"}","skill-programming":"true","programming-desc":"{"programming-c":"false","programming-java":"true","programming-csharp":"true","programming-python":"true","programming-robotc":"false","programming-labview":"true","programming-easyc":"false","programming-nxt":null,"programming-ev3":"false"}","skill-strategy":"false","skill-business":"false","skill-marketing":"false","skill-manufacturing":"true","skill-design":"true","skill-scouting":"true","skill-fundraising":"true","skill-other":"true","skill-other-desc":""}', 'jashbfk', '', 'odeshapfrouisd', 'n', 'ouhasouihf, kljbsdluikgb, iujbhsdiogjfb, iusdhfg', '{"pref_fll":"true","pref_ftc":"true","pref_frc":"true","pref_vex":null}', 'iohdsf', 'MENTOR'),
('', '{"skill-engineering":"false","engineering-desc":"{"engineering-mechanical":"false","engineering-electrical":"false"}","skill-programming":"false","programming-desc":"{"programming-c":"false","programming-java":"false","programming-csharp":"false","programming-python":"false","programming-robotc":"false","programming-labview":"false","programming-easyc":"false","programming-nxt":null,"programming-ev3":"false"}","skill-strategy":"false","skill-business":"false","skill-marketing":"false","skill-manufacturing":"false","skill-design":"false","skill-scouting":"false","skill-fundraising":"false","skill-other":"false","skill-other-desc":""}', '', '', '', '', ', , , ', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"false","pref_vex":null}', '', 'MENTOR'),
('1', '{"skill-engineering":"true","engineering-desc":"{"engineering-mechanical":"false","engineering-electrical":"true"}","skill-programming":"true","programming-desc":"{"programming-c":"false","programming-java":"false","programming-csharp":"true","programming-python":"false","programming-robotc":"false","programming-labview":"true","programming-easyc":"true","programming-nxt":null,"programming-ev3":"false"}","skill-strategy":"false","skill-business":"true","skill-marketing":"false","skill-manufacturing":"false","skill-design":"false","skill-scouting":"true","skill-fundraising":"false","skill-other":"false","skill-other-desc":""}', '1', 'no', '1', '1', '1, 1, 1, 1', '{"pref_fll":"false","pref_ftc":"true","pref_frc":"true","pref_vex":null}', '1', 'MENTOR'),
('1', '{"skill-engineering":"true","engineering-desc":"{"engineering-mechanical":"false","engineering-electrical":"true"}","skill-programming":"true","programming-desc":"{"programming-c":"false","programming-java":"false","programming-csharp":"true","programming-python":"false","programming-robotc":"false","programming-labview":"true","programming-easyc":"true","programming-nxt":null,"programming-ev3":"false"}","skill-strategy":"false","skill-business":"true","skill-marketing":"false","skill-manufacturing":"false","skill-design":"false","skill-scouting":"true","skill-fundraising":"false","skill-other":"false","skill-other-desc":""}', '1', 'no', '1', '1', '1, 1, 1, 1', '{"pref_fll":"false","pref_ftc":"true","pref_frc":"true","pref_vex":null}', '1', 'MENTOR'),
('1', '{"skill-engineering":"true","engineering-desc":"{"engineering-mechanical":"false","engineering-electrical":"true"}","skill-programming":"true","programming-desc":"{"programming-c":"false","programming-java":"false","programming-csharp":"true","programming-python":"false","programming-robotc":"false","programming-labview":"true","programming-easyc":"true","programming-nxt":"false","programming-ev3":"false"}","skill-strategy":"false","skill-business":"true","skill-marketing":"false","skill-manufacturing":"false","skill-design":"false","skill-scouting":"true","skill-fundraising":"false","skill-other":"false","skill-other-desc":""}', '1', 'no', '1', '1', '1, 1, 1, 1', '{"pref_fll":"false","pref_ftc":"true","pref_frc":"true","pref_vex":"true"}', '1', 'MENTOR'),
('1', '{"skill-engineering":"true","engineering-desc":"{"engineering-mechanical":"false","engineering-electrical":"true"}","skill-programming":"true","skill-cad":"true","programming-desc":"{"programming-c":"false","programming-java":"false","programming-csharp":"true","programming-python":"false","programming-robotc":"false","programming-labview":"true","programming-easyc":"true","programming-nxt":"false","programming-ev3":"false"}","skill-strategy":"false","skill-business":"true","skill-marketing":"false","skill-manufacturing":"false","skill-design":"false","skill-scouting":"true","skill-fundraising":"false","skill-other":"false","skill-other-desc":""}', '1', '', '1', '1', '1, 1, 1, 1', '{"pref_fll":"false","pref_ftc":"true","pref_frc":"true","pref_vex":"true"}', '1', 'MENTOR');

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
('0e4260dd3059b582992e340a95a949db', 'e', 'TEAM'),
('83ba4a6ce40e795134004b2cbafbd445', 'e', 'TEAM'),
('4eba289f8d6618e94f65f8475289c85b', 'e3', 'MENTOR'),
('274aa8348ca701a2b54f625dd6fcabe2', 'e4', 'MENTOR'),
('ce19c5d4c3f2511a23f1639a1ba5d52f', '', 'MENTOR'),
('ce19c5d4c3f2511a23f1639a1ba5d52f', '', 'MENTOR'),
('dd1bae494643e02ae45aa3a896c4228e', 'n', 'MENTOR'),
('dd1bae494643e02ae45aa3a896c4228e', 'n', 'MENTOR'),
('ce19c5d4c3f2511a23f1639a1ba5d52f', '', 'MENTOR'),
('547ca5d217ed7b72a0d0cc24d6c9bf52', '1', 'MENTOR'),
('547ca5d217ed7b72a0d0cc24d6c9bf52', '1', 'MENTOR'),
('568b97e59777a4a7f16907513e231968', '1', 'MENTOR'),
('76a30ed9b36ec4264d336ac4cb1cdc26', '1', 'MENTOR');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
