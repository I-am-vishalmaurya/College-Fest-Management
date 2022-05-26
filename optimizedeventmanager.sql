-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 26, 2022 at 01:09 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `optimizedeventmanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `EVENT_ID` int(11) NOT NULL,
  `EVENT_HEAD_ID` int(11) NOT NULL,
  `EVENT_NAME` varchar(255) NOT NULL,
  `EVENT_HEAD_EMAIL` varchar(255) NOT NULL,
  `PLACE` varchar(255) NOT NULL,
  `DESCRIPTION` varchar(255) NOT NULL,
  `THUMBNAIL` varchar(255) NOT NULL,
  `EVENT_START_DATE` date NOT NULL,
  `EVENT_END_DATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`EVENT_ID`, `EVENT_HEAD_ID`, `EVENT_NAME`, `EVENT_HEAD_EMAIL`, `PLACE`, `DESCRIPTION`, `THUMBNAIL`, `EVENT_START_DATE`, `EVENT_END_DATE`) VALUES
(1, 3, 'Spectrum', 'admin@admin.com', 'Mulund', 'A spectrum is an Intercollegiate event organized by Mulund College of Commerce with the theme of Metaverse', 'global/eventThumbnails/events/628f133513cf05.05280109.jpeg', '2022-05-31', '2022-06-08');

-- --------------------------------------------------------

--
-- Table structure for table `event_heads`
--

