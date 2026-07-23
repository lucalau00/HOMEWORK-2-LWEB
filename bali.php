<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Bali - Destinazioni</title>

    <link
        rel="stylesheet"
        type="text/css"
        href="css/style3.css"
    >
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
                    <th>Azione</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>Bali</td>
                    <td>low cost</td>
                    <td>04/05/2027</td>
                    <td>10/05/2027</td>
                    <td>500.00 €</td>

                    <td>
                        <form method="post">
                            <input
                                type="hidden"
                                name="id_bali"
                                value="1"
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