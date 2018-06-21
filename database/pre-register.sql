-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 02, 2017 at 02:28 PM
-- Server version: 5.6.35
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amirtir_pre-register`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `adminUserName` varchar(255) DEFAULT NULL,
  `adminPassword` varchar(255) DEFAULT NULL,
  `adminEmail` varchar(255) DEFAULT NULL,
  `deptID` int(11) DEFAULT NULL,
  `adminLastVisitedTime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `adminUserName`, `adminPassword`, `adminEmail`, `deptID`, `adminLastVisitedTime`) VALUES
(1, 'admin', 'd91b0099918abed8f7f6199d50ef4239', 'admin@gmail.com', 1, '2017-03-13 02:38:20'),
(2, 'admin2', '79ac83d5b2bf882dd2a07452f8688aba', 'admin2@gmail.com', 1, '2017-03-18 14:41:17'),
(3, 'admin3', '246bcfd71520ec694b764c60d8b79d79', 'admin3@gmail.com', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `ID` int(11) NOT NULL,
  `courseName` varchar(255) DEFAULT NULL,
  `courseCode` varchar(255) DEFAULT NULL,
  `courseOccupied` varchar(255) DEFAULT '0',
  `courseUnit` varchar(255) DEFAULT NULL,
  `deptID` int(11) DEFAULT NULL,
  `courseType` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`ID`, `courseName`, `courseCode`, `courseOccupied`, `courseUnit`, `deptID`, `courseType`) VALUES
(35, 'هوش مصنوعی', '7777208', '2', '3', 1, 'نظری'),
(36, 'تحلیل و طراحی سیستم ها', '7777135', '3', '3', 1, 'نظری'),
(37, 'شبکه های کامپیوتری', '7777144', '2', '3', 1, 'نظری'),
(38, 'ریز پردازنده', '7777207', '3', '3', 1, 'نظری'),
(39, 'آز منطقی و معماری', '7777211', '2', '1', 1, 'عملی');

-- --------------------------------------------------------

--
-- Table structure for table `course_term`
--

CREATE TABLE `course_term` (
  `courseID` int(11) NOT NULL,
  `term` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_term`
--

INSERT INTO `course_term` (`courseID`, `term`, `year`) VALUES
(35, '2', '1395'),
(36, '2', '1395'),
(37, '2', '1395'),
(38, '2', '1395'),
(39, '2', '1395');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `deptID` int(11) NOT NULL,
  `deptName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`deptID`, `deptName`) VALUES
(1, 'گروه کامپیوتر');

-- --------------------------------------------------------

--
-- Table structure for table `option`
--

