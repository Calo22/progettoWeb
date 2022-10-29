-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Ott 28, 2022 alle 17:36
-- Versione del server: 10.4.25-MariaDB
-- Versione PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sito_web`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `campi`
--

CREATE TABLE `campi` (
  `idCampo` int(11) NOT NULL,
  `nomeCampo` varchar(30) NOT NULL,
  `posizione` varchar(40) NOT NULL,
  `ksSport` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `campi`
--

INSERT INTO `campi` (`idCampo`, `nomeCampo`, `posizione`, `ksSport`) VALUES
(1, 'San Giuseppe', 'Messina, Via Grande 12', 2),
(2, 'PalaMangano', 'Sant\'Agata Militello, Via Cernaia 14', 1),
(3, 'Comunale', 'Milazzo, Via Papa 12', 3),
(4, 'Biagio Fresina', 'Sant\'Agata Militello, Via Lungomare 157', 2),
(5, 'PalaFantozzi', 'Capo D\'Orlando, Via Roma 25', 1),
(6, 'Village', 'Patti, Via Papa 47', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazioni`
--

CREATE TABLE `prenotazioni` (
  `idPrenotazione` int(11) NOT NULL,
  `Utente` int(11) NOT NULL,
  `Sport` int(11) NOT NULL,
  `Campo` int(11) NOT NULL,
  `dataOra` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `prenotazioni`
--

INSERT INTO `prenotazioni` (`idPrenotazione`, `Utente`, `Sport`, `Campo`, `dataOra`) VALUES
(30, 8, 1, 2, '2022-11-17 16:30:00'),
(31, 8, 2, 1, '2022-10-28 15:21:00'),
(32, 8, 3, 6, '2022-11-15 16:00:00'),
(34, 9, 2, 1, '2022-11-02 16:00:00'),
(35, 9, 1, 5, '2022-11-24 14:00:00'),
(36, 9, 2, 1, '2022-10-30 16:00:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `sport`
--

CREATE TABLE `sport` (
  `idSport` int(11) NOT NULL,
  `nomeSport` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `sport`
--

INSERT INTO `sport` (`idSport`, `nomeSport`) VALUES
(1, 'Basket'),
(2, 'Calcio'),
(3, 'Tennis');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `idUtente` int(11) NOT NULL,
  `nome` varchar(25) NOT NULL,
  `cognome` varchar(25) NOT NULL,
  `dataNascita` date NOT NULL,
  `cittaResidenza` varchar(30) NOT NULL,
  `via` varchar(30) NOT NULL,
  `userName` varchar(25) NOT NULL,
  `psw` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`idUtente`, `nome`, `cognome`, `dataNascita`, `cittaResidenza`, `via`, `userName`, `psw`) VALUES
(8, 'Giuseppe', 'Rossi', '1992-07-22', 'Roma', 'Dei Cespugli', 'gggggggg', '$2y$10$eS4xp/HNk.xwFDCx34FaY.O529/.bTmRjVeZ0IYqft4r0m9EuUNQq'),
(9, 'Mario', 'Verdi', '1986-06-17', 'Milano', 'Della Villa', 'mmmmmmmm', '$2y$10$lE5Q7c0v5OqlcPGHfIhSl..gwaSYpP1Yfmpuwhf1bI0JftlSC33AS');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `campi`
--
ALTER TABLE `campi`
  ADD PRIMARY KEY (`idCampo`),
  ADD KEY `ksSport` (`ksSport`);

--
-- Indici per le tabelle `prenotazioni`
--
ALTER TABLE `prenotazioni`
  ADD PRIMARY KEY (`idPrenotazione`),
  ADD KEY `Campo` (`Campo`),
  ADD KEY `Sport` (`Sport`),
  ADD KEY `Utente` (`Utente`);

--
-- Indici per le tabelle `sport`
--
ALTER TABLE `sport`
  ADD PRIMARY KEY (`idSport`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`idUtente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `campi`
--
ALTER TABLE `campi`
  MODIFY `idCampo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `prenotazioni`
--
ALTER TABLE `prenotazioni`
  MODIFY `idPrenotazione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT per la tabella `sport`
--
ALTER TABLE `sport`
  MODIFY `idSport` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `idUtente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `campi`
--
ALTER TABLE `campi`
  ADD CONSTRAINT `campi_ibfk_1` FOREIGN KEY (`ksSport`) REFERENCES `sport` (`idSport`);

--
-- Limiti per la tabella `prenotazioni`
--
ALTER TABLE `prenotazioni`
  ADD CONSTRAINT `prenotazioni_ibfk_1` FOREIGN KEY (`Campo`) REFERENCES `campi` (`idCampo`),
  ADD CONSTRAINT `prenotazioni_ibfk_2` FOREIGN KEY (`Sport`) REFERENCES `sport` (`idSport`),
  ADD CONSTRAINT `prenotazioni_ibfk_3` FOREIGN KEY (`Utente`) REFERENCES `utenti` (`idUtente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
