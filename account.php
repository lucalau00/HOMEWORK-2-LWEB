<?php
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
          
    // Prendi i dati dal form
    $CF= isset($_POST['CF']) ? $_POST['CF'] : '';
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $cognome = isset($_POST['cognome']) ? $_POST['cognome'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
    $data = isset($_POST['data']) ? $_POST['data'] : '';
   
    // Controllo se l'username esiste già
    $stmt = $conn->prepare("SELECT id_cliente FROM cliente WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Username già esistente
        echo "<p>L'email è già presente. Scegli un'altra email.</p>";
    } else {
        // Inserisci i dati nel database
        $sql_utente = "INSERT INTO cliente (CF, nome, cognome, data_nascita, telefono, email, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($sql_utente);
        $insert_stmt->bind_param("sssssss", $CF, $nome, $cognome,  $data, $telefono, $email, $password);

        if ($insert_stmt->execute()) {
           
            // Prendi l'ultimo ID utente inserito
            $utente_id = $conn->insert_id;

            header("Refresh: 3; URL=login.php");
            exit(); 
        
        } else {
           
            echo "<p>Errore nell'inserimento dell'utente: " . $insert_stmt->error . "</p>";
        }
    }

    $stmt->close();
    $conn->close();
}
?>
<?xml version="1.0" encoding="UTF-8"?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">

<head>
<title>Iscriviti</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="css\style2.css" />
</head>
<body style="background-color:rgb(250, 247, 235)">

    <div class="container">
       
        <div class="left-panel">
        <img src="Immagini/login.jpg" /> 
          <h2>Vivi la tua prossima avventura!</h2>
          <p>Scopri il mondo con noi, un viaggio alla volta</p>
        </div>
    
        <div class="right-panel">
        <h1 class="logo">Scopri. Esplora. Vivi.</h1>
        <h2>Benvenuti a TravelUp!</h2>
        

          <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="login-form">

            <label for="CF">Codice Fiscale</label>
            <input type="text" id="CF" name="CF" placeholder="Inserisci Codice Fiscale" required>

            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Inserisci Nome" required>

            <label for="cognome">Cognome</label>
            <input type="text" id="cognome" name="cognome" placeholder="Inserisci Cognome" required>
    
            <label for="email">Email</label>
            <input type="text" id="email" name="email" placeholder="Inserisci Email" required>

            <label for="password">Password</label>
            <input type="text" id="password" name="password" placeholder="Inserisci Password" required>

            <label for="telefono">Telefono</label>
            <input type="text" id="telefono" name="telefono" placeholder="Inserisci numero di telefono" required>

            <label for="data">Data di nascita</label>
            <input type="date" id="data" name="data" placeholder="Inserisci data di nascita" required>
          <br/>
          <button type="submit" class="btn">Iscriviti </button> 
          </form>
        </div>
      </div>
    </body>
  </html>