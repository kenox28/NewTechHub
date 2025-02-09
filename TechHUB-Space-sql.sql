-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2024 at 02:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `progbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `userid` int(200) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `img` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `bdate` date NOT NULL,
  `dateadded` date NOT NULL DEFAULT current_timestamp(),
  `number` int(12) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `userid`, `fname`, `lname`, `email`, `password`, `img`, `gender`, `bdate`, `dateadded`, `number`, `status`) VALUES
(92, 126618380, 'Iquen', 'Marba', 'Iquen@gmail.com', '1', 'ken.jpg', 'Male', '2004-04-28', '2024-12-06', 2147483647, 'Active now'),
(93, 806996988, 'Migs', 'Bacho', 'migs@gmail.com', '1', 'migs.jpg', 'Male', '2024-12-13', '2024-12-06', 123456, 'Offline'),
(94, 298954094, 'james', 'cortez', 'james@gmail.com', '1', 'james.jpg', 'Male', '2024-12-18', '2024-12-06', 2147483647, 'Offline'),
(95, 1364466008, 'cathia', 'ulan-ulan', 'cat@gmail.com', '1', 'cath.jpg', 'Female', '2025-01-02', '2024-12-06', 1234444434, 'Active now'),
(96, 712254578, 'Cyril', 'Neuva', 'cy@gmail.com', '1', 'cyril.jpg', 'Female', '2024-12-10', '2024-12-06', 121212121, 'Offline'),
(97, 1260625551, 'Ton', 'Rosos', 'ton@gmail.com', '1', 'ton.jpg', 'Male', '2024-12-25', '2024-12-06', 12121212, 'Offline'),
(98, 60158149, 'roxanne', ' Dalag ', 'rox@gmail.com', '1', 'rox2.jpg', 'Female', '2024-12-12', '2024-12-06', 2133123, 'Offline'),
(99, 722419606, 'John loyd', 'Estrera', 'iro@gmail.com', '1', 'iro.jpg', 'Male', '2222-03-31', '2024-12-06', 312312312, 'Offline'),
(100, 831820377, 'chan', 'colo', 'chan@gmail.com', '1', 'chan.jpg', 'Male', '2024-12-20', '2024-12-06', 2147483647, 'Offline'),
(101, 614538328, 'Kathy', 'Geses', 'kat@gmail.com', '1', 'kat.jpg', 'Female', '2024-12-11', '2024-12-06', 2147483647, 'Offline'),
(102, 1559275932, 'kaye', 'neuvo', 'kaye@gmail.com', '1', 'kaye.jpg', 'Female', '2024-12-11', '2024-12-06', 11111, 'Offline'),
(103, 1127920759, 'Orwell', 'Barida', 'oil@gmail.com', '1', 'orwel.jpg', 'Male', '3123-03-12', '2024-12-06', 2147483647, 'Offline'),
(104, 1069525477, 'john pual', 'vasquez', 'jp@gmail.com', '1', 'paul.jpg', 'Male', '0000-00-00', '2024-12-06', 23123, 'Offline'),
(105, 354271620, 'Von', 'Alfelor', 'von@gmail.com', '1', 'von.jpg', 'Male', '2132-02-13', '2024-12-06', 3213123, 'Active now'),
(106, 878786495, 'russel', 'dasigan', 'rus@gmail.com', '1', 'noprofile.jpg', 'Male', '2025-01-01', '2024-12-06', NULL, 'Active now'),
(107, 1480183258, 'loren', 'capuyan', 'loren@gmail.com', '1', 'migs.jpg', 'Male', '2024-12-10', '2024-12-06', 23123123, 'Offline'),
(133, 1427988314, 'Iquen', 'gwaps', 'iquen.marba@evsu.edu.ph', 'iquenpasssajdkasdlkajslkdj', 'noprofile.jpg', 'Male', '2024-12-05', '2024-12-07', NULL, NULL),
(150, 933444867, 'create', 'account', 'create@gmailcom', '1', 'noprofile.jpg', 'Male', '2024-12-11', '2024-12-09', NULL, NULL),
(151, 235122581, 'dasdsad', 'asdasd', 'asda@gmail.com123', 'dasdsadas', 'noprofile.jpg', 'Male', '2024-12-11', '2024-12-09', NULL, NULL),
(152, 308574348, 'sdasd', 'dasd', 'dasdsa@gmailcom', 'dasda', 'noprofile.jpg', 'Male', '2024-12-04', '2024-12-09', NULL, NULL),
(153, 562043732, 'iquen', 'marba', 'iquenxzx@gmail.com', '1', 'noprofile.jpg', 'Male', '2024-12-25', '2024-12-10', NULL, NULL),
(154, 726388679, 'Hello ', 'World', 'Hello@gmail.com', '212312312', 'noprofile.jpg', 'Male', '2024-12-24', '2024-12-10', NULL, NULL),
(155, 14764462, 'cathia', 'ulan-ulan', 'cathiaulanulan@gmail.com', '1', 'noprofile.jpg', 'Male', '2025-01-06', '2024-12-10', NULL, NULL),
(158, 1237813353, 'von', 'alfelor', 'von1@gmail.com', '1', 'noprofile.jpg', 'Male', '2024-12-17', '2024-12-11', NULL, 'Offline'),
(160, 1065399308, 'miggs', 'gwapokaayo', 'miguelito.bacho@evsu.edu.ph', '1234', 'migs.jpg', 'Male', '2024-12-18', '2024-12-11', 98765433, 'Active now'),
(161, 1492320003, 'Orly', 'Orge', 'orlyorge2004@gmail.com', '1', 'ken.jpg', 'Male', '2024-12-18', '2024-12-12', 2147483647, 'Active now'),
(162, 1029895314, 'Nicole', 'Cretecio', 'Nicole@gmail.com', '1', 'nic4.jpg', 'Female', '2024-12-26', '2024-12-12', 890890890, 'Offline'),
(163, 1038765506, 'cuttie', 'pie', 'kuya4949@gmail.com', '123', 'sirconds.jpg', 'Male', '2024-12-12', '2024-12-12', 123, 'Active now'),
(164, 540282169, 'Johny ', 'Sins', 'johnysins@gmail.com', 'john123', 'noprofile.jpg', 'Male', '1946-12-13', '2024-12-13', NULL, 'Active now');

-- --------------------------------------------------------

--
-- Table structure for table `archive`
--

CREATE TABLE `archive` (
  `id` int(11) NOT NULL,
  `userid` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `DeletedDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archive`
--

INSERT INTO `archive` (`id`, `userid`, `fname`, `lname`, `email`, `password`, `gender`, `DeletedDate`) VALUES
(1, 201505220, 'First name', 'last name', 'russmamen@gmen.men', 'Enter Password', 'MALE', '2024-11-29 02:07:15'),
(2, 1061034374, 'Christian', 'Paul', 'chanpaul791@gmail.com', 'piologwapo', 'MALE', '2024-11-29 02:10:01'),
(3, 668582793, 'ivy', 'marba', 'wq@gmail.com', '123', 'FEMALE', '2024-11-29 02:42:05'),
(4, 1061034374, 'Christian', 'Paul', 'chanpaul791@gmail.com', 'piologwapo', 'MALE', '2024-11-29 02:42:11'),
(5, 373462801, 'First name', 'last name', 'russmamen@gmen.men', 'Enter Password', 'MALE', '2024-11-29 02:42:14'),
(6, 281319889, 'kenno', '1', 'email@gmail.com', '3', 'MALE', '2024-11-29 02:42:24'),
(7, 694693865, 'cathia', 'rain-rain', 'cathia@gmail.com', 'cathia', 'Female', '2024-11-29 02:42:39'),
(8, 1061884084, 'viceganda2', 'ganda3', 'email1233333@gmail.com', '1', 'MALE', '2024-11-29 02:42:46'),
(9, 1618984601, 'kenno', 'Marba', 'email4@gmail.com', '1', 'MALE', '2024-11-29 02:42:57'),
(10, 850798441, '1', '1', '11111@gmail.com', '1', 'MALE', '2024-11-29 02:43:20'),
(11, 1718937802, 'iquen', 'marba', '12345@gmail.com', '1', 'Male', '2024-11-29 19:18:29'),
(12, 746402241, '11', '11', '1111@gmail.com', '$2y$10$RoJDcDZpsVYKwZZIDqg22.veg1F1aRNkKjjFj0Y0nRKcc/zMvQ4.6', 'Male', '2024-11-29 19:19:46'),
(13, 115776603, 'Iquen', 'Marba', 'ken@gmail.com', '1', 'MALE', '2024-11-29 19:20:04'),
(14, 1000876662, 'newname', 'newlastname', '123@gmail.com', 'newpass', 'MALE', '2024-11-29 19:20:24'),
(15, 675062991, 'Iquen', 'marba', 'Iquen@gmail.com', '1', 'MALE', '2024-11-29 19:20:35'),
(16, 716184028, 'Iquen', 'marba', 'Iquen@gmail.com', '1', 'Male', '2024-12-06 16:37:21'),
(17, 1494734914, 'Cathia', 'Ulanulanupdated', 'cathiaulanulan@gmail.com', '1', 'Female', '2024-12-08 23:36:48'),
(18, 732450691, 'iquen', 'marba', 'iquenxzx@gmail.com', '1', 'Male', '2024-12-08 23:36:53'),
(19, 307938448, 'James', 'cortez', 'james.cortez@evsu.edu.ph', 'jamespasswordakdjlaksjdlkjaslkdjals', 'Male', '2024-12-08 23:36:57'),
(20, 1376536383, 'dasdasd', 'dasdasd', 'adasdasd@gmail.com', '1', 'Male', '2024-12-11 14:10:00'),
(21, 127647277, 'eqweqwe', 'qweqwe', 'qweqw@gmail.com', '1', 'Male', '2024-12-11 14:10:14'),
(22, 1615573722, 'miggyy', 'Bacho', 'migsbacho04@gmail.com', '123', 'Male', '2024-12-11 15:21:31');

-- --------------------------------------------------------

--
-- Table structure for table `feedbackmessage`
--

CREATE TABLE `feedbackmessage` (
  `id` int(11) NOT NULL,
  `userid` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `rating` int(255) NOT NULL,
  `datefeedback` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedbackmessage`
