# Alberatura delle categorie

**Questa è la parte più importante da fare bene, e va fatta per prima.**

Nel tema **la categoria decide l'aspetto della pagina**. Un articolo messo in
*Notizie* si vede come una notizia; lo stesso identico articolo messo in *Servizi*
si vede come una scheda servizio, e il pannello ti chiederà campi diversi.

Non c'è un interruttore "tipo di contenuto": c'è la categoria.

---

## La struttura del modello per le scuole

```
Scuola
├── I luoghi
│   ├── Edifici Scolastici
│   ├── Biblioteca
│   ├── Laboratori
│   └── Palestra
├── Le carte della scuola
│   ├── Documenti didattici
│   ├── Documenti generici
│   ├── Modulistica
│   └── Regolamenti
└── Organizzazione
    ├── Scuola / Istituto
    ├── Segreteria
    ├── Dirigenza Scolastica
    └── Organo Collegiale

Servizi
├── Famiglie e studenti
├── Personale scolastico
└── Percorsi di studio

Novità
├── Notizie
├── Circolari
└── Eventi

Didattica
├── Le schede didattiche
│   └── Scuola secondaria di secondo grado
├── I progetti delle classi
│   ├── Progetti Area Scientifica
│   ├── Progetto Area Umanistica
│   └── Progetto di integrazione
└── Offerta formativa
```

Le quattro categorie di primo livello — **Scuola, Servizi, Novità, Didattica** —
corrispondono alle sezioni previste dal modello.

---

## Regole pratiche

**Gli articoli vanno nelle foglie, non nei rami.** Una circolare va in *Circolari*,
non in *Novità*. Le categorie intermedie servono a raggruppare, e le loro pagine
mostrano le sottocategorie.

**Non rinominare le categorie del modello a cuor leggero.** I campi aggiuntivi
sono assegnati alle categorie: cambiando struttura si rischia che un articolo non
mostri più i campi giusti. Rinominare il *titolo* è sicuro; spostare una categoria
sotto un altro genitore no.

**Puoi aggiungere sottocategorie.** Se servono nuovi tipi di documento, creane una
sotto *Le carte della scuola*: erediterà l'aspetto del ramo.

> **Attenzione ai campi aggiuntivi sulle categorie nuove.** Se crei una
> sottocategoria dentro un ramo che ha campi obbligatori, gli articoli di quella
> categoria li erediteranno. Verifica in Contenuti ▸ Campi quali campi sono
> assegnati al ramo, prima di stupirti di un "Campo richiesto" al salvataggio.

**Il filtro "Tipologia" mostra le categorie sorelle.** Nelle pagine di categoria
compare a sinistra un filtro con le categorie che hanno lo **stesso genitore**.
È generato automaticamente: se una voce non ti aspettavi di vederla, controlla il
genitore di quella categoria.

---

## Creare una categoria

1. Pannello ▸ **Contenuti ▸ Categorie ▸ Nuovo**
2. **Titolo**
3. **Genitore**: la categoria sopra (è il campo che determina tutto)
4. **Salva e chiudi**

Poi, per renderla raggiungibile, serve una **voce di menu** — vedi
[menu.md](menu.md).

> Se la categoria ha campi aggiuntivi propri (per esempio *Storia della Scuola* o
> *Strutture*), il form li mostra in fondo. **Non sono obbligatori**: si può
> salvare lasciandoli vuoti. Vedi
> [custom-field-categoria.md](custom-field-categoria.md).

## Categoria vuota

Una categoria senza articoli non è un errore: la pagina si apre e mostra le
sottocategorie, oppure un messaggio "nessun articolo". Puoi quindi preparare
l'intera struttura prima di scrivere i contenuti — ed è l'ordine consigliato.
