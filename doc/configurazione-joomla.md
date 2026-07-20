# Configurazione di Joomla

Le impostazioni da sistemare **prima** di iniziare a inserire contenuti.

**Dove:** Pannello ▸ **Sistema ▸ Configurazione globale**.

---

## Impostazioni generali

| Impostazione | Valore consigliato | Perché |
|---|---|---|
| **Nome sito** | il nome dell'istituto | compare nel titolo delle pagine |
| **Editor predefinito** | TinyMCE | l'editor visuale, il più semplice |
| **Cattura errori** | Predefinito | in produzione non mostrare dettagli tecnici |
| **Debug del sito** | **No** | se attivo, i visitatori vedono informazioni interne |

## Indirizzi leggibili (SEF)

Scheda **Sito ▸ Impostazioni SEO**:

| Impostazione | Valore |
|---|---|
| URL SEF | **Sì** |
| Riscrittura URL | **Sì** (richiede il file `.htaccess`) |
| Aggiungi suffisso agli URL | No |

Così gli indirizzi diventano `/novita/notizie/titolo-articolo` invece di
`index.php?option=com_content&view=article&id=42`.

> Per attivare la riscrittura serve rinominare `htaccess.txt` in `.htaccess` nella
> cartella principale del sito. Se dopo l'attivazione tutte le pagine danno errore,
> il file manca o il server non la consente: rimetti *Riscrittura URL* su No e
> chiedi al provider.

---

## Sito multilingua

Serve quando il sito esiste in italiano e in un'altra lingua.

1. **Sistema ▸ Lingue** — installa le lingue
2. **Sistema ▸ Lingue del contenuto** — pubblica ogni lingua
3. **Sistema ▸ Plugin** — attiva **Filtro lingua**
4. Crea **una home page per ogni lingua**, ciascuna nel proprio menu, con il
   campo *Predefinito* impostato per quella lingua
5. Aggiungi il modulo **Lingua** in posizione `lingua`

> **La regola che si dimentica sempre:** ogni lingua vuole la propria home page.
> E i moduli di contenuto vanno assegnati **alla home di ogni lingua**, altrimenti
> le altre lingue mostrano una pagina vuota.

Vedi [moduli.md](moduli.md).

---

## Permessi: la cosa che blocca i redattori

Questa merita attenzione perché genera un problema che sembra un guasto.

Nel modello per le scuole quasi tutte le categorie hanno **campi obbligatori**.
Ma modificare il valore di un campo personalizzato richiede un permesso
specifico, che **non è concesso a nessun gruppo per impostazione predefinita**.

Conseguenza: un redattore compila tutto correttamente, salva, e Joomla risponde
**"Campo richiesto"** scartando il valore. Succede sia dal pannello sia dal sito.
In pratica **solo i Super User riescono a salvare**.

**Come si concede:**

1. Pannello ▸ **Contenuti ▸ Campi ▸ Opzioni ▸ Permessi**
2. Scegli il gruppo (es. *Editor*, *Publisher*)
3. Imposta **Modifica valore campo personalizzato** su *Consentito*
4. Salva

### Chi può fare cosa

| Gruppo | Pannello | Dal sito |
|---|---|---|
| **Super User** | tutto | tutto, compresi i moduli |
| **Administrator / Manager** | sì | modifica articoli, **non** i moduli |
| **Publisher** | no | modifica e pubblica articoli |
| **Editor** | no | modifica articoli, non pubblica |
| **Author** | no | crea articoli propri |
| **Registered** | no | solo lettura |

---

## Modifica dal sito (front-editing)

Scheda **Sito ▸ Modifica frontend**. Se attiva, chi ha i permessi vede le icone di
modifica direttamente sulle pagine.

Comoda per chi non ama il pannello. Da valutare su siti con molti redattori: si
modifica "dal vivo", con meno controllo.

---

## Tour guidati: se l'editor sembra rotto

Joomla 5 e 6 mostrano dei **tour guidati** che aprono finestre sopra il modulo di
modifica. Capita che sembrino un guasto: *"si è aperto l'articolo ma non riesco a
scrivere nel corpo"*.

**Non è un difetto del tema né di Joomla.** È il tour guidato che intercetta i
click. Si chiude con la X, oppure si disattivano del tutto:

Pannello ▸ **Sistema ▸ Tour guidati** ▸ seleziona tutto ▸ **Azioni ▸ Non pubblicare**

> È una delle segnalazioni più frequenti dopo un aggiornamento a Joomla 5/6, e
> quasi sempre viene scambiata per un problema dell'editor.

---

## Cache

Scheda **Sistema ▸ Cache**. In fase di costruzione tienila **disattivata**: con la
cache attiva le modifiche non si vedono subito e si finisce per cercare problemi
che non esistono.

Ad attivarla si fa sempre in tempo, a sito finito.

Se una modifica non compare: **Sistema ▸ Svuota la cache**, poi **Ctrl+F5** sul
browser.