--

INSERT INTO `feedbackmessage` (`id`, `userid`, `fname`, `lname`, `img`, `feedback`, `rating`, `datefeedback`) VALUES
(1, 126618380, 'Iquen', 'Marba', 'ken.jpg', 'hello', 3, '2024-12-07 23:31:24'),
(2, 354271620, 'Von', 'Alfelor', 'von.jpg', 'hello', 5, '2024-12-07 23:46:43'),
(3, 354271620, 'Von', 'Alfelor', 'von.jpg', 'message', 5, '2024-12-07 23:46:53'),
(4, 354271620, 'Von', 'Alfelor', 'von.jpg', 'leaderboards', 3, '2024-12-07 23:47:09'),
(5, 126618380, 'Iquen', 'Marba', 'ken.jpg', 'leaderboards123', 5, '2024-12-07 23:58:23'),
(6, 126618380, 'Iquen', 'Marba', 'ken.jpg', 'toppost', 4, '2024-12-08 00:31:04'),
(7, 126618380, 'Iquen', 'Marba', 'ken.jpg', 'toppost', 4, '2024-12-08 00:31:04'),
(8, 126618380, 'Iquen', 'Marba', 'ken.jpg', 'toppost', 5, '2024-12-08 00:31:33'),
(9, 126618380, 'Iquen', 'Marba', 'ken.jpg', 'toppost', 5, '2024-12-08 00:31:33'),
(10, 126618380, 'Iquen', 'Marba', 'ken.jpg', 'rklajdljsalkdas', 5, '2024-12-08 23:30:03'),
(11, 126618380, 'Iquen', 'Marba', 'ken.jpg', 'shit\r\n', 4, '2024-12-10 00:38:34'),
(12, 126618380, 'Iquen', 'Marba', 'ken.jpg', 'dfsf', 4, '2024-12-10 02:39:43'),
(13, 126618380, 'Iquen', 'Marba', 'ken.jpg', 'hi', 4, '2024-12-10 02:42:52'),
(14, 126618380, 'Iquen', 'Marba', 'ken.jpg', 'techhub', 5, '2024-12-11 00:21:31'),
(15, 126618380, 'Iquen', 'Marba', 'ken.jpg', 'wow', 5, '2024-12-11 15:59:16'),
(16, 126618380, 'Iquen', 'Marba', 'ken.jpg', 'wow', 5, '2024-12-11 15:59:48'),
(17, 1065399308, 'miggs', 'gwapokaayo', 'migs.jpg', 'very nice system 5 star ka saken', 5, '2024-12-12 23:05:36');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `img` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `fname`, `lname`, `img`, `status`, `date`) VALUES
(414, 'iquen', 'marba', '311770063_1560898914327015_2765098293706730673_n (2).jpg', 'Active now', '2024-05-20'),
(415, 'iquen', 'marba', '311770063_1560898914327015_2765098293706730673_n (2).jpg', 'Active now', '2024-05-21');

