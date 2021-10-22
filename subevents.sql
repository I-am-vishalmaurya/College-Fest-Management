-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2021 at 05:13 PM
-- Server version: 8.0.26
-- PHP Version: 8.0.9

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
-- Table structure for table `subevents`
--

CREATE TABLE `subevents` (
  `SUB_EVENT_ID` int NOT NULL,
  `EVENT_ID` int NOT NULL,
  `SUB_EVENT_NAME` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `CATEGORY` int DEFAULT NULL,
  `SUB_EVENT_HEAD` int NOT NULL,
  `SUB_EVENT_DESCRIPTION` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `THUMBNAIL` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SUB_EVENT_DATE` datetime NOT NULL,
  `SUB_EVENT_LOCATION` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `CREATED_TIME_STAMP` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subevents`
--

INSERT INTO `subevents` (`SUB_EVENT_ID`, `EVENT_ID`, `SUB_EVENT_NAME`, `CATEGORY`, `SUB_EVENT_HEAD`, `SUB_EVENT_DESCRIPTION`, `THUMBNAIL`, `SUB_EVENT_DATE`, `SUB_EVENT_LOCATION`, `CREATED_TIME_STAMP`) VALUES
(108, 111, 'DANCE BATTLE', 3, 18, 'Lorem Ispum', 'global/eventThumbnails/subevents/615e7b4218a322.47029341.jpg', '2021-10-11 10:14:00', 'Mulund College of commerce', '2021-10-07 04:44:50'),
(114, 114, 'Quiz Compition', 4, 21, 'It is quiz competion', 'global/eventThumbnails/subevents/6163bcb44b5393.14362545.jpg', '2021-10-27 09:54:00', 'Mulund College of commerce', '2021-10-11 04:25:24'),
(115, 113, 'BGMI', 2, 19, 'Play BGMI', 'global/eventThumbnails/subevents/6163bd013783f4.24283069.jpg', '2021-10-30 09:56:00', 'Mulund College of commerce', '2021-10-11 04:26:41'),
(116, 112, 'DJ NIGHT', 3, 21, 'JOIN THE PARTY IN ONE OF THE BIGGEST DJ NIGHT', 'global/eventThumbnails/subevents/6172ac1aceec28.51199732.jpg', '2021-10-30 17:47:00', 'Mulund College of commerce', '2021-10-22 12:18:34'),
(117, 111, 'Fashion Show', 3, 19, 'The fashion club exclusive event with big prizes', 'global/eventThumbnails/subevents/6172b01bda0182.24573256.jpg', '2021-10-30 18:04:00', 'Mulund College of commerce', '2021-10-22 12:35:39'),
(118, 116, 'BEG BORROW STEAL', 1, 22, 'Take home great prizes with a team of four', 'global/eventThumbnails/subevents/6172b1b0661b08.28776077.jpg', '2021-11-01 18:11:00', 'K. J. Somaiya Institute of Engineering and Information Technology', '2021-10-22 12:42:24'),
(119, 116, 'CS GO', 2, 22, 'cs go event', 'global/eventThumbnails/subevents/6172b31533c173.25691347.jpg', '2021-11-03 18:17:00', 'K. J. Somaiya Institute of Engineering and Information Technology', '2021-10-22 12:48:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subevents`
--
ALTER TABLE `subevents`
  ADD PRIMARY KEY (`SUB_EVENT_ID`),
  ADD KEY `events and subevents` (`EVENT_ID`),
  ADD KEY `subevent and sub event head` (`SUB_EVENT_HEAD`),
  ADD KEY `tags and subevents` (`CATEGORY`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subevents`
--
ALTER TABLE `subevents`
  MODIFY `SUB_EVENT_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `subevents`
--
ALTER TABLE `subevents`
  ADD CONSTRAINT `events and subevents` FOREIGN KEY (`EVENT_ID`) REFERENCES `events` (`EVENT_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subevent and sub event head` FOREIGN KEY (`SUB_EVENT_HEAD`) REFERENCES `event_heads` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tags and subevents` FOREIGN KEY (`CATEGORY`) REFERENCES `tags` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
