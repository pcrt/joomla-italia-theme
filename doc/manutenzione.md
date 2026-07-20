# Manutenzione — convenzioni e trappole note

Documento per chi mette le mani nel codice. Raccoglie le cose che **non si capiscono
guardando i file** e che sono costate tempo scoprire.

---

## 1. La convenzione `_condiviso/`

Molti layout del template erano **copie identiche** l'uno dell'altro: lo stesso codice
esisteva in 7 o 10 file. Conseguenza pratica: ogni correzione andava applicata 7 volte,
e bastava dimenticarne una perché il difetto restasse in giro.

> È già successo: un errore nella query delle categorie ("`parent_id = root`" non
> quotato) era stato copiato in 7 override e per correggerlo sono serviti tutti e 7.

Oggi il codice duplicato vive in **una sola copia** dentro cartelle `_condiviso/`, e i
vecchi nomi di file restano al loro posto come richiamo:

```php
<?php
defined('_JEXEC') or die;
include __DIR__ . '/_condiviso/children.php';
```

**Cosa devi sapere prima di modificare:**

- modificare un file in `_condiviso/` cambia **tutti** i layout che lo usano —
  è il vantaggio (correggi una volta), ma non è più "solo la pagina Notizie";
- se ti serve un comportamento diverso **solo** per un layout, non modificare il file
  condiviso: sostituisci lo stub con il codice specifico di quel layout;
- Joomla continua a risolvere i layout **per nome di file**, quindi gli stub devono
  restare: `novita_children.php` deve esistere anche se contiene solo l'`include`.

### Perché nel file condiviso i nomi delle classi sono completi

In `com_content/category/_condiviso/query_tipologia.php` si legge:

```php
$db = \Joomla\CMS\Factory::getContainer()->get('DatabaseDriver');
```

e non il più breve `Factory::...`. **Non è una svista.** Le istruzioni `use` in PHP
valgono solo nel file in cui sono scritte: un file incluso non le eredita. Usare il
nome completo è l'unico modo perché il file condiviso funzioni da qualunque layout
venga richiamato.

---

## 2. Le mappe si caricano da un CDN esterno

In `html/plg_fields_subform/subform.php` (righe 16-17):

```php
$document->addScript('https://unpkg.com/leaflet@1.9.4/dist/leaflet.js');
$document->addStyleSheet('https://unpkg.com/leaflet@1.9.4/dist/leaflet.css');
```

**Perché è un problema su un sito PA:** ogni visitatore che apre una pagina con mappa
invia il proprio indirizzo IP a `unpkg.com`, un server di terze parti fuori dall'Unione
Europea. L'IP è un dato personale: il trasferimento andrebbe dichiarato nell'informativa
privacy. In più, se quel servizio è irraggiungibile le mappe spariscono.

**Le copie locali ci sono già** in questo repository:

```
media/templates/site/joomla-italia-theme/js/leaflet.js     (145 KB)
media/templates/site/joomla-italia-theme/css/leaflet.css   (15 KB)
```

La correzione è puntare a quelle. Usare la stessa versione **1.9.4**: aggiornare Leaflet
"già che ci siamo" è il modo tipico di rompere le mappe.

---

## 3. Asset caricati su tutte le pagine ma usati solo in home

In `index.php` vengono caricati sempre `jquery-3.6.2.min.js` (88 KB) e
`owl.carousel.min.js` (44 KB), ma il carosello che li usa è dentro una condizione
`$isHomePage` più in basso: esiste **solo in homepage**.

Circa 130 KB scaricati inutilmente su ogni pagina interna. Spostare quei caricamenti
dentro il controllo `$isHomePage`.

---

## 4. Possibile errore fatale in `index.php`

```php
$menu       = $app->getMenu()->getActive();
$isHomePage = ($menu->home);                          // <-- non controlla null
$pageclass  = $menu !== null ? ... : '';              // <-- qui il controllo c'è
```

Su una pagina senza voce di menu attiva `$menu` è `null` e la seconda riga genera un
errore fatale. La riga successiva dimostra che il rischio era noto ma è stato protetto
solo lì.

---

## 5. Override identici al core: non crearne

Un override che è una **copia identica** del file originale di Joomla non serve a nulla
e fa danno: "congela" quel file, quindi quando Joomla pubblica un aggiornamento
(anche di sicurezza) il sito continua a usare la vecchia copia, **in silenzio**.

Nel 2026 sono stati rimossi 44 file di questo tipo da `html/layouts/`.

**Regola:** prima di aggiungere un override, verifica che contenga davvero una modifica.
Per controllare l'intero template:

```bash
# dalla radice del sito Joomla
for f in $(find templates/joomla-italia-theme/html/layouts -name '*.php'); do
  rel=${f#templates/joomla-italia-theme/html/layouts/}
  cmp -s "$f" "layouts/$rel" && echo "IDENTICO (inutile): $rel"
done
```

---

## 6. Il file lingua del template deve chiamarsi come il template

Trappola già costata l'inglese del sito: la cartella era `language/en-EN/` e il file
`tpl_joomla-english-theme.ini`. Joomla cerca:

```
language/<codice-lingua>/tpl_<nome-cartella-template>.ini
```

cioè `language/en-GB/tpl_joomla-italia-theme.ini`. Con nomi diversi il file **non viene
mai caricato** e nel sito compaiono le sigle grezze (`TPL_PCRT_SKIP_TO_CONTENT`) al
posto dei testi. Nessun errore, nessun avviso: semplicemente non funziona.

Il codice lingua inglese in Joomla è **`en-GB`**, non `en-EN`.

---

## 7. Lo stesso codice è copiato in molti override: cercalo sempre

Anche dopo la deduplicazione restano blocchi ripetuti (non identici al byte, quindi non
unificabili meccanicamente):

- blocco di condivisione social (Facebook/Twitter/LinkedIn/stampa): **10 file** in `html/com_content/article/`
- blocco "indice della pagina": **7 file**
- blocco "Filtra per tipologia": **7 file**

**Quando trovi un difetto in uno di questi, cercalo con `grep` negli altri prima di
considerare chiuso il lavoro.**

---

## 8. Testi scritti a mano invece che tradotti

Il template usa correttamente `Text::_()` in 145 file, ma restano circa 143 punti con
testo italiano scritto direttamente nel PHP ("Filtra per tipologia", "Stampa il
contenuto", "Condividi su:", "Chiudi finestra modale"...). Sono ~25 stringhe diverse,
molto ripetute.

Conseguenza: nella versione inglese del sito quei testi restano in italiano, e sono
proprio quelli che legge uno screen reader.
