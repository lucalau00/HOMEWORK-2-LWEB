<?php

session_start();

require_once __DIR__ . "/connection.php";

$errore = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $password_inserita = $_POST["password"] ?? "";

    if ($email === "" || $password_inserita === "") {
        $errore = "Inserisci email e password.";
    } else {

        $sql = "
            SELECT id_cliente, email, password
            FROM `$tabella_cliente`
            WHERE email = ?
        ";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die(
                "Errore nella preparazione della query: "
                . htmlspecialchars($conn->error)
            );
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();

        $risultato = $stmt->get_result();

        if ($risultato->num_rows === 1) {

            $utente = $risultato->fetch_assoc();

            if (
                password_verify(
                    $password_inserita,
                    $utente["password"]
                )
            ) {
                $_SESSION["id_cliente"] = $utente["id_cliente"];
                $_SESSION["email"] = $utente["email"];

                $stmt->close();
                $conn->close();

                header("Location: home2.php");
                exit;
            }
        }

        $errore = "Email o password non corretti.";

        $stmt->close();
    }
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

    <title>Login</title>

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

            <?php if ($errore !== ""): ?>

                <p class="messaggio">
                    <?php
                    echo htmlspecialchars(
                        $errore,
                        ENT_QUOTES,
                        "UTF-8"
                    );
                    ?>
                </p>

            <?php endif; ?>

            <form
                method="post"
                class="login-form"
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

                <button type="submit" class="btn">
                    Accedi
                </button>

                <p class="signup">
                    Non hai un account?
                </p>

                <a href="account.php" class="btn">
                    Crea account
                </a>

            </form>

        </div>

    </div>

</body>
</html>