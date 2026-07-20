<?php

/**
 * Query condivisa: elenco delle categorie "sorelle" (stesso genitore),
 * usata per il filtro "Tipologia" nelle pagine di categoria.
 *
 * Definisce la variabile $rows. Prima questo stesso codice era copiato
 * in 7 layout diversi: una correzione andava fatta 7 volte (ed e' cosi'
 * che nacque il bug "parent_id = root" corretto il 2026-07-13).
 *
 * NB: si usa il nome completo \Joomla\CMS\Factory perche' le istruzioni
 * "use" valgono solo nel file in cui sono scritte.
 */
defined('_JEXEC') or die;

$db    = \Joomla\CMS\Factory::getContainer()->get('DatabaseDriver');
$query = $db->getQuery(true);

$query->select($db->quoteName(array('title', 'id', 'language')))
    ->from($db->quoteName('#__categories'))
    ->where($db->quoteName('parent_id') . ' = ' . (int) ($this->category->parent_id === 'root' ? 1 : $this->category->parent_id))
    ->where($db->quoteName('extension') . ' = ' . $db->quote('com_content'));
$db->setQuery($query);
$rows = $db->loadObjectList();
