-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 16, 2020 at 01:33 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `name`, `email`, `info`, `password`, `role`) VALUES
(4, 'Alex', 'alex@mail.com', 'Manager', 'alex123', 'user'),
(5, 'Kukul', 'abc@email.cz', 'adsad', '$2y$10$S9epo3aACQc5VbJzPep/1OT4jFcJCysTgobI0vG/pQJsvhDyy/1WK', 'user'),
(7, 'zhora', 'zhora@email.com', 'Zhora', '$2y$10$xBEsqhQoFyVHQuEHOXXZruEki4MlRwAOHglsI8j47EElziR5Jl/1K', 'user'),
(8, 'testAdmin', 'admin@email.com', 'Admin', '$2y$10$UUGhJJNZBvq.E.xdCaHsfe8cmA2wgPSFYsDlI32CTRrY3TvjWLWBe', 'admin'),
(9, 'newAdmin', 'newAdmin@mail.com', 'another Admin', '$2y$10$Ea02BE6cyDi9aWkawJjBPOYNmftK/hGtPxB82w7ETC6viT8piUWT2', 'admin'),
(10, 'user', 'user@mail.com', 'user', '$2y$10$XOzCbPTKfaUNxLIMDBSZl.VTPOW7zASmH2AFr3jVM5v8f3r8Kpq/O', 'user'),
(11, 'newTestUser', 'test@mail.cz', 'Another User', '$2y$10$mT8BwAYsUC79sSuqXFYqOuWR3fgQzapmvNN7PdE5ctY3yRO8T/psO', 'user'),
(12, 'myUser', 'usr@mail.cz', 'user', '$2y$10$sO.NinSKR.b9Qe2RbWUNr.fItfzltZFd2BkHJAB1Vz05kiBITKQ5K', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
