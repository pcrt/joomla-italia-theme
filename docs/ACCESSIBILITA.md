# Accessibilità — stato WCAG 2.1 AA

Verifica su **36 pagine**: tutte le voci di menu pubblicate del sito più la home
italiana e quella inglese. I controlli sono fatti sull'**HTML generato dal server**,
non sul codice sorgente PHP.

> **Stato: nessun errore rilevato fra quelli verificabili staticamente.**
> Restano da confermare con browser i criteri elencati in fondo.

---

## Esito dell'ultima verifica

| Controllo | Esito su 36 pagine |
|---|---|
| Immagini senza `alt` | **0** |
| Pagine senza `<h1>` | **0** |
| Pagine con più di un `<h1>` | **0** |
| Salti di livello nelle intestazioni (h2→h4) | **0** su 35 pagine con intestazioni |
| Intestazioni vuote | **0** |
| `id` HTML non validi (con spazi) | **0** |
| `id` duplicati | **0** |
| Controlli che cambiano pagina alla selezione | **0** |
| Errori PHP nell'output | **0** |
| Skip link funzionante | 36/36 |
| Campi form e pulsanti con nome accessibile | 36/36 |
| `<main>`, `<nav>`, `<header>`, `<footer>` e `aria-label` sui `nav` | 36/36 |
| `lang` corretto sull'elemento `html` | 36/36 |
| Viewport senza blocco dello zoom | 36/36 |

---

## Correzioni applicate

### 1. Filtro "Tipologia" — era il difetto bloccante

**Prima:**

```html
<input type="RADIO" onchange="window.open(this.value, '_self')"
       name="Circolari" id="check-Circolari">
```

In un gruppo di radio la tastiera si sposta con le frecce, e con quell'`onchange`
**ogni spostamento cambiava pagina**: chi navigava da tastiera non riusciva mai a
raggiungere la seconda opzione. Violazione **WCAG 3.2.2 "On Input"**.
Lo stesso markup aveva tre difetti aggiuntivi: `name` diverso per ogni radio (quindi
non erano nemmeno un gruppo), `id` contenenti spazi (HTML non valido, **4.1.1**), e il
titolo della categoria stampato senza `escape()`.

**Ora:**

```html
<ul class="filtro-tipologia">
  <li class="catsamelevel my-0">
    <a class="filtro-tipologia-link is-active"
       href="/novita/panoramicanovita/le-notizie"
       aria-current="page">Notizie</a>
  </li>
  …
</ul>
```

Selezionare una tipologia porta a un'altra pagina: il controllo corretto è un
**collegamento**. Funziona da tastiera, funziona senza JavaScript e comunica la pagina
corrente con `aria-current`.

Il codice sta in un solo file, `com_content/category/_condiviso/filtro_tipologia.php`,
richiamato dai 6 punti che prima contenevano copie del markup.

**L'aspetto non cambia:** in `pcrt-main.css` ci sono regole che ridisegnano il
collegamento come il radio di prima (cerchio vuoto, pieno per la voce attiva). Il
cerchio usa `currentColor`, quindi se il testo rispetta il contrasto lo rispetta anche
il segnalino.

### 2. `<h1>` multipli (1.3.1)

- **Carosello della homepage**: ogni slide conteneva un `<h1>`, tutti con lo stesso
  testo. Ora l'`<h1>` è solo sulla prima slide, le altre usano `<h2>`.
- **Modulo "La didattica"**: il titolo del modulo era un `<h1>` fisso, che in homepage
  diventava un terzo `<h1>`. Ora è `<h2>` (e il sottotitolo `<h3>`).
- **Pagine di categoria**: due blocchi `if` separati potevano produrre due `<h1>` se
  erano attive sia "Mostra titolo categoria" sia "Mostra intestazione pagina". Ora sono
  alternativi.

### 3. Pagine senza `<h1>` (1.3.1)

- **`/legalealias`** (login "Pubblicità legale") non aveva **nessuna** intestazione:
  attivata l'intestazione di pagina sulla voce di menu.
- **`/didattica`** e **`/didattica/…/offerta-formativa`** ricevevano l'`<h1>` dal titolo
  di un modulo: far dipendere l'intestazione principale da un modulo è fragile (basta
  toglierlo da quella pagina e l'`<h1>` sparisce). Introdotto
  `_condiviso/h1_fallback.php`, che emette un `<h1 class="visually-hidden">` con il
  titolo della categoria quando il layout non mostra un titolo visibile: si legge con
  gli assistivi, non cambia nulla graficamente.

### 4. `<title>` non descrittivi (2.4.2)

Cinque pagine diverse mostravano tutte `I progetti delle classi`, perché le
sottocategorie senza voce di menu propria ereditano il titolo della voce padre.
`_condiviso/titolo_pagina.php` antepone il titolo della categoria corrente, ma **solo
se non è già presente**: sulle categorie che hanno una voce di menu propria non cambia
nulla.

### 5. Escaping

I titoli di categoria stampati nelle intestazioni ora passano da `$this->escape()`.
Prima finivano grezzi nell'HTML.

---

## Due segnalazioni residue, entrambe innocue

**`/home-eng` risponde 404.** È la voce di menu della home inglese, che con il filtro
lingua attivo viene servita su `/en/`. **Nessuna pagina la collega** (zero `href` verso
`home-eng`), quindi non è un collegamento rotto per l'utente: è un residuo di
configurazione, non un problema di accessibilità.

**`/` e `/home-ita` hanno lo stesso `<title>`.** Sono la stessa pagina raggiungibile da
due indirizzi (la home generica e la home italiana del sito multilingua). Titoli
identici per contenuti identici sono corretti: 2.4.2 chiede che il titolo *descriva* la
pagina, non che sia diverso da ogni altro.

---

## Criteri NON verificati

Richiedono un browser o un test manuale e **non sono stati misurati**.
Non vanno considerati conformi:

- **1.4.3** contrasto del testo e **1.4.11** contrasto non testuale
- **2.4.7** focus visibile e **2.1.1 / 2.1.2** navigazione e trappole da tastiera
- **1.4.4** zoom al 200% e **1.4.10** reflow a 320 px
- **1.4.12** spaziatura del testo, **1.4.13** contenuti su hover/focus (menu a tendina)
- **2.4.3** ordine del focus, **1.3.2** ordine di lettura significativo
- **2.2.2** pausa/stop per il carosello della homepage
- **4.1.3** messaggi di stato (ricerca, form di login)

> Il carosello della homepage va scorre automaticamente: **2.2.2** richiede un comando
> per metterlo in pausa. È il controllo manuale da fare per primo.

---

## Nota di metodo

Un'analisi che cerca i tag `<img>` nel **codice sorgente PHP** produce falsi allarmi: in
questo template gli `alt` sono valorizzati tramite variabili e layout condivisi. Una
verifica di questo tipo aveva riportato "26 immagini senza alt"; il conteggio
sull'HTML generato dà **0 su 165 immagini**.

Allo stesso modo, gli strumenti automatici (axe-core, pa11y, WAVE) **non rilevano il
criterio 3.2.2**: non possono sapere che un `onchange` porta via dalla pagina. Il
difetto bloccante descritto sopra era invisibile a tutti e tre.
