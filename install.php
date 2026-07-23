<?php

require_once __DIR__ . "/dati_generali.php";

/*
 * Connessione al server MySQL senza selezionare un database.
 * Il database deve ancora essere creato.
 */
$conn = new mysqli($host, $utente, $password);

if ($conn->connect_error) {
    die("Connessione a MySQL fallita: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

/*
 * Creazione del database.
 */
$sql_database = "
    CREATE DATABASE IF NOT EXISTS `$nome_database`
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci
";

if (!$conn->query($sql_database)) {
    die("Errore nella creazione del database: " . $conn->error);
}

/*
 * Selezione del database appena creato.
 */
if (!$conn->select_db($nome_database)) {
    die("Errore nella selezione del database: " . $conn->error);
}

/*
 * Query per creare le tabelle.
 */
$sql_cliente = "
    CREATE TABLE IF NOT EXISTS `$tabella_cliente` (
        id_cliente INT NOT NULL AUTO_INCREMENT,
        CF VARCHAR(16) NOT NULL,
        nome VARCHAR(50) NOT NULL,
        cognome VARCHAR(50) NOT NULL,
        data_nascita VARCHAR(20) NOT NULL,
        telefono VARCHAR(20) NOT NULL,
        email VARCHAR(100) NOT NULL,
        password VARCHAR(255) NOT NULL,
        PRIMARY KEY (id_cliente)
    ) ENGINE=InnoDB
      DEFAULT CHARSET=utf8mb4
      COLLATE=utf8mb4_general_ci
";

$sql_viaggio = "
    CREATE TABLE IF NOT EXISTS `$tabella_viaggio` (
        id_viaggio INT NOT NULL,
        destinazione VARCHAR(20) NOT NULL,
        PRIMARY KEY (id_viaggio)
    ) ENGINE=InnoDB
      DEFAULT CHARSET=utf8mb4
      COLLATE=utf8mb4_general_ci
";

$sql_bali = "
    CREATE TABLE IF NOT EXISTS `$tabella_bali` (
        id_bali INT NOT NULL AUTO_INCREMENT,
        id_viaggio INT NOT NULL,
        categoria VARCHAR(50) NOT NULL,
        data_partenza VARCHAR(50) NOT NULL,
        data_rientro VARCHAR(50) NOT NULL,
        costo DECIMAL(20,2) NOT NULL,
        PRIMARY KEY (id_bali)
    ) ENGINE=InnoDB
      DEFAULT CHARSET=utf8mb4
      COLLATE=utf8mb4_general_ci
";

$sql_kyoto = "
    CREATE TABLE IF NOT EXISTS `$tabella_kyoto` (
        id_kyoto INT NOT NULL AUTO_INCREMENT,
        id_viaggio INT NOT NULL,
        categoria VARCHAR(50) NOT NULL,
        data_partenza VARCHAR(50) NOT NULL,
        data_rientro VARCHAR(50) NOT NULL,
        costo DECIMAL(20,2) NOT NULL,
        PRIMARY KEY (id_kyoto)
    ) ENGINE=InnoDB
      DEFAULT CHARSET=utf8mb4
      COLLATE=utf8mb4_general_ci
";

$sql_reykjavik = "
    CREATE TABLE IF NOT EXISTS `$tabella_reykjavik` (
        id_reykjavik INT NOT NULL AUTO_INCREMENT,
        id_viaggio INT NOT NULL,
        categoria VARCHAR(50) NOT NULL,
        data_partenza VARCHAR(50) NOT NULL,
        data_rientro VARCHAR(50) NOT NULL,
        costo DECIMAL(20,2) NOT NULL,
        PRIMARY KEY (id_reykjavik)
    ) ENGINE=InnoDB
      DEFAULT CHARSET=utf8mb4
      COLLATE=utf8mb4_general_ci
";

$sql_losangeles = "
    CREATE TABLE IF NOT EXISTS `$tabella_losangeles` (
        id_losangeles INT NOT NULL AUTO_INCREMENT,
        id_viaggio INT NOT NULL,
        categoria VARCHAR(50) NOT NULL,
        data_partenza VARCHAR(50) NOT NULL,
        data_rientro VARCHAR(50) NOT NULL,
        costo DECIMAL(20,2) NOT NULL,
        PRIMARY KEY (id_losangeles)
    ) ENGINE=InnoDB
      DEFAULT CHARSET=utf8mb4
      COLLATE=utf8mb4_general_ci
";

$sql_prenotazione = "
    CREATE TABLE IF NOT EXISTS `$tabella_prenotazione` (
        id_prenotazione INT NOT NULL AUTO_INCREMENT,
        id_cliente INT NOT NULL,
        id_viaggio INT DEFAULT NULL,
        destinazione VARCHAR(50) NOT NULL,
        categoria VARCHAR(50) NOT NULL,
        costo DECIMAL(20,2) NOT NULL,
        id_kyoto INT DEFAULT NULL,
        id_reykjavik INT DEFAULT NULL,
        id_losangeles INT DEFAULT NULL,
        id_bali INT DEFAULT NULL,
        PRIMARY KEY (id_prenotazione)
    ) ENGINE=InnoDB
      DEFAULT CHARSET=utf8mb4
      COLLATE=utf8mb4_general_ci
";

$sql_pagamento = "
    CREATE TABLE IF NOT EXISTS `$tabella_pagamento` (
        id_pagamento INT NOT NULL AUTO_INCREMENT,
        data INT NOT NULL,
        importo DECIMAL(20,2) NOT NULL,
        esito VARCHAR(20) NOT NULL,
        id_cliente INT NOT NULL,
        PRIMARY KEY (id_pagamento)
    ) ENGINE=InnoDB
      DEFAULT CHARSET=utf8mb4
      COLLATE=utf8mb4_general_ci
";

/*
 * Esecuzione delle query di creazione.
 */
$tabelle = [
    $tabella_cliente => $sql_cliente,
    $tabella_viaggio => $sql_viaggio,
    $tabella_bali => $sql_bali,
    $tabella_kyoto => $sql_kyoto,
    $tabella_reykjavik => $sql_reykjavik,
    $tabella_losangeles => $sql_losangeles,
    $tabella_prenotazione => $sql_prenotazione,
    $tabella_pagamento => $sql_pagamento
];

foreach ($tabelle as $nome_tabella => $query) {
    if (!$conn->query($query)) {
        die(
            "Errore nella creazione della tabella "
            . $nome_tabella
            . ": "
            . $conn->error
        );
    }
}

/*
 * Inserimento dei dati iniziali nella tabella viaggio.
 */
$sql_viaggi = "
    INSERT IGNORE INTO `$tabella_viaggio`
        (id_viaggio, destinazione)
    VALUES
        (1, 'Kyoto'),
        (2, 'Bali'),
        (3, 'Reykjavik'),
        (4, 'Reykjavik'),
        (5, 'Los Angeles')
";

if (!$conn->query($sql_viaggi)) {
    die("Errore nell'inserimento dei viaggi: " . $conn->error);
}

/*
 * Inserimento dell'offerta Bali.
 */
$sql_dati_bali = "
    INSERT IGNORE INTO `$tabella_bali`
        (
            id_bali,
            id_viaggio,
            categoria,
            data_partenza,
            data_rientro,
            costo
        )
    VALUES
        (1, 2, 'low cost', '04/05/2027', '10/05/2027', 500.00)
";

if (!$conn->query($sql_dati_bali)) {
    die("Errore nell'inserimento dei dati Bali: " . $conn->error);
}

/*
 * Inserimento dell'offerta Kyoto.
 */
$sql_dati_kyoto = "
    INSERT IGNORE INTO `$tabella_kyoto`
        (
            id_kyoto,
            id_viaggio,
            categoria,
            data_partenza,
            data_rientro,
            costo
        )
    VALUES
        (1, 1, 'low cost', '03-03-2026', '07-03-2026', 1500.00)
";

if (!$conn->query($sql_dati_kyoto)) {
    die("Errore nell'inserimento dei dati Kyoto: " . $conn->error);
}

/*
 * Inserimento delle offerte Reykjavik.
 */
$sql_dati_reykjavik = "
    INSERT IGNORE INTO `$tabella_reykjavik`
        (
            id_reykjavik,
            id_viaggio,
            categoria,
            data_partenza,
            data_rientro,
            costo
        )
    VALUES
        (1, 3, 'low cost', '11/10/2026', '16/10/2026', 1000.00),
        (2, 4, 'low cost', '04/04/2027', '10/04/2027', 500.00)
";

if (!$conn->query($sql_dati_reykjavik)) {
    die(
        "Errore nell'inserimento dei dati Reykjavik: "
        . $conn->error
    );
}

/*
 * Inserimento dell'offerta Los Angeles.
 */
$sql_dati_losangeles = "
    INSERT IGNORE INTO `$tabella_losangeles`
        (
            id_losangeles,
            id_viaggio,
            categoria,
            data_partenza,
            data_rientro,
            costo
        )
    VALUES
        (1, 5, 'low cost', '04/09/2026', '10/09/2027', 2000.00)
";

if (!$conn->query($sql_dati_losangeles)) {
    die(
        "Errore nell'inserimento dei dati Los Angeles: "
        . $conn->error
    );
}

$conn->close();

echo "Installazione completata correttamente: database, tabelle e dati iniziali creati.";