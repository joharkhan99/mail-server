-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 19, 2021 at 05:14 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id15744255_mailserver`
--

-- --------------------------------------------------------

--
-- Table structure for table `drafts`
--

CREATE TABLE `drafts` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `toEmail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fromEmail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` text COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `drafts`
--

INSERT INTO `drafts` (`id`, `sender_id`, `toEmail`, `fromEmail`, `subject`, `message`, `date`) VALUES
(4, 1, '', 'jk@gmail.com', '', '', '2021-01-31'),
(6, 1, '', 'jk@gmail.com', '', 'I really want to speak to you about the same that we have done yesterday so I want to just want you to imagine that how many people have died yesterday', '2021-02-28');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` int(11) NOT NULL,
  `toId` int(11) NOT NULL,
  `fromId` int(11) NOT NULL,
  `type` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `toEmail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fromEmail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` text COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `starred` varchar(7) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'unstar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `toId`, `fromId`, `type`, `toEmail`, `fromEmail`, `subject`, `message`, `date`, `starred`) VALUES
(2, 1, 1, 'to', 'jk@gmail.com', 'jk@gmail.com', 'Test', 'Random text for random people in random place', '2020-12-24', 'star'),
(3, 1, 1, 'to', 'jk@gmail.com', 'jk@gmail.com', '', 'Pakistan is burrying.', '2020-12-26', 'star'),
(4, 1, 1, 'to', 'jk@gmail.com', 'jk@gmail.com', 'dfsfdsd', 'my name is your fun am telling you just that there is a wall coming on can you write testing correctly', '2020-12-29', 'star'),
(5, 1, 1, 'to', 'jk@gmail.com', 'jk@gmail.com', 'suicide', 'I think I am going to do suicide I am really tired of myself and this life Du University University is no not letting us to anything it\'s it\'s really becoming complicated for me this may be well last of the time they\'re doing this on my own server so please not this', '2020-12-30', 'star'),
(6, 1, 1, 'to', 'jk@gmail.com', 'jk@gmail.com', ',..,,.', 'lkmlmlkmlkmklm\r\n         dsds\r\nsdsd\r\n                      sdsdsd\r\nsdsd \r\nsdsdd                              dssd                      sdsdd', '2021-01-21', 'star'),
(8, 1, 2, 'to', 'jk@gmail.com', 'test@gmail.com', 'Bruh moment', 'Why am i leaving', '2021-02-17', 'unstar'),
(9, 1, 1, 'to', 'jk@gmail.com', 'jk@gmail.com', 'bluhost reminder', '<?php\r\n$emailto = \'to@domain.com\';\r\n$toname = \'TO NAME\';\r\n$emailfrom = \'from@domain.com\';\r\n$fromname = \'FROM NAME\';\r\n$subject = \'Email Subject\';\r\n$messagebody = \'Hello.\';\r\n$headers = \r\n	\'Return-Path: \' . $emailfrom . \"\\r\\n\" . \r\n	\'From: \' . $fromname . \' <\' . $emailfrom . \'>\' . \"\\r\\n\" . \r\n	\'X-Priority: 3\' . \"\\r\\n\" . \r\n	\'X-Mailer: PHP \' . phpversion() .  \"\\r\\n\" . \r\n	\'Reply-To: \' . $fromname . \' <\' . $emailfrom . \'>\' . \"\\r\\n\" .\r\n	\'MIME-Version: 1.0\' . \"\\r\\n\" . \r\n	\'Content-Transfer-Encoding: 8bit\' . \"\\r\\n\" . \r\n	\'Content-Type: text/plain; charset=UTF-8\' . \"\\r\\n\";\r\n$params = \'-f \' . $emailfrom;\r\n$test = mail($emailto, $subject, $messagebody, $headers, $params);\r\n// $test should be TRUE if the mail function is called correctly\r\n?>', '2021-04-08', 'unstar'),
(10, 1, 1, 'to', 'jk@gmail.com', 'jk@gmail.com', 'bluhost reminder', '<?php\r\n$emailto = \'to@domain.com\';\r\n$toname = \'TO NAME\';\r\n$emailfrom = \'from@domain.com\';\r\n$fromname = \'FROM NAME\';\r\n$subject = \'Email Subject\';\r\n$messagebody = \'Hello.\';\r\n$headers = \r\n	\'Return-Path: \' . $emailfrom . \"\\r\\n\" . \r\n	\'From: \' . $fromname . \' <\' . $emailfrom . \'>\' . \"\\r\\n\" . \r\n	\'X-Priority: 3\' . \"\\r\\n\" . \r\n	\'X-Mailer: PHP \' . phpversion() .  \"\\r\\n\" . \r\n	\'Reply-To: \' . $fromname . \' <\' . $emailfrom . \'>\' . \"\\r\\n\" .\r\n	\'MIME-Version: 1.0\' . \"\\r\\n\" . \r\n	\'Content-Transfer-Encoding: 8bit\' . \"\\r\\n\" . \r\n	\'Content-Type: text/plain; charset=UTF-8\' . \"\\r\\n\";\r\n$params = \'-f \' . $emailfrom;\r\n$test = mail($emailto, $subject, $messagebody, $headers, $params);\r\n// $test should be TRUE if the mail function is called correctly\r\n?>', '2021-04-08', 'unstar'),
(11, 1, 1, 'to', 'jk@gmail.com', 'jk@gmail.com', 'https://www.karavadra.net/php-mail-function-with-bluehost-working/', 'https://www.karavadra.net/php-mail-function-with-bluehost-working/', '2021-04-08', 'unstar');

