<?php

session_start();

require_once __DIR__ . "/connection.php";

?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <title>Destinazioni - Viaggio dei Sogni</title>

    <link
        rel="stylesheet"
        type="text/css"
        href="css/style.css"
    >
</head>

<body>

    <h1>LE MIE DESTINAZIONI DA SOGNO</h1>

    <div>
        <ul>
            <li>
                <a href="home2.php">
                    <strong>HOME</strong>
                </a>
            </li>

            <li>
                <a href="Itinerario2.xhtml">
                    <strong>ITINERARI</strong>
                </a>
            </li>

            <li>
                <a href="chi_siamo2.xhtml">
                    <strong>CHI SIAMO</strong>
                </a>
            </li>

            <li>
                <a href="last_minute2.xhtml">
                    <strong>LAST MINUTE</strong>
                </a>
            </li>

            <li>
                <a href="storicoviaggi.php">
                    <strong>STORICO VIAGGI</strong>
                </a>
            </li>

            <li>
                <a href="Home.xhtml">
                    <strong>LOGOUT</strong>
                </a>
            </li>
        </ul>
    </div>

    <div id="contenuto">

        <h2>Kyoto, Giappone</h2>

        <a href="kyoto.php">
            <img
                src="Immagini/img_kyoto.jpg"
                alt="Tempio di Kyoto"
                width="600"
            >
        </a>

        <p>
            Kyoto è famosa per i suoi templi antichi, i giardini zen
            e le tradizionali case da tè. Vorrei perdermi tra le sue
            strade storiche e partecipare a una cerimonia del tè autentica.
        </p>

        <br>
        <hr>
        <br>

        <h2>Reykjavík, Islanda</h2>

        <a href="reykjavik.php">
            <img
                src="Immagini/img_reykjavik.jpg"
                alt="Paesaggio islandese"
                width="600"
            >
        </a>

        <p>
            La capitale islandese è il punto di partenza perfetto per
            esplorare geyser, cascate e l'aurora boreale. Sogno di fare
            un viaggio avventuroso immerso nella natura incontaminata.
        </p>

        <br>
        <hr>
        <br>

        <h2>Bali, Indonesia</h2>

        <a href="bali.php">
            <img
                src="Immagini/bali2.jpg"
                alt="Immagine di Bali"
                width="600"
            >
        </a>

        <p>
            L'isola degli dei è il punto di partenza perfetto per
            scoprire templi suggestivi, risaie verdi e spiagge da sogno.
            Sogno di vivere un viaggio rigenerante tra natura,
            spiritualità e tramonti mozzafiato.
        </p>

        <br>
        <hr>
        <br>

        <h2>Los Angeles &amp; California Coast, USA</h2>

        <a href="losangeles.php">
            <img
                src="Immagini/losangeles2.jpg"
                alt="Immagine di Los Angeles"
                width="600"
            >
        </a>

        <p>
            La città degli angeli è il luogo ideale per partire alla
            scoperta di spiagge iconiche, quartieri vivaci e il fascino
            di Hollywood. Sogno un'avventura tra creatività, sole e
            atmosfere californiane uniche.
        </p>

    </div>

    <div>
        <p>
            © 2025 Viaggio dei Sogni | Creato da Luca e Danila
        </p>
    </div>

</body>
</html>