CREATE TABLE `option` (
  `ID` int(11) NOT NULL,
  `opName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `option`
--

INSERT INTO `option` (`ID`, `opName`) VALUES
(1, 'confirmed'),
(2, 'currentTerm'),
(3, 'currentYear'),
(4, 'maxAllowedUnit');

-- --------------------------------------------------------

--
-- Table structure for table `option-department`
--

CREATE TABLE `option-department` (
  `opID` int(11) NOT NULL,
  `deptID` int(11) NOT NULL,
  `opValue` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `option-department`
--

INSERT INTO `option-department` (`opID`, `deptID`, `opValue`) VALUES
(1, 1, 'ON'),
(2, 1, '2'),
(3, 1, '1395'),
(4, 1, '21');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `ID` int(11) NOT NULL,
  `studentID` varchar(15) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `takenUnits` varchar(255) DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  `confirmed` varchar(255) DEFAULT NULL,
  `registerTime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `lastVisitedTime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deptID` int(11) DEFAULT NULL,
  `entryYear` varchar(255) DEFAULT NULL,
  `allowedUnit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`ID`, `studentID`, `password`, `firstName`, `lastName`, `takenUnits`, `email`, `confirmed`, `registerTime`, `lastVisitedTime`, `deptID`, `entryYear`, `allowedUnit`) VALUES
(41, '9350015', '246bcfd71520ec694b764c60d8b79d79', 'امیررضا', 'دشتی', '7', 'dashti.amir2752@gmail.com', 'ON', '2017-03-19 19:23:59', '2017-03-19 19:23:59', 1, '1393', 10),
(42, '9350001', '6ffca973d30b49096d27b1abd0560471', 'کوثر', 'احمدی بهبهانی', '0', 'kosar501.75@gmail.com', 'ON', '2017-03-19 19:17:24', '2017-03-19 19:17:24', 1, '1393', 21),
(43, '941617', '34bc63102d9daf496ac4316058ae2063', 'اسم', 'فامیل', '0', 'abc@def.com', 'OFF', '2017-03-19 19:17:24', '2017-03-19 19:17:24', 1, '1394', 21),
(44, '9350017', '34bc63102d9daf496ac4316058ae2063', 'کاربر تست', 'فامیل تست', '12', 'seaf@srgs.com', 'ON', '2017-03-19 19:23:59', '2017-03-19 19:23:59', 1, '1393', 17),
(45, '9356306', 'fe774ce4111d6db9cb07abd990483b52', 'محمد', 'پشم فروش', '13', 'pashmforoosh75@yahoo.com', 'ON', '2017-03-19 19:59:08', '2017-03-19 19:59:08', 1, '1393', 21);

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE `student_course` (
  `studentID` int(11) DEFAULT NULL,
  `courseID` int(11) DEFAULT NULL,
  `term` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_course`
--

INSERT INTO `student_course` (`studentID`, `courseID`, `term`, `year`) VALUES
(41, 39, '2', '1395'),
(41, 36, '2', '1395'),
(41, 38, '2', '1395'),
(44, 36, '2', '1395'),
(44, 38, '2', '1395'),
(44, 37, '2', '1395'),
(44, 35, '2', '1395'),
(45, 39, '2', '1395'),
(45, 36, '2', '1395'),
(45, 38, '2', '1395'),
(45, 37, '2', '1395'),
(45, 35, '2', '1395');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FGKey7` (`deptID`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FGKey6` (`deptID`);

--
-- Indexes for table `course_term`
--
ALTER TABLE `course_term`
  ADD UNIQUE KEY `Key` (`courseID`,`term`,`year`) USING BTREE;

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`deptID`);

--
-- Indexes for table `option`
--
ALTER TABLE `option`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `option-department`
--
ALTER TABLE `option-department`
  ADD UNIQUE KEY `op-dep` (`opID`,`deptID`) USING BTREE,
  ADD KEY `FGKey10` (`deptID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FGKey5` (`deptID`);

--
-- Indexes for table `student_course`
--
ALTER TABLE `student_course`
  ADD KEY `FGKey2` (`courseID`),
  ADD KEY `FGKey3` (`term`),
  ADD KEY `FGKey4` (`year`),
  ADD KEY `FGKey1` (`studentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `deptID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `option`
--
ALTER TABLE `option`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `FGKey7` FOREIGN KEY (`deptID`) REFERENCES `department` (`deptID`) ON UPDATE CASCADE;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `FGKey6` FOREIGN KEY (`deptID`) REFERENCES `department` (`deptID`) ON UPDATE CASCADE;

--
-- Constraints for table `course_term`
--
ALTER TABLE `course_term`
  ADD CONSTRAINT `FGKey3` FOREIGN KEY (`courseID`) REFERENCES `course` (`ID`) ON UPDATE CASCADE;

--
-- Constraints for table `option-department`
--
ALTER TABLE `option-department`
  ADD CONSTRAINT `FGKey10` FOREIGN KEY (`deptID`) REFERENCES `department` (`deptID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FGKey9` FOREIGN KEY (`opID`) REFERENCES `option` (`ID`) ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `FGKey5` FOREIGN KEY (`deptID`) REFERENCES `department` (`deptID`) ON UPDATE CASCADE;

--
-- Constraints for table `student_course`
--
ALTER TABLE `student_course`
  ADD CONSTRAINT `FGKey1` FOREIGN KEY (`studentID`) REFERENCES `student` (`ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FGKey2` FOREIGN KEY (`courseID`) REFERENCES `course` (`ID`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
