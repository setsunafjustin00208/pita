-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2022 at 09:36 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pita`
--

-- --------------------------------------------------------

--
-- Table structure for table `actvities`
--

CREATE TABLE `actvities` (
  `activity_id` int(255) NOT NULL,
  `activity_title` varchar(30) NOT NULL,
  `activity_details` text NOT NULL,
  `activity_output` text NOT NULL,
  `teacher_id` int(255) NOT NULL,
  `section` varchar(30) NOT NULL,
  `date_created` date DEFAULT current_timestamp(),
  `date_modified` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `a_id` int(255) NOT NULL,
  `announcement_title` varchar(30) NOT NULL,
  `announcement_details` text NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `date_modified` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`a_id`, `announcement_title`, `announcement_details`, `date_created`, `date_modified`) VALUES
(1, 'sample3', 'sample3', '2022-04-28', '2022-04-28');

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `score_id` int(255) NOT NULL,
  `student_id` int(255) NOT NULL,
  `teacher_id` int(255) NOT NULL,
  `activity_id` int(255) NOT NULL,
  `activity_score` int(3) NOT NULL,
  `section` varchar(255) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `date_modified` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `grade` int(3) NOT NULL,
  `section` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `is_active` varchar(10) NOT NULL,
  `verification` int(255) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp(),
  `date_modified` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `username`, `password`, `fname`, `mname`, `lname`, `grade`, `section`, `user_type`, `is_active`, `verification`, `date_created`, `date_modified`) VALUES
(1, 'admin@admin.com', 'admin', 'admin', 'admin', 'admin', 'admin', 999, 'admin', 'ADMIN', 'ACTIVE', 0, '2022-04-16', '2022-04-16'),
(2, 'student@student.com', 'student', 'student', 'student', 'student', 'student', 3, 'sample', 'STUDENT', 'ACTIVE', 0, '2022-04-16', '2022-04-16'),
(3, 'teacher@teacher.com', 'teacher', 'teacher', 'TEACHER', 'TEACHER', 'TEACHER', 9, 'TEACHER', 'TEACHER', 'ACTIVE', 0, '2022-04-16', '2022-04-16'),
(10, 'setsunafjustin00208@gmail.com', 'gundam250', 'aza123', 'gundam', 'gundam', 'gundam', 3, 'gundam', 'STUDENT', 'ACTIVE', 0, '2022-04-27', '2022-04-27'),
(20, 'teacher2@teacher2.com', 'teacher2', 'teacher2', 'teacher2', 'teacher2', 'teacher2', 3, 'teacher2', 'TEACHER', 'DISABLED', 0, '2022-04-27', '2022-04-27'),
(21, 'teacher3@teacher3.com', 'teacher3', 'teacher3', 'teacher3', 'teacher3', 'teacher3', 1, 'teacher3', 'TEACHER', 'DISABLED', 0, '2022-04-27', '2022-04-27'),
(22, 'teacher4@teacher4.com', 'teacher4', 'teacher4', 'teacher4', 'teacher4', 'teacher4', 2, 'teacher4', 'TEACHER', 'DISABLED', 0, '2022-04-27', '2022-04-27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actvities`
--
ALTER TABLE `actvities`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`score_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actvities`
--
ALTER TABLE `actvities`
  MODIFY `activity_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `a_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `score_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
