# Changelog

Tutte le modifiche rilevanti a questo progetto.
Formato ispirato a [Keep a Changelog](https://keepachangelog.com/it/1.1.0/).

## [Non rilasciato]

### Da fare — accessibilità
- **Filtro "Tipologia"**: sostituire i `<input type="radio" onchange="window.open(...)">`
  con collegamenti. Blocca la navigazione da tastiera (WCAG 3.2.2) in 32 punti su
  12 pagine. Vedi [docs/ACCESSIBILITA.md](docs/ACCESSIBILITA.md)
- `<title>` non univoci su 6 pagine (2.4.2)
- `<h1>` multipli in homepage (1.3.1)

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

## [1.2.1] — 2026-07-20

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
  Vedi [docs/STRUTTURA.md](docs/STRUTTURA.md).

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
