<?php
session_start();
//Connessione al database
$host = "localhost";
$user = "root"; 
$pass = ""; 
$dbname = "homework2";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
?>