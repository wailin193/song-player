-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2024 at 05:23 AM
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
-- Database: `music_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `album_id` int(11) NOT NULL,
  `album_name` varchar(100) DEFAULT NULL,
  `release_date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `artist_id` int(11) NOT NULL,
  `artist_name` varchar(100) DEFAULT NULL,
  `artist_country` varchar(50) DEFAULT NULL,
  `artist_photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `artist_albums`
--

CREATE TABLE `artist_albums` (
  `artist_id` int(11) DEFAULT NULL,
  `album_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `artist_songs`
--

CREATE TABLE `artist_songs` (
  `artist_id` int(11) DEFAULT NULL,
  `track_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `favourite_id` int(11) NOT NULL,
  `track_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `music_types`
--

CREATE TABLE `music_types` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(100) DEFAULT NULL,
  `track_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE `tracks` (
  `track_id` int(11) NOT NULL,
  `track_title` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `play_count` int(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`album_id`);

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`artist_id`);

--
-- Indexes for table `artist_albums`
--
ALTER TABLE `artist_albums`
  ADD KEY `artist_id` (`artist_id`),
  ADD KEY `album_id` (`album_id`);

--
-- Indexes for table `artist_songs`
--
ALTER TABLE `artist_songs`
  ADD KEY `artist_id` (`artist_id`),
  ADD KEY `track_id` (`track_id`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`favourite_id`),
  ADD KEY `track_id` (`track_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `music_types`
--
ALTER TABLE `music_types`
  ADD PRIMARY KEY (`type_id`),
  ADD KEY `track_id` (`track_id`);

--
-- Indexes for table `tracks`
--
ALTER TABLE `tracks`
  ADD PRIMARY KEY (`track_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artist_albums`
--
ALTER TABLE `artist_albums`
  ADD CONSTRAINT `artist_albums_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`),
  ADD CONSTRAINT `artist_albums_ibfk_2` FOREIGN KEY (`album_id`) REFERENCES `albums` (`album_id`);

--
-- Constraints for table `artist_songs`
--
ALTER TABLE `artist_songs`
  ADD CONSTRAINT `artist_songs_ibfk_1` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`artist_id`),
  ADD CONSTRAINT `artist_songs_ibfk_2` FOREIGN KEY (`track_id`) REFERENCES `tracks` (`track_id`);

--
-- Constraints for table `favourites`
--
ALTER TABLE `favourites`
  ADD CONSTRAINT `favourites_ibfk_1` FOREIGN KEY (`track_id`) REFERENCES `tracks` (`track_id`),
  ADD CONSTRAINT `favourites_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `music_types`
--
ALTER TABLE `music_types`
  ADD CONSTRAINT `music_types_ibfk_1` FOREIGN KEY (`track_id`) REFERENCES `tracks` (`track_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
