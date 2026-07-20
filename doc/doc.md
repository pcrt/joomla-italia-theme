# Documentazione — Joomla Italia Theme

Guida all'uso e alla configurazione del tema per i siti scolastici, basato sul
**modello di sito istituzionale delle scuole** di Designers Italia e su
**Bootstrap Italia**.

Questa documentazione è pensata per **chi gestisce il sito dal pannello**, non per
chi scrive codice: dove serve mettere le mani nel codice è indicato esplicitamente.

---

## Da dove iniziare

Se stai partendo da zero, l'ordine consigliato è questo:

| # | Passo | Documento |
|---|---|---|
| 1 | Installare il tema e il plugin | [installazione.md](installazione.md) |
| 2 | Impostazioni generali di Joomla | [configurazione-joomla.md](configurazione-joomla.md) |
| 3 | Costruire l'albero delle categorie | [alberatura-categorie.md](alberatura-categorie.md) |
| 4 | Configurare la barra in cima | [topbar.md](topbar.md) |
| 5 | Logo, menu e ricerca | [header.md](header.md) |
| 6 | Menu e voci di navigazione | [menu.md](menu.md) |
| 7 | Blocchi della homepage e interni | [moduli.md](moduli.md) |
| 8 | Piè di pagina | [footer.md](footer.md) |
| 9 | Scrivere il primo articolo | [inserimento-articoli.md](inserimento-articoli.md) |

## Riferimento

| Documento | Contenuto |
|---|---|
| [custom-field-articoli.md](custom-field-articoli.md) | i campi aggiuntivi degli articoli, categoria per categoria |
| [custom-field-categoria.md](custom-field-categoria.md) | i campi aggiuntivi delle categorie (timeline, strutture) |
| [struttura.md](struttura.md) | come è organizzato il codice del tema |
| [manutenzione.md](manutenzione.md) | convenzioni e trappole note, per chi tocca il codice |
| [accessibilita.md](accessibilita.md) | stato WCAG 2.1 AA misurato e verifiche mancanti |

---

## Come funziona il tema, in breve

Il tema **non aggiunge componenti**: usa esclusivamente il contenuto di Joomla
(articoli, categorie, menu, moduli). Quello che fa è **presentarlo** secondo il
modello per le scuole.

Tre meccanismi da conoscere:

**1. La categoria decide l'aspetto.** Un articolo in *Notizie* si vede come una
notizia, uno in *Servizi* come una scheda servizio. Non c'è un interruttore da
premere: conta la categoria in cui lo metti. Per questo l'albero delle categorie
va costruito prima dei contenuti.

**2. I campi aggiuntivi cambiano per categoria.** Un articolo in *Servizi* chiede
"Cos'è", "A cosa serve", "Come si accede"; uno in *Eventi* chiede luogo e date.
Sono i **campi personalizzati** di Joomla, già configurati e assegnati alle
categorie giuste.

**3. Le pagine sono composte da moduli.** La homepage non è un articolo: è un
insieme di blocchi (notizie, servizi, didattica) assegnati alla voce di menu della
home. Vedi [moduli.md](moduli.md).

---

## Attenzione: aggiornamenti futuri

Il tema è progettato per essere configurato dal pannello. **Modificare i file
sovrascritti (`html/`) o i fogli di stile rende più difficili gli aggiornamenti
futuri**: le tue modifiche verrebbero sovrascritte, o dovrebbero essere riapplicate
a mano ogni volta.

Se una personalizzazione ti serve davvero, leggi prima
[manutenzione.md](manutenzione.md): spiega le convenzioni del tema — in
particolare le cartelle `_condiviso/`, dove **un file solo** governa il
comportamento di più pagine.

---

## Segnalare un problema

Apri una *issue* sul repository indicando:

- versione di Joomla e di PHP (Sistema ▸ Informazioni di sistema)
- versione del tema (Sistema ▸ Gestione estensioni)
- la pagina in cui si verifica il problema
- cosa ti aspettavi e cosa è successo

Se il problema riguarda l'aspetto, allega uno screenshot; se riguarda un errore,
allega il testo esatto del messaggio.
