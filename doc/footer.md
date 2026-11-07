# Footer — il piè di pagina

Il piè di pagina è composto da due parti: i **parametri del tema** (logo, logo
Europa, copyright) e i **moduli** posizionati nelle quattro colonne.

---

## Logo e testi

**Dove:** Pannello ▸ **Sistema ▸ Stili del sito** ▸ *Italia Theme for Joomla* (`joomla-italia-theme`) ▸
scheda **Logo footer**.

| Campo | Cosa fa |
|---|---|
| **Mostra loghi footer** | interruttore generale |
| **Immagine** | il logo nel piè di pagina |
| **Testo sopra il titolo** | riga piccola sopra |
| **Titolo** | nome dell'istituto |
| **Sottotitolo** | riga sotto |

## Logo Europa

Scheda **Logo footer**, campi dedicati:

| Campo | Cosa fa |
|---|---|
| **Mostra logo Europa** | interruttore |
| **Immagine** | l'emblema |
| **Descrizione** | il testo accanto (es. *Finanziato dall'Unione Europea*) |

Serve per i finanziamenti PON/PNRR, dove l'emblema è obbligatorio insieme a una
dicitura precisa. **Il testo esatto è stabilito dal bando**: copialo da lì, non
inventarlo.

## Copyright

Scheda **Copyright**:

| Campo | Cosa fa |
|---|---|
| **Inserisci copyright** | interruttore |
| **Dati copyright** | editor di testo libero |

Essendo un editor puoi inserire collegamenti — utile per privacy, note legali e
dichiarazione di accessibilità.

> Per le scuole la **dichiarazione di accessibilità** va pubblicata e collegata in
> modo raggiungibile da ogni pagina: il piè di pagina è il posto giusto.

---

## Le colonne di moduli

Quattro posizioni, da riempire con moduli menu:

| Posizione | Uso tipico |
|---|---|
| `footer1` | link esterni |
| `footer2` | la scuola |
| `footer3` | servizi, didattica |
| `footer4` | novità |

In `footer3` possono convivere più moduli: si impilano nell'ordine indicato dal
campo **Ordine**.

Il layout consigliato per questi moduli menu è
`joomla-italia-theme:menusecondario`, che rende un elenco semplice adatto al piè
di pagina.

**Come aggiungere una colonna:**

1. Pannello ▸ **Contenuti ▸ Moduli sito ▸ Nuovo**
2. Tipo **Menu**
3. Scegli il **Menu** da mostrare
4. Imposta **Posizione** su `footer1`…`footer4`
5. Scheda **Avanzate** ▸ **Layout** ▸ `menusecondario`
6. Scheda **Assegnazione menu** ▸ *Su tutte le pagine*

## Altre posizioni della zona bassa

| Posizione | Contenuto tipico |
|---|---|
| `arealegale` | menu con note legali, privacy, albo |
| `menumodulorows` | collegamenti utili |
| `textmodulorows` | testo libero (es. riferimenti a progetti finanziati) |
| `mappa` | mappa o riquadro con la sede |
| `copyright` | contenuto libero aggiuntivo accanto al copyright |