-- --------------------------------------------------------

--
-- Table structure for table `recyclebin`
--

CREATE TABLE `recyclebin` (
  `id` int(11) NOT NULL,
  `emailId` int(11) NOT NULL,
  `toId` int(11) NOT NULL,
  `fromId` int(11) NOT NULL,
  `toEmail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fromEmail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` text COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `recyclebin`
--

INSERT INTO `recyclebin` (`id`, `emailId`, `toId`, `fromId`, `toEmail`, `fromEmail`, `subject`, `message`, `date`) VALUES
(1, 1, 1, 2, 'jk@gmail.com', 'test@gmail.com', 'Test', 'Hello future leader', '2020-12-22'),
(2, 7, 2, 1, 'test@gmail.com', 'jk@gmail.com', 'Hujj', 'Starving to death why are people Starving to death', '2021-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `location` text COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_img` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `dob`, `gender`, `location`, `email`, `password`, `user_img`, `account_date`) VALUES
(1, 'johar  khan', '2001-08-03', 'male', 'Pakistan', 'jk@gmail.com', '$2y$12$v7xxp7UH.8436IuoCINoQOy/T9squ9HiRNX.864gR7GoCSbPtr2Xy', 'profile.jpg', '2020-12-22'),
(2, 'Test', '2019-12-20', 'male', 'India', 'test@gmail.com', '$2y$12$wr/O0IfyK7./SzgqEuJfIOTRzAOds76BMZDnPSiLtwe843QPEEdGe', 'jeff 2.jpg', '2020-12-22'),
(3, 'test5', '2020-12-04', 'female', 'paki', 'test5@gmail.com', '$2y$12$ZObDjuJuZUs6IOCbqYz8g.5GHyvUOLJkSCEzq2RZaWYTcrIKVde5S', 'world-press-freedom-day-concept-woman-hand-with-microphone-tied-with-chain_101840-36.jpg', '2020-12-31'),
(4, 'own Rehman', '2021-03-02', 'male', 'Pakistan', 'test1@gmail.com', '$2y$12$rw5iQD9da/27cnZL8knvYuASvMHDF/1IY5l6BZYrZseqZFLk2igT6', NULL, '2021-03-17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drafts`
--
ALTER TABLE `drafts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recyclebin`
--
ALTER TABLE `recyclebin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drafts`
--
ALTER TABLE `drafts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `recyclebin`
--
ALTER TABLE `recyclebin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
