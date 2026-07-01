<?php
require_once 'connection.php';
// Visualizzo errori
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Controllo se l'utente è loggato
if (!isset($_SESSION['email'])) {
    die("Errore: utente non loggato.");
}
$email = $_SESSION['email'];

// Recupero id_cliente
$sqlCliente = "SELECT id_cliente FROM cliente WHERE email = ?";
$stmtCliente = $conn->prepare($sqlCliente);
$stmtCliente->bind_param("s", $email);
$stmtCliente->execute();
$resCliente = $stmtCliente->get_result();

if ($rowCliente = $resCliente->fetch_assoc()) {
    $id_cliente = $rowCliente['id_cliente'];
} else {
    die("Errore: impossibile trovare il cliente.");
}

//Quesy di storico pagamenti
$sqlStorico = "SELECT id_pagamento,
                      data AS data_pagamento,
                      importo,
                      esito
               FROM pagamento
               WHERE id_cliente = ?
               ORDER BY data DESC";

$stmtStorico = $conn->prepare($sqlStorico);
$stmtStorico->bind_param("i", $id_cliente);
$stmtStorico->execute();
$resultStorico = $stmtStorico->get_result();
?>
<?xml version="1.0" encoding="UTF-8"?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">

<head>
<title>Storico viaggi</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="css\style4.css" />
</head>

<body>
<div class="container">
    <h1>Storico dei tuoi pagamenti</h1>
    <table>
        <thead>
        <tr>
            <th>ID Pagamento</th>
            <th>Data</th>
            <th>Importo</th>
            <th>Esito</th>
        </tr>
        </thead>
        <tbody>
        <?php if ($resultStorico->num_rows === 0): ?>
            <tr>
                <td colspan="4">Non hai ancora effettuato nessun pagamento.</td>
            </tr>
        <?php else: ?>
            <?php while ($row = $resultStorico->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id_pagamento']) ?></td>
                    <td><?= htmlspecialchars($row['data_pagamento']) ?></td>
                    <td><?= number_format($row['importo'], 2) ?>€</td>
                    <td><?= htmlspecialchars($row['esito']) ?></td>
                </tr>
            <?php endwhile; ?>
        <?php endif; ?>
        </tbody>
    </table>
    <div class="bottoni-fine">
        <a href="home2.php" class="btn">⬅️ Torna alla home</a>
    </div>
</div>
</body>
</html>
<?php
$conn->close();
?>