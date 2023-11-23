-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 30. Jun 2022 um 10:36
-- Server-Version: 10.4.11-MariaDB
-- PHP-Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `db_lap_testen0`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_geschlechter`
--

CREATE TABLE `tbl_geschlechter` (
  `IDGeschlecht` int(10) UNSIGNED NOT NULL,
  `Bezeichnung` varchar(16) NOT NULL,
  `Kurzzeichen` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `tbl_geschlechter`
--

INSERT INTO `tbl_geschlechter` (`IDGeschlecht`, `Bezeichnung`, `Kurzzeichen`) VALUES
(1, 'weiblich', 'w'),
(2, 'männlich', 'm'),
(3, 'divers', 'd');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_user`
--

CREATE TABLE `tbl_user` (
  `IDUser` int(10) UNSIGNED NOT NULL,
  `Emailadresse` varchar(32) NOT NULL,
  `Passwort` varchar(32) NOT NULL,
  `Vorname` varchar(32) DEFAULT NULL,
  `Nachname` varchar(32) DEFAULT NULL,
  `Geburtsdatum` date NOT NULL,
  `FIDGeschlecht` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `tbl_geschlechter`
--
ALTER TABLE `tbl_geschlechter`
  ADD PRIMARY KEY (`IDGeschlecht`);

--
-- Indizes für die Tabelle `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`IDUser`),
  ADD KEY `FIDGeschlecht` (`FIDGeschlecht`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `tbl_geschlechter`
--
ALTER TABLE `tbl_geschlechter`
  MODIFY `IDGeschlecht` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `IDUser` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `tbl_user_ibfk_1` FOREIGN KEY (`FIDGeschlecht`) REFERENCES `tbl_geschlechter` (`IDGeschlecht`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
