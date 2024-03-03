-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2022 at 02:45 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `danceacademy`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dance_categories`
--

CREATE TABLE `tbl_dance_categories` (
  `category_id` int(200) NOT NULL,
  `category_name` varchar(200) NOT NULL,
  `category_image` varchar(200) NOT NULL,
  `tag_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dance_forms`
--

CREATE TABLE `tbl_dance_forms` (
  `dance_id` int(200) NOT NULL,
  `dance_name` varchar(200) NOT NULL,
  `category_id` int(200) NOT NULL,
  `price` int(200) NOT NULL,
  `dance_image` varchar(200) NOT NULL,
  `tag_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_enrollment`
--

CREATE TABLE `tbl_enrollment` (
  `id` int(100) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `user_role_id` int(100) NOT NULL,
  `category_id` int(100) NOT NULL,
  `dance_id` int(100) NOT NULL,
  `price` int(100) NOT NULL,
  `instructor_id` int(100) NOT NULL,
  `shift` varchar(100) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `payment_status` varchar(100) NOT NULL DEFAULT 'Pending',
  `address` text NOT NULL,
  `date_of_join` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `id` int(100) NOT NULL,
  `feedback` text NOT NULL,
  `user_id` int(100) NOT NULL,
  `user_role_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_instructors`
--

CREATE TABLE `tbl_instructors` (
  `instructor_id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `instructor_name` varchar(200) NOT NULL,
  `age` int(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `user_role_id` int(200) NOT NULL,
  `experience` int(200) NOT NULL,
  `address` text NOT NULL,
  `instructor_image` varchar(200) NOT NULL,
  `doj` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_instructor_dance_forms`
--

CREATE TABLE `tbl_instructor_dance_forms` (
  `id` int(200) NOT NULL,
  `instructor_role_id` int(200) NOT NULL,
  `dance_id` int(100) NOT NULL,
  `dance_name` varchar(200) NOT NULL,
  `user_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_students`
--

CREATE TABLE `tbl_students` (
  `student_id` int(200) NOT NULL,
  `user_id` int(200) NOT NULL,
  `student_name` varchar(200) NOT NULL,
  `age` int(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `user_role_id` int(200) NOT NULL,
  `address` text NOT NULL,
  `student_image` varchar(200) NOT NULL,
  `doj` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `mobile` varchar(200) NOT NULL,
  `user_role_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `username`, `email`, `password`, `mobile`, `user_role_id`) VALUES
(1, 'Mehmood Shaikh', 'mehmood@gmail.com', '7a60b0f0811de5370cd21d69da0db7cb4aaa1f32', '7412589635', 1),
(2, 'Scarlet Joseph', 'scarlet@gmail.com', '5bcfe00e72a941bf31a1d625e419cd7abba17203', '7896541235', 2),
(3, 'Peter Fernandes', 'peter@gmail.com', '4b8373d016f277527198385ba72fda0feb5da015', '7539514852', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_dance_categories`
--
ALTER TABLE `tbl_dance_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_dance_forms`
--
ALTER TABLE `tbl_dance_forms`
  ADD PRIMARY KEY (`dance_id`);

--
-- Indexes for table `tbl_enrollment`
--
ALTER TABLE `tbl_enrollment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_instructors`
--
ALTER TABLE `tbl_instructors`
  ADD PRIMARY KEY (`instructor_id`);

--
-- Indexes for table `tbl_instructor_dance_forms`
--
ALTER TABLE `tbl_instructor_dance_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_students`
--
ALTER TABLE `tbl_students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_dance_categories`
--
ALTER TABLE `tbl_dance_categories`
  MODIFY `category_id` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_dance_forms`
--
ALTER TABLE `tbl_dance_forms`
  MODIFY `dance_id` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_enrollment`
--
ALTER TABLE `tbl_enrollment`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_instructors`
--
ALTER TABLE `tbl_instructors`
  MODIFY `instructor_id` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_instructor_dance_forms`
--
ALTER TABLE `tbl_instructor_dance_forms`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_students`
--
ALTER TABLE `tbl_students`
  MODIFY `student_id` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
