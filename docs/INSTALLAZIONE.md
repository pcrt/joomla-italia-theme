# Installazione

## Requisiti

| | |
|---|---|
| Joomla | 5.x o 6.x (verificato su 5.4.7 e 6.1.2) |
| PHP | 8.1 o superiore (verificato su 8.4) |
| Estensioni PHP | quelle richieste da Joomla; per le mappe nessuna aggiuntiva |

Il template non richiede jQuery del core Joomla (rimosso da Joomla 5): include una
propria copia di jQuery 3.6.2, dichiarata negli asset del template.

## Installazione

### Metodo consigliato — pacchetto installabile

I file di questo repository stanno nella posizione che occupano **dentro un sito Joomla
già installato**. L'installatore di Joomla si aspetta invece un pacchetto in cui la
cartella `media` sta **dentro** il template, come dichiarato in `templateDetails.xml`:

```xml
<media destination="templates/site/joomla-italia-theme" folder="media">
```

`build.sh` riorganizza i file nel modo giusto e produce i due pacchetti:

```bash
bash build.sh
# dist/joomla-italia-theme-1.2.1.zip
# dist/plg_system_singleedit-1.0.0.zip
```

1. Pannello ▸ **Sistema ▸ Installa ▸ Carica file di pacchetto** ▸ caricare i due zip
2. Pannello ▸ **Sistema ▸ Stili del sito** ▸ aprire *Joomla Italia Theme* ▸
   **Predefinito** (la stella)
3. Pannello ▸ **Sistema ▸ Plugin** ▸ cercare *Single Edit* ▸ **Abilita**
   (solo se serve il blocco della modifica simultanea)

> **Verificato end-to-end:** i pacchetti prodotti da `build.sh` sono stati installati
> con l'installatore di Joomla su **Joomla 5.4.7** (partendo da template completamente
> assente dal disco) e su **Joomla 6.1.2**. In entrambi i casi i 265 file del template e
> i 71 di `media` — font compresi — finiscono nelle posizioni corrette, e il crawl di
> tutte le pagine non produce errori.

### Metodo alternativo — copia dei file

Utile per aggiornare un sito esistente senza reinstallare:

1. Copiare sulla radice del sito Joomla `templates/joomla-italia-theme/`,
   `media/templates/site/joomla-italia-theme/` e `plugins/system/singleedit/`
2. Pannello ▸ **Sistema ▸ Pannello Estensioni ▸ Individua** ▸ **Individua** ▸
   selezionare le estensioni ▸ **Installa**

### Verifica dopo l'installazione

Aprire il sito e controllare che la grafica sia applicata.

> **Se il sito appare senza grafica** (testo nudo, nessuno stile): aprire lo stile del
> template e verificare che sia **ereditabile**. In Joomla il campo `inheritable` a `0`
> impedisce il caricamento degli asset del template. Deve essere `1`.
> È l'errore più frequente in fase di installazione e non produce nessun messaggio.

## Configurazione del template

Pannello ▸ **Sistema ▸ Stili del sito** ▸ *Joomla Italia Theme*.

I parametri sono divisi in 6 gruppi:

| Gruppo | Cosa configura |
|---|---|
| `topbarmessage` | testo della barra in cima, con link facoltativo |
| `logo` | logo dell'ente e testi affiancati |
| `social` | collegamenti ai profili social |
| `banner` | carosello della homepage |
| `logofooter` | logo nel piè di pagina |
| `copyright` | testo di copyright |

I campi si mostrano e nascondono a seconda delle scelte fatte, quindi non serve
conoscere il codice per configurare il sito.

## Posizioni modulo disponibili

27 posizioni:

```
logo              menuprincipale    menusecondario    lingua
cerca             bottonecerca      hero              breadcrumbs
above             above1            above2            above3
below             below1            below2            below3
user              menucerca         menublog          menumodulorows
textmodulorows    footer1           footer2           footer3
footer4           arealegale        copyright
```

I blocchi di contenuto della homepage (notizie, servizi, didattica) vanno nelle
posizioni `below*` e assegnati alla voce di menu della home.

> **Siti multilingua:** i blocchi vanno assegnati alla voce di menu della home **di
> ogni lingua**. Se si assegnano solo alla home italiana, la home nelle altre lingue
> risulterà vuota — mostrerà solo intestazione, menu e piè di pagina.

## Il plugin `singleedit`

Plugin di sistema facoltativo: impedisce a un utente di aprire **una seconda scheda di
modifica** dal frontend mentre ne ha già una aperta (articoli e moduli).

Utile dove più redattori lavorano sugli stessi contenuti e si vogliono evitare
sovrascritture accidentali.

Funziona con un blocco in **sessione**, non con il `checked_out` del database: aprire un
modulo dal frontend non imposta il check-out di Joomla, quindi un approccio basato sul
database bloccherebbe gli articoli ma non i moduli. Il blocco si libera al salvataggio o
all'annullamento, e scade dopo 60 minuti di inattività.

## Disinstallazione

Rimuovere le estensioni dal pannello (**Sistema ▸ Gestione Estensioni**). Le cartelle
copiate a mano in `media/` vanno eventualmente rimosse a mano.
