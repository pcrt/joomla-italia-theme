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
- Puntare Leaflet alle copie locali invece che a `unpkg.com` (le copie sono già incluse)
- Caricare jQuery e il carosello solo in homepage (~130 KB per pagina interna)
- Proteggere `$menu` null in `index.php` riga 14

### Da fare — manutenibilità
- Estrarre il blocco di condivisione social (ripetuto in 10 override di articolo)
- Estrarre il blocco "indice della pagina" (ripetuto in 7 override)
- Portare in `Text::_()` le ~143 stringhe italiane scritte a mano nei PHP
- Spostare in CSS i 51 colori scritti a mano nei PHP

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
  originale [pcrt/joomla-italia-theme](https://github.com/pcrt/joomla-italia-theme).
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
