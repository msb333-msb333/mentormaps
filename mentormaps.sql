-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2015 at 03:35 AM
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
-- Table structure for table `assoc`
--

CREATE TABLE IF NOT EXISTS `assoc` (
  `interested-in-me` varchar(9999) DEFAULT NULL,
  `interested-in` varchar(9999) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  UNIQUE KEY `index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assoc`
--

INSERT INTO `assoc` (`interested-in-me`, `interested-in`, `email`) VALUES
('["m3@mrflark.org"]', '["m4@mrflark.org","m3@mrflark.org","friarbots_email@mrflark.org"]', 'joseph.sirna@gmail.com'),
('[]', '[]', 'mentor2@mrflark.org'),
('["joseph.sirna@gmail.com"]', '["joseph.sirna@gmail.com"]', 'm3@mrflark.org'),
('["joseph.sirna@gmail.com"]', '[]', 'm4@mrflark.org'),
('["joseph.sirna@gmail.com"]', NULL, 'friarbots_email@mrflark.org'),
(NULL, NULL, 'friarbots_2@mrflark.org'),
(NULL, NULL, 't1@mrflark.org'),
(NULL, NULL, 't2@mrflark.org'),
(NULL, NULL, 't3@mrflark.org');

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
('Joseph Sirna', '{"skill-engineering":"false","engineering-desc":{"engineering-mechanical":"false","engineering-electrical":"false"},"skill-programming":"true","programming-desc":{"programming-c":"true","programming-java":"true","programming-csharp":"true","programming-python":"false","programming-robotc":"true","programming-labview":"false","programming-easyc":"false","programming-nxt":"false","programming-ev3":"false"},"skill-cad":"false","skill-strategy":"false","skill-business":"false","skill-marketing":"false","skill-manufacturing":"false","skill-design":"false","skill-scouting":"false","skill-fundraising":"false","skill-other":"false","skill-other-desc":""}', '3309', 'I made this website', '5626650405', 'joseph.sirna@gmail.com', '1021 N Hensel Dr, La Habra, CA, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"true"}', '2', 'MENTOR', '33.9408116', '-117.93860990000002'),
('Friarbots-FRC', '{"skill-engineering":"true","engineering-desc":{"engineering-mechanical":"false","engineering-electrical":"true"},"skill-programming":"true","skill-cad":"false","programming-desc":{"programming-c":"false","programming-java":"true","programming-csharp":"false","programming-python":"false","programming-robotc":"false","programming-labview":"false","programming-easyc":"false","programming-nxt":"false","programming-ev3":"false"},"skill-strategy":"true","skill-business":"false","skill-marketing":"false","skill-manufacturing":"true","skill-design":"false","skill-scouting":"true","skill-fundraising":"true","skill-other":"false","skill-other-desc":""}', '3309', '', '', 'friarbots_email@mrflark.org', '934 N Keystone St, Anaheim, CA, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', 'Experienced Team', 'TEAM', '33.8451499', '-117.95057600000001'),
('Friarbots-VEX', '{"skill-engineering":"true","engineering-desc":{"engineering-mechanical":"true","engineering-electrical":"false"},"skill-programming":"true","programming-desc":{"programming-c":"false","programming-java":"false","programming-csharp":"false","programming-python":"false","programming-robotc":"true","programming-labview":"false","programming-easyc":"false","programming-nxt":"false","programming-ev3":"false"},"skill-cad":"false","skill-strategy":"true","skill-business":"false","skill-marketing":"false","skill-manufacturing":"false","skill-design":"true","skill-scouting":"true","skill-fundraising":"false","skill-other":"false","skill-other-desc":""}', '9983', '', '', 'friarbots_2@mrflark.org', 'Keystone St, Anaheim, CA, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"false","pref_vex":"true"}', 'Experienced Team', 'TEAM', '33.8437488', '-117.95085840000002'),
('mentor_2', '{"skill-engineering":"true","engineering-desc":{"engineering-mechanical":"true","engineering-electrical":"false"},"skill-programming":"true","programming-desc":{"programming-c":"true","programming-java":"false","programming-csharp":"false","programming-python":"false","programming-robotc":"false","programming-labview":"false","programming-easyc":"false","programming-nxt":"false","programming-ev3":"false"},"skill-cad":"false","skill-strategy":"true","skill-business":"true","skill-marketing":"true","skill-manufacturing":"true","skill-design":"true","skill-scouting":"false","skill-fundraising":"true","skill-other":"false","skill-other-desc":""}', '', '', '', 'mentor2@mrflark.org', '1556 N Walnut St, La Habra Heights, CA, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"true"}', '3', 'MENTOR', '33.948773', '-117.945762'),
('mentor_3', '{"skill-engineering":"true","engineering-desc":{"engineering-mechanical":"false","engineering-electrical":"true"},"skill-programming":"true","programming-desc":{"programming-c":"false","programming-java":"false","programming-csharp":"false","programming-python":"false","programming-robotc":"true","programming-labview":"false","programming-easyc":"false","programming-nxt":"true","programming-ev3":"false"},"skill-cad":"true","skill-strategy":"false","skill-business":"true","skill-marketing":"false","skill-manufacturing":"false","skill-design":"true","skill-scouting":"false","skill-fundraising":"false","skill-other":"false","skill-other-desc":""}', '', '', '', 'm3@mrflark.org', '2429 Greenwich Dr, Fullerton, CA, USA', '{"pref_fll":"true","pref_ftc":"false","pref_frc":"false","pref_vex":"false"}', '5', 'MENTOR', '33.896709', '-117.96810800000003'),
('mentor_4', '{"skill-engineering":"true","engineering-desc":{"engineering-mechanical":"true","engineering-electrical":"false"},"skill-programming":"false","programming-desc":{"programming-c":"false","programming-java":"false","programming-csharp":"false","programming-python":"false","programming-robotc":"false","programming-labview":"false","programming-easyc":"false","programming-nxt":"false","programming-ev3":"false"},"skill-cad":"false","skill-strategy":"false","skill-business":"false","skill-marketing":"true","skill-manufacturing":"false","skill-design":"false","skill-scouting":"true","skill-fundraising":"false","skill-other":"true","skill-other-desc":"other_skill_desc_test"}', '', '', '', 'm4@mrflark.org', '2101 Cheyenne Way, Fullerton, CA, USA', '{"pref_fll":"true","pref_ftc":"false","pref_frc":"false","pref_vex":"false"}', '1', 'MENTOR', '33.8972995', '-117.98476089999997'),
('team1', '{"skill-engineering":"true","engineering-desc":{"engineering-mechanical":"true","engineering-electrical":"true"},"skill-programming":"true","programming-desc":{"programming-c":"false","programming-java":"false","programming-csharp":"false","programming-python":"false","programming-robotc":"true","programming-labview":"true","programming-easyc":"false","programming-nxt":"true","programming-ev3":"false"},"skill-cad":"false","skill-strategy":"false","skill-business":"false","skill-marketing":"true","skill-manufacturing":"false","skill-design":"true","skill-scouting":"false","skill-fundraising":"true","skill-other":"false","skill-other-desc":""}', '1', '', '', 't1@mrflark.org', '14214 Whittier Blvd, Whittier, CA, USA', '{"pref_fll":"false","pref_ftc":"true","pref_frc":"false","pref_vex":"false"}', 'Rookie Team', 'TEAM', '33.956128', '-118.02096340000003'),
('team_2', '{"skill-engineering":"true","engineering-desc":{"engineering-mechanical":"true","engineering-electrical":"false"},"skill-programming":"false","programming-desc":{"programming-c":"false","programming-java":"false","programming-csharp":"false","programming-python":"false","programming-robotc":"false","programming-labview":"false","programming-easyc":"false","programming-nxt":"false","programming-ev3":"false"},"skill-cad":"false","skill-strategy":"true","skill-business":"false","skill-marketing":"true","skill-manufacturing":"false","skill-design":"true","skill-scouting":"true","skill-fundraising":"false","skill-other":"false","skill-other-desc":""}', '2', '', '', 't2@mrflark.org', '6110 Seville Ave, Huntington Park, CA, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"false","pref_vex":"true"}', 'Experienced Team', 'TEAM', '33.984782', '-118.22232600000001'),
('team_3', '{"skill-engineering":"false","engineering-desc":{"engineering-mechanical":"false","engineering-electrical":"false"},"skill-programming":"false","programming-desc":{"programming-c":"false","programming-java":"false","programming-csharp":"false","programming-python":"false","programming-robotc":"false","programming-labview":"false","programming-easyc":"false","programming-nxt":"false","programming-ev3":"false"},"skill-cad":"false","skill-strategy":"true","skill-business":"false","skill-marketing":"false","skill-manufacturing":"false","skill-design":"false","skill-scouting":"false","skill-fundraising":"false","skill-other":"false","skill-other-desc":""}', '3', '', '', 't3@mrflark.org', '505 W Pacific Coast Hwy, Wilmington, CA 90744, USA', '{"pref_fll":"false","pref_ftc":"true","pref_frc":"false","pref_vex":"false"}', 'Experienced Team', 'TEAM', '33.7910948', '-118.26826979999998');

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE IF NOT EXISTS `logins` (
  `PASSWORD` varchar(100) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `TYPE` varchar(100) DEFAULT NULL,
  `VERIFIED` varchar(5) NOT NULL,
  `KEY` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`PASSWORD`, `EMAIL`, `TYPE`, `VERIFIED`, `KEY`) VALUES
('a9f97ae4373552996477fa4bbeb988e9', 'joseph.sirna@gmail.com', 'MENTOR', 'true', 'c694a956f67b3588afd5d5e78b7c42b257d2a065f9a55b6b8a6849f192d260b8'),
('26e904ab7f364d328f237591a9e40ca7', 'friarbots_email@mrflark.org', 'TEAM', 'false', 'd1d3e7abc02211c677af54edaf610a745c9b2b4e7ba1ece782250838e02b731c'),
('a81b28af0a2c5eb38fa8fbc29b0334bd', 'friarbots_2@mrflark.org', 'TEAM', 'false', 'd3b394b6950440231fa26eaa4b8f076c8aa0f95c93b5f317ccc73643a17d2bd2'),
('7f2ee1c76745ffaa5c5c023025fb7e9c', 'mentor2@mrflark.org', 'MENTOR', 'false', 'da489e4810d40419376c0c4e28b0c7f1ea29c9c8a404f1843d93ca47db62f3c7'),
('c2d7650e5464341153817040bc9e6e6c', 'm3@mrflark.org', 'MENTOR', 'false', 'e179ea385f0973eb357d0d3fa37f656ffeba4aecedefc3cc910ae5a28f23747b'),
('e7495afa4bb6e48abf2e95ba57a85fe8', 'm4@mrflark.org', 'MENTOR', 'false', '79e99951733e8641f0be14fa601de102151e9e414075636f012625c2fd3ef163'),
('be30350bb117388a9e2317fc7e2ef285', 't1@mrflark.org', 'TEAM', 'false', '10ceb17a11b78b718c11d42d5ef05f88d42c5052199b95e1c3a13a28add658cc'),
('193df95a8c77d908156cf340d007fff8', 't2@mrflark.org', 'TEAM', 'false', 'a944f8ad7dfba4a374f6985f19937a354499ff23af3638107efd99a52584689d'),
('c623430d85fe072676dead5a9c83c429', 't3@mrflark.org', 'TEAM', 'false', '074e155feb6ee1d3283bc2d242c5088a9a3e18bc352f24780aaf9a4a254618bf');

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
  `WHY` varchar(200) DEFAULT NULL,
  UNIQUE KEY `index` (`EMAIL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