CREATE TABLE `event_heads` (
  `ID` int(11) NOT NULL,
  `EH_NAME` varchar(255) NOT NULL,
  `EH_EMAIL` varchar(255) NOT NULL,
  `EH_PASSWORD` varchar(1000) NOT NULL,
  `ORG_ID` int(11) DEFAULT NULL,
  `ORG_STATUS` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `event_heads`
--

INSERT INTO `event_heads` (`ID`, `EH_NAME`, `EH_EMAIL`, `EH_PASSWORD`, `ORG_ID`, `ORG_STATUS`) VALUES
(3, 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 2, 'ADMIN'),
(4, 'Test Account', 'test@test.com', '098f6bcd4621d373cade4e832627b4f6', 2, 'JOINED');

-- --------------------------------------------------------

--
-- Table structure for table `joined_events`
--

CREATE TABLE `joined_events` (
  `ID` int(11) NOT NULL,
  `SUB_EVENT_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `joined_events`
--

INSERT INTO `joined_events` (`ID`, `SUB_EVENT_ID`, `USER_ID`) VALUES
(2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `liked_the_project`
--

CREATE TABLE `liked_the_project` (
  `ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `LIKED` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `liked_the_project`
--

INSERT INTO `liked_the_project` (`ID`, `USER_ID`, `LIKED`) VALUES
(1, 1, 1),
(2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `ORG_ID` int(11) NOT NULL,
  `ORG_NAME` varchar(255) NOT NULL,
  `ORG_ADMIN_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`ORG_ID`, `ORG_NAME`, `ORG_ADMIN_ID`) VALUES
(2, 'Spectrum - MCC', 3);

-- --------------------------------------------------------

--
-- Table structure for table `saved_events`
--

CREATE TABLE `saved_events` (
  `ID` int(11) NOT NULL,
  `SUB_EVENT_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saved_events`
--

INSERT INTO `saved_events` (`ID`, `SUB_EVENT_ID`, `USER_ID`) VALUES
(2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subevents`
--

CREATE TABLE `subevents` (
  `SUB_EVENT_ID` int(11) NOT NULL,
  `EVENT_ID` int(11) NOT NULL,
  `SUB_EVENT_NAME` varchar(255) NOT NULL,
  `CATEGORY` varchar(255) NOT NULL,
  `SUB_EVENT_HEAD` int(11) NOT NULL,
  `SUB_EVENT_DESCRIPTION` varchar(1000) NOT NULL,
  `THUMBNAIL` varchar(1000) NOT NULL,
  `SUB_EVENT_DATE` datetime NOT NULL,
  `SUB_EVENT_LOCATION` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subevents`
--

INSERT INTO `subevents` (`SUB_EVENT_ID`, `EVENT_ID`, `SUB_EVENT_NAME`, `CATEGORY`, `SUB_EVENT_HEAD`, `SUB_EVENT_DESCRIPTION`, `THUMBNAIL`, `SUB_EVENT_DATE`, `SUB_EVENT_LOCATION`) VALUES
(1, 1, 'Valorant', '2', 4, 'Valorant torunament', 'global/eventThumbnails/subevents/628f1b74eeb363.33858182.jpeg', '2022-05-30 11:47:00', 'Mulund College of Commerce');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `ID` int(11) NOT NULL,
  `tagName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`ID`, `tagName`) VALUES
(1, 'Entertainment'),
(2, 'Sports');

-- --------------------------------------------------------

--
-- Table structure for table `users_details`
--

CREATE TABLE `users_details` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `PASSWORD` varchar(1000) NOT NULL,
  `PHONE` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_details`
--

INSERT INTO `users_details` (`ID`, `NAME`, `EMAIL`, `PASSWORD`, `PHONE`) VALUES
(1, 'VISHAL MAURYA', 'vishalmaurya3112@gmail.com', '474cabeeba8069faec8e3c63214b217d', '9076260427');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`EVENT_ID`);

--
-- Indexes for table `event_heads`
--
ALTER TABLE `event_heads`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `joined_events`
--
ALTER TABLE `joined_events`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SUBEVENT AND JOINED EVENT` (`SUB_EVENT_ID`),
  ADD KEY `USER AND JOINED EVENT` (`USER_ID`);

--
-- Indexes for table `liked_the_project`
--
ALTER TABLE `liked_the_project`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `liked and user id` (`USER_ID`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`ORG_ID`),
  ADD KEY `ORG ADMIN ID AND EVENT HEADS` (`ORG_ADMIN_ID`);

--
-- Indexes for table `saved_events`
--
ALTER TABLE `saved_events`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Saved and user` (`USER_ID`),
  ADD KEY `Saved and Sub event` (`SUB_EVENT_ID`);

--
-- Indexes for table `subevents`
--
ALTER TABLE `subevents`
  ADD PRIMARY KEY (`SUB_EVENT_ID`),
  ADD KEY `EVENT AND SUBEVENT` (`EVENT_ID`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users_details`
--
ALTER TABLE `users_details`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `EVENT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event_heads`
--
ALTER TABLE `event_heads`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `joined_events`
--
ALTER TABLE `joined_events`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `liked_the_project`
--
ALTER TABLE `liked_the_project`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `ORG_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `saved_events`
--
ALTER TABLE `saved_events`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subevents`
--
ALTER TABLE `subevents`
  MODIFY `SUB_EVENT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_details`
--
ALTER TABLE `users_details`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `joined_events`
--
ALTER TABLE `joined_events`
  ADD CONSTRAINT `SUBEVENT AND JOINED EVENT` FOREIGN KEY (`SUB_EVENT_ID`) REFERENCES `subevents` (`SUB_EVENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `USER AND JOINED EVENT` FOREIGN KEY (`USER_ID`) REFERENCES `users_details` (`ID`);

--
-- Constraints for table `liked_the_project`
--
ALTER TABLE `liked_the_project`
  ADD CONSTRAINT `liked and user id` FOREIGN KEY (`USER_ID`) REFERENCES `users_details` (`ID`);

--
-- Constraints for table `organizations`
--
ALTER TABLE `organizations`
  ADD CONSTRAINT `ORG ADMIN ID AND EVENT HEADS` FOREIGN KEY (`ORG_ADMIN_ID`) REFERENCES `event_heads` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `saved_events`
--
ALTER TABLE `saved_events`
  ADD CONSTRAINT `Saved and Sub event` FOREIGN KEY (`SUB_EVENT_ID`) REFERENCES `subevents` (`SUB_EVENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Saved and user` FOREIGN KEY (`USER_ID`) REFERENCES `users_details` (`ID`);

--
-- Constraints for table `subevents`
--
ALTER TABLE `subevents`
  ADD CONSTRAINT `EVENT AND SUBEVENT` FOREIGN KEY (`EVENT_ID`) REFERENCES `events` (`EVENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
