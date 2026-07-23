<?php

require_once __DIR__ . "/dati_generali.php";

$conn = new mysqli(
    $host,
    $utente,
    $password,
    $nome_database
);

if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>