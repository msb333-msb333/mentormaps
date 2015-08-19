-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2015 at 03:45 AM
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
('Friarbots', '{"skill-engineering":"true","engineering-desc":{"engineering-mechanical":"false","engineering-electrical":"false"},"skill-programming":"true","skill-cad":"true","programming-desc":{"programming-c":"false","programming-java":"true","programming-csharp":"false","programming-python":"true","programming-robotc":"true","programming-labview":"false","programming-easyc":"false","programming-nxt":"false","programming-ev3":"false"},"skill-strategy":"true","skill-business":"true","skill-marketing":"true","skill-manufacturing":"true","skill-design":"true","skill-scouting":"true","skill-fundraising":"true","skill-other":"false","skill-other-desc":""}', '3309', 'team info, this could get quite large, what if there are many characters here?  team info, this could get quite large, what if there are many characters here? team info, this could get quite large, wh', '7145551234', 'jetengr@yahoo.com', '1952 West La Palma Avenue, Anaheim, CA, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"false","pref_vex":"true"}', 'Experienced Team', 'TEAM'),
('Vikings', '{"skill-engineering":"true","engineering-desc":{"engineering-mechanical":"true","engineering-electrical":"true"},"skill-programming":"true","skill-cad":"false","programming-desc":{"programming-c":"false","programming-java":"false","programming-csharp":"false","programming-python":"false","programming-robotc":"false","programming-labview":"false","programming-easyc":"false","programming-nxt":"false","programming-ev3":"false"},"skill-strategy":"true","skill-business":"false","skill-marketing":"false","skill-manufacturing":"true","skill-design":"false","skill-scouting":"false","skill-fundraising":"false","skill-other":"false","skill-other-desc":""}', '4276', 'marina vikings', '7145551234', 'vikings', '15871 Springdale St, Huntington Beach, CA, usa', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', 'Experienced Team', 'TEAM'),
('test_mentor', '{"skill-engineering":"false","engineering-desc":{"engineering-mechanical":"false","engineering-electrical":"false"},"skill-programming":"false","programming-desc":{"programming-c":"false","programming-java":"false","programming-csharp":"false","programming-python":"false","programming-robotc":"false","programming-labview":"false","programming-easyc":"false","programming-nxt":"false","programming-ev3":"false"},"skill-cad":"false","skill-strategy":"false","skill-business":"false","skill-marketing":"false","skill-manufacturing":"false","skill-design":"false","skill-scouting":"false","skill-fundraising":"false","skill-other":"false","skill-other-desc":""}', '', '', '', 'e', '1021 N Hensel Dr, La Habra, CA, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', 'NULL', 'MENTOR'),
('ASmith', '{"skill-engineering":"true","engineering-desc":{"engineering-mechanical":"true","engineering-electrical":"false"},"skill-programming":"true","programming-desc":{"programming-c":"true","programming-java":"true","programming-csharp":"true","programming-python":"true","programming-robotc":"true","programming-labview":"false","programming-easyc":"false","programming-nxt":"false","programming-ev3":"false"},"skill-cad":"false","skill-strategy":"false","skill-business":"false","skill-marketing":"false","skill-manufacturing":"false","skill-design":"false","skill-scouting":"true","skill-fundraising":"true","skill-other":"false","skill-other-desc":""}', '', 'young mentor', '', 'ASmith', '6999 Cumberland Dr., huntington beach, ca, usa', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"true"}', 'NULL', 'MENTOR'),
('U.S. Coast Guard Academy, USCG Foundation, USCG Alumni Association & Local Supporters & Grosso Regio', NULL, '500', NULL, NULL, NULL, 'New London, CT, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', NULL, 'TEAM'),
('BURNDY/Dyn/4-H & MANCHESTER WEST HIGH SCHOOL & GOFFSTOWN HIGH SCHOOL', NULL, '501', NULL, NULL, NULL, 'Manchester, NH, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', NULL, 'TEAM'),
('Magna Seating Systems (Primary Sponsor)/Autoliv/AVL/Ford/NGK/Comcast/Softura/Denso/TechShop/Renesas/', NULL, '503', NULL, NULL, NULL, 'Novi, MI, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', NULL, 'TEAM'),
('Con Edison/Westchester Community College & Saunders Trades and Technical High School', NULL, '505', NULL, NULL, NULL, 'Yonkers, NY, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', NULL, 'TEAM'),
('U.S. Coast Guard Academy, USCG Foundation, USCG Alumni Association & Local Supporters & Grosso Regio', NULL, '500', NULL, NULL, NULL, 'New London, CT, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', NULL, 'TEAM'),
('BURNDY/Dyn/4-H & MANCHESTER WEST HIGH SCHOOL & GOFFSTOWN HIGH SCHOOL', NULL, '501', NULL, NULL, NULL, 'Manchester, NH, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', NULL, 'TEAM'),
('Magna Seating Systems (Primary Sponsor)/Autoliv/AVL/Ford/NGK/Comcast/Softura/Denso/TechShop/Renesas/', NULL, '503', NULL, NULL, NULL, 'Novi, MI, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', NULL, 'TEAM'),
('Con Edison/Westchester Community College & Saunders Trades and Technical High School', NULL, '505', NULL, NULL, NULL, 'Yonkers, NY, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', NULL, 'TEAM'),
('U.S. Coast Guard Academy, USCG Foundation, USCG Alumni Association & Local Supporters & Grosso Regio', NULL, '500', NULL, NULL, NULL, 'New London, CT, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', NULL, 'TEAM'),
('BURNDY/Dyn/4-H & MANCHESTER WEST HIGH SCHOOL & GOFFSTOWN HIGH SCHOOL', NULL, '501', NULL, NULL, NULL, 'Manchester, NH, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', NULL, 'TEAM'),
('Magna Seating Systems (Primary Sponsor)/Autoliv/AVL/Ford/NGK/Comcast/Softura/Denso/TechShop/Renesas/', NULL, '503', NULL, NULL, NULL, 'Novi, MI, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', NULL, 'TEAM'),
('Con Edison/Westchester Community College & Saunders Trades and Technical High School', NULL, '505', NULL, NULL, NULL, 'Yonkers, NY, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', NULL, 'TEAM'),
('U.S. Coast Guard Academy, USCG Foundation, USCG Alumni Association & Local Supporters & Grosso Regio', NULL, '500', NULL, NULL, NULL, 'New London, CT, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', NULL, 'TEAM'),
('BURNDY/Dyn/4-H & MANCHESTER WEST HIGH SCHOOL & GOFFSTOWN HIGH SCHOOL', NULL, '501', NULL, NULL, NULL, 'Manchester, NH, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', NULL, 'TEAM'),
('Magna Seating Systems (Primary Sponsor)/Autoliv/AVL/Ford/NGK/Comcast/Softura/Denso/TechShop/Renesas/', NULL, '503', NULL, NULL, NULL, 'Novi, MI, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', NULL, 'TEAM'),
('Con Edison/Westchester Community College & Saunders Trades and Technical High School', NULL, '505', NULL, NULL, NULL, 'Yonkers, NY, USA', '{"pref_fll":"false","pref_ftc":"false","pref_frc":"true","pref_vex":"false"}', NULL, 'TEAM');

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
('33.8467161', '-117.94944750000002', '1952 West La Palma Avenue, Anaheim, CA, USA'),
('33.8467161', '-117.94944750000002', '1952 West La Palma Avenue, Anaheim, CA, USA'),
('33.7315081', '-118.02718759999999', '15871 Springdale St, Huntington Beach, CA, usa'),
('33.9408116', '-117.93860990000002', '1021 N Hensel Dr, La Habra, CA, USA'),
('33.9408116', '-117.93860990000002', '1021 N Hensel Dr, La Habra, CA, USA'),
('33.9408116', '-117.93860990000002', '1021 N Hensel Dr, La Habra, CA, USA'),
('33.740906', '-118.00729230000002', '6999 Cumberland Dr., huntington beach, ca, usa'),
('41.3556539', '-72.0995209', 'New London, CT, USA'),
('42.9956397', '-71.4547891', 'Manchester, NH, USA'),
('40.6587138', '-73.6412406', 'Rockville Centre, NY, USA'),
('42.48059', '-83.4754913', 'Novi, MI, USA'),
('40.3367768', '-74.0470837', 'Little Silver, NJ, USA'),
('40.9312099', '-73.8987469', 'Yonkers, NY, USA'),
('40.8237097', '-73.3987314', 'South Huntington, NY, USA'),
('34.8526176', '-82.3940104', 'Greenville, SC, USA'),
('41.8096201', '-72.8305154', 'Avon, CT, USA'),
('42.9463291', '-71.5132008', 'Bedford, NH, USA'),
('37.545979', '-77.3277568', 'Highland Springs, VA, USA'),
('42.3020647', '-70.9078346', 'Hull, MA, USA'),
('35.4675602', '-97.5164276', 'Oklahoma City, OK, USA'),
('40.9598212', '-72.9962148', 'Miller Place, NY, USA'),
('42.331427', '-83.0457538', 'Detroit, MI, USA'),
('40.6984348', '-74.4015405', 'New Providence, NJ, USA'),
('42.9633599', '-85.6680863', 'Grand Rapids, MI, USA'),
('42.331427', '-83.0457538', 'Detroit, MI, USA'),
('29.7052284', '-95.1238204', 'Deer Park, TX, USA'),
('41.3542395', '-72.164816', 'Waterford, CT, USA'),
('40.5795317', '-74.1502007', 'Staten Island, NY, USA'),
('35.3732921', '-119.0187125', 'Bakersfield, CA, USA'),
('42.5348993', '-92.4453161', 'Cedar Falls, IA, USA');

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
('ce425d43c0acf8c824b4de7da9dacddb', 'jetengr@yahoo.com', 'TEAM'),
('9706620d136897c45c85bc0c220f4985', 'vikings', 'TEAM'),
('83ba4a6ce40e795134004b2cbafbd445', 'e', 'MENTOR'),
('45bfd47e52dde5e7c491a956a59d83b0', 'ASmith', 'MENTOR');

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
