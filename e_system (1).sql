-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Sep 16, 2023 at 06:52 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `A_ID` int(11) NOT NULL,
  `F_name` varchar(255) NOT NULL,
  `M_name` varchar(255) DEFAULT NULL,
  `L_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`A_ID`, `F_name`, `M_name`, `L_name`, `email`, `username`, `password`) VALUES
(1, 'Hashimu', 'Jumanne', 'Rajabu', 'hashimujr007@gmail.com', 'admin', '123'),
(2, 'juma', 'rajabu', 'hamisi', 'hamisi0001@gmail.com', 'admin12', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `AnnounceID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Content` text NOT NULL,
  `PostedBy` varchar(50) NOT NULL,
  `DatePosted` datetime NOT NULL,
  `Visibility` enum('All','Students','Instructors','Admins') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`AnnounceID`, `Title`, `Content`, `PostedBy`, `DatePosted`, `Visibility`) VALUES
(1, 'assignment1', 'adfttyjgfghjkfdbvcvbn', 'serrfghkll,', '2023-09-13 09:55:42', 'Students');

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `AS_ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `score` int(11) DEFAULT NULL,
  `S_ID` int(11) NOT NULL,
  `I_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `AS_ID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `AssignmentName` varchar(100) NOT NULL,
  `Description` text,
  `DueDate` datetime NOT NULL,
  `MaxPoints` int(11) NOT NULL,
  `AssignedDate` datetime NOT NULL,
  `FileAttachment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`AS_ID`, `CourseID`, `AssignmentName`, `Description`, `DueDate`, `MaxPoints`, `AssignedDate`, `FileAttachment`) VALUES
(7, 0, 'IA ASSIGNMENT', 'htyuiopkfeqsaweryujkljg', '2023-09-13 13:31:00', 16, '0000-00-00 00:00:00', 'uploads/checklist.docx'),
(8, 0, 'IA ASSIGNMENT', 'htyuiopkfeqsaweryujkljg', '2023-09-13 13:31:00', 16, '0000-00-00 00:00:00', 'uploads/checklist.docx'),
(9, 0, 'IA ASSIGNMENT', 'fgjkkiytrewdfghjkloi', '2023-09-13 12:50:00', 18, '0000-00-00 00:00:00', 'uploads/IPT-1 TIME TABLE-5.pdf'),
(10, 0, 'jjjjllll', 'kkkkk', '2023-09-13 20:50:00', 9, '0000-00-00 00:00:00', 'uploads/CUSTOMAZATION GROUP 2.1.pdf'),
(11, 0, 'jjjjllll', 'kkkkk', '2023-09-13 20:50:00', 9, '0000-00-00 00:00:00', 'uploads/CUSTOMAZATION GROUP 2.1.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `C_ID` int(11) NOT NULL,
  `c_code` varchar(15) NOT NULL,
  `C_name` varchar(255) NOT NULL,
  `Credit_number` text NOT NULL,
  `A_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`C_ID`, `c_code`, `C_name`, `Credit_number`, `A_ID`) VALUES
(1, 'CD 111', 'Didital Media Psychology', '7.5', NULL),
(2, 'CD 121', 'Foundation of Instructional Design', '7.5', NULL),
(3, 'CP 111', 'Principles of Programming Languages', '9', NULL),
(4, 'DS 102', 'Development Perspectives', '7.5', NULL),
(5, 'ET 111', 'Introduction to Educational Technology', '7', NULL),
(6, 'IM 111', 'Introduction to Information Systems', '7.5', NULL),
(7, 'IT 111', 'Introduction to Information Technology', '7.5', NULL),
(8, 'LG 102', 'Communication Skills', '7.5', NULL),
(9, 'ST103', 'statistics and probability', '7.5', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `I_ID` int(11) NOT NULL,
  `F_name` varchar(255) NOT NULL,
  `M_name` varchar(255) DEFAULT NULL,
  `L_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `A_ID` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `course` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`I_ID`, `F_name`, `M_name`, `L_name`, `username`, `A_ID`, `email`, `course`, `password`) VALUES
(1, 'Hassani', 'Hamisi', 'Said', 'instructor', NULL, 'said0001@gmail.com', 'CP121', '1234'),
(2, 'GRACE', 'J', 'MSUFI', 'MADAM', NULL, 'gjm@gmail.com', 'CD121: CP123: IT121:MT122', 'MADAM'),
(21, 'Juma', 'Juma', 'Omary', 'Hashimu', NULL, 'jumaa@gmail.com', '', '4321'),
(23, 'GRACE', 'J', 'MSUFI', 'rahel', NULL, 'gjm@gmail.com', 'CD222, IT121, DSC321, QT3', '4545'),
(98, 'm', 'n', 'n', 'thewinner', NULL, 'husnasungita@gmail.com', 'NS 123, cp 234', '098'),
(1111, 'GRACE', 'J', 'MSUFI', 'rahel', NULL, 'gjaaam@gmail.com', '', '321');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `M_ID` int(11) NOT NULL,
  `course` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `I_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `S_ID` int(11) NOT NULL,
  `F_name` varchar(255) NOT NULL,
  `M_name` varchar(255) DEFAULT NULL,
  `L_name` varchar(255) NOT NULL,
  `Study` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `AGE` int(11) NOT NULL,
  `Program` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `A_ID` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`S_ID`, `F_name`, `M_name`, `L_name`, `Study`, `gender`, `AGE`, `Program`, `username`, `A_ID`, `email`, `password`) VALUES
(89, 'm', 'h', 'm', '2023', 'Male', 65, 'BSc.HIS', 'sungita', NULL, 'husnasungita@gmail.com', '12'),
(7654, 'HFDF', 'HGF', 'HHG', '2345', 'Male', 23, 'BSc.TE', 'HGF', NULL, 'juma@gmail.com', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`A_ID`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`AnnounceID`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`AS_ID`),
  ADD KEY `S_ID` (`S_ID`),
  ADD KEY `I_ID` (`I_ID`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`AS_ID`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`C_ID`),
  ADD KEY `A_ID` (`A_ID`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`I_ID`),
  ADD KEY `A_ID` (`A_ID`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`M_ID`),
  ADD KEY `I_ID` (`I_ID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`S_ID`),
  ADD KEY `A_ID` (`A_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `A_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `AnnounceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `AS_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `AS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `C_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `I_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1112;

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `M_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `S_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7655;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`S_ID`) REFERENCES `student` (`S_ID`),
  ADD CONSTRAINT `assignment_ibfk_2` FOREIGN KEY (`I_ID`) REFERENCES `instructor` (`I_ID`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`A_ID`) REFERENCES `admin` (`A_ID`);

--
-- Constraints for table `instructor`
--
ALTER TABLE `instructor`
  ADD CONSTRAINT `instructor_ibfk_1` FOREIGN KEY (`A_ID`) REFERENCES `admin` (`A_ID`);

--
-- Constraints for table `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `material_ibfk_1` FOREIGN KEY (`I_ID`) REFERENCES `instructor` (`I_ID`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`A_ID`) REFERENCES `admin` (`A_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