-- --------------------------------------------------------

--
-- Table structure for table `newsfeed`
--

CREATE TABLE `newsfeed` (
  `id` int(11) NOT NULL,
  `userid` int(255) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(10) NOT NULL,
  `img1` varchar(255) NOT NULL,
  `react` int(11) NOT NULL,
  `cappost` varchar(100) NOT NULL,
  `imgpost` varchar(255) NOT NULL,
  `postdate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `newsfeed`
--

INSERT INTO `newsfeed` (`id`, `userid`, `fname`, `lname`, `img1`, `react`, `cappost`, `imgpost`, `postdate`) VALUES
(52, 1364466008, 'cathia', 'ulan-ulan', 'cath.jpg', 1002, 'Iloveyou von <3', 'cath.jpg', '2024-12-06 17:49:53'),
(53, 298954094, 'james', 'cortez', 'james.jpg', 20, 'shesh', 'james.jpg', '2024-12-06 17:52:34'),
(54, 806996988, 'Migs', 'Bacho', 'migs.jpg', 24, 'Miggy migs', 'migs.jpg', '2024-12-06 17:58:08'),
(55, 1260625551, 'Ton', 'Rosos', 'ton.jpg', 15, 'tonny tonny ;)', 'ton.jpg', '2024-12-06 18:00:26'),
(56, 712254578, 'Cyril', 'Neuva', 'cyril.jpg', 15, 'cy cy', 'cyril.jpg', '2024-12-06 18:02:42'),
(57, 1559275932, 'kaye', 'neuvo', 'kaye.jpg', 15, 'kaie', 'kaye.jpg', '2024-12-06 18:29:54'),
(58, 831820377, 'chan', 'colo', 'chan.jpg', 20, 'Mang channy', 'chan.jpg', '2024-12-06 18:31:21'),
(59, 60158149, 'roxanne', ' Dalag ', 'rox2.jpg', 20, 'clyde para sayo lang ako<3', 'rox2.jpg', '2024-12-06 18:33:59'),
(60, 614538328, 'Kathy', 'Geses', 'kat.jpg', 22, 'BUAK', 'kat.jpg', '2024-12-06 18:35:53'),
(61, 722419606, 'John loyd', 'Estrera', 'iro.jpg', 17, 'rawrf', 'iro.jpg', '2024-12-06 18:38:11'),
(62, 354271620, 'Von', 'Alfelor', 'von.jpg', 4501, 'cathia only', 'von.jpg', '2024-12-06 18:40:16'),
(63, 1127920759, 'Orwell', 'Barida', 'orwel.jpg', 15, 'OIL', 'orwel.jpg', '2024-12-06 18:42:39'),
(64, 1127920759, 'Orwell', 'Barida', 'orwel.jpg', 38, '<3', 'tanan.jpg', '2024-12-06 18:43:05'),
(65, 1069525477, 'john pual', 'vasquez', 'paul.jpg', 5345, 'Senior dev in just 1month current salary 150,000,00', 'paul.jpg', '2024-12-06 18:48:19'),
(66, 126618380, 'Iquen', 'Marba', 'ken.jpg', 32, 'Hello World', 'ken.jpg', '2024-12-06 18:56:18'),
(67, 1480183258, 'loren', 'capuyan', 'migs.jpg', 2, 'posst', 'von.jpg', '2024-12-06 22:19:45'),
(68, 126618380, 'Iquen', 'Marba', 'ken.jpg', 3123, 'hi idol', 'james.jpg', '2024-12-06 22:31:19'),
(69, 126618380, 'Iquen', 'Marba', 'ken.jpg', 1312, 'huhuhu kapoy', 'ken.jpg', '2024-12-07 23:32:15'),
(70, 126618380, 'Iquen', 'Marba', 'ken.jpg', 1231, 'hi', 'paul.jpg', '2024-12-08 23:28:15'),
(71, 126618380, 'Iquen', 'Marba', 'ken.jpg', 2131, 'Display <3', 'DFD.png', '2024-12-09 23:52:42'),
(72, 126618380, 'Iquen', 'Marba', 'ken.jpg', 3212, 'ERD', 'Untitled diagram-2024-12-09-135022.png', '2024-12-09 23:55:30'),
(73, 126618380, 'Iquen', 'Marba', 'ken.jpg', 1323, 'helloworld', 'Untitled diagram-2024-12-09-150250.svg', '2024-12-10 00:04:41'),
(74, 126618380, 'Iquen', 'Marba', 'ken.jpg', 0, '', 'Untitled diagram-2024-12-09-150250.svg', '2024-12-10 00:26:20'),
(75, 1364466008, 'cathia', 'ulan-ulan', 'cath.jpg', 2503, '\"🚀 Just wrapped up my Java Guessing Game system! 🎉 Ready to challenge your brain with random questio', 'catsystem.png', '2024-12-10 11:58:54'),
(76, 1364466008, 'cathia', 'ulan-ulan', 'cath.jpg', 1, '\"🚀 Just wrapped up my Java Guessing Game system! 🎉 ', 'catsystem.png', '2024-12-10 11:59:45'),
(77, 1364466008, 'cathia', 'ulan-ulan', 'cath.jpg', 1, 'code Java Guessing Game', 'catcode.png', '2024-12-10 12:00:12'),
(78, 806996988, 'Migs', 'Bacho', 'migs.jpg', 1, 'BOS!! A.K.A Beshy Ordering System in Java ', 'migssystem.png', '2024-12-10 12:02:11'),
(79, 806996988, 'Migs', 'Bacho', 'migs.jpg', 2331, 'Beshy Ordering System in Java Code', 'migscode.png', '2024-12-10 12:02:32'),
(80, 126618380, 'Iquen', 'Marba', 'ken.jpg', 4324, 'Assistant jabbis your personal Voice Assistant', 'jabbisscreenshot.png', '2024-12-10 22:08:24'),
(81, 126618380, 'Iquen', 'Marba', 'ken.jpg', 1, '', 'jabbisscreenshot.png', '2024-12-10 22:09:56'),
(82, 126618380, 'Iquen', 'Marba', 'ken.jpg', 1, 'https://meet.google.com/juz-odmg-mac?pli=1&authuser=1', '467476857_905176748405406_2639969857973119027_n.png', '2024-12-11 11:32:36'),
(83, 60158149, 'roxanne', ' Dalag ', 'rox2.jpg', 1003, 'gmeet', '467477970_1790413268394005_5053190576066098434_n.png', '2024-12-11 14:43:10'),
(84, 1065399308, 'miggy', 'gwapo', 'migs.jpg', 1, 'hello world', '467477970_1790413268394005_5053190576066098434_n.png', '2024-12-11 15:53:26'),
(85, 1492320003, 'Orly', 'Orge', 'ken.jpg', 3001, 'orly', 'kaye.jpg', '2024-12-12 15:11:26'),
(86, 1029895314, 'Nicole', 'Cretecio', 'nic4.jpg', 3, 'HI ORLY', 'nic4.jpg', '2024-12-12 15:47:57'),
(87, 1364466008, 'cathia', 'ulan-ulan', 'cath.jpg', 0, 'cathia', 'Untitled diagram-2024-12-09-150250.svg', '2024-12-12 16:10:49'),
(88, 1364466008, 'cathia', 'ulan-ulan', 'cath.jpg', 1000, 'cathia2000', 'Untitled diagram-2024-12-09-150250.svg', '2024-12-12 16:10:59'),
(89, 1364466008, 'cathia', 'ulan-ulan', 'cath.jpg', 1424, 'cathia2000', 'Untitled diagram-2024-12-09-150250.svg', '2024-12-12 16:11:01'),
(90, 1364466008, 'cathia', 'ulan-ulan', 'cath.jpg', 1002, 'cathia2000', 'Untitled diagram-2024-12-09-150250.svg', '2024-12-12 16:11:03'),
(91, 1364466008, 'cathia', 'ulan-ulan', 'cath.jpg', 2002, 'cathia2000', 'Untitled diagram-2024-12-09-150250.svg', '2024-12-12 16:11:49'),
(92, 1065399308, 'miggs', 'gwapokaayo', 'migs.jpg', 3, 'HI IQUEN THIS IS THE DEMO POST FOR ANOTHER DEVICE!', 'WIN_20240910_18_03_26_Pro.jpg', '2024-12-12 22:52:45');

-- --------------------------------------------------------

--
-- Table structure for table `ranking`
--

CREATE TABLE `ranking` (
  `rank_id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `ranks` varchar(100) NOT NULL,
  `Percent` int(11) NOT NULL,
  `date_added` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ranking`
--

INSERT INTO `ranking` (`rank_id`, `fname`, `lname`, `ranks`, `Percent`, `date_added`) VALUES
(14764462, 'cathia', 'ulan-ulan', 'INTERN', 0, '2024-12-10'),
(46368132, 'ken', 'marbs', 'INTERN', 0, '2024-12-07'),
(60158149, 'roxanne', ' Dalag ', 'MID-LEVEL', 0, '2024-12-06'),
(110214739, 'Iquenssss', 'Marba', 'INTERN', 0, '2024-12-07'),
(126618380, 'Iquen', 'Marba', 'JUNIOR DEV', 60, '2024-12-06'),
(126777658, 'Iquenssssssssssssss', 'Marba', 'INTERN', 0, '2024-12-07'),
(139602819, 'Iquen', 'Marba', 'INTERN', 0, '2024-12-07'),
(164674355, 'Iquen', 'Marba', 'INTERN', 0, '2024-12-07'),
(235122581, 'dasdsad', 'asdasd', 'INTERN', 0, '2024-12-09'),
(246480378, 'Iuqen', 'marba', 'INTERN', 0, '2024-12-07'),
(258890381, 'Iquengwapo', 'Marba', 'INTERN', 0, '2024-12-07'),
(298954094, 'james', 'cortez', 'SENIOR DEV', 0, '2024-12-06'),
(308574348, 'sdasd', 'dasd', 'INTERN', 0, '2024-12-09'),
(310436895, 'iquen', 'Marba', 'INTERN', 0, '2024-12-07'),
(323611805, 'iquen', 'marba', 'INTERN', 0, '2024-12-07'),
(354271620, 'Von', 'Alfelor', 'SENIOR DEV', 0, '2024-12-06'),
(389806693, 'Cathia', 'rain', 'INTERN', 0, '2024-12-08'),
(401860950, 'Iquen', 'Marba', 'INTERN', 0, '2024-12-07'),
(540282169, 'Johny ', 'Sins', 'INTERN', 0, '2024-12-13'),
(562043732, 'iquen', 'marba', 'SENIOR DEV', 0, '2024-12-10'),
(611719959, 'iquen', 'marba', 'INTERN', 0, '2024-12-07'),
(614538328, 'Kathy', 'Geses', 'JUNIOR DEV', 0, '2024-12-06'),
(626162614, 'dadasda', 'sdadasdsa', 'INTERN', 0, '2024-12-07'),
(667612770, 'iquen', 'marba', 'INTERN', 0, '2024-12-07'),
(677681624, 'Iquen', 'marba', 'INTERN', 0, '2024-12-07'),
(712254578, 'Cyril', 'Neuva', 'INTERN', 0, '2024-12-06'),
(722419606, 'John loyd', 'Estrera', 'MID-LEVEL', 0, '2024-12-06'),
(726388679, 'Hello ', 'World', 'INTERN', 0, '2024-12-10'),
(806524845, 'Iquenkenno', 'Marba', 'INTERN', 0, '2024-12-07'),
(806996988, 'Migs', 'Bacho', 'JUNIOR DEV', 0, '2024-12-06'),
(823106271, 'Ton', 'Rosos', 'INTERN', 0, '2024-12-07'),
(828086538, 'Iquen', 'Marba', 'INTERN', 0, '2024-12-07'),
(828553656, 'iquen', 'marba', 'INTERN', 0, '2024-12-07'),
(831820377, 'chan', 'colo', 'JUNIOR DEV', 0, '2024-12-06'),
(836284971, 'Iquen', 'Marba', 'INTERN', 0, '2024-12-07'),
(857296437, 'Migs', 'Bacho', 'SENIOR DEV', 0, '2024-12-07'),
(878786495, 'russel', 'dasigan', 'SENIOR DEV', 0, '2024-12-06'),
(886736497, 'iquen', 'marba', 'INTERN', 0, '2024-12-07'),
(897928428, 'ken', 'marba', 'INTERN', 0, '2024-12-07'),
(933444867, 'create', 'account', 'INTERN', 0, '2024-12-09'),
(974318155, 'Iquen', 'Marba', 'INTERN', 0, '2024-12-07'),
(1021973124, 'Iquen', 'Marba', 'INTERN', 0, '2024-12-07'),
(1024160606, 'Iquen', 'Marba', 'INTERN', 0, '2024-12-07'),
(1029895314, 'Nicole', 'Cretecio', 'INTERN', 0, '2024-12-12'),
(1038765506, 'cuttie', 'pie', 'INTERN', 0, '2024-12-12'),
(1065399308, 'miggs', 'gwapokaayo', 'SENIOR DEV', 0, '2024-12-11'),
(1069525477, 'john pual', 'vasquez', 'SENIOR DEV', 0, '2024-12-06'),
(1127920759, 'Orwell', 'Barida', 'MID-LEVEL', 0, '2024-12-06'),
(1177193127, 'Cathia', 'Alfelor Ulan-ulab', 'SENIOR DEV', 0, '2024-12-08'),
(1237813353, 'von', 'alfelor', 'INTERN', 0, '2024-12-11'),
(1245260339, 'Iquen', 'Marba', 'INTERN', 0, '2024-12-07'),
(1260625551, 'Ton', 'Rosos', 'INTERN', 0, '2024-12-06'),
(1274582385, 'Iquen', 'Marba', 'INTERN', 0, '2024-12-07'),
(1302886754, 'cat', 'ulan', 'INTERN', 0, '2024-12-08'),
(1355169837, 'iquen', 'marba', 'INTERN', 0, '2024-12-07'),
(1359156546, 'Iquen', 'Marba', 'INTERN', 0, '2024-12-07'),
(1364466008, 'cathia', 'ulan-ulan', 'JUNIOR DEV', 60, '2024-12-06'),
(1427988314, 'Iquen', 'gwaps', 'JUNIOR DEV', 0, '2024-12-07'),
(1452291040, 'Iquen', 'Marba', 'INTERN', 0, '2024-12-07'),
(1480183258, 'loren', 'capuyan', 'MID-LEVEL', 0, '2024-12-06'),
(1492320003, 'Orly', 'Orge', 'MID-LEVEL', 0, '2024-12-12'),
(1495799386, 'Cathia', 'Alfelor', 'INTERN', 0, '2024-12-07'),
(1500485085, 'iquen', 'marba', 'INTERN', 0, '2024-12-07'),
(1552022835, 'Cat', 'rain', 'INTERN', 0, '2024-12-08'),
(1559275932, 'kaye', 'neuvo', 'MID-LEVEL', 0, '2024-12-06'),
(1571305286, 'iquen', 'marbs', 'MID-LEVEL', 0, '2024-12-07'),
(1660623215, 'jdlkfjlkjfklds', 'dasdasdas', 'MID-LEVEL', 0, '2024-12-07');

-- --------------------------------------------------------

--
-- Table structure for table `reportmessage`
--

CREATE TABLE `reportmessage` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `img` varchar(255) NOT NULL,
  `report` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reportmessage`
--

INSERT INTO `reportmessage` (`id`, `userid`, `fname`, `lname`, `img`, `report`) VALUES
(7, '675062991', 'Iquen', 'marba', 'wal2.jpg', 'naay bug dapit sa bag nya gi sud sa echo bag sulod ato sambug\r\n'),
(8, '675062991', 'Iquen', 'marba', 'wal2.jpg', 'rport\r\n'),
(9, '126618380', 'Iquen', 'Marba', 'noprofile.jpg', 'hi'),
(10, '878786495', 'russel', 'dasigan', 'noprofile.jpg', 'hi admin\r\n'),
(11, '126618380', 'Iquen', 'Marba', 'ken.jpg', 'hello'),
(12, '126618380', 'Iquen', 'Marba', 'ken.jpg', 'hello\r\n'),
(13, '126618380', 'Iquen', 'Marba', 'ken.jpg', 'helllo'),
(14, '126618380', 'Iquen', 'Marba', 'ken.jpg', 'fck'),
(15, '126618380', 'Iquen', 'Marba', 'ken.jpg', 'fck'),
(16, '126618380', 'Iquen', 'Marba', 'ken.jpg', 'shes'),
(17, '126618380', 'Iquen', 'Marba', 'ken.jpg', 'hi'),
(18, '126618380', 'Iquen', 'Marba', 'ken.jpg', 'hi'),
(19, '126618380', 'Iquen', 'Marba', 'ken.jpg', 's'),
(20, '126618380', 'Iquen', 'Marba', 'ken.jpg', 's'),
(21, '126618380', 'Iquen', 'Marba', 'ken.jpg', 'hi'),
(22, '126618380', 'Iquen', 'Marba', 'ken.jpg', 'dasdsa'),
(23, '126618380', 'Iquen', 'Marba', 'ken.jpg', 'hiu'),
(24, '126618380', 'Iquen', 'Marba', 'ken.jpg', 'send admin'),
(25, '1065399308', 'miggs', 'gwapokaayo', 'migs.jpg', 'hii quennn report ko nimoo!');

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `admin_id` int(11) NOT NULL,
  `useridaddmin` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `rank` varchar(100) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`admin_id`, `useridaddmin`, `fname`, `lname`, `email`, `password`, `img`, `status`, `rank`, `number`) VALUES
