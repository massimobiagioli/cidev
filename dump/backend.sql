-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Creato il: Nov 07, 2016 alle 21:37
-- Versione del server: 5.5.42
-- Versione PHP: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `backend`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `frontends`
--

CREATE TABLE `frontends` (
  `fen_id` int(11) NOT NULL,
  `fen_name` varchar(30) NOT NULL,
  `fen_api_key` varchar(36) NOT NULL,
  `fen_disabled` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `frontends`
--

INSERT INTO `frontends` (`fen_id`, `fen_name`, `fen_api_key`, `fen_disabled`) VALUES
(1, 'backend', '262a4b7c-ee86-409c-af34-f06f893c0d7c', 0);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `frontends`
--
ALTER TABLE `frontends`
  ADD PRIMARY KEY (`fen_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `frontends`
--
ALTER TABLE `frontends`
  MODIFY `fen_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
