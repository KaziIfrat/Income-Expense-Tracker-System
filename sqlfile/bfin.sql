-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2018 at 01:50 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bfin`
--

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `addresss` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `age` int(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`user_id`, `user_name`, `email`, `phone`, `addresss`, `gender`, `age`, `password`) VALUES
(16, 'ananya', 'ananya@gmail.com', '1680615984', 'nobodoy', 'female', 25, '11'),
(18, 'Mormi', 'mormi@gmail.com', '01676103236', 'Mohammadpur', 'female', 24, 'mormi'),
(19, 'Tori', 'tori@gmail.com', '01111111111', 'Mohammadpur', 'female', 24, 'tori'),
(20, 'shama', 'shama@gmail.com', '01819145941', 'Mohammadpur', 'female', 24, 'shama');

-- --------------------------------------------------------

--
-- Table structure for table `person_information`
--

CREATE TABLE `person_information` (
  `info_id` int(11) NOT NULL,
  `person_id` int(11) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `DDate` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `income` float(7,2) DEFAULT NULL,
  `expense` float(7,2) DEFAULT NULL,
  `debitcredit` varchar(6) DEFAULT NULL,
  `balance` float(7,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person_information`
--

INSERT INTO `person_information` (`info_id`, `person_id`, `account_name`, `DDate`, `description`, `category`, `income`, `expense`, `debitcredit`, `balance`) VALUES
(1, 16, 'Checking', '2018-04-06', 'Beginning Balance', '[Balance]', 750.00, NULL, 'debit', 750.00),
(2, 16, 'Cash', '2018-04-02', 'Beginning Balance', '[Balance]', 50.00, NULL, 'debit', 800.00),
(4, 16, 'Credit', '2018-04-11', 'Beginning Balance', '[Balance]', NULL, 340.00, 'credit', 460.00),
(5, 16, 'Savings', '2018-04-12', 'Beginning Balance', '[Balance]', 850.00, NULL, 'debit', 1310.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `person_information`
--
ALTER TABLE `person_information`
  ADD PRIMARY KEY (`info_id`),
  ADD KEY `person_id` (`person_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `person_information`
--
ALTER TABLE `person_information`
  MODIFY `info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `person_information`
--
ALTER TABLE `person_information`
  ADD CONSTRAINT `person_information_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
