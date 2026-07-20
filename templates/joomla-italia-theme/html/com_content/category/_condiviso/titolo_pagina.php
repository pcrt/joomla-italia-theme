<?php

/**
 * Titolo del browser (<title>) delle pagine di categoria.
 *
 * PROBLEMA RISOLTO
 * Le sottocategorie che non hanno una voce di menu propria ereditano il <title>
 * della voce di menu padre. Risultato: cinque pagine diverse (Progetti Area
 * Scientifica, Area Umanistica, Progetto di Integrazione...) mostravano tutte
 * "I progetti delle classi", pur avendo un <h1> diverso. Un titolo che non
 * descrive la pagina viola il criterio WCAG 2.1 - 2.4.2 "Pagina titolata" ed e'
 * il primo elemento letto da uno screen reader e mostrato nella scheda del browser.
 *
 * Qui si antepone il titolo della categoria corrente, ma solo se non e' gia'
 * contenuto nel titolo: sulle categorie che hanno una voce di menu propria non
 * cambia nulla.
 *
 * NB: nomi di classe COMPLETI, le istruzioni "use" non si ereditano nei file inclusi.
 */
defined('_JEXEC') or die;

$titoloCategoria = isset($this->category->title) ? trim((string) $this->category->title) : '';

if ($titoloCategoria !== '') {
    $documento = \Joomla\CMS\Factory::getApplication()->getDocument();
    $titoloCorrente = trim((string) $documento->getTitle());

    if ($titoloCorrente === '') {
        $documento->setTitle($titoloCategoria);
    } elseif (stripos($titoloCorrente, $titoloCategoria) === false) {
        $documento->setTitle($titoloCategoria . ' - ' . $titoloCorrente);
    }
}
