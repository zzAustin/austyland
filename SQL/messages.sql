-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2019 at 11:49 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `date` datetime NOT NULL,
  `opened` varchar(3) NOT NULL,
  `viewed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_to`, `user_from`, `body`, `date`, `opened`, `viewed`, `deleted`) VALUES
(1, 'john_cuszack', 'leonardo_decaprio', 'Hey, John!', '2019-05-21 12:27:13', 'yes', 'no', 'no'),
(2, 'john_cuszack', 'leonardo_decaprio', 'This is Leo...', '2019-05-21 12:29:05', 'yes', 'no', 'no'),
(3, 'leonardo_decaprio', 'john_cuszack', 'Oh, leonardo, you wrote to me...', '2019-05-21 12:29:39', 'yes', 'no', 'no'),
(4, 'john_cuszack', 'leonardo_decaprio', 'haha, john i got you', '2019-05-21 12:30:21', 'yes', 'no', 'no'),
(5, 'john_cuszack', 'leonardo_decaprio', 'you wrote me back!', '2019-05-21 12:30:29', 'yes', 'no', 'no'),
(6, 'john_cuszack', 'leonardo_decaprio', 'Wow this page got styled--Leonardo Decaprio', '2019-05-22 02:26:53', 'yes', 'no', 'no'),
(7, 'john_cuszack', 'leonardo_decaprio', 'come on!', '2019-05-22 02:45:26', 'yes', 'no', 'no'),
(8, 'john_cuszack', 'leonardo_decaprio', 'can we scroll??\r\n', '2019-05-22 02:46:30', 'yes', 'no', 'no'),
(9, 'john_cuszack', 'leonardo_decaprio', 'gotta scroll!\r\n', '2019-05-22 02:46:45', 'yes', 'no', 'no'),
(10, 'john_cuszack', 'leonardo_decaprio', 'still not', '2019-05-22 02:46:55', 'yes', 'no', 'no'),
(11, 'john_cuszack', 'leonardo_decaprio', 'john a u gonna say anything???', '2019-05-22 02:47:16', 'yes', 'no', 'no'),
(12, 'john_cuszack', 'leonardo_decaprio', 'can\'t be true', '2019-05-22 02:47:44', 'yes', 'no', 'no'),
(13, 'john_cuszack', 'leonardo_decaprio', 'finally, it scrolls', '2019-05-22 02:47:55', 'yes', 'no', 'no'),
(14, 'john_cuszack', 'leonardo_decaprio', 'fixed', '2019-05-22 12:09:59', 'yes', 'no', 'no'),
(15, 'nicolas_cage', 'leonardo_decaprio', 'Hey Cage!', '2019-05-23 02:02:15', 'yes', 'no', 'no'),
(16, 'john_cuszack', 'leonardo_decaprio', ':)', '2019-05-23 02:04:50', 'yes', 'no', 'no'),
(17, 'nicolas_cage', 'leonardo_decaprio', 'cage say something!', '2019-05-23 02:06:00', 'yes', 'no', 'no'),
(18, 'nicolas_cage', 'leonardo_decaprio', 'cover up', '2019-05-23 02:15:02', 'yes', 'no', 'no'),
(19, 'leonardo_decaprio', 'john_cuszack', 'talking back to you', '2019-05-23 02:19:16', 'yes', 'no', 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
