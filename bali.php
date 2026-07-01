<?php
require_once 'connection.php';
//Controllo se l'utente è loggato
if (!isset($_SESSION['email']) || !isset($_SESSION['id_cliente'])) {
    die("Errore: utente non loggato.");
}
$id_cliente = $_SESSION['id_cliente'];
$email = $_SESSION['email'];

// Recupero id_cliente dal login
$sql = "SELECT id_cliente FROM cliente WHERE email = ?";
$stmtUser = $conn->prepare($sql);
$stmtUser->bind_param("s", $email);
$stmtUser->execute();
$resUser = $stmtUser->get_result();

if ($rowUser = $resUser->fetch_assoc()) {
    $id_cliente = $rowUser['id_cliente'];
} else {
    die("Errore: impossibile trovare il cliente.");
}

//Aggiungi prenotazione
if (isset($_POST['aggiungi_prenotazione'])) {

    $id_bali = $_POST['id_bali'];

    // Recupero informazioni sul viaggio
    $query = "SELECT categoria, costo FROM bali WHERE id_bali = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_bali);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {

        $destinazione = "Bali";
        $categoria = $row['categoria'];
        $costo = $row['costo'];

        // Controllo se l'utente ha già questa prenotazione
        $check = "SELECT id_prenotazione FROM prenotazione 
                  WHERE id_cliente = ? AND id_bali = ?";
        $stmtCheck = $conn->prepare($check);
        $stmtCheck->bind_param("ii", $id_cliente, $id_bali);
        $stmtCheck->execute();
        $resCheck = $stmtCheck->get_result();

        // Se non esiste, la inserisco
        if ($resCheck->num_rows == 0) {

            $insert = "INSERT INTO prenotazione 
                       (id_cliente, destinazione, categoria, costo, id_bali)
                       VALUES (?, ?, ?, ?, ?)";
            $stmt2 = $conn->prepare($insert);
            $stmt2->bind_param("issdi", $id_cliente, $destinazione, $categoria, $costo, $id_bali);
            $stmt2->execute();
        }

        header("Location: prenotazione.php");
        exit;
    } else {
        echo "<script>alert('Errore: viaggio di Kyoto non trovato.');</script>";
    }
}

// Mostro i viaggi disponibili
$query = "SELECT * FROM bali ORDER BY id_bali ASC";
$result = $conn->query($query);
?>
<?xml version="1.0" encoding="UTF-8"?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">

<head>
<title>Kyoto - Destinazioni</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="css\style3.css" />
</head>
<body>
<div class="container">
    <h1>Viaggio a Bali</h1>
    <table>
        <thead>
            <tr>
                <th>Destinazione</th>
                <th>Categoria</th>
                <th>Data di partenza</th>
                <th>Data di ritorno</th>
                <th>Costo</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td>Bali</td>
                <td><?= $row['categoria'] ?></td>
                <td><?= $row['data_partenza'] ?></td>
                <td><?= $row['data_rientro'] ?></td>
                <td><?= number_format($row['costo'], 2) ?>€</td>

                <td>
                    <form method="post">
                        <input type="hidden" name="id_bali" value="<?= $row['id_bali'] ?>">
                        <button type="submit" name="aggiungi_prenotazione" class="btn">
                            Aggiungi al carrello
                        </button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>

        </tbody>
    </table>

    <button onclick="window.location.href='destinazioni2.php'" class="btn">
        ⬅️ Indietro
    </button>
</div>

</body>
</html>
<?php $conn->close(); ?>