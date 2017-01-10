-- 
-- UPLOAD THIS FILE TO YOUR MYSQL
-- 
--

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `databasename`
--

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `slt_link_id` int(11) NOT NULL AUTO_INCREMENT,
  `slt_link_url` varchar(255) NOT NULL,
  `slt_link_baseurl` varchar(255) NOT NULL,
  `slt_link_userid` varchar(255) NOT NULL,
  `slt_link_trackingid` varchar(255) NOT NULL,
  `slt_link_total` varchar(255) NOT NULL,
  `slt_link_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`slt_link_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `links`
--

INSERT INTO `links` VALUES(24, 'http://mvrclabs.info/linktracker/?src=0032fb939e3425e65db3b6867ced8b80', 'http://marcosraudkett.com/', '1', '0032fb939e3425e65db3b6867ced8b80', '0', '2017-01-09 16:18:22');

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

CREATE TABLE `tracking` (
  `slt_tracking_id` int(11) NOT NULL AUTO_INCREMENT,
  `slt_tracking_trackid` varchar(255) NOT NULL,
  `slt_tracking_ipaddr` varchar(255) NOT NULL,
  `slt_tracking_referral` varchar(255) NOT NULL,
  `slt_tracking_useragent` varchar(255) NOT NULL,
  `slt_tracking_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`slt_tracking_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tracking`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `slt_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `slt_user_email` varchar(255) NOT NULL,
  `slt_user_password` varchar(255) NOT NULL,
  `slt_user_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`slt_user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES(1, 'admin@slt.com', '123123', '2017-01-09 04:59:43');
