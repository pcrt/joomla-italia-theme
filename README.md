# Italia Theme for Joomla

## Tema Joomla per la Scuola

**Italia Theme for Joomla** è il tema Joomla che permette di aderire al
[modello di sito istituzionale delle scuole](https://designers.italia.it/modello/scuole/)
di Designers Italia. Fino alla versione 2.0.0 si chiamava *Joomla Italia Theme*.

Demo: https://jit.protocollicreativi.it/

Sviluppato da [Protocolli Creativi](https://www.protocollicreativi.it),
con l'ausilio di strumenti di intelligenza artificiale.

| | |
|---|---|
| **Versione** | 2.0.1 |
| **Joomla** | 5.x e 6.x — verificato su 5.4.7 e 6.1.2 |
| **PHP** | 8.1 o superiore — verificato su 8.4 |
| **Licenza** | [GNU AGPL v3](LICENSE) o successiva |

---

> ## ⚠️ Quale versione ti serve
>
> **Le versioni 2.x richiedono Joomla 5 o Joomla 6.** Non è compatibile con
> Joomla 4: non installarla su un sito Joomla 4, non funzionerebbe.
>
> **Se il tuo sito è ancora su Joomla 4**, usa la versione **1.2.1**, disponibile
> nella pagina [Releases](https://github.com/pcrt/italia-theme-for-joomla/releases)
> di questo repository insieme a tutte le versioni precedenti. Restano scaricabili
> e continueranno a funzionare.
>
> Per capire quale Joomla hai: pannello ▸ **Sistema ▸ Informazioni di sistema**.

---

## Indice

- [Cos'è](#cosè)
- [Cosa fa](#cosa-fa)
- [Da dove iniziare](#da-dove-iniziare)
- [Installazione](#installazione)
- [Configurazione del template](#configurazione-del-template)
- [Conformità al modello scuole](#conformità-al-modello-scuole)
- [Accessibilità](#accessibilità)
- [La community di riferimento](#la-community-di-riferimento)
- [F.A.Q.](#faq)
- [Licenze software dei componenti di terze parti](#licenze-software-dei-componenti-di-terze-parti)
- [Segnalazione bug](#segnalazione-bug)
- [Documentazione](#documentazione)

---

## Cos'è

Il modello di sito istituzionale delle scuole nasce nel progetto **Designers
Italia** per dare agli istituti un sito coerente, accessibile e riconoscibile,
senza che ogni scuola debba riprogettare tutto da capo.

Il modello è stato pubblicato come tema WordPress. **Italia Theme for Joomla porta lo
stesso modello su Joomla**: stessa struttura di contenuti, stessa impostazione
grafica, stessi componenti di [Bootstrap Italia](https://italia.github.io/bootstrap-italia/).

### Bootstrap Italia

È la libreria che implementa le linee guida di design per i servizi web della
Pubblica Amministrazione italiana. Basata su [Bootstrap 5](https://getbootstrap.com/),
fornisce componenti già conformi: colori, tipografia, moduli, schede, menu.

---

## Cosa fa

Il tema **non aggiunge componenti a Joomla**: usa esclusivamente ciò che Joomla
già offre — articoli, categorie, menu, moduli, campi personalizzati — e ne cambia
la presentazione.

Questo significa tre cose:

- **niente da imparare oltre a Joomla**: chi sa usare il pannello sa usare il tema;
- **nessun blocco tecnologico**: disinstallando il tema i contenuti restano al loro
  posto, intatti;
- **aggiornamenti di Joomla senza sorprese**: il tema non sostituisce parti del core.

Il tema fornisce le pagine previste dal modello — schede servizio, luoghi,
strutture organizzative, documenti, notizie, circolari, eventi, schede didattiche,
progetti — insieme ai campi che le compongono, già configurati.

---

## Da dove iniziare

Un sito dimostrativo è disponibile su
[jit.protocollicreativi.it](https://jit.protocollicreativi.it): è il punto di
partenza consigliato per capire come organizzare i contenuti prima di scriverli.

Se stai partendo da zero, l'ordine di lavoro consigliato è in
**[doc/doc.md](doc/doc.md)**.

---

## Installazione

I file di questo repository stanno nella posizione che occupano **dentro un sito
Joomla già installato**. L'installatore di Joomla si aspetta invece un pacchetto in
cui la cartella `media` sta **dentro** il template: `build.sh` riorganizza i file e
produce i due pacchetti pronti.

```bash
bash build.sh
# dist/joomla-italia-theme-2.0.0.zip
# dist/plg_system_singleedit-1.0.0.zip
```

Il secondo pacchetto è **facoltativo**: il template funziona da solo. Il plugin
`singleedit` impedisce a due persone di modificare lo stesso contenuto nello stesso
momento — utile dove più redattori lavorano insieme, inutile se il sito lo aggiorna
una persona sola.

Poi dal pannello: **Sistema ▸ Installa ▸ Carica file di pacchetto**, e infine
**Sistema ▸ Stili del sito** per impostare *Italia Theme for Joomla* (`joomla-italia-theme`) come predefinito.

La procedura completa, con i requisiti e le verifiche successive, è in
**[doc/installazione.md](doc/installazione.md)**.

> **Errore frequente:** se il template risulta installato ma il sito appare senza
> grafica, controlla che lo stile abbia `inheritable = 1`. Con `0` Joomla non carica
> gli asset del template, e non viene mostrato nessun messaggio d'errore.

---

## Configurazione del template

**Sistema ▸ Stili del sito ▸ Italia Theme for Joomla** (`joomla-italia-theme`)

I parametri sono divisi in sei gruppi:

| Gruppo | Cosa configura |
|---|---|
| **Topbar** | la barra in cima, con messaggio e pulsanti (es. Area Riservata) |
| **Logo** | logo dell'istituto e testi affiancati |
| **Social** | collegamenti ai profili social |
| **Banner** | il carosello della homepage |
| **Logo footer** | logo nel piè di pagina e logo dell'Unione Europea |
| **Copyright** | il testo di copyright |

I campi si mostrano e si nascondono a seconda delle scelte fatte: non serve
conoscere il codice per configurare il sito.

Il tema mette a disposizione **27 posizioni modulo** e otto tipi di voce di menu
dedicati alle sezioni del modello. Dettagli in [doc/moduli.md](doc/moduli.md) e
[doc/menu.md](doc/menu.md).

---

## Conformità al modello scuole

Il sito demo, con la versione 2.0.1, è stato verificato il 15 ottobre 2026 con
l'[App di valutazione dei modelli](https://github.com/italia/pa-website-validator-ng)
del Dipartimento per la Trasformazione Digitale (versione 1.1.40, modello scuole):

- **8 criteri di conformità obbligatori su 9 superati**: font, Bootstrap Italia,
  tema CMS, menu di primo e secondo livello, informativa privacy, cookie, HTTPS;
- l'unico non superato è la **dichiarazione di accessibilità**, che ogni scuola
  deve pubblicare sul sito di AgID e collegare dal footer: non dipende dal tema;
- tra le raccomandazioni risultano superate schede servizio, vocabolari
  controllati e licenza dei contenuti (CC-BY 4.0 nelle note legali).

Il risultato dipende anche da come vengono inseriti i contenuti: la guida
[doc/doc.md](doc/doc.md) indica l'alberatura e i layout da usare.

---

## Accessibilità

L'accessibilità è un requisito di legge per i siti scolastici, non un
miglioramento facoltativo.

Su **36 pagine misurate sull'HTML generato** non risulta alcun errore fra quelli
verificabili staticamente: nessuna immagine priva di testo alternativo (su 165),
nessuna pagina senza `<h1>` o con più di uno, nessun salto di livello nelle
intestazioni, nessun identificativo HTML non valido o duplicato, nessun controllo
che cambi pagina alla semplice selezione. Skip link, landmark ARIA, etichette dei
moduli e viewport risultano corretti su tutte le pagine.

**Restano da verificare con un browser** i criteri che un'analisi statica non può
misurare: contrasto dei colori, focus visibile, navigazione da tastiera, zoom al
200% e reflow a 320 px.

Il quadro completo, con i criteri verificati e quelli ancora aperti, è in
**[doc/accessibilita.md](doc/accessibilita.md)**. **Leggilo prima di pubblicare la
dichiarazione di accessibilità**: la conformità è autodichiarata e la
responsabilità resta di chi la firma.

---

## La community di riferimento

- [Forum Italia](https://forum.italia.it/) — sezione dedicata ai servizi di design
- [Canale Slack `#design-siti-scuole`](http://developersitalia.slack.com/messages/design-siti-scuole)
- [Tema WordPress del modello scuole](https://github.com/italia/design-scuole-wordpress-theme)
- [Pagine statiche del modello scuole](https://github.com/italia/design-scuole-pagine-statiche)
- [Porte Aperte sul Web](https://www.porteapertesulweb.it/)
- [Team per la Trasformazione Digitale](https://teamdigitale.governo.it/)

---

## F.A.Q.

### Chi gestisce il sito?

Il personale della scuola, dal pannello di Joomla. Il tema è pensato perché le
operazioni quotidiane — pubblicare una circolare, aggiungere un evento, aggiornare
una scheda — si facciano senza toccare codice.

### Perché esiste un tema anche per Joomla?

Il modello per le scuole è stato pubblicato come tema WordPress, ma molte scuole
italiane usano Joomla. Questo tema permette di aderire allo stesso modello senza
dover migrare la piattaforma, il che significa non rifare da zero contenuti e
formazione del personale.

### Quali sono i benefici dell'uso del tema?

Un sito conforme al modello nazionale, con una struttura dei contenuti già
progettata e verificata: la scuola non deve decidere come organizzare le
informazioni, né progettare le pagine. In più, l'accessibilità è considerata fin
dall'impostazione, non aggiunta dopo.

### Posso fare dei cambiamenti al sito?

Sì. Contenuti, menu, moduli, colori dei parametri e struttura delle categorie sono
completamente nelle tue mani: sono funzioni standard di Joomla.

### È consigliato fare cambiamenti al codice?

**No, se puoi evitarlo.** Modificare i file sovrascritti (`html/`) o i fogli di
stile rende più difficili gli aggiornamenti futuri: le modifiche verrebbero
sovrascritte, o andrebbero riapplicate a mano ogni volta.

Se una personalizzazione ti serve davvero, leggi prima
[doc/manutenzione.md](doc/manutenzione.md): documenta le convenzioni del tema — in
particolare le cartelle `_condiviso/`, dove **un solo file** governa il
comportamento di più pagine, e le trappole già incontrate da chi ci ha lavorato.

---

## Licenze software dei componenti di terze parti

Il tema usa esclusivamente il core di Joomla! e distribuisce le librerie seguenti,
tutte con licenze open source:

| Componente | Licenza |
|---|---|
| [Bootstrap Italia](https://italia.github.io/bootstrap-italia/) (bundle, include Bootstrap 5 e Popper.js) | BSD-3-Clause |
| [jQuery](https://jquery.com/) 3.6.2 | MIT |
| [Owl Carousel 2](https://owlcarousel2.github.io/OwlCarousel2/) | MIT |
| [Leaflet](https://leafletjs.com/) 1.9.4 | BSD-2-Clause |
| Font [Titillium Web](https://fonts.google.com/specimen/Titillium+Web) | SIL Open Font License 1.1 |
| Font [Lora](https://fonts.google.com/specimen/Lora) | SIL Open Font License 1.1 |
| Font [Roboto Mono](https://fonts.google.com/specimen/Roboto+Mono) | Apache License 2.0 |

I font sono distribuiti **localmente** insieme al tema, nei formati `woff2` e
`woff`: nessuna richiesta viene inviata a servizi esterni per caricarli.

---

## Segnalazione bug

Apri una *issue* su questo repository indicando:

- versione di Joomla e di PHP (**Sistema ▸ Informazioni di sistema**)
- versione del tema (**Sistema ▸ Gestione estensioni**)
- l'indirizzo della pagina in cui si verifica il problema
- cosa ti aspettavi e cosa è successo

Se il problema riguarda l'aspetto allega uno screenshot; se riguarda un errore,
allega il testo esatto del messaggio.

---

## Documentazione

La documentazione completa è in **[doc/doc.md](doc/doc.md)**.

**Per chi gestisce il sito dal pannello:**

| Guida | Contenuto |
|---|---|
| [configurazione-joomla.md](doc/configurazione-joomla.md) | impostazioni di Joomla, multilingua, permessi |
| [alberatura-categorie.md](doc/alberatura-categorie.md) | la struttura delle categorie e perché viene prima di tutto |
| [inserimento-articoli.md](doc/inserimento-articoli.md) | scrivere e pubblicare un contenuto, passo passo |
| [custom-field-articoli.md](doc/custom-field-articoli.md) | i campi aggiuntivi, categoria per categoria |
| [custom-field-categoria.md](doc/custom-field-categoria.md) | i campi delle categorie: timeline, strutture |
| [menu.md](doc/menu.md) | menu, voci di navigazione, tipi di pagina |
| [moduli.md](doc/moduli.md) | i blocchi che compongono le pagine |
| [topbar.md](doc/topbar.md) · [header.md](doc/header.md) · [footer.md](doc/footer.md) | le tre zone fisse del sito |

**Per chi lavora sul codice:**

| Guida | Contenuto |
|---|---|
| [installazione.md](doc/installazione.md) | installazione, requisiti, pacchetti |
| [struttura.md](doc/struttura.md) | come è organizzato il codice del tema |
| [manutenzione.md](doc/manutenzione.md) | convenzioni e trappole note |
| [accessibilita.md](doc/accessibilita.md) | stato WCAG 2.1 AA e verifiche mancanti |

La cronologia delle modifiche è in [CHANGELOG.md](CHANGELOG.md).

---

## Licenza

**GNU Affero General Public License v3.0 o successiva** — vedi [LICENSE](LICENSE).

Attribuzioni in [AUTHORS](AUTHORS).

Questo programma è software libero: puoi redistribuirlo e modificarlo secondo i
termini della GNU AGPL pubblicata dalla Free Software Foundation. È distribuito
nella speranza che sia utile, ma **SENZA ALCUNA GARANZIA**.
Vedi <http://www.gnu.org/licenses/>.

## Marchi

Joomla!® è un marchio registrato di Open Source Matters, Inc. negli Stati Uniti
e in altri Paesi. Italia Theme for Joomla è un progetto indipendente di
Protocolli Creativi: non è affiliato né approvato da Open Source Matters o dal
Joomla! Project.
