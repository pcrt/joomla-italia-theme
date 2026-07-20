# Topbar — la barra in cima al sito

La barra sottile sopra l'intestazione. Contiene un messaggio facoltativo (a
sinistra) e uno o più pulsanti (a destra), tipicamente l'accesso all'area
riservata.

**Dove si configura:** Pannello ▸ **Sistema ▸ Stili del sito** ▸ *Joomla Italia
Theme* ▸ scheda **Topbar**.

---

## Il messaggio a sinistra

| Campo | Cosa fa |
|---|---|
| **Mostra testo nella topbar** | interruttore generale: se è No, la barra non compare |
| **Titolo topbar** | il testo mostrato |
| **Link** | facoltativo: se compilato, il testo diventa cliccabile |

Serve per comunicazioni brevi e permanenti (ente di appartenenza, avviso
istituzionale). Non è un posto adatto agli avvisi che cambiano spesso: per quelli
usa una notizia.

## I pulsanti a destra

| Campo | Cosa fa |
|---|---|
| **Mostra Bottoni Topbar** | interruttore generale dei pulsanti |
| **Titolo** | il testo del pulsante (es. `Area Riservata`) |
| **Icona** | nome dell'icona, **senza** il percorso (es. `it-user`) |
| **Link** | dove porta il pulsante |

I pulsanti sono un **elenco ripetibile**: il pulsante *+* aggiunge una riga, così
puoi averne più di uno.

### Le icone

Il nome va scritto **esattamente** come nello sprite di Bootstrap Italia, compreso
il prefisso `it-`. Alcune di uso comune:

| Nome | Uso tipico |
|---|---|
| `it-user` | area riservata, accesso |
| `it-mail` | contatti |
| `it-telephone` | telefono |
| `it-calendar` | calendario |
| `it-pa` | ente, amministrazione |

L'elenco completo è nel file
`media/templates/site/joomla-italia-theme/images/sprites.svg`: gli identificativi
sono gli attributi `id` degli elementi `<symbol>`.

> **Se il pulsante appare senza icona**, quasi sempre il nome è sbagliato o manca
> il prefisso `it-`. Non viene mostrato nessun errore: semplicemente lo spazio
> resta vuoto.

### Il link dell'area riservata

Per far arrivare il pulsante alla pagina di accesso del sito, indica il percorso
della voce di menu che contiene il modulo di login — per esempio `/area-riservata`.

> **Verifica sempre dove punta questo campo.** In un'installazione di esempio
> conteneva ancora `https://www.google.com`, rimasto da una configurazione di
> prova: il pulsante funzionava, ma portava altrove. Non è il tipo di errore che
> si nota provando il sito distrattamente.

Se invece vuoi mandare gli utenti direttamente al pannello di amministrazione,
usa `/administrator` — ma è una scelta diversa: è l'accesso per chi gestisce il
sito, non l'area riservata dei visitatori.

---

## Accessibilità

Il titolo che scrivi nel campo **Titolo** diventa sia il testo visibile sia
l'etichetta letta dagli screen reader (`aria-label`). Scrivi quindi un testo che
abbia senso da solo: `Area Riservata` va bene, `Clicca qui` no.

Su schermi stretti il testo del pulsante viene nascosto e resta la sola icona: è
proprio in quel caso che l'etichetta diventa l'unica informazione disponibile per
chi non vede l'icona.
