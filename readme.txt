TITOLO DEL PROGETTO

Sito web dinamico di un’agenzia di viaggi – Homework 2


AUTORI

Danila Gatto
Repository GitHub:
https://github.com/danilagatto/HOMEWORK2-LWEB

Luca Lauretti
Repository GitHub:
https://github.com/lucalau00/HOMEWORK-2-LWEB


DESCRIZIONE DEL PROGETTO

Il progetto estende il sito statico realizzato per l’Homework 1,
trasformandolo in un’applicazione web dinamica tramite l’utilizzo di
PHP e MySQL.

Il sito simula il funzionamento di un’agenzia di viaggi online.

Gli utenti possono consultare le destinazioni e gli itinerari,
registrarsi, effettuare il login, aggiungere viaggi alle proprie
prenotazioni, rimuovere una prenotazione, simulare un pagamento e
consultare lo storico dei pagamenti effettuati.

Il progetto integra pagine HTML5 e XHTML, fogli di stile CSS, logica
lato server in PHP e una base di dati MySQL.


FUNZIONALITÀ PRINCIPALI

- Visualizzazione delle destinazioni e degli itinerari
- Registrazione di un nuovo utente
- Autenticazione tramite email e password
- Gestione delle sessioni utente
- Accesso a un’area personale
- Visualizzazione dinamica delle offerte di viaggio
- Inserimento di uno o più viaggi nelle prenotazioni
- Controllo delle prenotazioni duplicate
- Rimozione di una singola prenotazione
- Calcolo automatico del costo totale
- Simulazione del pagamento
- Registrazione dei pagamenti nel database
- Visualizzazione dello storico dei pagamenti


TECNOLOGIE UTILIZZATE

- HTML5 e XHTML per la struttura delle pagine
- CSS per la presentazione grafica e il layout
- PHP per la logica lato server
- MySQL per la memorizzazione dei dati
- phpMyAdmin per il controllo e l’amministrazione locale del database
- Sessioni PHP per mantenere l’autenticazione dell’utente
- MySQLi per la connessione tra PHP e MySQL


TECNICHE PRINCIPALI UTILIZZATE

- Inclusione di file tramite require_once
- Separazione dei dati generali di configurazione
- Connessione al database tramite MySQLi
- Query SQL SELECT, INSERT e DELETE
- Prepared statement
- Utilizzo di bind_param()
- Gestione dei form tramite metodo POST
- Utilizzo delle variabili di sessione
- Utilizzo dei campi hidden
- Cifratura delle password tramite password_hash()
- Verifica delle password tramite password_verify()
- Stampa sicura dei dati tramite htmlspecialchars()
- Reindirizzamento tramite header()
- Installazione automatica del database tramite install.php
- Validazione delle pagine e dei fogli di stile tramite W3C


STRUTTURA DEL DATABASE

Il database viene creato e popolato automaticamente tramite il file:

install.php

Il nome del database e i dati necessari alla connessione sono definiti
nel file:

dati_generali.php

Le principali tabelle del database sono:

- cliente
- viaggio
- prenotazione
- pagamento
- bali
- kyoto
- reykjavik
- losangeles

Il file install.php crea il database, costruisce le tabelle e inserisce
i dati iniziali relativi alle destinazioni e alle offerte disponibili.

Non è necessario importare manualmente un file SQL tramite phpMyAdmin.


CONFIGURAZIONE

Le impostazioni generali del database sono contenute esclusivamente nel
file:

dati_generali.php

All’interno di questo file possono essere modificati:

- host del server MySQL
- nome utente MySQL
- password MySQL
- nome del database
- nomi delle tabelle

I file connection.php e install.php includono dati_generali.php.

In questo modo, per installare il progetto su un server diverso, è
sufficiente modificare un solo file, evitando di ripetere gli stessi
dati in più punti dell’applicazione.


INSTALLAZIONE

1. Copiare la cartella del progetto nella directory del server web.

   Con XAMPP, per esempio:

   C:\xampp\htdocs\lauretti.luca.PHP_MySQL

2. Aprire il file dati_generali.php.

3. Controllare ed eventualmente modificare:

   - host MySQL
   - nome utente MySQL
   - password MySQL
   - nome del database

4. Avviare Apache e MySQL tramite XAMPP.

5. Aprire dal browser il file install.php:

   http://localhost/lauretti.luca.PHP_MySQL/install.php

6. Attendere la conferma del completamento dell’installazione.

7. Aprire la pagina iniziale del sito:

   http://localhost/lauretti.luca.PHP_MySQL/Home.xhtml


CREDENZIALI DI ACCESSO

Il database creato da install.php non contiene utenti predefiniti.

Per utilizzare le funzionalità riservate del sito è necessario creare
un nuovo account tramite la pagina:

account.php

Dopo la registrazione è possibile effettuare l’accesso tramite:

login.php

L’utente deve quindi scegliere autonomamente la propria email e la
propria password durante la registrazione.


PAGINE PRINCIPALI

- Home.xhtml
  Pagina iniziale pubblica del sito

- home2.php
  Home dell’area personale dell’utente autenticato

- login.php
  Pagina per l’accesso degli utenti

- account.php
  Pagina per la registrazione di un nuovo utente

- destinazioni.xhtml
  Destinazioni presenti nella parte pubblica

- destinazioni2.php
  Destinazioni disponibili nell’area personale

