-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 04, 2024 at 04:28 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biblio`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `author` varchar(100) NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `publication_year` year(4) NOT NULL,
  `category_id` int(11) NOT NULL,
  `status` enum('available','unavailable') DEFAULT 'available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `cover_image`, `publication_year`, `category_id`, `status`, `created_at`) VALUES
(4, 'Bumi', 'Tere Liye', 'uploads/674d5b197ef48.jpg', '2013', 3, 'available', '2024-12-02 07:00:41'),
(7, 'Malioboro at Midnight', 'Skysphire', 'uploads/674fb062b3462.png', '2023', 2, 'available', '2024-12-02 14:37:46'),
(8, 'Bandara Stasiun dan Tahun-Tahun Setelahnya', 'Skysphire', 'uploads/674fb012634b1.png', '2020', 2, 'unavailable', '2024-12-02 14:41:13'),
(9, 'Dago Setelah Hujan', 'Skysphire', 'uploads/674fb090329f7.png', '2022', 2, 'available', '2024-12-02 14:41:46'),
(10, 'Midnight Diaries by Malioboro Hartigan', 'Skysphire', 'uploads/674fb03a2ed64.png', '2024', 2, 'available', '2024-12-02 14:42:10'),
(11, 'Smart Book-Fisika 10 untuk SMA/MA', 'Rizka Zulhijah, Risdiyani Chasanah', 'uploads/674e7a33be2b9.png', '2024', 6, 'available', '2024-12-03 03:25:39'),
(12, 'Horror Story For Fun Study', 'Erfina Maulidah Khabib, M.Pd', 'uploads/674e7abfb73ce.png', '2019', 7, 'available', '2024-12-03 03:27:59'),
(13, 'Pentolan Daybreak', 'Faris Havoc, Dkk', 'uploads/674e7af94d9e8.png', '2017', 3, 'available', '2024-12-03 03:28:57'),
(14, 'Kemarau di Sedanau', 'ASRORUDDIN ZOECHNI', 'uploads/674e7c37a52b8.png', '2024', 2, 'available', '2024-12-03 03:34:15'),
(15, '3726 MDPL', 'Nurwina Sari', 'uploads/674e7c5ddda83.png', '2024', 2, 'available', '2024-12-03 03:34:53'),
(16, 'Sagaras', 'Tere Liye', 'uploads/674eb7d9f19e2.png', '2022', 3, 'available', '2024-12-03 07:48:41'),
(17, 'Bulan', 'Tere Liye', 'uploads/674fb0b84808f.png', '2022', 3, 'available', '2024-12-04 01:30:32'),
(18, 'Pulang Pergi', 'Tere Liye', 'uploads/674fb0d346bc9.png', '2021', 3, 'available', '2024-12-04 01:30:59'),
(19, 'Bandit Bandit Berkelas', 'Tere Liye', 'uploads/674fb11628097.png', '2024', 3, 'available', '2024-12-04 01:32:06');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(2, 'Romance', 'A Book about romance and love'),
(3, 'Action', 'An action book that inspire people to act in life.\r\n'),
(6, 'Science', 'All about science'),
(7, 'Horror', 'A very scary horror book!');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `status` enum('borrowed','returned') DEFAULT 'borrowed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `user_id`, `book_id`, `status`) VALUES
(1, 3, 7, 'returned'),
(2, 3, 7, 'returned'),
(3, 3, 9, 'returned'),
(4, 3, 16, 'returned'),
(5, 3, 12, 'returned'),
(6, 3, 12, 'returned'),
(7, 3, 12, 'returned'),
(8, 3, 14, 'returned'),
(9, 3, 12, 'returned'),
(10, 3, 14, 'returned'),
(11, 3, 9, 'returned'),
(12, 3, 15, 'returned'),
(13, 3, 4, 'returned'),
(14, 3, 12, 'returned'),
(15, 3, 7, 'returned'),
(16, 3, 8, 'returned'),
(17, 3, 7, 'returned'),
(18, 3, 8, 'borrowed'),
(19, 4, 12, 'returned'),
(20, 4, 14, 'returned'),
(21, 4, 4, 'returned'),
(22, 4, 11, 'returned'),
(23, 4, 15, 'returned'),
(24, 4, 7, 'returned'),
(25, 4, 9, 'returned'),
(26, 4, 17, 'returned');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `rating` tinyint(4) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `book_id`, `rating`, `comment`, `created_at`) VALUES
(1, 4, 11, 5, 'Buku nya bagus', '2024-12-04 15:02:46'),
(2, 3, 11, 4, 'Bukunya keren', '2024-12-04 15:11:50'),
(124, 3, 11, 5, '123', '2024-12-04 15:18:47'),
(125, 4, 11, 3, 'Buku kurang puas', '2024-12-04 15:23:42'),
(126, 4, 11, 1, '1', '2024-12-04 15:24:33'),
(127, 4, 11, 1, '1', '2024-12-04 15:25:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Masaid Fairus', 'masaidfairustrimarsongko@gmail.com', '$2y$10$q72TF3oV5JzNIXNhxVMIUOxqWyWCziFFdCCzxfQ1XpfvdqQaeU6CC', 'admin', '2024-11-29 03:17:12'),
(2, 'ahnaf', 'ahnaf@gmail.com', '$2y$10$4AmQ4chJAahYNLcYpWO0Wu2yon1Mz03AOjF2GmHbNKfiCFbnLCq6.', 'user', '2024-11-29 03:26:00'),
(3, 'Gobeng', 'gobeng@gmail.com', '$2y$10$nPh9MPcoF.Xy2MsjTUQHVOhkHSiBo6opIv4Xtfn0S9GV8aSfgBR6i', 'user', '2024-11-29 06:20:53'),
(4, 'Valentino', 'valen@gmail.com', '$2y$10$hcTova6vlU50q.D.mXNDIeMM9ZTt1z.JiJqlNmDW5Mxcg50XC9m2C', 'user', '2024-12-04 14:31:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `loans_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
