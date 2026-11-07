# Quickstart del sito dimostrativo

Il **quickstart** è una copia completa del sito dimostrativo
([jit.protocollicreativi.it](https://jit.protocollicreativi.it)) che installi sul
tuo spazio web, con il tuo dominio, il tuo database e il tuo amministratore.
È il modo più rapido per vedere il tema al lavoro con contenuti veri e per
partire da una struttura già pronta.

Il file è `quickstart-italia-theme-for-joomla-2.0.2.zip`, allegato alla
[release 2.0.2](https://github.com/pcrt/italia-theme-for-joomla/releases/tag/v2.0.2).

## Cosa contiene

| | |
|---|---|
| Joomla | 6.1.3, con la lingua italiana |
| Tema | Italia Theme for Joomla 2.0.2, già predefinito; plugin `singleedit` 1.0.1 |
| Contenuti di esempio | menu, articoli, categorie, campi personalizzati e moduli di un istituto **immaginario**, "Istituto Battaglia 1815" |
| Albo | componente Albo Pretorio Online (`com_alboonline`) 1.2.1, con alcuni atti di esempio |
| Strumenti | Akeeba Backup Core 10.5.0 (puoi disinstallarlo dopo); Akeeba Kickstart Core 9.2.0 per l'estrazione |

Nello zip ci sono tre file: `kickstart.php`, l'archivio
`quickstart-italia-theme-for-joomla-2.0.2.jpa` e `LEGGIMI.txt` con la procedura
passo passo.

## Requisiti

| | |
|---|---|
| PHP | **8.3 o superiore**: è il minimo di Joomla 6. Con PHP 8.1 o 8.2 il sito non parte |
| Estensioni PHP | mysqli, gd, zip, intl, xml, mbstring, json |
| Database | MySQL 8 oppure MariaDB 10.4 o superiore, vuoto (verificato con MariaDB 10.11) |
| Spazio | circa 250 MB durante l'installazione |
| Server | Apache consigliato: il sito usa gli URL brevi con `.htaccess` |

Se il tuo hosting è fermo a PHP 8.1 o 8.2, il quickstart non fa per te: installa
Joomla 5 e poi il tema seguendo [installazione.md](installazione.md).

## Come si installa

1. Crea un database vuoto, con il suo utente, dal pannello dell'hosting.
2. Carica `kickstart.php` e il file `.jpa` nella cartella principale del sito,
   vuota (scompattando lo zip con il file manager dell'hosting, oppure via FTP
   in modalità binaria).
3. Apri `https://iltuodominio.it/kickstart.php`. Kickstart 9 si blocca con la
   schermata *Insecure setup detected* finché non lo proteggi: crea il file
   `kickstart.json.php` con il testo che la pagina ti mostra e usa la password
   indicata, oppure rinomina `kickstart.php` con un nome casuale.
4. Premi **Avvia**, attendi l'estrazione e premi **Esegui il programma di
   installazione**. Lascia aperta la scheda di Kickstart.
5. Nella procedura di ripristino di Akeeba (BRS, che in Akeeba Backup 10 ha
   sostituito ANGIE):
   - **database**: sostituisci i valori precompilati con host, utente, password
     e nome del tuo database; il prefisso `w6xcr_` puoi cambiarlo;
   - **configurazione del sito**: nome ed email del sito, spunta **Genera un
     nuovo segreto**; in *Impostazioni Super Utente* scegli `admin` e imposta
     la tua email e una tua password.
6. Torna in Kickstart e premi **Pulisci**: cancella `installation/`, l'archivio
   e `kickstart.php` e ripristina `.htaccess`. Poi controlla a mano che non
   siano rimasti `kickstart.json.php`, `configuration.bak.php` e `LEGGIMI.txt`.

## Utente di prova

L'archivio contiene un solo super utente:

| Utente | Password | Email |
|---|---|---|
| `admin` | `demo-battaglia-2026` | `admin@example.com` |

La password è pubblica. Se al passo 5 non l'hai sostituita, entra subito in
`/administrator` e cambiala da **Utenti ▸ Gestione**, insieme all'email.

## Cosa cambiare dopo

- **Sistema ▸ Configurazione globale**: nome del sito, email di invio,
  metadati. Il quickstart è impostato su *index, follow*: per un sito di prova
  non ancora pubblico scegli *noindex, nofollow*.
- **Sistema ▸ Stili del sito ▸ Italia Theme for Joomla**: logo, nome
  dell'istituto, recapiti del footer (indirizzo, telefono, email, PEC), social.
  Vedi [header.md](header.md), [footer.md](footer.md), [topbar.md](topbar.md).
- **Contenuti**: sostituisci o cancella articoli, persone, luoghi e atti di
  esempio. Gli atti dell'albo di esempio sono già scaduti e archiviati, quindi
  `/albo-online` parte vuoto finché non ne pubblichi di nuovi.
- **Componenti ▸ Motore di ricerca** (Ricerca smart): premi **Indice**, perché
  l'indice della ricerca interna non viaggia nell'archivio.
- **Sistema ▸ Aggiorna**: controlla gli aggiornamenti di Joomla e delle
  estensioni.
- Il modulo *Sito dimostrativo* (posizione `hero`) è già disattivato.

Per organizzare i contenuti reali segui l'ordine di lavoro di [doc.md](doc.md).
