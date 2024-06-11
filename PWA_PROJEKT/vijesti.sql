-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2024 at 05:31 PM
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
-- Database: `vijesti`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `naslov` varchar(255) NOT NULL,
  `sazetak` text NOT NULL,
  `tekst` text NOT NULL,
  `kategorija` varchar(255) NOT NULL,
  `slika` varchar(255) NOT NULL,
  `arhiva` tinyint(1) NOT NULL DEFAULT 0,
  `datum` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `naslov`, `sazetak`, `tekst`, `kategorija`, `slika`, `arhiva`, `datum`) VALUES
(27, 'Prvi članak-POLITIKA', 'Ovo je prvi članak', 'Ovo je prvi članak Ovo je prvi članak Ovo je prvi članak Ovo je prvi članakOvo je prvi članakOvo je prvi članak Ovo je prvi članak', 'Politika', 'uploads/trump.jpeg', 0, '2024-06-11 14:25:42'),
(29, 'Ovo je treći članak', 'Ovo je treći članak', 'Ovo je treći članakOvo je treći članakOvo je treći članakOvo je treći članakOvo je treći članakOvo je treći članakOvo je treći članakOvo je treći članakOvo je treći članakOvo je treći članakOvo je treći članakOvo je treći članakOvo je treći članakOvo je treći članakOvo je treći članakOvo je treći članakOvo je treći članak', 'Politika', 'uploads/vestager.jpg', 0, '2024-06-11 14:26:39'),
(31, 'Ovo je drugi članak- ostalo', 'Ovo je drugi članak', 'Ovo je drugi članakOvo je drugi članakOvo je drugi članakOvo je drugi članakOvo je drugi članakOvo je drugi članakOvo je drugi članakOvo je drugi članakOvo je drugi članakOvo je drugi članakOvo je drugi članak', 'Ostalo', 'uploads/paralelw.jpg', 0, '2024-06-11 14:27:53'),
(32, 'NOVI ČLANAK', 'NOVI ČLANAK', 'NOVI ČLANAK', 'Ostalo', 'uploads/escooter.jpg', 0, '2024-06-11 14:49:15'),
(36, 'Arhivirana vijest', 'ova vijest je arhivirana', 'ova vijest je arhiviranaova vijest je arhiviranaova vijest je arhiviranaova vijest je arhiviranaova vijest je arhiviranaova vijest je arhiviranaova vijest je arhivirana', 'Ostalo', 'uploads/escooter.jpg', 1, '2024-06-11 15:04:08'),
(39, 'Ovo je test forme', 'ovo je test', 'ovo je testestestestestestestestte', 'Ostalo', 'uploads/vestager.jpg', 0, '2024-06-11 15:16:00'),
(41, 'ovaj naslov je pred', 'prekratakaaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaa', 'Politika', 'uploads/escooter.jpg', 1, '2024-06-11 15:20:28');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `korisnicko_ime` varchar(50) NOT NULL,
  `lozinka` varchar(255) NOT NULL,
  `ime` varchar(100) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT 0,
  `prezime` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `korisnicko_ime`, `lozinka`, `ime`, `admin`, `prezime`) VALUES
(1, 'pero', '$2y$10$parQAKuFFX6JM12GZaMfnujttnnq.5LltGvy2KI/UxCLJOQDYnrmW', 'Petar', 0, ''),
(2, 'Pero1', '$2y$10$PEf4hakbXd6yHGCT4FfRGOH5AtM/Vg9HyKzSUeRH/.KNsJtmC5yoG', 'Petar Todoric', 1, ''),
(3, 'admin', '$2y$10$Micz0jIfTwZZ1kwRnk49bukWaz.U5loD0vqLOVHC3tpq9ksytE4Ua', 'admin', 1, 'admin'),
(4, 'm  e', '$2y$10$TrthMZNb4rZKZKL2kGS56.RYQfPEA3BzDHMcACUt.7bcLLFPcg/Rq', 'me', 1, 'me'),
(5, 'PETAR', '$2y$10$W.NJQn.9KvVCBb3Dm63OTelmTQkAQvNWwDndfu/GXB3QWQOWdCN7q', 'PETAR', 1, 'T'),
(6, 'korisnik', '$2y$10$DwtA/GzNVOZW8XBmCTXbYOWMOy.95nMuWA47w3v/UMinhmp4ML1me', 'korisnik', 1, 'korisnik'),
(7, 'marko', '$2y$10$T8ZdTHGfygOf1AcArZgpMu1wdb4Gkv2gThhrbzs9yqRAyvnZHmrJG', 'marko', 1, 'markić');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
