-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Feb 23, 2017 at 02:03 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crm_music`
--
CREATE DATABASE IF NOT EXISTS `crm_music` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `crm_music`;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `date_of_lesson` datetime NOT NULL,
  `id` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_name` varchar(255) NOT NULL,
  `instrument` varchar(255) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `notes` text,
  `id` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_name`, `instrument`, `teacher_id`, `notes`, `id`) VALUES
('Johnny', 'Bongos', 4, 'Wednesday 22nd of February 2017 04:52:20 PM of first entry.', 1),
('Chewbakka', 'Ewok Flute', 4, 'Wednesday 22nd of February 2017 04:52:52 PM of first entry.', 2),
('Chewbakka', 'Ewok Flute', 4, 'Wednesday 22nd of February 2017 04:53:21 PM of first entry.', 3);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_name` varchar(255) NOT NULL,
  `instrument` varchar(100) NOT NULL,
  `notes` text,
  `id` bigint(20) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_name`, `instrument`, `notes`, `id`) VALUES
('Stevo', 'Flute', 'Wednesday 22nd of February 2017 03:01:03 PM of first entry.', 1),
('Stevo', 'Flute', 'Wednesday 22nd of February 2017 03:28:00 PM of first entry.', 2),
('Stevest', 'Super Flute', 'Wednesday 22nd of February 2017 03:44:46 PM of first entry.', 3),
('Stevest', 'Super Flute', 'Wednesday 22nd of February 2017 03:50:35 PM of first entry.', 4),
('Steve', 'Flute', 'Wednesday 22nd of February 2017 03:50:44 PM of first entry.', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
