<?php

session_start();

require_once __DIR__ . "/connection.php";

// Controllo che l'utente sia autenticato
if (
    !isset($_SESSION["email"]) ||
    !isset($_SESSION["id_cliente"])
) {
    die("Errore: utente non loggato.");
}

$email = $_SESSION["email"];
$id_cliente = (int) $_SESSION["id_cliente"];

// Verifica dell'utente nel database
$sql_utente = "
    SELECT id_cliente
    FROM `$tabella_cliente`
    WHERE email = ?
";

$stmtUser = $conn->prepare($sql_utente);

if (!$stmtUser) {
    die(
        "Errore nella preparazione della query utente: "
        . $conn->error
    );
}

$stmtUser->bind_param("s", $email);
$stmtUser->execute();

$resUser = $stmtUser->get_result();

if ($rowUser = $resUser->fetch_assoc()) {
    $id_cliente = (int) $rowUser["id_cliente"];
} else {
    die("Errore: impossibile trovare il cliente nel database.");
}

$stmtUser->close();

// Recupero del totale memorizzato nella sessione
$totale = isset($_SESSION["totale_pagamento"])
    ? (float) $_SESSION["totale_pagamento"]
    : 0.0;

$esito = "nessun pagamento";

if ($totale > 0) {

    $esito = "approvato";

    /*
     * La colonna data del database è INT.
     * Salviamo quindi la data nel formato numerico YYYYMMDD.
     */
    $data_pagamento = (int) date("Ymd");

    $insert_pagamento = "
        INSERT INTO `$tabella_pagamento`
            (
                data,
                importo,
                esito,
                id_cliente
            )
        VALUES (?, ?, ?, ?)
    ";

    $stmtPagamento = $conn->prepare($insert_pagamento);

    if (!$stmtPagamento) {
        die(
            "Errore nella preparazione del pagamento: "
            . $conn->error
        );
    }

    $stmtPagamento->bind_param(
        "idsi",
        $data_pagamento,
        $totale,
        $esito,
        $id_cliente
    );

    if (!$stmtPagamento->execute()) {
        die(
            "Errore durante la registrazione del pagamento: "
            . $stmtPagamento->error
        );
    }

    $stmtPagamento->close();

    // Svuotamento del carrello dopo il pagamento
    $delete = "
        DELETE FROM `$tabella_prenotazione`
        WHERE id_cliente = ?
    ";

    $stmtCarrello = $conn->prepare($delete);

    if (!$stmtCarrello) {
        die(
            "Errore nella preparazione dello svuotamento del carrello: "
            . $conn->error
        );
    }

    $stmtCarrello->bind_param("i", $id_cliente);
    $stmtCarrello->execute();
    $stmtCarrello->close();

    /*
     * Elimina il totale dalla sessione.
     * Così, aggiornando la pagina, il pagamento non viene inserito di nuovo.
     */
    unset($_SESSION["totale_pagamento"]);
}

$conn->close();

?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Pagamento completato</title>

    <link
        rel="stylesheet"
        type="text/css"
        href="css/style2.css"
    >
</head>

<body>

    <div class="container">

        <div class="left-panel">

            <img
                src="Immagini/login.jpg"
                alt="Accessori dedicati ai viaggi"
            >

            <h2>Vivi la tua prossima avventura!</h2>

            <p>
                Scopri il mondo con noi, un viaggio alla volta.
            </p>

        </div>

        <div class="right-panel">

            <h1 class="logo">Scopri. Esplora. Vivi.</h1>

            <h2>Benvenuti a TravelUp!</h2>

            <div style="text-align: center;">

                <?php if ($totale > 0): ?>

                    <h2>
                        <strong>✨ CONGRATULAZIONI! ✨</strong>
                        <br>
                        IL PAGAMENTO È ANDATO A BUON FINE
                    </h2>

                    <p style="font-size: 18px;">
                        Importo pagato:
                        <strong>
                            <?php
                            echo number_format(
                                $totale,
                                2,
                                ",",
                                "."
                            );
                            ?>
                            €
                        </strong>
                    </p>

                    <p style="color: gray;">
                        Esito:
                        <?php
                        echo htmlspecialchars(
                            $esito,
                            ENT_QUOTES,
                            "UTF-8"
                        );
                        ?>
                    </p>

                <?php else: ?>

                    <h2>Nessun pagamento da effettuare</h2>

                    <p>
                        Il carrello è vuoto oppure il pagamento è già
                        stato registrato.
                    </p>

                <?php endif; ?>

                <div class="contenitore-bottoni-fine">

                    <button
                        type="button"
                        onclick="window.location.href='prenotazione.php'"
                        class="btn btn-sinistra"
                    >
                        ⬅ Torna al carrello
                    </button>

                    <button
                        type="button"
                        onclick="window.location.href='home2.php'"
                        class="btn btn-sinistra"
                    >
                        🏠 Torna alla homepage
                    </button>

                </div>

            </div>

        </div>

    </div>

</body>
</html>