-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 07, 2021 at 10:43 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_user_logs`
--

CREATE TABLE `app_user_logs` (
  `id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `type` varchar(256) NOT NULL,
  `grabbed_info` varchar(256) NOT NULL,
  `device_details` varchar(256) NOT NULL,
  `device` varchar(256) NOT NULL,
  `day_name` varchar(256) NOT NULL,
  `day` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `hour` int(11) NOT NULL,
  `minute` int(11) NOT NULL,
  `second` int(11) NOT NULL,
  `user_ip` varchar(256) NOT NULL,
  `user_country_code` varchar(256) DEFAULT NULL,
  `user_country` varchar(256) DEFAULT NULL,
  `user_city` varchar(256) DEFAULT NULL,
  `user_latitude` varchar(256) DEFAULT NULL,
  `user_longitude` varchar(256) DEFAULT NULL,
  `c_date` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_user_logs`
--

INSERT INTO `app_user_logs` (`id`, `page_id`, `user_id`, `email`, `type`, `grabbed_info`, `device_details`, `device`, `day_name`, `day`, `month`, `year`, `hour`, `minute`, `second`, `user_ip`, `user_country_code`, `user_country`, `user_city`, `user_latitude`, `user_longitude`, `c_date`) VALUES
(1, 2, 1, 'nyz@gmail.com', 'Logged In', 'Username: nyz@gmail.com', 'Mozilla/5.0 (X11; Linux x86_64; rv:78.0) Gecko/20100101 Firefox/78.0', 'Computer', 'Sunday', 24, 1, 2021, 21, 26, 41, '127.0.0.1', NULL, NULL, NULL, NULL, NULL, '1611516401'),
(2, 2, 1, 'nyz@gmail.com', 'Logged In', 'Username: nyz@gmail.com', 'Mozilla/5.0 (X11; Linux x86_64; rv:78.0) Gecko/20100101 Firefox/78.0', 'Computer', 'Monday', 25, 1, 2021, 1, 48, 18, '127.0.0.1', NULL, NULL, NULL, NULL, NULL, '1611532098'),
(3, 2, 1, 'nyz@gmail.com', 'Logged In', 'Username: nyz@gmail.com', 'Mozilla/5.0 (X11; Linux x86_64; rv:78.0) Gecko/20100101 Firefox/78.0', 'Computer', 'Monday', 25, 1, 2021, 21, 7, 17, '127.0.0.1', NULL, NULL, NULL, NULL, NULL, '1611601637'),
(4, 2, 1, 'nyz@gmail.com', 'Logged In', 'Username: nyz@gmail.com', 'Mozilla/5.0 (X11; Linux x86_64; rv:78.0) Gecko/20100101 Firefox/78.0', 'Computer', 'Thursday', 28, 1, 2021, 22, 53, 53, '127.0.0.1', NULL, NULL, NULL, NULL, NULL, '1611867233'),
(5, 2, 1, 'nyz@gmail.com', 'Logged In', 'Username: nyz@gmail.com', 'Mozilla/5.0 (X11; Linux x86_64; rv:78.0) Gecko/20100101 Firefox/78.0', 'Computer', 'Friday', 29, 1, 2021, 22, 32, 5, '127.0.0.1', NULL, NULL, NULL, NULL, NULL, '1611952325');

-- --------------------------------------------------------

--
-- Table structure for table `app_user_session`
--

CREATE TABLE `app_user_session` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `app_user_token`
--

CREATE TABLE `app_user_token` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_user_token`
--

INSERT INTO `app_user_token` (`id`, `user_id`, `hash`) VALUES
(2, 17, 'e9ab498afb371b0174ca6eb61ce7d39bdc68d395ad2b6b3d150496d4440ab8bf'),
(3, 1, '6350e16044ad6d0886e755e5754eb830bcac90ba26cd67e047ddc7fd0b30168e');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(10) NOT NULL,
  `student_id` varchar(250) NOT NULL,
  `class_id` varchar(250) NOT NULL,
  `start_status` int(10) NOT NULL,
  `start_time` time NOT NULL,
  `end_status` int(10) NOT NULL,
  `end_time` time NOT NULL,
  `attendance_date` date NOT NULL,
  `start_observation` int(10) NOT NULL,
  `end_observation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_class`
