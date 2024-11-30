-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2021 at 07:44 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aess`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee_profile`
--

CREATE TABLE `employee_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  `birth_date` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `town` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `post_code` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `birth_city` int(11) NOT NULL,
  `nationality` int(11) NOT NULL,
  `insurance_no` varchar(255) NOT NULL,
  `passport_pic` varchar(255) NOT NULL,
  `utilitybill_pic` varchar(255) NOT NULL,
  `resident_pic` varchar(255) NOT NULL,
  `e_contact_name` varchar(255) NOT NULL,
  `e_contact_relation` varchar(255) NOT NULL,
  `e_contact_phone` varchar(255) NOT NULL,
  `badge_type` int(11) NOT NULL,
  `badge_number` varchar(255) NOT NULL,
  `badge_expiry` date NOT NULL,
  `badge_pic` varchar(255) NOT NULL,
  `bank_sort_code` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `name_of_account` varchar(255) NOT NULL,
  `utr_number` varchar(255) NOT NULL,
  `visa_required` int(11) NOT NULL,
  `uk_driving_licence` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_profile`
--

INSERT INTO `employee_profile` (`id`, `user_id`, `first_name`, `last_name`, `gender`, `birth_date`, `address`, `town`, `country`, `post_code`, `email`, `phone`, `birth_city`, `nationality`, `insurance_no`, `passport_pic`, `utilitybill_pic`, `resident_pic`, `e_contact_name`, `e_contact_relation`, `e_contact_phone`, `badge_type`, `badge_number`, `badge_expiry`, `badge_pic`, `bank_sort_code`, `account_number`, `name_of_account`, `utr_number`, `visa_required`, `uk_driving_licence`, `status`) VALUES
(4, 0, 'class', 'no', 1, '0000-00-00', '', 0, 0, '', '', '', 0, 0, '', '6140479f8a412Ironwood-Venture-Logo_sm-final.png', '6140479f8dfa3Ironwood-Venture-Logo_sm-final.png', '6140479f8eacfIronwood-Venture-Logo_sm-final(2).png', '', '', '', 0, '', '0000-00-00', '', '', '', '', '', 1, 1, 0),
(5, 0, 'class', 'no', 1, '0000-00-00', '', 0, 0, '', '', '', 0, 0, '', '6140479f8a412Ironwood-Venture-Logo_sm-final.png', '6140479f8dfa3Ironwood-Venture-Logo_sm-final.png', '6140479f8eacfIronwood-Venture-Logo_sm-final(2).png', '', '', '', 0, '', '0000-00-00', '', '', '', '', '', 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `employer_profile`
--

CREATE TABLE `employer_profile` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `c_mail` varchar(255) NOT NULL,
  `c_phone` varchar(255) NOT NULL,
  `c_website` varchar(255) NOT NULL,
  `c_team_size` varchar(255) NOT NULL,
  `c_about_company` varchar(255) NOT NULL,
  `c_country` int(11) NOT NULL,
  `c_city` int(11) NOT NULL,
  `c_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `vacancies` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_category`
--

CREATE TABLE `job_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'employee'),
(3, 'employer');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_email`, `password`, `user_role`) VALUES
(1, 'ali@gmail.com', '$2y$10$0hHqxyzajeIypm/iz2KZWeeEV0MhxIVBJouQGDyvIyjAQaaf4xe7a', 1),
(2, 'ahmad@gmail.com', '$2y$10$0hHqxyzajeIypm/iz2KZWeeEV0MhxIVBJouQGDyvIyjAQaaf4xe7a', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_jobs`
--

CREATE TABLE `user_jobs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee_profile`
--
ALTER TABLE `employee_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employer_profile`
--
ALTER TABLE `employer_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_category`
--
ALTER TABLE `job_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_jobs`
--
ALTER TABLE `user_jobs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee_profile`
--
ALTER TABLE `employee_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `employer_profile`
--
ALTER TABLE `employer_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_category`
--
ALTER TABLE `job_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_jobs`
--
ALTER TABLE `user_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
