<?php

/**
 * Variante del layout "progetti" senza i collegamenti "Vedi tutti" (issue #61): utile quando
 * il modulo mette insieme categorie di sezioni diverse e il collegamento porterebbe alla
 * categoria del primo articolo. Si sceglie dal campo Layout del modulo (Avanzate).
 * Il resto e' identico a progetti.php; i sotto-layout _items e _gruppi richiamano quelli di progetti.
 */

defined('_JEXEC') or die;

$nascondiVediTutti = true;

require __DIR__ . '/progetti.php';
