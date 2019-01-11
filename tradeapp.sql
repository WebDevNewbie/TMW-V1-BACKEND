-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2019 at 02:19 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tradeapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` int(11) NOT NULL,
  `chat_room_id` varchar(30) NOT NULL,
  `from_trader` int(11) NOT NULL,
  `to_trader` int(11) NOT NULL,
  `message` text NOT NULL,
  `datesent` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `imagefiles`
--

CREATE TABLE `imagefiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `dateadded` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profile_images`
--

CREATE TABLE `profile_images` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `profile_img` varchar(255) NOT NULL,
  `dateadded` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile_images`
--

INSERT INTO `profile_images` (`id`, `user_id`, `profile_img`, `dateadded`) VALUES
(1, 21, 'adam.jpg', '2018-12-18 00:00:00'),
(3, 16, '5c1cc2b47c9e6.jpeg', '2018-12-21 18:38:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_role` int(10) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `service_name` varchar(800) NOT NULL,
  `service_desc` varchar(800) NOT NULL,
  `age` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `activity` varchar(1000) DEFAULT NULL,
  `occupation` varchar(1000) DEFAULT NULL,
  `hobbies` varchar(1000) DEFAULT NULL,
  `skills` varchar(1000) DEFAULT NULL,
  `learn` varchar(1000) DEFAULT NULL,
  `todo` varchar(1000) DEFAULT NULL,
  `visit` varchar(1000) DEFAULT NULL,
  `languages` varchar(1000) DEFAULT NULL,
  `education` varchar(1000) DEFAULT NULL,
  `collegecourse` varchar(1000) DEFAULT NULL,
  `certificate` varchar(1000) DEFAULT NULL,
  `prefer_group` varchar(1000) DEFAULT NULL,
  `prefer_place` varchar(1000) DEFAULT NULL,
  `religion` varchar(1000) DEFAULT NULL,
  `civil_status` varchar(1000) DEFAULT NULL,
  `children` varchar(1000) DEFAULT NULL,
  `live_athome` varchar(1000) DEFAULT NULL,
  `ethniticity` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `user_role`, `first_name`, `last_name`, `service_name`, `service_desc`, `age`, `gender`, `birthday`, `address`, `region`, `state`, `country`, `activity`, `occupation`, `hobbies`, `skills`, `learn`, `todo`, `visit`, `languages`, `education`, `collegecourse`, `certificate`, `prefer_group`, `prefer_place`, `religion`, `civil_status`, `children`, `live_athome`, `ethniticity`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', 0, 'admin', 'admin', 'test123', 'A simple description', '1', 1, '2018-09-09', 'admin', '', '', '', '\"act1,act2,act3\"', 'engineer', 'hobby', 'skills', 'learn', 'todo', 'visit', 'english', 'bachelors', 'college course', 'certi', '2', '2', 'roman catholic', '2', '2', '2', 'asd'),
(2, 'admin123', '21232f297a57a5a743894a0e4a801fc3', '', 1, 'admin123', 'admin123', 'test test', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ', '20', 2, '2018-08-02', 'admin,123', '', '', '', '\"activity1,activity3,activity3\"', 'occu', 'hobby1', 'skill1', 'any', 'any', 'any', 'english', 'bachelors', 'secret', 'cert1', '1', '1', 'romans', '1', '1', '1', 'test'),
(8, 'admins', '2aefc34200a294a3cc7db81b43a81873', '', 1, 'sdfds', 'sdf', '', '', '25', 1, '2018-08-04', 'sdfg', '', '', '', '\"activity1,activity2,activity3\"', 'occupation', 'hobby1', 'skill1', 'any', 'any', 'any', 'english', 'bachelors', 'course1', 'cert1', '1', '1', 'romans', '1', '1', '1', 'test'),
(9, 'scabalida123', '5075b40187a80ae4a9abfe6e8273cef2', '', 1, 'Test', 'Test', 'Test', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ', '40', 2, '2018-09-19', 'Test', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'trader123', '472e8f9bea1f33ec30f73097b7da8e20', '', 1, 'Reynaldo', 'Lacdo-o', 'IT Solutions', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ', '25', 1, '1993-08-29', 'Cebu City', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'usertrader', 'a141c47927929bc2d1fb6d336a256df4', '', 1, 'newusers', 'newuser lastname', 'Fishing Equipment Dealer', 'Sells fishing Equipment for 10 years!', '30', 2, '1985-09-27', 'Cebu', '', '', '', '\"Fishing,Biking,Strolling\"', 'Civil Engineer', 'Playing Guitar enthuast', 'Dancing', 'How to the Guitar', 'nothing for now', 'the world', 'English', 'Bachelors', 'Engineering', '', '1', '1', 'Roman Catholic', '2', '3', '1', 'English'),
(16, 'username24', 'd6b0ab7f1c8ab8f514db9a6d85de160a', '', 1, 'Simple User', 'Simeple', 'Simple Service', 'Simple description', '25', 1, '1993-02-24', 'Cebu City', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'username25', '0659c7992e268962384eb17fafe88364', '', 1, 'My fname', 'My Lastname', 'my service', 'my service desc', '25', 1, '1993-12-12', 'Cebu City', '', '', '', '\"Swimming,Dancing,Playing the guitar\"', 'Fish dealing', 'Guitar playing', 'Guitar playing', 'I want to learn how to make a website', 'None for now', 'Japan', 'English', 'Bachelors', 'Engineering', '', '2', '1', 'Roman catholic', '', 'None', '2', 'English'),
(18, 'username26', '183f3364ed7564a9f5624da2421edeed', '', 2, 'Firstname26', 'lastname26', 'computer sales', 'Sales of computer', '25', 1, '1993-11-07', 'Cebu city, philippines', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'username27', '9a361ed860ec2617da5af72079594a21', '', 3, 'name27', 'lastname27', 'Driving Expert', 'Driving professional for 20 years', '25', 1, '1993-11-08', 'Tacloban City', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'username28', '1722442b586a85c95593a9c6131a0ebd', 'reynaldolacdoo@gmail.com', 3, 'Name28', 'lastname28', 'Mechanics Expert', '', '25', 1, '2018-01-01', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'username30', '57041f8f7dff9b67e3f97d7facbaf8d3', 'reynaldolacdoo@gmail.com', 3, 'name30', 'lastname30', 'Statistics Surveying', '', '30', 2, '2018-01-01', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `videofiles`
--

CREATE TABLE `videofiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `dateadded` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `video_promotion`
--

CREATE TABLE `video_promotion` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_name` varchar(30) NOT NULL,
  `dateadded` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imagefiles`
--
ALTER TABLE `imagefiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_images`
--
ALTER TABLE `profile_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `videofiles`
--
ALTER TABLE `videofiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video_promotion`
--
ALTER TABLE `video_promotion`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `imagefiles`
--
ALTER TABLE `imagefiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile_images`
--
ALTER TABLE `profile_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `videofiles`
--
ALTER TABLE `videofiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video_promotion`
--
ALTER TABLE `video_promotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
