-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 12, 2023 at 08:11 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fmc`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int NOT NULL,
  `type` enum('Livret A','Compte Courant','Plan Épargne Logement','') NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `overdraft` int NOT NULL,
  `costumers_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `type`, `balance`, `overdraft`, `costumers_id`) VALUES
(1, 'Compte Courant', '7484.45', 100, 1),
(2, 'Livret A', '10.00', 20, 4),
(3, 'Compte Courant', '500.00', 200, 4),
(4, 'Compte Courant', '1750847.00', 20000, 5),
(5, 'Compte Courant', '1235.00', 200, 2),
(6, 'Compte Courant', '1000000.73', 15000, 3),
(7, 'Plan Épargne Logement', '57850.00', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `advisors`
--

CREATE TABLE `advisors` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `gpdr` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `advisors`
--

INSERT INTO `advisors` (`id`, `email`, `password`, `lastname`, `firstname`, `gpdr`, `created_at`) VALUES
(1, 'felipe-luis@fmc.online', 'Azerty123', 'Felipe', 'Luis', 0, '2023-06-09 12:36:38'),
(2, 'jean-dupont@fmc.online', '1MotdePasseDeJean', 'Dupont', 'Jean', 1, '2023-06-09 13:38:52'),
(3, 'marc-manson@fmc.online', '1MotdePasseDeMarcManson', 'Manson', 'Marc', 0, '2023-06-09 13:43:43'),
(4, 'karl-Ashley@fmc.online', '1Password', 'Karl', 'Ashley', 1, '2023-06-09 13:44:47'),
(5, 'michel-fourniret@fmc.online', 'serialPassword', 'Fourniret', 'Michel', 0, '2023-06-09 13:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `address_comp` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gpdr` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `advisors_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `email`, `lastname`, `firstname`, `birth_date`, `address`, `address_comp`, `zip`, `city`, `phone`, `gpdr`, `created_at`, `advisors_id`) VALUES
(1, 'john-doe@fake.com', 'Doe', 'John', '2032-04-07', '21 rue de la brouette', 'Hameau Portugais', 'TRU3773', 'Macon', '0156565656', 1, '2023-06-09 12:43:54', 1),
(2, 'franck-denis@fake.com', 'Denis', 'Franck', '2033-06-23', '25 avenue du turfu', 'Hameau du Turfu', '!DF7DF#', 'TurfuLand', '0102016409409040940301', 1, '2023-06-09 13:46:37', 5),
(3, 'justin-hamidou@fake.com', 'Justin', 'Hamidou', '2014-06-09', '8 hameau de Sens', '', '54654', 'New York', '016054840', 1, '2023-06-09 13:48:52', 4),
(4, 'lucie-chida@fake.com', 'Chida', 'Lucie', '2023-06-04', '12 Schlampe Strasse', '12-13 bis', '49J8F8D', 'Hermanner', '0640546400', 1, '2023-06-09 13:50:42', 3),
(5, 'turuk-turuk@fake.com', 'Turuk', 'Turuk', '2013-06-19', '2 rue du chameau', 'Le drodro', '7897987', 'Desert', '50416041', 1, '2023-06-09 13:52:15', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `costumers_id` (`costumers_id`);

--
-- Indexes for table `advisors`
--
ALTER TABLE `advisors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advisors_id` (`advisors_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `advisors`
--
ALTER TABLE `advisors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`costumers_id`) REFERENCES `customers` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`advisors_id`) REFERENCES `advisors` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
