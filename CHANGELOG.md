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
- Estrarre il blocco di condivisione social (ripetuto in 10 override di articolo)
- Estrarre il blocco "indice della pagina" (ripetuto in 7 override)
- Portare in `Text::_()` le ~143 stringhe italiane scritte a mano nei PHP
- Spostare in CSS i 51 colori scritti a mano nei PHP

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
