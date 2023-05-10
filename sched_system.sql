-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2023 at 04:56 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sched_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_request.php`
--

CREATE TABLE `admin` (
  `id` int(25) NOT NULL,
  `dept_id` int(25) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_request.php`
--

INSERT INTO `admin` (`id`, `dept_id`, `username`, `email`, `password`) VALUES
(3, 0, 'adminxx', 'admin_request.php.edu.evsu.com', '$2y$10$bFJUZ2ZjpRTrf8dAr6A2Uu4pI0WAA6W20PaIzHHoU9GrxtfdPUgiO'),
(4, 1, 'Engineering', 'adminEngi@edu.evsu.com', '$2y$10$S4F9I2EN9ukrfTf0KBC5KO5dq5RA.X.rHqmZZ4KE.15u2iDeZsil2'),
(5, 2, 'Technology', 'admin_tech@edu_evsu.com', '$2y$10$M/ZaczpR9IoZHxUD9mA4Iu9JKECtuflRkEs5MjtolvgmWvUZ8S4IW');

-- --------------------------------------------------------

--
-- Table structure for table `authorizedpersonnel`
--

CREATE TABLE `authorizedpersonnel` (
  `AuthorizedPersonnelID` int(11) NOT NULL,
  `AuthorizedPersonnelName` varchar(255) DEFAULT NULL,
  `AuthorizedAddress` varchar(255) DEFAULT NULL,
  `AuthorizedPerson_IDPic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authorizedpersonnel`
--

INSERT INTO `authorizedpersonnel` (`AuthorizedPersonnelID`, `AuthorizedPersonnelName`, `AuthorizedAddress`, `AuthorizedPerson_IDPic`) VALUES
(11, 'I\'m batman', 'brgy san roque tanauan leyte', 'uploads/335928964_907206787274764_5990234728966170731_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `authorizedpersonnel_archive`
--

CREATE TABLE `authorizedpersonnel_archive` (
  `AuthorizedPersonnelID` int(11) NOT NULL,
  `AuthorizedPersonnelName` varchar(255) DEFAULT NULL,
  `AuthorizedAddress` varchar(255) DEFAULT NULL,
  `AuthorizedPerson_IDPic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authorizedpersonnel_archive`
--

INSERT INTO `authorizedpersonnel_archive` (`AuthorizedPersonnelID`, `AuthorizedPersonnelName`, `AuthorizedAddress`, `AuthorizedPerson_IDPic`) VALUES
(10, 'klark kent', 'brgy san roque tanauan leyte', 'uploads/kevin-quinn-cal130-alfdark.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `id` int(25) NOT NULL,
  `app_uid` int(25) NOT NULL,
  `event_type` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `event_length` int(25) NOT NULL,
  `event_category` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id`, `app_uid`, `event_type`, `event_date`, `event_length`, `event_category`) VALUES
(185, 29, 'request', '2023-04-29', 1, 4),
(186, 28, 'request', '2023-04-29', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(25) NOT NULL,
  `dept_id` int(25) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `dept_id`, `name`, `description`) VALUES
(1, 1, 'Bachelor of Science in Chemical Engineering (BSChE)', ''),
(2, 1, 'Bachelor of Science in Civil Engineering (BSCE)', ''),
(3, 1, 'Bachelor of Science in Electronics Engineering (BSECE)', ''),
(4, 1, 'Bachelor of Science in Electrical Engineering (BSEE)', ''),
(5, 1, 'Bachelor of Science in Geodetic Engineering (BSGE)', ''),
(6, 1, 'Bachelor of Science in Mechanical Engineering (BSME)', ''),
(7, 1, 'Bachelor of Science in Industrial Engineering (BSIE)', ''),
(8, 1, 'Bachelor of Science in Information Technology (BSIT)', ''),
(9, 2, 'Bachelor of Science in Hospitality Management (BSHM)', ''),
(10, 2, 'Bachelor of Science in Nutrition & Dietetics (BSND)', ''),
(12, 0, '', ''),
(13, 2, 'Bachelor of Science in Industrial Technology with major in: Civil Construction', '');

-- --------------------------------------------------------

--
-- Table structure for table `deppartment`
--

CREATE TABLE `deppartment` (
  `id` int(25) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deppartment`
--

INSERT INTO `deppartment` (`id`, `dept`, `description`) VALUES
(1, 'Engineering', ''),
(2, 'Technology', ''),
(12, '', ''),
(13, 'Education', ''),
(14, 'Business and Entrepreneurship', ''),
(15, 'Arts and Sciences', ''),
(16, 'Architecture and Allied Discipline', ''),
(17, 'Education', '');

-- --------------------------------------------------------

--
-- Table structure for table `documentmapping`
--

CREATE TABLE `documentmapping` (
  `id` int(11) NOT NULL,
  `RequestID` int(11) DEFAULT NULL,
  `DocumentID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documentmapping`
--

INSERT INTO `documentmapping` (`id`, `RequestID`, `DocumentID`) VALUES
(78, 28, 1),
(79, 28, 2),
(80, 28, 3),
(81, 28, 4),
(82, 28, 5),
(83, 29, 1),
(84, 29, 2),
(85, 29, 5),
(86, 29, 6),
(87, 29, 8),
(88, 30, 1),
(89, 30, 2);

-- --------------------------------------------------------

--
-- Table structure for table `documentmapping_archive`
--

CREATE TABLE `documentmapping_archive` (
  `id` int(11) NOT NULL,
  `RequestID` int(11) DEFAULT NULL,
  `DocumentID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documentmapping_archive`
--

INSERT INTO `documentmapping_archive` (`id`, `RequestID`, `DocumentID`) VALUES
(73, 26, 1),
(74, 26, 2),
(75, 27, 1),
(76, 27, 2),
(77, 27, 4);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `DocumentID` int(11) NOT NULL,
  `DocumentName` varchar(255) DEFAULT NULL,
  `DocumentDescription` text DEFAULT NULL,
  `DocumentImage` varchar(255) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`DocumentID`, `DocumentName`, `DocumentDescription`, `DocumentImage`) VALUES
(1, 'Transcript', 'Official record of student’s academic history.', 'default.jpg'),
(2, 'Diploma', 'Official document certifying that student has completed degree requirements.', 'default.jpg'),
(3, 'Enrollment Verification', 'Official proof of student’s enrollment status.', 'default.jpg'),
(4, 'Degree Verification', 'Official proof of student’s degree completion.', 'default.jpg'),
(5, 'Grade Report', 'Official record of student’s grades in a particular term.', 'default.jpg'),
(6, 'Course Description', 'Official description of a course offered by the institution.', 'default.jpg'),
(8, 'Financial Aid Verification', 'Official proof of student’s financial aid status.', 'default.jpg'),
(9, 'Student ID Card', 'Official identification card for the student.', 'default.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `RequestID` int(11) NOT NULL,
  `RequestType` varchar(50) DEFAULT NULL,
  `StudentID` int(11) DEFAULT NULL,
  `StudentFullName` varchar(255) DEFAULT NULL,
  `StudentEmail` varchar(255) DEFAULT NULL,
  `StudentAddress` varchar(255) DEFAULT NULL,
  `StudentGender` varchar(50) DEFAULT NULL,
  `StudentPhone` varchar(20) DEFAULT NULL,
  `Department` varchar(255) DEFAULT NULL,
  `Course` varchar(255) DEFAULT NULL,
  `Education` varchar(255) DEFAULT NULL,
  `Schedule` varchar(255) DEFAULT NULL,
  `AuthorizedPersonnelID` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `RequestStatus` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`RequestID`, `RequestType`, `StudentID`, `StudentFullName`, `StudentEmail`, `StudentAddress`, `StudentGender`, `StudentPhone`, `Department`, `Course`, `Education`, `Schedule`, `AuthorizedPersonnelID`, `CreatedAt`, `RequestStatus`) VALUES
(28, 'personal', 14, 'brent.agetro@gmail.com, brent philip ortega brent philip ortega.', 'brent.agetro@gmail.com', 'brgy san roque tanauan leyte', 'male', '2147483647', 'Technology', 'Bachelor of Science in Industrial Technology with major in: Civil Construction', 'undergraduate', '2023-04-29', NULL, '2023-04-19 05:58:03', '1'),
(29, 'personal', 14, 'brent.agetro@gmail.com, brent philip ortega brent philip ortega.', 'brent.agetro@gmail.com', 'brgy san roque tanauan leyte', 'male', '2147483647', 'Technology', 'Bachelor of Science in Industrial Technology with major in: Civil Construction', 'undergraduate', '2023-04-29', NULL, '2023-04-19 05:59:33', '0'),
(30, 'authorized', 13, 'Ortega, Brent Philip Brent Philip Ortega.', 'brent.agetro@gmail.com', 'brgy san roque tanauan leyte', 'male', '2147483647', 'Engineering', 'Bachelor of Science in Information Technology (BSIT)', 'undergraduate', '2023-04-27', 11, '2023-04-19 06:00:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `request_archive`
--

CREATE TABLE `request_archive` (
  `RequestID` int(11) NOT NULL,
  `RequestType` varchar(50) DEFAULT NULL,
  `StudentID` int(11) DEFAULT NULL,
  `StudentFullName` varchar(255) DEFAULT NULL,
  `StudentEmail` varchar(255) DEFAULT NULL,
  `StudentAddress` varchar(255) DEFAULT NULL,
  `StudentGender` varchar(50) DEFAULT NULL,
  `StudentPhone` varchar(20) DEFAULT NULL,
  `Department` varchar(255) DEFAULT NULL,
  `Course` varchar(255) DEFAULT NULL,
  `Education` varchar(255) DEFAULT NULL,
  `Schedule` varchar(255) DEFAULT NULL,
  `AuthorizedPersonnelID` int(11) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `RequestStatus` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_archive`
--

INSERT INTO `request_archive` (`RequestID`, `RequestType`, `StudentID`, `StudentFullName`, `StudentEmail`, `StudentAddress`, `StudentGender`, `StudentPhone`, `Department`, `Course`, `Education`, `Schedule`, `AuthorizedPersonnelID`, `CreatedAt`, `RequestStatus`) VALUES
(26, 'personal', 13, 'Ortega, Brent Philip Brent Philip Ortega.', 'brent.agetro@gmail.com', 'brgy san roque tanauan leyte', 'male', '2147483647', 'Engineering', 'Bachelor of Science in Information Technology (BSIT)', 'undergraduate', '2023-04-27', NULL, '2023-04-18 22:22:14', 'completed'),
(27, 'authorized', 14, 'brent.agetro@gmail.com, brent philip ortega brent philip ortega.', 'brent.agetro@gmail.com', 'brgy san roque tanauan leyte', 'male', '2147483647', 'Technology', 'Bachelor of Science in Industrial Technology with major in: Civil Construction', '', '2023-04-27', 10, '2023-04-19 05:57:17', 'canceled');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `st_id` int(25) NOT NULL,
  `dept_id` int(25) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `Profile_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`st_id`, `dept_id`, `student_id`, `password`, `user_name`, `Profile_ID`) VALUES
(13, 1, '2019-35970', '$2y$10$j8x6jF3NFB7SV7QhaYwuvO1PxfqK8trl44Pk0nSaCTEK00pG6GppS', 'brenty ', 17),
(14, 2, '2019-44444', '$2y$10$R9Bfpnhy0iz/EjDCigNiL.ZPlyRURZ6Eq5UIkurrfF8k7EL4BqkrO', 'jackalack', 18);

-- --------------------------------------------------------

--
-- Table structure for table `st_profile`
--

CREATE TABLE `st_profile` (
  `id` int(25) NOT NULL,
  `course_id` int(25) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `middle` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `st_profile`
--

INSERT INTO `st_profile` (`id`, `course_id`, `lname`, `fname`, `middle`, `gender`, `address`, `email`, `phone`) VALUES
(17, 8, 'Ortega', 'Brent Philip', 'Brent Philip Ortega', 'male', 'brgy san roque tanauan leyte', 'brent.agetro@gmail.com', 2147483647),
(18, 13, 'brent.agetro@gmail.com', 'brent philip ortega', 'brent philip ortega', 'male', 'brgy san roque tanauan leyte', 'brent.agetro@gmail.com', 2147483647);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authorizedpersonnel`
--
ALTER TABLE `authorizedpersonnel`
  ADD PRIMARY KEY (`AuthorizedPersonnelID`);

--
-- Indexes for table `authorizedpersonnel_archive`
--
ALTER TABLE `authorizedpersonnel_archive`
  ADD PRIMARY KEY (`AuthorizedPersonnelID`);

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deppartment`
--
ALTER TABLE `deppartment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documentmapping`
--
ALTER TABLE `documentmapping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `DocumentID` (`DocumentID`),
  ADD KEY `documentmapping_ibfk_1` (`RequestID`);

--
-- Indexes for table `documentmapping_archive`
--
ALTER TABLE `documentmapping_archive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `DocumentID` (`DocumentID`),
  ADD KEY `documentmapping_ibfk_1` (`RequestID`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`DocumentID`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `AuthorizedPersonnelID` (`AuthorizedPersonnelID`),
  ADD KEY `StudentID` (`StudentID`);

--
-- Indexes for table `request_archive`
--
ALTER TABLE `request_archive`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `AuthorizedPersonnelID` (`AuthorizedPersonnelID`),
  ADD KEY `StudentID` (`StudentID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`st_id`),
  ADD KEY `fk_Profile_ID` (`Profile_ID`);

--
-- Indexes for table `st_profile`
--
ALTER TABLE `st_profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `authorizedpersonnel`
--
ALTER TABLE `authorizedpersonnel`
  MODIFY `AuthorizedPersonnelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `authorizedpersonnel_archive`
--
ALTER TABLE `authorizedpersonnel_archive`
  MODIFY `AuthorizedPersonnelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `deppartment`
--
ALTER TABLE `deppartment`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `documentmapping`
--
ALTER TABLE `documentmapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `documentmapping_archive`
--
ALTER TABLE `documentmapping_archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `request_archive`
--
ALTER TABLE `request_archive`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `st_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `st_profile`
--
ALTER TABLE `st_profile`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `documentmapping`
--
ALTER TABLE `documentmapping`
  ADD CONSTRAINT `documentmapping_ibfk_1` FOREIGN KEY (`RequestID`) REFERENCES `request` (`RequestID`),
  ADD CONSTRAINT `documentmapping_ibfk_2` FOREIGN KEY (`DocumentID`) REFERENCES `documents` (`DocumentID`);

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`StudentID`) REFERENCES `student` (`st_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_Profile_ID` FOREIGN KEY (`Profile_ID`) REFERENCES `st_profile` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
