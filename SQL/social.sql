-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2019-05-06 18:54:03
-- 服务器版本： 10.1.38-MariaDB
-- PHP 版本： 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `social`
--

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signup_date` date NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `num_posts` int(11) NOT NULL,
  `num_likes` int(11) NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `friend_array` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `signup_date`, `profile_pic`, `num_posts`, `num_likes`, `user_closed`, `friend_array`) VALUES
(1, 'Reece', 'Kenney', 'ReeceBoy', 'reece@gmail.com', 'ewr123', '2019-04-11', 'erwer', 1, 1, 'no', ''),
(2, 'Austin', 'Chang', 'austin_chang', 'Austin@1.com', 'e10adc3949ba59abbe56e057f20f883e', '2019-05-02', 'assets/images/profile_pics/defaults/head_emerald.png', 0, 0, 'no', ','),
(5, 'Austin', 'Chang', 'austin_chang_1', 'Austin@2.com', 'e10adc3949ba59abbe56e057f20f883e', '2019-05-02', 'assets/images/profile_pics/defaults/head_deep_blue.png', 0, 0, 'no', ','),
(7, 'Austin', 'Chang', 'austin_chang_1_2', 'Austin@4.com', 'bcc720f2981d1a68dbd66ffd67560c37', '2019-05-02', 'assets/images/profile_pics/defaults/head_deep_blue.png', 0, 0, 'no', ','),
(8, 'Chase', 'Chang', 'chase_chang', 'Austi@4.com', 'e10adc3949ba59abbe56e057f20f883e', '2019-05-02', 'assets/images/profile_pics/defaults/head_deep_blue.png', 0, 0, 'no', ','),
(9, 'Goofy', 'Duck', 'goofy_duck', 'Goofy@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2019-05-02', 'assets/images/profile_pics/defaults/head_deep_blue.png', 0, 0, 'no', ','),
(10, 'Sda', 'Dasdsd', 'sda_dasdsd', 'Asdasd@sss.com', 'e10adc3949ba59abbe56e057f20f883e', '2019-05-02', 'assets/images/profile_pics/defaults/head_emerald.png', 0, 0, 'no', ','),
(11, 'Zach', 'Zhang', 'zach_zhang', 'Zack@gmail.com', 'ebe1b49e3c01a7ed012ed737235fcc3b', '2019-05-03', 'assets/images/profile_pics/defaults/head_deep_blue.png', 0, 0, 'no', ','),
(12, 'Change', 'Malone', 'change_malone', 'Asdad@ss.com', 'dab5b23703d114558022b4b4c995379b', '2019-05-03', 'assets/images/profile_pics/defaults/head_emerald.png', 0, 0, 'no', ','),
(13, 'Chase', 'Jc', 'chase_jc', 'Chase@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2019-05-03', 'assets/images/profile_pics/defaults/head_emerald.png', 0, 0, 'no', ','),
(14, 'Justin', 'Bie', '', 'Justin@sohu.com', '123456', '2019-05-05', 'assets/images/profile_pics/defaults/head_emerald.png', 0, 0, 'no', ','),
(15, 'Jason', 'Chen', '', 'Jason@sohu.com', '123456', '2019-05-05', 'assets/images/profile_pics/defaults/head_emerald.png', 0, 0, 'no', ','),
(16, 'Jason', 'Chen', '', 'Jason@sohu.com', '1234567', '2019-05-05', 'assets/images/profile_pics/defaults/head_emerald.png', 0, 0, 'no', ','),
(17, 'Jason', 'Chen', '', 'Jason@sohu.com', '67676767676767', '2019-05-05', 'assets/images/profile_pics/defaults/head_deep_blue.png', 0, 0, 'no', ','),
(18, 'Jason', 'Chen', 'jason_chen', 'Jason2@sohu.com', 'fcea920f7412b5da7be0cf42b8c93759', '2019-05-05', 'assets/images/profile_pics/defaults/head_deep_blue.png', 0, 0, 'no', ','),
(19, 'Jason', 'Chen', 'jason_chen_1', 'Jason3@sohu.com', 'e10adc3949ba59abbe56e057f20f883e', '2019-05-05', 'assets/images/profile_pics/defaults/head_emerald.png', 0, 0, 'no', ',');

--
-- 转储表的索引
--

--
-- 表的索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
