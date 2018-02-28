-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 11, 2018 at 11:03 PM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saveme`
--

-- --------------------------------------------------------

--
-- Table structure for table `intent`
--

CREATE TABLE `intent` (
  `id` int(11) NOT NULL,
  `intent` varchar(200) CHARACTER SET latin1 NOT NULL,
  `intent_id` varchar(100) NOT NULL,
  `time` int(11) NOT NULL,
  `last_see` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `intent`
--

INSERT INTO `intent` (`id`, `intent`, `intent_id`, `time`, `last_see`) VALUES
(51, 'smalltalk.greetings.hello', 'smalltalk.greetings.hello', 94, '2018-01-11 15:04:34'),
(52, 'BG2000', '095bf114-e852-42a2-823d-664ef3402952', 3, '2018-01-06 05:34:50'),
(53, 'GE1403', '485e8503-ce4b-4b8f-af4c-a09dcc39df47', 0, '2017-12-30 11:55:59'),
(55, 'Abac-ABAC-Info', '0ccda6b1-9314-4fb2-8b81-52a13d85d3b6', 35, '2018-01-11 15:14:00'),
(57, 'BG1001', 'e8f148eb-d965-4879-80e9-c1cb97ffe8dd', 0, '2017-12-30 15:56:33'),
(58, 'BG1002', 'db1c4dc0-453a-4201-93e3-bc2536dcae4b', 0, '2017-12-30 15:56:35'),
(60, 'BG2001', 'e33ebcbc-db1f-406a-b465-e74dedbe48bc', 9, '2018-01-11 14:21:27'),
(61, 'MIS1221', '6bb66f2f-9700-4565-9647-983a995b8287', 4, '2018-01-09 04:38:00'),
(62, 'smalltalk.agent.chatbot', 'smalltalk.greetings.hello', 0, '2017-12-30 15:56:55'),
(63, 'MIS3231', '6a5baec3-ebf6-4cd4-b378-95a47acde4a4', 4, '2018-01-09 04:38:00'),
(67, 'Default Fallback Intent', 'e2677674-a800-4d50-8cde-ba341fb3c0a4', 74, '2018-01-11 14:18:24'),
(74, 'smalltalk.user.testing_agent', 'smalltalk.greetings.hello', 2, '2018-01-09 12:57:02'),
(82, 'smalltalk.agent.can_you_help', 'smalltalk.greetings.hello', 1, '2018-01-05 04:12:39'),
(111, 'smalltalk.agent.busy', 'smalltalk.greetings.hello', 0, '2018-01-06 04:58:05'),
(117, 'MIS3221', '0b2d241b-e30c-4822-b2ca-f89795c05d2d', 1, '2018-01-06 05:09:56'),
(144, 'smalltalk.appraisal.well_done', 'smalltalk.greetings.hello', 1, '2018-01-09 04:50:13'),
(147, 'smalltalk.confirmation.no', 'smalltalk.greetings.hello', 2, '2018-01-09 12:44:31'),
(153, 'smalltalk.agent.sure', 'smalltalk.greetings.hello', 0, '2018-01-09 04:36:54'),
(166, 'smalltalk.dialog.wrong', 'smalltalk.greetings.hello', 0, '2018-01-09 04:38:29'),
(172, 'smalltalk.confirmation.yes', 'smalltalk.greetings.hello', 3, '2018-01-09 12:44:58'),
(173, 'smalltalk.emotions.ha_ha', 'smalltalk.greetings.hello', 0, '2018-01-09 04:47:28'),
(178, 'smalltalk.user.joking', 'smalltalk.greetings.hello', 0, '2018-01-09 04:47:42'),
(185, 'smalltalk.agent.occupation', 'smalltalk.greetings.hello', 0, '2018-01-09 04:50:18');

-- --------------------------------------------------------

--
-- Table structure for table `line_user`
--

CREATE TABLE `line_user` (
  `id` int(11) NOT NULL,
  `uid` varchar(100) NOT NULL,
  `sex` char(1) DEFAULT NULL,
  `year` char(1) DEFAULT NULL,
  `major` varchar(50) DEFAULT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `line_user`
--

INSERT INTO `line_user` (`id`, `uid`, `sex`, `year`, `major`, `date_create`) VALUES
(8, 'U2e78e9caf714536a98df758427f55917', '1', '4', 'bba', '2018-01-09 15:24:55'),
(13, 'Ue218e3d82165e3b205fcb7e873eabf05', '0', '4', 'bba', '2018-01-09 15:47:48');

-- --------------------------------------------------------

--
-- Table structure for table `most`
--

CREATE TABLE `most` (
  `id` int(11) NOT NULL,
  `uid` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `prof_name` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `time_usage` int(11) NOT NULL DEFAULT '0',
  `last_see` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `most`
--

INSERT INTO `most` (`id`, `uid`, `prof_name`, `time_usage`, `last_see`, `date_create`) VALUES
(19, 'U2e78e9caf714536a98df758427f55917', '🎸Song-Purin ™👣', 305, '2018-01-11 15:14:00', '2017-12-29 16:53:45'),
(67, 'U865ad72605e8f6bb2094401078056545', 'นุ่น bedroom', 9, '2018-01-04 12:30:35', '2018-01-04 12:29:52'),
(216, 'Ue218e3d82165e3b205fcb7e873eabf05', 'Bangearn', 1, '2018-01-09 15:48:06', '2018-01-09 15:48:06'),
(217, 'Udeadbeefdeadbeefdeadbeefdeadbeef', 'Udeadbeefdeadbeefdeadbeefdeadbeef', 2, '2018-01-10 16:55:59', '2018-01-10 16:55:39');

--
-- Triggers `most`
--
DELIMITER $$
CREATE TRIGGER `traffic hit` AFTER INSERT ON `most` FOR EACH ROW INSERT INTO `traffic` (`id`, `count_traffic`, `date`) VALUES (NULL, '1', DATE(NOW())) ON duplicate KEY UPDATE count_traffic = count_traffic+1
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `traffic update` AFTER UPDATE ON `most` FOR EACH ROW INSERT INTO `traffic` (`id`, `count_traffic`, `date`) VALUES (NULL, '1', DATE(NOW())) ON duplicate KEY UPDATE count_traffic = count_traffic+1
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `mute`
--

CREATE TABLE `mute` (
  `id` int(11) NOT NULL,
  `group_id` varchar(100) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mute`
