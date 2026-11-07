# Changelog

Tutte le modifiche rilevanti a questo progetto.
Formato ispirato a [Keep a Changelog](https://keepachangelog.com/it/1.1.0/).

## [Non rilasciato]

### Da fare — accessibilità
- **Verifiche da fare con browser** (non misurabili staticamente): contrasto colori,
  focus visibile, navigazione da tastiera, zoom 200%, reflow a 320 px.
  Il criterio **2.2.2 non si applica**: il carosello ha `autoplay: false` e nel tema
  non ci sono altri contenuti ad avanzamento automatico.

### Da fare — privacy e prestazioni
- Caricare jQuery e il carosello solo in homepage (~130 KB per pagina interna)
- Proteggere `$menu` null in `index.php` riga 14

### Da fare — manutenibilità
- Estrarre il blocco di condivisione social (ripetuto in 11 override di articolo,
  `note-legali` compreso dalla 2.0.2)
- Estrarre il blocco "indice della pagina" (ripetuto in 7 override)
- Portare in `Text::_()` le ~143 stringhe italiane scritte a mano nei PHP
- Spostare in CSS i 51 colori scritti a mano nei PHP

---

## [2.1.0] — 2026-11-07

Rilascio con le correzioni e le novità del riesame delle 24 issue aperte su GitHub al 7 novembre
2026. Ogni correzione e ogni novità è stata riprodotta e verificata su **Joomla
6.2.0 (PHP 8.4, MariaDB 11.8)** in Docker, con un sito costruito da zero: categorie, articoli,
campi aggiuntivi, menu e moduli del modello. Nessuna libreria nuova, nessun CDN.
I siti esistenti non cambiano comportamento se non per le correzioni: le novità
sono tutte **opzionali** (parametri con il valore predefinito di prima, layout
alternativi da scegliere nel modulo o nella voce di menu).

### Corretto
- **#89** Megamenu — con voci di terzo livello dentro una voce con classe
  `megamenu`, `mod_menu/default.php` perdeva quelle voci, chiudeva la colonna prima
  del tempo e trascinava tutte le voci successive dentro la tendina rotta: nel sito
  restava visibile solo la prima voce. Il ciclo segue ora `deeper`/`shallower`/
  `level_diff` di Joomla come il layout del core; il megamenu aggiunge solo le
  colonne al secondo livello. Il markup delle tendine normali è invariato.
- **#88** Conflitti con jQuery e Bootstrap caricati da estensioni di terze parti
  (es. iCagenda) — i componenti Bootstrap del core (dropdown, collapse) si
  sommavano a quelli del bundle di Bootstrap Italia: i menu a tendina si aprivano e
  richiudevano subito. `index.php` li disattiva ora in `onBeforeCompileHead`, cioè
  dopo il rendering dei moduli, e non solo per i componenti come faceva per
  collapse. Se un'estensione carica jQuery del core, la copia 3.6.2 del tema diventa
  un segnaposto che dipende da quella: una sola jQuery per pagina, con carosello e
  `jti.js` in coda. `jti.js` e lo script inline usano `jQuery` e non `$`, così
  funzionano anche con `jquery-noconflict`.
- **#57** Titolo e sottotitolo dell'intestazione fuori dal riquadro su mobile —
  sotto i 992px Bootstrap Italia fissa l'altezza dell'intestazione a 80px, ma il
  tema vi mostra tre righe: uscivano dal riquadro. Ora l'intestazione si adatta al
  contenuto e il testo è più piccolo.
- **#45** Finestra "Stampa / Condividi" con lo sfondo nero pieno — la regola
  `.modal.fade.show { background-color: #000 }` copriva la pagina di nero; ora è un
  nero trasparente, come l'oscuramento di Bootstrap Italia.
- Nei blog di sezione il confronto fra la categoria dell'articolo e la
  sottocategoria è ora fra interi (prima era un `!==` fra valori letti dal
  database, che possono essere stringhe o numeri a seconda del driver).

### Aggiunto
- **#60** Favicon personalizzata: scheda **Avanzate** dello stile ▸ *Favicon*
  (ICO, PNG o SVG). Vuoto: l'icona predefinita di Joomla, come prima.
- **#47** `user.css` e `user.js`: se esistono in
  `media/templates/site/joomla-italia-theme/css/` e `js/` vengono caricati dopo
  gli asset del tema; non fanno parte del pacchetto, gli aggiornamenti non li toccano.
- **#53** `error.php`: pagina di errore con intestazione, menu, messaggio in base al
  codice (404, 403, generico), pulsante per la homepage e piè di pagina; i moduli in
  posizione `error-<codice>` sostituiscono il testo, come nel template di sistema.
- **#54** `offline.php`: pagina "sito offline" con logo, messaggio di manutenzione
  della Configurazione globale e modulo di accesso.
- **#49** Layout `italia` per il modulo di accesso nativo (`mod_login`): scheda
  centrata con la grafica del modello, per le posizioni `below` e `user`.
- **#38** Icona degli allegati in base al tipo di file (layout `documento` dei
  campi): PDF, Word/testi, fogli di calcolo, presentazioni, archivi, audio, video…
