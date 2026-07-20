# Campi aggiuntivi delle categorie

Oltre ai campi degli articoli, il tema usa alcuni campi applicati **alla categoria
stessa**. Servono a comporre elementi che appartengono alla sezione, non al singolo
contenuto: la linea del tempo con la storia della scuola, il riquadro delle
strutture, un messaggio in cima alla pagina.

**Dove si compilano:** Pannello ▸ **Contenuti ▸ Categorie** ▸ apri una categoria ▸
schede accanto a *Descrizione*.

**Dove sono definiti:** Pannello ▸ **Contenuti ▸ Campi**, cambiando il selettore
del contesto da *Articoli* a **Categorie**. È un menu a tendina che si nota poco:
se non trovi questi campi, quasi sempre stai guardando il contesto sbagliato.

---

## I campi disponibili

### Messaggio
Testo libero mostrato in cima alla pagina di categoria. Utile per un avviso che
riguarda tutta la sezione.

### Storia della Scuola — la linea del tempo

Elenco ripetibile che genera la timeline.

| Campo | Contenuto |
|---|---|
| **Titolo Timeline** | intestazione del blocco |
| **Sottotitolo Timeline** | riga sotto il titolo |
| **Storia della Scuola** | l'elenco degli eventi (pulsante *+* per aggiungerne uno) |

Ogni evento contiene:

| Campo | Esempio |
|---|---|
| **Anno Evento** | `1961` |
| **Mese Anno Evento** | `Settembre 1961` |
| **Titolo Evento** | `Fondazione dell'istituto` |
| **Descrizione Evento** | il racconto esteso |

> Gli eventi compaiono nell'ordine in cui li inserisci. Per una cronologia
> corretta inseriscili **dal più antico al più recente**: non vengono riordinati
> automaticamente in base all'anno che scrivi.

### Row Strutture

Riquadro che collega la categoria alle strutture organizzative.

| Campo | Contenuto |
|---|---|
| **Strutture** | scelta fra gli articoli dell'organizzazione già pubblicati |
| **Intro strutture** | testo introduttivo |
| **Organizzazione** | collegamento alla pagina dell'organizzazione |

---

## Nessuno di questi campi è obbligatorio

Puoi creare e salvare una categoria lasciandoli tutti vuoti: il blocco
corrispondente semplicemente non comparirà.

> **Trappola da conoscere.** Il campo *Strutture* fa parte di un elenco ripetibile
> costruito con JavaScript. Se apri una riga e la **lasci vuota**, al salvataggio
> Joomla può rispondere *"Campo non valido: Strutture"* — anche se il campo non è
> obbligatorio. Il messaggio non aiuta a capire cosa fare.
>
> **Soluzione:** non aggiungere righe che non compili. Se il blocco non ti serve,
> lascialo chiuso e salva tranquillamente.

## Se compili un campo e non vedi il risultato

I blocchi compaiono solo nelle pagine di categoria che usano un layout che li
prevede. Se hai compilato la timeline e sulla pagina non c'è, controlla **quale
layout usa la voce di menu** che apre quella categoria: alcuni layout non
disegnano quel blocco.

Vedi [menu.md](menu.md) per i layout disponibili e come si scelgono.
