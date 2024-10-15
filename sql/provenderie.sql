-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 15, 2024 at 01:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `provenderie`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `Energy` decimal(8,2) NOT NULL,
  `Protein` decimal(4,2) NOT NULL,
  `Demarrage1` decimal(4,2) NOT NULL,
  `Demarrage2` decimal(4,2) NOT NULL,
  `Croissance1` decimal(4,2) NOT NULL,
  `Croissance2` decimal(4,2) NOT NULL,
  `Pondeuse1` decimal(4,2) NOT NULL,
  `Pondeuse2` decimal(4,2) NOT NULL,
  `Reproducteur1` decimal(4,2) NOT NULL,
  `Reproducteur2` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `Energy`, `Protein`, `Demarrage1`, `Demarrage2`, `Croissance1`, `Croissance2`, `Pondeuse1`, `Pondeuse2`, `Reproducteur1`, `Reproducteur2`) VALUES
(1, 'Maïs', 3400.00, 9.00, 10.00, 60.00, 30.00, 48.00, 30.00, 50.00, 20.00, 50.00),
(2, 'Sorgho', 2810.00, 10.00, 0.00, 40.00, 0.00, 25.00, 0.00, 50.00, 0.00, 50.00),
(3, 'Son de blé', 1810.00, 16.00, 0.00, 10.00, 0.00, 30.00, 0.00, 20.00, 0.00, 30.00),
(4, 'Son de maïs', 2500.00, 11.00, 10.00, 30.00, 10.00, 40.00, 10.00, 40.00, 10.00, 40.00),
(5, 'Son de sorgho', 2600.00, 12.00, 0.00, 10.00, 0.00, 10.00, 0.00, 20.00, 0.00, 20.00),
(6, 'Farine de blé', 3400.00, 9.25, 0.00, 50.00, 0.00, 40.00, 0.00, 50.00, 0.00, 50.00),
(7, 'Cossette de manioc', 2850.00, 2.20, 0.00, 5.00, 0.00, 10.00, 0.00, 15.00, 0.00, 15.00),
(8, 'Drèche de brasserie', 1980.00, 18.00, 0.00, 5.00, 0.00, 10.00, 0.00, 5.00, 2.00, 5.00),
(9, 'Tourteau d’arachide', 2640.00, 45.00, 0.00, 10.00, 0.00, 10.00, 0.00, 10.00, 0.00, 10.00),
(10, 'Farine de poisson', 3000.00, 34.00, 5.00, 10.00, 5.00, 10.00, 5.00, 10.00, 0.00, 10.00),
(11, 'Sel', 0.00, 0.00, 0.00, 0.50, 0.00, 0.50, 0.00, 0.50, 0.00, 0.50);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  `needed_protein_min` decimal(4,2) NOT NULL,
  `needed_protein_max` decimal(4,2) NOT NULL,
  `needed_energy_min` int(6) NOT NULL,
  `needed_energy_max` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `level`, `needed_protein_min`, `needed_protein_max`, `needed_energy_min`, `needed_energy_max`) VALUES
(1, 'Poussins', 'Démarrage', 19.00, 20.00, 2600, 2700),
(2, 'Pondeuses', 'Reproducteurs', 16.50, 18.00, 2500, 2500),
(3, 'Dindons reproducteurs', 'Reproducteurs', 13.00, 16.00, 2500, 2800),
(4, 'Canards reproducteurs', 'Reproducteurs', 13.00, 13.00, 2500, 2800),
(5, 'Pintades croissance', 'Croissance', 17.00, 70.00, 2800, 2800);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
