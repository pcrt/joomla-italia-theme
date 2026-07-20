# Struttura del codice

## Vista d'insieme

```
templates/joomla-italia-theme/
├── index.php               pagina completa (header, menu, hero, footer)
├── component.php           pagina "nuda" (stampa, finestre modali, iframe)
├── templateDetails.xml     manifesto: versione, posizioni modulo, parametri
├── joomla.asset.json       dichiarazione di css e js (14 asset)
├── language/
│   ├── it-IT/tpl_joomla-italia-theme.ini
│   └── en-GB/tpl_joomla-italia-theme.ini
└── html/                   gli override (il cuore del template)

media/templates/site/joomla-italia-theme/
├── css/                    fogli di stile
├── js/                     script
├── fonts/                  Titillium Web, Lora, Roboto Mono (woff2 + woff)
└── images/                 immagini del template

plugins/system/singleedit/  plugin "una modifica alla volta"
```

## `html/` — gli override

È la parte più corposa. Ogni sottocartella sovrascrive l'aspetto di un componente o
modulo di Joomla:

| Cartella | Cosa disegna |
|---|---|
| `com_content/article/` | pagine di articolo (10 varianti: notizie, eventi, servizi, documenti…) |
| `com_content/category/` | pagine di categoria (blog, novità, eventi, didattica, luoghi, documenti, organizzazione) |
| `com_content/categories/` | elenchi di categorie |
| `com_tags/`, `com_finder/`, `com_contact/`, `com_users/` | tag, ricerca, contatti, area utente |
| `mod_menu/`, `mod_articles_category/`, `mod_articles_latest/`, … | moduli |
| `layouts/` | layout condivisi di Joomla, sovrascritti dove serve |
| `plg_fields_*/` | resa dei campi personalizzati (mappe, subform, sql) |

### La convenzione dei nomi

Joomla risolve i layout **per nome di file**. Una pagina di categoria che usa il layout
`novita` carica:

```
novita.php                        il layout principale
novita_item.php                   il singolo articolo nell'elenco
novita_children.php               le sottocategorie
novita_links.php                  i collegamenti
novita_itemsottocategorie.php     gli articoli delle sottocategorie
```

Da qui nasce la duplicazione storica del template: sette famiglie di layout, ognuna con
la propria copia degli stessi file.

### Le cartelle `_condiviso/`

I file identici sono stati unificati: il codice vive in `_condiviso/` e i file con i
nomi che Joomla si aspetta sono diventati richiami di poche righe.

```
com_content/category/
├── _condiviso/
│   ├── children.php                    ← usato da 7 layout
│   ├── links.php                       ← usato da 7 layout
│   ├── query_tipologia.php             ← la query delle categorie "sorelle"
│   ├── itemsottocategorie_didattica.php
│   ├── itemsottocategorienoimg.php
│   ├── layout_eventi_novita.php        ← eventi.php e novita.php erano identici
│   └── layout_documenti_luoghi.php     ← documenti.php e luoghi.php erano identici
├── blog_children.php                   → include _condiviso/children.php
├── novita_children.php                 → include _condiviso/children.php
└── …
```

Stessa convenzione in `com_content/article/_condiviso/`, `mod_menu/_condiviso/` e
`mod_articles_category/_condiviso/`.

**Prima di modificare un file dentro `_condiviso/` leggi
[MANUTENZIONE.md](MANUTENZIONE.md#1-la-convenzione-_condiviso).**

## Layout dedicati degni di nota

### `mod_articles_category/newshome.php`

Layout su misura per il blocco della homepage con **Notizie, Circolari ed Eventi
affiancati**.

Serve perché il modulo `mod_articles_category` di Joomla usa un **conteggio condiviso**
fra le categorie: chiedendo 3 articoli su 3 categorie, poteva prenderli tutti e tre
dalla stessa e far sparire le altre colonne.

Questo layout invece:

- interroga **ogni categoria in modo indipendente**;
- mostra **sempre** una colonna per ogni categoria configurata, anche se vuota;
- distribuisce il *Numero di articoli* del modulo **a giro** fra le colonne
  (3 → 1+1+1, 4 → 2+1+1); se una categoria esaurisce gli articoli, i posti liberi
  vanno alle altre;
- ordina **sempre** per data di pubblicazione decrescente.

> L'ordinamento è volutamente fisso e **non** segue il parametro *Ordinamento articoli*
> del modulo: salvando il modulo dal pannello quel campo tornava al valore predefinito
> e la homepage perdeva l'ordine.

## `index.php` — cosa fa

In ordine: calcola se siamo in homepage, carica gli asset (preset Bootstrap Italia,
jQuery, carosello), disattiva l'asset `bootstrap.collapse` di Joomla quando è già
incluso nel bundle del template, e compone la pagina.

> **Perché disattiva `bootstrap.collapse`:** le pagine dei componenti (per esempio la
> modifica di un modulo dal frontend) fanno caricare a Joomla il proprio
> `collapse.min.js`, che si somma a quello già presente nel bundle Bootstrap Italia.
> Due gestori sullo stesso elemento si sfalsano e le fisarmoniche si aprono ma non si
> richiudono. La disattivazione è nel template, quindi sopravvive agli aggiornamenti
> del core.

Contiene inoltre tre routine JavaScript per l'accessibilità: etichette sulle frecce del
carosello, `h1` di riserva, rimozione degli attributi `title` ridondanti.
