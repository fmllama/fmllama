-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 23. Jul 2023 um 16:22
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
-- Datenbank: `db_lap_poolroboter`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_bauteile`
--

CREATE TABLE `tbl_bauteile` (
  `IDBauteil` int(10) UNSIGNED NOT NULL,
  `FIDBauteilgruppe` int(10) UNSIGNED NOT NULL,
  `Bauteil` varchar(32) NOT NULL,
  `Artikelnummer` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_bauteilgruppen`
--

CREATE TABLE `tbl_bauteilgruppen` (
  `IDBauteilgruppe` int(10) UNSIGNED NOT NULL,
  `FIDBauteilgruppe` int(10) UNSIGNED DEFAULT NULL,
  `Bauteilgruppe` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_bauteilgruppen`
--

INSERT INTO `tbl_bauteilgruppen` (`IDBauteilgruppe`, `FIDBauteilgruppe`, `Bauteilgruppe`) VALUES
(1, NULL, 'Elektrik'),
(2, NULL, 'Mechanik'),
(3, 1, 'Steuergerät'),
(4, 1, 'Kabel'),
(5, 1, 'Steuerelektronik'),
(6, 1, 'Motoren'),
(7, 5, 'Regler für Antriebsmotoren'),
(8, 2, 'Antriebsstrang'),
(9, 8, 'Zahnräder'),
(10, 8, 'Wellen');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_marken`
--

CREATE TABLE `tbl_marken` (
  `IDMarke` int(10) UNSIGNED NOT NULL,
  `Marke` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_marken`
--

INSERT INTO `tbl_marken` (`IDMarke`, `Marke`) VALUES
(2, 'Dolphin'),
(1, 'Zodiac');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_nutzungsarten`
--

CREATE TABLE `tbl_nutzungsarten` (
  `IDNutzungsart` int(10) UNSIGNED NOT NULL,
  `Nutzungsart` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_nutzungsarten`
--

INSERT INTO `tbl_nutzungsarten` (`IDNutzungsart`, `Nutzungsart`) VALUES
(3, 'öffentliche Anlagen'),
(1, 'private Anlagen'),
(2, 'semi-öffentliche Anlagen');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_poolarten`
--

CREATE TABLE `tbl_poolarten` (
  `IDPoolart` int(10) UNSIGNED NOT NULL,
  `Poolart` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_poolarten`
--

INSERT INTO `tbl_poolarten` (`IDPoolart`, `Poolart`) VALUES
(2, 'Naturpool'),
(3, 'Schwimmteich'),
(1, 'Swimming Pool');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_poolroboter`
--

CREATE TABLE `tbl_poolroboter` (
  `IDPoolroboter` int(10) UNSIGNED NOT NULL,
  `FIDMarke` int(10) UNSIGNED NOT NULL,
  `Poolroboter` varchar(32) NOT NULL,
  `Beschreibung` text DEFAULT NULL,
  `Artikelnummer` varchar(16) NOT NULL,
  `FIDPoolart` int(10) UNSIGNED NOT NULL,
  `FIDNutzungsart` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_poolroboter`
--

INSERT INTO `tbl_poolroboter` (`IDPoolroboter`, `FIDMarke`, `Poolroboter`, `Beschreibung`, `Artikelnummer`, `FIDPoolart`, `FIDNutzungsart`) VALUES
(1, 2, 'Maestro 10', 'Die Maestro-Serie aus dem Hause Dolphin / Maytronics zeichnet sich durch ihr leichtes Gewicht und ihre extrem einfache Handhabung aus. Wer einen Poolroboter sucht, der einfach „nur“ den Pool reinigt, ist hier richtig: Bei kaum einer Poolroboter-Serie bekommen Sie so viel Leistung fürs Geld.\r\nDer Dolphin Maestro 10 ist das günstigste Modell der Serie. Er ist als reiner Boden-Roboter konzipiert und eignet sich für die meisten privaten Schwimmbäder oder Aufstellbecken bis zu 8 x 4 Metern.', ' 39005501', 1, 1),
(2, 2, 'E50i', 'Kann viel mehr als nur putzen, aber das besonders gut: Der flexible Dolphin E50i passt sich genau Ihren Wünschen an.\r\nEs gibt einige Poolroboter, die wirklich gründlich reinigen. Oftmals haben die aber das Problem, dass man sich nach ihnen richten muss: Die Reinigungszeit schränkt die Bade-Aktivität ein, im Urlaub wird der Nachbar zur Poolreinigung benötigt und man muss auch meistens zuhause sein, um den Roboter zu starten.\r\nDer neue E50i macht Schluss mit dieser Abhängigkeit und gibt Ihnen die Kontrolle zurück. Höchste Flexibilität bei den Reinigungszeiten, eine Steuerung über die Cloud-basierte App und eine automatische Reinigung dank Wochen-Timer machen diesen Poolroboter zu einem Gefährten, der jederzeit genau so lange einsatzbereit ist, wie Sie es wünschen.\r\nFür die maximale Kontrolle – schließlich ist es Ihre Freizeit, um die es geht.\r\nÜbrigens: Der Dolphin E50i hat volle 36 Monate Hersteller-Gewährleistung.', '39005738 ', 1, 1),
(3, 2, 'Bio S', 'Der perfekte Reinigungs-Roboter für Schwimmteiche und Naturpools.\r\nImmer mehr Menschen steigen auf einen Bio- oder Naturpool um. Und das hat viele gute Gründe: Klares und weiches Wasser, kaum Einsatz von Chlor und anderen chemischen Zusätzen. Außerdem übernehmen die Pflanzen nicht nur die Wasseraufbereitung, sie erwärmen den Pool auch.\r\nAllerdings sollte auch ein Naturpool regelmäßig gereinigt werden, damit er so schön und klar bleibt.\r\nWo herkömmliche Poolroboter in Naturpools nur sehr eingeschränkt geeignet sind und die Phosphate im Naturpool der Elektronik schaden können, braucht es einen speziellen Poolroboter, der genau auf diese Gegebenheiten ausgelegt ist. Dafür hat Dolphin den Bio S entwickelt.\r\nDieser bietet eine optimale Reinigungs-Leistung für Pools bis zu 15 Meter Länge. Der Teichroboter entfernt effektiv Blätter und andere Fremdkörper aus dem Schwimmteich, durch interne Filterung oder externes Absaugen an Boden, Wänden und der Wasserlinie.', ' 39005461', 2, 1),
(4, 1, 'TRX 7500 iQ VORTRAX', 'Der vollautomatische TRX 7500 iQ VORTRAX ist speziell für den Einsatz in halböffentlichen Becken (professioneller Einsatz in Hotelbädern, Pools, Campingplätze und Sportzentren) entwickelt worden. Der Roboter wird für die Reinigung von Beckenböden und geraden Wänden mit einer Beckenlänge bis max. 20 Metern eingesetzt.', '85160', 1, 2),
(5, 1, 'Alpha 63 IQ BIO', 'Der neue Reiniger für Naturpools und Schwimmteiche. Mit Sensor Nav Sytem wird der Reinigungsablauf auf das Becken perfekt abgestimmt. Die Zykolontechnologie sorgt für starke und konstante Saugkraft und das Lift-System ermöglicht die leichte Entnahme des Reinigers aus dem Becken. Die Bedienung erfolgt über Smartphone oder Tablet via kostenloser App iAquaLink. Mit 400 μ Filterkorb für optimale Reinigung. Inkl. Transportcaddy.', '84829', 2, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_poolroboter_bauteile`
--

CREATE TABLE `tbl_poolroboter_bauteile` (
  `IDPoolroboterBauteil` int(10) UNSIGNED NOT NULL,
  `FIDPoolroboter` int(10) UNSIGNED NOT NULL,
  `FIDBauteil` int(10) UNSIGNED NOT NULL,
  `Anzahl` float(5,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_skala`
--

CREATE TABLE `tbl_skala` (
  `IDSkala` int(10) UNSIGNED NOT NULL,
  `Skala` varchar(16) NOT NULL,
  `Wert` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_skala`
--

INSERT INTO `tbl_skala` (`IDSkala`, `Skala`, `Wert`) VALUES
(1, 'schlecht', 1),
(2, 'ausreichend', 2),
(3, 'befriedigend', 3),
(4, 'gut', 4),
(5, 'sehr gut', 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_votings`
--

CREATE TABLE `tbl_votings` (
  `IDVoting` int(10) UNSIGNED NOT NULL,
  `FIDMarke` int(10) UNSIGNED NOT NULL,
  `User` varchar(32) NOT NULL,
  `FIDBewertung` int(10) UNSIGNED NOT NULL,
  `Bewertungstext` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tbl_votings`
--

INSERT INTO `tbl_votings` (`IDVoting`, `FIDMarke`, `User`, `FIDBewertung`, `Bewertungstext`) VALUES
(1, 2, 'Uwe', 3, 'Meine Erfahrungen mit der Marke waren nicht immer die Besten.'),
(2, 2, 'Silvia', 4, NULL),
(3, 2, 'Tom', 3, NULL),
(4, 2, 'Alex C', 1, 'Nur schlechte Erfahrungen mit dieser Marke gemacht... Nie wieder'),
(5, 1, 'Uwe', 4, 'Passt soweit'),
(6, 1, 'Silv', 5, NULL),
(7, 1, 'Alex D', 4, NULL),
(8, 1, 'Sabrina', 3, 'Voll ungut. Echt jetzt.'),
(9, 1, 'Chaqueline Monique Swoboda', 2, 'Najaaaaaaa...'),
(10, 1, 'Tim', 5, NULL);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `tbl_bauteile`
--
ALTER TABLE `tbl_bauteile`
  ADD PRIMARY KEY (`IDBauteil`),
  ADD KEY `Artikelnummer` (`Artikelnummer`),
  ADD KEY `FIDBauteilgruppe` (`FIDBauteilgruppe`);

--
-- Indizes für die Tabelle `tbl_bauteilgruppen`
--
ALTER TABLE `tbl_bauteilgruppen`
  ADD PRIMARY KEY (`IDBauteilgruppe`),
  ADD KEY `FIDBauteilgruppe` (`FIDBauteilgruppe`);

--
-- Indizes für die Tabelle `tbl_marken`
--
ALTER TABLE `tbl_marken`
  ADD PRIMARY KEY (`IDMarke`),
  ADD UNIQUE KEY `Marke` (`Marke`);

--
-- Indizes für die Tabelle `tbl_nutzungsarten`
--
ALTER TABLE `tbl_nutzungsarten`
  ADD PRIMARY KEY (`IDNutzungsart`),
  ADD UNIQUE KEY `Nutzungsart` (`Nutzungsart`);

--
-- Indizes für die Tabelle `tbl_poolarten`
--
ALTER TABLE `tbl_poolarten`
  ADD PRIMARY KEY (`IDPoolart`),
  ADD UNIQUE KEY `Poolart` (`Poolart`);

--
-- Indizes für die Tabelle `tbl_poolroboter`
--
ALTER TABLE `tbl_poolroboter`
  ADD PRIMARY KEY (`IDPoolroboter`),
  ADD KEY `FIDPoolart` (`FIDPoolart`),
  ADD KEY `FIDNutzungsart` (`FIDNutzungsart`),
  ADD KEY `FIDMarke` (`FIDMarke`);

--
-- Indizes für die Tabelle `tbl_poolroboter_bauteile`
--
ALTER TABLE `tbl_poolroboter_bauteile`
  ADD PRIMARY KEY (`IDPoolroboterBauteil`),
  ADD KEY `FIDPoolroboter` (`FIDPoolroboter`),
  ADD KEY `FIDBauteil` (`FIDBauteil`);

--
-- Indizes für die Tabelle `tbl_skala`
--
ALTER TABLE `tbl_skala`
  ADD PRIMARY KEY (`IDSkala`),
  ADD UNIQUE KEY `Skala` (`Skala`),
  ADD UNIQUE KEY `Wert` (`Wert`);

--
-- Indizes für die Tabelle `tbl_votings`
--
ALTER TABLE `tbl_votings`
  ADD PRIMARY KEY (`IDVoting`),
  ADD UNIQUE KEY `FIDMarke_2` (`FIDMarke`,`User`),
  ADD KEY `FIDMarke` (`FIDMarke`),
  ADD KEY `FIDBewertung` (`FIDBewertung`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `tbl_bauteile`
--
ALTER TABLE `tbl_bauteile`
  MODIFY `IDBauteil` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tbl_bauteilgruppen`
--
ALTER TABLE `tbl_bauteilgruppen`
  MODIFY `IDBauteilgruppe` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT für Tabelle `tbl_marken`
--
ALTER TABLE `tbl_marken`
  MODIFY `IDMarke` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `tbl_nutzungsarten`
--
ALTER TABLE `tbl_nutzungsarten`
  MODIFY `IDNutzungsart` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `tbl_poolarten`
--
ALTER TABLE `tbl_poolarten`
  MODIFY `IDPoolart` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `tbl_poolroboter`
--
ALTER TABLE `tbl_poolroboter`
  MODIFY `IDPoolroboter` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `tbl_poolroboter_bauteile`
--
ALTER TABLE `tbl_poolroboter_bauteile`
  MODIFY `IDPoolroboterBauteil` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tbl_skala`
--
ALTER TABLE `tbl_skala`
  MODIFY `IDSkala` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `tbl_votings`
--
ALTER TABLE `tbl_votings`
  MODIFY `IDVoting` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `tbl_bauteile`
--
ALTER TABLE `tbl_bauteile`
  ADD CONSTRAINT `tbl_bauteile_ibfk_1` FOREIGN KEY (`FIDBauteilgruppe`) REFERENCES `tbl_bauteilgruppen` (`IDBauteilgruppe`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `tbl_bauteilgruppen`
--
ALTER TABLE `tbl_bauteilgruppen`
  ADD CONSTRAINT `tbl_bauteilgruppen_ibfk_1` FOREIGN KEY (`FIDBauteilgruppe`) REFERENCES `tbl_bauteilgruppen` (`IDBauteilgruppe`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints der Tabelle `tbl_poolroboter`
--
ALTER TABLE `tbl_poolroboter`
  ADD CONSTRAINT `tbl_poolroboter_ibfk_1` FOREIGN KEY (`FIDPoolart`) REFERENCES `tbl_poolarten` (`IDPoolart`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_poolroboter_ibfk_2` FOREIGN KEY (`FIDNutzungsart`) REFERENCES `tbl_nutzungsarten` (`IDNutzungsart`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_poolroboter_ibfk_3` FOREIGN KEY (`FIDMarke`) REFERENCES `tbl_marken` (`IDMarke`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `tbl_poolroboter_bauteile`
--
ALTER TABLE `tbl_poolroboter_bauteile`
  ADD CONSTRAINT `tbl_poolroboter_bauteile_ibfk_1` FOREIGN KEY (`FIDPoolroboter`) REFERENCES `tbl_poolroboter` (`IDPoolroboter`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_poolroboter_bauteile_ibfk_2` FOREIGN KEY (`FIDBauteil`) REFERENCES `tbl_bauteile` (`IDBauteil`) ON UPDATE CASCADE;

--
-- Constraints der Tabelle `tbl_votings`
--
ALTER TABLE `tbl_votings`
  ADD CONSTRAINT `tbl_votings_ibfk_1` FOREIGN KEY (`FIDMarke`) REFERENCES `tbl_marken` (`IDMarke`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_votings_ibfk_2` FOREIGN KEY (`FIDBewertung`) REFERENCES `tbl_skala` (`IDSkala`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