- **#86** Parametro *Licenza dei documenti* (scheda Copyright): se compilato, le
  schede delle Carte della scuola lo mostrano sotto le date di pubblicazione.
- **#81** Data di pubblicazione nei layout `news`, `progetti`, `above` e `newshome`
  del modulo elenco articoli, quando nel modulo è attivo *Mostra data*.
- **#61** Layout `news-noveditutti` e `progetti-noveditutti`: come `news` e
  `progetti` ma senza i collegamenti "Vedi tutti".
- **#98** Layout `offerta-formativa-tutti`: come `offerta-formativa` con il
  pulsante "Tutti i percorsi di studio" verso la categoria madre.
- **#93** Sottocategorie dell'*Elenco categoria* come schede (icona cartella, numero
  di articoli, descrizione, sottocategorie annidate).
- **#95** Override per la voce di menu *Lista di tutti i tag*: elenco a schede con
  filtro, numero per pagina e paginazione.
- **#76** Parametro *Articoli per ogni sottocategoria* nelle voci di menu dei layout
  novita, eventi, didattica, documenti, luoghi e organizzazione: ogni sezione legge
  i propri articoli categoria per categoria, i più recenti per primi
  (`_condiviso/voci_sottocategoria.php`). Vuoto o 0: come prima.

### Verificato senza modifiche
- **#41** Formattazione dell'editor principale non mantenuta — è il comportamento
  del modello: il testo dell'editor principale è la descrizione breve mostrata
  nell'intestazione, senza formattazione; il testo esteso va nel campo aggiuntivo
  di tipo editor della categoria. Documentato in `doc/custom-field-articoli.md`.
- **#37** Campi aggiuntivi di tipo editor che perdono la formattazione — dipende dal
  *Filtro* del campo (Contenuti ▸ Campi ▸ Opzioni): con *Testo* Joomla toglie i tag
  al salvataggio; va impostato *HTML sicuro*. Il tema stampa il valore così com'è.

### Rimandato alla 2.2
- **#63** timeline della pagina Scuola come nel modello WordPress, **#20** strutture
  con più sedi (una mappa per sede), **#18** responsabili delle strutture, **#12**
  accesso in finestra modale e pulsanti Accedi/Esci nella topbar.
- **#25** aggiornamento di Bootstrap Italia (oggi 2.3.5, CSS e JS allineati): le
  versioni 2.1x cambiano markup e classi di intestazione, menu, moduli e finestre
  modali su cui poggiano gli override e i fogli di stile del tema; è un lavoro da
  release dedicata con verifica di tutte le pagine, non da manutenzione.

---

## [2.0.3] — 2026-11-07

