<?php

/**
 * Date di pubblicazione e di revisione dell'articolo (riga "Pubblicato / Revisione").
 *
 * PROBLEMA RISOLTO (issue #64)
 * I layout articolo assegnavano $pubblicazione e $revisione con publish_up e
 * modified, ma subito dopo le sovrascrivevano con Factory::getDate(): ogni
 * articolo mostrava come data di pubblicazione e di revisione il giorno della
 * visita, non le date reali.
 *
 * Qui:
 * - $pubblicazione = publish_up (se vuota, created), nel fuso orario del sito,
 *   nello stesso formato di prima (d.m.Y);
 * - $revisione = modified, solo se successiva alla pubblicazione e in un giorno
 *   diverso; altrimenti resta vuota e il layout non stampa "Revisione".
 *
 * NB: nomi di classe COMPLETI, le istruzioni "use" non si ereditano nei file inclusi.
 */
defined('_JEXEC') or die;

$formatoData = 'd.m.Y';

// Per Joomla una data "vuota" puo' essere null, '' oppure il valore storico 0000-00-00.
$dataValida = static function ($data): bool {
    return !empty($data) && strpos((string) $data, '0000-00-00') !== 0;
};

$dataPubblicazione = $dataValida($this->item->publish_up ?? null) ? $this->item->publish_up : ($this->item->created ?? null);
$dataRevisione     = $this->item->modified ?? null;

$pubblicazione = $dataValida($dataPubblicazione) ? \Joomla\CMS\HTML\HTMLHelper::_('date', $dataPubblicazione, $formatoData) : '';
$revisione     = '';

if ($pubblicazione !== '' && $dataValida($dataRevisione) && strtotime($dataRevisione) > strtotime($dataPubblicazione)) {
    $revisione = \Joomla\CMS\HTML\HTMLHelper::_('date', $dataRevisione, $formatoData);

    // Stessa giornata: la voce "Revisione" non aggiungerebbe informazione.
    if ($revisione === $pubblicazione) {
        $revisione = '';
    }
}
