-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Verzia serveru: 10.4.32-MariaDB
-- Verzia PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `sportcar_auta`
--

CREATE TABLE `sportcar_auta` (
  `idc` smallint(6) NOT NULL,
  `nazov` varchar(50) NOT NULL,
  `vykon` smallint(6) NOT NULL,
  `rychlost` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `sportcar_auta`
--

INSERT INTO `sportcar_auta` (`idc`, `nazov`, `vykon`, `rychlost`) VALUES
(1, 'Aston Martin DBS Coupe', 380, 350),
(2, 'Bugatti Veyron 16.4', 736, 407),
(3, 'Ferrari 599 GTB Fiorano', 456, 331),
(4, 'Lamborghini Aventador LP 700-4', 515, 350),
(5, 'Maserati GranTurismo MC Stradale', 331, 301),
(6, 'Porsche 911 Carrera S', 283, 302);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `sportcar_hodnotenie`
--

CREATE TABLE `sportcar_hodnotenie` (
  `idc` smallint(6) NOT NULL,
  `uid` smallint(6) NOT NULL,
  `body` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `sportcar_hodnotenie`
--

INSERT INTO `sportcar_hodnotenie` (`idc`, `uid`, `body`) VALUES
(1, 2, 5),
(1, 4, 4),
(3, 4, 5);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `sportcar_pouzivatelia`
--

CREATE TABLE `sportcar_pouzivatelia` (
  `uid` smallint(6) NOT NULL,
  `username` varchar(20) NOT NULL DEFAULT '',
  `heslo` varchar(255) NOT NULL,
  `meno` varchar(20) NOT NULL DEFAULT '',
  `priezvisko` varchar(30) NOT NULL DEFAULT '',
  `admin` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `sportcar_pouzivatelia`
--

INSERT INTO `sportcar_pouzivatelia` (`uid`, `username`, `heslo`, `meno`, `priezvisko`, `admin`) VALUES
(1, 'admin', '$2y$10$nsht0AM9c06btrynmePqPujujO74gm2exOK8hVDArianH0s7gHBWu', 'Administrátor', 'systému', 1),
(2, 'uwa', '$2y$10$LL8c8nhL52f/13UeqsuVWO9T75p0koqlkXt0XL97124DwxgvR/t7i', 'predmet', 'UWA', 0),
(3, 'ferrari', '$2y$10$B4YPG89zHs2NVXzNp2uJ7e1nEclu2hD2umSUvQK3hvMqHeJhWYnaO', 'Enzo', 'Ferrari', 1),
(4, 'roman', '$2y$10$9r88gBJm69hsqXmYoqwlj.z6gCQx79R0m4JE8SE4Wb0yc2rt3oLma', 'Roman', 'R', 0),
(5, 'jozko', '$2y$10$7klslqT7Ayt6f1HQC97TdOZyDsQ4cAgPteFPLU29WTBZiGsWEwDhe', 'Jožko', 'Púčik', 0),
(6, 'mrkva', '$2y$10$YcmzWkcvOa.adl146tY4R.uxGxhUA4k7yUqU62vHa7IiqOwZmoxXe', 'Janko', 'Mrkvička', 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `sportcar_terminy`
--

CREATE TABLE `sportcar_terminy` (
  `idt` smallint(6) NOT NULL,
  `idc` smallint(6) NOT NULL,
  `datum` date NOT NULL,
  `uid` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `sportcar_terminy`
--

INSERT INTO `sportcar_terminy` (`idt`, `idc`, `datum`, `uid`) VALUES
(2, 1, '2026-06-17', 0),
(4, 1, '2026-06-28', 0),
(6, 2, '2026-06-23', 0),
(7, 2, '2026-06-22', 0),
(12, 1, '2026-06-21', 0),
(13, 1, '2026-06-23', 0),
(16, 1, '2026-06-26', 0),
(17, 3, '2026-06-25', 0),
(18, 4, '2026-06-26', 0),
(20, 4, '2026-07-01', 0),
(21, 6, '2026-06-25', 0),
(22, 6, '2026-06-26', 0),
(23, 6, '2026-07-02', 0),
(24, 1, '2026-06-20', 0),
(25, 1, '2026-06-07', 0),
(28, 1, '2026-06-08', 0),
(29, 1, '2026-06-09', 0),
(30, 1, '2026-06-10', 0),
(37, 1, '2026-07-11', 0),
(38, 1, '2026-07-12', 2),
(39, 1, '2026-07-18', 0),
(40, 1, '2026-07-19', 0),
(41, 3, '2026-05-02', 0),
(42, 3, '2026-07-12', 0),
(45, 3, '2026-07-11', 4);

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `sportcar_auta`
--
ALTER TABLE `sportcar_auta`
  ADD PRIMARY KEY (`idc`);

--
-- Indexy pre tabuľku `sportcar_hodnotenie`
--
ALTER TABLE `sportcar_hodnotenie`
  ADD PRIMARY KEY (`idc`,`uid`);

--
-- Indexy pre tabuľku `sportcar_pouzivatelia`
--
ALTER TABLE `sportcar_pouzivatelia`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexy pre tabuľku `sportcar_terminy`
--
ALTER TABLE `sportcar_terminy`
  ADD PRIMARY KEY (`idt`),
  ADD UNIQUE KEY `car_terms` (`idc`,`datum`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `sportcar_auta`
--
ALTER TABLE `sportcar_auta`
  MODIFY `idc` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pre tabuľku `sportcar_pouzivatelia`
--
ALTER TABLE `sportcar_pouzivatelia`
  MODIFY `uid` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pre tabuľku `sportcar_terminy`
--
ALTER TABLE `sportcar_terminy`
  MODIFY `idt` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
