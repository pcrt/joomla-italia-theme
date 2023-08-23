# Custom field articoli

Al fine di ottenere il massimo del punteggio nell’app di valutazione scuole e per una corretta visualizzazione delle pagine è necessario creare e configurare i custom field come descritto nei prossimi paragrafi. Inoltre è importante che i titoli di alcuni custom field siano scritti esattamente come descritto di seguito, facendo particolare attenzione anche a maiuscole e minuscole. Per una corretta visualizzazione nel front-end dei campi nelle schede servizio, è necessario che questi vengano generati nell’ordine come descritto di seguito. 

La prima operazione da fare è suddividere i custom field per gruppi, in base alla tipologia di sezione che si andrà a creare.

## Custom field Scuola

### Gruppo campi Luoghi

Creare un nuovo gruppo di campi di tipo “Articolo” denominato “Luoghi”.
Quindi andare in Contenuto -> Gruppi di campi -> Filtrare la voce in alto a sinistra in Articolo -> Nuovo -> compilare il campo titolo “Luoghi”. 

### Descrizione

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Editor (editor) 
- Nome: descrizione-luogo 
- Etichetta: Descrizione 
- Obbligatorio: Sì 
- Usa solo in sottomodulo: No 
- Mostra pulsanti: Usa impostazioni Plugin 
- Filtro: Usa impostazioni Plugin 
- Stato: Pubblicato 
- Gruppo di campi: Luoghi 
- Categoria: I luoghi

![custom-field-descrizione-luogo](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-descrizione-luogo.png)

Nella tab Opzioni impostare:

- Modificabile in: entrambi 
- Mostra etichetta: mostra 
- Visualizza il campo: dopo il contenuto del display 
- Layout: generale 
- Mostra se di sola lettura: eredita

### Servizi presenti

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: SQL (sql) 
- Nome: servizi-presenti 
- Etichetta: Servizi Presenti 
- Obbligatorio: No 
- Usa solo in sottomodulo: No

Nel campo **“Query”** inserire la seguente stringa di testo 

SELECT content.id as 'value', content.title as 'text' FROM #__content content INNER JOIN #__categories categorie ON content.catid = categorie.id   WHERE categorie.parent_id = 24 and content.state=1

Andando a sostituire il numero 24 riportato nell’esempio con l’id della categoria “Servizi” creata precedentemente. Per visualizzare l’id è sufficiente andare in Contenuto -> Categorie e nella lista di tutte le categorie presenti individuare “Servizi”. Sulla destra è presente l’ID quindi il numero da sostituire al posto del 24.

- Valori multipli: Sì 
- Stato: Pubblicato 
- Gruppi di campi: Luoghi 
- Categoria: I luoghi

![custom-field-servizi-presenti](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-servizi-presenti.png)

Nella tab Opzioni impostare:

- Modificabile in: entrambi 
- Layout: selezione avanzata 
- Mostra etichetta: mostra 
- Visualizza il campo: dopo il contenuto del display 
- Layout: h4-titolosubform 
- Mostra se di sola lettura: eredita

### Il luogo è sede di

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: SQL (sql) 
- Nome: struttura-responsabile-del-servizio-2 
- Etichetta: Il Luogo è sede di 
- Obbligatorio: No 
- Usa solo in sottomodulo: No

Nel campo **“Query”** inserire la seguente stringa di testo 

SELECT content.id as 'value', content.title as 'text' FROM #__content content INNER JOIN #__categories categorie ON content.catid = categorie.id   WHERE categorie.parent_id = 19 and content.state=1

Andando a sostituire il numero 19 riportato nell’esempio con l’id della categoria “Organizzazione” creata precedentemente. Per visualizzare l’id è sufficiente andare in Contenuto -> Categorie e nella lista di tutte le categorie presenti individuare “Organizzazione”. Sulla destra è presente l’ID quindi il numero da sostituire al posto del 19.

- Valori multipli: Sì 
- Stato: Pubblicato 
- Gruppi di campi: Luoghi 
- Categoria: I luoghi

![custom-field-il-luogo-e-sede-di](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-il-luogo-e-sede-di.png)

Nella tab Opzioni impostare:

- Modificabile in: entrambi 
- Layout: selezione avanzata 
- Mostra etichetta: mostra 
- Visualizza il campo: dopo il contenuto del display 
- Layout: h4-titolosubform 
- Mostra se di sola lettura: eredita

### Anno di costruzione

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Testo (text) 
- Nome: anno-di-costruzione 
- Etichetta: Anno di costruzione 
- Obbligatorio: No 
- Usa solo in sottomodulo: Si 
- Filtro: Usa impostazioni Plugin 
- Stato: Pubblicato 
- Gruppi di campi: Luoghi

![custom-field-anno-costruzione](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-anno-costruzione.png)

Nella tab Opzioni impostare:

- Modificabile in: entrambi 
- Mostra etichetta: mostra 
- Visualizza il campo: dopo il contenuto del display 
- Layout: numeri 
- Mostra se di sola lettura: eredita

### Numero di piani

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Testo (text) 
- Nome: numero-di-piani 
- Etichetta: Numero di piani 
- Obbligatorio: No 
- Usa solo in sottomodulo: Si 
- Filtro: Usa impostazioni Plugin 
- Stato: Pubblicato Gruppi di campi: Luoghi

![custom-field-numero-piani](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-numero-piani.png)

Nella tab Opzioni impostare:

- Modificabile in: entrambi 
- Mostra etichetta: mostra 
- Visualizza il campo: dopo il contenuto del display 
- Layout: numeri 
- Mostra se di sola lettura: eredita

### Dove si trova

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Sottocampo ( subform ) 
- Nome: dove-si-trova 
- Etichetta: Dove si trova 
- Obbligatorio: No 
- Ripetibile: No 
- Campi: Nome Sede (text) Indirizzo (text) Orari (editor) Gps (text) Email (text) PEC (text) Telefono (text) 
- Stato: pubblicato 
- Gruppo di campi: luoghi 
- Categoria: I luoghi

![custom-field-dove-si-trova](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-dove-si-trova.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Layout: predefinito 
- Mostra etichetta: mostra 
- Visualizza il campo: dopo il contenuto del display 
- Layout: h4-titolosubform 
- Mostra se di sola lettura: eredita

Layout di tipo Card per il campo gruppi Luoghi.

### DModalità di accesso
Creare un nuovo campo e chiamarlo "Modalità di accesso"

All’interno della tab Generale impostare i seguenti parametri:

- Tipo: Editor (editor)
- Nome: modalita-di-accesso
- Etichetta: Modalità di accesso
- Obbligatorio: Sì
- Mostra pulsanti: Nascondi tutti i pulsanti
- Filtro: Usa impostazioni Plugin
- Stato: Pubblicato
- Gruppo di campi: Luoghi
- Categoria: I luoghi

Nella tab Opzioni impostare:

- Modificabile in: entrambi
- Mostra etichetta: mostra
- Visualizza il campo: dopo il contenuto del display
- Layout: card-modalita-accesso
- Mostra se di sola lettura: eredita

### Dettagli edificio

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Sottocampo ( subform ) 
- Nome: dettagli-edificio 
- Etichetta: Dettagli edificio 
- Obbligatorio: No 
- Usa solo in sottomodulo: No 
- Campi: Anno di costruzione (text) Numero di piani (text) 
- Stato: Pubblicato 
- Gruppi di campi: Luoghi 
- Categoria: I luoghi

![custom-field-dettagli-edificio](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-dettagli-edificio.png)

Nella tab Opzioni impostare:

- Modificabile in: entrambi 
- Layout: predefinito 
- Mostra etichetta: mostra 
- Visualizza il campo: dopo il contenuto del display 
- Layout: dettagli-edificio-subform 
- Mostra se di sola lettura: eredita

### Immagine

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Immagine (media) 
- Nome: immagine 
- Etichetta: Immagine 
- Obbligatorio: No 
- Usa solo in sottomodulo: Sì 
- Stato: Pubblicato 
- Gruppi di campi: Luoghi

![custom-field-immagine](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-immagine.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Mostra etichetta: mostra 
- Visualizza il campo: dopo il contenuto del display 
- Layout: immagine-galleria 
- Mostra se di sola lettura: eredita

### Galleria

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Sottocampo ( subform ) 
- Nome: galleria 
- Etichetta: Galleria 
- Obbligatorio: No 
- Ripetibile: Sì 
- Campi: Immagine (media)
- Stato: Pubblicato 
- Gruppi di campi: Luoghi 
- Categoria: I luoghi

![custom-field-galleria](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-galleria.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Layout: predefinito 
- Mostra etichetta: mostra 
- Visualizza il campo: dopo il contenuto del display 
- Layout: galleria-subform 
- Mostra se di sola lettura: eredita

### Gruppo campi Carte della scuola

Creare un nuovo gruppo di campi denominato “Carte della scuola”. 
Quindi andare in Contenuto -> Gruppi di campi -> Nuovo -> compilare il campo titolo “Carte della scuola”.

### Descrizione

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Editor (editor) 
- Nome: descrizione-carte 
- Etichetta: Descrizione 
- Obbligatorio: Sì 
- Usa solo in sottomodulo: No 
- Mostra pulsanti: Usa impostazioni Plugin 
- Filtro: Usa impostazioni Plugin 
- Stato: Pubblicato 
- Gruppo di campi: Carte della scuola 
- Categoria: Le carte della scuola

![custom-field-descrizione-carte](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-descrizione-carte.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Mostra etichetta: mostra 
- Visualizza il campo: dopo il contenuto del display 
- Layout: generale
-  Mostra se di sola lettura: eredita

### Allegati

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Sottocampo ( subform ) 
- Nome: allegati 
- Etichetta: Allegati 
- Obbligatorio: No 
- Ripetibile: Sì 
- Campi: Documenti (editor) 
- Stato: Pubblicato 
- Gruppi di campi: Carte della scuola 
- Categoria: Le carte della scuola

![custom-field-allegati](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-allegati.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Layout: predefinito 
- Mostra etichetta: mostra 
- Visualizza il campo: dopo il contenuto del display 
- Layout: titolosubform 
- Mostra se di sola lettura: eredita

### Servizi collegati

Creare un nuovo campo e chiamarlo esattamente così.

All’interno della tab Generale impostare i seguenti parametri:

- Tipo: SQL (sql)
- Nome: servizi-collegati
- Etichetta: Servizi Collegati
- Obbligatorio: No
- Usa solo in sottomodulo: No

Nel campo **“Query”** inserire la seguente stringa di testo 

SELECT content.id as 'value', content.title as 'text' FROM #__content content INNER JOIN #__categories categorie ON content.catid = categorie.id   WHERE categorie.parent_id = 24 and content.state=1

Andando a sostituire il numero 24 riportato nell’esempio con l’id della categoria “Servizi” creata precedentemente. Per visualizzare l’id è sufficiente andare in Contenuto -> Categorie e nella lista di tutte le categorie presenti individuare “Organizzazione”. Sulla destra è presente l’ID quindi il numero da sostituire al posto del 24.

- Valori multipli: Sì
- Stato: Pubblicato
- Gruppi di campi: Carte della scuola
- Categoria: Le carte della scuola

![custom-field-servizi-collegati](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-servizi-collegati.png)

Nella tab Opzioni impostare:

- Modificabile in: entrambi 
- Layout: selezione avanzata 
- Mostra etichetta: mostra 
- Visualizza il campo: dopo il contenuto del display 
- Layout: h4-titolosubform 
- Mostra se di sola lettura: eredita

### Gruppo campi Organizzazione

Creare un nuovo gruppo di campi denominato “Organizzazione”. 
Quindi andare in Contenuto -> Gruppi di campi -> Nuovo -> compilare il campo titolo “Organizzazione”.

### Cosa fa

Creare un nuovo campo e chiamarlo esattamente così.

All’interno della tab Generale impostare i seguenti parametri:

- Tipo: Editor (editor)
- Nome: cosa-fa
- Etichetta: Cosa fa
- Obbligatorio: Sì
- Usa solo in sottomodulo: No
- Mostra pulsanti: Sì
- Filtro: Usa impostazioni Plugin
- Stato: Pubblicato
- Gruppo di campi: Organizzazione
- Categoria: Organizzazione

![custom-field-cosa-fa](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-cosa-fa.png)

Nella tab Opzioni impostare:

- Modificabile in: entrambi
- Mostra etichetta: mostra
- Visualizza il campo: dopo il contenuto del display
- Layout: generale
- Mostra se di sola lettura: eredita

### Servizi di cui la struttura è responsabile

Creare un nuovo campo e chiamarlo esattamente così.

All’interno della tab Generale impostare i seguenti parametri:

- Tipo: SQL (sql)
- Nome: servizi-struttura-responsabile
- Etichetta: Servizi di cui la struttura è responsabile
- Obbligatorio: No
- Usa solo in sottomodulo: No

Nel campo **“Query”** inserire la seguente stringa di testo 

SELECT content.id as 'value', content.title as 'text' FROM #__content content INNER JOIN #__categories categorie ON content.catid = categorie.id   WHERE categorie.parent_id = 24 and content.state=1

Andando a sostituire il numero 24 riportato nell’esempio con l’id della categoria “Servizi” creata precedentemente. Per visualizzare l’id è sufficiente andare in Contenuto -> Categorie e nella lista di tutte le categorie presenti individuare “Organizzazione”. Sulla destra è presente l’ID quindi il numero da sostituire al posto del 24.

- Valori multipli: Sì 
- Stato: Pubblicato 
- Gruppi di campi: Organizzazione 
- Categoria: Organizzazione

![custom-field-servizi-struttura-responsabile](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-servizi-struttura-responsabile.png)

Nella tab Opzioni impostare:

- Modificabile in: entrambi 
- Layout: Selezione avanzata 
- Mostra etichetta: mostra 
- Visualizza il campo: dopo il contenuto del display 
- Layout: h4-titolosubform 
- Mostra se di sola lettura: eredita

### Contatta la struttura

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Editor (editor)
- Nome: contatta-struttura 
- Etichetta: Contatta la struttura 
- Obbligatorio: Sì 
- Usa solo in sottomodulo: No 
- Mostra pulsanti: Usa impostazioni Plugin 
- Nascondi pulsanti: Pulsante - Articolo Pulsante - Contatto Pulsante - Campo Pulsante - Immagine Pulsante - Menu Pulsante - Modulo Button - Pagebreak Pulsante - Leggi tutto 
- Filtro: Usa impostazioni Plugin 
- Stato: Pubblicato 
- Gruppo di campi: Organizzazione 
- Categoria: Organizzazione

![custom-field-contatta-struttura](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-contatta-struttura.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Mostra etichetta: mostra 
- Visualizza il campo: dopo il contenuto del display 
- Layout: contatti-struttura 
- Mostra se di sola lettura: eredita

### Sede

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Sottocamppo ( subform ) 
- Nome: sede 
- Etichetta: Sede 
- Obbligatorio: No 
- Ripetibile: No 
- Campi: Nome Sede (text) Indirizzo (text) Orari (editor) Gps (text) Email (text) PEC (text) Telefono (text) 
- Stato: Pubblicato 
- Gruppi di campi: Organizzazione 
- Categoria: Organizzazione

![custom-field-sede](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-sede.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Layout: predefinito 
- Mostra etichetta: mostra 
- Visualizza il campo: dopo il contenuto del display 
- Layout: h4-titolosubform 
- Mostra se di sola lettura: eredita

## Custom field Servizi

### Gruppo campi Servizi

Creare un nuovo gruppo di campi denominato “Servizi”. 
Quindi andare in contenuto Gruppi di campi -> Nuovo -> Compilare il campo titolo servizi. 

### Cos'è

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Area di Testo (textarea) 
- Nome: cose 
- Etichetta: Cos’è 
- Obbligatorio: Sì 
- Usa in sottomodulo: No 
- Stato: Pubblicato 
- Gruppi di campi: Servizi 
- Categoria: Servizi

![custom-field-cose](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-cose.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Mostra etichetta: mostra 
- Visualizza campo: dopo il contenuto del display 
- Layout: selezionare cose-acosaserve 
- Mostra se di sola lettura: eredita

### A cosa serve

Lasciare tutte le impostazioni (sia in Generale che in Opzioni) come nel campo “Cos’è” e cambiare solo i campi nome ed etichetta.

- Nome: a-cosa-serve
- Etichetta A cosa serve

![custom-field-a-cosa-serve](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-a-cosa-serve.png)

### Come si accede al servizio

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Area di Testo (textarea) 
- Nome: accesso-generico 
- Etichetta: Come si accede al servizio 
- Obbligatorio: Sì 
- Usa in sottomodulo: Sì 
- Stato: Pubblicato 
- Gruppi di campi: Servizi

![custom-field-come-si-accede-al-servizio](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-come-si-accede-al-servizio.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Mostra etichetta: mostra 
- Visualizza campo: dopo il contenuto del display 
- Layout: accesso 
- Mostra se di sola lettura: eredita

### Accesso online

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: URL (url) 
- Nome: accesso-online 
- Etichetta: Accesso online 
- Obbligatorio: No 
- Usa in sottomodulo: Sì 
- Stato: Pubblicato 
- Gruppi di campi: Servizi

![custom-field-accesso-online](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-accesso-online.png)

Nella tab Opzioni impostare:

- Modificabile in: entrambi
- Mostra etichetta: nascondi
- Visualizza campo: dopo il contenuto del display
- Layout: accesso 
- Mostra se di sola lettura: eredita

### Prenota appuntamento

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: URL (url) 
- Nome: prenota-appuntamento 
- Etichetta: Prenota appuntamento 
- Obbligatorio: No 
- Usa in sottomodulo: Sì 
- Stato: Pubblicato 
- Gruppi di campi: Servizi

![custom-field-prenota-appuntamento](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-prenota-appuntamento.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Mostra etichetta: nascondi 
- Visualizza campo: dopo il contenuto del display 
- Layout: accesso 
- Mostra se di sola lettura: eredita

### Accesso al servizio

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Sottocampo (subform) 
- Nome: come-si-accede-al-servizio 
- Etichetta: Accesso al servizio 
- Obbligatorio: No 
- Aggiungere i seguenti campi creati precedentemente: 

- Come si accede al servizio (textarea) 
- Accesso online (url) 
- Prenota appuntamento (url) 

![custom-field-accesso-al-servizio](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-accesso-al-servizio.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Mostra etichetta: nascondi 
- Visualizza campo: dopo il contenuto del display 
- Layout: usa predefinito 
- Mostra se di sola lettura: eredita

### Nome sede

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Testo (text) 
- Nome: nome-sede 
- Etichetta: Nome 
- Obbligatorio: Sì 
- Usa in sottomodulo: Sì 
- Filtro: Usa impostazioni Plugin 
- Stato: Pubblicato 
- Gruppi di campi: Servizi

![custom-field-nome-sede](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-nome-sede.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Mostra etichetta: mostra 
- Visualizza campo: dopo il contenuto del display 
- Layout: luoghi 
- Mostra se di sola lettura: eredita

### Indirizzo

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Testo (text) 
- Nome: indirizzo 
- Etichetta: indirizzo
- Obbligatorio: Sì 
- Usa in sottomodulo: Sì 
- Filtro: Usa impostazioni Plugin 
- Stato: Pubblicato 
- Gruppi di campi: Servizi

![custom-field-indirizzo](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-indirizzo.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Mostra etichetta: mostra 
- Visualizza campo: dopo il contenuto del display 
- Layout: luoghi 
- Mostra se di sola lettura: eredita

### Orari

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Editor (text) 
- Nome: orari 
- Etichetta: Nome 
- Obbligatorio: Sì 
- Usa in sottomodulo: Sì 
- Mostra pulsanti: No 
- Nascondi pulsanti: Pulsante - Articolo Pulsante - Contatto Pulsante - Campo Pulsante - Immagine Pulsante - Menu Pulsante - Modulo Button - Pagebreak Pulsante - Leggi tutto 
- Filtro: Usa impostazioni Plugin 
- Stato: Pubblicato 
- Gruppi di campi: Servizi

![custom-field-orari](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-orari.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Mostra etichetta: mostra 
- Visualizza campo: dopo il contenuto del display 
- Layout: luoghi 
- Mostra se di sola lettura: eredita

### Gps

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Editor (text) 
- Nome: gps 
- Etichetta: Gps 
- Obbligatorio: Sì 
- Usa in sottomodulo: Sì 
- Filtro: Usa impostazioni Plugin 
- Stato: Pubblicato 
- Gruppi di campi: Servizi

![custom-field-gps](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-gps.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Mostra etichetta: mostra 
- Visualizza campo: dopo il contenuto del display 
- Layout: luoghi 
- Mostra se di sola lettura: eredita

### Email

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Testo (text) 
- Nome: email 
- Etichetta: Email 
- Obbligatorio: Sì 
- Usa in sottomodulo: Sì 
- Filtro: Usa impostazioni Plugin 
- Stato: Pubblicato 
- Gruppi di campi: Servizi

![custom-field-email](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-email.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Mostra etichetta: mostra 
- Visualizza campo: dopo il contenuto del display 
- Layout: luoghi 
- Mostra se di sola lettura: eredita

### PEC

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Testo (text) 
- Nome: pec 
- Etichetta: PEC 
- Obbligatorio: Sì 
- Usa in sottomodulo: Sì 
- Filtro: Usa impostazioni Plugin 
- Stato: Pubblicato 
- Gruppi di campi: Servizi

![custom-field-pec](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-pec.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Mostra etichetta: mostra 
- Visualizza campo: dopo il contenuto del display 
- Layout: luoghi 
- Mostra se di sola lettura: eredita

### Telefono

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Testo (text) 
- Nome: telefono 
- Etichetta: Telefono 
- Obbligatorio: Sì 
- Usa in sottomodulo: Sì 
- Filtro: Usa impostazioni Plugin 
- Stato: Pubblicato 
- Gruppi di campi: Servizi

![custom-field-telefono](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-telefono.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Mostra etichetta: mostra 
- Visualizza campo: dopo il contenuto del display 
- Layout: luoghi 
- Mostra se di sola lettura: eredita

### Luoghi in cui viene erogato il servizio

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Sottocampo ( subform ) 
- Nome: luoghi 
- Etichetta: Luoghi in cui viene erogato il servizio 
- Obbligatorio: No 
- Aggiungere i seguenti campi creati precedentemente: 

- Nome Sede (text) 
- Indirizzo (text) 
- Orari (editor) 
- Gps (text) 
- Email (text) 
- PEC (text) 
- Telefono (text) 

- Stato: Pubblicato 
- Gruppi di campi: Accesso 
- Categoria: Servizi

![custom-field-luoghi-sottocampo](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-luoghi-sottocampo.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Layout: Predefinito 
- Mostra etichetta: mostra 
- Visualizza campo: dopo il contenuto del display 
- Layout: Usa predefinito 
- Mostra se di sola lettura: eredita

### Servizi correlati

Per poter selezionare nell’articolo del servizio uno o più servizi correlati è necessario creare una campo di tipo custom field. 

- Tipo: SQL (sql) 
- Nome: test-articoli 
- Etichetta: Servizi correlati 
- Obbligatorio: No 
- Usa in solo sotto modulo: No

Nel campo **“Query”** inserire la seguente stringa di testo 

SELECT content.id as 'value', content.title as 'text' FROM #__content content INNER JOIN #__categories categorie ON content.catid = categorie.id   WHERE categorie.parent_id = 24 and content.state=1

Andando a sostituire il numero 24 riportato nell’esempio con l’id della categoria degli articoli “Servizi” creata precedentemente. Per visualizzare l’id è sufficiente andare in Contenuto -> Categorie e nella lista di tutte le categorie presenti individuare “servizi”. Sulla destra è presente l’ID quindi il numero da sostituire al posto del 24.

- Valori multipli: Sì 
- Stato: Pubblicato 
- Gruppi di campi: Servizi 
- Categoria: Servizi

![custom-field-servizi-correlati](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-servizi-correlati.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Layout: Selezione avanzata 
- Mostra etichetta: mostra 
- Visualizza campo: dopo il contenuto del display 
- Layout: Usa predefinito 
- Mostra se di sola lettura: eredita

### Sottomodulo Cosa serve

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Area di testo (textarea) 
- Nome: sottomodulo-cosa-serve 
- Etichetta: Cosa serve 
- Obbligatorio: Sì 
- Usa in sottomodulo: Sì 
- Filtro: Testo 
- Stato: Pubblicato 
- Gruppi di campi: Servizi

![custom-field-sottomodulo-cosa-serve](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-sottomodulo-cosa-serve.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Mostra etichetta: mostra 
- Visualizza campo: dopo il contenuto del display 
- Layout: cose-acosaserve 
- Mostra se di sola lettura: eredita

### Cosa serve

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Sottocampo ( subform ) 
- Nome: gruppo-cosa-serve 
- Etichetta: Cosa Serve 
- Obbligatorio: Si 
- Campi: Sottomodulo Cosa serve (textarea)
- Stato: Pubblicato 
- Gruppi di campi: Servizi 
- Categoria: Servizi

![custom-field-cosa-serve](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-cosa-serve.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Layout: Predefinito 
- Mostra etichetta: Nascondi 
- Visualizza campo: dopo il contenuto del display 
- Layout: usa predefinito 
- Mostra se di sola lettura: eredita

### Sottomodulo Riga Cosa Serve

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Area di testo (textarea) 
- Nome: riga-cosa-serve 
- Etichetta: Riga Cosa Serve 
- Obbligatorio: No 
- Usa solo in sottomodulo: Sì 
- Filtro: Usa impostazione Plugin 
- Stato: Pubblicato 
- Gruppi di campi: Servizi

![custom-field-sottomodulo-riga-cosa-serve](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-sottomodulo-riga-cosa-serve.png)

Nella tab Opzioni impostare:

- Modificabile in: entrambi 
- Mostra etichetta: Nascondi 
- Visualizza campo: Prima di visualizzare il contenuto 
- Layout: cards-servizio
- Mostra se di sola lettura: eredita

### Elenco cosa serve

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Sottocampo ( subform ) 
- Nome: elenco-cosa-serve 
- Etichetta: Elenco cosa serve 
- Obbligatorio: No 
- Ripetibile: Si 
- Campi: Riga Cosa Serve (textarea)
- Stato: pubblicato 
- Gruppi di campi: Servizi 
- Categoria: Servizi

![custom-field-elenco-cosa-serve](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-elenco-cosa-serve.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi Layout: Predefinito 
- Mostra etichetta: Nascondi 
- Visualizza campo: Dopo il contenuto del display 
- Layout: come-si-accede-subform 
- Mostra se di sola lettura: eredita

### Tempi e scadenze

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Area di testo (textarea) 
- Nome: tempi-e-scadenze 
- Etichetta: Tempi e scadenza 
- Obbligatorio: Sì 
- Usa in sottomodulo: No 
- Filtro: Usa impostazioni Plugin 
- Stato: Pubblicato 
- Gruppi di campi: Servizi 
- Categoria: Servizi

![custom-field-tempi-scadenze](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-tempi-scadenze.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Mostra etichetta: Nascondi 
- Visualizza campo: Dopo il contenuto del display 
- Layout: cose-acosaserve 
- Mostra se di sola lettura: eredita

### Riga Data Tempi e scadenze

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Calendario (Calendar) 
- Nome: riga-data-tempi-e-scadenze 
- Etichetta: Riga Data Tempi e scadenze 
- Obbligatorio: No 
- Usa solo in sottomodulo: Sì 
- Stato: Pubblicato 
- Gruppo di campi: Servizi

![custom-field-riga-data-tempi-scadenze](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-riga-data-tempi-scadenze.png)

Nella tab Opzioni impostare:

- Modificabile in: entrambi 
- Mostra etichetta: Nascondi 
- Visualizza campo: Dopo il contenuto del display 
- Layout: calendario-data 
- Mostra se di sola lettura: eredita

### Riga Descrizione data tempi e scadenze

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Area di testo (textarea) 
- Nome: riga-descrizione-data-tempi-e-scadenze 
- Etichetta: Riga Descrizione data tempi e scadenze 
- Obbligatorio: No 
- Usa solo in sottomodulo: Sì 
- Stato: Pubblicato 
- Gruppo di campi: Servizi

![custom-field-riga--descrizione-data-tempi-scadenze](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-riga-descrizione-data-tempi-scadenze.png)

Nella tab Opzioni impostare:

- Modificabile in: entrambi 
- Mostra etichetta: Mostra 
- Visualizza campo: Dopo il contenuto del display 
- Layout: calendario-descrizione 
- Mostra se di sola lettura: eredita

### Calendario tempi e scadenze

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Sottocampo ( subform ) 
- Nome: calendario-tempi-e-scadenze 
- Etichetta: Calendario tempi e scadenze 
- Obbligatorio: No 
- Ripetibile: Si 
- Campi: Riga Data Tempi e scadenze (calendar) Riga Descrizione data tempi e scadenze (textarea) - Stato: Pubblicato 
- Gruppo di campi: 
- Servizi Categoria: Servizi

![custom-field-riga--descrizione-data-tempi-scadenze](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-calendario-tempi-scadenze.png)

Nella tab Opzioni impostare:

- Modificabile in: entrambi 
- Layout: predefinito 
- Mostra etichetta: Nascondi 
- Visualizza campo: Dopo il contenuto del display 
- Layout: usa predefinito 
- Mostra se di sola lettura: eredita

### Progetti correlati

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: SQL (sql) 
- Nome: progetticorrelati 
- Etichetta: Progetti correlati 
- Obbligatorio: No 
- Usa solo in sottomodulo: No

Nel campo **“Query”** inserire la seguente stringa di testo 

SELECT content.id as 'value', content.title as 'text' FROM #__content content INNER JOIN #__categories categorie ON content.catid = categorie.id   WHERE categorie.parent_id = 35 and content.state=1

Andando a sostituire il numero 35 riportato nell’esempio con l’id della categoria degli articoli “I progetti delle classi” creata precedentemente. Per visualizzare l’id è sufficiente andare in Contenuti -> Categorie e nella lista di tutte le categorie presenti individuare “I progetti delle classi” sulla destra è presente l’ID quindi il numero da sostituire al posto del 35 sopra.

- Valori multipli: Sì
- Stato: Pubblicato
- Gruppo di campi: Servizi
- Categoria: Servizi

![custom-field-progetti-correlati](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-progetti-correlati.png)

Nella tab Opzioni impostare:

- Modificabile in: entrambi 
- Layout: Selezione avanzata 
- Mostra etichetta: mostra 
- Visualizza campo: dopo il contenuto del display 
- Layout: Usa predefinito 
- Mostra se di sola lettura: eredita

### Ulteriori informazioni

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: area di testo (textarea)
- Nome: ulteriori-infomraizoni 
- Etichetta: Ulteriori informazioni 
- Obbligatorio: Sì 
- Usa solo in sottomodulo: No
- Filtro: Testo
- Stato: Pubblicato
- Gruppi di campi: Servizi
- Categoria: Servizi

![custom-field-ulteriori-informazioni](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-ulteriori-informazioni.png)

Nella tab Opzioni impostare:

- Modificabile in: entrambi 
- Mostra etichetta: mostra 
- Visualizza campo: dopo il contenuto del display 
- Layout: cose-acosaserve
- Mostra se di sola lettura: eredita

### Contatti

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Editor (editor)
- Nome: contatti
- Etichetta: Contatti
- Obbligatorio: Sì 
- Usa solo in sottomodulo: No
- Nascondi pulsanti: Pulsante - Articolo Pulsante - Contatto Pulsante - Campo Pulsante - Immagine Pulsante - Menu Pulsante - Modulo Button - Pagebreak Pulsante - Leggi tutto 
- Filtro: usa impostazioni Plugin
- Stato: Pubblicato
- Gruppi di campi: Servizi
- Categoria: Servizi

![custom-field-contatti](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-contatti.png)

Nella tab Opzioni impostare:

- Modificabile in: entrambi 
- Mostra etichetta: mostra 
- Visualizza campo: dopo il contenuto del display 
- Layout: card-contatti
- Mostra se di sola lettura: eredita

## Custom field Novità

### Gruppo campi Servizi

Creare un nuovo gruppo di campi denominato “Notizie”. Quindi andare in Contenuto -> Gruppi di campi -> Nuovo -> compilare il campo titolo “Notizie”.

### Descrizione notizia

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Area di testo (textarea) 
- Nome: descrizione-notizia 
- Etichetta: Descrizione notizia 
- Obbligatorio: No 
- Usa solo in sottomodulo: No 
- Filtro: Usa impostazioni Plugin 
- Stato: Pubblicato 
- Gruppo di campi: Notizie 
- Categoria: Notizie

![custom-field-descrizione-notizia](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-descrizione-notizia.png)

Nella tab Opzioni impostare:

- Modificabile in: entrambi
- Mostra etichetta: mostra
- Visualizza campo: dopo il contenuto del display
- Layout: Usa predefinito
- Mostra se di sola lettura: eredita

### Gruppo campi Circolari

Creare un nuovo gruppo di campi denominato “Circolari”. Quindi andare in Contenuto -> Gruppi di campi -> Nuovo -> compilare il campo titolo Circolari.

### Circolare n.

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Testo (text) 
- Nome: circolare-n 
- Etichetta: Circolare n. 
- Obbligatorio: No 
- Usa solo in sottomodulo: No 
- Filtro: Usa impostazioni Plugin 
- Stato: Pubblicato 
- Gruppi di campi: Circolari 
- Categoria: Circolari

![custom-field-numero-circolare](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-numero-circolare.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Mostra etichetta: mostra 
- Visualizza campo: prima di visualizzare il contenuto 
- Layout: circolari 
- Mostra se di sola lettura: eredita

### Descrizione circolare

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Area di testo (textarea) 
- Nome: descrizione-circolare 
- Etichetta: Descrizione circolare 
- Obbligatorio: No 
- Usa solo in sottomodulo: No 
- Filtro: Usa impostazioni Plugin 
- Stato: Pubblicato 
- Gruppo di campi: Circolari 
- Categoria: Circolari

![custom-field-descrizione-circolare](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-descrizione-circolare.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Mostra etichetta: mostra 
- Visualizza campo: dopo il contenuto del display 
- Layout: usa predefinito 
- Mostra se di sola lettura: eredita

### Gruppo campi Eventi

Creare un nuovo gruppo di campi denominato “Eventi”. Quindi andare in Contenuto -> Gruppi di campi -> Nuovo -> compilare il campo titolo Eventi.

### Cos'è

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Area di testo (textarea) 
- Nome: cose-eventi 
- Etichetta: Cos’è 
- Obbligatorio: Sì 
- Usa solo in sottomodulo: No 
- Filtro: Testo 
- Stato: Pubblicato 
- Gruppo di campi: Eventi 
- Categoria: Eventi

![custom-field-cose-eventi](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-cose-eventi.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Mostra etichetta: mostra 
- Visualizza campo: dopo il titolo 
- Layout: generale 
- Mostra se di sola lettura: eredita

### Luogo

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Sottocampo ( subform ) 
- Nome: luogo-evento
- Etichetta: Luogo
- Obbligatorio: No 
- Ripetibile: No 
- Campi: Nome Sede (text) Indirizzo (text) Gps (text)
- Stato: Pubblicato 
- Gruppo di campi: Eventi 
- Categoria: Eventi

![custom-field-luogo-eventi](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-luogo-eventi.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Layout: predefinito 
- Mostra etichetta: mostra 
- Visualizza campo: dopo il titolo 
- Layout: h4-titolosubform 
- Mostra se di sola lettura: eredita

### Date e Orari

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Sottocampo ( subform ) 
- Nome: date-e-orari 
- Etichetta: Date e Orari 
- Obbligatorio: No 
- Ripetibile: Sì 
- Campi: Riga Data Tempi e scadenze (calendar) Riga Descrizione data tempi e scadenze (textarea) - Stato: Pubblicato 
- Gruppi di campi: Eventi 
- Categoria: Eventi

![custom-field-date-orari](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-date-orari.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Layout: predefinito 
- Mostra etichetta: mostra 
- Visualizza campo: dopo il titolo 
- Layout: h4-titolosubform 
- Mostra se di sola lettura: eredita

### Data Evento

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Calendario (calendar)
- Nome: data-evento
- Etichetta: Data Evento
- Obbligatorio: No
- Usa solo in sottomodulo: No
- Mostra ora: No
- Stato: Pubblicato
- Gruppi di campi: Eventi 
- Categoria: Eventi

![custom-field-data-evento](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-data-evento.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Mostra etichetta: nascondi 
- Visualizza campo: prima di visualizzare il contenuto
- Layout: data-evento 
- Mostra se di sola lettura: eredita

### Contatti

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Editor (editor) 
- Nome: contatti-eventi 
- Etichetta: Contatti 
- Obbligatorio: Sì 
- Usa solo in sottomodulo: No 
- Mostra pulsanti: Usa impostazioni Plugin 
- Nascondi pulsanti: Pulsante - Articolo Pulsante - Contatto Pulsante - Campo Pulsante - Immagine Pulsante - Menu Pulsante - Modulo Button - Pagebreak Pulsante - Leggi tutto 
- Filtro: Usa impostazioni Plugin 
- Stato: Pubblicato 
- Gruppi di campi: Eventi 
- Categoria: Eventi

![custom-field-contatti-eventi](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-contatti-eventi.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Mostra etichetta: mostra 
- Visualizza campo: dopo il titolo 
- Layout: card-contatti-evento 
- Mostra se di sola lettura: eredita

## Custom field Didattica

### Gruppo campi Schede didattiche

Creare un nuovo gruppo di campi denominato “Schede didattiche”. Quindi andare in Contenuto -> Gruppi di campi -> Nuovo -> compilare il campo titolo “Schede didattiche”.

### Obiettivi

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Editor (editor) 
- Nome: obiettivi 
- Etichetta: Obiettivi 
- Obbligatorio: No 
- Usa solo in sottomodulo: No 
- Mostra pulsanti: Usa impostazioni Plugin 
- Filtro: Usa impostazioni Plugin 
- Stato: Pubblicato 
- Gruppo di campi: Schede didattiche 
- Categoria: Le schede didattiche

![custom-field-obiettivi](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-obiettivi.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Mostra etichetta: mostra 
- Visualizza campo: dopo il contenuto del display 
- Layout: cose-acosaserve 
- Mostra se di sola lettura: eredita

### Tempo di apprendimento

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri:

- Tipo: Editor (editor) 
- Nome: tempo-di-apprendimento 
- Etichetta: Tempo di apprendimento 
- Obbligatorio: No 
- Usa solo in sottomodulo: No 
- Mostra pulsanti: Usa impostazioni Plugin Nascondi pulsanti: Pulsante - Articolo Pulsante - Contatto Pulsante - Campo Pulsante - Immagine Pulsante - Menu Pulsante - Modulo Button - Pagebreak Pulsante - Leggi tutto 
- Filtro: Usa impostazioni Plugin 
- Stato: Pubblicato 
- Gruppi di campi: Schede didattiche 
- Categoria: Le schede didattiche

![custom-field-tempo-di-apprendimento](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-tempo-di-apprendimento.png)

Nella tab Opzioni impostare:

- Modificabile in: entrambi
- Mostra etichetta: mostra
- Visualizza campo: dopo il contenuto del display
- Layout: tempo-apprendimento
- Mostra se di sola lettura: eredita

### Argomento

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Editor (editor) 
- Nome: argomento 
- Etichetta: Argomento 
- Obbligatorio: No 
- Usa solo in sottomodulo: No 
- Mostra pulsanti: Usa impostazioni Plugin 
- Filtro: Usa impostazioni Plugin

![custom-field-argomento](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-argomento.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Mostra etichetta: mostra 
- Visualizza campo: dopo il contenuto del display 
- Layout: cose-acosaserve 
- Mostra se di sola lettura: eredita

### Attività

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Editor (editor) 
- Nome: attività 
- Etichetta: Attività 
- Obbligatorio: No 
- Usa solo in sottomodulo: No 
- Mostra pulsanti: Usa impostazioni Plugin 
- Filtro: Usa impostazioni Plugin 
- Stato: Pubblicato 
- Gruppi di campi: Schede didattiche 
- Categoria: Le schede didattiche

![custom-field-attivita](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-attivita.png)

Nella tab Opzioni impostare: 

- Modificabile in: entrambi 
- Mostra etichetta: mostra 
- Visualizza campo: dopo il contenuto del display 
- Layout: cose-acosaserve 
- Mostra se di sola lettura: eredita

### Documenti

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Editor (editor) 
- Nome: documenti 
- Etichetta: Documenti 
- Obbligatorio: No 
- Usa solo in sottomodulo: Sì 
- Mostra pulsanti: Sì 
- Nascondi pulsanti: Pulsante - Articolo Pulsante - Contatto Pulsante - Campo Pulsante - Menu Pulsante - Modulo Button - Pagebreak Pulsante - Leggi tutto 
- Filtro: Usa impostazioni Plugin 
- Gruppi di campi: Schede didattiche

![custom-field-documenti](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-documenti.png)

Nella tab Opzioni impostare:

- Modificabile in: entrambi
- Mostra etichetta: mostra
- Visualizza campo: prima di visualizzare il contenuto
- Layout: usa predefinito
- Mostra se di sola lettura: eredita

### Documenti

Creare un nuovo campo e chiamarlo esattamente così. 

All’interno della tab Generale impostare i seguenti parametri: 

- Tipo: Sottocampo ( subform ) 
- Nome: documenti-schede 
- Etichetta: Documenti 
- Obbligatorio: No 
- Ripetibile: Sì 
- Campi: Documenti (editor)
- Stato: Pubblicato 
- Gruppi di campi: Schede didattiche 
- Categorie: Le schede didattiche

![custom-field-documenti](https://jit.protocollicreativi.it/templates/joomla-italia-theme/doc/img/custom-field-documenti-schede.png)

Nella tab Opzioni impostare:

- Modificabile in: entrambi
- Layout: predefinito 
- Mostra etichetta: mostra 
- Visualizza il campo: dopo il contenuto del display 
- Layout: h4-titolosubform 
- Mostra se di sola lettura: eredita








