-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 01. Okt 2023 um 16:15
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `db_lap_ueberweisungen`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_fachrichtungen`
--

CREATE TABLE `tbl_fachrichtungen` (
  `IDFachrichtung` int(10) UNSIGNED NOT NULL,
  `Fachrichtung` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_fachrichtungen`
--

INSERT INTO `tbl_fachrichtungen` (`IDFachrichtung`, `Fachrichtung`) VALUES
(1, 'Arzt für Allgemeinmedizin'),
(2, 'Orthopäde');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_medical`
--

CREATE TABLE `tbl_medical` (
  `IDMedical` int(10) UNSIGNED NOT NULL,
  `Strasse` varchar(32) NOT NULL,
  `PLZ` varchar(16) NOT NULL,
  `Ort` varchar(32) NOT NULL,
  `FIDStaat` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_medical`
--

INSERT INTO `tbl_medical` (`IDMedical`, `Strasse`, `PLZ`, `Ort`, `FIDStaat`) VALUES
(1, 'Krankenhausstr. 1', '4020', 'Linz', 1),
(2, 'Franckstr. 23', '4020', 'Linz', 1),
(3, 'Holzwindenerstr. 4', '4221', 'Steyregg', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_medical_fachrichtungen`
--

CREATE TABLE `tbl_medical_fachrichtungen` (
  `IDMedicalFachrichtung` int(10) UNSIGNED NOT NULL,
  `FIDMedical` int(10) UNSIGNED NOT NULL,
  `FIDFachrichtung` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_medical_fachrichtungen`
--

INSERT INTO `tbl_medical_fachrichtungen` (`IDMedicalFachrichtung`, `FIDMedical`, `FIDFachrichtung`) VALUES
(1, 2, 1),
(3, 3, 1),
(2, 3, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_medical_institution`
--

CREATE TABLE `tbl_medical_institution` (
  `IDMedicalInstitution` int(10) UNSIGNED NOT NULL,
  `FIDMedical` int(10) UNSIGNED NOT NULL COMMENT '1:1-Beziehung',
  `Institution` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_medical_institution`
--

INSERT INTO `tbl_medical_institution` (`IDMedicalInstitution`, `FIDMedical`, `Institution`) VALUES
(1, 1, 'KUK MC 3 Uniklinik Linz');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_medical_person`
--

CREATE TABLE `tbl_medical_person` (
  `IDMedicalPerson` int(10) UNSIGNED NOT NULL,
  `FIDMedical` int(10) UNSIGNED NOT NULL COMMENT '1:1-Beziehung',
  `Titel` varchar(64) DEFAULT NULL,
  `Vorname` varchar(32) NOT NULL,
  `Nachname` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_medical_person`
--

INSERT INTO `tbl_medical_person` (`IDMedicalPerson`, `FIDMedical`, `Titel`, `Vorname`, `Nachname`) VALUES
(1, 2, 'MR Dr.', 'Georg', 'Pfau'),
(2, 3, 'Dr.', 'Matthias', 'Ullner');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_patienten`
--

CREATE TABLE `tbl_patienten` (
  `IDPatient` int(10) UNSIGNED NOT NULL,
  `FIDPerson` int(10) UNSIGNED NOT NULL,
  `FIDMedical` int(10) UNSIGNED NOT NULL,
  `PatientSeit` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_patienten`
--

INSERT INTO `tbl_patienten` (`IDPatient`, `FIDPerson`, `FIDMedical`, `PatientSeit`) VALUES
(1, 1, 2, '2023-09-01'),
(2, 4, 2, '2022-05-05'),
(3, 2, 3, '2012-02-19'),
(4, 3, 2, '2019-04-05'),
(5, 3, 3, '2023-10-01');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_personen`
--

CREATE TABLE `tbl_personen` (
  `IDPerson` int(10) UNSIGNED NOT NULL,
  `Vorname` varchar(32) NOT NULL,
  `Nachname` varchar(32) NOT NULL,
  `Adresse` varchar(32) NOT NULL,
  `PLZ` varchar(16) NOT NULL,
  `Ort` varchar(32) NOT NULL,
  `FIDStaat` int(10) UNSIGNED NOT NULL,
  `SVNr` smallint(4) UNSIGNED NOT NULL,
  `GebDatum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_personen`
--

INSERT INTO `tbl_personen` (`IDPerson`, `Vorname`, `Nachname`, `Adresse`, `PLZ`, `Ort`, `FIDStaat`, `SVNr`, `GebDatum`) VALUES
(1, 'Thomas', 'Müller', 'Mayerstr. 11', '4020', 'Linz', 1, 2115, '1978-11-12'),
(2, 'Uwe', 'Mutz', 'Teststr. 1', '4020', 'Linz', 1, 1234, '1972-10-17'),
(3, 'Silvia', 'Mutz', 'Teststr. 1', '4020', 'Linz', 1, 2345, '1978-05-02'),
(4, 'Sabine', 'Müller', 'Eignerweg 19', '00042', 'Rom', 3, 3456, '1991-08-18');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_personen_versicherungen`
--

CREATE TABLE `tbl_personen_versicherungen` (
  `IDPersonVersicherung` int(10) UNSIGNED NOT NULL,
  `FIDPerson` int(10) UNSIGNED NOT NULL,
  `FIDVersicherung` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_personen_versicherungen`
--

INSERT INTO `tbl_personen_versicherungen` (`IDPersonVersicherung`, `FIDPerson`, `FIDVersicherung`) VALUES
(2, 1, 1),
(1, 1, 5),
(5, 2, 1),
(4, 3, 2),
(3, 4, 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_staaten`
--

CREATE TABLE `tbl_staaten` (
  `IDStaat` int(10) UNSIGNED NOT NULL,
  `Staat` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_staaten`
--

INSERT INTO `tbl_staaten` (`IDStaat`, `Staat`) VALUES
(5, 'Großbritannien'),
(3, 'Italien'),
(1, 'Österreich'),
(4, 'Portugal'),
(2, 'Spanien');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_ueberweisungen`
--

CREATE TABLE `tbl_ueberweisungen` (
  `IDUeberweisung` int(10) UNSIGNED NOT NULL,
  `FIDPerson` int(10) UNSIGNED NOT NULL,
  `FIDUeberwiesenVon` int(10) UNSIGNED NOT NULL,
  `FIDUeberwiesenAn` int(10) UNSIGNED NOT NULL,
  `Ueberweisungsdatum` date NOT NULL,
  `Diagnose` text NOT NULL,
  `Anfrage` varchar(256) NOT NULL,
  `FIDAbrechnungUeber` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_ueberweisungen`
--

INSERT INTO `tbl_ueberweisungen` (`IDUeberweisung`, `FIDPerson`, `FIDUeberwiesenVon`, `FIDUeberwiesenAn`, `Ueberweisungsdatum`, `Diagnose`, `Anfrage`, `FIDAbrechnungUeber`) VALUES
(1, 1, 2, 1, '2023-09-01', 'Ansatztendopathie d. M bizeps brachii', 'Stosswellentherapie erbeten', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_versicherungen`
--

CREATE TABLE `tbl_versicherungen` (
  `IDVersicherung` int(10) UNSIGNED NOT NULL,
  `Versicherung` varchar(16) NOT NULL,
  `Beschreibung` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_versicherungen`
--

INSERT INTO `tbl_versicherungen` (`IDVersicherung`, `Versicherung`, `Beschreibung`) VALUES
(1, 'SVS', 'Sozialversicherung der Selbständigen'),
(2, 'ÖGK', 'Österreichische Gesundheitskasse'),
(3, 'PVA', 'Pensionsversicherungsanstalt'),
(4, 'AUVA', 'Allgemeine Unfallversicherungsanstalt'),
(5, 'BVAEB', 'Versicherungsanstalt für den öffentlichen Dienst und Schieneverkehrsunternehmen');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `tbl_fachrichtungen`
--
ALTER TABLE `tbl_fachrichtungen`
  ADD PRIMARY KEY (`IDFachrichtung`),
  ADD UNIQUE KEY `Fachrichtung` (`Fachrichtung`);

--
-- Indizes für die Tabelle `tbl_medical`
--
ALTER TABLE `tbl_medical`
  ADD PRIMARY KEY (`IDMedical`),
  ADD KEY `FIDStaat` (`FIDStaat`);

--
-- Indizes für die Tabelle `tbl_medical_fachrichtungen`
--
ALTER TABLE `tbl_medical_fachrichtungen`
  ADD PRIMARY KEY (`IDMedicalFachrichtung`),
  ADD UNIQUE KEY `FIDMedical` (`FIDMedical`,`FIDFachrichtung`),
  ADD KEY `FIDFachrichtung` (`FIDFachrichtung`);

--
-- Indizes für die Tabelle `tbl_medical_institution`
--
ALTER TABLE `tbl_medical_institution`
  ADD PRIMARY KEY (`IDMedicalInstitution`),
  ADD UNIQUE KEY `FIDMedical` (`FIDMedical`);

--
-- Indizes für die Tabelle `tbl_medical_person`
--
ALTER TABLE `tbl_medical_person`
  ADD PRIMARY KEY (`IDMedicalPerson`),
  ADD UNIQUE KEY `FIDMedical` (`FIDMedical`) USING BTREE;

--
-- Indizes für die Tabelle `tbl_patienten`
--
ALTER TABLE `tbl_patienten`
  ADD PRIMARY KEY (`IDPatient`),
  ADD UNIQUE KEY `FIDPerson` (`FIDPerson`,`FIDMedical`),
  ADD KEY `FIDMedical` (`FIDMedical`);

--
-- Indizes für die Tabelle `tbl_personen`
--
ALTER TABLE `tbl_personen`
  ADD PRIMARY KEY (`IDPerson`),
  ADD KEY `FIDStaat` (`FIDStaat`);

--
-- Indizes für die Tabelle `tbl_personen_versicherungen`
--
ALTER TABLE `tbl_personen_versicherungen`
  ADD PRIMARY KEY (`IDPersonVersicherung`),
  ADD UNIQUE KEY `FIDPerson` (`FIDPerson`,`FIDVersicherung`),
  ADD KEY `FIDVersicherung` (`FIDVersicherung`);

--
-- Indizes für die Tabelle `tbl_staaten`
--
ALTER TABLE `tbl_staaten`
  ADD PRIMARY KEY (`IDStaat`),
  ADD UNIQUE KEY `Staat` (`Staat`);

--
-- Indizes für die Tabelle `tbl_ueberweisungen`
--
ALTER TABLE `tbl_ueberweisungen`
  ADD PRIMARY KEY (`IDUeberweisung`),
  ADD KEY `FIDPerson` (`FIDPerson`),
  ADD KEY `FIDUeberwiesenVon` (`FIDUeberwiesenVon`),
  ADD KEY `FIDUeberwiesenAn` (`FIDUeberwiesenAn`),
  ADD KEY `FIDAbrechnungUeber` (`FIDAbrechnungUeber`);

--
-- Indizes für die Tabelle `tbl_versicherungen`
--
ALTER TABLE `tbl_versicherungen`
  ADD PRIMARY KEY (`IDVersicherung`),
  ADD UNIQUE KEY `Versicherung` (`Versicherung`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `tbl_fachrichtungen`
--
ALTER TABLE `tbl_fachrichtungen`
  MODIFY `IDFachrichtung` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `tbl_medical`
--
ALTER TABLE `tbl_medical`
  MODIFY `IDMedical` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `tbl_medical_fachrichtungen`
--
ALTER TABLE `tbl_medical_fachrichtungen`
  MODIFY `IDMedicalFachrichtung` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `tbl_medical_institution`
--
ALTER TABLE `tbl_medical_institution`
  MODIFY `IDMedicalInstitution` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `tbl_medical_person`
--
ALTER TABLE `tbl_medical_person`
  MODIFY `IDMedicalPerson` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `tbl_patienten`
--
ALTER TABLE `tbl_patienten`
  MODIFY `IDPatient` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `tbl_personen`
--
ALTER TABLE `tbl_personen`
  MODIFY `IDPerson` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `tbl_personen_versicherungen`
--
ALTER TABLE `tbl_personen_versicherungen`
  MODIFY `IDPersonVersicherung` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `tbl_staaten`
--
ALTER TABLE `tbl_staaten`
  MODIFY `IDStaat` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `tbl_ueberweisungen`
--
ALTER TABLE `tbl_ueberweisungen`
  MODIFY `IDUeberweisung` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `tbl_versicherungen`
--
ALTER TABLE `tbl_versicherungen`
  MODIFY `IDVersicherung` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `tbl_medical`
--
ALTER TABLE `tbl_medical`
  ADD CONSTRAINT `tbl_medical_ibfk_1` FOREIGN KEY (`FIDStaat`) REFERENCES `tbl_staaten` (`IDStaat`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `tbl_medical_fachrichtungen`
--
ALTER TABLE `tbl_medical_fachrichtungen`
  ADD CONSTRAINT `tbl_medical_fachrichtungen_ibfk_1` FOREIGN KEY (`FIDMedical`) REFERENCES `tbl_medical` (`IDMedical`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_medical_fachrichtungen_ibfk_2` FOREIGN KEY (`FIDFachrichtung`) REFERENCES `tbl_fachrichtungen` (`IDFachrichtung`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `tbl_medical_institution`
--
ALTER TABLE `tbl_medical_institution`
  ADD CONSTRAINT `tbl_medical_institution_ibfk_1` FOREIGN KEY (`FIDMedical`) REFERENCES `tbl_medical` (`IDMedical`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `tbl_medical_person`
--
ALTER TABLE `tbl_medical_person`
  ADD CONSTRAINT `tbl_medical_person_ibfk_1` FOREIGN KEY (`FIDMedical`) REFERENCES `tbl_medical` (`IDMedical`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `tbl_patienten`
--
ALTER TABLE `tbl_patienten`
  ADD CONSTRAINT `tbl_patienten_ibfk_1` FOREIGN KEY (`FIDMedical`) REFERENCES `tbl_medical` (`IDMedical`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_patienten_ibfk_2` FOREIGN KEY (`FIDPerson`) REFERENCES `tbl_personen` (`IDPerson`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `tbl_personen`
--
ALTER TABLE `tbl_personen`
  ADD CONSTRAINT `tbl_personen_ibfk_1` FOREIGN KEY (`FIDStaat`) REFERENCES `tbl_staaten` (`IDStaat`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `tbl_personen_versicherungen`
--
ALTER TABLE `tbl_personen_versicherungen`
  ADD CONSTRAINT `tbl_personen_versicherungen_ibfk_1` FOREIGN KEY (`FIDPerson`) REFERENCES `tbl_personen` (`IDPerson`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_personen_versicherungen_ibfk_2` FOREIGN KEY (`FIDVersicherung`) REFERENCES `tbl_versicherungen` (`IDVersicherung`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `tbl_ueberweisungen`
--
ALTER TABLE `tbl_ueberweisungen`
  ADD CONSTRAINT `tbl_ueberweisungen_ibfk_1` FOREIGN KEY (`FIDPerson`) REFERENCES `tbl_personen` (`IDPerson`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_ueberweisungen_ibfk_2` FOREIGN KEY (`FIDUeberwiesenVon`) REFERENCES `tbl_medical` (`IDMedical`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_ueberweisungen_ibfk_3` FOREIGN KEY (`FIDUeberwiesenAn`) REFERENCES `tbl_medical` (`IDMedical`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_ueberweisungen_ibfk_4` FOREIGN KEY (`FIDAbrechnungUeber`) REFERENCES `tbl_versicherungen` (`IDVersicherung`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
