-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2022 at 12:31 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tournament`
--

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `pid` int(10) NOT NULL,
  `pname` varchar(30) NOT NULL,
  `age` varchar(3) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `bloodgroup` varchar(5) DEFAULT NULL,
  `teamid` varchar(10) DEFAULT NULL,
  `captain` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`pid`, `pname`, `age`, `email`, `password`, `address`, `bloodgroup`, `teamid`, `captain`) VALUES
(1, 'admin1111', '22', 'admin11@gmail.com', 'abcdefg', 'asdf', 'O+', '1', 2),
(2, 'avinashttellakula', '20', 'avinashtellakula16@gmail.com', 'abcdefg', 'qwer', 'A+', '1', 2),
(3, 'rakesh8', '24', 'rakesh8@gmail.com', 'abcdefg', 'zxcv', 'AB-', '2', 4),
(4, 'yaswanth', '25', 'yaswanth@gmail.com', 'abcdefg', 'zxcv', 'AB+', '2', 4),
(5, 'kalyan9876', '23', 'kalyan@gmail.com', 'abcdefgh', 'hjkl', 'B+', '2', 4),
(7, 'badrish', '20', 'badri@gmail.com', 'abcdefg', 'asdf', 'A+', NULL, NULL),
(8, 'balu8461', '22', 'balu@gmail.com', 'abcdefgh', 'ghjk', 'AB+', '3', 8),
(10, 'avinash111', '22', '198w1a05c0@vrsiddhartha.ac.in', 'abcdefg', 'ghjk', 'A+', '1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `teamid` int(10) NOT NULL,
  `teamname` varchar(30) NOT NULL,
  `count` varchar(10) DEFAULT NULL,
  `captain` varchar(10) DEFAULT NULL,
  `wins` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`teamid`, `teamname`, `count`, `captain`, `wins`) VALUES
(1, 'Blue Badgers', '3', '2', '0'),
(2, 'Black Tigers', '3', '4', '0'),
(3, 'Chennai chasers', '1', '8', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tourevents`
--

CREATE TABLE `tourevents` (
  `tid` int(10) NOT NULL,
  `tname` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(15) NOT NULL,
  `minteams` varchar(10) NOT NULL,
  `pperteam` varchar(10) NOT NULL,
  `teamids` varchar(400) DEFAULT NULL,
  `time` time NOT NULL,
  `duration` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tourevents`
--

INSERT INTO `tourevents` (`tid`, `tname`, `type`, `start_date`, `end_date`, `status`, `minteams`, `pperteam`, `teamids`, `time`, `duration`) VALUES
(1, 'Hand Cricket', 'single', '2022-07-06', '2022-07-20', 'Active', '4', '1', '', '10:00:00', NULL),
(2, 'Cricket', 'team', '2022-07-14', '2022-07-16', 'Active', '6', '7', '', '13:30:00', NULL),
(3, 'Football', 'team', '2022-07-11', '2022-07-16', 'Active', '8', '4', '', '16:45:00', NULL),
(4, 'd', 'single', '2022-07-01', '2022-07-13', 'Active', '7', '1', '', '18:30:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tourparti`
--

CREATE TABLE `tourparti` (
  `tid` int(10) NOT NULL,
  `pid` int(10) NOT NULL,
  `disqualify` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tourparti`
--

INSERT INTO `tourparti` (`tid`, `pid`, `disqualify`) VALUES
(1, 1, '0'),
(1, 5, '0'),
(1, 7, '0'),
(1, 8, '0'),
(1, 10, '0'),
(4, 2, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tourteams`
--

CREATE TABLE `tourteams` (
  `tid` varchar(10) NOT NULL,
  `teamid` int(10) NOT NULL,
  `captainpid` varchar(10) NOT NULL,
  `disqualifyteam` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tourteams`
--

INSERT INTO `tourteams` (`tid`, `teamid`, `captainpid`, `disqualifyteam`) VALUES
('2', 2, '4', '0'),
('2', 3, '8', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`teamid`);

--
-- Indexes for table `tourevents`
--
ALTER TABLE `tourevents`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `tourparti`
--
ALTER TABLE `tourparti`
  ADD PRIMARY KEY (`tid`,`pid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `tourteams`
--
ALTER TABLE `tourteams`
  ADD PRIMARY KEY (`tid`,`teamid`),
  ADD KEY `teamid` (`teamid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `teamid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tourevents`
--
ALTER TABLE `tourevents`
  MODIFY `tid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tourparti`
--
ALTER TABLE `tourparti`
  ADD CONSTRAINT `tourparti_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `participants` (`pid`);

--
-- Constraints for table `tourteams`
--
ALTER TABLE `tourteams`
  ADD CONSTRAINT `tourteams_ibfk_1` FOREIGN KEY (`teamid`) REFERENCES `team` (`teamid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
