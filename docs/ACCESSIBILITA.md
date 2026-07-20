# Accessibilità — stato WCAG 2.1 AA

Verifica effettuata nel luglio 2026 su **35 pagine**, controllando l'HTML generato di
tutte le voci di menu pubblicate più la home italiana e quella inglese.

> **Verdetto: il template NON è conforme WCAG 2.1 AA.**
> Le fondamenta sono solide, ma c'è un difetto bloccante nel filtro "Tipologia".

---

## Cosa risulta conforme (misurato, non stimato)

| Criterio | Esito |
|---|---|
| **1.1.1** Contenuti non testuali | 165 `<img>`, **0 senza `alt`**. 74 hanno `alt=""`: corretto, sono decorative |
| **2.4.1** Salto dei blocchi | skip link su tutte le 35 pagine, punta a `#main-content` che esiste sempre |
| **4.1.2** Nome, ruolo, valore | 71 controlli form e 227 `<button>`, **tutti con nome accessibile**; nessuna `<label for>` orfana |
| **1.4.4** Ridimensionamento testo | viewport corretto ovunque, nessun `user-scalable=no` né `maximum-scale` |
| **2.4.6** Intestazioni ed etichette | `<main>`, `<nav>`, `<header>`, `<footer>` presenti ovunque; `<main>` mai duplicato; **tutti i `<nav>` hanno `aria-label`** |
| **3.1.1** Lingua della pagina | `lang` corretto sull'elemento `html` in tutte le pagine |
| **1.3.1** Tabelle | l'unica tabella presente ha intestazioni corrette |
| **id duplicati** | **0 su 746 id** |

Nessun salto di livello nelle intestazioni (h2→h4), nessun heading vuoto, nessun
`tabindex` positivo.

---

## Problemi da correggere

### 1. BLOCCANTE — Filtro "Tipologia" non usabile da tastiera (3.2.2 On Input)

**32 occorrenze su 12 pagine.** Markup generato:

```html
<input type="RADIO" value="/novita/panoramicanovita/le-circolari"
       onchange="window.open(this.value, '_self')"
       name="Circolari" id="check-Circolari">
```

In un gruppo di radio la tastiera si sposta con le frecce direzionali, e **ogni
spostamento fa cambiare pagina**. Chi naviga da tastiera non riesce mai a raggiungere
la seconda o la terza opzione: appena preme la freccia, il browser va via.

Lo stesso markup ha altri tre difetti:

| Difetto | Conseguenza |
|---|---|
| `name` diverso per ogni radio (`name="Circolari"`, `name="Eventi"`…) | non sono un gruppo di radio: sono radio isolati, che non si escludono a vicenda |
| `id="check-<titolo categoria>"` con spazi | `id` non validi in HTML5 (viola 4.1.1) |
| titolo stampato senza `escape()` | il titolo di una categoria finisce grezzo dentro attributi HTML |

**Dove intervenire** (dopo la deduplicazione sono 6 punti, non più 7+):

```
html/com_content/category/blog.php:175
html/com_content/category/didattica.php:129
html/com_content/category/didattica.php:186
html/com_content/category/organizzazione.php:164
html/com_content/category/_condiviso/layout_eventi_novita.php:196
html/com_content/category/_condiviso/layout_documenti_luoghi.php:162
```

**Correzione consigliata:** quel controllo non è una scelta da confermare, è un
**elenco di collegamenti**. Sostituire i radio con `<a href="...">` risolve in un colpo
solo il criterio 3.2.2, gli `id` non validi, i `name` sbagliati e l'escaping. Va
concordato con chi cura la grafica, perché cambia l'aspetto del filtro (Bootstrap Italia
offre stili "chip"/"tag" adatti).

**Correzione minima**, se si vuole mantenere l'aspetto a radio: stesso `name` per tutto
il gruppo, `id` generati con `ApplicationHelper::stringURLSafe()`, titoli passati da
`$this->escape()`, rimozione di `onchange` e aggiunta di un pulsante "Applica filtro".

### 2. `<title>` non univoci (2.4.2) — 6 pagine

Cinque pagine diverse condividono `<title>I progetti delle classi</title>` pur avendo
`<h1>` distinti. Anche `/` e `/home-ita` hanno lo stesso title.
Si corregge dal pannello, nelle voci di menu (campo *Titolo pagina del browser*).

### 3. Pagina senza intestazioni (1.3.1)

`/legalealias` (login "Pubblicità legale") non ha **nessun** heading da `h1` a `h6`,
pur avendo `<main>` e due form.

### 4. Home inglese in italiano (3.1.2)

`/en/` dichiara `lang="en-gb"` ma il contenuto è quasi tutto italiano ("La scuola",
"Didattica", "Amministrazione trasparente"). Non ci sono attributi `lang` sui blocchi in
lingua diversa (zero in tutto il sito). Uno screen reader legge testo italiano con
pronuncia inglese.
Questo è un problema di **contenuti**, non di template.

### 5. `<h1>` multipli — 4 pagine

`/`, `/home` e `/home-ita` hanno **3 `<h1>`**, di cui due identici (probabilmente le
varianti desktop e mobile dello hero, entrambe presenti nel DOM) più un terzo usato come
titolo di sezione (`<h1 class="h3">La didattica</h1>`).

Non è la violazione secca di un criterio, ma rende ingannevole la navigazione per
intestazioni. Il terzo dovrebbe essere un `<h2>`; delle due varianti dello hero una
andrebbe nascosta agli assistivi con `aria-hidden`.

### 6. Da valutare a mano — "Scopri di più" (2.4.4)

Unico testo di link generico su **2791 link** totali. Il criterio 2.4.4 ammette che il
contesto chiarisca la destinazione: da verificare visivamente.

---

## Criteri NON verificati

I seguenti richiedono un browser o un test manuale e **non sono stati misurati**.
Non vanno considerati conformi:

- **1.4.3** contrasto del testo e **1.4.11** contrasto non testuale
- **2.4.7** focus visibile, **2.1.1 / 2.1.2** navigazione e trappole da tastiera
  (per il punto 1 il sospetto è forte già dal markup, ma va confermato da tastiera)
- **1.4.4** zoom al 200% e **1.4.10** reflow a 320 px
- **1.4.12** spaziatura del testo, **1.4.13** contenuti su hover/focus (menu a tendina)
- **2.4.3** ordine del focus, **1.3.2** ordine di lettura significativo
- **2.2.2** pausa/stop per il carosello dello hero
- **4.1.3** messaggi di stato (ricerca, form di login)

## Metodo

Analisi statica dell'HTML restituito dal server per tutte le voci di menu pubblicate
(`client_id=0`, `type='component'`, `published=1`) più `/` e `/en/`.

Un'analisi che si limiti a cercare i tag `<img>` nel codice sorgente PHP **produce falsi
allarmi**: in questo template gli `alt` vengono valorizzati tramite variabili e layout
condivisi. Vanno contati sull'HTML generato, non sul sorgente.
