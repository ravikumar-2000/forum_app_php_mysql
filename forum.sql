-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 23, 2022 at 04:26 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

create database forum;
use forum;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blog_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `body` text NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modified_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blog_id`, `title`, `body`, `created_on`, `modified_on`, `user_id`, `is_deleted`) VALUES
(1, 'Machine Learning is Fun', 'It\'s not an easy task to learn Machine Learning without Mathematics.', '2022-08-22 06:22:13', '2022-08-22 06:22:13', 3, 0),
(2, 'React got Updated', 'React is Fun.', '2022-08-22 14:58:25', '2022-08-23 02:22:54', 3, 0),
(3, 'Python is Reality', 'Python is easy to learn in begining but in advance it shows it&#39;s true color.', '2022-08-23 02:19:33', '2022-08-23 02:19:33', 3, 0),
(4, 'Software Testing', 'Software testing is a kind of field for me where I see myself productive and relaxes my mind.', '2022-08-22 15:01:44', '2022-08-23 02:24:13', 8, 0),
(5, 'Hi this is Test and i got updated now.', 'I am test and I can write blogs too but someone updated me just now.', '2022-08-23 02:19:09', '2022-08-23 02:18:48', 9, 1),
(6, 'Hi this is Test updated', 'I am test and I can write blogs too and i am updated too.', '2022-08-23 02:18:02', '2022-08-23 02:18:02', 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email_address`, `password`, `created_on`, `is_deleted`) VALUES
(3, 'ravikumar_pande', 'panderavikumar4@gmail.com', '$2y$10$OFfC3Z.gVyQ84f0pRr.YfOQsLUA/6gVLfrnXK2.KYL5kpUHWkkjAu', '2022-08-22 02:25:56', 0),
(4, 'digital_nikhil', 'nikhilgaikwad@gmail.com', '$2y$10$CR3YCWIFRHiAQFmgy7H.4O7UfiB5qIvMNCSbPqKCEJrz4tePSEBX2', '2022-08-22 02:26:50', 0),
(5, 'vinayak_sir', 'sir.vinayak@gmail.com', '$2y$10$ifRaKFFq6HyDmUKCzDFwuu07OzBz4wKEcInnZOj6I5DrFBczis9Ty', '2022-08-22 02:58:19', 0),
(6, 'preeti_shinde', 'shide@gmail.com', '$2y$10$SVjsrtOZCkRrOXMHeJ/rbu74wRUfsHEw0Z8kWGNFSMWbY9rnM7G.2', '2022-08-22 02:59:22', 0),
(7, 'zenith', 'zenith@gmail.com', '$2y$10$kwW6xNMVd3WQzJWyJn1REO.uCwijODAHeSoCLYXl8A4UNUK6L5sie', '2022-08-22 04:25:00', 0),
(8, 'ashwin', 'ashwin@gmail.com', '$2y$10$B05zzYbPv.XmTWjTkKIU0ORGoXGsoWNFr45PRrU5e1uiXvnbRo1yq', '2022-08-22 05:03:28', 0),
(9, 'test_user', 'test@gmail.com', '$2y$10$JwPNjCRpWMKcgbAKdwiS1.r0cwV0LDuYOVqvoK2FyIJm/MRIGT/1q', '2022-08-22 15:19:27', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
