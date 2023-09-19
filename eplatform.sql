-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2023 at 12:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eplatform`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `first_name`, `last_name`, `password`) VALUES
(1, 'admin', 'admin', 'admin', '$2y$10$8KnX9rcKHAQvwO95yBj/g.P7Dasn7/pDdylyUv1ngS3geXt1KHHdW');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `announcement_id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `announcement_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`announcement_id`, `course_id`, `message`, `announcement_date`) VALUES
(1, 14, 'first year wote mje na vizibo kesho saa 2 asubuhi', '2023-09-17 10:22:04'),
(2, 14, 'ghj,.', '2023-09-17 10:23:41'),
(3, 14, 'ghj,.', '2023-09-17 10:24:02'),
(4, 14, '6tiuop', '2023-09-17 10:24:09'),
(5, 14, '6tiuop', '2023-09-17 10:24:35'),
(6, 14, '6tiuop', '2023-09-17 10:25:05'),
(7, 14, 'ghhfgh', '2023-09-17 11:27:58'),
(8, 14, 'hoii', '2023-09-17 11:32:48');

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `assignment_id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`assignment_id`, `course_id`, `title`, `description`, `deadline`, `file_path`) VALUES
(1, 14, 'dbm', 'ghkjh', '2023-09-16', NULL),
(2, 14, 'tyu', 'ghj', '2023-09-16', NULL),
(3, 14, 'tyl', 'hjk.', '2023-09-16', NULL),
(4, 14, 'ASSIGNMENT', 'ASSIGNMENT 1', '2023-09-16', NULL),
(5, 14, 'Assignment 2', 'Fanya mapema kwa group isiyozidi 4', '2023-09-30', 'uploads/18 (3).pptx');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `course_weight` decimal(5,2) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `title`, `description`, `course_weight`, `program_id`) VALUES
(1, 'Computer networking', 'first year course', 7.50, NULL),
(2, 'introduction to cybersecurity', 'first year course', 9.00, NULL),
(3, 'introduction to cybersecurity', 'first year course', 9.00, NULL),
(4, 'introduction to cybersecurity', 'first year course', 9.00, NULL),
(5, 'cvbnm', 'rtyioert', 7.50, NULL),
(6, 'cvbnm', 'rtyioert', 7.50, NULL),
(7, 'fgjkl;', 'yyyyyy', 7.50, NULL),
(8, 'fgk', 'fgdffgfg', 7.50, NULL),
(9, 'fgk', 'fgdffgfg', 7.50, NULL),
(10, 'tyuo', 'ertwe', 7.00, NULL),
(11, 'tddd', 'wrrrrrrrrrrrrrrr', 7.50, NULL),
(12, 'yao', 'doom', 9.00, NULL),
(13, 'CN 211', 'CONPUTER NETWORKING', 7.50, NULL),
(14, 'CN 211', 'CONPUTER NETWORKING', 7.50, 1),
(15, 'DDDDDDDD', 'DDDDDDDDDD', 7.50, 2),
(16, 'fffff', 'ffffffffffffffffff', 7.50, 2),
(17, 'fffff', 'ffffffffffffffffff', 7.50, 2);

-- --------------------------------------------------------

--
-- Table structure for table `course_instructor`
--

