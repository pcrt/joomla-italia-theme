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
| **Licenza** | GNU GPL v2 o successiva — vedi [LICENSE](LICENSE) |

---

## Cosa contiene questo repository

```
templates/joomla-italia-theme/          il template (override, layout, index.php)
media/templates/site/joomla-italia-theme/   css, js, font, immagini
plugins/system/singleedit/              plugin: una modifica alla volta dal frontend
docs/                                   documentazione
```

La struttura delle cartelle **rispecchia quella di Joomla**: per installare si copiano
le tre cartelle sulla radice del sito, senza spostare nulla.

> **Nota sulla struttura.** I file stanno nella posizione che occupano *dentro* un sito
> Joomla già installato. È comodo da leggere e da confrontare, ma **non è il formato che
> si aspetta l'installatore di Joomla**: nel pacchetto la cartella `media` deve stare
> dentro il template. Per questo c'è `build.sh`.

## Installazione

Vedi **[docs/INSTALLAZIONE.md](docs/INSTALLAZIONE.md)** per la procedura completa.

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
| [docs/INSTALLAZIONE.md](docs/INSTALLAZIONE.md) | installazione, requisiti, configurazione iniziale |
| [docs/STRUTTURA.md](docs/STRUTTURA.md) | com'è organizzato il codice, dove mettere le mani |
| [docs/MANUTENZIONE.md](docs/MANUTENZIONE.md) | convenzioni, trappole note, come non rompere niente |
| [docs/ACCESSIBILITA.md](docs/ACCESSIBILITA.md) | stato WCAG 2.1 AA misurato, cosa manca |
| [CHANGELOG.md](CHANGELOG.md) | cronologia delle modifiche |

## Stato dell'accessibilità

Il template è costruito con l'accessibilità come requisito: skip link, landmark ARIA,
etichette dei form, `alt` sulle immagini, viewport senza blocco dello zoom.

**Su 36 pagine misurate** non risulta nessun errore fra quelli verificabili
sull'HTML generato: 0 immagini senza `alt` (su 165), 0 pagine senza `<h1>`, 0 pagine con
più `<h1>`, 0 salti di livello nelle intestazioni, 0 `id` non validi o duplicati,
0 controlli che cambiano pagina alla selezione. Skip link, landmark, etichette dei form
e viewport corretti su tutte.

**Restano da verificare con un browser** i criteri che l'analisi statica non può
misurare — contrasto, focus visibile, zoom, reflow e in particolare **2.2.2** (il
carosello della homepage scorre da solo e serve un comando di pausa).
Il quadro completo è in **[docs/ACCESSIBILITA.md](docs/ACCESSIBILITA.md)**: leggerlo
prima di usare il template su un sito soggetto agli obblighi AgID.

## Problemi noti

- **Le mappe si caricano da `unpkg.com`**, un CDN esterno, benché le copie locali di
  Leaflet siano presenti nel repository. Rilevante per la privacy su siti PA:
  vedi docs/MANUTENZIONE.md
- **Duplicazione residua**: il blocco di condivisione social è ripetuto in 10 override
  di articolo e il blocco "indice della pagina" in 7. Non è un difetto funzionale,
  ma ogni correzione va applicata più volte.

## Licenza

GNU General Public License v2 o successiva.

Il template include override derivati dal codice sorgente di Joomla!, che è
distribuito sotto GPL: la licenza GPL è quindi obbligatoria per la ridistribuzione.

> **Da confermare dal titolare del copyright:** il file `templateDetails.xml` dichiara
> attualmente `<license>Protocolli Creativi</license>`, che non è una licenza valida e
> contraddice le intestazioni GPL presenti nei file. Va allineato a
> `GNU General Public License version 2 or later` (il plugin `singleedit` lo dichiara
> già correttamente).
