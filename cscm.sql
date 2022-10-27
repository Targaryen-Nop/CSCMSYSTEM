-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2022 at 06:39 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cscm`
--

-- --------------------------------------------------------

--
-- Table structure for table `cscm_majors`
--

CREATE TABLE `cscm_majors` (
  `major_id` int(11) NOT NULL,
  `major_name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cscm_majors`
--

INSERT INTO `cscm_majors` (`major_id`, `major_name`) VALUES
(301, 'Computer Science'),
(302, 'Computer Multimedia');

-- --------------------------------------------------------

--
-- Table structure for table `cscm_subjects`
--

CREATE TABLE `cscm_subjects` (
  `subject_id` varchar(100) NOT NULL,
  `subject_name` varchar(150) DEFAULT NULL,
  `subject_unit` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `major_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cscm_users`
--

CREATE TABLE `cscm_users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_password` blob DEFAULT NULL,
  `user_rname` varchar(150) DEFAULT NULL,
  `user_rnameth` varchar(100) DEFAULT NULL,
  `user_lname` varchar(150) DEFAULT NULL,
  `user_lnameth` varchar(100) DEFAULT NULL,
  `user_DoB` date DEFAULT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `user_blood` varchar(25) DEFAULT NULL,
  `user_gender` varchar(25) DEFAULT NULL,
  `user_phone` varchar(50) DEFAULT NULL,
  `user_email` varchar(150) DEFAULT NULL,
  `major_id` int(11) DEFAULT NULL,
  `user_auth` varchar(100) DEFAULT NULL,
  `user_image` varchar(100) DEFAULT NULL,
  `user_year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cscm_users`
--

INSERT INTO `cscm_users` (`user_id`, `user_name`, `user_password`, `user_rname`, `user_rnameth`, `user_lname`, `user_lnameth`, `user_DoB`, `user_address`, `user_blood`, `user_gender`, `user_phone`, `user_email`, `major_id`, `user_auth`, `user_image`, `user_year`) VALUES
(590010, 'Pooree', 0x0049b77040d97b6ed6baaa80d6dd3af5, 'Pooree', 'ภูรี', 'Menkool', 'เมนกูล', '0000-00-00', '', '', 'Male', '0926555', '', 301, 'Teacher', NULL, NULL),
(630078, 'Nopparat', 0x7cbc118601da75476658a8f1a1a015fa, 'Nopparat', 'นพรัตน์', 'Munsuwan', 'มั่นสุวรรณ', '0000-00-00', '', 'AB', 'Male', '0995960320', 's630078301@cpu.ac.th', 301, 'Student', '', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cscm_majors`
--
ALTER TABLE `cscm_majors`
  ADD PRIMARY KEY (`major_id`);

--
-- Indexes for table `cscm_subjects`
--
ALTER TABLE `cscm_subjects`
  ADD PRIMARY KEY (`subject_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `major_id` (`major_id`);

--
-- Indexes for table `cscm_users`
--
ALTER TABLE `cscm_users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `major_id` (`major_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cscm_subjects`
--
ALTER TABLE `cscm_subjects`
  ADD CONSTRAINT `cscm_subjects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `cscm_users` (`user_id`),
  ADD CONSTRAINT `cscm_subjects_ibfk_2` FOREIGN KEY (`major_id`) REFERENCES `cscm_majors` (`major_id`);

--
-- Constraints for table `cscm_users`
--
ALTER TABLE `cscm_users`
  ADD CONSTRAINT `cscm_users_ibfk_1` FOREIGN KEY (`major_id`) REFERENCES `cscm_majors` (`major_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
