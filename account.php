<?php

require_once __DIR__ . "/connection.php";

$messaggio = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $CF = trim($_POST["CF"] ?? "");
    $nome = trim($_POST["nome"] ?? "");
    $cognome = trim($_POST["cognome"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password_chiara = $_POST["password"] ?? "";
    $telefono = trim($_POST["telefono"] ?? "");
    $data = trim($_POST["data"] ?? "");

    if (
        $CF === "" ||
        $nome === "" ||
        $cognome === "" ||
        $email === "" ||
        $password_chiara === "" ||
        $telefono === "" ||
        $data === ""
    ) {
        $messaggio = "Compila tutti i campi obbligatori.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $messaggio = "Inserisci un indirizzo email valido.";
    } else {

        $sql_controllo = "
            SELECT id_cliente
            FROM `$tabella_cliente`
            WHERE email = ?
        ";

        $stmt = $conn->prepare($sql_controllo);

        if (!$stmt) {
            die("Errore nella preparazione della query: " . $conn->error);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $messaggio = "L'email è già presente. Scegli un'altra email.";
        } else {

            $password_hash = password_hash(
                $password_chiara,
                PASSWORD_DEFAULT
            );

            $sql_inserimento = "
                INSERT INTO `$tabella_cliente`
                    (
                        CF,
                        nome,
                        cognome,
                        data_nascita,
                        telefono,
                        email,
                        password
                    )
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ";

            $insert_stmt = $conn->prepare($sql_inserimento);

            if (!$insert_stmt) {
                die(
                    "Errore nella preparazione dell'inserimento: "
                    . $conn->error
                );
            }

            $insert_stmt->bind_param(
                "sssssss",
                $CF,
                $nome,
                $cognome,
                $data,
                $telefono,
                $email,
                $password_hash
            );

            if ($insert_stmt->execute()) {
                $insert_stmt->close();
                $stmt->close();
                $conn->close();

                header("Location: login.php");
                exit;
            }

            $messaggio = "Errore durante la registrazione.";

            $insert_stmt->close();
        }

        $stmt->close();
    }
}

$conn->close();

$azione_form = htmlspecialchars(
    $_SERVER["PHP_SELF"],
    ENT_QUOTES,
    "UTF-8"
);

?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Iscriviti</title>

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

            <?php if ($messaggio !== ""): ?>

                <p class="messaggio">
                    <?php
                    echo htmlspecialchars(
                        $messaggio,
                        ENT_QUOTES,
                        "UTF-8"
                    );
                    ?>
                </p>

            <?php endif; ?>

            <form
                action="<?php echo $azione_form; ?>"
                method="post"
                class="login-form"
            >

                <label for="CF">Codice fiscale</label>

                <input
                    type="text"
                    id="CF"
                    name="CF"
                    maxlength="16"
                    placeholder="Inserisci codice fiscale"
                    required
                >

                <label for="nome">Nome</label>

                <input
                    type="text"
                    id="nome"
                    name="nome"
                    placeholder="Inserisci nome"
                    required
                >

                <label for="cognome">Cognome</label>

                <input
                    type="text"
                    id="cognome"
                    name="cognome"
                    placeholder="Inserisci cognome"
                    required
                >

                <label for="email">Email</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Inserisci email"
                    required
                >

                <label for="password">Password</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Inserisci password"
                    required
                >

                <label for="telefono">Telefono</label>

                <input
                    type="tel"
                    id="telefono"
                    name="telefono"
                    placeholder="Inserisci numero di telefono"
                    required
                >

                <label for="data">Data di nascita</label>

                <input
                    type="date"
                    id="data"
                    name="data"
                    required
                >

                <button type="submit" class="btn">
                    Iscriviti
                </button>

            </form>

        </div>

    </div>

</body>
</html>