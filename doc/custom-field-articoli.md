# Campi aggiuntivi degli articoli

I **campi personalizzati** di Joomla sono le informazioni strutturate che
accompagnano un articolo: orari, indirizzi, allegati, date. Il tema li usa per
comporre le schede previste dal modello per le scuole.

**Non li devi creare tu: sono già configurati e assegnati alle categorie.**

**Dove si vedono:** Pannello ▸ **Contenuti ▸ Campi**.
**Dove si compilano:** aprendo un articolo, nelle schede accanto a *Contenuto*.

---

## La regola da capire

**I campi compaiono in base alla categoria dell'articolo.**

Su un articolo **nuovo** il pannello mostra i campi **solo dopo aver scelto la
categoria**: prima di quel momento le schede sono vuote. Non è un difetto —
scegli la categoria e i campi appaiono.

---

## Quali campi per quale categoria

### Servizi
La scheda più ricca, dal modello dei servizi pubblici.

| Campo | Obbligatorio |
|---|---|
| Cos'è | ✅ |
| A cosa serve | ✅ |
| Come si accede al servizio | ✅ |
| Cosa serve (elenco ripetibile) | ✅ |
| Tempi e scadenze | ✅ |
| Contatti | ✅ |
| Ulteriori informazioni | ✅ |
| Accesso online, Prenota appuntamento | — |
| Calendario tempi e scadenze | — |
| Luoghi in cui viene erogato | — |
| Servizi correlati, Struttura responsabile, Progetti correlati | — |

### Notizie
| Campo | Obbligatorio |
|---|---|
| Descrizione Notizie | ✅ |

### Circolari
| Campo | Obbligatorio |
|---|---|
| Descrizione Notizie | ✅ |
| Circolare n. | — |

### Eventi
| Campo | Obbligatorio |
|---|---|
| Cos'è | ✅ |
| Contatti | ✅ |
| Luogo, Date e Orari, Data Evento | — |

### I luoghi *(e sottocategorie: Edifici, Biblioteca, Laboratori, Palestra)*
| Campo | Obbligatorio |
|---|---|
| Descrizione | ✅ |
| Dove si trova, Servizi presenti, Il Luogo è sede di | — |
| Dettagli edificio, Galleria | — |

### Organizzazione *(e sottocategorie)*
| Campo | Obbligatorio |
|---|---|
| Cosa fa | ✅ |
| Contatta la struttura | ✅ |
| Servizi di cui la struttura è responsabile, Sede | — |

### Le carte della scuola *(e sottocategorie)*
| Campo | Obbligatorio |
|---|---|
| Descrizione | ✅ |
| Servizi Collegati | — |
| Allegati *(solo sulla categoria principale)* | — |

### Le schede didattiche
| Campo | Obbligatorio |
|---|---|
| Tempo di apprendimento | ✅ |
| Obiettivi, Argomento, Attività, Documenti | — |

### I progetti delle classi
| Campo | Obbligatorio |
|---|---|
| Presentazione, Obiettivi, Responsabile | — |
| Luogo, Servizi associati, Documenti | — |

---

## Tipi di campo e come si compilano

| Tipo | Come funziona |
|---|---|
| **Testo / Area di testo** | testo semplice |
| **Editor** | testo formattato, con grassetto e collegamenti |
| **URL** | un indirizzo web completo, con `https://` |
| **Calendario** | selettore di data |
| **Media** | scelta di un'immagine dal Media manager |
| **Subform** | **elenco ripetibile**: il pulsante *+* aggiunge una riga |
| **SQL** | menu a tendina che elenca contenuti già presenti nel sito |

### I campi "SQL": i collegamenti fra contenuti

Campi come *Servizi correlati*, *Struttura responsabile*, *Il Luogo è sede di*
mostrano un elenco di articoli già pubblicati. Servono a **collegare le schede fra
loro**: un servizio alla struttura che lo eroga, un luogo ai servizi che ospita.

> Se la tendina è vuota, non è un guasto: **non hai ancora creato i contenuti da
> collegare**. Crea prima le strutture e i luoghi, poi i servizi.

---

## Due cose che confondono

### "Campo richiesto" senza il nome del campo

Al salvataggio può comparire *Campo richiesto:* con l'etichetta vuota. Le cause
tipiche sono due:

1. **Un campo obbligatorio è vuoto** ma non è visibile perché si trova in una
   scheda che non hai aperto. Controlla tutte le schede dell'articolo.
2. **Non hai il permesso di modificare i campi personalizzati.** È il caso più
   insidioso, perché sembra un problema del contenuto.

### Solo alcuni utenti riescono a salvare

Modificare il **valore** di un campo personalizzato richiede il permesso
*Modifica valore campo personalizzato* (`core.edit.value`). Se non è concesso, un
redattore compila il campo, salva, e Joomla **scarta il valore** rispondendo
"Campo richiesto" — sia dal pannello sia dal sito.

**Dove si concede:** Pannello ▸ **Contenuti ▸ Campi ▸ Opzioni ▸ Permessi**,
sul gruppo che deve poter scrivere.

> Se non lo imposti, in pratica **solo i Super User riescono a salvare articoli**
> nelle categorie con campi obbligatori — cioè quasi tutte. È la spiegazione più
> frequente del "a me non fa salvare e al collega sì".
