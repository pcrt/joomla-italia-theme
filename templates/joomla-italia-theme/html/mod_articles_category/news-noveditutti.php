<?php

/**
 * Variante del layout "news" senza i collegamenti "Vedi tutti" (issue #61): utile quando
 * il modulo mette insieme categorie di sezioni diverse e il collegamento porterebbe alla
 * categoria del primo articolo. Si sceglie dal campo Layout del modulo (Avanzate).
 * Il resto e' identico a news.php; i sotto-layout _items e _gruppi richiamano quelli di news.
 */

defined('_JEXEC') or die;

$nascondiVediTutti = true;

require __DIR__ . '/news.php';