- bali.php
  Visualizzazione e prenotazione delle offerte per Bali

- kyoto.php
  Visualizzazione e prenotazione delle offerte per Kyoto

- reykjavik.php
  Visualizzazione e prenotazione delle offerte per Reykjavik

- losangeles.php
  Visualizzazione e prenotazione delle offerte per Los Angeles

- prenotazione.php
  Visualizzazione e gestione delle destinazioni scelte dall’utente

- pagaora.php
  Simulazione e registrazione del pagamento

- storicoviaggi.php
  Visualizzazione dello storico dei pagamenti dell’utente

- connection.php
  Gestione della connessione al database

- dati_generali.php
  Definizione delle impostazioni generali del database

- install.php
  Creazione e popolamento automatico del database


PAGINE STATICHE

Il progetto contiene anche alcune pagine statiche derivate
dall’Homework 1:

- Home.xhtml
- Chi_siamo.xhtml
- destinazioni.xhtml
- Itinerario.xhtml
- Last_minut.xhtml
- meteestive.xhtml
- meteinvernali.xhtml

Le pagine:

- chi_siamo2.xhtml
- Itinerario2.xhtml
- last_minute2.xhtml

sono versioni utilizzate nell’area personale e contengono collegamenti
adatti alla navigazione dell’utente autenticato.


FUNZIONAMENTO DEL SITO

All’avvio viene mostrata la pagina Home.xhtml.

Dalla pagina iniziale è possibile accedere alle sezioni pubbliche del
sito, tra cui Destinazioni, Itinerari, Chi siamo e Last Minute.

Gli utenti non registrati possono creare un nuovo account tramite la
pagina account.php.

Dopo la registrazione, l’utente può accedere tramite login.php.

Se le credenziali sono corrette, l’utente viene reindirizzato alla
pagina home2.php e può utilizzare le funzionalità dell’area personale.

Dalla pagina destinazioni2.php è possibile selezionare una delle
destinazioni disponibili:

- Bali
- Kyoto
- Reykjavik
- Los Angeles

Ogni offerta può essere aggiunta alle prenotazioni dell’utente.

Il sistema verifica che la stessa offerta non venga aggiunta più volte
dallo stesso utente.

Nella pagina prenotazione.php è possibile:

- visualizzare le destinazioni selezionate
- rimuovere una singola prenotazione
- visualizzare il totale complessivo
- procedere al pagamento

Il pagamento viene simulato nella pagina pagaora.php e registrato nella
tabella pagamento.

Dopo il pagamento, le prenotazioni presenti nel carrello vengono
rimosse.

Lo storico dei pagamenti effettuati può essere visualizzato tramite la
pagina storicoviaggi.php.


PROBLEMI AFFRONTATI E SOLUZIONI

1. Verifica delle credenziali

Per controllare le credenziali viene eseguita una query SELECT sulla
tabella cliente.

La password inserita viene confrontata con quella cifrata presente nel
database tramite la funzione password_verify().


2. Protezione delle password

Le password non vengono memorizzate in chiaro.

Durante la registrazione viene utilizzata la funzione password_hash()
per generare una versione cifrata della password.


3. Gestione dell’area personale

Dopo il login vengono salvati nella sessione l’identificativo del
cliente e il suo indirizzo email.

Le pagine riservate controllano la presenza delle variabili di sessione
prima di mostrare i propri contenuti.


4. Reindirizzamento dopo il login

Dopo l’autenticazione viene utilizzata l’istruzione:

header("Location: home2.php");

per reindirizzare l’utente alla propria area personale.


5. Calcolo del totale delle prenotazioni

Le prenotazioni dell’utente vengono recuperate dal database.

Un ciclo legge ogni record e somma il valore del campo costo nella
variabile $totale.


6. Rimozione di una prenotazione

Ogni prenotazione contiene un pulsante Rimuovi.

L’identificativo della prenotazione viene inviato tramite un campo
hidden.

La cancellazione viene effettuata con una query DELETE che controlla
sia id_prenotazione sia id_cliente, in modo che ogni utente possa
rimuovere solamente le proprie prenotazioni.


7. Registrazione del pagamento

Il pagamento viene registrato tramite una query INSERT nella tabella
pagamento.

Dopo la registrazione, il carrello dell’utente viene svuotato.

Il totale viene inoltre eliminato dalla sessione per evitare che
l’aggiornamento della pagina possa creare pagamenti duplicati.


8. Portabilità del progetto

I dati di connessione e i nomi delle tabelle sono definiti nel file
dati_generali.php.

Il database viene creato automaticamente tramite install.php.

Questa organizzazione permette di installare il progetto in una
cartella differente o su un altro server modificando solamente i dati
presenti in dati_generali.php.


VALIDAZIONE

Le pagine HTML e l’HTML generato dalle pagine PHP sono stati controllati
tramite il validatore HTML W3C.

I fogli di stile CSS sono stati controllati tramite il validatore CSS
W3C.

Gli errori individuati durante la validazione sono stati corretti.


NOTE

- Per il corretto funzionamento devono essere attivi Apache e MySQL.
- Il database non deve essere importato manualmente.
- install.php può essere eseguito più volte senza eliminare gli utenti,
  le prenotazioni e i pagamenti già presenti.
- Per eseguire un’installazione completamente pulita è necessario
  eliminare preventivamente il database esistente.
- Dopo l’installazione è necessario registrare un nuovo account tramite
  account.php.