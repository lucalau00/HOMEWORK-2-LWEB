<?php
require_once 'connection.php';
// Recupero id_cliente dalla sessione
if (!isset($_SESSION['id_cliente'])) {
    die("Errore: utente non loggato.");
}

$id_cliente = $_SESSION['id_cliente'];
$email = $_SESSION['email'];

// Se arrivo dalla pagina pagaora.php, pulisco l'eventuale totsle precedente
if (basename($_SERVER['HTTP_REFERER'] ?? '') === 'pagaora.php') {
    unset($_SESSION['totale_pagamento']);
}

// Rimozione prenotazione dal carrello
if (isset($_POST['rimuovi'])) {
    
    $id_prenotazione = (int)$_POST['id_prenotazione'];

    $delete = "DELETE FROM prenotazione 
               WHERE id_prenotazione = ? AND id_cliente = ?";
    $stmtDel = $conn->prepare($delete);
    $stmtDel->bind_param("ii", $id_prenotazione, $id_cliente);
    $stmtDel->execute();
    header("Location: prenotazione.php");
    exit;
}

// Recupero tutte le prenotazioni dell'utente. In base alla tabella prenotazione usiamo: id_prenotazione, destinazione, categoria, costo
$sql = "SELECT id_prenotazione, destinazione, categoria, costo 
        FROM prenotazione 
        WHERE id_cliente = ?
        ORDER BY id_prenotazione ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_cliente);
$stmt->execute();
$result = $stmt->get_result();

$prenotazioni = [];
$totale = 0;

while ($r = $result->fetch_assoc()) {
    $prenotazioni[] = $r;
    $totale += (float)$r['costo'];
}

// Memorizzo il totale in sessione per la pagina di pagamento
$_SESSION['totale_pagamento'] = $totale;
?>
<?xml version="1.0" encoding="UTF-8"?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">

<head>
<title>Prenotazione</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="css\style4.css" />
</head>

<body>
<div class="container">
    <h1>Le tue prenotazioni</h1>
    <table>
        <thead>
        <tr>
            <th>Destinazione</th>
            <th>Categoria</th>
            <th>Costo</th>
            <th>Rimuovi</th>
        </tr>
        </thead>
        <tbody>
        <?php if (count($prenotazioni) === 0): ?>
            <tr>
                <td colspan="4">Nessuna prenotazione presente.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($prenotazioni as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['destinazione']) ?></td>
                    <td><?= htmlspecialchars($p['categoria']) ?></td>
                    <td><?= number_format($p['costo'], 2) ?>€</td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="id_prenotazione"
                                   value="<?= (int)$p['id_prenotazione'] ?>">
                            <button type="submit" name="rimuovi" class="btn btn-danger">
                                Rimuovi
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

    <div class="totale">
        Totale: <?= number_format($totale, 2) ?>€
    </div>

    <div class="bottoni-fine">
        
        <a href="destinazioni2.php" class="btn">⬅️ Torna ai viaggi</a>

        <a href="pagaora.php" class="btn">💳 Procedi al pagamento</a>
    </div>
</div>
</body>
</html>
<?php
$conn->close();
?>