CREATE TABLE `course_instructor` (
  `course_id` int(11) DEFAULT NULL,
  `instructor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_instructor`
--

INSERT INTO `course_instructor` (`course_id`, `instructor_id`) VALUES
(NULL, 9),
(12, 1),
(1, 3),
(14, 1),
(16, 13),
(16, 13);

-- --------------------------------------------------------

--
-- Table structure for table `course_student`
--

CREATE TABLE `course_student` (
  `course_student_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`) VALUES
(1, 'CSE'),
(2, 'ETE'),
(3, 'IST');

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `instructor_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`instructor_id`, `username`, `first_name`, `last_name`, `password`, `email`, `course_id`) VALUES
(1, 'instructor', 'instructor', 'instructor', '$2y$10$8KnX9rcKHAQvwO95yBj/g.P7Dasn7/pDdylyUv1ngS3geXt1KHHdW', 'instructor@gmail.com', NULL),
(3, 'instructor2', 'instructor2', 'instructor2', '$2y$10$QD0RWfF3W8uU7.3yn07T4emHbBY85N6G67eqdrZp65VUcvaLAKL3K', 'instructor2@gmail.com', NULL),
(4, 'juma', 'mosi', 'jmos', '$2y$10$kVz4gp64/DecCOT.86jYdu.9iZGTb5d4c7636t8uDZfIOvITqXrLG', 'jmos@gmail.com', NULL),
(5, 'husna', 'sungita', 'mohamed', '$2y$10$kbc2ZJJFMzIKkohZFkjI9es2jPNZeVU7bAp1XhLQmMkwi.Ua18wPC', 'hsungita@gmail.com', NULL),
(6, 'hajum', 'salum', 'saidk', '$2y$10$xv6jaJXJQDIT5IzVScagDeQsUnxhYhCHuahWPnjy7liv5GpCMaPnG', 'hajumsadi@gmail.com', NULL),
(7, 'hajum', 'salum', 'saidk', '$2y$10$xv6jaJXJQDIT5IzVScagDeQsUnxhYhCHuahWPnjy7liv5GpCMaPnG', 'hajumsadi@gmail.com', NULL),
(8, 'dad', 'sal', 'sasaa', '$2y$10$gDZVeVYaFFH.WuGmwMgAS.34CQ5sWGcgYGYw1VMpQNR25Cvl2zO5m', 'sas@gmail.com', NULL),
(9, 'dad', 'sal', 'sasaa', '$2y$10$gDZVeVYaFFH.WuGmwMgAS.34CQ5sWGcgYGYw1VMpQNR25Cvl2zO5m', 'sas@gmail.com', NULL),
(10, 'ccccc', 'ccccc', 'ffff', '$2y$10$GjAAG.IJiVrQdpWRxT08ouKcAM8.J/3vsH7/eJxszzqH3wOMWvsS6', 'cc@gmail.com', NULL),
(11, 'ccccc', 'ccccc', 'ffff', '$2y$10$GjAAG.IJiVrQdpWRxT08ouKcAM8.J/3vsH7/eJxszzqH3wOMWvsS6', 'cc@gmail.com', NULL),
(12, 'chue', 'sss', 'sungita', '$2y$10$VUgjy3VQXmjxBnm/S/RkZeoahrmgn5vj5KNOKDfTdWrl17ZVe.tIW', 'ses@gmail.com', NULL),
(13, 'chue', 'sss', 'sungita', '$2y$10$VUgjy3VQXmjxBnm/S/RkZeoahrmgn5vj5KNOKDfTdWrl17ZVe.tIW', 'ses@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `material_id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`material_id`, `course_id`, `title`, `file_path`) VALUES
(4, 14, 'lecture 1', 'uploads/18.pptx');

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `program_id` int(11) NOT NULL,
  `program_name` varchar(255) NOT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`program_id`, `program_name`, `department_id`) VALUES
