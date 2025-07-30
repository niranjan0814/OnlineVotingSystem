-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8111
-- Generation Time: May 10, 2024 at 09:16 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AID` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `phoneNo` varchar(15) DEFAULT NULL,
  `pw` varchar(8) NOT NULL,
  `email` varchar(40) NOT NULL CHECK (`email` like '%_@__%.__%')
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contestant`
--

CREATE TABLE `contestant` (
  `CName` varchar(30) DEFAULT NULL,
  `Email` varchar(30) NOT NULL,
  `Phone` bigint(20) NOT NULL,
  `Gender` varchar(30) NOT NULL,
  `CPassword` varchar(20) NOT NULL,
  `cimage` varchar(255) NOT NULL,
  `CID` int(4) NOT NULL,
  `ShID` int(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contestant`
--

INSERT INTO `contestant` (`CName`, `Email`, `Phone`, `Gender`, `CPassword`, `cimage`, `CID`, `ShID`) VALUES
('Daviny', 'daviny@example.com', 5553334444, 'Female', 'Roy', '', 4, 1),
('Jakinthan', 'jakinthan@example.com', 5554445555, 'Male', 'Nimal', '', 5, 1),
('Olivia ', 'olivia@example.com', 5555556666, 'Female', 'Kmara', '', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `Fid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `CID` int(11) NOT NULL,
  `feedback` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mngvotes`
--

CREATE TABLE `mngvotes` (
  `MVID` int(4) NOT NULL,
  `Shid` int(4) DEFAULT NULL,
  `s_date` date DEFAULT NULL,
  `e_date` date DEFAULT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mngvotes`
--

INSERT INTO `mngvotes` (`MVID`, `Shid`, `s_date`, `e_date`, `name`) VALUES
(1, NULL, '2024-05-29', '2024-05-30', 'bigboss'),
(2, NULL, '2024-05-14', '2024-05-30', 'talk'),
(3, NULL, '2024-05-01', '2023-01-17', 'song');

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

CREATE TABLE `sponsor` (
  `SPID` int(4) NOT NULL,
  `Company_name` varchar(100) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE `sponsors` (
  `ShID` int(11) NOT NULL,
  `SPID` int(11) NOT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `advertisement` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tshow`
--

CREATE TABLE `tshow` (
  `Show_Name` varchar(255) NOT NULL,
  `television` varchar(255) NOT NULL,
  `seasion` varchar(255) DEFAULT NULL,
  `simage` varchar(255) DEFAULT NULL,
  `ShID` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tshow`
--

INSERT INTO `tshow` (`Show_Name`, `television`, `seasion`, `simage`, `ShID`) VALUES
('BIGG BOSS', 'vijay', '1', 'phpmyadmin5.png', 1),
('SUPER SINGER', '', 'Season 1', NULL, 2),
('cwc', 'vtv', '1', '', 13);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phonenumber` int(11) NOT NULL,
  `dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `phonenumber`, `dob`) VALUES
(0, 'Logini', 'Logini@4', 'logi44@gmail.com', 785421365, '2024-05-25'),
(1, 'Harish', 'ram', 'ram@gmail.com', 14698752, '2024-05-06'),
(2, 'Ben', 'pass', 'ben@gmail.com', 23659845, '2024-05-17'),
(3, 'Dilu', 'fun', 'dilu@gmail.com', 45879653, '2024-05-24'),
(4, 'George', 'jude', 'george@gmail.com', 7895642, '2024-05-17'),
(5, 'Harsha', 'tum', 'harsha@gmail.com', 56987502, '2024-05-30');

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `count` int(11) DEFAULT NULL,
  `feedback` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`id`, `name`, `count`, `feedback`) VALUES
(1, 'shanru', 5, 'good performance'),
(52, 'drstr', 2, NULL),
(53, 'dicap', 2, NULL),
(54, 'toms', 3, NULL),
(55, 'david', 2, NULL),
(56, 'ryan', 4, NULL),
(57, 'drstr', 1, NULL),
(58, 'dicap', 1, NULL),
(59, 'toms', 5, NULL),
(60, 'david', 1, NULL),
(61, 'ryan', 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `VID` int(4) NOT NULL,
  `id` int(4) DEFAULT NULL,
  `CID` int(4) DEFAULT NULL,
  `Date` date NOT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AID`);

--
-- Indexes for table `contestant`
--
ALTER TABLE `contestant`
  ADD PRIMARY KEY (`CID`),
  ADD KEY `ShID` (`ShID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`Fid`),
  ADD KEY `feedback_User_FK` (`id`),
  ADD KEY `feedback_Contestant_FK` (`CID`);

--
-- Indexes for table `mngvotes`
--
ALTER TABLE `mngvotes`
  ADD PRIMARY KEY (`MVID`),
  ADD KEY `Vote_show_FK` (`Shid`);

--
-- Indexes for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD PRIMARY KEY (`SPID`);

--
-- Indexes for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD KEY `Sponsors_Sponsor_FK` (`SPID`),
  ADD KEY `Sponsors_show_FK` (`ShID`);

--
-- Indexes for table `tshow`
--
ALTER TABLE `tshow`
  ADD PRIMARY KEY (`ShID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`VID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contestant`
--
ALTER TABLE `contestant`
  MODIFY `CID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mngvotes`
--
ALTER TABLE `mngvotes`
  MODIFY `MVID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sponsor`
--
ALTER TABLE `sponsor`
  MODIFY `SPID` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tshow`
--
ALTER TABLE `tshow`
  MODIFY `ShID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `VID` int(4) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contestant`
--
ALTER TABLE `contestant`
  ADD CONSTRAINT `contestant_ibfk_1` FOREIGN KEY (`ShID`) REFERENCES `tshow` (`ShID`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_Contestant_FK` FOREIGN KEY (`CID`) REFERENCES `contestant` (`CID`),
  ADD CONSTRAINT `feedback_User_FK` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Constraints for table `mngvotes`
--
ALTER TABLE `mngvotes`
  ADD CONSTRAINT `Vote_show_FK` FOREIGN KEY (`Shid`) REFERENCES `tshow` (`ShID`);

--
-- Constraints for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD CONSTRAINT `Sponsors_Sponsor_FK` FOREIGN KEY (`SPID`) REFERENCES `sponsor` (`SPID`),
  ADD CONSTRAINT `Sponsors_show_FK` FOREIGN KEY (`ShID`) REFERENCES `tshow` (`ShID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
