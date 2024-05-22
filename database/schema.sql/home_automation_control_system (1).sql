-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2024 at 03:33 PM
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
-- Database: `home_automation_control_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `automation_rules`
--

CREATE TABLE `automation_rules` (
  `ruleid` int(11) NOT NULL,
  `rulename` varchar(255) DEFAULT NULL,
  `trigger_event` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `deviceid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `automation_rules`
--

INSERT INTO `automation_rules` (`ruleid`, `rulename`, `trigger_event`, `action`, `deviceid`, `userid`) VALUES
(1, 'Turn on lights when motion detected', 'motion detected', 'turn on lights', 1, 1),
(2, 'Adjust thermostat at night', 'time of day (night)', 'set temperature to 68?F', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `deviceid` int(11) NOT NULL,
  `devicename` varchar(255) DEFAULT NULL,
  `devicetype` varchar(50) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `lastupdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`deviceid`, `devicename`, `devicetype`, `location`, `status`, `lastupdated`) VALUES
(1, 'Living Room Light', 'light', 'Living Room', 'on', '2024-04-09 07:52:01'),
(2, 'Kitchen Thermostat', 'thermostat', 'Kitchen', 'off', '2024-04-09 07:52:01');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `eventid` int(11) NOT NULL,
  `eventtype` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`eventid`, `eventtype`, `description`, `timestamp`) VALUES
(1, 'System Startup', 'System started up successfully', '2024-04-09 07:54:00'),
(2, 'Device Failure', 'Living room light malfunctioned', '2024-04-09 07:54:00');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `logid` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `userid` int(11) DEFAULT NULL,
  `deviceid` int(11) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`logid`, `timestamp`, `userid`, `deviceid`, `action`) VALUES
(1, '2024-04-09 07:52:58', 1, 1, 'turned on lights'),
(2, '2024-04-09 07:52:58', 1, 2, 'adjusted temperature');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notificationid` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notificationid`, `userid`, `message`, `timestamp`) VALUES
(1, 1, 'Motion detected in the living room', '2024-04-09 07:53:45'),
(2, 1, 'Temperature set to 72?F', '2024-04-09 07:53:45');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permissionid` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `deviceid` int(11) DEFAULT NULL,
  `permissiontype` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permissionid`, `userid`, `deviceid`, `permissiontype`) VALUES
(1, 1, 1, 'control'),
(2, 1, 2, 'read-only');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `roomid` int(11) NOT NULL,
  `roomname` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`roomid`, `roomname`, `description`) VALUES
(1, 'Living Room', 'Main area for entertainment and relaxation'),
(2, 'Kitchen', 'Place for cooking and dining');

-- --------------------------------------------------------

--
-- Table structure for table `scenes`
--

CREATE TABLE `scenes` (
  `sceneid` int(11) NOT NULL,
  `scenename` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scenes`
--

INSERT INTO `scenes` (`sceneid`, `scenename`, `description`, `active`) VALUES
(1, 'Evening Relaxation', 'Dim lights and set temperature for relaxation', 1),
(2, 'Morning Wake-up', 'Turn on lights and increase temperature for wake-up', 0);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `settingid` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `settingname` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settingid`, `userid`, `settingname`, `value`) VALUES
(1, 1, 'Temperature', '72?F'),
(2, 1, 'Light Intensity', '50%');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `firstname`, `lastname`, `email`, `role`) VALUES
(1, 'jack', 'password123', 'jack', 'maniraguha', 'jack@gmail.com', 'standard'),
(2, 'daniel', ' password456', 'daniel', 'habiyaremye', 'habiyaremyedaniel2021@gmail.com', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `automation_rules`
--
ALTER TABLE `automation_rules`
  ADD PRIMARY KEY (`ruleid`),
  ADD KEY `deviceid` (`deviceid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`deviceid`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`eventid`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`logid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `deviceid` (`deviceid`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notificationid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permissionid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `deviceid` (`deviceid`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`roomid`);

--
-- Indexes for table `scenes`
--
ALTER TABLE `scenes`
  ADD PRIMARY KEY (`sceneid`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`settingid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `automation_rules`
--
ALTER TABLE `automation_rules`
  ADD CONSTRAINT `automation_rules_ibfk_1` FOREIGN KEY (`deviceid`) REFERENCES `devices` (`deviceid`),
  ADD CONSTRAINT `automation_rules_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`),
  ADD CONSTRAINT `logs_ibfk_2` FOREIGN KEY (`deviceid`) REFERENCES `devices` (`deviceid`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`),
  ADD CONSTRAINT `permissions_ibfk_2` FOREIGN KEY (`deviceid`) REFERENCES `devices` (`deviceid`);

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
