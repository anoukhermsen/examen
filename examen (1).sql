-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 16 jan 2018 om 08:49
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
-- Tabelstructuur voor tabel `activiteit`
--

CREATE TABLE `activiteit` (
  `activiteitId` int(11) NOT NULL,
  `activiteitNaam` varchar(256) NOT NULL,
  `activiteitStartdatum` date NOT NULL,
  `activiteitArchief` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `activiteit`
--

INSERT INTO `activiteit` (`activiteitId`, `activiteitNaam`, `activiteitStartdatum`, `activiteitArchief`) VALUES
(1, 'Cursus sociale vaardigheden', '2018-01-25', 0),
(2, 'Survivaltocht', '2018-01-24', 0),
(3, 'Zeiltocht', '2018-01-22', 0),
(4, 'Sportactiviteit voetbal', '2018-01-23', 0),
(5, 'Sportactiviteit basketbal', '2018-01-26', 0),
(6, 'Sportactiviteit hockey', '2018-01-30', 0),
(7, 'Communicatieve vaardigheden', '2018-01-31', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikers`
--

CREATE TABLE `gebruikers` (
  `gebruikersId` int(11) NOT NULL,
  `gebruikersEmail` varchar(256) NOT NULL,
  `gebruikersWachtwoord` varchar(256) NOT NULL,
  `gebruikersVoornaam` varchar(20) NOT NULL,
  `gebruikersTussenvoegsel` varchar(7) DEFAULT NULL,
  `gebruikersAchternaam` varchar(25) NOT NULL,
  `gebruikersArchief` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `gebruikers`
--

INSERT INTO `gebruikers` (`gebruikersId`, `gebruikersEmail`, `gebruikersWachtwoord`, `gebruikersVoornaam`, `gebruikersTussenvoegsel`, `gebruikersAchternaam`, `gebruikersArchief`) VALUES
(1, 'Klara@almere.nl', 'test', 'Klara', 'Van Der', 'Molen', 0),
(2, 'Tony@almere.nl', 'test', 'Tony', NULL, 'Chocolony', 1),
(3, 'Ben@almere.nl', 'test', 'Ben', 'van', 'Jerry', 0),
(4, 'Kitty@almere.nl', 'test', 'Kitty', NULL, 'Katty', 1),
(5, 'Bubblegum@almere.nl', 'test', 'Bubble', NULL, 'Gum', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `instituut`
--

CREATE TABLE `instituut` (
  `instituutId` int(11) NOT NULL,
  `instituutNaam` varchar(256) NOT NULL,
  `instituutTel` int(10) NOT NULL,
  `instituutArchief` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `instituut`
--

INSERT INTO `instituut` (`instituutId`, `instituutNaam`, `instituutTel`, `instituutArchief`) VALUES
(1, 'Kaasfabriek BV', 611407487, 0),
(2, 'Bollenplukkers BV', 651478645, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `jongere`
--

CREATE TABLE `jongere` (
  `jongereId` int(11) NOT NULL,
  `jongereRoepnaam` varchar(20) NOT NULL,
  `jongereTussenvoegsel` varchar(7) DEFAULT NULL,
  `jongereAchternaam` varchar(25) NOT NULL,
  `jongereGeboortedatum` date NOT NULL,
  `jongereInschrijfdatum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `jongereArchief` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `jongere`
--

INSERT INTO `jongere` (`jongereId`, `jongereRoepnaam`, `jongereTussenvoegsel`, `jongereAchternaam`, `jongereGeboortedatum`, `jongereInschrijfdatum`, `jongereArchief`) VALUES
(1, 'Klaas', NULL, 'Janssen', '2000-12-15', '2018-01-15 10:59:58', 0),
(2, 'Anna', 'van', 'Dam', '1995-06-23', '2017-07-11 13:43:00', 1),
(3, 'Kees', NULL, 'Jongeman', '2003-10-13', '2016-12-31 13:08:53', 0),
(4, 'Lois', 'van', 'Broekhuizen', '1998-05-26', '2017-08-11 04:11:22', 0),
(5, 'Tim', NULL, 'Dijkstra', '2001-12-02', '2018-01-15 14:27:53', 1),
(6, 'Jantje', '', 'Janssen', '1999-09-05', '2018-01-15 14:39:11', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `jongereactiviteit`
--

CREATE TABLE `jongereactiviteit` (
  `activiteitId` int(11) NOT NULL,
  `jongereId` int(11) NOT NULL,
  `activiteitInschrijfdatum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activiteitAfgerond` tinyint(4) NOT NULL DEFAULT '0',
  `jongereActiviteitArchief` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `jongereactiviteit`
--

INSERT INTO `jongereactiviteit` (`activiteitId`, `jongereId`, `activiteitInschrijfdatum`, `activiteitAfgerond`, `jongereActiviteitArchief`) VALUES
(4, 1, '2018-01-15 11:07:16', 0, 0),
(4, 1, '2018-01-15 11:07:27', 0, 0);

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
(1, 1, '2018-02-04', 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `activiteit`
--
ALTER TABLE `activiteit`
  ADD PRIMARY KEY (`activiteitId`);

--
-- Indexen voor tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`gebruikersId`);

--
-- Indexen voor tabel `instituut`
--
ALTER TABLE `instituut`
  ADD PRIMARY KEY (`instituutId`);

--
-- Indexen voor tabel `jongere`
--
ALTER TABLE `jongere`
  ADD PRIMARY KEY (`jongereId`);

--
-- Indexen voor tabel `jongereactiviteit`
--
ALTER TABLE `jongereactiviteit`
  ADD KEY `activiteitId` (`activiteitId`),
  ADD KEY `jongereId` (`jongereId`);

--
-- Indexen voor tabel `jongereinstituut`
--
ALTER TABLE `jongereinstituut`
  ADD UNIQUE KEY `jongereId` (`jongereId`),
  ADD UNIQUE KEY `instituutId` (`instituutId`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `activiteit`
--
ALTER TABLE `activiteit`
  MODIFY `activiteitId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT voor een tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  MODIFY `gebruikersId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT voor een tabel `instituut`
--
ALTER TABLE `instituut`
  MODIFY `instituutId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT voor een tabel `jongere`
--
ALTER TABLE `jongere`
  MODIFY `jongereId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `jongereactiviteit`
--
ALTER TABLE `jongereactiviteit`
  ADD CONSTRAINT `jongereactiviteit_ibfk_1` FOREIGN KEY (`activiteitId`) REFERENCES `activiteit` (`activiteitId`),
  ADD CONSTRAINT `jongereactiviteit_ibfk_2` FOREIGN KEY (`jongereId`) REFERENCES `jongere` (`jongereId`);

--
-- Beperkingen voor tabel `jongereinstituut`
--
ALTER TABLE `jongereinstituut`
  ADD CONSTRAINT `jongereinstituut_ibfk_1` FOREIGN KEY (`jongereId`) REFERENCES `jongere` (`jongereId`),
  ADD CONSTRAINT `jongereinstituut_ibfk_2` FOREIGN KEY (`instituutId`) REFERENCES `instituut` (`instituutId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