(1, 'CNISE', 1),
(2, 'SE', 1),
(3, 'HIS', 3);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `year_of_study` int(11) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `registration_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `username`, `first_name`, `last_name`, `password`, `email`, `program_id`, `year_of_study`, `age`, `gender`, `registration_no`) VALUES
(17, 'student', 'student', 'student', '$2y$10$Sg5O1sGY3rnM36p0unfjMOgFnR4yNMeo5ZcvhFmeRQmITIjPFyz5y', 'student@gmail.com', 2, 2, 22, 'Male', 't-22-2029-005'),
(18, 'student2', 'student2', 'student2', '$2y$10$3nhJDZY39nulgRu/zkOxyeHcu2XyQea3piZ5Nk8L1dbejTLFOgsre', 'student2@gmail.com', 1, 2, 20, 'Male', 't-20-2023'),
(19, 'student3', 'student3', 'student3', '$2y$10$2Qkk.EjCYc69NkLrMPPZ9Ogdwgm2NDAOeDTJPD70pkGSReL6MKcy6', 'student3@gmail.com', 1, 2, 22, 'Female', 't-22-20003'),
(20, 'student', 'student', 'student', '$2y$10$T6IHju9N.onnGcC3Zj6Tde/Vv5IrvVksOkVfhor/QeWpJaL27K.3q', 'student@gmail.com', 1, 2, 22, 'Male', 't-33-2034');

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE `student_course` (
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `submitted_assignments`
--

CREATE TABLE `submitted_assignments` (
  `submission_id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `submission_date` datetime NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submitted_assignments`
--

INSERT INTO `submitted_assignments` (`submission_id`, `assignment_id`, `student_id`, `submission_date`, `file_path`, `comments`) VALUES
(1, 2, 17, '2023-09-17 12:28:46', 'uploads/18 (3) (1).pptx', NULL),
(2, 2, 17, '2023-09-17 12:30:52', 'uploads/18 (3) (1).pptx', NULL),
(3, 2, 17, '2023-09-17 12:35:07', 'uploads/18 (3) (1).pptx', NULL),
(4, 2, 17, '2023-09-17 12:39:29', 'uploads/18 (3) (1).pptx', NULL),
(5, 2, 17, '2023-09-17 12:39:43', 'uploads/18 (3) (1).pptx', NULL),
(6, 2, 17, '2023-09-17 12:39:52', 'uploads/18 (3) (1).pptx', NULL),
(7, 5, 17, '2023-09-17 12:40:53', 'uploads/18 (3) (1).pptx', NULL),
(8, 5, 17, '2023-09-17 12:42:22', 'uploads/view_assignment_details.htm', NULL),
(9, 5, 17, '2023-09-17 12:44:05', 'uploads/view_assignment_details.htm', NULL),
(10, 5, 17, '2023-09-17 12:46:04', 'uploads/view_assignment_details.htm', NULL),
(11, 5, 17, '2023-09-17 12:47:24', 'uploads/view_assignment_details.htm', NULL),
(12, 5, 17, '2023-09-17 12:47:34', 'uploads/view_assignment_details.htm', NULL),
(13, 5, 17, '2023-09-17 12:51:25', 'uploads/18 (3) (1).pptx', NULL),
(14, 5, 17, '2023-09-17 13:01:21', 'uploads/18 (3) (1).pptx', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`announcement_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `fk_program_id` (`program_id`);

--
-- Indexes for table `course_instructor`
--
ALTER TABLE `course_instructor`
  ADD KEY `course_id` (`course_id`),
  ADD KEY `instructor_id` (`instructor_id`);

--
-- Indexes for table `course_student`
--
ALTER TABLE `course_student`
  ADD PRIMARY KEY (`course_student_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`instructor_id`),
  ADD KEY `fk_instructor_course` (`course_id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`material_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`program_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `program_id` (`program_id`);

--
-- Indexes for table `student_course`
--
ALTER TABLE `student_course`
  ADD PRIMARY KEY (`student_id`,`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `submitted_assignments`
--
ALTER TABLE `submitted_assignments`
  ADD PRIMARY KEY (`submission_id`),
  ADD KEY `assignment_id` (`assignment_id`),
  ADD KEY `student_id` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `course_student`
--
ALTER TABLE `course_student`
  MODIFY `course_student_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `instructor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `submitted_assignments`
--
ALTER TABLE `submitted_assignments`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Constraints for table `assignment`
--
ALTER TABLE `assignment`
  ADD CONSTRAINT `assignment_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `fk_program_id` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`);

--
-- Constraints for table `course_instructor`
--
ALTER TABLE `course_instructor`
  ADD CONSTRAINT `course_instructor_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `course_instructor_ibfk_2` FOREIGN KEY (`instructor_id`) REFERENCES `instructor` (`instructor_id`);

--
-- Constraints for table `course_student`
--
ALTER TABLE `course_student`
  ADD CONSTRAINT `course_student_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `course_student_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Constraints for table `instructor`
--
ALTER TABLE `instructor`
  ADD CONSTRAINT `fk_instructor_course` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `materials_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Constraints for table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `programs_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `programs` (`program_id`);

--
-- Constraints for table `student_course`
--
ALTER TABLE `student_course`
  ADD CONSTRAINT `student_course_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `student_course_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Constraints for table `submitted_assignments`
--
ALTER TABLE `submitted_assignments`
  ADD CONSTRAINT `submitted_assignments_ibfk_1` FOREIGN KEY (`assignment_id`) REFERENCES `assignment` (`assignment_id`),
  ADD CONSTRAINT `submitted_assignments_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
