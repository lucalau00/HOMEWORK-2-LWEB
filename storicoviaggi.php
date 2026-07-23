<?php

session_start();

require_once __DIR__ . "/connection.php";

// Controllo se l'utente è loggato
if (
    !isset($_SESSION["email"]) ||
    !isset($_SESSION["id_cliente"])
) {
    die("Errore: utente non loggato.");
}

$email = $_SESSION["email"];
$id_cliente = (int) $_SESSION["id_cliente"];

// Recupero e verifica dell'id cliente
$sqlCliente = "
    SELECT id_cliente
    FROM `$tabella_cliente`
    WHERE email = ?
";

$stmtCliente = $conn->prepare($sqlCliente);

if (!$stmtCliente) {
    die(
        "Errore nella preparazione della query cliente: "
        . $conn->error
    );
}

$stmtCliente->bind_param("s", $email);
$stmtCliente->execute();

$resCliente = $stmtCliente->get_result();

if ($rowCliente = $resCliente->fetch_assoc()) {
    $id_cliente = (int) $rowCliente["id_cliente"];
} else {
    die("Errore: impossibile trovare il cliente.");
}

$stmtCliente->close();

// Query dello storico pagamenti
$sqlStorico = "
    SELECT
        id_pagamento,
        data AS data_pagamento,
        importo,
        esito
    FROM `$tabella_pagamento`
    WHERE id_cliente = ?
    ORDER BY data DESC, id_pagamento DESC
";

$stmtStorico = $conn->prepare($sqlStorico);

if (!$stmtStorico) {
    die(
        "Errore nella preparazione dello storico: "
        . $conn->error
    );
}

$stmtStorico->bind_param("i", $id_cliente);
$stmtStorico->execute();

$resultStorico = $stmtStorico->get_result();

?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Storico viaggi</title>

    <link
        rel="stylesheet"
        type="text/css"
        href="css/style4.css"
    >
</head>

<body>

    <div class="container">

        <h1>Storico dei tuoi pagamenti</h1>

        <table>
            <thead>
                <tr>
                    <th>ID pagamento</th>
                    <th>Data</th>
                    <th>Importo</th>
                    <th>Esito</th>
                </tr>
            </thead>

            <tbody>

                <?php if ($resultStorico->num_rows === 0): ?>

                    <tr>
                        <td colspan="4">
                            Non hai ancora effettuato nessun pagamento.
                        </td>
                    </tr>

                <?php else: ?>

                    <?php while ($row = $resultStorico->fetch_assoc()): ?>

                        <?php
                        $data_grezza = (string) $row["data_pagamento"];

                        if (
                            strlen($data_grezza) === 8 &&
                            ctype_digit($data_grezza)
                        ) {
                            $data_formattata =
                                substr($data_grezza, 6, 2)
                                . "/"
                                . substr($data_grezza, 4, 2)
                                . "/"
                                . substr($data_grezza, 0, 4);
                        } else {
                            $data_formattata = $data_grezza;
                        }
                        ?>

                        <tr>
                            <td>
                                <?php
                                echo (int) $row["id_pagamento"];
                                ?>
                            </td>

                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $data_formattata,
                                    ENT_QUOTES,
                                    "UTF-8"
                                );
                                ?>
                            </td>

                            <td>
                                <?php
                                echo number_format(
                                    (float) $row["importo"],
                                    2,
                                    ",",
                                    "."
                                );
                                ?>
                                €
                            </td>

                            <td>
                                <?php
                                echo htmlspecialchars(
                                    $row["esito"],
                                    ENT_QUOTES,
                                    "UTF-8"
                                );
                                ?>
                            </td>
                        </tr>

                    <?php endwhile; ?>

                <?php endif; ?>

            </tbody>
        </table>

        <div class="bottoni-fine">
            <a href="home2.php" class="btn">
                ⬅ Torna alla home
            </a>
        </div>

    </div>

</body>
</html>

<?php

$resultStorico->free();
$stmtStorico->close();
$conn->close();

?>