--

CREATE TABLE `attendance_class` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `registered_by` varchar(255) NOT NULL,
  `c_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance_class`
--

INSERT INTO `attendance_class` (`id`, `name`, `code`, `section`, `registered_by`, `c_date`) VALUES
(7, 'Year3', 'CLS-0007', 'Commercial Et Gestion', '1', '2021-01-23'),
(8, 'Year3', 'CLS-0008', 'Biochimie', '1', '2021-01-23'),
(9, 'Year3', 'CLS-0009', 'Humanite Pedagogique', '1', '2021-01-23'),
(10, 'Year4', 'CLS-0010', 'Commercial Et Gestion', '1', '2021-01-23'),
(11, 'Year4', 'CLS-0011', 'Biochimie', '1', '2021-01-23'),
(12, 'Year4', 'CLS-0012', 'Humanite Pedagogique', '1', '2021-01-23'),
(13, 'Year5', 'CLS-0013', 'Commercial Et Gestion', '1', '2021-01-23'),
(14, 'Year5', 'CLS-0014', 'Biochimie', '1', '2021-01-23'),
(15, 'Year5', 'CLS-0015', 'Humanite Pedagogique', '1', '2021-01-23'),
(16, 'Year6', 'CLS-0016', 'Commercial Et Gestion', '1', '2021-01-23'),
(17, 'Year6', 'CLS-0017', 'Biochimie', '1', '2021-01-23'),
(18, 'Year6', 'CLS-0018', 'Humanite Pedagogique', '1', '2021-01-23'),
(20, 'Year1', 'CLS-0019', 'Secondaire General', '1', '2021-01-29');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_student`
--

CREATE TABLE `attendance_student` (
  `id` int(11) NOT NULL,
  `rollnumber` varchar(255) NOT NULL,
  `card_id` bigint(20) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `classes` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `mothername` varchar(255) NOT NULL,
  `fathername` varchar(255) NOT NULL,
  `responsable_phone` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `registered_by` int(11) NOT NULL,
  `c_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance_student`
--

INSERT INTO `attendance_student` (`id`, `rollnumber`, `card_id`, `firstname`, `lastname`, `surname`, `email`, `gender`, `address`, `classes`, `nationality`, `birthday`, `mothername`, `fathername`, `responsable_phone`, `religion`, `profile`, `status`, `registered_by`, `c_date`) VALUES
(32, 'STD-20210032', 1233863893673, 'Kevin ', 'Ziha', 'Dav', 'kevin@gmail.com', 'Male', 'Goma', 'Year4 Commercial Et Gestion', 'Congolaise', '2022-02-25', 'Reina', 'Raphael', '0979865347', 'Protestance', 'User.png', 1, 1, '2021-01-24 09:29:16'),
(33, 'STD-20210033', 12334543876393, 'Kasikila ', 'Mahamudi', 'Charbel', 'charbel@gmai.com', 'Male', 'Goma', 'Year6 Biochimie', 'Congolaise', '2020-02-25', 'Reina', 'Kasikila', '0971234567', 'Catholique', 'User.png', 1, 1, '2021-01-24 09:33:45'),
(35, 'STD-20210034', 89765636267826, 'Madlyn', 'Bdl ', 'Nelsons', 'madlynbdl@gmail.com', 'Male', 'Goma', 'Year3 Commercial Et Gestion', 'Congolaise', '2022-02-26', 'Adrianna', 'Bdl Nelson', '+250782289442', 'Christian', 'User.png', 1, 1, '2021-01-25 01:40:16'),
(37, 'STD-20210036', 98757543554357, 'Benjamain', 'Muthamu ', 'Victoire', 'victoire@gmail.com', 'Male', 'Gisozi', 'Year3 Commercial Et Gestion', 'Congolaise', '1999-01-12', 'Marie', 'Josue', '0987654543', 'Protestante', 'User.png', 1, 1, '2021-01-28 11:45:55'),
(38, 'STD-20210038', 87657554356779, 'Salehm', 'Bin', 'Naser', 'naser@gmail.com', 'Male', 'Kachiru', 'Year2 Secondaire General', 'Arab', '2001-01-28', 'Sali', 'Yasin', '0787897662', 'Musilman', 'User.png', 1, 1, '2021-01-28 11:48:29'),
(39, 'STD-20210039', 78773738392838, 'Malik', 'Hamed', 'Kann', 'khan@mail.com', 'Male', 'Kachiru', 'Year3 Biochimie', 'Arab', '2019-01-29', 'Navabi', 'Haram', '0987654566', 'Musilman', 'User.png', 1, 1, '2021-01-28 11:53:08'),
(40, 'STD-20210040', 67654543279871, 'Yungu', 'Yang', 'Zong', 'zong@gmail.com', 'Male', 'Gisozi', 'Year1 Secondaire General', 'Japonaise', '2020-02-28', 'Zing', 'Young', '09876543234', 'Catholique', 'User.png', 1, 1, '2021-01-29 10:39:09'),
(41, 'STD-20210041', 2363528939, 'Hing', 'Kong', 'Ing', 'ing@gmail.com', 'Female', 'Gisozi', 'Year3 Humanite Pedagogique', 'Japonaise', '2022-09-27', 'Lin', 'Yin', '+250782345678', 'Hindu', 'User.png', 1, 1, '2021-01-29 10:48:15'),
(42, 'STD-20210042', 739921283648293, 'Rosine', 'Malebo', 'Chance', 'change@gmail.com', 'Female', 'Gisozi', 'Year3 Humanite Pedagogique', 'Congolaise', '2022-02-01', 'Sandra', 'Rodriguez', '+243987657865', 'Catholique', 'User.png', 1, 1, '2021-01-30 12:54:20'),
(43, 'STD-20210043', 73647382938742, 'Charles', 'Irak', 'Redpen', 'redpen@gmail.com', 'Male', 'Goma', 'Year1 Secondaire General', 'Rwandaise', '2022-02-23', 'Marie', 'Roger', '+2438973638292', 'Protestante', 'User.png', 1, 1, '2021-01-30 12:56:29'),
(44, 'STD-20210044', 837942020003843, 'Swari', 'Maonero', ' David', 'swari@gmail.com', 'Male', 'Goma', 'Year4 Commercial Et Gestion', 'Congolaise', '2021-01-13', 'Josianne', 'Frank', '+2439783204763', 'Protestante', 'User.png', 1, 1, '2021-01-30 12:58:11'),
(45, 'STD-20210045', 83764663839297, 'Innocent ', 'Vunabandi', 'Samvura', 'samv@gmail.com', 'Male', 'Goma', 'Year3 Biochimie', 'Congolaise', '1997-01-28', 'Sarah', 'Nepo', '+243987637362', 'Catholique', 'User.png', 1, 1, '2021-01-30 01:00:17');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_teacher`
--

