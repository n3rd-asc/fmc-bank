-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 16, 2023 at 12:01 PM
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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `advisors`
--

INSERT INTO `advisors` (`id`, `email`, `password`, `lastname`, `firstname`, `gpdr`, `created_at`) VALUES
(1, 'felipe-luis@fmc.online', 'Azerty123', 'Felipe', 'Luis', 0, '2023-06-09 12:36:38'),
(2, 'jean-dupont@fmc.online', '1MotdePasseDeJean', 'Dupont', 'Jean', 1, '2023-06-09 13:38:52'),
(3, 'marc-manson@fmc.online', '1MotdePasseDeMarcManson', 'Manson', 'Marc', 0, '2023-06-09 13:43:43'),
(4, 'karl-Ashley@fmc.online', '1Password', 'Karl', 'Ashley', 1, '2023-06-09 13:44:47'),
(5, 'michel-fourniret@fmc.online', 'serialPassword', 'Fourniret', 'Michel', 0, '2023-06-09 13:45:30'),
(6, 'dubois-mohamed@fmc.online', 'azertyuio', 'Dubois', 'Mohamed', 1, '2023-06-14 14:19:56'),
(7, 'choco@fmc.online', 'chochochochocolat', 'Chomet', 'Corentin', 1, '2023-06-14 14:21:09'),
(8, 'zak@fmc.online', 'azertyuio', 'Zak', 'D\'arabie', 1, '2023-06-14 14:27:55'),
(19, 'dubois-mohamed@fmc.online', 'azertyuio', 'tetert', 'retertertertert', 1, '2023-06-14 15:38:19'),
(22, 'saljardin@fmc.online', 'sdsqdsdsdsdqsqsdsqdqdqsdq', 'Salade', 'Jardin', 1, '2023-06-14 18:08:25'),
(23, 'admin@sdf.fds', 'zezaazezaezazaeazeaze', 'dernier', 'zaezaezae', 1, '2023-06-15 08:40:37'),
(24, 'eazeazzad@fmc.online', 'zaeazeazeazea', 'derder', 'erererer', 1, '2023-06-15 08:50:16'),
(25, 'marsonkiel@fmc.offline', '$argon2id$v=19$m=65536,t=4,p=1$U0w2U2UwZ2JsRzlVc1RINw$mYT1yfa6977NKV0eNS5pjUoUDI8LdZGGueBb3mSPA6Q', 'Marson', 'Kiel', 1, '2023-06-15 09:27:13'),
(28, 'jimjones@fmc.offline', '$argon2id$v=19$m=65536,t=4,p=1$dm1rTC4wb2lGVGg3Q3RUUg$MxvuEZNi6tXoqjNm6UghCGKk9BxU+uLaU5+ZPWhBevs', 'jim', 'jones', 1, '2023-06-15 09:39:48'),
(30, 'maxcor@fmc.online', '$argon2id$v=19$m=65536,t=4,p=1$bE1kbkxMN3ZIaUlQSnZ1cw$Xjx4spAE1hilNh64sjvORHb+6qr9x3vI+52iXukcpD8', 'Corentar', 'Maximum', 1, '2023-06-15 10:17:47'),
(31, 'dmanu@fmc.online', '$argon2id$v=19$m=65536,t=4,p=1$bHRUYTZPMkFqTmt1aktGRg$OilSJlXJ6OUsiQJSgPaqFrWDkspVGHSouim7x0xlQgs', 'Dubois', 'manuel', 1, '2023-06-15 11:33:20'),
(32, 'orangemeka@fmc.online', '$argon2id$v=19$m=65536,t=4,p=1$ZWNyb0RyTld3bjBVci9laQ$xk+wAG2hQgEq8zhXOxQMF9xmcxMwypLon3ryEe/Ssz8', 'Orange', 'Meka', 1, '2023-06-15 12:21:15'),
(33, 'jade-nicholas@proton.me', '$argon2id$v=19$m=65536,t=4,p=1$T0JJVEVjZy5HQjVCdm94WA$C5ud2TWDsX/vjMHxgn3dHbUGddZZYKQrYxKMiImGW9Q', 'Jade', 'Nicholas', 1, '2023-06-15 13:14:49'),
(34, 'macho@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$QURxRnVNRU5CekduZC9ucg$sz3sPQ2GK5w7kbbW3VPRtHUaEFWc0EHWmYFfhUoMTx8', 'Chomet', 'Mohamed', 1, '2023-06-15 13:18:09'),
(35, 'greenpanda@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$NS8xMEk0UHVrY2gwMU56Vg$q4ZFUrQbXClTFSJBTRUNjYM/6dQ3MW64cPYBBdoqiMo', 'Green', 'Panda', 1, '2023-06-15 13:21:44'),
(36, 'db@kc.fr', '$argon2id$v=19$m=65536,t=4,p=1$bE1JOHR5SnN1ZDB4YWxtdA$V4pDsJL8iT1KcSQQi93CJsJkhxcaa4TczRHVEPFHTtY', 'Dubois', 'Corentin', 1, '2023-06-15 14:04:28'),
(37, 'vernesjules@fmc.online', '$argon2id$v=19$m=65536,t=4,p=1$OEZMNWFCdlpWRDc3MnN3dQ$AuqyegEyHnvJjBFA9BCtSCbTIoxQUUlVOkQ1TkC56gY', 'Jules', 'Vernes', 1, '2023-06-15 14:12:34'),
(38, 'elvmh@fmc.online', '$argon2id$v=19$m=65536,t=4,p=1$TEZ5cURYZ3FtaEc3YWZyYQ$bHJRBv0cjKh8Gcbq+QZrb5dr2BrKENW/MRp9TD8y7r4', 'Elmut', 'Von-hargen', 1, '2023-06-15 14:14:55'),
(39, 'v@j.l', '$argon2id$v=19$m=65536,t=4,p=1$WGg4dzF0clAyTjMyaDVkTw$0JTHYURJmc0v7RVa6kbMYpISLJzsHpJfuu3GbAcLfDU', 'chombina', 'Mohamed', 1, '2023-06-15 14:20:43'),
(40, 'mah@moud.desert', '$argon2id$v=19$m=65536,t=4,p=1$UTdkSW14WjVNYVpHUE80RQ$C9xjSba5lCcC9VL1YqgIGxNqvgkXrKGjDQ11mIlkK/Q', 'Mahmoud', 'D\'arabie', 1, '2023-06-15 15:41:05'),
(41, 'judore@fmc.com', '$argon2id$v=19$m=65536,t=4,p=1$WFdsSEI5cnJvYjhJZ1lNYQ$9At38zovgouwkdTtsUAbZyxQpm+a/VlaLuvMSeFNybc', 'Julien', 'Doré', 1, '2023-06-15 15:43:30'),
(42, 'tema@fmc.com', '$argon2id$v=19$m=65536,t=4,p=1$NS5Vcy5ZaXVtTXFBanlIeA$NxF2KUHbiGfWgmcKvX8M5wtE8jOaKTiGqBSn1LV9IcQ', 'test', 'Mohamed', 1, '2023-06-15 15:44:44'),
(43, 'ggdhd@lghfdh.dgh', '$argon2id$v=19$m=65536,t=4,p=1$V3FRdU5UZ0xkT2twcGpFMQ$K64g0mKFBJ/jhkyLgKK0ufbzA++P82A8E73anx0Lm3A', 'tsshgfhgfh', 'dfhgdhgfhgfh', 1, '2023-06-15 15:46:56'),
(44, 'sdqsd@sqdqsd.fr', '$argon2id$v=19$m=65536,t=4,p=1$R2dkME41Wi9zenEyaDV3bw$wk07rGv0QNRxEKOqEdnrMZ/y4BaY/XH2fCsOebtEUy4', 'rggr', 'rgrgrg', 1, '2023-06-15 15:47:58'),
(45, 'jepetunkable@fmc.com', '$argon2id$v=19$m=65536,t=4,p=1$QUNIVS9jL3EzTEQ2c2JZaQ$ONW6yXTdxpzIMp2PTlAhrXepokxXqnmN3Xcrf2GbvkE', 'Je', 'petunkabl', 1, '2023-06-15 15:56:37'),
(46, 'ola@fmc.com', '$argon2id$v=19$m=65536,t=4,p=1$bnBEOHdxL2dFand6UmZ4WQ$dOnTspDt5NgXvEaewVKMQKh7G/RVm2hDCDCTguzCqAs', 'Olamain', 'Jules', 1, '2023-06-15 16:11:24'),
(47, 'hernandez-jamon@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$WGEzMXM5dVNyaVdDZXFEag$SCQY8uVObz/ub6rsEfpba3gqR50Zn/Z5NsGe/JOObkI', 'Hernandes', 'Jamon', 1, '2023-06-15 17:16:00'),
(48, 'Hekto@plasma.net', '$argon2id$v=19$m=65536,t=4,p=1$NkI0M0cyN09DM2U5OGJ6Vg$T85QHNb6lLycX5A41L/5q+qWQJ+dFn+195uYBKjD+qA', 'Hector', 'Berlioz', 1, '2023-06-15 17:17:48'),
(49, 'CortexFrancis@gmail.com', '$argon2id$v=19$m=65536,t=4,p=1$NG43aVIzUkhjNWpHVDNrNw$8Id15sMD1S35kKIxWf2WcvtV6qjFex+xmijGj5DToO4', 'Cortex', 'Francis', 1, '2023-06-16 09:29:37');

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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `advisors_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `email`, `lastname`, `firstname`, `birth_date`, `address`, `address_comp`, `zip`, `city`, `phone`, `gpdr`, `created_at`, `advisors_id`) VALUES
(1, 'john-doe@fake.com', 'Doe', 'John', '2032-04-07', '21 rue de la brouette', 'Hameau Portugais', 'TRU3773', 'Macon', '0156565656', 1, '2023-06-09 12:43:54', 35),
(2, 'franck-denis@fake.com', 'Denis', 'Franck', '2033-06-23', '25 avenue du turfu', 'Hameau du Turfu', '!DF7DF#', 'TurfuLand', '01020164094', 1, '2023-06-09 13:46:37', 48),
(3, 'justin-hamidou@fake.com', 'Justin', 'Hamidou', '2014-06-09', '8 hameau de Sens', '', '54654', 'New York', '016054840', 1, '2023-06-09 13:48:52', 46),
(4, 'lucie-chida@fake.com', 'Chida', 'Lucie', '2023-06-04', '12 Schlampe Strasse', '12-13 bis', '49J8F8D', 'Hermanner', '0640546400', 1, '2023-06-09 13:50:42', 32),
(5, 'turuk-turuk@fake.com', 'Turuk', 'Turuk', '2013-06-19', '2 rue du chameau', 'Le drodro', '7897987', 'Desert', '50416041', 1, '2023-06-09 13:52:15', 35);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

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
