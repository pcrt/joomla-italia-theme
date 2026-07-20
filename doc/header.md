# Header — logo, menu e ricerca

L'intestazione contiene il logo dell'istituto con i testi affiancati, il menu
principale, il selettore di lingua e la ricerca.

Una parte si configura nei **parametri del tema**, un'altra tramite i **moduli**.

---

## Il logo e i testi

**Dove:** Pannello ▸ **Sistema ▸ Stili del sito** ▸ *Joomla Italia Theme* ▸
scheda **Logo**.

| Campo | Cosa fa |
|---|---|
| **Mostra logo** | interruttore generale |
| **Immagine** | il logo (consigliato **SVG**) |
| **Testo sopra il titolo** | riga piccola sopra (es. tipologia di scuola) |
| **Titolo** | nome dell'istituto — la riga più evidente |
| **Sottotitolo** | riga sotto il titolo |

Il logo e i testi insieme formano **un unico collegamento alla homepage**.

> **Usa un SVG.** Il logo compare su schermi di ogni densità e in dimensioni
> diverse: un PNG a bassa risoluzione si vede sgranato sui display moderni.

> **Accessibilità:** non serve descrivere il logo nel testo alternativo. Il nome
> dell'istituto è già scritto accanto, dentro lo stesso collegamento: ripeterlo
> farebbe sentire la stessa informazione due volte a chi usa uno screen reader.

## Il menu principale

Non è un parametro del tema: è il **modulo** `Main Menu`, in posizione
**`menuprincipale`**.

Per cambiare le voci: Pannello ▸ **Menu ▸ Main Menu**.
Per cambiare come si comporta il modulo: Pannello ▸ **Contenuti ▸ Moduli sito**.

Vedi [menu.md](menu.md) per la struttura consigliata e per il comportamento dei
menu a più livelli.

## La ricerca

Sono due moduli distinti che lavorano insieme:

| Modulo | Posizione | Ruolo |
|---|---|---|
| `Ricerca nel sito` (mod_finder) | `cerca` | il campo di ricerca, aperto in una finestra |
| `Menu nella modale cerca` (mod_menu) | `menucerca` | i collegamenti rapidi mostrati dentro quella finestra |

La ricerca usa **Smart Search** di Joomla, che funziona solo se l'indice è
popolato: Pannello ▸ **Componenti ▸ Ricerca Smart ▸ Indicizza**. Va rifatto dopo
un caricamento massiccio di contenuti.

> Se la ricerca non trova nulla che invece esiste, il colpevole è quasi sempre
> l'indice non aggiornato, non il tema.

## Il selettore di lingua

Modulo `Lingua` (mod_languages) in posizione **`lingua`**. Compare solo se il sito
è multilingua e il plugin **Filtro lingua** è attivo.

> **In un sito multilingua ogni lingua ha bisogno della propria homepage.** Se
> assegni i blocchi di contenuto solo alla home italiana, la home nelle altre
> lingue risulterà vuota: intestazione e piè di pagina ci sono, in mezzo non c'è
> nulla. È un errore frequente e silenzioso — nessun messaggio lo segnala.

## Il percorso di navigazione (breadcrumb)

Modulo `Percorso di navigazione` in posizione **`breadcrumbs`**. Mostra dove ci si
trova nella gerarchia del sito e dipende dalla struttura dei **menu**, non da
quella delle categorie: se il percorso mostrato non ti convince, la causa è
nell'organizzazione delle voci di menu.