CREATE TABLE `attendance_teacher` (
  `id` int(11) NOT NULL,
  `code` varchar(256) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `nationality` varchar(11) NOT NULL,
  `status` int(11) NOT NULL,
  `registered_by` varchar(255) NOT NULL,
  `c_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance_teacher`
--

INSERT INTO `attendance_teacher` (`id`, `code`, `firstname`, `lastname`, `email`, `gender`, `birthday`, `address`, `qualification`, `telephone`, `religion`, `profile`, `nationality`, `status`, `registered_by`, `c_date`) VALUES
(31, 'TCH-0001', 'Charbel', 'Kasikila', 'Kas@gmail.com', 'Male', '2009-02-14', 'Goma', 'PHD', '0979300230', 'Catholique', 'User.png', 'Congolaise', 1, '1', '2021-01-13 04:22:15'),
(32, 'TCH-0032', 'Murille', 'Bedel', 'Mbedel@gmail.com', 'Female', '2004-02-14', 'Goma', 'PHD', '097886552', 'Catholique', 'User.png', 'Congolaise', 1, '1', '2021-01-13 04:23:35'),
(33, 'TCH-0033', 'Kevin', 'Ziha', 'Ziha@gmail.com', 'Male', '2002-02-14', 'Goma', 'PHD', '09757752775', 'Protestante', 'User.png', 'Congolaise', 1, '1', '2021-01-13 04:24:53'),
(34, 'TCH-0034', 'Victoire', 'Muthamu', 'Muthamu@gmail.com', 'Male', '2022-02-26', 'Goma', 'Master', '07896765444', 'Protestante', 'User.png', 'Congolaise', 1, '1', '2021-01-25 08:45:38');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_users`
--

CREATE TABLE `attendance_users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(256) NOT NULL,
  `lastname` varchar(256) NOT NULL,
  `surname` varchar(256) NOT NULL,
  `gender` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `email_state` int(11) NOT NULL,
  `telephone` varchar(256) NOT NULL,
  `address` varchar(256) NOT NULL,
  `profile` varchar(256) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `last_access` date NOT NULL,
  `last_login` date NOT NULL,
  `account_session` int(11) NOT NULL,
  `pin` int(11) NOT NULL,
  `password` varchar(256) NOT NULL,
  `salt` varchar(256) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `c_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance_users`
--

INSERT INTO `attendance_users` (`id`, `firstname`, `lastname`, `surname`, `gender`, `email`, `email_state`, `telephone`, `address`, `profile`, `user_type_id`, `last_access`, `last_login`, `account_session`, `pin`, `password`, `salt`, `admin_id`, `status`, `c_date`) VALUES
(1, 'nelson', 'nyz', 'Bdl', 'Male', 'nyz@gmail.com', 1, '+243979300230', 'Goma', 'imageProfil', 1, '0000-00-00', '0000-00-00', 0, 0, '505ea2054781b78b3d51d1cde9cf68e3749da5a632a83519fc62b349ab841fdc', 'a661810a5b27688ec4d7f6950abab95a', 1, 1, '2020-08-31 02:19:36'),
(22, 'nelson', 'yan ', 'zayd', 'Male', 'nelson@gmail.com', 1, '+243979300230', 'Goma', '', 1, '2020-12-31', '2020-12-31', 0, 0, '9f4e3ebb302c78c3121f90cd2a5b1d607ae16a02db93213b89ecdc8b78d01456\r\n\r\n', 'e54841d05fc43564007328c2547531fe\r\n', 1, 1, '2020-12-31 08:12:45');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_user_type`
--

CREATE TABLE `attendance_user_type` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `added_by` varchar(255) NOT NULL,
  `c_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance_user_type`
--

INSERT INTO `attendance_user_type` (`id`, `name`, `added_by`, `c_date`) VALUES
(1, 'Administrator', '1', '2020-03-18 17:23:33'),
(2, 'Teacher', '1', '2020-03-18 17:23:33'),
(3, 'Student', '1', '2021-01-12 14:51:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_user_logs`
--
ALTER TABLE `app_user_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_user_session`
--
ALTER TABLE `app_user_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_user_token`
--
ALTER TABLE `app_user_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_class`
--
ALTER TABLE `attendance_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_student`
--
ALTER TABLE `attendance_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_teacher`
--
ALTER TABLE `attendance_teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_users`
--
ALTER TABLE `attendance_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_user_type`
--
ALTER TABLE `attendance_user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_user_logs`
--
ALTER TABLE `app_user_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `app_user_session`
--
ALTER TABLE `app_user_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_user_token`
--
ALTER TABLE `app_user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance_class`
--
ALTER TABLE `attendance_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `attendance_student`
--
ALTER TABLE `attendance_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `attendance_teacher`
--
ALTER TABLE `attendance_teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `attendance_users`
--
ALTER TABLE `attendance_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `attendance_user_type`
--
ALTER TABLE `attendance_user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
