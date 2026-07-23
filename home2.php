<?php

session_start();

require_once __DIR__ . "/connection.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">

<head>
<title>Viaggio dei Sogni</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="css\style.css" />
</head>

<body>
    <h1>
        TRAVELUP
    </h1>
        <div>
            <ul>
                <li><a href="destinazioni2.php"><strong>DESTINAZIONI</strong></a></li>
                <li><a href="Itinerario2.xhtml"><strong>ITINERARI</strong></a></li>
                <li><a href="chi_siamo2.xhtml"><strong>CHI SIAMO</strong></a></li>
                <li><a href ="last_minute2.xhtml"> <strong>LAST MINUTE</strong></a></li>
                <li><a href ="storicoviaggi.php"> <strong>STORICO VIAGGI</strong></a></li>
                <li><a href ="Home.xhtml"><strong>LOGOUT</strong></a></li>
            </ul>
        </div>
    

    <div id="contenuto">
        <h2> Benvenuti nel mio Viaggio dei Sogni!</h2>
        <p>Scopri i luoghi che sogno di visitare e lasciati ispirare anche tu per il tuo prossimo viaggio.</p>
        <img src="Immagini/imgviaggio.jpg" alt="Panorama di viaggio" width="600" />
    </div>

    <hr/>
    
    <h3> Scopri il mondo con noi! 🌍 </h3>
        <p>La nostra agenzia di viaggi ti offre <strong>esperienze indimenticabili</strong>, prezzi competitivi e assistenza continua. Che sia una fuga romantica, un’avventura esotica o un weekend rilassante, con noi partire è semplice e sicuro. Prenota oggi il tuo prossimo viaggio: <strong>il mondo ti aspetta!</strong> </p>
           
<hr/>

<p> <strong> Clicca sulle immagini per saperne di più </strong></p>
    <ul class="cards">
        <li class="card">
            <h3> LE NOSTRE DESTINAZIONI LAST MINUTE</h3>
            <a href="Last_minut.xhtml">
                <img src="Immagini/lastminute2.jpg" height="200" width="200" alt="lastminute.jpg" />
            </a>
        </li>

        <li class="card">
            <h3> LE NOSTRE DESTINAZIONI INVERNALI </h3>
            <a href="meteinvernali.xhtml">
                <img src="Immagini/invernali.jpg" height="200" width="200" alt="invernali.jpg" />
            </a>
        </li>

        <li class="card">
            <h3> LE NOSTRE DESTINAZIONI ESTIVE</h3>
            <a href="meteestive.xhtml">
                <img src="Immagini/estive.jpg" height="200" width="200" alt="estive.jpg" />
            </a>
        </li>
        
    </ul>

    <div>
        <p>© 2025 Viaggio dei Sogni | Creato da [Luca e Danila]</p>
    </div>

</body>
</html>