-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Dic 07, 2025 alle 10:23
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homework2`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `bali`
--

CREATE TABLE `bali` (
  `id_bali` int(11) NOT NULL,
  `id_viaggio` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `data_partenza` varchar(50) NOT NULL,
  `data_rientro` varchar(50) NOT NULL,
  `costo` double(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `bali`
--

INSERT INTO `bali` (`id_bali`, `id_viaggio`, `categoria`, `data_partenza`, `data_rientro`, `costo`) VALUES
(1, 2, 'low cost', '04/05/2027', '10/05/2027', 500.00);

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(10) NOT NULL,
  `CF` varchar(16) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `data_nascita` varchar(20) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `CF`, `nome`, `cognome`, `data_nascita`, `telefono`, `email`, `password`) VALUES
(1, 'kkk', 'Danila', 'Gatto', '2003-12-19', '3248753135', 'danila.gatto.19@gmail.com', '$2y$10$YrzvNpwkW2zXAGwJVfFPAuCBXrwyoOmVOgoU7Y5qg9CGwuWSzQszi'),
(2, 'kkk', 'sofia', 'pelimenti', '2003-12-19', '3248753135', 'pelimenti@gmail.com', '$2y$10$8FaOv9q5b4hOU8ip/XuEJe32YXoOL7Hq.zMVX0uJpp/FoqM542uxi');

-- --------------------------------------------------------

--
-- Struttura della tabella `kyoto`
--

CREATE TABLE `kyoto` (
  `id_kyoto` int(11) NOT NULL,
  `id_viaggio` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `data_partenza` varchar(50) NOT NULL,
  `data_rientro` varchar(50) NOT NULL,
  `costo` double(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `kyoto`
--

INSERT INTO `kyoto` (`id_kyoto`, `id_viaggio`, `categoria`, `data_partenza`, `data_rientro`, `costo`) VALUES
(1, 1, 'low cost', '03-03-2026', '07-03-2026', 1500.00);

-- --------------------------------------------------------

--
-- Struttura della tabella `losangeles`
--

CREATE TABLE `losangeles` (
  `id_losangeles` int(11) NOT NULL,
  `id_viaggio` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `data_partenza` varchar(50) NOT NULL,
  `data_rientro` varchar(50) NOT NULL,
  `costo` double(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `losangeles`
--

INSERT INTO `losangeles` (`id_losangeles`, `id_viaggio`, `categoria`, `data_partenza`, `data_rientro`, `costo`) VALUES
(1, 5, 'low cost', '04/09/2026', '10/09/2027', 2000.00);

-- --------------------------------------------------------

--
-- Struttura della tabella `pagamento`
--

CREATE TABLE `pagamento` (
  `id_pagamento` int(11) NOT NULL,
  `data` int(11) NOT NULL,
  `importo` double(20,2) NOT NULL,
  `esito` varchar(20) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `pagamento`
--

INSERT INTO `pagamento` (`id_pagamento`, `data`, `importo`, `esito`, `id_cliente`) VALUES
(11, 20251206, 1500.00, 'approvato', 2),
(12, 20251206, 1000.00, 'approvato', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazione`
--

CREATE TABLE `prenotazione` (
  `id_prenotazione` int(10) NOT NULL,
  `id_cliente` int(10) NOT NULL,
  `id_viaggio` int(10) DEFAULT NULL,
  `destinazione` varchar(50) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `costo` double(20,2) NOT NULL,
  `id_kyoto` int(11) DEFAULT NULL,
  `id_reykjavik` int(11) DEFAULT NULL,
  `id_losangeles` int(11) DEFAULT NULL,
  `id_bali` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `reykjavik`
--

CREATE TABLE `reykjavik` (
  `id_reykjavik` int(11) NOT NULL,
  `id_viaggio` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `data_partenza` varchar(50) NOT NULL,
  `data_rientro` varchar(50) NOT NULL,
  `costo` double(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `reykjavik`
--

INSERT INTO `reykjavik` (`id_reykjavik`, `id_viaggio`, `categoria`, `data_partenza`, `data_rientro`, `costo`) VALUES
(1, 3, 'low cost', '11/10/2026', '16/10/2026', 1000.00),
(2, 4, 'low cost', '04/04/2027', '10/04/2027', 500.00);

-- --------------------------------------------------------

--
-- Struttura della tabella `viaggio`
--

CREATE TABLE `viaggio` (
  `id_viaggio` int(10) NOT NULL,
  `destinazione` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `bali`
--
ALTER TABLE `bali`
  ADD PRIMARY KEY (`id_bali`);

--
-- Indici per le tabelle `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indici per le tabelle `kyoto`
--
ALTER TABLE `kyoto`
  ADD PRIMARY KEY (`id_kyoto`);

--
-- Indici per le tabelle `losangeles`
--
ALTER TABLE `losangeles`
  ADD PRIMARY KEY (`id_losangeles`);

--
-- Indici per le tabelle `pagamento`
--
ALTER TABLE `pagamento`
  ADD PRIMARY KEY (`id_pagamento`);

--
-- Indici per le tabelle `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD PRIMARY KEY (`id_prenotazione`);

--
-- Indici per le tabelle `reykjavik`
--
ALTER TABLE `reykjavik`
  ADD PRIMARY KEY (`id_reykjavik`);

--
-- Indici per le tabelle `viaggio`
--
ALTER TABLE `viaggio`
  ADD PRIMARY KEY (`id_viaggio`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `bali`
--
ALTER TABLE `bali`
  MODIFY `id_bali` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `kyoto`
--
ALTER TABLE `kyoto`
  MODIFY `id_kyoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `losangeles`
--
ALTER TABLE `losangeles`
  MODIFY `id_losangeles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `pagamento`
--
ALTER TABLE `pagamento`
  MODIFY `id_pagamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT per la tabella `prenotazione`
--
ALTER TABLE `prenotazione`
  MODIFY `id_prenotazione` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `reykjavik`
--
ALTER TABLE `reykjavik`
  MODIFY `id_reykjavik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
