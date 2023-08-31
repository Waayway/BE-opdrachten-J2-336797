-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mariadb-be-p4:3306
-- Generation Time: May 11, 2023 at 11:19 AM
-- Server version: 10.7.6-MariaDB-1:10.7.6+maria~ubu2004
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `be-p4-opdr-1`
--

-- --------------------------------------------------------

--
-- Table structure for table `instructeurs`
--

CREATE TABLE `instructeurs` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `voornaam` varchar(50) NOT NULL,
  `tussenvoegsel` varchar(10) DEFAULT NULL,
  `achternaam` varchar(50) NOT NULL,
  `telefoon` char(12) NOT NULL,
  `datumInDienst` date NOT NULL,
  `aantalSterren` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instructeurs`
--

INSERT INTO `instructeurs` (`id`, `voornaam`, `tussenvoegsel`, `achternaam`, `telefoon`, `datumInDienst`, `aantalSterren`) VALUES
(1, 'Li', NULL, 'Zhan', '06-28493827', '2015-04-17', 3),
(2, 'Leroy', NULL, 'Boerhaven', '06-39398734', '2018-06-25', 1),
(3, 'Yoeri', 'Van', 'Veen', '06-24383291', '2010-05-12', 3),
(4, 'Bert', 'Van', 'Sali', '06-48293823', '2023-01-10', 4),
(5, 'Mohammed', 'El', 'Yassidi', '06-34291234', '2010-06-14', 5);

-- --------------------------------------------------------

--
-- Table structure for table `typevoertuig`
--

CREATE TABLE `typevoertuig` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `typevoertuig` varchar(100) NOT NULL,
  `rijbewijscategorie` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `typevoertuig`
--

INSERT INTO `typevoertuig` (`id`, `typevoertuig`, `rijbewijscategorie`) VALUES
(1, 'Personenauto', 'B'),
(2, 'Vrachtwagen', 'C'),
(3, 'Bus', 'D'),
(4, 'Bromfiets', 'AM');

-- --------------------------------------------------------

--
-- Table structure for table `voertuig`
--

CREATE TABLE `voertuig` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `kenteken` varchar(8) NOT NULL,
  `type` varchar(50) NOT NULL,
  `bouwjaar` date NOT NULL,
  `brandstof` varchar(15) NOT NULL,
  `typevoertuigID` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voertuig`
--

INSERT INTO `voertuig` (`id`, `kenteken`, `type`, `bouwjaar`, `brandstof`, `typevoertuigID`) VALUES
(1, 'AU-67-IO', 'Golf', '2017-06-12', 'Diesel', 1),
(2, 'TR-24-OP', 'DAF', '2019-05-23', 'Diesel', 2),
(3, 'TH-78-KL', 'Mercedes', '2023-01-01', 'Benzine', 1),
(4, '90-KL-TR', 'Fiat 500', '2021-09-12', 'Benzine', 1),
(5, '34-TK-LP', 'Scania', '2015-03-13', 'Diesel', 2),
(6, 'YY-OP-78', 'BMW M5', '2022-05-13', 'Diesel', 1),
(7, 'UU-HH-JK', 'M.A.N', '2017-12-03', 'Diesel', 2),
(8, 'ST-FZ-28', 'Citroën', '2018-01-20', 'Elektrisch', 1),
(9, '123-FR-T', 'Piaggio ZIP', '2021-02-01', 'Benzine', 4),
(10, 'DRS-52-P', 'Vespa', '2022-03-21', 'Benzine', 4),
(11, 'STP-12-U', 'Kymco', '2022-07-02', 'Benzine', 4),
(12, '45-SD-23', 'Renault', '2023-01-01', 'Diesel', 3);

-- --------------------------------------------------------

--
-- Table structure for table `voertuiginstructeur`
--

CREATE TABLE `voertuiginstructeur` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `voertuigID` tinyint(3) UNSIGNED NOT NULL,
  `instructeurID` tinyint(3) UNSIGNED NOT NULL,
  `datumToekenning` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voertuiginstructeur`
--

INSERT INTO `voertuiginstructeur` (`id`, `voertuigID`, `instructeurID`, `datumToekenning`) VALUES
(1, 1, 5, '2017-06-18'),
(2, 3, 1, '2021-09-26'),
(3, 9, 1, '2021-09-27'),
(4, 3, 4, '2022-08-01'),
(5, 5, 1, '2019-08-30'),
(6, 10, 5, '2020-02-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `instructeurs`
--
ALTER TABLE `instructeurs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `typevoertuig`
--
ALTER TABLE `typevoertuig`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voertuig`
--
ALTER TABLE `voertuig`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_typevoertuigID` (`typevoertuigID`);

--
-- Indexes for table `voertuiginstructeur`
--
ALTER TABLE `voertuiginstructeur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_voertuigID` (`voertuigID`),
  ADD KEY `FK_instructeurID` (`instructeurID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `instructeurs`
--
ALTER TABLE `instructeurs`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `typevoertuig`
--
ALTER TABLE `typevoertuig`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `voertuig`
--
ALTER TABLE `voertuig`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `voertuiginstructeur`
--
ALTER TABLE `voertuiginstructeur`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `voertuig`
--
ALTER TABLE `voertuig`
  ADD CONSTRAINT `FK_typevoertuigID` FOREIGN KEY (`typevoertuigID`) REFERENCES `typevoertuig` (`id`);

--
-- Constraints for table `voertuiginstructeur`
--
ALTER TABLE `voertuiginstructeur`
  ADD CONSTRAINT `FK_instructeurID` FOREIGN KEY (`instructeurID`) REFERENCES `instructeurs` (`id`),
  ADD CONSTRAINT `FK_voertuigID` FOREIGN KEY (`voertuigID`) REFERENCES `voertuig` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
