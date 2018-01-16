-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 16 jan 2018 om 13:08
-- Serverversie: 10.1.13-MariaDB
-- PHP-versie: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `examen`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `jongereinstituut`
--

CREATE TABLE `jongereinstituut` (
  `instituutId` int(11) NOT NULL,
  `jongereId` int(11) NOT NULL,
  `instituutStartdatum` date NOT NULL,
  `jongereInstituutArchief` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `jongereinstituut`
--

INSERT INTO `jongereinstituut` (`instituutId`, `jongereId`, `instituutStartdatum`, `jongereInstituutArchief`) VALUES
(1, 1, '2017-12-10', 0),
(2, 3, '2017-12-19', 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `jongereinstituut`
--
ALTER TABLE `jongereinstituut`
  ADD UNIQUE KEY `jongereId` (`jongereId`),
  ADD KEY `instituutId` (`instituutId`);

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `jongereinstituut`
--
ALTER TABLE `jongereinstituut`
  ADD CONSTRAINT `jongereinstituut_ibfk_1` FOREIGN KEY (`jongereId`) REFERENCES `jongere` (`jongereId`),
  ADD CONSTRAINT `jongereinstituut_ibfk_2` FOREIGN KEY (`instituutId`) REFERENCES `instituut` (`instituutId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
