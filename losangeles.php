<?php

session_start();

require_once __DIR__ . "/connection.php";

// Controllo se l'utente è loggato
if (!isset($_SESSION["email"]) || !isset($_SESSION["id_cliente"])) {
    die("Errore: utente non loggato.");
}

$id_cliente = (int) $_SESSION["id_cliente"];
$email = $_SESSION["email"];

// Recupero ID cliente dal login
$sql = "
    SELECT id_cliente
    FROM `$tabella_cliente`
    WHERE email = ?
";

$stmtUser = $conn->prepare($sql);

if (!$stmtUser) {
    die("Errore nella preparazione della query utente: " . $conn->error);
}

$stmtUser->bind_param("s", $email);
$stmtUser->execute();

$resUser = $stmtUser->get_result();

if ($rowUser = $resUser->fetch_assoc()) {
    $id_cliente = (int) $rowUser["id_cliente"];
} else {
    die("Errore: impossibile trovare il cliente.");
}

$stmtUser->close();

// Aggiunta alla prenotazione
if (isset($_POST["aggiungi_prenotazione"])) {

    $id_losangeles = isset($_POST["id_losangeles"])
        ? (int) $_POST["id_losangeles"]
        : 0;

    // Recupero informazioni sul viaggio
    $query = "
        SELECT categoria, costo
        FROM `$tabella_losangeles`
        WHERE id_losangeles = ?
    ";

    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die(
            "Errore nella preparazione della query Los Angeles: "
            . $conn->error
        );
    }

    $stmt->bind_param("i", $id_losangeles);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {

        $destinazione = "Los Angeles";
        $categoria = $row["categoria"];
        $costo = (float) $row["costo"];

        // Controllo se l'utente ha già questa prenotazione
        $check = "
            SELECT id_prenotazione
            FROM `$tabella_prenotazione`
            WHERE id_cliente = ?
              AND id_losangeles = ?
        ";

        $stmtCheck = $conn->prepare($check);

        if (!$stmtCheck) {
            die(
                "Errore nella preparazione del controllo prenotazione: "
                . $conn->error
            );
        }

        $stmtCheck->bind_param(
            "ii",
            $id_cliente,
            $id_losangeles
        );

        $stmtCheck->execute();

        $resCheck = $stmtCheck->get_result();

        // Se non esiste, la inserisco
        if ($resCheck->num_rows === 0) {

            $insert = "
                INSERT INTO `$tabella_prenotazione`
                    (
                        id_cliente,
                        destinazione,
                        categoria,
                        costo,
                        id_losangeles
                    )
                VALUES (?, ?, ?, ?, ?)
            ";

            $stmt2 = $conn->prepare($insert);

            if (!$stmt2) {
                die(
                    "Errore nella preparazione della prenotazione: "
                    . $conn->error
                );
            }

            $stmt2->bind_param(
                "issdi",
                $id_cliente,
                $destinazione,
                $categoria,
                $costo,
                $id_losangeles
            );

            $stmt2->execute();
            $stmt2->close();
        }

        $stmtCheck->close();
        $stmt->close();

        header("Location: prenotazione.php");
        exit;
    }

    $stmt->close();

    echo "<script>alert('Errore: viaggio di Los Angeles non trovato.');</script>";
}

// Mostro i viaggi disponibili
$query = "
    SELECT *
    FROM `$tabella_losangeles`
    ORDER BY id_losangeles ASC
";

$result = $conn->query($query);

if (!$result) {
    die(
        "Errore nel recupero dei viaggi Los Angeles: "
        . $conn->error
    );
}

?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Los Angeles - Destinazioni</title>

    <link
        rel="stylesheet"
        type="text/css"
        href="css/style3.css"
    >
</head>

<body>

    <div class="container">

        <h1>Viaggio a Los Angeles</h1>

        <table>
            <thead>
                <tr>
                    <th>Destinazione</th>
                    <th>Categoria</th>
                    <th>Data di partenza</th>
                    <th>Data di ritorno</th>
                    <th>Costo</th>
                    <th>Azione</th>
                </tr>
            </thead>

            <tbody>

                <?php while ($row = $result->fetch_assoc()): ?>

                    <tr>
                        <td>Los Angeles</td>

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $row["categoria"],
                                ENT_QUOTES,
                                "UTF-8"
                            );
                            ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $row["data_partenza"],
                                ENT_QUOTES,
                                "UTF-8"
                            );
                            ?>
                        </td>

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $row["data_rientro"],
                                ENT_QUOTES,
                                "UTF-8"
                            );
                            ?>
                        </td>

                        <td>
                            <?php
                            echo number_format(
                                (float) $row["costo"],
                                2,
                                ",",
                                "."
                            );
                            ?>
                            €
                        </td>

                        <td>
                            <form method="post">
                                <input
                                    type="hidden"
                                    name="id_losangeles"
                                    value="<?php
                                    echo (int) $row["id_losangeles"];
                                    ?>"
                                >

                                <button
                                    type="submit"
                                    name="aggiungi_prenotazione"
                                    class="btn"
                                >
                                    Aggiungi al carrello
                                </button>
                            </form>
                        </td>
                    </tr>

                <?php endwhile; ?>

            </tbody>
        </table>

        <button
            type="button"
            onclick="window.location.href='destinazioni2.php'"
            class="btn"
        >
            ⬅ Indietro
        </button>

    </div>

</body>
</html>

<?php

$result->free();
$conn->close();

?>