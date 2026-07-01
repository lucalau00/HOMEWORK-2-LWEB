Titolo del progetto:
Sito web dinamico di un'Agenzia di Viaggi – Homework 2

Descrizione dell’esercizio:
Questo progetto estende il lavoro svolto nell’Homework 1, trasformando il sito statico in un sito web dinamico tramite l’utilizzo di PHP e MySQL. 
L’obiettivo è integrare le basi di XHTML e CSS con funzionalità lato server, gestione dei dati e interazione con un database realizzato tramite phpMyAdmin.

Il sito permette ora di:
- Visualizzare destinazioni e itinerari
- Effettuare login e registrazione
- Prenotare uno o più viaggi
- Rimuovere preotazioni
- Visualizzare lo storico dei viaggi
- Simulare pagamenti e operazioni lato utente

Tecnologie utilizzate:
- XHTML per la struttura delle pagine
- CSS per la presentazione grafica e il layout
- PHP per la logica lato server e l’interazione con il database
- MySQL (phpMyAdmin) per la gestione e memorizzazione dei dati

Concetti applicati:
Durante lo sviluppo sono stati messi i pratica gli argomenti introdotti nelle lezioni, tra cui:
- Struttura XHTML e validazione
- Fogli di stile CSS  
- Connessione a un database MySQL tramite PHP
- Query SQL di base 
- Gestione di form e autenticazione utente

Funzionalità implementate:
- Login e registrazione utenti 
- Visualizzazione dinamica delle destinazioni 
- Pagina Home dinamica 
- Sistema di prenotazione 
- Pagamento simulato 
- Storico viaggi dell’utente 

Struttura del database:
Il database, creato tramite phpMyAdmin, contiene le principali tabelle necessarie al funzionamento del sito, tra cui:
- Tabella clienti 
- Tabella pagamento
- Tabella prenotazione
- Tabella viaggio
- Altre tabelle utili per la gestione del DB

Le tabelle sono state popolate con dati di esempio per permettere la navigazione completa del sito.

Caratteristiche XHTML e CSS messe alla prova:
- Struttura XHTML valida e coerente
- Utilizzo di liste, tabelle e immagini
- Collegamenti tra pagine statiche e dinamiche
- Layout uniforme tramite CSS
- Gestione di margini, padding, bordi e colori
- Stile coerente tra pagine HTML e PHP

Caratteristiche PHP e SQL messe alla prova:
- Connessione al database tramite mysql
- Query SQL per recupero, inserimento e modifica dei dati
- Gestione delle sessioni utente
- Validazione dei form
- Interazione dinamica tra pagine PHP e database

Pagine principali del sito:
- home2.php — Home dinamica dell’agenzia
- destinazioni2.php (bali.php, kyoto.php, reykjavik.php, losangeles.php)— Destinazioni caricate dal database
- prenotazione.php — Insieme delle destinazione scelte dall'utente
- pagaora.php — Pagamento simulato
- storicoviaggi.php — Storico delle prenotazioni
- login.php — Accesso utenti
- account.php — Registrazione nuovo utente
- connection.php - serve per collegare il sito al database
- Pagine XHTML statiche ereditate dall’Homework 1 (Home.xhtml, Chi_siamo.xhtml, destinazioni.xhtml, itinerario.xhtml, Last_minut.xhtml, meteestive.xhtml, meteinvernali.xhtml )
- le pagine chi_siamo2, itinerario2.xhtml e last_minute2.xhtml sono identiche alle pagine 1, ma necessarie per permettere di avere la parte di "area personale"

Come funziona il sito:
Il sito simula il funzionamento di un'agenzia di viaggi online.
All'avvio viene mostrata la Home Page (Home.xhtml), dalla quale è possibile accedere alle sezioni Destinazioni, Itinerari, Chi siamo, Last Minute e Login.
Gli utenti non ancora registrati possono creare un nuovo account tramite la pagina di registrazione.php. Dopo aver effettuato il login (login.php), l'utente accede alla propria area personale (home2.php), nella quale il pulsante Login viene sostituito da Logout e compare la sezione Storico Viaggi (storicoviaggi.php).
Una volta autenticato, l'utente può visualizzare le destinazioni disponibili (destinazioni2.php), prenotare un viaggio (prenotazione.php), simulare il pagamento (pagamento.php) e consultare lo storico delle proprie prenotazioni. Al termine della navigazione è possibile effettuare il logout, che chiude la sessione e riporta il sito allo stato iniziale.

Problemi riscontrati:
1. Verifica delle credenziali, cioè controllare che l'email inserita fosse presente nel database e che la password corrispondesse. Per riaolvere questo problema abbiamo eseguito una query SELECT per cercare quel utente e successivamente è stata utilizzata la funzione password_verify() per confrontare la password inserita con qulla registrata nel database.
2. Reindirizzamento dopo il login, cioè dopo l'autenticazione è necessario far accedere l'utente alla propria area personale. Per fare ciò abbiamo utilizzato la funzione "header("Location:home2.php), che reindirizza l'utente alla home dinamica dove è presente la sua area personale.
3. Calcolo totale delle prenotazioni, cioè determinare automaticamente il costo complessivo dei viaggi presente nella prenotazione. Per risolvere il problema abbiamo utilizzato un ciclo while che legge ogni record e somma il valore del campo "costo" nella variabile $totale.
4. Rimozione di una prenotazione, cioè consentire all'utente di eliminare una singola prenotazione. La soluzione a questo problema è stata creare un pulsante "rimuovi" per ogni prenotazione selezionata, il quale invia l'id_prenotazione tramite un form. La cancellazione viene eseguita con una query DELETE e verificando anche l'id_cliente in modo tale che ogni cliente elimini solo ed esclusivamente le proprie prenotazioni.
5. Registrare il pagamento nel database, cioè era necessario salvare nel database le informazioni relative al pagamento. Quindi per risolvere il problema abbiamo messo una query INSERT che inserisce automaticamente il pagamento nella tabella del db.

Autori:
- Danila Gatto (https://github.com/danilagatto/HOMEWORK2-LWEB)
- Luca Lauretti (https://github.com/lucalau00/HOMEWORK-2-LWEB)