Correzioni fatte direttamente sul sito demo (jit.protocollicreativi.it) e mai
riportate nel repository, recuperate confrontando il template del demo con la 2.0.2.
Le altre differenze del demo sono correzioni già entrate nella 2.0.1 e nella 2.0.2
o file residui di versioni precedenti, e non sono state riportate.

### Corretto
- **#75** Ricerca impossibile con l'intestazione fissa (da 1200px in su) — scorrendo
  la pagina l'intestazione diventa una barra `position: fixed` e la finestra modale
  della ricerca, che sta dentro l'intestazione, ne restava intrappolata: cliccando la
  lente si apriva con dimensione zero, invisibile, mentre il blocco dello scorrimento
  scattava lo stesso, lasciando la pagina bloccata. Ora `index.php` sposta le finestre
  modali dell'intestazione (`header .modal`) come figlie dirette del `body` al
  caricamento della pagina; funziona a ogni larghezza.
- **#56** Collegamenti rapidi della ricerca tagliati su mobile — in
  `mod_menu/cerca.php` i pulsanti della finestra di ricerca restavano su una riga sola
  e l'ultimo usciva dallo schermo (a 390px arrivava a 416px con il contenitore che
  finiva a 330px). Aggiunto `flex-wrap`: vanno a capo.
- **Schede articolo con foto verticale più alte delle altre** — in `pcrt-jit.css` il
  riquadro immagine delle card (`.card-article-img`) aveva `min-height: 240px`: una
  foto verticale faceva crescere la scheda (428px contro 240px nella pagina Studenti
  del demo). La regola che limitava l'altezza era scritta per un `<figure>` che in
  queste schede non esiste. Ora l'altezza è fissa a 240px e la foto è ritagliata con
  `object-fit: cover`, come le altre.

---

## [2.0.2] — 2026-11-07

Rilascio di manutenzione: correzioni dei bug confermati nel codice dal riesame
delle issue di GitHub del 7 novembre 2026. Nessuna novità funzionale; il plugin
`singleedit` resta alla 1.0.1.

### Corretto
- **#64** Date di pubblicazione e revisione — i layout articolo (novità, circolari,
  eventi, servizio, documenti della scuola, strutture, progetti, schede didattiche)
  sovrascrivevano `publish_up` e `modified` con la data del giorno: ogni articolo
  risultava pubblicato e revisionato "oggi". Ora "Pubblicato" mostra la data di
  pubblicazione reale (`publish_up`, in mancanza `created`) nel fuso orario del sito
  e "Revisione" compare solo quando la data di modifica è successiva; il calcolo è
  in `article/_condiviso/date_articolo.php`. Formato `d.m.Y` e markup invariati.
- **#78** `Undefined variable $item_active` — `mod_menu/_condiviso/url.php` usava la
  variabile senza inizializzarla (warning PHP con la segnalazione errori attiva);
  ora è inizializzata come in `component.php`, senza cambiare il markup.
- **#74** Intro delle card del modulo news in minuscolo — la regola
  `.mod-news .scheda-item p { text-transform: lowercase }` trasformava in minuscolo
  sigle e nomi propri; rimossa (resta la maiuscola sulla prima lettera).
- **#15** Descrizione della categoria "La scuola" senza formattazione —
  `category/scuola.php` la stampava con `strip_tags` dentro l'`h1`: grassetti e
  paragrafi sparivano. Ora l'`h1` è il titolo della categoria (o l'intestazione della
  voce di menu) e la descrizione è stampata sotto come HTML, con lo stesso markup
  degli altri layout di categoria.
- **#44** Note legali senza "Stampa / Condividi" — `article/note-legali.php` non aveva
  il blocco presente negli altri layout articolo; aggiunto nella stessa posizione
  (colonna laterale), con la pagina divisa nelle due colonne di `default.php`.