--

INSERT INTO `mute` (`id`, `group_id`, `date_create`) VALUES
(14, 'Cab6a1cd6eb461a071939ca6f1770e58d', '2017-12-27 12:59:31');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `uid` varchar(100) NOT NULL,
  `date_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `uid`, `date_create`) VALUES
(17, 'U2e78e9caf714536a98df758427f55917', '2017-12-27 17:09:25'),
(18, 'U5cee682fac100c3c10781b92c66dc6a3', '2017-12-27 21:28:50');

-- --------------------------------------------------------

--
-- Table structure for table `today_intent`
--

CREATE TABLE `today_intent` (
  `id` int(11) NOT NULL,
  `intent` varchar(100) NOT NULL,
  `intent_id` varchar(200) NOT NULL,
  `time` int(11) NOT NULL,
  `intent_day` date NOT NULL,
  `last_see` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `today_intent`
--

INSERT INTO `today_intent` (`id`, `intent`, `intent_id`, `time`, `intent_day`, `last_see`) VALUES
(5, 'BG2001', 'e33ebcbc-db1f-406a-b465-e74dedbe48bc', 2, '2018-01-06', '2018-01-05 17:00:00'),
(6, 'BG2000', '095bf114-e852-42a2-823d-664ef3402952', 1, '2018-01-06', '2018-01-06 05:34:50'),
(7, 'Abac-ABAC-Info', '0ccda6b1-9314-4fb2-8b81-52a13d85d3b6', 1, '2018-01-06', '2018-01-06 05:34:59'),
(13, 'smalltalk.greetings.hello', 'smalltalk.greetings.hello', 31, '2018-01-09', '2018-01-08 17:00:00'),
(15, 'Default Fallback Intent', 'e2677674-a800-4d50-8cde-ba341fb3c0a4', 37, '2018-01-09', '2018-01-08 17:00:00'),
(25, 'MIS1221', '6bb66f2f-9700-4565-9647-983a995b8287', 2, '2018-01-09', '2018-01-08 17:00:00'),
(27, 'Abac-ABAC-Info', '0ccda6b1-9314-4fb2-8b81-52a13d85d3b6', 5, '2018-01-09', '2018-01-08 17:00:00'),
(37, 'MIS3231', '6a5baec3-ebf6-4cd4-b378-95a47acde4a4', 1, '2018-01-09', '2018-01-09 04:38:00'),
(89, 'BG2001', 'e33ebcbc-db1f-406a-b465-e74dedbe48bc', 1, '2018-01-09', '2018-01-09 15:58:35'),
(90, 'smalltalk.greetings.hello', 'smalltalk.greetings.hello', 8, '2018-01-10', '2018-01-09 17:00:00'),
(94, 'Default Fallback Intent', 'e2677674-a800-4d50-8cde-ba341fb3c0a4', 5, '2018-01-10', '2018-01-09 17:00:00'),
(95, 'Abac-ABAC-Info', '0ccda6b1-9314-4fb2-8b81-52a13d85d3b6', 2, '2018-01-10', '2018-01-09 17:00:00'),
(105, 'smalltalk.greetings.hello', 'smalltalk.greetings.hello', 44, '2018-01-11', '2018-01-10 17:00:00'),
(107, 'Default Fallback Intent', 'e2677674-a800-4d50-8cde-ba341fb3c0a4', 9, '2018-01-11', '2018-01-10 17:00:00'),
(123, 'Abac-ABAC-Info', '0ccda6b1-9314-4fb2-8b81-52a13d85d3b6', 20, '2018-01-11', '2018-01-10 17:00:00'),
(129, 'BG2001', 'e33ebcbc-db1f-406a-b465-e74dedbe48bc', 4, '2018-01-11', '2018-01-10 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `traffic`
--

CREATE TABLE `traffic` (
  `id` int(11) NOT NULL,
  `count_traffic` int(11) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `traffic`
--

INSERT INTO `traffic` (`id`, `count_traffic`, `date`) VALUES
(40, 25, '2018-01-04'),
(65, 7, '2018-01-05'),
(72, 44, '2018-01-06'),
(116, 86, '2018-01-09'),
(202, 20, '2018-01-10'),
(221, 97, '2018-01-11');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `uid` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `uid`, `username`, `password`, `last_login`) VALUES
(1, 'admin', 'admin', '$2b$12$jsWNWf7lOJNfBNEZFuOmfuoCICqAV5pq2WHyBDgi7GLJlma/xYXui', '2018-01-11 13:43:06'),
(5, 'U2e78e9caf714536a98df758427f55917', 'vazabisong', '$2b$12$cRi6d3zXGkEA2CmPHXhwEe.WXEP.kbGN9ZUkDxejagbnVMBF82NN2', '2018-01-11 13:41:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `intent`
--
ALTER TABLE `intent`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `intent` (`intent`);

--
-- Indexes for table `line_user`
--
ALTER TABLE `line_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Indexes for table `most`
--
ALTER TABLE `most`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Indexes for table `mute`
--
ALTER TABLE `mute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `today_intent`
--
ALTER TABLE `today_intent`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `intent_id` (`intent_id`,`intent_day`);

--
-- Indexes for table `traffic`
--
ALTER TABLE `traffic`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `date` (`date`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `intent`
--
ALTER TABLE `intent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;
--
-- AUTO_INCREMENT for table `line_user`
--
ALTER TABLE `line_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `most`
--
ALTER TABLE `most`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;
--
-- AUTO_INCREMENT for table `mute`
--
ALTER TABLE `mute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `today_intent`
--
ALTER TABLE `today_intent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;
--
-- AUTO_INCREMENT for table `traffic`
--
ALTER TABLE `traffic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
