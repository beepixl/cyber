-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 15, 2025 at 09:28 AM
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
-- Database: `cyber`
--

-- --------------------------------------------------------

--
-- Table structure for table `crime_record_cards`
--

CREATE TABLE `crime_record_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `police_station_name` longtext DEFAULT NULL,
  `record_date` longtext DEFAULT NULL,
  `name` longtext DEFAULT NULL,
  `alias` longtext DEFAULT NULL,
  `age` varchar(11) DEFAULT NULL,
  `fp_classification` longtext DEFAULT NULL,
  `place_of_birth` longtext DEFAULT NULL,
  `height` longtext DEFAULT NULL,
  `complexion` longtext DEFAULT NULL,
  `build` longtext DEFAULT NULL,
  `hair` longtext DEFAULT NULL,
  `eyes` longtext DEFAULT NULL,
  `identification_marks` longtext DEFAULT NULL,
  `languages_known` longtext DEFAULT NULL,
  `religion_caste` longtext DEFAULT NULL,
  `education` longtext DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `date_of_photograph` longtext DEFAULT NULL,
  `police_officers` longtext DEFAULT NULL,
  `movements_info` longtext DEFAULT NULL,
  `convictions_summary` longtext DEFAULT NULL,
  `relatives_friends` longtext DEFAULT NULL,
  `father_name` longtext DEFAULT NULL,
  `spouse_name` longtext DEFAULT NULL,
  `associates_in_crime` longtext DEFAULT NULL,
  `receivers` longtext DEFAULT NULL,
  `mo_classification` longtext DEFAULT NULL,
  `general_particulars` longtext DEFAULT NULL,
  `fir_numbers` longtext DEFAULT NULL,
  `dress_description` longtext DEFAULT NULL,
  `style_description` longtext DEFAULT NULL,
  `habits_vices` longtext DEFAULT NULL,
  `sphere_of_activity` longtext DEFAULT NULL,
  `antecedents` longtext DEFAULT NULL,
  `cp_reference` longtext DEFAULT NULL,
  `ho_memo_no` longtext DEFAULT NULL,
  `red_no_of_p_stn` longtext DEFAULT NULL,
  `dist_mob_no` longtext DEFAULT NULL,
  `cid_no` longtext DEFAULT NULL,
  `frequents_of_stays_at` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crime_record_cards`
--

INSERT INTO `crime_record_cards` (`id`, `police_station_name`, `record_date`, `name`, `alias`, `age`, `fp_classification`, `place_of_birth`, `height`, `complexion`, `build`, `hair`, `eyes`, `identification_marks`, `languages_known`, `religion_caste`, `education`, `address`, `date_of_photograph`, `police_officers`, `movements_info`, `convictions_summary`, `relatives_friends`, `father_name`, `spouse_name`, `associates_in_crime`, `receivers`, `mo_classification`, `general_particulars`, `fir_numbers`, `dress_description`, `style_description`, `habits_vices`, `sphere_of_activity`, `antecedents`, `cp_reference`, `ho_memo_no`, `red_no_of_p_stn`, `dist_mob_no`, `cid_no`, `frequents_of_stays_at`, `created_at`, `updated_at`) VALUES
(1, 'Navsari', NULL, 'Abhishek', 'Abhi', NULL, 'test 1`', 'Jaipur', '5.11\"', 'Brown', 'Heavy', 'black', 'Dark brown ', 'NA', NULL, 'Jain', 'BE', 'Navsari', NULL, 'PI name', 'Navsari', '[{\"s_no\":\"1\",\"ps_crime_no\":\"12\",\"sentence\":\"121\",\"section\":\"11\",\"date\":\"2025-07-14\"},{\"s_no\":\"2\",\"ps_crime_no\":\"12\",\"sentence\":\"11\",\"section\":\"11\",\"date\":\"2025-07-09\"}]', 'Divyesh', 'Kriyank', 'Dikahsnsh ', 'All Crime', 'Receivers', 'class', 'alsals', NULL, 'asllas', NULL, 'aslal', 'aslals', 'aslalsa', NULL, NULL, 'No', 'No', 'No', 'Navsari', '2025-07-14 02:53:49', '2025-07-14 06:19:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crime_record_cards`
--
ALTER TABLE `crime_record_cards`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crime_record_cards`
--
ALTER TABLE `crime_record_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
