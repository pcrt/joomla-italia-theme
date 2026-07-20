# Inserire e gestire gli articoli

Guida passo passo per scrivere un contenuto, dalla creazione alla pubblicazione.

---

## Prima di iniziare: scegli la categoria

**La categoria decide tutto**: l'aspetto della pagina e quali campi ti verranno
chiesti. Una notizia va in *Notizie*, una circolare in *Circolari*, un servizio in
*Servizi*.

Se non sai dove mettere il contenuto, leggi prima
[alberatura-categorie.md](alberatura-categorie.md).

---

## Passo 1 — Crea l'articolo

Pannello ▸ **Contenuti ▸ Articoli ▸ Nuovo**

## Passo 2 — Titolo e categoria

1. Scrivi il **Titolo**
2. Sulla destra scegli la **Categoria**

> **Scegli subito la categoria.** I campi aggiuntivi compaiono **solo dopo**
> averla scelta: se ti sembra che manchino delle schede, è perché la categoria non
> è ancora impostata. Non è un difetto.

L'**Alias** è la parte dell'indirizzo web. Lasciandolo vuoto viene generato dal
titolo, e va benissimo.

## Passo 3 — Scrivi il testo

Nella scheda **Contenuto**, con l'editor.

### Testo introduttivo e "Leggi tutto"

Negli elenchi si vede solo la parte iniziale. Per decidere dove tagliare:

1. Metti il cursore dove vuoi il taglio
2. Premi il pulsante **Leggi tutto** sotto l'editor
3. Compare una linea rossa tratteggiata

Sopra la linea = quello che si vede nell'elenco. Sotto = il resto, visibile
aprendo l'articolo.

> Senza il taglio, negli elenchi compare **tutto** il testo, e le pagine di
> categoria diventano lunghissime.

## Passo 4 — Le immagini

Scheda **Immagini e collegamenti**:

| Campo | Dove si vede |
|---|---|
| **Immagine introduttiva** | negli elenchi e nelle anteprime |
| **Immagine articolo completo** | nella pagina dell'articolo |

Per ciascuna c'è un campo **Testo alternativo**.

> **Sul testo alternativo, la regola giusta è meno intuitiva di quanto sembri.**
>
> Se accanto all'immagine c'è già il titolo dell'articolo — come negli elenchi —
> l'immagine è **decorativa**: il testo alternativo va lasciato **vuoto**.
> Riempirlo farebbe sentire due volte la stessa cosa a chi usa uno screen reader.
>
> Va invece compilato quando l'immagine **aggiunge informazione**: una locandina
> con date e luoghi, un grafico, una foto che documenta qualcosa. In quel caso
> descrivi **cosa mostra**, non com'è fatta.

### Caricare un'immagine

Nel campo immagine ▸ **Seleziona** ▸ si apre il Media manager ▸ **Carica**.

Prima di caricare, **ridimensiona**: una foto da fotocamera pesa svariati MB e
rende il sito lentissimo su cellulare. Per il web bastano 1200-1600 pixel di lato
lungo.

## Passo 5 — I campi aggiuntivi

A seconda della categoria compaiono schede in più: *Cos'è*, *A cosa serve*,
*Orari*, *Luogo*, *Allegati*…

I campi con l'asterisco sono **obbligatori**: senza, l'articolo non si salva.
L'elenco completo per ogni categoria è in
[custom-field-articoli.md](custom-field-articoli.md).

## Passo 6 — Pubblica

Sulla destra:

| Campo | Cosa fa |
|---|---|
| **Stato** | `Pubblicato` per renderlo visibile |
| **In evidenza** | lo mostra nel blocco in primo piano della homepage |
| **Inizio pubblicazione** | per programmare l'uscita |
| **Accesso** | `Public` per tutti |
| **Lingua** | `Tutte`, salvo casi particolari |

Poi **Salva e chiudi**, e sul sito **Ctrl+F5**.

---

## Se l'articolo non si vede

In ordine di probabilità:

**1. Non è pubblicato.** Controlla lo Stato.

**2. Non esiste una pagina che lo mostri.** Un articolo in una categoria senza
voce di menu non è raggiungibile. Serve una voce di menu per quella categoria —
vedi [menu.md](menu.md).

**3. La cache.** **Ctrl+F5**, e se serve Sistema ▸ Svuota la cache.

**4. La data di inizio pubblicazione è nel futuro.**

**5. L'accesso non è pubblico.**

## Se non riesci a salvare

**"Campo richiesto"** con l'etichetta vuota: c'è un campo obbligatorio non
compilato in una scheda che non hai aperto — controllale tutte.

Se hai compilato tutto e il messaggio resta, il motivo è quasi sempre un
**permesso mancante**: modificare i valori dei campi personalizzati richiede
un'autorizzazione che per impostazione predefinita ha solo il Super User. È
spiegato in [configurazione-joomla.md](configurazione-joomla.md#permessi-la-cosa-che-blocca-i-redattori).

## Modificare un articolo dal sito

Se la modifica dal frontend è attiva, navigando da autenticato compare l'icona di
modifica sugli articoli: si apre lo stesso modulo del pannello.

> Su alcuni siti è attivo un blocco che impedisce di aprire **due schede di
> modifica insieme**: se provi ad aprirne una seconda compare un avviso. Serve a
> evitare che due persone si sovrascrivano il lavoro. Il blocco si libera
> salvando o annullando la modifica aperta.
