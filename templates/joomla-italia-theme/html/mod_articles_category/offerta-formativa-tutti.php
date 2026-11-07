<?php

/**
 * Variante del layout "offerta-formativa" con, in fondo, il pulsante "Tutti i percorsi di
 * studio" che porta alla categoria madre di quelle raggruppate nel modulo (issue #98).
 * Si sceglie dal campo Layout del modulo (Avanzate). Il resto e' identico a offerta-formativa.php.
 */

defined('_JEXEC') or die;

$mostraTuttiPercorsi = true;

require __DIR__ . '/offerta-formativa.php';