- **#82** Timeline: "Anno Evento" non stampato — `layouts/com_fields/field/timeline.php`
  stampava solo i primi tre sottocampi dell'elenco "Storia della Scuola". Ora stampa i
  quattro sottocampi documentati (Anno, Mese Anno, Titolo, Descrizione), riconosciuti
  dal nome del campo e non più dalla posizione; se i nomi non corrispondono vale
  l'ordine di inserimento come prima.
- **#3** "Dati Copyright" senza formattazione — il campo è di tipo editor, ma il
  manifesto lo filtrava come testo semplice (`filter="string"`, che toglie ogni tag al
  salvataggio) e `index.php` lo stampava con `htmlspecialchars`. Ora il filtro è
  `safehtml` (script ed eventi rimossi) e il footer lo stampa come HTML. Per vedere
  la formattazione va salvato di nuovo lo stile del template.
- **#79** Carosello in homepage con una sola slide — `loop: true` clonava l'unica slide
  e mostrava le frecce; ora il loop è attivo solo con più di una slide.

### Verificato senza modifiche
- **#80** Colore della sezione Novità — il layout "Blog per le categorie della sezione
  Novità" (`category/novita.php` → `_condiviso/layout_eventi_novita.php`) usa già il
  verde `bg-greendark`, lo stesso delle schede notizia; il viola `bg-purplelight` resta
  solo nel "Blog di categoria" standard (`category/blog.php`), pensato per i Servizi.
  Se la voce di menu Novità appare viola, usa il layout sbagliato: vedi `doc/menu.md`.

---

## [2.0.1] — 2026-11-07

Correzioni emerse dall'App di valutazione dei modelli (pa-website-validator-ng
1.1.40, modello scuole) eseguita sul sito demo, più preparazione alla
distribuzione: nome, update server, catalogo Developers Italia.

### Corretto — App di valutazione dei modelli
- **Le schede servizio non venivano trovate dal validatore.** L'App apre le
  pagine delle tipologie di servizio (`data-element="service-type"`) e lì cerca i
  link alle schede (`data-element="service-link"`). Le card delle categorie
  servizi avevano solo `itemprop="url"`: il validatore non trovava nessun servizio
  e segnava come falliti font (C.SC.1.1), Bootstrap Italia (C.SC.1.2) e cookie
  (C.SC.2.3), anche se tutte le pagine analizzate li rispettavano. Ora `blog_item.php`
  passa `service-link` al layout del titolo, che lo stampa solo quando il chiamante
  lo richiede (lo stesso layout è usato anche da notizie, eventi, luoghi, documenti).
- **Note legali: `=` al posto di `===`.** In `article/note-legali.php` la
  condizione sul titolo "Licenza dei contenuti" era un'assegnazione: risultava
  sempre vera e sovrascriveva il titolo dell'articolo.

### Nome
- **Il tema si chiama ora "Italia Theme for Joomla"** (prima "Joomla Italia Theme").
  La policy del marchio Joomla non ammette nomi di prodotto che iniziano con
  "Joomla"; la forma indicata è "… for Joomla". Cambia solo il nome visibile
  (README, documentazione, crediti nel footer, update server, `publiccode.yml`).
  Il nome tecnico resta `joomla-italia-theme` — cartella, elemento, percorso dei
  media — così l'aggiornamento dalla 2.0.0 conserva stili e impostazioni.
  Aggiunta nel README la nota sui marchi.

### Privacy
- **Leaflet non viene più caricato da `unpkg.com`.** La mappa delle sedi usava
  la CDN esterna: ogni visita a una scheda luogo inviava l'indirizzo IP del
  visitatore a un servizio terzo. Ora usa le copie di Leaflet 1.9.4 già incluse
  nel tema, registrate in `joomla.asset.json` (`template.css.leaflet`,
  `template.js.leaflet`). Aggiunte in `css/images/` le icone del segnaposto e
  dei livelli, che il CSS locale cerca lì e che prima mancavano.
  Le tessere della mappa restano servite da OpenStreetMap.

