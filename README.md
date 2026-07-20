# Joomla Italia Theme

Template Joomla per scuole e Pubbliche Amministrazioni, basato su
[Bootstrap Italia](https://italia.github.io/bootstrap-italia/) e sulle linee guida
di design per i siti della PA.

Sviluppato da [Protocolli Creativi](https://www.protocollicreativi.it).

| | |
|---|---|
| **Versione template** | 1.2.1 |
| **Joomla** | 5.x e 6.x (verificato su 5.4.7 e 6.1.2) |
| **PHP** | 8.1+ (verificato su 8.4) |
| **Licenza** | GNU AGPL v3 o successiva — vedi [LICENSE](LICENSE) |

---

## Cosa contiene questo repository

```
templates/joomla-italia-theme/          il template (override, layout, index.php)
media/templates/site/joomla-italia-theme/   css, js, font, immagini
plugins/system/singleedit/              plugin: una modifica alla volta dal frontend
doc/                                   documentazione
```

La struttura delle cartelle **rispecchia quella di Joomla**: per installare si copiano
le tre cartelle sulla radice del sito, senza spostare nulla.

> **Nota sulla struttura.** I file stanno nella posizione che occupano *dentro* un sito
> Joomla già installato. È comodo da leggere e da confrontare, ma **non è il formato che
> si aspetta l'installatore di Joomla**: nel pacchetto la cartella `media` deve stare
> dentro il template. Per questo c'è `build.sh`.

## Installazione

Vedi **[doc/installazione.md](doc/installazione.md)** per la procedura completa.

**Metodo consigliato — pacchetto installabile:**

```bash
bash build.sh          # crea dist/joomla-italia-theme-1.2.1.zip e dist/plg_system_singleedit-1.0.0.zip
```

Poi nel pannello: **Sistema ▸ Installa ▸ Carica file di pacchetto**, e infine
**Sistema ▸ Stili del sito** per impostare *Joomla Italia Theme* come predefinito.

*Verificato:* i pacchetti prodotti da `build.sh` sono stati installati con l'installatore
di Joomla su **Joomla 5.4.7** (partendo da template assente) e su **Joomla 6.1.2**, e in
entrambi i casi i file finiscono nelle posizioni corrette e il sito funziona senza errori.

> **Attenzione — errore frequente:** se il template risulta installato ma il sito appare
> senza grafica, controllare che lo stile abbia `inheritable = 1`. Con `0` Joomla non
> carica gli asset del template.

## Documentazione

| Documento | Contenuto |
|---|---|
| [doc/installazione.md](doc/installazione.md) | installazione, requisiti, configurazione iniziale |
| [doc/struttura.md](doc/struttura.md) | com'è organizzato il codice, dove mettere le mani |
| [doc/manutenzione.md](doc/manutenzione.md) | convenzioni, trappole note, come non rompere niente |
| [doc/accessibilita.md](doc/accessibilita.md) | stato WCAG 2.1 AA misurato, cosa manca |
| [CHANGELOG.md](CHANGELOG.md) | cronologia delle modifiche |

## Stato dell'accessibilità

Il template è costruito con l'accessibilità come requisito: skip link, landmark ARIA,
etichette dei form, `alt` sulle immagini, viewport senza blocco dello zoom.

**Su 36 pagine misurate** non risulta nessun errore fra quelli verificabili
sull'HTML generato: 0 immagini senza `alt` (su 165), 0 pagine senza `<h1>`, 0 pagine con
più `<h1>`, 0 salti di livello nelle intestazioni, 0 `id` non validi o duplicati,
0 controlli che cambiano pagina alla selezione. Skip link, landmark, etichette dei form
e viewport corretti su tutte.

Il criterio **2.2.2** (contenuti in movimento) **non si applica**: il carosello della
homepage ha `autoplay: false` e non scorre da solo — verificato anche che nel tema non
esistono altri contenuti ad avanzamento automatico.

**Restano da verificare con un browser** i criteri che l'analisi statica non può
misurare: contrasto dei colori, focus visibile, navigazione da tastiera, zoom al 200%
e reflow a 320 px.
Il quadro completo è in **[doc/accessibilita.md](doc/accessibilita.md)**: leggerlo
prima di usare il template su un sito soggetto agli obblighi AgID.

## Problemi noti

- **Le mappe si caricano da `unpkg.com`**, un CDN esterno, benché le copie locali di
  Leaflet siano presenti nel repository. Rilevante per la privacy su siti PA:
  vedi doc/manutenzione.md
- **Duplicazione residua**: il blocco di condivisione social è ripetuto in 10 override
  di articolo e il blocco "indice della pagina" in 7. Non è un difetto funzionale,
  ma ogni correzione va applicata più volte.

## Licenza

**GNU Affero General Public License v3.0 o successiva** — vedi [LICENSE](LICENSE).

È la stessa licenza del progetto originale
[pcrt/joomla-italia-theme](https://github.com/pcrt/joomla-italia-theme).
La dichiarazione è allineata in `templateDetails.xml`, nel manifesto del plugin
`singleedit` e nel file `LICENSE`.

Il template usa esclusivamente il contenuto del core di Joomla! e integra librerie di
terze parti distribuite con licenze open source (Bootstrap Italia, jQuery, Leaflet,
Owl Carousel, i font Titillium Web, Lora e Roboto Mono).

Attribuzioni in [AUTHORS](AUTHORS).
