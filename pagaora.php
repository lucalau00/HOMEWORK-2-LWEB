<?php
require_once 'connection.php';
// Recupero l'id del cliente dalla sessione
if (!isset($_SESSION['email'])) {
    die("Errore: utente non loggato. SESSIONE VUOTA");
}
$email = $_SESSION['email'];

$sql = "SELECT id_cliente FROM cliente WHERE email = ?";
$stmtUser = $conn->prepare($sql);
$stmtUser->bind_param("s", $email);
$stmtUser->execute();
$resUser = $stmtUser->get_result();

if ($rowUser = $resUser->fetch_assoc()) {
    $id_cliente = $rowUser['id_cliente'];
} else {
    die("Errore: impossibile trovare il cliente nel DB.");
}

//  Recupera il totale da sessione
$totale = isset($_SESSION['totale_pagamento']) ? $_SESSION['totale_pagamento'] : 0;

//  Inserisce il pagamento nella tabella pagamento
if ($totale > 0) {
    $esito = "approvato";
    $insert_pagamento = "INSERT INTO pagamento (data, importo, esito, id_cliente)
                         VALUES (CURDATE(), ?, ?, ?)";
    $stmt = $conn->prepare($insert_pagamento);
    $stmt->bind_param("dsi", $totale, $esito, $id_cliente);
    $stmt->execute();
}

//Svuota il carrello
$delete = "DELETE FROM prenotazione WHERE id_cliente = ?";
$stmt4 = $conn->prepare($delete);
$stmt4->bind_param("i", $id_cliente);
$stmt4->execute();
?>
<?xml version="1.0" encoding="UTF-8"?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">

<head>
<title>Pagamento completato</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="css\style2.css" />
</head>

<body>

<div class="container">
    
    <div class="left-panel">
      <img src="Immagini/login.jpg"/>
      <h2>Vivi la tua prossima avventura!</h2>
          <p>Scopri il mondo con noi, un viaggio alla volta</p>
    </div>

    
    <div class="right-panel">
    <h1 class="logo">Scopri. Esplora. Vivi.</h1>
    <h2>Benvenuti a TravelUp!</h2>

        <div style="text-align:center;">
            <h2>
                <strong>✨CONGRATULAZIONI!!✨</strong><br/>
                IL PAGAMENTO È ANDATO A BUON FINE
            </h2>
            <p style="font-size: 18px;">Importo pagato: <strong><?= number_format($totale, 2) ?>€</strong></p>
            <p style="color: gray;">Esito: <?= $esito ?></p>

            <div class="contenitore-bottoni-fine">
                <button type="button" onclick="window.location.href='prenotazione.php'" class="btn btn-sinistra">
                    ⬅️ Torna al carrello
                </button>
                <button type="button" onclick="window.location.href='home2.php'" class="btn btn-sinistra">
                    🏠 Torna alla Homepage
                </button>
                </div> 
        </div>
    </div>
</div>
</body>
</html>