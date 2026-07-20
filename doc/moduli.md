# Moduli — i blocchi che compongono le pagine

Un modulo è un **blocco di contenuto** che si aggancia a una posizione del tema.
La homepage non è un articolo: è un insieme di moduli.

**Dove:** Pannello ▸ **Contenuti ▸ Moduli sito**.

---

## Le tre cose che decidono dove appare un modulo

| Campo | Cosa decide |
|---|---|
| **Posizione** | *dove* nella pagina (es. `below`, `footer2`) |
| **Assegnazione menu** | *su quali pagine* compare |
| **Stato** | se è pubblicato |

> Se un modulo "non si vede", nove volte su dieci il problema è
> l'**assegnazione menu**: è pubblicato, è nella posizione giusta, ma non è
> assegnato alla pagina che stai guardando.

## Le posizioni disponibili

**Intestazione:** `logo`, `menuprincipale`, `menusecondario`, `lingua`, `cerca`,
`bottonecerca`, `menucerca`, `hero`, `breadcrumbs`

**Corpo:** `above`, `above1`, `above2`, `above3`, `below`, `below1`, `below2`,
`below3`, `user`, `menublog`

**Piè di pagina:** `menumodulorows`, `textmodulorows`, `footer1`, `footer2`,
`footer3`, `footer4`, `arealegale`, `copyright`

I blocchi di contenuto della homepage vanno nelle posizioni **`below`**.

---

## I moduli di un sito costruito col modello

### Homepage (posizione `below`)

| Modulo | Cosa mostra |
|---|---|
| **In Evidenza** | l'articolo in primo piano |
| **[Home] Notizie, Circolari, eventi** | le tre colonne delle novità |
| **Servizi** | i servizi principali |
| **La didattica** | l'offerta formativa a schede |
| **Le carte della scuola** | i documenti |
| **Esplora le risorse didattiche** | le risorse |
| **I progetti** | i progetti delle classi |
| **Schede didattiche** | le schede |

### Intestazione e piè di pagina

| Modulo | Posizione |
|---|---|
| Main Menu | `menuprincipale` |
| Menu secondario | `menusecondario` |
| Lingua | `lingua` |
| Ricerca nel sito | `cerca` |
| Percorso di navigazione | `breadcrumbs` |
| Link Esterni / La scuola / I Servizi / Didattica / Novità | `footer1`…`footer4` |
| Area legale | `arealegale` |
| Copyright | `copyright` |

---

## Il blocco delle tre colonne in homepage

Il modulo **[Home] Notizie, Circolari, eventi** ha un comportamento speciale e
due regole da rispettare.

> ### Non cambiare il campo "Layout"
>
> Deve restare **`newshome`**. È un layout costruito apposta: se lo riporti al
> valore standard, la homepage torna a essere un elenco unico invece delle tre
> colonne.

**Perché esiste.** Il modulo standard di Joomla usa un **conteggio condiviso** fra
le categorie: chiedendo 3 articoli su 3 categorie, poteva prenderli tutti e tre
dalla stessa e far sparire le altre colonne. Il layout `newshome` interroga ogni
categoria separatamente e mostra **sempre** una colonna per ciascuna, anche vuota.

**Il campo "Numero di articoli" è il totale**, distribuito a giro fra le colonne
da sinistra a destra:

| Imposti | Risultato (se ci sono abbastanza articoli) |
|---|---|
| 3 | 1 + 1 + 1 |
| 4 | 2 + 1 + 1 |
| 6 | 2 + 2 + 2 |

Se una categoria esaurisce gli articoli viene saltata e i posti liberi vanno alle
altre. Quindi con 6 e una categoria che ha un solo articolo puoi ottenere 3/1/2:
è corretto.

**L'ordinamento è fisso**: sempre l'ultimo pubblicato per primo. Il campo
*Ordinamento articoli* non ha effetto su questo layout — è voluto, perché salvando
il modulo quel campo tornava al valore predefinito e la home perdeva l'ordine.

---

## Aggiungere un modulo

1. Pannello ▸ **Contenuti ▸ Moduli sito ▸ Nuovo**
2. Scegli il tipo (**Articoli - Categoria** per un elenco di articoli)
3. **Titolo** — con l'interruttore *Mostra titolo* decidi se mostrarlo
4. Scheda **Assegnazione menu**: su tutte le pagine, oppure solo su alcune
5. **Posizione**
6. Scheda **Avanzate ▸ Layout**: se esiste una versione del tema, usa quella
7. **Salva e chiudi**, poi **Ctrl+F5** sul sito

## Sito multilingua

> Se assegni i blocchi solo alla home italiana, la home nelle altre lingue
> resterà **vuota**: si vedranno intestazione e piè di pagina e nulla in mezzo.
>
> I moduli vanno assegnati alla voce di menu della home **di ogni lingua**.
> Nessun messaggio ti avverte: la pagina si apre regolarmente, solo senza
> contenuto.

## Modificare i moduli dal sito

Se la modifica dal frontend è attiva, un Super User può modificare i moduli
direttamente dalle pagine, senza passare dal pannello. La modifica dei moduli dal
sito è riservata ai **Super User**: gli altri gruppi ricevono un errore 403 se non
viene concesso esplicitamente il permesso dedicato.