### Aggiornamenti
- **Update server** per il template e per il plugin `singleedit`
  (`updateserver/template.xml`, `updateserver/plugin-singleedit.xml`, pubblicati
  via GitHub raw). Da questa versione Joomla segnala da solo le nuove release in
  *Sistema ▸ Aggiornamenti*. Il `targetplatform` limita gli aggiornamenti a
  Joomla 5 e 6.

### Catalogo Developers Italia
- Aggiunto `publiccode.yml` in radice, validato con `publiccode-parser-go` 5.4.3,
  per l'inserimento nel catalogo del software open source per la PA. Da
  aggiornare a ogni release (`softwareVersion`, `releaseDate`).

### Plugin `singleedit` 1.0.1
- **Namespace da `Joomla\Plugin\System\Singleedit` a `Pcrt\Plugin\System\Singleedit`.**
  Il prefisso `Joomla\` è riservato al core: un'estensione di terze parti non
  deve usarlo. Nessun effetto sul funzionamento.

---

## [2.0.0] — 2026-07-20

> **Versione non compatibile all'indietro.** Richiede **Joomla 5 o 6** e PHP 8.1+.
> Chi usa **Joomla 4** deve restare alla **1.2.1**, che resta scaricabile dalla
> pagina Releases insieme a tutte le versioni precedenti.
>
> Il salto da 1.2.1 a 2.0.0 segnala proprio questo: non è un aggiornamento minore,
> è un cambio di piattaforma di riferimento.

### Licenza
- Dichiarazione allineata a **GNU AGPL v3.0 o successiva**, la stessa del progetto
  originale [pcrt/italia-theme-for-joomla](https://github.com/pcrt/italia-theme-for-joomla).
  Il manifesto dichiarava `<license>Protocolli Creativi</license>`, che non è una
  licenza valida. Corretto in `templateDetails.xml`, nel manifesto del plugin
  `singleedit` e nel file `LICENSE`; aggiunto `AUTHORS`.
- Corretto `<authorUrl>`, che conteneva un indirizzo email invece di un URL.

### Documentazione
- Aggiunta la cartella `doc/` con 15 guide in italiano, rivolte a chi gestisce il
  sito dal pannello: configurazione di Joomla, alberatura delle categorie, topbar,
  header, footer, menu, moduli, campi aggiuntivi di articoli e categorie,
  inserimento articoli, più le guide tecniche su installazione, struttura del
  codice, manutenzione e accessibilità.
- Aggiunto `build.sh`, che produce i pacchetti installabili riorganizzando i file
  nel formato atteso dall'installatore di Joomla.

### Corretto — accessibilità (WCAG 2.1 AA)
- **Filtro "Tipologia": era impossibile da usare con la tastiera.** I `<input
  type="radio">` avevano `onchange="window.open(this.value,'_self')"`: spostandosi con
  le frecce fra le opzioni si cambiava pagina a ogni tasto, quindi la seconda e la terza
  opzione erano irraggiungibili (WCAG 3.2.2). Sostituiti con collegamenti, che è il
  controllo corretto per una scelta che porta a un'altra pagina. Risolti insieme anche
  gli `id` con spazi (HTML non valido, 4.1.1), i `name` diversi per ogni radio e
  l'assenza di `escape()` sui titoli. Il markup vive ora in un solo file,
  `com_content/category/_condiviso/filtro_tipologia.php`; l'aspetto è invariato grazie
  alle regole `.filtro-tipologia-link` in `pcrt-main.css`.
- **`<h1>` multipli** (1.3.1): il carosello ne emetteva uno per ogni slide (ora solo la
  prima), il titolo del modulo "La didattica" era un `<h1>` fisso (ora `<h2>`), e nelle
  pagine di categoria due `if` separati potevano produrne due (ora alternativi).
- **Pagine senza `<h1>`** (1.3.1): `/legalealias` non aveva nessuna intestazione;
  `/didattica` e `/didattica/…/offerta-formativa` ricevevano l'`<h1>` dal titolo di un
  modulo. Aggiunto `_condiviso/h1_fallback.php`, che emette un `<h1>` visually-hidden
  con il titolo della categoria quando il layout non mostra un titolo visibile.
- **`<title>` non descrittivi** (2.4.2): cinque pagine mostravano tutte "I progetti
  delle classi". Aggiunto `_condiviso/titolo_pagina.php`, che antepone il titolo della
  categoria corrente solo se non già presente.
- **Escaping**: i titoli di categoria nelle intestazioni passano ora da `$this->escape()`.

Verifica su 36 pagine dopo le correzioni: 0 immagini senza `alt`, 0 pagine senza `<h1>`,
0 pagine con più `<h1>`, 0 salti di livello, 0 intestazioni vuote, 0 `id` non validi,
0 `id` duplicati, 0 controlli che cambiano pagina alla selezione, 0 errori PHP.

### Corretto
- **Traduzioni inglesi del template mai caricate.** La cartella era `language/en-EN/`
  e il file `tpl_joomla-english-theme.ini`; Joomla cerca
  `language/en-GB/tpl_joomla-italia-theme.ini`. Le 40 stringhe tradotte non venivano
  mai usate e nel sito inglese comparivano le sigle grezze
  (`TPL_PCRT_SKIP_TO_CONTENT`). Rinominati cartella e file.

### Rimosso
- **44 override in `html/layouts/` identici al core Joomla.** Un override identico
  "congela" il file: gli aggiornamenti di sicurezza di Joomla non lo raggiungono più.
  Verificati uno per uno con `cmp` prima della rimozione (44 identici, 45 realmente
  modificati e mantenuti, 39 non presenti nel core e mantenuti).
- File `.old` (6), file `.map` di sviluppo (2), asset non dichiarati né richiamati:
  `bootstrap-italia.min.js`, `owl.carousel.js`, `owl.theme.default.css`.
- Font nei formati obsoleti `.eot`, `.ttf` e `.svg` (48 file) e relativi riferimenti in
  `fonts.css`. Restano `woff2` e `woff`, che coprono tutti i browser in uso.

### Modificato
- **Deduplicazione degli override.** 11 gruppi di file byte-identici unificati in file
  `_condiviso/` richiamati da stub. Estratta anche la query delle categorie "sorelle"
  del filtro Tipologia, che era copiata in 5 punti — è la query che conteneva il difetto
  `parent_id = root`. Da 2426 a 972 righe negli override interessati.
  Vedi [doc/struttura.md](doc/struttura.md).

### Verifica
Confronto A/B fra template originale e template modificato su **36 pagine**, registrando
codice HTTP, dimensione in byte ed errori PHP: **35 pagine identiche byte per byte**.
L'unica differenza è la home inglese, che ora mostra le traduzioni. Controllo di sintassi
PHP su 245 file: 0 errori.

---

## [1.2.1] — precedente

### Corretto
- Titoli degli articoli non cliccabili nelle pagine di categoria: il layout condiviso
  del titolo calcolava il collegamento ma non lo stampava.
- Query con `parent_id = root` non quotato, copiata in 7 override: impediva la creazione
  di nuove categorie con layout blog.
- Fisarmoniche che si aprivano ma non si richiudevano nei form dei componenti:
  doppio Bootstrap collapse (bundle del template + asset di Joomla).
- Aggiunto `<jdoc:include type="message" />` in `index.php`: senza di esso il sito non
  mostrava **nessun** messaggio di errore o conferma, e i salvataggi fallivano in silenzio.

### Aggiunto
- Layout `mod_articles_category/newshome.php` per la homepage a tre colonne.
- Plugin `singleedit`.

### Modificato
- Pulizia delle chiamate deprecate in vista di Joomla 7 (`Factory::getUser()`,
  `getLanguage()`, `getDocument()`, `getDbo()`) su 33 file. Resta compatibile con
  Joomla 5 e 6.
