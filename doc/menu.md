# Menu e voci di navigazione

Una categoria, da sola, non è raggiungibile: perché una pagina esista sul sito
serve una **voce di menu** che la apra. La voce di menu decide anche **con quale
aspetto** la pagina viene disegnata.

---

## I menu di un sito costruito col modello

| Menu | A cosa serve |
|---|---|
| **Main Menu** | la navigazione vera del sito: qui stanno tutte le pagine |
| **Menu secondario** | voci di servizio (note legali, privacy, area riservata) |
| **Menu ITA** / **Menu ENG** | ⚠️ contengono **una sola voce ciascuno**: la home di quella lingua |
| **Scuola**, **Didattica**, **Novità**, **Servizi** | usati dai moduli del piè di pagina |
| **Link Esterni** | collegamenti verso altri siti |
| **Menu Cerca** | i collegamenti rapidi dentro la finestra di ricerca |

> ### Non cancellare Menu ITA e Menu ENG
>
> Sembrano vuoti o inutili, ma non lo sono: contengono la **home page di ciascuna
> lingua**, che in un sito multilingua Joomla pretende. Cancellandoli si rompe il
> cambio lingua, con errori del tipo "Home page non trovata".
>
> Non servono per aggiungere pagine: per quello si usa **Main Menu**.

---

## Creare una voce di menu

Il modo sicuro è **partire dal menu giusto**, così il campo *Menu* è già compilato:

1. Pannello ▸ **Menu ▸ Main Menu ▸ Aggiungi voce di menu**
2. **Titolo**: il nome che si vedrà
3. **Tipo di voce di menu** ▸ **Seleziona** ▸ **Articoli** ▸ scegli il tipo
   (vedi la tabella qui sotto)
4. **Scegli una categoria**: la categoria da mostrare
5. Sulla destra controlla due campi:
   - **Menu** = `Main Menu`
   - **Lingua** = `Tutte` (a meno che la pagina debba esistere in una sola lingua)
6. **Salva e chiudi**

Poi apri il sito e fai **Ctrl+F5**.

> **L'errore più comune:** creare la voce partendo da un menu diverso. Il campo
> *Menu* resta su quel menu e la pagina risponde "404". Non devi rifare tutto:
> apri la voce, cambia il campo **Menu** in `Main Menu` e salva.

---

## I tipi di pagina offerti dal tema

Oltre ai tipi standard di Joomla, il tema ne aggiunge otto, ognuno con la grafica
della sua sezione:

| Tipo di voce di menu | Per quale sezione |
|---|---|
| **Blog per le categorie della sezione Novità** | Notizie, Circolari |
| **Blog per la categoria Eventi** | Eventi (mostra le date) |
| **Blog per le categorie della sezione Didattica** | schede didattiche, progetti |
| **Blog per le categorie della sezione documenti della scuola** | Le carte della scuola |
| **Blog per le categorie della sezione luoghi della scuola** | I luoghi |
| **Blog per le categorie della sezione organizzazione della scuola** | Organizzazione |
| **Pagina Scuola** | la panoramica della sezione Scuola |
| **Pagina Didattica** | la panoramica della sezione Didattica |

**Scegli il tipo che corrisponde alla sezione.** Una categoria di eventi aperta col
layout delle notizie funziona, ma non mostrerà le date.

Esistono anche i tipi standard di Joomla (*Blog di categoria*, *Elenco categoria*):
funzionano, ma hanno l'aspetto generico, non quello del modello per le scuole.

---

## Il campo Lingua

| Valore | Effetto |
|---|---|
| **Tutte** | la voce compare in tutte le lingue — è quello che vuoi quasi sempre |
| **Italiano** | solo nel sito italiano |
| **English** | solo nel sito inglese |

---

## Menu a più livelli

Il menu principale gestisce i sottolivelli come tendine. Nel modello, le sezioni
di primo livello (Scuola, Servizi, Novità, Didattica) **aprono la tendina invece
di navigare**: si raggiunge la pagina della sezione tramite la voce *Panoramica*
al primo posto della tendina.

È una scelta di accessibilità: un elemento che apre un menu e contemporaneamente
porta altrove è ambiguo per chi naviga da tastiera.

## Nascondere una voce senza cancellarla

Apri la voce ▸ scheda **Tipo di collegamento** ▸ **Mostra nel menu: No**.

La pagina **resta raggiungibile** dal suo indirizzo, ma sparisce dal menu. È il
modo giusto per mettere da parte una sezione non ancora pronta: cancellarla
significherebbe rifarla da capo, e i collegamenti già in giro smetterebbero di
funzionare.
