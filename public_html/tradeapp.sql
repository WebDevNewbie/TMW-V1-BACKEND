-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2018 at 11:19 AM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `user_role` int(10) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `service_name` varchar(800) NOT NULL,
  `service_desc` varchar(800) NOT NULL,
  `age` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(255) NOT NULL,
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

INSERT INTO `users` (`user_id`, `username`, `password`, `user_role`, `first_name`, `last_name`, `service_name`, `service_desc`, `age`, `birthday`, `address`, `activity`, `occupation`, `hobbies`, `skills`, `learn`, `todo`, `visit`, `languages`, `education`, `collegecourse`, `certificate`, `prefer_group`, `prefer_place`, `religion`, `civil_status`, `children`, `live_athome`, `ethniticity`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, 'admin', 'admin', 'test123', 'A simple description', '1', '2018-09-09', 'admin', '\"act1,act2,act3\"', 'engineer', 'hobby', 'skills', 'learn', 'todo', 'visit', 'english', 'bachelors', 'college course', 'certi', '2', '2', 'roman catholic', '2', '2', '2', 'asd'),
(2, 'admin123', '21232f297a57a5a743894a0e4a801fc3', 1, 'admin123', 'admin123', 'test test', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ', '2', '2018-08-02', 'admin,123', '\"activity1,activity3,activity3\"', 'occu', 'hobby1', 'skill1', 'any', 'any', 'any', 'english', 'bachelors', 'secret', 'cert1', '1', '1', 'romans', '1', '1', '1', 'test'),
(8, 'admins', '2aefc34200a294a3cc7db81b43a81873', 1, 'sdfds', 'sdf', '', '', '11', '2018-08-04', 'sdfg', '\"activity1,activity2,activity3\"', 'occupation', 'hobby1', 'skill1', 'any', 'any', 'any', 'english', 'bachelors', 'course1', 'cert1', '1', '1', 'romans', '1', '1', '1', 'test'),
(9, 'scabalida123', '5075b40187a80ae4a9abfe6e8273cef2', 1, 'Test', 'Test', 'Test', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ', '123', '2018-09-19', 'Test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'trader123', '472e8f9bea1f33ec30f73097b7da8e20', 1, 'Reynaldo', 'Lacdo-o', 'IT Solutions', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco ', '25', '1993-08-29', 'Cebu City', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'usertrader', 'a141c47927929bc2d1fb6d336a256df4', 1, 'newuser', 'newuser lastname', 'Fishing Equipment Dealer', 'Sells fishing Equipment for 10 years!', '30', '1985-09-28', 'Cebu', '\"Fishing,Biking,Strolling\"', 'Civil Engineer', 'Playing Guitar enthuast', 'Dancing', 'How to the Guitar', 'nothing for now', 'the world', 'English', 'Bachelors', 'Engineering', '', '1', '1', 'Roman Catholic', '2', '3', '1', 'English');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
