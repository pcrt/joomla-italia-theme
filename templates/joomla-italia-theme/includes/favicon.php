<?php

/**
 * Favicon del sito (issue #60).
 *
 * Richiamato da index.php, component.php, error.php e offline.php. Se nei parametri del
 * template e' impostata una favicon la usa, con il tipo MIME ricavato dall'estensione;
 * altrimenti stampa i collegamenti predefiniti di Joomla, come nelle versioni precedenti.
 *
 * Variabile attesa: $this (il documento).
 */

defined('_JEXEC') or die;

$faviconParam = trim((string) $this->params->get('favicon', ''));

if ($faviconParam !== '') {
    // Il campo media salva "percorso#joomlaImage://..." : si tiene solo il percorso.
    $faviconUrl = \Joomla\CMS\HTML\HTMLHelper::cleanImageURL($faviconParam)->url;
    $estensione = strtolower(pathinfo(parse_url($faviconUrl, PHP_URL_PATH) ?: '', PATHINFO_EXTENSION));
    $mime       = [
        'ico'  => 'image/x-icon',
        'png'  => 'image/png',
        'svg'  => 'image/svg+xml',
        'gif'  => 'image/gif',
        'jpg'  => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'webp' => 'image/webp',
    ][$estensione] ?? '';

    if (!preg_match('#^(https?:)?//#', $faviconUrl)) {
        $faviconUrl = \Joomla\CMS\Uri\Uri::root(true) . '/' . ltrim($faviconUrl, '/');
    }

    $this->addHeadLink(htmlspecialchars($faviconUrl, ENT_QUOTES, 'UTF-8'), 'icon', 'rel', $mime !== '' ? ['type' => $mime] : []);
} else {
    // Browsers support SVG favicons
    $this->addHeadLink(\Joomla\CMS\HTML\HTMLHelper::_('image', 'joomla-favicon.svg', '', [], true, 1), 'icon', 'rel', ['type' => 'image/svg+xml']);
    $this->addHeadLink(\Joomla\CMS\HTML\HTMLHelper::_('image', 'favicon.ico', '', [], true, 1), 'alternate icon', 'rel', ['type' => 'image/vnd.microsoft.icon']);
    $this->addHeadLink(\Joomla\CMS\HTML\HTMLHelper::_('image', 'joomla-favicon-pinned.svg', '', [], true, 1), 'mask-icon', 'rel', ['color' => '#000']);
}