(1, 12312312, 'iquen', 'marba', 'admin@gmail.com', '1', 'pp.jpg', 'active now', 'warrior 1', 951366607);

-- --------------------------------------------------------

--
-- Table structure for table `tb_message`
--

CREATE TABLE `tb_message` (
  `id_msg` int(11) NOT NULL,
  `sender_Id` int(255) NOT NULL,
  `receiver_id` int(255) NOT NULL,
  `messages` varchar(1000) NOT NULL,
  `dateMsent` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_message`
--

INSERT INTO `tb_message` (`id_msg`, `sender_Id`, `receiver_id`, `messages`, `dateMsent`) VALUES
(196, 126618380, 1038765506, 'AHAHAHAHHH samoka ', '2024-12-12'),
(197, 126618380, 540282169, 'nakalogin nas doctor sin AHAHAH', '2024-12-13');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `course` varchar(50) NOT NULL,
  `pl` varchar(100) NOT NULL,
  `sectionyr` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`id`, `userid`, `fname`, `lname`, `address`, `course`, `pl`, `sectionyr`) VALUES
(70, 716184028, 'Iquen', 'marba', 'Looc linao Ormoc city', 'BSIT 3C', 'JavaScript', 'IT 3C'),
(71, 126618380, 'Iquen', 'Marba', 'Looc linao Ormoc City', 'BSIT', 'JavaScript,Php,Java,Python', 'IT 3C'),
(72, 806996988, 'Migs', 'Bacho', 'tagalayo', 'BSIT', 'JAVASCRIPT', 'IT 3C'),
(73, 298954094, 'james', 'cortez', 'tagalayo', 'BSIT', 'JAVASCRIPT', 'IT 3C'),
(74, 1364466008, 'cathia', 'ulan-ulan', 'tagalayo', 'IT', 'HTML', 'IT 3C'),
(75, 712254578, 'Cyril', 'Neuva', 'tagalayo', 'BSIT', 'HTML', 'IT 3C'),
(76, 1260625551, 'Ton', 'Rosos', 'tagalayo', 'BSIT', 'PHP', 'IT 3C'),
(77, 60158149, 'roxanne', ' Dalag ', 'tagalayo', 'BSIT', 'JAVA', 'IT 3C'),
(78, 722419606, 'John loyd', 'Estrera', 'tagalayo', 'BSIT', 'JAVA', 'IT 3C'),
(79, 831820377, 'chan', 'colo', 'tagalayo', 'BSIT', 'JAVA', 'BSIT 3C'),
(80, 614538328, 'Kathy', 'Geses', 'tagalayo', 'BSIT', 'JAVA', 'IT 3C'),
(81, 1559275932, 'kaye', 'neuvo', 'tagalayo', 'BSIT', 'JAVA', 'IT 3C'),
(82, 1127920759, 'Orwell', 'Barida', 'tagalayo', 'BSIT', 'JAVA', 'IT 3C'),
(83, 1069525477, 'john pual', 'vasquez', 'tagalayo', 'BSIT', 'JAVA JAVASCRIPT PHP ', 'IT 3A'),
(84, 354271620, 'Von', 'Alfelor', 'tagalayo', 'BSIT', 'JAVA', 'IT 3C'),
(85, 878786495, 'russel', 'dasigan', '', '', '', ''),
(86, 1480183258, 'loren', 'capuyan', 'linao looc o.c', 'BSIT', 'JAVASCRIPT', 'IT 3c'),
(87, 677681624, 'Iquen', 'marba', '', '', '', ''),
(88, 886736497, 'iquen', 'marba', '', '', '', ''),
(89, 310436895, 'iquen', 'Marba', '', '', '', ''),
(90, 1571305286, 'iquen', 'marbs', '', '', '', ''),
(91, 828553656, 'iquen', 'marba', '', '', '', ''),
(92, 1500485085, 'iquen', 'marba', '', '', '', ''),
(93, 46368132, 'ken', 'marbs', '', '', '', ''),
(94, 611719959, 'iquen', 'marba', '', '', '', ''),
(95, 667612770, 'iquen', 'marba', '', '', '', ''),
(96, 1355169837, 'iquen', 'marba', '', '', '', ''),
(97, 246480378, 'Iuqen', 'marba', '', '', '', ''),
(98, 323611805, 'iquen', 'marba', '', '', '', ''),
(99, 974318155, 'Iquen', 'Marba', '', '', '', ''),
(100, 1359156546, 'Iquen', 'Marba', '', '', '', ''),
(101, 110214739, 'Iquenssss', 'Marba', '', '', '', ''),
(102, 897928428, 'ken', 'marba', '', '', '', ''),
(103, 806524845, 'Iquenkenno', 'Marba', '', '', '', ''),
(104, 126777658, 'Iquenssssssssssssss', 'Marba', '', '', '', ''),
(105, 1245260339, 'Iquen', 'Marba', '', '', '', ''),
(106, 1274582385, 'Iquen', 'Marba', '', '', '', ''),
(107, 401860950, 'Iquen', 'Marba', '', '', '', ''),
(108, 836284971, 'Iquen', 'Marba', '', '', '', ''),
(109, 857296437, 'Migs', 'Bacho', '', '', '', ''),
(110, 823106271, 'Ton', 'Rosos', '', '', '', ''),
(111, 1495799386, 'Cathia', 'Alfelor', '', '', '', ''),
(112, 1427988314, 'Iquen', 'gwaps', '', '', '', ''),
(114, 164674355, 'Iquen', 'Marba', '', '', '', ''),
(115, 139602819, 'Iquen', 'Marba', '', '', '', ''),
(116, 1660623215, 'jdlkfjlkjfklds', 'dasdasdas', '', '', '', ''),
(117, 626162614, 'dadasda', 'sdadasdsa', '', '', '', ''),
(118, 828086538, 'Iquen', 'Marba', '', '', '', ''),
(119, 1024160606, 'Iquen', 'Marba', '', '', '', ''),
(120, 1452291040, 'Iquen', 'Marba', '', '', '', ''),
(121, 258890381, 'Iquengwapo', 'Marba', '', '', '', ''),
(122, 1021973124, 'Iquen', 'Marba', '', '', '', ''),
(124, 1177193127, 'Cathia', 'Alfelor Ulan-ulab', '', '', '', ''),
(125, 1302886754, 'cat', 'ulan', '', '', '', ''),
(126, 1552022835, 'Cat', 'rain', '', '', '', ''),
(127, 389806693, 'Cathia', 'rain', '', '', '', ''),
(129, 933444867, 'create', 'account', '', '', '', ''),
(130, 235122581, 'dasdsad', 'asdasd', '', '', '', ''),
(131, 308574348, 'sdasd', 'dasd', '', '', '', ''),
(132, 562043732, 'iquen', 'marba', '', '', '', ''),
(133, 726388679, 'Hello ', 'World', '', '', '', ''),
(134, 14764462, 'cathia', 'ulan-ulan', '', '', '', ''),
(137, 1237813353, 'von', 'alfelor', '', '', '', ''),
(139, 1065399308, 'miggs', 'gwapokaayo', 'ambot', 'BSIT', 'PHP', 'IT3C'),
(140, 1492320003, 'Orly', 'Orge', 'IPIL', 'BSIT', 'JAVA', 'IT 3C'),
(141, 1029895314, 'Nicole', 'Cretecio', 'PUSONIORLY', 'BSIT', 'JAVA', 'IT3C'),
(142, 1038765506, 'cuttie', 'pie', 'dasdada', '', 'asdas', ''),
(143, 540282169, 'Johny ', 'Sins', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archive`
--
ALTER TABLE `archive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedbackmessage`
--
ALTER TABLE `feedbackmessage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsfeed`
--
ALTER TABLE `newsfeed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ranking`
--
ALTER TABLE `ranking`
  ADD PRIMARY KEY (`rank_id`);

--
-- Indexes for table `reportmessage`
--
ALTER TABLE `reportmessage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tb_message`
--
ALTER TABLE `tb_message`
  ADD PRIMARY KEY (`id_msg`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `archive`
--
ALTER TABLE `archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `feedbackmessage`
--
ALTER TABLE `feedbackmessage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=416;

--
-- AUTO_INCREMENT for table `newsfeed`
--
ALTER TABLE `newsfeed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `reportmessage`
--
ALTER TABLE `reportmessage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_message`
--
ALTER TABLE `tb_message`
  MODIFY `id_msg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
