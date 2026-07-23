<?php

session_start();

require_once __DIR__ . "/connection.php";

// Recupero id_cliente dalla sessione
if (!isset($_SESSION["id_cliente"])) {
    die("Errore: utente non loggato.");
}

$id_cliente = (int) $_SESSION["id_cliente"];

// Se arrivo dalla pagina pagaora.php, pulisco l'eventuale totale precedente
if (basename($_SERVER["HTTP_REFERER"] ?? "") === "pagaora.php") {
    unset($_SESSION["totale_pagamento"]);
}

// Rimozione prenotazione dal carrello
if (isset($_POST["rimuovi"])) {

    $id_prenotazione = isset($_POST["id_prenotazione"])
        ? (int) $_POST["id_prenotazione"]
        : 0;

    $delete = "
        DELETE FROM `$tabella_prenotazione`
        WHERE id_prenotazione = ?
          AND id_cliente = ?
    ";

    $stmtDel = $conn->prepare($delete);

    if (!$stmtDel) {
        die(
            "Errore nella preparazione della cancellazione: "
            . $conn->error
        );
    }

    $stmtDel->bind_param(
        "ii",
        $id_prenotazione,
        $id_cliente
    );

    $stmtDel->execute();
    $stmtDel->close();

    header("Location: prenotazione.php");
    exit;
}

// Recupero delle prenotazioni dell'utente
$sql = "
    SELECT
        id_prenotazione,
        destinazione,
        categoria,
        costo
    FROM `$tabella_prenotazione`
    WHERE id_cliente = ?
    ORDER BY id_prenotazione ASC
";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die(
        "Errore nella preparazione della query: "
        . $conn->error
    );
}

$stmt->bind_param("i", $id_cliente);
$stmt->execute();

$result = $stmt->get_result();

$prenotazioni = [];
$totale = 0.0;

while ($r = $result->fetch_assoc()) {
    $prenotazioni[] = $r;
    $totale += (float) $r["costo"];
}

// Memorizzo il totale in sessione per la pagina di pagamento
$_SESSION["totale_pagamento"] = $totale;

?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Prenotazione</title>

    <link
        rel="stylesheet"
        type="text/css"
        href="css/style4.css"
    >
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
                        <td colspan="4">
                            Nessuna prenotazione presente.
                        </td>
                    </tr>

                <?php else: ?>

                    <?php foreach ($prenotazioni as $p): ?>

                        <tr>
                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $p["destinazione"],
                                    ENT_QUOTES,
                                    "UTF-8"
                                );
                                ?>
                            </td>

                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $p["categoria"],
                                    ENT_QUOTES,
                                    "UTF-8"
                                );
                                ?>
                            </td>

                            <td>
                                <?php
                                echo number_format(
                                    (float) $p["costo"],
                                    2,
                                    ",",
                                    "."
                                );
                                ?>
                                €
                            </td>

                            <td>
                                <form
                                    method="post"
                                    style="display: inline;"
                                >
                                    <input
                                        type="hidden"
                                        name="id_prenotazione"
                                        value="<?php
                                        echo (int) $p["id_prenotazione"];
                                        ?>"
                                    >

                                    <button
                                        type="submit"
                                        name="rimuovi"
                                        class="btn btn-danger"
                                    >
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
            Totale:
            <?php
            echo number_format(
                $totale,
                2,
                ",",
                "."
            );
            ?>
            €
        </div>

        <div class="bottoni-fine">

            <a href="destinazioni2.php" class="btn">
                ⬅ Torna ai viaggi
            </a>

            <a href="pagaora.php" class="btn">
                💳 Procedi al pagamento
            </a>

        </div>

    </div>

</body>
</html>

<?php

$result->free();
$stmt->close();
$conn->close();

?>