-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2024 at 08:23 PM
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
-- Database: `journal_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `email`, `password`) VALUES
(1, 'dujop87@gmail.com', '$2y$10$fWD3bZ9qAVw0TfSjHB9KJeNzaNHL27th1P0Izi5uikPbpwwVXhFYa');

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `id` int(11) NOT NULL,
  `journal_name` varchar(255) NOT NULL,
  `issn` varchar(50) NOT NULL,
  `editor_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `pdf` varchar(255) DEFAULT NULL,
  `date_uploaded` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`id`, `journal_name`, `issn`, `editor_name`, `date`, `status`, `pdf`, `date_uploaded`) VALUES
(2, 'Volume 21', '123456989455', 'Shubham sah', '2024-06-04', 'active', 'H_10226682.pdf', '2024-06-20 08:07:51'),
(3, 'Volume 22 ', '789466123', 'Nigoni 2345', '2024-06-05', 'active', 'assignfriday.pdf', '2024-06-20 08:07:51'),
(4, 'Volume 23', '789645613', 'Yusuf Pathan', '2024-06-01', 'active', 'ilide.info-dbms-lecture05-pr_8c5d1228500112d4bb657f6cd3cb24ac.pdf', '2024-06-20 08:07:51'),
(5, 'Volume 23', '45631336899', 'Md Sahebullah', '2024-05-10', 'active', 'H_10226682 (2).pdf', '2024-06-20 08:07:51'),
(12, 'Volume 25', '9446464', 'Dr. Kalyan Kumar Gupta', '2024-05-29', 'active', '20240620_103653_0258-20585.pdf', '2024-06-20 08:36:53'),
(15, 'Volume 26', '4646532321', 'kalyan guophduwhgd', '2024-08-15', 'active', '20240623_153319_H_10205508.pdf', '2024-06-23 13:33:19');

-- --------------------------------------------------------

--
-- Table structure for table `pdf_sections`
--

CREATE TABLE `pdf_sections` (
  `id` int(11) NOT NULL,
  `journal_id` int(11) NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `start_page` int(11) NOT NULL,
  `end_page` int(11) NOT NULL,
  `profile_name` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pdf_sections`
--

INSERT INTO `pdf_sections` (`id`, `journal_id`, `section_name`, `start_page`, `end_page`, `profile_name`, `profile_image`) VALUES
(1, 3, 'Kalki 2898', 1, 3, 'Dr. Bhaluk', NULL),
(3, 3, 'opppp', 4, 5, 'Dr. rizwan', NULL),
(4, 3, 'sdada', 5, 6, 'dwdwdwdwd', NULL),
(5, 2, 'Kalki 2898dsdd', 4, 3, 'dsdsdsdsd', NULL),
(6, 2, 'Kalki 2898dsdd', 4, 3, 'dsdsdsdsd', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pdf_sections`
--
ALTER TABLE `pdf_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_journal_id` (`journal_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pdf_sections`
--
ALTER TABLE `pdf_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pdf_sections`
--
ALTER TABLE `pdf_sections`
  ADD CONSTRAINT `fk_journal_id` FOREIGN KEY (`journal_id`) REFERENCES `journals` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
